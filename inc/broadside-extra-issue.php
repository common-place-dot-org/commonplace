<?php 

// get the ids of any child issues of the current issue. 
$extra_id = (array) get_term_children($issue_id, 'issue');

// only need the first item, as we will never display more than 1 extra issue. 
$extra_id = $extra_id[0];

// collect information about this particular extra issue. 
$extra_obj = get_term($extra_id, 'issue');
$extra_slug = $extra_obj->slug;
$extra_name = $extra_obj->name;
$extra_description = $extra_obj->description;

// We'll use these both for the query, and to count the number of articles from each. 
$extra_reviews_args = array(
	'post_type' => 'article',
	'tax_query'		 => array(
							'relation' => 'AND',
							array(
								'taxonomy'  => 'issue',
								'field'     => 'id',
								'terms'     => $extra_id
							),
							array(
								'taxonomy'  => 'column',
								'field'     => 'slug',
								'terms'     => 'reviews'
							)
						)
);
$extra_others_args = array (
	'post_type' => 'article',
	'tax_query'		 => array(
							'relation' => 'AND',
							array(
								'taxonomy'  => 'issue',
								'field'     => 'id',
								'terms'     => $extra_id,
							),
							array(
								'taxonomy'  => 'column',
								'field'     => 'slug',
								'terms'     => 'reviews',
								'operator'  => 'NOT IN'
							)
						)
);
?>
<div class="extra-issue row" id="issue-<?php echo $extra_slug; ?>">
	<header class="col-sm-12">
		<p class="issue-meta">
			<?php 
				echo $extra_name .' : '. $extra_description ;
			?>		
		</p>
		<hr/>
	</header>
	<div id="extra-reviews" class="col-sm-8">
		<header>
			<h2>Reviews</h2>
		</header>
		<?php 
		
		// count the reviews, we'll use this to create rows for the articles. 
		$extra_reviews = 	get_posts($extra_reviews_args);
		$extra_reviews_count = count($extra_reviews); 
		$extraCounter = 1;
		
		// query the reviews, setup a loop. 
		$extra_reviews_query = new WP_Query($extra_reviews_args);			
		while ( $extra_reviews_query->have_posts() ) {
			$extra_reviews_query->the_post(); 
			
			// is this an odd or even instance of a review?
			if ($extraCounter % 2 == 0) {
				$extra_even = true;
			} else {
				$extra_odd = true;
			}
			// start a row if this is an odd numbered article
			if ($extra_odd) {
				echo '<div class="row article-row">';
			}
			?>
			
			<div class="col-sm-6">
				<article <?php post_class(); ?>>
					<div class="row">
						<div class="col-sm-3">
							<figure class="article-img">
								<a href="<?php the_permalink();?>"><? the_post_thumbnail('post-thumbnail', array(
										'class' => "attachment-$size img-responsive",
								));?></a>
							</figure>
						</div>
						<div class="col-sm-9">
							<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
							<div class="article-excerpt"><?php the_excerpt();?></div>
						</div>
					</div>
				</article>
			</div>
		
		<?php 
			// close the row if this is either an even article, or the last article in the list. 
			if ($extra_even || ($extraCounter == $extra_reviews_count)) {
				echo '</div><!-- closing row... -->'; // closes row
			}
			// increase the article counter for odd/even
			$extraCounter++;
			// reset odd/even
			$extra_even = false;
			$extra_odd = false;
		} //end while
		?>
		<?php 
			// reset the query
			wp_reset_postdata(); 
		?>
	</div><!-- / extra reviews -->
	<div class="col-sm-4" id="extra-others">
		<header><h2>Other Articles</h2></header>
		<div class="row">
			<div class="col-sm-12">
			<?php 
			$extra_others_query = new WP_Query($extra_others_args);		
			while ( $extra_others_query->have_posts() ) {
				$extra_others_query->the_post(); 
				?>
				<article <?php post_class(); ?>>
					<h3><a href="#"><?php the_title(); ?></a></h3>
					<div class="article-excerpt"><?php the_excerpt();?></div>
				</article>				
			<?php 
			} //end while
			?>
			</div>
		</div>
	</div>
</div><!-- /extra issue -->
<hr/>