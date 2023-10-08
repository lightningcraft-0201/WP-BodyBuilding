<?php

if ( class_exists( 'MetaSliderPlugin' ) ) :

	// Add the Ultra Flex theme.
	function ultra_metaslider_themes( $themes, $current ) {
		$themes .= "<option value='ultra' class='option flex'" . selected( 'ultra', $current, false ) . ">" . __( 'Ultra (Flex)', 'ultra' ) . "</option>";
		return $themes;
	}
	add_filter( 'metaslider_get_available_themes', 'ultra_metaslider_themes', 5, 2 );

	// Change the Flex name space if the Ultra theme is selected.
	function ultra_metaslider_flex_params( $options, $slider_id, $settings ) {
		if ( ! empty( $settings['theme'] ) && $settings['theme'] == 'ultra' ) {
			$options['namespace'] = '"flex-ultra-"'; 
		}
		return $options;
	}
	add_filter( 'metaslider_flex_slider_parameters', 'ultra_metaslider_flex_params', 10, 3 );

	/**
	 * Change the HTML for the home page slider.
	 *
	 * @param $html
	 * @param $slide
	 * @param $settings
	 *
	 * @return string The new HTML
	 */
	function ultra_metaslider_filter_flex_slide( $html, $slide, $settings ) {
		if ( is_admin() && ! empty( $GLOBALS['ultra_is_main_slider'] ) ) return $html;
	
		if ( ! empty( $slide['caption'] ) && function_exists( 'filter_var' ) && filter_var( $slide['caption'], FILTER_VALIDATE_URL) !== false ) {
	
			$settings['height'] = round( $settings['height'] / 1200 * $settings['width'] );
			$settings['width'] = 1200;
	
			$html = sprintf( "<img src='%s' class='ms-default-image' width='%d' height='%d' />", $slide['thumb'], intval( $settings['width'] ), intval( $settings['height'] ) );
	
			if ( strlen( $slide['url'] ) ) {
				$html = '<a href="' . esc_url( $slide['url'] ) . '" target="' . esc_attr( $slide['target'] ) . '">' . $html . '</a>';
			}
	
			$caption = '<div class="content">';
			if ( strlen($slide['url'] ) ) $caption .= '<a href="' . $slide['url'] . '" target="' . $slide['target'] . '">';
			$caption .= sprintf( '<img src="%s" width="%d" height="%d" />', esc_url( $slide['caption'] ), intval( $settings['width'] ), intval( $settings['height'] ) );
			if ( strlen($slide['url'] ) ) $caption .= '</a>';
			$caption .= '</div>';
	
			$html = $caption . $html;
	
			$thumb = isset( $slide['data-thumb'] ) && strlen( $slide['data-thumb'] ) ? " data-thumb=\"{$slide['data-thumb']}\"" : "";
	
			$html = '<li style="display: none;"' . $thumb . ' class="ultra-slide-with-image">' . $html . '</li>';
		}
	
		return $html;
	}
	add_filter( 'metaslider_image_flex_slider_markup', 'ultra_metaslider_filter_flex_slide', 10, 3 );

	/**
	 * Filter Meta Slider settings when the Ultra (Flex) theme is selected.
	 *
	 * @param $settings
	 */
	function ultra_metaslider_ensure_height( $settings ) {
		if ( ! empty( $settings['theme'] ) && $settings['theme'] == 'ultra' ) {
			$settings['width'] = ultra_get_site_width();
		}
	
		return $settings;
	}
	add_filter( 'sanitize_post_meta_ml-slider_settings', 'ultra_metaslider_ensure_height' );

endif; // endif MetaSlider active.

if ( ! function_exists( 'ultra_slider_page_setting_metabox' ) ) :
function ultra_slider_page_setting_metabox() {
	add_meta_box( 'ultra-slider-page-slider', __( 'Page Slider', 'ultra' ), 'ultra_slider_page_setting_metabox_render', 'page', 'side' );
}
add_action( 'add_meta_boxes', 'ultra_slider_page_setting_metabox' );
endif;

function ultra_slider_page_setting_metabox_render( $post ) {
	// Key refers to MetaSlider, but this could be Smart Slider 3 too.
	$slider = get_post_meta( $post->ID, 'ultra_metaslider_slider', true );

	$is_home = $post->ID == get_option( 'page_on_front' );
	// If we're on the home page and the user hasn't explicitly set something here use the 'home_slider' theme setting.
	if ( $is_home && empty( $slider ) ) {
		$slider = siteorigin_setting( 'home_slider' );
	}

	// Default stretch setting to theme setting.
	$slider_stretch = siteorigin_setting( 'home_slider_stretch' );
	// $slider_overlap = siteorigin_setting( 'home_header_overlaps' );
	if ( metadata_exists( 'post', $post->ID, 'ultra_metaslider_slider_stretch' ) ) {
		$slider_stretch = get_post_meta( $post->ID, 'ultra_metaslider_slider_stretch', true );
	}
	if ( metadata_exists( 'post', $post->ID, 'ultra_metaslider_slider_overlap' ) ) {
		$slider_overlap = get_post_meta( $post->ID, 'ultra_metaslider_slider_overlap', true );
	}	
	$slider_can_stretch = preg_match( '/^(meta:)/', $slider );
	$slider_can_overlap = preg_match( '/^(meta|smart:)/', $slider );
	
	wp_enqueue_script(
		'siteorigin-ultra-sliders',
		get_template_directory_uri() . '/inc/sliders/js/sliders' . SITEORIGIN_THEME_JS_PREFIX . '.js',
		array( 'jquery' ),
		SITEORIGIN_THEME_VERSION
	);

	$options = ultra_sliders_get_options( $is_home );
	?>
	<label><strong><?php _e( 'Display Page Slider', 'ultra' ) ?></strong></label>
	<p>
		<select name="ultra_page_slider">
			<?php foreach( $options as $id => $name ) : ?>
				<option value="<?php echo esc_attr( $id ) ?>" <?php selected( $slider, $id ) ?>><?php echo esc_html( $name ) ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p class="checkbox-wrapper" style="display: <?php echo ( ! empty( $slider_can_stretch ) ? 'block' : 'none' ) ?>;">
		<input id="ultra_page_slider_stretch" name="ultra_page_slider_stretch" type="checkbox" <?php checked( $slider_stretch ); ?> />
		<label for="ultra_page_slider_stretch"><?php _e( 'Stretch Page Meta Slider', 'ultra' ); ?></label>
	</p>
	<p class="checkbox-overlap-wrapper" style="display: <?php echo ( ! empty( $slider_can_overlap ) ? 'block' : 'none' ) ?>;">
		<input id="ultra_page_slider_overlap" name="ultra_page_slider_overlap" type="checkbox" <?php checked( $slider_overlap ); ?> />
		<label for="ultra_page_slider_overlap"><?php _e( 'Overlap Header', 'ultra' ) ?></label>
	</p>
	<?php
	wp_nonce_field( 'save', '_ultra_slider_nonce' );
}

function ultra_slider_page_setting_save( $post_id ) {
	if ( empty( $_POST[ '_ultra_slider_nonce' ] ) || ! wp_verify_nonce( $_POST[ '_ultra_slider_nonce' ], 'save' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( defined( 'DOING_AJAX' ) ) return;

	update_post_meta( $post_id, 'ultra_metaslider_slider', $_POST[ 'ultra_page_slider' ] );

	$slider_stretch = !empty( $_POST[ 'ultra_page_slider_stretch' ] );
	update_post_meta( $post_id, 'ultra_metaslider_slider_stretch', $slider_stretch );

	$slider_overlap = ! empty( $_POST['ultra_page_slider_overlap'] );
	update_post_meta( $post_id, 'ultra_metaslider_slider_overlap', $slider_overlap );	

	// If we're on the home page update the 'home_slider' theme setting as well.
	if ( $post_id == get_option( 'page_on_front' ) ) {
		siteorigin_settings_set( 'home_slider', $_POST[ 'ultra_page_slider' ] );
		siteorigin_settings_set( 'home_slider_stretch', $slider_stretch );
		siteorigin_settings_set( 'home_header_overlaps', $slider_overlap );
	}
}
add_action( 'save_post', 'ultra_slider_page_setting_save' );
