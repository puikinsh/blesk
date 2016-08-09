<?php

//Define section
$wp_customize->add_section( 'blesk_colors_settings' , array(
	'title'       => __( 'Colors', 'blesk' ),
));

$wp_customize->add_setting( 'blesk_color_background', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#fff', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_background', array(
	'label'      => __( 'Background Color', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

$wp_customize->add_setting( 'blesk_color_general_text', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#a6a6a6', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_general_text', array(
	'label'      => __( 'Text Color', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

$wp_customize->add_setting( 'blesk_color_general_border', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#e1e1e1', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_general_border', array(
	'label'      => __( 'Borders Color', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

$wp_customize->add_setting( 'blesk_color_topbar_background', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#202020', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_topbar_background', array(
	'label'      => __( 'Top Bar - Background Color', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

$wp_customize->add_setting( 'blesk_color_topbar_links', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#a6a6a6', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_topbar_links', array(
	'label'      => __( 'Top Bar - Links Color', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

$wp_customize->add_setting( 'blesk_color_topbar_links_hover', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#a6a6a6', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_topbar_links_hover', array(
	'label'      => __( 'Top Bar - Links Hover Color', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

$wp_customize->add_setting( 'blesk_color_main_menu', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#dc0844', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_main_menu', array(
	'label'      => __( 'Main Menu - Background Color', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

$wp_customize->add_setting( 'blesk_color_main_menu_drop_down_border', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#dc0844', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_main_menu_drop_down_border', array(
	'label'      => __( 'Main Menu - Drop-down border Color', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

$wp_customize->add_setting( 'blesk_color_main_menu_links', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#fff', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_main_menu_links', array(
	'label'      => __( 'Main Menu - Links Color', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

$wp_customize->add_setting( 'blesk_color_main_menu_links_hover', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#202020', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_main_menu_links_hover', array(
	'label'      => __( 'Main Menu - Links Color Hover', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

$wp_customize->add_setting( 'blesk_color_headings', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#202020', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_headings', array(
	'label'      => __( 'Headings - Color', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

$wp_customize->add_setting( 'blesk_color_pagination_bg', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#f9f9f9', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_pagination_bg', array(
	'label'      => __( 'Pagination/Footer Categories - Background', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

$wp_customize->add_setting( 'blesk_color_pagination_buttons', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#f9f9f9', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_pagination_buttons', array(
	'label'      => __( 'Pagination/Footer Categories - Buttons Background', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

$wp_customize->add_setting( 'blesk_color_pagination_buttons_active', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#f9f9f9', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_pagination_buttons_active', array(
	'label'      => __( 'Pagination/Footer Categories - Buttons Active/Hover Color', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

$wp_customize->add_setting( 'blesk_color_miscellaneous', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#dc0844', 'transport' =>'postMessage' ) );
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'blesk_color_miscellaneous', array(
	'label'      => __( 'Miscellaneous Color', 'blesk' ),
	'section'    => 'blesk_colors_settings',
)));

