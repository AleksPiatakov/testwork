<?php

require('includes/application_top.php');

// HMCS: Begin Autologon    **************************************************************

$cookie_url_array = parse_url(HTTP_SERVER . substr(DIR_WS_CATALOG, 0, -1));
$cookie_path = $cookie_url_array['path'];
setcookie('email_address', '', time() - 3600, $cookie_path, $_SERVER['HTTP_HOST'], true, true);
setcookie('password', '', time() - 3600, $cookie_path, $_SERVER['HTTP_HOST'], true, true);

// HMCS: End Autologon      **************************************************************

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGOFF);

$breadcrumb->add(NAVBAR_TITLE);
$pageRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && ($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' || $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache');

if (!$pageRefreshed) {
//  tep_session_unregister('customer_id');
//  tep_session_unregister('customer_default_address_id');
//  tep_session_unregister('customer_first_name');
//  tep_session_unregister('customer_country_id');
//  tep_session_unregister('customer_zone_id');
//  tep_session_unregister('comments');
//  tep_session_unregister('guest_account');
//ICW - logout -> unregister GIFT VOUCHER sessions - Thanks Fredrik
//  tep_session_unregister('gv_id');
//  tep_session_unregister('cc_id');
//ICW - logout -> unregister GIFT VOUCHER sessions  - Thanks Fredrik

    $cart->reset();

//  $wishList->reset();

    session_regenerate_id(true);
    tep_session_destroy();

    // create session again to remember selected language:
    tep_session_start();
    $lng->set_language($lng->catalog_languages[$_GET['language']]['directory']);
    $_SESSION['language'] = $lng->language['directory'];
    $_SESSION['language_short'] = $_GET['language'];
    $_SESSION['languages_id'] = $lng->language['id'];
    $_SESSION['currency'] = $currency;

    $content = CONTENT_LOGOFF;

    require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

    require(DIR_WS_INCLUDES . 'application_bottom.php');
} else {
    header("Location:" . tep_href_link('/'));
}
