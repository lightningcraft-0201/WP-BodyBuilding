<?php
/**
 * Loop Name: Blog
 *
 * @package ultra
 * @since ultra 1.0.2
 * @license GPL 2.0
 */

?>

<?php if ( have_posts() ) : ?>
<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

	<?php
		/* Include the Post-Format-specific template for the content.
		* If you want to override this in a child theme, then include a file
		* called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		get_template_part( 'content', get_post_format() );
	?>

	<?php endwhile; ?>

	<?php the_posts_pagination(); ?>

<?php else : ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>
