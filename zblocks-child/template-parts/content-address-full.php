<?php
  $street = get_field( 'firm-address_street', 'option' );
  $city = get_field( 'firm-address_city', 'option' );
  $state = get_field( 'firm-address_state', 'option' );
  $zip = get_field( 'firm-address_zip', 'option' );

  echo '<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
  <span itemprop="streetAddress">' . $street . '</span><br/>
  <span itemprop="addressLocality">' . $city . '</span>,
  <span itemprop="addressRegion">' . $state . '</span>
  <span itemprop="postalCode">' . $zip . '</span></span>';
?>
