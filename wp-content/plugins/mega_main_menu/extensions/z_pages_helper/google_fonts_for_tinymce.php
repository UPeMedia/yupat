<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 1.0
 */

// Necessary filter to make following class works
add_filter( 'tiny_mce_before_init', array( 'mm_tiny_mce_extension', 'add_google_fonts_to_tiny_mce' ) );
add_filter( 'tiny_mce_before_init', array( 'mm_tiny_mce_extension', 'add_font_sizes_to_tiny_mce' ) );
add_filter( 'mce_buttons_2', array( 'mm_tiny_mce_extension', 'add_tiny_mce_buttons_2' ) );

/**
 * Class to add necessagy buttons to Tiny MCE (WYSIWYG) editor.
 */
if ( !class_exists( 'mm_tiny_mce_extension' ) ) {
	class mm_tiny_mce_extension
	{

		/*
		 * Method to add font family options to Tiny MCE 'fontselect' button.
		 */
		public static function add_google_fonts_to_tiny_mce ( $atts ) {
			global $mega_main_menu;
			$current_class = $mega_main_menu;
			$set_of_google_fonts = $current_class->get_option( 'set_of_google_fonts', array() );
			if ( isset( $set_of_google_fonts ) && is_array( $set_of_google_fonts ) && ( count( $set_of_google_fonts ) > 0 ) ) {
				if ( !isset( $atts[ 'font_formats' ] ) ) {
					$atts[ 'font_formats' ] = '';
				}
				$atts[ 'font_formats' ] .= 'inherit (Default)=inherit;';
				foreach ( $set_of_google_fonts as $key => $value ) {
					$atts[ 'font_formats' ] .= $value['family'] . '=' . $value['family'] . ';';
				}
				$atts[ 'font_formats' ] .= 'serif=serif; sans-serif=sans-serif; cursive=cursive; fantasy=fantasy; monospace=monospace; Arial=Arial; Courier New=Courier New; Helvetica=Helvetica; Tahoma=Tahoma; Times New Roman=Times New Roman; Verdana=Verdana;';
			}
			return $atts;
		}

		/*
		 * Method to add font size options to Tiny MCE 'fontsizeselect' button.
		 */
		public static function add_font_sizes_to_tiny_mce ( $atts ) {
			if ( !isset( $atts[ 'fontsize_formats' ] ) ) {
				$atts[ 'fontsize_formats' ] = '';
			}
			$atts[ 'fontsize_formats' ] .= 'inherit 4px 6px 8px 10px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px 38px 40px 42px 44px 46px 48px 50px 52px 54px 56px 58px 60px 62px 64px 66px 68px 70px 72px 100px 150px 200px';
			return $atts;
		}

		/*
		 * Method to show (unlock) additional buttons in Tiny MCE (WYSIWYG) editor.
		 */
		public static function add_tiny_mce_buttons_2 ( $atts ) {
	        array_unshift( $atts, 'fontsizeselect' ); // Add Font Size Select
	        array_unshift( $atts, 'fontselect' ); // Add Font Select
	        return $atts;
		}

	} // class mm_tiny_mce_extension
} // if class_exists
