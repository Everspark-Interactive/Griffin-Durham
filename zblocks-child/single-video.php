<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

	<section id="primary" class="content-area block-margin col-sm-12 col-xl-10">
		<main id="main" class="site-main" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php get_template_part( 'template-parts/content', 'video-iframe' ); ?>

				<header class="entry-header">
					<?php
					if ( is_single() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;

					// change post to video to show post date below title
					if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php wp_bootstrap_starter_posted_on(); ?>
					</div><!-- .entry-meta -->
					<?php
					endif; ?>
				</header><!-- .entry-header -->
				<div class="entry-content">
					<?php
			        if ( is_single() ) :
						the_content();
			        else :
			            the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wp-bootstrap-starter' ) );
			        endif;

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-starter' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<?php wp_bootstrap_starter_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			</article><!-- #post-## -->

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar();
get_footer();
