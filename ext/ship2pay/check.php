<?php

if (!defined('SHIP2PAY_ENABLED')) {
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
        ('Доставка-Оплата (Ship 2 Pay)',
        'SHIP2PAY_ENABLED',
        'ship2pay:false',
        'Модуль Доставка-Оплата',
        '277',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"ship2pay:true\", \"ship2pay:false\"),')
        ");
    $module_installed = true;
}
