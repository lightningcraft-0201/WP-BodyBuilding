<?php

class SiteOrigin_Settings_Control_Premium extends WP_Customize_Control {
	public $type = 'siteorigin-premium-notification';

	/**
	 * Render the font selector
	 */
	public function render_content(){
		$theme = wp_get_theme();
		?>
		<p>
			<?php
			printf(
				__( "%s Premium adds loads of extra customization settings and useful features. They'll save you time and make your site more professional.", 'ultra' ),
				$theme->get( 'Name' )
			);
			?>
		</p>
		<a
			href="<?php echo esc_url( SiteOrigin_Settings::get_premium_url( ) ) ?>"
			class="button-primary so-premium-upgrade"
			target="_blank">
			<?php esc_html_e( 'Find Out More', 'ultra' ) ?>
		</a>
		<?php
	}

	/**
	 * Enqueue all the scripts and styles we need
	 */
	public function enqueue() {
	}
}
