<?php
/**
 * Loop Name: Left Aligned Thumbnail
 *
 * @package ultra
 * @since ultra 1.0.2
 * @license GPL 2.0
 */

?>

<?php if ( have_posts() ) : ?>
<div class="ultra-left-thumb-loop">
<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php if ( has_post_thumbnail() && siteorigin_setting( 'blog_archive_featured_image' ) ) {
	$classes = array(
		'featured-image',
	);
} else {
	$classes = array();
} ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
		<?php if ( has_post_thumbnail() && siteorigin_setting( 'blog_archive_featured_image' ) ) : ?>
			<div class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			</div>
		<?php endif; ?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php ultra_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php if ( siteorigin_setting( 'blog_archive_content' ) == 'excerpt' ) ultra_excerpt(); else the_content(); ?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'ultra' ) . '</span>',
					'after'  => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		</div><!-- .entry-content -->

		<div class="clear"></div>

		<footer class="entry-footer">
			<?php ultra_entry_footer(); ?>
		</footer><!-- .entry-footer -->

	</article><!-- #post-## -->

	<?php endwhile; ?>

	</div><!-- .ultra-left-thumb-loop -->

	<?php the_posts_pagination(); ?>

<?php else : ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>
