<?php
function strona_karcher_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus([
        'main_menu' => __('Main Menu', 'strona_karcher'),
    ]);
}
add_action('after_setup_theme', 'strona_karcher_setup');

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('strona-karcher-style', get_stylesheet_uri(), [], null);
});

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
    $columns['typ_sprzetu'] = 'Typ sprzętu';
    $columns['cena_za_dzien'] = 'Cena za dzień';
    return $columns;
});

add_action('manage_sprzet_posts_custom_column', function($column, $post_id) {
    if ($column === 'typ_sprzetu') {
        $typ_sprzetu = get_field('typ_sprzetu', $post_id);
        if ($typ_sprzetu && is_array($typ_sprzetu)) {
            echo esc_html(implode(', ', $typ_sprzetu));
        } else {
            echo $typ_sprzetu ? esc_html($typ_sprzetu) : '-';
        }
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

add_action('admin_menu', function() {
    add_menu_page(
        'Opinie klientów',
        'Opinie klientów',
        'manage_options',
        'karcher_reviews_admin',
        'karcher_reviews_admin_page',
        'dashicons-star-filled',
        25
    );
});

function karcher_reviews_admin_page() {
    global $wpdb;
    if (isset($_GET['delete_review']) && current_user_can('manage_options')) {
        $id = intval($_GET['delete_review']);
        $wpdb->delete($wpdb->prefix . 'karcher_reviews', ['id' => $id]);
        echo '<div class="updated notice"><p>Opinia została usunięta.</p></div>';
    }
    $reviews = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}karcher_reviews ORDER BY created_at DESC");
    echo '<div class="wrap"><h1>Opinie klientów</h1>';
    if ($reviews) {
        echo '<table class="widefat fixed striped"><thead><tr><th>Imię</th><th>Sprzęt</th><th>Ocena</th><th>Opinia</th><th>Data</th><th>Akcje</th></tr></thead><tbody>';
        foreach ($reviews as $review) {
            echo '<tr>';
            echo '<td>' . esc_html($review->name) . '</td>';
            echo '<td>' . esc_html($review->equipment) . '</td>';
            echo '<td style="color:#ffe600;font-weight:900;">' . str_repeat('★', intval($review->stars)) . str_repeat('☆', 5-intval($review->stars)) . '</td>';
            echo '<td>' . esc_html($review->text) . '</td>';
            echo '<td>' . date('d.m.Y H:i', strtotime($review->created_at)) . '</td>';
            echo '<td><a href="' . admin_url('admin.php?page=karcher_reviews_admin&delete_review=' . intval($review->id)) . '" onclick="return confirm(\'Na pewno usunąć tę opinię?\');" class="button button-small">Usuń</a></td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>Brak opinii do wyświetlenia.</p>';
    }
    echo '</div>';
}