<?php

chdir('../../');
$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
$sideApp = true;

require_once $rootPath . '/includes/application_top.php';

if (strpos($_SERVER['REQUEST_URI'], '.php')) {
    tep_redirect(str_replace('.php', '.xml', $_SERVER['REQUEST_URI']));
}

require_once $rootPath . '/ext/export_priceua/check.php';
$priceUaPath = $rootPath . '/ext/export_priceua/priceua.php';
if (file_exists($priceUaPath) && getConstantValue('EXPORT_PRICEUA_MODULE_ENABLED')  == 'true') {
    require($priceUaPath);
} else {
    die('buy or enable module');
}
