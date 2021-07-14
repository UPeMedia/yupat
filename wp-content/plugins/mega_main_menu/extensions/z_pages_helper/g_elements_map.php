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
		if ( $_GET[ 'mm_page' ] == 'menu_g_blocks' ) {

			// get access to global MM variable.
			global $mega_main_menu;
			$current_class = $mega_main_menu;

			// Set "javascript" header for this document.
			header('Content-Type: application/javascript');

			// create "mm_global_list_of_icons" JS variable.
			$icon_sets = $current_class->get_option( 'icon_sets', array() );
			if ( in_array( 'is_checkbox', $icon_sets ) ) {
				unset( $icon_sets[ array_search( 'is_checkbox', $icon_sets ) ] );
			}
			echo "mm_global_list_of_icons = [";
			if ( count( $icon_sets ) ) {
				foreach ( $icon_sets as $set_key => $set_name ) {
					foreach ( call_user_func( array( 'mm_datastore', 'get_list_' . $set_name ) ) as $icon_key => $icon_value ) {
						echo "{label:'" . $icon_value . "',value:'" . $icon_value . "'}, ";
					}
				}
			}
			echo "];";

			// create "mm_global_list_of_animations" JS variable.
			echo "mm_global_list_of_animations = [";
			foreach ( mm_datastore::get_list_of_animations() as $anim_key => $anim_value ) {
				$anim_key = str_replace( '&nbsp;', '\u00A0', $anim_key );
				echo "{label:'" . $anim_key . "',value:'" . $anim_value . "'}, ";
			}
			echo "];";

			// create "mm_list_of_theme_menu_locations" JS variable.
			echo "mm_list_of_theme_menu_locations = [";
			$get_registered_nav_menus = get_registered_nav_menus();
			if ( count( $get_registered_nav_menus ) ) {
				foreach ( $get_registered_nav_menus as $key => $value ){
					$key = str_replace( ' ', '-', $key );
					$theme_menu_locations[ $key ] = $key;
				}
			}
			$get_nav_menu_locations = get_nav_menu_locations();
			if ( count( $get_nav_menu_locations ) ) {
				foreach ( $get_nav_menu_locations as $key => $value ){
					$key = str_replace( ' ', '-', $key );
					$theme_menu_locations[ $key ] = $key;
				}
			}
			if ( count( $theme_menu_locations ) ) {
				$mega_menu_locations = $mega_main_menu->get_option( 'mega_menu_locations', array() );
				foreach ( $theme_menu_locations as $key => $value ) {
					if ( in_array( $key, $mega_menu_locations ) ) {
						$key = $key . ' (' . __( 'Active', 'mega_main_menu' ) . ')';
					}
					echo "{label:'" . $key . "',value:'" . $value . "'}, ";
				}
			}
			echo "];";

			// create "mm_list_of_nav_menus_structures" JS variable.
			echo "mm_list_of_nav_menus_structures = [";
			$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
			// If no menus exists, direct the user to go and create some.
			if ( !$menus ) {
				echo "{label:'" . __( 'Go and create one at Appearance -> Menus', 'mega_main_menu' ) . "',value:'none'}, ";
			} else {
				foreach ( $menus as $menu ) {
					echo "{label:'" . $menu->name . "',value:'" . $menu->term_id . "'}, ";
				}
			}
			echo "];";

			// create "mm_menu_config_vars" JS variable.
			echo mm_common::ntab(0) ."mm_menu_config_vars = {";
			echo "plugin_settings_url:'" . get_admin_url() . "admin.php?page=" . $this->constant[ 'MM_OPTIONS_NAME' ] . "', ";
			echo "nav_menus_url:'" . get_admin_url() . "nav-menus.php', ";
			echo "};";
			echo <<<EOT

/* 
 * Guten Blocks for Mega Main Extensions.
 */
( function( blocks, editor, components, compose, element ) {
const {
	RichText,
	InnerBlocks,
	InspectorControls,
} = editor;
const {
	PanelBody,
	PanelRow,
	TextControl,
	SelectControl,
	CheckboxControl,
	TextareaControl,
	ToggleControl,
	Button,
	Popover,
	ServerSideRender,
} = components;
const {
	setState,
	withState,
} = compose
const {
	createElement,
} = element;
// translation constant
const { __ } = wp.i18n;

	// Mega Main Logo SVG icon.
	const mega_main_logo = createElement(
	'svg',
	{
		width: 24,
		height: 24,
		viewBox: '0 0 100 100',
	},
	[
		createElement(
			'path',
			{
				d: "M83.9,90.1c1.5-0.5,1.5-0.5,1.6-1l7.8-88.4h-87l7.7,87.5c0.1,1.6,0.2,1.5,0.6,1.6l34.4,9.6c0.9,0.3,1,0.3,1.8,0L83.9,90.1z",
				fill: '#13A484',
			},
		),
		createElement(
			'path',
			{
				d: "M85.6,8L49.7,7.8v84.3l27.9-7.7c1.1-0.3,1-0.2,1.2-1.9L85.6,8z",
				fill: '#1BBC9C',
			},
		),
		createElement(
			'path',
			{
				d: "M81.1,15.2L49.7,46.5L18.4,15.3L24.6,78c0.1,0.1,12.2,3.1,12.3,3.1l-3.4-35.3l16.3,16.2l16.2-16l-3.2,35c0.3,0,12-3,12.2-3.1L81.1,15.2z",
				fill: '#F3F3F3',
			},
		),
	]
	);


	// generator helpers
	// function encodes MM special charts
	function SpecialCharsEncode ( string ) {
		string = string
			.replace(/</g, "&lth;")
			.replace(/>/g, "&gth;")
			.replace(/"/g, "&quote;")
			.replace(/'/g, "&apost;");
		return string;
	}
	// function decodes MM special charts
	function SpecialCharsDecode ( string ) {
		string = string
			.replace(/&lth;/g, "<")
			.replace(/&gth;/g, ">")
			.replace(/&quote;/g, '"')
			.replace(/&apost;/g, "'");
		return string;
	}
	// function to use in callback "onChange" for regular inputs.
	function onChangeRegularInput( props, localAtts, newValue, attributeName ) {
		if ( typeof newValue === 'string' ) {
			newValue = SpecialCharsEncode( newValue ); // This replace is necessary for attributes with "string" values. And unnecessary for variables with "boolean" values.
		}
		props.setAttributes( { [attributeName]: newValue } );
		localAtts[ 'mm_function_args' ][ attributeName ] = newValue;
		localAtts[ 'mm_function_args' ] = JSON.stringify( localAtts[ 'mm_function_args' ] ).replace(/"/g, "'");
		props.setAttributes( { mm_function_args: localAtts[ 'mm_function_args' ] } );
	}
	// function returns an array of buttons for icon selection.
	function iconSelectionButtons( props, localAtts, attributeName ) {
		var iconSelectionButtons = [];
		mm_global_list_of_icons.forEach(function(item, i, arr) {
			iconSelectionButtons[ i ] = createElement(
				Button,
				{
					className: 'mm_icon_choice_button ' + item[ 'value' ],
					value: item[ 'value' ],
					isDefault: true,
					onClick: function(e) {
						setIconValueFromButton(props, localAtts, e, attributeName);
					},
				},
			);
		});
		return iconSelectionButtons;
	}
	// function to use in callback "onChange" for typein icon fields.
	function setIconValueFromTypein( props, localAtts, newValue, attributeName ) {
		newValue = SpecialCharsEncode( newValue ); // This replace is necessary for attributes with "string" values. And unnecessary for variables with "boolean" values.
		props.setAttributes( { [ attributeName ]: newValue } );
		localAtts[ 'mm_function_args' ][ attributeName ] = newValue;
		localAtts[ 'mm_function_args' ] = JSON.stringify( localAtts[ 'mm_function_args' ] ).replace(/"/g, "'");
		props.setAttributes( { mm_function_args: localAtts[ 'mm_function_args' ] } );
	}
	// function to use in callback "onClick" for iconSelectionButtons.
	function setIconValueFromButton( props, localAtts, newValue, attributeName ) {
		newValue = jQuery( newValue.target ).val(); // Get icon CSS class name from it's button "value" attribute.
		setIconValueFromTypein(props, localAtts, newValue, attributeName);
	}
	// function to use in callback "onClick" for Popovers to toggle status true/false.
	function togglePopover( props, localAtts, newValue, attributeName ) {
		props.setAttributes( { [ attributeName ]: ! props.attributes[ attributeName ] } );
/*
		if ( typeof props.attributes[ attributeName ] === 'undefined' ) {
			props.setAttributes( { [ attributeName ]: true } );
		} else {
			props.setAttributes( { [ attributeName ]: ! props.attributes[ attributeName ] } );
		}
*/
	}

	// generator fields.
	// START: option = mm_type-checkbox (ToggleControl)
	function mmTypeCheckbox( props, localAtts, optionName, title, description ) {
		output = createElement(
			PanelRow,
			{
				className: 'option mm_type-checkbox rowof-' + optionName,
			},
			[
				createElement(
					'div',
					{
						className: 'option_header',
					},
					[
						createElement(
							'div',
							{
								className: 'caption',
							},
							title,
						), // Element
						createElement(
							'div',
							{
								className: 'descr',
							},
							description,
						), // Element
					],
				), // Element
				createElement(
					'div',
					{
						className: 'option_field',
					},
					[
						createElement(
							ToggleControl,
							{
								id: optionName,
								name: optionName,
								checked: localAtts[ optionName ],
								onChange: function(e) {
									onChangeRegularInput(props, localAtts, e, optionName);
								},
							},
						), // Element
					],
				), // Element
			],
		); // PanelRow
		return output;
	}
	// END: option = mm_type-checkbox (ToggleControl)
	// START: option = mm_type-animation (SelectControl)
	function mmTypeAnimation( props, localAtts, optionName, title, description ) {
		output = createElement(
			PanelRow,
			{
				className: 'option mm_type-animation rowof-' + optionName,
			},
			[
				createElement(
					'div',
					{
						className: 'option_header',
					},
					[
						createElement(
							'div',
							{
								className: 'caption',
							},
							title,
						), // Element
						createElement(
							'div',
							{
								className: 'descr',
							},
							description,
						), // Element
					],
				), // Element
				createElement(
					'div',
					{
						className: 'option_field row',
					},
					[
						createElement(
							'div',
							{
								className: 'col-xs-9',
							},
							createElement(
								SelectControl,
								{
									id: optionName,
									name: optionName,
									value: localAtts[ optionName ],
									onChange: function(e) {
										onChangeRegularInput(props, localAtts, e, optionName);
									},
									options: mm_global_list_of_animations,
								},
							), // Element
						), // Element
						createElement(
							'div',
							{
								className: 'col-xs-3',
							},
							createElement(
								'div',
								{
									className: 'animation_preview',
								},
								createElement(
									'span',
									{
										className: 'mme_animation animated ' + localAtts[ optionName ] + ( ( typeof localAtts[ 'infinite' ] !== 'undefined' && localAtts[ 'infinite' ] === true ) ? ' infinite' : '' ),
									},
									'M',
								), // Element
							), // Element
						), // Element
					],
				), // Element
			],
		); // PanelRow
		return output;
	}
	// END: option = mm_type-animation (SelectControl)
	// START: option = mm_type-icon (Popover)
	function mmTypeIcon( props, localAtts, optionName, title, description ) {
		var data_popover_attr_name = 'data-show_popover_for_' + optionName;
		output = createElement(
			PanelRow,
			{
				className: 'option mm_type-icon rowof-' + optionName,
			},
			[
				createElement(
					'div',
					{
						className: 'option_header',
					},
					[
						createElement(
							'div',
							{
								className: 'caption',
							},
							title,
						), // Element
						createElement(
							'div',
							{
								className: 'descr',
							},
							description,
						), // Element
					],
				), // Element
				createElement(
					'div',
					{
						className: 'option_field row',
					},
					[
						createElement(
							'div',
							{
								className: 'col-xs-6 mb-xs-10',
							},
							createElement(
								Button,
								{
									id: optionName,
									name: optionName,
									isDefault: true,
									[ data_popover_attr_name ]: props.attributes[ 'show_popover_for_' + optionName ],
									onClick: function(e) {
										togglePopover(props, localAtts, e, 'show_popover_for_' + optionName);
									},
								},
								[
									__( 'Select Icon', 'mega_main_menu' ),
									props.attributes[ 'show_popover_for_' + optionName ] ? createElement(
										Popover,
										{
											headerTitle: __( 'Select Icon', 'mega_main_menu' ),
											className: 'mm_icon_selection_popover for_' + optionName,
											position: 'bottom center',
											focusOnMount: 'container',
											expandOnMobile: true,
											onClickOutside: function(e) {
												togglePopover(props, localAtts, e, 'show_popover_for_' + optionName);
											},
										},
										createElement(
											PanelBody,
											{ 
												className: 'bootstrap',
											},
											createElement(
												PanelRow,
												{
													className: 'option mm_type-icon_selection_list clearfix',
												},
												iconSelectionButtons(props, localAtts, optionName),
											), // PanelRow
										), // PanelBody
									) : '', // Popover
								]
							), // Botton
						), // Element
						createElement(
							'div',
							{
								className: 'col-xs-6 mm_icon_preview ' + optionName,
							},
							createElement(
								'i',
								{
									className: 'inline-ico-element ' + localAtts[ optionName ],
								},
							), // Element
						), // Element
						createElement(
							'div',
							{
								className: 'col-xs-12',
							},
							createElement(
								TextControl,
								{
									className: 'select_icon_typein_field ' + optionName,
									placeholder: __( 'Or type in the icon name', 'mega_main_menu' ),
									value: localAtts[ optionName ],
									onChange: function(e) {
										setIconValueFromTypein(props, localAtts, e, optionName);
									},
								},
							), // Element
						), // Element
					],
				), // Element
			],
		); // PanelRow
		return output;
	}
	// END: option = mm_type-icon (Popover)
	// START: option = mm_type-select (SelectControl)
	function mmTypeSelect( props, localAtts, optionName, title, description, options_list ) {
		output = createElement(
			PanelRow,
			{
				className: 'option mm_type-select rowof-' + optionName,
			},
			[
				createElement(
					'div',
					{
						className: 'option_header',
					},
					[
						createElement(
							'div',
							{
								className: 'caption',
							},
							title,
						), // Element
						createElement(
							'div',
							{
								className: 'descr',
							},
							description,
						), // Element
					],
				), // Element
				createElement(
					'div',
					{
						className: 'option_field row',
					},
					[
						createElement(
							'div',
							{
								className: 'col-xs-12',
							},
							createElement(
								SelectControl,
								{
									id: optionName,
									name: optionName,
									value: localAtts[ optionName ],
									onChange: function(e) {
										onChangeRegularInput(props, localAtts, e, optionName);
									},
									options: options_list,
								},
							), // Element
						), // Element
					],
				), // Element
			],
		); // PanelRow
		return output;
	}
	// END: option = mm_type-select (SelectControl)

	// check if 'mega_main' category exists and create it if not.
	blocks_categories = blocks.getCategories();
	is_mm_category_registered = false;
	blocks_categories.forEach(function(item, i, arr) {
		if ( item[ 'slug' ] === 'mega_main' ) {
			is_mm_category_registered = true;
		}
	});
	if ( is_mm_category_registered == false ) {
		// register category
		blocks_categories.push(
			{
				slug: 'mega_main',
				title: __( 'Mega Main Elements', 'mega_main_menu' ),
				icon: mega_main_logo,
			}
		);
		blocks.setCategories( blocks_categories );
	} else {
		// updateCategory icon
		blocks.updateCategory( 'mega_main', { icon: mega_main_logo } );
	}
	// END 'mega_main' category.
	// registerBlockType
	blocks.registerBlockType( 'mm/menu', {
		name: 'mm/menu', // the name in this argument should be exact the same as first argument in registerBlockType function.
		title: __( 'Mega Main Menu', 'mega_main_menu' ),
		description: __( 'This element allows you to insert Mega Main Menu into the content of your page. Please choose the menu from the settings below.', 'mega_main_menu' ),
		// Make it easier to discover a block with keyword aliases.
		// These can be localised so your keywords work across locales.
		keywords: [ 'mega', 'main', 'menu' ],
		category: 'mega_main',
		icon: {
			// Specifying a background color to appear with the icon e.g.: in the inserter.
			background: 'transparent',
			// Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
			foreground: '#ffffff',
			// Specifying a dashicon for the block
			src: mega_main_logo,
		},
		attributes: {
			// primary param (the code is not repeats. one instance)
			'mm_function_args': {
				type: 'string',
				source: 'attribute',
				attribute: 'data-mm_function_args',
				selector: '.mega_main_menu-preview',
				default: { shortcode: 'mega_main_menu' },
			},
			// one of params (the code repeats with new variable name)
			shortcode: {
				type: 'string',
				default: 'mega_main_menu',
			},
			// one of params (the code repeats with new variable name)
			location: {
				type: 'string',
				default: '',
			},
			// one of params (the code repeats with new variable name)
			structure: {
				type: 'string',
				default: '',
			},
		},

		edit: function( props ) {
			var localAtts = [];
			// Create primary property of localAtts - "mm_function_args".
			localAtts[ 'mm_function_args' ] = ( typeof props.attributes.mm_function_args !== 'undefined' ) ? props.attributes.mm_function_args : { shortcode: 'mega_main_menu' };
			if ( typeof localAtts[ 'mm_function_args' ] !== 'object' ) {
				localAtts[ 'mm_function_args' ] = localAtts[ 'mm_function_args' ].replace(/'/g, '"');
				localAtts[ 'mm_function_args' ] = JSON.parse( localAtts[ 'mm_function_args' ] );
			}
			localAtts[ 'mm_function_args' ][ 'shortcode' ] = ( typeof localAtts[ 'mm_function_args' ][ 'shortcode' ] !== 'undefined' ) ? localAtts[ 'mm_function_args' ][ 'shortcode' ] : 'mega_main_menu';
			// Create rest of localAtts array with current values for all variables that are registered in "props.blockSettings.attributes". So you don't need to declare each local variable individually.
			Object.keys( props.attributes ).forEach(function(item, i, arr) {
				if ( item !== 'className' && item !== 'mm_function_args' ) {
					localAtts[ item ] = props.attributes[ item ];
					if ( typeof localAtts[ 'mm_function_args' ][ item ] !== 'undefined' ) {
						localAtts[ item ] = localAtts[ 'mm_function_args' ][ item ];
					}
				}
			});

			// Do shortcode preview.
/*
			jQuery.ajax({
				url: window.location.origin + window.location.pathname + '?mm_page=do_shortcode',
				dataType: 'html',
				cache: false,
				global: false,
				type: 'POST',
				data: localAtts[ 'mm_function_args' ],
				success: function( data ) {
					jQuery( '.mega_main_menu-preview' ).html( data );
				},
				error: function () {
					alert( 'ajax error' );
				},
			});
*/
/*
var localAttsStringified = localAtts;
delete localAttsStringified[ 'mm_function_args' ];
if ( typeof localAttsStringified[ 'mm_function_args' ] !== 'string' ) {
	localAttsStringified[ 'mm_function_args' ] = JSON.stringify( localAttsStringified[ 'mm_function_args' ] ).replace(/"/g, "'");
}
*/
			// return elements 
			return [
				createElement(
					InspectorControls,
					null,
					createElement(
						PanelBody,
						{ 
							title: __( 'Element Settings', 'mega_main_menu' ),
							className: 'bootstrap',
						},

						mmTypeSelect(
							props, 
							localAtts, 
							'location', 
							__( 'Style', 'mega_main_menu' ), 
							[
								__( 'Select the style of the menu that you want to use. If you need to manage styles or activate one or more of them then go to the page of', 'mega_main_menu' ),
								' ',
								createElement(
									'a',
									{ 
										href: mm_menu_config_vars[ 'plugin_settings_url' ],
										target: '_blank', 
									},
									__( 'Mega Main Menu Configuration', 'mega_main_menu' ),
								),
							],
							mm_list_of_theme_menu_locations,
						), // PanelRow

						mmTypeSelect(
							props, 
							localAtts, 
							'structure', 
							__( 'Structure', 'mega_main_menu' ), 
							[
								__( 'Select the structure of the menu that you want to use. You can edit the menu structure or create a new one at', 'mega_main_menu' ),
								' ',
								createElement(
									'a',
									{ 
										href: mm_menu_config_vars[ 'nav_menus_url' ],
										target: '_blank', 
									},
									__( 'Appearance - Menus', 'mega_main_menu' ),
								),
							],
							mm_list_of_nav_menus_structures,
						), // PanelRow

					), // PanelBody
				), // InspectorControls
				createElement(
					'div',
					{
						className: 'mega_main_menu-preview',
						'data-mm_function_args': localAtts[ 'mm_function_args' ],
					},
					createElement(
						ServerSideRender,
						{
							block: 'mm/menu-render',
							attributes: {
								shortcode: localAtts[ 'shortcode' ],
								location: localAtts[ 'location' ],
								structure: localAtts[ 'structure' ],
							},
						}
					),
				), // primary element
			]; // return
		}, // edit

		save: function( props ) {
			return createElement(
					'div',
					{
						className: 'mega_main_menu-preview',
						'data-mm_function_args': props.attributes.mm_function_args,
					},
					createElement(
						ServerSideRender,
						{
							block: 'mm/menu-render',
							attributes: {
								shortcode: props.attributes[ 'shortcode' ],
								location: props.attributes[ 'location' ],
								structure: props.attributes[ 'structure' ],
							},
						}
					),
//					'Mega Main Menu',
				);
		},
	} );
}(
	window.wp.blocks,
	window.wp.editor,
	window.wp.components,
	window.wp.compose,
	window.wp.element
) );

EOT;
			die();
		}
	}
