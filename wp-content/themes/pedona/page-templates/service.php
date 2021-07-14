<?php

/**
 * Template Name: Service page
 *
 * Description: Service page template
 *
 * @package WordPress
 * @subpackage Pedona_Theme
 * @since Pedona 1.0
 */

$Pedona_opt = get_option( 'Pedona_opt' );

get_header();
?>
<div class="main-container service-page">
	<div class="breadcrumbs-wrapper">
		<div class="container">
			<div class="breadcrumbs-inner">
				<?php Pedona_Class::pedona_breadcrumb(); ?> 
			</div>
		</div>
	</div>
	<div class="page-content">
		<div class="service-container">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>