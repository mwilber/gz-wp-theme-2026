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
}
add_action( 'wp_enqueue_scripts', 'greenzeta_2026_enqueue_assets' );

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
