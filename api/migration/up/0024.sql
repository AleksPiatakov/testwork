DROP PROCEDURE IF EXISTS `insert_once`;

DELIMITER $$
CREATE PROCEDURE insert_once()
Begin

INSERT INTO `configuration`
(`configuration_id`, `configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`,
`configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`, `depends_on`,
`configuration_subgroup_id`, `callback_func`)
VALUES (NULL, 'Add parent categories ids to URL?', 'SEO_ADD_PARENT_CATEGORIES_TO_URL', 'true',
'This option will add parent categories to the category URL (ie some-category/c-1-2.html) or not (ie some-category/c-2.html).',
'26234', '3', '2021-10-01 10:02:06', '2021-10-01 10:02:06', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),',
'', '0', NULL);

END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;