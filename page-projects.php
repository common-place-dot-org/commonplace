<?php
/*

This page will display all the articles from a specified column. 

*/
/*
Template Name: Projects Page
*/

get_header();

?>
<div class="row">
	<div class="col-sm-12">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1><?php the_title()?></h1>
			<?php the_content();?>
		<?php endwhile; endif; ?>
		<hr/>
	</div>
</div>
<div class="row">
	
	<?php 
	
	// Go get all Projects with project_status == active
	
	// list them out. 
	
	
	// get all projects with project_status == archived
	
	// list those out seperately. 
	
	
	
	?>

	<?php 		
	$args = array(	
		'post_type' => 'project',
		'meta_key' => 'project_status',
		'meta_value' => 'active'
	);
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
	?>
	<div class="col-sm-4">	
		<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<a href="<?php the_permalink();?>"><? the_post_thumbnail('post-thumbnail', array(
				'class' => "attachment-$size img-responsive",
		));?></a>
		<div class="article-excerpt">
			<?php the_excerpt();?>
		</div>
	</div>
	<?php endwhile;?>
</div>
<div class="row">	
	
	
	<?php 		
	$args = array(	
		'post_type' => 'project',
		'meta_key' => 'project_status',
		'meta_value' => 'archived'
	);
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
	?>
	<div class="col-sm-3">	
		<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<a href="<?php the_permalink();?>"><? the_post_thumbnail('post-thumbnail', array(
				'class' => "attachment-$size img-responsive",
		));?></a>
		<div class="article-excerpt">
			<?php the_excerpt();?>
		</div>
	</div>
	<?php endwhile;?>
	
</div>
<?php 
get_footer();
?>