<?php

/**
 * Header title partial.
 */
?>
<?php
// Render dedicated hero for funkcje CPT.
if (is_singular('funkcje')) {
    get_template_part('templates-parts/header/h', 'title-functions');
    return;
}

// Check if we're on front page or home page
$is_front = is_front_page();
$is_home  = is_home();

// Determine if we should show title
$show_title = true;

// For single pages/posts (including static front page), check meta box first
if (is_single() || is_page() || $is_front) {
    $post_id = get_the_ID();

    // Only check meta if we have a valid post ID
    if ($post_id) {
        $meta_show_title = get_post_meta($post_id, '_care4kids_show_page_title', true);

        // If meta is set, use it; otherwise use global setting
        if ($meta_show_title !== '') {
            $show_title = ($meta_show_title === '1');
        } else {
            $show_title = get_theme_mod('care4kids_show_page_title', true);
        }
    } else {
        // No post ID, use global setting
        $show_title = get_theme_mod('care4kids_show_page_title', true);
    }
} elseif ($is_home && !is_paged()) {
    // For blog home page (not static front page), use global setting
    $show_title = get_theme_mod('care4kids_show_page_title', true);
} else {
    // For other pages (archive, search, 404), use global setting
    $show_title = get_theme_mod('care4kids_show_page_title', true);
}

// Display title if enabled
if ($show_title) {
    ?>
    <header class="entry-header">
        <h1 class="header-title__text">
            <?php
            if ($is_front || ($is_home && !is_paged())) {
                bloginfo('name');
            } elseif (is_single() || is_page()) {
                the_title();
            } elseif (is_archive()) {
                the_archive_title();
            } elseif (is_search()) {
                printf(esc_html__('Search Results for: %s', 'care4kids'), '<span>' . get_search_query() . '</span>');
            } elseif (is_404()) {
                esc_html_e('Page Not Found', 'care4kids');
            } else {
                bloginfo('name');
            }
            ?>
        </h1>
    </header>
    <?php
}
?>