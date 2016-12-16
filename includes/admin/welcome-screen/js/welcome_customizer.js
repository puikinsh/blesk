jQuery(document).ready(function() {
    var blesk_aboutpage = bleskLiteWelcomeScreenCustomizerObject.aboutpage;
    var blesk_nr_actions_required = bleskLiteWelcomeScreenCustomizerObject.nr_actions_required;

    /* Number of required actions */
    if ((typeof blesk_aboutpage !== 'undefined') && (typeof blesk_nr_actions_required !== 'undefined') && (blesk_nr_actions_required != '0') && _wpCustomizeSettings.theme.active && _wpCustomizeSettings.theme.stylesheet == 'blesk' ) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + blesk_aboutpage + '"><span class="blesk-actions-count">' + blesk_nr_actions_required + '</span></a>');
    }

});
