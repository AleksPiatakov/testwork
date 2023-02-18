<?php
/*
  $Id: configuration.php,v 1.2 2003/09/24 13:57:05 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

header("Cache-control: private, no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); # Past date
header("Pragma: no-cache");
define('HIDE_CONFIGURATION_SORT_ORDER', 9999);
define('SET_REDIRECT_WWW_ID', 7271);
define('SET_HTTP_HTTPS', 2013);
require('includes/application_top.php');

$groupConfigurationKeys = getGroupConfigurationKeys();
$subConfigurationNames = getAllSubConfiguration($languages_id);
if ($_GET['db'] == 1 && !empty($_POST['sortOrder']) && !empty($_POST['groupId'])) {
    $sortOrder = tep_db_prepare_input($_POST['sortOrder']);
    $groupId = tep_db_prepare_input($_POST['groupId']);
    $subGroupId = tep_db_prepare_input($_POST['subGroupId']);
    foreach ($sortOrder as $cId => $sortOrderValue) {
        $groupIdValue = $groupId[$cId];
        $subGroupIdValue = $subGroupId[$cId];
        tep_db_query("
            UPDATE " . TABLE_CONFIGURATION . "
            SET sort_order = '{$sortOrderValue}'
              , configuration_group_id = '{$groupIdValue}'
              , configuration_subgroup_id = '{$subGroupIdValue}'
            WHERE configuration_id = '{$cId}'
        ");
    }
}

$tooltipMap = [
    'STORE_OWNER_EMAIL_ADDRESS' => TOOLTIP_CONFIGURATION_MAIN_EMAIL,
    'STORE_COUNTRY' => TOOLTIP_STORE_COUNTRY,
    'STORE_ZONE' => TOOLTIP_STORE_REGION,
    'STORE_ADDRESS' => TOOLTIP_CONTACT_ADDRESS,
    'MIN_ORDER' => TOOLTIP_MINIMUM_ORDER,
    'MASTER_PASS' => TOOLTIP_MASTER_PASSWORD,
    'DISPLAY_PRICE_WITH_TAX' => TOOLTIP_SHOW_PRICE_WITH_TAX,
    'DISPLAY_PRICE_WITH_TAX_CHECKOUT' => TOOLTIP_CALCULATE_TAX,
    'GUEST_DISCOUNT' => TOOLTIP_EXTRA_PRICE,
    'XPRICES_NUM' => TOOLTIP_PRICES_COUNT,
    'ALLOW_GUEST_TO_SEE_PRICES' => TOOLTIP_SHOW_PRICE_TO_NOT_AUTHORIZED_CUSTOMER,
    'LOGO_IMAGE' => TOOLTIP_LOGO,
    'WATER_MARK' => TOOLTIP_WATERMARK,
    'FAVICON_IMAGE' => TOOLTIP_FAVICON,
    'STOCK_CHECK' => TOOLTIP_AUTO_STOCK,
    'STOCK_SHOW_BUY_BUTTON' => TOOLTIP_DISABLED_BUY_BUTTON_FOR_ZERO_STOCK,
    'STOCK_LIMITED' => TOOLTIP_STOCK_AUTO_INCREMENT,
    'STOCK_ALLOW_CHECKOUT' => TOOLTIP_ALLOW_ZERO_STOCK_ORDER,
    'STOCK_MARK_PRODUCT_OUT_OF_STOCK' => TOOLTIP_MARK_ZERO_STOCK_PRODUCT,
    'SMS_TEXT' => TOOLTIP_SMS_TEXT,
    'SMS_LOGIN' => TOOLTIP_SMS_LOGIN,
    'SMS_PASSWORD' => TOOLTIP_SMS_PASSWORD,
    'SMS_SIGN' => TOOLTIP_SMS_CODE_1,
    'SMS_ENC' => TOOLTIP_SMS_CODE_2,
    'DOMEN_URL' => DOMEN_URL_DESC,
    'STOCK_ALLOW_CHECKOUT_WITH_ATTR_COUNT_0' => STOCK_ALLOW_CHECKOUT_WITH_ATTR_COUNT_0_DESC,

	 'STORE_NAME' => TOOLTIP_STORE_NAME,
	 'STORE_OWNER' => TOOLTIP_STORE_OWNER,
	 'SHOW_BASKET_ON_ADD_TO_CART' => TOOLTIP_SHOW_BASKET_ON_ADD_TO_CART,
	 'USE_DEFAULT_LANGUAGE_CURRENCY' => TOOLTIP_USE_DEFAULT_LANGUAGE_CURRENCY,
	 'CHANGE_BY_GEOLOCATION' => TOOLTIP_CHANGE_BY_GEOLOCATION,
	 'GET_BROWSER_LANGUAGE' => TOOLTIP_GET_BROWSER_LANGUAGE,
	 'STORE_BANK_INFO' => TOOLTIP_STORE_BANK_INFO,
	 'ONEPAGE_LOGIN_REQUIRED' => TOOLTIP_ONEPAGE_LOGIN_REQUIRED,
	 'REVIEWS_WRITE_ACCESS' => TOOLTIP_REVIEWS_WRITE_ACCESS,
	 'ROBOTS_TXT' => TOOLTIP_ROBOTS_TXT,
     'MENU_LOCATION' => TOOLTIP_MENU_LOCATION,
	 'DEFAULT_DATE_FORMAT' => TOOLTIP_DEFAULT_DATE_FORMAT,
	 'SET_HTTPS' => TOOLTIP_SET_HTTPS,
	 'SET_WWW' => TOOLTIP_SET_WWW,
	 'ENABLE_DEBUG_PAGE_SPEED' => TOOLTIP_ENABLE_DEBUG_PAGE_SPEED,
	 'STORE_SCRIPTS' => TOOLTIP_STORE_SCRIPTS,
	 'STORE_METAS' => TOOLTIP_STORE_METAS,
	 'MYSQL_PERFORMANCE_TRESHOLD' => TOOLTIP_MYSQL_PERFORMANCE_TRESHOLD,

    'STOCK_REORDER_LEVEL' => TOOLTIP_STOCK_REORDER_LEVEL,

    'TELEGRAM_NOTIFICATIONS_ENABLED' => TOOLTIP_TELEGRAM_NOTIFICATIONS_ENABLED,
    'TELEGRAM_TOKEN' => TOOLTIP_TELEGRAM_TOKEN,
    'SMS_ENABLE' => TOOLTIP_SMS_ENABLE,
    'SMS_CUSTOMER_ENABLE' => TOOLTIP_SMS_CUSTOMER_ENABLE,
    'SMS_CHANGE_STATUS' => TOOLTIP_SMS_CHANGE_STATUS,
    'SMS_OWNER_ENABLE' => TOOLTIP_SMS_OWNER_ENABLE,
    'SMS_OWNER_TEL' => TOOLTIP_SMS_OWNER_TEL,

    'ENTRY_FIRST_NAME_MIN_LENGTH' => TOOLTIP_ENTRY_FIRST_NAME_MIN_LENGTH,
    'ENTRY_LAST_NAME_MIN_LENGTH' => TOOLTIP_ENTRY_LAST_NAME_MIN_LENGTH,
    'ENTRY_EMAIL_ADDRESS_MIN_LENGTH' => TOOLTIP_ENTRY_EMAIL_ADDRESS_MIN_LENGTH,
    'MIN_DISPLAY_XSELL' => TOOLTIP_MIN_DISPLAY_XSELL,

    'FACEBOOK_AUTH_STATUS' => TOOLTIP_FACEBOOK_AUTH_STATUS,
    'FACEBOOK_APP_ID' => TOOLTIP_FACEBOOK_APP_ID,
    'FACEBOOK_APP_SECRET' => TOOLTIP_FACEBOOK_APP_SECRET,
    'FACEBOOK_PIXEL_ID' => TOOLTIP_FACEBOOK_PIXEL_ID,
    'DEFAULT_PIXEL_CURRENCY' => TOOLTIP_DEFAULT_PIXEL_CURRENCY,
    'FACEBOOK_GOALS_CLICK_ON_BUG_REPORT' => TOOLTIP_FACEBOOK_GOALS_CLICK_ON_BUG_REPORT,
    'FACEBOOK_GOALS_PHONE_CALL' => TOOLTIP_FACEBOOK_GOALS_PHONE_CALL,
    'FACEBOOK_GOALS_CLICK_FAST_BUY' => TOOLTIP_FACEBOOK_GOALS_CLICK_FAST_BUY,
    'FACEBOOK_GOALS_CLICK_ON_CHAT' => TOOLTIP_FACEBOOK_GOALS_CLICK_ON_CHAT,
    'FACEBOOK_GOALS_CALLBACK' => TOOLTIP_FACEBOOK_GOALS_CALLBACK,
    'FACEBOOK_GOALS_FILTER' => TOOLTIP_FACEBOOK_GOALS_FILTER,
    'FACEBOOK_GOALS_SUBSCRIBE' => TOOLTIP_FACEBOOK_GOALS_SUBSCRIBE,
    'FACEBOOK_GOALS_LOGIN' => TOOLTIP_FACEBOOK_GOALS_LOGIN,
    'FACEBOOK_GOALS_ADD_REVIEW' => TOOLTIP_FACEBOOK_GOALS_ADD_REVIEW,
    'FACEBOOK_GOALS_PAGE_VIEW' => TOOLTIP_FACEBOOK_GOALS_PAGE_VIEW,
    'FACEBOOK_GOALS_ADD_TO_CART' => TOOLTIP_FACEBOOK_GOALS_ADD_TO_CART,
    'FACEBOOK_GOALS_CHECKOUT_PROCESS' => TOOLTIP_FACEBOOK_GOALS_CHECKOUT_PROCESS,
    'FACEBOOK_GOALS_SEARCH_RESULTS' => TOOLTIP_FACEBOOK_GOALS_SEARCH_RESULTS,
    'FACEBOOK_GOALS_VIEW_CONTENT' => TOOLTIP_FACEBOOK_GOALS_VIEW_CONTENT,
    'FACEBOOK_GOALS_COMPLETE_REGISTRATION' => TOOLTIP_FACEBOOK_GOALS_COMPLETE_REGISTRATION,
    'FACEBOOK_GOALS_CONTACT_US_REQUEST' => TOOLTIP_FACEBOOK_GOALS_CONTACT_US_REQUEST,
    'FACEBOOK_GOALS_ADD_TO_WISHLIST' => TOOLTIP_FACEBOOK_GOALS_ADD_TO_WISHLIST,
    'FACEBOOK_GOALS_ADD_PAYMENT_INFO' => TOOLTIP_FACEBOOK_GOALS_ADD_PAYMENT_INFO,
    'FACEBOOK_GOALS_SUCCESS_PAGE' => TOOLTIP_FACEBOOK_GOALS_SUCCESS_PAGE,

    'GOOGLE_OAUTH_STATUS' => TOOLTIP_GOOGLE_OAUTH_STATUS,
    'GOOGLE_OAUTH_CLIENT_ID' => TOOLTIP_GOOGLE_OAUTH_CLIENT_ID,
    'GOOGLE_OAUTH_CLIENT_SECRET' => TOOLTIP_GOOGLE_OAUTH_CLIENT_SECRET,
    'GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED' => TOOLTIP_GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED,
    'GOOGLE_ECOMM_SUCCESS_PAGE' => TOOLTIP_GOOGLE_ECOMM_SUCCESS_PAGE,
    'GOOGLE_ECOMM_CHECKOUT_PAGE' => TOOLTIP_GOOGLE_ECOMM_CHECKOUT_PAGE,
    'GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE' => TOOLTIP_GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE,
    'GOOGLE_ECOMM_SEARCH_RESULTS' => TOOLTIP_GOOGLE_ECOMM_SEARCH_RESULTS,
    'GOOGLE_ECOMM_HOME_PAGE' => TOOLTIP_GOOGLE_ECOMM_HOME_PAGE,
    'GOOGLE_SITE_VERIFICATION_KEY' => TOOLTIP_GOOGLE_SITE_VERIFICATION_KEY,
    'GOOGLE_RECAPTCHA_STATUS' => TOOLTIP_GOOGLE_RECAPTCHA_STATUS,
    'GOOGLE_RECAPTCHA_PUBLIC_KEY' => TOOLTIP_GOOGLE_RECAPTCHA_PUBLIC_KEY,
    'GOOGLE_RECAPTCHA_SECRET_KEY' => TOOLTIP_GOOGLE_RECAPTCHA_SECRET_KEY,

    //'TELEGRAM_' => TOOLTIP_,



];
// #CP - local dir to the template directory where you are uploading the company logo
$template_query = tep_db_query("
    SELECT `configuration_id`
         , `configuration_title`
         , sort_order
         , configuration_group_id
         , `configuration_value` 
         , `depends_on` 
         , `configuration_subgroup_id` 
    FROM " . TABLE_CONFIGURATION . " 
    WHERE `configuration_key` = 'DEFAULT_TEMPLATE'
");
$template = tep_db_fetch_array($template_query);
$CURR_TEMPLATE = $template['configuration_value'] . '/';
$upload_fs_dir = DIR_FS_TEMPLATES . $CURR_TEMPLATE . DIR_WS_IMAGES;
$upload_ws_dir = DIR_WS_TEMPLATES . $CURR_TEMPLATE . DIR_WS_IMAGES;
$action = (isset($_GET['action']) ? $_GET['action'] : '');
$allowed_image_types = [
    'image/jpeg',
    'image/gif',
    'image/png',
    'image/webp',
    'image/vnd.microsoft.icon',
    'image/x-icon'
];
$cID = tep_db_prepare_input($_GET['cID']);
if (tep_not_null($action)) {
    $minify_query = tep_db_query(
        "SELECT configuration_value as v FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MINIFY_CSSJS'"
    );
    $minify_status_value = $minify_query->num_rows ? tep_db_fetch_array($minify_query)['v'] : false;
    switch ($action) {
        case 'setflag':
            $r_flag = '';
            $prefix = '';
            $newHref = $_POST['href'];
            if ($_GET['flag'] == '0') {
                $r_flag = 'false';
                $newHref = preg_replace('#flag=[1|0]#is', 'flag=1', $newHref);
            } elseif ($_GET['flag'] == '1') {
                $r_flag = 'true';
                $newHref = preg_replace('#flag=[1|0]#is', 'flag=0', $newHref);
            } else {
                if (strpos($_GET['flag'], 'false') !== false) {
                    $tmp = explode(':', $_GET['flag']);
                    $r_flag = $tmp[1];
                    $prefix = $tmp[0] . ':';
                    $newHref = str_replace(
                        'flag=' . $prefix . $r_flag,
                        'flag=' . $prefix . 'true',
                        $newHref
                    );
                } elseif (strpos($_GET['flag'], 'true') !== false) {
                    $tmp = explode(':', $_GET['flag']);
                    $r_flag = $tmp[1];
                    $prefix = $tmp[0] . ':';
                    $newHref = str_replace(
                        'flag=' . $prefix . $r_flag,
                        'flag=' . $prefix . 'false',
                        $newHref
                    );
                } else {
                    $r_flag = $_GET['flag'];
                }
            }

            if ($cID == 1908) {#watermark id 1908
                rewriteHtaccess($r_flag, '#WATERMARK', 3);
                if (file_exists($rootPath . '/images/cache')) {
                    rrmdir($rootPath . '/images/cache');
                }
            } elseif ($cID == 2013) {#set https id 2013
                $configuration_query = tep_db_query(
                    "SELECT `configuration_value` as cv FROM " .
                    TABLE_CONFIGURATION . " WHERE `configuration_id` = 1919"
                );
                $robotsStatus = tep_db_fetch_array($configuration_query);
                rewriteRobots($robotsStatus['cv']);
            } elseif ($cID == 1919) {#robots txt id 1919
                rewriteRobots($r_flag);
            } elseif ($cID == 2347) {#seo filters id 2347
                rewriteHtaccess($r_flag, '#SEOFILTERS', 1);
            } elseif ($cID == 1856 && $r_flag == "false") {#auth
                tep_db_query(
                    "update " . TABLE_CONFIGURATION .
                    " set configuration_value = 'false', last_modified = now() where configuration_key IN
                    ('GOOGLE_OAUTH_STATUS','FACEBOOK_AUTH_STATUS')"
                );
            }

            tep_db_query(
                "update " .
                TABLE_CONFIGURATION . " set configuration_value = '" . $prefix . $r_flag .
                "', last_modified = now() where configuration_id = " . (int)$cID
            );

            \App\Logger\Log::channel('all')->info('Update configuration_value ', [
                'cID' => $cID,
                'r_flag' => $r_flag,
                'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
            ]);

            //set Minify Now for all actions with param need_minify = 1
            if (isset($_GET['need_minify']) && $_GET['need_minify'] == 1 && $minify_status_value == '2') {
                resetMinifiedFiles();
            }

            if (isset($tmp[0]) && count($tmp) == 2 && $tmp[0] == 'promurl') {
                //minify js again if changed urls
                resetMinifiedFiles();
                $flag = $r_flag == 'true' ? true : false;
                rewriteHtaccess(!$flag, '#SOLOMONO', 11);
                rewriteHtaccess($flag, '#PROM', 3);

            }

            if ($cID == 2472) {#on/off GOOGLE AUTH
                resetMinifiedFiles();
            } elseif ($cID == SET_HTTP_HTTPS) { #check if not too many redirects after changed http/https and return if needs
                $http = $r_flag === 'false' ? 'http' : 'https';
                $httpRedirect = isRedirectHttpToHttps($http);
                if ($httpRedirect) {
                    $r_flag = $r_flag === 'true' ? 'false' : 'true';
                    tep_db_query(
                        "update " .
                        TABLE_CONFIGURATION . " set configuration_value = '" . $prefix . $r_flag .
                        "', last_modified = now() where configuration_id = " . (int)$cID
                    );
                }
            }

            print json_encode([
                'result' => 'success',
                'check' => $r_flag,
                'newHref' => $newHref,
            ]);
            exit;
            break;
        case 'required':
            $r_flag = '';
            $prefix = '';
            $newHref = $_POST['href'];
            if ($_GET['flag'] == '0') {
                $r_flag = 'false';
                $newHref = preg_replace('#flag=[1|0]#is', 'flag=1', $newHref);
            } elseif ($_GET['flag'] == '1') {
                $r_flag = 'true';
                $newHref = preg_replace('#flag=[1|0]#is', 'flag=0', $newHref);
            } else {
                if (strpos($_GET['flag'], 'false') !== false) {
                    $tmp = explode(':', $_GET['flag']);
                    $r_flag = $tmp[1];
                    $prefix = $tmp[0] . ':';
                    $newHref = str_replace(
                        'flag=' . $prefix . $r_flag,
                        'flag=' . $prefix . 'true',
                        $newHref
                    );
                } elseif (strpos($_GET['flag'], 'true') !== false) {
                    $tmp = explode(':', $_GET['flag']);
                    $r_flag = $tmp[1];
                    $prefix = $tmp[0] . ':';
                    $newHref = str_replace(
                        'flag=' . $prefix . $r_flag,
                        'flag=' . $prefix . 'false',
                        $newHref
                    );
                } else {
                    $r_flag = $_GET['flag'];
                }
            }

            tep_db_query(
                "update " .
                TABLE_CONFIGURATION . " set configuration_required_value = '" . $r_flag .
                "', last_modified = now() where configuration_id = " . (int)$cID
            );

            \App\Logger\Log::channel('all')->info('Update configuration_value ', [
                'cID' => $cID,
                'r_flag' => $r_flag,
                'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
            ]);

            print json_encode([
                'result' => 'success',
                'check' => $r_flag,
                'newHref' => $newHref,
            ]);
            exit;
            break;
        case 'save':
            $configuration_value = tep_db_prepare_input($_POST['configuration_value']);
            $newHref = $_POST['flagHref'];
            $r_flag = '';
            if (strpos($configuration_value, 'false') !== false) {
                $tmp = explode(':', $configuration_value);
                $r_flag = $tmp[1];
                $prefix = $tmp[0] . ':';
                $newHref = str_replace('flag=' . $prefix . $r_flag, 'flag=' . $prefix . 'true', $newHref);
            } else {
                if (strpos($configuration_value, 'true') !== false) {
                    $tmp = explode(':', $configuration_value);
                    $r_flag = $tmp[1];
                    $prefix = $tmp[0] . ':';
                    $newHref = str_replace(
                        'flag=' . $prefix . $r_flag,
                        'flag=' . $prefix . 'false',
                        $newHref
                    );
                } else {
                    if ($configuration_value === 'true') {
                        $newHref = str_replace('flag=1', 'flag=0', $newHref);
                    } else {
                        if ($configuration_value === 'false') {
                            $newHref = str_replace('flag=0', 'flag=1', $newHref);
                        }
                    }
                }
            }

            /* One Page Checkout - BEGIN*/
            if ($_GET['gID'] == 7575) {
                tep_db_query(
                    "update " . TABLE_CONFIGURATION .
                    " set configuration_value = '" . $_POST['configuration_value'] . "', last_modified = now()
                    where configuration_id = " . (int)$cID
                );
            } else {
                tep_db_query(
                    "update " . TABLE_CONFIGURATION .
                    " set configuration_value = '" . tep_db_input($configuration_value) . "', last_modified = now()
                    where configuration_id = " . (int)$cID
                );

                // change robots.txt (08.12.16)
                //if ($cID == 1919) {
                if (isset($_GET['configuration_key']) && $_GET['configuration_key'] == 'ROBOTS_TXT') {
                    file_put_contents(DIR_FS_CATALOG . "robots.txt", $configuration_value);
                }
            }

            \App\Logger\Log::channel('all')->info('Update configuration_value ', [
                'cID' => $cID,
                'configuration_value' => $_POST['configuration_value'],
                'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
            ]);

            // Configuration Cache modification start
            //        require ('includes/configuration_cache.php');
            // Configuration Cache modification end
            print json_encode([
                'result' => 'success',
                'configuration_value' => (empty($r_flag) == true ? $configuration_value : $r_flag),
                'newHref' => $newHref
            ]);
            exit;
            break;
        case 'tableSave':
            $configuration_value = tep_db_prepare_input($_POST['configuration_value']);
            $configuration_value = htmlentities($configuration_value);

            if(isset($_POST['file_type']) && $_POST['file_type'] =='base64'){
                unset($_GET['use_function']);
                $img = $_POST['configuration_value'];
                $path = DIR_FS_CATALOG . 'images/';
                $data = explode( ',', $img );
                $picture = base64_decode( $data[ 1 ] );
                file_put_contents($path.'logo_r.png', file_get_contents($picture));

                $full_path = $path . 'logo_r.png';

                if (move_uploaded_file($path, $full_path)) {
                }

                $configuration_value = 'images/logo_r.png';
            }

            if (isset($_GET['use_function']) && $_GET['use_function'] == 'file_upload') {
                if (!in_array($_FILES['configuration_value']['type'], $allowed_image_types)) {
                    $_FILES['configuration_value']['error'] = 1;
                }

                $path = DIR_FS_CATALOG . 'images/';// директория для загрузки
                $ext_prep = explode('.', $_FILES['configuration_value']['name']); // расширение
                $ext = array_pop($ext_prep); // расширение
                $new_name = $_FILES['configuration_value']['name']; // новое имя с расширением
                if ($_GET['configuration_key'] == 'WATER_MARK') {
                    $new_name = 'watermark.png';
                }

                $full_path = $path . $new_name; // полный путь с новым именем и расширением
                $configuration_value = 'images/' . $new_name;
                if ($_FILES['configuration_value']['error'] == 0) {
                    if (
                        $_GET['configuration_key'] == 'FAVICON_IMAGE' &&
                        $_FILES['configuration_value']['type'] != 'image/x-icon'
                    ) {
                        $new_name = 'favicon.ico';
                        $configuration_value = 'images/' . $new_name;
                        $full_path = $path . $new_name; // полный путь с новым именем и расширением
                        $source = $_FILES['configuration_value']['tmp_name'];
                        $destination = $full_path;
                        require_once(DIR_WS_CLASSES . 'class-php-ico.php');
                        $ico_lib = new PHP_ICO($source, [[16, 16], [24, 24], [32, 32]]);
                        $ico_lib->save_ico($destination);
                    } else {
                        if (!file_exists($path)) {
                            mkdir($path, '0644');
                        }

                        if (move_uploaded_file($_FILES['configuration_value']['tmp_name'], $full_path)) {
                            // Если файл успешно загружен, то вносим в БД (надеюсь, что вы знаете как)
                            // Можно сохранить $full_path (полный путь) или просто имя файла - $new_name

                        }
                    }
                }
            }

            if (is_array($configuration_value)) {
                $configuration_value = serialize($configuration_value);
            }

            if ($_GET['configuration_key'] == 'DOMEN_URL') {

                //обрезаем https://, http://, www. и / в конце
                $host = parse_url($configuration_value, PHP_URL_HOST);

                if ($host) {
                    $configuration_value = $host;
                }

                $configuration_value = str_replace('www.', '', $configuration_value);
                $configuration_value = rtrim($configuration_value, '/');

                if (env('APP_ENV') !== 'trial') {
                    define('DOMEN_NAME', $configuration_value);
                    require_once('includes/widgets/DomenNameChange/DomenNameChange.php');
                }
            }
            if($_POST['configuration_key'] == 'STORE_TIME_ZONE'){
                $timeZoneName = tep_get_time_zone_name($configuration_value);
                $env_path = __DIR__.'/../.env';
                $env = parse_ini_file($env_path);
                if ( !is_null($env['TIME_ZONE'])) {
                    file_put_contents(
                        $env_path,
                        str_replace(
                            ['TIME_ZONE=\'' . $env['TIME_ZONE'] . '\'', 'TIME_ZONE=' . $env['TIME_ZONE']],
                            'TIME_ZONE=\'' . $timeZoneName . '\'',
                            file_get_contents($env_path)
                        )
                    );
                }
            }
            // if enable or disable google tag manager re-minify JavaScript
            if ($_GET['configuration_key'] == "GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED") {
                resetMinifiedFiles();
            }

            if (SET_REDIRECT_WWW_ID === (int)$cID) {
                /**
                 * 0 - Отключить любые перенаправления с www
                 * 1 - Перенаправить из www на  no-www
                 * 2 - Перенаправить из no-www на www
                 */

                //Получаем текущий урл, для дальнейшего теста перенаправлений
                $url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
                //Текущее состояние перенаправления www, в случае зацикленности - для возврата в рабочее состояние
                $currentValueQuery = tep_db_query(
                    "SELECT `configuration_value` as val FROM " . TABLE_CONFIGURATION .
                    " WHERE `configuration_id` = " . (int)$cID
                );
                $currentValue = tep_db_fetch_array($currentValueQuery);
                //Перезаписать htaccess
                redirectWWW($configuration_value);
                //Проверить на предел перенаправления
                if (isRedirectionLimitReached($url)) {
                    //возвращаем старое значение
                    redirectWWW($currentValue['val']);
                    $configuration_value = 3;
                } else {
                    tep_db_query(
                        "update " . TABLE_CONFIGURATION .
                        " set configuration_value = '" . tep_db_input($configuration_value) . "', last_modified = now()
                        where configuration_id = " . (int)$cID
                    );
                }

                print tep_cfg_read_redirect_www($configuration_value);
                exit;
            } else {
                $configuration_value = $_GET['gID'] == 2 ? (int)$configuration_value : $configuration_value;
                if ($_GET['gID'] == 2 && $configuration_value === 0) {
                    return;
                } else {
                    tep_db_query(
                        "update " . TABLE_CONFIGURATION .
                        " set configuration_value = '" . $configuration_value . "', last_modified = now()
                where configuration_id = " . (int)$cID);
                }
            }

            \App\Logger\Log::channel('all')->info('Update configuration_value ', [
                'cID' => $cID,
                'configuration_value' => $configuration_value,
                'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
            ]);

            /* One Page Checkout - BEGIN*/
            if ($_GET['gID'] == 7575) {
                //tep_redirect(tep_href_link(FILENAME_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $_GET['cID']));
            } elseif (isset($_GET['configuration_key']) && $_GET['configuration_key'] == 'ROBOTS_TXT') {
                // change robots.txt (08.12.16)
                file_put_contents(DIR_FS_CATALOG . "robots.txt", $configuration_value);
            }

            /*
             * tep_call_function missing fix
             */
            $configuration_query = tep_db_query(
                "SELECT `configuration_id`
                     , `configuration_title`
                     , `set_function`
                     , sort_order
                     , configuration_group_id
                     , `configuration_key`
                     , `configuration_value`
                     , `use_function` 
                     , `depends_on` 
                     , `configuration_subgroup_id` 
                FROM " . TABLE_CONFIGURATION . " 
                WHERE `configuration_id` = " . (int)$cID
            );
            while ($configuration = tep_db_fetch_array($configuration_query)) {
                if (tep_not_null($configuration['use_function'])) {
                    $use_function = $configuration['use_function'];
                    if (preg_match('/->/', $use_function)) {
                        $class_method = explode('->', $use_function);
                        if (!is_object(${$class_method[0]})) {
                            include(DIR_WS_CLASSES . $class_method[0] . '.php');
                            ${$class_method[0]} = new $class_method[0]();
                        }

                        $cfgValue = tep_call_function(
                            $class_method[1],
                            $configuration['configuration_value'],
                            ${$class_method[0]}
                        );
                    } else {
                        $cfgValue = tep_call_function($use_function, $configuration['configuration_value']);
                    }
                } else {
                    $cfgValue = $configuration['configuration_value'];
                }
                //comment
                if (isset($_POST['file_type']) && $_POST['file_type'] =='base64') {
                    $configuration_value = $configuration['configuration_value'];
                }

                //if ($cID == 2012 || $cID == 2014 || $cID == 2029) {
                if (isset($_GET['use_function']) && $_GET['use_function'] == 'file_upload') {
                    $configuration_value = $cfgValue;
                }
            }

            print stripcslashes($configuration_value);
            exit;
            break;
        case 'tableEdit':
            $cID = tep_db_prepare_input($_GET['cID']);
            if (!empty($cID)) {

                $cfg_extra_query = tep_db_query("
                    select configuration_key
                         , configuration_value
                         , configuration_id
                         , configuration_description
                         , date_added
                         , last_modified
                         , use_function
                         , set_function 
                         , depends_on 
                         , configuration_subgroup_id 
                    from " . TABLE_CONFIGURATION . " 
                    where configuration_id = '" . (int)$cID . "'
                ");

                $cfg_extra = tep_db_fetch_array($cfg_extra_query);

                $cInfo_array = $cfg_extra;
                $cInfo_array['configuration_value'] = stripcslashes($cInfo_array['configuration_value']);
                $cInfo = new objectInfo($cInfo_array);
                $cInfo->configuration_value = stripcslashes($cInfo->configuration_value);


                if ($cInfo->set_function) {
                    eval('$value_field = ' . $cInfo->set_function . '"' . htmlspecialchars($cInfo->configuration_value) . '");');
                    $value_field .= tep_draw_hidden_field('configuration_key', $cInfo->configuration_key);
                } elseif ($cInfo->use_function == 'file_upload') {
                    $value_field = tep_draw_input_field('configuration_value', $cInfo->configuration_value,
                        'class="editable-input form-control input-sm"', false, 'file');
                    $value_field .= tep_draw_hidden_field('use_function', $cInfo->use_function);
                    $value_field .= tep_draw_hidden_field('configuration_key', $cInfo->configuration_key);
                } else {
                    $value_field = tep_draw_input_field('configuration_value', $cInfo->configuration_value,
                        'class="editable-input form-control input-sm"');
                    $value_field .= tep_draw_hidden_field('configuration_key', $cInfo->configuration_key);
                }

                $href = preg_replace('#action=.*#', 'action=tableSave', $_SERVER['REQUEST_URI']);

                $value_field = '
                <form enctype="multipart/form-data" method="POST">
                <span class="editable-wrap editable-text">
                  <div class="editable-controls form-group">
                    ' . html_entity_decode($value_field) . '
                  </div>
                </span>
                <button type="submit" class="btn btn-sm btn-info tableEditSave id-'.$cInfo_array['configuration_key'].'" data-href="' . $href . '">
                ' . TEXT_SETTINGS_EDIT_FORM_SAVE . '
                </button>
                <button type="button" class="btn btn-sm btn-default tableEditCancel">
                ' . TEXT_SETTINGS_EDIT_FORM_CANCEL . '
                </button>
                </form>

              ';
                print html_entity_decode($value_field);
            }
            exit;
            break;
        case 'edit':
            if (!empty($cID)) {
                $cfg_extra_query = tep_db_query("
                    SELECT `configuration_key`
                         , sort_order
                         , configuration_group_id
                         , `configuration_value`
                         , `configuration_id`
                         , `configuration_description`
                         , `date_added`
                         , `last_modified`
                         , `use_function`
                         , `set_function` 
                         , `depends_on` 
                         , `configuration_subgroup_id` 
                    FROM " . TABLE_CONFIGURATION . " 
                    WHERE `configuration_id` = " . (int)$cID
                );
                $cfg_extra = tep_db_fetch_array($cfg_extra_query);
                $cInfo_array = $cfg_extra;
                $cInfo = new objectInfo($cInfo_array);
                $heading = [];
                $contents = [];
                if (defined(strtoupper($cInfo->configuration_key . '_DESC'))) {
                    $r_desc = constant(strtoupper($cInfo->configuration_key . '_DESC'));
                } else {
                    $r_desc = '';
                }

                if (isset($cInfo) && is_object($cInfo)) {
                    $heading[] = [
                        'text' => '<b>' . constant(strtoupper($cInfo->configuration_key . '_TITLE')) . '</b>'
                    ];
                }

                if ($cInfo->set_function) {
                    eval(
                        '$value_field = ' . $cInfo->set_function . '"' . htmlspecialchars($cInfo->configuration_value) . '");'
                    );
                } else {
                    $value_field = tep_draw_input_field(
                        'configuration_value',
                        $cInfo->configuration_value,
                        'class="form-control input-sm"'
                    );
                }

                /* One Page Checkout - BEGIN */
                if ($cInfo->set_function && $_GET['gID'] == 7575) {
                    eval('$value_field = ' . $cInfo->set_function . '"' . $cInfo->configuration_value . '");');
                }
                /* One Page Checkout - END */
                $contents = [
                    'form' => tep_draw_form(
                        'configuration',
                        FILENAME_CONFIGURATION,
                        'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=save'
                    )
                ];
                $contents[] = ['text' => $cInfo->configuration_description . '<br>' . $r_desc . '<br>' . $value_field];
                /**
                 *  виводимо інфу про останнє редагування налаштувань
                 */
                if (isset($cInfo) && is_object($cInfo)) {
                    $time_info = '<span class="modalModifiedInfo">';
                    $time_info .= TEXT_INFO_DATE_ADDED . ' ' . tep_date_short($cInfo->date_added);
                    if (tep_not_null($cInfo->last_modified)) {
                        $time_info .= ' | ' . TEXT_INFO_LAST_MODIFIED . ' ' . tep_date_short($cInfo->last_modified);
                    }

                    $time_info .= '</span>';
                    $contents[] = ['text' => $time_info];
                }
                ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="editModalLabel"><?php print $heading[0]['text']; ?></h4>
                    </div>
                    <?php
                    if (tep_not_null($contents)) {
                        $box2 = new box;
                        echo $box2->infoBoxModal($contents);
                    }
                    ?>
                </div>
                <?php
                exit;
            }
            break;
        // #CP - supporting functions to upload company logo to template images directory
        case 'processuploads':
            if (isset($GLOBALS['file_name']) && tep_not_null($GLOBALS['file_name'])) {
                $up_load = new upload('file_name', $upload_fs_dir);
                $file_name = $up_load->filename;
                if ($file_name != "logo.gif") {
                    unlink($upload_fs_dir . "logo.gif");
                    rename($upload_fs_dir . $file_name, $upload_fs_dir . "logo.gif");
                }
            }

            tep_redirect(tep_href_link(FILENAME_CONFIGURATION, 'gID=' . $_GET['gID']));
            break;
        case 'upload':
            $directory_writeable = true;
            if (!is_writeable($upload_fs_dir)) {
                $directory_writeable = false;
                $messageStack->add(sprintf(ERROR_DIRECTORY_NOT_WRITEABLE, $upload_fs_dir), 'error');
            }
            break;
    }
}

$gID = (isset($_GET['gID'])) ? $_GET['gID'] : 1;
$cfg_group_query = tep_db_query("
    select configuration_group_key
         , configuration_group_title 
    from " . TABLE_CONFIGURATION_GROUP . " 
    where configuration_group_id = '" . (int)$gID . "'
");
$cfg_group = tep_db_fetch_array($cfg_group_query);
// check if the template image directory exists
if (is_dir($upload_fs_dir)) {
    if (!is_writeable($upload_fs_dir)) {
        $messageStack->add(ERROR_TEMPLATE_IMAGE_DIRECTORY_NOT_WRITEABLE . $upload_fs_dir, 'error');
    }
} else {
    $messageStack->add(ERROR_TEMPLATE_IMAGE_DIRECTORY_DOES_NOT_EXIST . $upload_fs_dir, 'error');
}

if ((int)$gID == 500) {
    $configuration_query = tep_db_query("
        select c.configuration_id, 
            c.configuration_title, 
            c.set_function, 
            c.configuration_key, 
            c.sort_order, 
            c.configuration_group_id, 
            c.configuration_value, 
            c.use_function, 
            c.depends_on, 
            c.configuration_subgroup_id 
        from " . TABLE_CONFIGURATION . " c
        LEFT JOIN " . TABLE_SUB_CONFIGURATION . " sc on sc.id = c.configuration_subgroup_id
        where c.configuration_group_id = '" . (int)$gID . "' 
        group by c.configuration_id
        order by sc.sort_order asc, c.configuration_subgroup_id, c.configuration_title
    ");
} else {
    $configuration_query = tep_db_query("
        select c.configuration_id,
            c.configuration_title,
            c.set_function,
            c.configuration_key,
            c.sort_order,
            c.configuration_group_id,
            c.configuration_value,
            c.use_function,
            c.depends_on,
            c.configuration_subgroup_id,
            c.callback_func,
            c.configuration_required_value
        from " . TABLE_CONFIGURATION . " c
        LEFT JOIN " . TABLE_SUB_CONFIGURATION . " sc on sc.id = c.configuration_subgroup_id
        where c.configuration_group_id = '" . (int)$gID . "' 
        group by c.configuration_id
        order by sc.sort_order asc, c.configuration_subgroup_id, c.sort_order
    ");
}

include_once('html-open.php');
include_once('header.php');
?>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
        <div class="modal-dialog modal-lg" role="document"></div>
    </div><!-- content -->
    <div class="container app-content-body p-b-none">
        <div class="hbox hbox-auto-xs hbox-auto-sm">
            <!-- main -->
            <div class="col">
                <div class="wrapper_767">
                    <div class="bg-light lter ng-scope admin-name-indent">
                        <h1 class="m-n font-thin h3">
                            <?php
                            if (in_array((int)$gID, ['277', '333'])) { //277 - solo modules, 333 - Google Analytics modules
                                $cfg_group['configuration_group_key'] = 'TEXT_MENU_SITE_MODULES';
                                $check_file_name = 'check.php'; // Дефолтное название файла проверки в каждом модуле
                                $module_folders = scandir(DIR_FS_EXT);
                                foreach ($module_folders as $module_folder) {
                                    if (
                                        stristr($module_folder, '.') ||
                                        !is_dir(DIR_FS_EXT . $module_folder)
                                    ) {// Пропускаем системные папки
                                        continue;
                                    }

                                    $module_check_file = DIR_FS_EXT . $module_folder . '/' . $check_file_name;
                                    if (file_exists($module_check_file)) {
                                        require $module_check_file;
                                    }
                                }

                                //todo Не нашел где появляется переменная $module_installed удалить если ничего не поламалось после 24.09.2021
//                            if ($module_installed) {
//                                echo "<script>location.reload();</script>";
//                            } // JS page reload
                            }

                            if (isset($groupConfigurationKeys[$gID])) {
                                echo constant(strtoupper($groupConfigurationKeys[$gID]));
                            } else {
                                echo "&nbsp;";
                            }

                            $configurations = [];
                            while ($configuration = tep_db_fetch_array($configuration_query)) {
                                $configurations[$configuration['configuration_subgroup_id']][] = $configuration;
                            }
                            ?>
                        </h1>
                    </div>
                </div>
                <div class="configurations">
                    <?php
                    if ($login_email_address == "admin@solomono.net" && isset($_GET['db']) && $_GET['db'] == 1) { ?>
                    <form action="<?= tep_href_link(FILENAME_CONFIGURATION, tep_get_all_get_params('')) ?>" method="POST">
                        <input type="submit" style="display:none;">
                    <?php }

                    $active = ' active';
                    foreach ($configurations as $subConfigurationId => $subConfigurations) {
                        if (!empty($subConfigurationNames[$subConfigurationId])) {
                            echo '<div class="configuration_menu noselect' . $active . '">
                                    <div class="configuration_menu_header">
                                        <h4>' . $subConfigurationNames[$subConfigurationId] . '</h4>
                                        <span class="down">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 512 512" enable-background="new 0 0 512 512">
                                                <polygon points="442.2,93.1 256,279.3 69.8,93.1 0,162.9 256,418.9 512,162.9 "/>
                                            </svg>
                                        </span>
                                    </div>
                                  <div class="sub_menu" style="' . (!empty($active) ? 'display:block;' : 'display:none;') . '">';
                            $active = '';
                        } ?>

                        <div class="panel panel-default">
                            <table class="table table-bordered table-hover table-condensed bg-white-only b-t b-light configuration-table">
                                <thead>
                                    <tr>
                                        <?php if ($login_email_address == "admin@solomono.net" && isset($_GET['db']) && $_GET['db'] == 1) { ?>
                                            <th style="width: 10px;">Config group</th>
                                            <th style="width: 10px;">Config sub-group</th>
                                            <th style="width: 10px;">Sort order</th>
                                        <?php } ?>
                                        <th><?= TABLE_HEADING_CONFIGURATION_TITLE; ?></th>
                                        <?php if ($gID == '5') { ?>
                                            <th><?= TABLE_HEADING_CONFIGURATION_SHOW_FIELD; ?></th>
                                        <?php } else { ?>
                                            <th><?= TABLE_HEADING_CONFIGURATION_VALUE; ?></th>
                                        <?php } ?>
                                        <?php if ($gID == '277') { ?>
                                            <th><?= LINKS_CONF_TITLE; ?></th>
                                        <?php } ?>
                                        <?php if ($gID == '5') { ?>
                                            <th><?= TABLE_HEADING_CONFIGURATION_REQUIRED_VALUE; ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //connect all payment and shipping modules languages
                                    foreach ($subConfigurations as $configuration) {
                                        if (
                                            (
                                                $configuration['sort_order'] == HIDE_CONFIGURATION_SORT_ORDER &&
                                                $login_email_address != "admin@solomono.net"
                                            ) ||
                                            (
                                                $configuration['depends_on'] !== '' &&
                                                !isExtensionExist($configuration['depends_on'])
                                            )
                                        ) {
                                            continue;
                                        }

                                        if (tep_not_null($configuration['use_function'])) {
                                            $use_function = $configuration['use_function'];
                                            if (preg_match('/->/', $use_function)) {
                                                $class_method = explode('->', $use_function);
                                                if (!is_object(${$class_method[0]})) {
                                                    //get class file path
                                                    $classFile = DIR_WS_CLASSES . $class_method[0] . '.php';
                                                    //ext->payment
                                                    $file = '../ext/acquiring/' . $class_method[0] . '/' . $class_method[0] . '.php';
                                                    if (file_exists($file)) {
                                                        $classFile = $file;
                                                        $classType = 'payment';
                                                        //get language file path
                                                        $languageFile = '../includes/languages/' . $language . '/modules/payment/' . $class_method[0] . '.json';
                                                        if (file_exists($languageFile)) {
                                                            includeLanguages($languageFile);
                                                        }
                                                    }
                                                    //ext->shipping
                                                    $file = '../ext/shipping/' . $class_method[0] . '/' . $class_method[0] . '.php';
                                                    if (file_exists($file)) {
                                                        $classFile = $file;
                                                        $classType = 'shipping';
                                                        //get language file path
                                                        $languageFile = '../ext/shipping/' . $class_method[0] . '/languages/' . $language . '/' . $class_method[0] . '.json';
                                                        if (file_exists($languageFile)) {
                                                            includeLanguages($languageFile);
                                                        }
                                                    }

                                                    include($classFile);
                                                    ${$class_method[0]} = new $class_method[0]();
                                                }

                                                $cfgValue = tep_call_function(
                                                    $class_method[1],
                                                    $configuration['configuration_value'],
                                                    ${$class_method[0]}
                                                );
                                            } else {
                                                $cfgValue = tep_call_function(
                                                    $use_function,
                                                    $configuration['configuration_value']
                                                );
                                            }
                                        } else {
                                            $cfgValue = $configuration['configuration_value'];
                                        }

                                        if (
                                            (
                                                !isset($_GET['cID']) ||
                                                (
                                                    isset($_GET['cID']) && $_GET['cID'] == $configuration['configuration_id']
                                                )
                                            ) &&
                                            !isset($cInfo) &&
                                            substr($action, 0, 3) != 'new'
                                        ) {
                                            $cfg_extra_query = tep_db_query(
                                                "select
                                                configuration_key
                                                , sort_order
                                                , configuration_group_id
                                                , configuration_description
                                                , date_added
                                                , last_modified
                                                , use_function
                                                , set_function
                                                , depends_on
                                                , configuration_subgroup_id
                                            from " . TABLE_CONFIGURATION . "
                                            where configuration_id = " . (int)$configuration['configuration_id']
                                            );
                                            $cfg_extra = tep_db_fetch_array($cfg_extra_query);
                                            $cInfo_array = array_merge($configuration, $cfg_extra);
                                            $cInfo = new objectInfo($cInfo_array);
                                        }

                                        if (
                                            isset($cInfo) &&
                                            is_object($cInfo) &&
                                            $configuration['configuration_id'] == $cInfo->configuration_id
                                        ) {
                                            if ($cInfo->set_function == 'file_upload') {
                                                echo '      <tr class="dataTableRowSelected" data-href=\'' . tep_href_link(FILENAME_CONFIGURATION,
                                                        'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=upload') . '\'>' . "\n";
                                            } else {
                                                echo '      <tr class="dataTableRowSelected" data-href=\'' . tep_href_link(FILENAME_CONFIGURATION,
                                                        'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=tableEdit') . '\'>' . "\n";
                                            }
                                        } else {
                                            $style = $configuration['configuration_value'] == 'false' && $configuration['configuration_id'] == 1919 ? ' style="background: #ff1f1f47;"' : '';
                                            $class = "";
                                            if ($configuration['configuration_key'] == 'MASTER_PASS' && getConstantValue('MASTER_PASSWORD_MODULE_ENABLED') == 'false') {
                                                $class = "hidden";
                                            }
                                            if ($configuration['configuration_key'] == 'DOMEN_URL' && env('APP_ENV') == 'trial') {
                                                $class = "hidden";
                                            }
                                            echo '
                                            <tr' . $style . ' class="dataTableRowSelected ' . $class . '" data-href=\'' . tep_href_link(FILENAME_CONFIGURATION,
                                                    'gID=' . $_GET['gID'] . '&cID=' . $configuration['configuration_id']) . '&action=tableEdit\'>';
                                        }

                                        if (
                                            $login_email_address == "admin@solomono.net" &&
                                            isset($_GET['db']) &&
                                            $_GET['db'] == 1
                                        ) { ?>
                                            <td>
                                                <input style="width: 80px;"
                                                       type="number"
                                                       name="groupId[<?= $configuration['configuration_id'] ?>]"
                                                       value="<?= $configuration['configuration_group_id'] ?>">
                                            </td>
                                            <td>
                                                <input style="width: 80px;"
                                                       type="number"
                                                       name="subGroupId[<?= $configuration['configuration_id'] ?>]"
                                                       value="<?= $configuration['configuration_subgroup_id'] ?>">
                                            </td>
                                            <td>
                                                <input style="width: 80px;"
                                                       type="number"
                                                       name="sortOrder[<?= $configuration['configuration_id'] ?>]"
                                                       value="<?= $configuration['sort_order'] ?>">
                                            </td>
                                            <?php
                                        }

                                        $criticalCssBool = (
                                            (
                                                $criticalCssValue &&
                                                $configuration['callback_func'] == 'setAndShowCriticalWindow'
                                            ) ||
                                            $configuration['configuration_key'] == 'USE_CRITICAL_CSS'
                                        );
                                        $confKeyConst = strtoupper($configuration['configuration_key']);
                                        $confKeyConstTitle = strtoupper($configuration['configuration_key'] . '_TITLE');
                                        ?>
                                        <td data-label="<?= TABLE_HEADING_CONFIGURATION_TITLE; ?>" class="ajaxSpin v-middle">
                                            <?php
                                            echo defined($confKeyConstTitle) ? constant($confKeyConstTitle) : $confKeyConst;
                                            echo(!empty($tooltipMap[$confKeyConst]) ? renderTooltip($tooltipMap[$confKeyConst]) : '');
                                            if ($criticalCssBool) { ?>
                                                <a class="critical-info" href="javascript:void(0);">
                                                    <i class="fa fa-question-circle" data-toggle="tooltip"
                                                       data-placement="right" title=""
                                                       data-original-title="<?= INFO_ICON_NEED_GENERATE_CRITICAL ?>"></i>
                                                </a>
                                            <?php }
                                            if ($configuration['callback_func'] == 'NEED_MINIFY') { ?>
                                                <a class="critical-info" href="javascript:void(0);">
                                                    <i class="fa fa-question-circle" data-toggle="tooltip"
                                                       data-placement="right" title=""
                                                       data-original-title="<?= INFO_ICON_NEED_MINIFY ?>"></i>
                                                </a>
                                            <?php }
                                            if ($configuration['callback_func'] == 'check_SMTP') { ?>
                                                <a class="" href="configuration.php?gID=<?= SMTP_CONFIGURATION_GROUP_ID ?>">
                                                    <i class="fa fa-exclamation-triangle" data-toggle="tooltip"
                                                       data-placement="right" title=""
                                                       data-original-title="<?= INFO_ICON_ENABLE_SMTP ?>"
                                                    ></i>
                                                </a>
                                            <?php } ?>
                                        </td>
                                        <?php
                                        $critBoolRes = $criticalCssBool ? 'setAndShowCriticalWindow' : '';
                                        $redirectWWWRes = SET_REDIRECT_WWW_ID === (int)$configuration['configuration_id'] ? $configuration['configuration_key'] : '';
                                        $minifyRes = $configuration['callback_func'] == 'NEED_MINIFY' ? 'NEED_MINIFY' : '';
                                        ?>
                                        <td data-label="<?= TABLE_HEADING_CONFIGURATION_VALUE; ?>"
                                            class="setValue v-middle <?= $critBoolRes, ' ', $redirectWWWRes, ' ', $minifyRes, ' ', $configuration['configuration_key'] ?>"
                                            data-conf-key="<?= $configuration['configuration_key'] ?>"
                                        >
                                            <?php
                                            if ($confKeyConst == 'SET_HTTPS') { // if https:
                                                // CHECK SSL:
                                                $ssl_check = @fsockopen(
                                                    'ssl://' . $_SERVER['HTTP_HOST'],
                                                    443,
                                                    $errno,
                                                    $errstr, 30
                                                );
                                                $result = !!$ssl_check;
                                                if ($ssl_check) {
                                                    fclose($ssl_check);
                                                }

                                                if ($result) {
                                                    $https_enabled = '';
                                                    $https_on = true;
                                                } else {
    //                                        $https_enabled = 'style="pointer-events: none;"';
                                                    $https_on = false;
                                                }
                                            } else {
                                                $https_enabled = '';
                                            }


                                            if ($configuration['configuration_key'] == "SET_HTTPS") {
                                                if (env('APP_ENV') == 'rent' && getConstantValue('RENT_PACKAGE','free') !== 'free') {
                                                    echo '<input type="hidden" name="ERROR_DOMAIN_IN_USE" value="'.ERROR_DOMAIN_IN_USE.'"> ';
                                                    echo '<input type="hidden" name="ERROR_ANAME_MISMATCH" value="'.ERROR_ANAME_MISMATCH.'"> ';
                                                    echo '<input type="hidden" name="ERROR_ADD_DOMAIN_FIRST" value="'.ERROR_ADD_DOMAIN_FIRST.'"> ';
                                                    echo '<input type="hidden" name="ERROR_BASH_EXECUTION" value="'.ERROR_BASH_EXECUTION.'"> ';
                                                    echo '<input type="hidden" name="ERROR_SIMLINK_CREATE" value="'.ERROR_SIMLINK_CREATE.'"> ';
                                                    echo '<input type="hidden" name="ERROR_FOLDER_RENAME" value="'.ERROR_FOLDER_RENAME.'"> ';
                                                    echo '<input type="hidden" name="SUCCESS_DOMAIN_CHANGE" value="'.SUCCESS_DOMAIN_CHANGE.'"> ';
                                                    $domain_name = tep_get_configuration_key_value('DOMEN_URL');
                                                    if($domain_name !== ''){
                                                        if (isHttpsOn("https://" . $_SERVER["HTTP_HOST"])) {
                                                            echo '<div class="rented_cert yes"><span>' . SSL_EXIST . '</span></div>';
                                                        } else {
                                                            echo '<input id="are_you_sure_text" type="hidden" value="' . SSL_ARE_YOU_SURE . '">';
                                                            echo '<div class="rented_cert no"><span>' . SSL_NON_EXIST . '</span></div>';
                                                        }
													} else {
                                                        echo '<input id="are_you_sure_text" type="hidden" value="' . SSL_ARE_YOU_SURE . '">';
														echo '<div class="rented_cert no"><span>' . SSL_NON_EXIST . '</span></div>';
                                                    }
                                                }
                                            }


                                            $needMinifyParam = $configuration['callback_func'] == 'NEED_MINIFY' ? '&need_minify=1' : '';
                                            $check_for_folders = explode(':', $cfgValue);
                                            if ($check_for_folders[1] == 'true') {
                                                echo '<label class="i-switch bg-info m-t-xs m-r" ' . $https_enabled . '>
                                            <input
                                                type="checkbox"
                                                class="switchValue"
                                                checked=""
                                                data-href="' . tep_href_link(
                                                        FILENAME_CONFIGURATION,
                                                        'gID=' . $_GET['gID'] . '&cID=' . $configuration['configuration_id'] . $needMinifyParam . '&action=setflag&flag=' . $check_for_folders[0] . ':false'
                                                    ) . '">
                                            <i></i>
                                        </label>';
                                            } else {
                                                if ($check_for_folders[1] == 'false') {
                                                    echo '<label class="i-switch bg-info m-t-xs m-r" ' . $https_enabled . '>
                                                <input type="checkbox" class="switchValue" data-href="' . tep_href_link(FILENAME_CONFIGURATION,
                                                            'gID=' . $_GET['gID'] . '&cID=' . $configuration['configuration_id'] . $needMinifyParam . '&action=setflag&flag=' . $check_for_folders[0] . ':true') . '">
                                                <i></i>
                                            </label>';
                                                } else {
                                                    if (htmlspecialchars($cfgValue) == 'true') {
                                                        echo '<label class="i-switch bg-info m-t-xs m-r" ' . $https_enabled . '>
                                                    <input type="checkbox" class="switchValue" checked="" data-href="' . tep_href_link(FILENAME_CONFIGURATION,
                                                                'gID=' . $_GET['gID'] . '&cID=' . $configuration['configuration_id'] . $needMinifyParam . '&action=setflag&flag=0') . '">
                                                    <i></i>
                                                  </label>';
                                                    } else {
                                                        if (htmlspecialchars($cfgValue) == 'false') {
                                                            echo '<label class="i-switch bg-info m-t-xs m-r" ' . $https_enabled . '>
                                                        <input type="checkbox" class="switchValue seo" data-href="' . tep_href_link(FILENAME_CONFIGURATION,
                                                                    'gID=' . $_GET['gID'] . '&cID=' . $configuration['configuration_id'] . $needMinifyParam . '&action=setflag&flag=1') . '">
                                                        <i></i>
                                                    </label>';
                                                            //
                                                        } elseif (strpos($cfgValue, 'buyme') !== false) {
                                                            echo $cfgValue;
                                                        } elseif ($configuration['use_function'] == 'file_upload') {
                                                            if ($configuration['configuration_key'] == 'LOGO_IMAGE') {
                                                                echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.2/cropper.css" integrity="sha512-5ZQRy5L3cl4XTtZvjaJRucHRPKaKebtkvCWR/gbYdKH67km1e18C1huhdAc0wSnyMwZLiO7nEa534naJrH6R/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
                                                                echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.2/cropper.js" integrity="sha512-witv14AEvG3RlvqCAtVxAqply8BjTpbWaWheEZqOohL5pxLq3AtIwrihgz7SsxihwAZkhUixj171yQCZsUG8kw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
                                                                echo '<script src="includes/javascript/jquery-cropper.min.js"></script>';
                                                                echo '<script src="includes/javascript/functions.js"></script>';
                                                                $logoWidth = LOGO_WIDTH ? "width:" . LOGO_WIDTH . "px;" : "";
                                                                $logoHeight = LOGO_HEIGHT ? "height: " . LOGO_HEIGHT . "px;" : "";
                                                                echo "<style>.img-preview, .img-preview-wrapper{" . $logoWidth . $logoHeight . "}</style>";
                                                                echo '<span class="logofileButtons">';
                                                                echo '<span id="logo_download" class="btn btn-sm btn-info">';
                                                                echo IMAGE_UPLOAD;
                                                                echo '</span>';
                                                                echo '<span id="logo_cut" class="btn btn-sm btn-default">';
                                                                echo TEXT_BLOCK_OVERVIEW_ACTION_EDIT;
                                                                echo '</span>';

                                                                echo '   <div id="logofile" class="img-preview-wrapper">';
                                                                echo '        <div class="img-preview"> </div>';
                                                                echo '         </div>';

                                                                echo '</span>';
                                                                echo '<div class="img-cutter-preview-wrapper hidden">
                                                                <span id="logoresize">' . $cfgValue . '</span>';
                                                                echo '         <a id="set" class="btn btn-sm btn-info">';
                                                                echo IMAGE_SAVE;
                                                                echo '    </a>';
                                                                echo '</div>';
                                                            } else {
                                                                echo $cfgValue;
                                                            }
                                                        } else {
                                                            if ($configuration['configuration_key'] == 'ROBOTS_TXT') {
                                                                $html = htmlspecialchars(substr($cfgValue, 0, 20));

                                                            } else {
                                                                $html = htmlspecialchars($cfgValue);
                                                            }
                                                            echo '<span class="editable" data-toggle="tooltip" data-placement="right" title="" data-original-title="' . TEXT_SETTINGS_EDIT_FORM_TOOLTIP . '">' .
                                                                ($html == '' ? TEXT_SETTINGS_EDIT_FORM_TOOLTIP : stripcslashes($html)) .
                                                                '</span>';
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </td>
                                        <?php if ($gID == '277') { ?>
                                            <?php
                                            if ($configuration['configuration_key'] == 'SET_JIVOSITE') {
                                                $info_link_var = $configuration['configuration_key'] . "_INFO_LINK";
                                                $settings_link_var = $configuration['configuration_key'] . "_SETTINGS_LINK";
                                            } else {
                                                $info_link_var = str_replace("_ENABLED", "_INFO_LINK", $configuration['configuration_key']);
                                                $settings_link_var = str_replace("_ENABLED", "_SETTINGS_LINK", $configuration['configuration_key']);
                                            }
                                            switch ($languages_id) {
                                                case '3':
                                                    $lang_code = 'ru';
                                                    break;
                                                case '5':
                                                    $lang_code = 'uk';
                                                    break;
                                                case '12':
                                                    $lang_code = 'pl';
                                                    break;
                                                default:
                                                    $lang_code = 'en';
                                                    break;
                                            }
                                            require_once("includes/languages/globals_solomodules_links.php")
                                            ?>
                                            <td class="tools_links">
                                                <?php if ($GLOBALS[$info_link_var] !== '') { ?>
                                                    <a href="<?php echo sprintf($GLOBALS[$info_link_var], $lang_code); ?>" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                        </svg>
                                                    </a>
                                                <?php } ?>
                                                <?php if ($GLOBALS[$settings_link_var] !== '') { ?>
                                                    <a href="<?php echo sprintf($GLOBALS[$settings_link_var], $lang_code); ?>" target="_self">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                                            <path
                                                                d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                                                        </svg>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <!--Обязательность заполнения полей при регистрации-->
                                        <?php if ($gID == '5') { ?>
                                            <td data-label="<?= TABLE_HEADING_CONFIGURATION_REQUIRED_VALUE; ?>"
                                                class="setValue v-middle <?= $critBoolRes, ' ', $redirectWWWRes, ' ', $minifyRes, ' ', $configuration['configuration_key'] ?>"
                                                data-conf-key="<?= $configuration['configuration_key'] ?>"
                                            >

                                                <?php if ($configuration['configuration_required_value'] == 'true') {
                                                    echo '<label class="i-switch bg-info m-t-xs m-r" ' . $https_enabled . '>
                                                    <input
                                                            type="checkbox"
                                                            class="switchValue"
                                                            checked=""
                                                            data-href="' . tep_href_link(
                                                            FILENAME_CONFIGURATION,
                                                            'gID=' . $_GET['gID'] . '&cID=' . $configuration['configuration_id'] . $needMinifyParam . '&action=required&flag=' . $configuration['configuration_required_value'] . ':false'
                                                        ) . '">
                                                    <i></i>
                                                    </label>';
                                                } else {
                                                    if ($configuration['configuration_required_value'] == 'false') {
                                                        echo '<label class="i-switch bg-info m-t-xs m-r" ' . $https_enabled . '>
                                                <input type="checkbox" class="switchValue" data-href="' . tep_href_link(FILENAME_CONFIGURATION,
                                                                'gID=' . $_GET['gID'] . '&cID=' . $configuration['configuration_id'] . $needMinifyParam . '&action=required&flag=' . $configuration['configuration_required_value'] . ':true') . '">
                                                <i></i>
                                            </label>';
                                                    } else {
                                                        if (htmlspecialchars($configuration['configuration_required_value']) == 'true') {
                                                            echo '<label class="i-switch bg-info m-t-xs m-r" ' . $https_enabled . '>
                                                    <input type="checkbox" class="switchValue" checked="" data-href="' . tep_href_link(FILENAME_CONFIGURATION,
                                                                    'gID=' . $_GET['gID'] . '&cID=' . $configuration['configuration_id'] . $needMinifyParam . '&action=required&flag=0') . '">
                                                    <i></i>
                                                  </label>';
                                                        } else {
                                                            if (htmlspecialchars($configuration['configuration_required_value']) == 'false') {
                                                                echo '<label class="i-switch bg-info m-t-xs m-r" ' . $https_enabled . '>
                                                        <input type="checkbox" class="switchValue seo" data-href="' . tep_href_link(FILENAME_CONFIGURATION,
                                                                        'gID=' . $_GET['gID'] . '&cID=' . $configuration['configuration_id'] . $needMinifyParam . '&action=required&flag=1') . '">
                                                        <i></i>
                                                    </label>';
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </td>
                                        <?php } ?>
                                        </tr>
                                        <?php
                                    } ?>
                                </tbody>
                            </table>
                            <!--                            </div>-->
                        </div>

                        <?php if (!empty($subConfigurationNames[$subConfigurationId])) {
                            echo '</div></div>';
                        }
                    }

                    if ($login_email_address == "admin@solomono.net" && isset($_GET['db']) && $_GET['db'] == 1) { ?>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');