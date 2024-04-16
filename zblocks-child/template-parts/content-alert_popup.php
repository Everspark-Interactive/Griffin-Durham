<?php
  $popupTxt = get_field( 'popup_text' );
  $alertTxt = get_field( 'alert_text' );

  if ( get_field( 'enable_popup' ) == 1 ) {
    echo '<div class="popup__container" id="popup">
      <div class="popup__content container f5-xl">'.$popupTxt.'
      <a class="btn popup__control" href="#popup" onclick="closePopup()">Close</a></div>
    </div>

    <script>
    document.body.classList.add("popup__locked");

    function closePopup() {
        document.getElementById("popup").style.display = "none";
        document.body.classList.remove("popup__locked");
    }
    </script>';
  }
  elseif ( get_field( 'enable_alert' ) == 1 ) {
    echo '<div class="alert__container pt-2 pb-2" id="alert">
      <div class="alert__content container f8 f7-md f6-xl">'.$alertTxt.'
      <a class="alert__control" href="#alert" onclick="closeAlert()"><span class="sr-only">Close alert </span><i class="fas fa-times"></i></a></div>
    </div>

    <script>
    function closeAlert() {
        document.getElementById("alert").style.display = "none";
    }
    </script>';
  }
?>
