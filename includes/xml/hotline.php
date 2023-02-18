<?php

chdir('../../');
$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
$sideApp = true;
require_once $rootPath . '/includes/application_top.php';

if (strpos($_SERVER['REQUEST_URI'], '.php')) {
    tep_redirect(str_replace('.php', '.xml', $_SERVER['REQUEST_URI']));
}

require_once $rootPath . '/ext/export_hotline/check.php';
$hotlinePath = $rootPath . '/ext/export_hotline/hotline.php';
if (file_exists($hotlinePath) && defined('EXPORT_HOTLINE_MODULE_ENABLED') && constant('EXPORT_HOTLINE_MODULE_ENABLED') == 'true') {
    require($hotlinePath);
} else {
    die('buy or enable module');
}
