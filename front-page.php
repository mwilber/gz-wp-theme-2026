<?php
/**
 * Front page template.
 */

get_header();
?>

<main id="site-content" class="site-content">
  <div class="site-content__inner">
    <?php get_template_part( 'template-parts/hero' ); ?>

    <?php
    $cards_query = new WP_Query(
      array(
        'post_type' => 'post',
        'posts_per_page' => get_option( 'posts_per_page' ),
        'orderby' => 'date',
        'order' => 'DESC',
      )
    );
    ?>
    <?php if ( $cards_query->have_posts() ) : ?>
      <section class="card-grid card-grid--front card-grid--group">
        <?php while ( $cards_query->have_posts() ) : $cards_query->the_post(); ?>
          <?php get_template_part( 'template-parts/card', null, array( 'post_id' => get_the_ID() ) ); ?>
        <?php endwhile; ?>
      </section>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>

    <?php
    $projects_query = new WP_Query(
      array(
        'post_type' => 'project',
        'posts_per_page' => get_option( 'posts_per_page' ),
        'orderby' => 'date',
        'order' => 'DESC',
      )
    );
    ?>
    <?php if ( $projects_query->have_posts() ) : ?>
      <section class="card-grid card-grid--group">
        <?php while ( $projects_query->have_posts() ) : $projects_query->the_post(); ?>
          <?php get_template_part( 'template-parts/card', null, array( 'post_id' => get_the_ID() ) ); ?>
        <?php endwhile; ?>
      </section>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();
