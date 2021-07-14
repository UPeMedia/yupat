<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 1.0
 */
if (! function_exists( 'mega_main_menu__array_skin' ) ) {
	function mega_main_menu__array_skin ( $current_class ) {
	$mega_menu_locations = is_array( $current_class->get_option( 'mega_menu_locations' ) ) 
		? $current_class->get_option( 'mega_menu_locations' ) 
		: array();
	// Create copy of saved options and then use it in this file.
	$skin = $current_class->saved_options;
/* empty */
$out = '.empty{}/* empty */';
/* mega_menu_locations */
//		array_shift( $mega_menu_locations );
		if ( in_array( 'is_checkbox', $mega_menu_locations) ) {
			$is_checkbox_key = array_search( 'is_checkbox', $mega_menu_locations );
			unset( $mega_menu_locations[ $is_checkbox_key ] );
		}
		// hure foreach starts here.
		foreach ( $mega_menu_locations as $key => $location_name ) { 
if ( is_array( $current_class->get_option( 'indefinite_location_mode' ) ) && in_array( 'true', $current_class->get_option( 'indefinite_location_mode' ) ) ) {
		$location_class = '';
} else {
		$location_class = '.' . $location_name;
}
// Creation of predefined Skin options.
$predefined_skin = $current_class->get_option( $location_name . '_predefined_skin', 'mega_main_blue' );
$list_of_skins = mm_datastore::get_list_of_skins();
$selected_predefined_skin = $list_of_skins[ 'mega_main_blue' ];
if ( isset ( $list_of_skins[ $predefined_skin ] ) ) {
	$selected_predefined_skin = $list_of_skins[ $predefined_skin ];
}
// create gradient arrays from predefined skin.
$selected_predefined_skin[ 'gradient' ] = array( 
	'color1' => $selected_predefined_skin[ 'primary_theme_color' ], 
	'color2' => $selected_predefined_skin[ 'secondary_theme_color' ], 
	'start' => '0', 
	'end' => '100', 
	'orientation' => 'top' 
);
// Check all options that related to the color and set predefined skin value if custom values is not set.
if ( empty( $skin[ $location_name . '_menu_bg_gradient' ][ 'color1' ] ) ) {
	$skin[ $location_name . '_menu_bg_gradient' ][ 'color1' ] = $selected_predefined_skin[ 'primary_theme_color' ];
}
if ( empty( $skin[ $location_name . '_menu_bg_gradient' ][ 'color2' ] ) ) {
	$skin[ $location_name . '_menu_bg_gradient' ][ 'color2' ] = $selected_predefined_skin[ 'secondary_theme_color' ];
}
if ( empty( $skin[ $location_name . '_menu_first_level_link_color' ] ) ) {
	$skin[ $location_name . '_menu_first_level_link_color' ] = $selected_predefined_skin[ 'primary_theme_contrast_color' ];
}
if ( empty( $skin[ $location_name . '_menu_first_level_link_bg' ][ 'color1' ] ) ) {
	$skin[ $location_name . '_menu_first_level_link_bg' ][ 'color1' ] = $selected_predefined_skin[ 'primary_theme_color' ];
}
if ( empty( $skin[ $location_name . '_menu_first_level_link_bg' ][ 'color2' ] ) ) {
	$skin[ $location_name . '_menu_first_level_link_bg' ][ 'color2' ] = $selected_predefined_skin[ 'secondary_theme_color' ];
}
if ( empty( $skin[ $location_name . '_menu_first_level_link_color_hover' ] ) ) {
	$skin[ $location_name . '_menu_first_level_link_color_hover' ] = $selected_predefined_skin[ 'secondary_theme_contrast_color' ];
}
if ( empty( $skin[ $location_name . '_menu_first_level_link_bg_hover' ][ 'color1' ] ) ) {
	$skin[ $location_name . '_menu_first_level_link_bg_hover' ][ 'color1' ] = $selected_predefined_skin[ 'secondary_theme_color' ];
}
if ( empty( $skin[ $location_name . '_menu_first_level_link_bg_hover' ][ 'color2' ] ) ) {
	$skin[ $location_name . '_menu_first_level_link_bg_hover' ][ 'color2' ] = $selected_predefined_skin[ 'primary_theme_color' ];
}
if ( empty( $skin[ $location_name . '_menu_search_bg' ] ) ) {
	$skin[ $location_name . '_menu_search_bg' ] = $selected_predefined_skin[ 'secondary_theme_color' ];
}
if ( empty( $skin[ $location_name . '_menu_search_color' ] ) ) {
	$skin[ $location_name . '_menu_search_color' ] = $selected_predefined_skin[ 'secondary_theme_contrast_color' ];
}
if ( empty( $skin[ $location_name . '_menu_dropdown_wrapper_gradient' ][ 'color1' ] ) ) {
	$skin[ $location_name . '_menu_dropdown_wrapper_gradient' ][ 'color1' ] = '#ffffff';
}
if ( empty( $skin[ $location_name . '_menu_dropdown_wrapper_gradient' ][ 'color2' ] ) ) {
	$skin[ $location_name . '_menu_dropdown_wrapper_gradient' ][ 'color2' ] = '#ffffff';
}
if ( empty( $skin[ $location_name . '_menu_dropdown_link_color' ] ) ) {
	$skin[ $location_name . '_menu_dropdown_link_color' ] = $selected_predefined_skin[ 'text_font' ][ 'font_color' ];
}
if ( empty( $skin[ $location_name . '_menu_dropdown_link_bg' ][ 'color1' ] ) ) {
	$skin[ $location_name . '_menu_dropdown_link_bg' ][ 'color1' ] = 'transparent';
}
if ( empty( $skin[ $location_name . '_menu_dropdown_link_bg' ][ 'color2' ] ) ) {
	$skin[ $location_name . '_menu_dropdown_link_bg' ][ 'color2' ] = 'transparent';
}
if ( empty( $skin[ $location_name . '_menu_dropdown_link_border_color' ] ) ) {
	$skin[ $location_name . '_menu_dropdown_link_border_color' ] = $selected_predefined_skin[ 'wrapper_bg' ];
}
if ( empty( $skin[ $location_name . '_menu_dropdown_link_color_hover' ] ) ) {
	$skin[ $location_name . '_menu_dropdown_link_color_hover' ] = $selected_predefined_skin[ 'primary_theme_contrast_color' ];
}
if ( empty( $skin[ $location_name . '_menu_dropdown_link_bg_hover' ][ 'color1' ] ) ) {
	$skin[ $location_name . '_menu_dropdown_link_bg_hover' ][ 'color1' ] = $selected_predefined_skin[ 'primary_theme_color' ];
}
if ( empty( $skin[ $location_name . '_menu_dropdown_link_bg_hover' ][ 'color2' ] ) ) {
	$skin[ $location_name . '_menu_dropdown_link_bg_hover' ][ 'color2' ] = $selected_predefined_skin[ 'secondary_theme_color' ];
}
if ( empty( $skin[ $location_name . '_menu_dropdown_plain_text_color' ] ) ) {
	$skin[ $location_name . '_menu_dropdown_plain_text_color' ] = $selected_predefined_skin[ 'text_font' ][ 'font_color' ];
}
// Start CSS code creation.
$out .= '/* ' . $location_name . ' */
/* initial_height */
.mega_main_menu' . $location_class . ' .nav_logo > .logo_link > img
{
	max-height: ' . $current_class->get_option( $location_name . '_logo_height', '90' ) . '%;
}
.mega_main_menu' . $location_class . '
{
	min-height:' . $current_class->get_option( $location_name . '_first_level_item_height' ) . 'px;
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > .nav_logo > .logo_link, 
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle, 
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle > .mobile_button, 
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link, 
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link > .link_content, 
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.nav_search_box,
.mega_main_menu' . $location_class . '.icons-left > .menu_holder > .menu_inner > ul > li > .item_link > i,
.mega_main_menu' . $location_class . '.icons-right > .menu_holder > .menu_inner > ul > li > .item_link > i,
.mega_main_menu' . $location_class . '.icons-top > .menu_holder > .menu_inner > ul > li > .item_link.disable_icon > .link_content,
.mega_main_menu' . $location_class . '.icons-top > .menu_holder > .menu_inner > ul > li > .item_link.menu_item_without_text > i, 
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.nav_buddypress > .item_link > i.ci-icon-buddypress-user
{
	height:' . $current_class->get_option( $location_name . '_first_level_item_height' ) . 'px;
	line-height:' . $current_class->get_option( $location_name . '_first_level_item_height' ) . 'px;
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link > .link_content > .link_text
{
	height:' . $current_class->get_option( $location_name . '_first_level_item_height' ) . 'px;
}
.mega_main_menu' . $location_class . '.icons-top > .menu_holder > .menu_inner > ul > li > .item_link > i,
.mega_main_menu' . $location_class . '.icons-top > .menu_holder > .menu_inner > ul > li > .item_link > .link_content
{
	height:' . ( $current_class->get_option( $location_name . '_first_level_item_height', 1 ) / 2 ) . 'px;
	line-height:' . ( $current_class->get_option( $location_name . '_first_level_item_height', 1 ) / 3 ) . 'px;
}
.mega_main_menu' . $location_class . '.icons-top > .menu_holder > .menu_inner > ul > li > .item_link.with_icon > .link_content > .link_text
{
	height:' . ( $current_class->get_option( $location_name . '_first_level_item_height', 1 ) / 3 ) . 'px;
}
.mega_main_menu' . $location_class . '.icons-top > .menu_holder > .menu_inner > ul > li > .item_link > i
{
	padding-top:' . ( $current_class->get_option( $location_name . '_first_level_item_height', 1 ) / 3 / 2 ) . 'px;
}
.mega_main_menu' . $location_class . '.icons-top > .menu_holder > .menu_inner > ul > li > .item_link > .link_content
{
	padding-bottom:' . ( $current_class->get_option( $location_name . '_first_level_item_height', 1 ) / 3 / 2 ) . 'px;
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.nav_buddypress > .item_link > i:before
{	
	width:' . ( $current_class->get_option( $location_name . '_first_level_item_height', 1 ) * 0.6 ) . 'px;
}


/* initial_height_sticky */
.mega_main_menu' . $location_class . ' > .menu_holder.sticky_container > .menu_inner > .nav_logo > .logo_link, 
.mega_main_menu' . $location_class . ' > .menu_holder.sticky_container > .menu_inner > .nav_logo > .mobile_toggle, 
.mega_main_menu' . $location_class . ' > .menu_holder.sticky_container > .menu_inner > .nav_logo > .mobile_toggle > .mobile_button, 
.mega_main_menu' . $location_class . ' > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link, 
.mega_main_menu' . $location_class . ' > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link > .link_content, 
.mega_main_menu' . $location_class . ' > .menu_holder.sticky_container > .menu_inner > ul > li.nav_search_box,
.mega_main_menu' . $location_class . '.icons-left > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link > i,
.mega_main_menu' . $location_class . '.icons-right > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link > i,
.mega_main_menu' . $location_class . '.icons-top > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link.disable_icon > .link_content,
.mega_main_menu' . $location_class . '.icons-top > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link.menu_item_without_text > i, 
.mega_main_menu' . $location_class . ' > .menu_holder.sticky_container > .menu_inner > ul > li.nav_buddypress > .item_link > i.ci-icon-buddypress-user
{
	height:' . $current_class->get_option( $location_name . '_first_level_item_height_sticky' ) . 'px;
	line-height:' . $current_class->get_option( $location_name . '_first_level_item_height_sticky' ) . 'px;
}
.mega_main_menu' . $location_class . ' > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link > .link_content > .link_text 
{
	height:' . $current_class->get_option( $location_name . '_first_level_item_height_sticky' ) . 'px;
}
.mega_main_menu' . $location_class . '.icons-top > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link > i,
.mega_main_menu' . $location_class . '.icons-top > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link > .link_content
{
	height:' . ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) / 2 ) . 'px;
	line-height:' . ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) / 3 ) . 'px;
}
.mega_main_menu' . $location_class . '.icons-top > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link.with_icon > .link_content > .link_text
{
	height:' . ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) / 3 ) . 'px;
}
.mega_main_menu' . $location_class . '.icons-top > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link > i
{
	padding-top:' . ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) / 3 / 2 ) . 'px;
}
.mega_main_menu' . $location_class . '.icons-top > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link > .link_content
{
	padding-bottom:' . ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) / 3 / 2 ) . 'px;
}
.mega_main_menu' . $location_class . ' > .menu_holder.sticky_container > .menu_inner > ul > li.nav_buddypress > .item_link > i:before
{	
	width:' . ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) * 0.6 ) . 'px;
}
.mega_main_menu' . $location_class . '.primary_style-buttons > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link 
{
	margin:' . ( ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) - $current_class->get_option( $location_name . '_first_level_button_height', 1 ) ) / 2 ) . 'px 4px;
}


/* initial_height_mobile */
@media (max-width: 767px) { /* DO NOT CHANGE THIS LINE (See = Specific Options -> Responsive Resolution) */
	.mega_main_menu' . $location_class . '
	{
		min-height:' . $current_class->get_option( $location_name . '_first_level_item_height_sticky' ) . 'px;
	}
	.mega_main_menu' . $location_class . '.mobile_minimized-enable > .menu_holder > .menu_inner > .nav_logo > .logo_link, 
	.mega_main_menu' . $location_class . '.mobile_minimized-enable > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle, 
	.mega_main_menu' . $location_class . '.mobile_minimized-enable > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle > .mobile_button, 
	.mega_main_menu' . $location_class . '.mobile_minimized-enable > .menu_holder > .menu_inner > ul > li > .item_link, 
	.mega_main_menu' . $location_class . '.mobile_minimized-enable > .menu_holder > .menu_inner > ul > li > .item_link > .link_content, 
	.mega_main_menu' . $location_class . '.mobile_minimized-enable > .menu_holder > .menu_inner > ul > li.nav_search_box,
	.mega_main_menu' . $location_class . '.mobile_minimized-enable.icons-left > .menu_holder > .menu_inner > ul > li > .item_link > i,
	.mega_main_menu' . $location_class . '.mobile_minimized-enable.icons-right > .menu_holder > .menu_inner > ul > li > .item_link > i,
	.mega_main_menu' . $location_class . '.mobile_minimized-enable.icons-top > .menu_holder > .menu_inner > ul > li > .item_link.disable_icon > .link_content,
	.mega_main_menu' . $location_class . '.mobile_minimized-enable.icons-top > .menu_holder > .menu_inner > ul > li > .item_link.menu_item_without_text > i, 
	.mega_main_menu' . $location_class . '.mobile_minimized-enable > .menu_holder > .menu_inner > ul > li.nav_buddypress > .item_link > i.ci-icon-buddypress-user
	{
		height:' . $current_class->get_option( $location_name . '_first_level_item_height_sticky' ) . 'px;
		line-height:' . $current_class->get_option( $location_name . '_first_level_item_height_sticky' ) . 'px;
	}
	.mega_main_menu' . $location_class . '.mobile_minimized-enable > .menu_holder > .menu_inner > ul > li > .item_link > .link_content > .link_text 
	{
		height:' . $current_class->get_option( $location_name . '_first_level_item_height_sticky' ) . 'px;
	}
	.mega_main_menu' . $location_class . '.mobile_minimized-enable.icons-top > .menu_holder > .menu_inner > ul > li > .item_link > i,
	.mega_main_menu' . $location_class . '.mobile_minimized-enable.icons-top > .menu_holder > .menu_inner > ul > li > .item_link > .link_content
	{
		height:' . ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) / 2 ) . 'px;
		line-height:' . ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) / 3 ) . 'px;
	}
	.mega_main_menu' . $location_class . '.mobile_minimized-enable.icons-top > .menu_holder > .menu_inner > ul > li > .item_link > i
	{
		padding-top:' . ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) / 3 / 2 ) . 'px;
	}
	.mega_main_menu' . $location_class . '.mobile_minimized-enable.icons-top > .menu_holder > .menu_inner > ul > li > .item_link > .link_content
	{
		padding-bottom:' . ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) / 3 / 2 ) . 'px;
	}
	.mega_main_menu' . $location_class . '.mobile_minimized-enable > .menu_holder > .menu_inner > ul > li.nav_buddypress > .item_link > i:before
	{	
		width:' . ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) * 0.6 ) . 'px;
	}
	.mega_main_menu' . $location_class . '.primary_style-buttons > .menu_holder > .menu_inner > ul > li > .item_link 
	{
		margin:' . ( ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) - $current_class->get_option( $location_name . '_first_level_button_height', 1 ) ) / 2 ) . 'px 4px;
	}
}


/* style-buttons */
.mega_main_menu' . $location_class . '.primary_style-buttons > .menu_holder > .menu_inner > ul > li > .item_link, 
.mega_main_menu' . $location_class . '.primary_style-buttons > .menu_holder > .menu_inner > ul > li > .item_link > .link_content, 
.mega_main_menu' . $location_class . '.primary_style-buttons.icons-left > .menu_holder > .menu_inner > ul > li > .item_link > i,
.mega_main_menu' . $location_class . '.primary_style-buttons.icons-right > .menu_holder > .menu_inner > ul > li > .item_link > i,
.mega_main_menu' . $location_class . '.primary_style-buttons.icons-top > .menu_holder > .menu_inner > ul > li > .item_link.disable_icon > .link_content,
.mega_main_menu' . $location_class . '.primary_style-buttons.icons-top > .menu_holder > .menu_inner > ul > li > .item_link.menu_item_without_text > i, 
.mega_main_menu' . $location_class . '.primary_style-buttons > .menu_holder > .menu_inner > ul > li.nav_buddypress > .item_link > i.ci-icon-buddypress-user
{
	height:' . $current_class->get_option( $location_name . '_first_level_button_height' ) . 'px;
	line-height:' . $current_class->get_option( $location_name . '_first_level_button_height' ) . 'px;
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link > i
{
	width:' . ( $current_class->get_option( $location_name . '_menu_first_level_icon_font') + 15 ) . 'px;
}
.mega_main_menu' . $location_class . '.icons-left > .menu_holder > .menu_inner > ul > li > .item_link.with_icon > .link_content
{
	margin-left:' . ( $current_class->get_option( $location_name . '_menu_first_level_icon_font') + 15 ) . 'px;
}
.mega_main_menu' . $location_class . '.icons-right > .menu_holder > .menu_inner > ul > li > .item_link.with_icon > .link_content
{
	margin-right:' . ( $current_class->get_option( $location_name . '_menu_first_level_icon_font') + 15 ) . 'px;
}
.mega_main_menu' . $location_class . '.primary_style-buttons > .menu_holder > .menu_inner > ul > li > .item_link > .link_content > .link_text 
{
	height:' . $current_class->get_option( $location_name . '_first_level_button_height' ) . 'px;
}
.mega_main_menu' . $location_class . '.primary_style-buttons > .menu_holder > .menu_inner > ul > li > .item_link 
{
	margin:' . ( ( $current_class->get_option( $location_name . '_first_level_item_height', 1 ) - $current_class->get_option( $location_name . '_first_level_button_height', 1 ) ) / 2 ) . 'px 4px;
}
.mega_main_menu' . $location_class . '.primary_style-buttons.icons-top > .menu_holder > .menu_inner > ul > li > .item_link > i,
.mega_main_menu' . $location_class . '.primary_style-buttons.icons-top > .menu_holder > .menu_inner > ul > li > .item_link > .link_content
{
	height:' . ( $current_class->get_option( $location_name . '_first_level_button_height', 1 ) / 2 ) . 'px;
	line-height:' . ( $current_class->get_option( $location_name . '_first_level_button_height', 1 ) / 3 ) . 'px;
}
.mega_main_menu' . $location_class . '.primary_style-buttons.icons-top > .menu_holder > .menu_inner > ul > li > .item_link.with_icon > .link_content > .link_text 
{
	height:' . ( $current_class->get_option( $location_name . '_first_level_button_height', 1 ) / 3 ) . 'px;
}
.mega_main_menu' . $location_class . '.primary_style-buttons.icons-top > .menu_holder > .menu_inner > ul > li > .item_link > i
{
	padding-top:' . ( $current_class->get_option( $location_name . '_first_level_button_height', 1 ) / 3 / 2 ) . 'px;
}
.mega_main_menu' . $location_class . '.primary_style-buttons.icons-top > .menu_holder > .menu_inner > ul > li > .item_link > .link_content
{
	padding-bottom:' . ( $current_class->get_option( $location_name . '_first_level_button_height', 1 ) / 3 / 2 ) . 'px;
}


/* vertical */
.mega_main_menu' . $location_class . '.direction-vertical > .menu_holder > .menu_inner > ul > li > .item_link, 
.mega_main_menu' . $location_class . '.direction-vertical > .menu_holder > .menu_inner > ul > li > .item_link > .link_content, 
.mega_main_menu' . $location_class . '.direction-vertical > .menu_holder > .menu_inner > ul > li.nav_search_box,
.mega_main_menu' . $location_class . '.direction-vertical.icons-top > .menu_holder > .menu_inner > ul > li > .item_link.disable_icon > .link_content
{
	min-height:' . $current_class->get_option( $location_name . '_first_level_item_height' ) . 'px;
}
.mega_main_menu' . $location_class . '.direction-vertical > .menu_holder > .menu_inner > ul > li > .item_link > .link_content > .link_text
{
	min-height:' . $current_class->get_option( $location_name . '_first_level_item_height' ) . 'px;
}
.mega_main_menu' . $location_class . '.direction-vertical.icons-top > .menu_holder > .menu_inner > ul > li > .item_link > .link_content
{
	min-height:' . ( $current_class->get_option( $location_name . '_first_level_item_height', 1 ) / 2 ) . 'px;
}
.mega_main_menu' . $location_class . '.direction-vertical.icons-top > .menu_holder > .menu_inner > ul > li > .item_link.with_icon > .link_content > .link_text
{
	min-height:' . ( $current_class->get_option( $location_name . '_first_level_item_height', 1 ) / 3 ) . 'px;
}


.mega_main_menu' . $location_class . '.direction-vertical > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link, 
.mega_main_menu' . $location_class . '.direction-vertical > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link > .link_content, 
.mega_main_menu' . $location_class . '.direction-vertical > .menu_holder.sticky_container > .menu_inner > ul > li.nav_search_box,
.mega_main_menu' . $location_class . '.direction-vertical.icons-top > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link.disable_icon > .link_content
{
	min-height:' . $current_class->get_option( $location_name . '_first_level_item_height_sticky' ) . 'px;
}
.mega_main_menu' . $location_class . '.direction-vertical > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link > .link_content > .link_text 
{
	min-height:' . $current_class->get_option( $location_name . '_first_level_item_height_sticky' ) . 'px;
}
.mega_main_menu' . $location_class . '.direction-vertical.icons-top > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link > .link_content
{
	min-height:' . ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) / 2 ) . 'px;
}
.mega_main_menu' . $location_class . '.direction-vertical.icons-top > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link.with_icon > .link_content > .link_text
{
	min-height:' . ( $current_class->get_option( $location_name . '_first_level_item_height_sticky', 1 ) / 3 ) . 'px;
}


.mega_main_menu' . $location_class . '.direction-vertical.primary_style-buttons > .menu_holder > .menu_inner > ul > li > .item_link, 
.mega_main_menu' . $location_class . '.direction-vertical.primary_style-buttons > .menu_holder > .menu_inner > ul > li > .item_link > .link_content, 
.mega_main_menu' . $location_class . '.direction-vertical.primary_style-buttons.icons-top > .menu_holder > .menu_inner > ul > li > .item_link.disable_icon > .link_content
{
	min-height:' . $current_class->get_option( $location_name . '_first_level_button_height' ) . 'px;
}
.mega_main_menu' . $location_class . '.direction-vertical.primary_style-buttons > .menu_holder > .menu_inner > ul > li > .item_link > .link_content > .link_text 
{
	min-height:' . $current_class->get_option( $location_name . '_first_level_button_height' ) . 'px;
}
.mega_main_menu' . $location_class . '.direction-vertical.primary_style-buttons.icons-top > .menu_holder > .menu_inner > ul > li > .item_link > .link_content
{
	min-height:' . ( $current_class->get_option( $location_name . '_first_level_button_height', 1 ) / 2 ) . 'px;
}
.mega_main_menu' . $location_class . '.direction-vertical.primary_style-buttons.icons-top > .menu_holder > .menu_inner > ul > li > .item_link.with_icon > .link_content > .link_text 
{
	min-height:' . ( $current_class->get_option( $location_name . '_first_level_button_height', 1 ) / 3 ) . 'px;
}


/* color_scheme */
.mega_main_menu' . $location_class . ' > .menu_holder > .mmm_fullwidth_container
{
	' . mm_common::css_gradient( $skin[ $location_name . '_menu_bg_gradient' ] ) . '
}
.mega_main_menu' . $location_class . ' > .menu_holder > .mmm_fullwidth_container
{
	' . mm_common::css_bg_image( $skin[ $location_name . '_menu_bg_image' ] ) . '	
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle > .mobile_button,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link .link_text,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.nav_search_box input,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li .post_details > .post_title,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li .post_details > .post_title > .item_link
{
	' . mm_common::css_font( $skin[ $location_name . '_menu_first_level_link_font' ] ) . '
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.nav_search_box *
{
	font-size:' . $skin[ $location_name . '_menu_first_level_icon_font' ] . 'px;
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link > i
{
	font-size:' . $skin[ $location_name . '_menu_first_level_icon_font' ] . 'px;
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link > i:before
{	
	width:' . $skin[ $location_name . '_menu_first_level_icon_font' ] . 'px;
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle > .mobile_button,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link *
{
	color: ' . $skin[ $location_name . '_menu_first_level_link_color' ] . ';
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link:after
{
	border-color: ' . $skin[ $location_name . '_menu_first_level_link_color' ] . ';
	color: ' . $skin[ $location_name . '_menu_first_level_link_color' ] . ';
}
.mega_main_menu' . $location_class . '.primary_style-buttons > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link
{
	' . mm_common::css_gradient( $skin[ $location_name . '_menu_first_level_link_bg' ] ) . '
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li:hover > .item_link,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link:hover,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link:focus,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.keep_open > .item_link,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.current-page-ancestor > .item_link,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.current-post-ancestor > .item_link,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.current-menu-item > .item_link
{
	' . mm_common::css_gradient( $skin[ $location_name . '_menu_first_level_link_bg_hover' ] ) . '
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.nav_search_box > .mega_main_menu_searchform
{
	background-color:' . $skin[ $location_name . '_menu_search_bg' ] . ';
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.nav_search_box .field,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.nav_search_box *,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li .icosearch
{
	color: ' . $skin[ $location_name . '_menu_search_color' ] . ';
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li:hover > .item_link,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link:hover *,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link:hover,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .item_link:focus,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.keep_open > .item_link *,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li:hover > .item_link *,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link *,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.current-page-ancestor > .item_link *,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.current-post-ancestor > .item_link *,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.current-menu-item > .item_link *
{
	color: ' . $skin[ $location_name . '_menu_first_level_link_color_hover' ] . ';
	border-color: ' . $skin[ $location_name . '_menu_first_level_link_color_hover' ] . ';
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link:after,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.current-page-ancestor > .item_link:after,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.current-post-ancestor > .item_link:after,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.current-menu-item > .item_link:after,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li:hover > .item_link:after
{
	border-color: ' . $skin[ $location_name . '_menu_first_level_link_color_hover' ] . ';
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li.default_dropdown .mega_dropdown,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li > .mega_dropdown,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li .mega_dropdown > li .post_details
{
	' . mm_common::css_gradient( $skin[ $location_name . '_menu_dropdown_wrapper_gradient' ] ) . '
}
.mega_main_menu' . $location_class . ' .mega_dropdown *
{
	color: ' . $skin[ $location_name . '_menu_dropdown_plain_text_color' ] . ';
}
.mega_main_menu' . $location_class . ' ul li .mega_dropdown > li > .item_link,
.mega_main_menu' . $location_class . ' ul li .mega_dropdown > li > .item_link .link_text,
.mega_main_menu' . $location_class . ' ul li .mega_dropdown,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li .post_details > .post_description
{
	' . mm_common::css_font( $skin[ $location_name . '_menu_dropdown_link_font' ] ) . '
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul li .mega_dropdown > li > .item_link.with_icon
{
	line-height: ' . $skin[ $location_name . '_menu_dropdown_icon_font' ] . 'px;
	min-height: ' . $skin[ $location_name . '_menu_dropdown_icon_font' ] . 'px;
}
.mega_main_menu' . $location_class . ' li.default_dropdown > .mega_dropdown > .menu-item > .item_link > i,
.mega_main_menu' . $location_class . ' li.tabs_dropdown > .mega_dropdown > .menu-item > .item_link > i,
.mega_main_menu' . $location_class . ' li.widgets_dropdown > .mega_dropdown > .menu-item > .item_link > i,
.mega_main_menu' . $location_class . ' li.multicolumn_dropdown > .mega_dropdown > .menu-item > .item_link > i
{
	width: ' . $current_class->get_option( $location_name . '_menu_dropdown_icon_font' ) . 'px;
	height: ' . $current_class->get_option( $location_name . '_menu_dropdown_icon_font' ) . 'px;
	line-height: ' . $current_class->get_option( $location_name . '_menu_dropdown_icon_font' ) . 'px;
	font-size: ' . $current_class->get_option( $location_name . '_menu_dropdown_icon_font' ) . 'px;
	margin-top: -' . ( is_numeric( $current_class->get_option( $location_name . '_menu_dropdown_icon_font', 12 ) ) ? ( $current_class->get_option( $location_name . '_menu_dropdown_icon_font', 12 ) / 2 ) : ( 12 / 2 ) ) . 'px;
}
.mega_main_menu' . $location_class . ' li.default_dropdown > .mega_dropdown > .menu-item > .item_link.with_icon > .link_content,
.mega_main_menu' . $location_class . ' li.tabs_dropdown > .mega_dropdown > .menu-item > .item_link.with_icon > .link_content,
.mega_main_menu' . $location_class . ' li.widgets_dropdown > .mega_dropdown > .menu-item > .item_link.with_icon > .link_content,
.mega_main_menu' . $location_class . ' li.multicolumn_dropdown > .mega_dropdown > .menu-item > .item_link.with_icon > .link_content
{
	margin-left: ' . ( is_numeric( $current_class->get_option( $location_name . '_menu_dropdown_icon_font', 12 ) ) ? ( $current_class->get_option( $location_name . '_menu_dropdown_icon_font', 12 ) + 8 ) : ( 12 + 8 ) ) . 'px;
}
.mega_main_menu' . $location_class . '.language_direction-rtl li.default_dropdown > .mega_dropdown > .menu-item > .item_link.with_icon > .link_content,
.mega_main_menu' . $location_class . '.language_direction-rtl li.tabs_dropdown > .mega_dropdown > .menu-item > .item_link.with_icon > .link_content,
.mega_main_menu' . $location_class . '.language_direction-rtl li.widgets_dropdown > .mega_dropdown > .menu-item > .item_link.with_icon > .link_content,
.mega_main_menu' . $location_class . '.language_direction-rtl li.multicolumn_dropdown > .mega_dropdown > .menu-item > .item_link.with_icon > .link_content
{
	margin-right: ' . ( is_numeric( $current_class->get_option( $location_name . '_menu_dropdown_icon_font', 12 ) ) ? ( $current_class->get_option( $location_name . '_menu_dropdown_icon_font', 12 ) + 8 ) : ( 12 + 8 ) ) . 'px;
}
.mega_main_menu' . $location_class . ' li.default_dropdown .mega_dropdown > li > .item_link,
.mega_main_menu' . $location_class . ' li.widgets_dropdown .mega_dropdown > li > .item_link,
.mega_main_menu' . $location_class . ' li.multicolumn_dropdown .mega_dropdown > li > .item_link,
.mega_main_menu' . $location_class . ' li.grid_dropdown .mega_dropdown > li > .item_link
{
	' . mm_common::css_gradient( $skin[ $location_name . '_menu_dropdown_link_bg' ] ) . '
	color: ' . $skin[ $location_name . '_menu_dropdown_link_color' ] . ';
}
.mega_main_menu' . $location_class . ' li .post_details > .post_icon > i,
.mega_main_menu' . $location_class . ' li .mega_dropdown .item_link *,
.mega_main_menu' . $location_class . ' li .mega_dropdown a,
.mega_main_menu' . $location_class . ' li .mega_dropdown a *,
.mega_main_menu' . $location_class . ' li li .post_details a
{
	color: ' . $skin[ $location_name . '_menu_dropdown_link_color' ] . ';
}
.mega_main_menu' . $location_class . ' li.default_dropdown > .mega_dropdown > .menu-item > .item_link:before
{
	border-color: ' . $skin[ $location_name . '_menu_dropdown_link_color' ] . ';
}
.mega_main_menu' . $location_class . ' li.default_dropdown > .mega_dropdown > li > .item_link
{
	border-color: ' . $skin[ $location_name . '_menu_dropdown_link_border_color' ] . ';
}
.mega_main_menu' . $location_class . ' ul .mega_dropdown > li.current-menu-ancestor > .item_link,
.mega_main_menu' . $location_class . ' ul .mega_dropdown > li.current-menu-item > .item_link,
.mega_main_menu' . $location_class . ' ul .mega_dropdown > li > .item_link:focus,
.mega_main_menu' . $location_class . ' ul .mega_dropdown > li > .item_link:hover,
.mega_main_menu' . $location_class . ' ul li.post_type_dropdown > .mega_dropdown > li > .processed_image:hover
{
	' . mm_common::css_gradient( $skin[ $location_name . '_menu_dropdown_link_bg_hover' ] ) . '
	color: ' . $skin[ $location_name . '_menu_dropdown_link_color_hover' ] . ';
}
.mega_main_menu' . $location_class . ' .mega_dropdown > li.current-menu-ancestor > .item_link *,
.mega_main_menu' . $location_class . ' .mega_dropdown > li.current-menu-item > .item_link *,
.mega_main_menu' . $location_class . ' .mega_dropdown > li > .item_link:focus *,
.mega_main_menu' . $location_class . ' .mega_dropdown > li > .item_link:hover *,
.mega_main_menu' . $location_class . ' li.post_type_dropdown > .mega_dropdown > li > .processed_image:hover > .cover > a > i
{
	color: ' . $skin[ $location_name . '_menu_dropdown_link_color_hover' ] . ';
}
.mega_main_menu' . $location_class . ' li.default_dropdown > .mega_dropdown > .menu-item.current-menu-ancestor > .item_link:before,
.mega_main_menu' . $location_class . ' li.default_dropdown > .mega_dropdown > .menu-item.current-menu-item > .item_link:before,
.mega_main_menu' . $location_class . ' li.default_dropdown > .mega_dropdown > .menu-item > .item_link:focus:before,
.mega_main_menu' . $location_class . ' li.default_dropdown > .mega_dropdown > .menu-item > .item_link:hover:before
{
	border-color: ' . $skin[ $location_name . '_menu_dropdown_link_color_hover' ] . ';
}
.mega_main_menu' . $location_class . ' li.default_dropdown > .mega_dropdown > li:first-child:last-child > .item_link,
.mega_main_menu' . $location_class . '.direction-vertical > .menu_holder > .menu_inner > ul > li:first-child:last-child > .item_link,
.mega_main_menu' . $location_class . '.primary_style-buttons > .menu_holder > .menu_inner > ul > li > .item_link,
.mega_main_menu' . $location_class . '.primary_style-buttons > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle,
.mega_main_menu' . $location_class . '.primary_style-buttons.direction-vertical > .menu_holder > .menu_inner > ul > li:first-child > .item_link,
.mega_main_menu' . $location_class . ' > .menu_holder > .mmm_fullwidth_container,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > li .post_details,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .mega_dropdown
{
	border-radius: ' . $skin[ $location_name . '_corners_rounding' ] . 'px;
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > span.nav_logo,
.mega_main_menu' . $location_class . '.primary_style-flat.direction-horizontal.first-lvl-align-left.no-logo > .menu_holder > .menu_inner > ul > li:first-child > .item_link,
.mega_main_menu' . $location_class . '.primary_style-flat.direction-horizontal.first-lvl-align-center.no-logo.no-search.no-woo_cart > .menu_holder > .menu_inner > ul > li:first-child > .item_link
{
	border-radius: ' . $skin[ $location_name . '_corners_rounding' ] . 'px 0px 0px ' . $skin[ $location_name . '_corners_rounding' ] . 'px;
}
.mega_main_menu' . $location_class . '.primary_style-flat.direction-horizontal.no-search > .menu_holder > .menu_inner > ul > li.nav_woo_cart > .item_link,
.mega_main_menu' . $location_class . '.primary_style-flat.direction-horizontal.no-search.no-woo_cart > .menu_holder > .menu_inner > ul > li.nav_buddypress > .item_link,
.mega_main_menu' . $location_class . '.primary_style-flat.direction-horizontal.first-lvl-align-right.no-search.no-woo_cart > .menu_holder > .menu_inner > ul > li:last-child > .item_link,
.mega_main_menu' . $location_class . '.primary_style-flat.direction-horizontal.first-lvl-align-center.no-search.no-woo_cart > .menu_holder > .menu_inner > ul > li:last-child > .item_link
{
	border-radius: 0px ' . $skin[ $location_name . '_corners_rounding' ] . 'px ' . $skin[ $location_name . '_corners_rounding' ] . 'px 0px;
}
.mega_main_menu' . $location_class . ' li.default_dropdown > .mega_dropdown > li:first-child > .item_link,
.mega_main_menu' . $location_class . '.direction-vertical > .menu_holder > .menu_inner > ul > li:first-child > .item_link
{
	border-radius: ' . $skin[ $location_name . '_corners_rounding' ] . 'px ' . $skin[ $location_name . '_corners_rounding' ] . 'px 0px 0px;
}
.mega_main_menu' . $location_class . ' li.default_dropdown > .mega_dropdown > li:last-child > .item_link,
.mega_main_menu' . $location_class . '.direction-vertical > .menu_holder > .menu_inner > ul > li:last-child > .item_link
{
	border-radius: 0px 0px ' . $skin[ $location_name . '_corners_rounding' ] . 'px ' . $skin[ $location_name . '_corners_rounding' ] . 'px;
}
.mega_main_menu' . $location_class . ' .widgets_dropdown > .mega_dropdown > li.default_dropdown .mega_dropdown > li > .item_link,
.mega_main_menu' . $location_class . ' .multicolumn_dropdown > .mega_dropdown > li.default_dropdown .mega_dropdown > li > .item_link,
.mega_main_menu' . $location_class . ' ul .nav_search_box .mega_main_menu_searchform,
.mega_main_menu' . $location_class . ' .tabs_dropdown .mega_dropdown > li > .item_link,
.mega_main_menu' . $location_class . ' .tabs_dropdown .mega_dropdown > li > .mega_dropdown > li > .item_link,
.mega_main_menu' . $location_class . ' .widgets_dropdown > .mega_dropdown > li > .item_link,
.mega_main_menu' . $location_class . ' .multicolumn_dropdown > .mega_dropdown > li > .item_link,
.mega_main_menu' . $location_class . ' .grid_dropdown > .mega_dropdown > li > .item_link,
.mega_main_menu' . $location_class . ' .grid_dropdown > .mega_dropdown > li .processed_image,
.mega_main_menu' . $location_class . ' .post_type_dropdown > .mega_dropdown > li .item_link,
.mega_main_menu' . $location_class . ' .post_type_dropdown > .mega_dropdown > li .processed_image
{
	border-radius: ' . ( $current_class->get_option( $location_name . '_corners_rounding', 1 ) / 2 ) . 'px;
}
';
			$additional_styles_presets = $current_class->get_option( 'additional_styles_presets' );
			if ( isset( $additional_styles_presets ) && is_array( $additional_styles_presets ) && count( $additional_styles_presets ) > 0 ) {
				$out .= '/* additional_styles */ ';
				foreach ( $additional_styles_presets as $key => $value ) {
					$out .= '
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .menu-item.additional_style_' . $key . ' > .item_link
{
	' . mm_common::css_gradient( $value['bg_gradient'] ) . '
	color: ' . $value['text_color'] . ';
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .menu-item.additional_style_' . $key . ' > .item_link > i
{
	color: ' . $value['text_color'] . ';
	font-size: ' . $value[ 'icon' ]['font_size'] . 'px;
}
.mega_main_menu' . $location_class . ' ul li .mega_dropdown .menu-item.additional_style_' . $key . ' > .item_link > i
{
	width: ' . $value[ 'icon' ]['font_size'] . 'px;
	height: ' . $value[ 'icon' ]['font_size'] . 'px;
	line-height: ' . $value[ 'icon' ]['font_size'] . 'px;
	font-size: ' . $value[ 'icon' ]['font_size'] . 'px;
	margin-top: -' . ( $value[ 'icon' ]['font_size'] / 2 ) . 'px;
}
.mega_main_menu' . $location_class . ' ul li .mega_dropdown > .menu-item.additional_style_' . $key . ' > .item_link.with_icon > span
{
	margin-left: ' . ( $value[ 'icon' ]['font_size'] + 8 ) . 'px;
}
.mega_main_menu' . $location_class . '.language_direction-rtl ul li .mega_dropdown > .menu-item.additional_style_' . $key . ' > .item_link.with_icon > span
{
	margin-right: ' . ( $value[ 'icon' ]['font_size'] + 8 ) . 'px;
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .menu-item.additional_style_' . $key . ' > .item_link *,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .menu-item.additional_style_' . $key . ' > .item_link .link_content
{
	color: ' . $value['text_color'] . ';
	' . mm_common::css_font( $value[ 'font' ] ) . '
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > .menu-item.current-menu-ancestor.additional_style_' . $key . ' > .item_link,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > .menu-item.current-page-ancestor.additional_style_' . $key . ' > .item_link,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul > .menu-item.current-post-ancestor.additional_style_' . $key . ' > .item_link,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .menu-item.current-menu-item.additional_style_' . $key . ' > .item_link,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .menu-item.additional_style_' . $key . ' > .item_link:hover,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .menu-item.additional_style_' . $key . ' > .item_link:focus
{
	' . mm_common::css_gradient( $value['bg_gradient_hover'] ) . '
	color: ' . $value['text_color_hover'] . ';
}
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .menu-item.current-menu-ancestor.additional_style_' . $key . ' > .item_link > *,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .menu-item.current-page-ancestor.additional_style_' . $key . ' > .item_link > *,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .menu-item.current-post-ancestor.additional_style_' . $key . ' > .item_link > *,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .menu-item.additional_style_' . $key . ' > .item_link:focus > *,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .menu-item.additional_style_' . $key . ' > .item_link:hover > i,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .menu-item.additional_style_' . $key . ' > .item_link:hover *,
.mega_main_menu' . $location_class . ' > .menu_holder > .menu_inner > ul .menu-item.additional_style_' . $key . ' > .item_link:hover .link_content
{
	color: ' . $value['text_color_hover'] . ';
}
';
if ( $value[ 'icon' ]['font_size'] > $value[ 'font' ]['font_size']) {
					$out .= '
.mega_main_menu' . $location_class . '.language_direction-ltr > .menu_holder > .menu_inner > ul li .mega_dropdown > .menu-item.additional_style_' . $key . ' > .item_link.with_icon
{
	line-height: ' . $value[ 'icon' ]['font_size'] . 'px;
	min-height: ' . $value[ 'icon' ]['font_size'] . 'px;
}
.mega_main_menu' . $location_class . '.language_direction-ltr li.default_dropdown > .mega_dropdown > .menu-item.additional_style_' . $key . ' > .item_link.with_icon > .link_content, 
.mega_main_menu' . $location_class . '.language_direction-ltr li.tabs_dropdown > .mega_dropdown > .menu-item.additional_style_' . $key . ' > .item_link.with_icon > .link_content, 
.mega_main_menu' . $location_class . '.language_direction-ltr li.widgets_dropdown > .mega_dropdown > .menu-item.additional_style_' . $key . ' > .item_link.with_icon > .link_content, 
.mega_main_menu' . $location_class . '.language_direction-ltr li.multicolumn_dropdown > .mega_dropdown > .menu-item.additional_style_' . $key . ' > .item_link.with_icon > .link_content
{
	margin-left: ' . ( $value[ 'icon' ]['font_size'] + 15 ) . 'px;
}
';
}
				}
			}
		} //foreach ( $mega_menu_locations as $key => $location_name ) {
/* set_of_custom_icons */
$set_of_custom_icons = $current_class->get_option( 'set_of_custom_icons' );
if ( is_array( $set_of_custom_icons ) && count( $set_of_custom_icons ) > 0 ) {
	$out .= '/* set_of_custom_icons */ ';
	foreach ( $set_of_custom_icons as $value ) {
		$icon_name = str_replace( array( '/', strrchr( $value[ 'custom_icon' ], '.' ) ), '', strrchr( $value[ 'custom_icon' ], '/' ) );
		$out .= '
i.ci-icon-' . $icon_name . ':before
{
	background-image: url(' . $value[ 'custom_icon' ] . ');
}
';
		if ( isset( $value[ 'custom_icon_hover' ] ) && $value[ 'custom_icon_hover' ] != '' ) {
		$out .= '
.mega_main_menu .menu-item.current-menu-ancestor > .item_link > i.ci-icon-' . $icon_name . ':before,
.mega_main_menu .menu-item.current-page-ancestor > .item_link > i.ci-icon-' . $icon_name . ':before,
.mega_main_menu .menu-item.current-post-ancestor > .item_link > i.ci-icon-' . $icon_name . ':before,
.mega_main_menu .menu-item.current-menu-item > .item_link > i.ci-icon-' . $icon_name . ':before,
.mega_main_menu .menu-item:hover > .item_link > i.ci-icon-' . $icon_name . ':before,
i.ci-icon-' . $icon_name . ':hover:before
{
	background-image: url(' . $value[ 'custom_icon_hover' ] . ');
}
';
		}
	}
}
/* skin extend */
if ( function_exists( 'has_filter' ) ) {
	if ( has_filter( 'mmm_skin_extend' ) ) {
		$out .= '/* skin extend */' . apply_filters( 'mmm_skin_extend', $skin_extend = '' );
	}
}
/* custom css */
$custom_css = $current_class->get_option( 'custom_css' );
$out .= ( isset( $custom_css ) && !empty( $custom_css ) ) 
	? '/* custom css */ ' . $custom_css 
	: '';
$out .= ' /*' . date("Y-m-d H:i") . '*/';
/* RETURN */
	return $out;
	}
}
