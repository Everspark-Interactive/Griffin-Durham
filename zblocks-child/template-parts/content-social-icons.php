<div class="social-ico-row">
  <?php {
    $facebook = get_field( 'social-facebook', 'option' );
    $twitter = get_field( 'social-twitter', 'option' );
    $linkedin = get_field( 'social-linkedin', 'option' );
    $youtube = get_field( 'social-youtube', 'option' );
    $gplus = get_field( 'social-google', 'option' );
    $avvo = get_field( 'social-avvo', 'option' );
    $super = get_field( 'social-super-lawyer', 'option' );
    $insta = get_field( 'social-instagram', 'option' );
    $yelp = get_field( 'social-yelp', 'option' );

    if ($facebook) {
      echo '<a class="social-ico social-ico--fb" target="_blank" href="' . $facebook . '"><span class="sr-only">View our profile on Facebook</span></a>';
    }
    if ($twitter) {
      echo '<a class="social-ico social-ico--twitter" target="_blank" href="' . $twitter . '"><span class="sr-only">View our feed on Twitter</span></a>';
    }
    if ($linkedin) {
      echo '<a class="social-ico social-ico--linkedin" target="_blank" href="' . $linkedin . '"><span class="sr-only">View our firm profile on LinkedIn</span></a>';
    }
    if ($youtube) {
      echo '<a class="social-ico social-ico--youtube" target="_blank" href="' . $youtube . '"><span class="sr-only">View our channel on Youtube</span></a>';
    }
    if ($gplus) {
      echo '<a class="social-ico social-ico--google" target="_blank" href="' . $gplus . '"><span class="sr-only">View our profile on Google</span></a>';
    }
    if ($insta) {
      echo '<a class="social-ico social-ico--insta" target="_blank" href="' . $insta . '"><span class="sr-only">View our profile on Instagram</span></a>';
    }
    if ($yelp) {
      echo '<a class="social-ico social-ico--yelp" target="_blank" href="' . $insta . '"><span class="sr-only">See our reviews on Yelp</span></a>';
    }
    if ($avvo) {
      echo '<a class="social-ico social-ico--avvo" target="_blank" href="' . $avvo . '"><span class="sr-only">View our profile on Avvo </span><svg version="1.1" class="social-ico-avvo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
      viewBox="0 0 21.9 20.7" style="enable-background:new 0 0 21.9 20.7;" xml:space="preserve">
      <path d="M14.9,6.6c0.2-0.2,0.3-0.1,0.3,0l0.5,6.1H9.8C11.6,10,13.4,7.9,14.9,6.6z M16.3,20.7h5.6L20.2,0.9
      c-0.1-0.8-0.7-1-1.7-0.9C11.5,0.8,2.9,12.4,0,20.7h5.7c0.4-1.2,1-2.4,1.6-3.5H16L16.3,20.7z"/>
      </svg>
      </a>';
    }
    if ($super) {
      echo '<a class="social-ico social-ico--super" target="_blank" href="' . $super . '"><span class="sr-only">View our profile on </span>SuperLawyers</a>';
    }
  } ?>
</div>
