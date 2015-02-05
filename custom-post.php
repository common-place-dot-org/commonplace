<?php

/*
Creates issue and article post type
*/

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




?>
