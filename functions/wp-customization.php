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

/**
 * Sanitizes footer menu selections allowing empty values.
 *
 * @param mixed $value Menu term ID or empty.
 *
 * @return int|string
 */
function care4kids_sanitize_menu_choice($value)
{
    if (empty($value)) {
        return '';
    }

    return absint($value);
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

        $wp_customize->add_section(
            'care4kids_social_media',
            [
                'title'       => __('Social Media', 'care4kids'),
                'priority'    => 165,
                'description' => __('Provide links to your social media profiles.', 'care4kids'),
            ]
        );

        $wp_customize->add_setting(
            'care4kids_social_heading',
            [
                'default'           => __('Follow Us', 'care4kids'),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'refresh',
            ]
        );

        $wp_customize->add_control(
            'care4kids_social_heading',
            [
                'label'   => __('Section Heading', 'care4kids'),
                'section' => 'care4kids_social_media',
                'type'    => 'text',
            ]
        );

        $social_networks = [
            'facebook'  => __('Facebook URL', 'care4kids'),
            'instagram' => __('Instagram URL', 'care4kids'),
            'twitter'   => __('Twitter URL', 'care4kids'),
            'linkedin'  => __('LinkedIn URL', 'care4kids'),
            'youtube'   => __('YouTube URL', 'care4kids'),
        ];

        foreach ($social_networks as $network => $label) {
            $setting_id = sprintf('care4kids_social_%s_url', $network);

            $wp_customize->add_setting(
                $setting_id,
                [
                    'default'           => '',
                    'sanitize_callback' => 'esc_url_raw',
                    'transport'         => 'refresh',
                ]
            );

            $wp_customize->add_control(
                $setting_id,
                [
                    'label'   => $label,
                    'section' => 'care4kids_social_media',
                    'type'    => 'url',
                ]
            );
        }

        $wp_customize->add_section(
            'care4kids_footer',
            [
                'title'       => __('Footer', 'care4kids'),
                'priority'    => 170,
                'description' => __('Configure footer branding and navigation.', 'care4kids'),
            ]
        );

        $wp_customize->add_setting(
            'care4kids_footer_logo',
            [
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
                'transport'         => 'refresh',
            ]
        );

        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'care4kids_footer_logo',
                [
                    'label'   => __('Footer Logo', 'care4kids'),
                    'section' => 'care4kids_footer',
                ]
            )
        );

        $wp_customize->add_setting(
            'care4kids_footer_description',
            [
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
                'transport'         => 'refresh',
            ]
        );

        $wp_customize->add_control(
            'care4kids_footer_description',
            [
                'label'   => __('Footer Description', 'care4kids'),
                'section' => 'care4kids_footer',
                'type'    => 'textarea',
            ]
        );

        $wp_customize->add_setting(
            'care4kids_footer_link',
            [
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
                'transport'         => 'refresh',
            ]
        );

        $wp_customize->add_control(
            'care4kids_footer_link',
            [
                'label'   => __('Footer Link URL', 'care4kids'),
                'section' => 'care4kids_footer',
                'type'    => 'url',
            ]
        );

        $wp_customize->add_setting(
            'care4kids_footer_link_text',
            [
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'refresh',
            ]
        );

        $wp_customize->add_control(
            'care4kids_footer_link_text',
            [
                'label'   => __('Footer Link Text', 'care4kids'),
                'section' => 'care4kids_footer',
                'type'    => 'text',
            ]
        );

        $registered_menus = wp_get_nav_menus();
        $menu_choices     = ['' => __('— Select —', 'care4kids')];

        foreach ($registered_menus as $menu) {
            $menu_choices[$menu->term_id] = $menu->name;
        }

        for ($index = 1; $index <= 3; $index++) {
            $menu_setting_id  = sprintf('care4kids_footer_menu_%d', $index);
            $title_setting_id = sprintf('care4kids_footer_menu_%d_heading', $index);

            $wp_customize->add_setting(
                $menu_setting_id,
                [
                    'default'           => '',
                    'sanitize_callback' => 'care4kids_sanitize_menu_choice',
                    'transport'         => 'refresh',
                ]
            );

            $wp_customize->add_control(
                $menu_setting_id,
                [
                    'label'   => sprintf(__('Menu %d', 'care4kids'), $index),
                    'section' => 'care4kids_footer',
                    'type'    => 'select',
                    'choices' => $menu_choices,
                ]
            );

            $wp_customize->add_setting(
                $title_setting_id,
                [
                    'default'           => '',
                    'sanitize_callback' => 'sanitize_text_field',
                    'transport'         => 'refresh',
                ]
            );

            $wp_customize->add_control(
                $title_setting_id,
                [
                    'label'   => sprintf(__('Menu %d Heading', 'care4kids'), $index),
                    'section' => 'care4kids_footer',
                    'type'    => 'text',
                ]
            );
        }
    }
);
