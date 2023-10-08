<?php
/**
 * Ultra functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */

define( 'SITEORIGIN_THEME_VERSION' , '1.6.4' );
define( 'SITEORIGIN_THEME_ENDPOINT' , 'http://updates.purothemes.com' );
define( 'SITEORIGIN_THEME_JS_PREFIX', defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );

if ( file_exists( get_template_directory() . '/premium/functions.php' ) ){
	include get_template_directory() . '/premium/functions.php';
} else {
	include get_template_directory() . '/upgrade/upgrade.php';
}

// Load the settings framework.
include get_template_directory() . '/inc/customizer/customizer.php';
include get_template_directory() . '/inc/premium/premium.php';
include get_template_directory() . '/inc/settings/settings.php';
include get_template_directory() . '/inc/sliders/sliders.php';
include get_template_directory() . '/inc/update/update.php';
include get_template_directory() . '/inc/webfonts/webfonts.php';

// Include theme specific files.
require get_template_directory() . '/inc/comments.php';
require get_template_directory() . '/inc/extras.php';
include get_template_directory() . '/inc/sliders.php';
include get_template_directory() . '/inc/panels.php';
include get_template_directory() . '/inc/panels-missing-widgets.php';
include get_template_directory() . '/inc/plugin-activation/plugin-activation.php';
include get_template_directory() . '/inc/settings.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/deprecated.php';

// Include Jetpack.
if ( class_exists( 'Jetpack' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Include Breadcrumb Trail.
if ( ! function_exists( 'breadcrumb_trail' ) )
	require_once( 'breadcrumbs/breadcrumbs.php' );

// Include WooCommerce.
if ( class_exists( 'woocommerce' ) ) {
	require get_template_directory() . '/woocommerce/functions.php';
}

if ( ! function_exists( 'ultra_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ultra_setup() {

	/**
	 * Set the content width based on the theme's design and page template in use.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 821;
	}
	function ultra_adjust_content_width() {
		global $content_width;

		if ( is_page_template( 'page-templates/full-width.php' ) || is_page_template( 'page-templates/full-width-no-title.php' ) || is_page_template( 'home-panels.php' ) ) {
			$content_width = 1150;
		}
	}
	add_action( 'template_redirect', 'ultra_adjust_content_width' );

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ultra, use a find and replace
	 * to change 'ultra' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ultra', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Block Editor Wide Alignment.
	 *
	 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#wide-alignment
	 */
	add_theme_support( 'align-wide' );

	// Disable WP 5.8+ Widget Area.
	if ( apply_filters( 'ultra_disable_new_widget_area', true ) ) {
		remove_theme_support( 'widgets-block-editor' );
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in four locations.
	register_nav_menus( array(
		'secondary' => esc_html__( 'Top Bar Menu', 'ultra' ),
		'top-bar-social' => esc_html__( 'Top Bar Social Menu', 'ultra' ),
		'primary' => esc_html__( 'Primary Menu', 'ultra' ),
		'footer' => esc_html__( 'Bottom Bar Social Menu', 'ultra' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	/*
	 * Allow shortcodes to be use in category descriptions.
	 * See https://developer.wordpress.org/reference/functions/term_description/
	 */
	add_filter( 'term_description', 'shortcode_unautop' );
	add_filter( 'term_description', 'do_shortcode' );

	/*
	 * Enable support for the custom logo.
	 */
	add_theme_support( 'custom-logo' );

	/**
	 * Support SiteOrigin Page Builder plugin.
	 */
	add_theme_support( 'siteorigin-panels', array(
		'home-page'          => true,
		'home-page-default'  => false,
		'home-demo-template' => 'home-panels.php',
		'responsive'         => siteorigin_setting( 'layout_responsive' ),
		'margin-bottom'      => 35,
		'margin-sides'       => 35
	) );

	/**
	 * Add the default webfonts.
	 */
	siteorigin_webfonts_add_font( 'Muli', array( 300 ) );
	siteorigin_webfonts_add_font( 'Lato', array( 300, 400, 700 ) );

	/**
	 * Use the SiteOrigin archive theme settings.
	 */
	add_theme_support( 'siteorigin-template-settings' );

	/**
	 * Define the upgrade page URL.
	 */
	define( 'SITEORIGIN_THEME_PREMIUM_URL', admin_url( 'themes.php?page=premium_upgrade' ) );

}
endif; // ultra_setup.
add_action( 'after_setup_theme', 'ultra_setup' );

if ( ! function_exists( 'ultra_register_custom_background' ) ) :
/**
 * Setup the WordPress core custom background feature.
 */
function ultra_register_custom_background() {

	if ( siteorigin_setting( 'layout_bound' ) == 'boxed' ) {
		$args = array(
			'default-color' => 'eaeaea',
			'default-image' => '',
		);

		$args = apply_filters( 'ultra_custom_background_args', $args );
		add_theme_support( 'custom-background', $args );
	}

}
endif;
add_action( 'after_setup_theme', 'ultra_register_custom_background' );

/**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function ultra_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ultra' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Visible on posts and pages that use the default template.', 'ultra' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'ultra' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'A column will be automatically assigned to each widget inserted.', 'ultra' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'ultra_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ultra_scripts() {
	$in_footer = siteorigin_setting( 'footer_js_enqueue' );

	// Theme stylesheet.
	wp_enqueue_style( 'ultra-style', get_stylesheet_uri(), array(), SITEORIGIN_THEME_VERSION );

	// Font Awesome.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

	// Theme JavaScript.
	wp_enqueue_script( 'ultra-theme', get_template_directory_uri() . '/js/jquery.theme' . SITEORIGIN_THEME_JS_PREFIX . '.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION, $in_footer );

	// Sticky header.
	if ( siteorigin_setting( 'header_sticky' ) ) {
		wp_enqueue_script( 'jquery-hc-sticky', get_template_directory_uri() . '/js/jquery.hc-sticky.min.js', array( 'jquery' ), '2.2.6', $in_footer );
	}

	// Mobile menu.
	if ( siteorigin_setting( 'navigation_responsive_menu' ) ) {
		wp_enqueue_script( 'ultra-responsive-menu', get_template_directory_uri() . '/js/responsive-menu' . SITEORIGIN_THEME_JS_PREFIX . '.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION, true );
	}

	// Mobile menu collapse localisation.
	wp_localize_script( 'ultra-responsive-menu', 'ultra_resp_menu_params', array( 'collapse' => siteorigin_setting( 'navigation_responsive_menu_collapse' ) ) );

	// Smooth scroll localisation.
	wp_localize_script( 'ultra-theme', 'ultra_smooth_scroll_params', array( 'value' => siteorigin_setting( 'navigation_smooth_scroll' ) ) );

	// Top Bar collapse localisation.
	wp_localize_script( 'ultra-theme', 'ultra_resp_top_bar_params', array( 'collapse' => siteorigin_setting( 'navigation_responsive_menu_collapse' ) ) );

	// FlexSlider.
	wp_enqueue_script( 'jquery-flexslider' , get_template_directory_uri() . '/js/jquery.flexslider' . SITEORIGIN_THEME_JS_PREFIX . '.js', array( 'jquery' ), '2.2.2', $in_footer );	

	// FitVids.
	if ( siteorigin_setting( 'layout_fitvids' ) ) {
		wp_enqueue_script( 'jquery-fitvids' , get_template_directory_uri().'/js/jquery.fitvids' . SITEORIGIN_THEME_JS_PREFIX . '.js', array( 'jquery' ), '1.1', $in_footer );
	}

	// Skip link focus fix.
	wp_enqueue_script( 'ultra-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), SITEORIGIN_THEME_VERSION, $in_footer );

	// Comment reply.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Flexie.
	wp_enqueue_script( 'ultra-flexie', get_template_directory_uri() . '/js/flexie.js', array(), '1.0.3' );
	wp_script_add_data( 'ultra-flexie', 'conditional', 'lt IE 9' );

	// HTML5Shiv.
	wp_enqueue_script( 'ultra-html5', get_template_directory_uri() . '/js/html5shiv-printshiv.js', array(), '3.7.3' );
	wp_script_add_data( 'ultra-html5', 'conditional', 'lt IE 9' );

	// Selectivizr.
	wp_enqueue_script( 'ultra-selectivizr', get_template_directory_uri() . '/js/selectivizr' . SITEORIGIN_THEME_JS_PREFIX . '.js', array(), '1.0.3b' );
	wp_script_add_data( 'ultra-selectivizr', 'conditional', '(gte IE 6)&(lte IE 8)' );
}
add_action( 'wp_enqueue_scripts', 'ultra_scripts' );

/**
 * Enqueue Block Editor styles.
 */
function ultra_block_editor_styles() {
	wp_enqueue_style( 'ultra-block-editor-styles', get_template_directory_uri() . '/style-editor.css', SITEORIGIN_THEME_VERSION );
}
add_action( 'enqueue_block_editor_assets', 'ultra_block_editor_styles' );

if ( ! function_exists( 'ultra_breadcrumb' ) ):
/**
 * Render the breadcrumb trail.
 */
function ultra_breadcrumb() {
	$breadcrumbs = '';

	// JT Breadcrumb Trail.
	if ( function_exists( 'breadcrumb_trail' ) && siteorigin_setting( 'navigation_breadcrumb_trail' ) ) {
		$breadcrumbs = breadcrumb_trail(
			array( 
				'container'     => 'nav',
				'separator'     => '/',
				'show_browse'   => false,
				'show_on_front' => false,
			)
		);
	}

	// Yoast SEO.
	elseif ( function_exists( 'yoast_breadcrumb' ) ) {
		$breadcrumbs = yoast_breadcrumb( "", "", false );
	}

	// Breadcrumb NavXT.
	elseif ( function_exists( 'bcn_display' ) ) {
		$breadcrumbs = bcn_display( true );
	}

	if ( ! empty( $breadcrumbs ) ) { 
		echo '<div class="breadcrumbs">'. $breadcrumbs .'</div>';

	}
}
endif;

/**
 * Filter the comment form.
 * Remove comment form allowed tags if theme option is disabled.
 *
 * @param $defaults
 * @return mixed
 */
function ultra_comment_form_defaults( $defaults ) {
	if ( siteorigin_setting( 'comments_allowed_tags' ) ) {
		$defaults['comment_notes_after'] = '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'ultra' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>';
	}

	return $defaults;
}
add_filter( 'comment_form_defaults', 'ultra_comment_form_defaults', 5 );

if ( ! function_exists( 'ultra_read_more_link' ) ) :
/**
 * Filter the read more link.
 */
function ultra_read_more_link() {
	$read_more_text = siteorigin_setting( 'blog_read_more' ) ? esc_html( siteorigin_setting( 'blog_read_more' ) ) : esc_html__( 'Continue reading', 'ultra' );
	return '<span class="more-wrapper"><a class="more-link button" href="' . get_permalink() . '">' . $read_more_text . '</a></span>';
}
add_filter( 'the_content_more_link', 'ultra_read_more_link' );
endif;

if ( ! function_exists( 'ultra_excerpt' ) ) :
/**
 * Outputs the excerpt.
 */
function ultra_excerpt() {

	if ( siteorigin_setting( 'blog_archive_content' ) == 'excerpt' && siteorigin_setting( 'blog_excerpt_more' ) && ! is_search() ) {
		$read_more_text = siteorigin_setting( 'blog_read_more' ) ? esc_html( siteorigin_setting( 'blog_read_more' ) ) : esc_html__( 'Continue reading', 'ultra' );
		$read_more_text = '<span class="more-wrapper"><a class="more-link button" href="' . get_permalink() . '">' . $read_more_text . '</a></span>';
	} else {
		$read_more_text = '';
	}
	$ellipsis = '...';
	$length = siteorigin_setting( 'blog_excerpt_length' );

	if ( $length ) {
		$excerpt = explode( ' ', get_the_excerpt(), $length );
		if ( count( $excerpt ) >= $length ) {
			array_pop( $excerpt );
			$excerpt = '<p>' . implode( ' ', $excerpt ) . $ellipsis . '</p>' . $read_more_text;
		} else {
			$excerpt = '<p>' . implode( ' ', $excerpt ) . $ellipsis . '</p>' . $read_more_text;
		}
	} else {
		$excerpt = get_the_excerpt();
	}

	$excerpt = preg_replace( '`\[[^\]]*\]`','', $excerpt );

	echo $excerpt;

}
endif;

/**
 * Count the footer widgets and add the count to the widget class.
 */
function ultra_footer_widgets_params( $params ) {
	$sidebar_id = $params[0]['id'];

	if ( $sidebar_id == 'sidebar-2' ) {

		$total_widgets = wp_get_sidebars_widgets();
		$sidebar_widgets = count( $total_widgets[$sidebar_id] );

		$params[0]['before_widget'] = str_replace( 'class="', 'class="widget-count-' . floor( $sidebar_widgets ) . ' ', $params[0]['before_widget'] );
	}

	return $params;
}
add_filter( 'dynamic_sidebar_params', 'ultra_footer_widgets_params' );

/**
 * Filter the header opacity setting.
 */
function ultra_filter_header_opacity() {
	return siteorigin_setting( 'header_opacity' );
}
add_filter( 'ultra_sticky_header_opacity', 'ultra_filter_header_opacity' );

/**
 * Add the header opacity CSS.
 */
function ultra_set_header_opacity() {
	if ( siteorigin_setting( 'header_opacity' ) == '1' ) return;
	$header_opacity_theme_setting = siteorigin_setting( 'header_opacity' );
	$header_background_color = get_theme_mod( 'ultra_header_background_color', '#ffffff' );
	if ( $header_opacity_theme_setting != 1 && $header_background_color == '#ffffff' ) {
		$header_sticky_opacity = apply_filters( 'ultra_sticky_header_opacity', 1 );
		?>
		<style type="text/css" id="ultra-sticky-header-css"> 
			.site-header.is-stuck {
				background: rgba(255,255,255,<?php echo floatval( $header_sticky_opacity ) ?>);
			}
		</style>
		<?php
	}
}
add_action( 'wp_head', 'ultra_set_header_opacity' );

if ( ! function_exists( 'ultra_remove_current_menu_class' ) ) :
function ultra_remove_current_menu_class( $classes ) {
	$disallowed_class_names = array(
		'current-menu-item',
		'current_page_item',
	);
	foreach ( $classes as $class ) {
		if ( in_array( $class, $disallowed_class_names ) ) {
			$key = array_search( $class, $classes );
			if ( false !== $key ) {
				unset( $classes[$key] );
			}
		}
	}
	return $classes;
}
endif;
add_filter( 'nav_menu_css_class', 'ultra_remove_current_menu_class', 10, 1 );

if ( ! function_exists( 'ultra_render_slider' ) ) :
/**
 * Render Meta Slider.
 */
function ultra_render_slider() {
	if ( is_front_page() && ! in_array( siteorigin_setting( 'home_slider' ), array( '', 'none' ) ) ) {
		$settings_slider = siteorigin_setting( 'home_slider' );
		$slider_stretch = siteorigin_setting( 'home_slider_stretch' );
		$slider_overlap = siteorigin_setting( 'home_header_overlaps' );
		$slider = false;

		if ( ! empty( $settings_slider ) ) {
			$slider = $settings_slider;
		}

	} else {

		$page_id = get_the_ID();
		$is_wc_shop = ultra_is_woocommerce_active() && is_woocommerce() && is_shop();

		if ( $is_wc_shop ) {
			$page_id = wc_get_page_id( 'shop' );
		}

		if ( is_home() ) {
			$page_id = get_queried_object_id();
		}

		if ( ( is_page() || $is_wc_shop || is_home() ) && get_post_meta( $page_id, 'ultra_metaslider_slider', true ) != 'none' ) {
			$page_slider = get_post_meta( $page_id, 'ultra_metaslider_slider', true );
			if ( ! empty( $page_slider ) ) {
				$slider = $page_slider;
			}
			$slider_stretch = get_post_meta( $page_id, 'ultra_metaslider_slider_stretch', true );
			$slider_overlap = get_post_meta( $page_id, 'ultra_metaslider_slider_overlap', true );
		}
		
	}

	if ( empty( $slider ) ) return;

	global $ultra_is_main_slider;
	$ultra_is_main_slider = true;

	list( $type, $slider_id ) = explode( ':', $slider );
	if ( $type == 'meta' && ! class_exists( 'MetaSliderPlugin' ) || $type == 'smart' && ! class_exists( 'SmartSlider3' ) ) {
		return;
	}
	$shortcode = '[' . ( $type == 'meta' ? 'metaslider id=' : 'smartslider3 slider=' ) . intval( $slider_id ) . ']';
	?>
	<div id="main-slider" <?php if ( ! empty( $slider_stretch ) ) echo 'data-stretch="true"' ?>>
		<?php echo do_shortcode( $shortcode ); ?>
	</div><?php

	$ultra_is_main_slider = false;
}
endif;

if ( ! function_exists( 'ultra_get_site_width' ) ) :
/**
 * Get the site width.
 *
 * @return int The site width in pixels.
 */
function ultra_get_site_width() {
	return apply_filters( 'ultra_site_width', ! empty( $GLOBALS['ultra_site_width'] ) ? $GLOBALS['ultra_site_width'] : 1150 );
}
endif;

/**
 * Add the meta viewport tag.
 */
function ultra_responsive_header() {
	if ( siteorigin_setting('layout_responsive') ) {
		?><meta name="viewport" content="width=device-width, initial-scale=1" /><?php
	} else {
		?><meta name="viewport" content="width=1280" /><?php
	}
}
add_action( 'wp_head', 'ultra_responsive_header' );

/**
 * Add the responsive menu button.
 */
function ultra_responsive_menu() {
	if ( siteorigin_setting( 'navigation_responsive_menu' ) ) {
		echo '<button class="menu-toggle"></button>';
	}
}
add_action( 'ultra_before_nav', 'ultra_responsive_menu' );

/**
 * Filter the responsive menu collapse.
 */
function ultra_filter_responsive_menu_collapse( $collpase ) {
	return siteorigin_setting( 'navigation_responsive_menu_collapse' );
}
add_filter( 'ultra_responsive_menu_resolution', 'ultra_filter_responsive_menu_collapse' );

if ( ! function_exists( 'ultra_responsive_menu_css' ) ):
/**
 * Output the responsive menu collpase point.
 */
function ultra_responsive_menu_css() {
	if ( ! siteorigin_setting( 'navigation_responsive_menu' ) || ! siteorigin_setting( 'layout_responsive' ) ) return;
	$mobile_resolution = apply_filters( 'ultra_responsive_menu_resolution', 1024 );
	?>
	<style type="text/css" id="ultra-menu-css"> 
		@media (max-width: <?php echo intval( $mobile_resolution ) ?>px) { 
			.responsive-menu .main-navigation ul { display: none } 
			.responsive-menu .menu-toggle { display: block }
			.responsive-menu .menu-search { display: none }
			.site-header .site-branding-container { max-width: 90% }
			.main-navigation { max-width: 10% }
		}
		@media (min-width: <?php echo intval( $mobile_resolution ) ?>px) {
			.header-centered .site-header .container { height: auto; }
			.header-centered .site-header .site-branding-container { float: none; max-width: 100%; padding-right: 0; text-align: center; }
			.header-centered .main-navigation { float: none; max-width: 100%; text-align: center; }
			.header-centered .main-navigation > div { display: inline-block; float: none; vertical-align: top; }
		}
	</style>
	<?php
}
endif;
add_action( 'wp_head', 'ultra_responsive_menu_css' );

if ( ! function_exists( 'ultra_back_to_top' ) ) :
/**
 * Display the scroll to top link.
 */
function ultra_back_to_top() {
	if ( ! siteorigin_setting( 'navigation_scroll_top' ) && ! siteorigin_setting( 'navigation_scroll_top_mobile' ) ) return;
	$scroll_to_top = siteorigin_setting( 'navigation_scroll_top' ) ? 'scroll-to-top' : '';
	?><a href="#" id="scroll-to-top" class="<?php echo $scroll_to_top; ?>" title="<?php esc_attr_e( 'Back To Top', 'ultra' ) ?>"><span class="up-arrow"></span></a><?php
}
add_action( 'wp_footer', 'ultra_back_to_top' );
endif;

/**
* Handles the site title, copyright symbol and year string replace for the Footer Copyright theme option.
*/
function ultra_footer_copyright_text_sub( $copyright ) {
	$site_title = '<a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a>';
	return str_replace(
		array( '{site-title}', '{copyright}', '{year}' ),
		array( $site_title, '&copy;', date_i18n( esc_html__( 'Y', 'ultra' ) ) ),
		$copyright
	);
}
add_filter( 'ultra_copyright_text', 'ultra_footer_copyright_text_sub' );

if ( ! function_exists( 'ultra_top_bar_text_area' ) ):
/**
 * Display the top bar text.
 */
function ultra_top_bar_text_area() {
	$phone = wp_kses_post( siteorigin_setting( 'text_phone' ) );
	$email = wp_kses_post( siteorigin_setting( 'text_email' ) );

	if ( siteorigin_setting( 'text_phone' ) ) {
		echo '<span class="phone"><a href="tel:' . $phone . '">' . $phone . '</a></span>';
	}
	if ( siteorigin_setting( 'text_email' ) ) {
		echo '<span class="email"><a href="mailto:' . $email . '">' . $email . '</a></span>';
	}
}
add_action( 'ultra_top_bar_text', 'ultra_top_bar_text_area' );
endif;

if ( ! function_exists( 'ultra_is_woocommerce_active' ) ) :
/**
 * Check that WooCommerce is active.
 *
 * @return bool
 */
function ultra_is_woocommerce_active() {
	return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
}
endif;

/* IMPORTANT NOTICE: Please don't edit this file; any changes made here will be lost during the theme update process. 
If you need to add custom functions, use the Code Snippets plugin (https://wordpress.org/plugins/code-snippets/) or a child theme. */
