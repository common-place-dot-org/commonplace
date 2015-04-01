<?php 

/*
*Template Name: Home
* 
*/ 
get_header();

$current_issue=$wpdb->get_var( "SELECT option_value FROM wp_options WHERE option_name='current_issue'");

$features_args=array(
			'post_type'=>'article',
			'post_status'      => 'publish',
			'tax_query'		   => array(
									'relation'=>'AND',
									array(
										'taxonomy'=>'issue',
										'field'=>'name',
										'terms'=>$current_issue,
										),
									array(
										'taxonomy'=>'column',
										'field'=>'name',
										'terms'=>'Features',
									)
			)
		);
		
$features_query = new WP_Query($features_args);
$features_count = $features_query->found_posts;

$roundtable_args=array(
		'post_type'=>'article',
		'post_status'      => 'publish',
		'tax_query'		   => array(
								'relation'=>'AND',
								array(
									'taxonomy'=>'issue',
									'field'=>'name',
									'terms'=>$current_issue,
									),
								array(
									'taxonomy'=>'column',
									'field'=>'name',
									'terms'=>'Roundtable',
								)
		)
	);
		
$roundtables_query = new WP_Query($roundtable_args);
$roundtables_count = $roundtables_query->found_posts;

?>
<div class="container"> 

<?php 
//If there are <3 features 
if($features_count<=3){
	//Round tables are present
	 if($roundtables_count>0){ ?>
		<div class="row">
			<div class="col-sm-6">
				<section id="features">
					<h2>Features</h2>
					<?php
					$count=0;
					while ( $features_query->have_posts() ) {
						if($count<=3){
						$features_query->the_post();
						echo '<div class="col-sm-12">';
						echo '<article>';
						if ( has_post_thumbnail() ) {
							the_post_thumbnail(array(150,150));
						} 
						echo '<h3 class="article-title">'.get_the_title()."</h3>";
						echo '<div class="article-excerpt">'.get_the_excerpt()."</div>";
						echo '</article>';
						echo '</div>';
						$count++;
						}
						else{
							$query->the_post();
						}
					}
					wp_reset_postdata();
					?>
				</section>
			</div>
			<div class="col-sm-6">
				<section id="features">
					<h2>Roundtables</h2>
					<?php
					$count=0;
					while ( $roundtables_query->have_posts() ) {
						$roundtables_query->the_post();
						if($count==0){
							echo '<div class="col-sm-12">';
							echo '<article>';
							if ( has_post_thumbnail() ) {
								the_post_thumbnail(array(150,150));
							} 
							echo '<h3 class="article-title">'.get_the_title()."</h3>";
							echo '<div class="article-excerpt">'.get_the_excerpt()."</div>";
							echo '</article>';
							echo '</div>';
							$count++;
						}
						else{
							echo '<div class="col-sm-12">';
							echo '<article>';
							echo '<h3 class="article-title">'.get_the_title()."</h3>";
							//Use this line to get the author// echo '<div class="article-excerpt">'.get_the_excerpt()."</div>";
							echo '</article>';
							echo '</div>';
							$count++;
						}
					}
					wp_reset_postdata();
					?>
				</section>
			</div>
		</div>
		<?php
	}
	else{ ?>
			<div class="row">
			<section id="features">
			<h2>Features</h2>
			<?php
			$count=0;
			while ( $features_query->have_posts() ) {
				if($count<=3){
				$features_query->the_post();
				echo '<div class="col-sm-4">';
				echo '<article>';
				if ( has_post_thumbnail() ) {
					the_post_thumbnail(array(150,150));
				} 
				echo '<h3 class="article-title">'.get_the_title()."</h3>";
				echo '<div class="article-excerpt">'.get_the_excerpt()."</div>";
				echo '</article>';
				echo '</div>';
				$count++;
				}
				else{
					$query->the_post();
				}
			}
			wp_reset_postdata();
			?>
			</section>
		</div>
	
	<?php
  }
}
else if(3<$features_count || $features_count<=6){
  if($roundtables_count>0){ ?>
    <div class="row">
		<div class="col-sm-8">
			<section id="features">
				<h2>Features</h2>
				<?php
				$count=0;
				echo "<div class='col-sm-6'>";
				while ( $features_query->have_posts() ) {
					if($count<=3){
					$features_query->the_post();
					echo '<div class="col-sm-6">';
					echo '<article>';
					if ( has_post_thumbnail() ) {
						the_post_thumbnail(array(150,150));
					} 
					echo '<h3 class="article-title">'.get_the_title()."</h3>";
					echo '<div class="article-excerpt">'.get_the_excerpt()."</div>";
					echo '</article>';
					echo '</div>';
					$count++;
					}
					else{
						$query->the_post();
					}
				}
				echo "</div>";
				$count=0;
				echo "<div class='col-sm-6'>";
				while ( $features_query->have_posts() ) {
					if($count>3){
					$features_query->the_post();
					echo '<div class="col-sm-4">';
					echo '<article>';
					if ( has_post_thumbnail() ) {
						the_post_thumbnail(array(150,150));
					} 
					echo '<h3 class="article-title">'.get_the_title()."</h3>";
					echo '<div class="article-excerpt">'.get_the_excerpt()."</div>";
					echo '</article>';
					echo '</div>';
					$count++;
					}
					else{
						$query->the_post();
					}
				}
				echo "</div>";
				wp_reset_postdata();
				?>
			</section>
		</div>
		<div class="col-sm-4">
			<section id="features">
				<h2>Roundtables</h2>
				<?php
				$count=0;
				while ( $roundtables_query->have_posts() ) {
					$roundtables_query->the_post();
					if($count==0){
						echo '<div class="col-sm-12">';
						echo '<article>';
						if ( has_post_thumbnail() ) {
							the_post_thumbnail(array(150,150));
						} 
						echo '<h3 class="article-title">'.get_the_title()."</h3>";
						echo '<div class="article-excerpt">'.get_the_excerpt()."</div>";
						echo '</article>';
						echo '</div>';
						$count++;
					}
					else{
						echo '<div class="col-sm-12">';
						echo '<article>';
						echo '<h3 class="article-title">'.get_the_title()."</h3>";
						//Use this line to get the author// echo '<div class="article-excerpt">'.get_the_excerpt()."</div>";
						echo '</article>';
						echo '</div>';
						$count++;
					}
				}
				wp_reset_postdata();
				?>
			</section>
		</div>
	</div>
	
	<?php
  }
  else{ ?>
    <div class="row">
		<section id="features">
		<h2>Features</h2>
		<?php
		$count=0;
		while ( $features_query->have_posts() ) {
			$features_query->the_post();
			echo '<div class="col-sm-6">';
			echo '<article>';
			if ( has_post_thumbnail() ) {
				the_post_thumbnail(array(150,150));
			} 
			echo '<h3 class="article-title">'.get_the_title()."</h3>";
			echo '<div class="article-excerpt">'.get_the_excerpt()."</div>";
			echo '</article>';
			echo '</div>';
			$count++;
			}
		wp_reset_postdata();
		?>
		</section>
	</div>
	<?php
  }
}
  else{
    if($roundtables_count>0){
      echo "featured >7 with round";
    }
    else{
      echo "featured >7";
    }
  }?>
  </div> <!-- End of Container -->
  
  <?php get_footer();?>
