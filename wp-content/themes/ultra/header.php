<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ultra' ); ?></a>

	<?php if ( siteorigin_setting( 'header_top_bar' ) && siteorigin_page_setting( 'display_top_bar', true ) ) : ?>
		<?php get_template_part( 'parts/top-bar' ); ?>
	<?php endif; ?>

	<?php if ( siteorigin_setting( 'header_display' ) && siteorigin_page_setting( 'display_header', true ) ) : ?>
		<header id="masthead" class="site-header<?php if ( siteorigin_setting( 'header_sticky' ) ) echo ' sticky-header'; if ( siteorigin_setting( 'header_scale' ) ) echo ' scale'; if ( siteorigin_setting( 'navigation_responsive_menu' ) ) echo ' responsive-menu'; ?>">
			<div class="container">
				<div class="site-branding-container">
					<div class="site-branding">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php ultra_display_logo(); ?>
						</a>
						<?php ultra_display_logo_text(); ?>
						<?php if ( get_bloginfo( 'description' ) && siteorigin_setting( 'header_tagline' ) ) : ?>
							<p class="site-description"><?php bloginfo( 'description' ); ?></p>
						<?php endif; ?>
					</div><!-- .site-branding -->
				</div><!-- .site-branding-container -->

				<nav id="site-navigation" class="main-navigation">
					<?php do_action( 'ultra_before_nav' ); ?>
					<?php if ( siteorigin_setting( 'navigation_primary_menu' ) ) wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					<?php if ( siteorigin_setting( 'navigation_menu_search' ) ) : ?>
						<div class="menu-search">
							<div class="search-icon"></div>
							<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" />
							</form>	
						</div><!-- .menu-search -->
					<?php endif; ?>
					<?php do_action( 'ultra_after_nav' ); ?>
				</nav><!-- #site-navigation -->
			</div><!-- .container -->
		</header><!-- #masthead -->
	<?php endif; ?>

	<?php ultra_render_slider(); ?>

	<?php do_action( 'ultra_content_before' ); ?>

	<div id="content" class="site-content">

		<?php if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) get_template_part( 'parts/woocommerce-title' ); ?>
