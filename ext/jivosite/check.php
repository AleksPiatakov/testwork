<?php

if (!defined('SET_JIVOSITE')) {
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
        ('Включить jivoSite?',
        'SET_JIVOSITE',
        'jivosite:false',
        'Включить или выключить JivoSite',
        '277',
        '2',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"jivosite:true\", \"jivosite:false\"),')
        ");

    $module_installed = true;
}


if (!defined('JIVOSITE_WIDGET_ID')) {
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
         last_modified)
         VALUES
        ('JivoSite code',
        'JIVOSITE_WIDGET_ID',
        'YGWwF0bMIZ',
        'JivoSite code',
        '277',
        '3',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "')
        ");

    $module_installed = true;
}
