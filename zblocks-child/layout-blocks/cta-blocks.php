<?php
$developer_styles = get_field( 'cta_developer_styles' );
$containerFluid = get_field( 'cta_fluid_container' );
if ( have_rows( 'cta_blocks' ) ): ?>
<section class="cta-block <?php echo $developer_styles ?>">
	<div class="<?php if($containerFluid == 0){echo 'container';} else {echo 'container-fluid container--margin';}?>">
		<div class="row">
			<div class="col-12">
				<map title="Featured Pages" id="feat-pages_links">
					<?php while ( have_rows( 'cta_blocks' ) ) : the_row(); ?>
						<?php if ( get_row_layout() == 'cta-block-portrait' ) : ?>
							<!-- Cta Portait imgs -->

							<!-- Section headline  -->
							<?php get_template_part( 'template-parts/headline-options' ); ?>
							<div class="cta-block--portrait__row d-flex flex-wrap flex-lg-nowrap justify-content-center justify-content-md-between align-items-center align-items-md-baseline">
								<?php if ( have_rows( 'cta_repeater' ) ) : ?>
									<?php while ( have_rows( 'cta_repeater' ) ) : the_row(); ?>
										<a href="<?php the_sub_field( 'link_url' ); ?>" class="cta-portrait__link <?php the_sub_field( 'link_classes' ); ?>" <?php the_sub_field( 'data_attributes' ); ?>>
											<figure class="cta-portrait__figure">
												<?php $image = get_sub_field( 'image' ); ?>
												<img class="cta-portrait__img" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
											</figure>
											<div class="cta-portrait__txt f5-lg"><?php the_sub_field( 'button_text' ); ?></div>
										</a>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>

						<?php endif; ?>

						<?php if ( get_row_layout() == 'cta-img-btn-block' ) : ?>
							<!-- CTA Image buttons -->

							<div class="cta-img-btn-container d-flex flex-wrap flex-lg-nowrap justify-content-center">
								<?php if ( have_rows( 'cta_img_btn_repeater' ) ) : ?>
									<?php while ( have_rows( 'cta_img_btn_repeater' ) ) : the_row(); ?>
										<a href="<?php the_sub_field( 'link_url' ); ?>" class="cta-img-btn <?php the_sub_field( 'link_classes' ); ?>" <?php the_sub_field( 'data_attributes' ); ?>>
											<figure class="cta-img-btn__img-fig">
												<?php $image = get_sub_field( 'image' );
												if ( $image ) { ?>
													<img class="cta-img-btn__img" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
												<?php } ?>
												<!--<div class="cta-img-btn__ico"><?php the_sub_field( 'icon' ); ?></div>-->
											</figure>
											<div class="cta-img-btn__txt"><?php the_sub_field( 'button_text' ); ?></div>
										</a>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>

						<?php endif; ?>

						<?php if (get_row_layout() == 'cta') : ?>
							<!-- Call to action buttons -->

							<div class="content-block-cta__row d-flex justify-content-center justify-content-xl-between flex-wrap flex-xl-nowrap">
								<?php if (have_rows('cta-item')) : ?>
									<?php while (have_rows('cta-item')) : the_row(); ?>

										<?php
										$ctaStyle = get_sub_field('cta-style');
										?>
										<a class="content-block-cta__link" href="<?php the_sub_field('cta-link'); ?>" <?php the_sub_field( 'data_attributes' ); ?>>

											<figure class="content-block-cta__graphic">
												<?php if ($ctaStyle == 'img'): ?>
													<div class="content-block-cta__ico">
														<img class="content-block-cta__img" src="<?php the_sub_field('cta-img'); ?>" alt="<?php the_sub_field('cta-description'); ?>"/>
													</div>
												<?php elseif ($ctaStyle == 'ico'): ?>
													<div class="content-block-cta__ico d5 d3-sm d5-md">
														<?php the_sub_field('cta-icon'); ?>
													</div>
												<?php elseif ($ctaStyle == 'svg'): ?>
													<div class="content-block-cta__ico">
														<?php the_sub_field( 'svg_icon' ); ?>
													</div>
												<?php endif; ?>
											</figure>

											<div class="content-block-cta__txt f5">
												<?php the_sub_field('cta-description'); ?>
											</div>
										</a>

									<?php endwhile; ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<?php if (get_row_layout() == 'cta-tall') : ?>
							<?php if (have_rows('call_to_action_tall_with_icon')) : ?>
								<div class="content-block-cta-tall__row d-flex justify-content-between flex-wrap flex-lg-nowrap">
									<?php
									$ctaCount = 0;
									while (have_rows('call_to_action_tall_with_icon')) : the_row(); ?>
									<a class="cta-tall-ico" href="<?php the_sub_field('cta-tall-link'); ?>" <?php the_sub_field( 'data_attributes' ); ?>>
										<div class="cta-tall__container">
											<div class="cta-tall__content">
												<div class="cta-tall-ico__icon f1 d6-md d3-xl d2-xl d1-xx">
													<?php the_sub_field('cta-tall-ico'); ?>
												</div>
												<div class="content-block-cta-tall__txt f5 f4-xl">
													<?php the_sub_field('cta-tall-txt'); ?>
												</div>
											</div>
										</div>
									</a>
									<?php
									$ctaCount ++;
								endwhile; ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>

					<?php if (get_row_layout() == 'cta-grid') : ?>
						<!-- Gradient square grid -->
						<?php if (have_rows('cta-grid-item')) : ?>
							<div class="content-block-sq-grid__layout">
								<?php while (have_rows('cta-grid-item')) : the_row(); ?>
									<a class="content-block-sq-grid__link" href="<?php the_sub_field('cta-grid-link'); ?>" <?php the_sub_field( 'data_attributes' ); ?>>
										<?php if (get_sub_field('cta-grid-img')) {
											$cta_grid_img = get_sub_field( 'cta-grid-img' );
											?>
											<figure class="content-block-sq-grid__figure">
												<img class="cta-service-grid__img content-block-sq-grid__img lazyloaded" src="<?php echo $cta_grid_img['url']; ?>" alt="<?php echo $cta_grid_img['alt']; ?>"/>
											</figure>
											<?php }	?>
										<div class="content-block-sq-grid__txt-container">
											<div class="content-block-sq-grid__txt f7 f6-md f4-xx">
												<?php the_sub_field('cta-grid-description'); ?>
											</div>
										</div>
									</a>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				<?php endwhile; ?>
			</map>
		</div>
	</div>
</div>
</section>
<?php endif; ?>
