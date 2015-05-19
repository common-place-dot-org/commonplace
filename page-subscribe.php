<?php
/*

This page will display all the articles from a specified column. 

*/
/*
Template Name: Subscribe
*/

get_header();

?>
<div class="row">
	<div class="col-sm-12">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
		
			<div class="entry-content">
				<div class="row">
					<div class="col-sm-4">
						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'commonplace' ),
								'after'  => '</div>',
							) );
						?>
					</div>
					<div class="col-sm-8">
						<h2>RSS Feeds</h2>  
						<ul>
							<li><a href="<?php get_bloginfo(url); ?>/feed/">Common-place Master Feed</a> All articles, as soon as they're published.</li>
						</ul>
						<div class="row">
							<div class="col-sm-6">
								<h3>Topic Feeds</h3>
								<ul>
								<?php 
								$topics = get_terms( 'topic');
								foreach ($topics as $topic) {
									echo '<li><a href="'.get_bloginfo(url) .'/topic/'.$topic->slug.'/feed">'.$topic->name.'</a></li>';
								}
								?>
								</ul>
							</div>
							<div class="col-sm-6">
								<h3>Column Feeds</h3>
								<ul>
								<?php 
								$columns = get_terms( 'column');
								foreach ($columns as $column) {
									echo '<li><a href="'.get_bloginfo(url) .'/column/'.$column->slug.'/feed">'.$column->name.'</a></li>';
								}
								?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div><!-- .entry-content -->
		</article><!-- #post-## -->
	<?php endwhile; // end of the loop. ?>
	</div>
</div>


<?php 
get_footer();
?>