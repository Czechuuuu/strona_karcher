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
    'front-page-css',
    get_template_directory_uri() . '/assets/css/front-page.css',
    ['strona-karcher-global','strona-karcher-header','strona-karcher-footer'],
    null
);
?>

<?php get_header(); ?>

<section class="hero">
    <h1>Wypożyczalnia sprzętu Kärcher</h1>
    <p>Profesjonalny sprzęt do sprzątania czy ogrodu dostępny od ręki.</p>
    <div class="cta-buttons">
        <?php
        $oferta_page = get_page_by_path('oferta');
        $oferta_url = $oferta_page ? get_permalink($oferta_page->ID) : '#';
        $rezerwacja_page = get_page_by_path('rezerwacja');
        $rezerwacja_url = $rezerwacja_page ? get_permalink($rezerwacja_page->ID) : '#';
        ?>
        <a href="<?php echo esc_url($oferta_url); ?>" class="button cta">Zobacz ofertę</a>
        <a href="<?php echo esc_url($rezerwacja_url); ?>" class="button cta">Zarezerwuj online</a>
    </div>
</section>

<section class="why-us">
    <h2>O nas</h2>
    <div class="about-us-main">
        <div class="about-us-text">
            <p><strong>Jesteśmy lokalną wypożyczalnią sprzętu Kärcher</strong> z wieloletnim doświadczeniem. Naszą misją jest udostępnianie profesjonalnych urządzeń do sprzątania i pielęgnacji ogrodu każdemu – szybko, wygodnie i w przystępnej cenie.</p>
            <ul class="about-values">
                <li><span class="about-icon">✔️</span> Indywidualne podejście do klienta</li>
                <li><span class="about-icon">✔️</span> Sprzęt zawsze sprawny i gotowy do pracy</li>
                <li><span class="about-icon">✔️</span> Doradztwo i wsparcie techniczne</li>
                <li><span class="about-icon">✔️</span> Elastyczne godziny odbioru i zwrotu</li>
            </ul>
            <p>Zapraszamy do naszej wypożyczalni, gdzie znajdziesz wszystko, czego potrzebujesz do skutecznego sprzątania i pielęgnacji ogrodu. Nasz zespół chętnie pomoże Ci dobrać odpowiedni sprzęt i odpowie na wszystkie pytania.</p>
            <p>Skontaktuj się z nami telefonicznie lub mailowo, a  my pomożemy Ci w każdej kwestii związanej z wypożyczeniem sprzętu.</p>
        </div>
        <div class="about-us-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-us.jpg" alt="O nas" style="max-width:100%; border-radius:14px; box-shadow:0 2px 16px #009fe344;">
        </div>
    </div>
</section>

<section class="how-it-works-section">
  <h2 class="how-it-works-title">Jak to działa?</h2>
  <div class="how-it-works-steps">
    <div class="how-step">
      <div class="how-step-number">1</div>
      <div class="how-step-content">
        <strong>Wybierz sprzęt</strong>
        <p>Przejrzyj ofertę i wybierz urządzenie dopasowane do Twoich potrzeb.</p>
      </div>
    </div>
    <div class="how-step">
      <div class="how-step-number">2</div>
      <div class="how-step-content">
        <strong>Zarezerwuj online lub telefonicznie</strong>
        <p>Wypełnij formularz rezerwacji lub zadzwoń do nas, by zarezerwować sprzęt.</p>
      </div>
    </div>
    <div class="how-step">
      <div class="how-step-number">3</div>
      <div class="how-step-content">
        <strong>Odbierz i korzystaj</strong>
        <p>Odbierz sprzęt w ustalonym terminie i ciesz się profesjonalnym wsparciem.</p>
      </div>
    </div>
  </div>
</section>

<section class="popular-equipment">
    <h2>Najpopularniejszy sprzęt</h2>
    <div class="equipment equipment-home">
        <?php
        $popular = new WP_Query([
            'post_type' => 'sprzet',
            'posts_per_page' => 3,
            'orderby' => 'meta_value_num',
            'meta_key' => 'cena_za_dzien',
            'order' => 'DESC',
        ]);
        if ($popular->have_posts()):
            while ($popular->have_posts()): $popular->the_post();
                get_template_part('template-parts/content', 'sprzet');
            endwhile;
            wp_reset_postdata();
        else:
            echo '<p>Brak sprzętu do wyświetlenia.</p>';
        endif;
        ?>
    </div>
</section>

<p class="slogan"><strong>Wypożyczalnia Kärcher – Twój partner w czystości i porządku!</strong></p>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/equipment-animations.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const homeEquipment = document.querySelectorAll('.equipment-home .equipment-item');
  if(homeEquipment.length > 0 && window.animateEquipmentItems) {
    window.animateEquipmentItems(homeEquipment);
  }
});
</script>

<?php get_footer(); ?>
