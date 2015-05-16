<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$s = bsearch_clean_terms( apply_filters( 'the_search_query', get_search_query() ) );
get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<?php $form = get_bsearch_form( $s );
					echo $form;	?>
					<header class="page-header">
						<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</header>
					<?php echo get_bsearch_results( $s, $limit ); ?>
					<?php echo $form;	?>
				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
		<div class="col-sm-4">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>