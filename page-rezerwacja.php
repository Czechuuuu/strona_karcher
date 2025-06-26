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

<?php get_footer(); ?>
