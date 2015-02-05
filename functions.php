<?php
/**
 * commonplace functions and definitions
 *
 * @package commonplace
 */
/* Note by Sam M: Must put this in common-place theme file for featured image support*/


add_theme_support( 'post-thumbnails' );


/*-------------------------------------*/

include "custom-post.php"; //Contains add on for article custom post type

include "citation.php"; //Contains functions to generate citations
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'commonplace_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function commonplace_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on commonplace, use a find and replace
	 * to change 'commonplace' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'commonplace', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'commonplace' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'commonplace_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // commonplace_setup
add_action( 'after_setup_theme', 'commonplace_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function commonplace_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'commonplace' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'commonplace_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function commonplace_scripts() {
	wp_enqueue_style( 'commonplace-foundation-css', get_template_directory_uri() . '/css/foundation/foundation.css');
	wp_enqueue_style( 'commonplace-style', get_stylesheet_uri(), array('commonplace-foundation-css'));

	wp_enqueue_script( 'commonplace-modernizr', get_template_directory_uri() . '/js/vendor/custom.modernizr.js', array(), '20120206', true );
	wp_enqueue_script( 'commonplace-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'commonplace-foundation-js', get_template_directory_uri() . '/js/foundation/foundation.js', array());
	wp_enqueue_script( 'commonplace-foundation-abide', get_template_directory_uri() . '/js/foundation/foundation.abide.js', array('commonplace-foundation-js'));

	wp_enqueue_script( 'commonplace-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'commonplace_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Custom Post types.
 */
require get_template_directory() . '/inc/post-types.php';
