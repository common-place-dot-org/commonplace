<?php
function create_post_types() {

	register_post_type( 'article',
		array(
			'labels' => array(
				'name' => 'Articles',
				'singular_name' => 'Article',
				//'menu_name' => 'Search Columns',
				//'name_admin_bar' => 'Edit  ',
				//'all_items' => 'Column.viewitem',
				'add_new' => 'New Article',
				'add_new_item' => 'Add New Article',
				'edit_item' => 'Edit Article',
				//'new_item' => 'Column.newitemname',
				'view_item' => 'View Article',
				'search_items' => 'Search Articles'
			),
			'public' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
			'has_archive' => true,
			'menu_position' => 5,
			'menu_icon' => 'dashicons-media-text'
		)
	);

	register_taxonomy( 'column', 'article',
		array(
			'label' => 'Columns',
			'labels' => array(
				'name' => 'Columns',
				'singular_name' => 'Column',
				'search_items' => 'Search Columns',
				'edit_item' => 'Edit  ',
				'view_item' => 'Column.viewitem',
				'update_item' => 'Update Column',
				'add_new_item' => 'Add new Column',
				'new_item_name' => 'Column.newitemname'
			),
			'public' => true,
			'hierarchical' => true
		)
	);
	register_taxonomy( 'topic', 'article',
		array(
			'label' => 'Topic',
			'labels' => array(
				'name' => 'Topic',
				'singular_name' => 'Topic',
				'search_items' => 'Search Topic',
				'edit_item' => 'Edit  ',
				'view_item' => 'Topics.viewitem',
				'update_item' => 'Update Topic',
				'add_new_item' => 'Add new Topic',
				'new_item_name' => 'Topics.newitemname'
			),
			'public' => true,
			'hierarchical' => false
		)
	);
	$issue_labels=array(
		'name'              => _x( ' Issue', 'taxonomy general name' ),
		'singular_name'     => _x( 'Issue', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Issues' ),
		'all_items'         => __( 'All Issues' ),
		'parent_item'       => __( 'Parent Issue' ),
		'parent_item_colon' => __( 'Parent Issue:' ),
		'edit_item'         => __( 'Edit Issue' ),
		'update_item'       => __( 'Update Issue' ),
		'add_new_item'      => __( 'Add New Issue' ),
		'new_item_name'     => __( 'New Issue' ),
		'menu_name'         => __( 'Issues' ),
	);
	$Issues=array(
		'labels'=>$issue_labels,
		'hierarchical'=>true
		);

	register_taxonomy('issue','article', $Issues);
	
	
	
	register_post_type( 'project',
		array(
			'labels' => array(
				'name' => 'Projects',
				'singular_name' => 'Project',
				//'menu_name' => 'Search Columns',
				//'name_admin_bar' => 'Edit  ',
				//'all_items' => 'Column.viewitem',
				'add_new' => 'New Project',
				'add_new_item' => 'Add New Project',
				'edit_item' => 'Edit Project',
				//'new_item' => 'Column.newitemname',
				'view_item' => 'View Project',
				'search_items' => 'Search Projects'
			),
			'public' => true,
			'supports' => array('title', 'thumbnail', 'excerpt'),
			'has_archive' => true,
			'menu_position' => 6,
			'menu_icon' => 'dashicons-screenoptions'
		)
	);

	
	
}
add_action( 'init', 'create_post_types' );
?>
