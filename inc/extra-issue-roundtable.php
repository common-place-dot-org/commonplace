<div class="extra-issue extra-issue-standard row" id="issue-<?php echo $extra_slug; ?>">
	<header class="col-sm-12">
		<p class="issue-meta">
			<?php 
				echo $extra_name .' : '. $extra_description ;
			?>
		</p>
		<hr/>
	</header>
	<div id="extra-roundtable" class="col-sm-8">
		<div class="row">
			<?php 
		$extra_roundtableCounter = 0;
		$extra_roundtable_query = new WP_Query($extra_roundtable_args);
		while ( $extra_roundtable_query->have_posts() ) {
			
			$extra_roundtable_query->the_post();
			$extra_roundtableCounter++;
			if ($extra_roundtableCounter == 1) {?>
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
				</div>
				<!-- /roundtable-img -->
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
			<?php } //endif ?>
			<div class="col-sm-6">
				<?php 
			include('roundtables-output.php'); ?>
			</div>
			<?php
			if ($extra_roundtableCounter % 2 == 0 ){
				echo '</div><!-- closing row--><div class="row">';	
			}
		
		}//endwhile
	?>
		</div>
	</div>
	<div id="extra-roundtable-sidebar"  class="col-sm-4">
		<div id="extra-reviews">
			<header>
				<h2 class="column-title">
					<?php $reviews = get_term_by('slug', 'reviews', 'column');?>
					<a href="<?php echo get_term_link($reviews->term_id, 'column'); ?>"> <img src="<?php echo z_taxonomy_image_url($reviews->term_id); ?>" /> Reviews </a> </h2>
			</header>
			<?php 
		while ( $extra_reviews_query->have_posts() ) {
			$extra_reviews_query->the_post(); 
			?>
			<div class="row">
				<article <?php post_class(); ?>>
					<div class="col-sm-3">
						<figure class="article-img"> <a href="<?php the_permalink();?>">
							<? the_post_thumbnail('post-thumbnail', array(
												'class' => "attachment-$size img-responsive",
										));?>
							</a> </figure>
					</div>
					<div class="col-sm-9">
						<h3 class="article-title"><a href="<?php the_permalink();?>">
							<?php the_title();?>
							</a></h3>
						<div class="article-excerpt"><span class="article-author">
							<?php  
									echo the_field('author_first_name',$post->ID);
									echo ' ';
									echo the_field('author_last_name',$post->ID); ?>
							</span>
							<?php the_excerpt();?>
						</div>
					</div>
				</article>
			</div>
			<?php 
			// reset the query
			wp_reset_postdata();
		} //endwhile
		?>
		</div>
		<div id="extra-others">
			<div class="row">
				<div class="col-sm-12">
					<?php 
			while ( $extra_others_query->have_posts() ) {
				$extra_others_query->the_post(); 
				?>
					<article <?php post_class(); ?>>
						<h3 class="column-title">
							<?php foreach (get_the_terms(get_the_ID(), 'column') as $cat) : ?>
							<a href="<?php echo get_term_link($cat->term_id, 'column'); ?>"> <img src="<?php echo z_taxonomy_image_url($cat->term_id); ?>" /> <?php echo $cat->name; ?> </a>
							<?php endforeach; ?>
						</h3>
						<h3 class="article-title"><a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
							</a></h3>
						<div class="article-excerpt"><span class="article-author">
							<?php  
							echo the_field('author_first_name',$post->ID);
							echo ' ';
							echo the_field('author_last_name',$post->ID); ?>
							</span>
							<?php the_excerpt();?>
						</div>
					</article>
					<?php 
			} //end while
			?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /extra issue -->