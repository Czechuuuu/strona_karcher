<footer>
  <div class="footer-inner">
    <div class="footer-main">
      <div class="footer-logo-block">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/karcher-logo.png" alt="Karcher" class="footer-logo">
        <span class="footer-brand">Wypożyczalnia Kärcher</span>
      </div>
      <div class="footer-contact highlight">
        <strong>Kontakt:</strong><br>
        <span class="footer-contact-label">Telefon:</span> <a href="tel:123456789" class="footer-contact-link">123 456 789</a><br>
        <span class="footer-contact-label">Email:</span> <a href="mailto:kontakt@karcher-wypozyczalnia.pl" class="footer-contact-link">kontakt@karcher-wypozyczalnia.pl</a>
        <div class="footer-socials">
          <a href="https://facebook.com/" class="footer-social-btn" target="_blank" rel="noopener" title="Facebook">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/fb-custom.png" alt="Facebook" class="footer-social-icon">
          </a>
          <a href="https://instagram.com/" class="footer-social-btn" target="_blank" rel="noopener" title="Instagram">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ig-custom.png" alt="Instagram" class="footer-social-icon">
          </a>
          <a href="https://linkedin.com/" class="footer-social-btn" target="_blank" rel="noopener" title="LinkedIn">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/li-custom.png" alt="LinkedIn" class="footer-social-icon">
          </a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; <?php echo date('Y'); ?> Wypożyczalnia Karcher. Wszelkie prawa zastrzeżone.</p>
      <div class="footer-legal-links">
        <a href="<?php echo get_template_directory_uri(); ?>/assets/polityka-prywatnosci.pdf" download class="footer-legal-link">Polityka prywatności</a> |
        <a href="<?php echo get_template_directory_uri(); ?>/assets/regulamin.pdf" download class="footer-legal-link">Regulamin</a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>