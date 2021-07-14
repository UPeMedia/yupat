<?php
/**
 * Template Name: Portfolio Template
 *
 * Description: Portfolio page template
 *
 * @package WordPress
 * @subpackage Pedona_Theme
 * @since Pedona 1.0
 */
$pedona_opt = get_option( 'pedona_opt' );

get_header();
?>
<div class="main-container portfolio-page">
	<div class="breadcrumbs-wrapper">
		<div class="container">
			<div class="breadcrumbs-inner">
				<?php Pedona_Class::pedona_breadcrumb(); ?> 
			</div>
		</div>
	</div>
	<div class="page-content">
		<div class="portfolio-container">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>