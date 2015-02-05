<?php

function chicago_citation($post){
  echo the_field('last_name',$post->ID);echo "&#46"; echo the_field('first_name',$post->ID);echo "&#44"; echo "&#34".$post->post_title."&#34 &#44 <i> Common-Place.org </i> &#44"; echo get_the_date("F  j,Y",$post->ID)."&#46";
}

function mla_citation($post){
  echo the_field('last_name',$post->ID);echo "&#46"; echo the_field('first_name',$post->ID);echo "&#44"; echo "&#34".$post->post_title."&#34 &#44 <i> Common-Place.org </i> &#44"; echo get_the_date("F  j,Y",$post->ID)."&#46";
}

?>
