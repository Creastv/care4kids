<?php

/**
 * Color customization functions and settings.
 */

/**
 * Get theme color palette.
 *
 * @return array Array of color hex codes.
 */
function care4kids_get_color_palette(): array
{
    return [
        '#6262d2', // Primary
        '#00897b', // Accent
        '#2e7d32', // Success
        '#f9a825', // Warning
        '#c62828', // Error
        '#141414', // Text
        '#f5f7fa', // Text Light
        '#ffffff', // Background
        '#f1f5f9', // Background Alt
    ];
}

/**
 * Register default color palette for Gutenberg editor.
 */
add_action('after_setup_theme', function () {
    add_theme_support(
        'editor-color-palette',
        [
            [
                'name'  => __('Primary', 'care4kids'),
                'slug'  => 'primary',
                'color' => '#6262d2',
            ],
            [
                'name'  => __('Accent', 'care4kids'),
                'slug'  => 'accent',
                'color' => '#00897b',
            ],
            [
                'name'  => __('Success', 'care4kids'),
                'slug'  => 'success',
                'color' => '#2e7d32',
            ],
            [
                'name'  => __('Warning', 'care4kids'),
                'slug'  => 'warning',
                'color' => '#f9a825',
            ],
            [
                'name'  => __('Error', 'care4kids'),
                'slug'  => 'error',
                'color' => '#c62828',
            ],
            [
                'name'  => __('Text', 'care4kids'),
                'slug'  => 'text',
                'color' => '#141414',
            ],
            [
                'name'  => __('Text Light', 'care4kids'),
                'slug'  => 'text-light',
                'color' => '#f5f7fa',
            ],
            [
                'name'  => __('Background', 'care4kids'),
                'slug'  => 'background',
                'color' => '#ffffff',
            ],
            [
                'name'  => __('Background Alt', 'care4kids'),
                'slug'  => 'background-alt',
                'color' => '#f1f5f9',
            ],
        ]
    );
});

/**
 * Register default color palette for ACF Color Picker (if ACF is active).
 */
if (function_exists('acf_add_local_field_group')) {
    /**
     * Register default color palette for ACF Color Picker.
     *
     * @param array $field ACF field array.
     *
     * @return array Modified ACF field array.
     */
    add_filter('acf/load_field/type=color_picker', function ($field) {
        // Add color palette to ACF Color Picker
        if (!isset($field['palette']) || empty($field['palette'])) {
            $field['palette'] = care4kids_get_color_palette();
        }

        return $field;
    });

    /**
     * Alternative method: Prepare field for ACF Color Picker.
     *
     * @param array $field ACF field array.
     *
     * @return array Modified ACF field array.
     */
    add_filter('acf/prepare_field/type=color_picker', function ($field) {
        // Ensure palette is set
        if (!isset($field['palette']) || empty($field['palette'])) {
            $field['palette'] = care4kids_get_color_palette();
        }

        return $field;
    });

    /**
     * Configure ACF Color Picker palette via JavaScript.
     */
    add_action('acf/input/admin_footer', function () {
        $colors = care4kids_get_color_palette();
        $colors_json = wp_json_encode($colors);
?>
        <script type="text/javascript">
            (function($) {
                if (typeof acf !== 'undefined') {
                    // Use ACF filter to set color palette
                    acf.add_filter('color_picker_args', function(args, field) {
                        args.palettes = <?php echo $colors_json; ?>;
                        return args;
                    });

                    // Also configure existing color pickers
                    function configureColorPickers() {
                        $('input[type="text"].acf-color-picker, input.acf-color-picker').each(function() {
                            var $input = $(this);
                            if ($input.data('iris')) {
                                $input.iris('option', 'palettes', <?php echo $colors_json; ?>);
                            }
                        });
                    }

                    // Configure on page load
                    $(document).ready(function() {
                        configureColorPickers();
                    });

                    // Configure when ACF fields are added/updated
                    $(document).on('acf/setup_fields', function(e, postbox) {
                        configureColorPickers();
                    });

                    // Configure when color picker is clicked
                    $(document).on('focus', 'input.acf-color-picker', function() {
                        var $input = $(this);
                        setTimeout(function() {
                            if ($input.data('iris')) {
                                $input.iris('option', 'palettes', <?php echo $colors_json; ?>);
                            }
                        }, 50);
                    });
                }
            })(jQuery);
        </script>
<?php
    });
}
