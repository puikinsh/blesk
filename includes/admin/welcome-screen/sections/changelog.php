<?php
/**
 * Changelog
 */

$blesk = wp_get_theme( 'blesk' );

?>
<div class="blesk-tab-pane" id="changelog">

	<div class="blesk-tab-pane-center">
	
		<h1>Blesk <?php if( !empty($blesk['Version']) ): ?> <sup id="blesk-theme-version"><?php echo esc_attr( $blesk['Version'] ); ?> </sup><?php endif; ?></h1>

	</div>

	<?php
	WP_Filesystem();
	global $wp_filesystem;
	$blesk_changelog = $wp_filesystem->get_contents( get_template_directory().'/CHANGELOG.txt' );
	$blesk_changelog_lines = explode(PHP_EOL, $blesk_changelog);
	foreach($blesk_changelog_lines as $blesk_changelog_line){
		if(substr( $blesk_changelog_line, 0, 3 ) === "###"){
			echo '<hr /><h1>'.substr($blesk_changelog_line,3).'</h1>';
		} else {
			echo $blesk_changelog_line,'<br/>';
		}
	}

	?>
	
</div>