<?php
$class_name = 'b-price';
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

$tables = get_field('table');

if (!function_exists('care4kids_prepare_price_bullets')) {
    function care4kids_prepare_price_bullets($content)
    {
        $content = trim((string) $content);

        if ($content === '') {
            return [];
        }

        if (strpos($content, '<li') !== false) {
            return [
                'type'  => 'html',
                'value' => wp_kses_post($content),
            ];
        }

        $normalized = preg_replace('/\r\n|\r|\n/', '', $content);
        $segments = preg_split('/<\/p>/i', $normalized);
        $items = [];

        if ($segments) {
            foreach ($segments as $segment) {
                $segment = trim($segment);

                if ($segment === '') {
                    continue;
                }

                $segment = preg_replace('/^<p[^>]*>/i', '', $segment);
                $segment = trim($segment);

                if ($segment !== '') {
                    $items[] = wp_kses_post($segment);
                }
            }
        }

        if (empty($items)) {
            $items = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', strip_tags($content))));
        }

        if (empty($items)) {
            return [];
        }

        return [
            'type'  => 'list',
            'value' => $items,
        ];
    }
}

if (empty($tables)) {
    if (is_admin()) {
        echo '<p>' . esc_html__('Dodaj przynajmniej jeden pakiet, aby wyświetlić blok cennika.', 'care4kids') . '</p>';
    }
    return;
}
?>

<section class="<?php echo esc_attr($class_name); ?>" <?php echo $anchor; ?>>
    <div class="container">
        <?php foreach ($tables as $table_index => $table_row): ?>
            <?php
            $packs = $table_row['packiet'] ?? [];

            if (empty($packs)) {
                continue;
            }

            $columns = min(3, max(1, count($packs)));
            ?>
            <div class="b-price__grid b-price__grid--cols-<?php echo esc_attr($columns); ?>">
                <?php foreach ($packs as $pack): ?>
                    <?php
                    $is_featured = !empty($pack['futured']);

                    $title_group = $pack['title'] ?? [];
                    $title = $title_group['title'] ?? '';
                    $description = $title_group['desc'] ?? '';

                    $price_group = $pack['price'] ?? [];
                    $price_label = $price_group['price_label'] ?? '';
                    $price_value = $price_group['price'] ?? '';
                    $price_suffix = $price_group['price_sufix'] ?? '';
                    $price_note = $price_group['price_desc'] ?? '';

                    $cta_group = $pack['cta'] ?? [];
                    $cta_link = $cta_group['link'] ?? [];
                    $cta_note = $cta_group['link_desc'] ?? '';

                    $bullets = care4kids_prepare_price_bullets($pack['bullets_point'] ?? '');
                    ?>
                    <article class="b-price-card<?php echo $is_featured ? ' is-featured' : ''; ?>">
                        <div class="b-price-card__inner">
                            <header class="b-price-card__header">


                                <?php if ($title): ?>
                                    <h3 class="b-price-card__title"><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>

                                <?php if ($description): ?>
                                    <p class="b-price-card__description"><?php echo esc_html($description); ?></p>
                                <?php endif; ?>
                            </header>

                            <?php if ($price_value || $price_suffix || $price_note): ?>
                                <div class="b-price-card__pricing">
                                    <div class="b-price-card__value">
                                        <?php if ($price_label): ?>
                                            <span class="b-price-card__price-label"><?php echo esc_html($price_label); ?></span>
                                        <?php endif; ?>
                                        <?php if ($price_value): ?>
                                            <span class="b-price-card__price"><?php echo esc_html($price_value); ?></span>
                                        <?php endif; ?>

                                        <?php if ($price_suffix): ?>
                                            <span class="b-price-card__suffix"><?php echo esc_html($price_suffix); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($price_note): ?>
                                        <p class="b-price-card__note"><?php echo esc_html($price_note); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($cta_link['url']) && !empty($cta_link['title'])): ?>
                                <?php
                                $target = !empty($cta_link['target']) ? $cta_link['target'] : '_self';
                                ?>
                                <div class="b-price-card__cta">
                                    <a class="b-price-card__button" href="<?php echo esc_url($cta_link['url']); ?>"
                                        target="<?php echo esc_attr($target); ?>">
                                        <?php echo esc_html($cta_link['title']); ?>
                                    </a>
                                    <?php if ($cta_note): ?>
                                        <p class="b-price-card__cta-note"><?php echo esc_html($cta_note); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($bullets)): ?>
                            <div class="b-price-card__bullets">
                                <p class="b-price-card__bullets-heading">
                                    <?php esc_html_e('W skład pakietu wchodzi:', 'care4kids'); ?></p>

                                <?php if (($bullets['type'] ?? '') === 'html'): ?>
                                    <div class="b-price-card__bullets-inner">
                                        <?php echo $bullets['value']; ?>
                                    </div>
                                <?php else: ?>
                                    <ul class="b-price-card__list">
                                        <?php foreach ($bullets['value'] as $item): ?>
                                            <li><?php echo $item; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>