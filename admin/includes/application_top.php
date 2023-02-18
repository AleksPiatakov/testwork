<?php
/*
  $Id: application_top.php,v 1.2 2003/09/24 13:57:07 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

require __DIR__.'/../../vendor/autoload.php';

/**
 * Used in admin function tep_db_prepare_input to save escape strings
 */
$saveDbPrepareInput = [];

define('DIR_WS_INCLUDES', 'includes/');
define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
define('BUY_MODULES_LINK', 'https://solomono.net/modules-for-oscommerce/c-383.html');

if(ini_get('date.timezone')=='') date_default_timezone_set('Europe/Kiev');

$rootPath = $rootPath ?? dirname(dirname($_SERVER['SCRIPT_FILENAME']));
require($rootPath.'/includes/bootstrap.php');


// Start the clock for the page parse time log
define('PAGE_PARSE_START_TIME', microtime());
$timeZone = getenv('TIME_ZONE');
$timeZoneArray = explode(' ',$timeZone);
if(!empty($timeZoneArray[0])){
    date_default_timezone_set($timeZoneArray[0]);
}

$to_date = getenv('TRIAL_END_DATE');
$checkIsSiteAvailable = true;

if($_GET['checksite'] != 'true' && !empty($to_date) && is_numeric($to_date) && $to_date < strtotime("now")){
    $checkIsSiteAvailable = false;
}

if (getenv('APP_ENV') == 'trial' && !$checkIsSiteAvailable){
    if(getenv('CATALOG_FOLDER') !== '') {
        $catalog_folder = getenv('CATALOG_FOLDER');
    } else {
        $catalog_folder = '/';
    }
    echo "
        <script type = 'text/javascript' language = 'javascript'>
                window.location = '". $catalog_folder ."';
        </script>
        ";
}


// Check if register_globals is enabled.
// Since this is a temporary measure this message is hardcoded. The requirement will be removed before 2.2 is finalized.
if (function_exists('ini_get')) {
//    ini_get('register_globals') or exit('FATAL ERROR: register_globals is disabled in php.ini, please enable it!');
}

// Set the local configuration parameters - mainly for developers
if (file_exists(DIR_WS_INCLUDES.'includes/local/configure.php')) include(DIR_WS_INCLUDES.'local/configure.php');


if (stristr($_SERVER['REQUEST_URI'], '.php/login')) {
    die();
}
// Define the project version
//define('PROJECT_VERSION', 'SMosc1.1');

// set php_self in the local scope
$PHP_SELF = (isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);

// Used in the "Backup Manager" to compress backups
define('LOCAL_EXE_GZIP', '/usr/bin/gzip');
define('LOCAL_EXE_GUNZIP', '/usr/bin/gunzip');
define('LOCAL_EXE_ZIP', '/usr/local/bin/zip');
define('LOCAL_EXE_UNZIP', '/usr/local/bin/unzip');

// include the list of project filenames
require(DIR_WS_INCLUDES . 'filenames.php');
require_once (DIR_WS_INCLUDES."solomono/app/core/Config.php");
// include the list of project database tables
require(DIR_WS_INCLUDES . 'database_tables.php');

//     define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)
define('MENU_DHTML', true);

// Include application configuration parameters
require(DIR_WS_INCLUDES.'configure.php');
require_once DIR_FS_CATALOG . DIR_WS_FUNCTIONS . "crypto.php";

if (is_file(DIR_FS_CATALOG . DIR_WS_FUNCTIONS . "get_created.php")) {
    require_once DIR_FS_CATALOG . DIR_WS_FUNCTIONS . "get_created.php";
}
// include the database functions
require(DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
tep_db_connect() or die('Unable to connect to database server!');

// set application wide parameters
$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  while ($configuration = tep_db_fetch_array($configuration_query)) {

    // проверка на папки модулей:
		$check_modules_folders = explode(':',$configuration['cfgValue']);
        if (isset($check_modules_folders[1]) && in_array($check_modules_folders[1], ['true', 'false'])) {
			if (is_dir(DIR_FS_CATALOG.'ext/'.$check_modules_folders[0])) { // если модуль включен и существует папка
				define($configuration['cfgKey'], $check_modules_folders[1]);
			} else { // если модуль включен НО папки не существует то FALSE
			  define($configuration['cfgKey'], 'false');
			}
		}
		elseif($configuration['cfgKey']=='MAX_DISPLAY_SEARCH_RESULTS') define($configuration['cfgKey'], explode(';',$configuration['cfgValue'])[0]);
		else define($configuration['cfgKey'], $configuration['cfgValue']);

  }
define('HTTP_SERVER',((SET_HTTPS=='true')?'https://':'http://').$_SERVER['HTTP_HOST'].$add_folder);



if (MENU_DHTML == 'true')
    define('BOX_WIDTH', 0);
else
    define('BOX_WIDTH', 125);

// define our general functions used application-wide
require(DIR_WS_FUNCTIONS . 'general.php');
require_once DIR_FS_DOCUMENT_ROOT . DIR_WS_FUNCTIONS . 'constants.php';
require(DIR_WS_FUNCTIONS . 'html_output.php');
//Admin begin
require(DIR_WS_FUNCTIONS . 'password_funcs.php');


require_once DIR_WS_CLASSES . "template.php";
$template = new template();
$logoConfigs = $template->checkConfig('HEADER', 'H_LOGO');
define('LOGO_WIDTH', $logoConfigs['logo_width']['val']);
define('LOGO_HEIGHT', $logoConfigs['logo_height']['val']);

//Admin end

/**
 * Redirect to HTTP/HTTPS depending on the settings
 */
if (getConstantValue('SET_HTTPS') === 'true' && !isset($_SERVER['HTTPS'])) {
    $redirectUrl = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('Location: ' . $redirectUrl);
    exit();
} elseif (getConstantValue('SET_HTTPS') === 'false' && isset($_SERVER['HTTPS'])) {
    $redirectUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('Location: ' . $redirectUrl);
    exit();
}

// include shopping cart class
require(DIR_WS_CLASSES . 'shopping_cart.php');

// define how the session functions will be used
require(DIR_WS_FUNCTIONS . 'sessions.php');

// set the session name and save path
tep_session_name('osCAdminID');
tep_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
if (function_exists('session_set_cookie_params')) {
//    session_set_cookie_params(0, $add_folder.DIR_WS_ADMIN);
} elseif (function_exists('ini_set')) {
    ini_set('session.cookie_lifetime', '0');
    ini_set('session.cookie_path', $add_folder.DIR_WS_ADMIN);
}

// lets start our session
tep_session_start();
extract($_SESSION);
if (empty($_SESSION['csrf_token'])) {
     $_SESSION['csrf_token'] = RandomToken(32);
}

// set the language
include(DIR_WS_CLASSES . 'language.php');

if (!tep_session_is_registered('language') || isset($_GET['language'])) {
    if (!tep_session_is_registered('language')) {
        tep_session_register('language');
        tep_session_register('languages_id');
        tep_session_register('languages_code');
    }
    $lng = new language();

    if (isset($_GET['language']) && tep_not_null($_GET['language'])) {
        $lng->set_language($_GET['language']);
    } else {
        $lng->get_browser_language();
    }

    $language = $lng->language['directory'];
    $languages_id = $lng->language['id'];
    $languages_code = $lng->language['code'];

    $_SESSION['language'] = $language;
    $_SESSION['languages_id'] = $languages_id;
    $_SESSION['languages_code'] = $languages_code;
}


// include the language translations
require(DIR_WS_LANGUAGES . $language . '.php');

$array_for_js = array('CUSTOM_PANEL_DATE1' => CUSTOM_PANEL_DATE1,
  'CUSTOM_PANEL_DATE2' => CUSTOM_PANEL_DATE2,
  'CUSTOM_PANEL_DATE3' => CUSTOM_PANEL_DATE3,
  'MENU_LOCATION' => MENU_LOCATION,
  'SELECTED_LANGUAGE' => $languages_code,
  'ADMIN_BLOCK_STATE'  => addcslashes(ADMIN_BLOCK_STATE, '"'),
);


$current_page = basename($_SERVER['SCRIPT_NAME']);
if (file_exists(DIR_WS_LANGUAGES . $language . '/' . $current_page)) {
    include(DIR_WS_LANGUAGES . $language . '/' . $current_page);
}

// define our localization functions
require(DIR_WS_FUNCTIONS . 'localization.php');

// Include validation functions (right now only email address)
require(DIR_WS_FUNCTIONS . 'validations.php');

// setup our boxes
require(DIR_WS_CLASSES . 'table_block.php');
require(DIR_WS_CLASSES . 'box.php');

// initialize the message stack for output messages
require(DIR_WS_CLASSES . 'message_stack.php');
$messageStack = new messageStack;

// split-page-results
require(DIR_WS_CLASSES . 'split_page_results.php');

// entry/item info classes
require(DIR_WS_CLASSES . 'object_info.php');

// email classes
require(DIR_WS_CLASSES . 'mime.php');
require(DIR_WS_CLASSES . 'email.php');

// file uploading class
require(DIR_WS_CLASSES . 'upload.php');

$cat_tree = setTree(); // array of categories
$tep_get_category_tree = tep_get_category_tree(); // formatted list of categories
$all_categories_turned_on = tep_get_all_categories_turned_on();
$all_categories_to_xml = tep_get_all_categories_to_xml();
$prodToCat = prodToCat();
tep_make_cat_list();
$catProductCounter_ready = countAllCategoryProductsRecursive();

// calculate category path
if (isset($_GET['cPath'])) {
    $cPath = $_GET['cPath'];
} else {
    $cPath = '';
}

if (tep_not_null($cPath)) {
    $cPath_array = tep_parse_category_path($cPath);
    $cPath = implode('_', $cPath_array);
    $current_category_id = $cPath_array[(sizeof($cPath_array) - 1)];
} else {
    $current_category_id = 0;
}

if($login_id && !checkIsAdminAvailable($login_id)){
    clearAdminSession($_COOKIE['osCAdminID']);
    tep_redirect(tep_href_link(FILENAME_LOGOFF, '', 'SSL'));
    die;
}

// default open navigation box
if (!tep_session_is_registered('selected_box')) {
    tep_session_register('selected_box');
    $selected_box = 'configuration';
}

if (isset($_GET['selected_box'])) {
    $selected_box = $_GET['selected_box'];
}

// menu location 0 -> top, 1 -> left
$menu_location_query = tep_db_query("SELECT configuration_value FROM ".TABLE_CONFIGURATION." WHERE configuration_key = 'MENU_LOCATION'");
$menu_location = tep_db_fetch_array($menu_location_query)['configuration_value'];


// the following cache blocks are used in the Tools->Cache section
// ('language' in the filename is automatically replaced by available languages)
$cache_blocks = array(array('title' => TEXT_CACHE_CATEGORIES, 'code' => 'categories', 'file' => 'categories_box-language.cache', 'multiple' => true),
    array('title' => TEXT_CACHE_MANUFACTURERS, 'code' => 'manufacturers', 'file' => 'manufacturers_box-language.cache', 'multiple' => true),
    array('title' => TEXT_CACHE_ALSO_PURCHASED, 'code' => 'also_purchased', 'file' => 'also_purchased-language.cache', 'multiple' => true)
);

// check if a default currency is set
if (!defined('DEFAULT_CURRENCY')) {
    $messageStack->add(ERROR_NO_DEFAULT_CURRENCY_DEFINED, 'error');
}

// check if a default language is set
if (!defined('DEFAULT_LANGUAGE')) {
    $messageStack->add(ERROR_NO_DEFAULT_LANGUAGE_DEFINED, 'error');
}

if (function_exists('ini_get') && ((bool)ini_get('file_uploads') == false)) {
    $messageStack->add(WARNING_FILE_UPLOADS_DISABLED, 'warning');
}
//Admin begin
if (basename($PHP_SELF) != FILENAME_LOGIN && basename($PHP_SELF) != FILENAME_PASSWORD_FORGOTTEN) {
    tep_admin_check_login();
}
//Admin end
// Include OSC-AFFILIATE
// require('includes/affiliate_application_top.php');
// include giftvoucher
REQUIRE(DIR_WS_INCLUDES . 'add_ccgvdc_application_top.php');

// WebMakers.com Added: Includes Functions for Attribute Sorter and Copier
require(DIR_WS_FUNCTIONS . 'webmakers_added_functions.php');

// include the articles functions
require(DIR_WS_FUNCTIONS . 'articles.php');

define('FILENAME_POLLS', 'polls.php');

// entry/item info classes
require(DIR_WS_CLASSES . 'poll_info.php');
//BEGIN Added Lines: Dynamic Information pages
// calculate information path
$cPath = $_GET['cPath'];
if (strlen($cPath) > 0) {
    $cPath_array = explode('_', $cPath);
    $current_infopage_id = $cPath_array[(sizeof($cPath_array) - 1)];
} else {
    $current_infopage_id = 0;
}

//END Added Lines: Dynamic Information pages

// Article Manager
if (isset($_GET['tPath'])) {
    $tPath = $_GET['tPath'];
} else {
    $tPath = '';
}

if (tep_not_null($tPath)) {
    $tPath_array = tep_parse_topic_path($tPath);
    $tPath = implode('_', $tPath_array);
    $current_topic_id = $tPath_array[(sizeof($tPath_array) - 1)];
} else {
    $current_topic_id = 0;
}

define('LINK_TO_SHOP', 'https://solomono.net/' . $_SESSION['languages_code'] . '/pricing.html');
define('LINK_TO_SUBSCRIPTION', 'https://solomono.net/' . $_SESSION['languages_code'] . '/subscription.html');
require_once __DIR__ . "/classes/MenuItemConfiguration.php";

if(!isset($_COOKIE['MENU_LOCATION'])){
    tep_setcookie('MENU_LOCATION', MENU_LOCATION, time() + 60 * 60 * 24 * 7, '/');
}

if(env('APP_ENV') == 'rent'){
    require_once __DIR__ . "/check_rented_modules.php";
}

//Domain check in robots.txt
$domenInRobotsTxt = readRobotsHost();
if(!strpos($domenInRobotsTxt, $_SERVER["HTTP_HOST"]) && !isset($_SESSION['alertErrors']['robots_txt']['critical_for_site'])){
    $_SESSION['alertErrors']['domen_in_robots_txt'] = [
        "text" => "DOMEN_IN_ROBOTS_TXT_RECOMMENDATION_TEXT",
        "type" => "alert_danger"
    ];
}else{
    unset($_SESSION['alertErrors']['domen_in_robots_txt']);
}

checkLimitProducts();

if (!empty($login_id)) {
    tep_db_query("update " . TABLE_ADMIN . " set admin_logdate = now() where admin_id = " . (int)$login_id . " AND admin_logdate <= CURDATE();");
}