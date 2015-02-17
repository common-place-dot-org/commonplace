<?php function featured_issue(){
  wp_add_dashboard_widget('featured_issue',
  'Featured Issue',
  'featured_issue_display'
  );
};

add_action('wp_dashboard_setup','featured_issue');

function featured_issue_display(){
 $issueList = get_terms( 'category', array(
 	'orderby'    => 'count',
 	'hide_empty' => 0,
 ) );
 var_dump($issueList);
 echo '<ul>';
 foreach($issueList as $issue){
   echo '<li>'.$issue->name.'</li>';
 };
 echo '</ul>';


  echo "<p>Select Featured Issue</p>";
  echo '<form action="" method="post">';
  echo '<p> Test</p> <input type="text" id="test_meta" name="test" value=""></input>';
  echo '<input type="submit">';
  echo '</form>';
  $_POST['test'] ? $_POST['test'] : '';
}


?>
