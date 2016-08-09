<div class="main-content">
	<div class="wrapper cf">
		
	<?php

		$content_portion = '';

		// WP_Query arguments
		$args = array (
			'posts_per_page'         => get_theme_mod('blesk_home_post_count', get_option('posts_per_page')),
			'ignore_sticky_posts'    => true,
			'cache_results'          => true,
			'update_post_meta_cache' => true,
			'update_post_term_cache' => true,
		);


		// The Query
		$featured = new WP_Query( $args );

		if(!$featured->have_posts() or !is_active_sidebar('home_page_sidebar')) {
			$content_portion = ' style="width: 100%; float: none; padding-left: 0;"';
		}

		// The Loop
		if ( $featured->have_posts() ) {

			echo '<div class="posts"'.$content_portion.'>';

			while ( $featured->have_posts() ) {
				$featured->the_post();
				
				get_template_part( 'parts/content' );
			}

			echo '</div><!-- /.posts -->';

		} else {
			get_template_part( 'parts/content-none' );
		}

		// Restore original Post Data
		wp_reset_postdata();


		if(is_active_sidebar('home_page_sidebar')) {
			echo '<aside class="sidebar"'.$content_portion.'>';
				dynamic_sidebar('home_page_sidebar');
			echo '</aside><!-- /.sidebar -->';
		}
	?>
		
	</div><!-- /.wrapper -->
</div><!-- /.main-content -->