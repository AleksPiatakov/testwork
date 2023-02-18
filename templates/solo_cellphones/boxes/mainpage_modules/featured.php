<?php

$tpl_settings = [
    'id' => 'featured',
    'classes' => ($config['slider']['val'] == 1) ? ['product_slider'] : ['front_section'],
    'cols' => $config['cols']['val'] ?: 4,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val']: 10),
    'title' => BOX_HEADING_FEATURED,
];
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}

echo '<div class="white-rounded-box wide-featured-block">';
include(DIR_WS_MODULES . 'default_specials.php');
echo '</div>';
