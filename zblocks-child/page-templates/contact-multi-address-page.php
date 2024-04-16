<?php
/**
 * Template Name: Contact - Multiple Locations
 */

 get_header(); ?>

<section id="primary" class="content-area contact-page col-12">
  <main id="main" class="site-main" role="main">
    <header class="entry-header">
  		<?php
  		$seoTitle = get_field('the_seo_title');
  		if ($seoTitle) {
  			echo '<h1 class="entry-title">'. $seoTitle .'</h1>';
  		}
  		?>
  	</header><!-- .entry-header -->
   <?php if ( has_post_thumbnail() ) : ?>
   		<figure class="content-page__img-figure">
   		  <?php the_post_thumbnail(); ?>
   		</figure>
   <?php endif; ?>
   <?php the_content(); ?>
<div class="contact-page__multi-location-row">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <address>
          <p>
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
            <br/>
            <?php
			 
            $tel = get_field( 'firm_phone', 'option' );
            $fax = get_field ( 'firm_fax', 'option' );
            if($tel) {
              echo 'Phone: <a class="contact-block__tel" href="tel:' . $tel . '"><span itemprop="telephone" content="' . $tel . '"><span class="sr-only">Call our office </span>' . $tel . '</span></a>';
            }

              if (!empty($fax))
              {
                echo '<br/>Fax: <a class="contact-block__tel" href="tel:' . $fax . '"><span itemprop="faxNumber" content="' . $fax . '">' . $fax . '</span></a>';
              }
            ?></p>
          </address>

      </div>
      <div class="col-lg-6">
        <div class="contact-multi__map">
          <?php the_field( 'map_embed_code', 'option' ); ?>
        </div>
      </div>
</div>
</div>
      <?php if ( have_rows( 'add_loctions_repeater', 'option' ) ) : ?>
      <?php while ( have_rows( 'add_loctions_repeater', 'option' ) ) : the_row();
	 	echo $city;
      $tel = get_field( 'firm_phone', 'option' );
      $fax = get_field ( 'firm_fax', 'option' ); ?>
      <div class="contact-page__multi-location-row">
      <div class="row align-items-center">
        <div class="col-lg-6">
            <address>
              <p>
                <?php
                  $street = get_sub_field( 'firm-address_street' );
                  $city = get_sub_field( 'firm-address_city' );
                  $state = get_sub_field( 'firm-address_state' );
                  $zip = get_sub_field( 'firm-address_zip' );

                  $alias = get_sub_field( 'address_alias' );
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
                <?php if ( get_sub_field( 'appointment_only', 'options' ) ) : ?>
								<br/><strong>By appointment only</strong>
								<?php endif; ?>
                <br/>
                <?php
                $tel = get_sub_field( 'firm_phone' );
                $fax = get_sub_field ( 'firm_fax' );
                if($tel) {
                  echo 'Phone: <a class="contact-block__tel" href="tel:' . $tel . '"><span itemprop="telephone" content="' . $tel . '"><span class="sr-only">Call our office </span>' . $tel . '</span></a>';
                }

                  if (!empty($fax))
                  {
                    echo '<br/>Fax: <a class="contact-block__tel" href="tel:' . $fax . '"><span itemprop="faxNumber" content="' . $fax . '">' . $fax . '</span></a>';
                  }
                ?></p>
            </address>
        </div>
        <div class="col-lg-6">
          <div class="contact-multi__map">
            <?php the_sub_field( 'map_embed_code' ); ?>
          </div>
        </div>
      </div>
</div>
      <?php endwhile; ?>
    <?php endif; ?>


    <div class="row">
      <div class="col-lg-10">
        <p class="f4-md">If you have any questions or comments, feel free to contact us by filling out the contact form or calling our office.</p>
        <?php
        gravity_form( 3, false, false, false, '', true );
        ?>
      </div>
    </div>

  </main><!-- #main -->
</section><!-- #primary -->

 	<?php
 	get_footer();
