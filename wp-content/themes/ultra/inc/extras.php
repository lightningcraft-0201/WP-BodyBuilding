<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ultra_body_classes( $classes ) {

	// Add a class when the layout bound is set to boxed.
	if ( siteorigin_setting( 'layout_bound' ) == 'boxed' ) {
		$classes[] = 'boxed';
	}

	// Add a class when the layout bound is set to full.
	if ( siteorigin_setting( 'layout_bound' ) == 'full' ) {
		$classes[] = 'full';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	
	// Add a class if the sidebar is use.
	if ( is_active_sidebar( 'sidebar-1') ) {
		 $classes[] = 'sidebar';
	}

	// Add a class if the tagline is enabled.
	if ( siteorigin_setting( 'header_tagline' ) ) {
		$classes[] = 'tagline';
	}

	// Add a class if the mobile scroll to top is enabled.
	if ( siteorigin_setting( 'navigation_scroll_top_mobile' ) ) {
		$classes[] = 'mobile-scroll-top';
	}

	// Add a class if the mobile sticky header is enabled.
	if ( siteorigin_setting( 'header_sticky_mobile' ) ) {
		$classes[] = 'mobile-sticky-header';
	}

	// Adds a class which will be removed if a touch device is in use.
	$classes[] = 'no-touch';

	// Add widget-dependent classes.
	if ( ! is_active_sidebar( 'sidebar-1') ) {
		$classes[] = 'one-column';
	}

	// Add a class if the page slider overlap is true.
	if ( get_post_meta( get_the_ID(), 'ultra_metaslider_slider_overlap', true ) == true || is_front_page() && is_home() && siteorigin_setting( 'home_slider' ) != 'none' && siteorigin_setting( 'home_header_overlaps' ) == true ) {
		$classes[] = 'overlap';
	}

	if ( siteorigin_setting( 'header_layout' ) == 'centered' ) {
		$classes[] = 'header-centered';
	}

	// Add the page settings body classes.
	$page_settings = siteorigin_page_setting();

	if ( ! empty( $page_settings ) ) {
		if ( ! empty( $page_settings['layout'] ) ) $classes[] = 'page-layout-' . $page_settings['layout'];
		if ( empty( $page_settings['header_margin'] ) ) $classes[] = 'page-layout-no-header-margin';
		if ( empty( $page_settings['page_title'] ) ) $classes[] = 'no-page-title';
		if ( empty( $page_settings['footer_margin'] ) ) $classes[] = 'page-layout-no-footer-margin';
	}

	// Add a class if responsive layout is enabled.
	if ( siteorigin_setting( 'layout_responsive' ) ) {
		$classes[] = 'resp';
	}

	// Add a class if responsive top bar is enabled.
	if ( siteorigin_setting( 'navigation_responsive_top_bar' ) ) {
		$classes[] = 'resp-top-bar';
	}

	// Add a class if we're viewing the Customizer preview.
	if ( is_customize_preview() ) {
		$classes[] = 'ultra-customizer-preview';
	}

	// Add a class if viewed on mobile.
	if ( wp_is_mobile() ) {
		$classes[] = 'ultra-mobile-device';
	}

	// Add a class if Display Logo and Site Title is enabled.
	if ( siteorigin_setting( 'header_logo_with_title' ) ) {
		$classes[] = 'logo-and-title';
	}

	return $classes;
}
add_filter( 'body_class', 'ultra_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ultra_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'ultra_pingback_header' );
