<?php
// Uncomment if custom post type pages are giving a page not found error
// make sure to add comment back before uploading to WP Engine
//flush_rewrite_rules( false );

// Enque web fonts
function load_web_fonts() {
	wp_enqueue_style( 'web-fonts', '//fonts.googleapis.com/css2?family=Cormorant+Garamond:ital@0;1&family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400', [], null );
}
add_action( 'wp_enqueue_scripts', 'load_web_fonts' );

/*
 * Function for post duplication. Dups appear as drafts. User is redirected to the edit screen
 */
function rd_duplicate_post_as_draft(){
  global $wpdb;
  if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
    wp_die('No post to duplicate has been supplied!');
  }

  /*
   * Nonce verification
   */
  if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
    return;

  /*
   * get the original post id
   */
  $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
  /*
   * and all the original post data then
   */
  $post = get_post( $post_id );

  /*
   * if you don't want current user to be the new post author,
   * then change next couple of lines to this: $new_post_author = $post->post_author;
   */
  $current_user = wp_get_current_user();
  $new_post_author = $current_user->ID;

  /*
   * if post data exists, create the post duplicate
   */
  if (isset( $post ) && $post != null) {

    /*
     * new post data array
     */
    $args = array(
      'comment_status' => $post->comment_status,
      'ping_status'    => $post->ping_status,
      'post_author'    => $new_post_author,
      'post_content'   => $post->post_content,
      'post_excerpt'   => $post->post_excerpt,
      'post_name'      => $post->post_name,
      'post_parent'    => $post->post_parent,
      'post_password'  => $post->post_password,
      'post_status'    => 'draft',
      'post_title'     => $post->post_title,
      'post_type'      => $post->post_type,
      'to_ping'        => $post->to_ping,
      'menu_order'     => $post->menu_order
    );

    /*
     * insert the post by wp_insert_post() function
     */
    $new_post_id = wp_insert_post( $args );

    /*
     * get all current post terms ad set them to the new post draft
     */
    $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
    foreach ($taxonomies as $taxonomy) {
      $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
      wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
    }

    /*
     * duplicate all post meta just in two SQL queries
     */
    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
    if (count($post_meta_infos)!=0) {
      $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
      foreach ($post_meta_infos as $meta_info) {
        $meta_key = $meta_info->meta_key;
        if( $meta_key == '_wp_old_slug' ) continue;
        $meta_value = addslashes($meta_info->meta_value);
        $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
      }
      $sql_query.= implode(" UNION ALL ", $sql_query_sel);
      $wpdb->query($sql_query);
    }


    /*
     * finally, redirect to the edit post screen for the new draft
     */
    wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
    exit;
  } else {
    wp_die('Post creation failed, could not find original post: ' . $post_id);
  }
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );

/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
  if (current_user_can('edit_posts')) {
    $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
  }
  return $actions;
}

add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );



// Allow Webp Uploads
function webp_file_and_ext( $mime, $file, $filename, $mimes ) {

    $wp_filetype = wp_check_filetype( $filename, $mimes );
    if ( in_array( $wp_filetype['ext'], [ 'webp' ] ) ) {
        $mime['ext']  = true;
        $mime['type'] = true;
    }

    return $mime;
}
add_filter( 'wp_check_filetype_and_ext', 'webp_file_and_ext', 10, 4 );

function add_webp_mime_type( $mimes ) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter( 'upload_mimes', 'add_webp_mime_type' );

// Allow vcard upload
function vcard_allowed( $mime_types ){
	$mime_types['vcf'] = 'text/vcard';
	return $mime_types;
}
add_filter('upload_mimes', 'vcard_allowed' );

// Short code for content highlight [highlight]***[/highlight]
function content_highlight( $atts, $content = null, $tag = '' ) {
	$a = shortcode_atts( array(
		'title' => 'Title',
	), $atts );
	$output = '<div class="content-highlight">' . $content . '</div>';
	return $output;
}
add_shortcode( 'highlight', 'content_highlight' );

// Adds a shortcode to display responsive youtube videos with [yt-embed id="X"]
function yt_video_shortcode($atts) {
	extract(shortcode_atts(array(
		'id' => 1,
	), $atts));

	$ytEmbed = '<div class="embed-responsive embed-responsive-16by9 mb-5">
	<iframe class="embed-responsive-item" loading="lazy" src="https://www.youtube.com/embed/'.$id.'?rel=0" allowfullscreen></iframe>
		</div>';

		return $ytEmbed;
	}
	add_shortcode('yt-embed', 'yt_video_shortcode');

	// Adds a shortcode to display responsive vimeo videos with [vimeo-embed id="X"]
	function vimeo_video_shortcode($atts) {
		extract(shortcode_atts(array(
			'id' => 1,
		), $atts));

		$embed = '<div class="embed-responsive embed-responsive-16by9 mb-5">
		<iframe class="embed-responsive-item" loading="lazy" src="https://player.vimeo.com/video/'.$id.'" allowfullscreen></iframe>
			</div>';

			return $embed;
		}
		add_shortcode('vimeo-embed', 'vimeo_video_shortcode');

		// Adds a shortcode to display child pages with [child-pages]
		function wpb_list_child_pages() {
			global $post;
			$childpages = wp_list_pages( 'sort_column=post_name&title_li=&child_of=' . $post->ID . '&echo=0&depth=1' );
			if ( $childpages ) {
				$string = '<ul class="sub-page-list">' . $childpages . '</ul>';
			}
			return $string;
		}
		add_shortcode('child-pages', 'wpb_list_child_pages');

		// Prevents any user from accessing the Appearance > Customize menu
		add_filter('map_meta_cap', function($caps, $cap, $user_id, $args) {
			if ('customize' == $cap) return ['do_not_allow'];
			return $caps;
		}, 10, 4);

		function remove_unnecessary_wordpress_menus(){
			global $submenu;
			unset($submenu['themes.php'][11]);
			unset($submenu['themes.php'][12]);
		}
		add_action('admin_menu', 'remove_unnecessary_wordpress_menus', 999);

		// Deque theme defaults
		function dequeue_defaults() {
			// Dequeue fontawesome free
			wp_dequeue_style( 'wp-bootstrap-starter-fontawesome-cdn' );
			// Dequeue boostrap
			wp_dequeue_style( 'wp-bootstrap-starter-bootstrap-css' );
			// Dequeue popper.js
			wp_dequeue_script( 'wp-bootstrap-starter-popper' );
			// Deregister wp-embed-min.js
			wp_deregister_script( 'wp-embed' );
			// Dequeue skip-link-focus-fix.min.js
			wp_dequeue_script( 'wp-bootstrap-starter-skip-link-focus-fix' );
			// Dequeue theme-script.min.js
			wp_dequeue_script('wp-bootstrap-starter-themejs');
		}
		add_action( 'wp_print_styles', 'dequeue_defaults' );

		// Deque gutenberg css on front_page only
		function smartwp_remove_wp_block_library_css(){
			if ( is_front_page() ) {
				wp_dequeue_style( 'wp-block-library' );
				wp_dequeue_style( 'wp-block-library-theme' );
				wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
			}
		}
		add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

		// Deregister default theme CSS file
		function my_deregister_styles() {
			wp_deregister_style('wp-bootstrap-starter-style');
		}
		add_action('wp_print_styles', 'my_deregister_styles', 100);

		// Enque child theme styles
		function zblocks_enqueue_style() {
			wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/css/style.css',	array(), filemtime(get_stylesheet_directory() . '/css/style.css') );
		}
		add_action( 'wp_enqueue_scripts', 'zblocks_enqueue_style', 1 );

		// Update Jquery to latest version
		function replace_core_jquery_version() {
			// Deregister WP core jQuery
			wp_dequeue_script('jquery');
			wp_deregister_script( 'jquery' );
			// Deregister WP jQuery
			wp_deregister_script( 'jquery-core' );
			// Deregister WP jQuery Migrate
			wp_deregister_script( 'jquery-migrate' );

			// Re-add latest jquery ver
			wp_register_script( 'jquery', "//code.jquery.com/jquery-3.5.1.min.js", '', '3.5.1', true );
			wp_enqueue_script('jquery');
		}
		add_action( 'wp_enqueue_scripts', 'replace_core_jquery_version' );

		// Register + re-enque fontawesome pro
		function load_fontawesome_kit() {
			wp_register_script( 'font-awesome-pro', "https://kit.fontawesome.com/997b2a3cbf.js", array(), '5.15.1', true );
			wp_enqueue_script('font-awesome-pro');
		}
		add_action( 'wp_enqueue_scripts', 'load_fontawesome_kit', 0 );

		// Register + re-enque custom scripts file
		function load_sig_scripts() {
			wp_register_script( 'sig-scripts', get_stylesheet_directory_uri() . '/js/signature.js', array('jquery'), filemtime(get_stylesheet_directory() . '/js/signature.js'), true );
			wp_enqueue_script('sig-scripts');
		}
		add_action( 'wp_enqueue_scripts', 'load_sig_scripts', 0 );

    // Load swiper carousel js on front_page only
    function load_swiper_script() {
      if ( is_front_page() ) {
        wp_register_script( 'swiper-script', get_stylesheet_directory_uri() . '/js/swiper.js', array('jquery'), filemtime(get_stylesheet_directory() . '/js/swiper.js'), true );
  			wp_enqueue_script('swiper-script');
      }
    }
    add_action( 'wp_enqueue_scripts', 'load_swiper_script', 0 );

		// Remove emoji styles & scripts
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('admin_print_scripts', 'print_emoji_detection_script');
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_action('admin_print_styles', 'print_emoji_styles');

		// Remove the word archive from archive page titles
		//https://www.binarymoon.co.uk/2017/02/hide-archive-title-prefix-wordpress/
		function hap_hide_the_archive_title( $title ) {
			// Skip if the site isn't LTR, this is visual, not functional.
			// Should try to work out an elegant solution that works for both directions.
			if ( is_rtl() ) {
				return $title;
			}
			// Split the title into parts so we can wrap them with spans.
			$title_parts = explode( ': ', $title, 2 );
			// Glue it back together again.
			if ( ! empty( $title_parts[1] ) ) {
				$title = wp_kses(
					$title_parts[1],
					array(
						'span' => array(
							'class' => array(),
						),
					)
				);
				$title = '<span class="screen-reader-text">' . esc_html( $title_parts[0] ) . ': </span>' . $title;
			}
			return $title;
		}
		add_filter( 'get_the_archive_title', 'hap_hide_the_archive_title' );

		// Add custom Edit Front Page menu item to Wordpress backend
		add_action( 'admin_menu', 'frontpage_url' );
		function frontpage_url() {
			add_menu_page( 'frontpage_url', 'Edit Front Page', 'read', '/post.php?post=2&action=edit', '', 'dashicons-text', 3 );
		}

		// Allows you to reference all blog type pages with is_blog() with conditional statements
		// https://wordpress.stackexchange.com/questions/107141/check-if-current-page-is-the-blog-page
		function is_blog () {
			return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
		}

		// tn Limit Excerpt Length by number of words with echo excerpt(30);
		function excerpt( $limit ) {
			$excerpt = explode(' ', get_the_content(), $limit);
			if (count($excerpt)>=$limit) {
				array_pop($excerpt);
				$excerpt = implode(" ",$excerpt).'...';
			} else {
				$excerpt = implode(" ",$excerpt);
			}
			$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
			return $excerpt;
		}
		function content($limit) {
			$content = explode(' ', get_the_content(), $limit);
			if (count($content)>=$limit) {
				array_pop($content);
				$content = implode(" ",$content).'...';
			} else {
				$content = implode(" ",$content);
			}
			$content = preg_replace('/[.+]/','', $content);
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
			return $content;
		}

		// Change default excerpt ellipses
		function new_excerpt_more($more) {
			return '...';
		}
		add_filter('excerpt_more', 'new_excerpt_more');

		// Adds category class to body tag
		add_filter('body_class','add_category_to_single');
		function add_category_to_single($classes) {
			if (is_single() ) {
				global $post;
				foreach((get_the_category($post->ID)) as $category) {
					// add category slug to the $classes array
					$classes[] = $category->category_nicename;
				}
			}
			// return the $classes array
			return $classes;
		}

		//Excludes "Firm News" category from blog page
		function exclude_category($query) {
			if ( $query->is_home() ) {
				$query->set('cat', '-15');
			}
			return $query;
		}
		add_filter('pre_get_posts', 'exclude_category');

		// Hides BY AUTHOR on blog posts
		if ( ! function_exists( 'wp_bootstrap_starter_posted_on' ) ) :
			/**
			* Prints HTML with meta information for the current post-date/time and author.
			*/
			function wp_bootstrap_starter_posted_on() {
				$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
				if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
					$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
				}

				$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);

			$posted_on = sprintf(
				esc_html_x( 'Posted on %s', 'post date', 'wp-bootstrap-starter' ),
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);

			$byline = sprintf(
				esc_html_x( 'by %s', 'post author', 'wp-bootstrap-starter' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

			echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

		}
	endif;

	if ( ! function_exists( 'wp_bootstrap_starter_entry_footer' ) ) :
		/**
		* Prints HTML with meta information for the categories, tags and comments.
		*/
		function wp_bootstrap_starter_entry_footer() {
			// Hide category and tag text for pages.
			if ( 'post' === get_post_type() ) {
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ', ', 'wp-bootstrap-starter' ) );
				if ( $categories_list && wp_bootstrap_starter_categorized_blog() ) {
					printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'wp-bootstrap-starter' ) . '</span>', $categories_list ); // WPCS: XSS OK.
				}

				/* translators: used between list items, there is a space after the comma */
				// Remove comments from code below to show tags below the post
				/*$tags_list = get_the_tag_list( '', esc_html__( ', ', 'wp-bootstrap-starter' ) );
				if ( $tags_list ) {
				printf( ' | <span class="tags-links">' . esc_html__( 'Tagged %1$s', 'wp-bootstrap-starter' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}*/
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'wp-bootstrap-starter' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			' | <span class="edit-link">',
			'</span>'
		);
	}
endif;


// Include video custom post type in category feeds
// Causes issues with the recent posts listed on category pages - fix or change to custom taxonomies for this and page templates to display mutiple post types vs hijacking the main blog feed
/*function themeprefix_show_cpt_archives( $query ) {
if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
$query->set( 'post_type', array(
'nav_menu_item', 'post', 'video'
)
);
return $query;
}
}
add_filter( 'pre_get_posts', 'themeprefix_show_cpt_archives' );*/

/**
* WCAG 2.0 Attributes for Dropdown Menus
*
* Adjustments to menu attributes tot support WCAG 2.0 recommendations
* for flyout and dropdown menus.
*
* @ref https://www.w3.org/WAI/tutorials/menus/flyout/
*/
function wcag_nav_menu_link_attributes( $atts, $item, $args, $depth ) {

	// Add [aria-haspopup] and [aria-expanded] to menu items that have children
	$item_has_children = in_array( 'menu-item-has-children', $item->classes );
	if ( $item_has_children ) {
		$atts['aria-haspopup'] = "true";
		$atts['aria-expanded'] = "false";
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'wcag_nav_menu_link_attributes', 10, 4 );

// Add the class menu-link to <a> tags inside the main menu
function add_specific_menu_location_atts( $atts, $item, $args ) {
	// check if the item is in the primary menu
	if( $args->theme_location == 'primary' ) {
		// add the desired attributes:
		$atts['class'] = 'menu-link';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3 );

// accordion menu nav walker
class CSS_Menu_Maker_Walker extends Walker {

	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		/* Add active class */
		if(in_array('current-menu-item', $classes)) {
			$classes[] = 'active';
			unset($classes['current-menu-item']);
		}

		/* Check for children */
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
		if (!empty($children)) {
			$classes[] = 'has-sub';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'><span>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</span></a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}

// Gives Editor role access to Gravity Forms
function add_grav_forms(){
	$role = get_role('editor');
	$role->add_cap('gform_full_access');
}
add_action('admin_init','add_grav_forms');

// Disables tabindex on Gravity Forms
add_filter( 'gform_tabindex', '__return_false' );

// Gravity forms scroll to form on validation
add_filter( 'gform_confirmation_anchor', '__return_true' );

// Changes input type=submit into a button for gravity forms and disables the button on submit
//https://docs.gravityforms.com/gform_submit_button/
add_filter( 'gform_next_button', 'form_submit_button', 10, 2 );
add_filter( 'gform_previous_button', 'form_submit_button', 10, 2 );
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
/*
// Timeout function doesn't seem to work with this method, but would allow you to change the form submit text for an individual form if needed
function form_submit_button( $button, $form ) {
$dom = new DOMDocument();
$dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
$input = $dom->getElementsByTagName( 'input' )->item(0);

$onclick = $input->getAttribute( 'onclick' );
$onclick .= " addAdditionalAction('var e=this;setTimeout(function(){e.disabled=true;},0);return true');"; // Here's the JS function we're calling on click.
$input->setAttribute( 'onclick', $onclick );

$classes = $input->getAttribute( 'class' );
$classes .= " btn btn--form d-block";
$input->setAttribute( 'class', $classes );

$new_button = $dom->createElement( 'button' );
$new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
$input->removeAttribute( 'value' );
foreach( $input->attributes as $attribute ) {
$new_button->setAttribute( $attribute->name, $attribute->value );
}
$input->parentNode->replaceChild( $new_button, $input );

return $dom->saveHtml( $new_button );
}
*/
function form_submit_button( $button, $form ) {
	return "<button class='btn btn--form d-block' id='gform_submit_button_{$form['id']}' onclick='var e=this;setTimeout(function(){e.disabled=true;},0);return true;'>Send Your Information</button>";
}

	// ACF Options Page
	if( function_exists('acf_add_options_page') ) {
		//acf_add_options_page();

		acf_add_options_page(array(
			'page_title' 	=> 'Theme General Settings',
			'menu_title'	=> 'Admin Settings',
			'menu_slug' 	=> 'theme-general-settings',
			'capability' => 'manage_options',
			'redirect'		=> true,
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Design Settings',
			'menu_title'	=> 'Design',
			'parent_slug'	=> 'theme-general-settings'
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Firm Information',
			'menu_title'	=> 'Firm Info',
			'parent_slug'	=> 'theme-general-settings'
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Header Settings',
			'menu_title'	=> 'Header',
			'parent_slug'	=> 'theme-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Footer Settings',
			'menu_title'	=> 'Footer',
			'parent_slug'	=> 'theme-general-settings',
		));
	}

	// Changes "Howdy" text in admin bar
	function wp_admin_bar_my_custom_account_menu( $wp_admin_bar ) {
		$user_id = get_current_user_id();
		$current_user = wp_get_current_user();
		$profile_url = get_edit_profile_url( $user_id );
		if ( 0 != $user_id ) {
			/* Add the "My Account" menu */
			$avatar = get_avatar( $user_id, 28 );
			$howdy = sprintf( __('Welcome, %1$s'), $current_user->display_name );
			$class = empty( $avatar ) ? '' : 'with-avatar';

			$wp_admin_bar->add_menu( array(
				'id' => 'my-account',
				'parent' => 'top-secondary',
				'title' => $howdy . $avatar,
				'href' => $profile_url,
				'meta' => array(
					'class' => $class,
				),
			) );
		}
	}
	add_action( 'admin_bar_menu', 'wp_admin_bar_my_custom_account_menu', 11 );

	// Changes "Thank you for creating with Wordpress" message
	function wpse_edit_footer() {
		add_filter( 'admin_footer_text', 'wpse_edit_text', 11 );
	}

	function wpse_edit_text($content) {
		return "Website by Zola Media";
	}
	add_action( 'admin_init', 'wpse_edit_footer' );


	// Change logo URL on login page
	function put_my_url(){
		return "https://zolamedia.com/"; // your URL here
	}

	add_filter('login_headerurl', 'put_my_url');

	// Customize login page design
function custom_login_page() { ?>
<style type="text/css">
body {
  background: #222 !important;
}
#loginform {
  background: #333 !important;
  border: 1px solid rgba(0,0,0,.25) !important;
}
.login #login_error, .login .message, .login .success {
  border-left: 4px solid #14c8e3 !important;
  background: #333 !important;
  box-shadow: 0 1px 1px 0 rgba(255,255,255,.1) !important;
}
.login #backtoblog a,
.login #nav a,
.login label,
p.message,
.login #login_error, .login .message,
.login .success {
  color: #fff !important;
  transition: all 0.3s ease-in-out;
}
.login #backtoblog a:hover,
.login #nav a:hover,
.login #backtoblog a:focus,
.login #nav a:focus {
  color: #14c8e3 !important;
}
.wp-core-ui .button-primary {
  background:  #14c8e3 !important;
  transition: all 0.3s ease-in-out;
}
input[type="text"]:focus {
  border-color:   #14c8e3 !important;
}
.wp-core-ui .button-primary:hover,
.wp-core-ui .button-primary:focus {
  background:  #fff !important;
  color: #222 !important;
}
#login h1 a, .login h1 a {
  background-image: url("data:image/svg+xml;utf-8,\
  <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 500 97'>\
	<path style='fill:rgb(20,200,227)' d='M359.55,92.55c-1.66-.81-3.32-1.63-5-2.41,0,0-35.89-17.71-81.08-6-1.66.43-3.3,1-4.95,1.53-2.16.7-4.32,1.38-6.48,2.23-2.71,1.06-5.42,2.26-8.13,3.42-1.75.76-3.51,1.57-5.24,2.35L268.6,73.76a10.47,10.47,0,0,1,6.07-3c1.28-.16,2.57-.32,3.84-.43,3-.28,5.92-.57,8.86-.56,0,0,48.21-3.41,71.4,21.48a3.63,3.63,0,0,1,.78,1.33Z'/>\
  	<path style='fill:rgb(255,255,255);' d='M401.53,23.26h5a3.67,3.67,0,0,1,3.67,3.68v1.7c2.52-1.37,4.94-2.56,7.27-3.55a37.88,37.88,0,0,1,7.1-2.23,37.37,37.37,0,0,1,7.62-.75,20.34,20.34,0,0,1,9.39,1.95,13.11,13.11,0,0,1,5.72,5.67A19.72,19.72,0,0,1,449.28,39V84.67h-9.51V41.59c0-3.67-.93-6.47-2.8-8.42s-4.72-2.92-8.53-2.92a25.93,25.93,0,0,0-6,.68,43.46,43.46,0,0,0-5.61,1.78c-1.83.73-3.77,1.62-5.84,2.69V84.67h-9.5ZM472.38,7.15h5.18V24.06h20.49v6.42H477.56v35.4q0,6.18,2.35,8.94c1.56,1.83,4.14,2.75,7.72,2.75a30,30,0,0,0,5.5-.52h.05a5.58,5.58,0,0,1,6.51,4.47l.31,1.67a54.59,54.59,0,0,1-8.13,2,46.05,46.05,0,0,1-7.33.63,18.67,18.67,0,0,1-9.33-2.11,12.78,12.78,0,0,1-5.5-6.42,28.25,28.25,0,0,1-1.77-10.71V30.48H457.41V24.06h10.53l1.94-14.72A2.53,2.53,0,0,1,472.38,7.15ZM392.91,78.66a1.7,1.7,0,0,0-2-1.41h0a10.15,10.15,0,0,1-1.49.12,3.58,3.58,0,0,1-2.92-1.32q-1.09-1.32-1.09-5.1V41.16a20,20,0,0,0-2.58-10.54,15.68,15.68,0,0,0-7.67-6.36,33.07,33.07,0,0,0-12.65-2.12,63.94,63.94,0,0,0-9.73.8l-.89.15a4.53,4.53,0,0,0-2.31,1.13l-1.74,1.6-6.59,6a1.15,1.15,0,0,0,1.1,2c3.34-1,7.22-2.15,8.48-2.39a58,58,0,0,1,6-.8c1.9-.15,3.62-.23,5.15-.23q6.87,0,10.36,2.81t3.49,8.08v8.59q-9.17.8-16,2a48.75,48.75,0,0,0-11.56,3.33,15.69,15.69,0,0,0-7,5.67,16.46,16.46,0,0,0-2.29,9.05,22.42,22.42,0,0,0,.39,4.22,64.78,64.78,0,0,1,18.81,11.48,27.19,27.19,0,0,0,4.91-1,33,33,0,0,0,7.32-3.21,54.67,54.67,0,0,0,6.13-4.18,10.49,10.49,0,0,0,3.09,6.47,9.49,9.49,0,0,0,6.53,2.12,15.12,15.12,0,0,0,3.95-.51,17.55,17.55,0,0,0,3.6-1.43Zm-17.1-7.6a28.7,28.7,0,0,1-5.44,4.07,31,31,0,0,1-6.24,2.81,20.7,20.7,0,0,1-6.41,1,8.89,8.89,0,0,1-6.58-2.46q-2.46-2.48-2.46-7.39A9.55,9.55,0,0,1,350.57,63a13.14,13.14,0,0,1,5.49-3.89,37.31,37.31,0,0,1,8.59-2.24q5-.73,11.16-1.31ZM292,65.7a5,5,0,0,0,3.62-1.33l35.19-32.24,9.65-8.87H266.09c0,5.56,8.13,10.07,21.18,10.07h28.18l-36.6,33.32A60.06,60.06,0,0,1,292,65.7ZM170.8,28.17a16,16,0,0,0-3.45-4.24,14.77,14.77,0,0,0-5.23-2.87,22.35,22.35,0,0,0-6.74-.95,34,34,0,0,0-8.82,1.1,43.8,43.8,0,0,0-7.44,2.7c-1.62.77-3.21,1.62-4.75,2.54A14,14,0,0,0,132.05,24,15.26,15.26,0,0,0,127,21.19a21,21,0,0,0-6.65-1,32.48,32.48,0,0,0-7.5.86,43,43,0,0,0-6.91,2.28c-1.28.55-2.58,1.19-3.87,1.9a5.7,5.7,0,0,0-5.43-4h-7V86.67h13.51V36.56c1.28-.71,2.54-1.35,3.79-1.9a28.27,28.27,0,0,1,4.66-1.61,19.62,19.62,0,0,1,4.78-.57,9.47,9.47,0,0,1,4.29.81,6.73,6.73,0,0,1,2.43,2,8.06,8.06,0,0,1,1.29,2.89,16.33,16.33,0,0,1,.4,3.62V86.67h13.51V41.13a27.61,27.61,0,0,0-.18-3.09c-.07-.57-.16-1.13-.28-1.68.95-.53,2-1,3-1.55a29.31,29.31,0,0,1,5-1.76,21.25,21.25,0,0,1,5.45-.68,10.47,10.47,0,0,1,4.41.78A5.48,5.48,0,0,1,158,35.07a9.26,9.26,0,0,1,1.27,3,15.91,15.91,0,0,1,.41,3.51V86.67H173.3V39a27.64,27.64,0,0,0-.56-5.55A17.46,17.46,0,0,0,170.8,28.17Zm55.8-5.89a22.39,22.39,0,0,0-10.31-2.17,38.52,38.52,0,0,0-15.49,3.14c-1.52.64-3.09,1.38-4.69,2.18a5.7,5.7,0,0,0-5.48-4.18h-7V86.67h13.5v-50c1.6-.79,3.14-1.49,4.58-2.06A41.89,41.89,0,0,1,207,32.88a23.43,23.43,0,0,1,5.48-.63c3.24,0,5.62.78,7.09,2.31s2.25,3.92,2.25,7V86.67h13.51V39a21.84,21.84,0,0,0-2.18-10.15A15.07,15.07,0,0,0,226.6,22.28ZM245.78,82a4.64,4.64,0,0,0,4.63,4.63h.83l8.05-8.06V21.25H245.78Zm1-69.94a5.47,5.47,0,0,0,1.71,1.51,6.91,6.91,0,0,0,2,.74,10.2,10.2,0,0,0,2,.2,11,11,0,0,0,2-.19,6.87,6.87,0,0,0,2-.74,5.61,5.61,0,0,0,1.69-1.5,6.41,6.41,0,0,0,1-2.2,10.31,10.31,0,0,0,.31-2.67,9.82,9.82,0,0,0-.32-2.67,6.56,6.56,0,0,0-1-2.16A5.59,5.59,0,0,0,256.55.93a6.65,6.65,0,0,0-2-.74,11.08,11.08,0,0,0-4.06,0,6.73,6.73,0,0,0-2,.75,5.59,5.59,0,0,0-1.67,1.51,6.61,6.61,0,0,0-1,2.17,10.1,10.1,0,0,0-.31,2.65,9.75,9.75,0,0,0,.33,2.67A6.65,6.65,0,0,0,246.82,12.1ZM74,15.55a30.83,30.83,0,0,0-8.87-9A35,35,0,0,0,53.74,1.77a58.64,58.64,0,0,0-13-1.4,57.78,57.78,0,0,0-13,1.4A34.24,34.24,0,0,0,16.38,6.62a31.68,31.68,0,0,0-8.86,9.13,44,44,0,0,0-5.6,13.82A84,84,0,0,0,0,48.68,81.26,81.26,0,0,0,2,67.82a45.11,45.11,0,0,0,5.66,13.8,30.3,30.3,0,0,0,9,9.08,36.9,36.9,0,0,0,11.28,4.83A54.48,54.48,0,0,0,40.7,97a58.5,58.5,0,0,0,13.11-1.4,34.88,34.88,0,0,0,11.32-4.78,31.37,31.37,0,0,0,8.93-9.06,42.85,42.85,0,0,0,5.68-14,86.43,86.43,0,0,0,1.92-19.36,81.32,81.32,0,0,0-2-19.14A44.08,44.08,0,0,0,74,15.55ZM66.34,48.68a68,68,0,0,1-1.43,15A34.38,34.38,0,0,1,61.1,73.76a20,20,0,0,1-5.48,6.09A20.83,20.83,0,0,1,48.7,83a33.4,33.4,0,0,1-15.93,0,20,20,0,0,1-6.84-3.22,20.74,20.74,0,0,1-5.5-6.22,35.34,35.34,0,0,1-3.81-10,65.34,65.34,0,0,1-1.43-14.72,68.73,68.73,0,0,1,1.43-15.12,35,35,0,0,1,3.82-10.16,19.84,19.84,0,0,1,5.47-6.14,20.7,20.7,0,0,1,6.86-3.17,32.38,32.38,0,0,1,7.93-1,33.19,33.19,0,0,1,8,1,20.63,20.63,0,0,1,6.92,3.17,20,20,0,0,1,5.48,6.09,34.42,34.42,0,0,1,3.81,10.15A68.94,68.94,0,0,1,66.34,48.68Z'/>\
  </svg>");
  background-size: contain;
  width: 270px;
  height: 60px;
}
</style>
<?php }
add_action( 'login_enqueue_scripts', 'custom_login_page' );
?>
<?php
add_filter( 'acf/admin/prevent_escaped_html_notice', '__return_true' );
?>