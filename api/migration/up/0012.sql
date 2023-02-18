DROP PROCEDURE IF EXISTS `insert_once`;

DELIMITER $$
CREATE PROCEDURE insert_once()
Begin

UPDATE `configuration` SET `configuration_key` = 'MODULE_PAYMENT_BANK_SORT_ORDER'
    WHERE `configuration`.`configuration_key` = 'MODULE_PAYMENT_BANK_TRANSFER_SORT_ORDER';
UPDATE `configuration` SET `configuration_key` = 'MODULE_ORDER_TOTAL_DISC_SORT_ORDER'
    WHERE `configuration`.`configuration_key` = 'MODULE_PAYMENT_DISC_SORT_ORDER';

END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;