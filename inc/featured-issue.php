<?php

include 'change_homepage_template.php';

function featured_issue(){
  wp_add_dashboard_widget('featured_issue',
  'Featured Issue',
  'featured_issue_display'
  );
}

change_homepage_template('homepage6.php');

add_action('wp_dashboard_setup','featured_issue');

/* Creates form with current article issues */
/* COMMENT: Want to modd this in the future to limit the list of issues this form produces */
/* COMMENT: Try not using global wpdb */
function featured_issue_display(){
 global $wpdb;
$query="SELECT term_id FROM wp_term_taxonomy WHERE taxonomy='Issues' AND count<>0";
$issues=$wpdb->get_col($query);
echo "<form method='post' action=".$_SERVER['PHP_SELF']."><select name='choosen_issue'>";
 foreach($issues as $issue_termid){
	$issue_prepared=$wpdb->prepare("SELECT name FROM wp_terms WHERE term_id=%d",$issue_termid);
	$issue_name=$wpdb->get_var($issue_prepared);
	echo "<option>".$issue_name."</option>";
 };
 echo "<input type='submit' value='Submit' name='submit'>";
 echo "</select></form>";
};

/*Set Featured Issue in Database */
function set_featured(){
	global $wpdb;
	if(isset($_POST['choosen_issue'])){
		echo $_POST['choosen_issue'];
		$choosen_issue=$_POST['choosen_issue'];
		/* Is featured-issue already in the database? */
		$featured_issue_set=$wpdb->get_var("SELECT option_name FROM wp_options WHERE option_name='featured_issue'");
		var_dump($featured_issue_set);
		if($featured_issue_set==NULL){
			$make_featured_issue=$wpdb->prepare("INSERT INTO wp_options VALUES (700,'featured_issue',%s,'no')",$choosen_issue);
			$wpdb->query($make_featured_issue);

			//Set feature article count
			$featured_count=$wpdb->get_var($wpdb->prepare( "SELECT Features FROM cp_issue_columns WHERE Issue=%s",$choosen_issue));
			$make_featured_count=$wpdb->prepare("INSERT INTO wp_options VALUES (701,'featured_count',%s,'no')",$featured_count);
			$wpdb->query($make_featured_count);

			//Set round table article count
			$featured_round=$wpdb->get_var($wpdb->prepare( "SELECT RoundTable FROM cp_issue_columns WHERE Issue=%s",$choosen_issue));
			$make_featured_round=$wpdb->prepare("INSERT INTO wp_options VALUES (702,'featured_round',%s,'no')",$featured_round);
			$wpdb->query($make_featured_round);


		}
		else{
			$update_featured_issue=$wpdb->prepare("UPDATE wp_options SET option_value=%s WHERE option_name='featured_issue'",$choosen_issue);
			$wpdb->query($update_featured_issue);

			//Update feature article count
			$featured_count=$wpdb->get_var($wpdb->prepare( "SELECT Features FROM cp_issue_columns WHERE Issue=%s",$choosen_issue));
			$make_featured_issue=$wpdb->prepare("UPDATE wp_options SET option_value=%s WHERE option_name='featured_count'",$featured_count);
			$wpdb->query($make_featured_issue);

			//Set round table article count
			$featured_round=$wpdb->get_var($wpdb->prepare( "SELECT RoundTable FROM cp_issue_columns WHERE Issue=%s",$choosen_issue));
			$make_featured_round=$wpdb->prepare("UPDATE wp_options SET option_value=%s WHERE option_name='featured_round'",$featured_round);
			$wpdb->query($make_featured_round);
		}
	};
}

set_featured();


?>
