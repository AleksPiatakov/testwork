<?php

if (!defined('STATS_PRODUCTS_PURCHASED_BY_CATEGORY_MODULE_ENABLED')) {
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
        ('Статистика заказанные товары по категориям',
        'STATS_PRODUCTS_PURCHASED_BY_CATEGORY_MODULE_ENABLED',
        'stats_products_purchased_by_category:false',
        'Модуль статистики заказанных товаров по категориям',
        '277',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"stats_products_purchased_by_category:true\", \"stats_products_purchased_by_category:false\"),')
        ");
    $module_installed = true;
}
