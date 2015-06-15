<div class="extra-issue extra-issue-standard row" id="issue-<?php echo $extra_slug; ?>">
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
			<h2 class="column-title">
			<?php $reviews = get_term_by('slug', 'reviews', 'column');?>
			<a href="<?php echo get_term_link($reviews->term_id, 'column'); ?>">
				<img src="<?php echo z_taxonomy_image_url($reviews->term_id); ?>" />
				Reviews
			</a>
			</h2>
			
		</header>
		<?php 
		
			
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
							<h3 class="article-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
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
		<div class="row">
			<div class="col-sm-12">
			<?php 
			while ( $extra_others_query->have_posts() ) {
				$extra_others_query->the_post(); 
				?>
				<article <?php post_class(); ?>>
					<h3 class="column-title">
						<?php foreach (get_the_terms(get_the_ID(), 'column') as $cat) : ?>
							<a href="<?php echo get_term_link($cat->term_id, 'column'); ?>">
								<img src="<?php echo z_taxonomy_image_url($cat->term_id); ?>" />
								<?php echo $cat->name; ?>
							</a>
						<?php endforeach; ?>
					</h3>
					<h3 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="article-excerpt"><span class="article-author"><?php  
							echo the_field('author_first_name',$post->ID);
							echo ' ';
							echo the_field('author_last_name',$post->ID); ?>
							</span><?php the_excerpt();?></div>
				</article>				
			<?php 
			} //end while
			?>
			</div>
		</div>
	</div>
</div><!-- /extra issue -->