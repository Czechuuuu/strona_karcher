<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <script defer src="<?php echo get_template_directory_uri(); ?>/assets/js/hamburger.js"></script>
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
      <div class="header-hamburger-wrap">
        <button class="hamburger" id="hamburger-menu" aria-label="Otwórz menu" aria-expanded="false" aria-controls="main-menu">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </button>
        <span class="hamburger-label" id="hamburger-label">Rozwiń menu</span>
      </div>
      <nav>
        <?php
            wp_nav_menu([
              'theme_location' => 'main_menu',
              'container' => false,
              'menu_class' => 'main-menu',
              'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
              'walker' => new class extends Walker_Nav_Menu {
                function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                  if (untrailingslashit($item->url) === untrailingslashit(home_url('/'))) return;
                  parent::start_el($output, $item, $depth, $args, $id);
                }
              }
            ]);
        ?>
      </nav>
    </div>
</header>
