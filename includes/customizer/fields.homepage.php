<?php

//Define section
$wp_customize->add_section( 'blesk_homepage' , array(
	'title'       => __( 'Home page', 'blesk' ),
));

//Logo field

$wp_customize->add_setting( 'blesk_featured_count', array('sanitize_callback' => 'absint', 'default' => absint(get_option('posts_per_page'))));			
$wp_customize->add_control( 'blesk_featured_count', array(
	'label'    => __( 'Featured posts count', 'blesk' ),	
	'description'    => __( 'The default number is the post number added in Settings > Reading', 'blesk' ),	
	'section'  => 'blesk_homepage',	
	'settings' => 'blesk_featured_count',
));

$wp_customize->add_setting( 'blesk_gome_central_ad', array('sanitize_callback' => 'sanitize_text_field', 'transport' =>'postMessage'));			
$wp_customize->add_control( 'blesk_gome_central_ad', array(
	'label'    => __( 'Home Central Ad', 'blesk' ),
	'description'    => __( 'Please use a banner with size 728x90px', 'blesk' ),
	'type' 	   => 'textarea',	
	'section'  => 'blesk_homepage',	
	'settings' => 'blesk_gome_central_ad',
));

$wp_customize->add_setting( 'blesk_home_post_count', array('sanitize_callback' => 'absint', 'default' => absint(get_option('posts_per_page'))));			
$wp_customize->add_control( 'blesk_home_post_count', array(
	'label'    => __( 'Home posts count', 'blesk' ),	
	'description'    => __( 'The default number is the post number added in Settings > Reading', 'blesk' ),	
	'section'  => 'blesk_homepage',	
	'settings' => 'blesk_home_post_count',
));