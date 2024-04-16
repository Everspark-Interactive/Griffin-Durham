<?php
/**
 * Template Name: Locations
 */

 get_header(); 
 $current_page = home_url( $_SERVER['REQUEST_URI'] ); 
 $current_page = explode("/",$current_page); 
 ?>

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
<?php 
	  if(isset($current_page[1]) && $current_page[3]=="atlanta"){
		
	  ?>  
<div class="contact-page__multi-location-row">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <?php the_content(); ?>

      </div>
      <div class="col-lg-6">
        <div class="contact-multi__map">
          <?php the_field( 'map_embed_code', 'option' ); ?>
						 
        </div>
		  
		<div class="col-lg-6">
		 
		  <address>
          <p><br><table><tr><td><img src="http://griffindurham.com/wp-content/uploads/2023/02/location-e1677617939532.png"></td><td>
            <!-- Address, full  -->
            <?php
            $alias = get_field( 'address_alias', 'option' );
            if($alias) {
              echo '<span class="contact__address-alias">'.$alias.'</span>';
            } elseif (get_field( 'header_mutli_location', 'option' ) == 1 ) {
              $city = get_field( 'firm-address_city', 'option' );
             // echo '<span class="contact__address-alias">'.$city.' Office</span>';
             // 
            }
            get_template_part( 'template-parts/content-address-full' ); ?>
			  </td></tr></table>
            
            <?php
            $tel = get_field( 'firm_phone', 'option' );
            $fax = get_field ( 'firm_fax', 'option' );
            if($tel) {
              echo '<br><table><tr><td><img src="http://griffindurham.com/wp-content/uploads/2023/02/phone-e1677618027508.png"></td><td> Phone number: <a class="contact-block__tel" href="tel:' .str_replace(".","",$tel) . '"><span itemprop="telephone" content="' . $tel . '"><span class="sr-only">Call our office </span><a href="tel:'.str_replace(".","",$tel).'">' . $tel . '</a></span></a></td></tr></table>';
            }

              if (!empty($fax))
              {
                echo '<br/><table><tr><td><img src="http://griffindurham.com/wp-content/uploads/2023/02/fax-e1677618047413.png"></td><td>Fax: <a class="contact-block__tel" href="tel:' . $fax . '"><span itemprop="faxNumber" content="' . $fax . '">' . $fax . '</span></a></td></tr></table>';
              }
            ?></p>
          </address>
		  </div>  
      </div>
</div>

</div>
      	<?php } else {  if ( have_rows( 'add_loctions_repeater', 'option' ) ) : ?>
      <?php while ( have_rows( 'add_loctions_repeater', 'option' ) ) : the_row();
      $tel = get_field( 'firm_phone', 'option' );
      $fax = get_field ( 'firm_fax', 'option' ); ?>
      <div class="contact-page__multi-location-row">
      <div class="row align-items-center">
        <div class="col-lg-6">
            <?php the_content(); ?>
        </div>
        <div class="col-lg-6">
          <div class="contact-multi__map">
            <?php the_sub_field( 'map_embed_code' ); ?>
          </div>
			
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
                        // echo '<span class="contact__address-alias">'.$alias.'</span>';
                       } else {
                        // echo '<span class="contact__address-alias">'.$city.' Office</span>';
                       }

                  echo '<br><table><tr><td> <img src="http://griffindurham.com/wp-content/uploads/2023/02/location-e1677617939532.png"></td><td><span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                  <span itemprop="streetAddress">' . $street . '</span><br/>
                  <span itemprop="addressLocality">' . $city . '</span>,
                  <span itemprop="addressRegion">' . $state . '</span>
                  <span itemprop="postalCode">' . $zip . '</span></span></td></tr></table';
                ?>
                <?php if ( get_sub_field( 'appointment_only', 'options' ) ) : ?>
								<br/><strong>By appointment only</strong>
								<?php endif; ?>
                <br/>
                <?php
                $tel = get_sub_field( 'firm_phone' );
                $fax = get_sub_field ( 'firm_fax' );
                if($tel) {
                  echo '<br><table><tr><td><img src="http://griffindurham.com/wp-content/uploads/2023/02/phone-e1677618027508.png" ></td><td> Phone number: <a class="contact-block__tel" href="tel:' . str_replace(".","",$tel). '"><span itemprop="telephone" content="' . $tel . '"><span class="sr-only">Call our office </span><a href="tel:'.str_replace(".","",$tel).'">' . $tel . '</a></span></a></td></tr></table>';
                }

                  if (!empty($fax))
                  {
                    echo '<br/><img src="http://griffindurham.com/wp-content/uploads/2023/02/fax-e1677618047413.png" > Fax: <a class="contact-block__tel" href="tel:' . $fax . '"><span itemprop="faxNumber" content="' . $fax . '">' . $fax . '</span></a>';
                  }
                ?></p>
            </address>
			</div>	
        </div>
      </div>
</div>
      <?php endwhile; ?>
    <?php endif; }?>


    

  </main><!-- #main -->
</section><!-- #primary -->
<style>
	.footer__multi-locations {display:none !important;}
	.contact-multi__map {
    height: 200px !important;
    margin-top: -100px !important;
}
	.contact-page__multi-location-row{ border-bottom:none !important;}
	
	
	.footer-main {
    margin-top: -60px !important;
}
	[href^="tel:"] {pointer-events:unset !important;}
</style>
 	<?php
 	get_footer();
