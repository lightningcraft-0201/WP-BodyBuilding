<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */

if ( ! function_exists( 'ultra_author_box' ) ) :
/**
 * Displays the author author biographical info on single posts.
 */
function ultra_author_box() { ?>
	<div class="author-box">
		<div class="author-avatar">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
			</a>
		</div><!-- .author-avatar -->
		<div class="author-description">
			<h3><?php echo get_the_author(); ?></h3>
			<span class="author-posts">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
					<?php esc_html_e( 'View posts by ', 'ultra' );
					echo get_the_author(); ?>
				</a>
			</span>	
			<div><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></div>
		</div><!-- .author-description -->
	</div>
<?php }
endif;

if ( ! function_exists( 'ultra_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time, author, comment count and categories.
 */

function ultra_posted_on() {

	echo '<div class="entry-meta-inner">';

	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span class="featured-post">' . esc_html__( 'Sticky', 'ultra' ) . '</span>';
	}

	if ( is_home() && siteorigin_setting( 'blog_post_date' ) || is_archive() && siteorigin_setting( 'blog_post_date' ) || is_search() && siteorigin_setting( 'blog_post_date' ) ) {
		echo '<span class="entry-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><time class="published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time><time class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time></span></a>';
	}

	if ( is_single() && siteorigin_setting( 'blog_post_date' ) ) {
		echo '<span class="entry-date"><time class="published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time><time class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time></span>';
	}

	if ( siteorigin_setting( 'blog_post_author' ) ) {
		echo '<span class="byline"><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author">' . esc_html( get_the_author() ) . '</a></span></span>';
	}

	if ( comments_open() && siteorigin_setting( 'blog_post_comment_count' ) ) { 
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'ultra' ), esc_html__( '1 Comment', 'ultra' ), esc_html__( '% Comments', 'ultra' ) );
		echo '</span>';
	}

	echo '</div>';

	if ( is_single() && siteorigin_setting( 'navigation_post_nav' ) ) {
		the_post_navigation( $args = array( 'prev_text' => '', 'next_text' => '', ) );
	}
}
endif;

if ( ! function_exists( 'ultra_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function ultra_entry_footer() {

	if ( is_single() && has_category() && siteorigin_setting( 'blog_post_cats' ) ) {
		echo '<span class="cat-links">' . get_the_category_list( esc_html__( ', ', 'ultra' ) ) . '</span>';
	}

	if ( is_single() && has_tag() && siteorigin_setting( 'blog_post_tags' ) ) {
		echo '<span class="tags-links">' . get_the_tag_list( '', esc_html__( ', ', 'ultra' ) ) . '</span>';
	}

	if ( siteorigin_setting( 'blog_edit_link' ) ) { 
		edit_post_link( esc_html__( 'Edit', 'ultra' ), '<span class="edit-link">', '</span>' ); 
	}
}
endif;

if ( ! function_exists( 'ultra_display_logo' ) ) :
/**
 * Display the logo.
 */
function ultra_display_logo() {
	$logo = siteorigin_setting( 'header_logo' );
	if ( empty( $logo ) && function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		$logo = get_theme_mod( 'custom_logo' );
	}
	$logo = apply_filters( 'ultra_logo_image_id', $logo );

	if ( empty( $logo ) ) {

		// Just display the site title.
		if ( is_front_page() ) {
			$logo_html = '<h1 class="site-title">' . get_bloginfo( 'name' ) . '</h1>';
		} else {
			$logo_html = '<p class="site-title">' . get_bloginfo( 'name' ) . '</p>';
		}
		$logo_html = apply_filters( 'ultra_logo_text', $logo_html );
	}
	else {
		// Load the logo image.
		if ( is_array( $logo ) ) {
			list ( $src, $height, $width ) = $logo;
		}
		else {
			$image = wp_get_attachment_image_src( $logo, 'full' );
			$src = $image[0];
			$height = $image[2];
			$width = $image[1];
		}

		// Add the logo attributes.
		$logo_attributes = apply_filters( 'ultra_logo_image_attributes', array(
			'src' => $src,
			'width' => round( $width ),
			'height' => round( $height ),
			'alt' => sprintf( esc_html__( '%s Logo', 'ultra' ), get_bloginfo( 'name' ) ),
		) );

		if ( siteorigin_setting( 'header_sticky' ) && siteorigin_setting( 'header_scale' ) ) $logo_attributes['data-scale'] = '1';

		$logo_attributes_str = array();
		if ( ! empty( $logo_attributes ) ) {
			foreach ( $logo_attributes as $name => $val ) {
				if ( empty( $val ) ) continue;
				$logo_attributes_str[] = $name . '="' . esc_attr( $val ) . '" ';
			}
		}

		$logo_html = apply_filters( 'ultra_logo_image', '<img '.implode( ' ', $logo_attributes_str ).' />' );
	}

	// Echo the image.
	echo apply_filters( 'ultra_logo_html', $logo_html );
}
endif;

if ( ! function_exists( 'ultra_display_logo_text' ) ) :
/**
 * Display the Site Title next to the logo.
 */
function ultra_display_logo_text() {
	$logo = siteorigin_setting( 'header_logo' );
	if ( empty( $logo ) && function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		$logo = get_theme_mod( 'custom_logo' );
	}

	$logo_html = is_front_page() ? $logo_html = '<h1 class="site-title logo-title">' . get_bloginfo( 'name' ) . '</h1>' : $logo_html = '<p class="site-title logo-title">' . get_bloginfo( 'name' ) . '</p>';

	if ( siteorigin_setting( 'header_logo_with_title' ) && ! empty( $logo ) ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php echo $logo_html; ?>
		</a>
	<?php
	endif;

}
endif;

if ( ! function_exists( 'ultra_is_post_loop_template' ) ) :
/**
 * Check if we're currently rendering a specific Page Builder Post Loop widget template.
 * @param $check
 *
 * @return bool
 */
function ultra_is_post_loop_template( $check ) {
	if ( ! method_exists( 'SiteOrigin_Panels_Widgets_PostLoop', 'get_current_loop_template' ) ) return false;

	switch( $check ) {
		case 'blog':
			return SiteOrigin_Panels_Widgets_PostLoop::get_current_loop_template() == 'loops/loop-blog.php';
		case 'masonry':
			return SiteOrigin_Panels_Widgets_PostLoop::get_current_loop_template() == 'loops/loop-masonry.php';
		case 'medium-left':
			return SiteOrigin_Panels_Widgets_PostLoop::get_current_loop_template() == 'loops/loop-meduium-left.php';
		case 'thumbnail-left':
			return SiteOrigin_Panels_Widgets_PostLoop::get_current_loop_template() == 'loops/loop-thumbnail-left.php';
	}

	return false;
}
endif;

if ( ! function_exists( 'ultra_jetpack_remove_rp' ) ) :
/**
 * Remove Jetpack Related Posts from the bottom of posts.
 */
function ultra_jetpack_remove_rp() {
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'related-posts' ) ) {
		$jprp = Jetpack_RelatedPosts::init();
		$callback = array( $jprp, 'filter_add_target_to_dom' );
		remove_filter( 'the_content', $callback, 40 );
	}
}
endif;
add_filter( 'wp', 'ultra_jetpack_remove_rp', 20 );

if (
	class_exists( 'Smush\Core\Modules\Lazy' ) ||
	class_exists( 'LiteSpeed_Cache' ) ||
	class_exists( 'Jetpack_Lazy_Images' )
) :
	if ( ! function_exists( 'ultra_featured_image_lazy_load_exclude' ) ) :
		/**
		 * Exclude Featured Images from Lazy Load plugins.
		 */
		function ultra_featured_image_lazy_load_exclude( $attr, $attachment ) {
			if ( ( siteorigin_setting( 'blog_archive_layout' ) == 'masonry' && ( is_home() || is_archive() ) ) || ultra_is_post_loop_template( 'masonry' ) ) {
				$featured_image_id = get_post_thumbnail_id();
		
				if ( ! empty( $featured_image_id ) && $attachment->ID == $featured_image_id ) {
					// Jetpack Lazy Load.
					if ( class_exists( 'Jetpack_Lazy_Images' ) ) {
						$attr['class'] .= ' skip-lazy';
					}

					// Smush Lazy Load.
					if ( class_exists( 'Smush\Core\Modules\Lazy' ) ) {
						$attr['class'] .= ' no-lazyload';
					}

					// LiteSpeed Cache Lazy Load.
					if ( class_exists( 'LiteSpeed_Cache' ) ) {
						$attr['data-no-lazy'] = 1;
					}
				}
			}
			return $attr;
		}
	endif;
	add_filter( 'wp_get_attachment_image_attributes', 'ultra_featured_image_lazy_load_exclude', 10, 2 );
endif;

if ( ! function_exists( 'ultra_related_posts' ) ) :
/**
 * Display related posts in single posts.
 */
function ultra_related_posts( $post_id ) {
	if ( function_exists( 'related_posts' ) ) { // Check for YARPP plugin.
		related_posts();
	} elseif ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'related-posts' ) ) {
		echo do_shortcode( '[jetpack-related-posts]' );
	} else { // The fallback loop.
		$categories = get_the_category( $post_id );
		if ( empty( $categories ) ) return;
		$first_cat = $categories[0]->cat_ID;
		$args=array(
			'category__in'        => array( $first_cat ),
			'post__not_in'        => array( $post_id ),
			'posts_per_page'      => 3,
			'ignore_sticky_posts' => -1
		);
		$related_posts = new WP_Query( $args ); ?>

		<div class="related-posts-section">
			<h3 class="related-posts"><?php esc_html_e( 'You May Also Like', 'ultra' ); ?></h3>
			<?php if ( $related_posts->have_posts() ) : ?>
				<ol>
					<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
						<li>
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail(); ?>
								<?php endif; ?>
								<h3 class="related-post-title"><?php the_title(); ?></h3>
								<p class="related-post-date"><?php echo get_the_date(); ?></p>
							</a>
						</li>
					<?php endwhile; ?>
				</ol>
			<?php else : ?>
				<p><?php esc_html_e( 'No related posts.', 'ultra' ); ?></p>
			<?php endif; ?>
		</div>
		<?php wp_reset_query();
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function ultra_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'ultra_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'ultra_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so ultra_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so ultra_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in ultra_categorized_blog.
 */
function ultra_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'ultra_categories' );
}
add_action( 'edit_category', 'ultra_category_transient_flusher' );
add_action( 'save_post',     'ultra_category_transient_flusher' );
