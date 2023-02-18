DELETE FROM `infobox_configuration` WHERE `infobox_define` = 'MC_LOGO_WIDTH';
DELETE FROM `infobox_configuration` WHERE `infobox_define` = 'MC_LOGO_HEIGHT';

UPDATE `infobox_configuration` SET `infobox_data` = 'a:2:{s:11:\"logo_height\";a:3:{s:5:\"label\";s:13:\"H_LOGO_HEIGHT\";s:8:\"callable\";s:9:\"getNumber\";s:3:\"val\";s:2:\"35\";}s:18:\"logo_height_mobile\";a:3:{s:5:\"label\";s:20:\"H_LOGO_HEIGHT_MOBILE\";s:8:\"callable\";s:9:\"getNumber\";s:3:\"val\";s:2:\"25\";}}'
WHERE `infobox_configuration`.`infobox_define` = 'H_LOGO' and template_id = 23;

INSERT INTO `infobox_configuration` (`template_id`, `infobox_id`, `infobox_file_name`, `infobox_define`, `infobox_display`, `display_in_column`, `location`, `infobox_data`, `callback_data`) VALUES ('24', NULL, 'logo.php', 'H_LOGO', '1', 'HEADER', '9', 'a:2:{s:11:\"logo_height\";a:3:{s:5:\"label\";s:13:\"H_LOGO_HEIGHT\";s:8:\"callable\";s:9:\"getNumber\";s:3:\"val\";s:2:\"50\";}s:18:\"logo_height_mobile\";a:3:{s:5:\"label\";s:20:\"H_LOGO_HEIGHT_MOBILE\";s:8:\"callable\";s:9:\"getNumber\";s:3:\"val\";s:2:\"50\";}}', 'NEED_MINIFY');

UPDATE `infobox_configuration` SET `infobox_data` = 'a:2:{s:11:\"logo_height\";a:3:{s:5:\"label\";s:13:\"H_LOGO_HEIGHT\";s:8:\"callable\";s:9:\"getNumber\";s:3:\"val\";s:2:\"41\";}s:18:\"logo_height_mobile\";a:3:{s:5:\"label\";s:20:\"H_LOGO_HEIGHT_MOBILE\";s:8:\"callable\";s:9:\"getNumber\";s:3:\"val\";s:2:\"35\";}}'
WHERE `infobox_configuration`.`infobox_define` = 'H_LOGO' and template_id = 30;

UPDATE `infobox_configuration` SET `infobox_data` = 'a:2:{s:11:\"logo_height\";a:3:{s:5:\"label\";s:13:\"H_LOGO_HEIGHT\";s:8:\"callable\";s:9:\"getNumber\";s:3:\"val\";s:2:\"30\";}s:18:\"logo_height_mobile\";a:3:{s:5:\"label\";s:20:\"H_LOGO_HEIGHT_MOBILE\";s:8:\"callable\";s:9:\"getNumber\";s:3:\"val\";s:2:\"25\";}}'
WHERE `infobox_configuration`.`infobox_define` = 'H_LOGO' and template_id = 31;

UPDATE `infobox_configuration` SET `infobox_data` = 'a:2:{s:11:\"logo_height\";a:3:{s:5:\"label\";s:13:\"H_LOGO_HEIGHT\";s:8:\"callable\";s:9:\"getNumber\";s:3:\"val\";s:2:\"30\";}s:18:\"logo_height_mobile\";a:3:{s:5:\"label\";s:20:\"H_LOGO_HEIGHT_MOBILE\";s:8:\"callable\";s:9:\"getNumber\";s:3:\"val\";s:2:\"25\";}}'
WHERE `infobox_configuration`.`infobox_define` = 'H_LOGO' and template_id = 35;

UPDATE `infobox_configuration` SET `infobox_data` = 'a:2:{s:11:\"logo_height\";a:3:{s:5:\"label\";s:13:\"H_LOGO_HEIGHT\";s:8:\"callable\";s:9:\"getNumber\";s:3:\"val\";s:2:\"18\";}s:18:\"logo_height_mobile\";a:3:{s:5:\"label\";s:20:\"H_LOGO_HEIGHT_MOBILE\";s:8:\"callable\";s:9:\"getNumber\";s:3:\"val\";s:2:\"18\";}}'
WHERE `infobox_configuration`.`infobox_define` = 'H_LOGO' and template_id = 36;