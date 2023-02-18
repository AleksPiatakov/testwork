<?php

chdir('../../');
$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
$sideApp = true;
require_once $rootPath . '/includes/application_top.php';
if (strpos($_SERVER['REQUEST_URI'], '.php')) {
    tep_redirect(str_replace('.php', '.xml', $_SERVER['REQUEST_URI']));
}
require_once $rootPath . '/ext/export_promua/check.php';
$promUaPath = $rootPath . '/ext/export_promua/promua.php';
if (file_exists($promUaPath) && defined('EXPORT_PROMUA_MODULE_ENABLED') && constant('EXPORT_PROMUA_MODULE_ENABLED') == 'true') {
    require($promUaPath);
} else {
    die('buy or enable module');
}
