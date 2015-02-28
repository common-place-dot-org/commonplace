<?php
/**
 * The template for displaying archive pages... of articles!
 *
 * Learn more: http://codex.wordpress.org/Post_Type_Templates
 */

get_header(); ?>
<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
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
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->
			
			<table>
				<tr>
					<th>Issue</th>
					<th>Title</th>
					<th>Column</th>
					<th>Author</th>
				</tr>
			<?php while ( have_posts() ) : the_post(); ?>
				<tr>
					<td>is#</td>
					<td><?php the_title();?></td>
					<td>col</td>
					<td><?php the_field('author_first_name');?> <?php the_field('author_last_name');?></td>
				</tr>
			<?php endwhile; ?>
			</table>
			<?php commonplace_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
