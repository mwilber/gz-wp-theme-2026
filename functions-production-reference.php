<?php
/**
 * GreenZeta functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GreenZeta
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'greenzeta_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function greenzeta_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on GreenZeta, use a find and replace
		 * to change 'greenzeta' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'greenzeta', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'greenzeta' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'greenzeta_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'greenzeta_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function greenzeta_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'greenzeta_content_width', 640 );
}
add_action( 'after_setup_theme', 'greenzeta_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function greenzeta_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'greenzeta' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'greenzeta' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'greenzeta_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function greenzeta_scripts() {
	wp_enqueue_style( 'greenzeta-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'greenzeta-style', 'rtl', 'replace' );
	wp_enqueue_script( 'greenzeta-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'greenzeta-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    
    // Custom script for GreenZeta.com
    wp_enqueue_script( 'greenzeta-custom', get_template_directory_uri() . '/js/greenzeta.js', array(), _S_VERSION, true );
    // Screenshot Carousel
	wp_enqueue_script( 'swiperjs', get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), "3.4.1", true );
	wp_enqueue_style( 'swiper-theme', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), '3.4.1' );

}
add_action( 'wp_enqueue_scripts', 'greenzeta_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

flush_rewrite_rules( false );



////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
//
// Begin Custom Functions for GreenZeta.com
//
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////////////////////////////
// Add Page Slug to Body ClassList
////////////////////////////////////////////////////////////////////////////////////////////////////
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}

add_filter( 'body_class', 'add_slug_body_class' );
////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////
// Register Custom Taxonomy (project)
////////////////////////////////////////////////////////////////////////////////////////////////////
function project() {

	$labels = array(
		'name'                       => _x( 'Projects', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Project', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Projects', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               =>true,
	);
	register_taxonomy( 'project', array( 'post', ' portfolio', ' update' ), $args );

}

add_action( 'init', 'project', 0 );
////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////
// Register Custom Post Types (portfolio, update)
////////////////////////////////////////////////////////////////////////////////////////////////////
function register_gz_post_types() {

	$taxs = array( 'category', 'post_tag', 'project' );
	
	// Set up Update Posts
	$labels = array(
		'name'                  => 'Updates',
		'singular_name'         => 'Update',
		'menu_name'             => 'Updates',
		'name_admin_bar'        => 'Update',
		'archives'              => 'Item Archives',
		'attributes'            => 'Item Attributes',
		'parent_item_colon'     => 'Parent Item:',
		'all_items'             => 'All Items',
		'add_new_item'          => 'Add New Item',
		'add_new'               => 'Add New',
		'new_item'              => 'New Item',
		'edit_item'             => 'Edit Item',
		'update_item'           => 'Update Item',
		'view_item'             => 'View Item',
		'view_items'            => 'View Items',
		'search_items'          => 'Search Item',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into item',
		'uploaded_to_this_item' => 'Uploaded to this item',
		'items_list'            => 'Items list',
		'items_list_navigation' => 'Items list navigation',
		'filter_items_list'     => 'Filter items list',
	);
	$args = array(
		'label'                 => 'Update',
		'description'           => 'Personal Project Updates',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),
		'taxonomies'            => $taxs,
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'update', $args );


	// Set up Portfolio Posts
	$args['labels']['name'] = 'Portfolio';
	$args['labels']['singular_name'] = 'Portfolio';
	$args['labels']['menu_name'] = 'Portfolio';
	$args['labels']['name_admin_bar'] = 'Portfolio';
	$args['label'] = 'Portfolio';
	$args['description'] = 'Professional Work';
	$args['taxonomies'] = array( 'post_tag' );

	register_post_type( 'portfolio', $args );

}

add_action( 'init', 'register_gz_post_types', 0 );
////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////
// Show custom post types in category archive
////////////////////////////////////////////////////////////////////////////////////////////////////
function themeprefix_show_cpt_archives( $query ) {
	if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
		$query->set( 'post_type', array(
			'post', 'nav_menu_item', 'update', 'project', 'portfolio'
		));
		return $query;
	}
}

//add_filter( 'pre_get_posts', 'themeprefix_show_cpt_archives' );
////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////
// Add an options page for global field values
////////////////////////////////////////////////////////////////////////////////////////////////////
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Global Content',
		'menu_title'	=> 'Global Content',
		'menu_slug' 	=> 'global-content',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}
////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////
// Always enque fontawesome (ACF Fontawesome plugin)
////////////////////////////////////////////////////////////////////////////////////////////////////
add_filter( 'ACFFA_always_enqueue_fa', '__return_true' );
////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////
// Turn off archive pagination in portfolio
////////////////////////////////////////////////////////////////////////////////////////////////////
function no_nopaging($query) {
	if (is_post_type_archive('portfolio')) {
		$query->set('nopaging', 1);
	}
}

add_action('parse_query', 'no_nopaging');
////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////
// Allow ordering of project list by frequency
////////////////////////////////////////////////////////////////////////////////////////////////////
function customtaxorder_applyorderfilter($orderby, $args) {
	if($args['orderby'] == 'term_order')
		return 't.term_order';
	else
		return $orderby;
}
add_filter('get_terms_orderby', 'customtaxorder_applyorderfilter', 10, 2);
////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////
// 
////////////////////////////////////////////////////////////////////////////////////////////////////
function wpse147412_order_terms_by_post_date( $pieces, $taxonomies, $args ) {
	global $wpdb;

	if ( 'post_date' !== $args['orderby'] ) {
		return $pieces;
	}

	$args = wp_parse_args( $args, array( 'post_types' => 'update' ) );

	$pieces['fields']   = 'DISTINCT ' . $pieces['fields'] . ', MAX(p.post_date) as post_date_sort';
	$pieces['join']    .= " JOIN $wpdb->term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id";
	$pieces['join']    .= " JOIN $wpdb->posts AS p ON p.ID = tr.object_id";
	$pieces['where']   .= " AND p.post_type IN ('" . implode( "', '", (array) $args['post_types'] ) . "')";
	$pieces['orderby']  = ' GROUP BY t.name ORDER BY post_date_sort';
	
	//print_r($pieces);

	return $pieces;
}
add_filter( 'terms_clauses', 'wpse147412_order_terms_by_post_date', 10, 3 );

// function remove_redirect_guess_404_permalink( $redirect_url ) {
//   if ( is_404() ) {
//     return false;
//   }else{
//     return $redirect_url;
//   }//end if
// }//end remove_redirect_guess_404_permalink()
// add_filter( 'redirect_canonical', 'remove_redirect_guess_404_permalink' );
// function func_404_redirect($query){
//   if ( is_404() ) {
//   global $wp_query;
//   $post = get_post(2530);
//   $wp_query->queried_object = $post;
//   $wp_query->is_single = true;
//   $wp_query->is_404 = false;
//   $wp_query->queried_object_id = $post->ID;
//   $wp_query->post_count = 1;
//   $wp_query->current_post=-1;
//   $wp_query->posts = array($post);
//   }
// }
// add_filter('template_redirect','func_404_redirect');
////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////
// Add active class to main menu when looking at posts
////////////////////////////////////////////////////////////////////////////////////////////////////
function menu_item_parent_class_remove($var)
{
	// check for current page values, return false if they exist.
	if ($var == 'current_page_parent' || $var == 'current-menu-item' || $var == 'current-page-ancestor') { return false; }

	return true;
}

function gz_add_class_to_menu($classes)
{
	if (is_singular('portfolio')){
		$classes = array_filter($classes, 'menu_item_parent_class_remove');
		if (in_array('menu-item-2684', $classes)) $classes[] = 'current-menu-item';
	}elseif (is_singular('post')){
		$classes = array_filter($classes, 'menu_item_parent_class_remove');
		if (in_array('menu-item-2682', $classes)) $classes[] = 'current-menu-item';
	}elseif (is_tax('project') || is_singular('update')){
		$classes = array_filter($classes, 'menu_item_parent_class_remove');
		if (in_array('menu-item-2925', $classes)) $classes[] = 'current-menu-item';
	}
	return $classes;
}

if (!is_admin()) { add_filter('nav_menu_css_class', 'gz_add_class_to_menu'); }
////////////////////////////////////////////////////////////////////////////////////////////////////


	    // Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {  
	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => '.translation',  
			'block' => 'blockquote',  
			'classes' => 'translation',
			'wrapper' => true,
			
		),  
		array(  
			'title' => '⇠.rtl',  
			'block' => 'blockquote',  
			'classes' => 'rtl',
			'wrapper' => true,
		),
		array(  
			'title' => '.ltr⇢',  
			'block' => 'blockquote',  
			'classes' => 'ltr',
			'wrapper' => true,
		),
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = wp_json_encode( $style_formats );  
	
	return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );  

