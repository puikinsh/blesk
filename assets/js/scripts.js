jQuery( document ).ready( function($) {

	$(".featured-articles").owlCarousel({
	 	items: 4,
	 	itemsDesktop : false,
	 	itemsDesktopSmall : [1024,2],
	 	itemsTablet : false,
	 	itemsMobile : [560,1],
	 	autoPlay : 3000,
	 	pagination : false,
	 });

	
	var windowWidth = $( window ).width();
	var breakPoint = 1025;

	// Open menu
	function openMenu() {
		$( ".bottom-header .open-menu .open" ).click( function() {
			$( ".bottom-header .menunav" ).addClass( "show-menu" );
			$( this ).hide();
			$( ".bottom-header .open-menu .close" ).show();
		});

		$( ".bottom-header .open-menu .close" ).click( function() {
			$( ".bottom-header .menunav" ).removeClass( "show-menu" );
			$( this ).hide();
			$( ".bottom-header .open-menu .open" ).show();
		});
	};

	function openSearchBar() {
		$( ".open-search" ).click( function() {
			$( this ).hide();
			$( ".close-search" ).show();
			$( ".search-input" ).addClass( "show" );
		});

		$( ".close-search" ).click( function() {
			$( this ).hide();
			$( ".open-search" ).show();
			$( ".search-input" ).removeClass( "show" );
		});
	};

	// Color pink article-preview's title
	function hoverTitle( a, b ) {
		$( a ).each( function() {
			$( this ).on({
			    mouseenter: function () {
			    	$( this ).parent().find( b ).addClass( "hover-state" );
			    },
			    mouseleave: function () {
			    	$( this ).parent().find( b ).removeClass( "hover-state" );
			    }
			});
		})
	}
	openMenu();
	openSearchBar();
	hoverTitle( ".main-content .post .entry-image", ".entry-content .entry-title a" );
	hoverTitle( ".main-content .sidebar .widget .post .entry-image", ".read-more" );
	hoverTitle( ".other-articles .post .entry-image", ".entry-title a" );
	hoverTitle( ".bottom-header .search .search-input input[type='submit']", ".search-btn" );
});
