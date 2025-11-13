<?php

/**
 * Footer navigation columns.
 */

$nav_configs = [];

for ($index = 1; $index <= 3; $index++) {
    $menu_id = get_theme_mod(sprintf('care4kids_footer_menu_%d', $index));

    if (empty($menu_id)) {
        continue;
    }

    $heading = get_theme_mod(sprintf('care4kids_footer_menu_%d_heading', $index), '');
    $menu    = wp_get_nav_menu_object($menu_id);

    if (!$menu instanceof WP_Term) {
        continue;
    }

    $nav_configs[] = [
        'menu_id' => (int) $menu_id,
        'heading' => $heading,
        'label'   => $menu->name,
    ];
}

if (empty($nav_configs)) {
    return;
}
?>

<div class="footer-navs ">
    <div class="footer-navs__grid grid">
        <?php foreach ($nav_configs as $config) : ?>
            <nav class="footer-navs__group "
                aria-label="<?php echo esc_attr(sprintf(__('Footer navigation: %s', 'care4kids'), $config['label'])); ?>">
                <?php if (!empty($config['heading'])) : ?>
                    <h3 class="footer-navs__heading">
                        <?php echo esc_html($config['heading']); ?>
                    </h3>
                <?php endif; ?>

                <?php
                wp_nav_menu(
                    [
                        'menu'        => $config['menu_id'],
                        'container'   => false,
                        'menu_class'  => 'footer-navs__list',
                        'fallback_cb' => false,
                        'depth'       => 1,
                    ]
                );
                ?>
            </nav>
        <?php endforeach; ?>
    </div>
</div>