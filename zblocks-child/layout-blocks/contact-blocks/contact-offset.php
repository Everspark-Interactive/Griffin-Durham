<!-- Split -->
<section class="content-block contact-block contact-block--offset <?php the_field( 'developer_styles-contact' ); ?>" id="contact">
  <div class="container">
    <div class="row">
      <div class="col-xl-10 offset-xl-1">
        <div class="row">
          <div class="col-lg-6 col-xl-5 contact-offset__left mb-30 mb-lg-0">
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

            <div class="gravity-form-home">
              <?php gravity_form(1, false, false, false, '', true); ?>
            </div>
          </div>
          <div class="col-lg-5 offset-lg-1 col-xl-5 offset-xl-2 contact-offset__right align-self-center">
            <div class="contact-offset__right-content">
              <?php
              $hText = get_field( 'heading-txt_sec' );
              $hToggle = get_field( 'heading-toggle_sec' );
              $hTag = get_field( 'heading-tag_sec' );
              $hClass = get_field( 'heading-class_sec' );

              if ( $hText ) {
                if ( $hToggle == 'heading' ) {
                  echo '<' . $hTag . ' class="contact-block--split__form-title  color-white ' . $hClass . '">' . $hText . '</' . $hTag . '>';

                } elseif ( $hToggle == 'styled' ) {

                  echo '<div class="contact-block--split__form-title  color-white ' . $hTag  . ' ' . $hClass   . '">' . $hText . '</div>';
                }
                else {
                  echo '<div>Error duder</div>';
                }
              }
              ?>
              <p><!-- Address, full  -->
                <?php get_template_part( 'template-parts/content-address-full' ); ?>
                <br/>
                <?php
                $tel = get_field( 'firm_phone', 'option' );
                echo '<i class="fas fa-phone-plus"></i> <a class="color-white" href="tel:' . $tel . '"><span itemprop="telephone" content="' . $tel . '"><span class="sr-only">Call our office </span>' . $tel . '</span></a>'
                ?>
              </p>
                <?php if ( get_field( 'header_mutli_location', 'option' ) == 1 ) : ?>
                <?php if ( have_rows( 'add_loctions_repeater', 'option' ) ) : ?>
                  <?php while ( have_rows( 'add_loctions_repeater', 'option' ) ) : the_row(); ?>
                    <p>
                      <!-- Address, full  -->
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
      				?>

                      <br/>
                      <?php
                      $tel = get_sub_field( 'firm_phone' );

                      echo '<i class="fas fa-phone-plus"></i> <a class="color-white" href="tel:' . $tel . '"><span itemprop="telephone" content="' . $tel . '"><span class="sr-only">Call our office </span>' . $tel . '</span></a>'
                      ?>
                    </p>
                  <?php endwhile; ?>
                <?php endif; ?>
                <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
