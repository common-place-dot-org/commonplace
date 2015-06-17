<?php

function chicago_citation($post){
	$author_first 			= get_field('author_first_name',$post->ID);
	
	$author_last			= get_field('author_last_name',$post->ID);
	$additional_authors	= get_field('additional_authors',$post->ID);
	$book_title			= get_field('book_title',$post->ID);
	$book_author			= get_field('book_author',$post->ID);
	$issue 					= get_the_term_list($thisPost, 'issue');
	$issue					= str_replace('Vol.', '', $issue);
	$issue					= str_replace(' N', ', n', $issue);
	
	if (!$additional_authors){
		// if there's only one author, remove any periods from the name (middle initials)
		$author_first 			= str_replace('.', '', $author_first);
	}
	
	echo $author_last .', '. $author_first;
	
	if ($additional_authors){
		echo ', '.$additional_authors;
	}
	
	echo '.';
	
	echo ' "'.$post->post_title.'."';
	
	if ($book_title && $book_author){
		echo ' Review of <em>'.$book_title.' by '.$book_author.'.</em>';		
	}
	
	echo ' <em>Common-place.org.</em> '; 
	
	echo ' '.$issue.' ';
	
	$terms2 = get_the_terms($post->ID,'issue');
		foreach ($terms2 as $term2) {
		echo ' ('.$term2->description.'). ';
	};
	
	echo get_permalink();
}

?>