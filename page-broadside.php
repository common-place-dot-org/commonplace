<?php
/*

This page will display all the articles from a specified column. 

*/
/*
Template Name: Broadside Page
*/

get_header();
?>
<?php 
while ( have_posts() ) : the_post(); 
	// Find the slug of the issue set for this page.
	// We will use this slug to generate all articles for the page. 
	$issue_id = get_field('issue_displayed');
	$issue_obj = get_term($issue_id, 'issue');
	$issue_slug = $issue_obj->slug;
	$issue_name = $issue_obj->name;
	$issue_description = $issue_obj->description;
	
	//echo var_dump($issue_obj);
	
	
endwhile; 

?>

<?php 
	// if display_extra_issue is checked...
	$display_extra_issue = get_field('display_extra_issue');
	if ($display_extra_issue) {
		include('inc/broadside-extra-issue.php');
	}
?>

<div class="main-issue" id="issue-<?php echo $issue_slug; ?>">
	<hr/>
	<p class="issue-meta">
		<?php 
			echo $issue_name .' : '. $issue_description ;
		?>
	</p>
	<hr/>
	<?php  include('inc/broadside-top.php') ?>
</div><!-- /main issue -->
<?php 
	get_footer();
?>