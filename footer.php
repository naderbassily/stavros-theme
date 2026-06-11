<footer>
  <div class="footer-brand">
    <a href="<?php echo esc_url( home_url('/') ); ?>" class="footer-logo" aria-label="<?php esc_attr_e( 'Stavros E. Basta — Home', 'stavros-basta' ); ?>">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="Stavros E. Basta" class="footer-logo-img" width="180" height="52" />
    </a>
    <span class="footer-copy">&copy; <?php echo date('Y'); ?> Stavros E. Basta. All rights reserved.</span>
  </div>
  <?php
  $footer_menu = wp_get_nav_menu_object( 'Footer Menu' );

  wp_nav_menu(
    [
      'theme_location' => 'footer',
      'menu'           => $footer_menu ? $footer_menu->term_id : 'Footer Menu',
      'container'      => false,
      'menu_class'     => 'footer-links',
      'fallback_cb'    => false,
    ]
  );
  ?>
  <a href="https://www.linkedin.com/in/stavros-basta-201028357/?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3BaMek6%2FuUThqEzFNZQiMXEA%3D%3D" class="footer-social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'LinkedIn', 'stavros-basta' ); ?>">
    <svg class="footer-social-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
      <path fill="currentColor" d="M4.98 3.5C4.98 4.88 3.86 6 2.48 6S0 4.88 0 3.5 1.12 1 2.48 1s2.5 1.12 2.5 2.5ZM.5 8h4V23h-4V8Zm7 0h3.83v2.05h.06c.53-1.01 1.84-2.08 3.79-2.08 4.05 0 4.8 2.67 4.8 6.14V23h-4v-7.86c0-1.88-.03-4.29-2.62-4.29-2.62 0-3.02 2.05-3.02 4.16V23h-4V8Z"/>
    </svg>
  </a>
</footer>

<?php wp_footer(); ?>
</body>
</html>
