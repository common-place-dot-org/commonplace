<?php

/*
$features_args=array(
			'post_type'=>'article',
			'post_status'      => 'publish',
			'tax_query'		   => array(
									'relation'=>'AND',
									array(
										'taxonomy'=>'issue',
										'field'=>'name',
										'terms'=>$current_issue,
										'include_children'=>$extra_issue,
										),
									array(
										'taxonomy'=>'column',
										'field'=>'name',
										'terms'=>'Features',
										'include_children'=>$extra_issue,
									)
			)
		);

$features_query = new WP_Query($features_args);
$features_count = $features_query->found_posts;

$roundtable_args=array(
		'post_type'=>'article',
		'post_status'      => 'publish',
		'tax_query'		   => array(
								'relation'=>'AND',
								array(
									'taxonomy'=>'issue',
									'field'=>'name',
									'terms'=>$current_issue,
									'include_children'=>$extra_issue,
									),
								array(
									'taxonomy'=>'column',
									'field'=>'name',
									'terms'=>'Roundtable',
									'include_children'=>$extra_issue,
								)
		)
	);

$roundtables_query = new WP_Query($roundtable_args);
$roundtables_count = $roundtables_query->found_posts;

*/



// *********** Adding this temporarily. 

// ** Features query
$features_args = array(
	'posts_per_page'   => -1,
	'post_type'        => 'article',
	'orderby'			 => 'menu_order title',
	'order'  			 => 'ASC',
	'column' 			 => 'features',
	'issue'				 => $issue_slug
);
// ** Roundtable query  
$roundtables_args = array(
	'posts_per_page'   => -1,
	'post_type'        => 'article',
	'orderby'			 => 'menu_order title',
	'order'  			 => 'ASC',
	'tax_query' 		 => array(
		'relation' => 'AND',
		array(
			'taxonomy' 		=> 'column',
			'field'   			=> 'slug',
			'terms'				=> 'roundtable'
			),
		array(
			'taxonomy' 		=> 'issue',
			'field'   			=> 'slug',
			'terms'				=> $issue_slug,
			'include_children'	=> false
			)
	)
);

$features_query = new WP_Query($features_args);
$features_count = $features_query->found_posts;
$roundtables_query = new WP_Query($roundtables_args);
//var_dump($roundtables_query);
$roundtables_count = $roundtables_query->found_posts;
//var_dump($roundtables_count);


/*
// ** Count the Articles
	$features = get_posts( $features_args );
	$features_count = count($features); 
//	$features_count = 4;
	$roundtables = get_posts( $roundtables_args );
	$roundtables_count = count($roundtables); 
	//$roundtables_count = 0; 
	
	
/*
echo var_dump($current_issue);
echo var_dump($issue_id);
echo var_dump($extra_issue);
echo var_dump($features_count);
echo var_dump($roundtables_count);
/**/


//The featured issue picutre
//Use $issue_image_url to output image url into theme



// Layout variables: Determined by the Article count.

// if this issue has any round table articles...
if ($roundtables_count > 0 ){
	

	// change the width of the 'features' wrapper
	$features_width = 7;

	// change widths and orientation of articles depending on number.
	switch ($features_count) {
		// there are 2 features AND roundtable
		case 2:
			$features_articles_per_row = 1;
			$features_article_width = 12;
			$feature_img_width = 12;
			$feature_text_width = 12;
			break;
		// there are 3 features, AND roundtable
		case 3:
			$features_articles_per_row = 1;
			$features_article_width = 12;
			$feature_img_width = 5;
			$feature_text_width = 7;
			break;
		// 4 features, AND roundtable
		case 4:
			$features_articles_per_row = 1;
			$features_article_width = 12;
			$feature_img_width = 3;
			$feature_text_width = 9;
			break;
		// if there are any other number of features
		default :
			$features_articles_per_row = 2;
			$features_article_width = 6;
			$feature_img_width = 2;
			$feature_text_width = 10;
	}

} else {
	// If this issue does not have a roundtable....

	// set 'features' wrapper to full width.
	$features_width = 12;

	// change widths and orientation of articles depending on number.
	switch ($features_count) {
		// there are 2 features, no roundtable
		case 2:
			$features_articles_per_row = 2;
			$features_article_width = 6;
			$feature_img_width = 12;
			$feature_text_width = 12;
			break;
		// there are 3 features, no roundtable
		case 3:
			$features_articles_per_row = 3;
			$features_article_width = 4;
			$feature_img_width = 12;
			$feature_text_width = 12;
			break;
		// 4 features, no roundtable
		case 4:
			$features_articles_per_row = 2;
			$features_article_width = 6;
			$feature_img_width = 4;
			$feature_text_width = 8;
			break;
		// if there are any other number of features
		default :
			$features_articles_per_row = 3;
			$features_article_width = 4;
			$feature_img_width = 3;
			$feature_text_width = 9;
	}

	// width for each element within the article

};
?>

<?php /* if (function_exists('z_taxonomy_image_url')){
		$issue_image_url=z_taxonomy_image_url($issue_id);
		if ($issue_image_url){
		?>
		<div class-"row" id="special-issue">>
			<div class-"span12">
				<img src="<?php echo $issue_image_url;?>" alt="featured image">
			</div>
		</div>
		<?php 
		}
	}
	*/
?>
<div class="row" id="main-top">
	<div class="col-sm-<?php echo $features_width;?>" id="features">
		<header>
			<h2 class="column-title">
				<?php $feats = get_term_by('slug', 'features', 'column');?>
				<a href="<?php echo get_term_link($feats->term_id, 'column'); ?>">
					<img src="<?php echo z_taxonomy_image_url($feats->term_id); ?>" />
					Features
				</a>
			</h2>
		</header>
		<div class="row">
			<?php
			// query the features.
			$query = new WP_Query($features_args);
	
	
			// used to calculate odds and evens.
			$featureCounter = 0;
			while ( $query->have_posts() ) {
				$query->the_post();
				$featureCounter++;
				?>
				<div class="col-sm-<?php echo $features_article_width;?>">
					<article id="article-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="row">
							<div class="col-sm-<?php echo $feature_img_width; ?>">
								<figure class="article-img">
									<a href="<?php the_permalink();?>"><? if ( has_post_thumbnail() ) {
										the_post_thumbnail('post-thumbnail', array(
										'class' => "attachment-$size img-responsive",
										));
									};?></a>
								</figure>
							</div>
							<div class="col-sm-<?php echo $feature_text_width ?>">
								<h3 class="article-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
								
								<p class="article-description"><?php echo category_description( $category_id ); ?></p>
								<div class="article-excerpt"><span class="article-author"><?php  
								echo the_field('author_first_name',$post->ID);
								echo ' ';
								echo the_field('author_last_name',$post->ID); ?>
								<?php
								$other_authors = get_field('additional_authors',$post->ID);
								if ($other_authors){
									echo ', '.$other_authors;
								}?>
								</span><?php the_excerpt();?></div>
							</div>
						</div>
					</article>
				</div>
				<?php 
				if ($featureCounter % $features_articles_per_row == 0){
					// if this is the last col in the row, start a new row. 
					echo '</div><!-- closing row--><div class="row">';				
				}
			} //endwhile
			?>
		</div>
		<?php
		//reset the query
		wp_reset_postdata();
		?>
	</div> <!-- /features -->
	<?php
	// If we need a roundtables section...
	if ($roundtables_count > 0 ){?>

		<div class="col-sm-5" id="roundtables">
		
			<?php
			// using this to track the first roundtable article.
			$roundtableCounter = 0;
			$query2 = new WP_Query($roundtables_args);
			while ( $query2->have_posts() ) {
				$query2->the_post();

				// Roundtable header

				// Create a roundtable header from column and feat. img of first article.
				if ($roundtableCounter == 0) {?>
					<header>
						<?php
						if (get_the_post_thumbnail() != '') {
							// if there's a featured image, display that. ?>
							<div class="roundtable-img">
								<? if ( has_post_thumbnail() ) {
											the_post_thumbnail('post-thumbnail', array(
											'class' => "attachment-$size img-responsive",
											));
									 };?>
							</div><!-- /roundtable-img -->
						<?php
						} else {
							// if not, let's display the name of the roundtable in text.
							$terms = get_the_terms($post->ID,'column');
							foreach ($terms as $term) {
								// Don't print the info of the parent column "roundtables" just the info for the child column, the specfici roundtable.
								$parent = "$term->parent";
								if ($parent != 0) {
									echo '<h2 class="roundtable-description">';
									echo "$term->description";
									echo '</h2>';
								}
							}
						}
						?>
					</header>
				<?php
				}
				
				include('roundtables-output.php');
				$roundtableCounter++;

			} //endwhile
			?>
		</div><!-- /roundtables -->
	<?php
	}
	?>
</div><!--  /main-top -->
