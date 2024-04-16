<?php
/**
 * The template for displaying a single bio
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Bootstrap_Starter
 */

get_header();
$title = get_field( 'attorney_title' );
$directphone = get_field( 'attorney_tel' );
$ext = get_field( 'attorney_ext' );
$cell = get_field('attorney_cell');
$fax = get_field( 'attorney_fax' );
$email = get_field( 'attorney_email' );
$linkedin = get_field( 'attorney_linkedin' );
$vcard = get_field( 'attorney_vcard' );
$postTag = get_field( 'attorney_post_tag' );
?>
<style>
/* Edit in single-team.php file */
	#content.site-content {
		display: flex;
		flex-direction: column;
		flex-grow: 1;
    margin-bottom: 0;
	}
</style>
	<header class="header-single-team">
		<div class="header-single-team__img-container">
			<?php
				$header_vid = get_field( 'image_or_video_hero-bg', 'option'  );
				$hero_video_mobile_image = get_field( 'hero_video_mobile_image', 'option' );
				$hero_image = get_field( 'hero_image', 'option' );
				$smImage = get_field( 'hero_image_sm', 'option' );
				$mdImage = get_field( 'hero_image_md', 'option' );
				$lgImage = get_field( 'hero_image_lg', 'option' );
				$xlImage = get_field( 'hero_image_xl', 'option' );
				$customImg = get_field( 'header_background_image' );
			if( $header_vid == 'vid' ) { ?>
				<img class="header-single-team__img" loading="lazy" src="<?php echo $hero_video_mobile_image['url']; ?>" alt="" role="presentation" />
			<?php } else {
			if($customImg) { ?>
				<img class="header-single-team__img" loading="lazy" src="<?php echo $customImg; ?>" alt="" role="presentation" />
			<?php } else { ?>
				<picture>
					<?php if ( $xlImage ) { ?>
					<!-- xl devices -->
					<source media="(min-width: 1200px)" loading="lazy" srcset="<?php the_field( 'hero_image_xl', 'option' ); ?>">
					<?php } ?>
					<?php if ( $lgImage ) { ?>
					<!-- lg devices -->
					 <source media="(min-width: 992px)" loading="lazy" srcset="<?php the_field( 'hero_image_lg', 'option' ); ?>">
					 <?php } ?>
					 <?php if ( $mdImage ) { ?>
					<!-- md devices -->
					<source media="(min-width: 768px)" loading="lazy" srcset="<?php the_field( 'hero_image_md', 'option' ); ?>">
					<?php } ?>
					<?php if ( $smImage ) { ?>
					<!-- sm devices -->
					<source media="(min-width: 576px)" loading="lazy" srcset="<?php the_field( 'hero_image_sm', 'option' ); ?>">
					<?php } ?>
					<!-- default image -->
					<img class="header-single-team__img" loading="lazy" src="<?php echo $hero_image['url']; ?>" alt="" role="presentation" />
				</picture>
			<?php }
			} ?>
		</div>
		<div class="header-single-team__content">
			<div class="container">
				<div class="row">
					<div class="col-6 offset-3 col-lg-4 offset-lg-0">
						<?php
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
						$thumbnail_id = get_post_thumbnail_id( $post->ID );
						$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
						if($image) { ?>
							<figure class="bio-page__img-figure">
									<img class="bio-page__img" src="<?php echo $image[0]; ?>" alt="<?php echo $alt; ?>" />
							</figure>
						<?php } else { ?>
							<figure class="bio-page__img-figure bio-page__figure--placeholder">
							</figure>
						<?php } ?>

					</div>
					<div class="col-lg-7 offset-lg-1 text-center text-lg-left">
						<header class="bio-page__entry-header">
							<h1 class="bio-page__name mb-4 d6-xl">
								<?php
								the_title();
								if($title) {
									echo '<div class="bio-page__title f7 f6-md f5-xl f4-xx">'.$title.'</div>';
								}
								?>
							</h1>
						</header><!-- .entry-header -->
						<div class="bio-page__contact-info">
							<?php if($directphone || $fax) { ?>
							<div class="bio-page__contact-row">
								<?php
								if($directphone && !$ext)
								{
								echo '<div class="bio-page__contact-item bio-page__contact-item bio-page__tel"><a class="bio-page__link" href="tel:' . $directphone . '"><span itemprop="telephone" content="' . $directphone . '">' . $directphone . '</span></a></div>';
							} elseif ($ext) {
								echo '<div class="bio-page__contact-item bio-page__contact-item bio-page__tel"><a class="bio-page__link" href="tel:' . $directphone . ', '.$ext.'"><span itemprop="telephone" content="' . $directphone . '">' . $directphone . ' ext.'.$ext.'</span></a></div>';
							}
								if(get_field( 'attorney_fax' ))
								{
								echo '<div class="bio-page__contact-item bio-page__fax">' . $fax . '</div>';
								} ?>
							</div>
							<?php } ?>
							<?php if($cell) { ?>
							<div class="bio-page__contact-row">
								<?php if($cell) {
									echo '<div class="bio-page__contact-item bio-page__contact-item bio-page__cell"><a class="bio-page__link" href="tel:' . $cell . '"><span itemprop="telephone" content="' . $cell . '">' . $cell . '</span></a></div>';
								} ?>
							</div>
							<?php } ?>
							<?php if($email || $vcard) { ?>
							<div class="bio-page__contact-row">
								<?php
								if(get_field( 'attorney_email' )) {
								echo '<div class="bio-page__contact-item bio-page__email"><a class="bio-page__link" href="mailto:' . $email . '">' . $email . '</a></div>';
								}
								if(get_field( 'attorney_vcard' )) {
								echo '<div class="bio-page__contact-item bio-page__vcard"><a class="bio-page__link" href="' . $vcard . '">vCard</a></div>';
								}
								?>
							</div>
							<?php } ?>
							<?php if($linkedin) { ?>
							<div class="bio-page__contact-row">
								<?php
								if(get_field( 'attorney_linkedin' )) {
								 echo '<div class="bio-page__contact-item bio-page__linkedin"><a class="bio-page__link" href="' . $linkedin . '" target="_blank">LinkedIn</a></div>';
								 }
								?>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<section id="primary" class="content-area--single-team">
		<main id="main" class="site-main site-main--single-team" role="main">
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		  <div class="container">
			  <div class="row">
				  <div class="col-lg-4 offset-lg-0 order-2 order-lg-0">
					  <aside class="bio-page__sidebar">
							  <div class="bio-page__sidebar-content">
									<?php if ( have_rows( 'atty_sidebar_info' ) ) :
										while ( have_rows( 'atty_sidebar_info' ) ) :
											the_row(); ?>
											<?php if ( get_row_layout() == 'sidebar' ) :
												$title = get_sub_field( 'title' ); ?>
												<div class="bio-page__sidebar-section bio-sidebar-custom-info">
													<div class="h4 mb-3">
														<?php echo esc_html( $title ); ?>
													</div>
													<?php if ( $content = get_sub_field( 'content' ) ) : ?>
														<?php echo $content; ?>
													<?php endif; ?>
												</div>
											<?php endif; ?>
										<?php endwhile;
									endif; ?>

									<?php
											if ( $postTag ) {
												$tagquery = new WP_Query( array (
														'tag' => $postTag,
														'posts_per_page' => 5,
													)
												);
									?>
									<?php if( $postTag && $tagquery->have_posts() ) : ?>
										<div class="sidebar__related-posts bio-page__sidebar-section">
											<div class="h3 mb-3">Recent Posts</div>
												<ul class="sidebar-posts-list nav flex-column">
													<?php while($tagquery->have_posts()) : $tagquery->the_post(); ?>
													<li class="nav-item">
														<a class="nav-link" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
													</li>
													<?php endwhile; ?>
												</ul>
										</div>
									<?php
										endif;
										wp_reset_postdata(); }
										else {
											$the_query = new WP_Query( 'posts_per_page=5' );
											if ( $the_query->have_posts() ) : ?>
											<div class="sidebar__related-posts bio-page__sidebar-section">
												<div class="h3 mb-3">Recent Posts</div>
													<ul class="sidebar-posts-list nav flex-column">
													<?php while ($the_query -> have_posts()) : $the_query -> the_post();
													?>
													<li class="nav-item">
														<a class="nav-link" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
													</li>
													<?php	endwhile; ?>
												</ul>
											</div>
										<?php endif;
										wp_reset_postdata(); } ?>

							  </div>
						</aside>
				  </div>
				  <div class="col-12 col-lg-7 offset-lg-1 content-area">
					  <div class="bio-page__entry-content entry-content">
							<div class="breadcrumbs">
								<?php
								if ( function_exists('yoast_breadcrumb') ) {
									yoast_breadcrumb( '<div id="breadcrumbs">','</div>' );
								}
								?>
							</div>
						<?php the_content();?>
					  <?php if ( have_rows( 'bio_badges-row' ) ) : ?>
						<div class="bio-badges__container">
							<?php while ( have_rows( 'bio_badges-row' ) ) : the_row(); ?>
							  <?php $bio_badges_img = get_sub_field( 'bio_badges-img' ); ?>
							  <div class="bio-badges__item">
							  <?php if ( $bio_badges_img ) { ?>
								<img src="<?php echo $bio_badges_img['url']; ?>" alt="<?php echo $bio_badges_img['alt']; ?>" />
							  <?php } ?>
							  <?php the_sub_field( 'bio_badges-code' ); ?>
							</div>
							<?php endwhile; ?>
						</div>
					  <?php endif; ?>

						  <?php if ( have_rows( 'attorney-bio__accordions' ) ) : ?>
							<?php while ( have_rows( 'attorney-bio__accordions' ) ) : the_row(); ?>
							  <details class="content-block__accordion">
							  <?php
								echo '<summary class="content-block__accordion-title headline">' . get_sub_field('attorney-bio__accordions-title' , 'option' ) . '</summary>';
								?>
								<div class="content-block__accordion-description">
								  <?php the_sub_field( 'attorney-bio__accordions-desc' ); ?>
								</div>
							  </details>
							<?php endwhile; ?>
						<?php endif; ?>
					</div><!-- .entry-content -->
				  </div>
			  </div>
		  </div>

      </article><!-- #post-## -->
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
