<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 1.0
 */
	if ( !function_exists( 'mega_main_menu__array_theme_options' ) ) {
		function mega_main_menu__array_theme_options( $constants ){
			// get menu locations from get_registered_nav_menus();
			$theme_menu_locations = array();
			if ( function_exists( 'get_registered_nav_menus' ) ) {
				foreach ( get_registered_nav_menus() as $key => $value ){
					$key = str_replace( ' ', '-', $key );
					$theme_menu_locations[ $key ] = $key;
				}
			}
			// get menu locations from get_nav_menu_locations();
			if ( function_exists( 'get_nav_menu_locations' ) ) {
				foreach ( get_nav_menu_locations() as $key => $value ){
					$key = str_replace( ' ', '-', $key );
					$theme_menu_locations[ $key ] = $key;
				}
			}
			// Start creation array with locations_options.
			$locations_options = array(
				array(
					'name' => __( 'Below are all the locations, which are supported by this theme. Toggle to change their settings.', 'mega_main_menu' ),
					'key' => 'primary_settings',
					'type' => 'caption',
				),
			);
			if ( isset( $theme_menu_locations ) && is_array( $theme_menu_locations ) ) {
				$locations_options[] = array(
					'name' => __( 'Activate Mega Main Menu in the following locations:', 'mega_main_menu' ),
					'descr' => __( 'Mega Main Menu and its settings will be displayed in selected locations only after the activation of this location.', 'mega_main_menu' ),
					'key' => 'mega_menu_locations',
					'type' => 'checkbox',
					'values' => $theme_menu_locations,
					'default' => array( 'mega_main_sidebar_menu', ),
				);
			} else {
				$locations_options[] = array(
					'name' => __( 'Firstly, You need to create at least one menu', 'mega_main_menu' ) . ' (<a href="' . home_url() . '/wp-admin/nav-menus.php">' . __( 'Theme Menu Settings', 'mega_main_menu' ) . '</a>) ' . __( 'and set theme-location for it', 'mega_main_menu' ) . ' (<a href="' . home_url() . '/wp-admin/nav-menus.php?action=locations">' . __( 'Theme Menu Locations', 'mega_main_menu' ) . '</a>).',
					'key' => 'no_locations',
					'type' => 'caption',
				);
			}

			foreach ( $theme_menu_locations as $key => $value ){
				// General layout options 
				$original_menu_slug = $key;
				$key = str_replace( ' ', '-', $key );
				// temporary patch for 2.1.7 in order to transfer logo settings from previous versions.
				global $mega_main_menu;
				$default_logo_src = $mega_main_menu->get_option( 'logo_src', $constants[ 'MM_WARE_URL' ] . 'framework/src/img/megamain-logo-120x120.png' );
				$default_logo_height = $mega_main_menu->get_option( 'logo_height', '90' );
				$default_logo_positions = array( 'desktop', 'sticky', 'mobile', );
				if ( is_array( $mega_main_menu->get_option( $key . '_included_components' ) ) ) {
					if ( !in_array( 'company_logo', $mega_main_menu->get_option( $key . '_included_components' ) ) ) {
						$default_logo_positions = '';
					}
				}
				// END temporary patch for 2.1.7
				$locations_options = array_merge( 
					$locations_options, array(
						array(
							'name' => __( 'Layout Options:', 'mega_main_menu' ) . ' &nbsp; <strong>' . $key . '</strong>',
							'key' => $key . '_menu_options',
							'type' => 'collapse_start',
						),
						array(
							'name' => __( 'Add to Mega Main Menu:', 'mega_main_menu' ),
							'descr' => __( 'You can add searchbox and/or other elements to the primary menu.', 'mega_main_menu' ),
							'key' => $key . '_included_components',
							'type' => 'checkbox',
							'values' => array(
								__( 'Search Box', 'mega_main_menu' ) => 'search_box',
								__( 'BuddyPress Bar', 'mega_main_menu' ) => 'buddypress',
								__( 'WooCart', 'mega_main_menu' ) => 'woo_cart',
								__( 'WPML switcher', 'mega_main_menu' ) => 'wpml_switcher',
							),
							'default' => array( 'search_box', 'buddypress', 'woo_cart', 'wpml_switcher', ),
						),
						array(
							'name' => __( 'Height of the first level items', 'mega_main_menu' ),
							'descr' => __( 'Set the height for the initial menu container.', 'mega_main_menu' ),
							'key' => $key . '_first_level_item_height',
							'type' => 'number',
							'min' => 20,
							'max' => 300,
							'units' => 'px',
							'values' => '50',
							'default' => '50',
						),
						array(
							'name' => __( 'Primary Style', 'mega_main_menu' ),
							'descr' => __( 'Select the button style that fits the style of your site.', 'mega_main_menu' ),
							'key' => $key . '_primary_style',
							'type' => 'radio',
							'col_width' => 4,
							'values' => array(
								__( 'Flat', 'mega_main_menu' ) => 'flat',
								__( 'Buttons', 'mega_main_menu' ) . ' <small>' . __( '(+1 option)', 'mega_main_menu' ) . '</small>' => 'buttons',
							),
							'default' => array( 'flat', ),
						),
						array(
							'name' => __( 'Buttons Height', 'mega_main_menu' ),
							'descr' => __( 'Specify the height of the first level buttons. Notice: for "Buttons" style ONLY.', 'mega_main_menu' ),
							'key' => $key . '_first_level_button_height',
							'type' => 'number',
							'min' => 20,
							'max' => 300,
							'units' => 'px',
							'values' => '30',
							'default' => '30',
							'dependency' => array(
								'element' => 'mega_main_menu_options[' . $key . '_primary_style]', 
								'value' => array(
									'buttons',
								),
							),
						),
						array(
							'name' => __( 'The logo file', 'mega_main_menu' ),
							'descr' => __( "Select image to be used as logo in Main Mega Menu. It's recommended to use image with transparent background (.PNG) and sizes from 200 to 800 px.", 'mega_main_menu' ),
							'key' => $key . '_logo_src',
							'type' => 'file',
							'default' => $default_logo_src,
						),
						array(
							'name' => __( 'Maximum logo height', 'mega_main_menu' ),
							'descr' => __( 'Maximum logo height (in terms of percentage) in comparison to the height of the initial container.', 'mega_main_menu' ),
							'key' => $key . '_logo_height',
							'min' => 10,
							'max' => 100,
							'units' => '%',
							'type' => 'number',
							'default' => $default_logo_height,
						),
						array(
							'name' => __( 'Logo positions', 'mega_main_menu' ),
							'descr' => __( 'Please select the situations when you want to display logo for this menu.', 'mega_main_menu' ),
							'key' => $key . '_logo_positions',
							'type' => 'checkbox',
							'values' => array(
								__( 'Desktop (non-sticky)', 'mega_main_menu' ) => 'desktop',
								__( 'Sticky', 'mega_main_menu' ) => 'sticky',
								__( 'Mobile', 'mega_main_menu' ) => 'mobile',
							),
							'default' => $default_logo_positions,
						),
						array(
							'name' => __( 'Logo link', 'mega_main_menu' ),
							'descr' => __( 'Enter a valid value that can be used as "href" attribute for the link from the logo. Leave blank to use the default WordPress homepage URL.', 'mega_main_menu' ),
							'key' => $key . '_logo_link',
							'type' => 'text',
							'default' => '',
						),
						array(
							'name' => __( 'Alignment of the first level items', 'mega_main_menu' ),
							'descr' => __( 'Choose how to align menu elements of the first level.', 'mega_main_menu' ),
							'key' => $key . '_first_level_item_align',
							'type' => 'radio',
							'col_width' => 4,
							'values' => array(
								__( 'Left', 'mega_main_menu' ) => 'left',
								__( 'Center', 'mega_main_menu' ) => 'center',
								__( 'Right', 'mega_main_menu' ) => 'right',
								__( 'Justify (No Logo!)', 'mega_main_menu' ) => 'justify',
							),
							'default' => array( 'left', ),
						),
						array(
							'name' => __( 'Location of icons in first level elements', 'mega_main_menu' ),
							'descr' => __( 'Choose where to place icons for first level items.', 'mega_main_menu' ),
							'key' => $key . '_first_level_icons_position',
							'type' => 'radio',
							'col_width' => 4,
							'values' => array(
								__( 'Left', 'mega_main_menu' ) => 'left',
								__( 'Above', 'mega_main_menu' ) => 'top',
								__( 'Right', 'mega_main_menu' ) => 'right',
								__( 'Disable Icons In First Level Items', 'mega_main_menu' ) => 'disable_first_lvl',
								__( 'Disable Icons Globally', 'mega_main_menu' ) => 'disable_globally',
							),
							'default' => array( 'left', ),
						),
						array(
							'name' => __( 'Separator', 'mega_main_menu' ),
							'descr' => __( 'Select type of separator between the first level items of this menu.', 'mega_main_menu' ),
							'key' => $key . '_first_level_separator',
							'type' => 'radio',
							'col_width' => 4,
							'values' => array(
								__( 'None', 'mega_main_menu' ) => 'none',
								__( 'Smooth', 'mega_main_menu' ) => 'smooth',
								__( 'Sharp', 'mega_main_menu' ) => 'sharp',
							),
							'default' => array( 'smooth', ),
						),
						array(
							'name' => __( 'Rounded corners', 'mega_main_menu' ),
							'descr' => __( 'Select the radius value of corners.', 'mega_main_menu' ),
							'key' => $key . '_corners_rounding',
							'type' => 'number',
							'min' => 0,
							'max' => 100,
							'units' => 'px',
							'default' => 0,
						),
						array(
							'name' => __( 'Trigger', 'mega_main_menu' ),
							'descr' => __( 'Show dropdowns by "hover" or "click"?', 'mega_main_menu' ),
							'key' => $key . '_dropdowns_trigger',
							'type' => 'radio',
							'col_width' => 4,
							'values' => array(
								__( 'Hover', 'mega_main_menu' ) => 'hover',
								__( 'Click', 'mega_main_menu' ) => 'click',
							),
							'default' => array( 'hover', ),
						),
						array(
							'name' => __( 'Dropdowns Animation', 'mega_main_menu' ),
							'descr' => __( 'Select the type of animation for displaying dropdowns.', 'mega_main_menu' ) . ' <span style="color: #f11;">' . __( 'Warning', 'mega_main_menu' ) . ':</span> ' . __( 'Animation works correctly only in the latest versions of progressive browsers.', 'mega_main_menu' ),
							'key' => $key . '_dropdowns_animation',
							'type' => 'select',
							'values' => array(
								__( 'None', 'mega_main_menu' ) => 'none',
								__( 'Unfold', 'mega_main_menu' ) => 'anim_1',
								__( 'Fading', 'mega_main_menu' ) => 'anim_2',
								__( 'Scale', 'mega_main_menu' ) => 'anim_3',
								__( 'Down to Up', 'mega_main_menu' ) => 'anim_4',
								__( 'Dropdown', 'mega_main_menu' ) => 'anim_5',
							),
							'default' => array( 'none', ),
						),
						array(
							'name' => __( 'Minimized on Mobile Devices', 'mega_main_menu' ),
							'descr' => __( 'If this option is activated you get the collapsed menu on mobile devices.', 'mega_main_menu' ),
							'key' => $key . '_mobile_minimized',
							'type' => 'checkbox',
							'values' => array(
								__( 'Enable', 'mega_main_menu' ) => 'true',
							),
							'default' => array( 'true', ),
						),
						array(
							'name' => __( 'Label for Mobile Menu', 'mega_main_menu' ),
							'descr' => __( 'Here you can specify a label that will be displayed on the mobile version of the menu.', 'mega_main_menu' ),
							'key' => $key . '_mobile_label',
							'type' => 'text',
							'values' => '',
							'default' => __( 'Menu', 'mega_main_menu' ),
							'dependency' => array(
								'element' => 'mega_main_menu_options[' . $key . '_mobile_minimized]', 
								'value' => array(
									'true',
								),
							),
						),
						array(
							'name' => __( 'Direction', 'mega_main_menu' ),
							'descr' => __( 'Here you can determine the direction of the menu. Horizontal for classic top menu bar. Vertical for sidebar menu.', 'mega_main_menu' ),
							'key' => $key . '_direction',
							'type' => 'radio',
							'col_width' => 4,
							'values' => array(
								__( 'Horizontal', 'mega_main_menu' ) .' <small>' . __( '(+5 option)', 'mega_main_menu' ) . '</small>' => 'horizontal',
								__( 'Vertical', 'mega_main_menu' ) => 'vertical',
							),
							'default' => array( 'horizontal' ),
						),
						array(
							'name' => __( 'Full Width Initial Container', 'mega_main_menu' ),
							'descr' => __( 'If this option is enabled then the primary container will try to be the full width.', 'mega_main_menu' ),
							'key' => $key . '_fullwidth_container',
							'type' => 'checkbox',
							'values' => array(
								__( 'Enable', 'mega_main_menu' ) => 'true',
							),
							'dependency' => array(
								'element' => 'mega_main_menu_options[' . $key . '_direction]', 
								'value' => array(
									'horizontal',
								),
							),
						),
						array(
							'name' => __( 'Height of the first level items when menu is Sticky (or Mobile)', 'mega_main_menu' ),
							'descr' => __( 'Set the height for the initial menu container.', 'mega_main_menu' ),
							'key' => $key . '_first_level_item_height_sticky',
							'type' => 'number',
							'min' => 20,
							'max' => 300,
							'units' => 'px',
							'values' => '40',
							'default' => '40',
							'dependency' => array(
								'element' => 'mega_main_menu_options[' . $key . '_direction]', 
								'value' => array(
									'horizontal',
								),
							),
						),
						array(
							'name' => __( 'Sticky', 'mega_main_menu' ),
							'descr' => __( 'Check this option to make the menu sticky. Make sure you have disabled "Sticky" in the theme options. Incompatible with the "Vertical" menu. Sticky does not work on mobile devices. If the menu will be sticky on mobile devices when you open it - you will not be able to click on the last item, because it will always be outside the screen.', 'mega_main_menu' ),
							'key' => $key . '_sticky_status',
							'type' => 'checkbox',
							'values' => array(
								__( 'Enable', 'mega_main_menu' ) => 'true',
							),
							'dependency' => array(
								'element' => 'mega_main_menu_options[' . $key . '_direction]', 
								'value' => array(
									'horizontal',
								),
							),
						),
						array(
							'name' => __( 'Sticky scroll offset', 'mega_main_menu' ),
							'descr' => __( 'Set the length of the scroll for each user to pass before the menu will stick to the top of the window.', 'mega_main_menu' ),
							'key' => $key . '_sticky_offset',
							'type' => 'number',
							'min' => 0,
							'max' => 2000,
							'units' => 'px',
							'default' => 340,
							'dependency' => array(
								'element' => 'mega_main_menu_options[' . $key . '_direction]', 
								'value' => array(
									'horizontal',
								),
							),
						),
						array(
							'name' => __( 'Push Content Down', 'mega_main_menu' ),
							'descr' => __( 'Dropdown areas pushes the main website content down instead to dropping down over content. This option will be useful only for "Multi column" and "Full width" dropdowns.', 'mega_main_menu' ),
							'key' => $key . '_pushing_content',
							'type' => 'checkbox',
							'values' => array(
								__( 'Enable', 'mega_main_menu' ) => 'true',
							),
							'dependency' => array(
								'element' => 'mega_main_menu_options[' . $key . '_direction]', 
								'value' => array(
									'horizontal',
								),
							),
						),
						array(
							'name' => __( 'Shortcode', 'mega_main_menu' ),
							'descr' => __( 'You can copy this code and use in the content of the page in order to display this menu. Do not forget to activate mega menu for this location, using the option at the beginning of this page.', 'mega_main_menu' ),
							'key' => 'shortcode_integration',
							'type' => 'just_html',
							'default' => '<pre>[mega_main_menu location="' . $key . '"][/mega_main_menu]</pre>',
						),
						array(
							'name' => __( 'Forced PHP Integration', 'mega_main_menu' ),
							'descr' => __( 'If you have knowledge of PHP you can call this function anywhere in order to display this menu. Please use it only if you are a professional.', 'mega_main_menu' ),
							'key' => 'forced_integration',
							'type' => 'just_html',
							'default' => '<pre>&lt;?php echo wp_nav_menu( array( "theme_location" => "' . $key . '" ) ); ?&gt;</pre>',
						),
						array(
							'name' => '',
							'type' => 'collapse_end',
						),
					) // 'options' => array
				);
			};

/*
			$locations_options = array_merge( 
				$locations_options, array(
					array(
						'name' => __( 'Logo Settings', 'mega_main_menu' ),
						'key' => 'mega_menu_logo',
						'type' => 'caption',
					),
				) // 'options' => array
			);
*/

			// Start creation array with skins_options.
			$skins_options = array(
				array(
					'name' => __( 'You can change any properties for any menu location', 'mega_main_menu' ),
					'key' => 'mega_menu_skins',
					'type' => 'caption',
				)
			);
			// creation the list of available predefined skins.
			$predefined_skin_list = array();
			if ( method_exists( 'mm_datastore', 'get_list_of_skins' ) ) {
				$list_of_skins = mm_datastore::get_list_of_skins();
				foreach ( $list_of_skins as $key => $value ) {
					$predefined_skin_list[ '<div style="background-color:' . $value[ 'primary_theme_color' ] . '; color:' . $value[ 'primary_theme_contrast_color' ] . ';" class="skin_color_box">' . $value[ 'name' ] . '</div>' ] = $key;
				}
			}
			foreach ( $theme_menu_locations as $key => $value ){
				$key = str_replace( ' ', '-', $key );
				$skins_options = array_merge( 
					$skins_options, array(
						array(
							'name' => __( 'Skin Options:', 'mega_main_menu' ) . ' &nbsp; <strong>' . $key . '</strong>',
							'key' => $key . '_menu_skin',
							'type' => 'collapse_start',
						),
						array(
							'name' => __( 'Skin', 'mega_main_menu' ),
							'descr' => __( 'You can select a skin and only customize the options below that you want to change.', 'mega_main_menu' ),
							'key' => $key . '_predefined_skin',
							'type' => 'radio_html',
							'col_width' => 2,
							'values' => $predefined_skin_list,
							'default' => array( 'mega_main_blue', ),
						),
						array(
							'name' => __( 'Initial Container', 'mega_main_menu' ),
							'key' => 'dropdowns_skin_options',
							'type' => 'caption',
						),
						array(
							'name' => __( 'Background Gradient (Color) of the primary container', 'mega_main_menu' ),
							'key' => $key . '_menu_bg_gradient',
							'type' => 'gradient',
							'default' => array( 'color1' => '', 'color2' => '', 'start' => '0', 'end' => '100', 'orientation' => 'top' ),
						),
						array(
							'name' => __( 'Background image of the primary container', 'mega_main_menu' ),
							'descr' => __( 'You can choose and tune the background image of the primary container.', 'mega_main_menu' ),
							'key' => $key . '_menu_bg_image',
							'type' => 'background_image',
							'default' => '',
						),
						array(
							'name' => __( 'First Level Items', 'mega_main_menu' ),
							'key' => 'dropdowns_skin_options',
							'type' => 'caption',
						),
						array(
							'name' => __( 'Font of the First Level Item', 'mega_main_menu' ),
							'descr' => __( 'You can change size and weight of the font for first level items.', 'mega_main_menu' ),
							'key' => $key . '_menu_first_level_link_font',
							'type' => 'font',
							'values' => array( 'font_family', 'font_size', 'font_weight', 'text_transform' ),
							'default' => array( 'font_family' => 'Inherit', 'font_size' => '13', 'font_weight' => '400', 'text_transform' => 'none' ),
						),
						array(
							'name' => __( 'Text color of the first level item', 'mega_main_menu' ),
							'key' => $key . '_menu_first_level_link_color',
							'type' => 'color',
							'default' => '',
						),
						array(
							'name' => __( 'Icons in the first level item', 'mega_main_menu' ),
							'key' => $key . '_menu_first_level_icon_font',
/*
							'type' => 'font',
							'values' => array( 'font_size', ),
							'default' => array( 'font_size' => '15', ),
*/
							'type' => 'number',
							'col_width' => 3,
							'min' => 0,
							'max' => 200,
							'units' => 'px',
							'values' => '15',
							'default' => '15',
						),
						array(
							'name' => __( 'Background Gradient (Color) of the first level item', 'mega_main_menu' ),
							'key' => $key . '_menu_first_level_link_bg',
							'type' => 'gradient',
							'default' => array( 'color1' => '', 'color2' => '', 'start' => '0', 'end' => '100', 'orientation' => 'top' ),
						),
						array(
							'name' => __( 'Text color of the active first level item', 'mega_main_menu' ),
							'key' => $key . '_menu_first_level_link_color_hover',
							'type' => 'color',
							'default' => '',
						),
						array(
							'name' => __( 'Background Gradient (Color) of the active first level item', 'mega_main_menu' ),
							'key' => $key . '_menu_first_level_link_bg_hover',
							'type' => 'gradient',
							'default' => array( 'color1' => '', 'color2' => '', 'start' => '0', 'end' => '100', 'orientation' => 'top' ),
						),
						array(
							'name' => __( 'Background color of the Search Box', 'mega_main_menu' ),
							'key' => $key . '_menu_search_bg',
							'type' => 'color',
							'default' => '',
						),
						array(
							'name' => __( 'Text and icon color of the Search Box', 'mega_main_menu' ),
							'key' => $key . '_menu_search_color',
							'type' => 'color',
							'default' => '',
						),
						array(
							'name' => __( 'Dropdowns', 'mega_main_menu' ),
							'key' => 'dropdowns_skin_options',
							'type' => 'caption',
						),
						array(
							'name' => __( 'Background Gradient (Color) of the Dropdown Area', 'mega_main_menu' ),
							'key' => $key . '_menu_dropdown_wrapper_gradient',
							'type' => 'gradient',
							'default' => array( 'color1' => '#ffffff', 'color2' => '#ffffff', 'start' => '0', 'end' => '100', 'orientation' => 'top' ),
						),
						array(
							'name' => __( 'Font of the dropdown menu item', 'mega_main_menu' ),
							'key' => $key . '_menu_dropdown_link_font',
							'type' => 'font',
							'values' => array( 'font_family', 'font_size', 'font_weight', 'text_transform' ),
							'default' => array( 'font_family' => 'Inherit', 'font_size' => '12', 'font_weight' => '400', 'text_transform' => 'none' ),
						),
						array(
							'name' => __( 'Text color of the dropdown menu item', 'mega_main_menu' ),
							'key' => $key . '_menu_dropdown_link_color',
							'type' => 'color',
							'default' => '',
						),
						array(
							'name' => __( 'Icons of the dropdown menu item', 'mega_main_menu' ),
							'key' => $key . '_menu_dropdown_icon_font',
/*
							'type' => 'font',
							'values' => array( 'font_size', ),
							'default' => array( 'font_size' => '12', ),
*/
							'type' => 'number',
							'col_width' => 3,
							'min' => 0,
							'max' => 200,
							'units' => 'px',
							'values' => '12',
							'default' => '12',
						),
						array(
							'name' => __( 'Background Gradient (Color) of the dropdown menu item', 'mega_main_menu' ),
							'key' => $key . '_menu_dropdown_link_bg',
							'type' => 'gradient',
							'default' => array( 'color1' => '', 'color2' => '', 'start' => '0', 'end' => '100', 'orientation' => 'top' ),
						),
						array(
							'name' => __( 'Border color between dropdown menu items', 'mega_main_menu' ),
							'key' => $key . '_menu_dropdown_link_border_color',
							'type' => 'color',
							'default' => '#f0f0f0',
						),
						array(
							'name' => __( 'Text color of the dropdown active menu item', 'mega_main_menu' ),
							'key' => $key . '_menu_dropdown_link_color_hover',
							'type' => 'color',
							'default' => '',
						),
						array(
							'name' => __( 'Background Gradient (Color) of the dropdown active menu item', 'mega_main_menu' ),
							'key' => $key . '_menu_dropdown_link_bg_hover',
							'type' => 'gradient',
							'default' => array( 'color1' => '', 'color2' => '', 'start' => '0', 'end' => '100', 'orientation' => 'top' ),
						),
						array(
							'name' => __( 'Plain Text Color of the Dropdown', 'mega_main_menu' ),
							'key' => $key . '_menu_dropdown_plain_text_color',
							'type' => 'color',
							'default' => '#333333',
						),
						array(
							'name' => '',
							'type' => 'collapse_end',
						),
					) // 'options' => array
				);
			};
			$googlefonts_list = array();
			if ( method_exists( 'mm_datastore', 'get_googlefonts_list' ) ) {
				$googlefonts_list = mm_datastore::get_googlefonts_list();
			}
			$skins_options = array_merge( 
				$skins_options, array(
					array(
						'name' => __( 'Set of Installed Google Fonts', 'mega_main_menu' ),
						'descr' => __( 'Select the fonts to be included on the site. Remember that each additional font increases the time of page loading. Always remove unnecessary fonts. You can see Font faces on this page -', 'mega_main_menu' ) . ' <a href="https://fonts.google.com/" target="_blank">Google fonts</a>',
						'key' => 'set_of_google_fonts',
						'type' => 'multiplier',
						'default' => '0',
						'values' => array(
							array(
								'name' => __( 'Font 1', 'mega_main_menu' ),
								'key' => 'font_item',
								'type' => 'collapse_start',
							),
							array(
								'name' => __( 'Fonts Faily', 'mega_main_menu' ),
								'key' => 'family',
								'type' => 'select',
								'values' => $googlefonts_list,
								'default' => 'Open Sans'
							),
							array(
								'name' => '',
								'key' => 'font_item',
								'type' => 'collapse_end',
							),
						),
					),
					array(
						'name' => __( 'Custom Icons', 'mega_main_menu' ),
						'descr' => __( 'You can add custom raster icons. After saving these settings, icons will become available in a modal window of icon selection. Recommended size 64x64 pixels.', 'mega_main_menu' ),
						'key' => 'set_of_custom_icons',
						'type' => 'multiplier',
						'default' => '1',
						'values' => array(
							array(
								'name' => __( 'Custom Icon 1', 'mega_main_menu' ),
								'key' => 'icon_item',
								'type' => 'collapse_start',
							),
							array(
								'name' => __( 'Icon File', 'mega_main_menu' ),
								'key' => 'custom_icon',
								'type' => 'file',
								'default' => $constants[ 'MM_WARE_URL' ] . 'framework/src/img/megamain-logo-120x120.png',
							),
							array(
								'name' => __( 'Icon File on Hover', 'mega_main_menu' ),
								'descr' => __( 'Keep empty to use regular for both.', 'mega_main_menu' ),
								'key' => 'custom_icon_hover',
								'type' => 'file',
								'default' => '',
							),
							array(
								'name' => '',
								'key' => 'icon_item',
								'type' => 'collapse_end',
							),
						),
					),
					array(
						'name' => __( 'Additional Styles:', 'mega_main_menu' ),
						'descr' => __( 'Here you can add and edit highlighting styles. After that you can select these styles for menu items in "Appearance -> Menus -> Your Menu Item -> Style of This Item" option.', 'mega_main_menu' )	,
						'key' => 'additional_styles_presets',
						'type' => 'multiplier',
						'default' => '0',
						'values' => array(
							array(
								'name' => __( 'Style 1', 'mega_main_menu' ),
								'key' => 'additional_style_item',
								'type' => 'collapse_start',
							),
							array(
								'name' => __( 'Style Name', 'mega_main_menu' ),
								'key' => 'style_name',
								'type' => 'textfield',
								'default' => 'My Highlight Style'
							),
							array(
								'name' => __( 'Font', 'mega_main_menu' ),
								'key' => 'font',
								'type' => 'font',
								'values' => array( 'font_family', 'font_size', 'font_weight', 'text_transform' ),
								'default' => array( 'font_family' => 'Inherit', 'font_size' => '12', 'font_weight' => '400', 'text_transform' => 'none' ),
							),
							array(
								'name' => __( 'Icon Size', 'mega_main_menu' ),
								'key' => 'icon',
								'type' => 'font',
								'values' => array( 'font_size', ),
								'default' => array( 'font_size' => '12', ),
							),
							array(
								'name' => __( 'Text color', 'mega_main_menu' ),
								'key' => 'text_color',
								'type' => 'color',
								'default' => '#f8f8f8',
							),
							array(
								'name' => __( 'Background Gradient (Color)', 'mega_main_menu' ),
								'key' => 'bg_gradient',
								'type' => 'gradient',
								'default' => array( 'color1' => '#34495E', 'color2' => '#2C3E50', 'start' => '0', 'end' => '100', 'orientation' => 'top' ),
							),
							array(
								'name' => __( 'Text color of the active item', 'mega_main_menu' ),
								'key' => 'text_color_hover',
								'type' => 'color',
								'default' => '#f8f8f8',
							),
							array(
								'name' => __( 'Background Gradient (Color) of the active item', 'mega_main_menu' ),
								'key' => 'bg_gradient_hover',
								'type' => 'gradient',
								'default' => array( 'color1' => '#3d566e', 'color2' => '#354b60', 'start' => '0', 'end' => '100', 'orientation' => 'top' ),
							),
							array(
								'name' => '',
								'key' => 'additional_style_item',
								'type' => 'collapse_end',
							),
						),
					),
				)
			);

			// Put together all arrays of options.
			return array(
				array(
					'title' => __( 'General', 'mega_main_menu' ),
					'key' => 'mm_general',
					'icon' => 'im-icon-wrench-3',
					'options' => $locations_options,
				),
				array(
					'title' => __( 'Skins', 'mega_main_menu' ),
					'key' => 'mm_skins',
					'icon' => 'im-icon-brush',
					'options' => $skins_options, // 'options' => array
				),
				array(
					'title' => __( 'Specific Options', 'mega_main_menu' ),
					'key' => 'mm_specific_options',
					'icon' => 'im-icon-hammer',
					'options' => array(
						array(
							'name' => __( 'Custom CSS', 'mega_main_menu' ),
							'descr' => __( 'You can place here any necessary custom CSS properties.', 'mega_main_menu' ),
							'key' => 'custom_css',
							'type' => 'textarea',
							'col_width' => 12,
						),
						array(
							'name' => __( 'Responsive For Mobile Devices', 'mega_main_menu' ),
							'descr' => __( 'Enable responsive properties. If this option is enabled then the menu will be transformed, if the user uses the mobile device.', 'mega_main_menu' ),
							'key' => 'responsive_styles',
							'type' => 'checkbox',
							'values' => array(
								__( 'Enable', 'mega_main_menu' ) => 'true',
							),
							'default' => array( 'true', ),
						),
						array(
							'name' => __( 'Responsive Resolution', 'mega_main_menu' ),
							'descr' => __( 'Select on which screen resolution menu will be transformed for mobile devices.', 'mega_main_menu' ),
							'key' => 'responsive_resolution',
							'type' => 'radio',
							'col_width' => 3,
							'values' => array(
								'480px (iPhone Landscape)' => '480',
								'768px (iPad Portrait)' => '768',
								'960px' => '960',
								'1024px (iPad Landscape)' => '1026',
								'1200px' => '1199',
								'Always mobile version' => '2800',
							),
							'default' => array( '1024', ),
						),
						array(
							'name' => __( 'Sets of icons', 'mega_main_menu' ),
							'descr' => __( 'Here you can activate different sets of icons. After saving these settings, icons will become available in a modal window of icon selection. Remember that a larger list of icons requires more time for page loading.', 'mega_main_extensions' ),
							'key' => 'icon_sets',
							'type' => 'checkbox',
							'values' => array(
								__( 'IcoMoon (1200)', 'mega_main_menu' ) => 'icomoon',
//								__( 'FontAwesome (400)', 'mega_main_menu' ) => 'fontawesome',
								__( 'Glyphicons (200)', 'mega_main_menu' ) => 'glyphicons',
								__( 'Linearicons (170)', 'mega_main_menu' ) => 'linearicons',
								__( 'FontAwesome Light (900)', 'mega_main_menu' ) => 'mm_fa_5_light',
								__( 'FontAwesome Regular (900)', 'mega_main_menu' ) => 'mm_fa_5_regular',
								__( 'FontAwesome Solid (900)', 'mega_main_menu' ) => 'mm_fa_5_solid',
								__( 'FontAwesome Brands (360)', 'mega_main_menu' ) => 'mm_fa_5_brands',
							),
							'default' => array(
								'icomoon',
							),
						),
						array(
							'name' => __( 'Prioritize plugin styles', 'mega_main_menu' ),
							'descr' => __( 'If this option is checked - all CSS properties for this plugin will be have "!important" priority.', 'mega_main_menu' ),
							'key' => 'coercive_styles',
							'type' => 'checkbox',
							'values' => array(
								__( 'Enable', 'mega_main_menu' ) => 'true',
							),
						),
						array(
							'name' => __( '"Indefinite location" mode', 'mega_main_menu' ),
							'descr' => '<span style="color: #f11;">' . __( 'Warning', 'mega_main_menu' ) . ':</span> ' . __( 'If this option is checked - all menus will be replaced by Mega Main Menu. This will be useful only for templates where locations of the menu are not defined and template have only one menu.', 'mega_main_menu' ),
							'key' => 'indefinite_location_mode',
							'type' => 'checkbox',
							'values' => array(
								__( 'Enable', 'mega_main_menu' ) => 'true',
							),
						),
						array(
							'name' => __( 'Number of widget areas', 'mega_main_menu' ),
							'descr' => __( 'Set the number of independent widget areas you need here.', 'mega_main_menu' ),
							'key' => 'number_of_widgets',
							'type' => 'number',
							'min' => 0,
							'max' => 100,
							'units' => 'areas',
							'values' => '1',
							'default' => '1',
						),
						array(
							'name' => __( 'Language reading direction', 'mega_main_menu' ),
							'descr' => __( 'You can select direction of the text for this plugin. LTR - sites where you read text from left to right. RTL - sites where you read text from right to left.', 'mega_main_menu' ),
							'key' => 'language_direction',
							'type' => 'radio',
							'values' => array(
								__( 'Left To Right', 'mega_main_menu' ) => 'ltr',
								__( 'Right To Left', 'mega_main_menu' ) => 'rtl',
							),
							'default' => array(
								'ltr',
							),
						),
						array(
							'name' => __( 'max_input_vars', 'mega_main_menu' ),
							'descr' => __( 'This is real value of "max_input_vars" option in the configuration of your server. You can try to increase it in one of the ways that are described in', 'mega_main_menu' ) . '<a href="https://manual.menu.megamain.com/#max_input_vars" target="_blank">' . __( 'Documentation', 'mega_main_menu' ) .'</a>.',
							'key' => 'max_input_vars_value',
							'type' => 'just_html',
							'default' => '<pre>' . ini_get( 'max_input_vars' ) . '</pre>',
						),
						array(
							'name' => __( 'Backup of the configuration', 'mega_main_menu' ),
							'descr' => __( 'You can make a backup of the plugin configuration and restore this configuration later. Notice: Options of each menu item from the section "Menu Structure" are not imported.', 'mega_main_menu' ),
							'key' => 'backup',
							'type' => 'just_html',
							'default' => '<a href="' . get_admin_url() . '?' . $constants[ 'MM_WARE_PREFIX' ] . '_page=backup_file">' . __( 'Download backup file with current settings', 'mega_main_menu' ) . '</a><br /><br />' . __( 'Upload backup file and restore settings. Choose file and click "Save All Settings".', 'mega_main_menu' ) . '<br /><input class="col-xs-12 form-control input-sm" type="file" name="' . $constants[ 'MM_OPTIONS_NAME' ] . '_backup" />',
						),
						array(
							'name' => __( 'Reset Configuration', 'mega_main_menu' ),
							'descr' => __( 'If you need to reset configuration of this plugin then check this option and click "Save Changes".', 'mega_main_menu' ) . ' <span style="color: #f11;">' . __( 'Warning', 'mega_main_menu' ) . ':</span> ' . __( 'After this action all values of options located on this page will be reset to default values.', 'mega_main_menu' ),
							'key' => 'reset_configuration',
							'type' => 'checkbox',
							'values' => array(
								'<span style="color: #f11;">' . __( 'Reset Plugin Configuration', 'mega_main_menu' ) . '</span>' => 'true',
							),
							'col_width' => 12,
						),
					), // 'options' => array
				),
				array(
					'title' => __( 'Settings of the structure', 'mega_main_menu' ),
					'key' => 'mm_structure_settings',
					'icon' => 'im-icon-checkbox',
					'options' => array(
						array(
							'name' => __( 'Here you can deactivate the options that you do not use to customize the menu structure. It helps reduce the number of options and reduce the load on the server.', 'mega_main_menu' ),
							'key' => 'menu_structure_settings',
							'type' => 'caption',
						),
						array(
							'name' => __( 'Description of the item', 'mega_main_menu' ),
							'key' => 'item_descr',
							'type' => 'checkbox',
							'values' => array(
								__( 'Disable', 'mega_main_menu' ) => 'disable',
							),
						),
						array(
							'name' => __( 'Style of the item', 'mega_main_menu' ),
							'key' => 'item_style',
							'type' => 'checkbox',
							'values' => array(
								__( 'Disable', 'mega_main_menu' ) => 'disable',
							),
							'default' => array( 'true', ),
						),
						array(
							'name' => __( 'Visibility Control', 'mega_main_menu' ),
							'key' => 'item_visibility',
							'type' => 'checkbox',
							'values' => array(
								__( 'Disable', 'mega_main_menu' ) => 'disable',
							),
							'default' => array( 'true', ),
						),
						array(
							'name' => __( 'Icon of the item', 'mega_main_menu' ),
							'key' => 'item_icon',
							'type' => 'checkbox',
							'values' => array(
								__( 'Disable', 'mega_main_menu' ) => 'disable',
							),
						),
						array(
							'name' => __( 'Hide Text of the Item', 'mega_main_menu' ),
							'key' => 'disable_text',
							'type' => 'checkbox',
							'values' => array(
								__( 'Disable', 'mega_main_menu' ) => 'disable',
							),
						),
						array(
							'name' => __( 'Disable Link', 'mega_main_menu' ),
							'key' => 'disable_link',
							'type' => 'checkbox',
							'values' => array(
								__( 'Disable', 'mega_main_menu' ) => 'disable',
							),
						),
						array(
							'name' => __( 'Pull to the Other Side', 'mega_main_menu' ),
							'key' => 'pull_to_other_side',
							'type' => 'checkbox',
							'values' => array(
								__( 'Disable', 'mega_main_menu' ) => 'disable',
							),
							'default' => array( 'true', ),
						),
						array(
							'name' => __( 'Submenu Type', 'mega_main_menu' ),
							'key' => 'submenu_type',
							'type' => 'checkbox',
							'values' => array(
								__( 'Disable', 'mega_main_menu' ) => 'disable',
							),
						),
						array(
							'name' => __( 'Side of dropdown elements', 'mega_main_menu' ),
							'key' => 'submenu_drops_side',
							'type' => 'checkbox',
							'values' => array(
								__( 'Disable', 'mega_main_menu' ) => 'disable',
							),
						),
						array(
							'name' => __( 'Submenu Columns', 'mega_main_menu' ),
							'key' => 'submenu_columns',
							'type' => 'checkbox',
							'values' => array(
								__( 'Disable', 'mega_main_menu' ) => 'disable',
							),
						),
						array(
							'name' => __( 'Enable Full Width Dropdown', 'mega_main_menu' ),
							'key' => 'submenu_enable_full_width',
							'type' => 'checkbox',
							'values' => array(
								__( 'Disable', 'mega_main_menu' ) => 'disable',
							),
						),
						array(
							'name' => __( 'Dropdown Background Image', 'mega_main_menu' ),
							'key' => 'submenu_bg_image',
							'type' => 'checkbox',
							'values' => array(
								__( 'Disable', 'mega_main_menu' ) => 'disable',
							),
						),
					), // 'options' => array
				),
				array(
					'title' => __( 'Documentation & Support', 'mega_main_menu' ),
					'key' => 'support',
					'icon' => 'im-icon-support',
					'options' => array(
						array(
							'name' => '',
							'key' => 'support',
							'type' => 'just_html',
							'default' => '<br /><br /> <a href="https://manual.menu.megamain.com/" target="_blank">' . __( 'Online documentation', 'mega_main_menu' ) . '</a>. <br /><br /> ' . __( 'If you need support, have a question or suggestion - Leave a message on our support page', 'mega_main_menu' ) . ' <br /> <a href="https://support.megamain.com/?ref=' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . '" target="_blank">Support.MegaMain.com</a> ' . __( '(opens in new tab)', 'mega_main_menu' ) . '.<br /> <br />',
						),
						array(
							'name' => __( 'Purchase Code', 'mega_main_menu' ),
							'descr' => __( 'Enter here the purchase code of this product. This action unlocks the automatic updates for you. See where you can find your', 'mega_main_menu' ) . ' <a href="https://support.megamain.com/src/img/megamain-find-item-purchase-code.png" target="_blank">' . __( 'Purchase Code', 'mega_main_menu' ) . '</a>.',
							'key' => 'purchase_code',
							'type' => 'textfield',
							'col_width' => 6,
							'default' => '',
						),
					), // 'options' => array
				),
			); // END FRIMARY ARRAY
		}
	}
