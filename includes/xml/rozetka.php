<?php

chdir('../../');
$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
$sideApp = true;
require $rootPath . '/includes/application_top.php';
if (strpos($_SERVER['REQUEST_URI'], '.php')) {
    tep_redirect(str_replace('.php', '.xml', $_SERVER['REQUEST_URI']));
}

$rozetkaPath = $rootPath . '/ext/export_rozetka/rozetka.php';
if (file_exists($rozetkaPath) && defined('EXPORT_ROZETKA_MODULE_ENABLED') && constant('EXPORT_ROZETKA_MODULE_ENABLED') == 'true') {
    require_once $rootPath . '/ext/export_rozetka/check.php';
    require($rozetkaPath);
} else {
    die('buy or enable module');
}
