<?php

/**
 * Care4Kids Theme setup and assets.
 */

define('CARE4KIDS_VERSION', '1.0.0');

define('CARE4KIDS_THEME_DIR', get_template_directory());
define('CARE4KIDS_THEME_URI', get_template_directory_uri());

define('CARE4KIDS_ASSETS_URI', CARE4KIDS_THEME_URI . '/assets');
define('CARE4KIDS_BUILD_URI', CARE4KIDS_ASSETS_URI);

define('CARE4KIDS_ASSETS_DIR', CARE4KIDS_THEME_DIR . '/assets');

define('CARE4KIDS_BUILD_DIR', CARE4KIDS_ASSETS_DIR);

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    add_theme_support(
        'custom-logo',
        [
            'height'      => 100,
            'width'       => 300,
            'flex-height' => true,
            'flex-width'  => true,
        ]
    );

    register_nav_menus(
        [
            'primary' => __('Primary Menu', 'care4kids'),
        ]
    );
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('care4kids-style', get_stylesheet_uri(), [], CARE4KIDS_VERSION);

    $main_css = CARE4KIDS_BUILD_DIR . '/css/main.css';
    if (file_exists($main_css)) {
        wp_enqueue_style(
            'care4kids-main',
            CARE4KIDS_BUILD_URI . '/css/main.css',
            ['care4kids-style'],
            CARE4KIDS_VERSION
        );
    }

    $bundle_js = CARE4KIDS_BUILD_DIR . '/js/main.js';

    if (file_exists($bundle_js)) {
        wp_enqueue_script(
            'care4kids-scripts',
            CARE4KIDS_BUILD_URI . '/js/main.js',
            [],
            CARE4KIDS_VERSION,
            true
        );
    }
});

require_once CARE4KIDS_THEME_DIR . '/functions/wp-customization.php';
