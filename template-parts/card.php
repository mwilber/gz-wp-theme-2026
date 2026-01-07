<?php
/**
 * Card template part.
 */

$post_id = $args['post_id'] ?? get_the_ID();
$is_featured = ! empty( $args['is_featured'] );

if ( ! $post_id ) {
  return;
}

$is_front = is_front_page();
$is_portfolio = ( 'portfolio' === $post_type );
$post_type = get_post_type( $post_id );
$post_type_object = get_post_type_object( $post_type );
$label = 'post' === $post_type
  ? __( 'Article', 'greenzeta-2026' )
  : ( $post_type_object ? $post_type_object->labels->singular_name : __( 'Post', 'greenzeta-2026' ) );

if ( 'portfolio' === $post_type ) {
  $client = get_post_meta( $post_id, 'client', true );
  if ( $client ) {
    $label = $client;
  } else {
    $label = __( 'Portfolio', 'greenzeta-2026' );
  }
}

$project_title = '';
$project_tagline = '';
if ( 'project' === $post_type ) {
  $project_title = get_the_title( $post_id );
  $tag_line = get_post_meta( $post_id, 'tag_line', true );
  $project_tagline = $tag_line ? $tag_line : __( 'Development Project', 'greenzeta-2026' );
}

$banner_id = (int) get_post_meta( $post_id, 'banner', true );
$card_image = '';
$featured_image_size = ( $is_front && $is_featured && 'project' === $post_type ) ? 'full' : 'greenzeta-card';
if ( $banner_id ) {
  $card_image = wp_get_attachment_image( $banner_id, $featured_image_size );
} elseif ( ! $is_portfolio ) {
  $card_image = get_the_post_thumbnail( $post_id, $featured_image_size );
}

$logo_image = '';
if ( $is_portfolio && has_post_thumbnail( $post_id ) ) {
  $logo_alt = sprintf( __( '%s logo', 'greenzeta-2026' ), get_the_title( $post_id ) );
  $logo_image = get_the_post_thumbnail(
    $post_id,
    'thumbnail',
    array(
      'class' => 'card__badge-image',
      'alt' => $logo_alt,
    )
  );
}
?>
<article id="post-<?php echo esc_attr( $post_id ); ?>" <?php post_class( $is_front ? 'card card--hero' : 'card', $post_id ); ?>>
  <?php if ( $is_front ) : ?>
    <?php if ( $card_image ) : ?>
      <a class="card__media card__media--overlay" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
        <?php echo $card_image; ?>
        <div class="card__overlay-content">
          <?php if ( 'project' === $post_type ) : ?>
            <span class="card__label"><?php echo esc_html( $project_title ); ?></span>
            <h2 class="card__title card__title--overlay"><?php echo esc_html( $project_tagline ); ?></h2>
          <?php else : ?>
            <span class="card__label"><?php echo esc_html( $label ); ?></span>
            <h2 class="card__title card__title--overlay"><?php echo esc_html( get_the_title( $post_id ) ); ?></h2>
          <?php endif; ?>
        </div>
      </a>
    <?php else : ?>
      <?php if ( 'project' === $post_type ) : ?>
        <span class="card__label"><?php echo esc_html( $project_title ); ?></span>
        <h2 class="card__title"><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php echo esc_html( $project_tagline ); ?></a></h2>
      <?php else : ?>
        <span class="card__label"><?php echo esc_html( $label ); ?></span>
        <h2 class="card__title"><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php echo esc_html( get_the_title( $post_id ) ); ?></a></h2>
      <?php endif; ?>
    <?php endif; ?>
  <?php elseif ( $is_portfolio ) : ?>
    <?php if ( $card_image ) : ?>
      <a class="card__media card__media--overlay" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
        <?php echo $card_image; ?>
        <?php if ( $logo_image ) : ?>
          <span class="card__badge"><?php echo $logo_image; ?></span>
        <?php endif; ?>
        <div class="card__overlay-content">
          <span class="card__label"><?php echo esc_html( $label ); ?></span>
          <h2 class="card__title card__title--overlay"><?php echo esc_html( get_the_title( $post_id ) ); ?></h2>
        </div>
      </a>
    <?php else : ?>
      <a class="card__media card__media--overlay card__media--placeholder" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
        <?php if ( $logo_image ) : ?>
          <span class="card__badge"><?php echo $logo_image; ?></span>
        <?php endif; ?>
        <div class="card__overlay-content">
          <span class="card__label"><?php echo esc_html( $label ); ?></span>
          <h2 class="card__title card__title--overlay"><?php echo esc_html( get_the_title( $post_id ) ); ?></h2>
        </div>
      </a>
    <?php endif; ?>
    <div class="card__excerpt">
      <?php echo wp_kses_post( get_the_excerpt( $post_id ) ); ?>
    </div>
  <?php else : ?>
    <?php if ( $card_image ) : ?>
      <a class="card__media card__media--overlay" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
        <?php echo $card_image; ?>
        <div class="card__overlay-content card__overlay-content--label">
          <?php if ( 'project' === $post_type ) : ?>
            <span class="card__label"><?php echo esc_html( $project_title ); ?></span>
            <h2 class="card__title card__title--overlay"><?php echo esc_html( $project_tagline ); ?></h2>
          <?php else : ?>
            <span class="card__label"><?php echo esc_html( $label ); ?></span>
            <h2 class="card__title card__title--overlay"><?php echo esc_html( get_the_title( $post_id ) ); ?></h2>
          <?php endif; ?>
        </div>
      </a>
    <?php else : ?>
      <a class="card__media card__media--overlay card__media--placeholder" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
        <div class="card__overlay-content card__overlay-content--label">
          <?php if ( 'project' === $post_type ) : ?>
            <span class="card__label"><?php echo esc_html( $project_title ); ?></span>
            <h2 class="card__title card__title--overlay"><?php echo esc_html( $project_tagline ); ?></h2>
          <?php else : ?>
            <span class="card__label"><?php echo esc_html( $label ); ?></span>
            <h2 class="card__title card__title--overlay"><?php echo esc_html( get_the_title( $post_id ) ); ?></h2>
          <?php endif; ?>
        </div>
      </a>
    <?php endif; ?>
    <h2 class="card__title card__title--hidden">
      <a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
        <?php echo esc_html( 'project' === $post_type ? $project_tagline : get_the_title( $post_id ) ); ?>
      </a>
    </h2>
    <div class="card__excerpt">
      <?php echo wp_kses_post( get_the_excerpt( $post_id ) ); ?>
    </div>
  <?php endif; ?>
</article>
