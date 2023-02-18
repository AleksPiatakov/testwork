<?php

if (!defined('XSELL_PRODUCTS_BUYNOW_ENABLED')) {
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
        ('Сопутствующие товары',
        'XSELL_PRODUCTS_BUYNOW_ENABLED',
        'xsell_products_buynow:false',
        'Модуль сопутствующих товаров',
        '277',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"xsell_products_buynow:true\", \"xsell_products_buynow:false\"),')
        ");
    $module_installed = true;
}
