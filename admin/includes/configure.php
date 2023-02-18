<?php
/*
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// Define the webserver and path parameters
// * DIR_FS_* = Filesystem directories (local/physical)
// * DIR_WS_* = Webserver directories (virtual/URL)

// шукаємо корінь (перша папка в якій є index.php)
/*$path_arr = explode('/', $_SERVER['SCRIPT_FILENAME']);
$tmp_path_arr = array();
$delnext = 0;
foreach ($path_arr as $k => $val) {
    $tmp_path_arr[] = $val;
    $curr_path = implode('/', $tmp_path_arr) . '/index.php';
    if (@file_exists($curr_path) or $delnext >= 1) $delnext++;
    if ($delnext > 1) unset($path_arr[$k]);
}
$path = implode('/', $path_arr) . '/';
$rootPath = dirname($_SERVER['SCRIPT_FILENAME']);
require($path . 'includes/sm_config.php');   */

if ($rootPath=='')
    $rootPath=dirname(dirname($_SERVER['SCRIPT_FILENAME']));
$path=$rootPath . '/';
//require($path . 'includes/sm_config.php');

$admin=getenv('ADMIN_FOLDER');  // admin folder
$add_folder = getenv('CATALOG_FOLDER')!=''?'/'.getenv('CATALOG_FOLDER'):'';

define('DIR_ROOT', dirname(dirname(dirname(__FILE__)))); // absolute pate required

//define('HTTP_SERVER', 'http://' . $_SERVER['HTTP_HOST']); // eg, http://localhost - should not be empty for productive servers
//define('HTTP_CATALOG_SERVER', 'http://' . $_SERVER['HTTP_HOST']);
//define('HTTPS_CATALOG_SERVER', 'https://' . $_SERVER['HTTP_HOST']);
//define('ENABLE_SSL_CATALOG', 'false'); // secure webserver for catalog module

define('CLASS_PATH',$admin.'\includes\solomono\app\models');
define('DB_ERR_MAIL','admin@solomono.net');
define('VIEW_PATH',$admin.'/includes/solomono/app/view/');
define('DS', DIRECTORY_SEPARATOR); // where the pages are located on the server
define('DIR_FS_DOCUMENT_ROOT', $path); // where the pages are located on the server
define('DIR_WS_ADMIN', '/' . $admin . '/'); // absolute path required
define('DIR_FS_ADMIN', $path . $admin . '/'); // absolute path required
define('DIR_WS_CATALOG', '/'); // absolute path required
define('DIR_FS_CATALOG', $path); // absolute path required
define('DIR_WS_IMAGES', 'images/');
define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
define('DIR_WS_CATALOG_IMAGES', DIR_WS_CATALOG . 'images/');
define('DIR_WS_EXT', DIR_WS_CATALOG . 'ext/');
define('DIR_FS_LOGS', DIR_FS_DOCUMENT_ROOT . 'storage/logs');
define('DIR_WS_INCLUDES', 'includes/');
define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
define('DIR_WS_ASSETS', DIR_WS_INCLUDES . 'assets/');
define('DIR_WS_TABS', DIR_WS_INCLUDES . 'material/blocks/tabs/');
define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
define('DIR_WS_CATALOG_LANGUAGES', DIR_WS_CATALOG . DIR_WS_INCLUDES . 'languages/');
define('DIR_FS_CATALOG_LANGUAGES', DIR_FS_CATALOG . DIR_WS_INCLUDES . 'languages/');
define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG . 'images/');
define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . DIR_WS_INCLUDES . 'modules/');
define('DIR_FS_CATALOG_MODULES_SHIPPING', DIR_FS_CATALOG_MODULES . 'shipping/');
define('DIR_FS_CATALOG_CLASSES', DIR_FS_CATALOG . DIR_WS_INCLUDES . 'classes/');
define('DIR_FS_BACKUP', DIR_FS_ADMIN . 'backups/');
define('DIR_FS_EXT', DIR_ROOT . '/ext/');
define('BACKUP_FOLDER', DIR_FS_ADMIN . 'backups/');
//define('BACKUP_FOLDER', DIR_FS_ADMIN . 'includes/modules/backup/dumps/');

// Added for Templating
define('DIR_FS_CATALOG_MAINPAGE_MODULES', DIR_FS_CATALOG_MODULES . 'mainpage_modules/');
define('DIR_WS_TEMPLATES', DIR_WS_CATALOG . 'templates/');
define('DIR_FS_TEMPLATES', DIR_FS_CATALOG . 'templates/');

// define our database connection
define('DB_SERVER', getenv('DB_HOST')); // eg, localhost - should not be empty for productive servers
define('DB_SERVER_USERNAME', getenv('DB_USERNAME'));
define('DB_SERVER_PASSWORD', getenv('DB_PASSWORD'));
define('DB_DATABASE', getenv('DB_DATABASE'));
define('DB_TIME_ZONE', getenv('TIME_ZONE'));
define('USE_PCONNECT', 'false'); // use persisstent connections?
define('STORE_SESSIONS', 'mysql'); // leave empty '' for default handler or set to 'mysql'
define('SOLOMONO_SITE','solomono.net');
define('SMTP_CONFIGURATION_GROUP_ID', 17);
define('SMTP_CONFIGURATION_GROUP_ID', 17);
define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
?>