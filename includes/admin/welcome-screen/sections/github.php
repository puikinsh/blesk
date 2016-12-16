<?php
/**
 * Github
 */
?>

<div id="github" class="blesk-tab-pane">

	<h1><?php esc_html_e( 'How can I contribute?', 'blesk' ); ?></h1>

	<hr/>

	<div class="blesk-tab-pane-half blesk-tab-pane-first-half">
		<p><strong><?php esc_html_e( 'Found a bug? Want to contribute with a fix or create a new feature?','blesk'); ?></strong></p>

		<p><?php esc_html_e( 'GitHub is the place to go!','blesk' ); ?></p>

		<p>
			<a href="<?php echo esc_url( 'https://github.com/puikinsh/blesk' ); ?>" class="github-button button button-primary"><?php esc_html_e( 'Blesk on GitHub', 'blesk' ); ?></a>
		</p>
		<hr>
	</div>

	<div class="blesk-tab-pane-half">
		<p><strong><?php esc_html_e( 'Are you a polyglot? Want to translate blesk into your own language?', 'blesk' ); ?></strong></p>

		<p><?php esc_html_e( 'Get involved at WordPress.org.', 'blesk' ); ?></p>

		<p>
			<a href="<?php echo esc_url( 'https://translate.wordpress.org/projects/wp-themes/blesk' ); ?>" class="translate-button button button-primary"><?php _e( 'Translate Blesk', 'blesk' ); ?></a>
		</p>
		<hr>
	</div>

	<div>
		<h4><?php esc_html_e( 'Are you enjoying Blesk?', 'blesk' ); ?></h4>

		<p class="review-link"><?php echo sprintf( esc_html__( 'Rate our theme on %sWordPress.org%s. We\'d really appreciate it!', 'blesk' ), '<a href="https://wordpress.org/themes/blesk/">', '</a>' ); ?></p>

		<p><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></p>
	</div>

</div>
