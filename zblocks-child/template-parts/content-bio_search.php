<?php if ( is_search() ) { ?>
  <header class="page-header">
  <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'wp-bootstrap-starter' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
</header><!-- .page-header -->
<?php } ?>

<form role="search" method="get" class="search-form search-form--bio mb-5" action="<?php echo esc_url( home_url() ); ?>">
  <label><span class="accessible-hide">Search team members</span>
    <input type="hidden" value="1" name="sentence" />
    <input type="hidden" name="post_type" value="team" />
      <input type="search" class="search-field form-control" placeholder="Search team members …" value="" name="s" title="Search for:">
  </label>
  <input type="submit" class="search-submit search-submit--bio btn btn-default" value="Search">
</form>
