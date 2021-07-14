<?php
/**
 * Template Name: About Template
 *
 * Description: About page template
 *
 * @package WordPress
 * @subpackage Pedona_Theme
 * @since Pedona 1.0
 */
$pedona_opt = get_option( 'pedona_opt' );

get_header();
?>
<div class="main-container about-page">
	<div class="breadcrumbs-wrapper">
		<div class="container">
			<div class="breadcrumbs-inner">
				<?php Pedona_Class::pedona_breadcrumb(); ?> 
			</div>
		</div>
	</div>
	<div class="page-content">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			
			</article><!-- #post -->
		<?php endwhile; // end of the loop. ?>
	</div>
</div>
<?php get_footer(); ?>