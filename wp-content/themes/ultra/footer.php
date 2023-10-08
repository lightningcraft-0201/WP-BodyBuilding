<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */
?>

		</div><!-- .container -->

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<div class="footer-main">

			<?php if ( siteorigin_page_setting( 'display_footer_widgets', true ) ) : ?>
				<div class="container">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
					<div class="clear"></div>
				</div><!-- .container -->
			<?php endif; ?>

		</div><!-- .main-footer -->

		<?php
		if ( siteorigin_setting( 'footer_copyright_text' ) || siteorigin_setting( 'footer_privacy_policy_link' ) || siteorigin_setting( 'footer_attribution' ) ) {
			get_template_part( 'parts/bottom-bar' );
		}
		?>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
