<?php
/**
 * Compatibility with Page Builder by SiteOrigin.
 *
 * @link https://wordpress.org/plugins/siteorigin-panels/
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */

/**
 * The default Panels Lite labels.
 */
function ultra_panels_lite_localization( $loc ) {
	return wp_parse_args( array(
		'page_builder'         => esc_html__( 'Page Builder', 'ultra' ),
		'home_page_title'      => esc_html__( 'Custom Home Page Builder', 'ultra' ),
		'home_page_menu'       => esc_html__( 'Home Page', 'ultra' ),
		'install_plugin'       => esc_html__( 'Install Page Builder Plugin', 'ultra' ),
		'on_text'              => esc_html__( 'On', 'ultra' ),
		'off_text'             => esc_html__( 'Off', 'ultra' ),
		'home_install_message' => esc_html__( 'Ultra supports Page Builder to create beautifully proportioned column based content.', 'ultra' )
	), $loc );
}
add_filter( 'siteorigin_panels_lite_localization', 'ultra_panels_lite_localization' );

/**
 * Remove Post Loop widget templates that aren't complete loops.
 */
function ultra_filter_post_loop_widget( $templates ) {
	$disallowed_template_patterns = array(
		'content-none.php',
		'content-page.php',
		'content-search.php',
		'content-single.php',
		'content.php',
	);
	foreach ( $templates as $template ) {
		if ( in_array( $template, $disallowed_template_patterns ) ) {
			$key = array_search( $template, $templates );
			if ( false !== $key ) {
				unset( $templates[$key] );
			}
		}
	}
	return $templates;
}
add_filter( 'siteorigin_panels_postloop_templates', 'ultra_filter_post_loop_widget', 10, 1 );

if ( ! function_exists( 'ultra_panels_add_full_width_container' ) ) :
/**
 * Sets the Page Builder full width container.
 */
function ultra_panels_add_full_width_container() {
	return '#content';
}
endif;
add_filter( 'siteorigin_panels_full_width_container', 'ultra_panels_add_full_width_container' );

/**
 * Adds default page layouts.
 *
 * @param $layouts
 */
function ultra_prebuilt_page_layouts( $layouts ) {
	$layouts['default-home'] = array (
		'name' => __( 'Default Home', 'ultra' ),
		'screenshot' =>  get_template_directory_uri() . '/img/default-home.png',
		'widgets' =>
			array (
				0 =>
					array (
						'features' =>
							array (
								0 =>
									array (
										'container_color' => '#0896fe;',
										'icon' => 'fontawesome-tablet',
										'icon_color' => '#ffffff',
										'icon_image' => 0,
										'title' => __('Responsive Design', 'ultra'),
										'text' => 'Ultra is ready for a multi-device world. Built from the ground up to be fully responsive, you can be sure your site will look stunning on any device. ',
										'more_text' => __('Read More', 'ultra'),
										'more_url' => '#',
									),
								1 =>
									array (
										'container_color' => '#0896fe;',
										'icon' => 'fontawesome-arrows',
										'icon_color' => '#ffffff',
										'icon_image' => 0,
										'title' => __('Drag and Drop Layouts', 'ultra'),
										'text' => 'We\'ve tightly integrated SiteOrigin\'s powerful Page Builder plugin. Create the layouts you\'ve been dreaming of without touching any code.',
										'more_text' => __('Read More', 'ultra'),
										'more_url' => '#',
									),
								2 =>
									array (
										'container_color' => '#0896fe;',
										'icon' => 'fontawesome-comments-o',
										'icon_color' => '#ffffff',
										'icon_image' => 0,
										'title' => __('Professional Support', 'ultra'),
										'text' => 'Keep your project moving forward with quick support on the WordPress.org forums. Beginner or advanced user, we\'re here to help.',
										'more_text' => __('Read More', 'ultra'),
										'more_url' => '#',
									),
							),
						'container_shape' => 'round',
						'container_size' => 70,
						'icon_size' => 28,
						'per_row' => 3,
						'responsive' => true,
						'panels_info' =>
							array (
								'class' => 'SiteOrigin_Widget_Features_Widget',
								'grid' => 0,
								'cell' => 0,
								'id' => 1,
								'style' =>
									array (
										'background_image_attachment' => false,
										'background_display' => 'tile',
									),
							),
						'title_link' => false,
						'icon_link' => false,
						'new_window' => false,
					),
				1 =>
					array (
						'type' => 'html',
						'title' => '',
						'text' => '<h1 style="text-align: center;">' . __('Custom Home Page', 'ultra') . '</h1>
						<hr style="max-width: 400px;" />
						<h5 style="font-weight: normal; text-align: center;">' . __("This full-width headline was created using SiteOrigin's Page Builder and the Visual Editor widget.", 'ultra') . '</h5>',
						'filter' => '1',
						'panels_info' =>
							array (
								'class' => 'WP_Widget_Black_Studio_TinyMCE',
								'raw' => false,
								'grid' => 1,
								'cell' => 0,
								'id' => 2,
								'style' =>
									array (
										'background_display' => 'tile',
									),
							),
					),
				2 =>
					array (
						'title' => 'Latest Posts',
						'posts' => '',
						'panels_info' =>
							array (
								'class' => 'SiteOrigin_Widget_PostCarousel_Widget',
								'raw' => false,
								'grid' => 2,
								'cell' => 0,
								'id' => 2,
								'style' =>
									array (
										'background_display' => 'tile',
									),
							),
					),
			),
		'grids' =>
			array (
				0 =>
					array (
						'cells' => 1,
						'style' =>
							array (
								'row_css' => 'padding:0px !important;',
								'background_display' => 'tile',
							),
					),
				1 =>
					array (
						'cells' => 1,
						'style' =>
							array (
								'padding' => '30px',
								'row_stretch' => 'full',
								'background' => '#f6f6f7',
								'background_display' => 'tile',
								'border_color' => '#eaeaeb',
							),
					),
				2 =>
					array (
						'cells' => 1,
						'style' =>
							array (
							),
					),
			),
		'grid_cells' =>
			array (
				0 =>
					array (
						'grid' => 0,
						'weight' => 1,
					),
				1 =>
					array (
						'grid' => 1,
						'weight' => 1,
					),
				2 =>
					array (
						'grid' => 2,
						'weight' => 1,
					),
			),
	);

	return $layouts;
}
add_filter( 'siteorigin_panels_prebuilt_layouts', 'ultra_prebuilt_page_layouts' );