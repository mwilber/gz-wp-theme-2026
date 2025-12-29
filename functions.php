<?php
/**
 * Theme functions and setup.
 */

function greenzeta_2026_setup() {
  load_theme_textdomain( 'greenzeta-2026' );

  add_theme_support( 'title-tag' );
  add_theme_support( 'custom-logo' );
  add_theme_support( 'post-thumbnails' );
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
