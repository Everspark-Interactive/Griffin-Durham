<?php
$hTag = get_sub_field( 'heading-tag' );
$hText = get_sub_field( 'heading-txt' );
$hClass = get_sub_field( 'heading-class' );
$hData = get_sub_field( 'heading_data_attributes' );

// if headline tag else styled class
if ( $hText ) {
  echo '<' . $hTag . ' class="headline ' . $hClass . '" '. $hData .'>' . $hText . '</' . $hTag . '>';

}
?>
