<?php

$tpl_cols = explode(';', $config['cols']['val']);

if ($config['slider']['val'] == 1) {
    $classes = array('product_slider');
} else {
    $classes = array(
        'front_section ',
        'cc-xs-' . $tpl_cols[0],
        'cc-sm-' . $tpl_cols[1],
        'cc-md-' . $tpl_cols[2],
        'cc-lg-' . $tpl_cols[3]
    );
}

$tpl_settings = array(
    'id' => 'new_products',
    'classes' => $classes,
    'cols' => $config['cols']['val'] ?: 3,
    'limit' => (int)($config['limit']['val'] > 0 ?$config['limit']['val']: 8),
    'title' => BOX_HEADING_WHATS_NEW,
);


if (in_array('product_slider', $tpl_settings['classes'])) {
    $grid_class = 'products-slider-block';// add <div> if slider view
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
} else {
    $grid_class = 'products-grid-block';// add <div> if grid view
}

echo '<div class="' . $grid_class . ' white-rounded-box">';
include(DIR_WS_MODULES . 'new_products.php');
echo '</div>';
