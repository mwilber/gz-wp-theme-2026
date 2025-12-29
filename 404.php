<?php
/**
 * Template for displaying 404 pages.
 */

get_header();
?>

<main id="site-content" class="site-content">
  <div class="site-content__inner">
    <h1>Page not found</h1>
    <p>The page you are looking for could not be found.</p>
    <?php get_search_form(); ?>
  </div>
</main>

<?php
get_footer();
