<?php get_header(); ?>

<section class="hero">
    <h1>Wypożyczalnia sprzętu Karcher</h1>
    <p>Profesjonalny sprzęt do sprzątania dostępny od ręki.</p>
</section>

<section class="equipment">
    <?php
    $args = ['post_type' => 'sprzet', 'posts_per_page' => -1];
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/content', 'sprzet');
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>Brak dostępnego sprzętu.</p>';
    endif;
    ?>
</section>

<?php get_footer(); ?>
