<section class="publications" id="research">
  <div class="pub-left">
    <div class="sec-header" style="margin-bottom:20px;">
      <span class="sec-label sec-label-light">// 03 &mdash; Papers &amp; Reading</span>
    </div>
    <h2 class="sec-title-light" style="margin-bottom:0;">Selected Papers<br/>&amp; <em>Reading</em></h2>
    <p class="pub-body">
      Stavros Basta's research and publication work spans industrial control systems, critical infrastructure, adversarial analytics, AI-driven security, and the weaknesses of legacy models when applied to operational environments.
    </p>
    <p class="pub-note">This area can later be connected to a full papers archive and reading library once the new post type is created.</p>
  </div>

  <div class="pub-right">
    <?php
    $pubs = [
      [
        'title' => 'Evaluating the Limitations of the CMMC Model in Modern ICS Risk Management',
        'meta'  => 'ICS Risk Management · Compliance Analysis',
        'text'  => 'A focused look at where traditional compliance approaches do not fully reflect the realities of industrial risk and operational exposure.',
      ],
      [
        'title' => 'Poisoning-Resistant Anomaly Detection for Industrial Control Systems',
        'meta'  => 'ICS Security · Resilient Analytics',
        'text'  => 'Research into anomaly detection models that remain useful when adversaries target the integrity of the underlying data itself.',
      ],
      [
        'title' => 'The Convergence of Functional Safety and OT Cybersecurity',
        'meta'  => 'IEC 61511 · IEC 62443 · Cyber HAZOP',
        'text'  => 'A paper connecting safety engineering and OT cybersecurity into a more integrated framework for secure and safe industrial operations.',
      ],
    ];
    ?>
    <div class="pub-card-grid">
      <?php foreach ( $pubs as $i => $pub ) : ?>
        <article class="pub-card">
          <span class="pub-num"><?php printf( '%02d', $i + 1 ); ?></span>
          <div class="pub-title"><?php echo esc_html( $pub['title'] ); ?></div>
          <div class="pub-meta"><?php echo esc_html( $pub['meta'] ); ?></div>
          <p class="pub-card-text"><?php echo esc_html( $pub['text'] ); ?></p>
          <div class="pub-card-footer">Research archive placeholder</div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
