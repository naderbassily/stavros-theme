<?php
/**
 * Book archive template.
 */

get_header();

$archive_title = post_type_archive_title( '', false );
$archive_description = get_the_archive_description();
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
      </div>
      <h2 class="sec-title-dark">Browse All <em>Titles</em></h2>

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

        <?php
        $pagination = paginate_links(
          [
            'type'      => 'array',
            'prev_text' => __( 'Previous', 'stavros-basta' ),
            'next_text' => __( 'Next', 'stavros-basta' ),
          ]
        );
        ?>

        <?php if ( ! empty( $pagination ) ) : ?>
          <nav class="books-archive-pagination" aria-label="<?php esc_attr_e( 'Books pagination', 'stavros-basta' ); ?>">
            <?php foreach ( $pagination as $pagination_link ) : ?>
              <?php echo wp_kses_post( $pagination_link ); ?>
            <?php endforeach; ?>
          </nav>
        <?php endif; ?>
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
