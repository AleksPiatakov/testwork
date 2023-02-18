DROP PROCEDURE IF EXISTS `insert_once`;

DELIMITER $$
CREATE PROCEDURE insert_once()
Begin
    INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`, `depends_on`, `configuration_subgroup_id`, `callback_func`) VALUES
    ('Подключение скриптов', 'STORE_SCRIPTS', '', 'Подключение JS Файлов', 1, 38, '2021-04-20 11:51:34', '2014-02-10 10:10:10', '', 'tep_cfg_textarea(', '', 1, ''),
    ('Подключение Meta-тегов', 'STORE_METAS', '', 'Подключение meta в <head>', 1, 39, '2021-04-20 11:53:42', '2014-02-10 10:10:10', '', 'tep_cfg_textarea(', '', 1, '');

    ALTER TABLE `configuration` CHANGE `configuration_value` `configuration_value` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;

END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;