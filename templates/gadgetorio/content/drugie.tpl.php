<?php

$tpl_settings = array(
    'id' => 'drugie',
    'classes' => array('product_slider'),
    'cols' => $config['cols']['val'] ?: 4,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 10),
    'title' => PROD_DRUGIE,
);

//  echo '<div class="products-grid-block white-rounded-box">';
echo '<div class="products-slider-block white-rounded-box">';
include(DIR_WS_MODULES . 'drugie.php');
echo '</div>';
