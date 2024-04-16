<?php
$header_theme = get_field( 'hero_style', 'option' );
$tel = get_field( 'firm_phone', 'option' );
$email = get_field( 'firm_email', 'option' );
$displayLoc = get_field( 'display_city_state', 'option' );
$displayConsult = get_field( 'free_consult_tel', 'option' );
?>

<div class="header-container layer-1 <?php the_field( 'developer_styles', 'option' ); ?>">

  <header role="banner" class="header-block header-half">
    <div class="container-fluid container--margin py-3 py-md-5 pb-xl-0">
      <div class="row align-items-start justify-content-center justify-content-md-between">
        <div class="<?php if( is_front_page() ) { echo "col-6 col-sm-4 col-xl-3 col-xx-2";} else{ echo "col-8 col-sm-4 col-xx-3";}?>">
          <!-- Hero logo -->
          <?php get_template_part( 'block-parts/hero-logo' ); ?>
        </div>
        <div class="col-7 col-sm col-lg-8 col-xl-7 offset-xl-1 d-none d-md-block">
          <div class="row">
            <div class="col-12">
              <div class="header-contact-row mb-3 mb-xl-0 mt-xl-3">
               <div class="header-contact-row__item flex-wrap justify-content-end text-right">
                  <address class="header__address header__address--multi f9 f8-lg f5-xx flex-grow-1 w-100">
                    <?php get_template_part( 'block-parts/content-address-city_state' ); ?>
                  </address>
                  <a class="header__tel d-none d-md-inline-block f6 f5-lg f3-xx" href="tel:<?php the_field( 'firm_phone', 'option' ); ?>"><span itemprop="telephone" content="<?php the_field( 'firm_phone', 'option' ); ?>"><span class="sr-only">Call our office </span><?php the_field( 'firm_phone', 'option' ); ?></span></a>
                </div>

                  <?php if ( have_rows( 'add_loctions_repeater', 'option' ) ) : ?>
                    <?php while ( have_rows( 'add_loctions_repeater', 'option' ) ) : the_row(); ?>
                      <div class="header-contact-row__item flex-wrap justify-content-end text-right">
                      <address class="header__address header__address--multi f9 f8-lg f5-xx flex-grow-1 w-100">
                        <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                          <span itemprop="addressLocality">
                          <?php the_sub_field( 'firm-address_city' ); ?>,</span>
                          <span itemprop="addressRegion">
                            <?php the_sub_field( 'firm-address_state' ); ?></span>
                        </span>
                      </address>
                      <a class="header__tel d-none d-md-inline-block f6 f5-lg f3-xx" href="tel:<?php the_sub_field( 'firm_phone' ); ?>"><span itemprop="telephone" content="<?php the_sub_field( 'firm_phone' ); ?>"><span class="sr-only">Call our office </span><?php the_sub_field( 'firm_phone' ); ?></span></a>
                      </div>
                    <?php endwhile; ?>
                  <?php endif; ?>
              </div>
            </div>
            <div class="col-12">
              <div class="header-<?php echo $header_theme; ?>-menu">
                <!-- Main menu -->
                <?php get_template_part( 'template-parts/content','menu' ); ?>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </header>


  <?php if ( is_front_page() || is_page_template('zblocks-page.php') ) :
    $header_theme = get_field( 'hero_style', 'option' );
    $header_vid = get_field( 'image_or_video_hero-bg', 'option'  );
    $sloganVert = get_field( 'slogan_vertical', 'options' );
    $sloganHorz = get_field( 'slogan_horizontal', 'options' );
    $sloganVert_md = get_field( 'slogan_vertical_md', 'options' );
    $sloganHorz_md = get_field( 'slogan_horizontal_md', 'options' ); ?>

    <div class="header__bg-container header-half-bg mt-5 mt-lg-0">
      <div class="container-fluid container--margin">
        <div class="row align-items-center">
          <div class="col-lg-6 col-xx-6 offset-xx-1">
            <?php get_template_part( 'template-parts/content', 'slogan' ); ?>
          </div>
          <div class="col-lg-6 col-xx-5 order-first order-lg-0 mb-5 mb-lg-0">
            <div data-aos="slide-left" data-aos-duration="900">
              <?php get_template_part( 'header-blocks/header-hero-img' ); ?>
            </div>
          </div>
        </div>
      </div>


    </div>
  <?php endif; ?>
</div>
