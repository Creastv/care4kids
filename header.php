<?php

/**
 * The header for our theme.
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="site-header">
        <div class="container site-header__inner">
            <?php get_template_part('templates-parts/header/h', 'brand'); ?>
            <?php get_template_part('templates-parts/header/h', 'nav'); ?>
            <?php get_template_part('templates-parts/header/h', 'buttons'); ?>
        </div>
    </header>