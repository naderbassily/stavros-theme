<?php
/**
 * Book archive template.
 */

get_header();

$book_svg = '<svg width="30" height="38" viewBox="0 0 30 38" fill="none"><rect x="3" y="2" width="24" height="34" stroke="#2a2a2a" stroke-width="1.2"/><line x1="7" y1="9" x2="23" y2="9" stroke="#2a2a2a" stroke-width="0.8"/><line x1="7" y1="15" x2="23" y2="15" stroke="#2a2a2a" stroke-width="0.8"/><line x1="7" y1="21" x2="17" y2="21" stroke="#2a2a2a" stroke-width="0.8"/></svg>';
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
        <span class="sec-line-dark"></span>
      </div>
      <h2 class="sec-title-dark">Browse All <em>Titles</em></h2>

      <?php if ( have_posts() ) : ?>
        <div class="books-grid books-archive-grid">
          <?php while ( have_posts() ) : the_post(); ?>
            <?php
            $genre_terms = get_the_terms( get_the_ID(), 'genre' );
            $book_label  = ( ! is_wp_error( $genre_terms ) && ! empty( $genre_terms ) ) ? $genre_terms[0]->name : __( 'Published Work', 'stavros-basta' );
            ?>
            <article class="book-card">
              <a class="book-card-link" href="<?php the_permalink(); ?>">
                <div class="book-cover">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'large', [ 'class' => 'book-cover-img', 'alt' => get_the_title() ] ); ?>
                  <?php else : ?>
                    <div class="book-cover-ph">
                      <?php echo $book_svg; ?>
                      Publication Preview
                    </div>
                  <?php endif; ?>
                </div>
                <div class="book-info">
                  <div class="book-tag"><?php echo esc_html( $book_label ); ?></div>
                  <h3 class="book-title"><?php the_title(); ?></h3>
                  <p class="book-desc"><?php echo esc_html( get_the_excerpt() ); ?></p>
                </div>
              </a>
            </article>
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
