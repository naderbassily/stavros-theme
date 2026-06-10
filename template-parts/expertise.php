<section class="expertise" id="expertise">
  <div class="sec-header">
    <span class="sec-label sec-label-light">// 01 &mdash; Core Domains</span>
    <span class="sec-line-light"></span>
  </div>
  <h2 class="sec-title-light">Areas of <em>Expertise</em></h2>

  <?php
  $cards = [
    [ 'num'=>'01', 'icon'=>'⬡', 'title'=>'ICS &amp; Critical Infrastructure', 'text'=>'Focused on industrial control systems, operational technology environments, and the protection of critical infrastructure where conventional security assumptions often break down.' ],
    [ 'num'=>'02', 'icon'=>'◈', 'title'=>'Penetration Testing &amp; Adversarial Security', 'text'=>'Backed by certifications including LPTM and CPENT, with work spanning offensive security, validation, and adversarial thinking across modern environments.' ],
    [ 'num'=>'03', 'icon'=>'◇', 'title'=>'Governance, Risk &amp; Compliance', 'text'=>'Research and analysis centered on how frameworks such as CMMC, NIST, and IEC 62443 perform when applied to complex industrial and regulated systems.' ],
    [ 'num'=>'04', 'icon'=>'△', 'title'=>'Cybersecurity Leadership', 'text'=>'Combining formal cybersecurity education, leadership credentials, and applied industry work to support strategy, program development, and executive decision-making.' ],
    [ 'num'=>'05', 'icon'=>'○', 'title'=>'Cryptography, Mathematics &amp; Education', 'text'=>'Authoring technical and accessible works across cryptography, mathematics, and cybersecurity to translate difficult subjects into practical understanding.' ],
    [ 'num'=>'06', 'icon'=>'□', 'title'=>'AI, Analytics &amp; Supply Chain Resilience', 'text'=>'Ongoing publication work in adversarial AI, anomaly detection, resilient supply chains, and the use of analytics in security operations.' ],
  ];
  ?>

  <div class="exp-grid">
    <?php foreach ( $cards as $card ) : ?>
    <div class="exp-card">
      <div class="c-num"><?php echo esc_html( $card['num'] ); ?></div>
      <div class="c-icon"><?php echo $card['icon']; ?></div>
      <h3 class="c-title"><?php echo $card['title']; ?></h3>
      <p class="c-text"><?php echo esc_html( $card['text'] ); ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</section>
