<?php
/**
 * Search results template.
 */

get_header();

$search_term   = get_search_query();
$search_label  = '' !== trim( $search_term ) ? sprintf( __( 'Results for "%s"', 'stavros-basta' ), $search_term ) : __( 'Search Results', 'stavros-basta' );
$search_intro  = __( 'Organized across books, papers, and pages so readers can move directly to the right kind of material.', 'stavros-basta' );
$books_query   = new WP_Query(
    [
        'post_type'           => 'book',
        'post_status'         => 'publish',
        'posts_per_page'      => -1,
        's'                   => $search_term,
        'orderby'             => 'date',
        'order'               => 'DESC',
        'no_found_rows'       => true,
        'ignore_sticky_posts' => true,
    ]
);
$paper_results = stavros_get_search_paper_results( $search_term );
$pages_query   = new WP_Query(
    [
        'post_type'           => 'page',
        'post_status'         => 'publish',
        'posts_per_page'      => -1,
        's'                   => $search_term,
        'orderby'             => 'menu_order title',
        'order'               => 'ASC',
        'no_found_rows'       => true,
    ]
);
$total_results = (int) $books_query->post_count + count( $paper_results ) + (int) $pages_query->post_count;
?>

<main class="search-results-page">
  <section class="search-results-hero">
    <div class="search-results-shell">
      <p class="search-results-eyebrow">// Site Search</p>
      <h1 class="search-results-title"><?php echo esc_html( $search_label ); ?></h1>
      <div class="search-results-divider"></div>
      <p class="search-results-intro"><?php echo esc_html( $search_intro ); ?></p>

      <form class="search-results-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label class="screen-reader-text" for="search-results-field"><?php esc_html_e( 'Search site', 'stavros-basta' ); ?></label>
        <input id="search-results-field" type="search" name="s" value="<?php echo esc_attr( $search_term ); ?>" placeholder="<?php esc_attr_e( 'Search books, papers, and pages', 'stavros-basta' ); ?>" />
        <button type="submit" class="btn-primary-light"><?php esc_html_e( 'Search', 'stavros-basta' ); ?></button>
      </form>

      <p class="search-results-summary">
        <?php
        echo esc_html(
            sprintf(
                _n( '%d result found', '%d results found', $total_results, 'stavros-basta' ),
                $total_results
            )
        );
        ?>
      </p>
    </div>
  </section>

  <?php if ( $total_results > 0 ) : ?>
    <?php if ( $books_query->have_posts() ) : ?>
      <section class="search-results-section search-results-section-dark">
        <div class="search-results-shell">
          <div class="sec-header">
            <span class="sec-label sec-label-light">// Books</span>
          </div>
          <h2 class="sec-title-light"><em>Books</em></h2>
          <div class="books-grid search-results-books-grid">
            <?php while ( $books_query->have_posts() ) : $books_query->the_post(); ?>
              <?php
              $genre_terms = get_the_terms( get_the_ID(), 'genre' );
              $book_label  = ( ! is_wp_error( $genre_terms ) && ! empty( $genre_terms ) ) ? $genre_terms[0]->name : __( 'Book', 'stavros-basta' );
              ?>
              <?php get_template_part( 'template-parts/book-card', null, [ 'label' => $book_label ] ); ?>
            <?php endwhile; ?>
          </div>
        </div>
      </section>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>

    <?php if ( ! empty( $paper_results ) ) : ?>
      <section class="search-results-section search-results-section-light">
        <div class="search-results-shell">
          <div class="sec-header">
            <span class="sec-label sec-label-dark">// Papers</span>
          </div>
          <h2 class="sec-title-dark"><em>Papers</em></h2>
          <div class="pub-card-grid search-results-papers-grid">
            <?php foreach ( $paper_results as $post ) : ?>
              <?php setup_postdata( $post ); ?>
              <?php get_template_part( 'template-parts/paper-card', null, [ 'title_tag' => 'h3' ] ); ?>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <?php if ( $pages_query->have_posts() ) : ?>
      <section class="search-results-section search-results-section-dark">
        <div class="search-results-shell">
          <div class="sec-header">
            <span class="sec-label sec-label-light">// Pages</span>
          </div>
          <h2 class="sec-title-light"><em>Pages</em></h2>
          <div class="search-results-page-grid">
            <?php while ( $pages_query->have_posts() ) : $pages_query->the_post(); ?>
              <?php
              $page_parent_id = wp_get_post_parent_id( get_the_ID() );
              $page_context   = $page_parent_id ? get_the_title( $page_parent_id ) : __( 'Site Page', 'stavros-basta' );
              ?>
              <article <?php post_class( 'search-page-card' ); ?>>
                <a class="search-page-card-link" href="<?php the_permalink(); ?>">
                  <span class="search-page-card-kicker"><?php echo esc_html( $page_context ); ?></span>
                  <h3 class="search-page-card-title"><?php the_title(); ?></h3>
                  <p class="search-page-card-text"><?php echo esc_html( stavros_get_result_excerpt( get_the_ID(), 24 ) ); ?></p>
                  <span class="search-page-card-footer"><?php esc_html_e( 'View page', 'stavros-basta' ); ?></span>
                </a>
              </article>
            <?php endwhile; ?>
          </div>
        </div>
      </section>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  <?php else : ?>
    <section class="search-results-empty-section">
      <div class="search-results-shell">
        <div class="search-results-empty">
          <h2 class="sec-title-dark"><?php esc_html_e( 'No matching content found.', 'stavros-basta' ); ?></h2>
          <p><?php esc_html_e( 'Try another keyword or browse the books archive and main pages directly.', 'stavros-basta' ); ?></p>
          <div class="search-results-empty-actions">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'book' ) ?: stavros_section_url( 'books' ) ); ?>" class="btn-primary-light"><?php esc_html_e( 'Browse Books', 'stavros-basta' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-ghost-light"><?php esc_html_e( 'Back Home', 'stavros-basta' ); ?></a>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
