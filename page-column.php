<?php
/*

This page will display all the articles from a specified column. 

*/
/*
Template Name: Column Index
*/

get_header();

?>
<div id="colindex-<?php echo $post->post_name;?>">
<div class="row">
	<div class="col-sm-12">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1><?php the_title()?></h1>
			<?php the_content();?>
		<?php endwhile; endif; ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">	
		
		<?php 		
				
		$recent_args = array(	
			'post_type' => 'article',
			'orderby' => 'date',
			'posts_per_page' => 10, 
			'tax_query' => array(
				array(
					'taxonomy' => 'column',
					'terms'    => get_field('column_to_display')
				),
			),
		);
		
		$recent = get_posts( $recent_args );
		$recent_count = count($recent); 
		$recents_loop = new WP_Query( $recent_args );
		$colCount = 1;
		while ( $recents_loop->have_posts() ) : $recents_loop->the_post();
		?>
		
		<?php if ($colCount % 2 != 0){ 
			echo '<div class="row col-row">';
		}
		
		
		?>
		
			<article class="article col-sm-6">
				<div class="row">
					<div class="col-sm-5">
						<div class="article-img">
							<a href="<?php the_permalink();?>"><? the_post_thumbnail('post-thumbnail', array(
									'class' => "attachment-$size img-responsive",
							));?></a>
						</div>
					</div>
					<div class="col-sm-7">
						<h3 class="article-title">
							<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
						</h3>
						<p class="article-author"><?php the_field('author_prefix');?> <?php the_field('author_first_name');?> <?php the_field('author_last_name');?> <?php the_field('author_suffix');?></p>
						<div class="article-excerpt">
							<?php the_excerpt();?>
						</div>
					</div>
				</div>
			</article>			
			<?php 
			if ($colCount % 2 == 0 || $colCount >= $recent_count){ 
				echo '</div><!-- /row -->';
			}	
			$colCount++;
			?>
		<?php endwhile;?>
		<?php wp_reset_query(); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<p><a href="<?php bloginfo('url')?>/book/column/<?php echo get_field('column_to_display')?>">Archives for <?php the_title()?> &raquo;</a></p>
		<?php endwhile; endif; ?>
		
	</div>
</div><!-- /row-->
</div>
<?php 
get_footer();
?>