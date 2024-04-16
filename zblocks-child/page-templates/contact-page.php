<?php
/**
 * Template Name: Contact Page
 */

 get_header(); ?>

<section id="primary" class="content-area col">
  <main id="main" class="site-main" role="main">
    <header class="entry-header">
  		<?php
  		$seoTitle = get_field('the_seo_title');
  		if ($seoTitle) {
  			echo '<h1 class="entry-title">'. $seoTitle .'</h1>';
  		}
  		?>
  	</header><!-- .entry-header -->
  <section class="contact-page contact-page-2col">
    <div class="row">
      <div class="col">
        <?php if ( has_post_thumbnail() ) : ?>
        		<figure class="content-page__img-figure">
        		  <?php the_post_thumbnail(); ?>
        		</figure>
        <?php endif; ?>
        <?php the_content(); ?>
      </div>
    </div>
    <div class="row contact-address-outer">
      <div class="col-lg-6 d-flex flex-column">
        <address>
          <p class="f4-md">
            <!-- Address, full  -->
            <?php get_template_part( 'template-parts/content-address-full' ); ?>
            <br/><br/>
            <?php
            $tel = get_field( 'firm_phone', 'option' );
            $fax = get_field( 'firm_fax', 'option' );
            $email = get_field( 'firm_email', 'option' );

              echo 'Phone: <a class="contact-block__tel" href="tel:' . $tel . '"><span itemprop="telephone" content="' . $tel . '"><span class="sr-only">Call our office </span>' . $tel . '</span></a>';

              if ($fax)
              {
                echo '<br/>Fax: <a class="contact-block__tel" href="tel:' . $fax . '"><span itemprop="faxNumber" content="' . $fax . '">' . $fax . '</span></a>';
              }
              if ($email)
              {
                echo '<br/><a class="contact-block__tel" href="mailto:' . $email . '">' . $email . '</a>';
              }
            ?></p>
          </address>
          <div class="contact-page-2col__map">
            <?php the_field( 'map_embed_code', 'option' ); ?>
          </div>

      </div>
      <div class="col-lg-5 offset-lg-1">
        <p class="f5-lg">If you have any questions or comments, feel free to contact us by filling out the contact form or calling our office.</p>
        <?php
        gravity_form( 3, false, false, false, '', true );
        ?>
      </div>
    </div>
  </section>
  </main><!-- #main -->
</section><!-- #primary -->

 	<?php
 	get_footer();
