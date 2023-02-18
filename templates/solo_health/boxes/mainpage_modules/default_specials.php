<?php

$tpl_settings = [
    'id' => 'specials',
    'classes' => ($config['slider']['val'] == 1) ? ['product_slider'] : ['front_section'],
    'cols' => $config['cols']['val'] ?: 4,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 10),
    'title' => $remove_title ? false : sprintf(TABLE_HEADING_DEFAULT_SPECIALS, tep_date_long_translate(strftime('%B'))),
];
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}

echo '<div class="white-rounded-box wide-specials-block">';
include(DIR_WS_MODULES . 'default_specials.php');
echo '</div>';
