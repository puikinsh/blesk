<?php

/**
 * Function used to register customizer fields
 *
 * @return void
 */
if(!function_exists('blesk_customize_fields')) {
	function blesk_customize_fields($wp_customize) {
		include 'fields.colors.php';
		include 'fields.sections_order.php';
		include 'fields.header.php';
		include 'fields.social.php';
		include 'fields.homepage.php';
	}
	add_action( 'customize_register', 'blesk_customize_fields', 1000 );
}

/**
 * Function used to enqueue customizer live script
 *
 * @return void
 */
if(!function_exists('blesk_customize_preview_js')) {
	function blesk_customize_preview_js() {
		wp_enqueue_script( 'blesk_customizer_script', get_stylesheet_directory_uri() . '/assets/js/customizer_live.js', array("jquery"),'1.0.0', true  );
	}
	add_action( 'customize_preview_init', 'blesk_customize_preview_js' );
}