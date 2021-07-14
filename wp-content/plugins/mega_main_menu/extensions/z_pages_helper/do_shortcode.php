<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 2.0
 */
	/* 
	 * Functions provide information about PHP configuration.
	 */
	if ( isset( $_GET[ 'mm_page' ] ) && !empty( $_GET[ 'mm_page' ] ) ) {
		if ( $_GET[ 'mm_page' ] == 'do_shortcode' ) {
			if ( isset( $_POST[ 'shortcode' ] ) ) {
				$_POST[ 'shortcode_base_name' ] = $_POST[ 'shortcode' ];
			}
			if ( isset( $_POST[ 'shortcode_base_name' ] ) ) {
//				global $mega_main_extensions;
				$shortcode_atts = $_POST;
				$shortcode_base_name = $shortcode_atts[ 'shortcode_base_name' ];
				if ( isset( $shortcode_atts[ 'content' ] ) && !empty( $shortcode_atts[ 'content' ] ) ) {
					$content = $shortcode_atts[ 'content' ];
					unset( $shortcode_atts[ 'content' ] );
				}
				$out = '';
				$out .= '[' . $shortcode_base_name;
				foreach ( $shortcode_atts as $key => $value ) {
					$out .= ' ' . $key . '="' . $value . '"';
				}
				$out .= ']';
				if ( isset( $content ) ) {
					$out .= $content;
				}
				$out .= '[/' . $shortcode_base_name . ']';
				echo do_shortcode( $out );
				die();
			}
		}
	}
