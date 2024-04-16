<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>
<style>
/* styles in archive-verdict.php file */
	#content.site-content {
		margin-bottom: 0;
	}
</style>
	<section id="primary" class="content-area block-margin">
		<main id="main" class="site-main" role="main">
			<?php
		if ( have_posts() ) : ?>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h1 class="d6-xl text-center">Case Results</h1>

				<div class="success-grid mb-5">
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();
          $content = apply_filters( 'the_content', get_the_content() ); // Stores the_content in $content
          $word_count = str_word_count( strip_tags( $content ) ); // Counts the words in $content ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('success-grid__item'); ?>>
						<header class="entry-header">
							<?php
								$dollarAmount = get_field( 'success_dollar_amount' );
								if ($dollarAmount) {
									echo '<div class="success-item__dollar">'. $dollarAmount .'</div>';
									the_title( '<h2 class="success-item__title f5">', '</h2>' );
								} else {
									the_title( '<h2 class="success-item__dollar">', '</h2>' );
								}
								 ?>
						</header><!-- .entry-header -->
						<div class="success__excerpt <?php if($word_count > 55) { echo 'mb-4'; } ?>">
							<?php the_excerpt(); ?>
						</div><!-- .entry-content -->
						<?php if($word_count > 55) { ?>
						<button type="button" class="btn btn--success mt-auto align-self-center f7" data-toggle="modal" data-target="#modal<?php the_ID(); ?>">
						  Read More
						</button>
						<!-- Modal -->
						<div class="results__modal modal fade" id="modal<?php the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="More about the result" aria-hidden="true">
							<div class="results__modal-dialog modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
									<h5 class="modal-title" id="modalLabel<?php the_ID(); ?>"><?php the_title(); ?></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									</div>
									<div class="modal-body text-left f7 f6-md f5-xl">
									<?php the_content(); ?>
									</div>
									<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>


					</article><!-- #post-## -->
					<?php endwhile; ?>
				</div>
				<?php if ( $wp_query->max_num_pages > 1 ) { ?>
  <nav class="pagination pagination--custom-post" role="navigation">
    <div class="pagination__link"><?php next_posts_link( '&larr; Older' ); ?></div>
    <div class="pagination__link"><?php previous_posts_link( 'Newer &rarr;' ); ?></div>
  </nav>
<?php } ?>
			<?php endif; ?>

			<div class="review-page-disclaimer f7"><em>Prior results do not guarantee a similar outcome.</em></div>
		</div>
	</div>
</div>





		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
