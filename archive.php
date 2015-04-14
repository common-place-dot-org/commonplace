<?php
/**
 * The template for displaying archive pages.
 *Template Name: Archive
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package commonplace
 */
$args=array(
			'post_type'=>'article',
			'post_status'      => 'publish'
		);

get_header();

$args = array(
			'posts_per_page'   => 20,
			'orderby'          => 'menu_order',
			'order'            => 'DESC',
			'post_type'        => 'article',
			'post_status'      => 'publish');

$my_query = new WP_Query( $args );

?>


<style>
.beautiful-taxonomy-filters-button{
	background-color:#800924;
}
.beautiful-taxonomy-filters-button:hover{
	background-color:#67081E;
}
.beautiful-taxonomy-filters-label {text-transform: capitalize;}


</style>
		<section id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

		  <?php echo show_beautiful_filters('article');
			if ( $my_query->have_posts() ) {?>
				<h4> Most recent articles </h4>
				<table class="table table-responsive">
					<thead>
					<tr>
						<th>Issue</th>
						<th>Title</th>
						<th>Column</th>
						<th>Author</th>
					</tr>
					</thead>
					<tbody>

			<?php
				while ( $my_query->have_posts() ) {
					$my_query->the_post();?>
					<tr>
								<td>
									<?php $issues=get_the_terms($post->ID,'issue');
									foreach($issues as $issue){
										echo "<p>".$issue->name."</p>";
									}
									?>
								</td>
								<td><a href="<?php the_permalink(); ?>"><?php the_title();?></a></td>
									<td><?php $issues=get_the_terms($post->ID,'column');
								foreach($issues as $issue){
									echo "<p>".$issue->name."</p>";
								}
								?></td>
								<td><?php the_field('author_first_name');?> <?php the_field('author_last_name');?></td>
							</tr>
				
				<?php
				}?>
				</tbody>
				</table>
				<?php 

			}
			wp_reset_postdata();?>



			</main><!-- .site-main -->
		</section><!-- .content-area -->

	<?php get_footer(); ?>
