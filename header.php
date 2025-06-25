<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <div class="header-inner">
      <div class="header-logo">
        <a href="<?php echo home_url(); ?>" style="color:white; text-decoration:none; display:flex; align-items:center; gap:12px;">
          <span class="logo-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/karcher-logo.png" alt="Karcher" class="logo-img">
          </span>
          <span class="logo-text">Wypożyczalnia Kärcher</span>
        </a>
      </div>
      <nav>
        <?php
            wp_nav_menu([
                'theme_location' => 'main_menu',
                'container' => false,
                'menu_class' => 'main-menu',
            ]);
        ?>
      </nav>
    </div>
</header>
