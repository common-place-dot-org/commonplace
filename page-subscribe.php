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
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'commonplace' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		</article><!-- #post-## -->
	<?php endwhile; // end of the loop. ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-4">
		<h2>Email Subs</h2>
		<h2>Social Media</h2>
		<?php 
			if (wp_get_nav_menu_object('Social Media')){
				$defaults = array(
					'menu'			=> 'Social Media',
					'container'       => false,
					'items_wrap'      => '<ul id="%1$s" class="%2$s nav nav-pills">%3$s</ul>',
					'depth'			=> 1,
					'fallback_cb'		=> false
				);
				wp_nav_menu( $defaults );
			}
		?>
	</div>
	<div class="col-sm-8">
		<h2>RSS Feeds</h2>
		<p>Master Feed</p>
		<h3>Topic Feeds</h3>
		<ul>
		<?php 
		$topics = get_terms( 'topic');
		foreach ($topics as $topic) {
			echo '<li><a href="'.get_bloginfo(url) .'/'.$topic->slug.'">'.$topic->name.'</a></li>';
		}
		?>
		</ul>
		<h3>Column Feeds</h3>
		<?php 
		$columns = get_terms( 'column');
		foreach ($columns as $column) {
			echo $column->name;
			echo $column->slug;
		}
		?>
	</div>
</div>

<?php 
get_footer();
?>