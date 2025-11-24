<?php

/**
 * The template for displaying 404 pages.
 */

global $wp_query;

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="custome-separator  sep-50"></div>
        <section class="error-404 not-found">
            <?php get_template_part('templates-parts/header/h', 'title'); ?>

            <div class="page-content">
                <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'care4kids'); ?>
                </p>
                <?php get_search_form(); ?>
            </div>
        </section>
    </div>
</main>

<?php
get_footer();