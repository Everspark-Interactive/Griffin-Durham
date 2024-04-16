<?php
// Menu container
$menuFont = get_field( 'menu_font','options' );
$menuBG = get_field( 'menu_bg', 'options' );
$menuClasses = array();
array_push ($menuClasses, $menuFont, $menuBG);

// Menu parent ul
$menuAlign = get_field( 'menu_items_justifiy', 'option' );
$menuColor = get_field( 'menu_text_color', 'options' );
$menuHoverStyle = get_field( 'menu_hover_style', 'options' );
$menuHoverBg = get_field( 'menu_hover_bg', 'options' );
$menuHoverColor = get_field( 'menu_hover_txt', 'option' );

?>
<nav aria-label="Main Navigation" role="navigation" class="menu d-none d-md-block <?php foreach($menuClasses as $value){echo $value . " ";} ?>">
  <div class="container">
    <div class="row">
      <div class="col">
        <?php
        $args = array(
          'menu_class' => 'full-menu d-none d-xl-flex ' .  $menuAlign . ' '. $menuColor . ' ' . $menuHoverBg . ' ' . $menuHoverColor .' ' . $menuHoverStyle,
          'theme_location' => 'primary'
        );
        wp_nav_menu( $args );
        ?>
        <div class="d-xl-none d-flex align-items-center justify-content-end mb-5">
          <button class="navbar-toggler f5 <?php echo $menuColor ?>" type="button" onclick="openNav()" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">Menu</button>
        </div>
      </div>
    </div>
  </div>
</nav>
