<?php

// XML EXPORT
chdir('../../');
$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
require_once $rootPath . '/includes/application_top.php';
if (strpos($_SERVER['REQUEST_URI'], '.php')) {
    tep_redirect(str_replace('.php', '.xml', $_SERVER['REQUEST_URI']));
}

require_once $rootPath . '/ext/yandex_market/check.php';
$yandexMarketPath = $rootPath . '/ext/yandex_market/yandex_market.php';
if (file_exists($yandexMarketPath) && defined('YANDEX_MARKET_MODULE_ENABLED') && constant('YANDEX_MARKET_MODULE_ENABLED') == 'true') {
    require($yandexMarketPath);
} else {
    die('buy or enable module');
}
