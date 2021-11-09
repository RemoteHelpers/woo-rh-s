<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package clean
 */

if ( ! is_active_sidebar( 'filter_sidebar' ) ) {
	return;
}
?>

<?php if ( is_active_sidebar( 'filter_sidebar' ) ) : ?>
    <div id="filter-sidebar" class="filter-sidebar widget-area" role="complementary">
        <?php dynamic_sidebar( 'filter_sidebar' ); ?>
    </div><!-- #primary-sidebar -->
<?php endif; ?>
