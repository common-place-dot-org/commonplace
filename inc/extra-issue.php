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
									array(
										'taxonomy'  => 'issue',
										'field'     => 'id',
										'terms'     => $extra_id,
										'operator'  => 'AND'
									),
									array(
										'taxonomy'  => 'column',
										'field'     => 'slug',
										'terms'     => 'reviews',
										'operator'  => 'IN'
									)
								)
		);
		$extra_others_args = array ();
	
		// make 2 queries. 
		
		// 1 for the reviews to go in a nice left grid. 
			
			// dump those in a col6 with rows. 
		
		// another for all other articles. 	
		
			// if there are any other articles, make a right column and drop them in. 
			
	?>
	<div class="extra-issue" id="issue-<?php echo $issue_slug; ?>">
		<p class="issue-meta">
			<?php 
				echo $extra_name .' : '. $extra_description ;
			?>
		</p>
		<hr/>
		<div class="row">
		<?php $extra_reviews_query = new WP_Query($extra_reviews_args); ?>
			<h2>Reviews</h2>
				<?php
				while ( $extra_reviews_query->have_posts() ) {
					$extra_reviews_query->the_post(); ?>
				
					<div class="col-sm-6">
						<h3><?php the_title();?></h3>
						<figure class="article-img">
							<a href="<?php the_permalink();?>"><? the_post_thumbnail('post-thumbnail', array(
									'class' => "attachment-$size img-responsive",
							));?></a>
						</figure>
						<div class="article-excerpt"><?php the_excerpt();?></div>

					</div>
				
				<?php } //end while
				?>
		<?php wp_reset_postdata(); ?>
		</div>
	</div>