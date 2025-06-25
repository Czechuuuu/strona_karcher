<?php
function strona_karcher_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus([
        'main_menu' => __('Main Menu', 'strona_karcher'),
    ]);
}
add_action('after_setup_theme', 'strona_karcher_setup');

function strona_karcher_enqueue_styles() {
    wp_enqueue_style('strona_karcher-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'strona_karcher_enqueue_styles');

function strona_karcher_register_post_type() {
    register_post_type('sprzet', [
        'labels' => [
            'name' => 'Sprzęt',
            'singular_name' => 'Sprzęt',
            'add_new_item' => 'Dodaj nowy sprzęt',
            'edit_item' => 'Edytuj sprzęt',
        ],
        'public' => true,
        'has_archive' => false,
        'rewrite' => ['slug' => 'sprzet'],
        'menu_icon' => 'dashicons-hammer',
        'supports' => ['title', 'editor', 'thumbnail'],
    ]);
}
add_action('init', 'strona_karcher_register_post_type');

add_filter('manage_sprzet_posts_columns', function($columns) {
    $columns['typ_sprzetu'] = 'Klasa';
    $columns['cena_za_dzien'] = 'Cena za dzień';
    return $columns;
});

add_action('manage_sprzet_posts_custom_column', function($column, $post_id) {
    if ($column === 'typ_sprzetu') {
        $typ_sprzetu = get_field('typ_sprzetu', $post_id);
        echo $typ_sprzetu ? esc_html($typ_sprzetu) : '-';
    }
    if ($column === 'cena_za_dzien') {
        $cena = get_field('cena_za_dzien', $post_id);
        echo $cena ? esc_html($cena) . ' zł' : '-';
    }
}, 10, 2);

add_filter('manage_edit-sprzet_sortable_columns', function($columns) {
    $columns['typ_sprzetu'] = 'typ_sprzetu';
    $columns['cena_za_dzien'] = 'cena_za_dzien';
    return $columns;
});

add_action('pre_get_posts', function($query) {
    if (!is_admin() || !$query->is_main_query()) return;
    if ($query->get('post_type') === 'sprzet') {
        if ($query->get('orderby') === 'typ_sprzetu') {
            $query->set('meta_key', 'typ_sprzetu');
            $query->set('orderby', 'meta_value');
        }
        if ($query->get('orderby') === 'cena_za_dzien') {
            $query->set('meta_key', 'cena_za_dzien');
            $query->set('orderby', 'meta_value_num');
        }
    }
});