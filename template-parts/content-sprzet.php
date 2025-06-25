<div class="equipment-item">
    <?php if (has_post_thumbnail()) : ?>
        <div class="image">
            <?php the_post_thumbnail('medium'); ?>
        </div>
    <?php endif; ?>

    <h3><?php the_title(); ?></h3>
    <div class="description"><?php the_content(); ?></div>
    <div style="margin-top:auto;">
        <?php if (function_exists('get_field')): ?>
        <?php $cena = get_field('cena_za_dzien'); ?>
        <?php if ($cena): ?>
        <p class="price">Cena: <?php echo esc_html($cena); ?> zł / dzień</p>
        <?php endif; ?>
        <?php endif; ?>
        <a href="tel:123456789" class="button">Zadzwoń i wypożycz</a>
    </div>
</div>
