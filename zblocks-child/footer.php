<?php
/**
* The template for displaying the footer
*
* Contains the closing of the #content div and all content after.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WP_Bootstrap_Starter
*/

?>


<?php if(is_front_page() || is_page_template('page-templates/zblocks-page.php') || is_post_type_archive('results')  || is_post_type_archive('team') || is_singular('team')) {
	// Closes tags from header.php
	echo
	'</div><!-- #content -->';
}
else {
	echo
	'		</div><!-- .row -->
	</div><!-- .container -->
	</div><!-- #content -->';
}
?>

<?php if ( have_rows( 'add_loctions_repeater', 'option' ) && (!is_front_page()) && !is_page_template( array( 'page-templates/contact-page.php', 'page-templates/contact-multi-address-page.php', 'page-templates/zblocks-page.php' ) ) && ( get_field( 'header_mutli_location', 'option' ) == 1 ) ) : ?>
	<footer class="footer__multi-locations pt-4 pb-4 f7 text-center bg-quint">
		<div class="container">
			<div class="row">
				<div class="col-lg">
					<div class="footer_mutli-loc-item mb-4 mb-lg-0">
						<div class="footer__multi-loc-map">
							<?php the_field( 'map_embed_code', 'option' ); ?>
						</div>
						<br/>
						<!-- Address, full  -->
						<?php get_template_part( 'template-parts/content-address-full' ); ?>
					</div>
				</div>
				<?php if ( have_rows( 'add_loctions_repeater', 'option' ) && ( get_field( 'header_mutli_location', 'option' ) == 1 ) ) : ?>
					<?php while ( have_rows( 'add_loctions_repeater', 'option' ) ) : the_row(); ?>
						<div class="col-lg">
							<div class="footer_mutli-loc-item mb-4 mb-lg-0">
								<div class="footer__multi-loc-map">
									<?php the_sub_field( 'map_embed_code' ); ?>
								</div>
								<br/>
								<?php
								$street = get_sub_field( 'firm-address_street' );
								$city = get_sub_field( 'firm-address_city' );
								$state = get_sub_field( 'firm-address_state' );
								$zip = get_sub_field( 'firm-address_zip' );

								echo '<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
								<span itemprop="streetAddress">' . $street . '</span><br/>
								<span itemprop="addressLocality">' . $city . '</span>,
								<span itemprop="addressRegion">' . $state . '</span>
								<span itemprop="postalCode">' . $zip . '</span></span>';
								?>
								<?php if ( get_sub_field( 'appointment_only', 'options' ) ) : ?>
								<br/><strong>By appointment only</strong>
								<?php endif; ?>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</footer>
<?php endif; ?>
<footer class="footer-main">
	<nav class="mobile-nav d-flex d-md-none bg-prime">
		<?php if ( get_field( 'header_mutli_location', 'option' ) == 1 ) : ?>
			<!-- Button trigger modal -->
			<a href="javascript:void(0);" class="mobile-nav__link f7" data-toggle="modal" data-target="#callModal"><i class="fas fa-mobile-alt mobile-nav__icon"></i> Call</a>
		<?php else : ?>
			<a href="tel:<?php the_field( 'firm_phone', 'option' ); ?>" target="_self" class="mobile-nav__link f7 color-white"><i class="fas fa-mobile-alt mobile-nav__icon"></i> Call</a>
		<?php endif; ?>

		<a href="javascript:void(0);" onclick="openNav()" class="mobile-nav__link f7"><i class="fas fa-bars mobile-nav__icon"></i> Menu</a>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>contact" target="_top" class="mobile-nav__link f7"><i class="fas fa-envelope-open-text mobile-nav__icon"></i> Contact</a>
	</nav>
	<!-- Modal -->
	<div class="modal fade" id="callModal" tabindex="-1" role="dialog" aria-labelledby="callModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog--call" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="modal-title mb-0 headline f4" id="callModalLabel">Call Our Firm</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body modal-body--call">
					<div class="mobile__office-tel">
						<div class="mb-1 f8">
							<?php
							$alias = get_field( 'address_alias', 'option' );
							if($alias) {
								echo '<span class="contact__address-alias">'.$alias.'</span>';
							} else {
								$city = get_field( 'firm-address_city', 'option' );
								echo '<span class="contact__address-alias">'.$city.' Office</span>';
							} ?>
						</div>
						<a class="f3" href="tel:<?php the_field( 'firm_phone', 'option' ); ?>"><span itemprop="telephone" content="<?php the_field( 'firm_phone', 'option' ); ?>"><span class="sr-only">Call our office </span><?php the_field( 'firm_phone', 'option' ); ?></span>
						</a>
					</div>

					<?php if ( have_rows( 'add_loctions_repeater', 'option' ) ) : ?>
						<?php while ( have_rows( 'add_loctions_repeater', 'option' ) ) : the_row(); ?>
							<div class="mobile__office-tel mt-3">
								<div class="mb-1 f8">
									<?php
									$alias = get_sub_field( 'address_alias' );
									$city = get_sub_field( 'firm-address_city' );
									if($alias) {
										echo '<span class="contact__address-alias">'.$alias.'</span>';
									} else {
										echo '<span class="contact__address-alias">'.$city.' Office</span>';
									} ?>
								</div>
								<a class="f3" href="tel:<?php the_sub_field( 'firm_phone' ); ?>"><span itemprop="telephone" content="<?php the_sub_field( 'firm_phone' ); ?>"><span class="sr-only">Call our office </span><?php the_sub_field( 'firm_phone' ); ?></span></a>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid container--margin">
		<div class="row align-items-lg-center">
			<div class="col-8 offset-2 col-sm-6 offset-sm-3 col-lg-4 offset-lg-0 col-xl-2 offset-xx-1">
				<?php
				$headerLogo = get_field( 'firm_logo', 'option' );
				$footerLogo = get_field( 'firm_logo-footer', 'option' );
				$firmName = get_field( 'firm_name', 'option' );
				if (!empty($footerLogo))
				{
					echo '
					<figure class="m-lg-0 text-center text-lg-left">
					<img class="footer-logo" src="' . $footerLogo . '" alt="'. $firmName .'"/>
					</figure>';
				}
				else {
					echo '
					<figure class="m-lg-0 text-center text-lg-left">
					<img class="footer-logo" src="' . $headerLogo['url'] . '" alt="'. $firmName .'"/>
					</figure>';
				}	?>
			</div>
			<div class="col-12 col-lg col-xx-8 text-center text-lg-right">
				<div class="footer-social f6">
					<!-- Social icons  -->
					<?php get_template_part( 'template-parts/content-social-icons' ); ?>
				</div>
				<p class="f8 f7-lg m-0 fw-400">&copy;&nbsp;<?php echo date("Y"); ?> <?php the_field( 'firm_name', 'option' ); ?> |
					<?php
					$city = get_field( 'firm-address_city', 'option' );
					$tel = get_field( 'firm_phone', 'option' );
					$fax = get_field ( 'firm_fax', 'option' );
					if ( get_field( 'header_mutli_location', 'option' ) == 1 ) {
						echo '<strong>'.$city.'</strong> <a class="color-copy" href="tel:' . $tel . '"><span itemprop="telephone" content="' . $tel . '">' . $tel . '</span></a>';
						if ( have_rows( 'add_loctions_repeater', 'option' ) ) {
							while ( have_rows( 'add_loctions_repeater', 'option' ) ) : the_row();
							$secCity = get_sub_field( 'firm-address_city' );
							$secTel = get_sub_field( 'firm_phone' );
							$secFax = get_sub_field( 'firm_fax' );
							echo '&nbsp;|&nbsp;<strong>'.$secCity.'</strong> <a class="color-copy" href="tel:' . $secTel . '"><span itemprop="telephone" content="' . $secTel . '">' . $secTel . '</span></a>';
						endwhile;
					}
				} else {
					echo '| P: <a class="color-copy" href="tel:' . $tel . '"><span itemprop="telephone" content="' . $tel . '">' . $tel . '</span></a>';
					if ($fax)	{
						echo ' | F: <a class="color-copy" href="tel:' . $fax . '"><span itemprop="faxNumber" content="' . $fax . '">' . $fax . '</span></a>';
					}
				}
				?>
				<br/>
				<?php if ( get_field( 'header_mutli_location', 'option' ) == 0 ) : ?>
					<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						<span itemprop="streetAddress">
							<?php the_field( 'firm-address_street', 'option' ); ?></span>,
							<span itemprop="addressLocality">
								<?php the_field( 'firm-address_city', 'option' ); ?></span>,
								<span itemprop="addressRegion"><?php the_field( 'firm-address_state', 'option' ); ?></span>
								<span itemprop="postalCode"><?php the_field( 'firm-address_zip', 'option' ); ?></span>
							</span><br/>
						<?php endif; ?>
						<?php
						$disclaimerLanguage = get_field( 'advertising_disclaimer', 'option' );
						if($disclaimerLanguage) {
							echo $disclaimerLanguage.'&nbsp;|&nbsp;';
						}
						?><a href="<?php echo get_site_url(); ?>/disclaimer/">Disclaimer / Privacy Policy</a> | <a href="https://griffindurham.com/careers/">Careers</a> <strong style="display: flex;     justify-content: flex-end; align-items: center; " > <a class="esi-footer-logo" target="_blank" style="display: flex; align-items: center; justify-content: center;" href="https://www.eversparkinteractive.com"><img style="width:150px;" src="http://griffindurham.com/wp-content/uploads/2023/04/everspark-interactive-b-logo.png" alt="everspark interactive logo" ></a></strong>
				</p>
			</div>
		</div>
	</div>
</footer>

<!-- ADA Language  -->
<?php get_template_part( 'template-parts/content-ada-language' ); ?>

</div> <!-- end of #page -->

<!-- Fixed header code  -->
<?php get_template_part( 'header-blocks/header-fixed' ); ?>

<!-- Popup menu code -->
<div id="popup-nav" class="popup-nav__overlay invisible"> <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	<div class="popup-nav__content">
            <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container_id' => 'cssmenu',
            'menu_class' => 'mobile-menu',
            'walker' => new CSS_Menu_Maker_Walker(),
            'link_before' => '<span>',
            'link_after' => '</span>'
        ));
    ?>
	</div>
</div>

<?php if( current_user_can('editor') || current_user_can('administrator') ) {
	// Edit this page tab code
	echo '<div class="admin-footer">
	<div class="zblocks-edit-post-links"><a href="'.esc_url( home_url() ).'/wp-admin/index.php">Dash</a> | ';
	edit_post_link( __( 'Edit', 'textdomain' ), '&nbsp;', '&nbsp;', null );
	echo ' |&nbsp; <a href="'.esc_url( home_url() ).'/wp-admin/theme-editor.php">Edit Theme</a>
	</div>
	</div>';
} ?>

<?php wp_footer(); ?>
<style>
/* Footer*/
 pointer-events: unset !important;
.footer__multi-locations {display:none !important;}
</style>
</body>
</html>