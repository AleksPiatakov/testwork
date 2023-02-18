<?php

if (!defined('FACEBOOK_PIXEL_MODULE_ENABLED')) {
    /**
     * check.php -- файл для автоматического добавления констант модуля в БД
     */
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title,
         configuration_key,
         configuration_value,
         configuration_description,
         configuration_group_id,
         sort_order,
         date_added,
         last_modified,
         use_function,
         set_function)
         VALUES
        ('FaceBook pixel',
        'FACEBOOK_PIXEL_MODULE_ENABLED',
        'facebook_pixel:false',
        'FaceBook pixel',
        '277',
        '6',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"facebook_pixel:true\", \"facebook_pixel:false\"),')
        ");

    $module_installed = true;
}

if (!defined('FACEBOOK_PIXEL_ID')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title,
        configuration_key,
        configuration_value,
        configuration_description,
        configuration_group_id,
        sort_order,
        last_modified,
        date_added,
        use_function,
        set_function) 
        VALUES 
        ('Facebook Pixel Id', 
        'FACEBOOK_PIXEL_ID', 
        '', 
        'Facebook pixel ID', 
        333, 
        42, 
        '" . date('Y-m-d H:i:s') . "', 
        '" . date('Y-m-d H:i:s') . "', 
        NULL, 
        NULL)");
}

if (!defined('DEFAULT_PIXEL_CURRENCY')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
            (configuration_title,
            configuration_key,
            configuration_value,
            configuration_description,
            configuration_group_id,
            sort_order,
            last_modified,
            date_added,
            use_function,
            set_function) 
            VALUES 
            ('Facebook pixel currency', 
            'DEFAULT_PIXEL_CURRENCY', 
            'USD', 
            'Currency in which facebook will display analytic', 
            '333',
            '43',
            '" . date('Y-m-d H:i:s') . "', 
            '" . date('Y-m-d H:i:s') . "', 
            NULL, 
            NULL)");
    $module_installed = true;
}

//PageView - Facebook goal
if (!defined('FACEBOOK_GOALS_PAGE_VIEW')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - page View', 'FACEBOOK_GOALS_PAGE_VIEW', 'false', 'Facebook goals - page View', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_PAGE_VIEW', 'false');
    $module_installed = true;
}
//AddToCart - Facebook goal
if (!defined('FACEBOOK_GOALS_ADD_TO_CART')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - add to cart', 'FACEBOOK_GOALS_ADD_TO_CART', 'false', 'Facebook goals - add to cart', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_ADD_TO_CART', 'false');
    $module_installed = true;
}
//InitiateCheckout - Facebook goal
if (!defined('FACEBOOK_GOALS_CHECKOUT_PROCESS')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - InitiateCheckout', 'FACEBOOK_GOALS_CHECKOUT_PROCESS', 'false', 'Facebook goals - InitiateCheckout', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_CHECKOUT_PROCESS', 'false');
    $module_installed = true;
}

//Search
if (!defined('FACEBOOK_GOALS_SEARCH_RESULTS')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - Search', 'FACEBOOK_GOALS_SEARCH_RESULTS', 'false', 'Facebook goals - Search', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_SEARCH_RESULTS', 'false');
    $module_installed = true;
}
//CompleteRegistration
if (!defined('FACEBOOK_GOALS_COMPLETE_REGISTRATION')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - CompleteRegistration', 'FACEBOOK_GOALS_COMPLETE_REGISTRATION', 'false', 'Facebook goals - CompleteRegistration', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_COMPLETE_REGISTRATION', 'false');
    $module_installed = true;
}
//ViewContent
if (!defined('FACEBOOK_GOALS_VIEW_CONTENT')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - View Product Page', 'FACEBOOK_GOALS_VIEW_CONTENT', 'false', 'Facebook goals - View Product Page', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_VIEW_CONTENT', 'false');
    $module_installed = true;
}
//Lead
if (!defined('FACEBOOK_GOALS_CONTACT_US_REQUEST')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - Contact Us Request', 'FACEBOOK_GOALS_CONTACT_US_REQUEST', 'false', 'Facebook goals - Contact Us Request', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_CONTACT_US_REQUEST', 'false');
    $module_installed = true;
}
//AddToWishlist
if (!defined('FACEBOOK_GOALS_ADD_TO_WISHLIST')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - AddToWishlist', 'FACEBOOK_GOALS_ADD_TO_WISHLIST', 'false', 'Facebook goals - AddToWishlist', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_ADD_TO_WISHLIST', 'false');
    $module_installed = true;
}
//AddPaymentInfo
if (!defined('FACEBOOK_GOALS_ADD_PAYMENT_INFO')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - AddPaymentInfo', 'FACEBOOK_GOALS_ADD_PAYMENT_INFO', 'false', 'Facebook goals - AddPaymentInfo', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_ADD_PAYMENT_INFO', 'false');
    $module_installed = true;
}
//Purchase
if (!defined('FACEBOOK_GOALS_SUCCESS_PAGE')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - Purchase', 'FACEBOOK_GOALS_SUCCESS_PAGE', 'false', 'Facebook goals - Purchase', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_SUCCESS_PAGE', 'false');
    $module_installed = true;
}
//FastBy
if (!defined('FACEBOOK_GOALS_CLICK_FAST_BUY')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - FastBy', 'FACEBOOK_GOALS_CLICK_FAST_BUY', 'false', 'Facebook goals - FastBy', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_CLICK_FAST_BUY', 'false');
    $module_installed = true;
}
//click Chat button
if (!defined('FACEBOOK_GOALS_CLICK_ON_CHAT')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - click on chat', 'FACEBOOK_GOALS_CLICK_ON_CHAT', 'false', 'Facebook goals - click on chat', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_CLICK_ON_CHAT', 'false');
    $module_installed = true;
}
//callback
if (!defined('FACEBOOK_GOALS_CALLBACK')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - callback', 'FACEBOOK_GOALS_CALLBACK', 'false', 'Facebook goals - callback button', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_CALLBACK', 'false');
    $module_installed = true;
}
//callback
if (!defined('FACEBOOK_GOALS_FILTER')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - filter', 'FACEBOOK_GOALS_FILTER', 'false', 'Facebook goals - filtered product', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_FILTER', 'false');
    $module_installed = true;
}
//subscribe
if (!defined('FACEBOOK_GOALS_SUBSCRIBE')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - subscribe', 'FACEBOOK_GOALS_SUBSCRIBE', 'false', 'Facebook goals - subscribe', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_SUBSCRIBE', 'false');
    $module_installed = true;
}
//login
if (!defined('FACEBOOK_GOALS_LOGIN')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - login', 'FACEBOOK_GOALS_LOGIN', 'false', 'Facebook goals - login', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_LOGIN', 'false');
    $module_installed = true;
}
//add_review
if (!defined('FACEBOOK_GOALS_ADD_REVIEW')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - add review', 'FACEBOOK_GOALS_ADD_REVIEW', 'false', 'Facebook goals - add review', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_ADD_REVIEW', 'false');
    $module_installed = true;
}
//phone_call
if (!defined('FACEBOOK_GOALS_PHONE_CALL')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - phone call button', 'FACEBOOK_GOALS_PHONE_CALL', 'false', 'Facebook goals - phone call button', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_PHONE_CALL', 'false');
    $module_installed = true;
}
//bug_report
if (!defined('FACEBOOK_GOALS_CLICK_ON_BUG_REPORT')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, date_added, last_modified, set_function)
         VALUES
        ('Facebook goals - bug report button', 'FACEBOOK_GOALS_CLICK_ON_BUG_REPORT', 'false', 'Facebook goals - bug report button', '333', '43',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('FACEBOOK_GOALS_CLICK_ON_BUG_REPORT', 'false');
    $module_installed = true;
}
