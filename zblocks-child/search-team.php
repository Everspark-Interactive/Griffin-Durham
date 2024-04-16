<?php
/* Team custom search */


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

			<?php	endwhile;
			the_posts_navigation();?>

		<?php	else : ?>
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'wp-bootstrap-starter' ); ?></h1>
			</header><!-- .page-header -->
			<p><?php esc_html_e( 'Sorry, but no team members matched your search terms. Please try again with some different keywords.', 'wp-bootstrap-starter' ); ?></p>
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label><span class="accessible-hide">Search team members</span>
					<input type="hidden" name="post_type" value="bio" />
						<input type="search" class="search-field form-control" placeholder="Search team members …" value="" name="s" title="Search for:">
				</label>
				<input type="submit" class="search-submit btn btn-default" value="Search">
			</form>
	</div>
	<?php	endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
