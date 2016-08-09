<?php

//Define section
$wp_customize->add_section( 'blesk_social_links' , array(
	'title'       => __( 'Social Media Links', 'blesk' ),
));

//Facebook URL field
$wp_customize->add_setting( 'blesk_social_link_facebook', array('sanitize_callback' => 'esc_url_raw', 'transport' =>'postMessage'));			
$wp_customize->add_control( 'blesk_social_link_facebook', array(
	'label'    => __( 'Facebook URL', 'blesk' ),
	'type' 	   => 'text',	
	'section'  => 'blesk_social_links',	
	'settings' => 'blesk_social_link_facebook',
));

//Twitter URL field
$wp_customize->add_setting( 'blesk_social_link_twitter', array('sanitize_callback' => 'esc_url_raw', 'transport' =>'postMessage'));			
$wp_customize->add_control( 'blesk_social_link_twitter', array(
	'label'    => __( 'Twitter URL', 'blesk' ),
	'type' 	   => 'text',	
	'section'  => 'blesk_social_links',	
	'settings' => 'blesk_social_link_twitter',
));

//YouTube Channel URL field
$wp_customize->add_setting( 'blesk_social_link_youtube', array('sanitize_callback' => 'esc_url_raw', 'transport' =>'postMessage'));			
$wp_customize->add_control( 'blesk_social_link_youtube', array(
	'label'    => __( 'YouTube Channel URL', 'blesk' ),
	'type' 	   => 'text',	
	'section'  => 'blesk_social_links',	
	'settings' => 'blesk_social_link_youtube',
));

//Tumblr URL field
$wp_customize->add_setting( 'blesk_social_link_tumblr', array('sanitize_callback' => 'esc_url_raw', 'transport' =>'postMessage'));			
$wp_customize->add_control( 'blesk_social_link_tumblr', array(
	'label'    => __( 'Tumblr URL', 'blesk' ),
	'type' 	   => 'text',	
	'section'  => 'blesk_social_links',	
	'settings' => 'blesk_social_link_tumblr',
));

//Pinterest URL field
$wp_customize->add_setting( 'blesk_social_link_pinterest', array('sanitize_callback' => 'esc_url_raw', 'transport' =>'postMessage'));			
$wp_customize->add_control( 'blesk_social_link_pinterest', array(
	'label'    => __( 'Pinterest URL', 'blesk' ),
	'type' 	   => 'text',	
	'section'  => 'blesk_social_links',	
	'settings' => 'blesk_social_link_pinterest',
));

//Dribbble URL field
$wp_customize->add_setting( 'blesk_social_link_dribbble', array('sanitize_callback' => 'esc_url_raw', 'transport' =>'postMessage'));			
$wp_customize->add_control( 'blesk_social_link_dribbble', array(
	'label'    => __( 'Dribbble URL', 'blesk' ),
	'type' 	   => 'text',	
	'section'  => 'blesk_social_links',	
	'settings' => 'blesk_social_link_dribbble',
));