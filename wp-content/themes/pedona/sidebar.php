<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Pedona_Theme
 * @since Pedona 1.0
 */
$pedona_opt = get_option( 'pedona_opt' );
$pedona_blogsidebar = 'right';
if(isset($pedona_opt['sidebarblog_pos']) && $pedona_opt['sidebarblog_pos']!=''){
	$pedona_blogsidebar = $pedona_opt['sidebarblog_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$pedona_blogsidebar = $_GET['sidebar'];
}
$pedona_blogsidebarextraclass = NULl;
if($pedona_blogsidebar=='left') {
	$pedona_blogsidebarextraclass = 'order-md-first';
}
?>
<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="secondary" class="col-12 col-md-3 <?php echo esc_attr($pedona_blogsidebarextraclass);?>">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</div>
<?php endif; ?>