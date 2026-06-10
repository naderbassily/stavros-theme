<footer>
  <span class="footer-logo">S.E. Basta</span>
  <span class="footer-copy">&copy; <?php echo date('Y'); ?> Stavros E. Basta. All rights reserved.</span>
  <ul class="footer-links">
    <li><a href="<?php echo esc_url( stavros_section_url( 'certifications' ) ); ?>">Credentials</a></li>
    <li><a href="<?php echo esc_url( stavros_section_url( 'research' ) ); ?>">Research</a></li>
    <li><a href="<?php echo esc_url( get_post_type_archive_link( 'book' ) ?: stavros_section_url( 'books' ) ); ?>">Books</a></li>
    <li><a href="<?php echo esc_url( stavros_contact_url() ); ?>">Contact</a></li>
  </ul>
</footer>

<?php wp_footer(); ?>
</body>
</html>
