<?php
$before_h1 = get_field( 'before_h1' ); ?>
<style>
h1:first-of-type::before {
	content: "<?php echo $before_h1 ?>";
	display: block;
	line-height: 1.2;
	font-size: 0.6em;
}
</style>
<!-- Start of layouts -->
<?php if (have_rows('content_blocks')): ?>
	<?php $blockCount = 1;
	while (have_rows('content_blocks')) : the_row(); ?>


<?php if ( get_row_layout() == 'carousel_results' ) : ?>
	<?php if ( have_rows( 'results_items' ) ) : ?>
	<section class="results-block block-padding block-margin bg-second">
		<div class="container-fluid container-fluid--margin">
			<div class="row">
				<div class="col-12 col-xx-10 offset-xx-1">
					<div class="swiper-button-prev" data-aos="slide-right">
						<div class="swiper-icon swiper-icon--prev">
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								 viewBox="0 0 89 22" style="enable-background:new 0 0 89 22;" xml:space="preserve">
							<polygon class="st0" points="12,9.5 12,0 0,11 12,22 12,12.5 89,12.5 89,9.5 "/>
							</svg>
						</div>
						Prev
					</div>
					<div class="results-carousel pb-5" data-aos="fade" data-aos-duration="800">
						<div class="swiper-wrapper">
							<?php while ( have_rows( 'results_items' ) ) :
								the_row();
								$dollar_amount = get_sub_field( 'dollar_amount' );
								$description = get_sub_field( 'description' ); ?>

							<div class="swiper-slide">
								<div class="review__item">
									<div class="review__dollar"><?php echo esc_html( $dollar_amount ); ?></div>
									<div class="review__desc">
										<?php echo esc_html( $description ); ?>
									</div>
								</div>
							</div>
							<?php endwhile; ?>

						</div>
					</div>
					<div class="swiper-button-next" data-aos="slide-left">
						<div class="swiper-icon swiper-icon--next">
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								 viewBox="0 0 89 22" style="enable-background:new 0 0 89 22;" xml:space="preserve">
							<polygon class="st0" points="89,11 77,0 77,9.5 0,9.5 0,12.5 77,12.5 77,22 "/>
							</svg>
						</div>
						Next
					</div>
					<div class="text-center pt-5 pt-md-0 mt-5">
						<a href="<?php echo get_post_type_archive_link( 'results' ); ?>" class="btn">View All Recent Case Results</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>
<?php endif; ?>


	<?php if ( get_row_layout() == 'content_block' ) :
		$layout = get_sub_field( 'layout' );
		$flip = get_sub_field( 'flip' );
		$blockClass = get_sub_field( 'developer_styles' );
		$headlineTag = get_sub_field( 'headline_tag' );
		$headlineClass = get_sub_field( 'headline_class' );
		$headlineTxt = get_sub_field( 'headline_text' );
		$contentClass = get_sub_field( 'content_class' );
		$content = get_sub_field( 'content' );
		$btnClass = get_sub_field( 'button_class' );
		$btnTxt = get_sub_field( 'button_text' );
		$btnUrl = get_sub_field( 'button_url' );
		$image = get_sub_field( 'image' );
		$imageLg = get_sub_field( 'image_lg' ); ?>
		<?php if($layout == 'default' && $image) { ?>
			<style>
			<?php echo '.content-block-'.$blockCount.'.content-block--'.$layout; ?> {
				background-image: url("<?php echo esc_url( $image['url'] ); ?>");
				background-size: cover;
			}
			<?php if($imageLg) { ?>
				@media (min-width: 992px) {
					<?php echo '.content-block-'.$blockCount.'.content-block--'.$layout; ?> {
						background-image: url("<?php echo esc_url( $imageLg ); ?>");
					}
				}
				<?php } ?>
				</style>
			<?php } ?>
			<section class="content-block <?php echo 'content-block-'.$blockCount.' content-block--'.$layout.' '; if($blockClass){ echo $blockClass; } if($flip == 1 && $layout == 'offset') { echo ' content-block--'.$layout.'--right';} ?>" >
				<div class="container-fluid container--margin">
					<div class="row">
						<?php if($layout == 'default') {
							$align = get_sub_field( 'default_align' ); ?>
							<div class="col-lg-4 offset-xx-1" data-aos="fade" data-aos-easing="ease-in-out-quad">
							<?php
							if ($headlineTxt) {
								echo '<'.$headlineTag.' class="headline content-block__headline '.$headlineClass.'">'.$headlineTxt.'</'.$headlineTag.'>';
							}
							if ($btnTxt && $btnUrl) {
								echo '<a class="btn d-none d-lg-inline-block mt-5 '.$btnClass.'" href="'.$btnUrl.'">'.$btnTxt.'<span class="sr-only"> about '. $headlineTxt.'</span></a>';
							}
							?>
						</div>
						<div class="col-lg offset-xl-1 col-xx-5" data-aos="slide-left" data-aos-easing="ease-in-out-quad">
							<?php
							if ($content) {
								echo '<div class="content-block__content '.$contentClass.'">'.$content.'</div>';
							}
							if ($btnTxt && $btnUrl) {
								echo '<a class="btn d-lg-none mt-5 '.$btnClass.'" href="'.$btnUrl.'">'.$btnTxt.'<span class="sr-only"> about '. $headlineTxt.'</span></a>';
							}
							?>
						</div>
					<?php } elseif($layout == 'card') { ?>
						<div class="col-12 col-xx-10 offset-xx-1">
							<div class="content-card" data-aos="slide-up" data-aos-duration="900">
								<figure class="content-card__img">
									<picture>
										<source media="(min-width: 992px)" srcset="<?php echo esc_url( $imageLg ); ?>">

										<img src="<?php echo esc_url( $image['url'] ); ?>" alt="" role="presentation" />
									</picture>
								</figure>
								<div class="content-card__body">
									<?php
									if ($headlineTxt) {
										echo '<'.$headlineTag.' class="headline content-block__headline '.$headlineClass.'">'.$headlineTxt.'</'.$headlineTag.'>';
									}
									if ($content) {
										echo '<div class="content-block__content '.$contentClass.'">'.$content.'</div>';
									}
									if ($btnTxt && $btnUrl) {
										echo '<a class="btn mt-5 '.$btnClass.'" href="'.$btnUrl.'">'.$btnTxt.'<span class="sr-only"> about '. $headlineTxt.'</span></a>';
									}
									?>
								</div>
							</div>
						</div>
					<?php } elseif($layout == 'overlap') { ?>
						<div class="<?php if($flip == 0) { echo 'col-lg-8 col-xl-6'; } else { echo 'col-lg-8 offset-lg-4 offset-xl-6 col-xl-6'; } ?>">
							<div class="content-overlap__content <?php if($flip == 1) { echo 'content-overlap__content--left'; } ?>">
								<?php
								if ($headlineTxt) {
									echo '<'.$headlineTag.' class="headline content-block__headline '.$headlineClass.'">'.$headlineTxt.'</'.$headlineTag.'>';
								}
								if ($content) {
									echo '<div class="content-block__content '.$contentClass.'">'.$content.'</div>';
								}
								if ($btnTxt && $btnUrl) {
									echo '<a class="btn btn--overlap mt-5 '.$btnClass.'" href="'.$btnUrl.'">'.$btnTxt.'</a>';
								}
								?>
							</div>
						</div>
					<?php } elseif($layout == 'alter') { ?>
						<div class="<?php if($flip == 1) { echo 'col-lg-6 offset-lg-1 col-xx-5'; } else { echo 'col-lg-6 col-xx-5 offset-xx-1'; } ?>">
							<div class="<?php echo $contentClass ?>">
								<?php
								if ($headlineTxt) {
									echo '<'.$headlineTag.' class="headline content-block__headline '.$headlineClass.'">'.$headlineTxt.'</'.$headlineTag.'>';
								}
								if ($content) {
									echo '<div class="content-block__content">'.$content.'</div>';
								}
								if ($btnTxt && $btnUrl) {
									echo '<a class="btn mt-5 '.$btnClass.'" href="'.$btnUrl.'"><span class="sr-only">'.$headlineTxt.' </span>'.$btnTxt.'</a>';
								}
								?>
							</div>
						</div>
						<div class="<?php if($flip == 1) { echo 'col-lg-5 col-xx-4 offset-xx-1 order-first'; } else { echo 'col-lg-5 offset-lg-1 col-xx-4 text-center order-first order-lg-0'; } ?>">
							<?php
							$image = get_sub_field( 'image' );
							if ( $image ) { ?>
								<figure class="alternating__figure" data-aos="slide-up">
									<picture>
										<?php if($imageLg) { ?>
											<source media="(min-width: 992px)" srcset="<?php echo $imageLg; ?>">
											<?php } ?>
											<img class="alternating__img" loading="lazy" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
										</picture>
									</figure>
								<?php } ?>
							</div>

						<?php } elseif($layout == 'list') {
							$list_description = get_sub_field( 'list_description' ); ?>
							<div class="<?php { echo 'col-lg-6 col-xx-5 offset-xx-1'; } ?>">
								<div class="<?php echo $contentClass ?>">
									<?php
									if ($headlineTxt) {
										echo '<'.$headlineTag.' class="headline content-block__headline '.$headlineClass.'">'.$headlineTxt.'</'.$headlineTag.'>';
									}
									if ($content) {
										echo '<div class="content-block__content">'.$content.'</div>';
									}
									if ($btnTxt && $btnUrl) {
										echo '<a class="btn mt-5 '.$btnClass.'" href="'.$btnUrl.'">'.$btnTxt.'</a>';
									}
									?>
								</div>
							</div>
							<div class="<?php { echo 'col-lg-5 offset-lg-1 col-xx-4 '; } ?>" data-aos="slide-left">
								<div class="mb-5 font-header f5 f4-xx">
									<?php echo $list_description; ?>
								</div>
								<?php if ( have_rows( 'list_items' ) ) : ?>
									<div class="service-list">
									<?php while ( have_rows( 'list_items' ) ) :
										the_row();
										$icon = get_sub_field('icon' );
										$text = get_sub_field( 'text' );
										$url = get_sub_field( 'url' ); ?>
										<div class="service-list__item">
											<div class="service-list__icon">
												<?php echo $icon; ?>
											</div>
											<?php if($url) {
												echo '<a class="service-list__text" href="'.$url.'">'.$text.'</a>';
											} else {
												echo '<div class="service-list__text">'.$text.'</div>';
											} ?>
										</div>
									<?php endwhile; ?>
									</div>
								<?php endif; ?>
							</div>

						<?php } elseif($layout == 'half') { ?>
							<div class="<?php if($flip == 1) { echo 'col-lg-6 offset-lg-1'; } else { echo 'col-lg-6'; } ?>">
								<div class="content__half-description <?php echo $contentClass; ?>">
									<!-- Section headline  -->
									<div class="content__half-headline content__half-headline content__half-headline--left">
										<?php
										if ($headlineTxt) {
											echo '<'.$headlineTag.' class="headline content-block__headline '.$headlineClass.'">'.$headlineTxt.'</'.$headlineTag.'>';
										} ?>
									</div>
									<?php if ($content) {
										echo '<div class="content-block__content">'.$content.'</div>';
									}
									if ($btnTxt && $btnUrl) {
										echo '<a class="btn mt-5 '.$btnClass.'" href="'.$btnUrl.'">'.$btnTxt.'</a>';
									} ?>
								</div>
							</div>
							<div class="<?php if($flip == 1) { echo 'col-lg-5 order-first'; } else { echo 'col-lg-5 offset-lg-1 order-first order-lg-0 '; } ?>">
								<figure class="content__half-img-figure  <?php if($flip == 1) { echo 'content__half-img-figure--left'; } else { echo 'content__half-img-figure--right'; } ?>">
									<picture>
										<?php if($imageLg) { ?>
											<source media="(min-width: 992px)" srcset="<?php echo $imageLg; ?>">
											<?php } ?>
											<img class="content__half-img <?php if($flip == 1) { echo 'content__half-img--left'; } else { echo 'content__half-img--right '; } ?>" loading="lazy" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
										</picture>
									</figure>
								</div>
							<?php } elseif($layout == 'offset') { ?>
								<div class="<?php if($flip == 1) { echo 'col-lg-6 offset-lg-1'; } else { echo 'col-lg-6';}?>">
									<?php
									if ($headlineTxt) {
										echo '<'.$headlineTag.' class="headline content-block__headline '.$headlineClass.'">'.$headlineTxt.'</'.$headlineTag.'>';
									} ?>
									<div class="content__half-description">
										<?php if ($content) {
											echo '<div class="content-block__content '.$contentClass.'">'.$content.'</div>';
										}
										if ($btnTxt && $btnUrl) {
											echo '<a class="btn mt-5 '.$btnClass.'" href="'.$btnUrl.'">'.$btnTxt.'</a>';
										}
										?>
									</div>
								</div>
								<div class="<?php if($flip == 1) { echo 'col-lg-5 order-first'; } else { echo 'col-lg-5 offset-lg-1 order-first order-lg-0'; } ?>">
									<figure class="overlay-bg__figure mb-lg-0">
										<picture>
											<?php if($imageLg) { ?>
												<source media="(min-width: 992px)" srcset="<?php echo $imageLg; ?>">
												<?php } ?>
												<img loading="lazy" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
											</picture>
										</figure>
									</div>
								<?php } ?>
							</div>
						</div>
						<?php if($layout == 'overlap') { ?>
							<!-- This image only shows in the overlay layout -->
							<figure class="content-overlap__figure <?php if($flip == 1) { echo 'content-overlap__figure--left'; } ?>">
								<picture>
									<?php if($imageLg) { ?>
										<source media="(min-width: 992px)" srcset="<?php echo $imageLg; ?>">
										<?php } ?>
										<img class="content-overlap__img" loading="lazy" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
									</picture>
								</figure>
							<?php } ?>
						</section>
					<?php endif; ?>


<?php if ( get_row_layout() == 'carousel_team' ) : ?>
	<section class="team-block block-margin" data-aos="slide-left" data-aos-duration="950" data-aos-easing="ease-out">
		<div class="container-fluid container--margin">
			<div class="row">
				<div class="col-12 col-xx-10 offset-xx-1">
					<div class="headline f2 f1-xl d6-xx">Meet the Team Behind Our Success</div>
					<div id="carouselTeam" class="carousel carousel-block slide carousel-equalize" data-ride="carousel" data-interval="false">
						<div class="carousel-inner pb-xl-5">
							<?php
							// the query
							$team_query = new WP_Query( array (
								'post_type' => 'team', // Display just this post type
								'posts_per_page' => 4, // Display x posts per page ( use -1 for all posts )
								'orderby'=> 'menu_order date',
								'order'=> 'ASC'
							)
						);
						if ($team_query->have_posts()) {
							$teamCount ++;
							while ($team_query->have_posts()) {
								$team_query->the_post();
								if (1 == $teamCount) {
									echo '<div class="carousel-item active"><div class="team-grid">';
								} elseif ( 5 == $teamCount || 9 == $teamCount ) {
									echo '<div class="carousel-item"><div class="team-grid">';
								}?>
								<div class="team-grid__item">
									<?php get_template_part( 'template-parts/content', 'bio_thumb' ); ?>
								</div>
								<?php
								if ( (0 == $teamCount % 4) || ($team_query->current_post +1) == ($team_query->post_count) ) {
									echo '</div></div>';
								}
								$teamCount ++;
							}
							wp_reset_postdata();
						}	?>
					</div> <!-- close carousel-inner -->
					<div class="row mt-5">
						<div class="col-12 d-flex justify-content-between align-items-center">
							<div class="carousel-indicators position-relative ">
								<?php
								if($teamCount > 5) { ?>
								<button data-target="#carouselTeam" data-slide-to="0" class="carousel-pager active">1</button>
								<button data-target="#carouselTeam" data-slide-to="1" class="carousel-pager">2</button>
								<?php } if($teamCount > 9) { ?>
								<button data-target="#carouselTeam" data-slide-to="2" class="carousel-pager">3</button>
								<?php } ?>
							</div>
							<a href="<?php echo get_post_type_archive_link( 'team' ); ?>" class="btn">View Entire Team</a>
						</div>
					</div>
				</div> <!-- close carouselTeam -->
			</div><!-- close column -->
		</div>
	</div>
	</section>
<?php endif; ?>

				<?php if ( get_row_layout() == 'blog-feed-grid' ) : ?>
				<!-- Blog grid layout -->
				<section class="blog-block block-margin" data-aos="slide-left" data-aos-duration="950" data-aos-easing="ease-out">
					<div class="container-fluid container--margin">
						<div class="row">
							<div class="col-12 col-xx-10 offset-xx-1">
								<div class="headline f2 f1-xl d6-xx">Recent Blog Posts</div>
								<div id="carouselPosts" class="carousel carousel-block slide carousel-equalize mb-xl-5" data-ride="carousel" data-interval="false">
									<div class="carousel-inner pb-xl-5">
								<?php
								// the query
								$post_query = new WP_Query( array (
									'post_type' => 'post', // Display just this post type
									'posts_per_page' => 9, // Display x posts per page ( use -1 for all posts )
								)
							);
							if ($post_query->have_posts()) {
								$postCount ++;
								while ($post_query->have_posts()) {
									$post_query->the_post();
									if (1 == $postCount) {
										echo '<div class="carousel-item active"><div class="post-feed__posts">';
									} elseif ( 1 == $postCount || 4 == $postCount || 7 == $postCount ) {
										echo '<div class="carousel-item"><div class="post-feed__posts">';
									} ?>
									<div class="post-feed__item">
										<a href="<?php the_permalink(); ?>" class="post-feed__post-title font-header f4 f3-lg">
											<?php the_title(); ?>
										</a>
										<div class="post-feed__excerpt">
											<?php
											$postExcerpt = excerpt(45);
											echo strip_tags($postExcerpt, '<p><br>');
											?>
										</div>
										<a href="<?php the_permalink(); ?>" class="post-feed__read-more">
											<span class="sr-only"><?php the_title(); ?> </span>Read More
										</a>
									</div>
									<?php if ( (0 == $postCount % 3) || ($post_query->current_post +1) == ($post_query->post_count) ) {
										echo '</div></div>';
									}
									$postCount ++;
								}
								wp_reset_postdata();
							} ?>
						</div> <!-- close carousel-inner -->
						<div class="row mt-5">
							<div class="col-12 d-flex justify-content-between align-items-center">
								<div class="carousel-indicators position-relative ">
									<?php if($postCount > 4) { ?>
									<button data-target="#carouselPosts" data-slide-to="0" class="carousel-pager active">1</button>
									<button data-target="#carouselPosts" data-slide-to="1" class="carousel-pager">2</button>
								<?php } if($postCount > 7) { ?>
									<button data-target="#carouselPosts" data-slide-to="2" class="carousel-pager">3</button>
									<?php } ?>
								</div>
								<a href="/blog" class="btn">View All Blog Posts</a>
							</div>
						</div>
					</div> <!-- close carouselPosts -->
						</div>
					</div>
				</div>
				</section>
				<?php endif; ?>



				<?php if ( get_row_layout() == 'firm_badges_awards-carousel' ) : ?>
					<!-- Firm badge carousel -->
					<section class="content-block <?php the_sub_field( 'developer_styles' ); ?>">
						<div class="container-fluid container--margin">
							<div class="row">
								<div class="col-12 col-xx-10 offset-xx-1">
									<div id="carouselBadges" class="carousel slide" data-ride="carousel" data-interval="false">
										<div class="carousel-inner">
											<?php if ( have_rows( 'firm-badges-slide' ) ) : ?>
												<?php
												$badgeSlideCount = 1;
												while ( have_rows( 'firm-badges-slide' ) ) : the_row(); ?>
												<div class="carousel-item carousel-item-<?php echo $badgeSlideCount; if ($badgeSlideCount == 1) : ?> active<?php endif; ?>">
													<div class="badge-row justify-content-center justify-content-lg-between">
														<?php if ( have_rows( 'firm_badges-row' ) ) : ?>
															<?php
															$badgeCount = 1;
															while ( have_rows( 'firm_badges-row' ) ) : the_row(); ?>
															<?php
															$badges_img = get_sub_field( 'badges-img' );
															$badges_img2x = get_sub_field( 'badges-img_2x' );
															$badges_code = get_sub_field( 'badges-code' );
															$badgeLink = get_sub_field( 'badge_url' );
															$badgeTiming = $badgeCount * 50 + 100;

															if ( !empty( $badgeLink ) && empty( $badges_img2x ) ) {
																echo '<figure data-aos="fade" data-aos-delay="'.$badgeTiming.'" class="badge-row__item-'.$badgeCount.'">
																<a class="d-inline-block" href="'.$badgeLink.'" target="_blank">
																<img src="' . $badges_img[ 'url' ] . '" alt="' . $badges_img[ 'alt' ] . '" /></a>
																</figure>';
															} elseif ( !empty( $badgeLink ) && !empty( $badges_img2x ) ) {
																echo '<figure data-aos="fade" data-aos-delay="'.$badgeTiming.'" class="badge-row__item-'.$badgeCount.'">
																<a class="d-inline-block" href="'.$badgeLink.'" target="_blank">
																<img src="' . $badges_img[ 'url' ] . '" srcset="'. $badges_img2x .' 2x" loading="lazy" alt="' . $badges_img[ 'alt' ] . '" /></a>
																</figure>';
															} elseif ( !empty( $badges_img ) && empty($badges_img2x) ) {
																echo '<figure data-aos="fade" data-aos-delay="'.$badgeTiming.'" class="badge-row__item-'.$badgeCount.'"><img src="' . $badges_img[ 'url' ] . '" alt="' . $badges_img[ 'alt' ] . '" /></figure>';
															} elseif ( !empty( $badges_img2x ) ) {
																echo '<figure data-aos="fade" data-aos-delay="'.$badgeTiming.'" class="badge-row__item-'.$badgeCount.'"><img src="' . $badges_img[ 'url' ] . '" srcset="'. $badges_img2x .' 2x" loading="lazy" alt="' . $badges_img[ 'alt' ] . '" /></figure>';
															} else {
																echo '<figure data-aos="fade" data-aos-delay="'.$badgeTiming.'" class="badge-row__item-'.$badgeCount.'">' . $badges_code . '</figure>';
															}
															?>
															<?php
															$badgeCount ++;
														endwhile; ?>
													<?php endif; ?>
												</div>
											</div>
											<?php
											$badgeSlideCount ++;
										endwhile; ?>
									<?php endif; ?>
								</div>
								<?php if ( have_rows( 'firm-badges-slide' ) ) : ?>
									<div class="carousel-indicators position-relative mt-3">
										<?php
										$badgePagerCount = 0;
										while ( have_rows( 'firm-badges-slide' ) ) : the_row(); ?>
										<?php
										if($badgePagerCount > 0) {
										if ($badgePagerCount == 0) : ?>
											<button class="carousel-pager active" data-target="#carouselBadges" data-slide-to="0" tabindex="0"></button>
										<?php else : ?>
											<button class="carousel-pager" data-target="#carouselBadges" data-slide-to="<?php echo $badgePagerCount; ?>" tabindex="0"></button>
										<?php endif; } ?>
										<?php
										$badgePagerCount++;
									endwhile; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>



	<?php
	$blockCount ++;
endwhile; ?>
<?php endif; ?>
