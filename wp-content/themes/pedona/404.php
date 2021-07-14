<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Pedona_Theme
 * @since Pedona 1.0
 */

$pedona_opt = get_option( 'pedona_opt' );

get_header();

?>
	<div class="main-container error404">
		<div class="container">
			<div class="search-form-wrapper">
				<h2><?php esc_html_e( "OOPS! PAGE NOT BE FOUND", 'pedona' ); ?></h2>
				<p class="home-link"><?php esc_html_e( "Sorry but the page you are looking for does not exist, have been removed, name changed or is temporarity unavailable.", 'pedona' ); ?></p>
				<?php get_search_form(); ?>
				<a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Back to home', 'pedona' ); ?>"><?php esc_html_e( 'Back to home page', 'pedona' ); ?></a>
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
</div>
<?php get_footer(); ?>