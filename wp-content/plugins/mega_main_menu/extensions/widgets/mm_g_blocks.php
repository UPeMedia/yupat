<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 2.0
 */
	/*
	 * mm_g_blocks
	 */
	if ( !class_exists( 'mm_g_blocks' ) ) {
		class mm_g_blocks {

			/* 
			 * The function that register G blocks.
			 */
			public static function register_block ( $atts = array()  ) {
				if ( function_exists( 'register_block_type' ) ) {
//					add_filter( 'block_categories', array( __CLASS__, 'register_g_category' ), 10, 2 );
					// register editor functions.
					register_block_type( 
						'mm/menu', 
						array(
							'editor_script' => 'mm_g_blocks',
							'render_callback' => array( __CLASS__, 'g_blocks_render_frontend' ),
							'category' => 'mega_main',
							'attributes' => array(
								'content' => array(
									'type' => 'string',
									'default' => '',
								),
								'shortcode' => array(
									'type' => 'string',
									'default' => 'mega_main_menu',
								),
							), // END attributes
						) // END array
					); // END register_block_type
					// register backend render functions.
					register_block_type(
						'mm/menu-render',
						array(
							'render_callback' => array( __CLASS__, 'g_blocks_render_backend' ),
							'attributes'      => array(
								'mm_function_args'    => array(
									'type'      => 'string',
									'default'   => false,
								),

								'shortcode'    => array(
									'type'      => 'string',
									'default'   => false,
								),

								'location'    => array(
									'type'      => 'string',
									'default'   => false,
								),

								'structure'    => array(
									'type'      => 'string',
									'default'   => false,
								),

							),
						)
					);
				} // END function_exists
			} // END public static function register_block

			/* 
			 * Function to render block preview for frontend (site visitors).
			 * The universal function that used as "render_callback" at "register_block_type" and converts the blocks into the shortcodes.
			 */
			public static function g_blocks_render_frontend ( $atts = array(), $content = '' ) {
				include_once( 'simple_html_dom.php' );
				$out = $content;
				if ( ! empty( $content ) ) {
					$parsed_html = str_get_html( $content );
					if ( is_object( $parsed_html ) ) {
						$parent_element = $parsed_html->find( 'div', 0 );
						if ( is_object( $parent_element ) ) {
							$parent_function_atts_string = $parent_element->{'data-mm_function_args'};
							$parent_function_atts_string = str_replace( "'", '"', $parent_function_atts_string );
							$parent_function_atts_array = json_decode( $parent_function_atts_string, true );
							if ( is_array( $parent_function_atts_array ) ) {
								foreach ( $parent_function_atts_array as $key => $value ) {
									$parent_function_atts_array[ $key ] = str_replace( array( '&lth;', '&gth;', '&quote;', '&apost;' ), array( '<', '>', '"', "'" ), $value );
								}
								if ( isset( $parent_function_atts_array[ 'shortcode' ] ) ) {
									$out = '';
									$out .= '[' . $parent_function_atts_array[ 'shortcode' ];
									$shortcode_name = $parent_function_atts_array[ 'shortcode' ];
									unset( $parent_function_atts_array[ 'shortcode' ] );
									if ( count( $parent_function_atts_array ) ) {
										foreach ( $parent_function_atts_array as $key => $value ) {
											$out .= ' ' . $key . '="' . $value . '"';
										}
									}
									$out .= ']';
									$out .= trim( $parent_element->innertext );
									$out .= '[/' . $shortcode_name . ']';
								}
							}
						}
					}
				}
				return $out;
			} // public static function g_blocks_render_frontend

			/* 
			 * Function to render block preview for backend (admin area)
			 */
			public static function g_blocks_render_backend ( $atts = array(), $content = '' ) {
				$out = '';
				if ( isset( $atts[ 'shortcode' ] ) ) {
					$shortcode_name = $atts[ 'shortcode' ];
					unset( $atts[ 'shortcode' ] );
					$out .= '[' . $shortcode_name;
					if ( count( $atts ) ) {
						foreach ( $atts as $key => $value ) {
							$out .= ' ' . $key . '="' . $value . '"';
						}
					}
					$out .= ']';
					$out .= $content;
					$out .= '[/' . $shortcode_name . ']';
				}

				return do_shortcode( $out );
			} // public static function g_blocks_render_backend

			/* 
			 * Creates new category in the "Add Block" menu.
			 */
			public static function register_g_category ( $categories, $post = '' ) {
				return array_merge(
					$categories,
					array(
						array(
							'slug' => 'mega_main',
							'title' => __( 'Mega Main Elements', 'mega_main_menu' ),
							'icon'  => 'wordpress',
						),
					)
				);
			} // public static function register_g_category

		} // class
	} // class_exists

add_action( 'init', array( 'mm_g_blocks', 'register_block' ), 20 ); // IMPORTANT: the "priority" should be higher than "mega_main_init::init"