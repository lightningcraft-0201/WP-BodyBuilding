jQuery( function( $ ) {
	var $sliderMetabox = $( '#ultra-slider-page-slider' );
	var toggleSliderStretch = function( selectedSlider ) {
		if ( selectedSlider && selectedSlider.search( /^(meta:)/ ) > -1 ) {
			$sliderMetabox.find( '.checkbox-wrapper' ).slideDown( 'fast' );
		} else {
			$sliderMetabox.find( '.checkbox-wrapper' ).slideUp( 'fast' );
		}
	};
	var toggleSliderOverlap = function( selectedSlider ) {
		if ( selectedSlider && selectedSlider.search( /^(meta:|smart:)/ ) > -1 ) {
			$sliderMetabox.find( '.checkbox-overlap-wrapper' ).slideDown( 'fast' );
		} else {
			$sliderMetabox.find( '.checkbox-overlap-wrapper' ).slideUp( 'fast' );
		}
	};	
	var $sliderDropdown = $sliderMetabox.find( 'select[name="ultra_page_slider"]' );
	$sliderDropdown.change( function() {
		toggleSliderStretch( $sliderDropdown.val() );
	} );
	toggleSliderStretch( $sliderDropdown.val() );

	var $sliderOverlap = $sliderMetabox.find( 'select[name="ultra_page_slider"]' );
	$sliderOverlap.change( function() {
		toggleSliderOverlap( $sliderOverlap.val() );
	} );
	toggleSliderOverlap( $sliderOverlap.val() );	
	
} );
