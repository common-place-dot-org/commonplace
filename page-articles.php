<?php

/*
Template Name: Articles-Test
*/
get_header();
?>
<hr/>
<?php
$args = array( 'post_type' => 'issue', 'posts_per_page' => 2 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
?>
	<p>
		<?php the_title(); ?>
	</p>
<?php endwhile;
?>
<?php 
get_footer();
?>