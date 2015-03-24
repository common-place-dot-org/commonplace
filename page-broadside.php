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
	
	$roundtables = get_posts( $roundtables_args );
	$roundtables_count = count($roundtables); 

?>
<div class="broadside" id="issue-<?php echo $issue_slug; ?>">
	<div class="row">
		<?php 
			// Are there going to be roundtables?
			if ($roundtables_count > 0 ){
				$features_grid = 7;
				$features_articles_grid = 12;
				
				if ($features_count > 3 ){
					$feature_img_grid = 3;
					$feature_text_grid = 9;
				} else {
					$feature_img_grid = 5;
					$feature_text_grid = 7;
				}
				
			} else {
				$features_grid = 12;
				switch ($features_count) {
					case 2:	
						$features_articles_grid = 6;
						break;
					case 3:	
						$features_articles_grid = 4;
						break;
				}
				
			
					$feature_img_grid = 1;
					$feature_text_grid = 1;
				
			};
		?> 
		<div class="col-sm-<?php echo $features_grid;?>" id="features">
			<?php $query = new WP_Query($features_args); ?>
			<?php 
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
				<div class="col-sm-<?php echo $features_articles_grid;?>">
					<article>
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
			}
			?>
			<?php wp_reset_postdata(); ?>
		</div> <!-- /features -->
		<?php if ($roundtables_count > 0 ){?>
			
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