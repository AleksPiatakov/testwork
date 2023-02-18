<?php

$path = __DIR__ . '/../';

$admin = getenv('ADMIN_FOLDER');  // admin folder
$add_folder = !empty(getenv('CATALOG_FOLDER')) ? '/' . getenv('CATALOG_FOLDER') : '';
define('DIR_ROOT', dirname(dirname(__FILE__))); // absolute path required

define('CLASS_PATH', 'admin\includes\solomono\app\models');
define('VIEW_PATH', $path . $admin . '/includes/solomono/app/view/');

define('HTTP_COOKIE_DOMAIN', '');
//define('HTTPS_COOKIE_DOMAIN', $_SERVER['HTTP_HOST']);
define('HTTP_COOKIE_PATH', '/');
//define('HTTPS_COOKIE_PATH', '/');
define('DIR_WS_HTTP_CATALOG', '/');
define('DIR_WS_HTTPS_CATALOG', '/');
define('DIR_WS_CATALOG', DIR_WS_HTTP_CATALOG);


define('DIR_WS_IMAGES', 'images/');
define('DIR_WS_IMAGES_CDN', 'images/');
define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
if (!defined('DIR_WS_INCLUDES')) {
    define('DIR_WS_INCLUDES', 'includes/');
}
define("DIR_WS_EXT", "ext/");
define("DIR_FS_EXT", $path . "ext/");
define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
if (!defined('DIR_WS_FUNCTIONS')) {
    define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
}
define('DIR_WS_CLASSES', $path . DIR_WS_INCLUDES . 'classes/');
define('DIR_WS_MODULES', $path . DIR_WS_INCLUDES . 'modules/');
define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
//Added for BTS1.0
define('DIR_WS_TEMPLATES', 'templates/');
define('DIR_WS_DEFAULT_TEMPLATE_NAME', 'default/');
define('DIR_WS_CONTENT', DIR_WS_TEMPLATES . DIR_WS_DEFAULT_TEMPLATE_NAME . 'content/');
define('DIR_WS_JAVASCRIPT', DIR_WS_INCLUDES . 'javascript/');
//End BTS1.0
define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
define('DIR_FS_CATALOG', $path);
define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');
define('DIR_WS_ADMIN', '/' . $admin . '/'); // absolute path required
define('DIR_FS_ADMIN', $path . DIR_WS_ADMIN); // absolute pate required
define('DIR_FS_LOGS', $path . 'storage/logs');
define('BACKUP_FOLDER', DIR_FS_ADMIN . 'backups/');

// define our database connection
define('DB_SERVER', getenv('DB_HOST')); // eg, localhost - should not be empty for productive servers
define('DB_SERVER_USERNAME', getenv('DB_USERNAME'));
define('DB_SERVER_PASSWORD', getenv('DB_PASSWORD'));
define('DB_DATABASE', getenv('DB_DATABASE'));
define('DB_TIME_ZONE', getenv('TIME_ZONE'));
define('USE_PCONNECT', 'false'); // use persistent connections?
define('STORE_SESSIONS', 'mysql'); // leave empty '' for default handler or set to 'mysql'
