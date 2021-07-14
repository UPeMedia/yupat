<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     30.5.0
 */

defined( 'ABSPATH' ) || exit;

$pedona_opt = get_option( 'pedona_opt' );

$singleproductsidebar = 'right';
if(isset($pedona_opt['sidebarsingleproduct_pos']) && $pedona_opt['sidebarsingleproduct_pos']!=''){
	$singleproductsidebar = $pedona_opt['sidebarsingleproduct_pos'];
}

?>

<div class="container">
<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>
</div>
<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="row">
			<?php if ( is_active_sidebar( 'sidebar-single_product' ) && ($singleproductsidebar=='left') ) : ?>
			 	<div id="secondary" class="col-xs-12 col-md-3">
			  		<div class="sidebar-border">
			   			<?php dynamic_sidebar( 'sidebar-single_product' ); ?>
			  		</div>
			 	</div><!-- #secondary -->
			<?php endif; ?>	
			<div class="col-xs-12 <?php if ( is_active_sidebar( 'sidebar-single_product' ) ) { echo ' col-md-9'; } ?> product-content">
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<div class="single-product-image">
							<?php
								/**
								 * woocommerce_before_single_product_summary hook
								 *
								 * @hooked woocommerce_show_product_sale_flash - 10
								 * @hooked woocommerce_show_product_images - 20
								 */
								do_action( 'woocommerce_before_single_product_summary' );
							?>
						</div>

					</div>
					<div class="col-xs-12 col-md-6">
						<div class="summary entry-summary single-product-info">
							<div class="product-nav">
								<div class="next-prev">
									<div class="prev"><?php previous_post_link('%link'); ?></div>
									<div class="next"><?php next_post_link('%link'); ?></div>
								</div>
							</div>
						
							<?php
								/**
								 * woocommerce_single_product_summary hook
								 *
								 * @hooked woocommerce_template_single_title - 5
								 * @hooked woocommerce_template_single_rating - 10
								 * @hooked woocommerce_template_single_price - 10
								 * @hooked woocommerce_template_single_excerpt - 20
								 * @hooked woocommerce_template_single_add_to_cart - 30
								 * @hooked woocommerce_template_single_meta - 40
								 * @hooked woocommerce_template_single_sharing - 50
								 */
								do_action( 'woocommerce_single_product_summary' );
							?>
							<div class="single-product-sharing">
								<?php 
								if(function_exists('pedona_product_sharing')) {
									pedona_product_sharing();
								} ?>
							</div>

						</div><!-- .summary -->
					</div>
				</div>
				<div class="product-more-details">
					<?php
						/**
						 * woocommerce_after_single_product_summary hook
						 *
						 * @hooked woocommerce_output_product_data_tabs - 10
						 * @hooked woocommerce_output_related_products - 20
						 */
						do_action( 'woocommerce_after_single_product_summary' );
					?>
					
					<meta itemprop="url" content="<?php the_permalink(); ?>" />
				</div>

				<?php do_action('woocommerce_show_related_products'); ?>
			</div>

			<?php if ( is_active_sidebar( 'sidebar-single_product' ) && ($singleproductsidebar=='right') ) : ?>
			 	<div id="secondary" class="col-xs-12 col-md-3">
			  		<div class="sidebar-border">
			   			<?php dynamic_sidebar( 'sidebar-single_product' ); ?>
			  		</div>
			 	</div><!-- #secondary -->
			<?php endif; ?>	

		</div>
		
	</div>
	
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>