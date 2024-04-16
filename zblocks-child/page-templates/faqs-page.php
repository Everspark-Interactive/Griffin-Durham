<?php
/**
 * Template Name: Frequently Asked Questions
 */

get_header(); ?>

 	<section id="primary" class="content-area col-sm-12 col-lg-8">
 		<main id="main" class="site-main review-page-template" role="main">
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      	<?php
          $enable_vc = get_post_meta(get_the_ID(), '_wpb_vc_js_status', true);
          if(!$enable_vc ) {
          ?>
          <header class="entry-header">
        		<?php
        		$seoTitle = get_field('the_seo_title');
        		if ($seoTitle) {
        			echo '<h1 class="entry-title">'. $seoTitle .'</h1>';
        		}
        		?>
        	</header><!-- .entry-header -->
        <?php } ?>

        <?php if ( has_post_thumbnail() ) : ?>
        	<figure class="content-page__img-figure">
        	  <?php the_post_thumbnail(); ?>
        	</figure>
        <?php endif; ?>

      	<div class="entry-content">
      		<?php
      			the_content();

      			wp_link_pages( array(
      				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-starter' ),
      				'after'  => '</div>',
      			) );
      		?>

          <?php
          //FAQ repeater
          if ( have_rows( 'faq_repeater' ) ) : {
          while ( have_rows( 'faq_repeater' ) ) : the_row(); {

          $faqTitle = get_sub_field( 'faq_title' );
          $faqDescription = get_sub_field( 'faq_description' );

          echo '
          <div itemscope itemtype="http://schema.org/Question">
            <details itemprop="name" class="content-block__accordion">
              <summary class="content-block__accordion-title"><h2 itemprop="name">'.$faqTitle.'</h2></summary>
              <div class="content-block__accordion-description" itemprop="suggestedAnswer acceptedAnswer" itemscope itemtype="http://schema.org/Answer">'.$faqDescription.'</div>
            </details>
          </div>';
            }
          endwhile;
          }
          endif; ?>

          <?php the_field( 'content_after_faqs' ); ?>

      	</div><!-- .entry-content -->
      </article><!-- #post-## -->

 		</main><!-- #main -->
 	</section><!-- #primary -->

 <?php
 get_sidebar();
 get_footer();
