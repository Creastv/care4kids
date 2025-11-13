<?php

/**
 * Header buttons partial.
 */
?>
<?php
$defaults        = care4kids_get_header_button_defaults();
$primary_label   = get_theme_mod('care4kids_header_button_primary_label', $defaults['primary_label']);
$primary_url     = get_theme_mod('care4kids_header_button_primary_url', $defaults['primary_url']);
$secondary_label = get_theme_mod('care4kids_header_button_secondary_label', $defaults['secondary_label']);
$secondary_url   = get_theme_mod('care4kids_header_button_secondary_url', $defaults['secondary_url']);
?>
<div class="header-buttons col-3_lg-3_md-6_sm-6_xs-12">
    <a class="btn btn--white" href="<?php echo esc_url($primary_url); ?>">
        <?php echo esc_html($primary_label); ?>
    </a>
    <a class="btn btn--primary" aria-disabled="true" href="<?php echo esc_url($secondary_url); ?>">
        <?php echo esc_html($secondary_label); ?>
    </a>
</div>