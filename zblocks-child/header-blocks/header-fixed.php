<div id="headerStuck" class="fixed d-none d-md-block layer-4">
  <header role="banner" class="header-block header-block--fixed py-4 bg-white">
      <div class="container-fluid container--margin">
        <div class="row align-items-center justify-content-sm-center justify-content-md-between">
          <?php if ( get_field( 'header_mutli_location', 'option' ) == 1 ) : ?>
            <!-- Multiple locations layout -->
            <div class="col-6 offset-3 col-sm-5 offset-sm-0 col-md-4 col-xl-2">
              <!-- Hero fixed logo -->
              <?php get_template_part( 'block-parts/hero_fixed-logo' ); ?>
            </div>
            <div class="col-12 col-sm-8 d-none d-md-block text-center text-sm-right">
              <div class="header__multi-location-container d-flex justify-content-around justify-content-sm-end">
                <div class="header__multi-location-item">
                  <address class="header__address header__address--multi f9 f8-lg">
                    <?php get_template_part( 'block-parts/content-address-city_state' ); ?>
                  </address>
                  <a class="header__tel d-none d-md-inline-block f6 f5-lg" href="tel:<?php the_field( 'firm_phone', 'option' ); ?>"><span itemprop="telephone" content="<?php the_field( 'firm_phone', 'option' ); ?>"><span class="sr-only">Call our office </span><?php the_field( 'firm_phone', 'option' ); ?></span></a>
                </div>

                  <?php if ( have_rows( 'add_loctions_repeater', 'option' ) ) : ?>
                    <?php while ( have_rows( 'add_loctions_repeater', 'option' ) ) : the_row(); ?>
                      <div class="header__multi-location-item">
                      <address class="header__address header__address--multi f9 f8-lg">
                        <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                          <span itemprop="addressLocality">
                          <?php the_sub_field( 'firm-address_city' ); ?>,</span>
                          <span itemprop="addressRegion">
                            <?php the_sub_field( 'firm-address_state' ); ?></span>
                        </span>
                      </address>
                      <a class="header__tel d-none d-md-inline-block f6 f5-lg" href="tel:<?php the_sub_field( 'firm_phone' ); ?>"><span itemprop="telephone" content="<?php the_sub_field( 'firm_phone' ); ?>"><span class="sr-only">Call our office </span><?php the_sub_field( 'firm_phone' ); ?></span></a>
                      </div>
                    <?php endwhile; ?>
                  <?php endif; ?>
              </div>
          </div>
            <!-- End multiple locations layout -->
          <?php else : ?>
            <!-- Single location layout -->
            <div class="col-6 offset-3 col-sm-5 offset-sm-0 col-md-4 col-xl-3">
              <!-- Hero logo -->
              <?php get_template_part( 'block-parts/hero_fixed-logo' ); ?>
            </div>
            <div class="col-12 col-sm-7 col-lg d-none d-md-block">
              <div class="header__contact-info d-flex d-sm-block justify-content-center text-center text-sm-right">
                <?php
                $tel = get_field( 'firm_phone', 'option' );
                  echo '<a class="header__contact-item header__tel d-none d-md-inline-block f6 f4-md" href="tel:' . $tel . '"><span itemprop="telephone" content="' . $tel . '"><span class="sr-only">Call our office </span>' . $tel . '</span></a>'
                ?>
                <?php if ( get_field( 'display_city_state', 'option' ) == 1 ) { ?>
                <address class="header__address f8 f7-md">
                  <?php get_template_part( 'block-parts/content-address-city_state' ); ?>
                </address>
                <?php } ?>
              </div>
            </div>
            <!-- End single location layout -->
          <?php endif; ?>
        </div>
      </div>
    </header>
    <nav aria-label="Main Navigation" role="navigation" class="menu menu--sticky menu--bg-prime d-none d-md-block">
      <div class="container-fluid container--margin">
        <div class="row">
          <div class="col text-right text-lg-left">
            <?php
            $menuAlign = get_field( 'menu_items_justifiy', 'option' );
            $args = array(
            'menu_class' => 'full-menu fixed-menu menu-item--white  d-none d-xl-flex ' .  $menuAlign,
            'theme_location' => 'primary'
            );
            wp_nav_menu( $args );
            ?>
    			  <div class="d-xl-none d-flex align-items-center justify-content-end">
    			  <button class="navbar-toggler d-none d-md-inline-block f5 color-white" type="button" onclick="openNav()" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">Menu</button>
    			  </div>
          </div>
        </div>
      </div>
    </nav>

</div>
