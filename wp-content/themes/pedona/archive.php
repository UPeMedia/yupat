<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Pedona already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
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
						<h2 class="entry-title"><?php the_archive_title(); ?></h2>
					</header>
					<?php if ( have_posts() ) : ?>
						<?php
							the_archive_description( '<div class="archive-description">', '</div>' );
						?>
						<div class="post-container">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();
								/* Include the post format-specific template for the content. If you want to
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