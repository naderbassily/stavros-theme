<section class="certifications" id="certifications">
  <div class="sec-header">
    <span class="sec-label sec-label-dark">// 04 &mdash; Credentials</span>
  </div>
  <h2 class="sec-title-dark">Professional <em>Certifications</em></h2>

  <?php
  $groups = [
    [
      'title' => 'Signature Certifications',
      'items' => [
        'GIAC Global Industrial Cyber Security Professional (GICSP)',
        'GIAC Security Leadership Certification (GSLC)',
        'Certified Information Security Manager (CISM)',
        'Certified Penetration Testing Professional (CPENT)',
        'Licensed Penetration Testing Master (LPTM)',
      ],
    ],
    [
      'title' => 'Academic Foundation',
      'items' => [
        'Master of Science in Cybersecurity',
        'Bachelor of Science in Cybersecurity',
        'Published researcher in ICS security and critical infrastructure protection',
      ],
    ],
    [
      'title' => 'Professional Scope',
      'items' => [
        '25+ professional cybersecurity certifications spanning:',
      ],
      'subitems' => [
        'Security leadership',
        'Penetration testing',
        'Risk management',
        'Cloud security',
        'Governance &amp; compliance',
        'Industrial control systems security',
      ],
    ],
  ];
  ?>

  <div class="cert-groups">
    <?php foreach ( $groups as $group ) : ?>
      <section class="cert-group">
        <h3 class="cert-group-title"><?php echo $group['title']; ?></h3>
        <ul class="cert-list">
          <?php foreach ( $group['items'] as $item ) : ?>
            <li class="cert-list-item"><?php echo $item; ?></li>
          <?php endforeach; ?>
        </ul>

        <?php if ( ! empty( $group['subitems'] ) ) : ?>
          <ul class="cert-sublist">
            <?php foreach ( $group['subitems'] as $subitem ) : ?>
              <li class="cert-sublist-item"><?php echo $subitem; ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </section>
    <?php endforeach; ?>
  </div>
</section>
