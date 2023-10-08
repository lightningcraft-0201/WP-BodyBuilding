<?php if ( have_posts() ) : ?>
	<div class="sow-carousel-title">
		<h3 class="widget-title"><?php _e( 'Latest Posts', 'ultra' ); ?></h3>

		<a href="#" class="sow-carousel-next" title="<?php esc_attr_e( 'Next', 'ultra' ); ?>"></a>
		<a href="#" class="sow-carousel-previous" title="<?php esc_attr_e( 'Previous', 'ultra' ); ?>"></a>
	</div>

	<div class="sow-carousel-wrapper">
		<ul class="sow-carousel-items">
			<?php while ( have_posts() ) : the_post(); ?>
				<li class="sow-carousel-item">
					<div class="sow-carousel-thumbnail">
						<?php if ( has_post_thumbnail() ) : $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'sow-carousel-default'); ?>
							<a href="<?php the_permalink(); ?>" style="background-image: url( <?php echo esc_url( $img[0] ); ?> )">
								<span class="overlay"></span>
							</a>
						<?php else : ?>
							<a href="<?php the_permalink(); ?>" class="sow-carousel-default-thumbnail"><span class="overlay"></span></a>
						<?php endif; ?>
					</div>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				</li>
			<?php endwhile; wp_reset_postdata(); ?>
		</ul>
	</div>
<?php endif; ?>
