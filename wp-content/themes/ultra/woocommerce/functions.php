<?php
/**
 * Add theme support for Woocommerce.
 *
 * @package ultra
 * @since ultra 1.0.2
 * @license GPL 2.0
 */

if ( ! function_exists( 'ultra_woocommerce_setup' ) ) :
/**
 * Ultra theme WooCommerce setup.
 */
function ultra_woocommerce_setup() {

	// Add WooCommerce theme support.
	add_theme_support( 'woocommerce' );

	// Add support for WooCommerce product gallery lightbox.
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Remove the default WooCommerce containers.
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );

	// Remove the single product title.
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

	// Remove the default WooCommerce breadcrumb.
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

	// Add the WooCommerce breadcrumb to Ultra's location.
	add_action( 'ultra_woocommerce_breadcrumb', 'woocommerce_breadcrumb' );

}
endif; // ultra_woocommerce_setup
add_action( 'after_setup_theme', 'ultra_woocommerce_setup' );

if ( ! function_exists( 'ultra_woocommerce_wrapper_before' ) ) :
/**
 * Markup to be outputted before WooCommerce content.
 */
function ultra_woocommerce_wrapper_before() {
	echo '<div class="container"><div id="primary" class="content-area"><main id="main" class="site-main" role="main">';
}
add_action( 'woocommerce_before_main_content', 'ultra_woocommerce_wrapper_before' );
endif;

if ( ! function_exists( 'ultra_woocommerce_wrapper_after' ) ) :
/**
 * Markup to be outputted after WooCommerce content.
 */
function ultra_woocommerce_wrapper_after() {
	echo '</main><!-- #main --> </div><!-- #primary -->';
}
add_action( 'woocommerce_after_main_content', 'ultra_woocommerce_wrapper_after' );
endif;

if ( ! function_exists( 'ultra_woocommerce_page_title' ) ) :
/**
 * Filter the WooCommerce page title to remove it.
 */
function ultra_woocommerce_page_title() {
	return false;
}
add_filter( 'woocommerce_show_page_title', 'ultra_woocommerce_page_title', 10, 1 );
endif;

if ( ! function_exists( 'ultra_display_woocommerce_page_title' ) ) :
/**
 * Output the WooCommerce page titles to custom location.
 */
function ultra_display_woocommerce_page_title() {
	if ( is_singular( 'product' ) ) {
		woocommerce_template_single_title();
	} else {
		echo '<h1 class="entry-title">';
		woocommerce_page_title();
		echo '</h1>';
	}
}
add_action( 'ultra_woocommerce_title', 'ultra_display_woocommerce_page_title' );
endif;

if ( ! function_exists( 'ultra_woocommerce_enqueue_styles' ) ) :
/**
 * Enqueue WooCommerce styles.
 */
function ultra_woocommerce_enqueue_styles() {
	wp_enqueue_style( 'ultra-woocommerce-style', get_template_directory_uri() . '/woocommerce/woocommerce.css' );
}
add_action( 'wp_enqueue_scripts', 'ultra_woocommerce_enqueue_styles' );
endif;
