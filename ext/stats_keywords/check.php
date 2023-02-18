<?php

if (!defined('STATS_KEYWORDS_ENABLED')) {
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
        ('Cтатистика поисковых запросов',
        'STATS_KEYWORDS_ENABLED',
        'stats_keywords:false',
        'Модуль статистика поисковых запросов',
        '277',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"stats_keywords:true\", \"stats_keywords:false\"),')
        ");
    $module_installed = true;
}
