<?php

chdir('../../');
$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
$sideApp = true;
require_once $rootPath . '/includes/application_top.php';
require_once $rootPath . '/ext/export_facebook_feed/check.php';
$facebookFeedPath = $rootPath . '/ext/export_facebook_feed/facebook_feed.php';
if (file_exists($facebookFeedPath) && defined('EXPORT_FACEBOOK_FEED_MODULE_ENABLED') && constant('EXPORT_FACEBOOK_FEED_MODULE_ENABLED') == 'true') {
    require($facebookFeedPath);
} else {
    die('buy or enable module');
}
