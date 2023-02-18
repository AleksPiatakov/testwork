DROP PROCEDURE IF EXISTS `insert_once`;


DELIMITER $$
CREATE PROCEDURE insert_once()
Begin

    if ((SELECT COUNT(*) FROM configuration WHERE configuration_key = 'EXAMPLE_CONSTANT') = 0) THEN

        INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`,
                                     `configuration_description`, `configuration_group_id`, `sort_order`,
                                     `last_modified`, `date_added`, `use_function`, `set_function`, `depends_on`,
                                     `configuration_subgroup_id`)
        VALUES ('EXAMPLE_CONSTANT', 'EXAMPLE_CONSTANT', 'true', 'EXAMPLE_CONSTANT', 225566, 2,
                '2020-06-03 05:01:59', '2020-06-01 07:11:26', '', 'tep_cfg_select_option(array(\'true\', \'false\'),',
                '', 0);

    End if;
END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;