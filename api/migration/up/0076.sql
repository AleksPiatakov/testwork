INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_required_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`, `depends_on`, `configuration_subgroup_id`, `callback_func`)
VALUES ('Отправлять sms админу при покупке в один клик ?','SMS_OWNER_ENABLE_BUY_ONE_CLICK','true',
        'true','',902,2,'2016-02-10 10:10:10','2014-02-10 10:10:10',
        NULL,'tep_cfg_select_option(array(\'true\', \'false\'),','',0,'');