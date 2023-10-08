<?php

/**
 * Initialize the settings.
 */
function ultra_theme_settings() {
	$settings = SiteOrigin_Settings::single();

	$settings->add_section( 'header', esc_html__( 'Header', 'ultra' ) );
	$settings->add_section( 'navigation', esc_html__( 'Navigation', 'ultra' ) );
	$settings->add_section( 'layout', esc_html__( 'Layout', 'ultra' ) );
	$settings->add_section( 'home', esc_html__( 'Home', 'ultra' ) );
	$settings->add_section( 'pages', esc_html__( 'Pages', 'ultra' ) );
	$settings->add_section( 'blog', esc_html__( 'Blog', 'ultra' ) );
	$settings->add_section( 'comments', esc_html__( 'Comments', 'ultra' ) );
	$settings->add_section( 'social', esc_html__( 'Social', 'ultra' ) );
	$settings->add_section( 'footer', esc_html__( 'Footer', 'ultra' ) );
	$settings->add_section( 'text', esc_html__( 'Site Text', 'ultra' ) );

	// Header.
	$settings->add_field( 'header', 'logo', 'media', esc_html__( 'Logo', 'ultra' ), array(
		'description' => esc_html__( 'Your own custom logo.', 'ultra' ),
	) );

	$settings->add_teaser( 'header', 'image_retina', 'media', esc_html__( 'Retina Logo', 'ultra' ), array(
		'choose'      => esc_html__( 'Choose Image', 'ultra' ),
		'update'      => esc_html__( 'Set Logo', 'ultra' ),
		'description' => esc_html__( 'A double sized version of your logo for use on high pixel density displays. Must be used in addition to standard logo.', 'ultra' ),
	) );

	$settings->add_field( 'header', 'logo_with_title', 'checkbox', esc_html__( 'Display Logo and Site Title', 'ultra' ), array(
		'description' => esc_html__( 'Display the logo followed by the site title. Only applicable if a logo image has been set.', 'ultra' ),
	) );

	$settings->add_field( 'header', 'tagline', 'checkbox', esc_html__( 'Tagline', 'ultra' ), array(
		'description' => esc_html__( 'Display the website tagline.', 'ultra' ),
	) );

	$settings->add_field( 'header', 'top_bar', 'checkbox', esc_html__( 'Top Bar', 'ultra' ), array(
		'description' => esc_html__( 'Display the top bar.', 'ultra' ),
	) );

	$settings->add_field( 'header', 'display', 'checkbox', esc_html__( 'Header', 'ultra' ), array(
		'description' => esc_html__( 'Display the header.', 'ultra' ),
	) );

	$settings->add_field( 'header', 'layout', 'select', esc_html__( 'Header Layout', 'ultra' ), array(
		'options'     => array(
			'default'  => esc_html__( 'Default', 'ultra' ),
			'centered' => esc_html__( 'Centered', 'ultra'),
		),
		'description' => esc_html__( 'Select the header layout.', 'ultra'),
	) );

	$settings->add_field( 'header', 'sticky', 'checkbox', esc_html__( 'Sticky Header', 'ultra' ), array(
		'description' => esc_html__( 'Sticks the header to the top of the screen as the user scrolls down.', 'ultra' ),
	) );

	$settings->add_field( 'header', 'sticky_mobile', 'checkbox', esc_html__( 'Mobile Sticky Header', 'ultra' ), array(
		'description' => esc_html__( 'Use the sticky header on mobile devices.', 'ultra' ),
	) );

	$settings->add_field( 'header', 'opacity', 'text', esc_html__( 'Sticky Header Opacity', 'ultra' ), array(
		'description' => esc_html__( 'Set the header background opacity once it turns sticky. 0.1 (lowest) - 1 (highest).', 'ultra' ),
	) );

	$settings->add_field( 'header', 'scale', 'checkbox', esc_html__( 'Sticky Header Scaling', 'ultra' ), array(
		'description' => esc_html__( 'Scale the header down as it becomes sticky.', 'ultra' ),
	) );

	// Navigation.
	$settings->add_field( 'navigation', 'top_bar_menu', 'checkbox', esc_html__( 'Top Bar Menu', 'ultra' ), array(
		'description' => esc_html__( 'Display the right top bar menu.', 'ultra' ),
	) );

	$settings->add_field( 'navigation', 'responsive_top_bar', 'checkbox', esc_html__( 'Responsive Top Bar', 'ultra' ), array(
		'description' => esc_html__( 'Collapse the top bar for small screen devices.', 'ultra' ),
	) );

	$settings->add_field( 'navigation', 'primary_menu', 'checkbox', esc_html__( 'Primary Menu', 'ultra' ), array(
		'description' => esc_html__( 'Display the primary menu.', 'ultra' ),
	) );

	$settings->add_field( 'navigation', 'responsive_menu', 'checkbox', esc_html__( 'Responsive Menu', 'ultra' ), array(
		'description' => esc_html__( 'Use a special responsive menu for small screen devices. Requires the Primary Menu setting to be enabled.', 'ultra' ),
	) );

	$settings->add_field( 'navigation', 'responsive_menu_collapse', 'number', esc_html__( 'Responsive Menu Collapse', 'ultra' ), array(
		'description' => esc_html__( 'The pixel resolution when the primary menu and top bar collapse.', 'ultra' ),
	) );

	$settings->add_field( 'navigation', 'menu_search', 'checkbox', esc_html__( 'Menu Search', 'ultra' ), array(
		'description' => esc_html__( 'Display a search icon in the main menu.', 'ultra' ),
	) );

	$settings->add_field( 'navigation', 'smooth_scroll', 'checkbox', esc_html__( 'Smooth Scroll', 'ultra' ), array(
		'description' => esc_html__( 'Smooth scroll for internal anchor links from the main menu.', 'ultra' ),
	) );

	$settings->add_field( 'navigation', 'breadcrumb_trail', 'checkbox', esc_html__( 'Breadcrumb Trail', 'ultra' ), array(
		'description' => esc_html__( 'Display a breadcrumb trail below the menu. De-activate this setting if using Yoast Breadcrumbs or Breadcrumb NavXT.', 'ultra' ),
	) );

	$settings->add_field( 'navigation', 'post_nav', 'checkbox', esc_html__( 'Post Navigation', 'ultra' ), array(
		'description' => esc_html__( 'Display next/previous post navigation.', 'ultra' ),
	) );

	$settings->add_field( 'navigation', 'scroll_top', 'checkbox', esc_html__( 'Scroll to Top', 'ultra' ), array(
		'description' => esc_html__( 'Display the scroll to top button.', 'ultra' ),
	) );

	$settings->add_field( 'navigation', 'scroll_top_mobile', 'checkbox', esc_html__( 'Mobile Scroll to Top', 'ultra' ), array(
		'description' => esc_html__( 'Display the scroll to top button on mobile devices.', 'ultra' ),
	) );

	// Layout.
	$settings->add_field( 'layout', 'bound', 'select', esc_html__( 'Layout Bound', 'ultra' ), array(
		'options' => array(
			'full' => esc_html__( 'Full Width', 'ultra' ),
			'boxed' => esc_html__( 'Boxed', 'ultra' ),
		),
		'description' => esc_html__( 'Select a full width or boxed theme layout.', 'ultra' ),
	) );

	$settings->add_field( 'layout', 'responsive', 'checkbox', esc_html__( 'Responsive Layout', 'ultra' ), array(
		'description' => esc_html__( 'Adapt the site layout for mobile devices.', 'ultra' ),
	) );

	$settings->add_field( 'layout', 'fitvids', 'checkbox', esc_html__( 'FitVids.js', 'ultra' ), array(
		'description' => esc_html__( 'Include FitVids.js for fluid width video embeds.', 'ultra' ),
	) );

	// Home.
	$description = '';
	if ( ! class_exists( 'MetaSliderPlugin' ) && ! class_exists( 'SmartSlider3' ) ) {
		$description = sprintf(
			esc_html__( 'This theme supports Smart Slider 3. %1$s for free to create beautiful responsive sliders - %2$s', 'ultra' ),
			'<a href="' . ultra_smartslider_install_link() . '">Install it</a>',
			'<a href="https://purothemes.com/documentation/ultra-theme/home-page-slider/" target="_blank">More Info</a>'
		);
	}

	$settings->add_field( 'home', 'slider', 'select', esc_html__( 'Home Page Slider', 'ultra' ), array(
		'options' => ultra_sliders_get_options( true ),
		'description' => $description,
	) );
		
	if ( class_exists( 'MetaSliderPlugin' ) ) {
		$settings->add_field( 'home', 'slider_stretch', 'checkbox', esc_html__( 'Stretch Home Slider', 'ultra' ), array(
			'label'       => esc_html__( 'Stretch', 'ultra' ),
			'description' => esc_html__( 'Stretch the home page slider to the width of the screen if using the full width layout.', 'ultra' ),
		) );
	}

	if ( class_exists( 'MetaSliderPlugin' ) || class_exists( 'SmartSlider3' ) ) {
		$settings->add_field( 'home', 'header_overlaps', 'checkbox', esc_html__('Header Overlaps Slider', 'ultra'), array(
			'description' => esc_html__( 'Should the header overlap the home page slider?', 'ultra' ),
		) );
	}

	// Pages.
	$settings->add_field( 'pages', 'featured_image', 'checkbox', esc_html__( 'Featured Image', 'ultra' ), array(
		'description' => esc_html__( 'Display the featured image on pages.', 'ultra' ),
	) );

	// Blog.
	$settings->add_field( 'blog', 'page_title', 'text', esc_html__( 'Blog Page Title', 'ultra' ), array(
		'description' => esc_html__( 'The page title of the blog page.', 'ultra' ),
	) );

	$settings->add_field( 'blog', 'archive_layout', 'select', esc_html__( 'Blog Archive Layout', 'ultra' ), array(
		'options' => ultra_blog_layout_options(),
		'description' => esc_html__( 'Choose the layout to be used on blog and archive pages.', 'ultra' ),
	) );

	$settings->add_field( 'blog', 'archive_featured_image', 'checkbox', esc_html__( 'Archive Featured Image', 'ultra' ), array(
		'description' => esc_html__( 'Display the featured image on the blog archive pages.', 'ultra' ),
	) );

	$settings->add_field( 'blog', 'archive_content', 'select', esc_html__( 'Archive Post Content', 'ultra' ), array(
		'options' => array(
			'full' => esc_html__( 'Full Post Content', 'ultra' ),
			'excerpt' => esc_html__( 'Post Excerpt', 'ultra' ),
		),
		'description' => esc_html__( 'Choose how to display your post content on blog and archive pages. Select Full Post Content if using the "more" quicktag.', 'ultra' ),	
	) );

	$settings->add_field( 'blog', 'read_more', 'text', esc_html__( 'Read More Text', 'ultra' ), array(
		'description' => esc_html__( 'The link text displayed when posts are split using the "more" quicktag.', 'ultra' ),
	) );

	$settings->add_field( 'blog', 'excerpt_length', 'number', esc_html__( 'Post Excerpt Length', 'ultra' ), array(
		'description' => esc_html__( 'If no manual post excerpt is added one will be generated. How many words should it be?', 'ultra' ),
		'sanitize_callback' => 'absint',
	));

	$settings->add_field( 'blog', 'excerpt_more', 'checkbox', esc_html__( 'Post Excerpt Read More Link', 'ultra' ), array(
		'description' => esc_html__( 'Display the Read More text below the post excerpt. Only applicable if Post Excerpt has been selected from the Archive Post Content setting.', 'ultra' ),
	) );

	$settings->add_field( 'blog', 'post_featured_image', 'checkbox', esc_html__( 'Post Featured Image', 'ultra' ), array(
		'description' => esc_html__( 'Display the featured image on the single post page.', 'ultra' )
	) );

	$settings->add_field( 'blog', 'post_date', 'checkbox', esc_html__( 'Post Date', 'ultra' ), array(
		'description' => esc_html__( 'Display the post date.', 'ultra' ),
	) );

	$settings->add_field( 'blog', 'post_author', 'checkbox', esc_html__( 'Post Author', 'ultra' ), array(
		'description' => esc_html__( 'Display the post author.', 'ultra' ),
	) );

	$settings->add_field( 'blog', 'post_comment_count', 'checkbox', esc_html__( 'Post Comment Count', 'ultra' ), array(
		'description' => esc_html__( 'Display the post comment count.', 'ultra' ),
	));		

	$settings->add_field( 'blog', 'post_cats', 'checkbox', esc_html__( 'Post Categories', 'ultra' ), array(
		'description' => esc_html__( 'Display the post categories.', 'ultra' ),
	));		

	$settings->add_field( 'blog', 'post_tags', 'checkbox', esc_html__( 'Post Tags', 'ultra' ), array(
		'description' => esc_html__( 'Display the post tags.', 'ultra' ),
	));

	$settings->add_field( 'blog', 'post_author_box', 'checkbox', esc_html__( 'Post Author Box', 'ultra' ), array(
		'description' => esc_html__( 'Display the post author biographical info.', 'ultra' ),
	));			

	$settings->add_field( 'blog', 'related_posts', 'checkbox', esc_html__( 'Related Posts', 'ultra' ), array(
		'description' => esc_html__( 'Display related posts on the single post page.', 'ultra' ),
	));		

	$settings->add_field( 'blog', 'edit_link', 'checkbox', esc_html__( 'Edit Link', 'ultra' ), array(
		'description' => esc_html__( 'Display an Edit link below post content. Visible if a user is logged in and allowed to edit the content. Also applies to Pages.', 'ultra' ),
	) );

	// Comments.
	$settings->add_field( 'comments', 'allowed_tags', 'checkbox', esc_html__( 'Comment Form Allowed Tags', 'ultra' ), array(
		'description' => esc_html__( 'Display the explanatory text below the comment form that lets users know which HTML tags may be used.', 'ultra' ),
	) );

	$settings->add_teaser( 'comments', 'ajax_comments', 'checkbox', esc_html__( 'AJAX Comments', 'ultra' ), array(
		'description' => esc_html__( 'Allow users to submit comments without a page re-load.', 'ultra' ),
	) );

	// Social.
	$settings->add_teaser( 'social', 'share_post', 'checkbox', esc_html__( 'Post Sharing', 'ultra' ), array(
		'description' => esc_html__( 'Show icons to share your posts on Facebook, Twitter, Google+ and LinkedIn.', 'ultra' ),
	) );

	// Footer.
	$settings->add_field( 'footer', 'copyright_text', 'text', esc_html__( 'Copyright Text', 'ultra' ), array(
		'description' => esc_html__( '{site-title}, {copyright} and {year} can be used to display your website title, a copyright symbol and the current year.', 'ultra' ),
		'sanitize_callback' => 'wp_kses_post',
	) );

	$settings->add_field( 'footer', 'privacy_policy_link', 'checkbox', esc_html__( 'Privacy Policy Link', 'ultra' ), array(
		'description' => esc_html__( 'Display the Privacy Policy page link in the footer.', 'ultra' ),
	) );

	$settings->add_field( 'footer', 'js_enqueue', 'checkbox', esc_html__( 'Enqueue JavaScript in Footer', 'ultra' ), array(
		'description' => esc_html__( 'Enqueue theme JavaScript files in the footer. Doing so can improve site load time.', 'ultra' ),
	) );

	$settings->add_teaser( 'footer', 'attribution', 'checkbox', esc_html__( 'Footer Attribution Link', 'ultra' ), array(
		'description' => esc_html__( 'Remove the theme attribution link from your footer without editing any code.', 'ultra' ),
	) );

	// Site Text.
	$settings->add_field( 'text', 'phone', 'text', esc_html__( 'Phone Number', 'ultra' ), array(
		'description' => esc_html__( 'A phone number displayed in the top bar. Use international dialing format to enable click to call.', 'ultra' ),
	) );

	$settings->add_field( 'text', 'email', 'text', esc_html__( 'Email Address', 'ultra' ), array(
		'description' => esc_html__( 'An email address to be displayed in the top bar', 'ultra' ),
	) );

	$settings->add_field( 'text', 'comments_closed', 'text', esc_html__( 'Comments Closed', 'ultra' ), array(
		'description' => esc_html__( 'The text visitors see at the bottom of posts when comments are closed.', 'ultra' ),
	) );

	$settings->add_field( 'text', 'no_results_heading', 'text', esc_html__( 'No Search Results Heading', 'ultra' ), array(
		'description' => esc_html__( 'The search page heading visitors see when no results are found.', 'ultra' ),
	) );

	$settings->add_field( 'text', 'no_results_copy', 'text', esc_html__( 'No Search Results Text', 'ultra' ), array(
		'description' => esc_html__( 'The search page text visitors see when no results are found.', 'ultra' ),
	) );

	$settings->add_field( 'text', '404_heading', 'text', esc_html__( '404 Error Page Heading', 'ultra' ), array(
		'description' => esc_html__( 'The heading visitors see when no page is found.', 'ultra' ),
	) );

	$settings->add_field( 'text', '404_copy', 'text', esc_html__( '404 Error Page Text', 'ultra' ), array(
		'description' => esc_html__( 'The text visitors see no page is found.', 'ultra' ),
	) );
}
add_action( 'siteorigin_settings_init', 'ultra_theme_settings' );

/**
 * Add default settings.
 *
 * @param $defaults
 *
 * @return mixed
 */
function ultra_settings_defaults( $defaults ) {
	$defaults['header_logo']                         = false;
	$defaults['header_image_retina']                 = false;
	$defaults['header_logo_with_title']              = false;
	$defaults['header_tagline']                      = false;
	$defaults['header_top_bar']                      = true;
	$defaults['header_display']                      = true;
	$defaults['header_layout']                       = 'default';
	$defaults['header_sticky']                       = true;
	$defaults['header_sticky_mobile']                = false;
	$defaults['header_opacity']                      = 1;
	$defaults['header_scale']                        = true;

	$defaults['navigation_top_bar_menu']             = true;
	$defaults['navigation_responsive_top_bar']       = false;
	$defaults['navigation_primary_menu']             = true;
	$defaults['navigation_responsive_menu']          = true;
	$defaults['navigation_responsive_menu_collapse'] = 1024;
	$defaults['navigation_menu_search']              = true;
	$defaults['navigation_smooth_scroll']            = true;
	$defaults['navigation_breadcrumb_trail']         = false;
	$defaults['navigation_post_nav']                 = true;
	$defaults['navigation_scroll_top']               = true;
	$defaults['navigation_scroll_top_mobile']        = false;

	$defaults['layout_bound']                        = 'full';
	$defaults['layout_responsive']                   = true;
	$defaults['layout_fitvids']                      = true;

	$defaults['home_slider']                         = '';
	$defaults['home_slider_stretch']                 = true;
	$defaults['home_header_overlaps']                = false;

	$defaults['pages_featured_image']                = true;

	$defaults['blog_page_title']                     = esc_html__( 'Blog', 'ultra' );
	$defaults['blog_archive_layout']                 = 'blog';
	$defaults['blog_archive_featured_image']         = true;
	$defaults['blog_archive_content']                = 'full';
	$defaults['blog_read_more']                      = esc_html__( 'Continue reading', 'ultra' );
	$defaults['blog_excerpt_length']                 = 55;
	$defaults['blog_excerpt_more']                   = false;
	$defaults['blog_post_featured_image']            = true;
	$defaults['blog_post_date']                      = true;
	$defaults['blog_post_author']                    = true;
	$defaults['blog_post_comment_count']             = true;
	$defaults['blog_post_cats']                      = true;
	$defaults['blog_post_tags']                      = true;
	$defaults['blog_post_author_box']                = false;
	$defaults['blog_related_posts']                  = false;
	$defaults['blog_edit_link']                      = true;

	$defaults['comments_allowed_tags']               = true;
	$defaults['comments_ajax_comments']              = true;

	$defaults['social_share_post']                   = true;
	$defaults['social_share_page']                   = false;
	$defaults['social_twitter']                      = '';

	$defaults['footer_copyright_text']               = esc_html__( '{copyright} {year} {site-title}', 'ultra' );
	$defaults['footer_privacy_policy_link']          = false;
	$defaults['footer_attribution']                  = true;
	$defaults['footer_js_enqueue']                   = false;

	$defaults['text_phone']                          = esc_html__( '1800-345-6789', 'ultra' );
	$defaults['text_email']                          = esc_html__( 'info@yourdomain.com', 'ultra' );
	$defaults['text_comments_closed']                = esc_html__( 'Comments are closed.', 'ultra' );
	$defaults['text_no_results_heading']             = esc_html__( 'Nothing Found', 'ultra' );
	$defaults['text_no_results_copy']                = esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords. ', 'ultra');
	$defaults['text_404_heading']                    = esc_html__( 'Oops! That page can\'t be found.', 'ultra' );
	$defaults['text_404_copy']                       = esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'ultra' );

	return $defaults;
}
add_filter( 'siteorigin_settings_defaults', 'ultra_settings_defaults' );

function ultra_blog_layout_options() {
	$layouts = array();
	foreach ( glob( get_template_directory().'/loops/loop-*.php') as $template ) {
		$headers = get_file_data( $template, array(
			'loop_name' => 'Loop Name',
		) );

		preg_match( '/loop\-(.*?)\.php/', basename( $template ), $matches );
		if ( ! empty( $matches[1] ) ) {
			$layouts[$matches[1]] = $headers['loop_name'];
		}
	}
	return $layouts;
}

function ultra_siteorigin_settings_home_slider_update_post_meta( $new_value, $old_value ) {

	// Update home slider post meta.
	$home_id = get_option( 'page_on_front' );
	if ( $home_id ) {
		update_post_meta( $home_id, 'ultra_metaslider_slider', siteorigin_setting( 'home_slider' ) );
		update_post_meta( $home_id, 'ultra_metaslider_slider_stretch', siteorigin_setting( 'home_slider_stretch' ) );
		update_post_meta( $home_id, 'ultra_metaslider_slider_overlap', siteorigin_setting( 'home_header_overlaps' ) );
	}
	return $new_value;
}
add_filter( 'update_option_theme_mods_ultra', 'ultra_siteorigin_settings_home_slider_update_post_meta', 10, 2 );

/**
 * Localize the theme settings.
 */
function ultra_siteorigin_settings_localize( $loc ) {
	$loc = array(
		'section_title'            => esc_html__( 'Theme Settings', 'ultra' ),
		'section_description'      => esc_html__( 'Settings for your theme.', 'ultra' ),
		'premium_only'             => esc_html__( 'Premium Only', 'ultra' ),
		'premium_url'              => '#',
		// For the settings metabox.
		'meta_box'                 => esc_html__( 'Page Settings', 'ultra' ),
		// For archives section
		'page_section_title'       => esc_html__( 'Page Template Settings', 'ultra' ),
		'page_section_description' => esc_html__( 'Change layouts for various pages on your site.', 'ultra' ),
		// For all the different temples and template types
		'template_home'            => esc_html__( 'Blog Page', 'ultra' ),
		'template_search'          => esc_html__( 'Search Results', 'ultra' ),
		'template_date'            => esc_html__( 'Date Archives', 'ultra' ),
		'template_404'             => esc_html__( 'Not Found', 'ultra' ),
		'template_author'          => esc_html__( 'Author Archives', 'ultra' ),
		'templates_post_type'      => esc_html__( 'Type', 'ultra' ),
		'templates_taxonomy'       => esc_html__( 'Taxonomy', 'ultra' ),
	);
	return $loc;
}
add_filter( 'siteorigin_settings_localization', 'ultra_siteorigin_settings_localize' );

/**
 * Setup Page Settings for Ultra.
 */
function ultra_page_settings( $settings, $type, $id ) {

	$settings['layout'] = array(
		'type'    => 'select',
		'label'   => esc_html__( 'Page Layout', 'ultra' ),
		'options' => array(
			'default'            => esc_html__( 'Default', 'ultra' ),
			'no-sidebar'         => esc_html__( 'No Sidebar', 'ultra' ),
			'full-width'         => esc_html__( 'Full Width', 'ultra' ),
			'full-width-sidebar' => esc_html__( 'Full Width, With Sidebar', 'ultra' ),
		),
	);

	$settings['display_top_bar'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Top Bar', 'ultra' ),
		'checkbox_label' => esc_html__( 'Enable', 'ultra' ),
		'description'    => esc_html__( 'Display the top bar. Global setting must be enabled.', 'ultra' )
	);

	$settings['display_header'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Header', 'ultra' ),
		'checkbox_label' => esc_html__( 'Enable', 'ultra' ),
		'description'    => esc_html__( 'Display the header. Global setting must be enabled.', 'ultra' ),
	);

	$settings['header_margin'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Header Bottom Margin', 'ultra' ),
		'checkbox_label' => esc_html__( 'Enable', 'ultra' ),
		'description'    => esc_html__( 'Display the margin below the header.', 'ultra' ),
	);

	$settings['page_title'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Page Title', 'ultra' ),
		'checkbox_label' => esc_html__( 'Enable', 'ultra' ),
		'description'    => esc_html__( 'Display the page title.', 'ultra' ),
	);

	$settings['footer_margin'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Footer Top Margin', 'ultra' ),
		'checkbox_label' => esc_html__( 'Enable', 'ultra' ),
		'description'    => esc_html__( 'Display the margin above the footer.', 'ultra' ),
	);

	$settings['display_footer_widgets'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Footer Widgets', 'ultra' ),
		'checkbox_label' => esc_html__( 'Enable', 'ultra' ),
		'description'    => esc_html__( 'Display the footer widgets.', 'ultra' ),
	);

	return $settings;
}
add_filter( 'siteorigin_page_settings', 'ultra_page_settings', 10, 3 );

/**
 * Add the default Page Settings.
 */
function ultra_setup_page_setting_defaults( $defaults, $type, $id ) {
	$defaults['layout']                 = 'default';
	$defaults['display_top_bar']        = true;
	$defaults['display_header']         = true;
	$defaults['header_margin']          = true;
	$defaults['page_title']             = true;
	$defaults['display_footer_widgets'] = true;
	$defaults['footer_margin']          = true;

	return $defaults;
}
add_filter( 'siteorigin_page_settings_defaults', 'ultra_setup_page_setting_defaults', 10, 3 );

function ultra_page_settings_message( $post ) {
	if ( $post->post_type == 'page' ) {
		?>
		<div class="so-page-settings-message" style="background-color: #f3f3f3; padding: 10px; margin-top: 12px; border: 1px solid #d0d0d0">
			<?php _e( 'To use these page settings, please use the <strong>Default</strong> template selected under <strong>Page Attributes</strong>.', 'ultra' ) ?>
		</div>
		<?php
	}
}
add_action( 'siteorigin_settings_before_page_settings_meta_box', 'ultra_page_settings_message' );
