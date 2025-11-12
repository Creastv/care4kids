<?php

/**
 * Theme customization hooks and helpers.
 */

/**
 * Returns default values for header buttons.
 *
 * @return array
 */
function care4kids_get_header_button_defaults(): array
{
    return [
        'primary_label'   => __('Donate', 'care4kids'),
        'primary_url'     => home_url('/donate'),
        'secondary_label' => __('Contact Us', 'care4kids'),
        'secondary_url'   => home_url('/contact'),
    ];
}

add_action(
    'customize_register',
    function (WP_Customize_Manager $wp_customize) {
        $defaults = care4kids_get_header_button_defaults();

        $wp_customize->add_section(
            'care4kids_branding',
            [
                'title'    => __('Branding', 'care4kids'),
                'priority' => 150,
            ]
        );

        $wp_customize->add_setting(
            'care4kids_header_logo',
            [
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
                'transport'         => 'refresh',
            ]
        );

        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'care4kids_header_logo',
                [
                    'label'   => __('Header Logo', 'care4kids'),
                    'section' => 'care4kids_branding',
                ]
            )
        );

        $wp_customize->add_section(
            'care4kids_header_buttons',
            [
                'title'       => __('Header Buttons', 'care4kids'),
                'priority'    => 160,
                'description' => __('Manage the call-to-action buttons displayed in the site header.', 'care4kids'),
            ]
        );

        $wp_customize->add_setting(
            'care4kids_header_button_primary_label',
            [
                'default'           => $defaults['primary_label'],
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'refresh',
            ]
        );

        $wp_customize->add_control(
            'care4kids_header_button_primary_label',
            [
                'label'       => __('Primary Button Label', 'care4kids'),
                'section'     => 'care4kids_header_buttons',
                'type'        => 'text',
            ]
        );

        $wp_customize->add_setting(
            'care4kids_header_button_primary_url',
            [
                'default'           => $defaults['primary_url'],
                'sanitize_callback' => 'esc_url_raw',
                'transport'         => 'refresh',
            ]
        );

        $wp_customize->add_control(
            'care4kids_header_button_primary_url',
            [
                'label'       => __('Primary Button URL', 'care4kids'),
                'section'     => 'care4kids_header_buttons',
                'type'        => 'url',
            ]
        );

        $wp_customize->add_setting(
            'care4kids_header_button_secondary_label',
            [
                'default'           => $defaults['secondary_label'],
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'refresh',
            ]
        );

        $wp_customize->add_control(
            'care4kids_header_button_secondary_label',
            [
                'label'       => __('Secondary Button Label', 'care4kids'),
                'section'     => 'care4kids_header_buttons',
                'type'        => 'text',
            ]
        );

        $wp_customize->add_setting(
            'care4kids_header_button_secondary_url',
            [
                'default'           => $defaults['secondary_url'],
                'sanitize_callback' => 'esc_url_raw',
                'transport'         => 'refresh',
            ]
        );

        $wp_customize->add_control(
            'care4kids_header_button_secondary_url',
            [
                'label'       => __('Secondary Button URL', 'care4kids'),
                'section'     => 'care4kids_header_buttons',
                'type'        => 'url',
            ]
        );
    }
);