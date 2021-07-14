<?php
//WooCommerce Ajax
add_action('wp_head','pedona_woo_ajaxurl');
function pedona_woo_ajaxurl() {
?>
<?php
	// Enqueue variation scripts
	wp_enqueue_script( 'wc-add-to-cart-variation' );
}
add_action( 'wp_ajax_product_quickview', 'product_quickview' );
add_action( 'wp_ajax_nopriv_product_quickview', 'product_quickview' );
function product_quickview() {
	global $product, $post, $woocommerce_loop;
	$pedona_opt = get_option( 'pedona_opt' );
	if($_POST['data']){
		$productid = intval( $_POST['data'] );
		$product = get_product( $productid );
		$post = get_post( $productid );
	}
	?>
	<div class="woocommerce product">
		<div class="product-images">
			<?php $image_link = wp_get_attachment_url( $product->get_image_id() );?>
			<div class="main-image images"><img src="<?php echo esc_attr($image_link);?>" alt=" <?php echo esc_attr($product->name);?> " /></div>
			<?php
			$attachment_ids = $product->get_gallery_image_ids();
			if ( $attachment_ids ) { ?>
				<div class="quick-thumbnails">
					<?php $image_link = wp_get_attachment_url( $product->get_image_id() );?>
						<div>
							<a href="<?php echo esc_attr($image_link);?>">
								<?php echo wp_kses($product->get_image('shop_thumbnail'),array(
									'img'=>array(
										'src'=>array(),
										'alt'=>array(),
										'class'=>array(),
										'id'=>array()
									)
								));?>
							</a>
						</div>
					<?php
					$loop = 0;
					$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
					foreach ( $attachment_ids as $attachment_id ) { ?>
						<?php
						$classes = array( 'zoom' );
						if ( $loop == 0 || $loop % $columns == 0 )
							$classes[] = 'first';
						if ( ( $loop + 1 ) % $columns == 0 )
							$classes[] = 'last';
						$image_link = wp_get_attachment_url( $attachment_id );
						if ( ! $image_link )
							continue;
						$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
						$image_class = esc_attr( implode( ' ', $classes ) );
						$image_title = esc_attr( get_the_title( $attachment_id ) );
						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_title, $image ), $attachment_id, $product->ID, $image_class );
						$loop++;
						?>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<div class="product-info">
			<h1><a href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($product->get_title());?></a></h1>
			<div class="price-box" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<p class="price"><?php echo ''.$product->get_price_html(); ?></p>
			</div>
			<a class="see-all" href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($pedona_opt['quickview_link_text']); ?></a>
			<div class="quick-add-to-cart">
				<?php woocommerce_template_single_add_to_cart(); ?>
			</div>
			<div class="quick-desc"><?php echo do_shortcode(get_post($productid)->post_excerpt); ?></div>
			<?php if( function_exists('pedona_product_sharing') ) { ?>
				<div class="social-sharing"><?php pedona_product_sharing(); ?></div>
			<?php } ?>
		</div>
	</div>
	<?php
	die();
}
add_action( 'wp_ajax_get_cartinfo', 'get_cartinfo' );
add_action( 'wp_ajax_nopriv_get_cartinfo', 'get_cartinfo' );
function get_cartinfo() {
	global $woocommerce;
	echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'pedona'), $woocommerce->cart->cart_contents_count);
	echo '|'.$woocommerce->cart->get_cart_total();echo '|'.$woocommerce->cart->get_total().'|'.$woocommerce->cart->cart_contents_count; ?>
	<?php
	die();
}
add_action( 'wp_ajax_get_productinfo', 'get_productinfo' );
add_action( 'wp_ajax_nopriv_get_productinfo', 'get_productinfo' );
function get_productinfo() {
	global $product, $woocommerce_loop;
	$pedona_opt = get_option( 'pedona_opt' );
	$productid = intval( $_POST['data']['pid'] );
	$product = get_product( $productid );
	?>
	<h3><?php esc_html_e('Product is added to cart', 'pedona');?></h3>
	<div class="product-wrapper">
		<div class="product-image">
			<?php echo wp_kses($product->get_image('shop_thumbnail'), array(
				'img'=>array(
					'src'=>array(),
					'height'=>array(),
					'width'=>array(),
					'class'=>array(),
					'alt'=>array(),
				)
			));?>
		</div>
		<div class="product-info">
			<h4><?php echo esc_html($product->get_title());?></h4>
			<p class="price">
				<?php echo ''.$product->get_price_html();?>
			</p>
		</div>
	</div>
	<div class="buttons">
		<a class="button" href="<?php echo get_permalink( wc_get_page_id( 'cart' ) );?>"><?php esc_html_e('View Cart', 'pedona');?></a>
	</div>
	<?php
	die();
}