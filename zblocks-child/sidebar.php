<?php
/**
* The sidebar containing the main widget area
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WP_Bootstrap_Starter
*/

?>

<aside id="secondary" class="widget-area col-sm-12 col-lg-4 <?php if(is_page( 'why-choose-us' )) { echo "order-first order-lg-0"; } ?>" role="complementary">
	<div class="sidebar-content">
    <?php
    if(is_page( 'white-collar-criminal-defense' )) { ?>
		<div class="sidebar__child-pages sidebar-content__item">
			<div class="sidebar__related-service-title h3">Areas We Serve</div>
				<map title="Related content pages" id="sidebar__related-content">
					<ul class="sub-page-list sidebar__sub-page-list">
                        <li class="page_item">
                        <a href="/practice-areas/white-collar-criminal-defense-savannah/">Savannah</a></li>
                        <li class="page_item">
                        <a href="/practice-areas/white-collar-criminal-defense-atlanta/">Atlanta</a></li>
                      </ul>
					</map>
			</div> <?php } ?>
        
         <?php
    if(is_page( 'catastrophic-injuries' )) { ?>
		<div class="sidebar__child-pages sidebar-content__item">
			<div class="sidebar__related-service-title h3">Areas We Serve</div>
				<map title="Related content pages" id="sidebar__related-content">
					<ul class="sub-page-list sidebar__sub-page-list">
                        <li class="page_item">
                        <a href="/practice-areas/catastrophic-injuries-atlanta/">Atlanta</a></li>
                        <li class="page_item">
                        <a href="/practice-areas/catastrophic-injuries-savannah/">Savannah</a></li>
                      </ul>
					</map>
			</div> <?php } ?>
        
                
		<?php
		$hide_related_content = get_field( 'hide_related_content_sidebar' );
		if(is_page( 'why-choose-us' )) { ?>
			<figure class="why-us-img h-100 text-center">
				<img src="/wp-content/uploads/2021/02/why-us.jpg" alt="" role="presentation"/>
			</figure> 
		<?php } else {		
		if($hide_related_content == 0 ) {
			global $post;
			$parentID = get_field('parent-page-id');
			$pageChildren = wp_list_pages( 'sort_column=post_name&title_li=&child_of='. $parentID .'&echo=0&depth=1' );

			$children = wp_list_pages( 'sort_column=post_name&title_li=&child_of='.$post->ID.'&echo=0&depth=1' );
			$siblings = wp_list_pages( 'sort_column=post_name&title_li=&child_of='.$post->post_parent.'&echo=0&exclude='.$post->ID.'&depth=1');
			
			// if page is pulling specific page id for child pages
			if ( $parentID && $pageChildren ) { ?>
				<div class="sidebar__child-pages sidebar-content__item">
					<div class="sidebar__related-service-title h3">Related Content</div>
					<map title="Related content pages" id="sidebar__related-content">
						<ul class="sub-page-list sidebar__sub-page-list">
							<?php echo $pageChildren; ?>
						</ul>
					</map>
				</div>
			<?php }
			// if page is child with sibling pages display sibling pages
			elseif ( is_page() && $post->post_parent && !$children && $siblings ) { ?>
				<div class="sidebar__child-pages sidebar-content__item">
					<div class="sidebar__related-service-title h3">Related Content</div>
					<map title="Related content pages" id="sidebar__sibling-content">
						<ul class="sub-page-list sidebar__sub-page-list">
                <li class="just-page"><a href="https://griffindurham.com/practice-areas/white-collar-criminal-defense-atlanta/civil-controlled-substances-act/">Atlanta Controlled Substance Act (CSA) Lawyers</a></li>
							<?php echo $siblings; ?>
						</ul>
					</map>
				</div>
			<?php }
			// if page is parent with children pages display child pages
			elseif ( is_page() && $children ) { ?>
				<div class="sidebar__child-pages sidebar-content__item">
					<div class="sidebar__related-service-title mb-2 h3">Related Content</div>
					<map title="Related content pages" id="sidebar__related-content">
						<ul class="sub-page-list sidebar__sub-page-list">
							<?php echo $children; ?>
						</ul>
					</map>
				</div>
			<?php }
		} ?>

		<div class="sidebar-sticky">
			<div class="sidebar__form sidebar-content__item">
				<div class="widget-title h3">Contact Us Online</div>
				<?php	gravity_form( 2, false, false, false, '', true );	?>
			</div>
			<?php if (get_field('featured_attorney')): ?>
			<div class="sidebar__attorney sidebar-content__item">
				<?php echo do_shortcode('[elementor-template id="' . get_field('featured_attorney') . '"]'); ?>
			</div>
			<?php endif; ?>

			<div class="sidebar-content__item">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div>

			<?php if(is_blog()) { ?>
				<div class="blog-cats sidebar-content__item">
					<h3 class="widget-title">Categories</h3>
					<?php
					echo '<ul class="sidebar-posts-list nav flex-column">';
					wp_list_categories( array(
						'orderby'    => 'name',
						'show_count' => false, // change to false to hide post count
						'title_li' => '' // leave empty to remove default title in <li> tag
					) );
					echo '</ul>';
					?>
				</div>
			<?php } else { ?>

				<?php
				$catID = get_field ( 'category_id_posts' );
				if ( $catID ) {
					$catquery = new WP_Query( array (
						'category_name' => $catID,
						'posts_per_page' => 5,
					)
				);
				?>

				<?php if( $catID && $catquery->have_posts() ) : ?>
					<div class="sidebar__related-posts  sidebar-content__item">
						<div class="widget-title h3">Recent Posts</div>
						<ul class="sidebar-posts-list nav flex-column">
							<?php while($catquery->have_posts()) : $catquery->the_post(); ?>
								<li class="nav-item">
									<a class="nav-link" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
					<?php
				endif;
				wp_reset_postdata(); }
				else {
					$the_query = new WP_Query( 'posts_per_page=5' );
					if ( $the_query->have_posts() ) : ?>
					<div class="sidebar__related-posts  sidebar-content__item">
						<div class="widget-title h3">Recent Posts</div>
						<ul class="sidebar-posts-list nav flex-column">
							<?php while ($the_query -> have_posts()) : $the_query -> the_post();
							?>
							<li class="nav-item">
								<a class="nav-link" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
							</li>
						<?php	endwhile; ?>
					</ul>
				</div>
			<?php endif;
			wp_reset_postdata(); } ?>
		<?php } ?>


		<?php if( get_field( 'header_mutli_location', 'option' ) == 0 ) : ?>
			<div class="sidebar__map-embed  sidebar-content__item">
				<div class="widget-title h3">Our Office</div>
				<?php the_field( 'map_embed_code', 'option' ); ?>
				<address class="sidebar__map-address mt-4 text-center f7">
					<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						<span itemprop="streetAddress">
							<?php the_field( 'firm-address_street', 'option' ); ?></span><br/>
							<span itemprop="addressLocality">
								<?php the_field( 'firm-address_city', 'option' ); ?></span>,
								<span itemprop="addressRegion"><?php the_field( 'firm-address_state', 'option' ); ?></span>
								<span itemprop="postalCode"><?php the_field( 'firm-address_zip', 'option' ); ?></span>
							</span>
						</address>
					</div>
				<?php endif; ?>
			</div>
		<?php } ?>
		</div>
	</aside><!-- #secondary -->