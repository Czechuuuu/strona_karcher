<?php
wp_enqueue_style(
    'strona-karcher-global',
    get_template_directory_uri() . '/assets/css/global.css',
    [],
    null
);
wp_enqueue_style(
    'strona-karcher-header',
    get_template_directory_uri() . '/assets/css/header.css',
    ['strona-karcher-global'],
    null
);
wp_enqueue_style(
    'strona-karcher-footer',
    get_template_directory_uri() . '/assets/css/footer.css',
    ['strona-karcher-global'],
    null
);
wp_enqueue_style(
    'rezerwacja-css',
    get_template_directory_uri() . '/assets/css/rezerwacja.css',
    ['strona-karcher-global','strona-karcher-header','strona-karcher-footer'],
    null
);
?>

<?php
get_header(); ?>

<section class="reservation-section">
  <h1 class="reservation-title">Zarezerwuj sprzęt online</h1>
  <div class="reservation-flex">
    <div class="reservation-form-box">
      <p class="reservation-desc">Wypełnij krótki formularz, a skontaktujemy się z Tobą w celu potwierdzenia rezerwacji.</p>
      <form class="reservation-form" method="post" action="">
        <div class="reservation-row">
          <label for="res-name">Imię i nazwisko*</label>
          <input type="text" id="res-name" name="res-name" required>
        </div>
        <div class="reservation-row">
          <label for="res-phone">Telefon*</label>
          <input type="tel" id="res-phone" name="res-phone" required pattern="[0-9\s\-]+">
        </div>
        <div class="reservation-row">
          <label for="res-email">Email</label>
          <input type="email" id="res-email" name="res-email">
        </div>
        <div class="reservation-row">
          <label for="res-message">Wiadomość / sprzęt do rezerwacji*</label>
          <textarea id="res-message" name="res-message" rows="4" required></textarea>
        </div>
        <button type="submit" class="button cta">Wyślij rezerwację</button>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['res-name'], $_POST['res-phone'], $_POST['res-message'])): ?>
          <div class="reservation-success">Dziękujemy za zgłoszenie! Skontaktujemy się z Tobą wkrótce.</div>
        <?php endif; ?>
      </form>
    </div>
    <div class="reservation-info-box">
      <div class="reservation-info-title">Wypożyczalnia sprzętu Kärcher</div>
      <div class="reservation-info-phone"><strong>123 456 789</strong></div>
      <div class="reservation-info-company">Profesjonalny sprzęt do czyszczenia</div>
      <div class="reservation-info-address">ul. Przemysłowa 7, 80-200 Gdańsk</div>
      <div class="reservation-info-email"><span>Email</span><br><a href="mailto:kontakt@karcher-wypozyczalnia.pl">kontakt@karcher-wypozyczalnia.pl</a></div>
      <div class="reservation-info-area-title">Obsługujemy Trójmiasto i okolice</div>
      <div class="reservation-info-area-desc">Dostarczamy sprzęt na terenie Gdańska, Gdyni, Sopotu oraz okolicznych miejscowości. Skontaktuj się, aby ustalić szczegóły!</div>
    </div>
  </div>
</section>

<div class="map-container">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2754.6029029457745!2d18.659061177019627!3d54.406234294894844!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46fd0ca87b90260f%3A0x7335dd8bfb4c64ad!2sPrzemys%C5%82owa%207%2C%2080-001%20Gda%C5%84sk!5e1!3m2!1spl!2spl!4v1751311533662!5m2!1spl!2spl" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<?php get_footer(); ?>