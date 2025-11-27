<?php
$class_name = 'b-ornament';
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

$icon = get_field('icon');
$position = get_field('position');

// Map icon values to SVG files
$icon_map = array(
    1 => 'arrow.svg',
    2 => 'love.svg',
    3 => 'smile.svg',
    4 => '__.svg',
    5 => '_.svg',
);

// Get the SVG filename based on icon selection
$svg_file = '';
if (!empty($icon) && isset($icon_map[$icon])) {
    $svg_file = $icon_map[$icon];
}

// Determine position class
$position_class = '';
if ($position == 1) {
    $position_class = 'b-ornament--left';
} elseif ($position == 2) {
    $position_class = 'b-ornament--right';
}

// Only render if icon is selected
if (!empty($svg_file)):
    $svg_path = get_template_directory() . '/blocks/ornament/img/' . $svg_file;
    if (file_exists($svg_path)):
?>
        <div class="<?php echo esc_attr($class_name); ?> <?php echo esc_attr($position_class); ?>" <?php echo $anchor; ?>>
            <div class="b-ornament__svg-wrapper">
                <?php echo file_get_contents($svg_path); ?>
            </div>
        </div>
<?php
    endif;
endif;
?>