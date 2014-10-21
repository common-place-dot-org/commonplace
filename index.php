<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package commonplace
 */

get_header(); ?>
<h1>Index.php</h1>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
						<!-- Issue and Article Query  -->
						<h1> Issue List </h1>
						<?php
								$args = array(
									'post_type' => 'issue',
									'tax-query' => array(
										'taxonomy'=> 'Themes',
										'field'=>'slug'
										)
								);
								$issues=new WP_Query($args);
								if($issues->have_posts()){
									while($issues->have_posts()){
										$issues->the_post();
										$volume = get_post_meta( get_the_ID(), 'volume', true );
										$theVolume = get_field("volume");
										?>
										<h3><?php the_title() ?> </h3>
										<div class="volume-number">
											<p><?php echo $volume." ".$theVolume ?></p>
										</div><?php
									}

								}
								else{
									echo "There are no volumes";
								}
								?>

								<?php
										$args = array(
											'post_type' => 'article'
										);
										$articles=new WP_Query($args);
										if($articles->have_posts()){
											while($articles->have_posts()){
												$articles->the_post();
												$volume = array(get_post_meta( get_the_ID(), 'authors', true ));
												$theVolume = get_field("authors");
												$s;
												?>
												<h3><?php the_title() ?> </h3>
												<div class="volume-number">
													<p><?php foreach($theVolume as $user){
																		$s= $user['user_firstname']." ".$user['user_lastname'];
																		if($user!==end($theVolume)){
																			$s.=", ";
																		}
																echo $s;
															};
															?></p>
												</div><?php
											}

										}
										else{
											echo "There are no volumes";
										}
										?>

									<?php commonplace_paging_nav(); ?>

								<?php else : ?>

									<?php get_template_part( 'content', 'none' ); ?>

								<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
