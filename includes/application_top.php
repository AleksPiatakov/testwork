<?php

define('PAGE_PARSE_START_TIME', microtime(true));
define("SECONDS_PER_WEEK", 604800);
header("Content-Security-Policy: default-src data: * 'unsafe-inline' 'unsafe-eval'; frame-ancestors 'none';");

require_once __DIR__ . "/application_main.php";
$timeZone = getenv('TIME_ZONE');
$timeZoneArray = explode(' ',$timeZone);
if(!empty($timeZoneArray[0])){
    date_default_timezone_set($timeZoneArray[0]);
}
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

require_once DIR_WS_FUNCTIONS . "crypto.php";

$saveDbPrepareInput = [];
$_POST = tep_db_prepare_input($_POST);
$_GET = tep_db_prepare_input($_GET);
$_REQUEST = tep_db_prepare_input($_REQUEST);
if(isset($_GET['keywords'])){
    $_GET['keywords'] = str_replace(['>','<','/'],'',$_GET['keywords']);
}

if (!function_exists('validateUrlParams')) {
    require DIR_WS_INCLUDES . 'http_logger.php';
}
validateUrlParams();

$showAllQuery = '';
$query_counts = 0;
$query_total_time = 0;

foreach ($_GET as $key => $value) {
    $_GET[$key] = preg_replace('/[<>]/', '', $value);
    unset($GLOBALS[$key]);
}

if (isset($_GET['products_id'])) {
    $_GET['products_id'] = $products_id = $GLOBALS['products_id'] = (int)$_GET['products_id'];
}

if (!isset($PHP_SELF)) {
    $PHP_SELF = $_SERVER['PHP_SELF'];
}

$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];

if (defined('PROMURLS_MODULE_ENABLED') && constant('PROMURLS_MODULE_ENABLED') == 'true') {
    @include('ext/promurl/url.php');
}

$promUrls = defined('PROM_URLS') && constant('PROM_URLS') == true;

$request_type = 'NONSSL';

if (MINIFY_CSSJS == 1 && file_exists(DIR_WS_EXT . 'minifier/minifier.php')) {
    require_once(DIR_WS_EXT . 'minifier/minifier.php');
}
$versionTimestamp = defined('MINIFY_CSSJS_TIMESTAMP') ? constant('MINIFY_CSSJS_TIMESTAMP') : 0;

$template_name = isset($_COOKIE['template_name']) && isValidTemplateName($_COOKIE['template_name']) ? $_COOKIE['template_name'] : DEFAULT_TEMPLATE;

define('TEMPLATE_NAME', $template_name);

require_once DIR_WS_CLASSES . "template.php";
require_once DIR_WS_CLASSES . "CSRF.php";
$template = new template();
define('SMALL_IMAGE_WIDTH', $template->getMainconf('MC_THUMB_WIDTH'));
define('SMALL_IMAGE_HEIGHT', $template->getMainconf('MC_THUMB_HEIGHT'));
//include css and js assets
require_once DIR_WS_CLASSES . "Assets/AppAsset.php";
if (is_file(DIR_WS_FUNCTIONS . "get_created.php")) {
    require_once DIR_WS_FUNCTIONS . "get_created.php";
}

$assets = new AppAsset();
$assets->objMinifierCSS = !empty($minifierCSS) ? $minifierCSS : null;
$assets->objMinifierJS = !empty($minifierJS) ? $minifierJS : null;
$assets->versionTimestamp = $versionTimestamp;
$assets->isMobile = isMobile();
$assets->isCriticalMode = isset($_GET['isCriticalMode']);
$assets->createHookieVariable();

//remove this if somebody finally decides to add this constant to project

if (!defined("PROJECT_VERSION")) {
    define('PROJECT_VERSION', '');
}

// set the cookie domain
$cookie_domain = HTTP_COOKIE_DOMAIN;
$cookie_path = HTTP_COOKIE_PATH;

require_once DIR_WS_FUNCTIONS . 'sessions.php';

require_once DIR_WS_MODULES . 'user_redirects.php';

// set the session name and save path
tep_session_name('osCsid');
tep_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
if (function_exists('session_set_cookie_params')) {
    $secure = getConstantValue('SET_HTTPS') === 'true' ? true : false;
    session_set_cookie_params(time() - 3600, $cookie_path . ';SameSite=Lax', $cookie_domain, $secure, true);
} elseif (function_exists('ini_set')) {
    ini_set('session.cookie_lifetime', '0');
    ini_set('session.cookie_path', $cookie_path);
    ini_set('session.cookie_domain', $cookie_domain);
}

// set the session ID if it exists
if (isset($_POST[tep_session_name()])) {
    tep_session_id($_POST[tep_session_name()]);
}

if (empty($skipSessionRedirect)) {
    // start the session
    $session_started = false;
    if (SESSION_FORCE_COOKIE_USE == 'True') {
        tep_setcookie(
            'cookie_test',
            'please_accept_for_session',
            time() + 60 * 60 * 24 * 30,
            $cookie_path,
            $cookie_domain,
            false,
            true
        );

        if (isset($_COOKIE['cookie_test'])) {
            tep_session_start();
            $session_started = true;
        }
    } elseif (SESSION_BLOCK_SPIDERS == 'True') {
        $user_agent = strtolower(getenv('HTTP_USER_AGENT'));
        $spider_flag = false;

        if (tep_not_null($user_agent)) {
            $spiders = file(DIR_WS_INCLUDES . 'spiders.txt');

            for ($i = 0, $n = sizeof($spiders); $i < $n; $i++) {
                if (tep_not_null($spiders[$i])) {
                    if (is_integer(strpos($user_agent, trim($spiders[$i])))) {
                        $spider_flag = true;
                        break;
                    }
                }
            }
        }

        // START HACK for remove old sessions from search engines
        if (($spider_flag) && (is_integer(strpos($_SERVER['REQUEST_URI'], "?osCsid=")))) {
            preg_match("/(.+)\?osCsid=.+/", $_SERVER['REQUEST_URI'], $matches);
            header('Location: ' . $matches[1]);
            header('HTTP/1.0 301 Moved Permanently');
            die;  // Don't send any more output.
        }
        // END HACK

        if ($spider_flag == false) {
            tep_session_start();
            $session_started = true;
        }
    } else {
        tep_session_start();
        $session_started = true;
    }
}

if ($_SESSION) {
    extract($_SESSION);
}


//HTTP_REFERER
if (!isset($referer_url) && $_SERVER['HTTP_REFERER']) {
    $referer_url = $_SERVER['HTTP_REFERER'];
    tep_session_register('referer_url');
}

// set SID once, even if empty
$SID = (defined('SID') ? SID : '');


// verify the browser user agent if the feature is enabled
if (SESSION_CHECK_USER_AGENT == 'True') {
    $http_user_agent = getenv('HTTP_USER_AGENT');
    if (!tep_session_is_registered('SESSION_USER_AGENT')) {
        $SESSION_USER_AGENT = $http_user_agent;
        tep_session_register('SESSION_USER_AGENT');
    }

    if ($SESSION_USER_AGENT != $http_user_agent) {
        tep_session_destroy();
        tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
}

fixObject($cart); // fix object, which does not work on mamp (is_object = false)

// create the shopping cart & fix the cart if necesary
if (tep_session_is_registered('cart') && is_object($cart) && !is_null($cart->cartID)) {
} else {
    tep_session_register('cart');
    $cart = new shoppingCart();
}

// include currencies class and create an instance
require_once DIR_WS_CLASSES . 'currencies.php';
$currencies = new currencies();

require_once DIR_WS_CLASSES . 'language.php';
$lng = new language();

#redirect from language=uk to uk/
if (empty($_GET['language']) or $_GET['language'] === '') {
} else {
    header("HTTP/1.0 301 Moved Permanently");
    header("Location: " . tep_href_link(
        ($_GET['language'] ? $_GET['language'] . '/' : '') . basename($PHP_SELF),
        tep_get_all_get_params(array('currency', 'language'))
    ));
    exit;
}

$allLanguageCodes = array_keys($lng->languages);
if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' or !empty($_GET['mylang']) or $_SERVER['REDIRECT_STATUS'] == '403' or $_SERVER['REDIRECT_STATUS'] == '404') { // if ajax or comments or error 403/404 , then get NOT $_GET but SESSION language
    $checkLanguageDuplicates = array_unique(array_filter(explode('/', $_SERVER['REQUEST_URI'])));
    $possibleLang = end($checkLanguageDuplicates);
    if (count($checkLanguageDuplicates) === 1 && isset($lng->catalog_languages[$possibleLang])) {
        tep_redirect(HTTP_SERVER . '/' . tep_href_link($possibleLang . '/' . FILENAME_DEFAULT));
    }
    $_GET['language'] = $_SESSION['language_short'] ?: $lng->language['code'];
} else {
    // find site languages
    $lang_codes = array();
    foreach ($lng->catalog_languages as $cat_kay => $cat_lang) {
        $lang_codes[] = $cat_kay;
    }

    $ruri = explode('/', $_SERVER['REQUEST_URI']);
    foreach ($ruri as $k => $rur) {
        if (in_array($rur, $lang_codes)) {
            $lang_key = $k;
            $_GET['language'] = $rur;
            break;
        } elseif (in_array($rur, $allLanguageCodes)) {
            // if language exist but off then redirect
            // Need test
            header("HTTP/1.0 301 Moved Permanently");
            unset($ruri[$k]);
            $url = implode('/', $ruri);
            header("Location: " . $url);
            tep_exit();
        }
    }
    $misc_language_codes = array_diff($lang_codes, [$_GET['language']]);
    $excessLanguages = array_intersect($ruri, $misc_language_codes);
    if (count($excessLanguages)) {
        $ruri = array_diff($ruri, $excessLanguages);
        if ($_GET['language'] == DEFAULT_LANGUAGE) {
            unset($ruri[$lang_key]);
            $_SESSION['language_short'] = DEFAULT_LANGUAGE;
        }
        $redirect_to = HTTP_SERVER . '/' . tep_href_link(implode('/', $ruri));

        header("HTTP/1.0 301 Moved Permanently");
        header("Location: $redirect_to");
        tep_exit();
    }
    $filtered_lang = array_filter(
        $ruri,
        function ($chunk) {
            return $chunk === $_GET['language'];
        }
    );

    if (count($filtered_lang) > 1) {
        tep_redirect(HTTP_SERVER . '/' . tep_href_link($_GET['language'] . '/' . FILENAME_DEFAULT));
        die;
    }

    if (count($filtered_lang) > 0 && (!defined('LANGUAGE_SELECTOR_MODULE_ENABLED') || LANGUAGE_SELECTOR_MODULE_ENABLED == 'false')) {
        tep_redirect(HTTP_SERVER . tep_href_link(DEFAULT_LANGUAGE . '/' . FILENAME_DEFAULT));
        die;
    }

    if ($_GET['language'] == DEFAULT_LANGUAGE) { // redirect from default language to /
        $_SESSION['language_short'] = DEFAULT_LANGUAGE; // make session language = default language

        $ruri = array_slice($ruri, ++$lang_key); // remove all before lang
        $redirect_to = HTTP_SERVER . '/' . tep_href_link(implode('/', $ruri));

        header("HTTP/1.0 301 Moved Permanently");
        header("Location: $redirect_to");
        tep_exit();
    } elseif (!isset($_GET['language'])) { // if url without /en - define default language (english)
        $_GET['language'] = DEFAULT_LANGUAGE;
    }
}


// check if language just changed, then change currency to language-curency (en - USD)
if ($_SESSION['language_short'] != $_GET['language']) {
    $language_just_changed = true;
} else {
    $language_just_changed = false;
}

if (!tep_session_is_registered('language') and !_bot_detected() && empty($sideApp)) {
    if (getConstantValue('GET_BROWSER_LANGUAGE') === 'true') {
        $lng->get_browser_language(); // if its first enterance, get browser language
    } else {
        $lng->set_language($lng->catalog_languages[$_GET['language']]['directory']);
    }
    $sess_lang_not_registered = true;
} else { // if link is /ru, /uk, /
    $lng->set_language($lng->catalog_languages[$_GET['language']]['directory']);
}

$language = $lng->language['directory'];
$languages_id = $lng->language['id'];


$_SESSION['language'] = $language;
$_SESSION['language_short'] = $_GET['language'];
$_SESSION['languages_id'] = $languages_id;


if ($_GET['language'] == DEFAULT_LANGUAGE) {
    $language_short_link = '';
} else {
    $language_short_link = $_GET['language'] . '/';
}

//if($lng->language['code']!=DEFAULT_LANGUAGE and $sess_lang_not_registered) {
if (
    $lng->language['code'] != $_SESSION['language_short'] and $sess_lang_not_registered and !$_POST
    and !strstr($_SERVER['SCRIPT_NAME'], '404.php')
    and !strstr($_SERVER['SCRIPT_NAME'], 'sitemap.php')
    and !strstr($_SERVER['SCRIPT_NAME'], 'api/minification')
    and !strstr($_SERVER['SCRIPT_NAME'], 'api/migration')
    and !$assets->isCriticalMode
    and empty($skipLanguageRedirect)
) {
    if (basename($PHP_SELF) == 'product_info.php') {
        $path = explode('?', $_SERVER['REQUEST_URI'])[0];
        $pathParts = explode('/', $path);
        $newPathParts = [];
        foreach ($pathParts as $pathPart) {
            if (!in_array($pathPart, $allLanguageCodes)) {
                $newPathParts[] = $pathPart;
            }
        }
        $path = implode('/', $newPathParts);
    } else {
        $path = '/' . basename($PHP_SELF);
    }
    $url = '/' . tep_href_link($path, tep_get_all_get_params(array('language', 'currency')));
    $url = HTTP_SERVER . str_replace('//', '/', $url);
    tep_redirect($url);
}

if (!isset($_COOKIE['isMobile'])) {
    require_once DIR_WS_CLASSES . "MobileDetect.php";
    $detect = new MobileDetect();
    $detect->getBrowsers();
    setcookie("isMobile", $detect->isMobile() ? 1 : 0, time() + 60 * 60 * 24, '/');
    $isiOS = $detect->isiOS() ? 1 : 0;
    $isiOS = strpos($_SERVER['HTTP_USER_AGENT'], 'Mac OS') !== false ? 1 : $isiOS;
    setcookie("isiOS", $isiOS, time() + 60 * 60 * 24, '/');
    setcookie("isSafari", $detect->is('Safari') ? 1 : 0, time() + 60 * 60 * 24, '/');
}

// include the language translations
require_once DIR_WS_LANGUAGES . $language . '/config.php';
includeLanguages(DIR_WS_LANGUAGES . $language . '.php');

//constantsJSON not will add to minify
$assets->constantsJSON = [
    'BUTTON_SEND' => getConstantValue('BUTTON_SEND', 'Send'),
    'VK_LOGIN' => VK_LOGIN,
    'OG_LOCALE' => OG_LOCALE,
    'STORE_NAME' => STORE_NAME,
    'IMAGE_BUTTON_IN_CART' => IMAGE_BUTTON_IN_CART,
    'HOME_LOAD_MORE_INFO' => HOME_LOAD_MORE_INFO,
    'HOME_LOAD_ROLL_UP' => HOME_LOAD_ROLL_UP,
    'DEMO2_READ_MORE' => addslashes(DEMO2_READ_MORE),
    'DEMO2_READ_MORE_UP' => addslashes(DEMO2_READ_MORE_UP),
    'SHOW_RESULTS' => SHOW_RESULTS,
    'ENTER_KEY' => ENTER_KEY,
    'SEARCH_LANG' => ($lng->language['code'] != DEFAULT_LANGUAGE ? SEARCH_LANG : '/'),
    'TEXT_LIMIT_REACHED' => TEXT_LIMIT_REACHED,
    'RENDER_TEXT_ADDED_TO_CART' => RENDER_TEXT_ADDED_TO_CART,
    'CHOOSE_ADDRESS' => CHOOSE_ADDRESS,
    'IMAGE_BUTTON_ADDTO_CART' => IMAGE_BUTTON_ADDTO_CART,
    'CUSTOM_PANEL_DATE1' => CUSTOM_PANEL_DATE1,
    'CUSTOM_PANEL_DATE2' => CUSTOM_PANEL_DATE2,
    'CUSTOM_PANEL_DATE3' => CUSTOM_PANEL_DATE3,
    'TEMPLATE_NAME' => TEMPLATE_NAME,
    'SEO_FILTER' => getConstantValue('SEO_FILTER', 0),
    'ONEPAGE_ADDRESS_TYPE_POSITION' => ONEPAGE_ADDRESS_TYPE_POSITION,
    'LIST_TEMP_INSTOCK' => LIST_TEMP_INSTOCK,
    'LIST_TEMP_OUTSTOCK' => LIST_TEMP_OUTSTOCK,
    'TEXT_MODAL_APPLY_ACTION' => TEXT_MODAL_APPLY_ACTION,
    'IMAGE_CANCEL' => IMAGE_CANCEL,
    'TEXT_DAY_SHORT_1' => TEXT_DAY_SHORT_1,
    'TEXT_DAY_SHORT_2' => TEXT_DAY_SHORT_2,
    'TEXT_DAY_SHORT_3' => TEXT_DAY_SHORT_3,
    'TEXT_DAY_SHORT_4' => TEXT_DAY_SHORT_4,
    'TEXT_DAY_SHORT_5' => TEXT_DAY_SHORT_5,
    'TEXT_DAY_SHORT_6' => TEXT_DAY_SHORT_6,
    'TEXT_DAY_SHORT_7' => TEXT_DAY_SHORT_7,
    'TEXT_MONTH_BASE_1' => TEXT_MONTH_BASE_1,
    'TEXT_MONTH_BASE_2' => TEXT_MONTH_BASE_2,
    'TEXT_MONTH_BASE_3' => TEXT_MONTH_BASE_3,
    'TEXT_MONTH_BASE_4' => TEXT_MONTH_BASE_4,
    'TEXT_MONTH_BASE_5' => TEXT_MONTH_BASE_5,
    'TEXT_MONTH_BASE_6' => TEXT_MONTH_BASE_6,
    'TEXT_MONTH_BASE_7' => TEXT_MONTH_BASE_7,
    'TEXT_MONTH_BASE_8' => TEXT_MONTH_BASE_8,
    'TEXT_MONTH_BASE_9' => TEXT_MONTH_BASE_9,
    'TEXT_MONTH_BASE_10' => TEXT_MONTH_BASE_10,
    'TEXT_MONTH_BASE_11' => TEXT_MONTH_BASE_11,
    'TEXT_MONTH_BASE_12' => TEXT_MONTH_BASE_12,
];

$array_for_js = [
    'HTTP_SERVER' => HTTP_SERVER,
    'TEMPLATE_NAME' => TEMPLATE_NAME,
    'RENDER_TEMPLATE' => DIR_WS_TEMPLATES . TEMPLATE_NAME . '/render_template.php',
];
// Facebook Pixel Module
if (defined('FACEBOOK_PIXEL_MODULE_ENABLED') && FACEBOOK_PIXEL_MODULE_ENABLED === 'true') {
    $array_for_js['FACEBOOK_PIXEL_MODULE_ENABLED'] = true;
    $array_for_js['FACEBOOK_PIXEL_ID'] = defined('FACEBOOK_PIXEL_ID') ? FACEBOOK_PIXEL_ID : false;
    $array_for_js['DEFAULT_PIXEL_CURRENCY'] = defined('DEFAULT_PIXEL_CURRENCY') ? DEFAULT_PIXEL_CURRENCY : false;
} else {
    $array_for_js['FACEBOOK_PIXEL_MODULE_ENABLED'] = false;
    $array_for_js['FACEBOOK_PIXEL_ID'] = false;
    $array_for_js['DEFAULT_PIXEL_CURRENCY'] = false;
}


$array_for_js = array_map('addslashes', $array_for_js);
$assets->jsConstants = $array_for_js;

// Ultimate SEO URLs v2.1
if ((!defined('SEO_ENABLED')) || (SEO_ENABLED == 'true')) {
    include_once(DIR_WS_CLASSES . 'seo.class.php');
    if (!is_object($seo_urls)) {
        $seo_urls = new SEO_URL($languages_id);
    }
}

if (isset($_GET['fillSeoUrlForFilters'])) {
    makeSeoUrlsForOptions();
    makeSeoUrlsForOptionsValues();
}

//remove query params
$urlWithoutParams = explode('?', $_SERVER['REQUEST_URI'])[0];
//remove query params
$urlWithoutLanguage = array_reverse(array_unique(array_filter(explode('/', $urlWithoutParams))))[0];

switch ($urlWithoutLanguage) {
    case 'new.html':
        $_GET['sort'] = $_GET['sort'] ?: 'new';
        break;
    case 'specials.html':
        $_GET['type'] = $_GET['type'] ?: 'specials';
        break;
    case 'featured.html':
        $_GET['sort'] = $_GET['sort'] ?: 'featured';
        break;
}

// currency
if (!tep_session_is_registered('currency') || isset($_GET['currency']) || ((USE_DEFAULT_LANGUAGE_CURRENCY == 'true') && (LANGUAGE_CURRENCY != $currency))) {
    if (!tep_session_is_registered('currency')) {
        tep_session_register('currency');
    }

    $currency = (USE_DEFAULT_LANGUAGE_CURRENCY == 'true' and tep_currency_exists(LANGUAGE_CURRENCY)) ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
    if (isset($_GET['currency']) && tep_currency_exists($_GET['currency'])) {
        $_SESSION['currency'] = $currency = $_GET['currency'];
        $url = '/' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(['language', 'currency']));
        $url = str_replace('//', '/', $url);
        tep_redirect($url);
    } else {
        if (isset($_GET['currency'])) {
            unset($_GET['currency']);
        }
        if (!empty($_SESSION['currency'])) {
            $currency = $_SESSION['currency'];
        }
    }

    $_SESSION['currency'] = $currency;
}

$array_for_js['CURRENCY_CODE'] = $_SESSION['currency'];

// BOF: Down for Maintenance except for admin ip
if (EXCLUDE_ADMIN_IP_FOR_MAINTENANCE != getenv('REMOTE_ADDR')) {
    if (DOWN_FOR_MAINTENANCE == 'true' and !strstr($PHP_SELF, DOWN_FOR_MAINTENANCE_FILENAME)) {
        tep_redirect(tep_href_link(DOWN_FOR_MAINTENANCE_FILENAME));
    }
}
// do not let people get to down for maintenance page if not turned on
if (DOWN_FOR_MAINTENANCE == 'false' and strstr($PHP_SELF, DOWN_FOR_MAINTENANCE_FILENAME)) {
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
}
// EOF: WebMakers.com Added: Down for Maintenance


// wishlist data
if (!tep_session_is_registered('wishList')) {
    tep_session_register('wishList');
    $wishList = new wishlist();
    $_SESSION['wishList'] = $wishList;
}

// Shopping cart actions
if (!tep_session_is_registered('compares')) {
    tep_session_register('compares');
}
if (isset($_GET['action']) and $_POST['gv_redeem_code'] == '') {
    // redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled
    if ($session_started == false) {
        tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
    }

    $goto = basename($PHP_SELF);
    if ($_GET['action'] == 'buy_now') {
        $parameters = array(
            'action',
            'pid',
            'products_id'
        );
    } else {
        $parameters = array(
            'action',
            'pid'
        );
    }


    switch ($_GET['action']) {
        // customer wants to update the product quantity in their shopping cart
        case 'update_product':
            for ($i = 0; $i < sizeof($_POST['products_id']); $i++) {
                $_POST['products_id'][$i] = tep_db_prepare_input($_POST['products_id'][$i]);
                $r_order_units = tep_get_products_quantity_order_units($_POST['products_id'][$i]);
                $r_order_min = tep_get_products_quantity_order_min($_POST['products_id'][$i]);
                if ($r_order_units == 0) {
                    $r_order_units = 1;
                }
                if ($r_order_min == 0) {
                    $r_order_min = 1;
                }

                if (
                    in_array(
                        $_POST['products_id'][$i],
                        (is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : array())
                    )
                ) {
                    $cart->remove($_POST['products_id'][$i]);
                } else {
                    $attributes = ($_POST['id'][$_POST['products_id'][$i]]) ? $_POST['id'][$_POST['products_id'][$i]] : '';
                    if (($_POST['cart_quantity'][$i] >= $r_order_min)) {
                        if (($_POST['cart_quantity'][$i] % $r_order_units == 0)) {
                            $cart->add_cart(
                                $_POST['products_id'][$i],
                                round($_POST['cart_quantity'][$i]),
                                $attributes,
                                false
                            );
                        } else {
                            //  $error_cart_msg=trim($error_cart_msg) . '<br>' . trim(ERROR_PRODUCTS_QUANTITY_ORDER_UNITS_TEXT . ' ' . tep_get_products_name($_POST['products_id'][$i]) . ' - ' . ERROR_PRODUCTS_UNITS_INVALID . ' ' . $_POST['cart_quantity'][$i] . ' - ' . PRODUCTS_ORDER_QTY_UNIT_TEXT_CART . ' ' . $r_order_units);
                        }
                    } else {
                        //   $error_cart_msg=trim($error_cart_msg) . '<br>' . trim(ERROR_PRODUCTS_QUANTITY_ORDER_MIN_TEXT . ' ' . tep_get_products_name($_POST['products_id'][$i]) . ' - ' . ERROR_PRODUCTS_QUANTITY_INVALID . ' ' . $_POST['cart_quantity'][$i] . ' - ' . PRODUCTS_ORDER_QTY_MIN_TEXT_CART . ' ' . $r_order_min);
                    }
                }
            }
            //   tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters), 'NONSSL'));
            break;

        // customer adds a product from the products page
        case 'add_product':
            if (preg_match('/^[0-9]+$/', $_POST['products_id'])) {
                $r_order_min = tep_get_products_quantity_order_min($_POST['products_id']);
                $r_order_units = tep_get_products_quantity_order_units($_POST['products_id']);
                if ($r_order_min == 0) {
                    $r_order_min = 1;
                }
                if ($r_order_units == 0) {
                    $r_order_units = 1;
                }
                $_POST['cart_quantity'] = (int)$_POST['cart_quantity'];

                if ($_POST['cart_quantity'] < $r_order_min) {
                    $_POST['cart_quantity'] = $r_order_min;
                }

                if (
                    ($_POST['cart_quantity'] >= $r_order_min) or ($cart->get_quantity(tep_get_uprid(
                        $_POST['products_id'],
                        $_POST['id']
                    )) >= $r_order_min)
                ) {
                    if (
                        $_POST['cart_quantity'] % $r_order_units == 0 &&
                        ($cart->get_quantity(tep_get_uprid($_POST['products_id'], $_POST['id'])) + $_POST['cart_quantity']) >= $r_order_min
                    ) {
                        $cart->add_cart($_POST['products_id'], ($cart->get_quantity(tep_get_uprid($_POST['products_id'], $_POST['id'])) + $_POST['cart_quantity']), $_POST['id']);
                    } else {
                        $r_mult = ceil($_POST['cart_quantity'] / $r_order_units);   // round up to a greater amount
                        $_POST['cart_quantity'] = $r_mult * $r_order_units;
                        $cart->add_cart($_POST['products_id'], ($cart->get_quantity(tep_get_uprid($_POST['products_id'], $_POST['id'])) + (int)$_POST['cart_quantity']), $_POST['id']);
                        //    $error_cart_msg=ERROR_PRODUCTS_QUANTITY_ORDER_UNITS_TEXT . ERROR_PRODUCTS_UNITS_INVALID . $_POST['cart_quantity']  . ' - ' . PRODUCTS_ORDER_QTY_UNIT_TEXT_INFO . ' ' . $r_order_units;
                    }
                } else {
                    //  $error_cart_msg=ERROR_PRODUCTS_QUANTITY_ORDER_MIN_TEXT . ERROR_PRODUCTS_QUANTITY_INVALID . $_POST['cart_quantity'] . ' - ' . PRODUCTS_ORDER_QTY_MIN_TEXT_INFO . ' ' . $r_order_min;
                }

                $product_info_query = tep_db_query("select p.products_model, pd.products_name, cd.categories_name, p.products_quantity, p.products_price, mi.manufacturers_name from " . TABLE_PRODUCTS . " p " .
                    "left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on pd.products_id = p.products_id and pd.language_id = " . (int)$languages_id . " " .
                    /*"left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id " . */
                    "left join " . TABLE_MANUFACTURERS_INFO . " mi on p.manufacturers_id = mi.manufacturers_id and mi.languages_id = " . (int)$languages_id . " " .
                    "left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id " .
                    "left join " . TABLE_CATEGORIES_DESCRIPTION . " cd on cd.categories_id = p2c.categories_id and cd.language_id = " . (int)$languages_id . " " .
                    "where p.products_status = '1' and p.products_id = " . (int)$_POST['products_id']);
                $product_info = tep_db_fetch_array($product_info_query);

                $response = array(
                    'id' => (int)$_POST['products_id'],
                    'name' => $product_info['products_name'],
                    'category' => $product_info['categories_name'],
                    'brand' => $product_info['manufacturers_name'],
                    'price' => (float)$product_info['products_price'],
                    'quantity' => (int)$_POST['cart_quantity']
                );

                if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                } else {
                    tep_redirect($_SERVER['HTTP_REFERER']);
                }

                exit();
            }
            break;

        case 'compare':
            if (tep_session_is_registered('compares') && isset($_GET['idp'])) {
                $_SESSION['compares'][(int)$_GET['idp']] = (int)$_GET['idp'];
            }

            if (isset($_GET['delete'])) {
                if ($_GET['delete'] == "all") {
                    unset($_SESSION['compares']);
                } else {
                    unset($_SESSION['compares'][$_GET['delete']]);
                }

                //  tep_redirect(tep_href_link('compare.php'));
            }
            break;
        case 'add_set':
            $cart->add_cart(
                $_GET['products_id'],
                $cart->get_quantity(tep_get_uprid($_GET['products_id'], $_GET['id'])) + 1,
                $_GET['id']
            );
            $cart->add_cart(
                $_GET['bt_products_id'],
                $cart->get_quantity(tep_get_uprid($_GET['bt_products_id'], $_GET['bt_attr_id'])) + 1,
                $_GET['bt_attr_id']
            );
            die(json_encode(1));
            break;
    }
}


require(DIR_WS_FUNCTIONS . 'whos_online.php');  // include the who's online functions
tep_update_whos_online();

require(DIR_WS_FUNCTIONS . 'password_funcs.php'); // include the password crypto functions
require(DIR_WS_FUNCTIONS . 'validations.php'); // include validation functions (right now only email address)
require(DIR_WS_CLASSES . 'split_page_results.php'); // split-page-results
require(DIR_WS_CLASSES . 'breadcrumb.php'); // include the breadcrumb class and start the breadcrumb trail

$cat_tree = setTree();  //new function setTree
getCatSeoUrl();
$manufacturersToProductsId = [];
$prodToManufacturers = countProdToManufacturers();
$prodToCat = prodToCat();
$manufacturers_array = tep_get_manufacturers();
$taxRatesArray = getTaxRates();
$cPathTree = null;
tep_get_cpath_global($cat_tree); // generate cPaths array
if (getConstantValue('SEO_ADD_PARENT_CATEGORIES_TO_URL') === 'true') {
    $cPaths = $cPathTree; // add parent categories is to category URL
}
tep_get_categories_urls(); // generate categories urls
tep_make_cat_list();

if (empty($skipGeoPluginRedirect)) {
    if (!tep_session_is_registered('geopluginJSONE')) {
        require(DIR_WS_CLASSES . 'geoplugin.class.php');
        $geoplugin = new geoPlugin();
        $geoplugin->locate();
        $geopluginJSONE = json_encode($geoplugin);
        tep_session_register('geopluginJSONE');
        tep_setcookie('geoplugin_data', json_encode($geoplugin), time() + SECONDS_PER_WEEK);
    } else {
        $geoplugin = json_decode($_SESSION['geopluginJSONE']);
    }

    if (getConstantValue('CHANGE_BY_GEOLOCATION') === "true" && !isset($_COOKIE['lang_and_currency_changed']) && !empty($_SERVER['HTTP_USER_AGENT']) && !isBot()) {
        $geolocation_currency = $geoplugin->currencyCode ? $geoplugin->currencyCode : DEFAULT_CURRENCY;
        $geolocation_language = isset($geoplugin->languages[0]) ? strtolower($geoplugin->languages[0]) : DEFAULT_LANGUAGE;
        //if current language != $geolocation_language or current currency != $geolocation_currency
        if ($geolocation_language != $lng->language['code'] || $geolocation_currency != $currency) {
            //add cookie flag for next lang_and_currency autochanges
            tep_setcookie('lang_and_currency_changed', 1, time() + 60 * 60 * 24 * 7);
            // check if isset geo languages at our DB languages
            if (isset($lng->languages[$geolocation_language])) {
                $_SESSION['language_short'] = $geolocation_language;
            }
            // check if isset geo currency at our DB languages
            $currencyParam = isset($currencies->currencies[$geolocation_currency]) ? 'currency=' . $geolocation_currency : '';
            $redirect_to = HTTP_SERVER . "/" . tep_href_link(
                    (basename($PHP_SELF) != 'index.php' ? basename($PHP_SELF) : ''),
                    tep_get_all_get_params(['geoplugin', 'language']) . $currencyParam
                );
            header("HTTP/1.0 301 Moved Permanently");
            header("Location: $redirect_to");
            exit;
        }
    }
}

if (isset($_GET['keywords']) || isset($_GET['cPath']) || isset($_GET['manufacturers_id']) || isset($_GET['filtercPath'])) {
    if (defined('SEO_FILTER') && constant('SEO_FILTER') == 'true') {
        $optionsValuesToOption = [];
        $optionValuesUrls = getOptionValuesSeoUrlsList();
        $customSeoUrlList = getCustomSeoUrlsList();
        $countForRobots = [];

        if ($isFilter = isFilterUrl()) {
            $origUrl = $_SERVER['REQUEST_URI'];
            $_GET['cPath'] = substr($_GET['filtercPath'], 1, strlen($_GET['filtercPath']));
            $newUrl = 'c' . $_GET['cPath'];
            unset($_GET['filtercPath']);
            if (!empty($_GET['filterId'])) {
                $_GET['filter_id'] = substr($_GET['filterId'], 1, strlen($_GET['filterId']));
                $newUrl .= 'f' . $_GET['filter_id'];
            }
            unset($_GET['filterId']);
            if (!empty($_GET['optionsvalues']) || array_filter(array_keys($_GET), 'is_numeric')) {
                $options = substr($_GET['optionsvalues'], 1, strlen($_GET['optionsvalues']));
                $options = array_filter(explode('-', $options), 'is_numeric');
                foreach ($_GET as $k => $v) {
                    if (is_numeric($k)) {
                        $options = array_merge($options, explode('-', $v));
                        unset($_GET[$k]);
                    }
                }
                $newUrl .= 'a';
                $newUrlOptions = $redirectOptionsIdsArrayForCheck = [];
                foreach ($options as $oValue) {
                    if (isset($optionsValuesToOption[$oValue])) {
                        $newUrlOptions[] = $oValue;
                        $_GET[$optionsValuesToOption[$oValue]][$oValue] = $oValue;
                    }
                }
                foreach ($_GET as $k => &$queryValue) {
                    if (is_numeric($k)) {
                        $countForRobots[$k] = count($queryValue);
                        $queryValue = implode('-', $queryValue);
                        $redirectOptionsIdsArrayForCheck[$k] = $queryValue;
                    }
                };
                $newUrl .= implode('-', $newUrlOptions);
            }
            unset($_GET['optionsvalues']);
            $addPage = true;
            if (
                urldecode($origUrl) != $redirectUrl = getFilterUrl(
                    $_GET['cPath'],
                    (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''),
                    $redirectOptionsIdsArrayForCheck
                )
            ) {
                if ($_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest' && empty($_GET['manufacturers_id']) && empty($_GET['keywords'])) {
                    tep_redirect(HTTP_SERVER . $redirectUrl);
                }
            }
            $addPage = false;
        } elseif (($numericKeys = array_filter(array_keys($_GET), 'is_numeric')) || isset($_GET['filter_id'])) {
            $numericArray = [];
            if ($numericKeys) {
                $numericArray = array_intersect_key($_GET, array_flip($numericKeys));
            }
            foreach ($numericArray as $k => $queryValue) {
                if (is_numeric($k)) {
                    $countForRobots[$k] = count(explode('-', $queryValue));
                }
            };
            $addPage = true;
            $redirectUrl = getFilterUrl($_GET['cPath'], (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), $numericArray);
            $addPage = false;
            if ($_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest' && empty($_GET['manufacturers_id']) && empty($_GET['keywords'])) {
                tep_redirect(HTTP_SERVER . $redirectUrl);
            }
        }

        $seoFilterInfo = getFilterSeoInfo($tempSeoFilterInfo);
        $checkFilterRobots = $checkFilterNext = false;
        if ($_GET['filter_id'] && count($countForRobots) > 1) {
            $checkFilterRobots = true;
        } elseif (count($countForRobots) > 2) {
            $checkFilterRobots = true;
        } elseif (
            count($countForRobots) == 2 && array_reduce($countForRobots, function ($r, $acc) {
                return $r + $acc;
            }, 0) > 2
        ) {
            $checkFilterRobots = true;
        } elseif (
            count($countForRobots) == 1 && array_reduce($countForRobots, function ($r, $acc) {
                return $r + $acc;
            }, 0) > 1
        ) {
            $checkFilterRobots = true;
        }
        if (
            isset($_GET['filter_id']) && count($countForRobots) == 1 && array_reduce(
                $countForRobots,
                function ($r, $acc) {
                    return $r + $acc;
                },
                0
            ) == 1
        ) {
            $checkFilterNext = true;
        } elseif ($_GET['filter_id'] && count($countForRobots) == 1) {
            $checkFilterNext = true;
        } elseif (
            !isset($_GET['filter_id']) && count($countForRobots) == 2 && array_reduce(
                $countForRobots,
                function ($r, $acc) {
                    return $r + $acc;
                },
                0
            ) == 2
        ) {
            $checkFilterNext = true;
        }
    }
}
// calculate category path
if (isset($_GET['cPath'])) {
    // raid 23.10.2012
    $cPath = urldecode($_GET['cPath']);
    $cPath = preg_replace('/_/i', '-', $cPath);
    $cPath = preg_replace('/[^0-9,-]/i', '', $cPath);
} elseif (isset($_GET['products_id']) && !isset($_GET['manufacturers_id'])) {
    $cPath = tep_get_product_path($_GET['products_id']);
} else {
    $cPath = '';
}

if (tep_not_null($cPath)) {
    $cPath_array = isset($cPathTree[$cPath]) ? tep_parse_category_path($cPathTree[$cPath]) : tep_parse_category_path($cPath);
    $current_category_id = $cPath_array[(sizeof($cPath_array) - 1)];
} else {
    $current_category_id = 0;
}

// ------temp RAID -----ne trogaite!!!!-------//
if (!empty($cPath)) {
    if ($promUrls) {
        $_GET['cPath'] = $cPath = $cPaths[$current_category_id];

        $cPath_array = tep_parse_category_path($cPath);
    }
    //    $cPath = implode('_', $cPath_array);
    //  $r_current_subcats=tep_make_cat_list($current_category_id); // show all subcategories
    $r_current_subcats = $cat_list[$current_category_id]; // show all subcategories
    $r_current_subcats[] = (int)$current_category_id; // add current category to categories array
    $where_subcategories = "p2c.categories_id in(" . implode(',', $r_current_subcats) . ") and";
    $all_active_cats = implode(',', $r_current_subcats);

    if (!$promUrls) {
        // check cpath, if not valid - redirect!:
        if ($cPath != ($valid_cpath = (isset($cPaths[$current_category_id]) ? $cPaths[$current_category_id] : $cPath))) {
            $redirect_url = tep_href_link(FILENAME_DEFAULT, 'cPath=' . $valid_cpath);
            header("HTTP/1.0 301 Moved Permanently");
            header("Location: $redirect_url");
            tep_exit();
        }
    }
} else {
    // if NOT category page: listing on main page, or manufacturers or product info or other pages:
    if (is_array($all_active_cats = $cat_list[0]) and !empty($all_active_cats)) {
        $all_active_cats = implode(',', $all_active_cats);
    } else {
        $all_active_cats = 0;
    }

    $where_subcategories = "p2c.categories_id in(" . $all_active_cats . ") and";
}

// find all products with status = 1 + from categories with status = 1
$allProductsInActiveCategories = [];

foreach (explode(',', $all_active_cats) as $aac) {
    if (is_array($catToProd[$aac])) {
        foreach ($catToProd[$aac] as $allProductsIn) {
            $allProductsInActiveCategories[$allProductsIn] = $allProductsIn;
        }
    }
}
$activeProductsXsellProductsBuynow = $activeProducts;
$activeProducts = !empty($activeProducts) ? array_intersect_key($activeProducts, $allProductsInActiveCategories) : [];

if (($_GET['currency'])) {
    tep_session_register('kill_sid');
    $kill_sid = false;
}
if (basename($_SERVER['HTTP_REFERER']) == 'allprods.php') {
    $kill_sid = true;
}
if ((!tep_session_is_registered('customer_id')) && ($cart->count_contents() == 0) && (!tep_session_is_registered('kill_sid'))) {
    $kill_sid = true;
}
if ((basename($PHP_SELF) == FILENAME_LOGIN) && ($_GET['action'] == 'process')) {
    $kill_sid = false;
}

if (file_exists(__DIR__ . "/../ext/json_ld/connector.php")) {
    include_once __DIR__ . "/../ext/json_ld/connector.php";
}

$breadcrumb = new breadcrumb();
$breadcrumb->add(STORE_NAME, tep_href_link('/'));
if (isset($_GET['manufacturers_id'])) {
    $breadcrumb->add(TEXT_NAVIGATION_BRANDS, tep_href_link('brands'));
}

$page_not_found = false;
$allowRedirect = true;

//redirect to page_not_found if too many params
if ((is_array($_GET) && count($_GET) > 10)) {
    $page_not_found = true;
}

if (isset($cPath_array)) {
    for ($i = 0, $n = sizeof($cPath_array); $i < $n; $i++) {
        $cid = (int)$cPath_array[$i];

        if (isset($cat_names[$cid]) or $cid == 0) {
            if ($breadcrumb) {
                $breadcrumb->add($cat_names[$cid], tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cid));
            }
            if ($i == ($n - 1)) {
                $make_redirect = tep_href_link(
                    FILENAME_DEFAULT,
                    'cPath=' . $cid . $filterString
                ); // empty function to execute SEO URL and check link (if it wrong - SEO URL will redirect it)
                if (
                    !isset($_GET['products_id'])
                    && getConstantValue('SEO_ADD_SLASH_BEFORE_CATEGORY_ID') == 'true'
                    && !strpos($_SERVER['REQUEST_URI'],'/c-')
                    && empty($tempSeoFilterInfo)
                    && $cid != 0
                    && !$isFilter
                    && getConstantValue('PROMURLS_MODULE_ENABLED', false) === false
                ) {
                    $url = HTTP_SERVER . str_replace('//', '/', '/' . $make_redirect);
                    tep_redirect($url);
                }
            }
        } else {
            $page_not_found = true;
        }
    }
} elseif (isset($_GET['manufacturers_id'])) {
    if (isset($manufacturers_array[(int)$_GET['manufacturers_id']])) {
        $breadcrumb->add($manufacturers_array[(int)$_GET['manufacturers_id']]['name']);
        $make_redirect = tep_href_link(
            FILENAME_DEFAULT,
            'manufacturers_id=' . $_GET['manufacturers_id']
        ); // empty function to execute SEO URL and check link (if it wrong - SEO URL will redirect it)
    } else {
        $page_not_found = true;
    }
}
// add the products model to the breadcrumb trail
if (isset($_GET['products_id']) && !isset($_GET['isCriticalMode'])) {
    $model_query = tep_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = " . (int)$_GET['products_id'] . " and language_id = " . (int)$languages_id);
    if (tep_db_num_rows($model_query)) {
        $model = tep_db_fetch_array($model_query);
        $make_redirect = tep_href_link(
            FILENAME_PRODUCT_INFO,
            'cPath=' . $cPath . '&products_id=' . (int)$_GET['products_id']
        ); // empty function to execute SEO URL and check link (if it wrong - SEO URL will redirect it)
        //module prom url must be disabled
        if (getConstantValue('PROMURLS_MODULE_ENABLED', false) === false &&  getConstantValue('SEO_ADD_SLASH_BEFORE_PRODUCT_ID') === true && !strpos($_SERVER['REQUEST_URI'], '/p-')) {
            $url = HTTP_SERVER . str_replace('//', '/', '/' . $make_redirect);
            tep_redirect($url);
        }
    }
}

// include the articles functions
require(DIR_WS_FUNCTIONS . 'articles.php');

// calculate topic path
if (isset($_GET['tPath'])) {
    $tPath = $_GET['tPath'];
} elseif (isset($_GET['articles_id'])) {
    $tPath = tep_get_article_path($_GET['articles_id']);
} else {
    $tPath = '';
}

if (tep_not_null($tPath)) {
    if (strrpos($_SERVER['REQUEST_URI'], '//') !== false) {
        $make_redirect = tep_href_link(FILENAME_ARTICLES, 'tPath=' . $tPath);
        $url = HTTP_SERVER . str_replace('//', '/-/', $make_redirect);
        tep_redirect($url);
    }
    $tPath_array = tep_parse_topic_path($tPath);
    $tPath = implode('-', $tPath_array);
    $current_topic_id = $tPath_array[(sizeof($tPath_array) - 1)];
} else {
    $current_topic_id = 0;
}

// add topic names to the breadcrumb trail
if (isset($tPath_array)) {
    for ($i = 0, $n = sizeof($tPath_array); $i < $n; $i++) {
        $topics_query = tep_db_query("select topics_name from " . TABLE_TOPICS_DESCRIPTION . " where topics_id = " . (int)$tPath_array[$i] . " and language_id = " . (int)$languages_id);
        if (tep_db_num_rows($topics_query) > 0) {
            $topics = tep_db_fetch_array($topics_query);
            $make_redirect = tep_href_link(
                FILENAME_ARTICLES,
                'tPath=' . implode('_', array_slice($tPath_array, 0, ($i + 1)))
            );
            if (isset($_GET['articles_id'])) {
                $breadcrumb->add(
                    $topics['topics_name'],
                    tep_href_link(FILENAME_ARTICLES, 'tPath=' . implode('_', array_slice($tPath_array, 0, ($i + 1))))
                );
            } else {
                $breadcrumb->add($topics['topics_name'], '');
            }
        } else {
            break;
        }
    }
}

// add the articles name to the breadcrumb trail
if (isset($_GET['articles_id'])) {
    $article_query = tep_db_query("select ad.articles_name from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad where ad.articles_id = a.articles_id and ad.articles_id = " . (int)$_GET['articles_id'] . " and ad.language_id = " . (int)$languages_id . " and a.articles_status = '1'");
    if (tep_db_num_rows($article_query)) {
        $article = tep_db_fetch_array($article_query);
        //$breadcrumb->add($article['articles_name'], tep_href_link(FILENAME_ARTICLE_INFO, 'tPath=' . $tPath . '&articles_id=' . $_GET['articles_id']));
        $make_redirect = tep_href_link(
            FILENAME_ARTICLE_INFO,
            'tPath=' . $tPath . '&articles_id=' . (int)$_GET['articles_id']
        );
        $breadcrumb->add($article['articles_name'], '');
    }
}
$allowRedirect = false;

// initialize the message stack for output messages
require(DIR_WS_CLASSES . 'message_stack.php');
$messageStack = new messageStack();

// set which precautions should be checked
define('WARN_INSTALL_EXISTENCE', 'true');
define('WARN_CONFIG_WRITEABLE', 'true');
define('WARN_SESSION_DIRECTORY_NOT_WRITEABLE', 'true');
define('WARN_SESSION_AUTO_START', 'true');
define('WARN_DOWNLOAD_DIRECTORY_NOT_READABLE', 'true');

$headers_mainpage_aid = 68; // ID of article with main page meta-tags
$headers_mainpage = tep_db_query("select a.articles_image, ad.articles_name, ad.articles_head_title_tag, ad.articles_head_desc_tag, ad.articles_head_keywords_tag from " . TABLE_ARTICLES_DESCRIPTION . " ad LEFT JOIN articles a on a.articles_id=ad.articles_id where ad.articles_id = " . $headers_mainpage_aid . " and ad.language_id = " . (int)$languages_id);
$headers_mainpage = tep_db_fetch_array($headers_mainpage);

require(DIR_WS_FUNCTIONS . 'add_ccgvdc.php');
// BOF: WebMakers.com Added: Header Tags Controller v1.0
require(DIR_WS_FUNCTIONS . 'header_tags.php');
// Clean out HTML comments from ALT tags etc.
require(DIR_WS_FUNCTIONS . 'clean_html_comments.php');
// Also used by: WebMakers.com Added: FREE-CALL FOR PRICE
// EOF: WebMakers.com Added: Header Tags Controller v1.0

// BOF: WebMakers.com Added: Downloads Controller
require(DIR_WS_FUNCTIONS . 'downloads_controller.php');
// EOF: WebMakers.com Added: Downloads Controller

// +Country-State Selector
define('DEFAULT_COUNTRY', STORE_COUNTRY);
// -Country-State Selector

// adapted for Total B2B Contributions start
//Minimum group price to order
// min price
$customers_groups_min_price = 0;
$customers_price = 'products_price';
if (is_file(DIR_WS_EXT . 'customers_groups/customers_groups.php')) {
    $min_price_query = tep_db_query("select g.customers_groups_id, g.customers_groups_price, g.customers_groups_min_price from " . TABLE_CUSTOMERS_GROUPS . " g inner join  " . TABLE_CUSTOMERS . " c on g.customers_groups_id = c.customers_groups_id and c.customers_id = " . (int)$customer_id);

    $min_price = tep_db_fetch_array($min_price_query);
    $customers_groups_min_price = $min_price['customers_groups_min_price'];
    $customers_groups_id = $min_price['customers_groups_id'];
    $customer_price = 'products_price_' . $min_price['customers_groups_price'];
}

if (empty($min_price['customers_groups_price']) or $min_price['customers_groups_price'] == 1 or !$customer_id) {
    $customer_price = 'products_price';
}

// define the minimum order
define('MIN_ORDER_B2B', $customers_groups_min_price);
//Minimum group price to order
//  adapted for Total B2B Contributions end


$fb_app_id = FACEBOOK_APP_ID;
$fb_app_secret = FACEBOOK_APP_SECRET;
$fb_url = HTTP_SERVER . "/ext/auth/ajax_loginfb.php";
$fb_state = 'solomono';

$vk_app_id = VK_APP_ID; // auth
$vk_app_secret = VK_APP_SECRET;
$vk_url = HTTP_SERVER . '/ext/auth/ajax_loginvk.php';

$googleClientID = defined('GOOGLE_OAUTH_CLIENT_ID') ? GOOGLE_OAUTH_CLIENT_ID : '';
$googleClientSecret = defined('GOOGLE_OAUTH_CLIENT_SECRET') ? GOOGLE_OAUTH_CLIENT_SECRET : '';
$googleRedirectUri = HTTP_SERVER . '/ext/auth/ajax_login_google.php';

// get multicolor ID:
$multicolor_name_query = tep_db_query("select products_options_id from " . TABLE_PRODUCTS_OPTIONS . "  where products_options_type = 3");
$multicolor_name = tep_db_fetch_array($multicolor_name_query);
$color_id = $multicolor_name['products_options_id'];
//$color_id=MULTICOLOR_NAME;


// add constants for javascript
$array_for_js['TEMPLATE_PATH'] = DIR_WS_TEMPLATES . TEMPLATE_NAME;
$array_for_js['SEO_FILTER'] = defined('SEO_FILTER') && constant('SEO_FILTER') == 'true';
$array_for_js['CATEGORIES_TABS_SLIDER'] = false; //TODO сюди тянути константу

// define current template constants:
require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/render_template.php');

// custom product fields for template:
//debug(is_array(unserialize(RTPL_LISTING_ADD_FIELDS)));
if (defined('RTPL_LISTING_ADD_FIELDS') and is_array(unserialize(RTPL_LISTING_ADD_FIELDS)) and unserialize(RTPL_LISTING_ADD_FIELDS)) {
    $listing_add_fields = implode(',', unserialize(RTPL_LISTING_ADD_FIELDS)) . ',';
} else {
    $listing_add_fields = '';
}

include "includes/addressTypePosition.php";

// clear order sessions if automatic payment:
if (tep_session_is_registered('cart_payment_id') && (isset($_SESSION['complete_status']) || isset($_SESSION['check_order_status']))) {
    $orderId = substr($_SESSION['cart_payment_id'], strpos($_SESSION['cart_payment_id'], '-') + 1);

    \App\Logger\Log::channel('payment')->info("Try to verify complete payment for order {$orderId}");

    if (isset($_SESSION['complete_status'])) {
        $orderCompletedCounter = 0;
        while ($orderCompletedCounter < 5) {
            sleep(2);
            $isComplete = isOrderComplete($orderId, $_SESSION['complete_status']);
            \App\Logger\Log::channel('payment')->info("Try #{try_number}, for order {$orderId}. Payment is {result}", [
                'try_number' => $orderCompletedCounter + 1,
                'result' => $isComplete ? 'complete' : 'incomplete',
            ]);
            if ($isComplete) {
                \App\Logger\Log::channel('payment')->info("Clear order session for order {$orderId}");
                clear_order_sessions($orderId);
                break;
            }
            $orderCompletedCounter++;
        }
    } else {
        if (isset($_SESSION['check_order_status'])) {
            $isComplete = isOrderComplete($orderId, $_SESSION['check_order_status']);
            if ($isComplete) {
                \App\Logger\Log::channel('payment')->info("Clear order session for order {$orderId}");
                clear_order_sessions($orderId);
            }
        }
    }

    if ($_SESSION['complete_status']) {
        $_SESSION['check_order_status'] = $_SESSION['complete_status'];
        tep_session_unregister('complete_status');
        tep_redirect($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    }
}

// Coupons

$promo = tep_db_prepare_input($_GET['promo']);

if (file_exists("ext/coupons/coupon_cart.php") && $promo) {
    require_once DIR_WS_CLASSES . 'order_total.php';
    require_once DIR_WS_CLASSES . 'order.php';
    require_once "ext/coupons/coupon_cart.php";
    $order_total_modules = new order_total();
    $r = redeemCoupon($promo);
}
//End Coupons

if (
    in_array($lng->language['code'], array(
        'pl',
        'uk',
        'ru',
        'en'
    )) and ((DEFAULT_LANGUAGE == 'en' and $lng->language['code'] != DEFAULT_LANGUAGE) or (DEFAULT_LANGUAGE != 'en' and $lng->language['code'] != 'en'))
) {
    $solomono_link = '/' . $lng->language['code'] . '/';
}

if (PRODUCT_LABELS_MODULE_ENABLED == 'true') {
    require_once $rootPath . 'ext/labels/label.php';
}
if (COMPARE_MODULE_ENABLED == 'true') {
    require_once $rootPath . 'ext/compare/compare.inc.php';
}
if (WISHLIST_MODULE_ENABLED == 'true') {
    require_once $rootPath . 'ext/wishlist/wishlist.inc.php';
}
if (file_exists(DIR_WS_EXT . 'instagram/insta_controller.php')) {
    require DIR_WS_EXT . 'instagram/insta_controller.php';
}

require_once __DIR__ . "/simple_html_dom.php";
