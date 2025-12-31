<?php
/**
 * Hero section template part.
 */
$hero_id = is_front_page() ? get_queried_object_id() : 0;
$headline = get_bloginfo( 'description' );
$subhead = $hero_id ? get_post_meta( $hero_id, 'greenzeta_hero_subhead', true ) : '';
$skills_raw = $hero_id ? get_post_meta( $hero_id, 'greenzeta_hero_skills', true ) : '';
$skills = $skills_raw ? array_filter( array_map( 'trim', explode( ',', $skills_raw ) ) ) : array();
?>
<section class="hero">
  <div class="hero__content">
    <div class="hero__copy">
      <?php if ( $headline ) : ?>
        <h1 class="hero__title"><?php echo esc_html( $headline ); ?></h1>
      <?php endif; ?>
      <?php if ( $subhead ) : ?>
        <p class="hero__subtitle"><?php echo esc_html( $subhead ); ?></p>
      <?php endif; ?>
    </div>

    <?php if ( $skills ) : ?>
      <div class="hero__skills" aria-label="<?php esc_attr_e( 'Skills', 'greenzeta-2026' ); ?>">
        <?php foreach ( $skills as $skill ) : ?>
          <?php
          $tag = get_term_by( 'name', $skill, 'post_tag' );
          $tag_url = $tag && ! is_wp_error( $tag ) ? get_term_link( $tag ) : '';
          ?>
          <?php if ( $tag_url && ! is_wp_error( $tag_url ) ) : ?>
            <a class="hero__skill" href="<?php echo esc_url( $tag_url ); ?>"><?php echo esc_html( $skill ); ?></a>
          <?php else : ?>
            <span class="hero__skill"><?php echo esc_html( $skill ); ?></span>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="hero__social">
    <?php
    if ( has_nav_menu( 'social' ) ) {
      wp_nav_menu(
        array(
          'theme_location' => 'social',
          'container' => false,
          'menu_class' => 'hero__social-menu',
          'depth' => 1,
        )
      );
    }
    ?>
  </div>
</section>
