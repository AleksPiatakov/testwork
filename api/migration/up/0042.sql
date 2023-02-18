ALTER TABLE `orders` ADD `customers_shipping_fields` VARCHAR(1024) NOT NULL DEFAULT '' AFTER `customers_address_format_id`;
DELETE FROM configuration WHERE set_function LIKE "select_multioption_indexed%";
DROP TABLE IF EXISTS `ship2fields`;
CREATE TABLE `ship2fields` ( `id` INT NOT NULL AUTO_INCREMENT , `shipping_code` VARCHAR(255) NOT NULL , `field_allowed` TINYINT(1) NOT NULL DEFAULT '0' , `field_required` TINYINT(1) NOT NULL DEFAULT '0' , `min_length` INT NOT NULL DEFAULT '1' , PRIMARY KEY (`id`)) ENGINE = InnoDB;
DROP TABLE IF EXISTS `ship2fields_description`;
CREATE TABLE `ship2fields_description` ( `id` INT NOT NULL AUTO_INCREMENT , `language_id` INT NOT NULL DEFAULT '1' , `field_title` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`, `language_id`)) ENGINE = InnoDB;
ALTER TABLE `orders` CHANGE `customers_shipping_fields` `customers_shipping_fields` VARCHAR(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '';