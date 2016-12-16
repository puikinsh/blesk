<?php 
/**
 *	Template name: Home
 *
 *	The template for dispalying the Custom Home Page.
 */

//Get header
get_header(); 

//Display sections in order
$ordered_sections = array(
	get_theme_mod('blesk_sections_order_one', '01featured_posts'),
	get_theme_mod('blesk_sections_order_two', '02wide_banner'),
	get_theme_mod('blesk_sections_order_three', '03content_and_sidebar'),
	get_theme_mod('blesk_sections_order_four', '04bottom_categories')
	);

foreach($ordered_sections as $key => $section) {
	get_template_part( 'parts/homepage/'. $section );
}

//Get footer
get_footer(); ?>