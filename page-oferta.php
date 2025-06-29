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
    'oferta-css',
    get_template_directory_uri() . '/assets/css/oferta.css',
    ['strona-karcher-global','strona-karcher-header','strona-karcher-footer'],
    null
);
?>

<?php
$categories = [
    'all' => [
        'name' => 'Wszystkie',
        'img' => get_template_directory_uri() . '/assets/images/all.png',
    ],
    'myjka' => [
        'name' => 'Myjki Ciśnieniowe',
        'img' => get_template_directory_uri() . '/assets/images/myjka.jpg',
    ],
    'odkurzaczU' => [
        'name' => 'Odkurzacze Uniwersalne',
        'img' => get_template_directory_uri() . '/assets/images/odkurzaczU.jpg',
    ],
    'oczyszczacz' => [
        'name' => 'Oczyszczacze Powietrza',
        'img' => get_template_directory_uri() . '/assets/images/oczyszczacz.jpg',
    ],
    'odkurzaczP' => [
        'name' => 'Odkurzacze Piorące',
        'img' => get_template_directory_uri() . '/assets/images/odkurzaczP.jpg',
    ],
    'dmuchawa' => [
        'name' => 'Dmuchawy do Liści',
        'img' => get_template_directory_uri() . '/assets/images/dmuchawa.jpg',
    ],
    'kosiarka' => [
        'name' => 'Kosiarki Akumulatorowe',
        'img' => get_template_directory_uri() . '/assets/images/kosiarka.jpg',
    ],
    'podkaszarka' => [
        'name' => 'Podkaszarki Akumulatorowe',
        'img' => get_template_directory_uri() . '/assets/images/podkaszarka.jpg',
    ],
    'nozyce' => [
        'name' => 'Akumulatorowe Nożyce do Żywopłotu',
        'img' => get_template_directory_uri() . '/assets/images/nozyce.jpg',
    ],
];

$args = [
    'post_type' => 'sprzet',
    'posts_per_page' => -1,
];
$query = new WP_Query($args);
$posts = $query->have_posts() ? $query->posts : [];

$groups = [];
$groups['all'] = $posts;
foreach ($posts as $post) {
    $cat = get_field('typ_sprzetu', $post->ID);
    if (!$cat) continue;
    if (!isset($groups[$cat])) $groups[$cat] = [];
    $groups[$cat][] = $post;
}

get_header(); ?>

<section class="hero oferta-hero">
    <h1 class="oferta-title">
      <span class="oferta-icon">🛠️</span> Oferta <span class="oferta-underline"></span>
    </h1>
    <p class="oferta-desc">Sprawdź dostępny sprzęt do wypożyczenia.</p>
    <span class="oferta-highlight">Wybierz kategorię lub zobacz całą ofertę!</span>
    <div class="category-list">
      <?php foreach ($categories as $slug => $cat): if (empty($groups[$slug])) continue; ?>
        <div class="category-tile<?php echo $slug === 'all' ? ' active' : ''; ?>" data-category="<?php echo esc_attr($slug); ?>">
          <img src="<?php echo esc_url($cat['img']); ?>" alt="<?php echo esc_attr($cat['name']); ?>">
          <div class="name"><?php echo esc_html($cat['name']); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
</section>

<div class="category-current">
  <span id="current-category-label">
    <?php
    foreach ($categories as $slug => $cat) {
      if ($slug === 'all') {
        echo esc_html($cat['name']);
        break;
      }
    }
    ?>
  </span>
</div>

<div id="oferta-kategorie">
<?php
$first = true;
foreach ($categories as $slug => $cat) {
    if (empty($groups[$slug])) continue;
    $display = $slug === 'all' ? '' : ' style="display:none"';
    echo '<section class="equipment-group" data-category="' . esc_attr($slug) . '"' . $display . '>';
    echo '<div class="equipment">';
    usort($groups[$slug], function($a, $b) {
        $cenaA = floatval(get_field('cena_za_dzien', $a->ID));
        $cenaB = floatval(get_field('cena_za_dzien', $b->ID));
        return $cenaB <=> $cenaA;
    });
    foreach ($groups[$slug] as $post) {
        setup_postdata($post);
        get_template_part('template-parts/content', 'sprzet');
    }
    echo '</div>';
    echo '</section>';
}
wp_reset_postdata();
?>
</div>

<?php
wp_enqueue_script('equipment-animations', get_template_directory_uri() . '/assets/js/equipment-animations.js', [], null, true);
wp_enqueue_script('oferta-category', get_template_directory_uri() . '/assets/js/oferta-category.js', [], null, true);
?>

<?php get_footer(); ?>

<?php
?>
