<?php

if (!defined('API_ENABLED')) {

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
        ('Api',
        'API_ENABLED',
        'api:false',
        'Api',
        '277',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"api:true\", \"api:false\"),')
        ");


    tep_db_query("INSERT INTO " . TABLE_ADMIN_FILES . "
        (admin_files_name,
         admin_files_is_boxes,
         admin_files_to_boxes,
         admin_groups_id,
         status)
         VALUES
         ('" . FILENAME_API . "',
           0,
           1,
          '1',
           1)
         ");

    tep_db_query("
        CREATE TABLE IF NOT EXISTS `api_keys` (
        `id` INT(10) NOT NULL AUTO_INCREMENT,
        `api_key` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
        `api_key_name` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
        `api_key_status` INT(10) NULL DEFAULT '0',
        PRIMARY KEY (`id`) USING BTREE,
        INDEX `api_key_api_key_status` (`api_key`, `api_key_status`) USING BTREE
    )
    COLLATE='utf8mb4_general_ci'
    ENGINE=InnoDB
    AUTO_INCREMENT=8
    ;
    ");

    $module_installed = true;
}
