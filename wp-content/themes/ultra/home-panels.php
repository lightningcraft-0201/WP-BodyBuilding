<?php
/**
 * The template for displaying the home page panel. Requires SiteOrigin page builder plugin.
 *
 * Template Name: Page Builder Home
 *
 * @package ultra
 * @since ultra 0.9
 * @see https://siteorigin.com/page-builder/
 * @license GPL 2.0
 */
get_header(); ?>

	<div class="container">

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<div class="entry-content">
					<?php
					if ( is_page() ) {
						the_post();
						the_content();
					} elseif ( function_exists( 'siteorigin_panels_render' ) ) {
						echo siteorigin_panels_render( 'home' );
					} else {
						echo siteorigin_panels_lite_home_render();
					}
					?>
				</div>
			</main><!-- #main .site-main -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>
