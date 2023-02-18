<?php

if (!defined('EXPORT_ROZETKA_MODULE_ENABLED')) {
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
        ('Модуль экспорта Rozetka',
        'EXPORT_ROZETKA_MODULE_ENABLED',
        'export_rozetka:false',
        'Модуль экспорта Rozetka',
        '277',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"export_rozetka:true\", \"export_rozetka:false\"),')
        ");

    $module_installed = true;
}
if (!defined('GOOGLE_FEED_CHOOSE_ALL_PRODUCTS')) {
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
        ('Выбрать все товары для GOOGLE_FEED',
        'GOOGLE_FEED_CHOOSE_ALL_PRODUCTS',
        'false',
        'Модуль Google Feed',
        '10000',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        '',
        'tep_cfg_select_option(array(\"true\", \"false\"),')
        ");
}
if (!defined('GOOGLE_FEED_CHOOSE_PRODUCTS_2')) {
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
        ('Выбрать товары для GOOGLE_FEED 2',
        'GOOGLE_FEED_CHOOSE_PRODUCTS_2',
        'false',
        'Модуль Google Feed',
        '10000',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        '',
        'tep_cfg_select_option(array(\"true\", \"false\"),')
        ");
}
if (!defined('GOOGLE_FEED_CHOOSE_PRODUCTS_3')) {
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
        ('Выбрать товары для GOOGLE_FEED 3',
        'GOOGLE_FEED_CHOOSE_PRODUCTS_3',
        'false',
        'Модуль Google Feed',
        '10000',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        '',
        'tep_cfg_select_option(array(\"true\", \"false\"),')
        ");
}

