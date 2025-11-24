<?php

/**
 * Template for displaying single posts.
 */

global $wp_query;

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="custome-separator  sep-50"></div>
        <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php get_template_part('templates-parts/header/h', 'title'); ?>
            <div class="custome-separator  sep-50"></div>
            <!-- <div class="entry-meta">
                <span class="posted-on"><?php echo esc_html(get_the_date()); ?></span>
                <span class="byline"><?php esc_html_e(' by ', 'care4kids'); ?><?php the_author(); ?></span>
            </div> -->

            <div class="container-inner entry-content">
                <?php the_content(); ?>
            </div>
        </article>
        <div class="custome-separator  sep-50"></div>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();