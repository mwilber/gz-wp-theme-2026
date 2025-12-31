<?php
/**
 * Header template.
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php get_template_part( 'template-parts/background' ); ?>
<a class="skip-link" href="#site-content">Skip to content</a>
<header id="site-header" class="site-header">
  <div class="site-header__inner">
    <div class="site-brand">
      <?php if ( has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <p class="site-logo"><?php bloginfo( 'name' ); ?></p>
      <?php endif; ?>
    </div>

    <nav class="site-nav" aria-label="<?php esc_attr_e( 'Primary', 'greenzeta-2026' ); ?>">
      <button class="site-theme-toggle" type="button" aria-pressed="false" aria-label="<?php esc_attr_e( 'Toggle color theme', 'greenzeta-2026' ); ?>">
        <svg class="site-theme-toggle__icon" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M12 3a9 9 0 0 0 0 18V3z"/>
          <path d="M12 3a9 9 0 1 1 0 18V3z" fill="none" stroke="currentColor" stroke-width="2"/>
        </svg>
      </button>
      <button class="site-nav__toggle" type="button" aria-expanded="false" aria-controls="primary-menu-panel">
        <span class="site-nav__toggle-icon" aria-hidden="true"></span>
        <span class="screen-reader-text"><?php esc_html_e( 'Open menu', 'greenzeta-2026' ); ?></span>
      </button>

      <div class="site-nav__panel" id="primary-menu-panel" aria-hidden="true">
      <?php
      wp_nav_menu(
        array(
          'theme_location' => 'primary',
          'menu_class' => 'site-nav__menu',
          'container' => false,
          'fallback_cb' => false,
        )
      );
      ?>
      </div>
    </nav>
  </div>
</header>
