<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package PDFyolo
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function PDFyolo_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'PDFyolo_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function PDFyolo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'PDFyolo_pingback_header' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function ah_breadcrumb() {

  // Check if is front/home page, return
  if ( is_front_page() ) {
    return;
  }

  // Define
  global $post;
  $custom_taxonomy  = ''; // If you have custom taxonomy place it here

  $defaults = array(
    'seperator'   =>  '',
    'id'          =>  'ah-breadcrumb',
    'classes'     =>  'ah-breadcrumb',
    'home_title'  =>  esc_html__( 'Home', '' )
  );

  $sep  = '<li class="seperator">'. esc_html( $defaults['seperator'] ) .'</li>';

  // Start the breadcrumb with a link to your homepage
  echo '<ul id="'. esc_attr( $defaults['id'] ) .'" class="'. esc_attr( $defaults['classes'] ) .'">';

  // Creating home link
  echo '<li class="item"><a href="'. get_home_url() .'">'. esc_html( $defaults['home_title'] ) .'</a></li>' . $sep;

  if ( is_single() ) {

    // Get posts type
    $post_type = get_post_type();

    // If post type is not post
    if( $post_type != 'post' ) {

      $post_type_object   = get_post_type_object( $post_type );
      $post_type_link     = get_post_type_archive_link( $post_type );

      echo '<li class="item item-cat"><a href="'. $post_type_link .'">'. $post_type_object->labels->name .'</a></li>'. $sep;

    }

    // Get categories
    $category = get_the_category( $post->ID );

    // If category not empty
    if( !empty( $category ) ) {

      // Arrange category parent to child
      $category_values      = array_values( $category );
      $get_last_category    = end( $category_values );
      // $get_last_category    = $category[count($category) - 1];
      $get_parent_category  = rtrim( get_category_parents( $get_last_category->term_id, true, ',' ), ',' );
      $cat_parent           = explode( ',', $get_parent_category );

      // Store category in $display_category
      $display_category = '';
      foreach( $cat_parent as $p ) {
        $display_category .=  '<li class="item item-cat">'. $p .'</li>' . $sep;
      }

    }

    // If it's a custom post type within a custom taxonomy
    $taxonomy_exists = taxonomy_exists( $custom_taxonomy );

    if( empty( $get_last_category ) && !empty( $custom_taxonomy ) && $taxonomy_exists ) {

      $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
      $cat_id         = $taxonomy_terms[0]->term_id;
      $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
      $cat_name       = $taxonomy_terms[0]->name;

    }

    // Check if the post is in a category
    if( !empty( $get_last_category ) ) {

      echo $display_category;
      echo '<li class="item item-current">'. get_the_title() .'</li>';

    } else if( !empty( $cat_id ) ) {

      echo '<li class="item item-cat"><a href="'. $cat_link .'">'. $cat_name .'</a></li>' . $sep;
      echo '<li class="item-current item">'. get_the_title() .'</li>';

    } else {

      echo '<li class="item-current item">'. get_the_title() .'</li>';

    }

  } else if( is_archive() ) {

    if( is_tax() ) {
      // Get posts type
      $post_type = get_post_type();

      // If post type is not post
      if( $post_type != 'post' ) {

        $post_type_object   = get_post_type_object( $post_type );
        $post_type_link     = get_post_type_archive_link( $post_type );

        echo '<li class="item item-cat item-custom-post-type-' . $post_type . '"><a href="' . $post_type_link . '">' . $post_type_object->labels->name . '</a></li>' . $sep;

      }

      $custom_tax_name = get_queried_object()->name;
      echo '<li class="item item-current">'. $custom_tax_name .'</li>';

    } else if ( is_category() ) {

      $parent = get_queried_object()->category_parent;

      if ( $parent !== 0 ) {

        $parent_category = get_category( $parent );
        $category_link   = get_category_link( $parent );

        echo '<li class="item"><a href="'. esc_url( $category_link ) .'">'. $parent_category->name .'</a></li>' . $sep;

      }

      echo '<li class="item item-current">'. single_cat_title( '', false ) .'</li>';

    } else if ( is_tag() ) {

      // Get tag information
      $term_id        = get_query_var('tag_id');
      $taxonomy       = 'post_tag';
      $args           = 'include=' . $term_id;
      $terms          = get_terms( $taxonomy, $args );
      $get_term_name  = $terms[0]->name;

      // Display the tag name
      echo '<li class="item-current item">'. $get_term_name .'</li>';

    } else if( is_day() ) {

      // Day archive

      // Year link
      echo '<li class="item-year item"><a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') . ' Archives</a></li>' . $sep;

      // Month link
      echo '<li class="item-month item"><a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'. get_the_time('M') .' Archives</a></li>' . $sep;

      // Day display
      echo '<li class="item-current item">'. get_the_time('jS') .' '. get_the_time('M'). ' Archives</li>';

    } else if( is_month() ) {

      // Month archive

      // Year link
      echo '<li class="item-year item"><a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') . ' Archives</a></li>' . $sep;

      // Month Display
      echo '<li class="item-month item-current item">'. get_the_time('M') .' Archives</li>';

    } else if ( is_year() ) {

      // Year Display
      echo '<li class="item-year item-current item">'. get_the_time('Y') .' Archives</li>';

    } else if ( is_author() ) {

      // Auhor archive

      // Get the author information
      global $author;
      $userdata = get_userdata( $author );

      // Display author name
      echo '<li class="item-current item">'. 'Author: '. $userdata->display_name . '</li>';

    } else {

      echo '<li class="item item-current">'. post_type_archive_title() .'</li>';

    }

  } else if ( is_page() ) {

    // Standard page
    if( $post->post_parent ) {

      // If child page, get parents
      $anc = get_post_ancestors( $post->ID );

      // Get parents in the right order
      $anc = array_reverse( $anc );

      // Parent page loop
      if ( !isset( $parents ) ) $parents = null;
      foreach ( $anc as $ancestor ) {

        $parents .= '<li class="item-parent item"><a href="'. get_permalink( $ancestor ) .'">'. get_the_title( $ancestor ) .'</a></li>' . $sep;

      }

      // Display parent pages
      echo $parents;

      // Current page
      echo '<li class="item-current item">'. get_the_title() .'</li>';

    } else {

      // Just display current page if not parents
      echo '<li class="item-current item">'. get_the_title() .'</li>';

    }

  } else if ( is_search() ) {

    // Search results page
    echo '<li class="item-current item">Search results for: '. get_search_query() .'</li>';

  } else if ( is_404() ) {

    // 404 page
    echo '<li class="item-current item">' . 'Error 404' . '</li>';

  }

  // End breadcrumb
  echo '</ul>';

}

function PDFyolo_widgets_init() {
	register_sidebar( array(
		'name'          => 'Footer Widgets',
		'id'            => 'footer',
		'description'   => esc_html__( 'Add widgets here.', 'PDFyolo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
//add_action( 'widgets_init', 'PDFyolo_widgets_init' );



if ( function_exists('get_field') ) {
	// ACF Options
	acf_add_options_page(array(
			'page_title' 	=> 'Theme General Settings',
			'menu_title' 	=> 'Theme Settings',
			'menu_slug' 	=> 'theme-general-settings',
			'capability' 	=> 'edit_posts',
			'redirect' 	=> false
		));
}

if(!function_exists('PDFyolo_header_menus')) { 
	function PDFyolo_header_menus($class,$menu){
			
		$defaults = array(
		'theme_location'  => $menu,
		'menu'            => '', 
		'container'       => '', 
		'container_class' => '', 
		'container_id'    => '',
		'menu_class'      => $class,
		'menu_id'         => 'navs-'.$menu,
		'echo'            => true,
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'walker'          => '',
		'add_li_class'  => 'nav-item');				
		if(has_nav_menu($menu)){ 
			wp_nav_menu( $defaults);
		
		}
										
	}
}

/*function PDFyolo_menu_classes($classes, $item, $args){
		if($args->theme_location == 'primary') {
		 $classes[] = 'nav-item';
		}
		return $classes;
}

add_filter('nav_menu_css_class', 'PDFyolo_menu_classes', 1, 3);

add_filter( 'nav_menu_link_attributes', 'filter_menu_link_class', 10, 3 );

function filter_menu_link_class( $atts, $item, $args ) {
		if( $args->theme_location == 'primary') {
			$atts['class'] = "nav-link";
		}
		return $atts;
}*/

function PDFyolo_comment($comment, $args, $depth) {
		extract($args, EXTR_SKIP);

 ?>
		<li>
			<div class="comment">
				<div class="avatar-comment-thumb">
					<a href="#" title=""><img src="<?php echo get_avatar_url( $comment, 75 ); ?>" alt="" /></a>
				</div>
				<div class="comment-detail">
					<div class="avatar-title">
						<h3><a href="#" title=""><?php comment_author(); ?></a></h3>
						<span><?php printf( _x( '%s ago', '%s = human-readable time difference', 'PDFyoloni' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
						</span>
					</div>
					<p><?php comment_text(); ?> </p>
					<?php comment_reply_link(array_merge( $args, array('add_below' =>'Reply', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div>
			</div>
		</li>
					
		<?php
}

function PDFyolo_theme_logo(){
	if ( function_exists('get_field') ) {
        $header_logo=get_field('theme_header_logo','options');
	}
	if(empty($header_logo)){
        $header_logo=get_template_directory_uri().'/wp-content/uploads/2023/02/logo.svg';
	}
	?>
        <div class="logo">
            <a href="<?php echo home_url("/"); ?>">
                <img src="<?php echo $header_logo; ?>" class="img-fluid" alt="<?php bloginfo('name'); ?>" >
            </a>
        </div>
	 <?php
}


function PDFyolo_theme_social_icons($class){
	if ( function_exists('get_field') ) {
		echo '<ul class="'.$class.'">';
		$footer_social_icons=get_field('footer_social_icons','options');
		if(!empty($footer_social_icons)){
			foreach ($footer_social_icons as $footer_social_icon) {
				echo '<li>
						<a href="'.$footer_social_icon["link"].'"><i class="fa '.$footer_social_icon["icon_class"].'"></i></a>
					</li>';
			}
		}
		echo '</ul>';
	}
}



function PDFyolo_PDFyolo_pagination(){
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';			
		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' =>'Prev',
			'next_text' => 'Next',
		) );
		html_entity_decode($links);
		if ( $links ) :
			return $links;
		endif;
}

function books_func() {
	$labels = array(
		'name'                  => _x( 'Books', 'Post Type General Name', 'PDFyolo' ),
		'singular_name'         => _x( 'Book', 'Post Type Singular Name', 'PDFyolo' ),
		'menu_name'             => __( 'Books', 'PDFyolo' ),
		'name_admin_bar'        => __( 'Book', 'PDFyolo' ),
		'archives'              => __( 'Book Archives', 'PDFyolo' ),
		'parent_item_colon'     => __( 'Parent Book:', 'PDFyolo' ),
		'all_items'             => __( 'All Books', 'PDFyolo' ),
		'add_new_item'          => __( 'Add New Book', 'PDFyolo' ),
		'add_new'               => __( 'Add New Book', 'PDFyolo' ),
		'new_item'              => __( 'New Item Book', 'PDFyolo' ),
		'edit_item'             => __( 'Edit Item', 'PDFyolo' ),
		'update_item'           => __( 'Update Item', 'PDFyolo' ),
		'view_item'             => __( 'View Item', 'PDFyolo' ),
		'search_items'          => __( 'Search Item', 'PDFyolo' ),
		'not_found'             => __( 'Not found', 'PDFyolo' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'PDFyolo' ),
		'featured_image'        => __( 'Featured Image', 'PDFyolo' ),
		'set_featured_image'    => __( 'Set featured image', 'PDFyolo' ),
		'remove_featured_image' => __( 'Remove featured image', 'PDFyolo' ),
		'use_featured_image'    => __( 'Use as featured image', 'PDFyolo' ),
		'insert_into_item'      => __( 'Insert into item', 'PDFyolo' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'PDFyolo' ),
		'items_list'            => __( 'Items list', 'PDFyolo' ),
		'items_list_navigation' => __( 'Items list navigation', 'PDFyolo' ),
		'filter_items_list'     => __( 'Filter items list', 'PDFyolo' ),
	);
	$args = array(
		'label'                 => __( 'Book', 'PDFyolo' ),
		'description'           => __( 'Add Books', 'PDFyolo' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail' , 'excerpt','comments'	),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 65,
		'menu_icon'             => 'dashicons-book',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
	);
	register_post_type( 'books', $args );

	register_taxonomy(
		"book_cat", array("books"), array(
			"hierarchical" => true,
			'show_ui' => true,
			'show_admin_column' => false,
			'query_var' => true,
			"label" => "Book Category",
			"singular_label" => "Book Category",
			"rewrite" => true
		)
	);
	register_taxonomy_for_object_type('book_cat', 'books');


	register_taxonomy(
		"book_author", array("books"), array(
			"hierarchical" => true,
			'show_ui' => true,
			'show_admin_column' => false,
			'query_var' => true,
			"label" => "Author",
			"singular_label" => "Author",
			"rewrite" => true
		)
	);
	register_taxonomy_for_object_type('book_author', 'books');
}
add_action("init","books_func");



function novels_func() {
	$labels = array(
		'name'                  => _x( 'Novels', 'Post Type General Name', 'PDFyolo' ),
		'singular_name'         => _x( 'Novel', 'Post Type Singular Name', 'PDFyolo' ),
		'menu_name'             => __( 'Novels', 'PDFyolo' ),
		'name_admin_bar'        => __( 'Novel', 'PDFyolo' ),
		'archives'              => __( 'Novel Archives', 'PDFyolo' ),
		'parent_item_colon'     => __( 'Parent Novel:', 'PDFyolo' ),
		'all_items'             => __( 'All Novels', 'PDFyolo' ),
		'add_new_item'          => __( 'Add New Novel', 'PDFyolo' ),
		'add_new'               => __( 'Add New Novel', 'PDFyolo' ),
		'new_item'              => __( 'New Item Novel', 'PDFyolo' ),
		'edit_item'             => __( 'Edit Item', 'PDFyolo' ),
		'update_item'           => __( 'Update Item', 'PDFyolo' ),
		'view_item'             => __( 'View Item', 'PDFyolo' ),
		'search_items'          => __( 'Search Item', 'PDFyolo' ),
		'not_found'             => __( 'Not found', 'PDFyolo' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'PDFyolo' ),
		'featured_image'        => __( 'Featured Image', 'PDFyolo' ),
		'set_featured_image'    => __( 'Set featured image', 'PDFyolo' ),
		'remove_featured_image' => __( 'Remove featured image', 'PDFyolo' ),
		'use_featured_image'    => __( 'Use as featured image', 'PDFyolo' ),
		'insert_into_item'      => __( 'Insert into item', 'PDFyolo' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'PDFyolo' ),
		'items_list'            => __( 'Items list', 'PDFyolo' ),
		'items_list_navigation' => __( 'Items list navigation', 'PDFyolo' ),
		'filter_items_list'     => __( 'Filter items list', 'PDFyolo' ),
	);
	$args = array(
		'label'                 => __( 'Novel', 'PDFyolo' ),
		'description'           => __( 'Add Novels', 'PDFyolo' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail' , 'excerpt','comments'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 65,
		'menu_icon'             => 'dashicons-feedback',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
	);
	register_post_type( 'novels', $args );

	register_taxonomy(
		"novel_cat", array("novels"), array(
			"hierarchical" => true,
			'show_ui' => true,
			'show_admin_column' => false,
			'query_var' => true,
			"label" => "Novel Category",
			"singular_label" => "Novel Category",
			"rewrite" => true
		)
	);
	register_taxonomy_for_object_type('novel_cat', 'novels');


	register_taxonomy(
		"novel_author", array("novels"), array(
			"hierarchical" => true,
			'show_ui' => true,
			'show_admin_column' => false,
			'query_var' => true,
			"label" => "Author",
			"singular_label" => "Author",
			"rewrite" => true
		)
	);
	register_taxonomy_for_object_type('novel_author', 'novels');
}
add_action("init","novels_func");




function games_func() {
	$labels = array(
		'name'                  => _x( 'Games', 'Post Type General Name', 'PDFyolo' ),
		'singular_name'         => _x( 'Game', 'Post Type Singular Name', 'PDFyolo' ),
		'menu_name'             => __( 'Games', 'PDFyolo' ),
		'name_admin_bar'        => __( 'Game', 'PDFyolo' ),
		'archives'              => __( 'Game Archives', 'PDFyolo' ),
		'parent_item_colon'     => __( 'Parent Game:', 'PDFyolo' ),
		'all_items'             => __( 'All Games', 'PDFyolo' ),
		'add_new_item'          => __( 'Add New Game', 'PDFyolo' ),
		'add_new'               => __( 'Add New Game', 'PDFyolo' ),
		'new_item'              => __( 'New Item Game', 'PDFyolo' ),
		'edit_item'             => __( 'Edit Item', 'PDFyolo' ),
		'update_item'           => __( 'Update Item', 'PDFyolo' ),
		'view_item'             => __( 'View Item', 'PDFyolo' ),
		'search_items'          => __( 'Search Item', 'PDFyolo' ),
		'not_found'             => __( 'Not found', 'PDFyolo' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'PDFyolo' ),
		'featured_image'        => __( 'Featured Image', 'PDFyolo' ),
		'set_featured_image'    => __( 'Set featured image', 'PDFyolo' ),
		'remove_featured_image' => __( 'Remove featured image', 'PDFyolo' ),
		'use_featured_image'    => __( 'Use as featured image', 'PDFyolo' ),
		'insert_into_item'      => __( 'Insert into item', 'PDFyolo' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'PDFyolo' ),
		'items_list'            => __( 'Items list', 'PDFyolo' ),
		'items_list_navigation' => __( 'Items list navigation', 'PDFyolo' ),
		'filter_items_list'     => __( 'Filter items list', 'PDFyolo' ),
	);
	$args = array(
		'label'                 => __( 'Game', 'PDFyolo' ),
		'description'           => __( 'Add Games', 'PDFyolo' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail' , 'excerpt','comments'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 65,
		'menu_icon'             => 'dashicons-games',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
	);
	register_post_type( 'games', $args );

	register_taxonomy(
		"game_cat", array("games"), array(
			"hierarchical" => true,
			'show_ui' => true,
			'show_admin_column' => false,
			'query_var' => true,
			"label" => "Games Category",
			"singular_label" => "Games Category",
			"rewrite" => true
		)
	);
	register_taxonomy_for_object_type('game_cat', 'games');


	register_taxonomy(
		"game_author", array("games"), array(
			"hierarchical" => true,
			'show_ui' => true,
			'show_admin_column' => false,
			'query_var' => true,
			"label" => "Author",
			"singular_label" => "Author",
			"rewrite" => true
		)
	);
	register_taxonomy_for_object_type('game_author', 'games');
}
add_action("init","games_func");





add_action('wp_head','my_custom_scripts');
function my_custom_scripts(){
	?>
		<style>
			body {
				-ms-overlfow-style: scrollbar;
				min-width: 320px;
				font-weight: 400;
				line-height: 1.5;
				color: #212529;
				font-size: .9375rem;
			}

			h1 a, .h1 a,
			h2 a, .h2 a,
			h3 a, .h3 a,
			h4 a, .h4 a,
			h5 a, .h5 a,
			h6 a, .h6 a {
				color: inherit; 
			}

			a {
				transition: all .35s ease;
				text-decoration: none;	
			}

			a:hover {
				text-decoration: none;
			}

			h1, .h1 {
				line-height: 0.8571428571; 
			}

			h2, .h2 {
				line-height: 1.1; 
			}

			.bg-cover {
				background-color: #CFD4DB;
				background-repeat: no-repeat;
				background-position: center center;
				background-size: cover;
			}

			.bg-light {
				background-color: #f0f2f5 !important;
			}

			.rounded-lg {
				border-radius: 0.5rem!important;
			}

			small,
			.small {
				font-size: 90%;
			}

			textarea {
				resize: none;
				min-height: 130px;
			}

			.bg-overlay {
				background-color: rgba(0, 0, 0, 0.6);
				z-index: 10;
				top: 0;
				bottom: 0;
				left: 0;
				right: 0;
			}

			.anchore-link:hover {
				color: #EB144C;
			}

			.svg-5 {
				width: 1.25rem;
				height: 1.25rem;
			}

			.svg-6 {
				width: 1rem;
				height: 1rem;
			}

			.svg-secondary {
				fill: #f25132;
			}

			.border-bottom-2 {
				border-bottom: 2px solid #dee2e6;
			}

			.border-secondary {
				border-color: #FE8401!important;
			}

			.font-size-body {
				font-size: 0.9375rem!important;
			}

			.container,
			[class*="col-"] {
				padding-left: 8px;
				padding-right: 8px;
			}

			.row {
				margin-left: -8px;
				margin-right: -8px;
			}

			.btn {
				font-weight: 600;
				border-radius: 0.375rem;
				-webkit-transition: all 0.3s ease 0s;
				-moz-transition: all 0.3s ease 0s;
				transition: all 0.3s ease 0s;
			}

			.btn-sm {
				font-size: .75rem;
			}

			.btn-primary,
			.btn-primary:not(:disabled):not(.disabled):active:focus {
				color: #fff;
				background-color: #EB144C;
				border-color: #EB144C;
			}

			.btn-primary:hover, 
			.btn-primary:focus, 
			.btn-primary:not(:disabled):not(.disabled):active {
				color: #FFF;
				background-color: #cb093c;
				border-color: #cb093c;
			}

			.btn-light, 
			.btn-light:not(:disabled):not(.disabled):active:focus {
				color: #212529;
				background-color: #f0f2f5;
				border-color: #f0f2f5;
			}

			#pageWrapper {
				position: relative;
				width: 100%;
				overflow: hidden;
				padding-top: 46px;
				background-color: #F0F2F5 !important;
			}

			#pgNaveOpener {
				padding: 0.625rem 0;
				margin-right: 10px;
			}

			.logo {
				max-width: 100px;
				width: 100%;
			}

			.pageMainNavCollapse {
				background-color: #fff;
				overflow-y: auto;
				width: 17.5rem;
				position: fixed;
				left: -17.5rem;
				top: 0;
				bottom: 0;
				z-index: 1031;
				display: block !important;
				transition: all 0.3s ease 0s;
			}

			body.mobile-nav-active .pageMainNavCollapse {
				left: 0;
			}

			.site-overlay {
				background: rgba(0,0,0,.5);
				width: 100%;
				height: 100%;
				position: fixed;
				z-index: 1001;
				top: 0;
				left: 0;
				opacity: 0;
				visibility: hidden;
				transition: all .35s ease;
			}

			body.mobile-nav-active .site-overlay {
				opacity: 1;
				visibility: visible;
			}

			.btn-menu-close {
				font-size: 19px;
				margin-right: 5px;
			}

			.mainNavigation li {
				border-bottom: 1px solid #dee2e6;
				padding: 0.75rem 2.5rem 0.75rem 0.75rem;
				margin-left: 0;
			}

			.mainNavigation li a {
				font-size: 1rem;
				font-weight: 600;
				border-top: 2px solid transparent;
				border-bottom: 2px solid transparent;
				display: inline;
				padding: 0;
				color: #212529 !important;
				transition: all .35s ease;
			}

			.mainNavigation li:hover a {
				background: #F2F2F2 !important;
			}

			.mainNavigation li.active a,
			.mainNavigation li.current a {
				color: #EB144C !important;
				background-color: transparent !important;
				border-bottom-color: #EB144C !important;
			}

			.header-form-wrap {
				max-width: 300px !important;
				width: 100%;
			}

			.searchForm {
				padding: 4px 0 4px 10px;
			}

			.searchForm .form-control, 
			.searchForm .custom-select, 
			.searchForm .btn {
				border-radius: 0.375rem;
				-webkit-transition: all 0.3s ease 0s;
				-moz-transition: all 0.3s ease 0s;
				transition: all 0.3s ease 0s;
				background-color: #F0F2F5;
				border-color: #F0F2F5;
			}

			.searchForm .form-control:focus, 
			.searchForm .custom-select:focus, 
			.searchForm .form-control:focus + .input-group-append .btn {
				background-color: #FFF;
				border-color: #dee2e6;
				box-shadow: 0 0.125rem 0.5rem rgb(0 0 0 / 15%);
			}

			.searchForm .search-icn {
				font-size: 16px; 
			}

			.btn-light, 
			.btn-light:not(:disabled):not(.disabled):active:focus {
				color: #212529;
				background-color: #F0F2F5;
				border-color: #F0F2F5;
				font-size: .75rem;
				font-weight: 600;
			}

			.content-section {
				background-color: #fff !important;
/* 				border: 1px solid #dee2e6 !important; */
				border: 0 !important;
				border-radius: 0.75rem!important;
/* 				border-radius: 0.25rem !important; */
/* 				box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important; */
				box-shadow: rgb(0 0 0 / 10%) 0px 1px 20px 0px !important;
				margin-bottom: 1rem !important;
				padding: 1rem 0.5rem 0 !important;
			}

			.section-header {
				display: flex;
				align-items: center;
				margin-bottom: 1rem !important;
			}

			.section-header h2,
			.section-header .h2 {
				font-size: 1.25rem;
				margin-bottom: 0 !important;
				font-weight: 600 !important;
			}

			.section-header h2 .text-link,
			.section-header .h2 .text-link{
				padding-bottom: 0.25rem!important;
				border-bottom: 2px solid #EB144C;
			}

			.section-header h2 a:hover,
			.section-header .h2 a:hover {
				color: #EB144C;
			}

			.blog-post {
				box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 15%);
				border-radius: 4px;
				margin-bottom: 24px;
			}

			.blog-post:before {
				padding-top: 56.25%;
			}

			.blog-post .holder-wrap {
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				padding: 16px;
				display: flex !important;
				align-items: flex-end !important;
				display: -ms-flexbox !important;
				-ms-flex-align: end !important;
				background-color: rgba(0, 0, 0, 0.5);
				transition: background-color .35s ease;
			}

			.blog-post .h3 {
				font-size: 0.875rem;
				color: #fff;
				margin-bottom: 0;
				transition: color .35s ease;
			}

			.blog-post:hover .holder-wrap {
				background-color: rgba(0, 0, 0, 0.3);
			}

			.category-post {
				color: #212529 !important;
				position: relative !important;
				overflow: hidden !important;
				display: block !important;
				border-radius: 0.5rem !important;
/* 				border-radius: 0.25rem !important; */
/* 				border: 1px solid #dee2e6 !important; */
				border: 0 !important;	
				margin-bottom: 16px !important;
				transition: all 0.35s ease;
			}

			.category-post .cp-wrap {
				display: flex;
				padding: 8px;
			}

			.category-post .img-wrap {
				max-width: 60px;
				width: 100%;
				overflow: hidden; 
				flex-shrink: 0 !important;
				-ms-flex-negative: 0 !important;
				margin-right: 0.5rem !important;
				border-radius: 0.5rem !important;
			}

			.category-post .img-wrap img {
				border-radius: inherit;
			}

			.category-post .content-wrap {
				min-width: 0;
			}

			.category-post .content-wrap .h6 {
				font-weight: 600 !important;
				margin-bottom: 2px;
				transition: color 0.35s ease;
			}

			.category-post .content-wrap .svg-6 {
				fill: #999;
				display: inline-block;
				width: 1rem;
				height: 1rem;
			}

			.category-post:hover {
/* 				border-color: #EB144C !important; */
				background-color: #f2f2f2 !important;
			}

			.category-post:hover .content-wrap .h6 {
/* 				color: #EB144C !important; */
				color: #212529 !important
			}

			.widget-sidebar .cat-link {
				margin-bottom: 16px;
			}

			.widget-sidebar .cat-link:hover {
				color: #EB144C !important;
			}

			/*Footer_Styles*/
			.footerAside {
				padding-top: 1.5rem !important;
				padding-bottom: 1.5rem!important;
				border-top: 1px solid #dee2e6 !important;
				background-color: #fff !important;
			}

			.footer-widget {
				margin-bottom: 1.5rem!important;
			}

			.footer-widget .h5 {
				font-weight: 600 !important;
				margin-bottom: 1rem !important;
			}

			.ft-nav {
				margin-left: 2.25rem;
				ms-flex-wrap: wrap;
				flex-wrap: wrap;
			}

			.ft-nav li {
				margin-right: 1.5rem;
			}

			.ft-nav li a {
				color: inherit;
			}

			.ft-nav li a:hover {
				color: #EB144C;
			}

			.social-list li a {
				color: inherit;
				background-color: #F0F2F5;
				border-radius: 50%;
				display: flex;
				align-items: center;
				justify-content: center;
				width: 2.5rem;
				height: 2.5rem;
			}

			.social-list li + li {
				margin-left: 8px;
			}

			.social-list li a svg {
				fill: #212529;
				transition: all 0.3s ease 0s;
			}

			.social-list li a:hover {
				background-color: #E2E6EA;
			}

			.social-list li a:hover svg {
				fill: #EB144C;
			}

			#pageFooter {
				background-color: #343a40 !important;
				display: -ms-flexbox !important;
				display: flex !important;
				font-weight: 400;
				padding-top: 1rem !important;
				text-align: center !important;
				color: #fff !important;
			}

			/*Breadcrumb Styles*/
			.breadcrumb {
				background: transparent;
				border: 0;
				border-radius: 0;
				padding: 0;
				margin: 0;
			}

			.breadcrumb li a:hover {
				color: #EB144C;
			}

			.seperator:before {
				content: '' !important;
				border-top: 2px solid #6c757d;
				border-right: 2px solid #6c757d;
				display: inline-block !important;
				vertical-align: middle;
				width: 0.5rem;
				height: 0.5rem;
				padding-right: 0 !important;
				margin-top: -0.25rem;
				margin-right: 0.5rem;
				transform: rotate(45deg);
			}

			/*Pagination Styles*/
			.pagination {
				justify-content: center;
				margin-bottom: 1.5rem;
			}

			.pagination .page-link {
				font-size: 1rem;
				font-weight: 600;
				color: #212529;
				background: #F0F2F5;
				border-color: #F0F2F5;
				border-radius: 0.5rem!important;
				display: flex;
				align-items: center;
				justify-content: center;
				width: 2.5rem;
				height: 2.5rem;
				text-align: center;
				padding: 0;
				margin-left: 0.25rem;
				margin-right: 0.25rem;
			}

			.pagination .page-item.active .page-link {
				color: #fff;
				background-color: #EB144C;
				border-color: #EB144C;
			}

			.pagination .page-link:hover, 
			.pagination .page-link:focus {
				color: #212529;
				background-color: #E2E6EA;
				border-color: #E2E6EA;
			}

			.social-link-list .social-btn {
				color: #fff;
				border-radius: 0.25rem;
				display: flex;
				align-items: center;
				padding: 0.25rem 0.5rem;
				-webkit-transition: all .3s ease 0s;
				-moz-transition: all .3s ease 0s;
				transition: all .3s ease 0s;
			}

			.social-link-list .social-btn .svg-5 {
				height: 14px;
				fill: #fff;
			}

			.social-link-list .social-btn.facebook {
				background-color: #455fa1;
			}

			.social-link-list .social-btn.twitter {
				background-color: #58abf4;
			}

			.social-link-list .social-btn.pinterest {
				background-color: #cc1d1e;
			}

			.social-link-list .social-btn.linkedin {
				background-color: #007bb5;
			}

			.social-link-list .social-btn.email {
				background-color: #1980be;
			}

			.social-link-list .social-btn:hover {
				opacity: .7;
			}

			.accordion .toggler.collapsed {
				color: #EB144C;
				background-color: #fff;
			}

			.accordion .toggler:after {
				content: '-';
				font-size: 1.25rem;
				font-weight: 700;
				cursor: pointer;
				display: inline-block;
				line-height: 1;
				margin-left: auto;
				transition: all .3s ease 0s;
			}

			.accordion .toggler.collapsed:after {
				content: '+';
			}

			.accordion-more-info .toggler {
				color: #EB144C;
				background-color: #f0f2f5;
			}

			.explore-btn {
				font-size: 16px !important;
			}

			.entry-content .img-with-title img {
				margin-bottom: 1.35rem;
			}

			.entry-content .h2 {
				font-size: 1.375rem;
				text-align: center;
				margin-bottom: 1rem;
			}

			h2.section-title {
				font-size: 28px;
			}

			.accordion .toggler {
				color: #fff;
				background-color: #EB144C;
			}

			#accordion-versions.accordion .btn.btn-light {
				padding-top: 15px;
				padding-bottom: 15px;
			}

			.latest-cat-post a h3 {
				transition: color .35s ease;
			}

			.latest-cat-post a:hover h3 {
				color: #EB144C !important;
			}

			/*Responsive Styles*/
			@media (max-width: 767px) {
				h2, 
				.h2 {
					font-size: 1.5rem;
				}
			}
			@media (min-width: 576px) {
				.logo {
					max-width: 120px;
				}
			}

			@media (min-width: 992px) {
				.pageMainNavCollapse {
					position: relative;
					width: auto;
					height: auto;
					left: auto;
					top: auto;
					overflow-y: visible;
				}

				.mainNavigation li {
					padding: 0;
					border-bottom: 0;
				}

				.mainNavigation li a {
					padding: 0.5rem .75rem !important;
				}

				.site-overlay {
					display: none;
				}

				.content-section {
					padding-right: 1rem!important;
					padding-left: 1rem!important;
				}
			}

			@media (min-width: 1200px) {
				.mainNavigation li a {
					padding: 0.5rem 1.25rem !important;
				}

				.container {
					max-width: 1280px;
				}
			}


			/* Slider */

			.slick-slider {
				position: relative;
				display: block;
				box-sizing: border-box;
				-webkit-user-select: none;
				-ms-user-select: none;
				user-select: none;
				-webkit-touch-callout: none;
				-khtml-user-select: none;
				-ms-touch-action: pan-y;
				touch-action: pan-y;
				-webkit-tap-highlight-color: transparent;
			}

			.slick-list {
				position: relative;
				display: block;
				overflow: hidden;
				margin: 0;
				padding: 0;
			}

			.slick-list:focus {
				outline: none;
			}

			.slick-list.dragging {
				cursor: pointer;
				cursor: hand;
			}

			.slick-slider .slick-track,
			.slick-slider .slick-list {
				-webkit-transform: translate3d(0, 0, 0);
				-ms-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}

			.slick-track {
				position: relative;
				top: 0;
				left: 0;
				display: block;
			}

			.slick-track:before,
			.slick-track:after {
				display: table;
				content: "";
			}

			.slick-track:after {
				clear: both;
			}

			.slick-loading .slick-track {
				visibility: hidden;
			}

			.slick-slide {
				display: none;
				float: left;
				height: 100%;
				min-height: 1px;
			}

			[dir="rtl"] .slick-slide {
				float: right;
			}

			.slick-slide img {
				display: block;
			}

			.slick-slide.slick-loading img {
				display: none;
			}

			.slick-slide.dragging img {
				pointer-events: none;
			}

			.slick-initialized .slick-slide {
				display: block;
			}

			.slick-loading .slick-slide {
				visibility: hidden;
			}

			.slick-vertical .slick-slide {
				display: block;
				height: auto;
				border: 1px solid transparent;
			}

			.slick-arrow.slick-hidden {
				display: none;
			}

			/* Slider */

			.slick-slider {
				position: relative;
				display: block;
				box-sizing: border-box;
				-webkit-user-select: none;
				-ms-user-select: none;
				user-select: none;
				-webkit-touch-callout: none;
				-khtml-user-select: none;
				-ms-touch-action: pan-y;
				touch-action: pan-y;
				-webkit-tap-highlight-color: transparent;
			}

			.slick-list {
				position: relative;
				display: block;
				overflow: hidden;
				margin: 0;
				padding: 0;
			}

			.slick-list:focus {
				outline: none;
			}

			.slick-list.dragging {
				cursor: pointer;
				cursor: hand;
			}

			.slick-slider .slick-track,
			.slick-slider .slick-list {
				-webkit-transform: translate3d(0, 0, 0);
				-ms-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}

			.slick-track {
				position: relative;
				top: 0;
				left: 0;
				display: block;
			}

			.slick-track:before,
			.slick-track:after {
				display: table;
				content: "";
			}

			.slick-track:after {
				clear: both;
			}

			.slick-loading .slick-track {
				visibility: hidden;
			}

			.slick-slide {
				display: none;
				float: left;
				height: 100%;
				min-height: 1px;
			}

			[dir="rtl"] .slick-slide {
				float: right;
			}

			.slick-slide img {
				display: block;
			}

			.slick-slide.slick-loading img {
				display: none;
			}

			.slick-slide.dragging img {
				pointer-events: none;
			}

			.slick-initialized .slick-slide {
				display: block;
			}

			.slick-loading .slick-slide {
				visibility: hidden;
			}

			.slick-vertical .slick-slide {
				display: block;
				height: auto;
				border: 1px solid transparent;
			}

			.slick-arrow.slick-hidden {
				display: none;
			}

			.sitePagination {
				justify-content: center;
				margin-bottom: 1.5rem;
				display: flex;
			}

			.sitePagination .page-numbers {
				font-size: 1rem;
				font-weight: 600;
				color: #212529;
				background: #F0F2F5;
				border-color: #F0F2F5;
				border-radius: 0.5rem!important;
				display: flex;
				align-items: center;
				justify-content: center;
				width: 2.5rem;
				height: 2.5rem;
				text-align: center;
				padding: 0;
				margin-left: 0.25rem;
				margin-right: 0.25rem;
			}

			.sitePagination .page-numbers.current {
				color: #fff;
				background-color: #EB144C;
				border-color: #EB14
			}

			.sitePagination .page-numbers.next {
				font-size: 14px;
			}

			.sitePagination a.page-numbers:hover,
			.sitePagination a.page-numbers:focus {
				color: #212529;
				background-color: #E2E6EA;
				border-color: #E2E6EA;
			}
			.ah-breadcrumb{
				display: flex;
				list-style: none;
				padding: 0;
				margin: 0;
			}
			.ah-breadcrumb li{
				margin-right:10px;
			}

			ul.slicksDots {
				display: flex;
				justify-content: center;
				list-style-type: none;
				padding-left: 0;
				padding-bottom: 20px;
			}
			.slicksDots > li {
				margin-left: 8px;
				margin-right: 8px;
				width: 16px;
				padding: 0;
				overflow: hidden;
			}
			.slicksDots > li button {
				border: 0;
				border-radius: 100%;
				width: 16px;
				height: 16px;
				text-indent: -9999px;
				background-color: #F0F2F5;
				display: block;
				overflow: hidden;
				transition: all 0.35s ease;
			}
			.slicksDots > li button:hover {
				background-color: #E2E6EA;
			}
			.slicksDots > li.slick-active button {
				background-color: #EB144C;
			}
			.singlePostBreadCrumb .ah-breadcrumb {
				margin-bottom: 10px;
			}
			.category-post .btn-primary {
				font-size: .75rem;
				padding: 0.185rem 0.25rem 0.1rem;
				border-radius: 50rem!important;
				line-height: 1.5;
				min-width: 60px;
				color: #EB144C;
				background-color: #efeff4;
				border-color: #efeff4;
			}
			.category-post:hover .btn-primary {
				color: #fff;
				background-color: #EB144C;
				border-color: #EB144C;
			}
			
			.blogsSlider:not(.slick-initialized){
				height: 226px;
				opacity: 0;
				visibility: hidden;
			}
			#reply-title{
				font-size: 28px;
				font-weight: 700!important;
				margin-bottom: 1rem!important;
				line-height: 1.1;
			}
			#commentform input[type=checkbox]{
				display:none !important;
			}
			.form-submit{
				text-align: right;
			}
			.submit{
				color: #fff;
				background-color: #EB144C;
				border-color: #EB144C;
				font-weight: 600;
				border-radius: 0.375rem;	
				display: inline-block;
				text-align: center;
				vertical-align: middle;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
				border: 1px solid transparent;
				padding: 0.375rem 0.75rem;
				font-size: 1rem;
				line-height: 1.5;
				
			}
			
			
		</style>

	<?php
}