<section class="books" id="books">
  <div class="sec-header">
    <span class="sec-label sec-label-dark">// 02 &mdash; Published Works</span>
    <span class="sec-line-dark"></span>
  </div>
  <h2 class="sec-title-dark">Books &amp; <em>Publications</em></h2>

  <?php
  $book_svg = '<svg width="30" height="38" viewBox="0 0 30 38" fill="none"><rect x="3" y="2" width="24" height="34" stroke="#2a2a2a" stroke-width="1.2"/><line x1="7" y1="9" x2="23" y2="9" stroke="#2a2a2a" stroke-width="0.8"/><line x1="7" y1="15" x2="23" y2="15" stroke="#2a2a2a" stroke-width="0.8"/><line x1="7" y1="21" x2="17" y2="21" stroke="#2a2a2a" stroke-width="0.8"/></svg>';
  $books_archive_url = get_post_type_archive_link( 'book' );
  $books_query = new WP_Query(
    [
      'post_type'           => 'book',
      'posts_per_page'      => 5,
      'post_status'         => 'publish',
      'orderby'             => [
        'menu_order' => 'ASC',
        'date'       => 'DESC',
      ],
      'ignore_sticky_posts' => true,
    ]
  );
  ?>

  <div class="books-grid">
    <?php if ( $books_query->have_posts() ) : ?>
      <?php while ( $books_query->have_posts() ) : $books_query->the_post(); ?>
        <?php
        $book_terms = get_the_terms( get_the_ID(), 'genre' );
        $book_tag   = ( ! is_wp_error( $book_terms ) && ! empty( $book_terms ) ) ? $book_terms[0]->name : '';
        ?>
        <article class="book-card">
          <a class="book-card-link" href="<?php the_permalink(); ?>">
            <div class="book-cover">
              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'large', [ 'class' => 'book-cover-img' ] ); ?>
              <?php else : ?>
                <div class="book-cover-ph">
                  <?php echo $book_svg; ?>
                  Publication Preview
                </div>
              <?php endif; ?>
            </div>
            <div class="book-info">
              <?php if ( $book_tag ) : ?>
                <div class="book-tag"><?php echo esc_html( $book_tag ); ?></div>
              <?php endif; ?>
              <h3 class="book-title"><?php the_title(); ?></h3>
              <p class="book-desc"><?php echo esc_html( get_the_excerpt() ); ?></p>
            </div>
          </a>
        </article>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>

  <div class="books-footer">
    <a href="<?php echo esc_url( $books_archive_url ?: stavros_section_url( 'contact' ) ); ?>" class="btn-ghost-light">View all books</a>
  </div>
</section>
