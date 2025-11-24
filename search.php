<?php

/**
 * The template for displaying search results.
 */

global $wp_query;

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="custome-separator sep-50"></div>

        <?php if (have_posts()) : ?>
        <?php get_template_part('templates-parts/header/h', 'title'); ?>

        <div class="search-results">
            <?php
                $results_count = $wp_query->found_posts;
                printf(
                    '<p class="search-results-count">%s</p>',
                    sprintf(
                        esc_html(_n('Found %d result', 'Found %d results', $results_count, 'care4kids')),
                        number_format_i18n($results_count)
                    )
                );
                ?>

            <div class="search-results-list">
                <?php while (have_posts()) : ?>
                <?php the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
                    <header class="entry-header">
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <div class="entry-meta">
                            <span class="posted-on"><?php echo esc_html(get_the_date()); ?></span>
                            <?php if (get_post_type() === 'post') : ?>
                            <span class="byline"><?php esc_html_e(' by ', 'care4kids'); ?><?php the_author(); ?></span>
                            <?php endif; ?>
                            <span
                                class="post-type"><?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?></span>
                        </div>
                    </header>

                    <div class="entry-summary">
                        <?php
                                if (has_excerpt()) {
                                    the_excerpt();
                                } else {
                                    $content = get_the_content();
                                    $excerpt = wp_trim_words($content, 30, '...');
                                    echo '<p>' . esc_html($excerpt) . '</p>';
                                }
                                ?>
                    </div>

                    <div class="entry-footer">
                        <a href="<?php the_permalink(); ?>" class="read-more">
                            <?php esc_html_e('Read more', 'care4kids'); ?>
                        </a>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>

            <?php
                // Pagination
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => esc_html__('Previous', 'care4kids'),
                    'next_text' => esc_html__('Next', 'care4kids'),
                ));
                ?>
        </div>
        <?php else : ?>
        <section class="no-results not-found">
            <?php get_template_part('templates-parts/header/h', 'title'); ?>

            <div class="page-content">
                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'care4kids'); ?>
                </p>
                <?php get_search_form(); ?>
            </div>
        </section>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();