DROP PROCEDURE IF EXISTS `insert_once`;

DELIMITER $$
CREATE PROCEDURE insert_once()
Begin

    if ((SELECT COUNT(*) FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED') = 0) THEN

        INSERT INTO `configuration` (configuration_title, configuration_key, configuration_value, configuration_description,
        configuration_group_id, sort_order, date_added, last_modified, use_function, set_function)
        VALUES ('Google Analytics and Tags module', 'GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED',
        'google_analytics_and_targets:false', 'Google Analytics and Tags module', '333', '44','now()"',
        'now()', 'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"google_analytics_and_targets:true\", \"google_analytics_and_targets:false\"),');

End if;

DELETE FROM configuration
    WHERE configuration_key = 'GOOGLE_TAGS_ID'
    OR configuration_key = 'GOOGLE_TAGS_ID_STATUS'
    OR configuration_key LIKE 'GOOGLE_GOALS%';

END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;