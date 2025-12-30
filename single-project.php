<?php
/**
 * Template for displaying single project posts.
 */

get_header();
?>

<main id="site-content" class="site-content">
  <div class="site-content__inner">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'template-parts/content', 'single' ); ?>

        <?php
        $linked_query = new WP_Query(
          array(
            'post_type' => array( 'post', 'update' ),
            'posts_per_page' => -1,
            'meta_key' => 'project_id',
            'meta_value' => get_the_ID(),
            'orderby' => 'date',
            'order' => 'DESC',
          )
        );
        ?>

        <?php if ( $linked_query->have_posts() ) : ?>
          <section class="linked-content">
            <h2><?php esc_html_e( 'Related Articles & Updates', 'greenzeta-2026' ); ?></h2>
            <div class="card-grid">
              <?php while ( $linked_query->have_posts() ) : $linked_query->the_post(); ?>
                <?php get_template_part( 'template-parts/card', null, array( 'post_id' => get_the_ID() ) ); ?>
              <?php endwhile; ?>
            </div>
          </section>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>
      <?php endwhile; ?>
    <?php else : ?>
      <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();
