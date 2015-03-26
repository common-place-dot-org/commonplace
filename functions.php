<?php
/**
 * commonplace functions and definitions
 *
 * @package gazette
 */


/*-------------------------------------*/

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'gazette_setup' ) ) :

function gazette_setup() {
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'gazette' ),
	) );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
	add_theme_support( 'post-thumbnails', array( 'post', 'article', 'project' ) );
}
endif; // commonplace_setup
add_action( 'after_setup_theme', 'gazette_setup' );

function gazette_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'commonplace' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer', 'commonplace' ),
		'id'            => 'sidebar-footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class=" col-sm-3 widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'gazette_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gazette_scripts() {
	wp_enqueue_style( 'gazette-sass', get_template_directory_uri() . '/css/gazette.css');
	wp_enqueue_style( 'gazette-css', get_stylesheet_uri(), array('gazette-sass'));

	wp_enqueue_script( 'gazette-modernizr', get_template_directory_uri() . '/js/vendor/custom.modernizr.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'gazette-bootstrap', get_template_directory_uri() . '/vendor/bootstrap-sass-3.3.2/assets/javascripts/bootstrap.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'gazette-modernizr', get_template_directory_uri() . '/js/gazette.js', array( 'jquery' ), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gazette_scripts' );

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

/**
* Generates citations
*/
require get_template_directory() . '/inc/citation.php';

/**
* Adds Select Featured Issue to Dashboard
*/
require get_template_directory() . '/inc/featured-issue.php';

/**
* Requires article to have issue picked upon creation
*/
require get_template_directory() . '/inc/require-post-category.php';

<<<<<<< HEAD
/**
* Changes HTML of Images from Media Library
*/
 require get_template_directory() . '/inc/images.php';
=======
/*Requires article to have issue picked upon creation
*/
require get_template_directory() . '/inc/count_features.php';

/*Adds images*/

require get_template_directory() . '/inc/images.php';

/*Adds option to filter articles by issue*/

require get_template_directory() . '/inc/filter_by_taxonomy.php';
>>>>>>> 3d37025a24d311221b699b53256316a345da77f5
