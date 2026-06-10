<section class="contact-section" id="contact">
  <div class="contact-left">
    <div class="sec-header sec-header-compact">
      <span class="sec-label sec-label-light">// 05 &mdash; Engage</span>
    </div>
    <h2 class="sec-title-light sec-title-flush">Speaking,<br/>Consulting &amp;<br/><em>Collaboration</em></h2>
    <p class="contact-text">
      Available for keynote speaking, executive consulting, academic collaboration, and expert advisory engagements in cybersecurity, ICS protection, and critical infrastructure resilience.
    </p>
    <a href="#contact-details" class="btn-primary-dark">View Engagement Details</a>
  </div>

  <div class="contact-right" id="contact-details">
    <?php
    $rows = [
      [ 'label'=>'Specialization', 'value'=>'ICS Security &amp; Critical Infrastructure' ],
      [ 'label'=>'Engagements',    'value'=>'Speaking &middot; Consulting &middot; Advisory &middot; Academic' ],
      [ 'label'=>'Education',      'value'=>'M.S. Cybersecurity &middot; B.S. Cybersecurity' ],
      [ 'label'=>'Credentials',    'value'=>'25+ professional certifications including GICSP, CISM, GSLC, LPTM, and CPENT' ],
      [ 'label'=>'Publishing',     'value'=>'Books, peer-reviewed papers, and cross-disciplinary work spanning cybersecurity, AI, mathematics, and governance' ],
      [ 'label'=>'Focus Areas',    'value'=>'Industrial Control Systems &middot; Critical Infrastructure &middot; GRC &middot; Penetration Testing &middot; Applied AI' ],
      [ 'label'=>'Contact',        'value'=>'Direct contact details can be added after client approval.' ],
    ];
    ?>
    <?php foreach ( $rows as $row ) : ?>
    <div class="c-row">
      <span class="c-row-label"><?php echo esc_html( $row['label'] ); ?></span>
      <span class="c-row-value"><?php echo $row['value']; ?></span>
    </div>
    <?php endforeach; ?>
  </div>
</section>
