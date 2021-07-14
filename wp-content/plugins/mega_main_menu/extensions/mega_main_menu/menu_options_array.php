<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 1.0
 */
	if ( !function_exists( 'mmm_menu_options_array' ) ) {
		function mmm_menu_options_array(){
			global $mmm_menu_options_array;
			if ( isset( $mmm_menu_options_array ) && $mmm_menu_options_array !== false ) {
				$options = $mmm_menu_options_array;
			} else {
				global $mega_main_menu;
				/* Additional styles */
				$additional_styles_presets = $mega_main_menu->get_option( 'additional_styles_presets' );
				$additional_styles[ __( 'Default', 'mega_main_menu' ) ] = 'default_style';
				if ( is_array( $additional_styles_presets ) ) {
					unset( $additional_styles_presets['0'] );
					foreach ( $additional_styles_presets as $key => $value) {
						$additional_styles[ $key . '. ' . $value['style_name'] ] = 'additional_style_' . $key;
					}
				}
				/* Submenu types */
				$submenu_types = array(
					__( 'Standard Submenu', 'mega_main_menu' ) => 'default_dropdown',
					__( 'Multicolumn Submenu', 'mega_main_menu' ) => 'multicolumn_dropdown',
					__( 'Tabs Submenu', 'mega_main_menu' ) => 'tabs_dropdown',
					__( 'Grid Submenu', 'mega_main_menu' ) => 'grid_dropdown',
					__( 'Posts Grid Submenu', 'mega_main_menu' ) => 'post_type_dropdown',
					__( 'Posts List Submenu', 'mega_main_menu' ) => 'post_type_list_dropdown',
					__( 'Posts List in Multicolumn', 'mega_main_menu' ) => 'post_type_list_multicolumn_dropdown',
				);
				if ( is_callable( 'is_multisite' ) && is_callable( 'is_main_site' ) ) {
					if ( is_multisite() && is_main_site() ) {
						$submenu_types[ __( 'Posts Grid Submenu (Multisite)', 'mega_main_menu' ) ] = 'post_type_dropdown_multisite';
					}
				}

				$number_of_widgets = $mega_main_menu->get_option( 'number_of_widgets', '1' );
				if ( is_numeric( $number_of_widgets ) && $number_of_widgets > 0 ) {
					for ( $i=1; $i <= $number_of_widgets; $i++ ) { 
						$submenu_widgets[ __( 'Widgets area', 'mega_main_menu' ) . ' ' . $i ] = $mega_main_menu->constant[ 'MM_WARE_PREFIX' ] . '_menu_widgets_area_' . $i;
					}
					$submenu_types = array_merge( $submenu_types, $submenu_widgets );
				}
				/* options */
				$item_visibility_rolles = array(
					__( 'Always Visible', 'mega_main_menu' ) => 'all',
					__( 'Visible Only for Logged Users', 'mega_main_menu' ) => 'logged',
					__( 'Visible Only for Unlogged Visitors', 'mega_main_menu' ) => 'visitors',
				);
				if ( is_callable( 'get_editable_roles' ) ) {
					$editable_roles_array = get_editable_roles();
					foreach ( $editable_roles_array as $key => $value ) {
						$item_visibility_rolles[ __( 'Visible Only for', 'mega_main_menu' ) . ' ' . $value[ 'name' ] ] = $key;
					}
				}
				$options = array(
						array(
							'descr' => __( 'Description', 'mega_main_menu' ),
							'key' => 'item_descr',
							'type' => 'textarea',
							'col_width' => 3
						),
						array(
							'descr' => __( 'Style of This Item', 'mega_main_menu' ),
							'key' => 'item_style',
							'type' => 'select',
							'values' => $additional_styles,
							'default' => 'default',
						),
						array(
							'descr' => __( 'Visibility Control', 'mega_main_menu' ),
							'key' => 'item_visibility',
							'type' => 'select',
							'values' => $item_visibility_rolles,
						),
						array(
							'descr' => __( 'Icon of This Item (set empty to hide)', 'mega_main_menu' ),
							'key' => 'item_icon',
							'type' => 'icons',
						),
						array(
							'key' => 'disable_text',
							'type' => 'checkbox',
							'values' => array(
								__( 'Hide Text of This Item', 'mega_main_menu' ) => 'true',
							),
						),
						array(
							'key' => 'disable_link',
							'type' => 'checkbox',
							'values' => array(
								__( 'Disable Link', 'mega_main_menu' ) => 'true',
							),
						),
						array(
							'key' => 'pull_to_other_side',
							'type' => 'checkbox',
							'values' => array(
								__( 'Pull to the Other Side', 'mega_main_menu' ) => 'true',
							),
						),
						array(
							'name' => __( 'Options of Dropdown', 'mega_main_menu' ),
							'descr' => __( 'Submenu Type', 'mega_main_menu' ),
							'key' => 'submenu_type',
							'type' => 'select',
							'values' => $submenu_types,
/*
							'dependency' => array(
								'element' =>'submenu_post_type',
								'value' => 'post_type_dropdown',
							),
*/
					   ),
						array(
							'key' => 'submenu_post_type',
							'descr' => __( 'Post Type for Display in Dropdown', 'mega_main_menu' ),
							'type' => 'select',
							'values' => mm_common::get_all_taxonomies(),
							'dependency' => array(
								'element' => 'menu-item-submenu_type[__ID__]', 
								'value' => array(
									'post_type_dropdown',
									'post_type_list_dropdown',
									'post_type_list_multicolumn_dropdown',
								),
							),
						),
						array(
							'key' => 'submenu_drops_side',
							'descr' => __( 'Side of Dropdown Area', 'mega_main_menu' ),
							'type' => 'select',
							'values' => array(
								__( 'Drop To Right Side', 'mega_main_menu' ) => 'drop_to_right',
								__( 'Drop To Left Side', 'mega_main_menu' ) => 'drop_to_left',
								__( 'Drop To Center', 'mega_main_menu' ) => 'drop_to_center',
							),
						),
						array(
							'descr' => __( 'Submenu Columns (Not For Standard Drops)', 'mega_main_menu' ),
							'key' => 'submenu_columns',
							'type' => 'select',
							'values' => range(1, 10),
						),
						array(
							'key' => 'submenu_enable_full_width',
							'type' => 'checkbox',
							'values' => array(
								__( 'Enable Full Width Dropdown (only for horizontal menu)', 'mega_main_menu' ) => 'true',
							),
						),
						array(
							'name' => __( 'Dropdown Background Image', 'mega_main_menu' ),
							'descr' => '',
							'key' => 'submenu_bg_image',
							'type' => 'background_image',
							'default' => '',
						),
				);
				$GLOBALS['mmm_menu_options_array'] = $options;
			}
			return $options;
		}
	}
