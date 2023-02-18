DROP PROCEDURE IF EXISTS `insert_once`;

DELIMITER $$
CREATE PROCEDURE insert_once()
Begin

INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`)
VALUES ('23', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', ''),
('24', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', ''),
('27', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', ''),
('28', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', ''),
('29', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', ''),
('30', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', ''),
('31', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', ''),
('32', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', ''),
('33', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', ''),
('34', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', ''),
('35', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', ''),
('36', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', ''),
('37', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', ''),
('38', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', ''),
('39', NULL, '', 'LIST_PRESENCE', '1', 'LISTING', '11', 'a:0:{}', '');

END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;