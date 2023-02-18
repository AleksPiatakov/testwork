<?php

if (!defined('STATS_KEYWORDS_POPULAR_ENABLED')) {
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
         callback_func)
         VALUES
        ('Популярные поисковые запросы',
        'STATS_KEYWORDS_POPULAR_ENABLED',
        'stats_keywords_popular:false',
        'Модуль популярные поисковые запросы',
        '277',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        '')
        ");

    tep_db_query('DROP TABLE IF EXISTS stats_keywords_popular;');

    tep_db_query("
      CREATE TABLE stats_keywords_popular (
      id int(11) DEFAULT NULL,
      language_id int(11) DEFAULT NULL,
      search_keywords varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
      meta_title varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
      meta_description varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
      seo_text mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
      h1 varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
      canonical varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
      UNIQUE KEY id_language_id (id,language_id))");

    tep_db_query('INSERT INTO infobox_configuration (template_id,infobox_file_name,infobox_define,display_in_column,callback_data) 
SELECT DISTINCT template_id, "search_queries.php","M_SEARCH_QUERIES","MAINPAGE",\'\' FROM infobox_configuration');

    tep_db_query("INSERT INTO " . TABLE_ADMIN_FILES . "
        (admin_files_name,
         admin_files_is_boxes,
         admin_files_to_boxes,
         admin_groups_id,
         status)
         VALUES
         ('stats_keywords_popular.php',
           0,
           1,
          '1',
           1)
         ");

    $module_installed = true;
}
