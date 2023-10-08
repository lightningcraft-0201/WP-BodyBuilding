<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */

get_header(); ?>

	<?php if ( siteorigin_page_setting( 'page_title' ) ) : ?>
		<header class="page-header">
			<div class="container">
				<div class="title-wrapper">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' ); 
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</div><!-- .title-wrapper --><?php ultra_breadcrumb(); ?>
			</div><!-- .container -->
		</header><!-- .page-header -->
	<?php endif; ?>

	<div class="container">

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<?php get_template_part( 'loops/loop', siteorigin_setting( 'blog_archive_layout' ) ); ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>
	<?php get_footer();	?>
