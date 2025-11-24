<?php
$class_name = 'b-banner-reviews';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '"';
}

// Get ACF fields
$images = get_field('images'); // Repeater field for profile images
$text_before = get_field('desc') ?: 'Zaufało nam ponad';
$text_after = get_field('desc_sufix') ?: 'rodziców';
?>

<div class="<?php echo esc_attr($class_name); ?>" <?php echo $anchor; ?>>
    <div class="b-banner-reviews__wrapper">
        <?php if (!empty($images) && is_array($images)) : ?>
        <div class="b-banner-reviews__images">
            <?php foreach ($images as $index => $image_row) :
                    // Handle both repeater format (with 'image' sub_field) and simple array format
                    if (is_array($image_row)) {
                        $image_id = $image_row['image'] ?? ($image_row['ID'] ?? $image_row);
                    } else {
                        $image_id = $image_row;
                    }

                    if (empty($image_id)) continue;

                    $img_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                    $img_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: '';
                ?>
            <div class="b-banner-reviews__image">
                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" width="29"
                    height="29">
            </div>
            <?php endforeach; ?>

        </div>
        <?php endif; ?>

        <p class="b-banner-reviews__text">
            <span class="b-banner-reviews__text-normal"><?php echo esc_html($text_before); ?> </span>
            <span class="b-banner-reviews__text-handwritten"> <?php echo esc_html($text_after); ?></span>
        </p>
    </div>
</div>