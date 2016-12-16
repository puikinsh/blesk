<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<?php

		//Head hook
		wp_head(); 

		//Customizer values
		$header_ad = get_theme_mod('blesk_header_ad');

		$link_facebook = get_theme_mod('blesk_social_link_facebook');
		$link_twitter = get_theme_mod('blesk_social_link_twitter');
		$link_youtube = get_theme_mod('blesk_social_link_youtube');
		$link_tumblr = get_theme_mod('blesk_social_link_tumblr');
		$link_pinterest = get_theme_mod('blesk_social_link_pinterest');
		$link_dribbble = get_theme_mod('blesk_social_link_dribbble');

		//Check if any social link is available
		if($link_facebook or $link_twitter or $link_youtube or $link_tumblr or $link_pinterest or $link_dribbble) {
			$social_links = TRUE;
		} else {
			$social_links = FALSE;
		}

		//Header menus
		$top_menu_location = 'top_menu';
		$main_menu_location = 'header_menu';

	?>
</head>
<body <?php body_class(); ?>>
	<div class="overflow-h">
		<header>
			<?php if(has_nav_menu($top_menu_location) or $social_links): ?>

			<div class="top-header">
				<div class="wrapper cf">
					<?php

						//Display top menu
						if(has_nav_menu($top_menu_location)) {
							echo '<div class="top-links">';
									
								wp_nav_menu( array('theme_location' => $top_menu_location, 'container' => '', 'depth' => 1 ) );

							echo '</div><!-- /.top-links -->';
						}

						//Display social links
						if($social_links) {
							echo '<div class="social"><ul>';

								if($link_facebook)
									echo '<li><a href="'.esc_url($link_facebook).'" title="'.esc_attr(get_bloginfo('name')). ' ' . __('on Facebook', 'blesk').'" class="fa fa-facebook"></a></li>';

								if($link_twitter)
									echo '<li><a href="'.esc_url($link_twitter).'" title="'.esc_attr(get_bloginfo('name')). ' ' . __('on Twitter', 'blesk').'" class="fa fa-twitter"></a></li>';

								if($link_youtube)
									echo '<li><a href="'.esc_url($link_youtube).'" title="'.esc_attr(get_bloginfo('name')). ' ' . __('on YouTube', 'blesk').'" class="fa fa-youtube"></a></li>';

								if($link_tumblr)
									echo '<li><a href="'.esc_url($link_tumblr).'" title="'.esc_attr(get_bloginfo('name')). ' ' . __('on Tumblr', 'blesk').'" class="fa fa-tumblr"></a></li>';

								if($link_pinterest)
									echo '<li><a href="'.esc_url($link_pinterest).'" title="'.esc_attr(get_bloginfo('name')). ' ' . __('on Pinterest', 'blesk').'" class="fa fa-pinterest-p"></a></li>';

								if($link_dribbble)
									echo '<li><a href="'.esc_url($link_dribbble).'" title="'.esc_attr(get_bloginfo('name')). ' ' . __('on Dribbble', 'blesk').'" class="fa fa-dribbble"></a></li>';

							echo '</ul></div><!-- /.social -->';
						}

					?>
					
				</div><!-- /.wrapper -->
			</div><!-- /.top-header -->
			
			<?php endif; ?>

			<div class="center-header">
				<div class="wrapper cf">
					<?php

					//Display logo
					if ( has_custom_logo() ) {
						the_custom_logo();
					}else{
						$format = '<h1><a href="%s">%s</a></h1><h2><a href="%s">%s</a></h2>';
						printf( $format, esc_url(site_url()), get_bloginfo('name'), esc_url(site_url()), esc_attr(get_bloginfo('description')) );
					}

					//Display Header AD
					if($header_ad) {
						echo '<div class="ads-panel">'.wp_kses_post($header_ad).'</div><!-- /.ad-panel -->';
					}

					?>
				
				</div><!-- /.wrapper -->
			</div><!-- /.center-header -->

			<div class="bottom-header">
				<div class="wrapper cf">
					<?php

					//Display main menu
					if(has_nav_menu($main_menu_location)) {
						echo '<div class="open-menu">
								<span class="fa fa-bars open"></span>
								<span class="fa fa-times close"></span>
							</div><!-- /.open-menu -->
							<nav class="menunav">';
								
							wp_nav_menu( array('theme_location' => $main_menu_location, 'container' => '' ) );

						echo '</nav><!-- /.menu -->';
					}
					
					?>
					<?php get_search_form(); ?>
				</div><!-- /.wrapper -->
			</div><!-- /.bottom-header -->
		</header>