<?php get_header(); ?>

<!-- ── HERO ──────────────────────────────────────────────── -->
<section class="hero">
  <div class="hero-content">
    <p class="hero-eyebrow">// ICS Security &amp; Critical Infrastructure</p>
    <h1 class="hero-name">
      Stavros<br/>E. Basta
      <em>ICS Security Specialist</em>
    </h1>
    <div class="hero-divider"></div>
    <p class="hero-bio">
      Cybersecurity leader, published author, and researcher focused on industrial control systems, critical infrastructure resilience, and the places where conventional security frameworks break down in operational technology environments.
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

<!-- ── CONTACT ───────────────────────────────────────────── -->
<?php get_template_part('template-parts/contact'); ?>

<?php get_footer(); ?>
