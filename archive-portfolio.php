<?php
/**
 * Template for displaying portfolio archive.
 */

get_header();
?>

<main id="site-content" class="site-content">
  <div class="site-content__inner">
    <?php greenzeta_2026_render_breadcrumbs(); ?>
    <header class="archive-header card">
      <h1><?php post_type_archive_title(); ?></h1>
      <?php the_archive_description( '<div>', '</div>' ); ?>
    </header>

    <?php
    $portfolio_query = new WP_Query(
      array(
        'post_type' => 'portfolio',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
      )
    );
    ?>

    <?php if ( $portfolio_query->have_posts() ) : ?>
      <section class="card-grid">
        <?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
          <?php get_template_part( 'template-parts/card', null, array( 'post_id' => get_the_ID() ) ); ?>
        <?php endwhile; ?>
      </section>
      <?php wp_reset_postdata(); ?>
    <?php else : ?>
      <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();
