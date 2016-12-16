<?php
/**
 * Welcome Screen Class
 */
class blesk_Welcome {

	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {

		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'blesk_welcome_register_menu' ) );

		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'blesk_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'blesk_welcome_style_and_scripts' ) );

		/* enqueue script for customizer */
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'blesk_welcome_scripts_for_customizer' ) );

		/* load welcome screen */
		add_action( 'blesk_welcome', array( $this, 'blesk_welcome_getting_started' ), 	    10 );
		add_action( 'blesk_welcome', array( $this, 'blesk_welcome_actions_required' ),        20 );
		add_action( 'blesk_welcome', array( $this, 'blesk_welcome_github' ), 		            40 );
		add_action( 'blesk_welcome', array( $this, 'blesk_welcome_changelog' ), 				50 );

		/* ajax callback for dismissable required actions */
		add_action( 'wp_ajax_blesk_lite_dismiss_required_action', array( $this, 'blesk_dismiss_required_action_callback') );

	}

	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 * @since 1.8.2.4
	 */
	public function blesk_welcome_register_menu() {
		add_theme_page( __('About Blesk', 'blesk'), __('About Blesk','blesk'), 'activate_plugins', 'blesk-welcome', array( $this, 'blesk_welcome_screen' ) );
	}

	/**
	 * Adds an admin notice upon successful activation.
	 * @since 1.8.2.4
	 */
	public function blesk_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'blesk_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 * @since 1.8.2.4
	 */
	public function blesk_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing Blesk! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'blesk' ), '<a href="' . esc_url( admin_url( 'themes.php?page=blesk-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=blesk-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with Blesk', 'blesk' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Load welcome screen css and javascript
	 * @since  1.8.2.4
	 */
	public function blesk_welcome_style_and_scripts( $hook_suffix ) {

		if ( 'appearance_page_blesk-welcome' == $hook_suffix ) {
			wp_enqueue_style( 'blesk-welcome-screen-css', get_template_directory_uri() . '/includes/admin/welcome-screen/css/welcome.css' );
			wp_enqueue_script( 'blesk-welcome-screen-js', get_template_directory_uri() . '/includes/admin/welcome-screen/js/welcome.js', array('jquery') );

			global $blesk_required_actions;

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

			wp_localize_script( 'blesk-welcome-screen-js', 'bleskLiteWelcomeScreenObject', array(
				'nr_actions_required' => $nr_actions_required,
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.','blesk' )
			) );
		}
	}

	/**
	 * Load scripts for customizer page
	 * @since  1.8.2.4
	 */
	public function blesk_welcome_scripts_for_customizer() {

		wp_enqueue_style( 'blesk-welcome-screen-customizer-css', get_template_directory_uri() . '/includes/admin/welcome-screen/css/welcome_customizer.css' );
		wp_enqueue_script( 'blesk-welcome-screen-customizer-js', get_template_directory_uri() . '/includes/admin/welcome-screen/js/welcome_customizer.js', array('jquery'), '20120206', true );

		global $blesk_required_actions;

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

		wp_localize_script( 'blesk-welcome-screen-customizer-js', 'bleskLiteWelcomeScreenCustomizerObject', array(
			'nr_actions_required' => $nr_actions_required,
			'aboutpage' => esc_url( admin_url( 'themes.php?page=blesk-welcome#actions_required' ) ),
			'customizerpage' => esc_url( admin_url( 'customize.php#actions_required' ) ),
			'themeinfo' => __('View Theme Info','blesk'),
		) );
	}

	/**
	 * Dismiss required actions
	 * @since 1.8.2.4
	 */
	public function blesk_dismiss_required_action_callback() {

		global $blesk_required_actions;

		$blesk_dismiss_id = (isset($_GET['dismiss_id'])) ? $_GET['dismiss_id'] : 0;

		echo $blesk_dismiss_id; /* this is needed and it's the id of the dismissable required action */

		if( !empty($blesk_dismiss_id) ):

			/* if the option exists, update the record for the specified id */
			if( get_option('blesk_show_required_actions') ):

				$blesk_show_required_actions = get_option('blesk_show_required_actions');

				$blesk_show_required_actions[$blesk_dismiss_id] = false;

				update_option( 'blesk_show_required_actions',$blesk_show_required_actions );

			/* create the new option,with false for the specified id */
			else:

				$blesk_show_required_actions_new = array();

				if( !empty($blesk_required_actions) ):

					foreach( $blesk_required_actions as $blesk_required_action ):

						if( $blesk_required_action['id'] == $blesk_dismiss_id ):
							$blesk_show_required_actions_new[$blesk_required_action['id']] = false;
						else:
							$blesk_show_required_actions_new[$blesk_required_action['id']] = true;
						endif;

					endforeach;

				update_option( 'blesk_show_required_actions', $blesk_show_required_actions_new );

				endif;

			endif;

		endif;

		die(); // this is required to return a proper result
	}


	/**
	 * Welcome screen content
	 * @since 1.8.2.4
	 */
	public function blesk_welcome_screen() {

		?>

		<ul class="blesk-nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting started','blesk'); ?></a></li>
			<li role="presentation" class="blesk-w-red-tab"><a href="#actions_required" aria-controls="actions_required" role="tab" data-toggle="tab"><?php esc_html_e( 'Actions required','blesk'); ?></a></li>
			<li role="presentation"><a href="#github" aria-controls="github" role="tab" data-toggle="tab"><?php esc_html_e( 'Contribute','blesk'); ?></a></li>
			<li role="presentation"><a href="#changelog" aria-controls="changelog" role="tab" data-toggle="tab"><?php esc_html_e( 'Changelog','blesk'); ?></a></li>
		</ul>

		<div class="blesk-tab-content">

			<?php
			/**
			 * @hooked blesk_welcome_getting_started - 10
			 * @hooked blesk_welcome_actions_required - 20
			 * @hooked blesk_welcome_child_themes - 30
			 * @hooked blesk_welcome_github - 40
			 * @hooked blesk_welcome_changelog - 50
			 */
			do_action( 'blesk_welcome' ); ?>

		</div>
		<?php
	}

	/**
	 * Getting started
	 * @since 1.8.2.4
	 */
	public function blesk_welcome_getting_started() {
		require_once( get_template_directory() . '/includes/admin/welcome-screen/sections/getting-started.php' );
	}

	/**
	 * Actions required
	 * @since 1.8.2.4
	 */
	public function blesk_welcome_actions_required() {
		require_once( get_template_directory() . '/includes/admin/welcome-screen/sections/actions-required.php' );
	}

	/**
	 * Contribute
	 * @since 1.8.2.4
	 */
	public function blesk_welcome_github() {
		require_once( get_template_directory() . '/includes/admin/welcome-screen/sections/github.php' );
	}

	/**
	 * Changelog
	 * @since 1.8.2.4
	 */
	public function blesk_welcome_changelog() {
		require_once( get_template_directory() . '/includes/admin/welcome-screen/sections/changelog.php' );
	}
}

new blesk_Welcome();
