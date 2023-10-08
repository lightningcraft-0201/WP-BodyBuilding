<?php
/**
 * Ultra comment customizations.
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */

if ( ! function_exists( 'ultra_filter_comment_fields' ) ) :
/**
 * Filter the comment fields to get more custom HTML.
 * @param $fields
 */
function ultra_filter_comment_fields( $fields ) {
	$commenter = wp_get_current_commenter();

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html_req = ( $req ? " required='required'" : '' );
	$html5    = true;

	$fields['author'] = '<div class="comment-form-author"><input id="author" name="author" placeholder="' . esc_attr__('Name *', 'ultra') . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></div>';
	$fields['email'] = '<div class="comment-form-email"><input id="email" name="email" placeholder="' . esc_attr__('Email *', 'ultra') . '" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></div>';
	$fields['url'] = '<div class="comment-form-url"><input id="url" name="url" placeholder="' . esc_attr__('Website', 'ultra') . '" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>';

	return $fields;
}
endif;
add_filter( 'comment_form_default_fields', 'ultra_filter_comment_fields' );