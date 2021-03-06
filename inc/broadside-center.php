<?php 

$reviews_args = array(
	'post_type'        => 'article',
	'orderby'			 => 'menu_order title',
	'order'  			 => 'ASC',
	'tax_query' 		 => array(
		'relation' => 'AND',
		array(
			'taxonomy' 		=> 'column',
			'field'   			=> 'slug',
			'terms'				=> 'reviews',
			),
		array(
			'taxonomy' 		=> 'issue',
			'field'   			=> 'slug',
			'terms'				=> $issue_slug,
			'include_children'	=> false
			)
	)
);

$others_args = array(
	'post_type'        => 'article',
	'orderby'			 => 'menu_order title',
	'order'  			 => 'ASC',
	'tax_query' 		 => array(
		'relation' => 'AND',
		array(
			'taxonomy' 		=> 'column',
			'field'   			=> 'slug',
			'terms'				=> array('reviews', 'features', 'roundtable'),
			'operator'			=> 'NOT IN'
			),
		array(
			'taxonomy' 		=> 'issue',
			'field'   			=> 'slug',
			'terms'				=> $issue_slug,
			'include_children'	=> false
			)
	)
);

// ** Count the Articles
	$reviews = get_posts( $reviews_args );
	$reviews_count = count($reviews); 
//	$features_count = 4;
	$others = get_posts( $others_args );
	$others_count = count($others); 
	//$roundtables_count = 0; 
/*	
echo var_dump($reviews_count);
echo var_dump($others_count);

echo var_dump($extra_issue);
echo var_dump($features_count);
echo var_dump($roundtables_count);	
/**/
?>


<hr/>

<div class="row" id="main-center">
<div class="col-sm-4">
	<h3 class="column-title">
		<?php $reviews = get_term_by('slug', 'reviews', 'column');?>
		<a href="<?php echo get_term_link($reviews->term_id, 'column'); ?>">
			<img src="<?php echo z_taxonomy_image_url($reviews->term_id); ?>" />
			Reviews
		</a>
	</h3>
	
	<?php 
	$query = new WP_Query($reviews_args);
	while ( $query->have_posts() ) {
			$query->the_post();
	?>
		<div class="row">
			<div class="col-sm-4">
				<figure class="article-img">
					<a href="<?php the_permalink();?>"><? if ( has_post_thumbnail() ) {
								the_post_thumbnail('post-thumbnail', array(
								'class' => "attachment-$size img-responsive",
								));
							};?></a>
				</figure>
			</div>
			<div class="col-sm-8">
				<h3 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>


				<div class="article-excerpt"><span class="article-author"><?php  
							echo the_field('author_first_name',$post->ID);
							echo ' ';
							echo the_field('author_last_name',$post->ID); ?><?php
							$other_authors = get_field('additional_authors',$post->ID);
							if ($other_authors){
								echo ', '.$other_authors;
							}?>
							</span><?php the_excerpt();?></div>
			</div>
		</div>
	<?php
	} //endwhile
	?>
</div>
<div class="col-sm-8">
	<?php
	$thisCol = 1;
	$query = new WP_Query($others_args);
	while ( $query->have_posts() ) {
			$query->the_post();
			?>
			<?php if ($thisCol == 1){
				echo '<div class="row">';
			}?>
			
			<div class="col-sm-4">
				<h3 class="column-title">
					<?php foreach (get_the_terms(get_the_ID(), 'column') as $cat) : ?>
						<a href="<?php echo get_term_link($cat->term_id, 'column'); ?>">
							<img src="<?php echo z_taxonomy_image_url($cat->term_id); ?>" />
							<?php echo $cat->name; ?>
						</a>
					<?php endforeach; ?>
				</h3>
				<figure class="article-img">
					<a href="<?php the_permalink();?>"><? if ( has_post_thumbnail() ) {
						the_post_thumbnail('post-thumbnail', array(
						'class' => "attachment-$size img-responsive",
						));
					};?></a>
				</figure>
				<h4 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
	
	
				<div class="article-excerpt">
					<span class="article-author">
					<?php  
						echo the_field('author_first_name',$post->ID);
						echo ' ';
						echo the_field('author_last_name',$post->ID); 
					?><?php
							$other_authors = get_field('additional_authors',$post->ID);
							if ($other_authors){
								echo ', '.$other_authors;
							}?>
					</span>
					<?php the_excerpt();?>
				</div>
			</div>
				
				
			<?php if ($thisCol == 3){
				echo '</div><!-- /row -->';
			}?>
		
			<?php 
				if ($thisCol < 3 ){
					$thisCol++ ;
				} else {
					$thisCol = 1;
				}
			?>
	<?php
	} //endwhile
	?>
</div>
</div>