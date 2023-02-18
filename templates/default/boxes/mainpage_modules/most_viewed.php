<?php

if (isset($_POST['render'])) {
    $config = $template->checkConfig('MAINPAGE', 'M_MOST_VIEWED');
}
$module_is_ajax = isset($config['ajax']['val']) && $config['ajax']['val'] == '1' ? true : false;
$item_limit_mobile = (int)($config['limit_mobile']['val'] > 0 ? $config['limit_mobile']['val'] : 3);
$item_limit = (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 3);
$tpl_settings = [
    'id' => 'most_viewed',
    'classes' => ($config['slider']['val'] == 1) ? ['product_slider'] : ['front_section'],
    'cols' => $config['cols']['val'] ?: 4,
    'limit' => isMobile() ? $item_limit_mobile : $item_limit,
    'title' => MAIN_MOSTVIEWED,
];
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}
if (isset($_POST['render']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest' || !$module_is_ajax) {
    if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
        echo '<div class="' . ($template->getModuleSetting(
            'MAINPAGE',
            'M_MOST_VIEWED',
            'content_width'
        ) ? 'container' : 'container-fluid') . '">';
    }
    include(DIR_WS_MODULES . 'most_viewed.php');

    if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
        echo '</div>';
    }
}
if ($module_is_ajax && !isset($_POST['render'])) {
    echo '<div data-module-id="' . $tpl_settings['id'] . '" class="ajax-module-box lazy-data-block"><span class="lazy-data-loader"></span></div>';
}
