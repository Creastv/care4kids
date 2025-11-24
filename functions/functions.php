<?php

/**
 * Additional theme functions.
 */


/**
 * Add meta box for page title visibility.
 */
add_action('add_meta_boxes', function () {
    add_meta_box(
        'care4kids_page_title_meta',
        __('Page Title', 'care4kids'),
        'care4kids_page_title_meta_box_callback',
        ['page', 'post'],
        'side',
        'default'
    );
});

/**
 * Meta box callback function.
 *
 * @param WP_Post $post The post object.
 */
function care4kids_page_title_meta_box_callback($post)
{
    wp_nonce_field('care4kids_page_title_meta_box', 'care4kids_page_title_meta_box_nonce');

    $show_title = get_post_meta($post->ID, '_care4kids_show_page_title', true);

    // Default to true if not set
    if ($show_title === '') {
        $show_title = '1';
    }
?>
    <p>
        <label>
            <input type="checkbox" name="care4kids_show_page_title" value="1" <?php checked($show_title, '1'); ?>>
            <?php esc_html_e('Show page title', 'care4kids'); ?>
        </label>
    </p>
    <p class="description">
        <?php esc_html_e('Uncheck to hide the title on this page.', 'care4kids'); ?>
    </p>
<?php
}

/**
 * Save meta box data.
 *
 * @param int $post_id The post ID.
 */
add_action('save_post', function ($post_id) {
    // Check nonce
    if (
        !isset($_POST['care4kids_page_title_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['care4kids_page_title_meta_box_nonce'], 'care4kids_page_title_meta_box')
    ) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save meta value
    $show_title = isset($_POST['care4kids_show_page_title']) ? '1' : '0';
    update_post_meta($post_id, '_care4kids_show_page_title', $show_title);
});

/**
 * Register ACF field group for Title Function block.
 */
add_action('acf/include_fields', function() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_69206d4666af6',
        'title' => 'b: Title funcion',
        'fields' => array(
            array(
                'key' => 'field_69206db1a6f17',
                'label' => 'Img',
                'name' => 'img',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'id',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
                'allow_in_bindings' => 0,
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_69206d46c756c',
                'label' => 'Title',
                'name' => 'title',
                'aria-label' => '',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_69206d69c756e',
                        'label' => 'Subtitle',
                        'name' => 'subtitle',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'Wykrywanie zagrożeń',
                        'maxlength' => '',
                        'allow_in_bindings' => 0,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_69206d62c756d',
                        'label' => 'Title',
                        'name' => 'title',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '1. Analiza emocji, głosu i zachowań dziecka',
                        'maxlength' => '',
                        'allow_in_bindings' => 0,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/title-fun',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
        'display_title' => '',
    ));
});
