<?php
/**
 * Output the customized options to the front.
 *
 * @package Padhang
 */

/**
 * Custom styles
 */
function padhang_customize_style() {
	$fonts_kit = get_theme_mod( 'fonts_kit', 'roboto' );
	$wrapper_width = absint( get_theme_mod( 'wrapper_width', '96' ) );
	$title_color = esc_attr( get_theme_mod( 'site_title_color', '#ffffff' ) );
	$tagline_color = esc_attr( get_theme_mod( 'site_tagline_color', '#ffffff' ) );
	$accent_color = esc_attr( get_theme_mod( 'accent_color', '#65b045' ) );
	$overlay_color 	= esc_attr( get_theme_mod( 'overlay_color', '#222222' ) );
	$overlay_transparency 	= absint( get_theme_mod( 'overlay_transparency', '70' ) );
	?>

	<!-- Custom style -->
	<style type="text/css">
		<?php if ( $fonts_kit == 'opensans' ) :?>
			body, button, input, select, textarea, .site-title {
				font-family: "Open Sans", sans-serif;
			}
			h1, h2, h3, h4, h5, h6, blockquote {
				font-family: "Bitter", serif;
			}
		<?php endif; ?>

		.site-header, .site-content, .site-footer {
			width: <?php echo $wrapper_width; ?>%;
		}

		<?php if ( $title_color != '#ffffff' ) :?>
			.site-title a {
				color: <?php echo $title_color; ?>;
			}
		<?php endif; ?>

		<?php if ( $tagline_color != '#ffffff' ) :?>
			.site-description {
				color: <?php echo $tagline_color; ?>;
			}
		<?php endif; ?>

		button, input[type="button"], input[type="reset"], input[type="submit"] {
			border-color: <?php echo $accent_color; ?>;
			color: <?php echo $accent_color; ?>;
		}

		.main-navigation ul li:hover > a, .main-navigation ul ul a:hover, .sticky .entry-title:before, .format-link .entry-title a:before, .format-video .entry-title:before, .format-audio .entry-title:before, .format-image .entry-title:before, .format-gallery .entry-title:before, .format-aside .entry-title:before, .format-status .entry-title:before, .format-quote .entry-content:before, .format-chat .entry-title:before, .format-link .entry-title a, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover {
			background: <?php echo $accent_color; ?>;
		}

		a:hover, a:focus, a:active, .format-status .entry-content .avatar, input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, textarea:focus, select:focus {
			border-color: <?php echo $accent_color; ?>;
		}

		a, .entry-title a:hover {
			color: <?php echo $accent_color; ?>;
		}

		.comment-navigation a:hover, .paging-navigation a:hover, .post-navigation a:hover {
			background: <?php echo $accent_color; ?>;
			border-color: <?php echo $accent_color; ?>;	
		}

		.overlay {
			background: <?php echo $overlay_color; ?>;
			opacity: <?php echo $overlay_transparency/100; ?>;
		}
	</style>
	<?php	
}
add_action( 'wp_head', 'padhang_customize_style' );

/**
 * Display favicon
 */
function padhang_display_favicon() {
	$favicon = get_theme_mod( 'favicon_image' );

	if ( ! empty( $favicon ) ) : ?>
		<link rel="icon" href="<?php echo esc_url( $favicon ); ?>" />
	<?php endif;
}
add_action( 'wp_head', 'padhang_display_favicon' );

/**
 * Footer text
 */
function padhang_footer_text() {
	$footer_text = get_theme_mod( 'footer_text' );

	echo '<p>' . $footer_text . '</p>';
}
add_action( 'padhang_footer', 'padhang_footer_text' );

function padhang_backgound_cover() {
	if ( get_theme_mod( 'background_cover', 0 ) == 1 ) :
	?>

	<script type="text/javascript">
		jQuery(document).ready(function($){
			var url = $('body.custom-background').css('background-image');
			url = url.replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
			
			$.backstretch( url );
		});
	</script>

	<?php
	endif;
}
add_action( 'wp_footer', 'padhang_backgound_cover' );