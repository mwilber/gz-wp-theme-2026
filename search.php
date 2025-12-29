<?php
/**
 * Template for displaying search results.
 */

get_header();
?>

<main id="site-content">
  <header>
    <h1>Search results for: <?php echo esc_html( get_search_query() ); ?></h1>
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

    <?php the_posts_navigation(); ?>
  <?php else : ?>
    <p>No results found.</p>
    <?php get_search_form(); ?>
  <?php endif; ?>
</main>

<?php
get_footer();
