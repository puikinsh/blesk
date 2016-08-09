( function( $ ) {

	//Header logo
	wp.customize( 'blesk_logo', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('.center-header .logo').empty();
				$('.center-header .wrapper .logo').append('<img src="'+to+'"/>');
			} else {
				$('.center-header .logo').empty();
				$('.center-header .logo').append('<h1>'+$('.center-header .logo').attr('title')+'</h1><h2>'+$('.center-header .logo').attr('alt')+'</h2>');
			}
		} );
	} );

	wp.customize( 'site_logo', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('.center-header .logo').empty();
				$('.center-header .wrapper .logo').append('<img src="'+to+'"/>');
			} else {
				$('.center-header .logo').empty();
				$('.center-header .logo').append('<h1>'+$('.center-header .logo').attr('title')+'</h1><h2>'+$('.center-header .logo').attr('alt')+'</h2>');
			}
		} );
	} );

	//Footer logo
	wp.customize( 'blesk_logo', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('footer .top-footer .center .logo').empty();
				$('footer .top-footer .center .logo').append('<a href="" class="logo"><img src="'+to+'"/></a>');
			} else {
				$('footer .top-footer .center .logo').empty();
				$('footer .top-footer .center .logo').append('<h1>'+$('.center-header .logo').attr('title')+'</h1>');
			}
		} );
	} );

	wp.customize( 'site_logo', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('footer .top-footer .center .logo').empty();
				$('footer .top-footer .center .logo').append('<a href="" class="logo"><img src="'+to+'"/></a>');
			} else {
				$('footer .top-footer .center .logo').empty();
				$('footer .top-footer .center .logo').append('<h1>'+$('.center-header .logo').attr('title')+'</h1>');
			}
		} );
	} );

	//Header ads
	wp.customize( 'blesk_header_ad', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('.center-header .ads-panel').remove();
				$('.center-header .wrapper').append('<div class="ads-panel">'+to+'</div>');
			} else {
				$('.center-header .ads-panel').remove();
			}
		} );
	} );

	//Social links
	function socialIconHeaderOutput(to, icon) {
		if(to.length) {
			if(!$('.top-header .social').length) {
				$('.top-header .wrapper').append('<div class="social"><ul></ul></div>');
			}

			$('.top-header .social a.'+icon).parents('li').remove();
			$('.top-header .wrapper .social ul').append('<li><a href="'+to+'" class="fa '+icon+'"></a></li>');
		} else {
			$('.top-header .social a.'+icon).parents('li').remove();
		}
	}

	function socialIconFooterOutput(to, icon) {
		if(to.length) {
			if(!$('footer .top-footer .center .social').length) {
				$('footer .top-footer .center').prepend('<div class="social"><ul></ul></div>');
			}

			$('footer .top-footer .center .social a.'+icon).parents('li').remove();
			$('footer .top-footer .center .social').append('<li><a href="'+to+'" class="fa '+icon+'"></a></li>');
		} else {
			$('footer .top-footer .center .social a.'+icon).parents('li').remove();
		}
	}

	//Facebook icon
	wp.customize( 'blesk_social_link_facebook', function( value ) {
		value.bind( function( to ) {
			socialIconHeaderOutput(to, 'fa-facebook');
			socialIconFooterOutput(to, 'fa-facebook');
		} );
	} );

	//Twitter icon
	wp.customize( 'blesk_social_link_twitter', function( value ) {
		value.bind( function( to ) {
			socialIconHeaderOutput(to, 'fa-twitter');
			socialIconFooterOutput(to, 'fa-twitter');
		} );
	} );

	//Youtube icon
	wp.customize( 'blesk_social_link_youtube', function( value ) {
		value.bind( function( to ) {
			socialIconHeaderOutput(to, 'fa-youtube');
			socialIconFooterOutput(to, 'fa-youtube-play');
		} );
	} );

	//Tumblr icon
	wp.customize( 'blesk_social_link_tumblr', function( value ) {
		value.bind( function( to ) {
			socialIconHeaderOutput(to, 'fa-tumblr');
			socialIconFooterOutput(to, 'fa-tumblr');
		} );
	} );

	//Pinterest icon
	wp.customize( 'blesk_social_link_pinterest', function( value ) {
		value.bind( function( to ) {
			socialIconHeaderOutput(to, 'fa-pinterest-p');
			socialIconFooterOutput(to, 'fa-pinterest-p');
		} );
	} );

	//Dribbble icon
	wp.customize( 'blesk_social_link_dribbble', function( value ) {
		value.bind( function( to ) {
			socialIconHeaderOutput(to, 'fa-dribbble');
			socialIconFooterOutput(to, 'fa-dribbble');
		} );
	} );

	//Home wide ad
	wp.customize( 'blesk_gome_central_ad', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('#home_wide_ad .central-ad').remove();
				$('#home_wide_ad').append('<div class="central-ad"><div class="ads-panel">'+to+'</div><!-- /.ads-panel --></div><!-- /.central-ad -->');
			} else {
				$('#home_wide_ad .central-ad').remove();
			}
		} );
	} );

	//Background color
	var body_style = '';

	wp.customize( 'blesk_color_background', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				var body_style =  $('body').attr('style') + 'background: ' + to + ';';
				$('body, .other-articles').attr('style', body_style);
			} 
		} );
	} );

	//Text color
	wp.customize( 'blesk_color_general_text', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				var body_style =  $('body').attr('style') + 'color: ' + to + ';';
				$('body').attr('style', body_style);
			} 
		} );
	} );

	//Top bar background color
	wp.customize( 'blesk_color_topbar_background', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('.top-header').attr('style', 'background: ' + to + ';');
			} 
		} );
	} );

	//Top bar links color
	wp.customize( 'blesk_color_topbar_links', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('.top-header a').attr('style', 'color: ' + to + ';');
			} 
		} );
	} );

	//Main menu background color
	// var submenustyle = $('.bottom-header .menu li .sub-menu').attr('style');
	wp.customize( 'blesk_color_main_menu', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('.bottom-header').attr('style', 'background-color: ' + to + ';');
				$('.bottom-header .menu').attr('style', 'background-color: ' + to + ';');
				$('.bottom-header .menu li .sub-menu').css('background-color', to);
				$('.bottom-header .search .search-input').attr('style', 'background-color: ' + to + ';');

				$('style.blesk_color_main_menu').remove();
				$('head').append('<style class="blesk_color_main_menu">.bottom-header .menu li.menu-item-has-children:after{border-top-color: ' + to + ' !important;}.bottom-header .menu li .sub-menu:after,.bottom-header .menu li .sub-menu:before{border-bottom-color: '+to+' !important;}</style>');
			} 
		} );
	} );

	wp.customize( 'blesk_color_main_menu_drop_down_border', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('.bottom-header .menu li .sub-menu li').attr('style', 'border-bottom-color: ' + to + ';');
			} 
		} );
	} );

	wp.customize( 'blesk_color_main_menu_links', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('.bottom-header .menu a').attr('style', 'color: ' + to + ';');
			} 
		} );
	} );

	wp.customize( 'blesk_color_general_border', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				var body_style =  $('body').attr('style') + 'border-color: ' + to + ';';
				$('.other-articles').attr('style', body_style);
				$('.other-articles .pagination a, .other-articles .pagination span, footer .top-footer, .main-content, .widget-title, .sidebar .widget, .main-content .post, footer .bottom-footer, .sidebar .widget .post,footer .top-footer .center, .single-content .author-area, #comments h3, #comments h2').attr('style', 'border-color: ' + to + ';');
			} 
		} );
	} );

	wp.customize( 'blesk_color_headings', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('h1.page-title, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .sidebar .widget .widget-title, footer .top-footer .widget .title, #comments h3, #comments h2, .single-post .entry-title, .single-post h1, .single-post h2, .single-post h3, .single-post h4, .single-post h5, .single-post h6').attr('style', 'color: ' + to + ';');
			} 
		} );
	} );

	wp.customize( 'blesk_color_miscellaneous', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('.single-post .entry-meta li i, .main-content .post .entry-content .entry-meta li i, .widget_categoryposts .entry-title a, .widget_categoryposts .entry-meta a, .single-content .sharedaddy .sd-title, .single-content .author-area .author-info .title,.sidebar .widget li a').attr('style', 'color: ' + to + ';');
				$('#comments #respond input[type=submit]').attr('style', 'background-color: ' + to + ';border-color: ' + to + ';');
				
				$('style.blesk_color_miscellaneous').remove();
				$('head').append('<style class="blesk_color_miscellaneous">footer .top-footer a:hover, .markup-format a:hover, .sidebar .widget.widget_categoryposts a:hover, .main-content .post .entry-content .entry-meta a:hover,.main-content .post .entry-content .entry-title a:hover,footer .top-footer .center .social a:hover{color: '+to+';}.sidebar .widget .widget-title:after{background-color: '+to+';}</style>');

			} 
		} );
	} );

	wp.customize( 'blesk_color_pagination_bg', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('.other-articles').attr('style', 'background-color: ' + to + ';');
			} 
		} );
	} );

	wp.customize( 'blesk_color_pagination_buttons', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('.other-articles .pagination a, .other-articles .pagination span').attr('style', 'background-color: ' + to + ';');
			} 
		} );
	} );

	wp.customize( 'blesk_color_pagination_buttons_active', function( value ) {
		value.bind( function( to ) {
			if(to.length) {
				$('style.blesk_color_pagination_buttons_active').remove();
				$('head').append('<style class="blesk_color_pagination_buttons_active">.other-articles .pagination a.current, .other-articles .pagination a:hover, .other-articles .pagination span.current, .other-articles .pagination span:hover{background-color: ' + to + ';}</style>');
			} 
		} );
	} );

} )( jQuery );