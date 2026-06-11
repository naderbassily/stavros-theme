<?php
/**
 * Shared posts archive layout.
 */

$archive_title       = $args['title'] ?? __( 'Posts', 'stavros-basta' );
$archive_description = $args['description'] ?? '';
$empty_message       = $args['empty_message'] ?? __( 'No posts were found in this archive.', 'stavros-basta' );
?>

<main class="posts-archive-page">
  <section class="posts-archive-hero">
    <div class="posts-archive-shell">
      <p class="posts-archive-eyebrow">// Posts Archive</p>
      <h1 class="posts-archive-title"><?php echo esc_html( $archive_title ); ?></h1>
      <div class="posts-archive-divider"></div>
      <div class="posts-archive-intro">
        <?php
        echo wp_kses_post(
          $archive_description
            ?: __( 'Research, analysis, and perspectives on cybersecurity, industrial systems, and technology.', 'stavros-basta' )
        );
        ?>
      </div>
    </div>
  </section>

  <section class="posts-archive-listing">
    <div class="posts-archive-shell">
      <div class="sec-header">
        <span class="sec-label sec-label-light">// Browse Posts</span>
      </div>
      <h2 class="sec-title-light">Latest <em>Writing</em></h2>

      <?php if ( have_posts() ) : ?>
        <div class="pub-card-grid posts-archive-grid">
          <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'template-parts/paper-card', null, [ 'title_tag' => 'h3' ] ); ?>
          <?php endwhile; ?>
        </div>

        <?php
        $pagination = paginate_links(
          [
            'type'      => 'array',
            'mid_size'  => 1,
            'prev_text' => __( 'Previous', 'stavros-basta' ),
            'next_text' => __( 'Next', 'stavros-basta' ),
          ]
        );
        ?>
        <?php if ( $pagination ) : ?>
          <nav class="posts-archive-pagination" aria-label="<?php esc_attr_e( 'Posts pagination', 'stavros-basta' ); ?>">
            <?php foreach ( $pagination as $page_link ) : ?>
              <?php echo wp_kses_post( $page_link ); ?>
            <?php endforeach; ?>
          </nav>
        <?php endif; ?>
      <?php else : ?>
        <div class="posts-archive-empty">
          <p><?php echo esc_html( $empty_message ); ?></p>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>
