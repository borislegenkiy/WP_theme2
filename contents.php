<?php
class Kama_Contents{    
	// defaults options
	public $opt = array(
		// Отступ слева у подразделов в px.
		'margin'     => 40,
		// Теги по умолчанию по котором будет строиться оглавление. Порядок имеет значение. 
		// Кроме тегов, можно указать атрибут classа: array('h2','.class_name'). Можно указать строкой: 'h2 h3 .class_name'
		'selectors'  => array('h2','h3','h4'),
		// Ссылка на возврат к оглавлению. '' - убрать ссылку
//		'to_menu'    => '↑',
		// Заголовок. '' - убрать заголовок 
		'title'      => 'Содержание:',
		// Css стили. '' - убрать стили
		'css'        => '.kc__gotop{ display:block; text-align:right; } .kc__title{ font-style:italic; padding:1em 0; }',
		// Минимальное количество найденных тегов, чтобы оглавление выводилось.
		'min_found'  => 2,
		// Минимальная длина (символов) текста, чтобы оглавление выводилось.
		'min_length' => 2000,
		// Ссылка на страницу для которой собирается оглавление. Если оглавление выводиться на другой странице...
		'page_url'   => '',
		// Название шоткода
		'shortcode'  => 'contents',
		// Оставлять символы в анкорах
		'spec'       => '\'.+$*~=',
		// Какой тип анкора использовать: 'a' - <a name="anchor"></a> или 'id' - 
		'anchor_type' => 'a',
	);

	public $contents; // collect html contents

	private $temp;

	static $inst;

	function __construct( $args = array() ){
		$this->set_opt( $args );
		return $this;
	}

	## экземпляр
	static function init( $args = array() ){
		is_null( self::$inst ) && self::$inst = new self( $args );
		//if( $args ) self::$inst->set_opt( $args ); // ! NO
		return self::$inst;
	}

	function set_opt( $args = array() ){
		$this->opt = (object) array_merge( $this->opt, (array) $args );
	}

	/**
	 * Обрабатывает текст, превращает шоткод в нем в оглавление.
	 * @param (string) $content текст, в котором есть шоткод.
	 * @param (string) $contents_cb колбек фунция, которая обработает список оглавления.
	 * @return Обработанный текст с оглавлением, если в нем есть шоткод.
	 */
	function shortcode( $content, $contents_cb = '' ){
		if( false === strpos( $content, '['. $this->opt->shortcode ) ) 
			return $content; 

		// get contents data
		if( ! preg_match('~^(.*)\['. $this->opt->shortcode .'([^\]]*)\](.*)$~s', $content, $m ) )
			return $content;

		$contents = $this->make_contents( $m[3], $m[2] );

		if( $contents && $contents_cb && is_callable($contents_cb) )
			$contents = $contents_cb( $contents );

		return $m[1] . $contents . $m[3];
	}

	/**
	 * Заменяет заголовки в переданном тексте (по ссылке), создает и возвращает оглавление.
	 * @param (string)        $content текст на основе которого нужно создать оглавление.
	 * @param (array/string)  $tags    массив тегов, которые искать в переданном тексте. 
	 *                                 Можно указать: имена тегов "h2 h3" или классы элементов ".foo .foo2".
	 *                                 Если в теги добавить маркер "embed" то вернется только тег <ul>
	 *                                 без заголовка и оборачивающего блока. Нужно для использвоания внутри текста, как список.
	 * @return                html код оглавления.
	 */
	function make_contents( & $content, $tags = '' ){
		// выходим если текст короткий
		if( mb_strlen( strip_tags($content) ) < $this->opt->min_length ) return;

		$this->temp     = $this->opt;
		$this->temp->i  = 0;
		$this->contents = '';

		if( is_string($tags) && $tags = trim($tags) )
			$tags = array_map('trim', preg_split('~\s+~', $tags ) );

		if( ! $tags )
			$tags = $this->opt->selectors;

		// check tags
		foreach( $tags as $k => $tag ){
			// remove special marker tags and set $args
			if( in_array( $tag, array('embed','no_to_menu') ) ){
				if( $tag == 'embed' ) $this->temp->embed = true;
				if( $tag == 'no_to_menu' ) $this->opt->to_menu = false;

				unset( $tags[ $k ] );
				continue;
			}

			// remove tag if it's not exists in content
			$patt = ( ($tag[0] == '.') ? 'class=[\'"][^\'"]*'. substr($tag, 1) : "<$tag" );
			if( ! preg_match("/$patt/i", $content ) ){
				unset( $tags[ $k ] );
				continue;
			}
		}

		if( ! $tags ) return;

		// set patterns from given $tags
		// separate classes & tags & set
		$class_patt = $tag_patt = $level_tags = array();
		foreach( $tags as $tag ){
			// class
			if( $tag{0} == '.' ){
				$tag  = substr( $tag, 1 );
				$link = & $class_patt;
			}
			// html tag
			else
				$link = & $tag_patt;

			$link[] = $tag;         
			$level_tags[] = $tag;
		}

		$this->temp->level_tags = array_flip( $level_tags );

		// заменяем все заголовки и собираем оглавление в $this->contents
		$patt_in = array();
		if( $tag_patt )   $patt_in[] = '(?:<('. implode('|', $tag_patt) .')([^>]*)>(.*?)<\/\1>)';
		if( $class_patt ) $patt_in[] = '(?:<([^ >]+) ([^>]*class=["\'][^>]*('. implode('|', $class_patt) .')[^>]*["\'][^>]*)>(.*?)<\/'. ($patt_in?'\4':'\1') .'>)';

		$patt_in = implode('|', $patt_in );

		// collect and replace
		$_content = preg_replace_callback("/$patt_in/is", array( &$this, '__make_contents_callback'), $content, -1, $count );

		if( ! $count || $count < $this->opt->min_found )
			return;

		$content = $_content; // опять работаем с важной $content
		// html
		static $css;
		$embed = !! isset($this->temp->embed);
		$this->contents = 
			( ( !$embed && $this->opt->title ) ? '<div>' : '' ) .
			( ( !$embed && $this->opt->title ) ? '<div class="kc-title" id="kcmenu">'. $this->opt->title .'</div>'. "\n" : '' ) .
				'<ul class="contents"'. ((!$this->opt->title || $embed) ? ' id="kcmenu"' : '') .'>'. "\n". 
					implode('', $this->contents ) .
				'</ul>'."\n" .
			( ( !$embed && $this->opt->title ) ? '</div>' : '' );

		return $this->contents;
	}

	## callback функция для замены и сбора оглавления
	private function __make_contents_callback( $match ){
		// it's only class selector in pattern
		if( count($match) == 5 ){
			$tag   = $match[1];
			$attrs = $match[2];
			$title = $match[4];

			$level_tag = $match[3]; // class_name
		}
		// it's found tag selector
		elseif( count($match) == 4 ){
			$tag   = $match[1];
			$attrs = $match[2];
			$title = $match[3];

			$level_tag = $tag;
		}
		// it's found class selector
		else{
			$tag   = $match[4];
			$attrs = $match[5];
			$title = $match[7];

			$level_tag = $match[6]; // class_name
		}

		$anchor = $this->__sanitaze_anchor( $title );
		$opt = & $this->opt;

		$level = @ $this->temp->level_tags[ $level_tag ];
		if( $level > 0 )
			$sub = ( $opt->margin ? ' style="margin-left:'. ($level*$opt->margin) .'px;"' : '') . ' class="sub sub_'. $level .'"';
		else 
			$sub = ' class="top"';

		// собираем оглавление
		$this->contents[] = "\t". '<li'. $sub .'><a href="'. $opt->page_url .'#'. $anchor .'">'. $title .'</a></li>'. "\n";

		// заменяем
		$to_menu = $new_el = '';
		if( $opt->to_menu )
			$to_menu = (++$this->temp->i == 1) ? '' : '<a class="kc-gotop kc__gotop" href="'. $opt->page_url .'#kcmenu">'. $opt->to_menu .'</a>';

		$new_el = "\n<$tag id=\"$anchor\" $attrs>$title</$tag>";
		if( $opt->anchor_type == 'a' )
			$new_el = '<a class="kc-anchor kc__anchor" name="'. $anchor .'"></a>'."\n<$tag $attrs>$title</$tag>";

		return $to_menu . $new_el;
	}

	## Транслитерация УРЛ
	private function __sanitaze_anchor( $str ){
		$str = strip_tags( $str );

		$iso9 = array(
			'А'=>'A', 'Б'=>'B', 'В'=>'V', 'Г'=>'G', 'Д'=>'D', 'Е'=>'E', 'Ё'=>'YO', 'Ж'=>'ZH',
			'З'=>'Z', 'И'=>'I', 'Й'=>'J', 'К'=>'K', 'Л'=>'L', 'М'=>'M', 'Н'=>'N', 'О'=>'O',
			'П'=>'P', 'Р'=>'R', 'С'=>'S', 'Т'=>'T', 'У'=>'U', 'Ф'=>'F', 'Х'=>'H', 'Ц'=>'TS',
			'Ч'=>'CH', 'Ш'=>'SH', 'Щ'=>'SHH', 'Ъ'=>'', 'Ы'=>'Y', 'Ь'=>'', 'Э'=>'E', 'Ю'=>'YU', 'Я'=>'YA',
			// small
			'а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e', 'ё'=>'yo', 'ж'=>'zh',
			'з'=>'z', 'и'=>'i', 'й'=>'j', 'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n', 'о'=>'o',
			'п'=>'p', 'р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f', 'х'=>'h', 'ц'=>'ts',
			'ч'=>'ch', 'ш'=>'sh', 'щ'=>'shh', 'ъ'=>'', 'ы'=>'y', 'ь'=>'', 'э'=>'e', 'ю'=>'yu', 'я'=>'ya',
			// other
			'Ѓ'=>'G', 'Ґ'=>'G', 'Є'=>'YE', 'Ѕ'=>'Z', 'Ј'=>'J', 'І'=>'I', 'Ї'=>'YI', 'Ќ'=>'K', 'Љ'=>'L', 'Њ'=>'N', 'Ў'=>'U', 'Џ'=>'DH',          
			'ѓ'=>'g', 'ґ'=>'g', 'є'=>'ye', 'ѕ'=>'z', 'ј'=>'j', 'і'=>'i', 'ї'=>'yi', 'ќ'=>'k', 'љ'=>'l', 'њ'=>'n', 'ў'=>'u', 'џ'=>'dh'
		);

		$str = strtr( $str, $iso9 );

		$spec = preg_quote( $this->opt->spec );
		$str  = preg_replace("/[^a-zA-Z0-9\-_$spec]+/", '-', $str ); // все ненужное на '-'
		$str  = preg_replace('/^-+|-+$/', '', $str ); // кил конечные ---

		return strtolower( $str );
	}

	## Вырезает шоткод из контента
	function strip_shortcode( $text ){
		return preg_replace('~\['. $this->opt->shortcode .'[^\]]*\]~', '', $text );
	}
}
?>