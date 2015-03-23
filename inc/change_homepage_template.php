<?php
function change_homepage_template($template){
  $page = get_page_by_title( 'TestPage', OBJECT, 'page' );
  if($page){
    $page_id = $page->ID;
    update_post_meta( $page_id, '_wp_page_template', $template );
    }
  };
?>
