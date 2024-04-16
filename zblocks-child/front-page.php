<?php
/**
* The main template file
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package WP_Bootstrap_Starter
*/

get_header();

// AOS Include
	$detect = new Mobile_Detect;
	if ( $detect->isMobile() ) {
	// silence is golden
	} else {
		// get_template_part( 'template-parts/aos-include' );
	}
?>

<style>
/* Swiper CSS include */
<?php get_template_part( 'template-parts/swiper_css-include' ); ?>
</style>

<section id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<!-- Content Blocks  -->
				<?php get_template_part( 'layout-blocks/content-blocks' ); ?>

				<section class="contact-block" id="contact">
					<div class="container-fluid container--margin">
						<div class="row">
							<div class="col-lg-6 col-xx-5 offset-xx-1 mb-5 mb-lg-0" data-aos="slide-right" data-aos-easing="ease-in-out" data-aos-duration="650" >
								<div class="contact-block__contact-info">
									<div class="headline f4 f3-xl color-white">
										You did not choose to become entangled in the justice system. We can help.
									</div>
									<div class="contact-block__location">
										<div class="contact-block__contact-item contact-block__contact-item--address">
											<?php get_template_part( 'template-parts/content-address-full' ); ?>
										</div>
										<div class="contact-block__contact-item contact-block__contact-item--tel">
											<?php
											$tel = get_field( 'firm_phone', 'option' );

											echo '<a class="contact-block--split__tel" href="tel:' . $tel . '"><span itemprop="telephone" content="' . $tel . '"><span class="sr-only">Call our office </span>' . $tel . '</span></a>'
											?>
										</div>
										<div class="contact-block__contact-item contact-block__contact-item--fax">
											<a href="tel:<?php the_field( 'firm_fax', 'option' ); ?>"><?php the_field( 'firm_fax', 'option' ); ?></a>
										</div>
									</div>
									<?php if ( have_rows( 'add_loctions_repeater', 'option' )) : ?>
										<?php while ( have_rows( 'add_loctions_repeater', 'option' ) ) : the_row();
										$street = get_sub_field( 'firm-address_street' );
          				  $city = get_sub_field( 'firm-address_city' );
          				  $state = get_sub_field( 'firm-address_state' );
          				  $zip = get_sub_field( 'firm-address_zip' );
										$tel = get_sub_field( 'firm_phone' );?>
											<div class="contact-block__location">
												<div class="contact-block__contact-item contact-block__contact-item--address">
													<?php echo '<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			          				  <span itemprop="streetAddress">' . $street . '</span><br/>
			          				  <span itemprop="addressLocality">' . $city . '</span>,
			          				  <span itemprop="addressRegion">' . $state . '</span>
			          				  <span itemprop="postalCode">' . $zip . '</span></span>';
			          				?>
												</div>

												<div class="contact-block__contact-item contact-block__contact-item--tel">
													<?php echo '<a class="contact-block--split__tel" href="tel:' . $tel . '"><span itemprop="telephone" content="' . $tel . '"><span class="sr-only">Call our office </span>' . $tel . '</span></a>'; ?>
												</div>

												<div class="contact-block__contact-item contact-block__contact-item--fax"><a href="tel:<?php the_sub_field( 'firm_fax', 'option' ); ?>"><?php the_sub_field( 'firm_fax', 'option' ); ?></a></div>
											</div>
										<?php endwhile; ?>
									<?php endif; ?>
								</div>
							</div>
							<div class="col-lg-6 col-xx-5" data-aos="slide-left" data-aos-easing="ease-in-out" data-aos-duration="650" >
								<div class="contact-block__form-container">
									<div class="mb-3 headline f2 f1-xl d6-xx color-white">Contact Us Today</div>
									<div class="gravity-form-home">
										<?php gravity_form(1, false, false, false, '', true); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<!-- .entry-content -->
		</article><!-- #post-## -->
	</main><!-- #main -->
</section><!-- #primary -->





<?php
//get_sidebar();
get_footer();
