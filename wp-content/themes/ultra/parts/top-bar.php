<?php
/**
 * Part Name: Top Bar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 * @package ultra
 * @since ultra 1.0.2
 * @license GPL 2.0
 */
?>

<div id="top-bar">
	<div class="container">
		<div class="top-bar-text"><?php do_action( 'ultra_top_bar_text' ); ?><?php wp_nav_menu( array( 'theme_location' => 'top-bar-social', 'container_class' => 'top-bar-menu', 'depth' => 1, 'fallback_cb' => '' ) ); ?></div><?php if ( siteorigin_setting( 'navigation_top_bar_menu' ) ) { ?><nav class="top-bar-navigation"><?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?></nav><!-- .top-bar-navigation -->
		<?php } ?>
	</div><!-- .container -->
</div><!-- #top-bar -->
<span class="top-bar-arrow" style="display: none;"></span>
