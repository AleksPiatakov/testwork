<?php

if (!defined('REVIEWS_WRITE_ACCESS')) {
    tep_db_query(
        "
                    INSERT INTO `configuration`
                    (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`,
                     `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `set_function`)
                    VALUES ('Allow only registered users to write reviews', 'REVIEWS_WRITE_ACCESS', 'false',
                            'Allow only registered users to write reviews', '1', '25', '" . date('Y-m-d H:i:s') . "',
                            '" . date('Y-m-d H:i:s') . "', 'tep_cfg_select_option(array(\'true\', \'false\'),')
                "
    );
}
if (!defined('COMMENTS_MODULE_ENABLED')) {


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
        ('Модуль комментариев',
        'COMMENTS_MODULE_ENABLED',
        'reviews:false',
        'Модуль отзывов',
        '277',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"reviews:true\", \"reviews:false\"),')
        ");


    tep_db_query(
        "
            CREATE TABLE IF NOT EXISTS `reviews` (
              `reviews_id` int(11) NOT NULL AUTO_INCREMENT,
              `products_id` int(11) NOT NULL DEFAULT '0',
              `customers_id` int(11) DEFAULT NULL,
              `customers_name` varchar(64) NOT NULL DEFAULT '',
              `reviews_rating` int(1) DEFAULT NULL,
              `date_added` datetime DEFAULT NULL,
              `last_modified` datetime DEFAULT NULL,
              `reviews_read` int(5) NOT NULL DEFAULT '0',
              `reviews_type` int(11) NOT NULL DEFAULT '1',
               PRIMARY KEY (`reviews_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=`utf8mb4`;
"
    );
    tep_db_query(
        "
            CREATE TABLE IF NOT EXISTS `reviews_description` (    
              `reviews_id` int(11) NOT NULL DEFAULT '0',
              `languages_id` int(11) NOT NULL DEFAULT '0',
              `reviews_text` mediumtext NOT NULL,
               PRIMARY KEY (`reviews_id`,`languages_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=`utf8mb4`;
            "
    );

    $module_installed = true;
}
