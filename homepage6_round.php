<?php
/*
* Template Name: Homepage 6
* Description: Homepage for 6 features and roundtables
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

$query_feature = new WP_Query( $args );

$args_round=array(
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
			'terms'    => 'roundtable'
		)
	)
);

$query_round = new WP_Query( $args_round );

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
		<div class="col-sm-8">
			<section id="features">
				<h2>Features</h2>
				<?php
				$count=0;
				echo "<div class='col-sm-6'>";
				while ( $query_feature->have_posts() ) {
					if($count<=3){
					$query_feature->the_post();
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
				echo "</div>";
				$count=0;
				echo "<div class='col-sm-6'>";
				while ( $query_feature->have_posts() ) {
					if($count>3){
					$query_feature->the_post();
					echo '<div class="col-sm-4">';
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
				echo "</div>";
				wp_reset_postdata();
				?>
			</section>
		</div>
		<div class="col-sm-4">
			<section id="features">
				<h2>Roundtable</h2>
				<?php
				$count=0;
				while ( $query_round->have_posts() ) {
					$query_round->the_post();
					if($count==0){
						echo '<div class="col-sm-12">';
						echo '<article>';
						echo '<h3 class="article-title">'.get_the_title()."</h3>";
						echo '<div class="article-excerpt">'.get_the_excerpt()."</div>";
						echo '</article>';
						echo '</div>';
						$count++;
					}
					else{
						echo '<div class="col-sm-12">';
						echo '<article>';
						echo '<h3 class="article-title">'.get_the_title()."</h3>";
						//Use this line to get the author// echo '<div class="article-excerpt">'.get_the_excerpt()."</div>";
						echo '</article>';
						echo '</div>';
						$count++;
					}
				}
				wp_reset_postdata();
				?>
			</section>
		</div>
	</div>
</body>