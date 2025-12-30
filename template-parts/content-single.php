<?php
/**
 * Template part for displaying single post content.
 */
?>
<?php if ( has_post_thumbnail() ) : ?>
  <section class="post-hero card card--hero">
    <div class="card__media card__media--overlay">
      <?php the_post_thumbnail( 'greenzeta-card' ); ?>
      <div class="card__overlay-content">
        <h1 class="card__title card__title--overlay"><?php the_title(); ?></h1>
      </div>
    </div>
  </section>
<?php else : ?>
  <header class="post-hero post-hero--no-image">
    <h1 class="entry__title"><?php the_title(); ?></h1>
  </header>
<?php endif; ?>

<section class="post-meta-card card">
  <p class="post-meta-card__text">
    <?php
    printf(
      '%s %s',
      esc_html__( 'Published on:', 'greenzeta-2026' ),
      esc_html( get_the_date() )
    );
    ?>
  </p>
</section>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry--single card' ); ?>>
  <div class="entry__content">
    <?php the_content(); ?>
  </div>
</article>
