<?php
$class_name = 'b-steps';
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

$steps = get_field('steps');
$columns = get_field('columns') ?: '4'; // Default to 3 columns

if (empty($steps)) {
    if (is_admin()) {
        echo '<p>' . esc_html__('Dodaj przynajmniej jeden krok, aby wyświetlić blok kroków.', 'care4kids') . '</p>';
    }
    return;
}

$grid_class = 'b-steps__grid';
$grid_class .= ' b-steps__grid--columns-' . esc_attr($columns);
?>

<section class="<?php echo esc_attr($class_name); ?>" <?php echo $anchor; ?>>
    <div class="container">
        <div class="<?php echo esc_attr($grid_class); ?>">
            <?php foreach ($steps as $index => $step): ?>
            <?php
                $number = $step['number'] ?? '';
                $title = $step['tilte'] ?? ''; // Note: typo in ACF field name
                $desc = $step['desc'] ?? '';
                $link = $step['link'] ?? [];

                $is_first = ($index === 0);
                ?>
            <article class="b-steps__item">
                <div class="b-steps__content">
                    <div class="b-steps__top">
                        <div class="b-steps__number<?php echo $is_first ? ' b-steps__number--primary' : ''; ?>">
                            <?php if ($number): ?>
                            <span><?php echo esc_html($number); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="b-steps__text">
                            <?php if ($title): ?>
                            <h3 class="b-steps__title"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>

                            <?php if ($desc): ?>
                            <p class="b-steps__desc"><?php echo esc_html($desc); ?></p>
                            <?php endif; ?>
                        </div>


                        <?php if (!empty($link['url']) && !empty($link['title'])): ?>
                        <?php
                            $target = !empty($link['target']) ? $link['target'] : '_self';
                            $button_class = 'b-steps__button btn btn--white';
                            if ($is_first) {
                                $button_class .= ' btn--primary';
                            }
                            ?>
                        <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($target); ?>"
                            class="<?php echo esc_attr($button_class); ?>">
                            <?php echo esc_html($link['title']); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>