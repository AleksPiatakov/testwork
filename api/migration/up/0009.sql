DROP PROCEDURE IF EXISTS `insert_once`;

DELIMITER $$
CREATE PROCEDURE insert_once()
Begin
INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`, `depends_on`, `configuration_subgroup_id`, `callback_func`) VALUES ('Установить валюту и язык согласно геолокации', 'CHANGE_BY_GEOLOCATION', 'false', 'Автоматическая установка валюты и языка согласно геолокации', '1', '11', '2017-04-27 09:35:44', '2014-02-10 10:10:10', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),', '', '0', '');

END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;