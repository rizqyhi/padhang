<?php
/**
 * Padhang functions and definitions
 *
 * @package Padhang
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 720; /* pixels */
}

if ( ! function_exists( 'padhang_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function padhang_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails on posts and pages, and set the size.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 720, 270, true );

	// Register for primary and socials menu location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'padhang' ),
		'social' => __( 'Social Menu', 'padhang' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' 
	) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Support for editor style
	add_editor_style( array( 'editor-style.css', padhang_fonts_url() ) );
}
endif; // padhang_setup
add_action( 'after_setup_theme', 'padhang_setup' );

/**
 * Register widgetized area.
 */
function padhang_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Left Widget Area', 'padhang' ),
		'id'            => 'left-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Right Widget Area', 'padhang' ),
		'id'            => 'right-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'padhang_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function padhang_scripts() {
	wp_enqueue_style( 'padhang-style', get_stylesheet_uri() );
	wp_enqueue_style( 'padhang-fonts', padhang_fonts_url() );

	if ( get_theme_mod( 'background_cover', 0 ) == 1 ) {
		wp_enqueue_script( 'padhang-backstretch', get_template_directory_uri() . '/js/jquery.backstretch.min.js', array('jquery'), '2.0.4', true );
	}

	wp_enqueue_script( 'padhang-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );	
	wp_enqueue_script( 'padhang-slicknav', get_template_directory_uri() . '/js/jquery.slicknav.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'padhang-script', get_template_directory_uri() . '/js/padhang.js', array('jquery'), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'padhang_scripts' );

/**
 * Implement the Custom Background feature.
 */
require get_template_directory() . '/inc/hybrid/post-formats.php';

/**
 * Implement the Custom Background feature.
 */
require get_template_directory() . '/inc/custom-background.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Admin page.
 */
require get_template_directory() . '/inc/admin-page.php';