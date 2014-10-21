<?php 
function create_post_types() {
	register_post_type( 'issue',
		array(
				'labels' => array(
				'name' => __( 'Issues' ),
				'singular_name' => __( 'Issue' ),
				'add_new' => 'New Issue',
				'add_new_item' => 'Add New Issue',
				'edit_item' => 'Edit Issue',
				//'new_item' => 'Column.newitemname',
				'view_item' => 'View Issue',
				'search_items' => 'Search Issues'
			),
			'public' => false,
			'has_archive' => false,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'menu_icon' => 'dashicons-book' 
		)
	);
	/*
	register_taxonomy( 'issue_number', 'issue', 
		array(
			'label' => 'Issue Number',
			'labels' => array(
				'name' => 'Issue Numbers',
				'singular_name' => 'Issue Number',
				'search_items' => 'Search Issue Numbers',
				'edit_item' => 'Edit Issue Number',
				'view_item' => 'Issue Number.viewitem',
				'update_item' => 'Update Issue Number',
				'add_new_item' => 'Add new Issue Number',
				'new_item_name' => 'Issue Number.newitemname'
			),
			'public' => true,
			'hierarchical' => true
		)
	);
	*/
	register_taxonomy( 'issue_tag', 'issue', 
		array(
			'label' => 'Issue Tag',
			'labels' => array(
				'name' => 'Issue Tags',
				'singular_name' => 'Issue Tag',
				'search_items' => 'Search Issue Tags',
				'edit_item' => 'Edit Issue Tags',
				'view_item' => 'Issue Tag.viewitem',
				'update_item' => 'Update Issue Tag',
				'add_new_item' => 'Add new Issue Tag',
				'new_item_name' => 'Issue Tag.newitemname'
			),
			'public' => true,
			'hierarchical' => false
		)
	);
	
	
	
	
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
			'label' => 'Topic Tags',
			'labels' => array(
				'name' => 'Topic Tags',
				'singular_name' => 'Topic Tag',
				'search_items' => 'Search Topic Tags',
				'edit_item' => 'Edit  ',
				'view_item' => 'Topics.viewitem',
				'update_item' => 'Update Topic Tag',
				'add_new_item' => 'Add new Topic Tag',
				'new_item_name' => 'Topics.newitemname'
			),
			'public' => true,
			'hierarchical' => false
		)
	);
}
add_action( 'init', 'create_post_types' );
?>