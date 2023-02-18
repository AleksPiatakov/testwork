INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_required_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`, `depends_on`, `configuration_subgroup_id`, `callback_func`)
VALUES ('SMS шлюз', 'SMS_GATENAME', '', 'true', 'SMS шлюз', '902', '2', NULL, now(), 'tep_get_sms_gatename', 'tep_cfg_pull_down_sms_gatename_list(', '', '0', NULL);

DELETE FROM `configuration`
WHERE `configuration_group_id` = '902' AND `configuration_id` = '1829';