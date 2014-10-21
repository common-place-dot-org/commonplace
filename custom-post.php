<?php

/*
Creates issue and article post type
*/

/*Creating new issue */

function create_issues(){

  $labels=array(
    'name' => 'Issues',
    'singular_name' => 'Issue',
    'add_new' => _x('Add New', 'coin'),
    'add_new_item' =>__('Add a Issue'),
    'edit_item' =>__('Edit Issue'),
    'new_item' =>__('New Issue'),
    'all_items' =>__('All Issues'),
    'view_item' =>__('View Issue'),
    'search_items' => __('Search Issue'),
    'not_found' => __('No issues found'),
    'not_found_in_trash' => __('No issues found in the trash'),
    'parent_item_colon' => '',
    'menu_name' => "Issues"
  );
  $args=array(
    'labels' => $labels,
    'description' => 'Use to create and manage journal issues',
    'public' => true,
    'exclude_from_search'=>false,
    'menu_position'=> 5,
    'supports' => array('title','editor','excerpt'),
    'has_archive' => true
  );
  register_post_type('issue',$args);

};



add_action( 'init', 'create_issues' );

/* Cutstomizing Issue messages */

function updated_issue_messages( $messages ) {
  global $post, $post_ID;
  $messages['issue'] = array(
    0 => '',
    1 => sprintf( __('Issue updated. <a href="%s">View issue</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('issue updated.'),
    3 => __('issue banished.'),
    4 => __('issue updated.'),
    5 => isset($_GET['revision']) ? sprintf( __('issue restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('issue published. <a href="%s">View issue</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('issue saved.'),
    8 => sprintf( __('issue submitted. <a target="_blank" href="%s">Preview issue</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('issue scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview issue</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('issue draft updated. <a target="_blank" href="%s">Preview issue</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}

add_filter( 'post_updated_messages', 'updated_issue_messages' );

/* Customizing issue help section */

function issue_contextual_help($contextual_help, $screen_id, $screen){
  if('issue' == $screen->id){
     $contextual_help = '<h2>Issue</h2>
      <p> Use to create journal issues </p>';

  }
  elseif ( 'edit-issue' == $screen->id ) {

        $contextual_help = '<h2>Issue editing</h2>
       <p>This page allows you to view and modify journal issues';

    }
    return $contextual_help;
};
  add_action( 'contextual_help', 'issue_contextual_help', 10, 3 );

  /* Creating issue taxonomy theme */

function issue_taxonomies(){
  $labels=array(
    'name'              => _x( ' Issue Themes', 'taxonomy general name' ),
    'singular_name'     => _x( 'Issue Theme', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Issue Themes' ),
    'all_items'         => __( 'All Issue Themes' ),
    'parent_item'       => __( 'Parent Issue Theme' ),
    'parent_item_colon' => __( 'Parent Issue Theme:' ),
    'edit_item'         => __( 'Edit Issue Theme' ),
    'update_item'       => __( 'Update Issue Theme' ),
    'add_new_item'      => __( 'Add New Issue Theme' ),
    'new_item_name'     => __( 'New Issue Theme' ),
    'menu_name'         => __( 'Issue Themes' ),
  );
  $args=array(
    'labels'=>$labels,
    'hierarchical'=>false
    );

  register_taxonomy('Themes','issue', $args);
};

add_action('init','issue_taxonomies',0);

/*----------------------------------------------------------------/*

/* Create Artcles */

function create_article(){

  $labels=array(
    'name' => 'Articles',
    'singular_name' => 'Article',
    'add_new' => _x('Add New', 'coin'),
    'add_new_item' =>__('Add a Article'),
    'edit_item' =>__('Edit Article'),
    'new_item' =>__('New Article'),
    'all_items' =>__('All Articles'),
    'view_item' =>__('View Article'),
    'search_items' => __('Search Article'),
    'not_found' => __('No Articles found'),
    'not_found_in_trash' => __('No articles found in the trash'),
    'parent_item_colon' => '',
    'menu_name' => "Articles"
  );
  $args=array(
    'labels' => $labels,
    'description' => 'For journal articles',
    'public' => true,
    'menu_position'=> 5,
    'supports' => array('title','editor','thumbnail','excerpt','comments'),
    'has_archive' => true
  );
  register_post_type('article',$args);

};



add_action( 'init', 'create_article' );

/* Cutstomizing article messages */

function updated_article_messages( $messages ) {
  global $post, $post_ID;
  $messages['article'] = array(
    0 => '',
    1 => sprintf( __('Article updated. <a href="%s">View article</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Article updated.'),
    3 => __('Article banished.'),
    4 => __('Article updated.'),
    5 => isset($_GET['revision']) ? sprintf( __('Article restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Article published. <a href="%s">View article</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Article saved.'),
    8 => sprintf( __('Article submitted. <a target="_blank" href="%s">Preview article</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Article scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview article</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Article draft updated. <a target="_blank" href="%s">Preview article</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}

add_filter( 'post_updated_messages', 'updated_article_messages' );

/* Customizing article help section */

function article_contextual_help($contextual_help, $screen_id, $screen){
  if('article' == $screen->id){
    $contextual_help = '<h2>Article</h2>
      <p> Use to create journal articles </p>';

  }
  elseif ( 'edit-article' == $screen->id ) {

        $contextual_help = '<h2>Article editing</h2>
      <p>This page allows you to view and modify journal articles';

    }
    return $contextual_help;
};
  add_action( 'contextual_help', 'article_contextual_help', 10, 3 );

  /* Creating article taxonomy theme */

function article_taxonomies(){
  $label1=array(
    'name'              => _x( ' Article Topics', 'taxonomy general name' ),
    'singular_name'     => _x( 'Article Topic', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Article Topics' ),
    'all_items'         => __( 'All Article Topics' ),
    'parent_item'       => __( 'Parent Article Topic' ),
    'parent_item_colon' => __( 'Parent Article Topic:' ),
    'edit_item'         => __( 'Edit Article Topic' ),
    'update_item'       => __( 'Update Article Topic' ),
    'add_new_item'      => __( 'Add New Article Topic' ),
    'new_item_name'     => __( 'New Article Topic' ),
    'menu_name'         => __( 'Article Topics' ),
  );
  $tax1=array(
    'labels'=>$label1,
    'hierarchical'=>false
    );

  register_taxonomy('Topics','article', $tax1);

  $label2=array(
    'name'              => _x( ' Article Designs', 'taxonomy general name' ),
    'singular_name'     => _x( 'Article Design', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Article Designs' ),
    'all_items'         => __( 'All Article Designs' ),
    'parent_item'       => __( 'Parent Article Design' ),
    'parent_item_colon' => __( 'Parent Article Design:' ),
    'edit_item'         => __( 'Edit Article Design' ),
    'update_item'       => __( 'Update Article Design' ),
    'add_new_item'      => __( 'Add New Article Design' ),
    'new_item_name'     => __( 'New Article Design' ),
    'menu_name'         => __( 'Article Designs' ),
  );
  $tax2=array(
    'labels'=>$label2,
    'hierarchical'=>false
    );

    register_taxonomy('Designs','article', $tax2);
};

add_action('init','article_taxonomies',0);


function create_new_post_gremlin(){

  $labels=array(
    'name' => 'Gremlins',
    'singular_name' => 'Gremlin',
    'add_new' => _x('Add New', 'coin'),
    'add_new_item' =>__('Add a gremlin'),
    'edit_item' =>__('Edit Gremlin'),
    'new_item' =>__('New Gremlin'),
    'all_items' =>__('All Gremlins'),
    'view_item' =>__('View Gremlin'),
    'search_items' => __('Search Gremlin'),
    'not_found' => __('No gremlins found'),
    'not_found_in_trash' => __('No gremlins found in the trash'),
    'parent_item_colon' => '',
    'menu_name' => "Gremlins"
  );
  $args=array(
    'labels' => $labels,
    'description' => 'Use to create and manage your gremlins',
    'public' => true,
    'menu_position'=> 5,
    'supports' => array('title','editor','thumbnail','excerpt','comments'),
    'has_archive' => true
  );
  register_post_type('Gremlin',$args);

};

add_action( 'init', 'create_new_post_gremlin' );

function my_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['gremlin'] = array(
    0 => '',
    1 => sprintf( __('Grelim updated. <a href="%s">View gremlin</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Gremlin updated.'),
    3 => __('Gremlin banished.'),
    4 => __('Gremlin updated.'),
    5 => isset($_GET['revision']) ? sprintf( __('Gremlin restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Gremlin published. <a href="%s">View gremlin</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Gremlin saved.'),
    8 => sprintf( __('Gremlin submitted. <a target="_blank" href="%s">Preview gremlin</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Gremlin scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview gremlin</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Gremlin draft updated. <a target="_blank" href="%s">Preview gremlin</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
};

add_filter( 'post_updated_messages', 'my_updated_messages' );

function gremlin_contextual_help($contextual_help, $screen_id, $screen){
  if('gremlin' == $screen->id){
    $contextual_help = '<h2>Gremlin</h2>
      <p> A page to manage your mischievous gremlins</p>';

  }
  elseif ( 'edit-gremlin' == $screen->id ) {

        $contextual_help = '<h2>Making changes to your gremlins</h2>
      <p>This page allows you to view and modify your gremlins';

    }
    return $contextual_help;
};
  add_action( 'contextual_help', 'gremlin_contextual_help', 10, 3 );

function gremlin_taxonomies(){
  $labels=array(
    'name'              => _x( 'Gremlin Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Gremlin Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Gremlin Categories' ),
    'all_items'         => __( 'All Gremlin Categories' ),
    'parent_item'       => __( 'Parent Gremlin Category' ),
    'parent_item_colon' => __( 'Parent Gremlin Category:' ),
    'edit_item'         => __( 'Edit Gremlin Category' ),
    'update_item'       => __( 'Update Gremlin Category' ),
    'add_new_item'      => __( 'Add New Gremlin Category' ),
    'new_item_name'     => __( 'New Gremlin Category' ),
    'menu_name'         => __( 'Gremlin Categories' ),
  );
  $args=array(
    'labels'=>$labels,
    'hierarchical'=>true
    );

  register_taxonomy('gremlin_category','gremlin', $args);
};

add_action('init','gremlin_taxonomies',0);

add_action( 'add_meta_boxes', 'gremlin_price_box' );
function gremlin_price_box() {
    add_meta_box(
        'gremlin price_box',
        'Gremlin Price',
        'gremlin_price_box_content',
        'gremlin',
        'side',
        'high'
    );
}

function gremlin_price_box_content( $post ) {
  wp_nonce_field( plugin_basename( __FILE__ ), 'product_price_box_content_nonce' );
  echo '<label for="product_price"></label>';
  echo '<input type="text" id="product_price" name="product_price" placeholder="enter a price" />';
}

add_action( 'save_post', 'gremlin_price_box_save' );
function gremlin_price_box_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;

  if ( !wp_verify_nonce( $_POST['product_price_box_content_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }
  $gremlin_price = $_POST['gremlin_price'];
  update_post_meta( $post_id, 'gremlin_price', $gremlin_price );
}

?>
