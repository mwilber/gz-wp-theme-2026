<?php
/**
 * Template part for displaying single post content.
 */
?>
<?php
$banner_id = (int) get_post_meta( get_the_ID(), 'banner', true );
$banner_image = $banner_id
  ? wp_get_attachment_image( $banner_id, 'greenzeta-card' )
  : get_the_post_thumbnail( get_the_ID(), 'greenzeta-card' );
?>
<?php if ( $banner_image ) : ?>
  <section class="post-hero card card--hero">
    <div class="card__media card__media--overlay">
      <?php echo $banner_image; ?>
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

<?php
$current_id = get_the_ID();
$category_ids = wp_get_post_terms( $current_id, 'category', array( 'fields' => 'ids' ) );
$tag_ids = wp_get_post_terms( $current_id, 'post_tag', array( 'fields' => 'ids' ) );

$related_args = array(
  'post_type' => 'post',
  'posts_per_page' => 3,
  'post__not_in' => array( $current_id ),
  'ignore_sticky_posts' => true,
);

if ( $category_ids || $tag_ids ) {
  $tax_query = array( 'relation' => 'OR' );

  if ( $category_ids ) {
    $tax_query[] = array(
      'taxonomy' => 'category',
      'field' => 'term_id',
      'terms' => $category_ids,
    );
  }

  if ( $tag_ids ) {
    $tax_query[] = array(
      'taxonomy' => 'post_tag',
      'field' => 'term_id',
      'terms' => $tag_ids,
    );
  }

  $related_args['tax_query'] = $tax_query;
}

$related_query = new WP_Query( $related_args );

if ( $related_query->have_posts() ) :
  ?>
  <section class="related-posts">
    <div class="card-grid card-grid--related">
      <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
        <?php get_template_part( 'template-parts/card', null, array( 'post_id' => get_the_ID() ) ); ?>
      <?php endwhile; ?>
    </div>
  </section>
  <?php
elseif ( ! empty( $related_args['tax_query'] ) ) :
  $fallback_query = new WP_Query(
    array(
      'post_type' => 'post',
      'posts_per_page' => 3,
      'post__not_in' => array( $current_id ),
      'ignore_sticky_posts' => true,
      'orderby' => 'date',
      'order' => 'DESC',
    )
  );
  if ( $fallback_query->have_posts() ) :
    ?>
    <section class="related-posts">
      <div class="card-grid card-grid--related">
        <?php while ( $fallback_query->have_posts() ) : $fallback_query->the_post(); ?>
          <?php get_template_part( 'template-parts/card', null, array( 'post_id' => get_the_ID() ) ); ?>
        <?php endwhile; ?>
      </div>
    </section>
    <?php
  endif;
  wp_reset_postdata();
endif;

wp_reset_postdata();
?>
