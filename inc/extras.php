<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package commonplace
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function commonplace_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'commonplace_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function commonplace_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'commonplace_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function commonplace_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'commonplace' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'commonplace_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function commonplace_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'commonplace_setup_author' );

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/*

	Adding columns to Edit All Articles screen in dashbaord. 

	http://justintadlock.com/archives/2011/06/27/custom-columns-for-custom-post-types
	
*/

add_filter( 'manage_edit-article_columns', 'my_edit_article_columns' ) ;

function my_edit_article_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Title' ),
		'writer' => __( 'Author' ),
		'issue' => __( 'Issue' ),
		'column' => __( 'Column' )
	);

	return $columns;
}
add_action( 'manage_article_posts_custom_column', 'my_manage_article_columns', 10, 2 );

function my_manage_article_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'duration' column. */
		case 'writer' :

			/* Get the post meta. */
			//$issue = get_post_meta( $post_id, 'title', true );
			$writerLast = get_field('author_last_name',$post_id );
			$writerFirst = get_field('author_first_name',$post_id );
			
			/* If no duration is found, output a default message. */
			if ( empty( $writerLast ) || empty( $writerFirst ) )
				echo __( 'Unknown' );

			/* If there is a duration, append 'minutes' to the text string. */
			else
			
				echo __($writerLast);
				echo __(', ');
				echo __($writerFirst);
			
			break;
		
		/* If displaying the 'duration' column. */
		case 'issue' :

			/* Get the post meta. */
			//$issue = get_post_meta( $post_id, 'title', true );
			$issue = get_the_term_list($post_id, 'issue', '', ', ', '');
			
			/* If no duration is found, output a default message. */
			if ( empty( $issue ) )
				echo __( 'Unknown' );

			/* If there is a duration, append 'minutes' to the text string. */
			else
			
				echo __($issue);
			
			break;

		/* If displaying the 'genre' column. */
		case 'column' :

			/* Get the genres for the post. */
			$terms = get_the_terms( $post_id, 'column' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'column' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'column', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'No Genres' );
			}

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}


function my_article_sortable_columns( $columns ) {
	$columns['issue'] = 'issue';
	$columns['column'] = 'column';
	$columns['writer'] = 'writer';
	return $columns;
}

add_filter( 'manage_edit-article_sortable_columns', 'my_article_sortable_columns' );
?>