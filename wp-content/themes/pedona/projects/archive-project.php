<?php
/**
 * The Template for displaying project archives, including the main showcase page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/projects/archive-project.php
 *
 * @author 		WooThemes
 * @package 	Projects/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $projects_loop, $post, $wp_query;

$pedona_opt = get_option( 'pedona_opt' );

get_header( 'projects' ); ?>

<div class="main-container full-width">
	<div class="breadcrumbs-wrapper">
		<div class="container">
			<div class="breadcrumbs-inner">
				<?php Pedona_Class::pedona_breadcrumb(); ?> 
			</div>
		</div>
	</div>
	<div class="container">
		
		<div class="page-content">
			<?php
				/**
				 * projects_before_main_content hook
				 *
				 * @hooked projects_output_content_wrapper - 10 (outputs opening divs for the content)
				 */
				do_action( 'projects_before_main_content' );
			?>

			<?php do_action( 'projects_archive_description' ); ?>

			<?php
			$projects_per_page = 10;
			if( isset($pedona_opt['portfolio_per_page']) ) {
				$projects_per_page = $pedona_opt['portfolio_per_page'];
			}
			$projects_args = $wp_query->query_vars;
			
			$paged = get_query_var( 'paged', 1 );
			
			$projects_args['post_type'] = 'project';
			$projects_args['posts_per_page'] = $projects_per_page;
			$projects_args['paged'] = $paged;
			
			if(!isset($wp_query->query["project-category"])){ //if is not the category page
				$projects_args = array(
					'posts_per_page' => $projects_per_page,
					'post_type' => 'project',
					'paged' => $paged,
					'nopaging' => false
				);
			}
			//var_dump($projects_args);
			
			$projects_query = new WP_Query( $projects_args );
			?>
				
			<?php if ( $projects_query->have_posts() ) : ?>

				<?php
					/**
					 * projects_before_loop hook
					 *
					 */
					do_action( 'projects_before_loop' );
				?>
				<div class="filter-options btn-group">
					<button data-group="all" class="btn active btn--warning"><?php esc_html_e('All', 'pedona');?></button>
					<?php 
					$datagroups = array();
					
					while ( $projects_query->have_posts() ) : $projects_query->the_post();
					
						$prcates = get_the_terms($post->ID, 'project-category' );
						
						if($prcates) {
							foreach ($prcates as $category ) {
								$datagroups[$category->slug] = $category->name;
							}
						}
						?>
					<?php endwhile; // end of the loop. ?>
					<?php
					foreach($datagroups as $key=>$value) { ?>
						<button data-group="<?php echo esc_attr($key);?>" class="btn btn--warning"><?php echo esc_html($value);?></button>
					<?php }
					?>
				</div>
				<div class="list_projects entry-content">

				<?php projects_project_loop_start(); ?>
					<?php while ( $projects_query->have_posts() ) : $projects_query->the_post(); ?>

						<?php projects_get_template_part( 'content', 'project' ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php projects_project_loop_end(); ?>
				
				</div><!-- .projects -->

				<?php
					/**
					 * projects_after_loop hook
					 *
					 * @hooked projects_pagination - 10
					 */
					do_action( 'projects_after_loop' );
				?>

			<?php else : ?>

				<?php projects_get_template( 'loop/no-projects-found.php' ); ?>

			<?php endif; ?>

			<?php
				/**
				 * projects_after_main_content hook
				 *
				 * @hooked projects_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'projects_after_main_content' );
			?>

			<?php
				/**
				 * projects_sidebar hook
				 *
				 * @hooked projects_get_sidebar - 10
				 */
				//do_action( 'projects_sidebar' );
			?>
			
			<?php wp_reset_postdata(); ?>
			
		</div>
	</div>
	<div class="brands-logo other-page">
		<div class="container">
		<?php echo do_shortcode('[ourbrands]'); ?>
		</div>
	</div>
	<div class="home-static3 other-page">
		<div class="container">
			<?php if(isset($pedona_opt['static_block3'])) {
				echo wp_kses($pedona_opt['static_block3'], array(
					'a' => array(
					'class' => array(),
					'href' => array(),
					'title' => array()
					),
					'img' => array(
						'src' => array(),
						'alt' => array()
					),
					'strong' => array(),
					'h2' => array(),
					'p' => array(),
					'i' => array(),
				)); 
			} ?>
		</div>	
	</div>
</div>
<?php get_footer( 'projects' ); ?>