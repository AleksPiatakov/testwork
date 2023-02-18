DROP PROCEDURE IF EXISTS `insert_once`;

DELIMITER $$
CREATE PROCEDURE insert_once()
Begin

UPDATE `configuration` SET `depends_on` = 'recaptcha' WHERE `configuration`.`configuration_key` LIKE '%RECAPTCHA%';

END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;