DROP PROCEDURE IF EXISTS `insert_once`;


DELIMITER $$
CREATE PROCEDURE insert_once()
Begin

    if ((SELECT COUNT(*) FROM configuration WHERE configuration_key = 'SET_WWW') = 0) THEN
        INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`,
                                     `configuration_description`, `configuration_group_id`, `sort_order`,
                                     `last_modified`, `date_added`, `use_function`, `set_function`, `depends_on`,
                                     `configuration_subgroup_id`, `callback_func`)
        VALUES ('Перенаправление www', 'SET_WWW', '1', 'C WWW или без WWW или отключить какие либо перенаправления для www', 1, 35,
                '2021-06-15 13:00:22', '2021-06-15 13:00:22', 'tep_cfg_read_redirect_www', 'tep_cfg_pull_down_redirect_www(',
                '', 1, '');

    End if;
END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;