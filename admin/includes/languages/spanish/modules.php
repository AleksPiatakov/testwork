<?php
/*
  $Id: modules.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE_MODULES_PAYMENT', 'Payment Modules');
define('HEADING_TITLE_MODULES_SHIPPING', 'Shipping Modules');
define('HEADING_TITLE_MODULES_ORDER_TOTAL', 'Order Total Modules');
define('TEXT_INSTALL_INTRO', 'Do you really want to install this module?');
define('TEXT_DELETE_INTRO', 'Are you sure you want to delete this module?');

define('TABLE_HEADING_MODULES', 'Modules');
define('TABLE_HEADING_MODULE_DESCRIPTION', 'Description');
define('TABLE_HEADING_SORT_ORDER', 'Sort Order');
define('TABLE_HEADING_ACTION', 'Action');
define('TEXT_MODULE_DIRECTORY', 'Module Directory:');
define('TEXT_SAVE_BUTTON', 'Save');
define('TEXT_CANCEL_BUTTON', 'Cancel');
define('TEXT_CLOSE_BUTTON', 'Close');

define('MODULE_PAYMENT_CC_STATUS_TITLE', 'Enable Credit Card method');
define('MODULE_PAYMENT_CC_STATUS_DESC', 'Do you want to enable Credit Card method?');
define('MODULE_PAYMENT_CC_EMAIL_TITLE', 'E-Mail');
define('MODULE_PAYMENT_CC_EMAIL_DESC', 'E-Mail');
define('MODULE_PAYMENT_CC_ZONE_TITLE', 'Zone');
define('MODULE_PAYMENT_CC_ZONE_DESC', 'Zone');
define('MODULE_PAYMENT_CC_ORDER_STATUS_ID_TITLE', 'Order status');
define('MODULE_PAYMENT_CC_ORDER_STATUS_ID_DESC', 'Order status');
define('MODULE_PAYMENT_CC_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_PAYMENT_CC_SORT_ORDER_DESC', 'Enter sort order for this module');

define('MODULE_PAYMENT_COD_STATUS_TITLE', 'Enable COD method');
define('MODULE_PAYMENT_COD_STATUS_DESC', 'Do you want to enable COD method?');
define('MODULE_PAYMENT_COD_ZONE_TITLE', 'Zone');
define('MODULE_PAYMENT_COD_ZONE_DESC', 'If zone is set, this module will available only for customers from selected zone.');
define('MODULE_PAYMENT_COD_ORDER_STATUS_ID_TITLE', 'Order status');
define('MODULE_PAYMENT_COD_ORDER_STATUS_ID_DESC', 'Orders placed using this payment module will take the selected status.');
define('MODULE_PAYMENT_COD_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_PAYMENT_COD_SORT_ORDER_DESC', 'Enter sort order for this module.');

define('MODULE_PAYMENT_FREECHARGER_STATUS_TITLE', 'Enable Free charger method');
define('MODULE_PAYMENT_FREECHARGER_STATUS_DESC', 'Do you want to enable Free charger method?');
define('MODULE_PAYMENT_FREECHARGER_ZONE_TITLE', 'Zone');
define('MODULE_PAYMENT_FREECHARGER_ZONE_DESC', 'If zone is set, this module will available only for customers from selected zone.');
define('MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID_TITLE', 'Order status');
define('MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID_DESC', 'Orders placed using this payment module will take the selected status.');
define('MODULE_PAYMENT_FREECHARGER_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_PAYMENT_FREECHARGER_SORT_ORDER_DESC', 'Enter sort order for this module.');

define('MODULE_PAYMENT_LIQPAY_STATUS_TITLE', 'Enable LiqPAY method');
define('MODULE_PAYMENT_LIQPAY_STATUS_DESC', 'Do you want to enable LiqPAY method?');
define('MODULE_PAYMENT_LIQPAY_ID_TITLE', 'Merchant ID');
define('MODULE_PAYMENT_LIQPAY_ID_DESC', 'Set your Merchant ID.');
define('MODULE_PAYMENT_LIQPAY_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_PAYMENT_LIQPAY_SORT_ORDER_DESC', 'Enter sort order for this module.');
define('MODULE_PAYMENT_LIQPAY_ZONE_TITLE', 'Zone');
define('MODULE_PAYMENT_LIQPAY_ZONE_DESC', 'If zone is set, this module will available only for customers from selected zone.');
define('MODULE_PAYMENT_LIQPAY_SECRET_KEY_TITLE', 'Merchant password (key)');
define('MODULE_PAYMENT_LIQPAY_SECRET_KEY_DESC', 'Enter merchant password (key).');
define('MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID_TITLE', 'Select status for paid order');
define('MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID_DESC', 'Select status for paid order');

define('MODULE_PAYMENT_LIQPAY_DEFAULT_ORDER_STATUS_ID_TITLE', 'Establecer estado de pedido predeterminado');
define('MODULE_PAYMENT_LIQPAY_DEFAULT_ORDER_STATUS_ID_DESC', 'Establecer estado de pedido predeterminado');

define('MODULE_PAYMENT_BANK_TRANSFER_STATUS_TITLE', 'Bank transfer');
define('MODULE_PAYMENT_BANK_TRANSFER_STATUS_DESC', 'Do you want to use Bank transfer module? 1 - yes, 0 - no');
define('MODULE_PAYMENT_BANK_TRANSFER_1_TITLE', 'Bank name');
define('MODULE_PAYMENT_BANK_TRANSFER_1_DESC', 'Enter name of bank');
define('MODULE_PAYMENT_BANK_TRANSFER_2_TITLE', 'Checking account');
define('MODULE_PAYMENT_BANK_TRANSFER_2_DESC', 'Enter your current account');
define('MODULE_PAYMENT_BANK_TRANSFER_3_TITLE', 'BIC');
define('MODULE_PAYMENT_BANK_TRANSFER_3_DESC', 'Enter your Bank Identification Code');
define('MODULE_PAYMENT_BANK_TRANSFER_4_TITLE', 'Correspondent account');
define('MODULE_PAYMENT_BANK_TRANSFER_4_DESC', 'Enter your Correspondent account');
define('MODULE_PAYMENT_BANK_TRANSFER_5_TITLE', 'TIN');
define('MODULE_PAYMENT_BANK_TRANSFER_5_DESC', 'Enter the Bank Tax ID');
define('MODULE_PAYMENT_BANK_TRANSFER_6_TITLE', 'Receiver');
define('MODULE_PAYMENT_BANK_TRANSFER_6_DESC', 'Payment receiver');
define('MODULE_PAYMENT_BANK_TRANSFER_7_TITLE', 'CPR');
define('MODULE_PAYMENT_BANK_TRANSFER_7_DESC', 'Enter CPR');
define('MODULE_PAYMENT_BANK_TRANSFER_8_TITLE', 'Purpose');
define('MODULE_PAYMENT_BANK_TRANSFER_8_DESC', 'Enter purpose of payment');
define('MODULE_PAYMENT_BANK_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_PAYMENT_BANK_SORT_ORDER_DESC', 'Enter sort order for this module');

define('MODULE_PAYMENT_BANK_CART_TRANSFER_STATUS_TITLE', 'Prepago a la tarjeta');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_STATUS_DESC', '¿Quiere usar el módulo de Suscripción de Tarjeta? 1 - si, 0 - no');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_1_TITLE', 'Nombre del banco');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_1_DESC', 'Ingrese el nombre del banco');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_2_TITLE', 'Número de tarjeta');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_2_DESC', 'Ingrese su número de tarjeta');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_3_TITLE', 'Destinatario');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_3_DESC', 'Destinatario del pago');
define('MODULE_PAYMENT_BANK_CART_SORT_ORDER_TITLE', 'Orden de clasificación');
define('MODULE_PAYMENT_BANK_CART_SORT_ORDER_DESC', 'Orden de clasificación del módulo');

define('MODULE_PAYMENT_WEBMONEY_STATUS_TITLE', 'WebMoney payment');
define('MODULE_PAYMENT_WEBMONEY_STATUS_DESC', 'Do you want to use WebMoney module? 1 - yes, 0 - no');
define('MODULE_PAYMENT_WEBMONEY_1_TITLE', 'Your WebMoney ID');
define('MODULE_PAYMENT_WEBMONEY_1_DESC', 'Enter your WebMoney ID');
define('MODULE_PAYMENT_WEBMONEY_2_TITLE', 'Number of your R purse');
define('MODULE_PAYMENT_WEBMONEY_2_DESC', 'Enter number of your R purse');
define('MODULE_PAYMENT_WEBMONEY_3_TITLE', 'Number of your Z purse');
define('MODULE_PAYMENT_WEBMONEY_3_DESC', 'Enter number of your Z purse');
define('MODULE_PAYMENT_WEBMONEY_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_PAYMENT_WEBMONEY_SORT_ORDER_DESC', 'Enter sort order for this module');

// -----------------------SHIPPING!!!!!---------------------------//

define('MODULE_SHIPPING_EXPRESS_STATUS_TITLE', 'Enable express shipping method');
define('MODULE_SHIPPING_EXPRESS_STATUS_DESC', 'Do you want to enable express shipping method?');
define('MODULE_SHIPPING_EXPRESS_COST_TITLE', 'Cost');
define('MODULE_SHIPPING_EXPRESS_COST_DESC', 'Cost for this shipping method');
define('MODULE_SHIPPING_EXPRESS_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_EXPRESS_TAX_CLASS_DESC', 'Use tax.');
define('MODULE_SHIPPING_EXPRESS_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_EXPRESS_ZONE_DESC', 'If zone is set, this module will available only for customers from selected zone.');
define('MODULE_SHIPPING_EXPRESS_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_SHIPPING_EXPRESS_SORT_ORDER_DESC', 'Enter sort order for this module.');
define('MODULE_SHIPPING_EXPRESS_SHIPPING_PRICE_TEXT_TITLE', 'Texto de precio de entrega');
define('MODULE_SHIPPING_EXPRESS_SHIPPING_PRICE_TEXT_DESC', 'Deje en blanco si desea utilizar el precio especificado en el campo de costo');

define('MODULE_SHIPPING_FLAT_STATUS_TITLE', 'Enable Flat method');
define('MODULE_SHIPPING_FLAT_STATUS_DESC', 'Do you want to enable Flat method?');
define('MODULE_SHIPPING_FLAT_COST_TITLE', 'Cost');
define('MODULE_SHIPPING_FLAT_COST_DESC', 'Cost for this shipping method');
define('MODULE_SHIPPING_FLAT_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_FLAT_TAX_CLASS_DESC', 'Use tax.');
define('MODULE_SHIPPING_FLAT_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_FLAT_ZONE_DESC', 'If zone is set, this module will available only for customers from selected zone.');
define('MODULE_SHIPPING_FLAT_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_SHIPPING_FLAT_SORT_ORDER_DESC', 'Enter sort order for this module.');

define('MODULE_SHIPPING_FREESHIPPER_STATUS_TITLE', 'Enable free shipping');
define('MODULE_SHIPPING_FREESHIPPER_STATUS_DESC', 'Do you want to enable free shipping?');
define('MODULE_SHIPPING_FREESHIPPER_COST_TITLE', 'Cost');
define('MODULE_SHIPPING_FREESHIPPER_COST_DESC', 'Cost for this shipping method.');
define('MODULE_SHIPPING_FREESHIPPER_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_FREESHIPPER_TAX_CLASS_DESC', 'Use tax.');
define('MODULE_SHIPPING_FREESHIPPER_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_FREESHIPPER_ZONE_DESC', 'If zone is set, this module will available only for customers from selected zone.');
define('MODULE_SHIPPING_FREESHIPPER_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_SHIPPING_FREESHIPPER_SORT_ORDER_DESC', 'Enter sort order for this module.');

define('MODULE_SHIPPING_ITEM_STATUS_TITLE', 'Enable Per item method');
define('MODULE_SHIPPING_ITEM_STATUS_DESC', 'Do you want to enable Per item method?');
define('MODULE_SHIPPING_ITEM_COST_TITLE', 'Cost');
define('MODULE_SHIPPING_ITEM_COST_DESC', 'Cost for this shipping method will be multiplied to number of items in order');
define('MODULE_SHIPPING_ITEM_HANDLING_TITLE', 'Cost');
define('MODULE_SHIPPING_ITEM_HANDLING_DESC', 'Cost for this shipping method.');
define('MODULE_SHIPPING_ITEM_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_ITEM_TAX_CLASS_DESC', 'Use tax.');
define('MODULE_SHIPPING_ITEM_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_ITEM_ZONE_DESC', 'If zone is set, this module will available only for customers from selected zone.');
define('MODULE_SHIPPING_ITEM_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_SHIPPING_ITEM_SORT_ORDER_DESC', 'Enter sort order for this module.');

define('MODULE_SHIPPING_NWPOCHTA_STATUS_TITLE', 'Enable Mail method');
define('MODULE_SHIPPING_NWPOCHTA_STATUS_DESC', 'Do you want to enable Mail method?');
define('MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME_TITLE', 'Nombre del módulo personalizado');
define('MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME_DESC', 'Déjelo vacío si desea usar el nombre del módulo predeterminado');
define('MODULE_SHIPPING_NWPOCHTA_COST_TITLE', 'Cost');
define('MODULE_SHIPPING_NWPOCHTA_COST_DESC', 'Cost for this shipping method.');
define('MODULE_SHIPPING_NWPOCHTA_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_NWPOCHTA_TAX_CLASS_DESC', 'Use tax.');
define('MODULE_SHIPPING_NWPOCHTA_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_NWPOCHTA_ZONE_DESC', 'If zone is set, this module will available only for customers from selected zone.');
define('MODULE_SHIPPING_NWPOCHTA_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_SHIPPING_NWPOCHTA_SORT_ORDER_DESC', 'Enter sort order for this module.');
define('MODULE_SHIPPING_NWPOCHTA_SHIPPING_PRICE_TEXT_TITLE', 'Texto de precio de entrega');
define('MODULE_SHIPPING_NWPOCHTA_SHIPPING_PRICE_TEXT_DESC', 'Deje en blanco si desea utilizar el precio especificado en el campo de costo');

define('MODULE_SHIPPING_AVTOLUX_STATUS_TITLE', 'Allow the module courier delivery');
define('MODULE_SHIPPING_AVTOLUX_STATUS_DESC', 'You want to allow the module courier delivery?');
define('MODULE_SHIPPING_AVTOLUX_COST_TITLE', 'Cost');
define('MODULE_SHIPPING_AVTOLUX_COST_DESC', 'The cost of using this method of delivery.');
define('MODULE_SHIPPING_AVTOLUX_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_AVTOLUX_TAX_CLASS_DESC', 'Use the tax.');
define('MODULE_SHIPPING_AVTOLUX_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_AVTOLUX_ZONE_DESC', 'If the zone is selected, then this delivery module will be visible only to buyers from the selected zone.');
define('MODULE_SHIPPING_AVTOLUX_SORT_ORDER_TITLE', 'Sorting order');
define('MODULE_SHIPPING_AVTOLUX_SORT_ORDER_DESC', 'The order of the module sorting.');

define('MODULE_SHIPPING_CUSTOMSHIPPER_STATUS_TITLE', 'Allow the module courier delivery');
define('MODULE_SHIPPING_CUSTOMSHIPPER_NAME_TITLE', 'Module name');
define('MODULE_SHIPPING_CUSTOMSHIPPER_WAY_TITLE', 'Description');
define('MODULE_SHIPPING_CUSTOMSHIPPER_COST_TITLE', 'Cost');
define('MODULE_SHIPPING_CUSTOMSHIPPER_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_CUSTOMSHIPPER_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_CUSTOMSHIPPER_ZONE_DESC', 'If the zone is selected, then this delivery module will be visible only to buyers from the selected zone.');
define('MODULE_SHIPPING_CUSTOMSHIPPER_SORT_ORDER_TITLE', 'Sorting order');

define('MODULE_SHIPPING_PERCENT_STATUS_TITLE', 'Enable Percent method');
define('MODULE_SHIPPING_PERCENT_STATUS_DESC', 'Do you want to enable Percent method?');
define('MODULE_SHIPPING_PERCENT_RATE_TITLE', 'Percent');
define('MODULE_SHIPPING_PERCENT_RATE_DESC', 'Стоимость доставки данным модулем в процентах от общей стоимости заказа, значения от .01 до .99');
define('MODULE_SHIPPING_PERCENT_LESS_THEN_TITLE', 'Плоская стоимость для заказов до');
define('MODULE_SHIPPING_PERCENT_LESS_THEN_DESC', 'Плоская стоимость доставки для заказов, стоимостью до указанной величины.');
define('MODULE_SHIPPING_PERCENT_FLAT_USE_TITLE', 'Плоская процентная стоимость');
define('MODULE_SHIPPING_PERCENT_FLAT_USE_DESC', 'Плоская стоимость доставки в процентах от общей стоимости заказа, действительно для всех заказов.');
define('MODULE_SHIPPING_PERCENT_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_PERCENT_TAX_CLASS_DESC', 'Use tax.');
define('MODULE_SHIPPING_PERCENT_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_PERCENT_ZONE_DESC', 'If zone is set, this module will available only for customers from selected zone.');
define('MODULE_SHIPPING_PERCENT_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_SHIPPING_PERCENT_SORT_ORDER_DESC', 'Enter sort order for this module.');

define('MODULE_SHIPPING_SAT_STATUS_TITLE', 'Enable SAT method');
define('MODULE_SHIPPING_SAT_STATUS_DESC', 'Do you want to enable SAT method?');
define('MODULE_SHIPPING_SAT_COST_TITLE', 'Cost');
define('MODULE_SHIPPING_SAT_COST_DESC', 'Cost for this shipping method.');
define('MODULE_SHIPPING_SAT_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_SAT_TAX_CLASS_DESC', 'Use tax.');
define('MODULE_SHIPPING_SAT_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_SAT_ZONE_DESC', 'If zone is set, this module will available only for customers from selected zone.');
define('MODULE_SHIPPING_SAT_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_SHIPPING_SAT_SORT_ORDER_DESC', 'Enter sort order for this module.');

define('MODULE_SHIPPING_TABLE_STATUS_TITLE', 'Enable Table method');
define('MODULE_SHIPPING_TABLE_STATUS_DESC', 'Do you want to enable Table method?');
define('MODULE_SHIPPING_TABLE_COST_TITLE', 'Cost');
define('MODULE_SHIPPING_TABLE_COST_DESC', 'The shipping cost is calculated based on the total weight of the order or the total cost of the order. For example: 25: 8.50,50: 5.50, etc ... This means that up to 25 delivery will cost 8.50, from 25 to 50 it will cost 5.50, etc.');
define('MODULE_SHIPPING_TABLE_MODE_TITLE', 'Method of calculation');
define('MODULE_SHIPPING_TABLE_MODE_DESC', 'The cost of calculating the delivery based on the total weight of the order (weight) or based on the total cost of the order (price).');
define('MODULE_SHIPPING_TABLE_HANDLING_TITLE', 'Cost');
define('MODULE_SHIPPING_TABLE_HANDLING_DESC', 'Cost for this shipping method.');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_DESC', 'Use tax.');
define('MODULE_SHIPPING_TABLE_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_TABLE_ZONE_DESC', 'If zone is set, this module will available only for customers from selected zone.');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_DESC', 'Enter sort order for this module.');

define('MODULE_SHIPPING_ZONES_STATUS_TITLE', 'Enable Zones method');
define('MODULE_SHIPPING_ZONES_STATUS_DESC', 'Do you want to enable Zones method?');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_DESC', 'Use tax.');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_DESC', 'Enter sort order for this module.');
define('MODULE_SHIPPING_ZONES_COUNTRIES_1_TITLE', 'Страны 1 зоны');
define('MODULE_SHIPPING_ZONES_COUNTRIES_1_DESC', 'Список стран через запятую для зоны 1.');
define('MODULE_SHIPPING_ZONES_COST_1_TITLE', 'Стоимость доставки для 1 зоны');
define('MODULE_SHIPPING_ZONES_COST_1_DESC', 'Стоимость доставки через запятую для зоны 1 на базе максимальной стоимость заказа. Например: 3:8.50,7:10.50,... Это значит, что стоимость доставки для заказов, весом до 3 кг. будет стоить 8.50 для покупателей из стран 1 зоны.');
define('MODULE_SHIPPING_ZONES_HANDLING_1_TITLE', 'Стоимость для 1 зоны');
define('MODULE_SHIPPING_ZONES_HANDLING_1_DESC', 'Стоимость использования данного способа доставки.');

// -----------------------ORDER TOTAL!!!!!---------------------------//

define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS_TITLE', 'Enable method "Related discount"');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS_DESC', 'Do you want to enable "Related discount"?');
define('MODULE_ORDER_TOTAL_OT_BETTER_TOGETHER_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_ORDER_TOTAL_OT_BETTER_TOGETHER_SORT_ORDER_DESC', 'Enter sort order for this module');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX_TITLE', 'Include Tax');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX_DESC', 'Use tax');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX_TITLE', 'Re-calculate Tax');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX_DESC', 'Re-calculate Tax');

define('MODULE_ORDER_TOTAL_COUPON_STATUS_TITLE', 'Display total');
define('MODULE_ORDER_TOTAL_COUPON_STATUS_DESC', 'You want to show the nominal of coupon?');
define('MODULE_ORDER_TOTAL_OT_COUPON_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_ORDER_TOTAL_OT_COUPON_SORT_ORDER_DESC', 'Enter sort order for this module.');
define('MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING_TITLE', 'Include shipping');
define('MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING_DESC', 'Include the delivery into calculation.');
define('MODULE_ORDER_TOTAL_COUPON_INC_TAX_TITLE', 'Include tax.');
define('MODULE_ORDER_TOTAL_COUPON_INC_TAX_DESC', 'Include tax into calculation.');
define('MODULE_ORDER_TOTAL_COUPON_CALC_TAX_TITLE', 'Recalculate the tax');
define('MODULE_ORDER_TOTAL_COUPON_CALC_TAX_DESC', 'Recalculate the tax.');
define('MODULE_ORDER_TOTAL_COUPON_TAX_CLASS_TITLE', 'Tax');
define('MODULE_ORDER_TOTAL_COUPON_TAX_CLASS_DESC', 'Use tax for coupons.');

define('MODULE_ORDER_TOTAL_GV_STATUS_TITLE', 'Display total');
define('MODULE_ORDER_TOTAL_GV_STATUS_DESC', 'Do you want to show the value of the gift certificate?');
define('MODULE_ORDER_TOTAL_OT_GV_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_ORDER_TOTAL_OT_GV_SORT_ORDER_DESC', 'Enter sort order for this module.');
define('MODULE_ORDER_TOTAL_GV_QUEUE_TITLE', 'Certificate activation');
define('MODULE_ORDER_TOTAL_GV_QUEUE_DESC', 'Do you want to manually activate your purchased gift certificates?');
define('MODULE_ORDER_TOTAL_GV_INC_SHIPPING_TITLE', 'Include shipping');
define('MODULE_ORDER_TOTAL_GV_INC_SHIPPING_DESC', 'Include the delivery into calculation.');
define('MODULE_ORDER_TOTAL_GV_INC_TAX_TITLE', 'Include tax');
define('MODULE_ORDER_TOTAL_GV_INC_TAX_DESC', 'Include tax into calculation.');
define('MODULE_ORDER_TOTAL_GV_CALC_TAX_TITLE', 'Recalculate the tax');
define('MODULE_ORDER_TOTAL_GV_CALC_TAX_DESC', 'Recalculate the tax.');
define('MODULE_ORDER_TOTAL_GV_TAX_CLASS_TITLE', 'Tax');
define('MODULE_ORDER_TOTAL_GV_TAX_CLASS_DESC', 'Use tax.');
define('MODULE_ORDER_TOTAL_GV_CREDIT_TAX_TITLE', 'Tax on certificate');
define('MODULE_ORDER_TOTAL_GV_CREDIT_TAX_DESC', 'Add tax to purchased gift certificates.');
define('MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID_TITLE', 'Order status');
define('MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID_DESC', 'Orders issued using a gift certificate covering the full cost of the order will have the indicated status.');

define('MODULE_LEV_DISCOUNT_STATUS_TITLE', 'Show discount');
define('MODULE_LEV_DISCOUNT_STATUS_DESC', 'Allow discount?');
define('MODULE_ORDER_TOTAL_OT_LEV_DISCOUNT_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_ORDER_TOTAL_OT_LEV_DISCOUNT_SORT_ORDER_DESC', 'Enter sort order for this module.');
define('MODULE_LEV_DISCOUNT_TABLE_TITLE', 'Discount percent');
define('MODULE_LEV_DISCOUNT_TABLE_DESC', 'Set up price limits and discount percents, separated by commas.');
define('MODULE_LEV_DISCOUNT_INC_SHIPPING_TITLE', 'Include shipping');
define('MODULE_LEV_DISCOUNT_INC_SHIPPING_DESC', 'Include the delivery into calculation.');
define('MODULE_LEV_DISCOUNT_INC_TAX_TITLE', 'Include tax');
define('MODULE_LEV_DISCOUNT_INC_TAX_DESC', 'Include tax into calculation.');
define('MODULE_LEV_DISCOUNT_CALC_TAX_TITLE', 'Recalculate the tax');
define('MODULE_LEV_DISCOUNT_CALC_TAX_DESC', 'Recalculate the tax.');

define('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS_TITLE', 'Show low cost of the order');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS_DESC', 'Do you want to show low cost of the order?');
define('MODULE_ORDER_TOTAL_OT_LOWORDERFEE_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_ORDER_TOTAL_OT_LOWORDERFEE_SORT_ORDER_DESC', 'Enter sort order for this module.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE_TITLE', 'Allow low cost of the order');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE_DESC', 'Do you want to enable method of low cost of the order?');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER_TITLE', 'Low cost of the order to');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER_DESC', 'Low cost of orders for orders up to a specified value.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE_TITLE', 'Fee');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE_DESC', 'Fee');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION_TITLE', 'Include fee to the order');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION_DESC', 'Include fee to the next orders.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS_TITLE', 'Tax');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS_DESC', 'Use tax.');

define('MODULE_PAYMENT_DISC_STATUS_TITLE', 'Enable method');
define('MODULE_PAYMENT_DISC_STATUS_DESC', 'Activate module?');
define('MODULE_ORDER_TOTAL_OT_PAYMENT_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_ORDER_TOTAL_OT_PAYMENT_SORT_ORDER_DESC', 'Enter sort order for this module.');
define('MODULE_PAYMENT_DISC_PERCENTAGE_TITLE', 'Discount');
define('MODULE_PAYMENT_DISC_PERCENTAGE_DESC', 'Minimal order amount to receive the discount.');
define('MODULE_PAYMENT_DISC_MINIMUM_TITLE', 'Minimum order amount');
define('MODULE_PAYMENT_DISC_MINIMUM_DESC', 'Minimal order amount to receive the discount.');
define('MODULE_PAYMENT_DISC_TYPE_TITLE', 'Payment method');
define('MODULE_PAYMENT_DISC_TYPE_DESC', 'Here you need to specify the name of the payment module. You can get the name from the module file, for example /includes/modules/payment/webmoney.php. There is webmoney on top, so if we want to give a discount for payments made via WebMoney, write webmoney than.');
define('MODULE_PAYMENT_DISC_INC_SHIPPING_TITLE', 'Include shipping');
define('MODULE_PAYMENT_DISC_INC_SHIPPING_DESC', 'Include the delivery into calculation');
define('MODULE_PAYMENT_DISC_INC_TAX_TITLE', 'Include tax');
define('MODULE_PAYMENT_DISC_INC_TAX_DESC', 'Include tax into calculation.');
define('MODULE_PAYMENT_DISC_CALC_TAX_TITLE', 'Calculate tax');
define('MODULE_PAYMENT_DISC_CALC_TAX_DESC', 'Include fee to discount calculation.');

define('MODULE_QTY_DISCOUNT_STATUS_TITLE', 'Show a discount depending on quantity');
define('MODULE_QTY_DISCOUNT_STATUS_DESC', 'Do you want to allow a discount depending on quantity?');
define('MODULE_ORDER_TOTAL_OT_QTY_DISCOUNT_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_ORDER_TOTAL_OT_QTY_DISCOUNT_SORT_ORDER_DESC', 'Enter sort order for this module.');
define('MODULE_QTY_DISCOUNT_RATE_TYPE_TITLE', 'Type of discount');
define('MODULE_QTY_DISCOUNT_RATE_TYPE_DESC', 'Choose type of discount - percentage or flat rate');
define('MODULE_QTY_DISCOUNT_RATES_TITLE', 'Discount');
define('MODULE_QTY_DISCOUNT_RATES_DESC', 'The discount is based on the total number units of goods ordered. For example, 10:5, 20:10 and so on ... This means that by ordering 10 or more units of goods, the buyer gets a discount of 5% or $5; 20 units or more - 10% or $10, depending on the type');
define('MODULE_QTY_DISCOUNT_INC_SHIPPING_TITLE', 'Include shipping');
define('MODULE_QTY_DISCOUNT_INC_SHIPPING_DESC', 'Include the delivery into calculation.');
define('MODULE_QTY_DISCOUNT_INC_TAX_TITLE', 'Include tax');
define('MODULE_QTY_DISCOUNT_INC_TAX_DESC', 'Include tax into calculation.');
define('MODULE_QTY_DISCOUNT_CALC_TAX_TITLE', 'Recalculate the tax');
define('MODULE_QTY_DISCOUNT_CALC_TAX_DESC', 'Recalculate the tax.');

define('MODULE_ORDER_TOTAL_SHIPPING_STATUS_TITLE', 'Show delivery');
define('MODULE_ORDER_TOTAL_SHIPPING_STATUS_DESC', 'Do you want to show delivery cost?');
define('MODULE_ORDER_TOTAL_OT_SHIPPING_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_ORDER_TOTAL_OT_SHIPPING_SORT_ORDER_DESC', 'Enter sort order for this module.');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_TITLE', 'Allow free delivery');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_DESC', 'Do you want to allow allow free delivery?');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_TITLE', 'Free delivery for orders after');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_DESC', 'For orders over a specified value, delivery will be free..');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_TITLE', 'Free delivery for orders');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_DESC', 'Specify free shipping orders.');

define('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS_TITLE', 'Show cost of item');
define('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS_DESC', 'Do you want to show cost of item?');
define('MODULE_ORDER_TOTAL_OT_SUBTOTAL_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_ORDER_TOTAL_OT_SUBTOTAL_SORT_ORDER_DESC', 'Enter sort order for this module.');

define('MODULE_ORDER_TOTAL_TAX_STATUS_TITLE', 'Show tax');
define('MODULE_ORDER_TOTAL_TAX_STATUS_DESC', 'Do you want to show tax?');
define('MODULE_ORDER_TOTAL_OT_TAX_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_ORDER_TOTAL_OT_TAX_SORT_ORDER_DESC', 'Enter sort order for this module.');

define('MODULE_ORDER_TOTAL_TOTAL_STATUS_TITLE', 'Show total');
define('MODULE_ORDER_TOTAL_TOTAL_STATUS_DESC', 'Do you want to show total cost of order?');
define('MODULE_ORDER_TOTAL_OT_TOTAL_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_ORDER_TOTAL_OT_TOTAL_SORT_ORDER_DESC', 'Enter sort order for this module.');

define('SHIPPING_TAB_TITLE', 'Envío');
define('SHIPPING_TO_PAYMENT_TAB_TITLE', 'Enviar para pagar');
define('SHIPPING_TO_FIELDS_TAB_TITLE', 'Enviar a campos');
define('SHIPPING_UPDATE_WAREHOUSES_TITLE', 'Actualizar almacenes');
define('MODULE_SHIPPING_NWPOSHTANEW_STATUS_TITLE', 'Habilitar nuevo módulo de correo');
define('MODULE_SHIPPING_NWPOSHTANEW_STATUS_DESC', '¿Desea habilitar el módulo de correo nuevo?');
define('MODULE_SHIPPING_NWPOSHTANEW_COST_TITLE', 'Coste');
define('MODULE_SHIPPING_NWPOSHTANEW_CUSTOM_NAME_TITLE', 'Nombre personalizado');
define('MODULE_SHIPPING_NWPOSHTANEW_CUSTOM_NAME_DESC', 'Deje este campo en blanco si desea usar el nombre predeterminado');
define('MODULE_SHIPPING_NWPOSHTANEW_COST_DESC', 'El costo de usar este método de envío.');
define('MODULE_SHIPPING_NWPOSHTANEW_TAX_CLASS_TITLE', 'Impuesto');
define('MODULE_SHIPPING_NWPOSHTANEW_TAX_CLASS_DESC', 'Use tax.');
define('MODULE_SHIPPING_NWPOSHTANEW_ZONE_TITLE', 'Zona');
define('MODULE_SHIPPING_NWPOSHTANEW_ZONE_DESC', 'Si se selecciona una zona, este módulo de envío solo será visible para los clientes en la zona seleccionada.');
define('MODULE_SHIPPING_NWPOSHTANEW_SORT_ORDER_TITLE', 'Orden de clasificación');
define('MODULE_SHIPPING_NWPOSHTANEW_SORT_ORDER_DESC', 'Orden de clasificación del módulo.');
define('MODULE_SHIPPING_NWPOSHTANEW_API_KEY_TITLE', 'Clave API');
define('MODULE_SHIPPING_NWPOSHTANEW_API_KEY_DESCRIPTION', 'Puede ser necesario para actualizar almacenes');
define('MODULE_SHIPPING_NWPOSHTANEW_SHOW_SHIPPING_COST_STATUS_TITLE', 'Mostrar costo de envío');
define('MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_PRICE_TEXT_TITLE', 'Delivery price text');
define('MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_PRICE_TEXT_DESC', 'Leave blank if you want to use the price specified in the cost field');
define('MODULE_SHIPPING_NWPOSHTANEW_AUTODETECTION_DEPARTURE_TYPE_TITLE', 'Auto-detection of shipment type');
define('MODULE_SHIPPING_NWPOSHTANEW_AUTODETECTION_DEPARTURE_TYPE_DESC', 'Detect shipment type automatically?');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_REGION_TITLE', 'Sender area');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_REGION_DESC', 'Specify sender area');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_CITY_NAME_TITLE', 'Sender city');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_CITY_NAME_DESC', '\Select the city from which the order will be sent');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS_NAME_TITLE', 'Sender\'s address');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS_NAME_DESC', '\Select the address from which the order will be sent');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_TYPE_TITLE', 'Departure type');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_TYPE_DESC', 'Specify the type of shipment.');
define('MODULE_SHIPPING_NWPOSHTANEW_SEATS_AMOUNT_TITLE', 'Number of seats');
define('MODULE_SHIPPING_NWPOSHTANEW_SEATS_AMOUNT_DESC', 'Specify the default number of seats. If the field is left blank, then the number of seats will correspond to the number of products in the order.');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_DESCRIPTION_TITLE', 'Departure Description');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_DESCRIPTION_DESC', 'It is used as the default description of the product when creating "EN", it is convenient if there are many products in the store that have the same description.');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_TITLE', 'Return shipping');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_DESC', 'Specify the default return shipping type.');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_TITLE', 'Declared value');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DESC', 'Specify the components for the declared value of the shipment.');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DEFAULT_TITLE', 'Declared default value');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DEFAULT_DESC', 'The value will be used if the declared value is not set or if the order is not paid by cash on delivery.');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_PAYER_TITLE', 'Return shipping payer');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_PAYER_DESC', 'Specify the default return shipping payer.');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_TYPE_TITLE', 'Payment form');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_TYPE_DESC', 'Specify the default form of payment.');
define('MODULE_SHIPPING_NWPOSHTANEW_MONEY_TRANSFER_METHOD_TITLE', 'How to receive a money transfer');
define('MODULE_SHIPPING_NWPOSHTANEW_MONEY_TRANSFER_METHOD_DESC', 'Specify the method of receiving money transfer.');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_CONTROL_TITLE', 'Payment control');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_CONTROL_DESC', 'Specify components for payment control. If items are marked, the payment control will replace the money transfer.');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_ADDITIONAL_INFORMATION_TITLE', 'Additional shipping information');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_ADDITIONAL_INFORMATION_DESC', 'It is used as a template for the field of additional information about the shipment when creating a waybill. Macros can be used. When using product macros, separate the text into two blocks using the symbol "|" (use product macros in the second block).');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_FORMAT_TITLE', 'Print format');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_FORMAT_DESC', 'Specify the print format.');
define('MODULE_SHIPPING_NWPOSHTANEW_TEMPLATE_TYPE_TITLE', 'Template type');
define('MODULE_SHIPPING_NWPOSHTANEW_TEMPLATE_TYPE_DESC', 'Specify template type.');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_TYPE_TITLE', 'Print type');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_TYPE_DESC', 'Specify Print Type.');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_START_TITLE', 'Place of printing');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_START_DESC', 'Specify the location where printing will start.');
define('MODULE_SHIPPING_NWPOSHTANEW_NUMBER_OF_COPIES_TITLE', 'Number of copies');
define('MODULE_SHIPPING_NWPOSHTANEW_NUMBER_OF_COPIES_DESC', 'Specify the number of copies.');
define('MODULE_SHIPPING_NWPOSHTANEW_DISPLAY_ALL_CONSIGNMENTS_TITLE', 'Display all invoices for an account');
define('MODULE_SHIPPING_NWPOSHTANEW_DISPLAY_ALL_CONSIGNMENTS_DESC', 'Show all invoices for a postal company account? If you select "No", then only those invoices that are assigned to the orders of this online store will be displayed.');
define('MODULE_SHIPPING_NWPOSHTANEW_CONSIGNMENT_DISPLAYED_INFORMATION_TITLE', 'Displayed Information');
define('MODULE_SHIPPING_NWPOSHTANEW_CONSIGNMENT_DISPLAYED_INFORMATION_DESC', 'Select information to display.');
define('MODULE_SHIPPING_NWPOSHTANEW_DELIVERY_PAYER_TITLE', 'Delivery payer');
define('MODULE_SHIPPING_NWPOSHTANEW_DELIVERY_PAYER_DESC', 'Specify the default shipping payer');
define('MODULE_SHIPPING_NWPOSHTANEW_WEIGHT_TITLE', 'The weight');
define('MODULE_SHIPPING_NWPOSHTANEW_WEIGHT_DESC', 'Specify the default actual weight');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_W_TITLE', 'Width');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_W_DESC', 'Specify a default width');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_L_TITLE', 'Length');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_L_DESC', 'Specify a default length');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_H_TITLE', 'Height');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_H_DESC', 'Specify a default height');
define('MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE_TITLE', 'Debug mode');
define('MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE_DESC', 'Enable/disable debug mode');
define('MODULE_SHIPPING_NWPOSHTANEW_SAVE_TTN_ONE_CLICK_TITLE', 'Create TTN in one click');
define('MODULE_SHIPPING_NWPOSHTANEW_SAVE_TTN_ONE_CLICK_DESC', 'Enable / disable the creation of TTN in one click');
define('MODULE_SHIPPING_NWPOSHTANEW_cn_identifier', 'Invoice ID');
define('MODULE_SHIPPING_NWPOSHTANEW_cn_number', 'invoice number');
define('MODULE_SHIPPING_NWPOSHTANEW_order_number', 'order no.');
define('MODULE_SHIPPING_NWPOSHTANEW_create_date', 'date of creation');
define('MODULE_SHIPPING_NWPOSHTANEW_actual_shipping_date', 'Actual departure date');
define('MODULE_SHIPPING_NWPOSHTANEW_preferred_shipping_date', 'Desired delivery date');
define('MODULE_SHIPPING_NWPOSHTANEW_estimated_shipping_date', 'Estimated delivery date');
define('MODULE_SHIPPING_NWPOSHTANEW_recipient_date', 'Date of receiving');
define('MODULE_SHIPPING_NWPOSHTANEW_last_updated_status_date', 'Date of last status update');
define('MODULE_SHIPPING_NWPOSHTANEW_sender', 'Sender');
define('MODULE_SHIPPING_NWPOSHTANEW_sender_address', 'Sender\'s address');
define('MODULE_SHIPPING_NWPOSHTANEW_recipient', 'Recipient');
define('MODULE_SHIPPING_NWPOSHTANEW_recipient_address', 'Address of the recipient');
define('MODULE_SHIPPING_NWPOSHTANEW_weight', 'Weight, kg');
define('MODULE_SHIPPING_NWPOSHTANEW_seats_amount', 'Number of seats');
define('MODULE_SHIPPING_NWPOSHTANEW_declared_cost', 'Declared value');
define('MODULE_SHIPPING_NWPOSHTANEW_shipping_cost', 'Cost of delivery');
define('MODULE_SHIPPING_NWPOSHTANEW_backward_delivery', 'Return shipping');
define('MODULE_SHIPPING_NWPOSHTANEW_service_type', 'Delivery technology');
define('MODULE_SHIPPING_NWPOSHTANEW_description', 'Description');
define('MODULE_SHIPPING_NWPOSHTANEW_additional_information', 'Additional Information');
define('MODULE_SHIPPING_NWPOSHTANEW_payer_type', 'Delivery payer');
define('MODULE_SHIPPING_NWPOSHTANEW_payment_method', 'Payment type');
define('MODULE_SHIPPING_NWPOSHTANEW_departure_type', 'Departure type');
define('MODULE_SHIPPING_NWPOSHTANEW_packing_number', 'Packing number');
define('MODULE_SHIPPING_NWPOSHTANEW_rejection_reason', 'Reason for not delivering');
define('MODULE_SHIPPING_NWPOSHTANEW_status', 'Status');
define('MODULE_SHIPPING_NWPOSHTANEW_Cargo', 'Cargo');
define('MODULE_SHIPPING_NWPOSHTANEW_Parcel', 'Parcel');
define('MODULE_SHIPPING_NWPOSHTANEW_Documents', 'Documents');
define('MODULE_SHIPPING_NWPOSHTANEW_TiresWheels', 'TiresWheels');
define('MODULE_SHIPPING_NWPOSHTANEW_Pallet', 'Pallet');
define('MODULE_SHIPPING_NWPOSHTANEW_N', 'No return shipping');
define('MODULE_SHIPPING_NWPOSHTANEW_Money', 'Money');
define('MODULE_SHIPPING_NWPOSHTANEW_ot_shipping', 'Delivery');
define('MODULE_SHIPPING_NWPOSHTANEW_ot_subtotal', 'Preliminary Total');
define('MODULE_SHIPPING_NWPOSHTANEW_ot_total', 'Order Total');
define('MODULE_SHIPPING_NWPOSHTANEW_Sender', 'Sender');
define('MODULE_SHIPPING_NWPOSHTANEW_Recipient', 'Recipient');
define('MODULE_SHIPPING_NWPOSHTANEW_ThirdPerson', 'Third Person');
define('MODULE_SHIPPING_NWPOSHTANEW_on_warehouse', 'On warehouse');
define('MODULE_SHIPPING_NWPOSHTANEW_to_payment_card', 'To payment card');
define('MODULE_SHIPPING_NWPOSHTANEW_document_A4', 'Document A4 ');
define('MODULE_SHIPPING_NWPOSHTANEW_document_A5', 'Document A5 ');
define('MODULE_SHIPPING_NWPOSHTANEW_markings_A4', 'Markings A4 ');
define('MODULE_SHIPPING_NWPOSHTANEW_html', 'HTML');
define('MODULE_SHIPPING_NWPOSHTANEW_pdf', 'PDF');
define('MODULE_SHIPPING_NWPOSHTANEW_horPrint', 'Horizontal');
define('MODULE_SHIPPING_NWPOSHTANEW_verPrint', 'Vertical');
define('MODULE_SHIPPING_NWPOSHTANEW_Cash', 'Cash');
define('MODULE_SHIPPING_NWPOSHTANEW_NonCash', 'Non Cash');

define('SHIPPING_UPDATE_AREAS_TITLE', 'Update areas');
define('SHIPPING_UPDATE_CITIES_TITLE', 'Update cities');
define('SHIPPING_UPDATE_REFERENCES_TITLE', 'Update directories');
?>
