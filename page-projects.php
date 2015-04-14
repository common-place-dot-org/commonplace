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
	</div>
</div>
<div class="row">
	<?php 
	function printProject(){
		$projType = get_field('project_type');	
		$projectLink = '#';
		if ($projType == 'Site'){
			$projectLink = get_field('project_link');
		} elseif ($projType == 'Page') {
			$projectLink = get_field('project_page');
		} elseif ($projType == 'File'){
			$arr = get_field('project_file');
			$projectLink = $arr['url'];
		}
		
		//echo '<h3><a href="'. $projectLink .'">'. get_the_title().'</a></h3>';
		echo '<a href="'.  $projectLink.'">';
		the_post_thumbnail('post-thumbnail', array('class' => "attachment-$size img-responsive"));
		echo '</a><br/><br/>';
		echo '<div class="article-excerpt">'. the_excerpt() .'</div><br/><br/><br/><br/>';
		print_r($thumb);
	}
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
			<?php printProject();?>
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
			<?php printProject();?>
		</div>
	<?php endwhile;?>
</div>
<?php 
get_footer();
?>