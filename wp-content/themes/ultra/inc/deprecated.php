<?php
/**
 * Deprecated functions.
 *
 * @package ultra
 * @since ultra 1.3
 * @license GPL 2.0
 */

if ( ! function_exists( 'ultra_excerpt_more' ) ) :
/**
 * Add a more link to the excerpt.
 */
function ultra_excerpt_more( $more ) {
	if ( is_search() ) return;
	if ( siteorigin_setting( 'blog_archive_content' ) == 'excerpt' && siteorigin_setting( 'blog_excerpt_more' ) ) {
		$read_more_text = siteorigin_setting( 'blog_read_more' ) ? esc_html( siteorigin_setting( 'blog_read_more' ) ) : esc_html__( 'Continue reading', 'ultra' );
		return '<p><span class="more-wrapper"><a class="more-link button" href="' . get_permalink() . '">' . $read_more_text . '</a></span></p>';
	}
}
endif;
add_filter( 'excerpt_more', 'ultra_excerpt_more' );

if ( ! function_exists( 'ultra_custom_excerpt_length' ) ) :
/**
 * Filter the excerpt length.
 */
function ultra_custom_excerpt_length( $length ) {
	return siteorigin_setting( 'blog_excerpt_length' );
}
add_filter( 'excerpt_length', 'ultra_custom_excerpt_length', 10 );
endif;
