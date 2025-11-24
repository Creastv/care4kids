<?php
$class_name = 'b-works';
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

if (empty($steps)) {
    if (is_admin()) {
        echo '<p>' . esc_html__('Dodaj przynajmniej jeden krok, aby wyświetlić blok "How it works".', 'care4kids') . '</p>';
    }
    return;
}

$steps_count = count($steps);
$grid_class = 'b-works__grid b-works__grid--' . $steps_count;
?>

<section class="<?php echo esc_attr($class_name); ?>" <?php echo $anchor; ?>>
    <div class="container">
        <div class="<?php echo esc_attr($grid_class); ?>">
            <?php foreach ($steps as $index => $step): ?>
                <?php
                $ico = $step['ico'] ?? '';
                $number = $step['number'] ?? '';
                $title = $step['title'] ?? '';
                $desc = $step['desc'] ?? '';
                ?>
                <article class="b-works__item">
                    <div class="b-works__content">
                        <div class="b-works__header">
                            <?php if ($ico): ?>
                                <div class="b-works__icon">
                                    <?php echo wp_get_attachment_image($ico, 'full', false, ['class' => 'b-works__icon-img']); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($number): ?>
                                <div class="b-works__number">
                                    <span><?php echo esc_html($number); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="b-works__text">
                            <?php if ($title): ?>
                                <h3 class="b-works__title"><?php echo $title; ?></h3>
                            <?php endif; ?>

                            <?php if ($desc): ?>
                                <p class="b-works__desc"><?php echo $desc; ?></p>
                            <?php endif; ?>
                        </div>


                        <?php if ($index === 0): ?>
                            <svg class="b-works__item__arrowone" width="110" height="41" viewBox="0 0 110 41" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.800321 12.1002C10.7337 6.51393 26.9453 -4.21681 38.6995 3.49357C47.7183 9.40965 43.9639 21.8258 45.5751 30.802C49.9868 55.3815 89.1171 23.4302 98.73 18.0684C101.202 16.6894 110.386 8.25444 108.246 12.9789C106.315 17.2421 100.835 31.9353 104.185 19.8182C105.144 16.3507 109.125 13.9207 107.587 9.9487C106.97 8.35507 91.35 9.64801 89.8243 10.582"
                                    stroke="#A1A1E4" stroke-width="1.6" stroke-linecap="round" />
                            </svg>
                        <?php elseif ($index === 1): ?>
                            <svg class="b-works__item__arrowtwo" width="93" height="45" viewBox="0 0 93 45" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.800148 1.75882C16.2452 -2.14079 45.9784 6.55487 59.6149 15.1781C73.2514 23.8014 85.3274 36.3607 87.1833 40.0543C88.2374 42.1523 90.7107 43.2926 87.0426 43.2646C84.0217 43.2415 79.5599 43.4129 76.7122 42.2803C75.6838 41.8713 86.8205 43.1925 90.1923 43.7362C94.5029 44.4313 86.0303 26.7683 84.7251 23.7395"
                                    stroke="#A1A1E4" stroke-width="1.6" stroke-linecap="round" />
                            </svg>
                        <?php elseif ($index === 2): ?>
                            <svg class="b-works__item__arrowtree" width="107" height="58" viewBox="0 0 107 58" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.800097 35.8612C17.0613 47.6855 35.1358 58.187 55.8991 56.6355C61.6545 56.2055 71.1372 53.7256 73.7157 47.6305C75.9566 42.3336 73.5489 34.5764 71.2331 29.7527C68.9695 25.0379 65.0451 20.3806 59.991 18.7221C57.6979 17.9696 55.0772 18.1862 55.311 21.0204C55.931 28.5364 66.7316 31.9401 72.4602 28.2754C80.9925 22.817 85.8613 11.7965 95.3133 7.96434C96.3966 7.52513 101.884 4.39671 102.757 6.5499C103.657 8.77138 100.624 11.6781 100.031 13.6678C99.1246 16.7094 102.797 7.90291 104.737 5.39093C106.267 3.40923 106.722 3.68833 103.602 3.80198C100.403 3.91855 95.4053 3.36955 93.2103 0.800019"
                                    stroke="#A1A1E4" stroke-width="1.6" stroke-linecap="round" />
                            </svg>
                        <?php endif; ?>

                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>