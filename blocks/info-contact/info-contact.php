<?php
$class_name = 'b-info-contact';
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

$items = get_field('contact_items');
if (!$items) {
    $items = get_field('info_contact_items') ?: get_field('items');
}

if (empty($items)) {
    if (!is_admin()) {
        return;
    }

    $items = [
        [
            'icon_emoji'      => '📍',
            'label'           => __('Adres', 'care4kids'),
            'value'           => 'ul. Migdałowa 4 wejście B',
            'secondary_value' => '02-796 Warszawa, Polska',
        ],
        [
            'icon_emoji' => '✉️',
            'label'      => __('Email', 'care4kids'),
            'value'      => 'care4kids@kontakt.pl',
        ],
        [
            'icon_emoji' => '📞',
            'label'      => __('Numer telefonu', 'care4kids'),
            'value'      => '+48 780 250 250',
        ],
        [
            'icon_emoji'      => '⏰',
            'label'           => __('Godziny otwarcia', 'care4kids'),
            'value'           => __('Pn - pt: 7:00 - 21:00', 'care4kids'),
            'secondary_value' => __('Sb: 8:00 - 18:00', 'care4kids'),
        ],
    ];
}

/**
 * Normalize icon data.
 */
$prepare_icon = static function ($item) {
    $icon_url = '';
    $icon = $item['icon'] ?? null;

    if ($icon) {
        if (is_array($icon)) {
            $icon_url = $icon['url'] ?? '';
        } else {
            $icon_url = wp_get_attachment_image_url($icon, 'thumbnail') ?: '';
        }
    }

    return [
        'url'   => $icon_url,
        'emoji' => $item['icon_emoji'] ?? '',
    ];
};

/**
 * Build link data for the item.
 */
$prepare_link = static function ($item, $fallback_line) {
    $link_url = '';
    $link_target = '_self';
    $link_rel = '';

    $link = $item['link'] ?? null;
    if (is_array($link) && !empty($link['url'])) {
        $link_url = $link['url'];
        $link_target = !empty($link['target']) ? $link['target'] : '_self';
        if (!empty($link['title'])) {
            $link_rel = sanitize_title($link['title']);
        }
    } elseif (!empty($item['link_url'])) {
        $link_url = $item['link_url'];
        $link_target = !empty($item['link_target']) ? $item['link_target'] : '_self';
    }

    if (!$link_url && $fallback_line) {
        if (filter_var($fallback_line, FILTER_VALIDATE_EMAIL)) {
            $link_url = 'mailto:' . $fallback_line;
        } elseif (preg_match('/^\+?[0-9][0-9\s\-\(\)]+$/', $fallback_line)) {
            $sanitized = preg_replace('/[^\d\+]/', '', $fallback_line);
            $link_url  = 'tel:' . $sanitized;
        }
    }

    return [
        'url'    => $link_url,
        'target' => $link_target,
        'rel'    => $link_rel,
    ];
};
?>

<section class="<?php echo esc_attr($class_name); ?>" <?php echo $anchor; ?>>
    <div class="container">
        <div class="b-info-contact__list">
            <?php foreach ($items as $item): ?>
                <?php
                $label = $item['label'] ?? '';
                $value = $item['value'] ?? ($item['primary_text'] ?? '');
                $value_secondary = $item['secondary_value'] ?? ($item['secondary_text'] ?? '');
                $value_third = $item['tertiary_value'] ?? ($item['tertiary_text'] ?? '');

                $content = [];
                foreach ([$value, $value_secondary, $value_third] as $line) {
                    if (!empty($line)) {
                        $content[] = $line;
                    }
                }

                if (empty($content) && !empty($item['content'])) {
                    $content = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $item['content'])));
                }

                if (empty($content)) {
                    continue;
                }

                $icon = $prepare_icon($item);
                $link = $prepare_link($item, $content[0]);
                $has_link = !empty($link['url']);
                ?>
                <article class="b-info-contact__item">
                    <div class="b-info-contact__icon" aria-hidden="true">
                        <?php if (!empty($icon['url'])): ?>
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="" class="b-info-contact__icon-img" loading="lazy" />
                        <?php elseif (!empty($icon['emoji'])): ?>
                            <span class="b-info-contact__icon-emoji" role="presentation"><?php echo esc_html($icon['emoji']); ?></span>
                        <?php else: ?>
                            <span class="b-info-contact__icon-emoji" role="presentation">ℹ️</span>
                        <?php endif; ?>
                    </div>
                    <div class="b-info-contact__content">
                        <?php if ($label): ?>
                            <p class="b-info-contact__label"><?php echo esc_html($label); ?></p>
                        <?php endif; ?>

                        <?php if ($has_link): ?>
                            <a class="b-info-contact__values b-info-contact__values--link"
                                href="<?php echo esc_url($link['url']); ?>"
                                target="<?php echo esc_attr($link['target']); ?>"
                                <?php echo $link['rel'] ? 'rel="noopener ' . esc_attr($link['rel']) . '"' : 'rel="noopener"'; ?>>
                                <?php foreach ($content as $line): ?>
                                    <span class="b-info-contact__value-line"><?php echo esc_html($line); ?></span>
                                <?php endforeach; ?>
                            </a>
                        <?php else: ?>
                            <div class="b-info-contact__values">
                                <?php foreach ($content as $line): ?>
                                    <span class="b-info-contact__value-line"><?php echo esc_html($line); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>