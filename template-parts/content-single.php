<?php
/**
 * Template part for displaying single post content.
 */
?>
<?php
$post_type = get_post_type();
$banner_id = (int) get_post_meta( get_the_ID(), 'banner', true );
$banner_image = $banner_id
  ? wp_get_attachment_image( $banner_id, 'greenzeta-card' )
  : get_the_post_thumbnail( get_the_ID(), 'greenzeta-card' );
$logo_image = '';
if ( 'portfolio' === $post_type && has_post_thumbnail() ) {
  $logo_alt = sprintf( __( '%s logo', 'greenzeta-2026' ), get_the_title() );
  $logo_image = get_the_post_thumbnail(
    get_the_ID(),
    'thumbnail',
    array(
      'class' => 'card__badge-image',
      'alt' => $logo_alt,
    )
  );
}
?>
<?php if ( $banner_image ) : ?>
  <section class="post-hero card card--hero">
    <div class="card__media card__media--overlay">
      <?php echo $banner_image; ?>
      <?php if ( $logo_image ) : ?>
        <span class="card__badge card__badge--hero"><?php echo $logo_image; ?></span>
      <?php endif; ?>
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
$screenshots = get_post_meta( get_the_ID(), 'screen_shots', true );
$screenshot_ids = array();

if ( is_array( $screenshots ) ) {
  $screenshot_ids = array_filter( array_map( 'absint', $screenshots ) );
} elseif ( is_string( $screenshots ) && '' !== $screenshots ) {
  $screenshot_ids = wp_parse_id_list( $screenshots );
}

if ( $screenshot_ids ) :
  ?>
  <section class="screenshot-carousel" aria-label="<?php esc_attr_e( 'Project screenshots', 'greenzeta-2026' ); ?>">
    <div class="screenshot-carousel__track">
      <?php foreach ( $screenshot_ids as $screenshot_id ) : ?>
        <?php $full_src = wp_get_attachment_image_url( $screenshot_id, 'full' ); ?>
        <div class="screenshot-carousel__slide">
          <button class="screenshot-carousel__button" type="button" data-full="<?php echo esc_url( $full_src ); ?>">
            <?php echo wp_get_attachment_image( $screenshot_id, 'large' ); ?>
          </button>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <div class="screenshot-lightbox" aria-hidden="true">
    <div class="screenshot-lightbox__backdrop" data-lightbox-close></div>
    <div class="screenshot-lightbox__content" role="dialog" aria-modal="true">
      <button class="screenshot-lightbox__close" type="button" data-lightbox-close aria-label="<?php esc_attr_e( 'Close', 'greenzeta-2026' ); ?>">
        &times;
      </button>
      <img class="screenshot-lightbox__image" src="" alt="" />
    </div>
  </div>
<?php endif; ?>

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
