<php function add_issue_features( $new_status, $old_status, $post ){
if ( $new_status != $old_status ) {



  }
};

add_action('transition_post_status','add_issue_features');

?>
