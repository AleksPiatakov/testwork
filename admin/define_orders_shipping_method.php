<?php
//Application top part:

// Set the level of error reporting

define('DIR_WS_INCLUDES', 'includes/');
define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
define('BUY_MODULES_LINK', 'https://solomono.net/modules-for-oscommerce/c-383.html');

if (empty(ini_get('date.timezone'))) {
    date_default_timezone_set('Europe/Kiev');
}

if (empty($rootPath)) {
    $rootPath = dirname(dirname($_SERVER['SCRIPT_FILENAME']));
}
require_once($rootPath . '/includes/bootstrap.php');
// Start the clock for the page parse time log
define('PAGE_PARSE_START_TIME', microtime());

// Set the local configuration parameters - mainly for developers
if (file_exists(DIR_WS_INCLUDES . 'includes/local/configure.php')) {
    include(DIR_WS_INCLUDES . 'local/configure.php');
}

// set php_self in the local scope
$PHP_SELF = (isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);

// Used in the "Backup Manager" to compress backups
define('LOCAL_EXE_GZIP', '/usr/bin/gzip');
define('LOCAL_EXE_GUNZIP', '/usr/bin/gunzip');
define('LOCAL_EXE_ZIP', '/usr/local/bin/zip');
define('LOCAL_EXE_UNZIP', '/usr/local/bin/unzip');

// include the list of project filenames
require(DIR_WS_INCLUDES . 'filenames.php');
require_once(DIR_WS_INCLUDES . "solomono/app/core/Config.php");
// include the list of project database tables
require(DIR_WS_INCLUDES . 'database_tables.php');

//define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)
define('MENU_DHTML', true);

// Include application configuration parameters
require(DIR_WS_INCLUDES . 'configure.php');

if (is_file(DIR_FS_CATALOG . DIR_WS_FUNCTIONS . "get_created.php")) {
    require_once DIR_FS_CATALOG . DIR_WS_FUNCTIONS . "get_created.php";
}
// include the database functions
require(DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
tep_db_connect() or die('Unable to connect to database server!');

require(DIR_WS_FUNCTIONS . 'general.php');
require_once DIR_FS_DOCUMENT_ROOT . DIR_WS_FUNCTIONS . 'constants.php';
//Application top part end

//change on true to display info
$showResult = true;
$showResultDetail = false;

if ($showResultDetail) echo '<pre>';

//get all languages
$shippingModulesTitles = [];
$languagesQuery = tep_db_query("select directory from " . TABLE_LANGUAGES);
while ($languagesInfo = tep_db_fetch_array($languagesQuery)) {
    $language = $languagesInfo['directory'];
    //get shipping modules info
    $shippingModules = [];
    $moduleDirectory = DIR_FS_CATALOG_MODULES_SHIPPING;
    foreach(glob($moduleDirectory.'*.php') as $modulePath){
        $shippingModules[] = basename($modulePath);
    }
    foreach ($shippingModules as $fileName) {
        //init shipping module to get title
        include_once($moduleDirectory . $fileName);
        $admin_check = true;
        $class = substr($fileName, 0, strrpos($fileName, '.'));
        $module = new $class;

        //get instead of constants an array('const_name'=>'const_value') in different languages
        $langContentJson = file_get_contents(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/shipping/' . $class . '.json');
        $langContent = json_decode($langContentJson, true);

        //get shipping module`s names
        $title = $langContent[$module->title];
        //if isset custom name instead of title from language file
        if (empty($title)) {
            $customNameQuery = tep_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = '" . $module->title . "'");
            $customName = tep_db_fetch_array($customNameQuery);
            if (!empty($customName['configuration_value'])) {
                $title = $customName;
            }else {
                //find title in appropriate language file
                foreach ($langContent as $constName) {
                    if (strstr($constName, '_TEXT_TITLE') !== false) {
                        $title = $constName;
                        break;
                    }
                }
            }
        }
        $shippingModulesTitles[$class][] = $title;
    }
}

//display associative array of modules and their titles
if ($showResultDetail) {
    echo '<br><div style="font-weight: 700">Модулі та їх назви:</div>';
    print_r($shippingModulesTitles);
}

//get existing orders shipping modules info
$shippingInfoAboutOrders = [];
$info = '';
$existingShippingInfoQuery = tep_db_query("select ot.orders_id, ot.title from "
    . TABLE_ORDERS . " o"
    . " left join " . TABLE_ORDERS_TOTAL . " ot on ot.orders_id=o.orders_id"
    . " where ot.class='ot_shipping' and o.shipping_method_code=''");
while ($existingShippingInfo = tep_db_fetch_array($existingShippingInfoQuery)) {
    $orders_id = $existingShippingInfo['orders_id'];
    $title = trim(str_replace(':', '', $existingShippingInfo['title']));
    $shippingInfoAboutOrders[$orders_id] = [
        'orders_id' => $orders_id,
        'title' => $title,
    ];
    //define to which shipping module depend this order
    foreach ($shippingModulesTitles as $key => $shippingTitles) {
        if (in_array($title, $shippingTitles) !== false) {
            $info .= 'id:' . $orders_id . ' => ' . $title . ' => ' . $key . '<br>';

            $shippingInfoAboutOrders[$orders_id] = [
                'orders_id' => $orders_id,
                'title' => $title,
                'shipping_method_code' => $key,
            ];
        }
    }
}

//display all info
if ($showResult) echo '<br><div style="font-weight: 700">Опізнано наступні модулі:</div>' . $info;

/*//display associative array of orders, their shipping titles and module title (if was defined)
if ($showResultDetail) {
    echo '<br><div style="font-weight: 700">Замовлення без вказаного модуля доставки:</div>';
    print_r($shippingInfoAboutOrders);
}*/

//update orders shipping_method_code if was defined shipping module
$undefinedShippingModules = [];
foreach ($shippingInfoAboutOrders as $shippingInfoAboutOrder) {
    if (isset($shippingInfoAboutOrder['shipping_method_code'])) {
        tep_db_query("update " . TABLE_ORDERS . " set shipping_method_code='" . $shippingInfoAboutOrder['shipping_method_code'] . "' where orders_id='" . $shippingInfoAboutOrder['orders_id'] . "'");
    }else {
        $undefinedShippingModules[] = $shippingInfoAboutOrder;
    }
}

if ($showResult) {
    //show positive result
    $countOfDefinedModules = (count($shippingInfoAboutOrders, false) - count($undefinedShippingModules, false));
    echo '<br><div style="font-weight: 700">Готово! Було опізнано: ' . $countOfDefinedModules . ' модулів доставки.</div>';

    //show orders and titles where modules are still undefined
    $string = '<br><div style="font-weight: 700">Залишились неопізнанними наступні назви модулів доставки:</div>';
    foreach ($undefinedShippingModules as $shippingInfoAboutOrder) {
        $string .= 'id:' . $shippingInfoAboutOrder['orders_id'] . ' => ' . $shippingInfoAboutOrder['title'];
        $string .= '<br>';
    }
    echo $string;
}




