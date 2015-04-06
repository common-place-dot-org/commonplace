<?php

function featured_issue(){
  wp_add_dashboard_widget('featured_issue',
  'Current Issue',
  'featured_issue_display'
  );
}

add_action('wp_dashboard_setup','featured_issue');

/* Creates form with current article issues */
/* COMMENT: Want to modd this in the future to limit the list of issues this form produces */
/* COMMENT: Try not using global wpdb */
function featured_issue_display(){
 global $wpdb;
$query="SELECT term_id FROM wp_term_taxonomy WHERE taxonomy='issue' AND count<>0";
$issues=$wpdb->get_col($query);
echo "<form method='post' action=".$_SERVER['PHP_SELF']."><p>Select current issue from dropdown:</p><select name='choosen_issue'>";
 foreach($issues as $issue_termid){
	$issue_prepared=$wpdb->prepare("SELECT name FROM wp_terms WHERE term_id=%d",$issue_termid);
	$issue_name=$wpdb->get_var($issue_prepared);
	echo "<option>".$issue_name."</option>";
 };
 echo "</select>";
 echo "<br><p>Include Extra Issues?</p><select name='extra_issue'>";
 $xi_false="false";
 $xi_true="true";
 echo "<option>".$xi_false."</option>";
 echo "<option>".$xi_true."</option>";
 echo "</select><br><input type='submit' value='Submit' name='submit'></form>";
};

/*Set Featured Issue in Database */
function set_featured(){
	global $wpdb;
	global $post;
	if(isset($_POST['choosen_issue'])){
		$choosen_issue=$_POST['choosen_issue'];
		/* Is featured-issue already in the database? */
		$featured_issue_set=$wpdb->get_var("SELECT option_name FROM wp_options WHERE option_name='current_issue'");
		if($featured_issue_set==NULL){
			$make_featured_issue=$wpdb->prepare("INSERT INTO wp_options VALUES (700,'current_issue',%s,'no')",$choosen_issue);
			$wpdb->query($make_featured_issue);

		}
		else{
			$update_featured_issue=$wpdb->prepare("UPDATE wp_options SET option_value=%s WHERE option_name='current_issue'",$choosen_issue);
			$wpdb->query($update_featured_issue);
		}
	};
  if(isset($_POST['extra_issue'])){
    $extra_issue=$_POST['extra_issue'];
    /* Is featured-issue already in the database? */
    $extra_issue_set=$wpdb->get_var("SELECT option_name FROM wp_options WHERE option_name='extra_issue'");
    if($extra_issue_set==NULL){
      $get_extra_issue=$wpdb->prepare("INSERT INTO wp_options VALUES (701,'extra_issue',%s,'no')",$extra_issue);
      $wpdb->query($get_extra_issue);

    }
    else{
      $update_extra_issue=$wpdb->prepare("UPDATE wp_options SET option_value=%s WHERE option_name='extra_issue'",$extra_issue);
      $wpdb->query($update_extra_issue);
    }
  };
}

set_featured();


?>
