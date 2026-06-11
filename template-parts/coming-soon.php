<section class="coming-soon-section" id="coming-soon">
  <div class="coming-soon-inner">
  <div class="coming-soon-left">
    <div class="sec-header sec-header-compact">
      <span class="sec-label sec-label-dark">// 04 &mdash; Coming Soon</span>
    </div>
    <h2 class="sec-title-dark sec-title-flush">Upcoming <em>Books</em></h2>
    <p class="coming-soon-body">New titles currently in development, spanning industrial control systems security, applied cryptography, and cybersecurity leadership.</p>
  </div>

  <div class="coming-soon-right">
    <?php
    $coming_soon_term = get_term_by( 'slug', 'coming-soon', 'genre' );

    if ( ! $coming_soon_term ) {
      $coming_soon_term = get_term_by( 'name', 'Coming Soon', 'genre' );
    }

    $coming_soon_query = new WP_Query(
      [
        'post_type'           => 'book',
        'posts_per_page'      => -1,
        'post_status'         => 'publish',
        'orderby'             => [
          'menu_order' => 'ASC',
          'date'       => 'DESC',
        ],
        'ignore_sticky_posts' => true,
        'tax_query'           => [
          [
            'taxonomy' => 'genre',
            'field'    => $coming_soon_term ? 'term_id' : 'slug',
            'terms'    => $coming_soon_term ? $coming_soon_term->term_id : 'coming-soon',
          ],
        ],
      ]
    );
    ?>

    <div class="books-grid coming-soon-grid">
      <?php if ( $coming_soon_query->have_posts() ) : ?>
        <?php while ( $coming_soon_query->have_posts() ) : $coming_soon_query->the_post(); ?>
          <?php
          $book_terms = get_the_terms( get_the_ID(), 'genre' );
          $book_tag   = ( ! is_wp_error( $book_terms ) && ! empty( $book_terms ) ) ? $book_terms[0]->name : '';

          get_template_part(
            'template-parts/book-card',
            null,
            [
              'label'       => $book_tag,
              'title'       => get_the_title(),
              'description' => get_the_excerpt(),
              'url'         => get_permalink(),
            ]
          );
          ?>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
  </div>
  </div><!-- .coming-soon-inner -->
</section>
