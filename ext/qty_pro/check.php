<?php

if (!defined('QTY_PRO_ENABLED')) {
    /**
     * check.php -- файл для автоматического добавления констант модуля в БД
     */
    //TODO module not ready for production - 02_12_21
    // need check and fix prise value in different pages and popups window
    /*tep_db_query("INSERT INTO ".TABLE_CONFIGURATION."
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
        ('Модуль установки значений для связок аттрибутов',
        'QTY_PRO_ENABLED',
        'qty_pro:false',
        'Модуль установки значений для связок аттрибутов',
        '277',
        '1',
        '".date('Y-m-d H:i:s')."',
        '".date('Y-m-d H:i:s')."',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"qty_pro:true\", \"qty_pro:false\"),')
        ");

    $module_installed = true;*/
}
