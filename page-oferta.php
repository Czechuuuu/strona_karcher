<?php
get_header(); ?>

<section class="hero">
    <h1>Oferta</h1>
    <p>Sprawdź dostępny sprzęt do wypożyczenia.</p>
</section>

<section class="equipment">
    <?php
    $args = [
        'post_type' => 'sprzet',
        'posts_per_page' => -1,
        'meta_key' => 'typ_sprzetu',
        'orderby' => 'meta_value',
        'order' => 'ASC',
    ];
    $query = new WP_Query($args);
    $posts = $query->have_posts() ? $query->posts : [];
    usort($posts, function($a, $b) {
        $typA = get_field('typ_sprzetu', $a->ID);
        $typB = get_field('typ_sprzetu', $b->ID);
        if ($typA === $typB) {
            $cenaA = floatval(get_field('cena_za_dzien', $a->ID));
            $cenaB = floatval(get_field('cena_za_dzien', $b->ID));
            return $cenaB <=> $cenaA;
        }
        return strcmp($typA, $typB);
    });
    if (!empty($posts)) :
        foreach ($posts as $post) :
            setup_postdata($post);
            get_template_part('template-parts/content', 'sprzet');
        endforeach;
        wp_reset_postdata();
    else :
        echo '<p>Brak dostępnego sprzętu.</p>';
    endif;
    ?>
</section>

<?php get_footer(); ?>
