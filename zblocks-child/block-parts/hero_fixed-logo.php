<a class="header__home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
  <span class="sr-only">Return home</span>
  <?php
  $stickyLogo = get_field( 'sticky_header_logo', 'option' );
  $firm_logo = get_field( 'firm_logo', 'option' ); ?>

  <?php if ( $stickyLogo ) : ?>
    <img class="header-fixed__logo" src="<?php echo $stickyLogo['url']; ?>" alt="<?php echo $stickyLogo['alt']; ?>" />

  <?php elseif ( $firm_logo ) : ?>
    <img class="header-fixed__logo" src="<?php echo $firm_logo['url']; ?>" alt="<?php the_field( 'firm_name', 'option' ); ?>" />

  <?php endif; ?>
</a>
