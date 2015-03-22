<?php

// The Query
$the_query = get_post(9);

		echo '<h1>' . $the_query->post_title() . '</h1>';
		echo '<br>';
		echo '<p>'.$the_query->post_content().'</p>';

?>