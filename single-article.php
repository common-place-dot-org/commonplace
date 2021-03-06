<?php
/**
 * The template for displaying all single articles.
 *
 * @package gazette
 */

get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main article-view" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
		
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<ol class="breadcrumb">
						<li>
							<?php 
								$thisPost = get_the_ID();
								echo get_the_term_list($thisPost, 'issue');
								echo ' ';
								$terms = get_the_terms($post->ID,'issue');
									foreach ($terms as $term) {
									echo "$term->description";
								}
							?>
						</li>
						<li>
							<?php echo get_the_term_list($thisPost, 'column'); ?>
						</li>
					</ol>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<p><?php the_field('author_prefix');?> <?php the_field('author_first_name');?> <?php the_field('author_last_name');?> <?php the_field('author_suffix');?>
						<?php
							$other_authors = get_field('additional_authors',$post->ID);
							if ($other_authors){
								echo ', '.$other_authors;
							}?>
					</p>
				</header><!-- .entry-header -->
				<div class="entry-excerpt">
					<div class="well">
						<?php the_excerpt();?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->
					</div>
				</div>		
			</article><!-- #post-## -->
			
		<?php endwhile; // end of the loop. ?>
	<div id="author-info">
		<p>
			<strong>About <?php  
							echo the_field('author_first_name',$post->ID);
							echo ' ';
							echo the_field('author_last_name',$post->ID); ?>
							</strong> <br/><span><?php echo the_field('author_bio',$post->ID) ?></span>
		</p>
	</div>
	<div id="citation">
	<h2>Chicago Citation</h2>
	<p><?php chicago_citation(get_post()); ?> </p>
	
	<?php 
	$topics = get_the_terms($post->ID,'topic');
	
	if ($topics){
		echo '<p id="topics">Topic Tags: ';
		foreach ($topics as $topic) {
			//echo "$topic->name";	
			//echo "$topic->slug";
			$url = get_bloginfo('url');
			echo '<a href="'.$url.'/book/topic/'.$topic->slug.'">'.$topic->name.'</a> ';
		}
		echo '</p>';
	}
	
	?>
	</div>
	<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
