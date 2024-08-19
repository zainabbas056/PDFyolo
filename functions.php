<?php
/**
 * PDFyolo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PDFyolo
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.2' );
}

if ( ! function_exists( 'PDFyolo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function PDFyolo_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on PDFyolo, use a find and replace
		 * to change 'PDFyolo' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'PDFyolo', get_template_directory() . '/languages' );
		// remove image sizes
		function rlni_remove_plugin_image_sizes() {
				remove_image_size( '2048x2048' );
		}
		//add_action('init', 'rlni_remove_plugin_image_sizes');

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'post-thumbnails' );
		//add_image_size( 'magBlogpost', 312, 366, true);
		// add_image_size( 'image-size2', 600, 400);
		// add_image_size( 'image-size3', 1188, 792 );
		// add_image_size( 'image-size4', 1425, 950);

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
		register_nav_menus(
			array(
				'header_main_navigation' => esc_html__('Header Main Navigation', 'PDFyolo'),
				'footer_quick_links' => esc_html__('Footer Quick Links', 'PDFyolo'),
				'footer_second_menu' => esc_html__('Footer Seconed Menu', 'PDFyolo'),
			)
		);

		//add_image_size( 'blog-list', 230, 312,true );

		//add_image_size( 'product-list', 300, 257 ,true );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		if ( class_exists( 'WooCommerce' ) ) {
				add_theme_support( 'woocommerce' );
				add_theme_support( 'wc-product-gallery-zoom' );
				add_theme_support( 'wc-product-gallery-lightbox' );
				add_theme_support( 'wc-product-gallery-slider' );
		}
	}
endif;
add_action( 'after_setup_theme', 'PDFyolo_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function PDFyolo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'PDFyolo_content_width', 640 );
}
add_action( 'after_setup_theme', 'PDFyolo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */


/**
 * Enqueue scripts and styles.
 */
function PDFyolo_scripts() {
	
	wp_enqueue_style( 'PDFyolo-style', get_stylesheet_uri() );
	wp_enqueue_style( 'PDFyolo-Bootstrap-styles', get_template_directory_uri().'/css/bootstrap.css', array(), _S_VERSION );
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'PDFyolo-jquery',get_template_directory_uri() . '/js/jquery-3.5.1.min.js', array(), false, true );
	wp_enqueue_script( 'PDFyolo-popperjs',get_template_directory_uri() . '/js/popper.min.js', array(), false, true );
	wp_enqueue_script( 'PDFyolo-customjs', get_template_directory_uri() . '/js/jqueryCustom.js', array(), false, true );
	wp_enqueue_script( 'PDFyolo-bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(), false, true );
	wp_enqueue_script( 'PDFyolo-kit','https://kit.fontawesome.com/391f644c42.js', array(), false, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'PDFyolo_scripts', 10 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


require get_template_directory() . '/inc/breadcrumb.php';

/**
 * Load Jetpack compatibility file.
 */

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

//Widgets
//require get_template_directory() . '/inc/widgets/class-pages-list.php';

//vc_add_shortcode_param( 'dropdown_multi', 'dropdown_multi_settings_field' );
function dropdown_multi_settings_field( $param, $value ) {
	$param_line = '';
	$param_line .= '<select multiple name="'. esc_attr( $param['param_name'] ).'" class="wpb_vc_param_value wpb-input wpb-select '. esc_attr( $param['param_name'] ).' '. esc_attr($param['type']).'">';

	foreach($param['value'] as $text_val => $val ) {

		if(is_numeric($text_val) && (is_string($val) || is_numeric($val))){
			$text_val = $val;
		}

		$text_val = __($text_val, "js_composer");
		$selected = '';

		if(!is_array($value)) {
			$param_value_arr = explode(',',$value);

		} else {
			$param_value_arr = $value;
		}

		if($value!=='' && in_array($val, $param_value_arr)){
			$selected = ' selected="selected"';
		}

		$param_line .= '<option class="'.$val.'" value="'.$val.'"'.$selected.'>'.$text_val.'</option>';
	}

	$param_line .= '</select>';

	return  $param_line;
}

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    if (in_array('current-menu-item', $classes) ){
	    $classes[] = 'active ';
	  }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);


add_filter('pre_get_posts','lw_search_filter_pages');
function lw_search_filter_pages($query) {
    // Frontend search only
    if ( ! is_admin() && $query->is_archive() && $query->is_main_query() ) {
		$query->set('paged', ( get_query_var('paged') ) ? get_query_var('paged') : 1 );
		$query->set('posts_per_page',30);
    }
    if ( ! is_admin() && $query->is_search() ) {
        $query->set('post_type', 'product');
        $query->set( 'wc_query', 'product_query' );
    }
    return $query;
}


function setPostViews($postID) {
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '0');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}

add_filter( 'comment_form_default_fields', 'tu_comment_form_hide_cookies_consent' );
function tu_comment_form_hide_cookies_consent( $fields ) {
	unset( $fields['cookies'] );
	return $fields;
}

