<?php

if (!defined('LANGUAGE_SELECTOR_MODULE_ENABLED')) {
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
        ('Выбор языка',
        'LANGUAGE_SELECTOR_MODULE_ENABLED',
        'multilanguage:true',
        '',
        '277',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"multilanguage:true\", \"multilanguage:false\"),',
        '')
        ");

    $module_installed = true;
}
