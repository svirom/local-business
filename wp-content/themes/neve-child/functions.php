<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! function_exists( 'neve_child_load_css' ) ):
	/**
	 * Load CSS file.
	 */
	function neve_child_load_css() {
		wp_enqueue_style( 'neve-child-style', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'neve-style' ), NEVE_VERSION );
		wp_register_script('custom', get_stylesheet_directory_uri().'/assets/js/custom.js', array('jquery'), false, true);
		wp_enqueue_script('custom');
		//Ajax posts loading on main page
		wp_enqueue_script( 'true_loadmore', get_stylesheet_directory_uri() . '/assets/js/loadmore.js', array('jquery') );
		wp_localize_script( 'true_loadmore', 'PS', array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ), 
		));
		
	}
endif;
add_action( 'wp_enqueue_scripts', 'neve_child_load_css', 20 );

require_once get_stylesheet_directory() . '/inc/custom-post-type.php';
require_once get_stylesheet_directory() . '/inc/loadmore.php';

// contact form 7 google map customization
add_filter('cf7_google_map_settings', 'use_google_map_settings',10,2);
function use_google_map_settings($settings){
  //if( 'your-location' == $field_name ){
    $settings['mapTypeControl']= false; //hide (true by default).
    //$settings['navigationControl']= false; //hide (true by default).
    $settings['streetViewControl']= false; //hide (true by default).
    //$settings['zoomControl']=false; //hide (false by default).
    //$settings['rotateControl']=true; //show (false by default).
    //$settings['fullscreenControl']=true; //show (false by default).
    //$settings['rotateControl']= true; //show (false by default).
    //$settings['zoom']= 12; //set by default to the value initialised at the time of creating the form tag.
    //$settings['center'] = array('11.936825', '79.834278'); //set by default to the value initialised at the time of creating the form tag.

  //}
  return $settings;
}

// implement categories list into contact form 7 select field
add_filter('listo_list_types', 'listo_list_types_func');
function listo_list_types_func($list_types){
	$list_types['categories'] = 'Listo_Categories';
	return $list_types;
}

class Listo_Categories implements Listo {

	public static function items(){
		$categories = get_categories(['hide_empty' => 0]);

		foreach( $categories as $cat ){
			if ($cat->slug !== 'uncategorized') {
				$items [$cat->cat_ID] = $cat->name;
			}
		}

		return $items;
	}

	public static function groups(){}
}

add_action('after_setup_theme', 'true_load_theme_textdomain');
function true_load_theme_textdomain(){
    load_child_theme_textdomain( 'lang', get_stylesheet_directory_uri() . '/languages' );
}

/*add_filter( 'locale', 'true_localize_theme' );
function true_localize_theme( $locale ) {
    if ( isset( $_GET['lang'] ) ) {
        return esc_attr( $_GET['lang'] );
    }
    return $locale;
}*/

// define language of current page
global $curr_lang;
$curr_lang = ICL_LANGUAGE_CODE;

// shortcode for Contact form 7 (string with link to oferta)
function oferta_cf7_func() {
	global $curr_lang;

	if ( $curr_lang == 'uk' ) {
		$oferta = '/oferta';
	} else if ( $curr_lang == 'ru' ) {
		$oferta = '/ru/oferta';
	} else if ( $curr_lang == 'en' ) {
		$oferta = '/en/oferta';
	} else {
		$oferta = '/oferta';
	} 

	$text_conditions = __('Додаючи заклад ви погоджуєтесь з умовами', 'neve-child');
	$text_url = site_url() . $oferta;
	$text_oferta = __('оферти', 'neve-child');

	$html = "<p>$text_conditions <a href='$text_url'>$text_oferta</a></p>";

	return $html;
}
wpcf7_add_shortcode('oferta', 'oferta_cf7_func');
