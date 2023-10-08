<?php
/**
 * Part Name: Bottom Bar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ultra
 * @since ultra 1.0.2
 * @license GPL 2.0
 */
?>

<div class="bottom-bar">
	<div class="container">
		<?php $copyright_text = apply_filters( 'ultra_copyright_text', siteorigin_setting( 'footer_copyright_text' ) ); ?>
		<div class="site-info">
			<?php
			if ( ! empty( $copyright_text ) ) {
				echo '<span>' . wp_kses_post( $copyright_text ) . '</span>';
			}

			if ( function_exists( 'the_privacy_policy_link' ) && siteorigin_setting( 'footer_privacy_policy_link' ) ) {
				the_privacy_policy_link( '<span>', '</span>' );
			}

			if ( siteorigin_setting( 'footer_attribution' ) ) {
				/* translators: 1: Theme author. */
				echo '<span>' . sprintf( esc_html__( 'Theme by %1$s', 'ultra' ), '<a href="https://purothemes.com/">Puro</a>' ) . '</span>';
			}
			?>
		</div><!-- .site-info --><?php wp_nav_menu( array( 'theme_location' => 'footer', 'container_class' => 'bottom-bar-menu', 'depth' => 1, 'fallback_cb' => '' ) ); ?>
	</div><!-- .container -->
</div><!-- .bottom-bar -->
