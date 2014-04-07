<?php
/**
 * Padhang Theme Customizer
 *
 * @package Padhang
 */

/**
 * Add new controls and postMessage support for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function padhang_customize_register( $wp_customize ) {
	// Register textarea control
	class Padhang_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
		
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php 
		}
	}

	$wp_customize->add_setting( 'accent_color', array(
		'default' => '#65b045',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'   	=> __('Accent Color', 'padhang' ),
		'section' 	=> 'colors',
		'settings'  => 'accent_color',
	) ) );

	$wp_customize->add_setting( 'background_transparency', array(
		'default' => '70',
		'sanitize_callback' => 'padhang_transparency_sanitize',
	) );

	$wp_customize->add_control( 'background_transparency', array(
		'label'   	=> __('Background Transparency', 'padhang'),
		'section' 	=> 'colors',
		'settings'	=> 'background_transparency',
		'type'    	=> 'text'
	) );

	$wp_customize->add_section( 'padhang_extra_section' , array(
		'title'      => __( 'Extras', 'padhang' ),
		'priority'   => 120,
	) );

	$wp_customize->add_setting( 'footer_text', array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_data',
	) );

	$wp_customize->add_control( new Padhang_Textarea_Control( $wp_customize, 'footer_text', array(
		'label'   	=> __('Footer text', 'padhang'),
		'section' 	=> 'padhang_extra_section',
		'settings'	=> 'footer_text',
	) ) );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'accent_color' )->transport 	= 'postMessage';
	$wp_customize->get_setting( 'background_transparency' )->transport 	= 'postMessage';
	$wp_customize->get_setting( 'footer_text' )->transport 		= 'postMessage';
}
add_action( 'customize_register', 'padhang_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function padhang_customize_preview_js() {
	wp_enqueue_script( 'padhang_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'padhang_customize_preview_js' );

/**
 * Sanitize background transparency value.
 * It should be between 0-100, otherwise it return default value (70).
 */
function padhang_transparency_sanitize( $input ) {
	$transparency = absint( $input );

	if( ( 0 <= $transparency ) && ( $transparency <= 100 ) )
		return $transparency;

	return 70;
}

/**
 * Output the customized style to the front.
 */
function padhang_customize_style() {
	$color = esc_attr( get_theme_mod( 'accent_color', '#65b045' ) );
	?>
	<!-- Custom style -->
	<style type="text/css">
		a, .main-navigation ul a:hover, .entry-title a:hover, .widget-title {
			color: <?php echo $color; ?>;
		}
		button, input[type="button"], input[type="reset"], input[type="submit"], .main-navigation ul ul, .comment-navigation a:hover, .paging-navigation a:hover, .post-navigation a:hover, .sticky .entry-title:before, .format-link .entry-title:before, .format-video .entry-title:before, .format-audio .entry-title:before, .format-image .entry-title:before, .format-gallery .entry-title:before {
			background: <?php echo $color; ?>;
		}
		a:hover, a:focus, a:active, .comment-navigation a:hover, .paging-navigation a:hover, .post-navigation a:hover {
			border-color: <?php echo $color; ?>;
		}
	</style>
	<?php	
}
add_action( 'wp_head', 'padhang_customize_style' );

/**
 * Output custom footer text if user fill it.
 */
function padhang_footer_text() {
	$footer_text = get_theme_mod( 'footer_text' );

	if( $footer_text != '' ) {
		echo '<p>' . wp_kses_data( $footer_text ) . '</p>';
	}
}
add_action( 'padhang_footer', 'padhang_footer_text' );