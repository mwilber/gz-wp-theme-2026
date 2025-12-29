<?php
/**
 * Template for displaying single posts.
 */

get_header();
?>

<main id="site-content" class="site-content">
  <div class="site-content__inner">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'template-parts/content', 'single' ); ?>

        <?php if ( comments_open() || get_comments_number() ) : ?>
          <?php comments_template(); ?>
        <?php endif; ?>
      <?php endwhile; ?>
    <?php else : ?>
      <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();
