<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <h2><a href="<?php echo home_url(); ?>" style="color:white; text-decoration:none;">Wypożyczalnia Karcher</a></h2>
    <?php
        wp_nav_menu([
            'theme_location' => 'main_menu',
            'container' => false,
            'menu_class' => 'main-menu',
        ]);
    ?>
</header>
