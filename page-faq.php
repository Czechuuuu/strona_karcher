<?php
// Dodanie ładowania dedykowanego CSS tylko na stronie FAQ
add_action('wp_enqueue_scripts', function() {
  if (is_page_template('page-faq.php') || is_page('faq')) {
    wp_enqueue_style('faq-css', get_template_directory_uri() . '/assets/css/faq.css', [], null);
  }
});
?>

<?php get_header(); ?>

<section class="faq-section">
  <h1 class="faq-title">Najczęściej zadawane pytania (FAQ)</h1>
  <div class="faq-list">
    <div class="faq-item">
      <button class="faq-question">Jak mogę zarezerwować sprzęt?</button>
      <div class="faq-answer">Możesz zarezerwować sprzęt online przez formularz na stronie lub telefonicznie.</div>
    </div>
    <div class="faq-item">
      <button class="faq-question">Czy muszę wpłacić kaucję?</button>
      <div class="faq-answer">Tak, pobieramy zwrotną kaucję, której wysokość zależy od rodzaju sprzętu.</div>
    </div>
    <div class="faq-item">
      <button class="faq-question">Jakie są godziny odbioru i zwrotu?</button>
      <div class="faq-answer">Odbiór i zwrot sprzętu możliwy jest w elastycznych godzinach po wcześniejszym ustaleniu.</div>
    </div>
    <div class="faq-item">
      <button class="faq-question">Czy sprzęt jest ubezpieczony?</button>
      <div class="faq-answer">Tak, cały nasz sprzęt jest ubezpieczony na czas wypożyczenia.</div>
    </div>
    <div class="faq-item">
      <button class="faq-question">Czy mogę przedłużyć wypożyczenie?</button>
      <div class="faq-answer">Tak, wystarczy skontaktować się z nami telefonicznie lub mailowo.</div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
