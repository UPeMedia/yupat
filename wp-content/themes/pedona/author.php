<?php
/**
 * The template for displaying Author Archive pages
 *
 * Used to display archive-type pages for posts by an author.
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
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							 *
							 * We reset this later so we can run the loop
							 * properly with a call to rewind_posts().
							 */
							the_post();
						?>
						<?php
						// If a user has filled out their description, show a bio on their entries.
						if ( get_the_author_meta( 'description' ) ) : ?>
							<div class="archive-header">
								<h3 class="archive-title"><?php printf( esc_html__( 'Author Archives: %s', 'pedona' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h3>
								<div class="author-info archives">
									<div class="author-avatar">
										<?php
										/**
										 * Filter the author bio avatar size.
										 *
										 * @since Pedona 1.0
										 *
										 * @param int $size The height and width of the avatar in pixels.
										 */
										$author_bio_avatar_size = apply_filters( 'pedona_author_bio_avatar_size', 68 );
										echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
										?>
									</div>
									<div class="author-description">
										<h2><?php printf( esc_html__( 'About %s', 'pedona' ), get_the_author() ); ?></h2>
										<p><?php the_author_meta( 'description' ); ?></p>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<?php
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();
						?>
						<div class="post-container">
							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', get_post_format() ); ?>
							<?php endwhile; ?>
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