<?php
  include 'ChromePhp.php';  ChromePhp::log('LOG');
  change_homepage_template('homepage6.php');

  function add_issue_columns( $ID, $post ){
  ChromePhp::log('Hello console!');
  global $wpdb;
		//Slug Names for feature and roundtable
		//Must change variable to correct slug upon changing the corresponding column slug
		$feature_slug="feature";
		$roundTable_slug="roundtable";

		echo 'REACHED $POST_COLUMNS';
		$post_columns=wp_get_object_terms($ID,"column");
		$post_issues=wp_get_object_terms($ID,"Issues");
		echo $ID;
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



};

add_action(  'publish_article',  'add_issue_columns', 10 ,2);
