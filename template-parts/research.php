<section class="publications" id="research">
  <div class="pub-left">
    <div class="sec-header sec-header-compact">
      <span class="sec-label sec-label-light">// 03 &mdash; Papers &amp; Reading</span>
    </div>
    <h2 class="sec-title-light sec-title-flush">Selected Papers<br/>&amp; <em>Reading</em></h2>
    <p class="pub-body">
      Stavros Basta's research and publication work spans industrial control systems, critical infrastructure, adversarial analytics, AI-driven security, and the weaknesses of legacy models when applied to operational environments.
    </p>
    <p class="pub-note">A focused selection of current research themes and publication tracks.</p>
    <?php
    $papers_cat = get_category_by_slug( 'papers' );
    $papers_url = $papers_cat ? get_category_link( $papers_cat->term_id ) : home_url( '/category/papers/' );
    ?>
    <a href="<?php echo esc_url( $papers_url ); ?>" class="btn-primary-dark pub-all-link">View all papers</a>
  </div>

  <div class="pub-right">
    <?php
    $papers_query = new WP_Query(
      [
        'post_type'           => 'post',
        'posts_per_page'      => 3,
        'post_status'         => 'publish',
        'category_name'       => 'papers',
        'meta_query'          => [
          [
            'key'     => 'paper_url',
            'value'   => '',
            'compare' => '!=',
          ],
        ],
        'ignore_sticky_posts' => true,
      ]
    );
    ?>

    <div class="pub-card-grid">
      <?php while ( $papers_query->have_posts() ) : $papers_query->the_post(); ?>
        <?php get_template_part( 'template-parts/paper-card', null, [ 'title_tag' => 'h3' ] ); ?>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    </div>
  </div>
</section>
