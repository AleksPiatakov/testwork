DROP PROCEDURE IF EXISTS `insert_once`;

DELIMITER $$
CREATE PROCEDURE insert_once()
Begin

ALTER TABLE `articles_description` CHANGE `seo_url` `seo_url` VARCHAR(255) CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;