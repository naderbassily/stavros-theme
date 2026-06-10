<?php get_header(); ?>

<!-- ── HERO ──────────────────────────────────────────────── -->
<section class="hero">
  <div class="hero-content">
    <p class="hero-eyebrow">// Cybersecurity Expert &amp; Published Author</p>
    <h1 class="hero-name">
      Stavros<br/>E. Basta
      <em>ICS Security Specialist</em>
    </h1>
    <div class="hero-divider"></div>
    <p class="hero-bio">
      Stavros E. Basta is an accomplished cybersecurity professional and published researcher specializing in industrial control systems security, critical infrastructure protection, and the limits of traditional security frameworks in operational technology environments.
    </p>
    <div class="hero-actions">
      <a href="#books" class="btn-primary-light">View Publications</a>
    </div>
  </div>
  <div class="scroll-hint">
    <span class="scroll-hint-line"></span>
    Scroll to explore
  </div>
</section>

<!-- ── EXPERTISE ─────────────────────────────────────────── -->
<?php get_template_part('template-parts/expertise'); ?>

<!-- ── BOOKS ─────────────────────────────────────────────── -->
<?php get_template_part('template-parts/books'); ?>

<!-- ── RESEARCH ──────────────────────────────────────────── -->
<?php get_template_part('template-parts/research'); ?>

<!-- ── COMING SOON ───────────────────────────────────────── -->
<?php get_template_part('template-parts/coming-soon'); ?>

<!-- ── CERTIFICATIONS ────────────────────────────────────── -->
<?php get_template_part('template-parts/certifications'); ?>

<!-- ── CONTACT ───────────────────────────────────────────── -->
<?php get_template_part('template-parts/contact'); ?>

<?php get_footer(); ?>
