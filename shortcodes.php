<?
//function for box attention (red box) - future shotrcode
function contents($atts) {
		extract(shortcode_atts(array(
			   'content_all' => '',
			   'anchor_all' => ''
			), $atts));
		$content_names = explode(",", $content_all);
		$content_anchors = explode(",", $anchor_all);
		$content_print ="<h3>Содержание</h3><ul class='content_items'>";
		for ($i = 0; $i <count ($content_names); $i++) {
			$content_print=$content_print."<li><i class='fa fa-sign-in'></i><a href='#".$content_anchors[$i]."'>".$content_names[$i]."</a></li>";
		}
		$content_print=$content_print."</ul>";
		return $content_print;
}

//function for box_question (~green box) - future shotrcode
function box_lamp($atts) {
		extract(shortcode_atts(array(
			   'text_full' => ''
			), $atts));
		return "
			<div class='idea_box'>
				<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/idea.png' alt='Лайфха - подсказка' title='Лайфха - подсказка'/></div>
				<div class='content_place f_left'>".$text_full."</div>
			</div>
		";
}
//function for box_question (~green box) - future shotrcode
function box_free_book($atts) {
		extract(shortcode_atts(array(
			   'title' => '',
			   'text' => '',
			   'href' => '',
			   'img' => '',
			), $atts));
		return "
			<div class='box_place'>
				<div class='box_img f_left'><a href='".$href."' target='_blank'><img src='".$img."' width='150px' alt='".$title."'/></a></div>
				<div class='box_text1 f_left'>
					<div class='box_text_title'>".$title."</div>
					<div class='box_text_description'>".$text."</div>
					<div class='button_donwload'><a href='".$href."' target='_blank'>Скачать</a></div>
				</div>
			</div>
		";
}
//function for box_question (~green box) - future shotrcode
function box_shop_book($atts) {
		extract(shortcode_atts(array(
			   'title' => '',
			   'text' => '',
			   'href' => '',
			   'img' => '',
			), $atts));
		return "
			<div class='box_place'>
				<div class='box_img f_left'><a href='".$href."' target='_blank'><img src='".$img."' width='250px' alt='".$title."'/></a></div>
				<div class='box_text f_left'>
					<div class='box_text_title'>".$title."</div>
					<div class='box_text_description'>".$text."</div>
					<div class='button_donwload'><a href='".$href."' target='_blank'>Купить</a></div>
				</div>
			</div>
		";
}
//function for box_question (~green box) - future shotrcode
function lamp($atts, $content = null) {
		return "
			<div class='idea_box'>
				<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/idea.png'/></div>
				<div class='content_place f_left'>".$content."</div>
			</div>
		";
}
//function for box_exclamation (~yellow box) - future shotrcode
function hand($atts, $content = null) {
		return "
			<div class='hand_box'>
					<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/hand.png'></div>
					<div class='content_place f_left'>".$content."</div>
				</div>
		";
}
//function for box_close (~gray box) - future shotrcode
function help($atts, $content = null) {
		return "
			<div class='help_box'>
					<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/help.png'></div>
					<div class='content_place f_left'>".$content."</div>
				</div>
		";
}
//function for newspaper - future shotrcode
function handshake($atts, $content = null) {
		return "
				<div class='handshake_box'>
					<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/handshake.png'></div>
					<div class='content_place f_left'>".$content."</div>
				</div>
		";
}
//function for logo_text - future shotrcode
function about($atts, $content = null) {
		return "
				<div class='about_box'>
					<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/about.png'></div>
					<div class='content_place f_left'>".$content."</div>
				</div>
		";
}
//function for box_exclamation (~yellow box) - future shotrcode
function box_hand($atts) {
		extract(shortcode_atts(array(
			   'text_full' => ''
			), $atts));
		return "
			<div class='hand_box'>
					<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/hand.png'></div>
					<div class='content_place f_left'>".$text_full."</div>
				</div>
		";
}
//function for logo_text - future shotrcode
function adsense($atts, $content = null) {
		return "
				<div class='adsense'>
					<script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
					<!-- LifeHa - Single In Post Place (468*60) -->
					<ins class='adsbygoogle'
						 style='display:inline-block;width:468px;height:60px'
						 data-ad-client='ca-pub-4061901667790874'
						 data-ad-slot='6940236742'></ins>
					<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div>
		";
}
//function for box_close (~gray box) - future shotrcode
function box_help($atts) {
		extract(shortcode_atts(array(
			   'text_full' => ''
			), $atts));
		return "
			<div class='help_box'>
					<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/help.png'></div>
					<div class='content_place f_left'>".$text_full."</div>
				</div>
		";
}

//function for newspaper - future shotrcode
function box_handshake($atts) {
		extract(shortcode_atts(array(
			   'text_full' => ''
			), $atts));
		return "
				<div class='handshake_box'>
					<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/handshake.png'></div>
					<div class='content_place f_left'>".$text_full."</div>
				</div>
		";
}


//function for logo_text - future shotrcode
function box_about($atts) {
		extract(shortcode_atts(array(
			   'text_full' => ''
			), $atts));
		return "
				<div class='about_box'>
					<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/about.png'></div>
					<div class='content_place f_left'>".$text_full."</div>
				</div>
		";
}

//function for logo_text - future shotrcode
function anchor($atts) {
		extract(shortcode_atts(array(
			   'name' => ''
			), $atts));
		return "
				<a name='".$name."'></a>
		";
}

//function for logo_text_vertical - future shotrcode
function logo_text_vertical($atts) {
		extract(shortcode_atts(array(
			   'text_full1' => '',
			   'text_full2' => '',
			   'text_full3' => ''

			), $atts));
		return "
				<div class='text'>
					<div class='logo_text_vertical f_left'>
						<div class='place_img_vertical'>
							<img src='/wp-content/themes/prodavec_okon/img/img_content3.png'>
						</div>
						<div class='place_text_vertical'>
							<p>".$text_full1."</p>
						</div>
					</div>
					<div class='logo_text_vertical f_left'>
						<div class='place_img_vertical'>
							<img src='/wp-content/themes/prodavec_okon/img/img_content2.png'>
						</div>
						<div class='place_text_vertical'>
							<p>".$text_full2."</p>
						</div>
					</div>
					<div class='logo_text_vertical f_left'>
						<div class='place_img_vertical'>
							<img src='/wp-content/themes/prodavec_okon/img/img_content1.png'>
						</div>
						<div class='place_text_vertical'>
							<p>".$text_full3."</p>
						</div>
					</div>
				</div>
		";
}

//function for citation - future shotrcode
function citation($atts) {
		extract(shortcode_atts(array(
			   'text_full' => ''
			), $atts));
		return "
				<div class='citation'>
					<div class='citation_left f_left'></div>
					<div class='citation_text f_left'>".$text_full."</div>
					<div class='citation_right f_left'></div>
				</div>
		";
}

// instruction for use this technology https://tech.yandex.ru/share/doc/dg/tasks/how-to-add-button-docpage/
// function for smm likes buttons from Yandex - future shotrcode
function smm_buttons ($atts) {
	 extract(shortcode_atts(array(
	      'smm_url' => '',
	      'smm_title' => '',
	      'smm_image' => '',
	      'smm_desc' => ''

	   ), $atts));

	$smm_class_id = "ya_share_" . rand(1000,9999);
	
	$smm_code =
	"<script type='text/javascript' src='https://yastatic.net/share/share.js' charset='utf-8'></script>
	<script type='text/javascript'>
	new Ya.share({
		theme: 'counter', 
	        element: '" . $smm_class_id . "'";

	if($smm_url !="") $smm_code = $smm_code . ", link: '" . $smm_url . "'";
	if($smm_title !="") $smm_code = $smm_code . ", title: '" . $smm_title . "'";
	if($smm_url_img !="") $smm_code = $smm_code . ", image: '" . $smm_title . "'";
	if($smm_description !="") $smm_code = $smm_code . ", description: '" . $smm_description . "'";

	$smm_code = $smm_code .
	"});
	</script>
	<span id='" . $smm_class_id . "'></span>";

	return $smm_code;
}
// function for book post advert
function boxs_advert ($atts) {
	 extract(shortcode_atts(array(
	      'href' => '',
	      'image' => '',
	      'desc_small' => '',
	      'desc_full' => '',
		  'price' => ''

	   ), $atts));



	$boxs_advert =
	"
		<div class='product_current_place f_left' onclick='window.open('".$href."','_blank');'>
				<div class='product_box_place'>
					<div class='popular_box_img'><img src='".$image."'></div>
					<div class='popular_box_text'>
						<div class='popular_box_text_name1'>".$desc_full."</div>
						<div class='popular_box_text_name2'>".$desc_small."</div>
						<div class='popular_box_text_cost_place'>
							<div class='popular_box_text_cost_place1 f_left'>".$price."</div>
							<div class='popular_box_text_cost_place2 buy_button f_left'><a href='#'>Подробнее</a></div>
						</div>
					</div>
				</div>
			</div>
	";

	return $boxs_advert;
}

// function for create new line
function new_line () {
	return "<div class='clear'></div>";
}


/*-------------ALL NEW SHORTCODES---------------------------*/
//tip
function tip($atts, $content = null) {
		return "
				<div class='prompt_box'>
					<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/idea.png'  alt='Лайфха - подсказка' title='Лайфха - подсказка'></div>
					<div class='content_place f_left'>".$content."</div>
				</div>
		";
}

//todo
function todo($atts, $content = null) {
		return "
				<div class='todo_box'>
					<div class='what_doing_box'>
						<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/what_doing.png'  alt='Лайфха - выполнить' title='Лайфха - выполнить'></div>
						<div class='content_place f_left'>".$content."</div>
					</div>
				</div>
		";
}

//info
function info($atts, $content = null) {
		return "
				<div class='info_box'>
					<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/about.png'  alt='Лайфха - информация' title='Лайфха - информация'></div>
					<div class='content_place f_left'>".$content."</div>
				</div>
		";
}


//warning
function warning($atts, $content = null) {
		return "
				<div class='warning_box'>
					<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/warning.png'  alt='Лайфха - предупреждение' title='Лайфха - предупреждение'></div>
					<div class='content_place f_left'>".$content."</div>
				</div>
		";
}


//ask
function ask($atts, $content = null) {
		return "
				<div class='reference_box'>
					<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/book.png'  alt='Лайфха - вопрос' title='Лайфха - вопрос'></div>
					<div class='content_place f_left'>".$content."</div>
				</div>
		";
}


//download
function download($atts, $content = null) {
		return "
				<div class='donwload_box'>
					<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/donwload.png'  alt='Лайфха - скачать' title='Лайфха - скачать'></div>
					<div class='content_place f_left'>".$content."</div>
				</div>
				
		";
}

//important
function important($atts, $content = null) {
		return "
				<div class='important_box'>
					<div class='img_place f_left'><img src='/wp-content/themes/life-haker/img/hand.png'  alt='Лайфха - важно' title='Лайфха - важно'></div>
					<div class='content_place f_left'>".$content."</div>
				</div>
		";
}

//recommend
function recommend($atts, $content = null) {
		extract(shortcode_atts(array(
	      'href' => '',
	      'title' => 'Рекомендуем посмотреть:',
	      'text' => ''
		),$atts));
	
		return "
				<div class='recommend_box'>
					<div class='content_place f_left' onclick=window.open('".$href."','_blank');>
						<div class='text f_left'>
							<div><a href='".$href."' target='_blank'>".$title."</a></div><div class='name_link'> ".($content==null?$text:$content)."</div>
						</div>
						<div class='img_place f_right'>
							<img src='/wp-content/themes/life-haker/img/arrow_right.png' alt='Лайфха - рекомендации' title='Лайфха - рекомендации'>
						</div>
					</div>
				</div>
		";
}
//recommend
function recommend_link($atts) {
		extract(shortcode_atts(array(
	      'href' => '',
	      'text' => ''
		), $atts));
	
		return "
				<div class='what_doing_header'>Рекомендуем посмотреть:</div>
				<div class='recommend_box'>
					<div class='content_place f_left'>
						<div class='text f_left'>
							<div><a href='".$href."' target='_blank'>".$text."</a></div>
						</div>
						<div class='img_place f_right'>
							<img src='/wp-content/themes/life-haker/img/arrow_right.png' alt='Лайфха - рекомендации' title='Лайфха - рекомендации'>
						</div>
					</div>
				</div>
		";
}
?>