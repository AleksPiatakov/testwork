<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 17.03.2021
 * Time: 14:20
 * check.php -- файл для автоматического добавления констант модуля в БД
 */

//status for Google Analytics and Tags module
if (!defined('GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, use_function, set_function, callback_func)
         VALUES
        ('Google Analytics and Tags module', 'GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED', 'google_analytics_and_targets:false', 'Google Analytics and Tags module', '125', '44', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_check_modules_folder', 'tep_cfg_select_option(array(\"google_analytics_and_targets:true\", \"google_analytics_and_targets:false\"),', 'NEED_MINIFY')
        ");
    define('GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED', 'false');
    $module_installed = true;
}

//unique google ID(gtag)
if (!defined('GOOGLE_TAGS_ID')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google Tag ID', 'GOOGLE_TAGS_ID', '', 'Google tags id', '125', '46', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', '');");
    define('GOOGLE_TAGS_ID', '');
    $module_installed = true;
}

//unique Google Tag Manager ID(gtm)
if (!defined('GOOGLE_TAG_MANAGER_ID')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google Tag Manager Id', 'GOOGLE_TAG_MANAGER_ID', '', 'Google Tag Manager Id', '125', '46', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', '');");
    define('GOOGLE_TAG_MANAGER_ID', '');
    $module_installed = true;
}

//add_to_cart - goal in google cabinet
if (!defined('GOOGLE_GOALS_ADD_TO_CART')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - add to cart', 'GOOGLE_GOALS_ADD_TO_CART', 'false', 'Google goals - add to cart', '125', '47', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_ADD_TO_CART', 'false');
    $module_installed = true;
}

//checkout_view - goal in google cabinet
if (!defined('GOOGLE_GOALS_ON_CHECKOUT')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - on checkout', 'GOOGLE_GOALS_ON_CHECKOUT', 'false', 'Google goals - on checkout', '125', '48', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_ON_CHECKOUT', 'false');
    $module_installed = true;
}

//checkout_progress - goal in google cabinet
if (!defined('GOOGLE_GOALS_CHECKOUT_PROCESS')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - checkout process', 'GOOGLE_GOALS_CHECKOUT_PROCESS', 'false', 'Google goals - checkout process', '125', '49', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_CHECKOUT_PROCESS', 'false');
    $module_installed = true;
}

//fast_buy - goal in google cabinet
if (!defined('GOOGLE_GOALS_CLICK_FAST_BUY')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - click fast buy', 'GOOGLE_GOALS_CLICK_FAST_BUY', 'false', 'Google goals - click fast buy', '125', '50', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_CLICK_FAST_BUY', 'false');
    $module_installed = true;
}

//phone_call - goal in google cabinet
if (!defined('GOOGLE_GOALS_CLICK_ON_PHONE')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - click on phone', 'GOOGLE_GOALS_CLICK_ON_PHONE', 'false', 'Google goals - click on phone', '125', '51', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_CLICK_ON_PHONE', 'false');
    $module_installed = true;
}

//click_chat - goal in google cabinet
if (!defined('GOOGLE_GOALS_CLICK_ON_CHAT')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - click on chat', 'GOOGLE_GOALS_CLICK_ON_CHAT', 'false', 'Google goals - click on chat', '125', '52', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_CLICK_ON_CHAT', 'false');
    $module_installed = true;
}

//bug_report - goal in google cabinet
if (!defined('GOOGLE_GOALS_CLICK_ON_BUG_REPORT')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - bug report', 'GOOGLE_GOALS_CLICK_ON_BUG_REPORT', 'false', 'Google goals - bug report', '125', '53', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_CLICK_ON_BUG_REPORT', 'false');
    $module_installed = true;
}

//page_view - goal in google cabinet
if (!defined('GOOGLE_GOALS_PAGE_VIEW')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - page view', 'GOOGLE_GOALS_PAGE_VIEW', 'false', 'Google goals - page view', '125', '54', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_PAGE_VIEW', 'false');
    $module_installed = true;
}

//callback - goal in google cabinet
if (!defined('GOOGLE_GOALS_CALLBACK')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - callback', 'GOOGLE_GOALS_CALLBACK', 'false', 'Google goals - callback button', '125', '55', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_CALLBACK', 'false');
    $module_installed = true;
}

//filter - goal in google cabinet
if (!defined('GOOGLE_GOALS_FILTER')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - filter', 'GOOGLE_GOALS_FILTER', 'false', 'Google goals - click on filter', '125', '56', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_FILTER', 'false');
    $module_installed = true;
}

//subscribe - goal in google cabinet
if (!defined('GOOGLE_GOALS_SUBSCRIBE')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - subscribe on homepage', 'GOOGLE_GOALS_SUBSCRIBE', 'false', 'Google goals - subscribe on homepage', '125', '57', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_SUBSCRIBE', 'false');
    $module_installed = true;
}

//login - goal in google cabinet
if (!defined('GOOGLE_GOALS_LOGIN')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - login', 'GOOGLE_GOALS_LOGIN', 'false', 'Google goals - login', '125', '58', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_LOGIN', 'false');
    $module_installed = true;
}

//add_review - goal in google cabinet
if (!defined('GOOGLE_GOALS_ADD_REVIEW')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - add review', 'GOOGLE_GOALS_ADD_REVIEW', 'false', 'Google goals - add review', '125', '59', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_ADD_REVIEW', 'false');
    $module_installed = true;
}

//contact_us - goal in google cabinet
if (!defined('GOOGLE_GOALS_CONTACT_US')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - contact us', 'GOOGLE_GOALS_CONTACT_US', 'false', 'Google goals - contact us', '125', '60', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_CONTACT_US', 'false');
    $module_installed = true;
}

//checkout_success - goal in google cabinet
if (!defined('GOOGLE_GOALS_CHECKOUT_SUCCESS')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google goals - checkout success', 'GOOGLE_GOALS_CHECKOUT_SUCCESS', 'false', 'Google goals - checkout success', '125', '61', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_GOALS_CHECKOUT_SUCCESS', 'false');
    $module_installed = true;
}

//Google ecommerce home page
if (!defined('GOOGLE_ECOMM_HOME_PAGE')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google ecommerce home page', 'GOOGLE_ECOMM_HOME_PAGE', 'false', 'Google ecommerce home page', '125', '62', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_ECOMM_HOME_PAGE', 'false');
    $module_installed = true;
}

//Google ecommerce searchresults
if (!defined('GOOGLE_ECOMM_SEARCH_RESULTS')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google ecommerce searchresults', 'GOOGLE_ECOMM_SEARCH_RESULTS', 'false', 'Google ecommerce searchresults - ProductList Page + keywords', '125', '63', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_ECOMM_SEARCH_RESULTS', 'false');
    $module_installed = true;
}

//Google ecommerce - Product Detail Page
if (!defined('GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google ecommerce - Product Detail Page', 'GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE', 'false', 'Google ecommerce - Product Detail Page', '125', '64', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE', 'false');
    $module_installed = true;
}

//Google ecommerce - Checkout Page
if (!defined('GOOGLE_ECOMM_CHECKOUT_PAGE')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google ecommerce - Checkout Page', 'GOOGLE_ECOMM_CHECKOUT_PAGE', 'false', 'Google ecommerce - Checkout Page', '125', '65', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_ECOMM_CHECKOUT_PAGE', 'false');
    $module_installed = true;
}

//Google ecommerce - Success Page
if (!defined('GOOGLE_ECOMM_SUCCESS_PAGE')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google ecommerce - Success Page', 'GOOGLE_ECOMM_SUCCESS_PAGE', 'false', 'Google ecommerce - Success Page', '125', '66', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_ECOMM_SUCCESS_PAGE', 'false');
    $module_installed = true;
}

//Google ecommerce - Fast Buy Success
if (!defined('GOOGLE_ECOMM_CLICK_FAST_BUY')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id,
         sort_order, configuration_subgroup_id, date_added, last_modified, set_function)
         VALUES
        ('Google ecommerce - Fast Buy Success', 'GOOGLE_ECOMM_CLICK_FAST_BUY', 'false', 'Google ecommerce - Fast Buy Success', '125', '67', '3',
        '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\"true\", \"false\")');");
    define('GOOGLE_ECOMM_CLICK_FAST_BUY', 'false');
    $module_installed = true;
}
