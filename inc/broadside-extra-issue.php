<?php 

// get the ids of any child issues of the current issue. 
$extra_id = (array) get_term_children($issue_id, 'issue');

// only need the first item, as we will never display more than 1 extra issue. 
$extra_id = $extra_id[0];

// collect information about this particular extra issue. 
$extra_obj = get_term($extra_id, 'issue');
$extra_slug = $extra_obj->slug;
$extra_name = $extra_obj->name;
$extra_description = $extra_obj->description;

// We'll use these both for the query, and to count the number of articles from each. 
$extra_reviews_args = array(
	'post_type' => 'article',
	'orderby'			 => 'menu_order title',
	'order'  			 => 'ASC',
	'tax_query'		 => array(
							'relation' => 'AND',
							array(
								'taxonomy'  => 'issue',
								'field'     => 'id',
								'terms'     => $extra_id
							),
							array(
								'taxonomy'  => 'column',
								'field'     => 'slug',
								'terms'     => 'reviews'
							)
						)
);
$extra_others_args = array (
	'post_type' => 'article',
	'orderby'			 => 'menu_order title',
	'order'  			 => 'ASC',
	'tax_query'		 => array(
							'relation' => 'AND',
							array(
								'taxonomy'  => 'issue',
								'field'     => 'id',
								'terms'     => $extra_id,
							),
							array(
								'taxonomy'  => 'column',
								'field'     => 'slug',
								'terms'     => array('reviews', 'roundtable'),
								'operator'  => 'NOT IN'
							)
						)
);
$extra_roundtable_args = array (
	'post_type' => 'article',
	'orderby'			 => 'menu_order title',
	'order'  			 => 'ASC',
	'tax_query'		 => array(
							'relation' => 'AND',
							array(
								'taxonomy'  => 'issue',
								'field'     => 'id',
								'terms'     => $extra_id,
							),
							array(
								'taxonomy'  => 'column',
								'field'     => 'slug',
								'terms'     => 'roundtable',
								'operator'  => 'IN'
							)
						)
);

// count the reviews, we'll use this to create rows for the articles. 
		$extra_reviews = 	get_posts($extra_reviews_args);
		$extra_reviews_count = count($extra_reviews); 
		$extraCounter = 1;
		
		// query the reviews, setup a loop. 
		$extra_reviews_query = new WP_Query($extra_reviews_args);		
		$extra_others_query = new WP_Query($extra_others_args);		
		$extra_roundtable_query = new WP_Query($extra_roundtable_args);	
		$extra_roundtables = get_posts($extra_roundtable_args);
		$extra_reviews_count = count($extra_roundtables); 	

if ($extra_reviews_count > 0){
	include('extra-issue-roundtable.php');
} else {
	include('extra-issue-standard.php');
}

?>



<hr class="extra-issue-divider"/>