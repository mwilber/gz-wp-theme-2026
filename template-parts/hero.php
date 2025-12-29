<?php
/**
 * Hero section template part.
 */
?>
<section>
  <h1><?php bloginfo( 'name' ); ?></h1>
  <?php if ( get_bloginfo( 'description' ) ) : ?>
    <p><?php bloginfo( 'description' ); ?></p>
  <?php endif; ?>
</section>
