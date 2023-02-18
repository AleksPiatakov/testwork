<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    require('includes/application_top.php');
    if (is_array($all_active_cats = $cat_list[0])) {
        $all_active_cats = implode(',', $all_active_cats);
    } else {
        $all_active_cats = 0;
    }
    $filename = $_GET['fName'];
    $conf = $template->config['MAINPAGE_modules']['M_' . strtoupper($filename)];
    $tpl_settings['limit'] = (int)(($conf['limit']['val'] ?: 10));
    $tpl_settings['cols'] = $conf['cols']['val'] ?: 2;
//    require(DIR_WS_TEMPLATES . TEMPLATE_NAME . "/boxes/mainpage_modules/$filename.php");
    require(DIR_WS_MODULES . "/$filename.php");
}
