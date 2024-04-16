<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WP_Bootstrap_Starter
*/

$firmName = get_field( 'firm_name', 'option' );
$slogan = get_field( 'hero_slogan', 'option' );
$sloganDesc = get_field( 'hero_description', 'option' );
$hero_image = get_field( 'hero_image', 'options' );
$hero_video_mobile_image = get_field( 'hero_video_mobile_image', 'options' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-focus-outline">
<head>
  <!-- Hide page until loaded to prevent FOUC / This is overwritten at the end of the style.scss stylesheet -->
  <style>
  :root {
    --color-prime: <?php the_field( 'color_prime', 'option' ); ?>;
    --color-second: <?php the_field( 'color_second', 'option' ); ?>;
    --color-tert: <?php the_field( 'color_tert', 'option' ); ?>;
    --color-quart: <?php the_field( 'color_quart', 'option' ); ?>;
    --color-quint: <?php the_field( 'color_quint', 'option' ); ?>;
  }
  html { visibility: hidden;opacity:0; }
  </style>

  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php if( $hero_image ) { ?>
    <meta property="og:image" content="<?php echo esc_url( $hero_image['url'] ); ?>" />

  <?php } else { ?>
    <meta property="og:image" content="<?php echo esc_url( $hero_video_mobile_image['url'] ); ?>" />

    <meta property="og:image:secure_url" content="<?php echo esc_url( $hero_video_mobile_image['url'] ); ?>" />
  <?php }  ?>
  <meta property="og:description"
  content="<?php if($slogan) {
    echo strip_tags($slogan);
  } if($sloganDesc) {
    echo ' '.strip_tags($sloganDesc);
  } ?>" />

  <?php
  $twitter = get_field( 'social-twitter', 'option' );
  if ($twitter) {
    preg_match("/https:\/\/twitter.com\/(#!\/)?([^\/]*)/", $twitter, $match);
    $twitterName = $match[2]; ?>
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@<?php echo $twitterName; ?>">
    <meta name="twitter:creator" content="@<?php echo $twitterName; ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $hero_image['url'] ); ?>">
  <?php }  ?>

  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#a3151b">
  <meta name="msapplication-TileColor" content="#2b5797">
  <meta name="theme-color" content="#ffffff">

  <!-- Load Boostrap css inline -->
  <?php get_template_part( 'template-parts/boostrap-include' ); ?>
<script async src="//372660.tctm.co/t.js"></script>

	
	
  <?php
  wp_head();
  require_once 'Mobile_Detect.php';
  ?>
</head>

<body <?php body_class(); ?>>

  <div id="page" class="site">
    <!-- Popup / Alert code  -->
    <?php get_template_part( 'template-parts/content', 'alert_popup' ); ?>

    <a class="skip-link screen-reader-text" href="#content">
      <?php esc_html_e( 'Skip to content', 'wp-bootstrap-starter' ); ?></a>

      <!-- Cookie banner -->
      <?php if ( get_field( 'enable_cookie_banner', 'options' ) == "1" ) : $cookie_banner_text = get_field( 'cookie_banner_text', 'options' ); ?>
        <div class="cookie-banner" style="display: none">
          <div class="container">
            <div class="row">
              <div class="col-12 d-flex justify-content-between align-items-center">
                <div class="cookie-banner__desc mr-4 f7 f6-xl">
                  <?php echo $cookie_banner_text; ?>
                </div>
                <button class="cookie-banner__close">Accept</button>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php
      $header_theme = get_field( 'hero_style', 'option' );

      if( $header_theme == 'overlay' ) {
        get_template_part( 'header-blocks/header-overlay' );
      }
      elseif( $header_theme == 'impact' ) {
        get_template_part( 'header-blocks/header-impact' );
      }
      elseif( $header_theme == 'stream' ) {
        get_template_part( 'header-blocks/header-stream' );
      }
      elseif( $header_theme == 'fluid-stream' ) {
        get_template_part( 'header-blocks/header-fluid' );
      }
      elseif( $header_theme == 'half' ) {
        get_template_part( 'header-blocks/header-half' );
      }
      else {
        echo '<p>Error: No header selected.</p>';
      }
      ?>
      <?php if(!is_front_page() && !is_page_template('page-templates/zblocks-page.php') && !is_singular( 'team' ) ) :?>
        <header class="header-inner-page">
          <?php
          $page_header_image = get_field( 'page_header_image' );
          if ( $page_header_image ) {
            ?>
            <img class="header-inner-page__img" loading="lazy" src="<?php echo $page_header_image['url']; ?>" alt="<?php echo $page_header_image['alt']; ?>" src="/wp-content/uploads/2020/05/transparent-pixel.png" />
          <?php }  ?>
          <div class="header-inner-page__content <?php if($page_header_image) { echo 'position-xl-absolute'; } ?>">
            <div class="header-inner__title-container">
              <div class="container-fluid container--margin">
                <div class="row">
                  <div class="col-12">
                    <?php if ( is_page() ) {
                      $seoTitle = get_field('the_seo_title');
                      //if(is_page(2424) || $post->post_parent == 2424 ){
                        if(in_array('2424', get_ancestors($post->ID, 'page')) || is_page(2524)){
                       $clss="dsplynone"; }
                      if ($seoTitle) {
                        the_title( '<div class="mb-0 headline f3 f2-md f1-lg header-inner-page__title '.$clss.'"><span>', '</span></div>' );
                      } else {
                        the_title( '<h1 class="mb-0 f3 f2-md f1-lg header-inner-page__title '.$clss.'"><span>', '</span></h1>' );
                      }
                    } elseif ( is_archive() ) {
                      the_archive_title( '<h1 class="mb-0 f3 f2-md f1-lg header-inner-page__title">', '</h1>' );
                    } elseif (is_blog ()) {
                      $blog_title = get_the_title( get_option('page_for_posts', true) );
                      echo '<div class="mb-0 headline f3 f2-md f1-lg header-inner-page__title">'.$blog_title.'</div>';
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </header>
        <div class="container-fluid container--margin">
          <div class="row">
            <div class="col">
              <div class="breadcrumbs">
                <?php yoast_breadcrumb( '<div id="breadcrumbs">','</div>' ); ?>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php if(is_front_page() || is_page_template('page-templates/zblocks-page.php') || is_post_type_archive('results')  || is_post_type_archive('team') || is_singular('team')) {
        // Tags close in footer.php
        echo
        '<div id="content" class="site-content">';
      }
      else {
        echo
        '<div id="content" class="site-content">
        <div class="container">
        <div class="row">';
      }
      ?>
