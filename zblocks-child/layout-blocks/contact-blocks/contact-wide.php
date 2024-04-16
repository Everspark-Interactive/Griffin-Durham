<!-- Wide -->
<section class="contact-block <?php the_field( 'developer_styles-contact' ); ?>" id="contact">
      <div class="row no-gutters mb-5">
        <?php if ( get_field( 'header_mutli_location', 'option' ) == 1 ) : ?>
          <!-- Start of multi location layout -->
        <div class="col-lg">
          <div class="contact-block__map-wide mb-3 mb-sm-0">
          <?php the_field( 'map_embed_code', 'option' ); ?>
          </div>
        </div>

          <?php if ( have_rows( 'add_loctions_repeater', 'option' ) ) : ?>
            <?php while ( have_rows( 'add_loctions_repeater', 'option' ) ) : the_row(); ?>
              <div class="col-lg">
                <div class="contact-block__map-wide mb-3 mb-sm-0">
                <?php the_sub_field( 'map_embed_code' ); ?>
                </div>
              </div>
          <?php endwhile; ?>
        <?php endif; ?>
        <!-- End of multi location layout -->
      <?php else : ?>
        <!-- Start of single location layout -->
        <div class="col-lg">
          <div class="contact-block__map-wide mb-3 mb-sm-0">
          <?php the_field( 'map_embed_code', 'option' ); ?>
          </div>
        </div>
        <!-- End of single location layout -->
        <?php endif; ?>
      </div>


  <div class="container">
    <div class="row text-center">
      <div class="col-12 col-xl-10 offset-xl-1">
        <?php
        $hText = get_field( 'heading-txt' );
        $hToggle = get_field( 'heading-toggle' );
        $hTag = get_field( 'heading-tag' );
        $hClass = get_field( 'heading-class' );

        if ( $hText ) {
          if ( $hToggle == 'heading' ) {
            echo '<' . $hTag . ' class="contact-block--split__form-title ' . $hClass . '">' . $hText . '</' . $hTag . '>';

          } elseif ( $hToggle == 'styled' ) {

            echo '<div class="contact-block--split__form-title ' . $hTag  . ' ' . $hClass   . '">' . $hText . '</div>';
          }
          else {
            echo '<div>Error duder</div>';
          }
        }
        ?>
        <?php
        $hText = get_field( 'heading-txt_sec' );
        $hToggle = get_field( 'heading-toggle_sec' );
        $hTag = get_field( 'heading-tag_sec' );
        $hClass = get_field( 'heading-class_sec' );

        if ( $hText ) {
          if ( $hToggle == 'heading' ) {
            echo '<' . $hTag . ' class="contact-block--split__form-title ' . $hClass . '">' . $hText . '</' . $hTag . '>';

          } elseif ( $hToggle == 'styled' ) {

            echo '<div class="contact-block--split__form-title ' . $hTag  . ' ' . $hClass   . '">' . $hText . '</div>';
          }
          else {
            echo '<div>Error duder</div>';
          }
        }
        ?>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-10 offset-md-1 col-xl-8 offset-xl-2">
        <div class="gravity-form-home mb-30">
          <?php gravity_form(1, false, false, false, '', true); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-prime pt-4 pb-4 text-center reverse-child-links">
    <div class="container">
      <div class="row">
        <div class="col-12">

              <div class="row justify-content-center align-items-center color-white">
              <div class="col-lg">
                <i class="fas fa-map-marker f2 f1-md"></i><br/>
                <!-- Address, full  -->
                <?php get_template_part( 'template-parts/content-address-full' ); ?><br/>
                <?php
                $tel = get_field( 'firm_phone', 'option' );

                echo '<a class="color-white" href="tel:' . $tel . '"><span itemprop="telephone" content="' . $tel . '"><span class="sr-only">Call our office </span><i class="fas fa-phone-plus"></i> ' . $tel . '</span></a>'
                ?>
                <?php if( get_field( 'firm_fax', 'option' ) ): ?>
                  <br/>
                   <i class="fas fa-print"></i> <a class="color-white" href="tel:<?php the_field( 'firm_fax', 'option' ); ?>"><?php the_field( 'firm_fax', 'option' ); ?></a>
                <?php endif; ?>
                <?php
                $email = get_field( 'firm_email', 'option' );
                if($email) {?> | <a href="mailto:<?php echo $email; ?>"><i class="fas fa-envelope-open-text"></i> <?php echo $email; ?></a>
                <?php } ?>
              </div>


              <?php if ( have_rows( 'add_loctions_repeater', 'option' ) ) : ?>
                <?php while ( have_rows( 'add_loctions_repeater', 'option' ) ) : the_row(); ?>
                  <div class="col-lg">
                    <div class="mt-3 m-lg-0">
                      <i class="fas fa-map-marker f2 f1-md"></i><br/>
                        <?php
                          $street = get_sub_field( 'firm-address_street' );
                          $city = get_sub_field( 'firm-address_city' );
                          $state = get_sub_field( 'firm-address_state' );
                          $zip = get_sub_field( 'firm-address_zip' );

                          echo '<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                          <span itemprop="streetAddress">' . $street . '</span><br/>
                          <span itemprop="addressLocality">' . $city . '</span>,
                          <span itemprop="addressRegion">' . $state . '</span>
                          <span itemprop="postalCode">' . $zip . '</span></span>';

                          $tel = get_sub_field( 'firm_phone' );

                          echo '<br/><a class="color-white" href="tel:' . $tel . '"><span itemprop="telephone" content="' . $tel . '"><span class="sr-only">Call our office </span><i class="fas fa-phone-plus"></i> ' . $tel . '</span></a>'
                        ?>
                        <?php if( get_sub_field( 'firm_fax', 'option' ) ): ?>
                        <br/>
                       <i class="fas fa-print"></i> <a class="color-white" href="tel:<?php the_sub_field( 'firm_fax', 'option' ); ?>"><?php the_sub_field( 'firm_fax', 'option' ); ?></a>
                        <?php endif; ?>
                    </div>
                  </div>
              <?php endwhile; ?>
            <?php endif; ?>
            </div>

            <?php if (get_field('contact_block_split__social-opt', 'option') == 1) : ?>
              <div class="row contact-wide__social_media-row">
                <div class="col-12 col-md mr-auto ml-auto">
                  <div class="f3">
                    <!-- Social icons  -->
                    <?php get_template_part( 'template-parts/content-social-icons' ); ?>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>

    </div>
  </div>

</section>
