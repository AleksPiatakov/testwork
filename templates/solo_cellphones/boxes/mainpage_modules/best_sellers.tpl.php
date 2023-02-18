<?php

$tpl_settings = [
    'id' => 'best_sellers',
    'classes' => ($config['slider']['val'] == 1) ? ['product_slider'] : ['front_section'],
    'cols' => $config['cols']['val'] ?: 4,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 3),
    'title' => MAIN_BESTSELLERS,
];
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}

echo '<div class="white-rounded-box">';
include(DIR_WS_MODULES . 'best_sellers.php');
echo '</div>';
