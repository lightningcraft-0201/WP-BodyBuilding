<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */
?>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ultra' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

<?php elseif ( is_search() ) : ?>

	<header class="page-header">
		<div class="container">
			<h1 class="page-title"><?php echo wp_kses_post( siteorigin_setting( 'text_no_results_heading' ) ); ?></h1>
		</div><!-- .container -->
	</header><!-- .page-header -->

	<div class="container">

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

			<p><?php echo wp_kses_post( siteorigin_setting( 'text_no_results_copy' ) ); ?></p>
			<?php get_search_form(); ?>

<?php else : ?>

	<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ultra' ); ?></p>
	<?php get_search_form(); ?>

<?php endif; ?>
