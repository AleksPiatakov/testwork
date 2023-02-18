INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`, `depends_on`, `configuration_subgroup_id`, `callback_func`)
SELECT 'Выключать выкупленные товары', 'STOCK_DISABLE_NON_EXISTENT_PRODUCT_ON_CHECKOUT', 'false', 'Выключать товары с количеством 0 после покупки', '9', '6', '2018-11-01 06:23:52', '2014-02-10 10:10:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),', '', '0', ''
FROM `configuration`
WHERE `configuration_group_id` = '9' AND ((`configuration_id` = '115'));