/**
 * File responsive-menu.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, button, menu;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

} )();

( function( $ ) {

	$( 'li[class*=children]' ).append( '<span></span>' );
	$( 'li[class*=children]>span' ).click( function( e ) {
		$( this ).closest( 'li[class*=children]' ).toggleClass( 'up' );
		return false;
	} );

	$( '.menu-item-has-children > a' ).addClass( 'has-dropdown' );
	$( '.page_item_has_children > a' ).addClass( 'has-dropdown' );

	$( '.main-navigation' ).find( '.has-dropdown' ).click( function( e ) {
		if ( typeof $( this ).attr( 'href' ) === "undefined" || $( this ).attr( 'href' ) == "#" ) {
			e.preventDefault();
			$( this ).siblings( 'li[class*=children]>span' ).trigger( 'click' );
		}
	} );

	$( 'nav a' ).on( 'click', function() {
		if ( ! $( this ).hasClass( 'has-dropdown' ) || ( typeof $( this ).attr( 'href' ) !== "undefined" && $( this ).attr( 'href' )  !== "#" ) ) {
			$( '.main-navigation' ).removeClass( 'toggled' );
		}
	} );

	$( window ).resize( function() {

		windowWidth = $( window ).width();
		navigation  = $( 'nav' );
		isToggled   = navigation.hasClass( 'toggled' );

		if ( windowWidth > ultra_resp_menu_params.collapse && isToggled ) {
			navigation.removeClass( 'toggled' );
		}

	} );

} )( jQuery );