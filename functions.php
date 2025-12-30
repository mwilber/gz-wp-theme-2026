<?php
/**
 * Theme functions and setup.
 */

function greenzeta_2026_setup() {
  load_theme_textdomain( 'greenzeta-2026' );

  add_theme_support( 'title-tag' );
  add_theme_support( 'custom-logo' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'editor-styles' );
  add_editor_style( 'assets/css/editor.css' );
  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'script',
      'style',
    )
  );

  register_nav_menus(
    array(
      'primary' => __( 'Primary Menu', 'greenzeta-2026' ),
      'social' => __( 'Social Menu', 'greenzeta-2026' ),
    )
  );
}
add_action( 'after_setup_theme', 'greenzeta_2026_setup' );

function greenzeta_2026_register_image_sizes() {
  add_image_size( 'greenzeta-card', 720, 480, true );
}
add_action( 'after_setup_theme', 'greenzeta_2026_register_image_sizes' );

function greenzeta_2026_enqueue_assets() {
  wp_enqueue_style(
    'greenzeta-2026-fonts',
    'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap',
    array(),
    null
  );
  wp_enqueue_style( 'greenzeta-2026-style', get_stylesheet_uri(), array( 'greenzeta-2026-fonts' ), '1.0.0' );
  wp_enqueue_script(
    'greenzeta-2026-navigation',
    get_template_directory_uri() . '/assets/js/navigation.js',
    array(),
    '1.0.0',
    true
  );
  wp_enqueue_script(
    'greenzeta-2026-screenshot-lightbox',
    get_template_directory_uri() . '/assets/js/screenshot-lightbox.js',
    array(),
    '1.0.0',
    true
  );
}
add_action( 'wp_enqueue_scripts', 'greenzeta_2026_enqueue_assets' );

function greenzeta_2026_enqueue_admin_assets( $hook ) {
  if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
    return;
  }

  $screen = get_current_screen();
  if ( ! $screen || ! in_array( $screen->post_type, array( 'post', 'portfolio', 'update', 'project' ), true ) ) {
    return;
  }

  wp_enqueue_media();
  wp_enqueue_script(
    'greenzeta-2026-banner-meta',
    get_template_directory_uri() . '/assets/js/banner-meta.js',
    array( 'jquery' ),
    '1.0.0',
    true
  );
  wp_enqueue_script(
    'greenzeta-2026-gallery-meta',
    get_template_directory_uri() . '/assets/js/gallery-meta.js',
    array( 'jquery' ),
    '1.0.0',
    true
  );
}
add_action( 'admin_enqueue_scripts', 'greenzeta_2026_enqueue_admin_assets' );

function greenzeta_2026_register_custom_post_types() {
  $taxonomies = array( 'category', 'post_tag' );

  $labels = array(
    'name' => __( 'Updates', 'greenzeta-2026' ),
    'singular_name' => __( 'Update', 'greenzeta-2026' ),
    'menu_name' => __( 'Updates', 'greenzeta-2026' ),
    'name_admin_bar' => __( 'Update', 'greenzeta-2026' ),
    'archives' => __( 'Item Archives', 'greenzeta-2026' ),
    'attributes' => __( 'Item Attributes', 'greenzeta-2026' ),
    'parent_item_colon' => __( 'Parent Item:', 'greenzeta-2026' ),
    'all_items' => __( 'All Items', 'greenzeta-2026' ),
    'add_new_item' => __( 'Add New Item', 'greenzeta-2026' ),
    'add_new' => __( 'Add New', 'greenzeta-2026' ),
    'new_item' => __( 'New Item', 'greenzeta-2026' ),
    'edit_item' => __( 'Edit Item', 'greenzeta-2026' ),
    'update_item' => __( 'Update Item', 'greenzeta-2026' ),
    'view_item' => __( 'View Item', 'greenzeta-2026' ),
    'view_items' => __( 'View Items', 'greenzeta-2026' ),
    'search_items' => __( 'Search Item', 'greenzeta-2026' ),
    'not_found' => __( 'Not found', 'greenzeta-2026' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'greenzeta-2026' ),
    'featured_image' => __( 'Featured Image', 'greenzeta-2026' ),
    'set_featured_image' => __( 'Set featured image', 'greenzeta-2026' ),
    'remove_featured_image' => __( 'Remove featured image', 'greenzeta-2026' ),
    'use_featured_image' => __( 'Use as featured image', 'greenzeta-2026' ),
    'insert_into_item' => __( 'Insert into item', 'greenzeta-2026' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'greenzeta-2026' ),
    'items_list' => __( 'Items list', 'greenzeta-2026' ),
    'items_list_navigation' => __( 'Items list navigation', 'greenzeta-2026' ),
    'filter_items_list' => __( 'Filter items list', 'greenzeta-2026' ),
  );

  $args = array(
    'label' => __( 'Update', 'greenzeta-2026' ),
    'description' => __( 'Personal Project Updates', 'greenzeta-2026' ),
    'labels' => $labels,
    'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),
    'taxonomies' => $taxonomies,
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'capability_type' => 'page',
    'show_in_rest' => true,
  );

  register_post_type( 'update', $args );

  $portfolio_args = $args;
  $portfolio_args['label'] = __( 'Portfolio', 'greenzeta-2026' );
  $portfolio_args['description'] = __( 'Professional Work', 'greenzeta-2026' );
  $portfolio_args['labels']['name'] = __( 'Portfolio', 'greenzeta-2026' );
  $portfolio_args['labels']['singular_name'] = __( 'Portfolio', 'greenzeta-2026' );
  $portfolio_args['labels']['menu_name'] = __( 'Portfolio', 'greenzeta-2026' );
  $portfolio_args['labels']['name_admin_bar'] = __( 'Portfolio', 'greenzeta-2026' );
  $portfolio_args['taxonomies'] = array( 'post_tag' );

  register_post_type( 'portfolio', $portfolio_args );

  $project_labels = array(
    'name' => __( 'Projects', 'greenzeta-2026' ),
    'singular_name' => __( 'Project', 'greenzeta-2026' ),
    'menu_name' => __( 'Projects', 'greenzeta-2026' ),
    'name_admin_bar' => __( 'Project', 'greenzeta-2026' ),
    'archives' => __( 'Project Archives', 'greenzeta-2026' ),
    'attributes' => __( 'Project Attributes', 'greenzeta-2026' ),
    'parent_item_colon' => __( 'Parent Project:', 'greenzeta-2026' ),
    'all_items' => __( 'All Projects', 'greenzeta-2026' ),
    'add_new_item' => __( 'Add New Project', 'greenzeta-2026' ),
    'add_new' => __( 'Add New', 'greenzeta-2026' ),
    'new_item' => __( 'New Project', 'greenzeta-2026' ),
    'edit_item' => __( 'Edit Project', 'greenzeta-2026' ),
    'update_item' => __( 'Update Project', 'greenzeta-2026' ),
    'view_item' => __( 'View Project', 'greenzeta-2026' ),
    'view_items' => __( 'View Projects', 'greenzeta-2026' ),
    'search_items' => __( 'Search Projects', 'greenzeta-2026' ),
    'not_found' => __( 'Not found', 'greenzeta-2026' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'greenzeta-2026' ),
    'featured_image' => __( 'Featured Image', 'greenzeta-2026' ),
    'set_featured_image' => __( 'Set featured image', 'greenzeta-2026' ),
    'remove_featured_image' => __( 'Remove featured image', 'greenzeta-2026' ),
    'use_featured_image' => __( 'Use as featured image', 'greenzeta-2026' ),
    'insert_into_item' => __( 'Insert into item', 'greenzeta-2026' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'greenzeta-2026' ),
    'items_list' => __( 'Items list', 'greenzeta-2026' ),
    'items_list_navigation' => __( 'Items list navigation', 'greenzeta-2026' ),
    'filter_items_list' => __( 'Filter items list', 'greenzeta-2026' ),
  );

  $project_args = array(
    'label' => __( 'Project', 'greenzeta-2026' ),
    'description' => __( 'Project entries', 'greenzeta-2026' ),
    'labels' => $project_labels,
    'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 6,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'show_in_rest' => true,
  );

  register_post_type( 'project', $project_args );
}
add_action( 'init', 'greenzeta_2026_register_custom_post_types', 0 );

function greenzeta_2026_register_hero_meta() {
  register_post_meta(
    'page',
    'greenzeta_hero_headline',
    array(
      'type' => 'string',
      'single' => true,
      'sanitize_callback' => 'sanitize_text_field',
      'show_in_rest' => false,
    )
  );

  register_post_meta(
    'page',
    'greenzeta_hero_subhead',
    array(
      'type' => 'string',
      'single' => true,
      'sanitize_callback' => 'sanitize_textarea_field',
      'show_in_rest' => false,
    )
  );

  register_post_meta(
    'page',
    'greenzeta_hero_skills',
    array(
      'type' => 'string',
      'single' => true,
      'sanitize_callback' => 'sanitize_text_field',
      'show_in_rest' => false,
    )
  );
}
add_action( 'init', 'greenzeta_2026_register_hero_meta' );

function greenzeta_2026_register_client_meta() {
  $post_types = array( 'portfolio', 'project' );

  foreach ( $post_types as $post_type ) {
    register_post_meta(
      $post_type,
      'client',
      array(
        'type' => 'string',
        'single' => true,
        'sanitize_callback' => 'sanitize_text_field',
        'show_in_rest' => false,
      )
    );
  }
}
add_action( 'init', 'greenzeta_2026_register_client_meta' );

function greenzeta_2026_register_banner_meta() {
  $post_types = array( 'post', 'portfolio', 'update', 'project' );

  foreach ( $post_types as $post_type ) {
    register_post_meta(
      $post_type,
      'banner',
      array(
        'type' => 'integer',
        'single' => true,
        'sanitize_callback' => 'absint',
        'show_in_rest' => false,
      )
    );
  }
}
add_action( 'init', 'greenzeta_2026_register_banner_meta' );

function greenzeta_2026_register_gallery_meta() {
  $post_types = array( 'portfolio', 'project' );

  foreach ( $post_types as $post_type ) {
    register_post_meta(
      $post_type,
      'screen_shots',
      array(
        'type' => 'array',
        'single' => true,
        'sanitize_callback' => 'wp_parse_id_list',
        'show_in_rest' => false,
      )
    );
  }
}
add_action( 'init', 'greenzeta_2026_register_gallery_meta' );

function greenzeta_2026_register_case_media_meta() {
  $post_types = array( 'portfolio', 'project' );

  foreach ( $post_types as $post_type ) {
    register_post_meta(
      $post_type,
      'case_video',
      array(
        'type' => 'string',
        'single' => true,
        'sanitize_callback' => 'esc_url_raw',
        'show_in_rest' => false,
      )
    );

    register_post_meta(
      $post_type,
      'case_poster',
      array(
        'type' => 'string',
        'single' => true,
        'sanitize_callback' => 'esc_url_raw',
        'show_in_rest' => false,
      )
    );
  }
}
add_action( 'init', 'greenzeta_2026_register_case_media_meta' );

function greenzeta_2026_register_live_site_meta() {
  $post_types = array( 'portfolio', 'project' );

  foreach ( $post_types as $post_type ) {
    register_post_meta(
      $post_type,
      'live_site',
      array(
        'type' => 'string',
        'single' => true,
        'sanitize_callback' => 'esc_url_raw',
        'show_in_rest' => false,
      )
    );
  }
}
add_action( 'init', 'greenzeta_2026_register_live_site_meta' );

function greenzeta_2026_register_project_link_meta() {
  $post_types = array( 'post', 'update' );

  foreach ( $post_types as $post_type ) {
    register_post_meta(
      $post_type,
      'project_id',
      array(
        'type' => 'integer',
        'single' => true,
        'sanitize_callback' => 'absint',
        'show_in_rest' => false,
      )
    );
  }
}
add_action( 'init', 'greenzeta_2026_register_project_link_meta' );

function greenzeta_2026_add_hero_meta_box( $post_type, $post ) {
  if ( 'page' !== $post_type ) {
    return;
  }

  $front_page_id = (int) get_option( 'page_on_front' );
  if ( ! $front_page_id || (int) $post->ID !== $front_page_id ) {
    return;
  }

  add_meta_box(
    'greenzeta-hero-meta',
    __( 'Hero Content', 'greenzeta-2026' ),
    'greenzeta_2026_render_hero_meta_box',
    'page',
    'normal',
    'high'
  );
}
add_action( 'add_meta_boxes', 'greenzeta_2026_add_hero_meta_box', 10, 2 );

function greenzeta_2026_add_banner_meta_box( $post_type, $post ) {
  $allowed_post_types = array( 'post', 'portfolio', 'update', 'project' );
  if ( ! in_array( $post_type, $allowed_post_types, true ) ) {
    return;
  }

  add_meta_box(
    'greenzeta-banner-meta',
    __( 'Banner Image', 'greenzeta-2026' ),
    'greenzeta_2026_render_banner_meta_box',
    $post_type,
    'side',
    'high'
  );
}
add_action( 'add_meta_boxes', 'greenzeta_2026_add_banner_meta_box', 10, 2 );

function greenzeta_2026_add_gallery_meta_box( $post_type, $post ) {
  if ( ! in_array( $post_type, array( 'portfolio', 'project' ), true ) ) {
    return;
  }

  add_meta_box(
    'greenzeta-gallery-meta',
    __( 'Screenshots', 'greenzeta-2026' ),
    'greenzeta_2026_render_gallery_meta_box',
    $post_type,
    'normal',
    'high'
  );
}
add_action( 'add_meta_boxes', 'greenzeta_2026_add_gallery_meta_box', 10, 2 );

function greenzeta_2026_add_case_media_meta_box( $post_type, $post ) {
  if ( ! in_array( $post_type, array( 'portfolio', 'project' ), true ) ) {
    return;
  }

  add_meta_box(
    'greenzeta-case-media',
    __( 'Case Video', 'greenzeta-2026' ),
    'greenzeta_2026_render_case_media_meta_box',
    $post_type,
    'normal',
    'default'
  );
}
add_action( 'add_meta_boxes', 'greenzeta_2026_add_case_media_meta_box', 10, 2 );

function greenzeta_2026_add_live_site_meta_box( $post_type, $post ) {
  if ( ! in_array( $post_type, array( 'portfolio', 'project' ), true ) ) {
    return;
  }

  add_meta_box(
    'greenzeta-live-site',
    __( 'Live Site', 'greenzeta-2026' ),
    'greenzeta_2026_render_live_site_meta_box',
    $post_type,
    'side',
    'default'
  );
}
add_action( 'add_meta_boxes', 'greenzeta_2026_add_live_site_meta_box', 10, 2 );

function greenzeta_2026_add_project_link_meta_box( $post_type, $post ) {
  if ( ! in_array( $post_type, array( 'post', 'update' ), true ) ) {
    return;
  }

  add_meta_box(
    'greenzeta-project-link',
    __( 'Linked Project', 'greenzeta-2026' ),
    'greenzeta_2026_render_project_link_meta_box',
    $post_type,
    'side',
    'default'
  );
}
add_action( 'add_meta_boxes', 'greenzeta_2026_add_project_link_meta_box', 10, 2 );

function greenzeta_2026_render_banner_meta_box( $post ) {
  $banner_id = (int) get_post_meta( $post->ID, 'banner', true );
  $banner_src = $banner_id ? wp_get_attachment_image_url( $banner_id, 'medium' ) : '';

  wp_nonce_field( 'greenzeta_banner_meta', 'greenzeta_banner_meta_nonce' );
  ?>
  <div class="greenzeta-banner-meta" data-banner-id="<?php echo esc_attr( $banner_id ); ?>">
    <div class="greenzeta-banner-meta__preview" style="margin-bottom: 12px;">
      <?php if ( $banner_src ) : ?>
        <img src="<?php echo esc_url( $banner_src ); ?>" alt="" style="max-width: 100%; height: auto;" />
      <?php else : ?>
        <em><?php esc_html_e( 'No banner selected.', 'greenzeta-2026' ); ?></em>
      <?php endif; ?>
    </div>
    <input type="hidden" name="greenzeta_banner_id" value="<?php echo esc_attr( $banner_id ); ?>" />
    <button type="button" class="button greenzeta-banner-meta__select"><?php esc_html_e( 'Select banner', 'greenzeta-2026' ); ?></button>
    <button type="button" class="button-link greenzeta-banner-meta__remove" <?php echo $banner_id ? '' : 'style="display:none;"'; ?>>
      <?php esc_html_e( 'Remove banner', 'greenzeta-2026' ); ?>
    </button>
  </div>
  <?php
}

function greenzeta_2026_save_banner_meta( $post_id ) {
  if ( ! isset( $_POST['greenzeta_banner_meta_nonce'] ) ) {
    return;
  }

  if ( ! wp_verify_nonce( $_POST['greenzeta_banner_meta_nonce'], 'greenzeta_banner_meta' ) ) {
    return;
  }

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  if ( ! current_user_can( 'edit_post', $post_id ) ) {
    return;
  }

  if ( isset( $_POST['greenzeta_banner_id'] ) ) {
    update_post_meta( $post_id, 'banner', absint( wp_unslash( $_POST['greenzeta_banner_id'] ) ) );
  }
}
add_action( 'save_post', 'greenzeta_2026_save_banner_meta' );

function greenzeta_2026_render_gallery_meta_box( $post ) {
  $stored = get_post_meta( $post->ID, 'screen_shots', true );
  $image_ids = array();

  if ( is_array( $stored ) ) {
    $image_ids = array_filter( array_map( 'absint', $stored ) );
  } elseif ( is_string( $stored ) && '' !== $stored ) {
    $image_ids = wp_parse_id_list( $stored );
  }

  wp_nonce_field( 'greenzeta_gallery_meta', 'greenzeta_gallery_meta_nonce' );
  ?>
  <div class="greenzeta-gallery-meta">
    <div class="greenzeta-gallery-meta__preview" style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 12px;">
      <?php if ( $image_ids ) : ?>
        <?php foreach ( $image_ids as $image_id ) : ?>
          <?php echo wp_get_attachment_image( $image_id, 'thumbnail', false, array( 'style' => 'width: 80px; height: auto;' ) ); ?>
        <?php endforeach; ?>
      <?php else : ?>
        <em><?php esc_html_e( 'No screenshots selected.', 'greenzeta-2026' ); ?></em>
      <?php endif; ?>
    </div>
    <input type="hidden" name="greenzeta_screen_shots" value="<?php echo esc_attr( implode( ',', $image_ids ) ); ?>" />
    <button type="button" class="button greenzeta-gallery-meta__select"><?php esc_html_e( 'Select screenshots', 'greenzeta-2026' ); ?></button>
    <button type="button" class="button-link greenzeta-gallery-meta__clear" <?php echo $image_ids ? '' : 'style="display:none;"'; ?>>
      <?php esc_html_e( 'Clear screenshots', 'greenzeta-2026' ); ?>
    </button>
  </div>
  <?php
}

function greenzeta_2026_save_gallery_meta( $post_id ) {
  if ( ! isset( $_POST['greenzeta_gallery_meta_nonce'] ) ) {
    return;
  }

  if ( ! wp_verify_nonce( $_POST['greenzeta_gallery_meta_nonce'], 'greenzeta_gallery_meta' ) ) {
    return;
  }

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  if ( ! current_user_can( 'edit_post', $post_id ) ) {
    return;
  }

  if ( isset( $_POST['greenzeta_screen_shots'] ) ) {
    $image_ids = wp_parse_id_list( wp_unslash( $_POST['greenzeta_screen_shots'] ) );
    if ( $image_ids ) {
      update_post_meta( $post_id, 'screen_shots', $image_ids );
    } else {
      delete_post_meta( $post_id, 'screen_shots' );
    }
  }
}
add_action( 'save_post_portfolio', 'greenzeta_2026_save_gallery_meta' );
add_action( 'save_post_project', 'greenzeta_2026_save_gallery_meta' );

function greenzeta_2026_render_case_media_meta_box( $post ) {
  $video = get_post_meta( $post->ID, 'case_video', true );
  $poster = get_post_meta( $post->ID, 'case_poster', true );

  wp_nonce_field( 'greenzeta_case_media_meta', 'greenzeta_case_media_meta_nonce' );
  ?>
  <p>
    <label for="greenzeta-case-video"><strong><?php esc_html_e( 'Video URL', 'greenzeta-2026' ); ?></strong></label>
    <input
      type="url"
      id="greenzeta-case-video"
      name="greenzeta_case_video"
      value="<?php echo esc_attr( $video ); ?>"
      class="widefat"
      placeholder="https://"
    />
  </p>
  <p>
    <label for="greenzeta-case-poster"><strong><?php esc_html_e( 'Poster URL', 'greenzeta-2026' ); ?></strong></label>
    <input
      type="url"
      id="greenzeta-case-poster"
      name="greenzeta_case_poster"
      value="<?php echo esc_attr( $poster ); ?>"
      class="widefat"
      placeholder="https://"
    />
  </p>
  <?php
}

function greenzeta_2026_save_case_media_meta( $post_id ) {
  if ( ! isset( $_POST['greenzeta_case_media_meta_nonce'] ) ) {
    return;
  }

  if ( ! wp_verify_nonce( $_POST['greenzeta_case_media_meta_nonce'], 'greenzeta_case_media_meta' ) ) {
    return;
  }

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  if ( ! current_user_can( 'edit_post', $post_id ) ) {
    return;
  }

  if ( isset( $_POST['greenzeta_case_video'] ) ) {
    update_post_meta( $post_id, 'case_video', esc_url_raw( wp_unslash( $_POST['greenzeta_case_video'] ) ) );
  }

  if ( isset( $_POST['greenzeta_case_poster'] ) ) {
    update_post_meta( $post_id, 'case_poster', esc_url_raw( wp_unslash( $_POST['greenzeta_case_poster'] ) ) );
  }
}
add_action( 'save_post_portfolio', 'greenzeta_2026_save_case_media_meta' );
add_action( 'save_post_project', 'greenzeta_2026_save_case_media_meta' );

function greenzeta_2026_render_live_site_meta_box( $post ) {
  $live_site = get_post_meta( $post->ID, 'live_site', true );

  wp_nonce_field( 'greenzeta_live_site_meta', 'greenzeta_live_site_meta_nonce' );
  ?>
  <p>
    <label for="greenzeta-live-site"><strong><?php esc_html_e( 'Live site URL', 'greenzeta-2026' ); ?></strong></label>
    <input
      type="url"
      id="greenzeta-live-site"
      name="greenzeta_live_site"
      value="<?php echo esc_attr( $live_site ); ?>"
      class="widefat"
      placeholder="https://"
    />
  </p>
  <?php
}

function greenzeta_2026_save_live_site_meta( $post_id ) {
  if ( ! isset( $_POST['greenzeta_live_site_meta_nonce'] ) ) {
    return;
  }

  if ( ! wp_verify_nonce( $_POST['greenzeta_live_site_meta_nonce'], 'greenzeta_live_site_meta' ) ) {
    return;
  }

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  if ( ! current_user_can( 'edit_post', $post_id ) ) {
    return;
  }

  if ( isset( $_POST['greenzeta_live_site'] ) ) {
    update_post_meta( $post_id, 'live_site', esc_url_raw( wp_unslash( $_POST['greenzeta_live_site'] ) ) );
  }
}
add_action( 'save_post_portfolio', 'greenzeta_2026_save_live_site_meta' );
add_action( 'save_post_project', 'greenzeta_2026_save_live_site_meta' );

function greenzeta_2026_render_project_link_meta_box( $post ) {
  $selected_id = (int) get_post_meta( $post->ID, 'project_id', true );
  $projects = get_posts(
    array(
      'post_type' => 'project',
      'posts_per_page' => -1,
      'orderby' => 'title',
      'order' => 'ASC',
      'post_status' => 'publish',
    )
  );

  wp_nonce_field( 'greenzeta_project_link_meta', 'greenzeta_project_link_meta_nonce' );
  ?>
  <p>
    <label for="greenzeta-project-link-select"><strong><?php esc_html_e( 'Project', 'greenzeta-2026' ); ?></strong></label>
    <select id="greenzeta-project-link-select" name="greenzeta_project_id" class="widefat">
      <option value=""><?php esc_html_e( 'None', 'greenzeta-2026' ); ?></option>
      <?php foreach ( $projects as $project ) : ?>
        <option value="<?php echo esc_attr( $project->ID ); ?>" <?php selected( $selected_id, $project->ID ); ?>>
          <?php echo esc_html( $project->post_title ); ?>
        </option>
      <?php endforeach; ?>
    </select>
  </p>
  <?php
}

function greenzeta_2026_save_project_link_meta( $post_id ) {
  if ( ! isset( $_POST['greenzeta_project_link_meta_nonce'] ) ) {
    return;
  }

  if ( ! wp_verify_nonce( $_POST['greenzeta_project_link_meta_nonce'], 'greenzeta_project_link_meta' ) ) {
    return;
  }

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  if ( ! current_user_can( 'edit_post', $post_id ) ) {
    return;
  }

  if ( isset( $_POST['greenzeta_project_id'] ) ) {
    update_post_meta( $post_id, 'project_id', absint( wp_unslash( $_POST['greenzeta_project_id'] ) ) );
  }
}
add_action( 'save_post_post', 'greenzeta_2026_save_project_link_meta' );
add_action( 'save_post_update', 'greenzeta_2026_save_project_link_meta' );

function greenzeta_2026_add_client_meta_box( $post_type, $post ) {
  if ( ! in_array( $post_type, array( 'portfolio', 'project' ), true ) ) {
    return;
  }

  add_meta_box(
    'greenzeta-client-meta',
    __( 'Client', 'greenzeta-2026' ),
    'greenzeta_2026_render_client_meta_box',
    $post_type,
    'side',
    'high'
  );
}
add_action( 'add_meta_boxes', 'greenzeta_2026_add_client_meta_box', 10, 2 );

function greenzeta_2026_render_client_meta_box( $post ) {
  $client = get_post_meta( $post->ID, 'client', true );

  wp_nonce_field( 'greenzeta_client_meta', 'greenzeta_client_meta_nonce' );
  ?>
  <p>
    <label for="greenzeta-client"><strong><?php esc_html_e( 'Client name', 'greenzeta-2026' ); ?></strong></label>
    <input
      type="text"
      id="greenzeta-client"
      name="greenzeta_client"
      value="<?php echo esc_attr( $client ); ?>"
      class="widefat"
    />
  </p>
  <?php
}

function greenzeta_2026_save_client_meta( $post_id ) {
  if ( ! isset( $_POST['greenzeta_client_meta_nonce'] ) ) {
    return;
  }

  if ( ! wp_verify_nonce( $_POST['greenzeta_client_meta_nonce'], 'greenzeta_client_meta' ) ) {
    return;
  }

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  if ( ! current_user_can( 'edit_post', $post_id ) ) {
    return;
  }

  if ( isset( $_POST['greenzeta_client'] ) ) {
    update_post_meta( $post_id, 'client', sanitize_text_field( wp_unslash( $_POST['greenzeta_client'] ) ) );
  }
}
add_action( 'save_post_portfolio', 'greenzeta_2026_save_client_meta' );
add_action( 'save_post_project', 'greenzeta_2026_save_client_meta' );

function greenzeta_2026_render_hero_meta_box( $post ) {
  $headline = get_post_meta( $post->ID, 'greenzeta_hero_headline', true );
  $subhead = get_post_meta( $post->ID, 'greenzeta_hero_subhead', true );
  $skills = get_post_meta( $post->ID, 'greenzeta_hero_skills', true );
  wp_nonce_field( 'greenzeta_hero_meta', 'greenzeta_hero_meta_nonce' );
  ?>
  <p><?php esc_html_e( 'Used on the front page hero section.', 'greenzeta-2026' ); ?></p>
  <p>
    <label for="greenzeta-hero-headline"><strong><?php esc_html_e( 'Headline', 'greenzeta-2026' ); ?></strong></label>
    <input
      type="text"
      id="greenzeta-hero-headline"
      name="greenzeta_hero_headline"
      value="<?php echo esc_attr( $headline ); ?>"
      class="widefat"
    />
  </p>
  <p>
    <label for="greenzeta-hero-subhead"><strong><?php esc_html_e( 'Subhead', 'greenzeta-2026' ); ?></strong></label>
    <textarea
      id="greenzeta-hero-subhead"
      name="greenzeta_hero_subhead"
      class="widefat"
      rows="4"
    ><?php echo esc_textarea( $subhead ); ?></textarea>
  </p>
  <p>
    <label for="greenzeta-hero-skills"><strong><?php esc_html_e( 'Skills (comma-separated)', 'greenzeta-2026' ); ?></strong></label>
    <input
      type="text"
      id="greenzeta-hero-skills"
      name="greenzeta_hero_skills"
      value="<?php echo esc_attr( $skills ); ?>"
      class="widefat"
    />
  </p>
  <?php
}

function greenzeta_2026_save_hero_meta( $post_id ) {
  if ( ! isset( $_POST['greenzeta_hero_meta_nonce'] ) ) {
    return;
  }

  if ( ! wp_verify_nonce( $_POST['greenzeta_hero_meta_nonce'], 'greenzeta_hero_meta' ) ) {
    return;
  }

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  if ( ! current_user_can( 'edit_post', $post_id ) ) {
    return;
  }

  if ( isset( $_POST['greenzeta_hero_headline'] ) ) {
    update_post_meta( $post_id, 'greenzeta_hero_headline', sanitize_text_field( wp_unslash( $_POST['greenzeta_hero_headline'] ) ) );
  }

  if ( isset( $_POST['greenzeta_hero_subhead'] ) ) {
    update_post_meta( $post_id, 'greenzeta_hero_subhead', sanitize_textarea_field( wp_unslash( $_POST['greenzeta_hero_subhead'] ) ) );
  }

  if ( isset( $_POST['greenzeta_hero_skills'] ) ) {
    update_post_meta( $post_id, 'greenzeta_hero_skills', sanitize_text_field( wp_unslash( $_POST['greenzeta_hero_skills'] ) ) );
  }
}
add_action( 'save_post_page', 'greenzeta_2026_save_hero_meta' );

function greenzeta_2026_social_menu_link_attributes( $atts, $item, $args ) {
  if ( empty( $args->theme_location ) || 'social' !== $args->theme_location ) {
    return $atts;
  }

  $url = isset( $atts['href'] ) ? wp_parse_url( $atts['href'] ) : array();
  $host = isset( $url['host'] ) ? strtolower( $url['host'] ) : '';

  $map = array(
    'x.com' => 'x',
    'twitter.com' => 'x',
    'www.twitter.com' => 'x',
    'linkedin.com' => 'linkedin',
    'www.linkedin.com' => 'linkedin',
    'youtube.com' => 'youtube',
    'www.youtube.com' => 'youtube',
    'youtu.be' => 'youtube',
    'github.com' => 'github',
    'www.github.com' => 'github',
    'instagram.com' => 'instagram',
    'www.instagram.com' => 'instagram',
    'codepen.io' => 'codepen',
    'www.codepen.io' => 'codepen',
  );

  if ( $host && isset( $map[ $host ] ) ) {
    $atts['data-social'] = $map[ $host ];
  }

  if ( empty( $atts['aria-label'] ) && ! empty( $item->title ) ) {
    $atts['aria-label'] = $item->title;
  }

  if ( empty( $atts['title'] ) && ! empty( $item->title ) ) {
    $atts['title'] = $item->title;
  }

  $atts['target'] = '_blank';
  $atts['rel'] = 'noopener noreferrer';

  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'greenzeta_2026_social_menu_link_attributes', 10, 3 );

function greenzeta_2026_disable_comments_post_types_support() {
  $post_types = get_post_types( array(), 'names' );

  foreach ( $post_types as $post_type ) {
    if ( post_type_supports( $post_type, 'comments' ) ) {
      remove_post_type_support( $post_type, 'comments' );
      remove_post_type_support( $post_type, 'trackbacks' );
    }
  }
}
add_action( 'admin_init', 'greenzeta_2026_disable_comments_post_types_support' );

function greenzeta_2026_disable_comments_status() {
  return false;
}
add_filter( 'comments_open', 'greenzeta_2026_disable_comments_status', 20, 2 );
add_filter( 'pings_open', 'greenzeta_2026_disable_comments_status', 20, 2 );

function greenzeta_2026_hide_existing_comments( $comments ) {
  return array();
}
add_filter( 'comments_array', 'greenzeta_2026_hide_existing_comments', 10, 2 );

function greenzeta_2026_remove_comments_menu_page() {
  remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'greenzeta_2026_remove_comments_menu_page' );

function greenzeta_2026_remove_comments_admin_bar() {
  if ( is_admin_bar_showing() ) {
    remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
  }
}
add_action( 'init', 'greenzeta_2026_remove_comments_admin_bar' );
