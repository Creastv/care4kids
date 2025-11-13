<?php
/**
 * Main template file.
 */

global $wp_query;

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : ?>
        <?php the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
        <?php endwhile; ?>
        <?php else : ?>
        <section class="no-results">
            <h1><?php esc_html_e( 'Nothing Found', 'care4kids' ); ?></h1>
            <p><?php esc_html_e( 'It seems we can’t find what you’re looking for.', 'care4kids' ); ?></p>
        </section>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();