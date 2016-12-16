<?php
/**
 * Getting started template
 */

$customizer_url = wp_customize_url() ;
?>

<div id="getting_started" class="blesk-tab-pane active">

	<div class="blesk-tab-pane-center">

		<h1 class="blesk-welcome-title"><?php _e('Welcome to Blesk!', 'blesk'); ?> <?php if( !empty($blesk_lite['Version']) ): ?> <sup id="blesk-theme-version"><?php echo esc_attr( $blesk_lite['Version'] ); ?> </sup><?php endif; ?></h1>

		<p><?php esc_html_e( 'Our most popular free one page WordPress theme, Blesk!','blesk'); ?></p>
		<p><?php esc_html_e( 'We want to make sure you have the best experience using Blesk and that is why we gathered here all the necessary information for you. We hope you will enjoy using Blesk, as much as we enjoy creating great products.', 'blesk' ); ?>

	</div>

	<hr />

	<div class="blesk-tab-pane-center">

		<h1><?php esc_html_e( 'Getting started', 'blesk' ); ?></h1>

		<h4><?php esc_html_e( 'Customize everything in a single place.' ,'blesk' ); ?></h4>
		<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'blesk' ); ?></p>
		<p><a href="<?php echo esc_url( $customizer_url ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'blesk' ); ?></a></p>

	</div>

	<hr />

</div>
