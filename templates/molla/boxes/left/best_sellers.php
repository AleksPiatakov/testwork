<?php

$tpl_settings = array(
    'id' => 'left_bestsellers',
    'classes' => ($config['slider']['val'] == 1) ? array('product_slider') : array('front_section'),
    'cols' => $config['cols']['val'] ?: 1,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 3),
    'title' => BOX_HEADING_BESTSELLERS,
);

if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsInline[] = generateOwlCarousel($tpl_settings);
}

include(DIR_WS_MODULES . 'best_sellers.php');
