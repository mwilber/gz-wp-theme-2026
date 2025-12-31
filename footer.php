<?php
/**
 * Footer template.
 */
?>
<?php get_template_part( 'template-parts/cityscape' ); ?>
<footer id="site-footer" class="site-footer">
  <div class="site-footer__inner">
    <nav class="site-social" aria-label="<?php esc_attr_e( 'Social', 'greenzeta-2026' ); ?>">
      <?php
      wp_nav_menu(
        array(
          'theme_location' => 'social',
          'menu_class' => 'site-social__menu',
          'container' => false,
          'fallback_cb' => false,
        )
      );
      ?>
    </nav>
    <p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> GreenZeta 2026</p>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
