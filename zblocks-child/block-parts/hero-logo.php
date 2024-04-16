<a class="header__home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
  <span class="sr-only">Return home</span>
  <?php
    $inside_header_logo = get_field( 'inside_header_logo', 'option' );
    $firm_logo = get_field( 'firm_logo', 'option' );
    if (( $firm_logo ) && ( is_front_page() )) : ?>
       <img class="header__logo" src="<?php echo $firm_logo['url']; ?>" alt="Georgia Trial Attorneys" />
    <?php elseif (( $inside_header_logo ) && ( !is_front_page() )) : ?>
        <img class="header__logo" src="<?php echo $inside_header_logo['url']; ?>" alt="<?php the_field( 'firm_name', 'option' ); ?>" />
    <?php else : ?>
        <img class="header__logo" src="<?php echo $firm_logo['url']; ?>" alt="<?php the_field( 'firm_name', 'option' ); ?>" />
<?php endif; ?>
</a>