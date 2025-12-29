<?php
/**
 * Card template part.
 */

$post_id = $args['post_id'] ?? get_the_ID();

if ( ! $post_id ) {
  return;
}
?>
<article id="post-<?php echo esc_attr( $post_id ); ?>" <?php post_class( 'card', $post_id ); ?>>
  <h2 class="card__title"><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php echo esc_html( get_the_title( $post_id ) ); ?></a></h2>
  <div class="card__excerpt">
    <?php echo wp_kses_post( get_the_excerpt( $post_id ) ); ?>
  </div>
</article>
