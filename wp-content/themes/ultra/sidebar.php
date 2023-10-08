<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		return;
	}

	if ( ! in_array( siteorigin_page_setting( 'layout', 'default' ), array( 'default', 'full-width-sidebar' ), true ) ) return;
?>

<div id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
