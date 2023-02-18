DROP PROCEDURE IF EXISTS `insert_once`;

DELIMITER $$
CREATE PROCEDURE insert_once()
Begin
    UPDATE configuration
    SET callback_func = 'NEED_MINIFY'
    WHERE configuration_key = 'MULTICOLOR_ENABLED';
END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;