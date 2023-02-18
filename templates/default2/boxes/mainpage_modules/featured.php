<?php

$tpl_settings = [
    'id' => 'featured',
    'additional_title_block' => '<a class="link_whole_list" href="' . tep_href_link(
        'featured.html'
    ) . '">' . DEMO2_TITLE_SLIDER_LINK . '</a>',
    'classes' => ($config['slider']['val'] == 1) ? ['product_slider'] : ['front_section'],
    'cols' => $config['cols']['val'] ?: 4,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 10),
    'title' => BOX_HEADING_FEATURED,
];
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}

include(DIR_WS_MODULES . 'featured.php');
