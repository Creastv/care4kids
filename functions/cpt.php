<?php

/**
 * Custom Post Types registration.
 */

/**
 * Register custom post types.
 */
add_action('init', function () {
    register_post_type(
        'funkcje',
        [
            'labels'              => [
                'name'                  => __('Funkcje', 'care4kids'),
                'singular_name'         => __('Funkcja', 'care4kids'),
                'add_new'               => __('Dodaj nową', 'care4kids'),
                'add_new_item'          => __('Dodaj nową funkcję', 'care4kids'),
                'edit_item'             => __('Edytuj funkcję', 'care4kids'),
                'new_item'              => __('Nowa funkcja', 'care4kids'),
                'view_item'             => __('Zobacz funkcję', 'care4kids'),
                'view_items'            => __('Zobacz funkcje', 'care4kids'),
                'search_items'          => __('Szukaj funkcji', 'care4kids'),
                'not_found'             => __('Nie znaleziono funkcji', 'care4kids'),
                'not_found_in_trash'    => __('Nie znaleziono funkcji w koszu', 'care4kids'),
                'all_items'             => __('Wszystkie funkcje', 'care4kids'),
                'archives'              => __('Archiwum funkcji', 'care4kids'),
                'attributes'            => __('Atrybuty funkcji', 'care4kids'),
                'insert_into_item'      => __('Wstaw do funkcji', 'care4kids'),
                'uploaded_to_this_item' => __('Przesłane do tej funkcji', 'care4kids'),
                'featured_image'        => __('Obrazek wyróżniający', 'care4kids'),
                'set_featured_image'    => __('Ustaw obrazek wyróżniający', 'care4kids'),
                'remove_featured_image' => __('Usuń obrazek wyróżniający', 'care4kids'),
                'use_featured_image'    => __('Użyj jako obrazek wyróżniający', 'care4kids'),
                'menu_name'             => __('Funkcje', 'care4kids'),
                'filter_items_list'     => __('Filtruj listę funkcji', 'care4kids'),
                'items_list_navigation' => __('Nawigacja listy funkcji', 'care4kids'),
                'items_list'            => __('Lista funkcji', 'care4kids'),
            ],
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'query_var'           => true,
            'rewrite'             => ['slug' => 'funkcje'],
            'capability_type'     => 'post',
            'has_archive'         => false,
            'hierarchical'        => false,
            'menu_position'       => null,
            'menu_icon'           => 'dashicons-admin-post',
            'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
            'show_in_rest'        => true,
        ]
    );
});

/**
 * Register custom title meta box for funkcje CPT.
 */
add_action('add_meta_boxes', function () {
    add_meta_box(
        'care4kids_funkcje_title_meta',
        __('Custom Title', 'care4kids'),
        'care4kids_funkcje_title_meta_box_callback',
        'funkcje',
        'side',
        'low'
    );
});

/**
 * Meta box callback for funkcje custom titles.
 *
 * @param WP_Post $post Current post object.
 */
function care4kids_funkcje_title_meta_box_callback($post)
{
    wp_nonce_field('care4kids_funkcje_title_meta_box', 'care4kids_funkcje_title_meta_box_nonce');

    $custom_title = get_post_meta($post->ID, '_care4kids_funkcje_custom_title', true);
    $title_suffix = get_post_meta($post->ID, '_care4kids_funkcje_title_suffix', true);
?>
<p>
    <label for="care4kids_funkcje_custom_title"><?php esc_html_e('Custom title', 'care4kids'); ?></label>
    <input type="text" id="care4kids_funkcje_custom_title" name="care4kids_funkcje_custom_title" class="widefat"
        value="<?php echo esc_attr($custom_title); ?>">
</p>
<p>
    <label for="care4kids_funkcje_title_suffix"><?php esc_html_e('Title suffix', 'care4kids'); ?></label>
    <input type="text" id="care4kids_funkcje_title_suffix" name="care4kids_funkcje_title_suffix" class="widefat"
        value="<?php echo esc_attr($title_suffix); ?>">
</p>
<p class="description">
    <?php esc_html_e('Optional replacement for the default title and suffix used in the frontend.', 'care4kids'); ?>
</p>
<?php
}

/**
 * Save custom title meta for funkcje CPT.
 *
 * @param int $post_id The post ID.
 */
add_action('save_post_funkcje', function ($post_id) {
    if (
        !isset($_POST['care4kids_funkcje_title_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['care4kids_funkcje_title_meta_box_nonce'], 'care4kids_funkcje_title_meta_box')
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $custom_title = isset($_POST['care4kids_funkcje_custom_title']) ? sanitize_text_field($_POST['care4kids_funkcje_custom_title']) : '';
    $title_suffix = isset($_POST['care4kids_funkcje_title_suffix']) ? sanitize_text_field($_POST['care4kids_funkcje_title_suffix']) : '';

    update_post_meta($post_id, '_care4kids_funkcje_custom_title', $custom_title);
    update_post_meta($post_id, '_care4kids_funkcje_title_suffix', $title_suffix);
});