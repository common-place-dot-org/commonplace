<?php
/*
* Template Name: Homepage 6
* Description: Homepage for 6 features
*/
$current_issue_name=$wpdb->get_var("SELECT option_value FROM wp_options WHERE option_name='featured_issue'");
$current_issue=$wpdb->get_var($wpdb->prepare("SELECT slug FROM wp_terms WHERE name=%s",$current_issue_name));
echo $current_issue;

$args=array(
	'post_type'=>'article',
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy'=>'Issues',
			'field'=>'slug',
			'terms'=>$current_issue
		),
		array(
			'taxonomy' => 'column',
			'field'    => 'slug',
			'terms'    => 'feature'
		)
	)
);

$query = new WP_Query( $args );

?>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container"> 
	<!-- 1-3 Features - - - - - - - - -  - - - - - -->
	
	<div class="row">
		<section id="features">
		<h2>Features</h2>
		<?php
		$count=0;
		while ( $query->have_posts() ) {
			if($count<=6){
			$query->the_post();
			echo '<div class="col-sm-6">';
			echo '<article>';
			echo '<h3 class="article-title">'.get_the_title()."</h3>";
			echo '<div class="article-excerpt">'.get_the_excerpt()."</div>";
			echo '</article>';
			echo '</div>';
			$count++;
			}
			else{
				$query->the_post();
			}
		}
		wp_reset_postdata();
		?>
		</section>
	</div>
</body>