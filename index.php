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

$featured_count=3;
$featured_round=2;
if($featured_count<=3){
  if($featured_round>0){
    echo "featured <=3 with round";
  }
  else{
    echo "featured <=3";
  }
}
else if(3<$featured_count || $featured_count<=6){
  if($featured_round>0){
    echo "featured >=6 with round";
  }
  else{
    echo "featured >=6";
  }
}
  else{
    if($featured_round>0){
      echo "featured >7 with round";
    }
    else{
      echo "featured >7";
    }
  }
  
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
			
			//var_dump($roundtables_query);
			echo $roundtables_count;
			
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
			
			echo $features_count;
			//var_dump($features_query);
  

?>
