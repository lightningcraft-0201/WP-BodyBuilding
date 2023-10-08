<?php
$install_url = siteorigin_panels_lite_plugin_activation_install_url();
$home = get_theme_mod( 'siteorigin_panels_home_page_enabled', siteorigin_panels_lite_setting('home-page-default') );
$toggle_url = wp_nonce_url(admin_url('admin-ajax.php?action=panels_lite_toggle&panels_new='.($home ? 0 : 1)), 'toggle_panels_home');

?>
<div class="wrap" id="panels-home-page">
	<div id="icon-index" class="icon32"><br></div>
	<h2>
		<?php esc_html_e('Custom Home Page', 'ultra') ?>

		<a id="panels-toggle-switch" href="<?php echo esc_url($toggle_url) ?>" class="state-<?php echo $home ? 'on' : 'off' ?> subtle-move">
			<div class="on-text"><?php _e('ON', 'ultra') ?></div>
			<div class="off-text"><?php _e('OFF', 'ultra') ?></div>
			<img src="<?php echo esc_url( get_template_directory_uri() ) ?>/inc/panels-lite/css/images/handle.png" class="handle" />
		</a>
	</h2>

	<p>
		<?php _e("This theme is compatible with SiteOrigin's powerful drag and drop page builder.", 'ultra') ?>
		<?php _e('It allows you to build responsive columnized pages, populated with the widgets you know and love.', 'ultra') ?>
		<?php _e("It's a <strong>free plugin</strong> that works well with most WordPress themes.", 'ultra') ?>
		<?php if($home) _e("If you don't want to use it, click the toggle switch above to disable the default home page.", 'ultra') ?>
	</p>
	
	<p class="install-container">
		<a href="<?php echo esc_url($install_url) ?>" class="install"><?php _e('Install Page Builder', 'ultra') ?></a>
	</p>
	
</div>