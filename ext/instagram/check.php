<?php

if (!defined('INSTAGRAM_POSTS_MARKUP')) {
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
        ('Последние посты Instagram',
        'INSTAGRAM_POSTS_MARKUP',
        '',
        'Последние посты Instagram',
        '13',
        '2',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        '',
        '')
        ");

    $module_installed = true;
}


if (!defined('INSTAGRAM_LAST_UPDATE')) {
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
        ('Последнее обновление постов Instagram',
        'INSTAGRAM_LAST_UPDATE',
        '1990-01-01 00:00:00',
        'Последнее обновление постов Instagram',
        '13',
        '3',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "')
        ");

    $module_installed = true;
}
