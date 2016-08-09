<?php

//Define section
$wp_customize->add_section( 'blesk_sections_order' , array(
	'title'       => __( 'Sections Order', 'blesk' ),
));


$wp_customize->add_setting( 'blesk_sections_order_one', array('sanitize_callback' => 'blesk_sanitize_text', 'default' => '01featured_posts'));			
$wp_customize->add_control( 'blesk_sections_order_one', array(
	'label'    => __( 'First section', 'blesk' ),
	'description'    => __( 'Please select what you want to display on the first section', 'blesk' ),
	'type' 	   => 'select',	
	'section'  => 'blesk_sections_order',	
	'settings' => 'blesk_sections_order_one',
	'choices' => blesk_home_sections()
));

$wp_customize->add_setting( 'blesk_sections_order_two', array('sanitize_callback' => 'blesk_sanitize_text', 'default' => '02wide_banner'));			
$wp_customize->add_control( 'blesk_sections_order_two', array(
	'label'    => __( 'Seccound section', 'blesk' ),
	'description'    => __( 'Please select what you want to display on the secound section', 'blesk' ),
	'type' 	   => 'select',	
	'section'  => 'blesk_sections_order',	
	'settings' => 'blesk_sections_order_two',
	'choices' => blesk_home_sections()
));

$wp_customize->add_setting( 'blesk_sections_order_three', array('sanitize_callback' => 'blesk_sanitize_text', 'default' => '03content_and_sidebar'));			
$wp_customize->add_control( 'blesk_sections_order_three', array(
	'label'    => __( 'Third section', 'blesk' ),
	'description'    => __( 'Please select what you want to display on the third section', 'blesk' ),
	'type' 	   => 'select',	
	'section'  => 'blesk_sections_order',	
	'settings' => 'blesk_sections_order_three',
	'choices' => blesk_home_sections()
));

$wp_customize->add_setting( 'blesk_sections_order_four', array('sanitize_callback' => 'blesk_sanitize_text', 'default' => '04bottom_categories'));			
$wp_customize->add_control( 'blesk_sections_order_four', array(
	'label'    => __( 'Fourth section', 'blesk' ),
	'description'    => __( 'Please select what you want to display on the fourth section', 'blesk' ),
	'type' 	   => 'select',	
	'section'  => 'blesk_sections_order',	
	'settings' => 'blesk_sections_order_four',
	'choices' => blesk_home_sections()
));