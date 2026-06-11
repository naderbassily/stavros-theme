<section class="books" id="books">
  <div class="sec-header">
    <span class="sec-label sec-label-dark">// 02 &mdash; Published Works</span>
  </div>
  <div class="books-title-row">
    <h2 class="sec-title-dark">Books &amp; <em>Publications</em></h2>
    <div class="carousel-controls" role="group" aria-label="<?php esc_attr_e( 'Browse books', 'stavros-basta' ); ?>">
      <button class="carousel-btn carousel-prev" aria-label="<?php esc_attr_e( 'Previous', 'stavros-basta' ); ?>">&#8592;</button>
      <button class="carousel-btn carousel-next" aria-label="<?php esc_attr_e( 'Next', 'stavros-basta' ); ?>">&#8594;</button>
    </div>
  </div>

  <?php
  $books_archive_url = get_post_type_archive_link( 'book' );
  $books_query = new WP_Query(
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
          'field'    => 'slug',
          'terms'    => 'coming-soon',
          'operator' => 'NOT IN',
        ],
      ],
    ]
  );
  ?>

  <div class="books-carousel">
    <div class="books-carousel-track" id="books-carousel-track">
      <?php if ( $books_query->have_posts() ) : ?>
        <?php while ( $books_query->have_posts() ) : $books_query->the_post(); ?>
          <?php
          $book_terms = get_the_terms( get_the_ID(), 'genre' );
          $book_tag   = ( ! is_wp_error( $book_terms ) && ! empty( $book_terms ) ) ? $book_terms[0]->name : '';
          ?>
          <?php get_template_part( 'template-parts/book-card', null, [ 'label' => $book_tag ] ); ?>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
  </div>

  <div class="books-footer">
    <a href="<?php echo esc_url( $books_archive_url ?: stavros_section_url( 'contact' ) ); ?>" class="btn-ghost-light">View all books</a>
  </div>

  <script>
  (function () {
    var track = document.getElementById('books-carousel-track');
    if (!track) return;
    var section = track.closest('.books');
    var prevBtn = section ? section.querySelector('.carousel-prev') : null;
    var nextBtn = section ? section.querySelector('.carousel-next') : null;
    function scrollBy(dir) {
      var card = track.querySelector('.book-card');
      var step = card ? card.offsetWidth * 3 : track.offsetWidth * 0.75;
      track.scrollBy({ left: dir * step, behavior: 'smooth' });
    }
    if (prevBtn) prevBtn.addEventListener('click', function () { scrollBy(-1); });
    if (nextBtn) nextBtn.addEventListener('click', function () { scrollBy(1); });
  })();
  </script>
</section>
