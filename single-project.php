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
        $updates_query = new WP_Query(
          array(
            'post_type' => 'update',
            'posts_per_page' => -1,
            'meta_key' => 'project_id',
            'meta_value' => get_the_ID(),
            'orderby' => 'date',
            'order' => 'DESC',
          )
        );
        ?>

        <?php if ( $updates_query->have_posts() ) : ?>
          <section class="updates-list">
            <h2><?php esc_html_e( 'Updates', 'greenzeta-2026' ); ?></h2>
            <div class="card-grid">
              <?php while ( $updates_query->have_posts() ) : $updates_query->the_post(); ?>
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
