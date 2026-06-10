<section class="coming-soon-section" id="coming-soon">
  <div class="sec-header">
    <span class="sec-label sec-label-dark">// 04 &mdash; Coming Soon</span>
  </div>
  <h2 class="sec-title-dark">Upcoming <em>Books</em></h2>

  <?php
  $coming_soon_books = [
    [
      'track' => 'AI & Data Science',
      'title' => 'Foundations of AI and Data Science',
      'note'  => 'A forthcoming title focused on AI literacy, data science foundations, and technical education.',
    ],
    [
      'track' => 'Applied AI',
      'title' => 'AI, Data Science, and Monetization Strategies',
      'note'  => 'A practitioner-oriented roadmap connecting artificial intelligence, data strategy, and revenue design.',
    ],
    [
      'track' => 'Case Studies',
      'title' => 'AI Revealed: Learning Data Science Through Real-World Case Studies',
      'note'  => 'A case-study-driven book intended to make data science and applied AI more concrete and usable.',
    ],
  ];
  ?>

  <div class="books-grid coming-books-grid">
    <?php foreach ( $coming_soon_books as $coming_book ) : ?>
      <?php
      get_template_part(
        'template-parts/book-card',
        null,
        [
          'label'       => $coming_book['track'],
          'title'       => $coming_book['title'],
          'description' => $coming_book['note'],
          'url'         => '',
          'placeholder' => true,
        ]
      );
      ?>
    <?php endforeach; ?>
  </div>
</section>
