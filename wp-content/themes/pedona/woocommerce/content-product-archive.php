<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 30.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$pedona_opt = get_option( 'pedona_opt' );

$pedona_viewmode = Pedona_Class::pedona_show_view_mode();

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;


// Extra post classes
$classes = array();

$count   = $product->get_rating_count();

$pedona_shopclass = Pedona_Class::pedona_shop_class('');

$colwidth = 3;

if($pedona_shopclass=='shop-fullwidth') {
	if(isset($pedona_opt)){
		$woocommerce_loop['columns'] = $pedona_opt['product_per_row_fw'];
		if($woocommerce_loop['columns'] > 0){
			$colwidth = round(12/$woocommerce_loop['columns']);
		}
	}
	$classes[] = ' item-col col-xs-6 col-sm-4 col-md-'.$colwidth ;
} else {
	if(isset($pedona_opt)){
		$woocommerce_loop['columns'] = $pedona_opt['product_per_row'];
		if($woocommerce_loop['columns'] > 0){
			$colwidth = round(12/$woocommerce_loop['columns']);
		}
	}
	$classes[] = ' item-col col-xs-6 col-sm-'.$colwidth ;
}
?>

<div <?php post_class( $classes ); ?>>
	<div class="product-wrapper gridview">
		<div class="list-col4">
			<div class="product-image">
				<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
				
				<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
					
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
			<ul class="actions">
				<li class="quickviewbtn">
					<a class="detail-link quickview" data-quick-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e('Quick View', 'pedona');?></a>
				</li>
				<li class="add-to-cart">
					<?php echo do_shortcode('[add_to_cart id="'.$product->get_id().'"]') ?>
				</li>
				<li class="add-to-wishlist"> 
					<?php if ( class_exists( 'YITH_WCWL' ) ) {
						echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]'));
					} ?>
				</li>
				<li class="add-to-compare">
					<?php if( class_exists( 'YITH_Woocompare' ) ) {
						echo do_shortcode('[yith_compare_button]');
					} ?>
				</li>
			</ul>
		</div>
		<div class="list-col8">
				<div class="category-list">
					<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( '', '', count( $product->get_category_ids() ), 'pedona' ) . ' ', '</span>' ); ?>
					<?php if ($count) { ?>
						<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
					<?php } ?>
				</div>

				<div class="product-name">
					<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
				
				<?php if ( $product->get_price() != '' )  { ?>
					<div class="price-box">
						<?php echo ''.$product->get_price_html(); ?>
					</div>
				<?php } ?>

				
		</div>
	</div>

	<div class="product-wrapper listview">
		<div class="row">
			<div class="list-col4 col-xs-12 col-sm-4">
				<div class="product-image">
					<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
					
					<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
						
					<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
					
				</div>

				<ul class="actions">
					<li class="quickviewbtn">
						<a class="detail-link quickview" data-quick-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e('Quick View', 'pedona');?></a>
					</li>
					<li class="add-to-cart">
						<?php echo do_shortcode('[add_to_cart id="'.$product->get_id().'"]') ?>
					</li>
					<li class="add-to-wishlist"> 
						<?php if ( class_exists( 'YITH_WCWL' ) ) {
							echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]'));
						} ?>
					</li>
					<li class="add-to-compare">
						<?php if( class_exists( 'YITH_Woocompare' ) ) {
							echo do_shortcode('[yith_compare_button]');
						} ?>
					</li>
				</ul>

			</div>
			<div class="list-col8 col-xs-12 col-sm-8">
					<div class="category-list">
						<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( '', '', count( $product->get_category_ids() ), 'pedona' ) . ' ', '</span>'); ?>
					</div>

					<div class="product-name">
						<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</div>

					<?php if ($count) { ?>
						<div class="product-list-rating">
							<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
						</div>
					<?php } ?>
					
					<?php if ( $product->get_price() != '' )  { ?>
						<div class="price-box">
							<?php echo ''.$product->get_price_html(); ?>
						</div>
					<?php } ?>


				<?php if ( has_excerpt() ) { ?>
					<div class="product-desc">
						<?php the_excerpt(); ?>
					</div>
				<?php } ?>

				<div class="count-down">
					<div class="count-down-inner">
						<?php
						$countdown = false;
						$sale_end = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
						/* simple product */
						if($sale_end){
							$countdown = true;
							$sale_end = date('Y/m/d', (int)$sale_end);
							?>
							<div class="countbox hastime" data-time="<?php echo esc_attr($sale_end); ?>"></div>
						<?php } ?>
						<?php /* variable product */
						if($product->has_child()){
							$vsale_end = array();
							
							$pvariables = $product->get_children();
							foreach($pvariables as $pvariable){
								$vsale_end[] = (int)get_post_meta( $pvariable, '_sale_price_dates_to', true );
								
								if( get_post_meta( $pvariable, '_sale_price_dates_to', true ) ){
									$countdown = true;
								}
							}
							if($countdown){
								/* get the latest time */
								$vsale_end_date = max($vsale_end);
								$vsale_end_date = date('Y/m/d', $vsale_end_date);
								?>
								<div class="countbox hastime" data-time="<?php echo esc_attr($vsale_end_date); ?>"></div>
							<?php
							}
						}
						?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>