<?php
$bg = get_field('bg');
$front_img = get_field('front_img');
$position = get_field('position');

$class_name = 'b-img-section';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

// Position class: 1 = Left, 2 = Right
$position_class = ($position == 2) ? 'img-right' : 'img-left';
?>

<div class="<?php echo esc_attr($class_name); ?> <?php echo esc_attr($position_class); ?>">
    <div class="container">
        <div class="b-img-section__grid">
            <?php if ($position == 2) : ?>
                <!-- Content column first when images are on the right -->
                <div class="b-img-section__content">
                    <InnerBlocks />
                </div>
                <div class="b-img-section__images">
                    <?php if ($bg) : ?>
                        <?php
                        $bg_url = wp_get_attachment_image_url($bg, 'full');
                        ?>
                        <div class="b-img-section__bg">
                            <img src="<?php echo esc_url($bg_url); ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <?php if ($front_img) : ?>
                        <?php
                        $front_img_url = wp_get_attachment_image_url($front_img, 'full');
                        ?>
                        <div class="b-img-section__front">
                            <img src="<?php echo esc_url($front_img_url); ?>" alt="">
                        </div>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <!-- Images column first when images are on the left -->
                <div class="b-img-section__images">
                    <?php if ($bg) : ?>
                        <?php
                        $bg_url = wp_get_attachment_image_url($bg, 'full');
                        ?>
                        <div class="b-img-section__bg">
                            <img src="<?php echo esc_url($bg_url); ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <?php if ($front_img) : ?>
                        <?php
                        $front_img_url = wp_get_attachment_image_url($front_img, 'full');
                        ?>
                        <div class="b-img-section__front">
                            <img src="<?php echo esc_url($front_img_url); ?>" alt="">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="b-img-section__content">
                    <InnerBlocks />
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>