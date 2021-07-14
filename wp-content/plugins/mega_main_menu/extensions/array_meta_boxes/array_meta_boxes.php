<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 1.0
 */
	if ( !function_exists( 'mega_main_menu__array_meta_boxes' ) ) {
		function mega_main_menu__array_meta_boxes( $constants ){
			return array(
				array( // START single element params array
					'key' => 'mm_general', // HTML atribute "id" for metabox
					'title' => __( 'Mega Main Options', 'mega_main_menu' ), // Caption for metabox
					'post_type' => 'all_post_types', // Post types where will be displayed this metabox
					'context' => 'normal', // Position where will be displayed this metabox
					'priority' => 'high', // Priority for this metabox
					'options' => array(
						array(
							'name' => __( 'Post Icon', 'mega_main_menu' ),
							'descr' => __( 'Select an icon for this post, which will be displayed in the "Post Grid Dropdown Menu"', 'mega_main_menu' ),
							'key' => 'post_icon',
							'default' => 'im-icon-plus-circle-2',
							'type' => 'icons',
						),
					), // END element options
				), // END single element params array
			);
		}
	}
