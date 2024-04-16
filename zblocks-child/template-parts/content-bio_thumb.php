<a class="team-member__link" href="<?php the_permalink() ?>">

  <?php
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
  $thumbnail_id = get_post_thumbnail_id( $post->ID );
  $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
  if($image) { ?>
    <figure class="team-member__figure">
        <img class="team-member__img" src="<?php echo $image[0]; ?>" alt="<?php echo $alt; ?>" />

    </figure>
  <?php } else { ?>
    <figure class="team-member__figure team-member__figure--placeholder">

    </figure>
  <?php } ?>
  <div class="team-member__info-container">
    <div class="team-member__name lh-1">
      <?php the_title( '<div class="mb-0 headline f4 f5-lg f4-xl">', '</div>' ); ?>
      <?php
      $title = get_field ( 'attorney_title' );
      if ( $title ) :
      ?>
      <div class="team-member__title mt-1 font-header f5 f6-lg f5-xl color-tert">
        <?php the_field( 'attorney_title' ); ?>
      </div>
      <?php endif; ?>
    </div>
    <div class="team-member__view-profile text-uppercase fw-700 f8-lg f7-xl">View Profile</div>
  </div>
</a>
