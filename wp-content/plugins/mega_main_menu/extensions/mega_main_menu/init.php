<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 1.0
 */
	if ( is_admin() ) {
		global $mega_main_menu;
		$menu_locations = ( is_array( get_nav_menu_locations() ) ) ? get_nav_menu_locations() : array();
		// find which menu we are editing now
		$nav_menu_selected_id = ( isset( $_REQUEST['menu'] ) 
			? (int) $_REQUEST['menu'] 
			: ( ( get_user_option( 'nav_menu_recently_edited' ) != false ) 
				? absint( get_user_option( 'nav_menu_recently_edited' ) )
				: 0
			)
		);
		// conditions if current menu for edit can be found in $mega_menu_locations
		$current_menu_location = array_search( $nav_menu_selected_id, $menu_locations );
		$self_current_menu_location = str_replace( ' ', '-', $current_menu_location );
		$mega_menu_locations = $mega_main_menu->get_option( 'mega_menu_locations', array() );
		if ( is_array( $mega_menu_locations ) ) {
			if ( in_array( $self_current_menu_location, $mega_menu_locations ) || in_array( 'mega_main_sidebar_menu', $mega_menu_locations ) ) {
				$activate_backend = true;
			}
		}
		// condition if active "indefinite_location_mode" option
		$indefinite_location_mode = $mega_main_menu->get_option( 'indefinite_location_mode', array() );
		if ( is_array( $indefinite_location_mode ) && in_array( 'true', $indefinite_location_mode ) ) {
			$activate_backend = true;
		}
		// activate_backend_walker
		if ( isset( $activate_backend ) && ( $activate_backend == true ) ) {
			include_once( 'menu_options_array.php' );
			include_once( 'backend_walker.php' );
		}
	} else {

		/** 
		 * register link to MM options in admin toolbar.
		 * @return void
		 */
		/*
		add_action( 'admin_bar_menu', 'toolbar_link_to_mm_options', 10 );
		function toolbar_link_to_mm_options( $wp_admin_bar ) {
			global $mega_main_menu;
			$args = array(
				'parent' => 'site-name',
				'id' => $mega_main_menu->constant[ 'MM_OPTIONS_NAME' ],
				'title' => $mega_main_menu->constant[ 'MM_WARE_NAME' ],
				'href' => get_admin_url() . 'admin.php?page=' . $mega_main_menu->constant[ 'MM_OPTIONS_NAME' ],
			);
			$wp_admin_bar->add_node( $args );
		}
		 */
	}
	include_once( 'frontend_walker.php' );
	include_once( 'handler.php' );
