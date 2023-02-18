<?php

$tpl_settings = [
    'id' => 'most_viewed',
    'classes' => ($config['slider']['val'] == 1) ? ['product_slider'] : ['front_section'],
    'cols' => $config['cols']['val'] ?: 6,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 10),
    'title' => MAIN_MOSTVIEWED,
];
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}

include(DIR_WS_MODULES . 'most_viewed.php');
