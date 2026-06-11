<?php
/**
 * Reusable paper card.
 */

$paper_url  = stavros_custom_field( 'paper_url' ) ?: get_permalink();
$paper_text = get_the_excerpt();
$title_tag  = isset( $args['title_tag'] ) && in_array( $args['title_tag'], [ 'h2', 'h3' ], true )
    ? $args['title_tag']
    : 'h3';

if ( '' === trim( $paper_text ) ) {
    $paper_text = wp_trim_words( wp_strip_all_tags( strip_shortcodes( get_the_content() ) ), 26 );
}
?>

<article <?php post_class( 'pub-card' ); ?>>
  <a class="pub-card-link" href="<?php echo esc_url( $paper_url ); ?>" target="_blank" rel="noopener noreferrer">
    <<?php echo esc_html( $title_tag ); ?> class="pub-title"><?php the_title(); ?></<?php echo esc_html( $title_tag ); ?>>
    <?php if ( '' !== trim( $paper_text ) ) : ?>
      <p class="pub-card-text"><?php echo esc_html( $paper_text ); ?></p>
    <?php endif; ?>
    <div class="pub-card-footer">Read paper <span aria-hidden="true">&nearr;</span></div>
  </a>
</article>
