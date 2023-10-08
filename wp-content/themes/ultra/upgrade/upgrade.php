<?php

function ultra_premium_upgrade_content( $content ) {
	$content['premium_title'] = esc_html__( 'Upgrade to Ultra Premium', 'ultra' );
	$content['premium_summary'] = esc_html__( 'Hi, my name is Andrew Misplon, the developer of Ultra. If you\'ve enjoyed Ultra Free then I know you\'re going to love Ultra Premium. Below you\'ll find an outline of the premium features.', 'ultra' );

	$content['buy_url'] = 'http://puro.fetchapp.com/sell/49b42a54';
	$content['premium_video_poster'] = get_template_directory_uri() . '/upgrade/poster.jpg';

	$content['features'] = array();

	$content['features'][] = array(
		'heading' => esc_html__( 'Premium Email Support', 'ultra' ),
		'content' => esc_html__( 'Ultra Premium comes with priority email support. Let us know if you run into any challenges or simply need a hand getting setup. We\'re here to help.', 'ultra' ),
	);

	$content['features'][] = array(
		'heading' => esc_html__( 'Name the Price', 'ultra' ),
		'content' => esc_html__( 'You choose the price, so you can pay what Ultra is worth to you. Choose from one our suggested options or specify your own custom price. Regardless of what you pay you\'ll receive the same premium upgrade and be supporting the continued development of the theme.', 'ultra' ),
	);

	$content['features'][] = array(
		'heading' => esc_html__( 'Retina Logo', 'ultra' ),
		'content' => esc_html__( 'Ultra Premium allows you to upload an additional, double-sized logo, to be displayed on Apple Retina and other high pixel density displays.', 'ultra' ),
	);

	$content['features'][] = array(
		'heading' => esc_html__( 'Enhanced Customizer Integration', 'ultra' ),
		'content' => esc_html__( 'Make Ultra your own with enhanced Customizer integration. Choose from Google\'s huge selection of fonts; change colors, spacing and more all using the live-updating WordPress Customizer.', 'ultra' ),
		'image' => get_template_directory_uri() . '/upgrade/teasers/customizer.png',
	);	

	$content['features'][] = array(
		'heading' => esc_html__( 'Ajax Comments', 'ultra' ),
		'content' => esc_html__( 'Remove page re-loads from your comment forms. This means that users can submit comments without losing their place in a gallery or interrupting a video.', 'ultra' ),
		'image' => get_template_directory_uri() . '/upgrade/teasers/ajax-comments.png',
	);

	$content['features'][] = array(
		'heading' => esc_html__( 'Post Sharing', 'ultra' ),
		'content' => esc_html__( 'Add sharing icons for Facebook, Twitter and LinkedIn to the bottom of your posts.', 'ultra' ),
		'image' => get_template_directory_uri() . '/upgrade/teasers/social-sharing.png',
	);

	$content['features'][] = array(
		'heading' => esc_html__( 'Remove Attribution Link', 'ultra' ),
		'content' => esc_html__( 'Ultra Premium gives you the option to remove the "Theme by Puro" text from your Footer without editing any code.', 'ultra' ),
		'image' => get_template_directory_uri() . '/upgrade/teasers/attribution.png',
	);

	$content['features'][] = array(
		'heading' => esc_html__( 'Continued Updates', 'ultra' ),
		'content' => esc_html__( 'Your premium upgrade is a valuable contribution to the future development of Ultra, ensuring it\'s compatible with future versions of WordPress.', 'ultra' ),
		'image' => get_template_directory_uri() . '/upgrade/teasers/updates.png',
	);

	$content['testimonials'] = array(
		array(
			'gravatar' => '07079067e6b88e8d2a2a1fa886e50b98',
			'name' => 'Cloudontap',
			'title' => 'Beautiful Theme, Top-Notch Support!',
			'content' => esc_html__( 'LOVE this theme - so many options, and so gorgeous! I HIGHLY suggest submitting a question on their support forum if you run into any problems - they respond within minutes to my questions! Doesn\'t get much better than that. Thanks for all of your help, Andrew, and thank you for the awesome theme!', 'ultra' ),
		),
		array(
			'gravatar' => '054d90a54412053c65f897b01f367e4b',
			'name' => 'AJR Computing',
			'title' => 'Amazing Responsive Theme, with Awesome Support!',
			'content' => esc_html__( 'The Ultra WordPress theme looks awesome and the best part is it\'s a free theme, I really love this theme and my site is starting to come together and looks really sharp thanks to this amazing theme also the theme designer Andrew Misplon from Puro themes provided me with great support when I needed assistance in setting up a few things.', 'ultra' ),
		),
		array(
			'gravatar' => '1bc72295a0b339d59610b7e1ac0bead2',
			'name' => 'Wccwts',
			'title' => 'Responsive',
			'content' => esc_html__( 'Theme is very responsive and so is the support. Highly recommended!.', 'ultra' ),
		),
		array(
			'gravatar' => 'ba93dfb175b0c3c8d437fbe1c9465a50',
			'name' => 'Sunshine4nikki',
			'title' => 'Ultra Impressed!',
			'content' => esc_html__( 'The Ultra+ theme is great (my FAVORITE). I\'m impressed by the ease of set-up (even for a WP beginner). The versatility of design along with everything needed in the customizing menu gave me the ability to see a live preview before publishing. It\'s OBVIOUS that the author put a lot of effort into creating Ultra+ because it\'s so easy to use - my admin board isn\'t cluttered with a bunch of plugins. The interface is clean and simple... perfect!', 'ultra' ),
		),
	);

	return $content;
}
add_filter( 'siteorigin_premium_content', 'ultra_premium_upgrade_content' );