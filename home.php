<?php

/*
*Template Name: Home
*
*/
get_header();

global $wp_query;

$current_issue=$wpdb->get_var( "SELECT option_value FROM wp_options WHERE option_name='current_issue'");

$extra_issue=$wpdb->get_var( "SELECT option_value FROM wp_options WHERE option_name='extra_issue'");

$issue_id=$wpdb->get_var($wpdb->prepare("SELECT term_id FROM wp_terms WHERE name=%s",$current_issue));

echo $current_issue;

echo "<h1>".$issue_id."</h1>";

$features_args = array(
			'posts_per_page'   => -1,
			'orderby'          => 'menu_order',
			'order'            => 'DESC',
			'post_type'        => 'article',
			'post_status'      => 'publish',
			'column' 			 => 'features',
			'tax_query'		 => array(
										array(
										'taxonomy'  			=> 'issue',
										'field'     			=> 'term_id',
										'terms'     			=> $issue_id,
										'include_children' 	=> true,
										'operator'  			=> 'IN'
										)
									)
		);

		// ** Roundtable query
		$roundtables_args = array(
				'posts_per_page'   => -1,
				'orderby'          => 'menu_order',
				'order'            => 'DESC',
				'post_type'        => 'article',
				'post_status'      => 'publish',
				'column' 			 => 'roundtable',
				'tax_query'		 => array(
											array(
											'taxonomy'  			=> 'issue',
											'field'     			=> 'term_id',
											'terms'     			=> $issue_id,
											'include_children' 	=> true,
											'operator'  			=> 'IN'
											)
										)
		);





$features_query = new WP_Query($features_args);
$features_count = $features_query->found_posts;

$roundtables_query = new WP_Query($roundtables_args);
$roundtables_count = $roundtables_query->found_posts;



echo "Roundtable count: ".$roundtables_count;
echo "Features count: ".$features_count;

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
