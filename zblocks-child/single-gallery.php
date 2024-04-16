<?php
/**
* Template part for displaying posts
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package WP_Bootstrap_Starter
*/

get_header(); ?>

<section id="primary" class="content-area col-12">
	<main id="main" class="site-main review-page-template" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php
					// Must be inside a loop.
					if ( has_post_thumbnail() ) {
						echo  '<figure class="post-thumbnail">' . the_post_thumbnail() . '</figure>';
					}
					?>
					<header class="entry-header">
						<?php
						if ( is_single() ) :
							the_title( '<h1 class="entry-title">', '</h1>' );
							else :
								the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
							endif;

							if ( 'post' === get_post_type() ) : ?>
							<div class="entry-meta">
								<?php wp_bootstrap_starter_posted_on(); ?>
							</div><!-- .entry-meta -->
							<?php
						endif; ?>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<?php	the_content(); ?>
					</div><!-- .entry-content -->

			<div class="gallery-grid">
				<?php if ( have_rows( 'gallery_img' ) ) : ?>
					<?php
					$galleryCount = 1;
					while ( have_rows( 'gallery_img' ) ) : the_row();
					$image = get_sub_field( 'image' );
					if($image) {?>
						<button class="gallery-grid__item" type="button" data-toggle="modal" data-target="#modal<?php the_ID(); echo $galleryCount; ?>">
							<img class="gallery-grid__img" loading="lazy" src="<?php echo $image['sizes']['medium'] ; ?>" alt="<?php echo $image['alt']; ?>" />
							<?php //the_sub_field( 'caption' ); ?>
						</button>
						<!-- Modal -->
						<div class="gallery-modal modal fade" id="modal<?php the_ID(); echo $galleryCount; ?>" tabindex="-1" role="dialog" aria-labelledby="More about the result" aria-hidden="true">
							<div class="gallery-modal__dialog modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									</div>
									<div class="modal-body">
										<img loading="lazy" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
										<?php if ( $caption = get_sub_field( 'caption' ) ) : ?>
											<div class="mt-5">
												<?php echo $caption; ?>
											</div>
										<?php endif; ?>
									</div>
									<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					<?php
					}
					$galleryCount ++;
					endwhile; ?>
				<?php endif; ?>
			</div>
		</article><!-- #post-## -->
	</main><!-- #main -->
</section><!-- #primary -->



<?php
get_footer();
