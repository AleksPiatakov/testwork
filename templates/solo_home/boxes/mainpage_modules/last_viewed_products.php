<?php

$tpl_settings = [
    'id' => 'last_viewed',
    'classes' => ($config['slider']['val'] == 1) ? ['product_slider'] : ['front_section'],
    'cols' => $config['cols']['val'] ?: 6,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 10),
    'wishlist' => true,
    'title' => BOX_HEADING_LASTVIEWED,
];
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}

if (is_file($rootPath . "ext/last_viewed_products/last_viewed_products.php")) {
    require_once $rootPath . "ext/last_viewed_products/last_viewed_products.php";
}
