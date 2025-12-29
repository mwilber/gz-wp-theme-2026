<?php
/**
 * Template for displaying archive pages.
 */

get_header();
?>

<main id="site-content">
  <header>
    <h1><?php the_archive_title(); ?></h1>
    <?php the_archive_description( '<div>', '</div>' ); ?>
  </header>

  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div>
          <?php the_excerpt(); ?>
        </div>
      </article>
    <?php endwhile; ?>
  <?php else : ?>
    <p>No posts found.</p>
  <?php endif; ?>
</main>

<?php
get_footer();
