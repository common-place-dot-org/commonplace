<?php
/*

This page will display all the articles from a specified column. 

*/
/*
Template Name: Column Index
*/

get_header();

?>
<div class="row">
	<div class="col-sm-12">
		
	</div>
</div>
<div class="row">
	<div class="col-sm-9">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1><?php the_title()?></h1>
			<?php the_content();?>
		<?php endwhile; endif; ?>
		<?php 		
		$args = array(
			'post_type' => 'article',
			'tax_query' => array(
				array(
					'taxonomy' => 'column',
					'terms'    => get_field('column_to_display'),
				),
			),
		);
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
		?>
			<article class="article col-sm-6">
				<div class="col-sm-4">
					<div class="article-img">
						<a href="<?php the_permalink();?>"><? the_post_thumbnail('post-thumbnail', array(
								'class' => "attachment-$size img-responsive",
						));?></a>
					</div>
				</div>
				<div class="col-sm-8">
					<h3 class="article-title">
						<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
					</h3>
					<p class="article-author"><?php echo get_field( "author_name" );?></p>
					<div class="article-excerpt">
						<?php the_excerpt();?>
					</div>
				</div>
			</article>
		<?php endwhile;?>
	</div>
	<div class="col-sm-3">
		<h2>Topics</h2>
		<p>Topic Tags used by articles within this category, sorted in descending order by number of articles.</p>
		<ul class="nav nav-pills nav-stacked">
			<li><a href="#"><strong>TopicName</strong> <span class="badge">00</span></a></li>
			<li><a href="#"><strong>TopicName</strong> <span class="badge">00</span></a></li>
			<li><a href="#"><strong>TopicName</strong> <span class="badge">00</span></a></li>
			<li><a href="#"><strong>TopicName</strong> <span class="badge">00</span></a></li>
		</ul>
	</div>
</div><!-- /row-->
<?php 
get_footer();
?>