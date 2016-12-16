<?php

if(!function_exists('blesk_sanitize_section_order')) {
	function blesk_sanitize_section_order( $input ) {
		$values = array_keys( blesk_home_sections() );

		$value = sanitize_text_field($input);

		if ( in_array($value, $values) ) {
			return $value;
		}else{
			return $values[0];
		}
	}
}

if(!function_exists('blesk_sanitize_icon_select')) {
	function blesk_sanitize_icon_select( $input ) {
		$values = blesk_get_fontawesome_icons();

		$value = sanitize_text_field($input);

		if ( in_array($value, $values) ) {
			return $value;
		}else{
			return $values[0];
		}
	}
}

if(!function_exists('blesk_sanitize_category_select')) {
	function blesk_sanitize_category_select( $input ) {
		$value = absint($input);

		$category = get_the_category_by_ID($value);

		if ( $category ) {
			return $value;
		}else{
			return 0;
		}
	}
}
