<?php
/**
 * Single Book template.
 */

get_header();

while ( have_posts() ) :
    the_post();

    $post_id            = get_the_ID();
    $genre_terms        = get_the_terms( $post_id, 'genre' );
    $genre_label        = ( ! is_wp_error( $genre_terms ) && ! empty( $genre_terms ) ) ? implode( ' · ', wp_list_pluck( $genre_terms, 'name' ) ) : '';
    $publisher          = stavros_book_field( 'publisher', $post_id ) ?: stavros_book_field( 'book_publisher', $post_id );
    $amazon_url         = stavros_book_field( 'amazon_link', $post_id ) ?: stavros_book_field( 'amazon_url', $post_id ) ?: stavros_book_field( 'amazon', $post_id ) ?: stavros_book_field( 'buy_link', $post_id );
    $wiley_url          = stavros_book_field( 'wiley_link', $post_id ) ?: stavros_book_field( 'wiley_url', $post_id ) ?: stavros_book_field( 'publisher_url', $post_id );
    $subtitle           = stavros_book_field( 'subtitle', $post_id ) ?: stavros_book_field( 'book_subtitle', $post_id );
    $year               = stavros_book_field( 'year', $post_id ) ?: stavros_book_field( 'publication_date', $post_id );
    $page_count         = stavros_book_field( 'pages', $post_id ) ?: stavros_book_field( 'page_count', $post_id ) ?: stavros_book_field( 'pages_count', $post_id );
    $sample_url         = stavros_book_field( 'sample_url', $post_id ) ?: stavros_book_field( 'sample_chapter', $post_id );
    $features           = stavros_book_field( 'features', $post_id );
    $isbn_13            = stavros_book_field( 'isbn-13', $post_id ) ?: stavros_book_field( 'isbn_13', $post_id ) ?: stavros_book_field( 'isbn13', $post_id );
    $isbn_10            = stavros_book_field( 'isbn-10', $post_id ) ?: stavros_book_field( 'isbn_10', $post_id ) ?: stavros_book_field( 'isbn10', $post_id );
    $asin               = stavros_book_field( 'asin', $post_id ) ?: stavros_book_field( 'amazon_asin', $post_id );
    $book_archive_url   = get_post_type_archive_link( 'book' );
    $book_content       = trim( get_the_content() );
    $normalized_features = [];
    $detail_rows        = [];
    $detail_signature   = [];

    if ( ! empty( $features ) ) {
        if ( is_array( $features ) ) {
            foreach ( $features as $feature ) {
                $feature_text = is_array( $feature ) ? ( $feature['text'] ?? $feature['feature'] ?? '' ) : $feature;
                $feature_text = trim( wp_strip_all_tags( (string) $feature_text ) );

                if ( '' !== $feature_text ) {
                    $normalized_features[] = $feature_text;
                }
            }
        } else {
            $feature_text = trim( wp_strip_all_tags( (string) $features ) );

            if ( '' !== $feature_text ) {
                $normalized_features[] = $feature_text;
            }
        }
    }

    $candidate_detail_rows = [
        [
            'label' => __( 'Publication Date', 'stavros-basta' ),
            'value' => $year,
        ],
        [
            'label' => __( 'Publisher', 'stavros-basta' ),
            'value' => $publisher,
        ],
        [
            'label' => __( 'ISBN-13', 'stavros-basta' ),
            'value' => $isbn_13,
        ],
        [
            'label' => __( 'ISBN-10', 'stavros-basta' ),
            'value' => $isbn_10,
        ],
        [
            'label' => __( 'ASIN', 'stavros-basta' ),
            'value' => $asin,
        ],
    ];

    foreach ( $candidate_detail_rows as $detail_row ) {
        if ( ! $detail_row['value'] ) {
            continue;
        }

        $signature = $detail_row['label'] . '|' . $detail_row['value'];

        if ( isset( $detail_signature[ $signature ] ) ) {
            continue;
        }

        $detail_signature[ $signature ] = true;
        $detail_rows[]                  = $detail_row;
    }

    $related_books_args = [
        'post_type'           => 'book',
        'posts_per_page'      => 3,
        'post_status'         => 'publish',
        'post__not_in'        => [ $post_id ],
        'orderby'             => [
            'menu_order' => 'ASC',
            'date'       => 'DESC',
        ],
        'ignore_sticky_posts' => true,
    ];

    if ( ! is_wp_error( $genre_terms ) && ! empty( $genre_terms ) ) {
        $related_books_args['tax_query'] = [
            [
                'taxonomy' => 'genre',
                'field'    => 'term_id',
                'terms'    => wp_list_pluck( $genre_terms, 'term_id' ),
            ],
        ];
    }

    $related_books = new WP_Query( $related_books_args );
?>

<main class="single-book-page">
  <section class="single-book-hero">
    <div class="single-book-shell">
      <div class="single-book-cover-col">
        <div class="single-book-3d-container">
          <div class="single-book-3d">
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( 'large', [ 'class' => 'single-book-cover-img', 'alt' => get_the_title() ] ); ?>
            <?php else : ?>
              <div class="single-book-cover-fallback">
                <span>Stavros E. Basta</span>
                <strong><?php the_title(); ?></strong>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="single-book-info-col">
        <?php if ( $book_archive_url ) : ?>
          <a class="single-book-back-link" href="<?php echo esc_url( $book_archive_url ); ?>"><?php esc_html_e( 'All Books', 'stavros-basta' ); ?></a>
        <?php endif; ?>

        <?php if ( $genre_label ) : ?>
          <p class="single-book-kicker"><?php echo esc_html( $genre_label ); ?></p>
        <?php endif; ?>

        <h1 class="single-book-title"><?php the_title(); ?></h1>

        <?php if ( $subtitle ) : ?>
          <p class="single-book-subtitle"><?php echo esc_html( $subtitle ); ?></p>
        <?php endif; ?>

        <?php if ( has_excerpt() ) : ?>
          <div class="single-book-excerpt">
            <p><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
          </div>
        <?php endif; ?>

        <?php if ( $sample_url || $amazon_url || $wiley_url ) : ?>
          <div class="single-book-actions">
            <?php if ( $sample_url ) : ?>
              <a href="<?php echo esc_url( $sample_url ); ?>" class="btn-ghost-light" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'View Sample Chapter', 'stavros-basta' ); ?></a>
            <?php endif; ?>
            <?php if ( $wiley_url ) : ?>
              <a href="<?php echo esc_url( $wiley_url ); ?>" class="btn-ghost-light" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'View on Publisher', 'stavros-basta' ); ?></a>
            <?php endif; ?>
            <?php if ( $amazon_url ) : ?>
              <a href="<?php echo esc_url( $amazon_url ); ?>" class="btn-primary-light" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'View on Amazon', 'stavros-basta' ); ?></a>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <?php if ( $book_content || $page_count || ! empty( $detail_rows ) || ! empty( $normalized_features ) ) : ?>
    <section class="single-book-body-section">
      <div class="single-book-shell single-book-body-shell">
        <div class="single-book-body-main">
          <div class="sec-header">
            <span class="sec-label sec-label-light">// About This Book</span>
            <span class="sec-line-light"></span>
          </div>
          <h2 class="sec-title-light"><?php the_title(); ?></h2>
          <?php if ( $book_content ) : ?>
            <div class="single-book-content">
              <?php the_content(); ?>
            </div>
          <?php endif; ?>
        </div>

        <aside class="single-book-body-side">
          <?php if ( $page_count ) : ?>
            <div class="single-book-side-block">
              <span class="single-book-side-label"><?php esc_html_e( 'Length', 'stavros-basta' ); ?></span>
              <div class="single-book-side-value"><?php echo esc_html( $page_count ); ?> <?php esc_html_e( 'Pages', 'stavros-basta' ); ?></div>
            </div>
          <?php endif; ?>

          <?php if ( ! empty( $detail_rows ) ) : ?>
            <?php foreach ( $detail_rows as $detail_row ) : ?>
              <div class="single-book-side-block">
                <span class="single-book-side-label"><?php echo esc_html( $detail_row['label'] ); ?></span>
                <div class="single-book-side-value"><?php echo esc_html( $detail_row['value'] ); ?></div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if ( ! empty( $normalized_features ) ) : ?>
            <div class="single-book-side-block">
              <span class="single-book-side-label"><?php esc_html_e( 'Highlights', 'stavros-basta' ); ?></span>
              <ul class="single-book-features">
                <?php foreach ( $normalized_features as $feature_text ) : ?>
                  <li><?php echo esc_html( $feature_text ); ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
        </aside>
      </div>
    </section>
  <?php endif; ?>

  <?php if ( $related_books->have_posts() ) : ?>
    <section class="single-book-related">
      <div class="single-book-shell">
        <div class="sec-header">
          <span class="sec-label sec-label-dark">// Related Books</span>
          <span class="sec-line-dark"></span>
        </div>
        <h2 class="sec-title-dark">Explore More <em>Publications</em></h2>

        <div class="single-book-related-grid">
          <?php while ( $related_books->have_posts() ) : $related_books->the_post(); ?>
            <?php
            $related_genres = get_the_terms( get_the_ID(), 'genre' );
            $related_label  = ( ! is_wp_error( $related_genres ) && ! empty( $related_genres ) ) ? $related_genres[0]->name : __( 'Published Work', 'stavros-basta' );
            ?>
            <article class="book-card">
              <a class="book-card-link" href="<?php the_permalink(); ?>">
                <div class="book-cover">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'large', [ 'class' => 'book-cover-img', 'alt' => get_the_title() ] ); ?>
                  <?php else : ?>
                    <div class="book-cover-ph">
                      <span>Stavros E. Basta</span>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="book-info">
                  <div class="book-tag"><?php echo esc_html( $related_label ); ?></div>
                  <h3 class="book-title"><?php the_title(); ?></h3>
                  <p class="book-desc"><?php echo esc_html( get_the_excerpt() ); ?></p>
                </div>
              </a>
            </article>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
</main>

<?php
endwhile;
get_footer();
?>
