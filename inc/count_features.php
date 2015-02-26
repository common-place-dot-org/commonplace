<?php
  include 'ChromePhp.php';
  ChromePhp::log('Hello console!');
  function add_issue_columns( $ID, $post ){
  global $wpdb;
  $post_issues=wp_get_object_terms($ID,"issues");
  $post_issue=$post_issues[0];
  $post_columns=wp_get_object_terms($ID,"Columns");
  foreach($post_columns as $column){
    $make_cp_table=$wpdb->prepare("CREATE TABLE cp_issue_columns (Issue varchar(255), Features int, RoundTable int)");
    $wpdb->query($make_cp_table);
  //  if ($column->name=="Features"){
  //       $result = mysql_query("SHOW TABLES LIKE 'cp_issue_columns'");
  //       $tableExists = mysql_num_rows($result) > 0;
  //       if($tableExists){
  //         //Add +1 to features in table at post Issue
  //       }
  //       else{
  //         $make_cp_table=$wpdb->prepare("CREATE TABLE cp_issue_columns (Issue varchar(255), Features int, RoundTable int)");
  //         $wpdb->query($make_cp_table);
  //         //Add +1 to features in table at post Issue
  //       }
  //   }
  // if($column->name=="Round-Table"){
  //   //Same as features
  //   }
  };

};

add_action(  'publish_article',  'add_issue_columns', 10, 2 );
?>
