<?php
/**
 * Shared book card.
 *
 * @var array $args Optional card data.
 */

$book_label       = $args['label'] ?? '';
$book_title       = $args['title'] ?? get_the_title();
$book_description = $args['description'] ?? get_the_excerpt();
$book_url         = $args['url'] ?? get_permalink();
$is_placeholder   = ! empty( $args['placeholder'] );
$card_tag         = $book_url ? 'a' : 'div';
?>

<article class="book-card<?php echo $is_placeholder ? ' book-card--placeholder' : ''; ?>">
  <<?php echo esc_html( $card_tag ); ?> class="book-card-link"<?php echo $book_url ? ' href="' . esc_url( $book_url ) . '"' : ''; ?>>
    <div class="book-cover">
      <?php if ( ! $is_placeholder && has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'large', [ 'class' => 'book-cover-img', 'alt' => $book_title ] ); ?>
      <?php else : ?>
        <div class="book-cover-ph">
          <span><?php echo $is_placeholder ? esc_html__( 'Forthcoming', 'stavros-basta' ) : esc_html__( 'Stavros E. Basta', 'stavros-basta' ); ?></span>
          <strong><?php echo esc_html( $book_title ); ?></strong>
          <small><?php esc_html_e( 'Cover in development', 'stavros-basta' ); ?></small>
        </div>
      <?php endif; ?>
    </div>
    <div class="book-info">
      <div class="book-tag">
        <?php echo $book_label ? esc_html( $book_label ) : '&nbsp;'; ?>
      </div>
      <h3 class="book-title"><?php echo esc_html( $book_title ); ?></h3>
      <p class="book-desc"><?php echo esc_html( $book_description ); ?></p>
    </div>
  </<?php echo esc_html( $card_tag ); ?>>
</article>
