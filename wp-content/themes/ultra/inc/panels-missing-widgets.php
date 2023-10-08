<?php

/**
 * This file gives additional Page Builder compatibility by rendering missing widgets.
 */

function ultra_panels_missing_widgets( $code, $widget, $args, $instance ) {
	switch( $widget ) {
		case 'SiteOrigin_Widget_Features_Widget':
			ob_start();
			echo $args['before_widget'];
			ultra_panels_missing_widgets_features( $instance, $args );
			echo $args['after_widget'];
			$code = ob_get_clean();
			break;

		case 'SiteOrigin_Widget_PostCarousel_Widget':
			ob_start();
			echo $args['before_widget'];
			ultra_panels_missing_widgets_carousel( $instance, $args );
			echo $args['after_widget'];
			$code = ob_get_clean();
			break;
	}

	return $code;
}
add_filter( 'siteorigin_panels_missing_widget', 'ultra_panels_missing_widgets', 10, 4 );

/**
 * Render the features widget
 *
 * @param $instance
 * @param $args
 */
function ultra_panels_missing_widgets_features( $instance, $args ) {
	global $ultra_demo_features_instance;
	// enqueue all the required styles
	wp_enqueue_style( 'ultra-demo-features', get_template_directory_uri() . '/demo/features/css/style.css', array(), SITEORIGIN_THEME_VERSION );
	wp_enqueue_style( 'ultra-demo-features-fontawesome', get_template_directory_uri() . '/demo/features/css/fontawesome/style.css', array(), SITEORIGIN_THEME_VERSION );

	$ultra_demo_features_instance = $instance;
	get_template_part( 'demo/features/features' );
}

/**
 * Render the carousel widget
 */
function ultra_panels_missing_widgets_carousel( $instance, $args ) {
	$js_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'ultra-demo-carousel-basic', get_template_directory_uri() . '/demo/carousel/css/style.css', array(), SITEORIGIN_THEME_VERSION );
	wp_enqueue_script( 'ultra-demo-carousel-basic', get_template_directory_uri() . '/demo/carousel/js/carousel' . $js_suffix . '.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );

	get_template_part( 'demo/carousel/carousel' );
}