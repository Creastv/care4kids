<?php
/**
 * Header navigation partial.
 */
?>
<nav class="header-nav" aria-label="Main Navigation">
    <?php
    wp_nav_menu(
        [
            'theme_location' => 'primary',
            'menu_class'     => 'menu menu--primary',
            'container'      => false,
            'fallback_cb'    => function () {
                echo '<ul class="menu menu--fallback">';
                wp_list_pages(
                    [
                        'title_li' => '',
                    ]
                );
                echo '</ul>';
            },
        ]
    );
    ?>
</nav>
