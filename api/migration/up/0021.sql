DROP PROCEDURE IF EXISTS `insert_once`;

DELIMITER $$
CREATE PROCEDURE insert_once()
Begin

DELETE FROM `configuration` WHERE configuration_key = 'PRODUCT_MODAL_ON';
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('23', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('24', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('27', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('28', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('29', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('30', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('31', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('32', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('33', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('34', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('35', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('36', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('37', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('38', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');
INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('39', NULL, '', 'LIST_MODAL_ON', '1', 'LISTING', '11', 'a:0:{}', '');

END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;