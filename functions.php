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