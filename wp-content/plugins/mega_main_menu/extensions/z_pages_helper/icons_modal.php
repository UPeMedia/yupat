<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 1.0
 */
if ( isset( $_GET[ 'mm_page' ] ) && !empty( $_GET[ 'mm_page' ] ) ) {
//	header("Content-type: text/css", true);
	if ( $_GET[ 'mm_page' ] == 'icons_list' ) {
		global $mega_main_menu;
		$current_class = $mega_main_menu;
		$input_name = ( isset( $_GET['input_name'] ) ? $_GET['input_name'] : '');
		$modal_id = ( isset( $_GET['modal_id'] ) ? $_GET['modal_id'] : '');
		$current_icon = ( isset( $_GET['current_icon'] ) ? $_GET['current_icon'] : '');
		echo mm_common::ntab(1) . '
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(\'.all_icons_search_input.'. $modal_id .'\').keyup(function(){
				setTimeout(function () {
					search_query = jQuery(\'.all_icons_search_input.'. $modal_id .'\').val();
					if ( search_query != \'\' ) {
						jQuery(\'.all_icons_container label\').css({\'display\' : \'none\'});
						jQuery(\'.all_icons_container label[for*="\' + search_query + \'"]\').css({\'display\' : \'block\'});
					} else {
						jQuery(\'.all_icons_container label\').removeAttr(\'style\');
					}
				}, 1200 );
			});
		});
	</script>';
		echo mm_common::ntab(3) . '<div class="modal-header">';
		echo mm_common::ntab(3) . '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <h4 class="modal-title">' . __( 'Select Icon', 'mega_main_menu' ) . '</h4>';
		echo mm_common::ntab(3) . '</div><!-- class="modal-header" -->';
		echo mm_common::ntab(3) . '<div class="modal-body">';
		echo mm_common::ntab(4) . '<div class="holder">';
		echo mm_common::ntab(5) . '<div class="all_icons_control_panel">';
		echo mm_common::ntab(6) . '<input type="text" class="all_icons_search_input '. $modal_id .'" placeholder="'.__( 'Search icon', 'mega_main_menu' ).'">';
		echo mm_common::ntab(6) . '<span class="ok_button btn-primary" onclick="mm_icon_selector(\'' . $input_name . '\', \'' . $modal_id . '\' );">'.__( 'OK', 'mega_main_menu' ).'</span>';
		echo mm_common::ntab(5) . '</div><!-- class="all_icons_control_panel" -->';
		echo mm_common::ntab(5) . '<div class="all_icons_container">';
		$set_of_custom_icons = $current_class->get_option( 'set_of_custom_icons', array() );
		if ( is_array( $set_of_custom_icons ) && count( $set_of_custom_icons ) >= 1 ) {
			echo mm_common::ntab(6) . '<div class="mm_clearboth"></div>';
			echo mm_common::ntab(6) . '<div class="mm_clearfix">' . __( 'Custom Icons', 'mega_main_menu' ) . '</div>';
			foreach ( $set_of_custom_icons as $value ) {
				$icon_name = str_replace( array( '/', strrchr( $value[ 'custom_icon' ], '.' ) ), '', strrchr( $value[ 'custom_icon' ], '/' ) );
				echo '<label for="ci-icon-' . $icon_name . '-' . $input_name . '"><input name="icon" id="ci-icon-' . $icon_name . '-' . $input_name . '" type="radio" value="ci-icon-' . $icon_name . '"><i class="ci-icon-' . $icon_name . '"></i></label>';
			}
		}
		$icon_sets = $current_class->get_option( 'icon_sets', array( 'icomoon' ) );
		if ( in_array( 'icomoon', $icon_sets ) ) {
			echo mm_common::ntab(6) . '<div class="mm_clearboth"></div>';
			echo mm_common::ntab(6) . '<div class="mm_clearfix">' . __( 'IcoMoon (1200)', 'mega_main_menu' ) . '</div>';
			foreach ( mm_datastore::get_list_icomoon() as $key => $value ) {
				echo '<label for="' . $value . '-' . $input_name . '"><input name="icon" id="' . $value . '-' . $input_name . '" type="radio" value="' . $value . '"' . ( ( $value ==  $current_icon ) ? ' checked="checked"' : '') . '><i class="' . $value . '"></i></label>';
			}
		}
/*
		if ( in_array( 'fontawesome', $icon_sets ) ) {
			echo '<div class="mm_clearboth"></div>';
			echo '<div class="mm_clearfix">' . __( 'FontAwesome (400)', 'mega_main_menu' ) . '</div>';
			foreach ( mm_datastore::get_list_fontawesome() as $key => $value ) {
				echo '<label for="' . $value . '-' . $input_name . '"><input name="icon" id="' . $value . '-' . $input_name . '" type="radio" value="' . $value . '"' . ( ( $value ==  $current_icon ) ? ' checked="checked"' : '') . '><i class="' . $value . '"></i></label>';
			}
		}
*/
		if ( in_array( 'glyphicons', $icon_sets ) ) {
			echo mm_common::ntab(6) . '<div class="mm_clearboth"></div>';
			echo mm_common::ntab(6) . '<div class="mm_clearfix">' . __( 'Glyphicons (200)', 'mega_main_menu' ) . '</div>';
			foreach ( mm_datastore::get_list_glyphicons() as $key => $value ) {
				echo '<label for="' . $value . '-' . $input_name . '"><input name="icon" id="' . $value . '-' . $input_name . '" type="radio" value="' . $value . '"' . ( ( $value ==  $current_icon ) ? ' checked="checked"' : '') . '><i class="' . $value . '"></i></label>';
			}
		}
		if ( in_array( 'linearicons', $icon_sets ) ) {
			echo mm_common::ntab(6) . '<div class="mm_clearboth"></div>';
			echo mm_common::ntab(6) . '<div class="mm_clearfix">' . __( 'Linearicons (170)', 'mega_main_menu' ) . '</div>';
			foreach ( mm_datastore::get_list_linearicons() as $key => $value ) {
				echo '<label for="' . $value . '-' . $input_name . '"><input name="icon" id="' . $value . '-' . $input_name . '" type="radio" value="' . $value . '"' . ( ( $value ==  $current_icon ) ? ' checked="checked"' : '') . '><i class="' . $value . '"></i></label>';
			}
		}
		if ( in_array( 'mm_fa_5_light', $icon_sets ) ) {
			echo mm_common::ntab(6) . '<div class="mm_clearboth"></div>';
			echo mm_common::ntab(6) . '<div class="mm_clearfix">' . __( 'FontAwesome Light (900)', 'mega_main_menu' ) . '</div>';
			foreach ( mm_datastore::get_list_fa_5_light() as $key => $value ) {
				echo '<label for="' . $value . '-' . $input_name . '"><input name="icon" id="' . $value . '-' . $input_name . '" type="radio" value="' . $value . '"' . ( ( $value ==  $current_icon ) ? ' checked="checked"' : '') . '><i class="' . $value . '"></i></label>';
			}
		}
		if ( in_array( 'mm_fa_5_regular', $icon_sets ) ) {
			echo mm_common::ntab(6) . '<div class="mm_clearboth"></div>';
			echo mm_common::ntab(6) . '<div class="mm_clearfix">' . __( 'FontAwesome Regular (900)', 'mega_main_menu' ) . '</div>';
			foreach ( mm_datastore::get_list_fa_5_regular() as $key => $value ) {
				echo '<label for="' . $value . '-' . $input_name . '"><input name="icon" id="' . $value . '-' . $input_name . '" type="radio" value="' . $value . '"' . ( ( $value ==  $current_icon ) ? ' checked="checked"' : '') . '><i class="' . $value . '"></i></label>';
			}
		}
		if ( in_array( 'mm_fa_5_solid', $icon_sets ) ) {
			echo mm_common::ntab(6) . '<div class="mm_clearboth"></div>';
			echo mm_common::ntab(6) . '<div class="mm_clearfix">' . __( 'FontAwesome Solid (900)', 'mega_main_menu' ) . '</div>';
			foreach ( mm_datastore::get_list_fa_5_solid() as $key => $value ) {
				echo '<label for="' . $value . '-' . $input_name . '"><input name="icon" id="' . $value . '-' . $input_name . '" type="radio" value="' . $value . '"' . ( ( $value ==  $current_icon ) ? ' checked="checked"' : '') . '><i class="' . $value . '"></i></label>';
			}
		}
		if ( in_array( 'mm_fa_5_brands', $icon_sets ) ) {
			echo mm_common::ntab(6) . '<div class="mm_clearboth"></div>';
			echo mm_common::ntab(6) . '<div class="mm_clearfix">' . __( 'FontAwesome Brands (360)', 'mega_main_menu' ) . '</div>';
			foreach ( mm_datastore::get_list_fa_5_brands() as $key => $value ) {
				echo '<label for="' . $value . '-' . $input_name . '"><input name="icon" id="' . $value . '-' . $input_name . '" type="radio" value="' . $value . '"' . ( ( $value ==  $current_icon ) ? ' checked="checked"' : '') . '><i class="' . $value . '"></i></label>';
			}
		}
		echo mm_common::ntab(6) . '<div class="mm_clearboth"></div>';
		echo mm_common::ntab(6) . '<div class="mm_clearfix">' . __( 'You can turn on more icons using', 'mega_main_menu' ) . ' ' . $current_class->constant[ 'MM_WARE_NAME' ] . ' &rarr; ' . __( 'Specific Options', 'mega_main_menu' ) . ' &rarr; ' . __( 'Use Sets Of Icons', 'mega_main_menu' ) . '. <br />' . __( 'Also you can add Custom Icons using', 'mega_main_menu' ) . ' ' . $current_class->constant[ 'MM_WARE_NAME' ] . ' &rarr; ' . __( 'Skins', 'mega_main_menu' ) . ' &rarr; ' . __( 'Custom Icons', 'mega_main_menu' ) . '.</div>';
		echo mm_common::ntab(5) . '</div><!-- class="all_icons_container" -->';
		echo mm_common::ntab(4) . '</div><!-- class="holder" -->';
		echo mm_common::ntab(3) . '</div><!-- class="modal-body" -->';
		die();
	}
}
