<?php

function strona_karcher_enqueue_assets() {
    wp_enqueue_style('strona-karcher-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'strona_karcher_enqueue_assets');