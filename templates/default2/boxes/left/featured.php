<?php

$tpl_settings = array(
    'id' => 'left_featured',
    'additional_title_block' => '<a class="link_whole_list" href="' . tep_href_link(
        'featured.html'
    ) . '">' . DEMO2_LEFT_ALL_GOODS . '</a>',
    'classes' => ($config['slider']['val'] == 1) ? array('product_slider') : array('front_section'),
    'cols' => $config['cols']['val'] ?: 1,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 3),
    'title' => BOX_HEADING_FEATURED,
);
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsInline[] = generateOwlCarousel($tpl_settings);
}

echo '<div class="left_slider">';
include(DIR_WS_MODULES . 'featured.php');
echo '</div>';
