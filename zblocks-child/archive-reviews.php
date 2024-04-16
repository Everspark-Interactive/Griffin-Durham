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
	<main id="main" class="site-main review-page-template" role="main">
		<?php
		if ( have_posts() ) : ?>
		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="blog-page__post reivew-item" itemprop="review" itemscope itemtype="http://schema.org/Review">
				<span class="sr-only" itemprop="itemReviewed" itemscope itemtype="https://schema.org/LegalService">
					<img itemprop="image" src="<?php $firm_logo = get_field( 'firm_logo', 'option' ); echo $firm_logo['url']; ?>" alt="<?php the_field( 'firm_name', 'option' ); ?>"/>
					<span itemprop="name"><?php the_field( 'firm_name', 'option' ); ?></span>
					<span itemprop="telephone"><?php the_field( 'firm_phone', 'option' ); ?></span>
					<span itemprop="address"><?php the_field( 'firm-address_street', 'option' ); ?> <?php the_field( 'firm-address_city', 'option' ); ?>, <?php the_field( 'firm-address_state', 'option' ); ?></span>
				</span>
				<meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>">
				<header class="entry-header">
					<?php
					the_title( '<h1 class="f3">', '</h1>' );
					if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php wp_bootstrap_starter_posted_on(); ?>
					</div><!-- .entry-meta -->
					<?php
				endif; ?>
			</header><!-- .entry-header -->
			<div class="entry-content review-item__desc" itemprop="description">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
			<?php
			$author = get_field('review-author');
			if($author) { ?>
				<span class="d-block text-right" itemprop="author">&mdash; <?php echo $author; ?></span>
			<?php } else { echo '<span itemprop="author" itemscope itemtype="https://schema.org/Person" class="sr-only"><span itemprop="name">Client</span></span>'; } ?>
			</div>
		</article>
	<?php endwhile; ?>
	<?php if ( $wp_query->max_num_pages > 1 ) { ?>
		<nav class="pagination pagination--custom-post" role="navigation">
			<div class="pagination__link"><?php next_posts_link( '&larr; Older' ); ?></div>
			<div class="pagination__link"><?php previous_posts_link( 'Newer &rarr;' ); ?></div>
		</nav>
	<?php } ?>
<?php endif; ?>
<div class="review-page-disclaimer f7"><em>Prior results do not guarantee a similar outcome.</em></div>
</main><!-- #main -->
</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
