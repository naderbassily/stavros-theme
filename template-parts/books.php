<section class="books" id="books">
  <div class="sec-header">
    <span class="sec-label sec-label-dark">// 02 &mdash; Published Works</span>
  </div>
  <h2 class="sec-title-dark">Books &amp; <em>Publications</em></h2>

  <?php
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
        <?php get_template_part( 'template-parts/book-card', null, [ 'label' => $book_tag ] ); ?>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>

  <div class="books-footer">
    <a href="<?php echo esc_url( $books_archive_url ?: stavros_section_url( 'contact' ) ); ?>" class="btn-ghost-light">View all books</a>
  </div>
</section>
