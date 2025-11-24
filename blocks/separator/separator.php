<?php
$haight = get_field('wysomosc');

$class_name = 'custome-separator ';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
$id = 'sep-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo $class_name; ?> sep-<?php echo $haight; ?>"></div>