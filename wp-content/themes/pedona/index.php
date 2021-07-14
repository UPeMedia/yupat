<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
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
						<h1 class="entry-title"><?php if(isset($pedona_opt) && ($pedona_opt !='')) { echo esc_html($pedona_opt['blog_header_text']); } else { esc_html_e('Blog', 'pedona');}  ?></h1>
					</header>
					<div class="blog-wrapper">
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
							<?php if ( current_user_can( 'edit_posts' ) ) :
								// Show a different message to a logged-in user who can add posts.
							?>
								<header class="entry-header">
									<h1 class="entry-title"><?php esc_html_e( 'No posts to display', 'pedona' ); ?></h1>
								</header>
								<div class="entry-content">
									<p><?php printf( wp_kses(__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'pedona' ), array('a'=>array('href'=>array()))), admin_url( 'post-new.php' ) ); ?></p>
								</div><!-- .entry-content -->
							<?php else :
								// Show the default message to everyone else.
							?>
								<header class="entry-header">
									<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'pedona' ); ?></h1>
								</header>
								<div class="entry-content">
									<p><?php esc_html_e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'pedona' ); ?></p>
									<?php get_search_form(); ?>
								</div>
							<?php endif; // end current_user_can() check ?>
							</article>
						<?php endif; // end have_posts() check ?>
					</div>
				</div>
			</div>
			<?php if($pedona_bloglayout!='nosidebar') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>