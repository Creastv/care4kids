<?php

/**
 * Header navigation partial.
 */
?>

<?php
$primary_nav_id = 'primary-navigation-panel';
$breakpoint_xl  = 1200;
?>
<nav class="header-nav col col_md-last" aria-label="<?php esc_attr_e('Main Navigation', 'care4kids'); ?>"
    data-nav-breakpoint="<?php echo esc_attr($breakpoint_xl ?? 1200); ?>">
    <button class="header-nav__toggle" type="button" aria-expanded="false"
        aria-controls="<?php echo esc_attr($primary_nav_id); ?>">
        <span class="header-nav__toggle-bar"></span>
        <span class="header-nav__toggle-bar"></span>
        <span class="header-nav__toggle-bar"></span>
        <span class="screen-reader-text">
            <?php esc_html_e('Toggle navigation', 'care4kids'); ?>
        </span>
    </button>
    <div class="header-nav__overlay" data-header-nav-overlay></div>
    <div class="header-nav__panel" id="<?php echo esc_attr($primary_nav_id); ?>">
        <?php
        wp_nav_menu(
            [
                'theme_location' => 'primary',
                'menu_class'     => 'header-nav__list grid grid-middle',
                'container'      => false,
            ]
        );
        ?>
        <div class="header-nav__panel-actions">
            <?php get_template_part('templates-parts/header/h', 'buttons'); ?>
        </div>
    </div>
</nav>