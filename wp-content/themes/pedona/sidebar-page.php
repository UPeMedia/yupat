<?php
/**
 * The sidebar for content page
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Pedona_Theme
 * @since Pedona 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar-page' ) ) : ?>
<div id="secondary" class="col-12 col-md-3">
	<?php dynamic_sidebar( 'sidebar-page' ); ?>
</div>
<?php endif; ?>