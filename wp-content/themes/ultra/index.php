<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */

get_header(); ?>

	<?php if ( siteorigin_page_setting( 'page_title' ) && siteorigin_setting( 'blog_page_title' ) ) : ?>
		<header class="page-header">
			<div class="container">
				<h1 class="page-title"><?php echo wp_kses_post( siteorigin_setting( 'blog_page_title' ) ); ?></h1><?php ultra_breadcrumb(); ?>
			</div><!-- .container -->
		</header><!-- .page-header -->
	<?php endif; ?>

	<div class="container <?php if ( ! siteorigin_setting( 'blog_page_title' ) ) { echo 'no-blog-title'; } ?>">

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<?php get_template_part( 'loops/loop', siteorigin_setting( 'blog_archive_layout' ) ); ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>
	<?php get_footer();	?>
