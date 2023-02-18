DROP PROCEDURE IF EXISTS `insert_once`;

DELIMITER $$
CREATE PROCEDURE insert_once()
Begin

UPDATE `configuration` SET `configuration_key` = 'MODULE_ORDER_TOTAL_OT_BETTER_TOGETHER_SORT_ORDER'
    WHERE `configuration`.`configuration_key` = 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_SORT_ORDER';
UPDATE `configuration` SET `configuration_key` = 'MODULE_ORDER_TOTAL_OT_COUNTRY_DISCOUNT_SORT_ORDER'
    WHERE `configuration`.`configuration_key` = 'MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_SORT_ORDER';
UPDATE `configuration` SET `configuration_key` = 'MODULE_ORDER_TOTAL_OT_COUPON_SORT_ORDER'
    WHERE `configuration`.`configuration_key` = 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER';
UPDATE `configuration` SET `configuration_key` = 'MODULE_ORDER_TOTAL_OT_GV_SORT_ORDER'
    WHERE `configuration`.`configuration_key` = 'MODULE_ORDER_TOTAL_GV_SORT_ORDER';
UPDATE `configuration` SET `configuration_key` = 'MODULE_ORDER_TOTAL_OT_LEV_DISCOUNT_SORT_ORDER'
    WHERE `configuration`.`configuration_key` = 'MODULE_LEV_DISCOUNT_SORT_ORDER';
UPDATE `configuration` SET `configuration_key` = 'MODULE_ORDER_TOTAL_OT_LOWORDERFEE_SORT_ORDER'
    WHERE `configuration`.`configuration_key` = 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER';
UPDATE `configuration` SET `configuration_key` = 'MODULE_ORDER_TOTAL_OT_PAYMENT_SORT_ORDER'
    WHERE `configuration`.`configuration_key` = 'MODULE_ORDER_TOTAL_DISC_SORT_ORDER';
UPDATE `configuration` SET `configuration_key` = 'MODULE_ORDER_TOTAL_OT_QTY_DISCOUNT_SORT_ORDER'
    WHERE `configuration`.`configuration_key` = 'MODULE_QTY_DISCOUNT_SORT_ORDER';
UPDATE `configuration` SET `configuration_key` = 'MODULE_ORDER_TOTAL_OT_SHIPPING_SORT_ORDER'
    WHERE `configuration`.`configuration_key` = 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER';
UPDATE `configuration` SET `configuration_key` = 'MODULE_ORDER_TOTAL_OT_SUBTOTAL_SORT_ORDER'
    WHERE `configuration`.`configuration_key` = 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER';
UPDATE `configuration` SET `configuration_key` = 'MODULE_ORDER_TOTAL_OT_TAX_SORT_ORDER'
    WHERE `configuration`.`configuration_key` = 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER';
UPDATE `configuration` SET `configuration_key` = 'MODULE_ORDER_TOTAL_OT_TOTAL_SORT_ORDER'
    WHERE `configuration`.`configuration_key` = 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER';

END$$
DELIMITER ;
CALL insert_once();

DROP PROCEDURE IF EXISTS `insert_once`;