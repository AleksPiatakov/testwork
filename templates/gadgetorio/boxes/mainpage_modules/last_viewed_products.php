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
    'id' => 'last_viewed',
    'classes' => $classes,
    'cols' => $config['cols']['val'] ?: 4,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 3),
    'title' => BOX_HEADING_LASTVIEWED,
);

if (in_array('product_slider', $tpl_settings['classes'])) {
    $grid_class = 'products-slider-block';// add <div> if slider view
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
} else {
    $grid_class = 'products-grid-block';// add <div> if grid view
}

echo '<div class="' . $grid_class . ' white-rounded-box">';
if (is_file($rootPath . "ext/last_viewed_products/last_viewed_products.php")) {
    require_once $rootPath . "ext/last_viewed_products/last_viewed_products.php";
}
echo '</div>';
