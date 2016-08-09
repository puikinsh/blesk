<?php

//Define section
$wp_customize->add_section( 'blesk_header' , array(
	'title'       => __( 'Header', 'blesk' ),
));

//Logo field

if(!blesk_check_wp_version('4.5')) {
	$wp_customize->add_setting( 'blesk_logo', array('sanitize_callback' => 'esc_url_raw', 'default' => get_stylesheet_directory_uri().'/assets/img/logo.png', 'transport' =>'postMessage'));			
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'blesk_logo', array(
		'label'    => __( 'Logo', 'blesk' ),	
		'description'    => __( 'For a better experience, recommanded logo size is 276x83px', 'blesk' ),
		'section'  => 'blesk_header',	
		'settings' => 'blesk_logo',
	)));
}

$wp_customize->add_setting( 'blesk_header_ad', array('sanitize_callback' => 'blesk_sanitize_text', 'transport' =>'postMessage'));			
$wp_customize->add_control( 'blesk_header_ad', array(
	'label'    => __( 'Header Ad', 'blesk' ),
	'description'    => __( 'Please use a banner with size 728x90px', 'blesk' ),
	'type' 	   => 'textarea',	
	'section'  => 'blesk_header',	
	'settings' => 'blesk_header_ad',
));