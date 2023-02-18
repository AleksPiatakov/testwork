<?php

if (!defined('AUTO_TRANSLATE_MODULE_ENABLED')) {
    /**
     * check.php -- file for automatically adding module constants to the database
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
         set_function,
         callback_func)
         VALUES
        ('Модуль для автоматического перевода',
        'AUTO_TRANSLATE_MODULE_ENABLED',
        'auto_translate:true',
        'Модуль для автоматического перевода',
        '277',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"auto_translate:true\", \"auto_translate:false\"),',
        '')
        ");

    tep_db_query("INSERT INTO " . TABLE_ADMIN_FILES . "
        (admin_files_name,
         admin_files_is_boxes,
         admin_files_to_boxes,
         admin_groups_id,
         status)
         VALUES
         ('auto_translate.php',
           0,
           1,
          '1',
           1)
         ");

    $module_installed = true;
}
