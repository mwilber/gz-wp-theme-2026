<?php
/**
 * Hero section template part.
 */
?>
<section class="hero">
  <h1 class="hero__title"><?php bloginfo( 'name' ); ?></h1>
  <?php if ( get_bloginfo( 'description' ) ) : ?>
    <p class="hero__subtitle"><?php bloginfo( 'description' ); ?></p>
  <?php endif; ?>
</section>
