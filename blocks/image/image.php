<?php
$image_id = get_field('image');

$class_name = 'b-image';
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
?>

<?php if ($image_id) : ?>
<section class="<?php echo esc_attr($class_name); ?>" <?php echo $anchor; ?>>
    <div class="b-image__wrapper">
        <div class="b-image__container">
            <?php echo wp_get_attachment_image($image_id, 'full', false, ['class' => 'b-image__img']); ?>
        </div>
    </div>
</section>
<?php endif; ?>