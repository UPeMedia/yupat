<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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
<div class="main-container page-wrapper">
	<div class="breadcrumb-container">
		<div class="container">
			<?php Pedona_Class::pedona_breadcrumb(); ?> 
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12 <?php echo 'col-md-'.$pedona_blogcolclass; ?> <?php echo esc_attr($pedona_mainextraclass);?>">
				<div class="page-content blogs blog-page <?php echo esc_attr($pedona_blogclass); if($pedona_blogsidebar=='left') {echo ' left-sidebar'; } if($pedona_blogsidebar=='right') {echo ' right-sidebar'; } ?>">
					<header class="entry-header">
						<h2 class="entry-title"><?php the_archive_title(); ?></h2>
					</header>
					<?php if ( have_posts() ) : ?>
						<?php if ( tag_description() ) : // Show an optional tag description ?>
							<div class="archive-header">
								<h1 class="archive-title"><?php printf( wp_kses(__( 'Tag Archives: %s', 'pedona' ), array('span'=>array())), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
								<div class="archive-meta"><?php echo tag_description(); ?></div>
							</div><!-- .archive-header -->
						<?php endif; ?>
						<div class="post-container">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();
								/*
								 * Include the post format-specific template for the content. If you want to
								 * this in a child theme then include a file called called content-___.php
								 * (where ___ is the post format) and that will be used instead.
								 */
								get_template_part( 'content', get_post_format() );
							endwhile;
							?>
						</div>
						<?php Pedona_Class::pedona_pagination(); ?>
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>