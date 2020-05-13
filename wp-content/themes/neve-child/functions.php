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
	}
endif;
add_action( 'wp_enqueue_scripts', 'neve_child_load_css', 20 );

require_once get_stylesheet_directory() . '/inc/custom-post-type.php';
