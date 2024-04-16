<!-- Split -->
<section class="content-block contact-block contact-block--split block-padding-lg-4 <?php the_field( 'developer_styles-contact' ); ?>" id="contact">
  <div class="container">
        <div class="row">
          <div class="col-lg-5 contact-block--split__left-col mb-30 mb-lg-0">
            <?php
            $hText = get_field( 'heading-txt' );
            $hToggle = get_field( 'heading-toggle' );
            $hTag = get_field( 'heading-tag' );
            $hClass = get_field( 'heading-class' );

            // if headline tag else styled class
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
          <div class="col-lg-5 offset-lg-2 contact-block--split__right-col">
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
              <p class="contact-block--split__right-desc <?php if (get_field( 'header_mutli_location', 'option' ) == 0 ){ echo 'f5'; } ?>">
                <!-- Address, full  -->
                <?php
                $alias = get_field( 'address_alias', 'option' );
                if($alias) {
                  echo '<span class="contact__address-alias">'.$alias.'</span>';
                } elseif (get_field( 'header_mutli_location', 'option' ) == 1 ) {
                  $city = get_field( 'firm-address_city', 'option' );
                  echo '<span class="contact__address-alias">'.$city.' Office</span>';
                }
                get_template_part( 'template-parts/content-address-full' ); ?>
                <br/><i class="fas fa-phone-plus"></i>
                <?php
                $tel = get_field( 'firm_phone', 'option' );

                echo '<a class="contact-block--split__tel" href="tel:' . $tel . '"><span itemprop="telephone" content="' . $tel . '"><span class="sr-only">Call our office </span>' . $tel . '</span></a>'
                ?>

                <?php if( get_field( 'firm_fax', 'option' ) ): ?>
                  <br/>
                   <i class="fas fa-print"></i> <a href="tel:<?php the_field( 'firm_fax', 'option' ); ?>"><?php the_field( 'firm_fax', 'option' ); ?></a>
                 <?php endif; ?>
              </p>
              <?php if ( have_rows( 'add_loctions_repeater', 'option' ) && get_field( 'header_mutli_location', 'option' ) == 1 ) : ?>
                <?php while ( have_rows( 'add_loctions_repeater', 'option' ) ) : the_row(); ?>
                  <p class="contact-block--split__right-desc">
                    <!-- Address, full  -->
                    <?php
                    $alias = get_sub_field( 'address_alias' );
          				  $street = get_sub_field( 'firm-address_street' );
          				  $city = get_sub_field( 'firm-address_city' );
          				  $state = get_sub_field( 'firm-address_state' );
          				  $zip = get_sub_field( 'firm-address_zip' );

                    if($alias) {
                      echo '<span class="contact__address-alias">'.$alias.'</span>';
                    } else {

                      echo '<span class="contact__address-alias">'.$city.' Office</span>';
                    }
          				  echo '<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
          				  <span itemprop="streetAddress">' . $street . '</span><br/>
          				  <span itemprop="addressLocality">' . $city . '</span>,
          				  <span itemprop="addressRegion">' . $state . '</span>
          				  <span itemprop="postalCode">' . $zip . '</span></span>';
          				?>

                    <br/><i class="fas fa-phone-plus"></i>
                    <?php
                    $tel = get_sub_field( 'firm_phone' );

                    echo '<a class="contact-block--split__tel" href="tel:' . $tel . '"><span itemprop="telephone" content="' . $tel . '"><span class="sr-only">Call our office </span>' . $tel . '</span></a>'
                    ?>

                    <?php if( get_sub_field( 'firm_fax', 'option' ) ): ?>
                    <br/>
                   <i class="fas fa-print"></i> <a href="tel:<?php the_sub_field( 'firm_fax', 'option' ); ?>"><?php the_sub_field( 'firm_fax', 'option' ); ?></a>
                    <?php endif; ?>
                  </p>
                <?php endwhile; ?>
              <?php endif; ?>


            <?php if (get_field('contact_block_split__social-opt') == 1) : ?>
            <div class="row align-items-lg-center m-b-lg-15">
              <div class="col-12 m-b-15 m-b-lg-0 f3">
                <div class="social-ico-title">Follow Us</div>
                  <!-- Social icons  -->
              		<?php get_template_part( 'template-parts/content-social-icons' ); ?>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>

  </div>
</section>
