<?php

$tpl_settings = [
    'id' => 'new_products',
    'classes' => ($config['slider']['val'] == 1) ? ['product_slider'] : ['front_section'],
    'cols' => $config['cols']['val'] ?: 4,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val']: 8),
    'title' => BOX_HEADING_WHATS_NEW,
];

if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}
if (!$tpl_settings['classes']) {
    // add <div> if grid view
    echo '<div class="products-grid-block five-per-row white-rounded-box">';
    include(DIR_WS_MODULES . 'new_products.php');
    echo '</div>';
} elseif ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    include(DIR_WS_MODULES . 'new_products.php');
} else {
    // add <div> if slider view
    echo '<div class="products-slider-block">';
    include(DIR_WS_MODULES . 'new_products.php');
    echo '</div>';
}
