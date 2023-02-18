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

if (!$tpl_settings['classes']) {
    // add <div> if grid view
    echo '<div class="left_block">';
    include(DIR_WS_MODULES . 'new_products.php');
    echo '</div>';
} elseif ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    include(DIR_WS_MODULES . 'new_products.php');
} else {
    // add <div> if slider view
    echo '<div class="left_block">';
    include(DIR_WS_MODULES . 'new_products.php');
    echo '</div>';
}
