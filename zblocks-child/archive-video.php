<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

	<section id="primary" class="content-area col-sm-12 col-lg-8">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="blog-page__post">
					<?php get_template_part( 'template-parts/content', 'video-iframe' ); ?>
				<header class="entry-header">
					<?php
						the_title( '<h1 class="entry-title h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" style="text-decoration: none;">', '</a></h1>' );
					// change post to video to show post date below title
					if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php wp_bootstrap_starter_posted_on(); ?>
					</div><!-- .entry-meta -->
					<?php
					endif; ?>
				</header><!-- .entry-header -->
				<?php
					$content = get_the_content();
					if($content) { ?>
						<div class="entry-content mt-4">
							<?php the_excerpt(); ?>
							<a href="<?php echo get_permalink(); ?>" rel="bookmark" style="text-decoration: none;" class="blog__read-more f5">View full description&mldr;</a>
						</div><!-- .entry-content -->
					<?php } ?>

				</div>
			</article><!-- #post-## -->

		<?php endwhile; ?>
		<?php if ( $wp_query->max_num_pages > 1 ) { ?>
			<nav class="pagination pagination--custom-post" role="navigation">
				<div class="pagination__link"><?php next_posts_link( '&larr; Older' ); ?></div>
				<div class="pagination__link"><?php previous_posts_link( 'Newer &rarr;' ); ?></div>
			</nav>
		<?php } ?>
	<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
