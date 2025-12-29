<?php
/**
 * Template for displaying archive pages.
 */

get_header();
?>

<main id="site-content" class="site-content">
  <div class="site-content__inner">
    <header class="archive-header">
      <h1><?php the_archive_title(); ?></h1>
      <?php the_archive_description( '<div>', '</div>' ); ?>
    </header>

    <?php if ( have_posts() ) : ?>
      <section class="card-grid">
        <?php while ( have_posts() ) : the_post(); ?>
          <?php get_template_part( 'template-parts/card', null, array( 'post_id' => get_the_ID() ) ); ?>
        <?php endwhile; ?>
      </section>

      <?php the_posts_navigation(); ?>
    <?php else : ?>
      <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();
