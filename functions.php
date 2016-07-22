<?php
/**
 * life-haker functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package life-haker
 */

if ( ! function_exists( 'life_haker_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function life_haker_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on life-haker, use a find and replace
	 * to change 'life-haker' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'life-haker', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'life-haker' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'life_haker_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // life_haker_setup
add_action( 'after_setup_theme', 'life_haker_setup' );


/** Удаляем заголовок статьи из хлебных крошек SEO BY Yoast
  
*/
function adjust_single_breadcrumb( $link_output) {
	if(strpos( $link_output, 'breadcrumb_last' ) !== false ) {
		$link_output = '';
	}
   	return $link_output;
}
add_filter('wpseo_breadcrumb_single_link', 'adjust_single_breadcrumb' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function life_haker_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'life_haker_content_width', 640 );
}
add_action( 'after_setup_theme', 'life_haker_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function life_haker_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'life-haker' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Uder-Post', 'life-haker' ),
		'id'            => 'underpost-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Upper-Post', 'life-haker' ),
		'id'            => 'upperpost-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'life_haker_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function life_haker_scripts() {
	wp_enqueue_style( 'life-haker-style', get_stylesheet_uri() );

	wp_enqueue_script( 'life-haker-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'life-haker-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'life_haker_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
 
 //отключение Emoji start
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
//отключение Emoji end
/**
 * Remove the slug from published post permalinks. 
 * Only affect our CPT though.
 */
/*function vipx_remove_cpt_slug( $post_link, $post, $leavename ) {
 
    if ( ! in_array( $post->post_type, array( 'internet-zarabotok' ) ) 
        || 'publish' != $post->post_status )
        return $post_link;
 
    $post_link = str_replace( 
        '/' . $post->post_type . '/', '/', $post_link 
    );
 
    return $post_link;
}
add_filter( 'post_type_link', 'vipx_remove_cpt_slug', 10, 3 );


function vipx_parse_request_tricksy( $query ) {
 
    // Only noop the main query
    if ( ! $query->is_main_query() )
        return;
 
    // Only noop our very specific rewrite rule match
    if ( 2 != count( $query->query )
        || ! isset( $query->query[ 'page' ] ) )
        return;
 
    // 'name' will be set if post permalinks are just post_name, 
    // otherwise the page rule will match
    if ( ! empty( $query->query[ 'name' ] ) )
        $query->set( 'post_type', array( 'post', 'internet-zarabotok', 'page' ) );
}

add_action( 'pre_get_posts', 'vipx_parse_request_tricksy' );
*/

/*
function na_remove_slug( $post_link, $post, $leavename ) {

    if ( 'internet-zarabotok' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }

    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

    return $post_link;
}
add_filter( 'post_type_link', 'na_remove_slug', 10, 3 );

function na_parse_request( $query ) {

    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }

    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'internet-zarabotok', 'page' ) );
    }
}
add_action( 'pre_get_posts', 'na_parse_request' );
*/

function disable_tags()
{
    ?>
    <script type='text/javascript'>
        jQuery(document).ready(function() {
            jQuery('#new-tag-post_tag').attr("disabled", "disabled").css("display", "none");
            jQuery('.tagadd').attr("disabled", "disabled").css("display", "none");
            jQuery('#post_tag').css("display", "none");
        });
    </script>
    <?php
}
add_action('admin_head', 'disable_tags');

 
//customize the PageNavi HTML before it is output
function ik_pagination($html) {
	$out = '';
 
	//wrap a's and span's in li's
	$out = str_replace("<a","<span title='Перейдите на страницу, пожалуйста'",$html);
	$out = str_replace("href=","rel=",$out);
	$out = str_replace("larger","larger seolink",$out);
	$out = str_replace("smaller","smaller seolink",$out);
	$out = str_replace("</a>","</span>",$out);
	//$out = str_replace("<span","<li><span",$out);	
	//$out = str_replace("</span>","</span></li>",$out);
 
	return '<div class="paging">
			<ul>'.$out.'</ul>
		</div>';
}
//attach our function to the wp_pagenavi filter
add_filter('wp_pagenavi', 'ik_pagination',10,2);

function sidebar_pagination($html) {
	$out = '';
 
	//wrap a's and span's in li's
	$out = str_replace("<a","<span class='seolink' title='Рубрика сайта'",$html);
	$out = str_replace("href=","rel=",$out);
	$out = str_replace("</a>","</span>",$out);
	//$out = str_replace("<span","<li><span",$out);
	//$out = str_replace("</span>","</span></li>",$out);
 
	return '<div class="paging">
			<ul>'.$out.'</ul>
		</div>';
}
//attach our function to the wp_pagenavi filter
add_filter('wp_list_categories', 'sidebar_pagination',10,2);
add_filter('wp_tag_cloud', 'sidebar_pagination',10,2);

function removeTitle($str){
	$str = preg_replace('#title="[^"]+"#', '', $str);
	return $str;
}
add_filter("wp_list_categories", "removeTitle");

require get_template_directory() . '/inc/jetpack.php';
function disablePostCommentsFeedLink($for_comments) {
	return;
}
add_filter('post_comments_feed_link','disablePostCommentsFeedLink');
remove_action('wp_head', 'feed_links_extra',3);
remove_action('wp_head', 'feed_links',2);
remove_action('wp_head', 'rsd_link');
add_action('wp_head', 'my_feed_links');

add_action('pre_get_posts', 'parse_request');

//-------------------ShortCodes---------------------
include(WP_CONTENT_DIR . '/themes/life-haker/shortcodes.php');
add_shortcode('contents', 'contents');
add_shortcode('box_lamp', 'box_lamp');
add_shortcode('box_hand', 'box_hand');
add_shortcode('box_help', 'box_help');
add_shortcode('box_free_book', 'box_free_book');
add_shortcode('box_shop_book', 'box_shop_book');
add_shortcode('box_handshake', 'box_handshake');
add_shortcode('box_about', 'box_about');
add_shortcode('anchor', 'anchor');
add_shortcode('logo_text_vertical', 'logo_text_vertical');
add_shortcode('citation', 'citation');
add_shortcode('citation', 'citation');
add_shortcode('boxs_advert', 'boxs_advert');
add_shortcode('new_line', 'new_line');
//add_shortcode('lamp', 'lamp');
add_shortcode('hand', 'hand');
add_shortcode('help', 'help');
add_shortcode('handshake', 'handshake');
//add_shortcode('about', 'about');
add_shortcode('adsense', 'adsense');
add_shortcode('smm_buttons', 'smm_buttons');

//--------NEW SHORTCODES
add_shortcode('tip', 'tip');
add_shortcode('lamp', 'tip');
add_shortcode('todo', 'todo');
add_shortcode('info', 'info');
add_shortcode('about', 'info');
add_shortcode('warning', 'warning');
add_shortcode('ask', 'ask');
add_shortcode('download', 'download');
add_shortcode('important', 'important');
add_shortcode('recommend', 'recommend');
add_shortcode('recommend_link', 'recommend_link');

// *********************************************************
// замена внешних ссылок на <span class="seolink" rel=href>
// страница на которой трениовался
// view-source:http://lifeha.ru/youtube/skolko-zarabatyvaet-kanal-na-youtube.html
// *********************************************************
function remove_extenal_links($content) {
    
    // находим все ссылки которые не ведут на текущих домен
    // !!! + TODO
    //  скрываем все ссылки на сокращатель lifeha.ru/go/.. - ннужно разобраться с регуляркой
    // неработающий пример: |lifeha.ru\/go\/.*?
    // проблема если в тексте ссылки тег <br/>
    // СМ строка 300: view-source:http://lifeha.ru/youtube/skolko-zarabatyvaet-kanal-na-youtube.html
    
    $host = strtr($_SERVER['HTTP_HOST'], array('.' => '\.'));
    
    // старая регулярка
    //                $1                $2               $3         $4      $5        $6    $7 
    //$pattern = '/<a (.*?)href=[\"\']([a-z0-9]+)\:\/\/(?!'.$host.')(.*?)\/?(.*?)[\"\'](.*?)>(.*?)<\/a>/i';
    //$replace = "$1<span class='seolink_target' rel=\"http://$4\">$6</span>$7";
    //$content = preg_replace($pattern, $replace, $content);
    
    // TODO
    // Известные проблемы: 
    // !!! не заменяет ссылку если href в одинарных кавычках
    // пример - 192 view-source:http://lifeha.ru/vkontakte/kak-zarabotat-vkontakte-na-prodazhe-grupp-i-soobshhestv.html
    // !!! не заменяет ссылки внутри плагина видеогалереи (не понял когда он отрабатывает))
    
    // правильное выражение которое лихо заменяет все внешние ссылк    
    //$pattern = '/<a(.*?)href=[\"\'](http|https)\:\/\/(?!'.$host.')([^\"\']+)[\"\']([^>]*?)>(.*?|[^a]*?)<\/a>/i';
    
    $pattern = "/<a(.*?)href=[\"'](http|https)\:\/\/(?!".$host.")([^\"']+)[\"']([^>]*?)>(.*?|[^a]*?)<\/a>/i";
    $replace = "<span class='seolink_target' rel=\"http://$3\"$1$4>$5</span>";    
    $content = preg_replace($pattern, $replace, $content);
    
    // скрываем все ссылки lifeha.ru/go вторым проходом
    $pattern = '/<a(.*?)href=[\"\'](http|https)\:\/\/(lifeha\.ru\/go\/)([^\"\']+)[\"\']([^>]*?)>(.*?|[^a]*?)<\/a>/i';
    $replace = "<span class=\"seolink_target\" rel=\"http://$3$4\"$1$5>$6</span>";    
    $content = preg_replace($pattern, $replace, $content);
	
	
	// скрываем все ссылки youtube.com/embed третим проходом
    $pattern = '/<a(.*?)href=[\"\'](http|https)\:\/\/(wwww.youtube\.com\/embed\/)([^\"\']+)[\"\']([^>]*?)>(.*?|[^a]*?)<\/a>/i';
    $replace = "<span class=\"seolink_target\" rel=\"http://$3$4\"$1$5>$6</span>";    
    $content = preg_replace($pattern, $replace, $content);
    
    return $content;
}

// важно поставил приоритет - после того как отработают все с приоритетами 10(по умолчанию)
add_filter ('the_content', 'remove_extenal_links',11);
add_filter ('the_excerpt', 'remove_extenal_links',11);
add_filter ('get_comment_author_link', 'remove_extenal_links',11);


//add_filter('posts_request', 'remove_extenal_links',11);
