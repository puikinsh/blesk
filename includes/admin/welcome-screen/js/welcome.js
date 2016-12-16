jQuery(document).ready(function() {

	/* If there are required actions, add an icon with the number of required actions in the About blesk page -> Actions required tab */
    var blesk_nr_actions_required = bleskLiteWelcomeScreenObject.nr_actions_required;

    if ( (typeof blesk_nr_actions_required !== 'undefined') && (blesk_nr_actions_required != '0') ) {
        jQuery('li.blesk-w-red-tab a').append('<span class="blesk-actions-count">' + blesk_nr_actions_required + '</span>');
    }

    /* Dismiss required actions */
    jQuery(".blesk-dismiss-required-action").click(function(){

        var id= jQuery(this).attr('id');
        console.log(id);
        jQuery.ajax({
            type       : "GET",
            data       : { action: 'blesk_lite_dismiss_required_action',dismiss_id : id },
            dataType   : "html",
            url        : bleskLiteWelcomeScreenObject.ajaxurl,
            beforeSend : function(data,settings){
				jQuery('.blesk-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + bleskLiteWelcomeScreenObject.template_directory + '/inc/admin/welcome-screen/img/ajax-loader.gif" /></div>');
            },
            success    : function(data){
				jQuery("#temp_load").remove(); /* Remove loading gif */
                jQuery('#'+ data).parent().remove(); /* Remove required action box */

                var blesk_lite_actions_count = jQuery('.blesk-actions-count').text(); /* Decrease or remove the counter for required actions */
                if( typeof blesk_lite_actions_count !== 'undefined' ) {
                    if( blesk_lite_actions_count == '1' ) {
                        jQuery('.blesk-actions-count').remove();
                        jQuery('.blesk-tab-pane#actions_required').append('<p>' + bleskLiteWelcomeScreenObject.no_required_actions_text + '</p>');
                    }
                    else {
                        jQuery('.blesk-actions-count').text(parseInt(blesk_lite_actions_count) - 1);
                    }
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });

	/* Tabs in welcome page */
	function blesk_welcome_page_tabs(event) {
		jQuery(event).parent().addClass("active");
        jQuery(event).parent().siblings().removeClass("active");
        var tab = jQuery(event).attr("href");
        jQuery(".blesk-tab-pane").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
	}

	var blesk_actions_anchor = location.hash;

	if( (typeof blesk_actions_anchor !== 'undefined') && (blesk_actions_anchor != '') ) {
		blesk_welcome_page_tabs('a[href="'+ blesk_actions_anchor +'"]');
	}

    jQuery(".blesk-nav-tabs a").click(function(event) {
        event.preventDefault();
		blesk_welcome_page_tabs(this);
    });

		/* Tab Content height matches admin menu height for scrolling purpouses */
	 $tab = jQuery('.blesk-tab-content > div');
	 $admin_menu_height = jQuery('#adminmenu').height();
	 if( (typeof $tab !== 'undefined') && (typeof $admin_menu_height !== 'undefined') )
	 {
		 $newheight = $admin_menu_height - 180;
		 $tab.css('min-height',$newheight);
	 }

});
