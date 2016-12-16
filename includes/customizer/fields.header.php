<?php

//Define section
$wp_customize->add_section( 'blesk_header' , array(
	'title'       => __( 'Header', 'blesk' ),
));

$wp_customize->add_setting( 'blesk_header_ad', array('sanitize_callback' => 'sanitize_text_field', 'transport' =>'postMessage'));			
$wp_customize->add_control( 'blesk_header_ad', array(
	'label'    => __( 'Header Ad', 'blesk' ),
	'description'    => __( 'Please use a banner with size 728x90px', 'blesk' ),
	'type' 	   => 'textarea',	
	'section'  => 'blesk_header',	
	'settings' => 'blesk_header_ad',
));