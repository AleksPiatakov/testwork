<?php

if (!defined('QUICK_PRODUCTS_UPDATE_ENABLED')) {
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
        ('Быстрое обновление товаров',
        'QUICK_PRODUCTS_UPDATE_ENABLED',
        'quick_update:false',
        'Модуль быстрого обновления товаров',
        '277',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"quick_update:true\", \"quick_update:false\"),')
        ");

    $module_installed = true;
}
