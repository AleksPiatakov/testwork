<?php

$module_name = 'last_viewed_products';
if (isset($_POST['render'])) {
    $config = $template->checkConfig('MAINPAGE', 'M_VIEW_PRODUCTS');
}
$item_limit_mobile = (int)($config['limit_mobile']['val'] > 0 ? $config['limit_mobile']['val'] : 5);
$item_limit = (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 10);
$module_is_ajax = isset($config['ajax']['val']) && $config['ajax']['val'] == '1' ? true : false;
$tpl_settings = [
    'id' => 'last_viewed',
    'classes' => ($config['slider']['val'] == 1) ? ['product_slider'] : ['front_section'],
    'cols' => $config['cols']['val'] ?: 4,
    'limit' => isMobile() ? $item_limit_mobile : $item_limit,
    'title' => BOX_HEADING_LASTVIEWED,
];
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}
if (isset($_POST['render']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest' || !$module_is_ajax) {
    if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
        echo '<div class="' . ($template->getModuleSetting(
            'MAINPAGE',
            'M_VIEW_PRODUCTS',
            'content_width'
        ) ? 'container' : 'container-fluid') . '">';
    }

    if (is_file($rootPath . "ext/last_viewed_products/last_viewed_products.php")) {
        require_once $rootPath . "ext/last_viewed_products/last_viewed_products.php";
    }
    // include(DIR_WS_MODULES . 'last_viewed_products.php');
    if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
        echo '</div>';
    }
}
if ($module_is_ajax && !isset($_POST['render'])) {
    echo '<div data-module-id="' . $module_name . '" class="ajax-module-box lazy-data-block"><span class="lazy-data-loader"></span></div>';
}
