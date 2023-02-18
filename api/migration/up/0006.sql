DROP PROCEDURE IF EXISTS `insert_once`;

DELIMITER $$
CREATE PROCEDURE insert_once()
Begin

ALTER TABLE configuration CHANGE callback_func callback_func VARCHAR(64) CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;