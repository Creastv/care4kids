<?php

/**
 * Footer branding section.
 */

$footer_logo        = get_theme_mod('care4kids_footer_logo');
$footer_description = get_theme_mod('care4kids_footer_description', '');
$footer_link_url    = get_theme_mod('care4kids_footer_link', '');
$footer_link_text   = get_theme_mod('care4kids_footer_link_text', '');

if (empty($footer_logo) && empty($footer_description) && (empty($footer_link_url) || empty($footer_link_text))) {
    return;
}
?>

<div class="footer-brand">
    <?php if (!empty($footer_logo)) : ?>
        <div class="footer-brand__logo">
            <img src="<?php echo esc_url($footer_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
        </div>
    <?php else : ?>
        <a class="footer-brand__logo footer-brand__fallback" href="<?php echo esc_url(home_url('/')); ?>">
            <span class="brand-fallback" aria-hidden="true">
                <span class="brand-fallback__primary">care4</span>
                <span class="brand-fallback__accent">kids</span>
            </span>
            <span class="screen-reader-text"><?php bloginfo('name'); ?></span>
        </a>
    <?php endif; ?>

    <?php if (!empty($footer_description)) : ?>
        <div class="footer-brand__description">
            <?php echo wp_kses_post(wpautop($footer_description)); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($footer_link_url) && !empty($footer_link_text)) : ?>
        <a class="btn btn--primary" href="<?php echo esc_url($footer_link_url); ?>">
            <?php echo esc_html($footer_link_text); ?>
        </a>
    <?php endif; ?>
</div>