<?php
/**
 * Template Name: teams
**/
/**
* The template for displaying archive pages
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package WP_Bootstrap_Starter
*/


get_header(); ?>
<section id="primary" class="container-fluid container--margin testclasss1">
	<main id="main" class="site-main row" role="main">
		<div class="col-12 col-xx-10 offset-xx-1">
			<?php
			if ( have_posts() ) : ?>
			<?php get_template_part( 'template-parts/content', 'bio_search' ); ?>
			<div class="team-grid">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'bio_thumb' ); ?>
			<?php endwhile;?>
		</div>
	<?php endif; ?>
</div>

</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
