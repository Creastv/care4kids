<?php
$nav = get_field('navigacja');
?>
<div class="b-sticky-con">
    <div class="grid">
        <div class="col col-9_lg-9_md-9_sm-8_xs-12 ">
            <InnerBlocks />
        </div>
        <?php if ($nav) { ?>
        <div class="col col-3_lg-3_md-3_sm-4_xs-12 ">
            <div class="sticky-nav">
                <h4><?php echo esc_html('Spis treści'); ?></h4>
                <nav>
                    <ul>
                        <?php foreach ($nav as $item) {
                                $link = $item['link'];
                                if ($link) {
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                }
                            ?>
                        <li>
                            <a class="dot" href="<?php echo esc_url($link_url); ?>"
                                target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
        <?php } ?>
    </div>
</div>