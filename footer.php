		<?php

		/**
		 * Get values
		 */
		//Customizer values
		$logo = get_theme_mod('blesk_logo', get_stylesheet_directory_uri().'/assets/img/logo.png');

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

		//Menus
		$left_footer_menu = 'footer_menu_left';
		$right_footer_menu = 'footer_menu_right';

		?>
		<footer>
			<?php

				//If there are no logos, social icons or menus hide these empty divs
				if($logo or $social_links or has_nav_menu($left_footer_menu) or has_nav_menu($right_footer_menu)):

			?>
			<div class="top-footer">
				<div class="wrapper cf">
					<?php

					

					//Display the footer left menu
					if(has_nav_menu($left_footer_menu)) {

						//Get menu title
						$left_menu_title = blesk_get_menu_name($left_footer_menu);

						//Build box position depending on menus
						$left_style = '';

						if(!has_nav_menu($right_footer_menu) and $logo) {
							$left_style = ' style="margin-top: 0; text-align: left;"';
						}

						if(!has_nav_menu($right_footer_menu) and !$logo) {
							$left_style = ' style="float: none; margin: 0 auto;"';
						}

						echo '<div class="widget"'.$left_style.'>';

							if($left_menu_title) {
								echo '<h3 class="title">'.esc_html($left_menu_title).'</h3><!-- /.title -->';
							}
							
							wp_nav_menu( array('theme_location' => $left_footer_menu, 'container' => '', 'depth' => 1 ) );

						echo '</div><!-- /.widget -->';
					}

					//Display the footer right menu
					if(has_nav_menu($right_footer_menu)) {

						//Get menu title
						$left_menu_title = blesk_get_menu_name($right_footer_menu);

						//Build box position depending on menus
						$right_style = '';

						if(!has_nav_menu($left_footer_menu) and $logo) {
							$right_style = ' style="margin-top: 0; text-align: right;"';
						}

						if(!has_nav_menu($left_footer_menu) and !$logo) {
							$right_style = ' style="float: none; margin: 0 auto;"';
						}

						echo '<div class="widget"'.$right_style.'>';

							if($left_menu_title) {
								echo '<h3 class="title">'.esc_html($left_menu_title).'</h3><!-- /.title -->';
							}
							
							wp_nav_menu( array('theme_location' => $right_footer_menu, 'container' => '', 'depth' => 1 ) );

						echo '</div><!-- /.widget -->';
					}

					//Display footer center logo and content
					if($logo or $social_links) {

						//Build box position depending on menus
						$center_box_position = '';
						if(!has_nav_menu($right_footer_menu)) {
							$center_box_position = ' style="float: right; border: none; padding-right: 0; text-align: right;"';
						}

						if(!has_nav_menu($left_footer_menu)) {
							$center_box_position = ' style="float: left; border: none; padding-left: 0; text-align: left;"';
						}

						if(!has_nav_menu($left_footer_menu) and !has_nav_menu($right_footer_menu)) {
							$center_box_position = ' style="float: none; border: none; padding: 0; margin: 0 auto;"';
						}

						echo '<div class="center"'.$center_box_position.'>';

							//Display logo
							echo '<a href="'.esc_url(home_url('/')).'" class="logo" title="'.get_bloginfo('name').'" alt="'.get_bloginfo('description').'">';

							if($logo) {
								echo '<img src="'.esc_url($logo).'" alt="logo" />';
							} else {
								echo '<h1>'.get_bloginfo('name').'</h1><h2>'.get_bloginfo('description').'</h2>';
							}

							echo '</a>';

							//Display description
							if(get_bloginfo('description')) {
								echo '<p>'.wp_kses_post(get_bloginfo('description')).'</p>';
							}

							//Display social icons
							if($social_links) {
							echo '<ul class="social">';

								if($link_facebook)
									echo '<li><a href="'.esc_url($link_facebook).'" title="'.get_bloginfo('name'). ' ' . __('on Facebook', 'blesk').'" class="fa fa-facebook"></a></li>';

								if($link_twitter)
									echo '<li><a href="'.esc_url($link_twitter).'" title="'.get_bloginfo('name'). ' ' . __('on Twitter', 'blesk').'" class="fa fa-twitter"></a></li>';

								if($link_youtube)
									echo '<li><a href="'.esc_url($link_youtube).'" title="'.get_bloginfo('name'). ' ' . __('on YouTube', 'blesk').'" class="fa fa-youtube-play"></a></li>';

								if($link_tumblr)
									echo '<li><a href="'.esc_url($link_tumblr).'" title="'.get_bloginfo('name'). ' ' . __('on Tumblr', 'blesk').'" class="fa fa-tumblr"></a></li>';

								if($link_pinterest)
									echo '<li><a href="'.esc_url($link_pinterest).'" title="'.get_bloginfo('name'). ' ' . __('on Pinterest', 'blesk').'" class="fa fa-pinterest-p"></a></li>';

								if($link_dribbble)
									echo '<li><a href="'.esc_url($link_dribbble).'" title="'.get_bloginfo('name'). ' ' . __('on Dribbble', 'blesk').'" class="fa fa-dribbble"></a></li>';

							echo '</ul><!-- /.social -->';
						}

						echo '</div><!-- /.center -->';
					}

					?>
				</div><!-- /.wrapper -->
			</div><!-- /.top-footer -->
			<?php endif; ?>

			<div class="bottom-footer">
				<div class="wrapper cf">
					<span class="copyright">
						<?php _e('Copyright', 'blesk'); ?> &#169; <?php echo date('Y'); ?>, <?php bloginfo('name'); ?>. <?php _e('All Rights Reserved', 'blesk'); ?>.</span>
				</div><!-- /.wrapper -->
			</div><!-- /.bottom-footer -->
		</footer>
	</div><!-- /.overflow-h -->
	<?php wp_footer(); ?>
</body>
</html>