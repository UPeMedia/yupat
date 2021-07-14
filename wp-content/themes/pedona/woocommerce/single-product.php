<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     10.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

<div class="main-container">

	<div class="page-content">
		<div class="breadcrumbs-wrapper">
			<div class="container">
				<div class="breadcrumbs-inner">
					<?php
						/**
						 * woocommerce_before_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>
				</div>
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>
				<?php endif; ?>
			</div>
		</div>
		<div class="product-page">
			<div class="product-view">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'single-product' ); ?>

				<?php endwhile; // end of the loop. ?>

				<?php
					/**
					 * woocommerce_after_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					do_action( 'woocommerce_after_main_content' );
				?>

				<?php
					/**
					 * woocommerce_sidebar hook
					 *
					 * @hooked woocommerce_get_sidebar - 10
					 */
					//do_action( 'woocommerce_sidebar' );
				?>
			</div> 
		</div> 
	</div>
	<!-- brand logo -->
	<?php 
		if(isset($pedona_opt['inner_brand']) && function_exists('pedona_brands_shortcode') && shortcode_exists( 'ourbrands' ) ){
			if($pedona_opt['inner_brand'] && isset($pedona_opt['brand_logos'][0]) && $pedona_opt['brand_logos'][0]['thumb']!=null) { ?>
				<div class="inner-brands">
					<div class="container">
						<?php if(isset($pedona_opt['inner_brand_title']) && $pedona_opt['inner_brand_title']!=''){ ?>
							<div class="title">
								<h3><?php echo esc_html( $pedona_opt['inner_brand_title'] ); ?></h3>
							</div>
						<?php } ?>
						<?php echo do_shortcode('[ourbrands]'); ?>
					</div>
				</div>
				
			<?php }
		}
	?>
	<!-- end brand logo --> 
</div>
<?php get_footer( 'shop' ); ?>