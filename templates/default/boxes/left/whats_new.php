<?php

$tpl_settings = array(
    'id' => 'left_whatsnew',
    'classes' => ($config['slider']['val'] == 1) ? array('product_slider') : array('front_section'),
    'cols' => $config['cols']['val'] ?: 1,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 4),
    'title' => BOX_HEADING_WHATS_NEW,
);

if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsInline[] = generateOwlCarousel($tpl_settings);
}

include(DIR_WS_MODULES . 'new_products.php');
