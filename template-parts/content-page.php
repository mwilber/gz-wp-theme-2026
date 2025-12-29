<?php
/**
 * Template part for displaying page content.
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry--page' ); ?>>
  <header class="entry__header">
    <h1 class="entry__title"><?php the_title(); ?></h1>
  </header>
  <div class="entry__content">
    <?php the_content(); ?>
  </div>
</article>
