<?php
function register_acf_block_types()
{

    acf_register_block_type(array(
        'name'              => 'separator',
        'title'             => __('separator'),
        'render_template'   => 'blocks/separator/separator.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('Kontener', 'separator'),
        'supports'    => [
            'align'      => false,
            'anchor'    => true,
            'customClassName'  => true,
            'jsx'       => false,
        ],
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-separator',  get_template_directory_uri() . '/blocks/separator/separator.min.css');
        }
    ));
    acf_register_block_type(array(
        'name'              => 'bg',
        'title'             => __('Tło - kontener'),
        'render_template'   => 'blocks/bg/bg.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('Kontener', 'bg'),
        'supports'    => [
            'align'      => false,
            'anchor'    => true,
            'customClassName'  => true,
            'jsx'       => true,
        ],
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-bg',  get_template_directory_uri() . '/blocks/bg/bg.min.css');
        }
    ));
    acf_register_block_type(array(
        'name'              => 'anchor',
        'title'             => __('Anchor'),
        'render_template'   => 'blocks/anchor/anchor.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('anchor'),
    ));
    acf_register_block_type(array(
        'name'              => 'sticky-sidebar',
        'title'             => __('Sticky sidebar'),
        'render_template'   => 'blocks/sticky-sidebar/sticky-sidebar.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('sticky-sidebar'),
        'supports'    => [
            'align'      => false,
            'anchor'    => false,
            'customClassName'  => false,
            'jsx'       => true,
        ],
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-sticky-sidebra',  get_template_directory_uri() . '/blocks/sticky-sidebar/sticky-sidebar.min.css');
            wp_enqueue_script('go-sticky-sidebra-js', get_template_directory_uri() . '/blocks/sticky-sidebar/sticky-sidebar.js', array('jquery'), '4', true);
        },
    ));
    acf_register_block_type(array(
        'name'              => 'bullets',
        'title'             => __('Bullets'),
        'render_template'   => 'blocks/bullets/bullets.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('Kontener', 'bullets'),
        'supports'    => [
            'align'      => false,
            'anchor'    => true,
            'customClassName'  => true,
            'jsx'       => false,
        ],
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-bullets',  get_template_directory_uri() . '/blocks/bullets/bullets.min.css');
            if (!wp_style_is('swiper', 'enqueued')) {
                wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11.1.4');
            }
            if (!wp_script_is('swiper', 'enqueued')) {
                wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11.1.4', true);
            }
            wp_enqueue_script('go-bullets-carousel', get_template_directory_uri() . '/blocks/bullets/bullets.js', array('swiper'), '1.0.0', true);
        }
    ));
    acf_register_block_type(array(
        'name'              => 'faq',
        'title'             => __('Najczęściej zadawane pytania'),
        'render_template'   => 'blocks/faq/faq.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('faq'),
        'supports' => array('align' => false),
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-faq',  get_template_directory_uri() . '/blocks/faq/faq.min.css');
            wp_enqueue_script('go-faq-init', get_template_directory_uri() . '/blocks/faq/faq.js', array('jquery'), '4', true);
        },
    ));
    acf_register_block_type(array(
        'name'              => 'title',
        'title'             => __('Title'),
        'render_template'   => 'blocks/title/title.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('Title'),
        'supports'    => [
            'align'      => true,
            'anchor'    => true,
            'customClassName'  => true,
            'jsx'       => false,
        ],
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-title',  get_template_directory_uri() . '/blocks/title/title.min.css');
        },
    ));
    acf_register_block_type(array(
        'name'              => 'img-section',
        'title'             => __('IMG section'),
        'render_template'   => 'blocks/img-section/img-section.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('img-section'),
        'supports'    => [
            'align'      => false,
            'anchor'    => true,
            'customClassName'  => true,
            'jsx'       => true,
        ],
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-img-section',  get_template_directory_uri() . '/blocks/img-section/img-section.min.css');
            // Enqueue GSAP from CDN
            wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', [], '3.12.5', true);
            wp_enqueue_script('gsap-scrolltrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', ['gsap'], '3.12.5', true);
            // Enqueue img-section script
            wp_enqueue_script('go-img-section-js', get_template_directory_uri() . '/blocks/img-section/img-section.js', ['gsap', 'gsap-scrolltrigger'], '1.0.0', true);
        },
    ));
    acf_register_block_type(array(
        'name'              => 'button-link',
        'title'             => __(' Przycisk '),
        'render_template'   => 'blocks/button/button.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('przycisk'),
        'supports' => array('align' => true),
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-button',  get_template_directory_uri() . '/blocks/button/button.min.css');
        },
    ));
    acf_register_block_type(array(
        'name'              => 'price-list',
        'title'             => __(' Table price list '),
        'render_template'   => 'blocks/price/price.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('Price'),
        'supports' => array('align' => true),
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-price',  get_template_directory_uri() . '/blocks/price/price.min.css');
        },
    ));
    acf_register_block_type(array(
        'name'              => 'banner',
        'title'             => __(' Banner '),
        'render_template'   => 'blocks/banner/banner.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('banner'),
        'supports' => array('align' => true),
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-banner',  get_template_directory_uri() . '/blocks/banner/banner.min.css');
            // Enqueue GSAP from CDN
            wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', [], '3.12.5', true);
            wp_enqueue_script('gsap-scrolltrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', ['gsap'], '3.12.5', true);
            // Enqueue banner script
            wp_enqueue_script('go-banner-js', get_template_directory_uri() . '/blocks/banner/banner.js', ['gsap', 'gsap-scrolltrigger'], '1.0.0', true);
        },
    ));
    acf_register_block_type(array(
        'name'              => 'steps',
        'title'             => __(' steps '),
        'render_template'   => 'blocks/steps/steps.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('Steps'),
        'supports' => array('align' => true),
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-steps',  get_template_directory_uri() . '/blocks/steps/steps.min.css');
        },
    ));
    acf_register_block_type(array(
        'name'              => 'works',
        'title'             => __(' How it works'),
        'render_template'   => 'blocks/works/works.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('works'),
        'supports' => array('align' => true),
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-works',  get_template_directory_uri() . '/blocks/works/works.min.css');
        },
    ));
    acf_register_block_type(array(
        'name'              => 'slider-fu',
        'title'             => __('Function slider'),
        'render_template'   => 'blocks/slider-fu/slider-fu.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('slider-function', 'function', 'slider'),
        'supports' => array('align' => true),
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-slider-fu',  get_template_directory_uri() . '/blocks/slider-fu/slider-fu.min.css');
            if (!wp_style_is('swiper', 'enqueued')) {
                wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11.1.4');
            }
            if (!wp_script_is('swiper', 'enqueued')) {
                wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11.1.4', true);
            }
            // Enqueue GSAP from CDN
            wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', [], '3.12.5', true);
            wp_enqueue_script('gsap-scrolltrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', ['gsap'], '3.12.5', true);
            wp_enqueue_script('go-slider-fu-js', get_template_directory_uri() . '/blocks/slider-fu/slider-fu.js', array('swiper', 'gsap', 'gsap-scrolltrigger'), '1.0.0', true);
        },
    ));
    acf_register_block_type(array(
        'name'              => 'info-contact',
        'title'             => __('Contact information'),
        'render_template'   => 'blocks/info-contact/info-contact.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('info-contactnction', 'function', 'slider'),
        'supports' => array('align' => true),
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-info-contact',  get_template_directory_uri() . '/blocks/info-contact/info-contact.min.css');
        },
    ));
    acf_register_block_type(array(
        'name'              => 'image',
        'title'             => __('Zdjęcie'),
        'render_template'   => 'blocks/image/image.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('image', 'zdjęcie'),
        'supports' => array('align' => true),
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-image',  get_template_directory_uri() . '/blocks/image/image.min.css');
            // Enqueue GSAP from CDN
            wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', [], '3.12.5', true);
            wp_enqueue_script('gsap-scrolltrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', ['gsap'], '3.12.5', true);
            // Enqueue image script
            wp_enqueue_script('go-image-js', get_template_directory_uri() . '/blocks/image/image.js', ['gsap', 'gsap-scrolltrigger'], '1.0.0', true);
        },
    ));
    acf_register_block_type(array(
        'name'              => 'banner-reviews',
        'title'             => __('Reviews banner'),
        'render_template'   => 'blocks/banner-reviews/banner-reviews.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('banner-reviews', 'banner'),
        'supports' => array('align' => true),
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-banner-reviews',  get_template_directory_uri() . '/blocks/banner-reviews/banner-reviews.min.css');
        },
    ));
    acf_register_block_type(array(
        'name'              => 'title-fun',
        'title'             => __('Nagłówek funkcji'),
        'render_template'   => 'blocks/title-fu/title-fu.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('title-fun'),
        'supports' => array('align' => true),
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-title-fun',  get_template_directory_uri() . '/blocks/title-fu/title-fu.min.css');
            // Enqueue GSAP from CDN
            wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', [], '3.12.5', true);
            wp_enqueue_script('gsap-scrolltrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', ['gsap'], '3.12.5', true);
            // Enqueue title-fu script
            wp_enqueue_script('go-title-fu-js', get_template_directory_uri() . '/blocks/title-fu/title-fu.js', ['gsap', 'gsap-scrolltrigger'], '1.0.0', true);
        },
    ));
    acf_register_block_type(array(
        'name'              => 'opinions',
        'title'             => __('Opinions'),
        'render_template'   => 'blocks/opinions/opinions.php',
        'category'          => 'formatting',
        'icon' => array(
            'background' => '#0e4194',
            'foreground' => '#fff',
            'src' => 'ellipsis',
        ),
        'mode'            => 'preview',
        'keywords'          => array('opinions'),
        'supports' => array('align' => true),
        'enqueue_assets'    => function () {
            wp_enqueue_style('go-opinions',  get_template_directory_uri() . '/blocks/opinions/opinions.min.css');
            if (!wp_style_is('swiper', 'enqueued')) {
                wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11.1.4');
            }
            if (!wp_script_is('swiper', 'enqueued')) {
                wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11.1.4', true);
            }
            wp_enqueue_script('go-opinions-carousel', get_template_directory_uri() . '/blocks/opinions/opinions.js', array('swiper'), '1.0.0', true);
        },
    ));
}
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_acf_block_types');
}

function my_acf_json_save_point($path)
{
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}
add_filter('acf/settings/save_json', 'my_acf_json_save_point');