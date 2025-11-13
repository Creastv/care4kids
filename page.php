<?php

/**
 * Template for displaying all pages.
 */

global $wp_query;

get_header();
?>

<main id="primary" class="site-main">
    <div class="container-inner">
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
