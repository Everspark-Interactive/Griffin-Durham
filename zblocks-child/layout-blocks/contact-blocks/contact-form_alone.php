<!-- Form large alone -->
<section class="contact-block <?php the_field( 'developer_styles-contact' ); ?>" id="contact">
  <div class="container">
    <div class="row text-center justify-content-center">
      <div class="col-12">
        <?php
        $hText = get_field( 'heading-txt' );
        $hToggle = get_field( 'heading-toggle' );
        $hTag = get_field( 'heading-tag' );
        $hClass = get_field( 'heading-class' );
        $txtColor = get_field( 'content-color' );

        if ( $hText ) {
          if ( $hToggle == 'heading' ) {
            echo '<' . $hTag . ' class="contact-block--split__form-title ' . $hClass . '" style="color:' . $txtColor . '">' . $hText . '</' . $hTag . '>';

          } elseif ( $hToggle == 'styled' ) {

            echo '<div class="contact-block--split__form-title ' . $hTag  . ' ' . $hClass   . '" style="color:' . $txtColor . '">' . $hText . '</div>';
          }
          else {
            echo '<div>Error duder</div>';
          }
        }
        ?>


        <?php
        $hText = get_field( 'heading-txt_sec' );
        $hToggle = get_field( 'heading-toggle_sec' );
        $hTag = get_field( 'heading-tag_sec' );
        $hClass = get_field( 'heading-class_sec' );
        $txtColor = get_field( 'content-color_sec' );

        // if headline tag else styled class
        if ( $hText ) {
          if ( $hToggle == 'heading' ) {
            echo '<' . $hTag . ' class="contact-block--split__form-title ' . $hClass . '" style="color:' . $txtColor . '">' . $hText . '</' . $hTag . '>';

          } elseif ( $hToggle == 'styled' ) {

            echo '<div class="contact-block--split__form-title ' . $hTag  . ' ' . $hClass   . '" style="color:' . $txtColor . '">' . $hText . '</div>';
          }
          else {
            echo '<div>Error duder</div>';
          }
        }
        ?>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-md-8 offset-md-2">
        <div class="gravity-form-home">
          <?php gravity_form(1, false, false, false, '', true); ?>
        </div>
      </div>
    </div>
  </div>
</section>
