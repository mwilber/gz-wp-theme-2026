<?php
/**
 * Front page template.
 */

get_header();
?>

<main id="site-content">
  <?php get_template_part( 'template-parts/hero' ); ?>

  <?php if ( have_posts() ) : ?>
    <section>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'template-parts/card', null, array( 'post_id' => get_the_ID() ) ); ?>
      <?php endwhile; ?>
    </section>
  <?php endif; ?>
</main>

<?php
get_footer();
