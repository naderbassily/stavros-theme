<?php
/*
Template Name: About Stavros
*/

get_header();
?>

<main class="about-page">
  <section class="about-hero">
    <div class="about-hero-inner">
      <p class="about-eyebrow">// About Stavros</p>
      <h1 class="about-title">Stavros E. Basta</h1>
      <p class="about-subtitle">Cybersecurity Professional, Published Researcher, and ICS Security Specialist</p>
      <div class="about-divider"></div>
      <p class="about-intro">
        Stavros E. Basta is an accomplished cybersecurity professional and published researcher specializing in industrial control systems security and critical infrastructure protection.
      </p>
    </div>
  </section>

  <section class="about-overview">
    <div class="about-overview-main">
      <div class="sec-header">
        <span class="sec-label sec-label-light">// 01 &mdash; Professional Overview</span>
        <span class="sec-line-light"></span>
      </div>
      <h2 class="sec-title-light">Academic Depth.<br/><em>Operational Focus.</em></h2>
      <div class="about-copy">
        <p>
          Holding a Master of Science in Cybersecurity and a Bachelor of Science in Cybersecurity, Basta combines formal academic training with deep practical experience across security leadership, penetration testing, governance, risk, and industrial systems security.
        </p>
        <p>
          His work focuses on the gap between traditional cybersecurity frameworks and the real operating conditions of industrial control systems, operational technology environments, and critical infrastructure. That focus runs through his consulting, authorship, and research.
        </p>
        <p>
          Across 25+ professional certifications, published books, and peer-reviewed research, he brings a perspective grounded in both strategic security leadership and hands-on technical depth.
        </p>
      </div>
    </div>

    <aside class="about-overview-side">
      <div class="about-stat-block">
        <div class="about-stat-label">Education</div>
        <div class="about-stat-value">M.S. Cybersecurity<br/>B.S. Cybersecurity</div>
      </div>
      <div class="about-stat-block">
        <div class="about-stat-label">Credentials</div>
        <div class="about-stat-value">25+ Professional Certifications</div>
      </div>
      <div class="about-stat-block">
        <div class="about-stat-label">Core Focus</div>
        <div class="about-stat-value">ICS Security, Critical Infrastructure, GRC, and Offensive Security</div>
      </div>
    </aside>
  </section>

  <section class="about-focus">
    <div class="sec-header">
      <span class="sec-label sec-label-dark">// 02 &mdash; Focus Areas</span>
      <span class="sec-line-dark"></span>
    </div>
    <h2 class="sec-title-dark">Where Research Meets<br/><em>Real-World Security</em></h2>

    <div class="about-focus-grid">
      <article class="about-focus-card">
        <h3>Industrial Control Systems Security</h3>
        <p>Security strategy and technical analysis for ICS, OT, and critical infrastructure environments where conventional security assumptions often break down.</p>
      </article>
      <article class="about-focus-card">
        <h3>Framework and Compliance Analysis</h3>
        <p>Critical evaluation of standards, controls, and compliance models including where they fail to address operational technology risk in practice.</p>
      </article>
      <article class="about-focus-card">
        <h3>Penetration Testing and Adversarial Thinking</h3>
        <p>Offensive security experience applied to enterprise and industrial environments to expose gaps before adversaries do.</p>
      </article>
      <article class="about-focus-card">
        <h3>Leadership and Security Education</h3>
        <p>Bridging technical depth with executive clarity through writing, research, speaking, and strategic cybersecurity guidance.</p>
      </article>
    </div>
  </section>

  <section class="about-publications">
    <div class="about-publications-copy">
      <div class="sec-header" style="margin-bottom:20px;">
        <span class="sec-label sec-label-light">// 03 &mdash; Publications</span>
      </div>
      <h2 class="sec-title-light">Books, Research,<br/><em>and Applied Insight</em></h2>
      <p class="about-publications-body">
        Basta's publication record spans books and research focused on cybersecurity mathematics, industrial control systems, cryptography, governance, compliance, and leadership. His work consistently addresses the disconnect between theory, standards, and the operational realities organizations face.
      </p>
    </div>

    <div class="about-publications-list">
      <div class="about-pub-item">
        <span class="about-pub-num">01</span>
        <div>
          <div class="about-pub-title">Books on ICS Security, Cryptography, GRC, and Leadership</div>
          <div class="about-pub-meta">Published author across technical and strategic cybersecurity topics</div>
        </div>
      </div>
      <div class="about-pub-item">
        <span class="about-pub-num">02</span>
        <div>
          <div class="about-pub-title">Research on ICS Vulnerabilities and Framework Limitations</div>
          <div class="about-pub-meta">Focused on operational risk, compliance gaps, and critical infrastructure resilience</div>
        </div>
      </div>
      <div class="about-pub-item">
        <span class="about-pub-num">03</span>
        <div>
          <div class="about-pub-title">Applied Security Writing for Practitioners and Decision Makers</div>
          <div class="about-pub-meta">Translating complex security concepts into usable guidance</div>
        </div>
      </div>
    </div>
  </section>

  <section class="about-page-cta">
    <div class="about-page-cta-inner">
      <p class="about-page-cta-label">// Connect</p>
      <h2>For speaking, consulting, research collaboration, and advisory work.</h2>
      <a href="<?php echo esc_url( stavros_contact_url() ); ?>" class="btn-primary-light">Contact Stavros</a>
    </div>
  </section>
</main>

<?php get_footer(); ?>
