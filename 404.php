<?php
get_header();
?>

<main class="not-found-page">
  <section class="not-found-hero">
    <div class="not-found-shell">
      <p class="not-found-eyebrow">// Error 404</p>
      <div class="not-found-grid">
        <div class="not-found-copy">
          <p class="not-found-code">404</p>
          <h1 class="not-found-title">The page you requested could not be found.</h1>
          <div class="not-found-divider"></div>
          <p class="not-found-text">
            The link may be outdated, the page may have moved, or the address may have been entered incorrectly.
          </p>
        </div>

        <aside class="not-found-panel">
          <p class="not-found-panel-label">Suggested paths</p>
          <ul class="not-found-links">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Return to Home</a></li>
            <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Read the About Page</a></li>
            <li><a href="<?php echo esc_url( get_post_type_archive_link( 'book' ) ?: stavros_section_url( 'books' ) ); ?>">Browse Publications</a></li>
            <li><a href="<?php echo esc_url( stavros_section_url( 'contact' ) ); ?>">Get in Contact</a></li>
          </ul>
        </aside>
      </div>

      <div class="not-found-actions">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary-light">Back to Home</a>
        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn-ghost-dark">About Stavros</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
