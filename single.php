<?php
/**
 * Template for displaying single posts.
 */

global $wp_query;

get_header();
?>

<main id="primary" class="site-main">
    <?php while ( have_posts() ) : ?>
        <?php the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header>

            <div class="entry-meta">
                <span class="posted-on"><?php echo esc_html( get_the_date() ); ?></span>
                <span class="byline"><?php esc_html_e( ' by ', 'care4kids' ); ?><?php the_author(); ?></span>
            </div>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <?php if ( comments_open() || get_comments_number() ) : ?>
                <?php comments_template(); ?>
            <?php endif; ?>
        </article>
    <?php endwhile; ?>
</main>

<?php
get_footer();
