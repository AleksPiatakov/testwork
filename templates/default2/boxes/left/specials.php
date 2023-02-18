<?php

$tpl_settings = array(
    'id' => 'left_specials',
    'additional_title_block' => '<a class="link_whole_list" href="' . tep_href_link(
        'specials.html'
    ) . '">' . DEMO2_LEFT_ALL_GOODS . '</a>',
    'classes' => ($config['slider']['val'] == 1) ? array('product_slider') : array('front_section'),
    'cols' => $config['cols']['val'] ?: 1,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 5),
    'title' => BOX_HEADING_SPECIALS,
);
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsInline[] = generateOwlCarousel($tpl_settings);
}
echo '<div class="left_slider">';
include(DIR_WS_MODULES . 'default_specials.php');
echo '</div>';
