<?php
/**
 * Card template part.
 */

$post_id = $args['post_id'] ?? get_the_ID();

if ( ! $post_id ) {
  return;
}

$is_front = is_front_page();
$post_type = get_post_type( $post_id );
$post_type_object = get_post_type_object( $post_type );
$label = 'post' === $post_type
  ? __( 'Article', 'greenzeta-2026' )
  : ( $post_type_object ? $post_type_object->labels->singular_name : __( 'Post', 'greenzeta-2026' ) );

if ( 'portfolio' === $post_type ) {
  $client = get_post_meta( $post_id, 'client', true );
  if ( $client ) {
    $label = $client;
  }
}
?>
<article id="post-<?php echo esc_attr( $post_id ); ?>" <?php post_class( $is_front ? 'card card--hero' : 'card', $post_id ); ?>>
  <?php if ( $is_front ) : ?>
    <?php if ( has_post_thumbnail( $post_id ) ) : ?>
      <a class="card__media card__media--overlay" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
        <?php echo get_the_post_thumbnail( $post_id, 'greenzeta-card' ); ?>
        <div class="card__overlay-content">
          <span class="card__label"><?php echo esc_html( $label ); ?></span>
          <h2 class="card__title card__title--overlay"><?php echo esc_html( get_the_title( $post_id ) ); ?></h2>
        </div>
      </a>
    <?php else : ?>
      <span class="card__label"><?php echo esc_html( $label ); ?></span>
      <h2 class="card__title"><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php echo esc_html( get_the_title( $post_id ) ); ?></a></h2>
    <?php endif; ?>
  <?php else : ?>
    <?php if ( has_post_thumbnail( $post_id ) ) : ?>
      <a class="card__media" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
        <?php echo get_the_post_thumbnail( $post_id, 'greenzeta-card' ); ?>
      </a>
    <?php endif; ?>
    <h2 class="card__title"><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php echo esc_html( get_the_title( $post_id ) ); ?></a></h2>
    <div class="card__excerpt">
      <?php echo wp_kses_post( get_the_excerpt( $post_id ) ); ?>
    </div>
  <?php endif; ?>
</article>
