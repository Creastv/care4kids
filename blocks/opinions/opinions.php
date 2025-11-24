<?php
$class_name = 'b-opinions';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '"';
}

$opinions = get_field('opinions');

if (empty($opinions)) {
    if (is_admin()) {
        echo '<p>' . esc_html__('Dodaj przynajmniej jedną opinię, aby wyświetlić blok "Opinions".', 'care4kids') . '</p>';
    }
    return;
}
?>

<section class="<?php echo esc_attr($class_name); ?>" <?php echo $anchor; ?>>
    <div class="container">
        <div class="b-opinions__carousel">
            <div class="swiper b-opinions-swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($opinions as $opinion): ?>
                    <?php
                        $img_id = $opinion['img'] ?? '';
                        $title = $opinion['title'] ?? [];
                        $name = $title['name'] ?? '';
                        $name_desc = $title['name_desc'] ?? '';
                        $pakiet = $title['pakiet'] ?? '';
                        $date = $title['date'] ?? '';
                        $stars = $opinion['stars'] ?? 5;
                        $opinion_text = $opinion['opinion'] ?? '';
                        ?>
                    <div class="swiper-slide">
                        <article class="b-opinions__item">


                            <div class="b-opinions__content">
                                <?php if ($name || $name_desc || $pakiet || $date): ?>

                                <div class="b-opinions__header">
                                    <?php if ($img_id): ?>
                                    <div class="b-opinions__img">
                                        <?php echo wp_get_attachment_image($img_id, 'medium', false, ['class' => 'b-opinions__img-el']); ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="b-opinions__info">
                                        <?php if ($name): ?>
                                        <p class="b-opinions__name"><?php echo esc_html($name); ?>
                                            <?php if ($name_desc): ?>
                                            <small
                                                class="b-opinions__name-desc"><?php echo esc_html($name_desc); ?></small>
                                            <?php endif; ?>
                                        </p>
                                        <?php endif; ?>



                                        <?php if ($pakiet): ?>
                                        <span class="b-opinions__pakiet"><?php echo esc_html($pakiet); ?></span>
                                        <?php endif; ?>

                                        <?php if ($date): ?>
                                        <span class="b-opinions__date"><?php echo esc_html($date); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($stars): ?>
                                <div class="b-opinions__stars"
                                    aria-label="<?php echo esc_attr(sprintf(__('%d gwiazdek', 'care4kids'), $stars)); ?>">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span
                                        class="b-opinions__star <?php echo $i <= $stars ? 'b-opinions__star--active' : ''; ?>">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 0L12.2451 6.90983H19.5106L13.6327 11.1803L15.8779 18.0902L10 13.8197L4.12215 18.0902L6.36729 11.1803L0.489435 6.90983H7.75486L10 0Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <?php endfor; ?>
                                </div>
                                <?php endif; ?>

                                <?php if ($opinion_text): ?>
                                <div class="b-opinions__text">
                                    <i> <?php echo wp_kses_post($opinion_text); ?></i>
                                </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>