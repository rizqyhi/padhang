/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	// Background overlay transparency
	wp.customize( 'background_transparency', function( value ) {
		value.bind( function( to ) {
			$( '.overlay' ).css( { 'opacity': to/100 } );
		} );
	} );

	// Wrapper width
	wp.customize( 'wrapper_width', function( value ) {
		value.bind( function( to ) {
			$( '.site-header, .site-content, .site-footer' ).css( { 'width': to + '%' } );
		} );
	} );

	// Accent colors
	var customColor, customBg, customBorder;
	customColor 	= 'a, .main-navigation li a:hover, .entry-title a:hover, .widget-title';
	customBg 		= 'button, input[type="button"], input[type="reset"], input[type="submit"], .main-navigation ul ul, .comment-navigation a:hover, .paging-navigation a:hover, .post-navigation a:hover, .sticky .entry-title:before, .format-link .entry-title:before, .format-video .entry-title:before, .format-audio .entry-title:before, .format-image .entry-title:before, .format-gallery .entry-title:before';
	customBorder 	= 'a:hover, .comment-navigation a:hover, .paging-navigation a:hover, .post-navigation a:hover';

	wp.customize( 'accent_color', function( value ) {
		value.bind( function( to ) {
			$( customColor ).css( { 'color': to } );
			$( customBg ).css( { 'background-color': to } );
			$( customBorder ).css( { 'border-color': to } );
		} );
	} );

	// Footer text
	wp.customize( 'footer_text', function( value ) {
		value.bind( function( to ) {
			$( '.site-info .copyright' ).text( to );
		} );
	} );

} )( jQuery );
