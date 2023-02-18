DROP PROCEDURE IF EXISTS `insert_once`;

DELIMITER $$
CREATE PROCEDURE insert_once()
Begin
INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`, `depends_on`, `configuration_subgroup_id`, `callback_func`) VALUES ('Капча on/off', 'DEFAULT_CAPTCHA_STATUS', 'false', 'Капча', '26231', '1110', '2021-05-06 21:01:44', '2021-05-06 21:01:44', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),', '', '0', '');

END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;