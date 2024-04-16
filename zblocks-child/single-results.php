<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>
<section id="primary" class="content-area col-sm-12 col-lg-8">
	<main id="main" class="site-main review-page-template" role="main">
<article id="post-<?php the_ID(); ?>" <?php post_class('success-grid__item'); ?>>
	<div class="entry-content">
						<header class="entry-header">
							<?php
								$dollarAmount = get_field( 'success_dollar_amount' );
								if ($dollarAmount) {
									echo '<div class="success-item__dollar">'. $dollarAmount .'</div>';
								} else {
									echo '<div class="success-item__dollar"><i class="fad fa-award"></i></div>';
								}
								the_title( '<h1 class="success-item__title f5">', '</h1>' ); ?>
						</header><!-- .entry-header -->
						<div class="success__excerpt">
							<?php the_content(); ?>
						</div><!-- .entry-content -->
						<a href="<?php echo get_post_type_archive_link( 'results' ); ?>" class="btn mt-5">View All Verdicts</a>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
<div class="review-page-disclaimer f7"><em>Prior results do not guarantee a similar outcome.</em></div>
</main><!-- #main -->
</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
