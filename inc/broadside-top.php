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
	'order'  			 => 'DESC',
	'column' 			 => 'features',
	'issue'				 => $issue_slug
);
// ** Roundtable query  
$roundtables_args = array(
	'posts_per_page'   => -1,
	'post_type'        => 'article',
	'orderby'			 => 'menu_order title',
	'order'  			 => 'DESC',
	'column' 			 => 'roundtable',
	'issue'				 => $issue_slug
);

$features_query = new WP_Query($features_args);
$features_count = $features_query->found_posts;
$roundtables_query = new WP_Query($roundtables_args);
$roundtables_count = $roundtables_query->found_posts;


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
	$features_grid = 7;
	// change feature articles to single column.
	$features_articles_grid = 12;

	// add more or less room for img based on number of articles.
	if ($features_count > 3 ){
		$feature_img_grid = 3;
		$feature_text_grid = 9;
	} else {
		$feature_img_grid = 5;
		$feature_text_grid = 7;
	}
	// change widths and orientation of articles depending on number.
	switch ($features_count) {
		// there are 2 features
		case 2:
			$feature_split = false;
			$features_articles_grid = 12;
			$feature_img_grid = 12;
			$feature_text_grid = 12;
			break;
		// there are 3 features
		case 3:
			$feature_split = false;
			$features_articles_grid = 12;
			$feature_img_grid = 5;
			$feature_text_grid = 7;
			break;
		case 4:
			$feature_split = false;
			$features_articles_grid = 12;
			$feature_img_grid = 3;
			$feature_text_grid = 9;
			break;
		// if there are any other number of features
		default :
			$feature_split = false;
			$features_articles_grid = 12;
			$feature_img_grid = 2;
			$feature_text_grid = 10;
	}

} else {

	// If this issue does not have a roundtable....

	// set 'features' wrapper to full width.
	$features_grid = 12;

	// change widths and orientation of articles depending on number.
	switch ($features_count) {
		// there are 2 features
		case 2:
			$feature_split = false;
			$features_articles_grid = 6;
			$feature_img_grid = 12;
			$feature_text_grid = 12;
			break;
		// there are 3 features
		case 3:
			$feature_split = false;
			$features_articles_grid = 4;
			$feature_img_grid = 12;
			$feature_text_grid = 12;
			break;
		// there are 4 features
		case 4:
			$feature_split = false;
			$features_articles_grid = 3;
			$feature_img_grid = 12;
			$feature_text_grid = 12;
			break;
		// if there are any other number of features
		default :
			$feature_split = true;
			$features_articles_grid = 6;
			$feature_img_grid = 4;
			$feature_text_grid = 8;
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
	<div class="col-sm-<?php echo $features_grid;?>" id="features">
		<header>
			<h2 class="column-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>/column/features">Features</a></h2>
		</header>
		<?php
		// query the features.
		$query = new WP_Query($features_args);


		// used to calculate odds and evens.
		$featureCounter = 1;
		while ( $query->have_posts() ) {
			$query->the_post();
			// are there so many features that we need 2 columns of them?
			if ($feature_split) {
				// in 2 col mode, we need to track even and odd articles to create rows.
				if ($featureCounter % 2 == 0) {
					$feature_even = true;
				} else {
					$feature_odd = true;
				}
				// start a row if this is an odd numbered article
				if ($feature_odd) {
					echo '<div class="row">';
				}
			} else {
				echo '<div class="row">';
			}
			?>
			<div class="col-sm-<?php echo $features_articles_grid;?>">
				<article id="article-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="row">
						<div class="col-sm-<?php echo $feature_img_grid; ?>">
							<figure class="article-img">
								<a href="<?php the_permalink();?>"><? if ( has_post_thumbnail() ) {
											the_post_thumbnail('post-thumbnail', array(
											'class' => "attachment-$size img-responsive",
											));
										};?></a>
							</figure>
						</div>
						<div class="col-sm-<?php echo $feature_text_grid ?>">
							<h3 class="article-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
							
							<p class="article-description"><?php echo category_description( $category_id ); ?></p>
							<div class="article-excerpt"><span class="article-author"><?php  
							echo the_field('author_first_name',$post->ID);
							echo ' ';
							echo the_field('author_last_name',$post->ID); ?>
							</span><?php the_excerpt();?></div>
						</div>
					</div>
				</article>
			</div>
			<?php
			// if we're running 2 cols, we don;t always want to close the row.
			if ($feature_split) {
				// close the row if this is an even numbered article, or the last article in the bunch.
				if ($feature_even || ($featureCounter == $features_count)) {
					echo '</div>';
				}
				//increase the article counter
				$featureCounter++;
				// reset odd/even.
				$feature_even = false;
				$feature_odd = false;
			} else {
				// if we're not in 2col mode, always close the row.
				echo '</div>';
			}
		}
		?>
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
				?>
				<?php

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

				// Roundtable articles.

				?>
				<article>
					<h3 class="article-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
					
					<p class="article-description"><?php echo category_description( $category_id ); ?></p>
					<div class="article-excerpt"><span class="article-author"><?php  
							echo the_field('author_first_name',$post->ID);
							echo ' ';
							echo the_field('author_last_name',$post->ID); ?>
							</span><?php the_excerpt();?></div>
				</article>
				<?php $roundtableCounter++; ?>
			<?php
			} //endwhile
			?>
		</div><!-- /roundtables -->
	<?php
	}
	?>
</div><!--  /main-top -->
