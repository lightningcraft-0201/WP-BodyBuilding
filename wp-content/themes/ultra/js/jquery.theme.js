/**
 * File jquery.theme.js.
 *
 * Handles the primary JavaScript functions for the theme.
 */
jQuery( function( $ ) {

	// Setup FitVids for entry content, Page Builder by SiteOrigin and WooCommerce. Ignore Tableau.
	if ( typeof $.fn.fitVids !== 'undefined' ) {
		$( '.entry-content, .entry-content .panel, .woocommerce #main' ).fitVids( { ignore: '.tableauViz' } );
	}	

	// Main menu current menu item indication.
	$( document ).ready( function( $ ) {
		if ( window.location.hash ) {
			return;
		} else {
			$( '#site-navigation a[href="'+ window.location.href +'"]' ).parent( 'li' ).addClass( 'current-menu-item' );
		}
		$( window ).scroll( function() {
			if ( $( '#site-navigation ul li' ).hasClass( 'current' ) ) {
				$( '#site-navigation li' ).removeClass( 'current-menu-item' );
			}
		} );
	} );

	// Main menu search bar.
	var isSearchHover = false;
	$( document ).click( function() {
		if ( ! isSearchHover ) $( '.menu-search form' ).fadeOut( 250 );
	} );

	$( document )
		.on( 'click','.search-icon', function() {
			var $$ = $( this ).parent();
			$$.find( 'form' ).fadeToggle( 150 );
			setTimeout( function() {
				$$.find( 'input[name=s]' ).focus();
			}, 250);
		} );

	$( document )
		.on( 'mouseenter', '.main-navigation .menu-search', function() {
			isSearchHover = true;
		} )
		.on( 'mouseleave', '.main-navigation .menu-search', function() {
			isSearchHover = false;
		} );

	// Close the header search with the escape key.
	$( document )
		.keyup( function( e ) {
			if ( e.keyCode == 27 ) { // Escape key maps to keycode 27.
				$( '.main-navigation .menu-search form' ).fadeOut( 250 );
			}
		} );

	// Initialize FlexSlider.
	$( '.entry-content .flexslider:not(.metaslider .flexslider), #metaslider-demo.flexslider, .gallery-format-slider').flexslider( { 
		namespace: "flex-ultra-",
	} );

	// Main slider stretch.
	$( 'body.full #main-slider[data-stretch="true"]' ).each( function() {
		var $$ = $( this );
		$$.find( '>div' ).css( 'max-width', '100%' );
		$$.find( '.slides li' ).each( function() {
			var $s = $( this );

			// Move the image into the background.
			var $img = $s.find( 'img.ms-default-image' ).eq( 0 );
			if ( ! $img.length ) {
				$img = $s.find( 'img' ).eq( 0 );
			}

			$s.css( 'background-image', 'url(' + $img.attr( 'src' ) + ')' );
			$img.css( 'visibility', 'hidden' );
			// Add a wrapper.
			$s.wrapInner( '<div class="container"></div>' );
			// This is because IE doesn't detect links correctly when we stretch slider images.
			var link = $s.find( 'a' );
			if ( link.length ) {
				$s.mouseover( function() {
					$s.css( 'cursor', 'hand' );
				} );
				$s.mouseout( function() {
					$s.css( 'cursor', 'pointer' );
				} );
				$s.click(function ( event ) {
					event.preventDefault();
					var clickTarget = $( event.target );
					var navTarget = clickTarget.is( 'a' ) ? clickTarget : link;
					window.open( navTarget.attr( 'href' ), navTarget.attr( 'target' ) );
				} );
			}
		} );
	} );

	// Scroll to top.
	var isMobileDevice = $( 'body' ).hasClass( 'ultra-mobile-device' ),
		isMobileScrollTop = $( 'body' ).hasClass( 'mobile-scroll-top' );

	if ( ( ! isMobileDevice && $( '#scroll-to-top' ).hasClass( 'scroll-to-top' ) ) || ( isMobileDevice && isMobileScrollTop ) ) {

		$( window ).scroll( function() {
			if ( $( window ).scrollTop() > 150) {
				$( '#scroll-to-top' ).addClass( 'displayed' );
			}
			else {
				$( '#scroll-to-top' ).removeClass( 'displayed' );
			}
		} );

		$( '#scroll-to-top' ).click( function() {
			$( "html, body" ).animate( { scrollTop: "0px" } );
			return false;
		} );
	}

	// Sticky header.
	var isHeaderScaling      = $( 'header' ).hasClass( 'scale' ),
		isMobileDevice       = $( 'body' ).hasClass( 'ultra-mobile-device' ),
		isMobileStickyHeader = $( 'body' ).hasClass( 'mobile-sticky-header' ),
		isResponsiveMenu     = $( 'header' ).hasClass( 'responsive-menu' ),
		isStickyHeader       = $( 'header' ).hasClass( 'sticky-header' );
		isAdminBar           = $( 'body' ).hasClass( 'admin-bar' ),
		adminBarHeight       = $( '#wpadminbar' ).outerHeight();

	if ( ( isStickyHeader && ! isMobileDevice ) || ( isStickyHeader && isMobileDevice && isMobileStickyHeader ) ) {
		$( '.site-header' ).hcSticky( {
			stickyClass: 'is-stuck',
		} );

		if ( isAdminBar ) {
			$( '.site-header' ).hcSticky( 'update', {
				top: 32,
			} );
		}

		if ( isHeaderScaling ) {
			$( window ).scroll( function() {
				if ( $( this ).scrollTop() > 150 ) {
					$( '.site-header' ).addClass( 'scaled' );
				} else {
					$( '.site-header' ).removeClass( 'scaled' );
				}
			} );
		}
	}

	// Smooth scroll from internal page anchors.
	// Header height.
	if ( isStickyHeader && isAdminBar && jQuery( window ).width() > 600 ) {
		if ( isHeaderScaling ) {
			var headerHeight = adminBarHeight + 72;
		} else {
			var headerHeight = adminBarHeight + $( 'header' ).height() - 3;
		}
	} else if ( isStickyHeader ) {
		if ( isHeaderScaling ) {
			var headerHeight = 72;
		} else {
			var headerHeight = $( 'header' ).height() - 3;
		}
	} else {
		var headerHeight = 0;
	}

	if ( ultra_smooth_scroll_params.value ) {

		$.fn.ultraSmoothScroll = function() {

			$( this ).click( function( e ) {

				var hash    = this.hash;
				var idName  = hash.substring( 1 ); // Get ID name.
				var alink   = this;                // This button pressed.

				// Check if there is a section that had same id as the button pressed.
				if ( $( '.panel-grid [id*=' + idName + ']' ).length > 0 ) {
					$( '#site-navigation .current' ).removeClass( 'current' );
					$( alink ).parent( 'li' ).addClass( 'current' );
				} else {
					$( '#site-navigation .current' ).removeClass( 'current' );
				}
				if ( location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {
					var target = $( this.hash );
					target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) +']' );
					if ( target.length ) {
						$( 'html, body' ).animate( {
							scrollTop: target.offset().top - headerHeight
						},
						{
							duration: 1200,
							start: function() {
								$( 'html, body' ).on( 'wheel touchmove', function() {
									$( 'html, body' ).stop().off( 'wheel touchmove' );
								} );
							},
							complete: function() {
								$( 'html, body' ).finish().off( 'wheel touchmove' );
							},
						} );
						return false;
					}
				}
			} );
		};

		$( window ).on( 'load', function() {
			$( '#site-navigation a[href*="#"]:not([href="#"]), .comments-link a[href*="#"]:not([href="#"]), .puro-scroll[href*="#"]:not([href="#"])' ).ultraSmoothScroll();
		} );

		// Adjust for sticky header when linking from external anchors.
		$( window ).on( 'load', function() {

			if ( location.pathname.replace( /^\//,'' ) == window.location.pathname.replace( /^\//,'' ) && location.hostname == window.location.hostname ) {
				var target = $( window.location.hash );
				if ( target.length ) {
					$( 'html, body' ).animate( {
						scrollTop: target.offset().top - headerHeight
					}, 0 );
					return false;
				}
			}
		} );

	} // ultra_smooth_scroll_params.value

	// Indicate which section of the page we're viewing with selected menu classes.
	function ultraScrolled() {

		// Cursor position.
		var scrollTop = $( window ).scrollTop();

		// Used for checking if the cursor is in one section or not.
		var isInOneSection = 'no';

		// For all sections check if the cursor is inside a section.
		$( '.panel-row-style' ).each( function() {

			// Section ID.
			var thisID = '#' + $( this ).attr( 'id' );

			// Distance between top and our section. Minus 1px to compensate for an extra pixel produced when a Page Builder row bottom margin is set to 0.
			var offset = $( this ).offset().top - 1;

			// Section height.
			var thisHeight = $( this ).outerHeight();

			// Where the section begins.
			var thisBegin = offset - headerHeight;

			// Where the section ends.
			var thisEnd = offset + thisHeight - headerHeight;

			// If position of the cursor is inside of the this section.
			if ( scrollTop >= thisBegin && scrollTop <= thisEnd ) {
				isInOneSection = 'yes';
				$( '#site-navigation .current' ).removeClass( 'current' );
				// Find the menu button with the same ID section.
				$( '#site-navigation a[href$="' + thisID + '"]' ).parent( 'li' ).addClass( 'current' ); // Find the menu button with the same ID section.
				return false;
			}
			if ( isInOneSection === 'no' ) {
				$( '#site-navigation .current' ).removeClass( 'current' );
			}
		} );
	}

	$( window ).on( 'scroll', ultraScrolled );

	// Top bar responsive behaviour.
	if ( $( 'body' ).hasClass( 'resp' ) && $( 'body' ).hasClass( 'resp-top-bar' ) ) {
		function ultrahidingHeader( selector, breakpointWidth ) {
			return {
				_selector: selector,
				_breakpointWidth: breakpointWidth,
				_duration: 500,
				_firstRun: true,
				_forceToShow: false,
				_animating: false,
				_currentState: '',
				_startingState: '',
				_eventCb: { stateStart: false, stateEnd: false },

				_get: function() {
					return $(this._selector);
				},
				_getState: function() {
					if ( window.innerWidth >= this._breakpointWidth ) return 'show';
					if ( this._forceToShow ) return 'force';
					return 'hide';
				},
				_setNewState: function( newState, start ) {
					if ( this._currentState == newState ) return;
					if ( start ) {
						if ( this._startingState != newState ) {
							this._startingState = newState;
							if ( this._eventCb.stateStart ) this._eventCb.stateStart( newState );
						}
					} else {
						this._currentState = newState;
						if ( this._eventCb.stateEnd ) this._eventCb.stateEnd( newState );
					}
				},
				_hide: function( animate ) {
					var header = this._get();
					var self = this;
					var css = {
						'margin-top': -header.height()+'px'
					};
					this._setNewState( 'hide', true );
					if ( animate ) {
						this._animating = true;
						header.animate( css, {
							duration: this._duration,
							step: function( now, fx ) {
								if( -self._get().height() != fx.end ) fx.end = -self._get().height();
							},
							done: function() {
								self._animating = false;
								self._setNewState( 'hide' );
								self.adjust();
							}
						} );
					} else {
						header.css( css );
						this._setNewState( 'hide' );
					}
				},
				_show: function( animate ) {
					var css = {
						'margin-top': '0px'
					};
					var self = this;
					var state = this._getState();
					this._setNewState( state, true );
					if ( animate ) {
						this._animating = true;
						this._get().animate( css, {
							duration: this._duration,
							step: function( now, fx ) {
								var margin = -self._get().height();
								if( margin != fx.start ) fx.start = margin;
							},
							done: function() {
								self._animating = false;
								self._setNewState( state );
								self.adjust();
							}
						} );
					} else {
						this._get().css( css );
						this._setNewState( state );
					}
				},
				toggle: function() {
					switch( this._currentState )
					{
						case 'force':
							this._forceToShow = false;
							break;
						case 'hide':
							this._forceToShow = true;
							break;
						default:
							break;
					}
					this.adjust();
				},
				adjust: function() {
					if( this._animating ) {
						return this;
					}
					if( this._firstRun ) {
						switch( this._getState() ) {
							case 'hide': this._hide(); break;
							default: this._show();
						}
						this._firstRun = false;
					} else {
						var state = this._getState();
						switch( state ) {
							case 'hide':
								if( this._currentState == 'hide' ) this._hide();
								else this._hide( true );
								break;
							default:
								if ( this._currentState == 'hide' ) this._show( true );
								else if( this._currentState != state ) this._show();
						}
					}
					return this;
				},
				getCurrentState: function() {
					return this._currentState;
				},
				on: function( event, cb ) {
					switch( event ) {
						case 'statestart': this._eventCb.stateStart = cb; break;
						case 'stateend': this._eventCb.stateEnd = cb; break;
						default:
							throw 'unknown event: '+event;
					}
					return this;
				}
			};
		}
	}

	if ( $( 'body' ).hasClass( 'resp' ) && $( 'body' ).hasClass( 'resp-top-bar' ) ) {
		$( document ).ready( function() {
			$('.top-bar-arrow').css( 'display', 'none' );
			var header = ultrahidingHeader( '#top-bar .container', ultra_resp_top_bar_params.collapse )
				.on( 'stateend', function( state ) {
					switch( state ) {
						case 'force':
							$('.top-bar-arrow').removeClass( 'show' ).addClass( 'close' );
							break;
						case 'hide':
							$('.top-bar-arrow').removeClass( 'close' ).addClass( 'show' );
							break;
						default:
							$('.top-bar-arrow').removeClass( 'show' ).removeClass( 'close' );
							break;
					}
				} )
				.on( 'statestart', function( state ) {
					switch( state ) {
						case 'force':
							$('.top-bar-arrow').css( 'display', '' );
							break;
						case 'hide':
							$('.top-bar-arrow').css( 'display', '' );
							break;
						default:
							$('.top-bar-arrow').css( 'display', 'none' );
							break;
					}
				} )
				.adjust();
			window.onresize = function() { header.adjust(); };
			$( '.top-bar-arrow' ).on( 'click', function() { header.toggle(); } );
		} );
	}

	// Detect if is a touch device. We detect this through ontouchstart, msMaxTouchPoints and MaxTouchPoints.
	if ( 'ontouchstart' in document.documentElement || window.navigator.msMaxTouchPoints || window.navigator.MaxTouchPoints ) {
		if ( /iPad|iPhone|iPod/.test( navigator.userAgent ) && ! window.MSStream ) {
			$( 'body' ).css( 'cursor', 'pointer' );
			$( 'body' ).addClass( 'ios' );
		}

		$( '.main-navigation, .top-bar-navigation' ).find( '.menu-item-has-children > a, .page_item_has_children > a' ).each( function() {
			$( this ).on( 'click touchend', function( e ) {
				var link = $( this );
				e.stopPropagation();

				if ( e.type == 'click' ) {
					return;
				}

				if ( ! link.parent().hasClass( 'hover' ) ) {
					// Remove .hover from all other sub menus
					$( '.menu-item.hover, .page_item.hover' ).removeClass( 'hover' );
					link.parents('.menu-item, .page_item').addClass( 'hover' );
					e.preventDefault();
				}

				// Remove .hover class when user clicks outside of sub menu
				$( document ).one( 'click', function() {
					link.parent().removeClass( 'hover' );
				} );

			} );
		} );
	}

} );

( function( $ ) {
	$( window ).on( 'load', function() {

		// Masonry blog layout.
		if ( $( '.ultra-masonry-loop' ).length ) {
			$( '.ultra-masonry-loop' ).masonry( {
				itemSelector: '.post',
				columnWidth: '.post'
			} );
		}

	} );
} )( jQuery );
