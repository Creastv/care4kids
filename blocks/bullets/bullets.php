<?php
$class_name = 'bullets-container';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
$bullets_columns = get_field('bullets_col');
if ($bullets_columns == 1) {
    $class_name .= ' bullets-columns-3';
} elseif ($bullets_columns == 2) {
    $class_name .= ' bullets-columns-4';
} elseif ($bullets_columns == 3) {
    $class_name .= ' bullets-columns-5';
}
$bullets_display = get_field('bullets_display') ?: '1';
$style = get_field('style');

// Jeśli wybrano slider, wymuś style-2
if ((string) $bullets_display === '2') {
    $style = '2';
    $class_name .= ' style-2';
} elseif ($style == '1') {
    $class_name .= ' style-1';
} elseif ($style == '2') {
    $class_name .= ' style-2';
} else {
    $class_name .= ' style-2';
}

if (!function_exists('care4kids_render_bullet_item')) {
    function care4kids_render_bullet_item($style)
    {
        $icon = get_sub_field('ikona');
        $title = get_sub_field('tutul');
        $description = get_sub_field('opis');
?>
<div class="bullet-item">
    <?php if ($icon): ?>
    <div class="bullet-icon">
        <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
    </div>
    <?php endif; ?>

    <?php if ($style == '1'): ?>
    <div class="bullet-content">
        <?php endif; ?>

        <?php if ($title): ?>
        <h3 class="bullet-title"><?php echo $title; ?></h3>
        <?php endif; ?>

        <?php if ($description): ?>
        <p class="bullet-description"><?php echo $description; ?></p>
        <?php endif; ?>

        <?php if ($style == '1'): ?>
    </div>
    <?php endif; ?>
</div>
<?php
    }
}
?>
<?php if (have_rows('bullets')): ?>
<?php if ((string) $bullets_display === '2'): ?>
<div class="<?php echo esc_attr($class_name . ' bullets-carousel'); ?>" data-bullets-display="carousel">
    <div class="swiper bullets-swiper">
        <div class="swiper-wrapper">
            <?php while (have_rows('bullets')): the_row(); ?>
            <div class="swiper-slide">
                <?php care4kids_render_bullet_item($style); ?>
            </div>
            <?php endwhile; ?>
        </div>


    </div>

    <div class="bullets-swiper__pagination">
        <div class="swiper-pagination"></div>
    </div>
    <div class="bullets-swiper__controls">
        <button class="swiper-button-prev" type="button"
            aria-label="<?php esc_attr_e('Poprzedni slajd', 'care4kids'); ?>"></button>
        <button class="swiper-button-next" type="button"
            aria-label="<?php esc_attr_e('Następny slajd', 'care4kids'); ?>"></button>
    </div>
</div>
<?php else: ?>
<div class="<?php echo esc_attr($class_name); ?>">
    <?php while (have_rows('bullets')): the_row(); ?>
    <?php care4kids_render_bullet_item($style); ?>
    <?php endwhile; ?>
</div>
<?php endif; ?>
<?php endif; ?>