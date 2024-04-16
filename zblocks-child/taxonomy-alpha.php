<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

	<section id="primary" class="content-area col-12">
		<main id="main" class="site-main" role="main">
      <?php
		if ( have_posts() ) : ?>


	<?php get_template_part( 'template-parts/content', 'bio_search' ); ?>

<div class="team-grid">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'template-parts/content', 'bio_thumb' ); ?>

			<?php endwhile;
			the_posts_navigation();?>
</div>
		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
