<?php
/*
  $Id: modules.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE_MODULES_PAYMENT', 'Platební moduly');
define('HEADING_TITLE_MODULES_SHIPPING', 'Přepravní moduly');
define('HEADING_TITLE_MODULES_ORDER_TOTAL', 'Objednat moduly celkem');
define('TEXT_INSTALL_INTRO', 'Opravdu chcete nainstalovat tento modul?');
define('TEXT_DELETE_INTRO', 'Opravdu chcete smazat tento modul?');

define('TABLE_HEADING_MODULES', 'Moduly');
define('TABLE_HEADING_MODULE_DESCRIPTION', 'Popis');
define('TABLE_HEADING_SORT_ORDER', 'Pořadí řazení');
define('TABLE_HEADING_ACTION', 'Akce');
define('TEXT_MODULE_DIRECTORY', 'Adresář modulu:');
define('TEXT_SAVE_BUTTON', 'Uložit');
define('TEXT_CANCEL_BUTTON', 'Zrušit');
define('TEXT_CLOSE_BUTTON', 'Zavřít');

define('MODULE_PAYMENT_CC_STATUS_TITLE', 'Povolit metodu kreditní karty');
define('MODULE_PAYMENT_CC_STATUS_DESC', 'Chcete aktivovat metodu kreditní karty?');
define('MODULE_PAYMENT_CC_EMAIL_TITLE', 'E-mail');
define('MODULE_PAYMENT_CC_EMAIL_DESC', 'E-mail');
define('MODULE_PAYMENT_CC_ZONE_TITLE', 'Zóna');
define('MODULE_PAYMENT_CC_ZONE_DESC', 'Zóna');
define('MODULE_PAYMENT_CC_ORDER_STATUS_ID_TITLE', 'Stav objednávky');
define('MODULE_PAYMENT_CC_ORDER_STATUS_ID_DESC', 'Stav objednávky');
define('MODULE_PAYMENT_CC_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_PAYMENT_CC_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul');

define('MODULE_PAYMENT_COD_STATUS_TITLE', 'Povolit metodu COD');
define('MODULE_PAYMENT_COD_STATUS_DESC', 'Chcete povolit metodu COD?');
define('MODULE_PAYMENT_COD_ZONE_TITLE', 'Zóna');
define('MODULE_PAYMENT_COD_ZONE_DESC', 'Pokud je nastavena zóna, bude tento modul dostupný pouze pro zákazníky z vybrané zóny.');
define('MODULE_PAYMENT_COD_ORDER_STATUS_ID_TITLE', 'Stav objednávky');
define('MODULE_PAYMENT_COD_ORDER_STATUS_ID_DESC', 'Objednávky zadané pomocí tohoto platebního modulu budou mít vybraný stav.');
define('MODULE_PAYMENT_COD_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_PAYMENT_COD_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');

define('MODULE_PAYMENT_FREECHARGER_STATUS_TITLE', 'Povolit metodu bezplatné nabíječky');
define('MODULE_PAYMENT_FREECHARGER_STATUS_DESC', 'Chcete povolit metodu bezplatného nabíjení?');
define('MODULE_PAYMENT_FREECHARGER_ZONE_TITLE', 'Zóna');
define('MODULE_PAYMENT_FREECHARGER_ZONE_DESC', 'Pokud je nastavena zóna, bude tento modul dostupný pouze pro zákazníky z vybrané zóny.');
define('MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID_TITLE', 'Stav objednávky');
define('MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID_DESC', 'Objednávky zadané pomocí tohoto platebního modulu budou mít vybraný stav.');
define('MODULE_PAYMENT_FREECHARGER_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_PAYMENT_FREECHARGER_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');

define('MODULE_PAYMENT_LIQPAY_STATUS_TITLE', 'Povolit metodu LiqPAY');
define('MODULE_PAYMENT_LIQPAY_STATUS_DESC', 'Chcete aktivovat metodu LiqPAY?');
define('MODULE_PAYMENT_LIQPAY_ID_TITLE', 'ID obchodníka');
define('MODULE_PAYMENT_LIQPAY_ID_DESC', 'Nastavte své ID obchodníka.');
define('MODULE_PAYMENT_LIQPAY_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_PAYMENT_LIQPAY_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');
define('MODULE_PAYMENT_LIQPAY_ZONE_TITLE', 'Zóna');
define('MODULE_PAYMENT_LIQPAY_ZONE_DESC', 'Pokud je nastavena zóna, bude tento modul dostupný pouze pro zákazníky z vybrané zóny.');
define('MODULE_PAYMENT_LIQPAY_SECRET_KEY_TITLE', 'Heslo obchodníka (klíč)');
define('MODULE_PAYMENT_LIQPAY_SECRET_KEY_DESC', 'Zadejte heslo obchodníka (klíč).');
define('MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID_TITLE', 'Vyberte stav pro zaplacenou objednávku');
define('MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID_DESC', 'Vyberte stav pro zaplacenou objednávku');

define('MODULE_PAYMENT_LIQPAY_DEFAULT_ORDER_STATUS_ID_TITLE', 'Nastavit výchozí stav objednávky');
define('MODULE_PAYMENT_LIQPAY_DEFAULT_ORDER_STATUS_ID_DESC', 'Nastavit výchozí stav objednávky');

define('MODULE_PAYMENT_BANK_TRANSFER_STATUS_TITLE', 'Bankovní převod');
define('MODULE_PAYMENT_BANK_TRANSFER_STATUS_DESC', 'Chcete použít modul Bankovní převod? 1 - ano, 0 - ne');
define('MODULE_PAYMENT_BANK_TRANSFER_1_TITLE', 'Název banky');
define('MODULE_PAYMENT_BANK_TRANSFER_1_DESC', 'Zadejte název banky');
define('MODULE_PAYMENT_BANK_TRANSFER_2_TITLE', 'Kontrolní účet');
define('MODULE_PAYMENT_BANK_TRANSFER_2_DESC', 'Zadejte svůj aktuální účet');
define('MODULE_PAYMENT_BANK_TRANSFER_3_TITLE', 'BIC');
define('MODULE_PAYMENT_BANK_TRANSFER_3_DESC', 'Zadejte svůj bankovní identifikační kód');
define('MODULE_PAYMENT_BANK_TRANSFER_4_TITLE', 'korespondentský účet');
define('MODULE_PAYMENT_BANK_TRANSFER_4_DESC', 'Zadejte svůj korespondentský účet');
define('MODULE_PAYMENT_BANK_TRANSFER_5_TITLE', 'DIČ');
define('MODULE_PAYMENT_BANK_TRANSFER_5_DESC', 'Zadejte daňové identifikační číslo banky');
define('MODULE_PAYMENT_BANK_TRANSFER_6_TITLE', 'Přijímač');
define('MODULE_PAYMENT_BANK_TRANSFER_6_DESC', 'Příjemce plateb');
define('MODULE_PAYMENT_BANK_TRANSFER_7_TITLE', 'CPR');
define('MODULE_PAYMENT_BANK_TRANSFER_7_DESC', 'Zadejte CPR');
define('MODULE_PAYMENT_BANK_TRANSFER_8_TITLE', 'Účel');
define('MODULE_PAYMENT_BANK_TRANSFER_8_DESC', 'Zadejte účel platby');
define('MODULE_PAYMENT_BANK_TRANSFER_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_PAYMENT_BANK_TRANSFER_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul');

define('MODULE_PAYMENT_BANK_CART_TRANSFER_STATUS_TITLE', 'Platba předem na kartu');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_STATUS_DESC', 'Chcete použít modul Předplatné karty? 1 - ano, 0 - ne');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_1_TITLE', 'Název banky');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_1_DESC', 'Zadejte název banky');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_2_TITLE', 'Číslo karty');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_2_DESC', 'Zadejte číslo své karty');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_3_TITLE', 'Příjemce');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_3_DESC', 'Příjemce platby');
define('MODULE_PAYMENT_BANK_CART_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_PAYMENT_BANK_CART_SORT_ORDER_DESC', 'Pořadí řazení modulů');

define('MODULE_PAYMENT_WEBMONEY_STATUS_TITLE', 'Platba WebMoney');
define('MODULE_PAYMENT_WEBMONEY_STATUS_DESC', 'Chcete použít modul WebMoney? 1 - ano, 0 - ne');
define('MODULE_PAYMENT_WEBMONEY_1_TITLE', 'Vaše ID WebMoney');
define('MODULE_PAYMENT_WEBMONEY_1_DESC', 'Zadejte své ID WebMoney');
define('MODULE_PAYMENT_WEBMONEY_2_TITLE', 'Číslo vaší peněženky R');
define('MODULE_PAYMENT_WEBMONEY_2_DESC', 'Zadejte číslo vaší peněženky R');
define('MODULE_PAYMENT_WEBMONEY_3_TITLE', 'Číslo vaší Z peněženky');
define('MODULE_PAYMENT_WEBMONEY_3_DESC', 'Zadejte číslo vaší Z peněženky');
define('MODULE_PAYMENT_WEBMONEY_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_PAYMENT_WEBMONEY_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul');

// -----------------------LODNÍ DOPRAVA!!!!!------------------- --------//

define('MODULE_SHIPPING_EXPRESS_STATUS_TITLE', 'Povolit expresní způsob dopravy');
define('MODULE_SHIPPING_EXPRESS_STATUS_DESC', 'Chcete povolit expresní způsob dopravy?');
define('MODULE_SHIPPING_EXPRESS_COST_TITLE', 'Cena');
define('MODULE_SHIPPING_EXPRESS_COST_DESC', 'Cena za tento způsob dopravy');
define('MODULE_SHIPPING_EXPRESS_TAX_CLASS_TITLE', 'Daň');
define('MODULE_SHIPPING_EXPRESS_TAX_CLASS_DESC', 'Použít daň.');
define('MODULE_SHIPPING_EXPRESS_ZONE_TITLE', 'Zóna');
define('MODULE_SHIPPING_EXPRESS_ZONE_DESC', 'Pokud je nastavena zóna, bude tento modul dostupný pouze pro zákazníky z vybrané zóny.');
define('MODULE_SHIPPING_EXPRESS_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_SHIPPING_EXPRESS_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');
define('MODULE_SHIPPING_EXPRESS_SHIPPING_PRICE_TEXT_TITLE', 'Text ceny doručení');
define('MODULE_SHIPPING_EXPRESS_SHIPPING_PRICE_TEXT_DESC', 'Pokud chcete použít cenu uvedenou v poli ceny, ponechte prázdné');

define('MODULE_SHIPPING_FLAT_STATUS_TITLE', 'Povolit Flat metodu');
define('MODULE_SHIPPING_FLAT_STATUS_DESC', 'Chcete aktivovat Flat metodu?');
define('MODULE_SHIPPING_FLAT_COST_TITLE', 'Cena');
define('MODULE_SHIPPING_FLAT_COST_DESC', 'Cena za tento způsob dopravy');
define('MODULE_SHIPPING_FLAT_TAX_CLASS_TITLE', 'Daň');
define('MODULE_SHIPPING_FLAT_TAX_CLASS_DESC', 'Použít daň.');
define('MODULE_SHIPPING_FLAT_ZONE_TITLE', 'Zóna');
define('MODULE_SHIPPING_FLAT_ZONE_DESC', 'Pokud je nastavena zóna, bude tento modul dostupný pouze pro zákazníky z vybrané zóny.');
define('MODULE_SHIPPING_FLAT_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_SHIPPING_FLAT_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');

define('MODULE_SHIPPING_FREESHIPPER_STATUS_TITLE', 'Povolit dopravu zdarma');
define('MODULE_SHIPPING_FREESHIPPER_STATUS_DESC', 'Chcete povolit dopravu zdarma?');
define('MODULE_SHIPPING_FREESHIPPER_COST_TITLE', 'Cena');
define('MODULE_SHIPPING_FREESHIPPER_COST_DESC', 'Cena za tento způsob dopravy.');
define('MODULE_SHIPPING_FREESHIPPER_TAX_CLASS_TITLE', 'Daň');
define('MODULE_SHIPPING_FREESHIPPER_TAX_CLASS_DESC', 'Použít daň.');
define('MODULE_SHIPPING_FREESHIPPER_ZONE_TITLE', 'Zóna');
define('MODULE_SHIPPING_FREESHIPPER_ZONE_DESC', 'Pokud je nastavena zóna, bude tento modul dostupný pouze pro zákazníky z vybrané zóny.');
define('MODULE_SHIPPING_FREESHIPPER_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_SHIPPING_FREESHIPPER_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');

define('MODULE_SHIPPING_ITEM_STATUS_TITLE', 'Povolit metodu podle položky');
define('MODULE_SHIPPING_ITEM_STATUS_DESC', 'Chcete povolit metodu podle položky?');
define('MODULE_SHIPPING_ITEM_COST_TITLE', 'Cena');
define('MODULE_SHIPPING_ITEM_COST_DESC', 'Cena za tento způsob dopravy bude vynásobena počtem položek v objednávce');
define('MODULE_SHIPPING_ITEM_HANDLING_TITLE', 'Cena');
define('MODULE_SHIPPING_ITEM_HANDLING_DESC', 'Cena za tento způsob dopravy.');
define('MODULE_SHIPPING_ITEM_TAX_CLASS_TITLE', 'Daň');
define('MODULE_SHIPPING_ITEM_TAX_CLASS_DESC', 'Použít daň.');
define('MODULE_SHIPPING_ITEM_ZONE_TITLE', 'Zóna');
define('MODULE_SHIPPING_ITEM_ZONE_DESC', 'Pokud je nastavena zóna, bude tento modul dostupný pouze pro zákazníky z vybrané zóny.');
define('MODULE_SHIPPING_ITEM_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_SHIPPING_ITEM_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');

define('MODULE_SHIPPING_NWPOCHTA_STATUS_TITLE', 'Povolit metodu');
define('MODULE_SHIPPING_NWPOCHTA_STATUS_DESC', 'Chcete povolit tuto metodu?');
define('MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME_TITLE', 'Název vlastního modulu');
define('MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME_DESC', 'Nechte prázdné, pokud chcete použít výchozí název modulu');
define('MODULE_SHIPPING_NWPOCHTA_COST_TITLE', 'Cena');
define('MODULE_SHIPPING_NWPOCHTA_COST_DESC', 'Cena za tento způsob dopravy.');
define('MODULE_SHIPPING_NWPOCHTA_TAX_CLASS_TITLE', 'Daň');
define('MODULE_SHIPPING_NWPOCHTA_TAX_CLASS_DESC', 'Použít daň.');
define('MODULE_SHIPPING_NWPOCHTA_ZONE_TITLE', 'Zóna');
define('MODULE_SHIPPING_NWPOCHTA_ZONE_DESC', 'Pokud je nastavena zóna, bude tento modul dostupný pouze pro zákazníky z vybrané zóny.');
define('MODULE_SHIPPING_NWPOCHTA_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_SHIPPING_NWPOCHTA_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');
define('MODULE_SHIPPING_NWPOCHTA_SHIPPING_PRICE_TEXT_TITLE', 'Text ceny doručení');
define('MODULE_SHIPPING_NWPOCHTA_SHIPPING_PRICE_TEXT_DESC', 'Pokud chcete použít cenu uvedenou v poli ceny, ponechte prázdné');

define('MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_PRICE_TEXT_TITLE', 'Text ceny doručení');
define('MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_PRICE_TEXT_DESC', 'Pokud chcete použít cenu uvedenou v poli ceny, ponechte prázdné');

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
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD_TITLE', 'Cash on delivery payment method');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD_DESC', 'Specify the payment method corresponding to the cash on delivery.');
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

define('MODULE_SHIPPING_CUSTOMSHIPPER_STATUS_TITLE', 'Povolit doručení modulu kurýrem');
define('MODULE_SHIPPING_CUSTOMSHIPPER_NAME_TITLE', 'Název modulu');
define('MODULE_SHIPPING_CUSTOMSHIPPER_WAY_TITLE', 'Popis');
define('MODULE_SHIPPING_CUSTOMSHIPPER_COST_TITLE', 'Cena');
define('MODULE_SHIPPING_CUSTOMSHIPPER_TAX_CLASS_TITLE', 'Daň');
define('MODULE_SHIPPING_CUSTOMSHIPPER_ZONE_TITLE', 'Zóna');
define('MODULE_SHIPPING_CUSTOMSHIPPER_ZONE_DESC', 'Pokud je vybrána zóna, pak bude tento dodací modul viditelný pouze pro kupující z vybrané zóny.');
define('MODULE_SHIPPING_CUSTOMSHIPPER_SORT_ORDER_TITLE', 'Pořadí řazení');

define('MODULE_SHIPPING_PERCENT_STATUS_TITLE', 'Povolit metodu procent');
define('MODULE_SHIPPING_PERCENT_STATUS_DESC', 'Chcete povolit metodu procent?');
define('MODULE_SHIPPING_PERCENT_RATE_TITLE', 'Procenta');
define('MODULE_SHIPPING_PERCENT_RATE_DESC', 'Náklady na dodání tohoto modulu jsou procentem z celkové hodnoty objednávky, hodnoty od 0,01 do 0,99');
define('MODULE_SHIPPING_PERCENT_LESS_THEN_TITLE', 'Paušální cena pro objednávky do');
define('MODULE_SHIPPING_PERCENT_LESS_THEN_DESC', 'Pevné náklady na dopravu u objednávek, náklady do zadané hodnoty.');
define('MODULE_SHIPPING_PERCENT_FLAT_USE_TITLE', 'Pevné procentuální náklady');
define('MODULE_SHIPPING_PERCENT_FLAT_USE_DESC', 'Paušální náklady na dopravu jako procento z celkové hodnoty objednávky, platné pro všechny objednávky.');
define('MODULE_SHIPPING_PERCENT_TAX_CLASS_TITLE', 'Daň');
define('MODULE_SHIPPING_PERCENT_TAX_CLASS_DESC', 'Použít daň.');
define('MODULE_SHIPPING_PERCENT_ZONE_TITLE', 'Zóna');
define('MODULE_SHIPPING_PERCENT_ZONE_DESC', 'Pokud je nastavena zóna, bude tento modul dostupný pouze pro zákazníky z vybrané zóny.');
define('MODULE_SHIPPING_PERCENT_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_SHIPPING_PERCENT_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');

define('MODULE_SHIPPING_SAT_STATUS_TITLE', 'Povolit metodu SAT');
define('MODULE_SHIPPING_SAT_STATUS_DESC', 'Chcete povolit metodu SAT?');
define('MODULE_SHIPPING_SAT_COST_TITLE', 'Cena');
define('MODULE_SHIPPING_SAT_COST_DESC', 'Cena za tento způsob dopravy.');
define('MODULE_SHIPPING_SAT_TAX_CLASS_TITLE', 'Daň');
define('MODULE_SHIPPING_SAT_TAX_CLASS_DESC', 'Použít daň.');
define('MODULE_SHIPPING_SAT_ZONE_TITLE', 'Zóna');
define('MODULE_SHIPPING_SAT_ZONE_DESC', 'Pokud je nastavena zóna, bude tento modul dostupný pouze pro zákazníky z vybrané zóny.');
define('MODULE_SHIPPING_SAT_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_SHIPPING_SAT_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');

define('MODULE_SHIPPING_TABLE_STATUS_TITLE', 'Povolit metodu tabulky');
define('MODULE_SHIPPING_TABLE_STATUS_DESC', 'Chcete povolit metodu tabulky?');
define('MODULE_SHIPPING_TABLE_COST_TITLE', 'Cena');
define('MODULE_SHIPPING_TABLE_COST_DESC', 'Náklady na dopravu se vypočítávají na základě celkové hmotnosti objednávky nebo celkových nákladů na objednávku. Například: 25: 8,50,50: 5,50 atd... To znamená, že až 25 doručení bude stát 8,50, od 25 do 50 bude stát 5,50 atd.');
define('MODULE_SHIPPING_TABLE_MODE_TITLE', 'Metoda výpočtu');
define('MODULE_SHIPPING_TABLE_MODE_DESC', 'Náklady na výpočet dodávky na základě celkové hmotnosti objednávky (váha) nebo na základě celkových nákladů na objednávku (ceny).');
define('MODULE_SHIPPING_TABLE_HANDLING_TITLE', 'Cena');
define('MODULE_SHIPPING_TABLE_HANDLING_DESC', 'Cena za tento způsob dopravy.');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_TITLE', 'Daň');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_DESC', 'Použít daň.');
define('MODULE_SHIPPING_TABLE_ZONE_TITLE', 'Zóna');
define('MODULE_SHIPPING_TABLE_ZONE_DESC', 'Pokud je nastavena zóna, bude tento modul dostupný pouze pro zákazníky z vybrané zóny.');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');

define('MODULE_SHIPPING_ZONES_STATUS_TITLE', 'Povolit metodu Zones');
define('MODULE_SHIPPING_ZONES_STATUS_DESC', 'Chcete povolit metodu zón?');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_TITLE', 'Daň');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_DESC', 'Použít daň.');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');
define('MODULE_SHIPPING_ZONES_COUNTRIES_1_TITLE', 'Země pro zónu 1');
define('MODULE_SHIPPING_ZONES_COUNTRIES_1_DESC', 'Seznam zemí oddělených čárkou pro zónu 1.');
define('MODULE_SHIPPING_ZONES_COST_1_TITLE', 'Cena dopravy pro zónu 1');
define('MODULE_SHIPPING_ZONES_COST_1_DESC', 'Cena za doručení je pro zónu 1 oddělena čárkou na základě maximální ceny objednávky. Například: 3: 8,50,7: 10,50, ... To znamená, že náklady na dopravu u objednávek o hmotnosti do 3 kg bude stát 8,50 pro kupující ze zemí 1. zóny.');
define('MODULE_SHIPPING_ZONES_HANDLING_1_TITLE', 'Cena pro zónu 1');
define('MODULE_SHIPPING_ZONES_HANDLING_1_DESC', 'Cena za použití tohoto způsobu doručení.');

// ------------------------CELKEM OBJEDNÁVKY!!!!!------------------- ---------//

define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS_TITLE', 'Povolit metodu "Související sleva"');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS_DESC', 'Chcete aktivovat "Související slevu"?');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX_TITLE', 'Zahrnout daň');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX_DESC', 'Použít daň');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX_TITLE', 'Přepočítat daň');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX_DESC', 'Přepočítat daň');

define('MODULE_ORDER_TOTAL_COUPON_STATUS_TITLE', 'Zobrazit celkový počet');
define('MODULE_ORDER_TOTAL_COUPON_STATUS_DESC', 'Chcete zobrazit nominální hodnotu kuponu?');
define('MODULE_ORDER_TOTAL_COUPON_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_ORDER_TOTAL_COUPON_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');
define('MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING_TITLE', 'Zahrnout dopravu');
define('MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING_DESC', 'Zahrnout dodávku do kalkulace.');
define('MODULE_ORDER_TOTAL_COUPON_INC_TAX_TITLE', 'Zahrnout daň.');
define('MODULE_ORDER_TOTAL_COUPON_INC_TAX_DESC', 'Zahrnout daň do výpočtu.');
define('MODULE_ORDER_TOTAL_COUPON_CALC_TAX_TITLE', 'Přepočítat daň');
define('MODULE_ORDER_TOTAL_COUPON_CALC_TAX_DESC', 'Přepočítejte daň.');
define('MODULE_ORDER_TOTAL_COUPON_TAX_CLASS_TITLE', 'Daň');
define('MODULE_ORDER_TOTAL_COUPON_TAX_CLASS_DESC', 'Použijte daň pro kupóny.');

define('MODULE_ORDER_TOTAL_GV_STATUS_TITLE', 'Zobrazit celkový počet');
define('MODULE_ORDER_TOTAL_GV_STATUS_DESC', 'Chcete ukázat hodnotu dárkového certifikátu?');
define('MODULE_ORDER_TOTAL_GV_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_ORDER_TOTAL_GV_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');
define('MODULE_ORDER_TOTAL_GV_QUEUE_TITLE', 'Aktivace certifikátu');
define('MODULE_ORDER_TOTAL_GV_QUEUE_DESC', 'Chcete ručně aktivovat zakoupené dárkové poukázky?');
define('MODULE_ORDER_TOTAL_GV_INC_SHIPPING_TITLE', 'Zahrnout dopravu');
define('MODULE_ORDER_TOTAL_GV_INC_SHIPPING_DESC', 'Zahrnout dodávku do kalkulace.');
define('MODULE_ORDER_TOTAL_GV_INC_TAX_TITLE', 'Zahrnout daň');
define('MODULE_ORDER_TOTAL_GV_INC_TAX_DESC', 'Zahrnout daň do výpočtu.');
define('MODULE_ORDER_TOTAL_GV_CALC_TAX_TITLE', 'Přepočítejte daň');
define('MODULE_ORDER_TOTAL_GV_CALC_TAX_DESC', 'Přepočítejte daň.');
define('MODULE_ORDER_TOTAL_GV_TAX_CLASS_TITLE', 'Daň');
define('MODULE_ORDER_TOTAL_GV_TAX_CLASS_DESC', 'Použít daň.');
define('MODULE_ORDER_TOTAL_GV_CREDIT_TAX_TITLE', 'Daň z certifikátu');
define('MODULE_ORDER_TOTAL_GV_CREDIT_TAX_DESC', 'Přidat daň k zakoupeným dárkovým certifikátům.');
define('MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID_TITLE', 'Stav objednávky');
define('MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID_DESC', 'Objednávky vystavené pomocí dárkového certifikátu pokrývajícího plnou cenu objednávky budou mít uvedený stav.');

define('MODULE_LEV_DISCOUNT_STATUS_TITLE', 'Zobrazit slevu');
define('MODULE_LEV_DISCOUNT_STATUS_DESC', 'Povolit slevu?');
define('MODULE_LEV_DISCOUNT_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_LEV_DISCOUNT_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');
define('MODULE_LEV_DISCOUNT_TABLE_TITLE', 'Procento slevy');
define('MODULE_LEV_DISCOUNT_TABLE_DESC', 'Nastavení cenových limitů a procent slev oddělených čárkami.');
define('MODULE_LEV_DISCOUNT_INC_SHIPPING_TITLE', 'Zahrnout dopravu');
define('MODULE_LEV_DISCOUNT_INC_SHIPPING_DESC', 'Zahrnout dodávku do kalkulace.');
define('MODULE_LEV_DISCOUNT_INC_TAX_TITLE', 'Zahrnout daň');
define('MODULE_LEV_DISCOUNT_INC_TAX_DESC', 'Zahrnout daň do výpočtu.');
define('MODULE_LEV_DISCOUNT_CALC_TAX_TITLE', 'Přepočítejte daň');
define('MODULE_LEV_DISCOUNT_CALC_TAX_DESC', 'Přepočítejte daň.');

define('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS_TITLE', 'Zobrazit nízkou cenu objednávky');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS_DESC', 'Chcete ukázat nízkou cenu objednávky?');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE_TITLE', 'Umožněte nízkou cenu objednávky');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE_DESC', 'Chceteo povolit metodu nízké ceny objednávky?');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER_TITLE', 'Nízké náklady na objednávku');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER_DESC', 'Nízké náklady na objednávky pro objednávky do zadané hodnoty.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE_TITLE', 'Poplatek');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE_DESC', 'Poplatek');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION_TITLE', 'Zahrnout poplatek do objednávky');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION_DESC', 'Zahrnout poplatek do dalších objednávek.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS_TITLE', 'Daň');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS_DESC', 'Použít daň.');

define('MODULE_PAYMENT_DISC_STATUS_TITLE', 'Povolit metodu');
define('MODULE_PAYMENT_DISC_STATUS_DESC', 'Aktivovat modul?');
define('MODULE_PAYMENT_DISC_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_PAYMENT_DISC_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');
define('MODULE_PAYMENT_DISC_PERCENTAGE_TITLE', 'Sleva');
define('MODULE_PAYMENT_DISC_PERCENTAGE_DESC', 'Minimální částka objednávky pro získání slevy.');
define('MODULE_PAYMENT_DISC_MINIMUM_TITLE', 'Minimální částka objednávky');
define('MODULE_PAYMENT_DISC_MINIMUM_DESC', 'Minimální částka objednávky pro získání slevy.');
define('MODULE_PAYMENT_DISC_TYPE_TITLE', 'Způsob platby');
define('MODULE_PAYMENT_DISC_TYPE_DESC', 'Zde musíte zadat název platebního modulu. Název můžete získat ze souboru modulu, například /includes/modules/payment/webmoney.php. Nahoře je webmoney, takže pokud chceme dát slevu za platby provedené přes WebMoney, napište webmoney než.');
define('MODULE_PAYMENT_DISC_INC_SHIPPING_TITLE', 'Zahrnout dopravu');
define('MODULE_PAYMENT_DISC_INC_SHIPPING_DESC', 'Zahrnout dodávku do výpočtu');
define('MODULE_PAYMENT_DISC_INC_TAX_TITLE', 'Zahrnout daň');
define('MODULE_PAYMENT_DISC_INC_TAX_DESC', 'Zahrnout daň do výpočtu.');
define('MODULE_PAYMENT_DISC_CALC_TAX_TITLE', 'Výpočet daně');
define('MODULE_PAYMENT_DISC_CALC_TAX_DESC', 'Zahrnout poplatek do výpočtu slevy.');

define('MODULE_QTY_DISCOUNT_STATUS_TITLE', 'Zobrazit slevu v závislosti na množství');
define('MODULE_QTY_DISCOUNT_STATUS_DESC', 'Chcete povolit slevu v závislosti na množství?');
define('MODULE_QTY_DISCOUNT_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_QTY_DISCOUNT_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');
define('MODULE_QTY_DISCOUNT_RATE_TYPE_TITLE', 'Typ slevy');
define('MODULE_QTY_DISCOUNT_RATE_TYPE_DESC', 'Vyberte typ slevy - procentuální nebo paušální sazba');
define('MODULE_QTY_DISCOUNT_RATES_TITLE', 'Sleva');
define('MODULE_QTY_DISCOUNT_RATES_DESC', 'Sleva je založena na celkovém počtu jednotek objednaného zboží. Například 10:5, 20:10 a tak dále ... To znamená, že při objednání 10 nebo více jednotek zboží kupující získává slevu 5 % nebo 5 USD; 20 jednotek nebo více – 10 % nebo 10 USD, v závislosti na typu');
define('MODULE_QTY_DISCOUNT_INC_SHIPPING_TITLE', 'Zahrnout dopravu');
define('MODULE_QTY_DISCOUNT_INC_SHIPPING_DESC', 'Zahrnout dodávku do kalkulace.');
define('MODULE_QTY_DISCOUNT_INC_TAX_TITLE', 'Zahrnout daň');
define('MODULE_QTY_DISCOUNT_INC_TAX_DESC', 'Zahrnout daň do výpočtu.');
define('MODULE_QTY_DISCOUNT_CALC_TAX_TITLE', 'Přepočítat daň');
define('MODULE_QTY_DISCOUNT_CALC_TAX_DESC', 'Přepočítejte daň.');

define('MODULE_ORDER_TOTAL_SHIPPING_STATUS_TITLE', 'Zobrazit doručení');
define('MODULE_ORDER_TOTAL_SHIPPING_STATUS_DESC', 'Chcete zobrazit cenu doručení?');
define('MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_TITLE', 'Povolit bezplatné doručení');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_DESC', 'Chcete povolit doručení zdarma?');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_TITLE', 'Doručení zdarma pro objednávky po');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_DESC', 'U objednávek nad určitou hodnotu bude doručení zdarma..');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_TITLE', 'Doručení zdarma pro objednávky');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_DESC', 'Určete objednávky dopravy zdarma.');

define('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS_TITLE', 'Zobrazit cenu položky');
define('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS_DESC', 'Chcete zobrazit cenu položky?');
define('MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');

define('MODULE_ORDER_TOTAL_TAX_STATUS_TITLE', 'Zobrazit daň');
define('MODULE_ORDER_TOTAL_TAX_STATUS_DESC', 'Chcete zobrazit daň?');
define('MODULE_ORDER_TOTAL_TAX_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_ORDER_TOTAL_TAX_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');

define('MODULE_ORDER_TOTAL_TOTAL_STATUS_TITLE', 'Zobrazit celkem');
define('MODULE_ORDER_TOTAL_TOTAL_STATUS_DESC', 'Udělejtechcete zobrazit celkovou cenu objednávky?');
define('MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER_TITLE', 'Pořadí řazení');
define('MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER_DESC', 'Zadejte pořadí řazení pro tento modul.');

define('SHIPPING_TAB_TITLE', 'Doprava');
define('SHIPPING_TO_PAYMENT_TAB_TITLE', 'Zaslání na zaplacení');
define('SHIPPING_TO_FIELDS_TAB_TITLE', 'Doručit do polí');
define('SHIPPING_UPDATE_WAREHOUSES_TITLE', 'Aktualizace skladů');

define('SHIPPING_UPDATE_AREAS_TITLE', 'Update areas');
define('SHIPPING_UPDATE_CITIES_TITLE', 'Update cities');
define('SHIPPING_UPDATE_REFERENCES_TITLE', 'Update directories');

?>