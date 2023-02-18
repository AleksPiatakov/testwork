<?php

require __DIR__ . '/../vendor/autoload.php';

$rootPath = __DIR__ . "/../";

ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);

define('DIR_WS_INCLUDES', 'includes/');
define('DIR_WS_FUNCTIONS', __DIR__ . '/functions/');

date_default_timezone_set('UTC');

require_once __DIR__ . "/bootstrap.php";
require_once __DIR__ . '/configure.php';
require_once __DIR__ . '/filenames.php';
require_once __DIR__ . '/database_tables.php';
require_once DIR_WS_FUNCTIONS . 'database.php';

tep_db_connect() or die('Unable to connect to database server!');

$configuration_query = tep_db_query(
    '
    select configuration_key as cfgKey
         , configuration_value as cfgValue
    from ' . TABLE_CONFIGURATION
);

while ($configuration = tep_db_fetch_array($configuration_query)) {
    $check_modules_folders = explode(':', $configuration['cfgValue']);
    if (
        count(
            $check_modules_folders
        ) > 1 && ($check_modules_folders[1] == 'true' or $check_modules_folders[1] == 'false')
    ) {
        if (is_dir(DIR_FS_CATALOG . 'ext/' . $check_modules_folders[0])) {
            define($configuration['cfgKey'], $check_modules_folders[1]);
        } else {
            define($configuration['cfgKey'], 'false');
        }
    } else {
        define($configuration['cfgKey'], $configuration['cfgValue']);
    }
}

define('HTTP_SERVER',
    ((defined('SET_HTTPS') && (SET_HTTPS == 'true')) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $add_folder);

require_once DIR_WS_FUNCTIONS . 'general.php';
require_once DIR_WS_FUNCTIONS . 'constants.php';
require_once DIR_WS_FUNCTIONS . 'html_output.php';
require_once DIR_WS_FUNCTIONS . 'extra_product_price.php';
require_once DIR_WS_MODULES . 'rating/rating.php';
require_once DIR_WS_CLASSES . 'shopping_cart.php';
require_once DIR_WS_CLASSES . 'wishlist.php';

if (php_sapi_name() == "cli") {
    echo "<<< CLI MODE ENABLED >>>" . PHP_EOL;
}
