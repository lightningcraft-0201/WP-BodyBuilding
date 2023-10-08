<?php
/**
 * Template Name: Full Width - No Title
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/page-templates/
 * 
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */

get_header(); ?>

	<div class="container">

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

<?php get_footer(); ?>
