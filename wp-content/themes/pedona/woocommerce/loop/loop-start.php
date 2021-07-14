<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     30.3.0
 */

global $wp_query, $woocommerce_loop;

$pedona_opt = get_option( 'pedona_opt' );

$shoplayout = 'sidebar';
if(isset($pedona_opt['shop_layout']) && $pedona_opt['shop_layout']!=''){
	$shoplayout = $pedona_opt['shop_layout'];
}
if(isset($_GET['layout']) && $_GET['layout']!=''){
	$shoplayout = $_GET['layout'];
}
$shopsidebar = 'left';
if(isset($pedona_opt['sidebarshop_pos']) && $pedona_opt['sidebarshop_pos']!=''){
	$shopsidebar = $pedona_opt['sidebarshop_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$shopsidebar = $_GET['sidebar'];
}
switch($shoplayout) {
	case 'fullwidth':
		Pedona_Class::pedona_shop_class('shop-fullwidth');
		$shopcolclass = 12;
		$shopsidebar = 'none';
		$productcols = 4;
		break;
	default:
		Pedona_Class::pedona_shop_class('shop-sidebar');
		$shopcolclass = 9;
		$productcols = 3;
}

$pedona_viewmode = Pedona_Class::pedona_show_view_mode();
?>
<div class="shop-products products <?php echo esc_attr($pedona_viewmode);?> <?php echo esc_attr($shoplayout);?>">