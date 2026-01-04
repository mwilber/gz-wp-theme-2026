<?php
/**
 * Posts index template.
 */

get_header();
?>

<main id="site-content" class="site-content">
  <div class="site-content__inner">
    <?php greenzeta_2026_render_breadcrumbs(); ?>
    <header class="archive-header card">
      <h1><?php bloginfo( 'name' ); ?></h1>
      <?php if ( get_bloginfo( 'description' ) ) : ?>
        <p><?php bloginfo( 'description' ); ?></p>
      <?php endif; ?>
    </header>

    <?php if ( have_posts() ) : ?>
      <section class="card-grid">
        <?php while ( have_posts() ) : the_post(); ?>
          <?php get_template_part( 'template-parts/card', null, array( 'post_id' => get_the_ID() ) ); ?>
        <?php endwhile; ?>
      </section>

      <?php the_posts_navigation(); ?>
    <?php else : ?>
      <p>No posts found.</p>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();
