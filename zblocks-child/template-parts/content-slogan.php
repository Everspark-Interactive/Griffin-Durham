<?php
  $sloganColor = get_field( 'slogan_color', 'option' );
  $slogan = get_field( 'hero_slogan', 'option' );
  $sloganBtn = get_field( 'hero_read_more_text', 'option' );
  $sloganURL = get_field( 'hero_read_more', 'option' );

  $sFont = get_field( 'slogan_font_family', 'option' );
  $sSize = get_field( 'slogan_size', 'option' );
  $sSizeSM = get_field( 'slogan_sm_size', 'option' );
  $sSizeMD = get_field( 'slogan_md_size', 'option' );
  $sSizeLG = get_field( 'slogan_lg_size', 'option' );
  $sSizeXL = get_field( 'slogan_xl_size', 'option' );

  $cFont = get_field( 'caption_font_family', 'option' );
  $cSize = get_field( 'caption_size', 'option' );
  $cSizeSM = get_field( 'caption_sm_size', 'option' );
  $cSizeMD = get_field( 'caption_md_size', 'option' );
  $cSizeLG = get_field( 'caption_lg_size', 'option' );
  $cSizeXL = get_field( 'caption_xl_size', 'option' );

  $btnStyle = get_field( 'slogan_btn_bg_color', 'option' );
  $btnSize = get_field( 'btn_size', 'option' );
  $btnSizeSM = get_field( 'btn_sm_size', 'option' );
  $btnSizeMD = get_field( 'btn_md_size', 'option' );
  $btnSizeLG = get_field( 'btn_lg_size', 'option' );
  $btnSizeXL = get_field( 'btn_xl_size', 'option' );

  $sloganAttributes = array();
  array_push ($sloganAttributes, $sFont, $sSize, $sSizeSM, $sSizeMD, $sSizeLG, $sSizeXL);

  $captionAttributes = array();
  array_push ($captionAttributes, $cFont, $cSize, $cSizeSM, $cSizeMD, $cSizeLG, $cSizeXL);

  $btnAttributes = array();
  array_push ($btnAttributes, $btnStyle, $btnSize, $btnSizeSM, $btnSizeMD, $btnSizeLG, $btnSizeXL); ?>

  <div class="header-slogan__content layer-1 <?php echo $sloganColor; ?>">
    <?php if($slogan) { ?>
    <div class="header-slogan__txt <?php foreach($sloganAttributes as $value){echo $value . " ";} ?>">
      <?php echo $slogan; ?>
    </div>
    <?php } ?>

    <?php
    $count = 0;
    $sloganRows = get_field('hero_slogan_carousel', 'options');
    if (is_array($sloganRows)) {
      $count = count($sloganRows);
    }
    if ( have_rows( 'hero_slogan_carousel', 'options' ) ) : ?>
    <div id="carouselSlogan" class="carousel carousel-fade carousel-equalize slide mt-5" data-ride="carousel" data-interval="false">
      <div class="carousel-inner">
      <?php
      $sloganItemCount = 1;
      while ( have_rows( 'hero_slogan_carousel', 'options' ) ) :
        the_row();
        $carousel_item = get_sub_field( 'carousel_item', 'options' ); ?>
          <div class="carousel-item bg-white <?php if($sloganItemCount == 1) {echo 'active';}?>">
            &ldquo;<?php echo esc_html( $carousel_item ); ?>&rdquo;
          </div>
        <?php
        $sloganItemCount ++;
      endwhile; ?>
      </div>
      <?php
      if ($count > 1) {  ?>
      <div class="carousel-indicators justify-content-start position-relative mt-5">
        <?php
        $sloganPagerCount = 0;
        while ( have_rows( 'hero_slogan_carousel', 'options' ) ) :
          the_row(); ?>
        <button class="carousel-pager <?php if($sloganPagerCount == 0) {echo 'active';}?>" data-target="#carouselSlogan" data-slide-to="<?php echo $sloganPagerCount; ?>" tabindex="0"></button>
        <?php
        $sloganPagerCount ++;
      endwhile; ?>
      </div>
      <?php } ?>

    </div>
    <?php endif; ?>

    <?php if($sloganURL) { ?>
    <a href="<?php echo $sloganURL; ?>" class="btn btn--slogan mt-5 <?php foreach($btnAttributes as $value){echo $value . " ";} ?>">
      <?php echo $sloganBtn; ?>
    </a>
    <?php } ?>
  </div>
