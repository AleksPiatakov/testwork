<?php

if (!defined('QUICK_ORDER_ENABLED')) {
    /**
     * check.php -- файл для автоматического добавления констант модуля в БД
     */
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_required_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`, `depends_on`, `configuration_subgroup_id`, `callback_func`) VALUES ('Швидке замовлення', 'QUICK_ORDER_ENABLED', 'quick_order:false', 'false', 'Модуль швидкого заказу', '277', '10', '2020-03-11 05:57:30', '2020-01-22 08:24:14', 'tep_check_modules_folder', 'tep_cfg_select_option(array(\"quick_order:true\", \"quick_order:false\"),', '', '0', '');");
    
    $module_installed = true;
}
