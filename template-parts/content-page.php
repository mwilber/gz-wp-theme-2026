<?php
/**
 * Template part for displaying page content.
 */
?>
<?php greenzeta_2026_render_breadcrumbs(); ?>
<?php if ( is_page( 'about' ) ) : ?>
  <?php
  $tagline = get_bloginfo( 'description' );
  $hero_image = get_the_post_thumbnail( get_the_ID(), 'greenzeta-card' );
  ?>
  <section class="post-hero card card--hero">
    <div class="card__media card__media--overlay<?php echo $hero_image ? '' : ' card__media--placeholder'; ?>">
      <?php if ( $hero_image ) : ?>
        <?php echo $hero_image; ?>
      <?php endif; ?>
      <div class="card__overlay-content">
        <span class="card__label"><?php esc_html_e( 'Matthew Wilber', 'greenzeta-2026' ); ?></span>
        <?php if ( $tagline ) : ?>
          <h1 class="card__title card__title--overlay"><?php echo esc_html( $tagline ); ?></h1>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry--page card' ); ?>>
    <div class="entry__content">
      <?php the_content(); ?>
    </div>
  </article>
<?php else : ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry--page' ); ?>>
    <header class="entry__header">
      <h1 class="entry__title"><?php the_title(); ?></h1>
    </header>
    <div class="entry__content">
      <?php the_content(); ?>
    </div>
  </article>
<?php endif; ?>
