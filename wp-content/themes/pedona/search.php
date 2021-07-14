<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Pedona_Theme
 * @since Pedona 1.0
 */
$pedona_opt = get_option( 'pedona_opt' );
get_header();
$pedona_bloglayout = 'sidebar';
if(isset($pedona_opt['blog_layout']) && $pedona_opt['blog_layout']!=''){
	$pedona_bloglayout = $pedona_opt['blog_layout'];
}
if(isset($_GET['layout']) && $_GET['layout']!=''){
	$pedona_bloglayout = $_GET['layout'];
}
$pedona_blogsidebar = 'right';
if(isset($pedona_opt['sidebarblog_pos']) && $pedona_opt['sidebarblog_pos']!=''){
	$pedona_blogsidebar = $pedona_opt['sidebarblog_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$pedona_blogsidebar = $_GET['sidebar'];
}
if ( !is_active_sidebar( 'sidebar-1' ) )  {
	$pedona_bloglayout = 'nosidebar';
}
$pedona_mainextraclass = NULl;
if($pedona_blogsidebar=='left') {
	$pedona_mainextraclass = 'order-md-last';
}
switch($pedona_bloglayout) {
	case 'sidebar':
		$pedona_blogclass = 'blog-sidebar';
		$pedona_blogcolclass = 9;
		Pedona_Class::pedona_post_thumbnail_size('pedona-post-thumb');
		break;
	case 'largeimage':
		$pedona_blogclass = 'blog-large';
		$pedona_blogcolclass = 9;
		Pedona_Class::pedona_post_thumbnail_size('pedona-post-thumbwide');
		break;
	case 'grid':
		$pedona_blogclass = 'grid';
		$pedona_blogcolclass = 9;
		Pedona_Class::pedona_post_thumbnail_size('pedona-post-thumbwide');
		break;
	default:
		$pedona_blogclass = 'blog-nosidebar';
		$pedona_blogcolclass = 12;
		$pedona_blogsidebar = 'none';
		Pedona_Class::pedona_post_thumbnail_size('pedona-post-thumb');
}
?>
<div class="main-container">
	<div class="breadcrumb-container">
		<div class="container">
			<?php Pedona_Class::pedona_breadcrumb(); ?>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12 <?php echo 'col-md-'.$pedona_blogcolclass; ?> <?php echo esc_attr($pedona_mainextraclass);?>">
				<div class="page-content blog-page blogs <?php echo esc_attr($pedona_blogclass); if($pedona_blogsidebar=='left') {echo ' left-sidebar'; } if($pedona_blogsidebar=='right') {echo ' right-sidebar'; } ?>">
					<header class="entry-header">
						<h2 class="entry-title"><?php printf( wp_kses(__( 'Search Results for: %s', 'pedona' ), array('span'=>array())), '<span>' . get_search_query() . '</span>' ); ?></h2>
					</header>
					<?php if ( have_posts() ) : ?>
						<div class="post-container">
							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', get_post_format() ); ?>
							<?php endwhile; ?>
						</div>
						<?php Pedona_Class::pedona_pagination(); ?>
					<?php else : ?>
						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'pedona' ); ?></h1>
							</header>
							<div class="entry-content">
								<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'pedona' ); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-0 -->
					<?php endif; ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>