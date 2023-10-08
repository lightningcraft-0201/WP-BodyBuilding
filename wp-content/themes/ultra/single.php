<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */
get_header(); ?>
		
	<?php if ( siteorigin_page_setting( 'page_title' ) ) : ?>
		<header class="entry-header">
			<div class="container">
				<h1 class="entry-title"><?php echo get_the_title(); ?></h1><?php ultra_breadcrumb(); ?>
			</div><!-- .container -->
		</header><!-- .entry-header -->
	<?php endif; ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<div class="entry-meta">
		<div class="container">
			<div>
				<?php ultra_posted_on(); ?>
			</div>
		</div><!-- .container -->
	</div><!-- .entry-meta -->

	<div class="container">

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<?php get_template_part( 'content', 'single' ); ?>

	 			<?php if ( siteorigin_setting( 'navigation_post_nav' ) ) the_post_navigation(); ?>

	 			<?php if ( siteorigin_setting( 'blog_post_author_box' ) ) ultra_author_box(); ?>

	 			<?php if ( siteorigin_setting( 'blog_related_posts' ) && ! is_attachment() ) ultra_related_posts( $post->ID ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?> 
	<?php get_footer();	?>
