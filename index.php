<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package commonplace
 */


$featured_issue=$wpdb->get_var( "SELECT option_value FROM wp_options WHERE option_id=700");
$feature_count=(int)($wpdb->get_var("SELECT option_value FROM wp_options WHERE option_id=701"));
$roundtable_count=(int)($wpdb->get_var("SELECT option_value FROM wp_options WHERE option_id=702"));

echo "Featured Issue: ".$featured_issue."<br>Feature Count: ".$feature_count."<br>RoundTable Count: ".$roundtable_count."<br><br>";

// The Query
?>
$the_query = get_post(9);
		echo '<br><br><br><br>';
		echo '<h1>' . $the_query->post_title . '</h1>';
		echo '<br>';
		echo '<p>'.$the_query->post_content.'</p>';
		
		//Slug Names for feature and roundtable
		//Must change variable to correct slug upon changing the corresponding column slug
		$feature_slug="feature";
		$roundTable_slug="roundtable";
		
		echo 'REACHED $POST_COLUMNS';
		$post_columns=wp_get_object_terms($the_query->ID,"column");
		$post_issues=wp_get_object_terms($the_query->ID,"Issues");
		echo $the_query->ID;
		foreach($post_columns as $column){
		echo $column->slug.'<br>';
		}
		foreach($post_columns as $column){
			//Is this article a feature?
			if($column->slug==$feature_slug){
				foreach($post_issues as $issue){
					$wpdb->query($wpdb->prepare("UPDATE cp_issue_columns SET Features = Features + 1 WHERE Issue = %s",$issue->name));
				}
			}
			//Is this article a roundtable?
			if($column->slug==$roundTable_slug){
				foreach($post_issues as $issue){
					$wpdb->query($wpdb->prepare("UPDATE cp_issue_columns SET RoundTable = RoundTable + 1 WHERE Issue = %s",$issue->name));
				}
			}
			
		}
		global $wpdb;
        $wpdb->query("CREATE TABLE IF NOT EXISTS cp_issue_columns (Issue varchar(255), Features int, RoundTable int)");
		$num_rows=$wpdb->get_var("SELECT COUNT(*) FROM cp_issue_columns");
		echo $num_rows;
		if($num_rows<2){
			$issues=get_terms('Issues',array('hide_empty'=>false));
			foreach($issues as $issue){
				$wpdb->query($wpdb->prepare("INSERT INTO cp_issue_columns(Issue,Features,RoundTable) VALUES(%s,0,0)",$issue->name));
				
			}
		}
		$choosen_issue='Issue 1';
		$featured_count=$wpdb->get_var($wpdb->prepare( "SELECT Features FROM cp_issue_columns WHERE Issue=%s",$choosen_issue));
		echo var_dump($featured_count);
		echo $featured_count;
		
		
		
		
?>

