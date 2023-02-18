DROP PROCEDURE IF EXISTS `insert_once`;

DELIMITER $$
CREATE PROCEDURE insert_once()
Begin

INSERT INTO `configuration`
    (`configuration_id`, `configuration_title`, `configuration_key`, `configuration_value`,
    `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`,
    `use_function`, `set_function`, `depends_on`, `configuration_subgroup_id`, `callback_func`)
    VALUES (NULL, 'Включить дебаг загрузки страници', 'ENABLE_DEBUG_PAGE_SPEED', 'true',
    'Включить/отключить дебаг загрузки страници', '1', '36', '2021-07-21 09:11:26',
    '2021-07-21 09:11:26', '', 'tep_cfg_select_option(array(\'true\', \'false\'),', '', '1', '');

END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;