<?php
/**
 * Padhang Theme Customizer
 *
 * @package Padhang
 */

// require the display functions to output the customized options
require_once get_template_directory() . '/inc/customizer-display.php';

/**
 * Add new controls and postMessage support for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function padhang_customize_register( $wp_customize ) {
	// require cusom customizer controls
	require_once get_template_directory() . '/inc/customizer-controls.php';

	// Rename Background Image section to Background
	$wp_customize->get_section( 'background_image' )->title = __( 'Background', 'padhang' );

	// Move Background Color to Background section
	$wp_customize->get_control( 'background_color' )->section = 'background_image';

	/**
	 * General section
	 */
	$wp_customize->add_section( 'padhang_general_section' , array(
		'title'    => __( 'General', 'padhang' ),
		'priority' => 10,
	) );

	$wp_customize->add_setting(	'fonts_kit', array(
		'default' => 'roboto',
		'sanitize_callback' => 'padhang_sanitize_fontskit',
	) );

	$wp_customize->add_control( 'fonts_kit', array(
		'label'    => __( 'Fonts Kit', 'padhang' ),
		'section'  => 'padhang_general_section',
		'settings' => 'fonts_kit',
		'type'     => 'select',
		'choices'  => array(
				'roboto'   => 'Roboto + Roboto Slab',
				'opensans' => 'Open Sans + Bitter'
			)
	) );

	$wp_customize->add_setting( 'wrapper_width', array(
		'default' => '96',
		'sanitize_callback' => 'padhang_wrapper_width_sanitize',
	) );

	$wp_customize->add_control( 'wrapper_width', array(
		'label'    => __('Wrapper width (%)', 'padhang'),
		'section'  => 'padhang_general_section',
		'settings' => 'wrapper_width',
		'type'     => 'text'
	) );

	$wp_customize->add_setting( 'footer_text', array(
		'default' => '&copy; 2014 <a href="' . esc_url( home_url( '/' ) ) . '">' . bloginfo( 'name' ) . '</a>',
		'sanitize_callback' => 'wp_kses_data',
	) );

	$wp_customize->add_control( new Padhang_Customize_Textarea_Control( $wp_customize, 'footer_text', array(
		'label'   	=> __('Footer text', 'padhang'),
		'section' 	=> 'padhang_general_section',
		'settings'	=> 'footer_text',
	) ) );

	/**
	 * Title and Tagline section
	 */
	$wp_customize->add_control( new Padhang_Customize_Misc_Control( $wp_customize, 'options_heading', array(
		'section'  => 'title_tagline',
		'type'     => 'heading',
		'label'    => __( 'Title and Tagline Options', 'padhang' ),
	) ) );

	$wp_customize->add_setting(	'show_hide_title', array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'show_hide_title', array(
		'label'    => __( 'Show site title', 'padhang' ),
		'section'  => 'title_tagline',
		'settings' => 'show_hide_title',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting(	'show_hide_tagline', array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'show_hide_tagline', array(
		'label'    => __( 'Show site tagline', 'padhang' ),
		'section'  => 'title_tagline',
		'settings' => 'show_hide_tagline',
		'type'     => 'checkbox',
	) );

	/**
	 * Logo section
	 */
	$wp_customize->add_section( 'padhang_logo_section' , array(
		'title'    => __( 'Logo', 'padhang' ),
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'logo_image', array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new Padhang_Customize_Image_Control( $wp_customize, 'logo_image', array(
		'label'    => __( 'Logo', 'padhang' ),
		'section'  => 'padhang_logo_section',
		'settings' => 'logo_image',
		'context'  => 'padhang-logo-image',
	) ) );

	$wp_customize->add_setting( 'favicon_image', array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new Padhang_Customize_Image_Control( $wp_customize, 'favicon_image', array(
		'label'    => __( 'Favicon', 'padhang' ),
		'section'  => 'padhang_logo_section',
		'settings' => 'favicon_image',
		'context'  => 'padhang-favicon-image',
	) ) );

	/**
	 * Colors section
	 */
	$wp_customize->add_setting( 'site_title_color', array(
		'default' => '#ffffff',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_title_color', array(
		'label'   	=> __('Title Color', 'padhang' ),
		'section' 	=> 'colors',
		'settings'  => 'site_title_color',
	) ) );

	$wp_customize->add_setting( 'site_tagline_color', array(
		'default' => '#ffffff',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_tagline_color', array(
		'label'   	=> __('Tagline Color', 'padhang' ),
		'section' 	=> 'colors',
		'settings'  => 'site_tagline_color',
	) ) );

	$wp_customize->add_setting( 'accent_color', array(
		'default' => '#65b045',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'   	=> __('Accent Color', 'padhang' ),
		'section' 	=> 'colors',
		'settings'  => 'accent_color',
	) ) );

	$wp_customize->add_setting( 'overlay_color', array(
		'default' => '#222222',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'overlay_color', array(
		'label'   	=> __('Overlay Color (%)', 'padhang' ),
		'section' 	=> 'colors',
		'settings'  => 'overlay_color',
	) ) );

	$wp_customize->add_setting( 'overlay_transparency', array(
		'default' => '70',
		'sanitize_callback' => 'padhang_transparency_sanitize',
	) );

	$wp_customize->add_control( 'overlay_transparency', array(
		'label'   	=> __('Overlay Transparency', 'padhang'),
		'section' 	=> 'colors',
		'settings'	=> 'overlay_transparency',
		'type'    	=> 'text'
	) );

	$wp_customize->add_control( new Padhang_Customize_Misc_Control( $wp_customize, 'overlay_transparency_description', array(
		'section'  => 'colors',
		'type'     => 'text',
		'description'    => __( 'Set 0 to disable overlay.', 'padhang' ),
	) ) );

	/**
	 * Background section
	 */
	$wp_customize->add_setting(	'background_cover', array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'background_cover', array(
		'label'    => __( 'Make background image covering the page', 'padhang' ),
		'section'  => 'background_image',
		'settings' => 'background_cover',
		'type'     => 'checkbox',
	) );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
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
 * Sanitize wrapper width value.
 * It should be between 0-100, otherwise it return default value (96).
 */
function padhang_wrapper_width_sanitize( $input ) {
	$width = absint( $input );

	if( ( 0 <= $width ) && ( $width <= 100 ) )
		return $width;

	return 96;
}

/**
 * Sanitize the fonts kit
 */
function padhang_sanitize_fontskit( $value ) {
	$choices         = array( 'roboto', 'opensans' );
	$allowed_choices = array_keys( $choices );

	if ( ! in_array( $value, $allowed_choices ) ) {
		$value = 'roboto';
	}

	return $value;
}