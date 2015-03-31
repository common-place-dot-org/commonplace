<?php

function featured_issue(){
  wp_add_dashboard_widget('featured_issue',
  'Featured Issue',
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
	global $post;
	if(isset($_POST['choosen_issue'])){
		$choosen_issue=$_POST['choosen_issue'];
		/* Is featured-issue already in the database? */
		$featured_issue_set=$wpdb->get_var("SELECT option_name FROM wp_options WHERE option_name='current_issue'");
		if($featured_issue_set==NULL){
			$make_featured_issue=$wpdb->prepare("INSERT INTO wp_options VALUES (700,'current_issue',%s,'no')",$choosen_issue);
			$wpdb->query($make_featured_issue);

			//Set feature article count
			$features_args = array(
				'posts_per_page'   => -1,
				'orderby'          => 'menu_order',
				'order'            => 'DESC',
				'post_type'        => 'article',
				'post_status'      => 'publish',
				'column' 			 => 'features',
				'issue'				 => $featured_issue
			);
			$features_query = new WP_Query($features_args);
			$features_count = $features_query->found_posts;
			
			
			//Set featured count in database
			$make_featured_count=$wpdb->prepare("INSERT INTO wp_options VALUES (701,'features_count',%s,'no')",$features_count);
			$wpdb->query($make_featured_count);
			
			//Set roundtable article count
			$roundtables_args = array(
				'posts_per_page'   => -1,
				'orderby'          => 'menu_order',
				'order'            => 'DESC',
				'post_type'        => 'article',
				'post_status'      => 'publish',
				'column' 			 => 'roundtable',
				'issue'				 => $featured_issue
			);
			
			$roundtables_query = new WP_Query($roundtables_args);
			$roundtables_count = $roundtables_query->found_posts;
			

			//Set round table article count in database
			$make_featured_round=$wpdb->prepare("INSERT INTO wp_options VALUES (702,'roundtables_count',%s,'no')",$roundtables_round);
			$wpdb->query($make_featured_round);

		}
		else{
			$update_featured_issue=$wpdb->prepare("UPDATE wp_options SET option_value=%s WHERE option_name='current_issue'",$choosen_issue);
			$wpdb->query($update_featured_issue);
			
			//Set feature article count
			$features_args = array(
				'posts_per_page'   => -1,
				'orderby'          => 'menu_order',
				'order'            => 'DESC',
				'post_type'        => 'article',
				'post_status'      => 'publish',
				'column' 			 => 'features',
				'issue'				 => $featured_issue
			);
			$features_query = new WP_Query($features_args);
			$features_count = $features_query->found_posts;
			
			

			//Update feature article count in database
			$make_featured_issue=$wpdb->prepare("UPDATE wp_options SET option_value=%s WHERE option_name='features_count'",$features_count);
			$wpdb->query($make_featured_issue);
			
			//Set roundtable article count
			$roundtables_args = array(
				'posts_per_page'   => -1,
				'orderby'          => 'menu_order',
				'order'            => 'DESC',
				'post_type'        => 'article',
				'post_status'      => 'publish',
				'column' 			 => 'roundtable',
				'issue'				 => $featured_issue
			);
			$roundtables_query = new WP_Query($roundtables_args);
			$roundtables_count = $roundtables_query->found_posts;
			


			//Set round table article count in database
			$make_featured_round=$wpdb->prepare("UPDATE wp_options SET option_value=%s WHERE option_name='roundtables_count'",$roundtables_count);
			$wpdb->query($make_featured_round);
		}
	};
}

set_featured();


?>
