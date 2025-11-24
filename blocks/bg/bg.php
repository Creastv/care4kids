<?php
$bg = get_field('bg_color');
$bgSecond = get_field('bg_color_sec');
$h = get_field('height');
$p = get_field('position');
$img = get_field('zdjecie');
$size = get_field('size');
$sizeClass = 'container';
$bgStyle = get_field('bg_color_style');
$bgClass = '';
if ($bgStyle == 1) {
    $bgClass = '';
} else {
    $bgClass = 'o-hidden';
}

if ($size == 1) {
    $sizeClass = 'container';
} elseif ($size == 2) {
    $sizeClass = 'container-middel';
} elseif ($size == 3) {
    $sizeClass = 'container-narrow';
} else {
    $sizeClass = 'overflow-h';
}

$position = '';
if ($p == 1) {
    $position = 'top:0;';
} else {
    $position = 'bottom:0;';
}
$class_name = 'b-bg';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}


?>

<div class="<?php echo esc_attr($class_name); ?> <?php echo $bgClass; ?>">


    <div class="<?php echo $sizeClass; ?>">
        <div class="b-bg-apla "
            style="background-color:<?php echo $bg; ?>; height:<?php echo $h; ?>%; <?php echo $position; ?>; background-image:url(<?php echo $img; ?>) ">
        </div>
        <InnerBlocks />
        <?php if ($bgSecond) : ?>
        <div class="b-bg-apla "
            style="background-color:<?php echo $bgSecond; ?>; height:100%; top:0;     z-index: -99999; ">
        </div>
        <?php endif; ?>
    </div>

</div>