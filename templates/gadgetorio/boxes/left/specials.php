<?php

$tpl_settings = array(
    'id' => 'left_specials',
    'classes' => ($config['slider']['val'] == 1) ? array('product_slider') : array('front_section'),
    'cols' => $config['cols']['val'] ?: 1,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 5),
    'title' => BOX_HEADING_SPECIALS,
);
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsInline[] = generateOwlCarousel($tpl_settings);
}

echo '<div class="left_block">';
include(DIR_WS_MODULES . 'default_specials.php');
echo '</div>';
