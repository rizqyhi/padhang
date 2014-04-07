<?php
/**
 * Implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Padhang
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses padhang_header_style()
 * @uses padhang_admin_header_style()
 * @uses padhang_admin_header_image()
 */
function padhang_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'padhang_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'flex-height'            => true,
		'wp-head-callback'       => 'padhang_header_style',
		'admin-head-callback'    => 'padhang_admin_header_style',
		'admin-preview-callback' => 'padhang_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'padhang_custom_header_setup' );

if ( ! function_exists( 'padhang_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see padhang_custom_header_setup().
 */
function padhang_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<!-- custom header style -->
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // padhang_header_style

if ( ! function_exists( 'padhang_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see padhang_custom_header_setup().
 */
function padhang_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			-webkit-box-sizing: border-box;
			-moz-box-sizing:    border-box;
			box-sizing:         border-box;
			border: none;
			padding: 20px;
			background: #252525;
			text-align: center;
		}
		#headimg h1 {
			text-transform: uppercase;
		}
		#headimg h1 a {
			border: none;
		}
		#desc {
			margin: 3rem 0 0;
		}
		#headimg img {
			display: block;
			max-width: 50%;
			height: auto;
			margin: 0 auto 3rem;
		}
	</style>
<?php
}
endif; // padhang_admin_header_style

if ( ! function_exists( 'padhang_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see padhang_custom_header_setup().
 */
function padhang_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>">
		<?php endif; ?>
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
	</div>
<?php
}
endif; // padhang_admin_header_image
