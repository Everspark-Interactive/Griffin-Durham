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
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="blog-page__post">
				<header class="entry-header">
					<?php
						the_title( '<h1 class="entry-title h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" style="text-decoration: none;">', '</a></h1>' );?>
					<div class="entry-meta">
						<?php wp_bootstrap_starter_posted_on(); ?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->
				<div class="entry-content">
					<div class="gallery-content">
						<?php
				    // Must be inside a loop.
				    if ( has_post_thumbnail() ) { ?>
				        <figure class="post-thumbnail">
									<?php the_post_thumbnail( 'medium_large' ); ?>
								</figure>
				    <?php } elseif ( have_rows( 'gallery_img' ) ) { ?>
							<?php
							$count = 1;
							while ( have_rows( 'gallery_img' ) ) : the_row(); ?>
								<?php $image = get_sub_field( 'image' ); ?>
								<?php if ( $image && 1 == $count) { ?>
									<a href="<?php echo get_permalink(); ?>" style="text-decoration: none;">
									<figure class="post-thumbnail">
										<picture>
											<source media="(min-width: 992px)" srcset="<?php echo $image['sizes']['medium_large']; ?>">
												<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" />
										</picture>
									</figure>
									</a>
								<?php } ?>
							<?php
							$count ++;
							endwhile; ?>
						<?php } ?>
						<?php the_content(); ?>
						<a href="<?php echo get_permalink(); ?>" style="text-decoration: none;" class="blog__read-more blog__read-more--gallery f5">View image gallery</a>
					</div>

				</div><!-- .entry-content -->
				</div>
			</article><!-- #post-## -->

			<?php endwhile;

			the_posts_navigation();

		else :
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
