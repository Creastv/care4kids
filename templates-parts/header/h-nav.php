<?php

/**
 * Header navigation partial.
 */
?>

<nav class="header-nav col-6_lg-6_md-12_sm-12_xs-12" aria-label="Main Navigation">
    <?php
    wp_nav_menu(
        [
            'theme_location' => 'primary',
            'menu_class'     => 'header-nav__list grid grid-middle',
            'container'      => false,
        ]
    );
    ?>
</nav>