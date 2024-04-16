<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */
 $content = apply_filters( 'the_content', get_the_content() ); // Stores the_content in $content
 $word_count = str_word_count( strip_tags( $content ) ); // Counts the words in $content
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="blog-page__post">
    <?php
    // Must be inside a loop.

    if ( has_post_thumbnail() ) {
        echo  '<figure class="post-thumbnail">' . the_post_thumbnail('medium_large', array('class' => 'post-thumbnail'), ['loading'=>'lazy']) . '</figure>';
    }
    ?>
	<header class="entry-header">
		<?php
		if ( is_front_page() ) :
			the_title( '<h2 class="entry-title h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" style="text-decoration: none;">', '</a></h2>' );
		else :
			the_title( '<h2 class="entry-title h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" style="text-decoration: none;">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php wp_bootstrap_starter_posted_on(); ?> by <a href="https://griffindurham.com/author/griffin-durham-tanner-clarkson/">Griffin Durham Tanner & Clarkson</a>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
    <?php
				if( 'video' === get_post_type() ) { ?>
				<?php get_template_part( 'template-parts/content', 'video-iframe' ); ?>
			<?php } ?>
      <div class="blog-page__excerpt">
          <?php
          $postExcerpt = excerpt(55);
          echo strip_tags($postExcerpt, '<p><br>');
          ?>
        </div>

    <?php if($word_count > 55) { ?>
    <a href="<?php echo get_permalink(); ?>" rel="bookmark" style="text-decoration: none;" class="blog__read-more f5">Continue reading&mldr;</a>
    <?php } ?>
	</div><!-- .entry-content -->

  </div>
</article><!-- #post-## -->
