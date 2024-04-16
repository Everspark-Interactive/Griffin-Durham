<?php
  $city = get_field( 'firm-address_city', 'option' );
  $state = get_field( 'firm-address_state', 'option' );

  echo '<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><span itemprop="addressLocality">' . $city . '</span>,
  <span itemprop="addressRegion">' . $state . '</span></span>';
?>
