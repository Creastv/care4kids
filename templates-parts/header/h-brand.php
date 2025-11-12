<?php

/**
 * Header brand/logo partial.
 */
?>
<?php
$customizer_logo = get_theme_mod('care4kids_header_logo');
?>
<div class="header-brand">
    <a class="brand-link" href="<?php echo esc_url(home_url('/')); ?>">
        <?php
        if (! empty($customizer_logo)) {
        ?>
            <img class="brand-image" src="<?php echo esc_url($customizer_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
        <?php
        } elseif (function_exists('the_custom_logo') && has_custom_logo()) {
            the_custom_logo();
        } else {
            bloginfo('name');
        }
        ?>
    </a>
</div>