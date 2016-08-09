<?php

/**
 * Function used to sanitize text, textarea, number, tel, email fields
 *
 * @param string $input
 * @return string
 */
if(!function_exists('blesk_sanitize_text')) {
	function blesk_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
}
