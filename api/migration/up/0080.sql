UPDATE `configuration` SET `configuration_subgroup_id` = '3' WHERE `configuration`.`configuration_key` = 'GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED';
INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_required_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`, `depends_on`, `configuration_subgroup_id`, `callback_func`) VALUES
    ('Гугл тег менеджер ид',	'GOOGLE_TAG_MANAGER_ID',	'',	'true',	'Код гугл тег менеджера',	125,	46,	NULL,	'2022-08-25 16:13:57',	'',	'',	'',	3,	NULL);