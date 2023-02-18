<?php

chdir('../../');
$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
$sideApp = true;
require $rootPath . '/includes/application_top.php';

if (strpos($_SERVER['REQUEST_URI'], '.php')) {
    tep_redirect(str_replace('.php', '.xml', $_SERVER['REQUEST_URI']));
}

$googleFeedPath = $rootPath . '/ext/google_feed/google_feed.php';
if (file_exists($googleFeedPath) && defined('GOOGLE_FEED_MODULE_ENABLED') && constant('GOOGLE_FEED_MODULE_ENABLED') == 'true') {
    require($googleFeedPath);
} else {
    die('buy or enable module');
}
