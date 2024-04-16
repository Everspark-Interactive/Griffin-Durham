<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
    $enable_vc = get_post_meta(get_the_ID(), '_wpb_vc_js_status', true);
    if(!$enable_vc ) {
    ?>
		<header class="entry-header">
			<?php
			$seoTitle = get_field('the_seo_title');
			if ($seoTitle) {
				echo '<h1 class="entry-title">'. $seoTitle .'</h1>';
			}
			?>
		</header><!-- .entry-header -->
    <?php } ?>
<?php if ( has_post_thumbnail() ) : ?>
		<figure class="content-page__img-figure">
		  <?php the_post_thumbnail(); ?>
		</figure>
<?php endif; ?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-starter' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
