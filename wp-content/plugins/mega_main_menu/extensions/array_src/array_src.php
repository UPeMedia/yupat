<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 1.0
 */

	if ( !function_exists( 'mega_main_menu__array_src' ) ) {
		function mega_main_menu__array_src( $current_class ){
			$array_src = array(
				'frontend' => array(
					'css' => array(
//						'mm_icomoon' => 'framework/src/css/icomoon.css',
//						'mm_font-awesome' => 'framework/src/css/font-awesome.css',
//						'mm_glyphicons' => 'framework/src/css/glyphicons.css',
//						'mm_linearicons' => 'framework/src/css/linearicons.css',
					),
					'js' => array(
						$current_class->constant[ 'MM_WARE_PREFIX' ] . '_menu_functions' => 'src/js/frontend.js',
					),
				),
				'backend' => array(
					'css' => array(
//						'mm_icomoon' => 'framework/src/css/icomoon.css',
//						'mm_font-awesome' => 'framework/src/css/font-awesome.css',
//						'mm_glyphicons' => 'framework/src/css/glyphicons.css',
//						'mm_linearicons' => 'framework/src/css/linearicons.css',
						'mm_bootstrap' => 'framework/src/css/bootstrap.css',
						'mm_option_generator' => 'framework/src/css/mm_option_generator.css',
//						'mm_bootstrap_colorpicker' => 'framework/src/css/colorpicker.css',
//						$current_class->constant[ 'MM_WARE_PREFIX' ] . '_backend_general' => 'src/css/backend.css',
					),
					'js' => array(
						'jquery-ui-sortable' => '',
						'jquery-ui-draggable' => '',
						'mm_bootstrap' => 'framework/src/js/bootstrap.js',
						'mm_bootstrap_colorpicker' => 'framework/src/js/colorpicker.js',
						'mm_option_generator' => 'framework/src/js/mm_option_generator.js',
						'mm_menu_g_blocks' => '../../../?mm_page=menu_g_blocks',
					),
					'supported_pages' => array(
						'toplevel_page_' . $current_class->constant[ 'MM_OPTIONS_NAME' ], 
						'post.php', 
						'post-new.php', 
						'nav-menus.php'
					),
				),
			);
			$option_status = $current_class->get_option( 'icon_sets', array( 'icomoon' ) );
/*
			if ( !in_array( 'icomoon', $option_status ) ) {
				unset( $array_src[ 'backend' ][ 'css' ][ 'mm_icomoon' ] );
				unset( $array_src[ 'frontend' ][ 'css' ][ 'mm_icomoon' ] );
			}
			if ( !in_array( 'fontawesome', $option_status ) ) {
				unset( $array_src[ 'backend' ][ 'css' ][ 'mm_font-awesome' ] );
				unset( $array_src[ 'frontend' ][ 'css' ][ 'mm_font-awesome' ] );
			}
			if ( !in_array( 'glyphicons', $option_status ) ) {
				unset( $array_src[ 'backend' ][ 'css' ][ 'mm_glyphicons' ] );
				unset( $array_src[ 'frontend' ][ 'css' ][ 'mm_glyphicons' ] );
			}
			if ( !in_array( 'linearicons', $option_status ) ) {
				unset( $array_src[ 'backend' ][ 'css' ][ 'mm_linearicons' ] );
				unset( $array_src[ 'frontend' ][ 'css' ][ 'mm_linearicons' ] );
			}
*/

			if ( in_array( 'icomoon', $option_status ) ) {
				$array_src[ 'backend' ][ 'css' ][ 'mm_icomoon' ] = 'framework/src/css/icomoon.css';
				$array_src[ 'frontend' ][ 'css' ][ 'mm_icomoon' ] = 'framework/src/css/icomoon.css';
			}
			if ( in_array( 'glyphicons', $option_status ) ) {
				$array_src[ 'backend' ][ 'css' ][ 'mm_glyphicons' ] = 'framework/src/css/glyphicons.css';
				$array_src[ 'frontend' ][ 'css' ][ 'mm_glyphicons' ] = 'framework/src/css/glyphicons.css';
			}
			if ( in_array( 'linearicons', $option_status ) ) {
				$array_src[ 'backend' ][ 'css' ][ 'mm_linearicons' ] = 'framework/src/css/linearicons.css';
				$array_src[ 'frontend' ][ 'css' ][ 'mm_linearicons' ] = 'framework/src/css/linearicons.css';
			}
			if ( in_array( 'mm_fa_5_brands', $option_status ) ) {
				$array_src[ 'backend' ][ 'css' ][ 'mm_fa_5_list' ] = 'framework/src/css/font-awesome-v5.css';
				$array_src[ 'frontend' ][ 'css' ][ 'mm_fa_5_list' ] = 'framework/src/css/font-awesome-v5.css';
				$array_src[ 'backend' ][ 'css' ][ 'mm_fa_5_brands' ] = 'framework/src/css/font-awesome-brands.css';
				$array_src[ 'frontend' ][ 'css' ][ 'mm_fa_5_brands' ] = 'framework/src/css/font-awesome-brands.css';
			}
			if ( in_array( 'mm_fa_5_light', $option_status ) ) {
				$array_src[ 'backend' ][ 'css' ][ 'mm_fa_5_list' ] = 'framework/src/css/font-awesome-v5.css';
				$array_src[ 'frontend' ][ 'css' ][ 'mm_fa_5_list' ] = 'framework/src/css/font-awesome-v5.css';
				$array_src[ 'backend' ][ 'css' ][ 'mm_fa_5_light' ] = 'framework/src/css/font-awesome-light.css';
				$array_src[ 'frontend' ][ 'css' ][ 'mm_fa_5_light' ] = 'framework/src/css/font-awesome-light.css';
			}
			if ( in_array( 'mm_fa_5_regular', $option_status ) ) {
				$array_src[ 'backend' ][ 'css' ][ 'mm_fa_5_list' ] = 'framework/src/css/font-awesome-v5.css';
				$array_src[ 'frontend' ][ 'css' ][ 'mm_fa_5_list' ] = 'framework/src/css/font-awesome-v5.css';
				$array_src[ 'backend' ][ 'css' ][ 'mm_fa_5_regular' ] = 'framework/src/css/font-awesome-regular.css';
				$array_src[ 'frontend' ][ 'css' ][ 'mm_fa_5_regular' ] = 'framework/src/css/font-awesome-regular.css';
			}
			if ( in_array( 'mm_fa_5_solid', $option_status ) ) {
				$array_src[ 'backend' ][ 'css' ][ 'mm_fa_5_list' ] = 'framework/src/css/font-awesome-v5.css';
				$array_src[ 'frontend' ][ 'css' ][ 'mm_fa_5_list' ] = 'framework/src/css/font-awesome-v5.css';
				$array_src[ 'backend' ][ 'css' ][ 'mm_fa_5_solid' ] = 'framework/src/css/font-awesome-solid.css';
				$array_src[ 'frontend' ][ 'css' ][ 'mm_fa_5_solid' ] = 'framework/src/css/font-awesome-solid.css';
			}
			return $array_src;
		}
	}
