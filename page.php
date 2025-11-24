<?php

/**
 * Template for displaying all pages.
 */

global $wp_query;

get_header();
?>



<main id="primary" class="site-main">
    <div class="container">
        <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php get_template_part('templates-parts/header/h', 'title'); ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();