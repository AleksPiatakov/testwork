<?php

$tpl_settings = [
    'id' => 'specials',
    'additional_title_block' => '<a class="link_whole_list" href="' . tep_href_link(
        'specials.html'
    ) . '">' . DEMO2_TITLE_SLIDER_LINK . '</a>',
    'classes' => ($config['slider']['val'] == 1) ? ['product_slider'] : ['front_section'],
    'cols' => $config['cols']['val'] ?: 4,
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 3),
    'title' => sprintf(TABLE_HEADING_DEFAULT_SPECIALS, tep_date_long_translate(strftime('%B'))),
];
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}

include(DIR_WS_MODULES . 'default_specials.php');
