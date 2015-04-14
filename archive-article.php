<?php
/**
 * The template for displaying archive pages... of articles!
 *
 * Learn more: http://codex.wordpress.org/Post_Type_Templates
 */

get_header(); ?>
<style>
.beautiful-taxonomy-filters-button{
	background-color:#800924;
}
.beautiful-taxonomy-filters-button:hover{
	background-color:#67081E;
}
</style>
<header class="page-header">
<h1 class="page-title"></h1>
<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php if(function_exists('show_beautiful_filters')){ show_beautiful_filters(); } ?>
		<?php if ( have_posts() ) : ?>
    <h4>
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'commonplace' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'commonplace' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'commonplace' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'commonplace' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'commonplace' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'commonplace' ) ) . '</span>' );

						else :
							_e( 'Archives', 'commonplace' );

						endif;
					?>
				</h4>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<h5 class="taxonomy-description">%s</h5>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->

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
			<?php while ( have_posts() ) : the_post(); ?>
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

			<?php endwhile; ?>
			</tbody></table>
			<?php commonplace_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif;wp_reset_postdata(); ?>

		</main><!-- #main -->
	</section><!-- #primary -->
<br><br>
<script>
jQuery(window).load(function() {
		jQuery(".beautiful-taxonomy-filters-tax filter-count-3").css("color", "red");
});
</script>
<?php get_footer(); ?>
