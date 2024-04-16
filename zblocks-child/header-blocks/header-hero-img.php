<div class="header__img-container bg-overlay--<?php the_field( 'vid_overlay-color', 'option' ); ?>">
  <?php
    $hero_image = get_field( 'hero_image', 'option' );
    $smImage = get_field( 'hero_image_sm', 'option' );
    $mdImage = get_field( 'hero_image_md', 'option' );
    $lgImage = get_field( 'hero_image_lg', 'option' );
    $xlImage = get_field( 'hero_image_xl', 'option' );
	$webp_hero_image = get_field( 'webp_hero_image', 'options' );
  ?>
  <?php if ( get_field( 'hero_image', 'option' ) && get_field( 'anim-option', 'option' ) == 'stat' ) { ?>
    <?php
    if ( $hero_image ) { ?>
         <picture>
           <?php if ( $xlImage ) { ?>
           <!-- xl devices -->
           <source media="(min-width: 1200px)" srcset="<?php the_field( 'hero_image_xl', 'option' ); ?>">
           <?php } ?>
           <?php if ( $lgImage ) { ?>
           <!-- lg devices -->
            <source media="(min-width: 992px)" srcset="<?php the_field( 'hero_image_lg', 'option' ); ?>">
            <?php } ?>
            <?php if ( $mdImage ) { ?>
           <!-- md devices -->
           <source media="(min-width: 768px)" srcset="<?php the_field( 'hero_image_md', 'option' ); ?>">
           <?php } ?>
           <?php if ( $smImage ) { ?>
           <!-- sm devices -->
           <source media="(min-width: 576px)" srcset="<?php the_field( 'hero_image_sm', 'option' ); ?>">
           <?php } ?>
			 <?php if($webp_hero_image) { ?>
           <!-- webp format image -->
           <source srcset="<?php echo esc_url( $webp_hero_image['url'] ); ?>" type="image/webp" />
           <?php } ?>
           <!-- default image -->
           <img class="header__img" src="<?php echo $hero_image['url']; ?>" <?php if(is_null($hero_image['alt'])) { ?> alt="<?php echo $hero_image['alt']; ?>" <?php } else { echo 'alt="" role="presentation"'; }?> />
         </picture>
    <?php } ?>
  <?php } ?>
  <?php if ( get_field( 'hero_image', 'option' ) && get_field( 'anim-option', 'option' ) == 'anim' ) { ?>
    <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel" data-pause="false">
      <?php if ( have_rows( 'animation_slides', 'option' ) ) : ?>
        <div class="carousel-indicators carousel-indicators--header-slides">
          <button data-target="#header-carousel" data-slide-to="0" class="active carousel-pager"><span class="sr-only">View slide 1</span></button>
          <?php
          $count = 1;
          while ( have_rows( 'animation_slides', 'option' ) ) : the_row(); ?>
            <button data-target="#header-carousel" data-slide-to="<?php echo $count; ?>" class="carousel-pager"><span class="sr-only">View slide <?php echo $count + 1; ?></span></button>
          <?php
          $count++;
          endwhile; ?>
        </div>
      <?php endif; ?>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <picture>
          <!-- xl devices -->
          <source media="(min-width: 1200px)" srcset="<?php the_field( 'hero_image_xl', 'option' ); ?>">

          <!-- lg devices -->
          <source media="(min-width: 992px)" srcset="<?php the_field( 'hero_image_lg', 'option' ); ?>">

          <!-- md devices -->
          <source media="(min-width: 768px)" srcset="<?php the_field( 'hero_image_md', 'option' ); ?>">

          <!-- sm devices -->
          <source media="(min-width: 576px)" srcset="<?php the_field( 'hero_image_sm', 'option' ); ?>">

			<?php if($webp_hero_image) { ?>
           <!-- webp format image -->
           <source srcset="<?php echo esc_url( $webp_hero_image['url'] ); ?>" type="image/webp" />
           <?php } ?>

          <!-- default image -->
          <img class="header__img" src="<?php echo $hero_image['url']; ?>" <?php if(is_null($hero_image['alt'])) { ?> alt="<?php echo $hero_image['alt']; ?>" <?php } else { echo 'alt="" role="presentation"'; }?> />
        </picture>
      </div>
      <?php if ( have_rows( 'animation_slides', 'option' ) ) : ?>
        <?php while ( have_rows( 'animation_slides', 'option' ) ) : the_row(); ?>
          <div class="carousel-item">
            <?php
            $slide_img = get_sub_field( 'slide-img' );
			$webp_hero_image = get_sub_field( 'webp_hero_image' );
            if ( $slide_img ) { ?>
                 <picture>

                   <!-- xl devices -->
                   <source media="(min-width: 1200px)" srcset="<?php the_sub_field( 'slide-img_xl', 'option' ); ?>">
                     <!-- lg devices -->
                     <source media="(min-width: 992px)" srcset="<?php the_sub_field( 'slide-img_lg', 'option' ); ?>">

                       <!-- md devices -->
                       <source media="(min-width: 768px)" srcset="<?php the_sub_field( 'slide-img_md', 'option' ); ?>">

                         <!-- sm devices -->
                         <source media="(min-width: 576px)" srcset="<?php the_sub_field( 'slide-img_sm', 'option' ); ?>">
					 <?php if($webp_hero_image) { ?>
           <!-- webp format image -->
           <source srcset="<?php echo esc_url( $webp_hero_image['url'] ); ?>" type="image/webp" />
           <?php } ?>
                   <!-- default image -->
                   <img loading="lazy" class="header__img d-block w-100" src="<?php echo $slide_img['url']; ?>" alt="<?php echo $slide_img['alt']; ?>" />
                 </picture>
            <?php } ?>

          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
    </div>
  <?php } ?>
</div>
