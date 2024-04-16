<div class="header__vid-container bg-overlay--<?php the_field( 'vid_overlay-color', 'option' ); ?>">
<?php
	// Include and instantiate the mobile detect
	$detect = new Mobile_Detect;
	$hero_video_mobile_image = get_field( 'hero_video_mobile_image', 'option' );
  	if ( $detect->isMobile() ) : ?>
			<img class="header__img" src="<?php echo $hero_video_mobile_image['url']; ?>" alt="<?php echo $hero_video_mobile_image['alt']; ?>" />
<?php else : ?>

  <?php
  $vidType = get_field( 'video-youtube-or-mp4', 'option' );
  if( $vidType == 'youtube' ) : ?>
    <div class="embed-responsive embed-responsive-16by9">
      <iframe tabindex="-1" src="https://www.youtube.com/embed/<?php the_field( 'hero_video-youtube', 'option' ); ?>?controls=0&amp;showinfo=0&amp;rel=0&amp;autoplay=1&amp;loop=1&amp;playlist=<?php the_field( 'hero_video-youtube', 'option' ); ?>&amp;mute=1" allowfullscreen="" frameborder="0"></iframe>
    </div>

  <?php elseif( $vidType == 'mp4' ) : ?>
    <video tabindex="-1" class="header__vid" width="320" height="240" autoplay muted loop>
      <source src="<?php the_field( 'hero_video-mp4', 'option' ); ?>" type="video/mp4">
    </video>
  <?php endif; //end of if youtube or mp4 video statement  ?>

<?php endif; //end of detect mobile  ?>
</div>
