<?php
$title = get_field('title');
$subtitle = get_field('label');
$tag = get_field('tag');
$description = get_field('description');
$link = get_field('link');
if ($link) :
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif;

$class_name = ' bc-title';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}
if ($link) {
    $class_name .= ' has-link';
}

?>

<div class=" <?php echo esc_attr($class_name); ?>" <?php echo esc_attr($anchor); ?>>
    <?php if ($link): ?>
    <div class="has-link-content">
        <?php endif; ?>

        <?php if ($subtitle) : ?>
        <p class="bc-title__subtitle"><em><?php echo $subtitle; ?></em></p>
        <?php endif; ?>
        <div class="bc-title__wrap">
            <<?php echo $tag; ?> class="bc-title__title">
                <?php echo $title; ?>
            </<?php echo $tag; ?>>
        </div>

        <?php if ($description) : ?>
        <div class="bc-title__description"><?php echo $description; ?></div>
        <?php endif; ?>

        <?php if ($link): ?>
    </div>
    <?php endif; ?>
    <?php if ($link) : ?>
    <a class="btn btn--primary" href="<?php echo esc_url($link_url); ?>"
        target="<?php echo esc_attr($link_target); ?>"><?php echo $link_title; ?></a>
    <?php endif; ?>
</div>