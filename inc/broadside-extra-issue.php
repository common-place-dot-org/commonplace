<?php // get the ids of any child issues of hte current issue. 
		$extra_id = (array) get_term_children($issue_id, 'issue');
		// only need the first item, as we will never display more than 1 extra issue. 
		$extra_id = $extra_id[0];
		
		$extra_obj = get_term($extra_id, 'issue');
		$extra_slug = $extra_obj->slug;
		$extra_name = $extra_obj->name;
		$extra_description = $extra_obj->description;
		
		
		
		
		$extra_reviews_args = array(
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
		
		

	
		// make 2 queries. 
		
		// 1 for the reviews to go in a nice left grid. 
			
			// dump those in a col6 with rows. 
		
		// another for all other articles. 	
		
			// if there are any other articles, make a right column and drop them in. 
			
	?>
	<div class="extra-issue" id="issue-<?php echo $extra_slug; ?>">
		<p class="issue-meta">
			<?php 
				echo $extra_name .' : '. $extra_description ;
			?>		
		</p>
		<p>
			<?php 
				$extra_reviews = 	get_posts($extra_reviews_args);
				$extra_reviews_count = count($extra_reviews); 
				echo var_dump($extra_reviews);
			?>
		</p>
		<hr/>
		<div id="extra-reviews" class="col-sm-8">
			<?php 
			
			$extra_reviews_query = new WP_Query($extra_reviews_args);
			$extraCounter = 1;
				
			while ( $extra_reviews_query->have_posts() ) {
				$extra_reviews_query->the_post(); 
				
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
				
				<div class="col-sm-6 article-container">
					<div class="row">
						<div class="col-sm-3">
							<figure class="article-img">
								<a href="<?php the_permalink();?>"><? the_post_thumbnail('post-thumbnail', array(
										'class' => "attachment-$size img-responsive",
								));?></a>
							</figure>
						</div>
						<div class="col-sm-9">
							<h3><?php the_title();?></h3>
							<div class="article-excerpt"><?php the_excerpt();?></div>
						</div>
					</div>
				</div>
			
			<?php 
				if ($extra_even || ($extraCounter == $extras_reviews_count)) {
					echo '</div><!-- closing row... -->'; // closes row
				}
			
				$extraCounter++;
				$extra_even = false;
				$extra_odd = false;
			} //end while
			?>
			<?php wp_reset_postdata(); ?>
		</div><!-- / extra reviews -->
		<div class="col-sm-4" id="extra-others">
			<h2>Other Articles</h2>
		</div>
</div>