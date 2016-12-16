<?php
/**
 * Actions required
 */
?>

<div id="actions_required" class="blesk-tab-pane">

    <h1><?php esc_html_e( 'Actions recommend to make this theme look like in the demo.' ,'blesk' ); ?></h1>

    <!-- NEWS -->
    <hr />

	<?php
	global $blesk_required_actions;

	if( !empty($blesk_required_actions) ):

		/* blesk_show_required_actions is an array of true/false for each required action that was dismissed */
		$blesk_show_required_actions = get_option("blesk_show_required_actions");
		$action_number = 1;
		foreach( $blesk_required_actions as $blesk_required_action_key => $blesk_required_action_value ):
			if(@$blesk_show_required_actions[$blesk_required_action_value['id']] === false) continue;
			if(@$blesk_required_action_value['check']) continue;
			?>
			<div class="blesk-action-required-box">
				<span class="dashicons dashicons-no-alt blesk-dismiss-required-action" id="<?php echo $blesk_required_action_value['id']; ?>"></span>
				<h4><?php echo $action_number; ?>. <?php if( !empty($blesk_required_action_value['title']) ): echo $blesk_required_action_value['title']; endif; ?></h4>
				<p><?php if( !empty($blesk_required_action_value['description']) ): echo $blesk_required_action_value['description']; endif; ?></p>
				<?php
					if( !empty($blesk_required_action_value['plugin_slug']) ):
						?><p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin='.$blesk_required_action_value['plugin_slug'] ), 'install-plugin_'.$blesk_required_action_value['plugin_slug'] ) ); ?>" class="button button-primary"><?php if( !empty($blesk_required_action_value['title']) ): echo $blesk_required_action_value['title']; endif; ?></a></p><?php
					endif;
				?>

				<hr />
			</div>
			<?php
			$action_number ++;
		endforeach;
	endif;

	$nr_actions_required = 0;

	/* get number of required actions */
	if( get_option('blesk_show_required_actions') ):
		$blesk_show_required_actions = get_option('blesk_show_required_actions');
	else:
		$blesk_show_required_actions = array();
	endif;

	if( !empty($blesk_required_actions) ):
		foreach( $blesk_required_actions as $blesk_required_action_value ):
			if(( !isset( $blesk_required_action_value['check'] ) || ( isset( $blesk_required_action_value['check'] ) && ( $blesk_required_action_value['check'] == false ) ) ) && ((isset($blesk_show_required_actions[$blesk_required_action_value['id']]) && ($blesk_show_required_actions[$blesk_required_action_value['id']] == true)) || !isset($blesk_show_required_actions[$blesk_required_action_value['id']]) )) :
				$nr_actions_required++;
			endif;
		endforeach;
	endif;

	if( $nr_actions_required == 0 ):
		echo '<p>'.__( 'Hooray! There are no required actions for you right now.','blesk' ).'</p>';
	endif;
	?>

</div>
