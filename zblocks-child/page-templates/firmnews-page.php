<?php
/*
Template Name: Firm News Page
*/

get_header(); ?>

<section id="primary" class="content-area col-sm-12 col-lg-8">
	<main id="main" class="site-main review-page-template" role="main">
		<article>

			<?php // News & Media only page
			/*$temp = $wp_query;
			$wp_query= null;*/
			$wp_query = new WP_Query(); $wp_query->query('cat=15&posts_per_page=10' . '&paged='.$paged);
			while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="blog-page__post">
					<?php
					// Must be inside a loop.

					if ( has_post_thumbnail() ) {
						echo  '<figure class="post-thumbnail">' . the_post_thumbnail() . '</figure>';
					}
					?>
					<header class="entry-header">
						<?php
						if ( is_front_page() ) :
							the_title( '<h1 class="entry-title h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" style="text-decoration: none;">', '</a></h1>' );
							else :
								the_title( '<h1 class="entry-title h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" style="text-decoration: none;">', '</a></h1>' );
							endif;

							if ( 'post' === get_post_type() ) : ?>
							<div class="entry-meta">
								<?php wp_bootstrap_starter_posted_on(); ?>
							</div><!-- .entry-meta -->
							<?php
						endif; ?>
					</header><!-- .entry-header -->
					<?php
					if( 'video' === get_post_type() ) { ?>
						<?php get_template_part( 'template-parts/content', 'video-iframe' ); ?>
					<?php } ?>
					<div class="entry-content">
						<p class="blog-page__excerpt"><?php echo excerpt(55); ?></p>

						<?php
						$content = apply_filters( 'the_content', get_the_content() ); // Stores the_content in $content
						$word_count = str_word_count( strip_tags( $content ) ); // Counts the words in $content
						if($word_count > 55) { ?>
							<a href="<?php echo get_permalink(); ?>" rel="bookmark" style="text-decoration: none;" class="blog__read-more f5">Continue reading&mldr;</a>
						<?php } ?>
					</div><!-- .entry-content -->

				</div>
			</article><!-- #post-## -->
		<?php endwhile; ?>

		<?php if ( $wp_query->max_num_pages > 1 ) { ?>
			<nav class="pagination pagination--custom-post" role="navigation">
				<div class="pagination__link"><?php next_posts_link( '&larr; Older' ); ?></div>
				<div class="pagination__link"><?php previous_posts_link( 'Newer &rarr;' ); ?></div>
			</nav>
		<?php } ?>

		<?php wp_reset_postdata(); ?>

	</article>

</main><!-- #main -->
</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
