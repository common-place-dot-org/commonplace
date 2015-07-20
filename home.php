<?php

/*
*Template Name: Home
*
*/
get_header();

$current_issue=$wpdb->get_var( "SELECT option_value FROM wp_options WHERE option_name='current_issue'");

$extra_issue=$wpdb->get_var( "SELECT option_value FROM wp_options WHERE option_name='extra_issue'");

$issue_id=$wpdb->get_var($wpdb->prepare("SELECT term_id FROM wp_terms WHERE name=%s",$current_issue));


$issue_obj = get_term($issue_id, 'issue');
$issue_slug = $issue_obj->slug;
$issue_name = $issue_obj->name;
$issue_description = $issue_obj->description;
$issue_id = $issue_obj->term_taxonomy_id;
$issue_image_src = z_taxonomy_image_url($issue_id, 'medium');
?>


<!-- Sample code for current issue image -->
<?php 
	// if display_extra_issue is checked...
	if ($extra_issue != 'false') {
		include('inc/broadside-extra-issue.php');
	}
?>
<div class="main-issue" id="issue-<?php echo $issue_slug; ?>">
	<p class="issue-meta">
		<?php 
			echo $issue_name .' : '. $issue_description ;
		?>
	</p>
	<?php $reviews = get_term_by('slug', 'reviews', 'column');?>

<?php 

if ($issue_image_src) {
	?>
<div class="issue-image">
<img src="<?php echo $issue_image_src ?>" class="img-responsive"/>
</div>
 <?php }?>
	
	
	
	
	<?php  include('inc/broadside-top.php') ?>
	<?php  include('inc/broadside-center.php') ?>
</div><!-- /main issue -->
<hr/>
<?php if ( is_active_sidebar( 'sidebar-footer' ) ) { ?>
	<div id="promos" class="row">
		<?php dynamic_sidebar( 'sidebar-footer' ); ?>
	</div>
<?php }; ?>
<?php 
	get_footer();
?>

