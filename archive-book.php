<?php
/**
 * Book archive template.
 */

get_header();

$archive_title = post_type_archive_title( '', false );
$archive_description = get_the_archive_description();
$selected_genre = isset( $_GET['book_genre'] ) ? sanitize_text_field( wp_unslash( $_GET['book_genre'] ) ) : '';
$selected_sort  = isset( $_GET['book_sort'] ) ? sanitize_text_field( wp_unslash( $_GET['book_sort'] ) ) : 'date_desc';
$book_search    = isset( $_GET['book_search'] ) ? sanitize_text_field( wp_unslash( $_GET['book_search'] ) ) : '';
$genre_terms    = get_terms(
    [
        'taxonomy'   => 'genre',
        'hide_empty' => true,
    ]
);
?>

<main class="books-archive-page">
  <section class="books-archive-hero">
    <div class="books-archive-shell">
      <p class="books-archive-eyebrow">// Published Works Archive</p>
      <h1 class="books-archive-title"><?php echo esc_html( $archive_title ?: __( 'Books', 'stavros-basta' ) ); ?></h1>
      <div class="books-archive-divider"></div>
      <p class="books-archive-intro">
        <?php
        echo wp_kses_post(
          $archive_description
            ?: __( 'A complete archive of Stavros E. Basta publications, including books on cybersecurity, industrial control systems, and critical infrastructure protection.', 'stavros-basta' )
        );
        ?>
      </p>
    </div>
  </section>

  <section class="books-archive-listing">
    <div class="books-archive-shell">
      <div class="sec-header">
        <span class="sec-label sec-label-dark">// Archive Collection</span>
        <span class="sec-line-dark"></span>
      </div>
      <h2 class="sec-title-dark">Browse All <em>Titles</em></h2>

      <form class="books-archive-controls" method="get" action="<?php echo esc_url( get_post_type_archive_link( 'book' ) ); ?>">
        <div class="books-archive-control">
          <label for="book-search"><?php esc_html_e( 'Search', 'stavros-basta' ); ?></label>
          <input id="book-search" type="search" name="book_search" value="<?php echo esc_attr( $book_search ); ?>" placeholder="<?php esc_attr_e( 'Search books', 'stavros-basta' ); ?>" />
        </div>
        <div class="books-archive-control">
          <label for="book-genre"><?php esc_html_e( 'Genre', 'stavros-basta' ); ?></label>
          <select id="book-genre" name="book_genre">
            <option value=""><?php esc_html_e( 'All genres', 'stavros-basta' ); ?></option>
            <?php foreach ( $genre_terms as $genre_term ) : ?>
              <option value="<?php echo esc_attr( $genre_term->slug ); ?>"<?php selected( $selected_genre, $genre_term->slug ); ?>>
                <?php echo esc_html( $genre_term->name ); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="books-archive-control">
          <label for="book-sort"><?php esc_html_e( 'Sort', 'stavros-basta' ); ?></label>
          <select id="book-sort" name="book_sort">
            <option value="date_desc"<?php selected( $selected_sort, 'date_desc' ); ?>><?php esc_html_e( 'Newest first', 'stavros-basta' ); ?></option>
            <option value="date_asc"<?php selected( $selected_sort, 'date_asc' ); ?>><?php esc_html_e( 'Oldest first', 'stavros-basta' ); ?></option>
            <option value="title_asc"<?php selected( $selected_sort, 'title_asc' ); ?>><?php esc_html_e( 'Title A-Z', 'stavros-basta' ); ?></option>
            <option value="title_desc"<?php selected( $selected_sort, 'title_desc' ); ?>><?php esc_html_e( 'Title Z-A', 'stavros-basta' ); ?></option>
          </select>
        </div>
        <div class="books-archive-actions">
          <button type="submit" class="btn-primary-light"><?php esc_html_e( 'Apply', 'stavros-basta' ); ?></button>
          <a href="<?php echo esc_url( get_post_type_archive_link( 'book' ) ); ?>" class="btn-ghost-light"><?php esc_html_e( 'Reset', 'stavros-basta' ); ?></a>
        </div>
      </form>

      <?php if ( have_posts() ) : ?>
        <div class="books-grid books-archive-grid">
          <?php while ( have_posts() ) : the_post(); ?>
            <?php
            $genre_terms = get_the_terms( get_the_ID(), 'genre' );
            $book_label  = ( ! is_wp_error( $genre_terms ) && ! empty( $genre_terms ) ) ? $genre_terms[0]->name : __( 'Published Work', 'stavros-basta' );
            ?>
            <?php get_template_part( 'template-parts/book-card', null, [ 'label' => $book_label ] ); ?>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <div class="books-archive-empty">
          <p><?php esc_html_e( 'No books have been published yet.', 'stavros-basta' ); ?></p>
          <a href="<?php echo esc_url( stavros_section_url( 'contact' ) ); ?>" class="btn-primary-light"><?php esc_html_e( 'Contact Stavros', 'stavros-basta' ); ?></a>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
