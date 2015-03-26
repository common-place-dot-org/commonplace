<?php
/*

This page will display all the articles from a specified column. 

*/
/*
Template Name: Broadside Page
*/

get_header();
?>
<?php 
while ( have_posts() ) : the_post(); 
	// Find the slug of the issue set for this page.
	// Use this slug to generate all articles for the page. 
	$issue_id = get_field('issue_displayed');
	$issue_obj = get_term($issue_id[0], 'issue');
	$issue_slug = $issue_obj->slug;
endwhile; 

// ** Features query
$features_args = array(
	'posts_per_page'   => 100,
	'orderby'          => 'menu_order',
	'order'            => 'DESC',
	'post_type'        => 'article',
	'post_status'      => 'publish',
	'column' 			 => 'features',
	'issue'				 => $issue_slug
);
// ** Roundtable query  
$roundtables_args = array(
	'posts_per_page'   => 100,
	'orderby'          => 'menu_order',
	'order'            => 'DESC',
	'post_type'        => 'article',
	'post_status'      => 'publish',
	'column' 			 => 'roundtable',
	'issue'				 => $issue_slug
);

// ** Count the Articles

	$features = get_posts( $features_args );
	$features_count = count($features); 
	$features_count = 4;
	
	$roundtables = get_posts( $roundtables_args );
	$roundtables_count = count($roundtables); 
	//$roundtables_count = 0; 

?>
<div class="broadside" id="issue-<?php echo $issue_slug; ?>">
	<div class="row">
		<?php 
		
			/* 
			*	Layout Variables
			*	Used to change the bootstrap col numbers based on number of feature articles and roundtable articles. - AB
			*	
			*/
		
			
			if ($roundtables_count > 0 ){
				// YES ROUNDTABLES
				
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
						$feature_img_grid = 4;
						$feature_text_grid = 8;
						break;
					case 4:	
						$feature_split = false;
						$features_articles_grid = 12;
						$feature_img_grid = 3;
						$feature_text_grid = 9;
						break;
					// if there are 5+ features
					default :
						$feature_split = false;
						$features_articles_grid = 12;
						$feature_img_grid = 2;
						$feature_text_grid = 10;
				}
				
			} else {
				// NO ROUNDTABLES 
				
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
					case 4:	
						$feature_split = false;
						$features_articles_grid = 3;
						$feature_img_grid = 12;
						$feature_text_grid = 12;
						break;
					// if there are 5+ features
					default :
						$feature_split = true;
						$features_articles_grid = 6;
						$feature_img_grid = 4;
						$feature_text_grid = 8;
				}
				
				// width for each element within the article
				
			};
		?> 
		<?php 
		/* 
		*	Generate Features Articles
		*/
		?>
		<div class="col-sm-<?php echo $features_grid;?>" id="features">
			<?php $query = new WP_Query($features_args); ?>
			<?php
			// used to calculate odds and evens. 
			$featureCounter = 1; 
			while ( $query->have_posts() ) {
				$query->the_post();
				
				// Is this an odd article or even 
				if ($feature_split) {
					if ($featureCounter % 2 == 0) {
						$feature_even = true;
					} else {
						$feature_odd = true;
					}
					// start a row if this is an odd numbered article
					if ($feature_odd) {
						echo '<div class="row">';
					}	
				}
				?>
				<div class="col-sm-<?php echo $features_articles_grid;?>">
					<article id="article-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="col-sm-<?php echo $feature_img_grid; ?>">
							<figure class="article-img">
								<a href="<?php the_permalink();?>"><? the_post_thumbnail('post-thumbnail', array(
										'class' => "attachment-$size img-responsive",
								));?></a>
							</figure>
						</div>
						<div class="col-sm-<?php echo $feature_text_grid ?>">
							<h3 class="article-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
							<div class="article-excerpt"><?php the_excerpt();?></div>
						</div>
					</article>
				</div>
				<?php 
				
				if ($feature_split) {
					// close the row if this is an even numbered article
					if ($feature_even) {
						echo '</div>';
					}
					// used to calculate odds and evens. 
					$featureCounter++;
					$feature_even = false;
					$feature_odd = false;
				}
			}
			?>
			<?php wp_reset_postdata(); ?>
		</div> <!-- /features -->
		<?php 
		
		/* 
		*	Generate Roundtable Articles
		*/
		
		
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
									<? the_post_thumbnail('post-thumbnail', array(
											'class' => "attachment-$size img-responsive",
									));?>
								</div><!-- /roundtable-img -->
							<?php 
							} else {
								// if not, let's display the name of the roundtable in text. 
								$terms = get_the_terms($post->ID,'column');
								foreach ($terms as $term) {
									// Don't print the info of the parent column "roundtables" just the info for the child column, the specfici roundtable. 
									$parent = "$term->parent";
									if ($parent != 0) {
										echo '<h3 class="roundtable-description">';
											echo "$term->description";
										echo '</h3>';
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
						<div class="article-excerpt"><?php the_excerpt();?></div>
					</article>
					<?php $roundtableCounter++; ?>
				<?php 
				} //endwhile
				?>
			</div><!-- /roundtables -->
		<?php 
		} else {
			echo 'roundtables is <= 0';	
		}?>
	</div><!--  /row -->
</div><!-- /broadside -->
<?php 
get_footer();
?>