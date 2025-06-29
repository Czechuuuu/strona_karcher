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
    'opinie-css',
    get_template_directory_uri() . '/assets/css/opinie.css',
    ['strona-karcher-global','strona-karcher-header','strona-karcher-footer'],
    null
);
?>  

<?php
global $wpdb;
get_header();

$success = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review_name'], $_POST['review_text'], $_POST['review_equipment'], $_POST['review_stars'])) {
    $name = sanitize_text_field($_POST['review_name']);
    $text = sanitize_textarea_field($_POST['review_text']);
    $equipment = sanitize_text_field($_POST['review_equipment']);
    $stars = intval($_POST['review_stars']);
    if ($name && $text && $equipment && $stars >= 1 && $stars <= 5) {
        $wpdb->insert(
            $wpdb->prefix . 'karcher_reviews',
            [
                'name' => $name,
                'text' => $text,
                'equipment' => $equipment,
                'stars' => $stars,
                'created_at' => current_time('mysql', 1)
            ]
        );
        $success = true;
    } else {
        $error = 'Wypełnij wszystkie pola i wybierz ilość gwiazdek.';
    }
}

$equipment_options = [];
$equipment_query = new WP_Query([
    'post_type' => 'sprzet',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
]);
if ($equipment_query->have_posts()) {
    while ($equipment_query->have_posts()) {
        $equipment_query->the_post();
        $equipment_options[] = get_the_title();
    }
    wp_reset_postdata();
}

$reviews = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}karcher_reviews ORDER BY created_at DESC LIMIT 20");
?>

<section class="reviews-section">
  <h1 class="reviews-title">Opinie klientów</h1>
  <div class="review-form-section">
    <h2>Dodaj swoją opinię</h2>
    <?php if ($success): ?>
      <div class="review-success">Dziękujemy za opinię!</div>
    <?php elseif ($error): ?>
      <div class="review-error"><?php echo esc_html($error); ?></div>
    <?php endif; ?>
    <form class="review-form" method="post" action="">
      <div class="review-row">
        <label for="review_name">Imię*</label>
        <input type="text" id="review_name" name="review_name" required>
      </div>
      <div class="review-row">
        <label for="review_equipment">Wypożyczony sprzęt*</label>
        <select id="review_equipment" name="review_equipment" required>
          <option value="">-- Wybierz --</option>
          <?php foreach ($equipment_options as $eq): ?>
            <option value="<?php echo esc_attr($eq); ?>"><?php echo esc_html($eq); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="review-row">
        <label for="review_stars">Ocena*</label>
        <select id="review_stars" name="review_stars" required>
          <option value="">-- Wybierz --</option>
          <option value="5">★★★★★</option>
          <option value="4">★★★★☆</option>
          <option value="3">★★★☆☆</option>
          <option value="2">★★☆☆☆</option>
          <option value="1">★☆☆☆☆</option>
        </select>
      </div>
      <div class="review-row">
        <label for="review_text">Opinia*</label>
        <textarea id="review_text" name="review_text" rows="4" required></textarea>
      </div>
      <button type="submit" class="button cta">Wyślij opinię</button>
    </form>
  </div>

  <?php if ($reviews): ?>
    <div class="reviews-list">
      <?php foreach ($reviews as $review): ?>
        <div class="review-item">
          <div class="review-header">
            <span class="review-name"><?php echo esc_html($review->name); ?></span>
            <span class="review-stars"><?php echo str_repeat('★', intval($review->stars)) . str_repeat('☆', 5-intval($review->stars)); ?></span>
          </div>
          <div class="review-equipment"><?php echo esc_html($review->equipment); ?></div>
          <div class="review-text"><?php echo esc_html($review->text); ?></div>
          <div class="review-date"><?php echo date('d.m.Y H:i', strtotime($review->created_at)); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p style="text-align:center; color:#bdbdbd; margin-top:12px;">Brak opinii do wyświetlenia.</p>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
