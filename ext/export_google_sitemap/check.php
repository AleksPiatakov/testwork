<?php

if (!defined('EXPORT_GOOGLE_SITEMAP_MODULE_ENABLED')) {


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
        ('Модуль GOOGLE SITEMAP',
        'EXPORT_GOOGLE_SITEMAP_MODULE_ENABLED',
        'export_google_sitemap:false',
        'Модуль Google Sitemap',
        '277',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"export_google_sitemap:true\", \"export_google_sitemap:false\"),')
        ");


    $module_installed = true;
}
