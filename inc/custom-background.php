<?php
/**
 * Implementation of the Custom Backgrounds feature
 * http://codex.wordpress.org/Custom_Backgrounds
 *
 * @package Padhang
 */

/**
 * Setup the WordPress core custom background feature.
 *
 * @uses padhang_background_style()
 */
function padhang_custom_background_setup() {
	add_theme_support( 'custom-background', apply_filters( 'padhang_custom_background_args', array(
		'default-color' => '252525',
		'default-image' => '',
		'wp-head-callback' => 'padhang_background_style'
	) ) );
}
add_action( 'after_setup_theme', 'padhang_custom_background_setup' );

if ( ! function_exists( 'padhang_background_style' ) ) :
/**
 * Styles the background and overlay displayed on the blog
 *
 * @see padhang_custom_background_setup().
 */
function padhang_background_style() {
	$background = get_background_image();
	$color      = get_background_color();

	if ( ! $background && ! $color )
		return;

	$style = $color ? "background-color: #$color;" : '';

	if ( $background ) {
		$image = " background-image: url('$background');";
 
		$repeat = get_theme_mod( 'background_repeat', 'repeat' );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';
		$repeat = " background-repeat: $repeat;";
 
		$position = get_theme_mod( 'background_position_x', 'left' );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';
		$position = " background-position: top $position;";
 
		$attachment = get_theme_mod( 'background_attachment', 'scroll' );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
			$attachment = 'scroll';
		$attachment = " background-attachment: $attachment;";
 
		$style .= $image . $repeat . $position . $attachment;
	}
	?>
	<!-- custom background style -->
	<style type="text/css">
		body.custom-background { 
			<?php echo trim( $style ); ?>
		}
	</style>
	<?php
}
endif; // padhang_background_style