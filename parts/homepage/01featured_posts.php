<?php
// WP_Query arguments
$args = array (
	'posts_per_page'         => get_theme_mod('blesk_featured_count', get_option('posts_per_page')),
	'ignore_sticky_posts'    => true,
	'meta_query'             => array(
		array(
			'key'       => 'blesk_featured_post_checkbox',
			'value'     => 'on',
			'compare'     => '='
		),
	),
	'cache_results'          => true,
	'update_post_meta_cache' => true,
	'update_post_term_cache' => true,
);


// The Query
$featured = new WP_Query( $args );

// The Loop
if ( $featured->have_posts() ) {

	//If there are any post in the query, echo wrapper mark-up
	echo '<div class="featured-articles cf" id="featured-slider">';
	while ( $featured->have_posts() ) {
		$featured->the_post();
		
		//Get featured image
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'home_category' );

		//Get category name
		$category_name = blesk_get_categories_in_loop(get_the_ID());

		echo '<article class="post">
			<a href="'.get_the_permalink().'" class="entry-content" title="'.get_the_title().'" '.(isset($image[0]) ? 'style="background-image:url('.esc_url($image[0]).')" ' : '' ).'>
				<h2 class="entry-title">'.get_the_title().'</h2><!-- /.entry-title -->';

			if($category_name) {
				echo '<div class="entry-meta">
						<i class="fa fa-tags"></i>
						<span>'.esc_html($category_name[0][2]).'</span>
					</div><!-- /.entry-meta -->';
			}
				
		echo '</a><!-- /.entry-content -->
		</article><!-- /.post -->';
	}

	echo '</div><!-- /.featured -->';
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();