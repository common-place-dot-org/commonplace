<?php
/**
 * The template for displaying all single articles.
 *
 * @package gazette
 */

get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-meta">
						Issue:
						<?php
							$thisPost = get_the_ID();
							echo get_the_term_list($thisPost, 'issue');
							echo ' : ';
							$terms = get_the_terms($post->ID,'issue');
								foreach ($terms as $term) {
								echo "$term->description";
							}
						?>
						<p><?php the_field('author_prefix');?> <?php the_field('author_first_name');?> <?php the_field('author_last_name');?> <?php the_field('author_suffix');?></p>
						<hr/>					
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->
				<div class="entry-excerpt">
					<div class="well">
						<?php the_excerpt();?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->
					</div>
					<div class="col-sm-6">
						x
					</div>
				</div>		
			</article><!-- #post-## -->
			
		<?php endwhile; // end of the loop. ?>
	
	<h1>Chicago Citation</h1>
	<p><?php chicago_citation(get_post()); ?> </p>
	
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
