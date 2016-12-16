<?php

/**
 * File includes
 */
include 'includes/libs/class-tgm-plugin-activation.php'; 
include 'includes/sanitize.php';
include 'includes/customizer/customizer.php';
include 'includes/metaboxes.php';
include 'includes/widgets/latest_news.php';
include 'includes/widgets/posts_from_category.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @return void
 */
if(!function_exists('blesk_theme_setup')) {
	function blesk_theme_setup() {

	//Theme Support
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
      add_theme_support( 'automatic-feed-links' );

      add_image_size( 'blesk-logo', 276, 83 );
      add_theme_support( 'custom-logo', array( 'size' => 'blesk-logo' ) );

	//Register navigation menu
	register_nav_menus( array(
		'top_menu' => esc_html__( 'Top Header Menu', 'blesk' ),
		'header_menu' => esc_html__( 'Main Menu', 'blesk' ),
		'footer_menu_left' => esc_html__( 'Footer Left Menu', 'blesk' ),
		'footer_menu_right' => esc_html__( 'Footer Right Menu', 'blesk' )
	) );

			//Image sizes
        add_image_size( 'home_category', 550, 550 );
		add_image_size( 'home_post', 320, 205 );

		if ( ! isset( $content_width ) ) {
			$content_width = 759;
		}

      if ( is_admin() ) {

            global $blesk_required_actions;

            /*
             * id - unique id; required
             * title
             * description
             * check - check for plugins (if installed)
             * plugin_slug - the plugin's slug (used for installing the plugin)
             *
             */
            $blesk_required_actions = array(
                  array(
                        "id"          => 'blesk-req-ac-install-blesk-companion',
                        "title"       => esc_html__( 'Install Blesk Companion', 'blesk' ),
                        "description" => esc_html__( '', 'blesk' ),
                        "check"       => defined( "BLESK_COMPANION" ),
                        "plugin_slug" => 'blesk-companion',
                  ),
                  array(
                        "id"          => 'blesk-req-ac-frontpage-latest-news',
                        "title"       => esc_html__( 'Set Static Homepage', 'blesk' ),
                        "description" => esc_html__( 'If you just installed blesk, create a page with "Home" template and then you need to go to Settings -> Reading , Front page displays and select "Static Page".', 'blesk' ),
                        "check"       => blesk_is_not_frontpage(),
                  ),
                  array(
                        "id"          => 'blesk-req-ac-install-jetpack',
                        "title"       => esc_html__( 'Install Jetpack', 'blesk' ),
                        "description" => esc_html__( 'Blesk works perfectly with Jetpack', 'blesk' ),
                        "check"       => defined( "JETPACK__MINIMUM_WP_VERSION" ),
                        "plugin_slug" => 'jetpack',
                  ),

            );

            require get_template_directory() . '/includes/admin/welcome-screen/welcome-screen.php';
      }

	}
	add_action( 'after_setup_theme', 'blesk_theme_setup' );
}

function blesk_is_not_frontpage() {

      return ( 'page' == get_option( 'show_on_front' ) ? true : false );

}

/**
 * Add theme stylesheets
 *
 * @return void
 */
if(!function_exists('blesk_styles')) {
	function blesk_styles() {

		$google_fonts_roboto = array('family'	=> 'Roboto:400,400italic,900,700,300,300italic',);

		$google_fonts_raleway = array('family'	=> 'Raleway:300');

		
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.5.0');
		wp_enqueue_style( 'owl-css',  get_template_directory_uri() . '/assets/css/owl.carousel.css', array(), '1.3.3');
		wp_enqueue_style( 'owl-css-theme',  get_template_directory_uri() . '/assets/css/owl.theme.css', array('owl-css'), '1.3.3');
		wp_enqueue_style( 'google-fonts-roboto', add_query_arg( $google_fonts_roboto, 'https://fonts.googleapis.com/css' ), array(), null );
		wp_enqueue_style( 'google-fonts-raleway', add_query_arg( $google_fonts_raleway, 'https://fonts.googleapis.com/css' ), array(), null );
            wp_enqueue_style( 'blesk-theme-style', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.3');
            wp_enqueue_style( 'blesk-main-style', get_stylesheet_uri() );
	
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
	add_action( 'wp_enqueue_scripts', 'blesk_styles' );
}


/**
 * Add theme script
 *
 * @return void
 */
if(!function_exists('blesk_scripts')) {
	function blesk_scripts() {

            wp_enqueue_script( 'blesk-html5shiv',get_template_directory_uri().'/assets/js/html5shiv.js');
            wp_script_add_data( 'blesk-html5shiv', 'conditional', 'lt IE 9' );

		wp_enqueue_script( 'blesk-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), '1.3.3', true );
	}
	add_action( 'wp_enqueue_scripts', 'blesk_scripts' );
}


/**
 * Function used to get the menu name
 * 
 * @param string $menu_location - the menu ID
 * @return string|bool
 */
if(!function_exists('blesk_get_menu_name')) {
	function blesk_get_menu_name($menu_location = NULL) {
		if(!$menu_location)
			return NULL;

		$theme_locations = get_nav_menu_locations();

		if(!empty($theme_locations)) {
			$menu_obj = get_term( $theme_locations[$menu_location], 'nav_menu' );
			return $menu_obj->name;
		} else {
			return NULL;
		}
	}
}


/**
 * Function used to get the first category name in loop
 * 
 * @param int $id - post id
 * @param string $taxonomy:category - taxonomy slug
 * @return string|bool
 */
if(!function_exists('blesk_get_categories_in_loop')) {
	function blesk_get_categories_in_loop($id, $taxonomy = 'category') {
		$output = array();
		$categories = get_the_terms( $id, $taxonomy );

        if(!$categories)
            return FALSE;

		foreach( $categories as $category ) {
			array_push($output, array($category->term_id, $category->slug, $category->name));
		}

		$categories = NULL;

		if(empty($output)) {
			return FALSE;
		} else {
			return $output;
		}
	}
}

/**
 * Register sidebars
 *
 * @return void
 */
if(!function_exists('blesk_sidebars')) {
	function blesk_sidebars() {

		$home_page_sidebar = array(
			'id'			=> 'home_page_sidebar',
			'name'			=> __( 'Home Page Sidebar', 'blesk' ),
			'before_widget' => '<div class="widget %2$s" id="%1$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		);
		register_sidebar( $home_page_sidebar );


		$home_page_bottom_categories = array(
			'id'			=> 'home_page_bottom_categories',
			'name'			=> __( 'Home Page Bottom Columns', 'blesk' ),
			'before_widget' => '<div class="col %2$s" id="%1$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="title">',
			'after_title'   => '</h3>',
		);
		register_sidebar( $home_page_bottom_categories );

	}
	add_action( 'widgets_init', 'blesk_sidebars' );
}

if(!function_exists('blesk_get_fontawesome_icons')) {
    function blesk_get_fontawesome_icons() {
        $icons = array(
            'fa-adjust' => 'fa-adjust',
            'fa-adn' => 'fa-adn',
            'fa-align-center' => 'fa-align-center',
            'fa-align-justify' => 'fa-align-justify',
            'fa-align-left' => 'fa-align-left',
            'fa-align-right' => 'fa-align-right',
            'fa-ambulance' => 'fa-ambulance',
            'fa-anchor' => 'fa-anchor',
            'fa-android' => 'fa-android',
            'fa-angellist' => 'fa-angellist',
            'fa-angle-double-down' => 'fa-angle-double-down',
            'fa-angle-double-left' => 'fa-angle-double-left',
            'fa-angle-double-right' => 'fa-angle-double-right',
            'fa-angle-double-up' => 'fa-angle-double-up',
            'fa-angle-down' => 'fa-angle-down',
            'fa-angle-left' => 'fa-angle-left',
            'fa-angle-right' => 'fa-angle-right',
            'fa-angle-up' => 'fa-angle-up',
            'fa-apple' => 'fa-apple',
            'fa-archive' => 'fa-archive',
            'fa-area-chart' => 'fa-area-chart',
            'fa-arrow-circle-down' => 'fa-arrow-circle-down',
            'fa-arrow-circle-left' => 'fa-arrow-circle-left',
            'fa-arrow-circle-o-down' => 'fa-arrow-circle-o-down',
            'fa-arrow-circle-o-left' => 'fa-arrow-circle-o-left',
            'fa-arrow-circle-o-right' => 'fa-arrow-circle-o-right',
            'fa-arrow-circle-o-up' => 'fa-arrow-circle-o-up',
            'fa-arrow-circle-right' => 'fa-arrow-circle-right',
            'fa-arrow-circle-up' => 'fa-arrow-circle-up',
            'fa-arrow-down' => 'fa-arrow-down',
            'fa-arrow-left' => 'fa-arrow-left',
            'fa-arrow-right' => 'fa-arrow-right',
            'fa-arrow-up' => 'fa-arrow-up',
            'fa-arrows' => 'fa-arrows',
            'fa-arrows-alt' => 'fa-arrows-alt',
            'fa-arrows-h' => 'fa-arrows-h',
            'fa-arrows-v' => 'fa-arrows-v',
            'fa-asterisk' => 'fa-asterisk',
            'fa-at' => 'fa-at',
            'fa-automobile' => 'fa-automobile',
            'fa-backward' => 'fa-backward',
            'fa-ban' => 'fa-ban',
            'fa-bank' => 'fa-bank',
            'fa-bar-chart' => 'fa-bar-chart',
            'fa-bar-chart-o' => 'fa-bar-chart-o',
            'fa-barcode' => 'fa-barcode',
            'fa-bars' => 'fa-bars',
            'fa-bed' => 'fa-bed',
            'fa-beer' => 'fa-beer',
            'fa-behance' => 'fa-behance',
            'fa-behance-square' => 'fa-behance-square',
            'fa-bell' => 'fa-bell',
            'fa-bell-o' => 'fa-bell-o',
            'fa-bell-slash' => 'fa-bell-slash',
            'fa-bell-slash-o' => 'fa-bell-slash-o',
            'fa-bicycle' => 'fa-bicycle',
            'fa-binoculars' => 'fa-binoculars',
            'fa-birthday-cake' => 'fa-birthday-cake',
            'fa-bitbucket' => 'fa-bitbucket',
            'fa-bitbucket-square' => 'fa-bitbucket-square',
            'fa-bitcoin' => 'fa-bitcoin',
            'fa-bold' => 'fa-bold',
            'fa-bolt' => 'fa-bolt',
            'fa-bomb' => 'fa-bomb',
            'fa-book' => 'fa-book',
            'fa-bookmark' => 'fa-bookmark',
            'fa-bookmark-o' => 'fa-bookmark-o',
            'fa-briefcase' => 'fa-briefcase',
            'fa-btc' => 'fa-btc',
            'fa-bug' => 'fa-bug',
            'fa-building' => 'fa-building',
            'fa-building-o' => 'fa-building-o',
            'fa-bullhorn' => 'fa-bullhorn',
            'fa-bullseye' => 'fa-bullseye',
            'fa-bus' => 'fa-bus',
            'fa-buysellads' => 'fa-buysellads',
            'fa-cab' => 'fa-cab',
            'fa-calculator' => 'fa-calculator',
            'fa-calendar' => 'fa-calendar',
            'fa-calendar-o' => 'fa-calendar-o',
            'fa-camera' => 'fa-camera',
            'fa-camera-retro' => 'fa-camera-retro',
            'fa-car' => 'fa-car',
            'fa-caret-down' => 'fa-caret-down',
            'fa-caret-left' => 'fa-caret-left',
            'fa-caret-right' => 'fa-caret-right',
            'fa-caret-square-o-down' => 'fa-caret-square-o-down',
            'fa-caret-square-o-left' => 'fa-caret-square-o-left',
            'fa-caret-square-o-right' => 'fa-caret-square-o-right',
            'fa-caret-square-o-up' => 'fa-caret-square-o-up',
            'fa-caret-up' => 'fa-caret-up',
            'fa-cart-arrow-down' => 'fa-cart-arrow-down',
            'fa-cart-plus' => 'fa-cart-plus',
            'fa-cc' => 'fa-cc',
            'fa-cc-amex' => 'fa-cc-amex',
            'fa-cc-discover' => 'fa-cc-discover',
            'fa-cc-mastercard' => 'fa-cc-mastercard',
            'fa-cc-paypal' => 'fa-cc-paypal',
            'fa-cc-stripe' => 'fa-cc-stripe',
            'fa-cc-visa' => 'fa-cc-visa',
            'fa-certificate' => 'fa-certificate',
            'fa-chain' => 'fa-chain',
            'fa-chain-broken' => 'fa-chain-broken',
            'fa-check' => 'fa-check',
            'fa-check-circle' => 'fa-check-circle',
            'fa-check-circle-o' => 'fa-check-circle-o',
            'fa-check-square' => 'fa-check-square',
            'fa-check-square-o' => 'fa-check-square-o',
            'fa-chevron-circle-down' => 'fa-chevron-circle-down',
            'fa-chevron-circle-left' => 'fa-chevron-circle-left',
            'fa-chevron-circle-right' => 'fa-chevron-circle-right',
            'fa-chevron-circle-up' => 'fa-chevron-circle-up',
            'fa-chevron-down' => 'fa-chevron-down',
            'fa-chevron-left' => 'fa-chevron-left',
            'fa-chevron-right' => 'fa-chevron-right',
            'fa-chevron-up' => 'fa-chevron-up',
            'fa-child' => 'fa-child',
            'fa-circle' => 'fa-circle',
            'fa-circle-o' => 'fa-circle-o',
            'fa-circle-o-notch' => 'fa-circle-o-notch',
            'fa-circle-thin' => 'fa-circle-thin',
            'fa-clipboard' => 'fa-clipboard',
            'fa-clock-o' => 'fa-clock-o',
            'fa-close' => 'fa-close',
            'fa-cloud' => 'fa-cloud',
            'fa-cloud-download' => 'fa-cloud-download',
            'fa-cloud-upload' => 'fa-cloud-upload',
            'fa-cny' => 'fa-cny',
            'fa-code' => 'fa-code',
            'fa-code-fork' => 'fa-code-fork',
            'fa-codepen' => 'fa-codepen',
            'fa-coffee' => 'fa-coffee',
            'fa-cog' => 'fa-cog',
            'fa-cogs' => 'fa-cogs',
            'fa-columns' => 'fa-columns',
            'fa-comment' => 'fa-comment',
            'fa-comment-o' => 'fa-comment-o',
            'fa-comments' => 'fa-comments',
            'fa-comments-o' => 'fa-comments-o',
            'fa-compass' => 'fa-compass',
            'fa-compress' => 'fa-compress',
            'fa-connectdevelop' => 'fa-connectdevelop',
            'fa-copy' => 'fa-copy',
            'fa-copyright' => 'fa-copyright',
            'fa-credit-card' => 'fa-credit-card',
            'fa-crop' => 'fa-crop',
            'fa-crosshairs' => 'fa-crosshairs',
            'fa-css3' => 'fa-css3',
            'fa-cube' => 'fa-cube',
            'fa-cubes' => 'fa-cubes',
            'fa-cut' => 'fa-cut',
            'fa-cutlery' => 'fa-cutlery',
            'fa-dashboard' => 'fa-dashboard',
            'fa-dashcube' => 'fa-dashcube',
            'fa-database' => 'fa-database',
            'fa-dedent' => 'fa-dedent',
            'fa-delicious' => 'fa-delicious',
            'fa-desktop' => 'fa-desktop',
            'fa-deviantart' => 'fa-deviantart',
            'fa-diamond' => 'fa-diamond',
            'fa-digg' => 'fa-digg',
            'fa-dollar' => 'fa-dollar',
            'fa-dot-circle-o' => 'fa-dot-circle-o',
            'fa-download' => 'fa-download',
            'fa-dribbble' => 'fa-dribbble',
            'fa-dropbox' => 'fa-dropbox',
            'fa-drupal' => 'fa-drupal',
            'fa-edit' => 'fa-edit',
            'fa-eject' => 'fa-eject',
            'fa-ellipsis-h' => 'fa-ellipsis-h',
            'fa-ellipsis-v' => 'fa-ellipsis-v',
            'fa-empire' => 'fa-empire',
            'fa-envelope' => 'fa-envelope',
            'fa-envelope-o' => 'fa-envelope-o',
            'fa-envelope-square' => 'fa-envelope-square',
            'fa-eraser' => 'fa-eraser',
            'fa-eur' => 'fa-eur',
            'fa-euro' => 'fa-euro',
            'fa-exchange' => 'fa-exchange',
            'fa-exclamation' => 'fa-exclamation',
            'fa-exclamation-circle' => 'fa-exclamation-circle',
            'fa-exclamation-triangle' => 'fa-exclamation-triangle',
            'fa-expand' => 'fa-expand',
            'fa-external-link' => 'fa-external-link',
            'fa-external-link-square' => 'fa-external-link-square',
            'fa-eye' => 'fa-eye',
            'fa-eye-slash' => 'fa-eye-slash',
            'fa-eyedropper' => 'fa-eyedropper',
            'fa-facebook' => 'fa-facebook',
            'fa-facebook-f' => 'fa-facebook-f',
            'fa-facebook-official' => 'fa-facebook-official',
            'fa-facebook-square' => 'fa-facebook-square',
            'fa-fast-backward' => 'fa-fast-backward',
            'fa-fast-forward' => 'fa-fast-forward',
            'fa-fax' => 'fa-fax',
            'fa-female' => 'fa-female',
            'fa-fighter-jet' => 'fa-fighter-jet',
            'fa-file' => 'fa-file',
            'fa-file-archive-o' => 'fa-file-archive-o',
            'fa-file-audio-o' => 'fa-file-audio-o',
            'fa-file-code-o' => 'fa-file-code-o',
            'fa-file-excel-o' => 'fa-file-excel-o',
            'fa-file-image-o' => 'fa-file-image-o',
            'fa-file-movie-o' => 'fa-file-movie-o',
            'fa-file-o' => 'fa-file-o',
            'fa-file-pdf-o' => 'fa-file-pdf-o',
            'fa-file-photo-o' => 'fa-file-photo-o',
            'fa-file-picture-o' => 'fa-file-picture-o',
            'fa-file-powerpoint-o' => 'fa-file-powerpoint-o',
            'fa-file-sound-o' => 'fa-file-sound-o',
            'fa-file-text' => 'fa-file-text',
            'fa-file-text-o' => 'fa-file-text-o',
            'fa-file-video-o' => 'fa-file-video-o',
            'fa-file-word-o' => 'fa-file-word-o',
            'fa-file-zip-o' => 'fa-file-zip-o',
            'fa-files-o' => 'fa-files-o',
            'fa-film' => 'fa-film',
            'fa-filter' => 'fa-filter',
            'fa-fire' => 'fa-fire',
            'fa-fire-extinguisher' => 'fa-fire-extinguisher',
            'fa-flag' => 'fa-flag',
            'fa-flag-checkered' => 'fa-flag-checkered',
            'fa-flag-o' => 'fa-flag-o',
            'fa-flash' => 'fa-flash',
            'fa-flask' => 'fa-flask',
            'fa-flickr' => 'fa-flickr',
            'fa-floppy-o' => 'fa-floppy-o',
            'fa-folder' => 'fa-folder',
            'fa-folder-o' => 'fa-folder-o',
            'fa-folder-open' => 'fa-folder-open',
            'fa-folder-open-o' => 'fa-folder-open-o',
            'fa-font' => 'fa-font',
            'fa-forumbee' => 'fa-forumbee',
            'fa-forward' => 'fa-forward',
            'fa-foursquare' => 'fa-foursquare',
            'fa-frown-o' => 'fa-frown-o',
            'fa-futbol-o' => 'fa-futbol-o',
            'fa-gamepad' => 'fa-gamepad',
            'fa-gavel' => 'fa-gavel',
            'fa-gbp' => 'fa-gbp',
            'fa-ge' => 'fa-ge',
            'fa-gear' => 'fa-gear',
            'fa-gears' => 'fa-gears',
            'fa-genderless' => 'fa-genderless',
            'fa-gift' => 'fa-gift',
            'fa-git' => 'fa-git',
            'fa-git-square' => 'fa-git-square',
            'fa-github' => 'fa-github',
            'fa-github-alt' => 'fa-github-alt',
            'fa-github-square' => 'fa-github-square',
            'fa-gittip' => 'fa-gittip',
            'fa-glass' => 'fa-glass',
            'fa-globe' => 'fa-globe',
            'fa-google' => 'fa-google',
            'fa-google-plus' => 'fa-google-plus',
            'fa-google-plus-square' => 'fa-google-plus-square',
            'fa-google-wallet' => 'fa-google-wallet',
            'fa-graduation-cap' => 'fa-graduation-cap',
            'fa-gratipay' => 'fa-gratipay',
            'fa-group' => 'fa-group',
            'fa-h-square' => 'fa-h-square',
            'fa-hacker-news' => 'fa-hacker-news',
            'fa-hand-o-down' => 'fa-hand-o-down',
            'fa-hand-o-left' => 'fa-hand-o-left',
            'fa-hand-o-right' => 'fa-hand-o-right',
            'fa-hand-o-up' => 'fa-hand-o-up',
            'fa-hdd-o' => 'fa-hdd-o',
            'fa-header' => 'fa-header',
            'fa-headphones' => 'fa-headphones',
            'fa-heart' => 'fa-heart',
            'fa-heart-o' => 'fa-heart-o',
            'fa-heartbeat' => 'fa-heartbeat',
            'fa-history' => 'fa-history',
            'fa-home' => 'fa-home',
            'fa-hospital-o' => 'fa-hospital-o',
            'fa-hotel' => 'fa-hotel',
            'fa-html5' => 'fa-html5',
            'fa-ils' => 'fa-ils',
            'fa-image' => 'fa-image',
            'fa-inbox' => 'fa-inbox',
            'fa-indent' => 'fa-indent',
            'fa-info' => 'fa-info',
            'fa-info-circle' => 'fa-info-circle',
            'fa-inr' => 'fa-inr',
            'fa-instagram' => 'fa-instagram',
            'fa-institution' => 'fa-institution',
            'fa-ioxhost' => 'fa-ioxhost',
            'fa-italic' => 'fa-italic',
            'fa-joomla' => 'fa-joomla',
            'fa-jpy' => 'fa-jpy',
            'fa-jsfiddle' => 'fa-jsfiddle',
            'fa-key' => 'fa-key',
            'fa-keyboard-o' => 'fa-keyboard-o',
            'fa-krw' => 'fa-krw',
            'fa-language' => 'fa-language',
            'fa-laptop' => 'fa-laptop',
            'fa-lastfm' => 'fa-lastfm',
            'fa-lastfm-square' => 'fa-lastfm-square',
            'fa-leaf' => 'fa-leaf',
            'fa-leanpub' => 'fa-leanpub',
            'fa-legal' => 'fa-legal',
            'fa-lemon-o' => 'fa-lemon-o',
            'fa-level-down' => 'fa-level-down',
            'fa-level-up' => 'fa-level-up',
            'fa-life-bouy' => 'fa-life-bouy',
            'fa-life-buoy' => 'fa-life-buoy',
            'fa-life-ring' => 'fa-life-ring',
            'fa-life-saver' => 'fa-life-saver',
            'fa-lightbulb-o' => 'fa-lightbulb-o',
            'fa-line-chart' => 'fa-line-chart',
            'fa-link' => 'fa-link',
            'fa-linkedin' => 'fa-linkedin',
            'fa-linkedin-square' => 'fa-linkedin-square',
            'fa-linux' => 'fa-linux',
            'fa-list' => 'fa-list',
            'fa-list-alt' => 'fa-list-alt',
            'fa-list-ol' => 'fa-list-ol',
            'fa-list-ul' => 'fa-list-ul',
            'fa-location-arrow' => 'fa-location-arrow',
            'fa-lock' => 'fa-lock',
            'fa-long-arrow-down' => 'fa-long-arrow-down',
            'fa-long-arrow-left' => 'fa-long-arrow-left',
            'fa-long-arrow-right' => 'fa-long-arrow-right',
            'fa-long-arrow-up' => 'fa-long-arrow-up',
            'fa-magic' => 'fa-magic',
            'fa-magnet' => 'fa-magnet',
            'fa-mail-forward' => 'fa-mail-forward',
            'fa-mail-reply' => 'fa-mail-reply',
            'fa-mail-reply-all' => 'fa-mail-reply-all',
            'fa-male' => 'fa-male',
            'fa-map-marker' => 'fa-map-marker',
            'fa-mars' => 'fa-mars',
            'fa-mars-double' => 'fa-mars-double',
            'fa-mars-stroke' => 'fa-mars-stroke',
            'fa-mars-stroke-h' => 'fa-mars-stroke-h',
            'fa-mars-stroke-v' => 'fa-mars-stroke-v',
            'fa-maxcdn' => 'fa-maxcdn',
            'fa-meanpath' => 'fa-meanpath',
            'fa-medium' => 'fa-medium',
            'fa-medkit' => 'fa-medkit',
            'fa-meh-o' => 'fa-meh-o',
            'fa-mercury' => 'fa-mercury',
            'fa-microphone' => 'fa-microphone',
            'fa-microphone-slash' => 'fa-microphone-slash',
            'fa-minus' => 'fa-minus',
            'fa-minus-circle' => 'fa-minus-circle',
            'fa-minus-square' => 'fa-minus-square',
            'fa-minus-square-o' => 'fa-minus-square-o',
            'fa-mobile' => 'fa-mobile',
            'fa-mobile-phone' => 'fa-mobile-phone',
            'fa-money' => 'fa-money',
            'fa-moon-o' => 'fa-moon-o',
            'fa-mortar-board' => 'fa-mortar-board',
            'fa-motorcycle' => 'fa-motorcycle',
            'fa-music' => 'fa-music',
            'fa-navicon' => 'fa-navicon',
            'fa-neuter' => 'fa-neuter',
            'fa-newspaper-o' => 'fa-newspaper-o',
            'fa-openid' => 'fa-openid',
            'fa-outdent' => 'fa-outdent',
            'fa-pagelines' => 'fa-pagelines',
            'fa-paint-brush' => 'fa-paint-brush',
            'fa-paper-plane' => 'fa-paper-plane',
            'fa-paper-plane-o' => 'fa-paper-plane-o',
            'fa-paperclip' => 'fa-paperclip',
            'fa-paragraph' => 'fa-paragraph',
            'fa-paste' => 'fa-paste',
            'fa-pause' => 'fa-pause',
            'fa-paw' => 'fa-paw',
            'fa-paypal' => 'fa-paypal',
            'fa-pencil' => 'fa-pencil',
            'fa-pencil-square' => 'fa-pencil-square',
            'fa-pencil-square-o' => 'fa-pencil-square-o',
            'fa-phone' => 'fa-phone',
            'fa-phone-square' => 'fa-phone-square',
            'fa-photo' => 'fa-photo',
            'fa-picture-o' => 'fa-picture-o',
            'fa-pie-chart' => 'fa-pie-chart',
            'fa-pied-piper' => 'fa-pied-piper',
            'fa-pied-piper-alt' => 'fa-pied-piper-alt',
            'fa-pinterest' => 'fa-pinterest',
            'fa-pinterest-p' => 'fa-pinterest-p',
            'fa-pinterest-square' => 'fa-pinterest-square',
            'fa-plane' => 'fa-plane',
            'fa-play' => 'fa-play',
            'fa-play-circle' => 'fa-play-circle',
            'fa-play-circle-o' => 'fa-play-circle-o',
            'fa-plug' => 'fa-plug',
            'fa-plus' => 'fa-plus',
            'fa-plus-circle' => 'fa-plus-circle',
            'fa-plus-square' => 'fa-plus-square',
            'fa-plus-square-o' => 'fa-plus-square-o',
            'fa-power-off' => 'fa-power-off',
            'fa-print' => 'fa-print',
            'fa-puzzle-piece' => 'fa-puzzle-piece',
            'fa-qq' => 'fa-qq',
            'fa-qrcode' => 'fa-qrcode',
            'fa-question' => 'fa-question',
            'fa-question-circle' => 'fa-question-circle',
            'fa-quote-left' => 'fa-quote-left',
            'fa-quote-right' => 'fa-quote-right',
            'fa-ra' => 'fa-ra',
            'fa-random' => 'fa-random',
            'fa-rebel' => 'fa-rebel',
            'fa-recycle' => 'fa-recycle',
            'fa-reddit' => 'fa-reddit',
            'fa-reddit-square' => 'fa-reddit-square',
            'fa-refresh' => 'fa-refresh',
            'fa-remove' => 'fa-remove',
            'fa-renren' => 'fa-renren',
            'fa-reorder' => 'fa-reorder',
            'fa-repeat' => 'fa-repeat',
            'fa-reply' => 'fa-reply',
            'fa-reply-all' => 'fa-reply-all',
            'fa-retweet' => 'fa-retweet',
            'fa-rmb' => 'fa-rmb',
            'fa-road' => 'fa-road',
            'fa-rocket' => 'fa-rocket',
            'fa-rotate-left' => 'fa-rotate-left',
            'fa-rotate-right' => 'fa-rotate-right',
            'fa-rouble' => 'fa-rouble',
            'fa-rss' => 'fa-rss',
            'fa-rss-square' => 'fa-rss-square',
            'fa-rub' => 'fa-rub',
            'fa-ruble' => 'fa-ruble',
            'fa-rupee' => 'fa-rupee',
            'fa-save' => 'fa-save',
            'fa-scissors' => 'fa-scissors',
            'fa-search' => 'fa-search',
            'fa-search-minus' => 'fa-search-minus',
            'fa-search-plus' => 'fa-search-plus',
            'fa-sellsy' => 'fa-sellsy',
            'fa-send' => 'fa-send',
            'fa-send-o' => 'fa-send-o',
            'fa-server' => 'fa-server',
            'fa-share' => 'fa-share',
            'fa-share-alt' => 'fa-share-alt',
            'fa-share-alt-square' => 'fa-share-alt-square',
            'fa-share-square' => 'fa-share-square',
            'fa-share-square-o' => 'fa-share-square-o',
            'fa-shekel' => 'fa-shekel',
            'fa-sheqel' => 'fa-sheqel',
            'fa-shield' => 'fa-shield',
            'fa-ship' => 'fa-ship',
            'fa-shirtsinbulk' => 'fa-shirtsinbulk',
            'fa-shopping-cart' => 'fa-shopping-cart',
            'fa-sign-in' => 'fa-sign-in',
            'fa-sign-out' => 'fa-sign-out',
            'fa-signal' => 'fa-signal',
            'fa-simplybuilt' => 'fa-simplybuilt',
            'fa-sitemap' => 'fa-sitemap',
            'fa-skyatlas' => 'fa-skyatlas',
            'fa-skype' => 'fa-skype',
            'fa-slack' => 'fa-slack',
            'fa-sliders' => 'fa-sliders',
            'fa-slideshare' => 'fa-slideshare',
            'fa-smile-o' => 'fa-smile-o',
            'fa-soccer-ball-o' => 'fa-soccer-ball-o',
            'fa-sort' => 'fa-sort',
            'fa-sort-alpha-asc' => 'fa-sort-alpha-asc',
            'fa-sort-alpha-desc' => 'fa-sort-alpha-desc',
            'fa-sort-amount-asc' => 'fa-sort-amount-asc',
            'fa-sort-amount-desc' => 'fa-sort-amount-desc',
            'fa-sort-asc' => 'fa-sort-asc',
            'fa-sort-desc' => 'fa-sort-desc',
            'fa-sort-down' => 'fa-sort-down',
            'fa-sort-numeric-asc' => 'fa-sort-numeric-asc',
            'fa-sort-numeric-desc' => 'fa-sort-numeric-desc',
            'fa-sort-up' => 'fa-sort-up',
            'fa-soundcloud' => 'fa-soundcloud',
            'fa-space-shuttle' => 'fa-space-shuttle',
            'fa-spinner' => 'fa-spinner',
            'fa-spoon' => 'fa-spoon',
            'fa-spotify' => 'fa-spotify',
            'fa-square' => 'fa-square',
            'fa-square-o' => 'fa-square-o',
            'fa-stack-exchange' => 'fa-stack-exchange',
            'fa-stack-overflow' => 'fa-stack-overflow',
            'fa-star' => 'fa-star',
            'fa-star-half' => 'fa-star-half',
            'fa-star-half-empty' => 'fa-star-half-empty',
            'fa-star-half-full' => 'fa-star-half-full',
            'fa-star-half-o' => 'fa-star-half-o',
            'fa-star-o' => 'fa-star-o',
            'fa-steam' => 'fa-steam',
            'fa-steam-square' => 'fa-steam-square',
            'fa-step-backward' => 'fa-step-backward',
            'fa-step-forward' => 'fa-step-forward',
            'fa-stethoscope' => 'fa-stethoscope',
            'fa-stop' => 'fa-stop',
            'fa-street-view' => 'fa-street-view',
            'fa-strikethrough' => 'fa-strikethrough',
            'fa-stumbleupon' => 'fa-stumbleupon',
            'fa-stumbleupon-circle' => 'fa-stumbleupon-circle',
            'fa-subscript' => 'fa-subscript',
            'fa-subway' => 'fa-subway',
            'fa-suitcase' => 'fa-suitcase',
            'fa-sun-o' => 'fa-sun-o',
            'fa-superscript' => 'fa-superscript',
            'fa-support' => 'fa-support',
            'fa-table' => 'fa-table',
            'fa-tablet' => 'fa-tablet',
            'fa-tachometer' => 'fa-tachometer',
            'fa-tag' => 'fa-tag',
            'fa-tags' => 'fa-tags',
            'fa-tasks' => 'fa-tasks',
            'fa-taxi' => 'fa-taxi',
            'fa-tencent-weibo' => 'fa-tencent-weibo',
            'fa-terminal' => 'fa-terminal',
            'fa-text-height' => 'fa-text-height',
            'fa-text-width' => 'fa-text-width',
            'fa-th' => 'fa-th',
            'fa-th-large' => 'fa-th-large',
            'fa-th-list' => 'fa-th-list',
            'fa-thumb-tack' => 'fa-thumb-tack',
            'fa-thumbs-down' => 'fa-thumbs-down',
            'fa-thumbs-o-down' => 'fa-thumbs-o-down',
            'fa-thumbs-o-up' => 'fa-thumbs-o-up',
            'fa-thumbs-up' => 'fa-thumbs-up',
            'fa-ticket' => 'fa-ticket',
            'fa-times' => 'fa-times',
            'fa-times-circle' => 'fa-times-circle',
            'fa-times-circle-o' => 'fa-times-circle-o',
            'fa-tint' => 'fa-tint',
            'fa-toggle-down' => 'fa-toggle-down',
            'fa-toggle-left' => 'fa-toggle-left',
            'fa-toggle-off' => 'fa-toggle-off',
            'fa-toggle-on' => 'fa-toggle-on',
            'fa-toggle-right' => 'fa-toggle-right',
            'fa-toggle-up' => 'fa-toggle-up',
            'fa-train' => 'fa-train',
            'fa-transgender' => 'fa-transgender',
            'fa-transgender-alt' => 'fa-transgender-alt',
            'fa-trash' => 'fa-trash',
            'fa-trash-o' => 'fa-trash-o',
            'fa-tree' => 'fa-tree',
            'fa-trello' => 'fa-trello',
            'fa-trophy' => 'fa-trophy',
            'fa-truck' => 'fa-truck',
            'fa-try' => 'fa-try',
            'fa-tty' => 'fa-tty',
            'fa-tumblr' => 'fa-tumblr',
            'fa-tumblr-square' => 'fa-tumblr-square',
            'fa-turkish-lira' => 'fa-turkish-lira',
            'fa-twitch' => 'fa-twitch',
            'fa-twitter' => 'fa-twitter',
            'fa-twitter-square' => 'fa-twitter-square',
            'fa-umbrella' => 'fa-umbrella',
            'fa-underline' => 'fa-underline',
            'fa-undo' => 'fa-undo',
            'fa-university' => 'fa-university',
            'fa-unlink' => 'fa-unlink',
            'fa-unlock' => 'fa-unlock',
            'fa-unlock-alt' => 'fa-unlock-alt',
            'fa-unsorted' => 'fa-unsorted',
            'fa-upload' => 'fa-upload',
            'fa-usd' => 'fa-usd',
            'fa-user' => 'fa-user',
            'fa-user-md' => 'fa-user-md',
            'fa-user-plus' => 'fa-user-plus',
            'fa-user-secret' => 'fa-user-secret',
            'fa-user-times' => 'fa-user-times',
            'fa-users' => 'fa-users',
            'fa-venus' => 'fa-venus',
            'fa-venus-double' => 'fa-venus-double',
            'fa-venus-mars' => 'fa-venus-mars',
            'fa-viacoin' => 'fa-viacoin',
            'fa-video-camera' => 'fa-video-camera',
            'fa-vimeo-square' => 'fa-vimeo-square',
            'fa-vine' => 'fa-vine',
            'fa-vk' => 'fa-vk',
            'fa-volume-down' => 'fa-volume-down',
            'fa-volume-off' => 'fa-volume-off',
            'fa-volume-up' => 'fa-volume-up',
            'fa-warning' => 'fa-warning',
            'fa-wechat' => 'fa-wechat',
            'fa-weibo' => 'fa-weibo',
            'fa-weixin' => 'fa-weixin',
            'fa-whatsapp' => 'fa-whatsapp',
            'fa-wheelchair' => 'fa-wheelchair',
            'fa-wifi' => 'fa-wifi',
            'fa-windows' => 'fa-windows',
            'fa-won' => 'fa-won',
            'fa-wordpress' => 'fa-wordpress',
            'fa-wrench' => 'fa-wrench',
            'fa-xing' => 'fa-xing',
            'fa-xing-square' => 'fa-xing-square',
            'fa-yahoo' => 'fa-yahoo',
            'fa-yelp' => 'fa-yelp',
            'fa-yen' => 'fa-yen',
            'fa-youtube' => 'fa-youtube',
            'fa-youtube-play' => 'fa-youtube-play',
            'fa-youtube-square' => 'fa-youtube-square'
        );

        return $icons;
    }
}

/**
 * Builds array of home sections
 *
 * @return $array - of sections with file name as key and formatted name as value
 */
if(!function_exists('blesk_home_sections')) {
    function blesk_home_sections() {

      $array = array(
            '01featured_posts' => __('Featured posts','blesk'),
            '02wide_banner' => __('Wide banner','blesk'),
            '03content_and_sidebar' => __('Content and sidebar','blesk'),
            '04bottom_categories' => __('Bottom categories','blesk'),
      );

      return $array;
    }
}

/**
 * Check WordPress version
 *
 * @param string $tocheck - WP version you want to check against the current version
 * @return boolean
 */
if(!function_exists('blesk_check_wp_version')) {
    function blesk_check_wp_version($tocheck) {

        //Get current value
        global $wp_version;

        //Check if $tocheck exists, if not the function will return always false
        if(!$tocheck) {
            $tocheck = $wp_version;
        }

        return ($wp_version > $tocheck ? true : false);
    }
}

/**
 * TGM Plugin Activation
 */
if(!function_exists('blesk_tgm_activation')) {
    function blesk_tgm_activation() {

        $plugins = array(
            array(
                'name'      => 'Jetpack by WordPress.com',
                'slug'      => 'jetpack',
                'required'  => false,
            )
        );

        $config = array(
            'default_path' => '',                      
            'menu'         => 'tgmpa-install-plugins', 
            'has_notices'  => true,                   
            'dismissable'  => true,                  
            'dismiss_msg'  => '',                   
            'is_automatic' => false,                 
            'message'      => '',     
            'strings'      => array(
                'page_title'                      => __( 'Install Required Plugins', 'blesk' ),
                'menu_title'                      => __( 'Install Plugins', 'blesk' ),
                'installing'                      => __( 'Installing Plugin: %s', 'blesk' ), 
                'oops'                            => __( 'Something went wrong with the plugin API.', 'blesk' ),
                'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'blesk' ),
                'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'blesk' ),
                'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'blesk' ),
                'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'blesk' ),
                'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'blesk' ),
                'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' , 'blesk'), 
                'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' , 'blesk'), 
                'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' , 'blesk'), 
                'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'blesk' ),
                'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'blesk' ),
                'return'                          => __( 'Return to Required Plugins Installer', 'blesk' ),
                'plugin_activated'                => __( 'Plugin activated successfully.', 'blesk' ),
                'complete'                        => __( 'All plugins installed and activated successfully. %s', 'blesk' ), 
                'nag_type'                        => 'updated'
            )
        );

        tgmpa( $plugins, $config );
    }

    add_action( 'tgmpa_register', 'blesk_tgm_activation' );
}

/**
 * Customizer CSS output
 */
if(!function_exists('blesk_customizer_style_css')) {
    
    add_action('wp_enqueue_scripts','blesk_customizer_style_css');
    function blesk_customizer_style_css() {
        /*
            array(
                'selector' => '.buttons .custom-button',
                'style' => 'background-image',
                'property' => 'zerif_bigtitle_button_border_color'
                'before_property' => 'url(',
                'after_property' => ')'
                'important' => true
            ),
        */
        $return = '';
        $styles = array(

                array(
                    'selector' => 'body',
                    'style' => 'background',
                    'property' => 'blesk_color_background' 
                ),

                array(
                    'selector' => 'body',
                    'style' => 'color',
                    'property' => 'blesk_color_general_text' 
                ),

                array(
                    'selector' => '.top-header',
                    'style' => 'background',
                    'property' => 'blesk_color_topbar_background' 
                ),

                array(
                    'selector' => '.top-header a',
                    'style' => 'color',
                    'property' => 'blesk_color_topbar_links' 
                ),

                array(
                    'selector' => '.top-header a:hover',
                    'style' => 'color',
                    'property' => 'blesk_color_topbar_links_hover' 
                ),

                array(
                    'selector' => '.bottom-header, .bottom-header .menu, .bottom-header .menu li .sub-menu, .bottom-header .search .search-input',
                    'style' => 'background-color',
                    'property' => 'blesk_color_main_menu' 
                ),

                array(
                    'selector' => '.bottom-header .search .search-input .search-btn',
                    'style' => 'color',
                    'property' => 'blesk_color_main_menu' 
                ),

                array(
                    'selector' => '.bottom-header .menu li.menu-item-has-children:after',
                    'style' => 'border-top-color',
                    'property' => 'blesk_color_main_menu' 
                ),

                array(
                    'selector' => '.bottom-header .menu li .sub-menu:after,.bottom-header .menu li .sub-menu:before',
                    'style' => 'border-bottom-color',
                    'property' => 'blesk_color_main_menu' 
                ),

                array(
                    'selector' => '.bottom-header .menu li .sub-menu li',
                    'style' => 'border-bottom-color',
                    'property' => 'blesk_color_main_menu_drop_down_border' 
                ),

                array(
                    'selector' => '.bottom-header .menu a',
                    'style' => 'color',
                    'property' => 'blesk_color_main_menu_links' 
                ),

                array(
                    'selector' => '.bottom-header .menu a:hover',
                    'style' => 'color',
                    'property' => 'blesk_color_main_menu_links_hover' 
                ),

                array(
                    'selector' => '.single-content .single-tags, .single-content .sharedaddy, .other-articles .pagination a, .other-articles .pagination span, footer .top-footer, .main-content, .widget-title, .sidebar .widget, .main-content .post, footer .bottom-footer, 
                    .sidebar .widget .post, .other-articles,footer .top-footer .center, .single-content .author-area, #comments h3, #comments h2',
                    'style' => 'border-color',
                    'property' => 'blesk_color_general_border' 
                ),

                array(
                    'selector' => 'h1.page-title, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .sidebar .widget .widget-title, footer .top-footer .widget .title, #comments h3, #comments h2, .single-post .entry-title, .single-post h1, .single-post h2, .single-post h3, .single-post h4, .single-post h5, .single-post h6',
                    'style' => 'color',
                    'property' => 'blesk_color_headings' 
                ),

                array(
                    'selector' => 'footer .top-footer a:hover, .markup-format a:hover, .sidebar .widget.widget_categoryposts a:hover, 
                    .main-content .post .entry-content .entry-meta a:hover,.main-content .post .entry-content .entry-title a:hover,
                    footer .top-footer .center .social a:hover, .main-content .post .entry-content .entry-meta li i, 
                    .widget_categoryposts .entry-title a, .widget_categoryposts .entry-meta a, .single-content .sharedaddy .sd-title, 
                    .single-content .author-area .author-info .title, .sidebar .widget li a, .single-post .entry-meta li i',
                    'style' => 'color',
                    'property' => 'blesk_color_miscellaneous' 
                ),
               
                array(
                    'selector' => '#comments #respond input[type=submit], .sidebar .widget .widget-title:after',
                    'style' => 'background-color',
                    'property' => 'blesk_color_miscellaneous' 
                ),

                array(
                    'selector' => '#comments input[type=submit]',
                    'style' => 'border-color',
                    'property' => 'blesk_color_miscellaneous',
                    'important' => true
                ),

                array(
                    'selector' => '.other-articles',
                    'style' => 'background-color',
                    'property' => 'blesk_color_pagination_bg',
                ),

                array(
                    'selector' => '.other-articles .pagination a, .other-articles .pagination span',
                    'style' => 'background-color',
                    'property' => 'blesk_color_pagination_buttons',
                ),

                array(
                    'selector' => '.other-articles .pagination a.current, .other-articles .pagination a:hover, .other-articles .pagination span.current, .other-articles .pagination span:hover',
                    'style' => 'background-color',
                    'property' => 'blesk_color_pagination_buttons_active',
                ),

            );

        if($styles) {
            $return .= ' <style type="text/css">';
            $excludes = array();
            $excludes_keys = array();

            //Add items to exclude list
            foreach($styles as $key => $val) {
                if(array_key_exists('exclude', $val) && !empty($val['exclude'])) {
                    $property = get_theme_mod($val['property']);

                    if($property) {
                        array_push($excludes, $val['exclude']);
                    }
                }
            }

            // Add items to exclude keys list
            foreach($styles as $key => $val) {
                if(array_key_exists('property', $val) && !empty($val['property'])) {
                    foreach ($excludes as $poz => $exclude) {
                        if($val['property'] == $exclude) {
                            array_push($excludes_keys, $key);
                        }
                    }
                }
            }

            foreach($styles as $key => $val) {
                    
                //If style is added in customizer, create a new row in output
                $property = get_theme_mod($val['property']);

                if($property && !in_array($key, $excludes_keys)) {

                    //Display selector
                    if(array_key_exists('selector', $val) && !empty($val['selector'])) {
                        $return .= $val['selector'];
                    } else {
                        error_log("Function: blesk_customizer_style_css() - Array Key 'selector' not defined for " . $val['property']);
                    }

                    $return .= '{';

                    if(array_key_exists('style', $val) && !empty($val['style'])) {
                        $return .= $val['style'] . ':';
                    } else {
                        error_log("Function: blesk_customizer_style_css() - Array Key 'style' not defined for " . $val['property']);
                    }

                    if(array_key_exists('before_property', $val) && !empty($val['before_property'])) {
                        $return .= $val['before_property'];
                    }

                    if(array_key_exists('property', $val) && !empty($val['property'])) {
                        $return .= esc_html(get_theme_mod($val['property']));
                    }

                    if(array_key_exists('after_property', $val) && !empty($val['after_property'])) {
                        $return .= $val['after_property'];
                    }

                    if(array_key_exists('important', $val) && !empty($val['important'])) {
                        $return .= ' !important';
                    }

                    $return .= ';}';
                }
            }

            $return .=  '</style>';
        }

        wp_add_inline_style( 'blesk-theme-style', $return );
        
    }
}

