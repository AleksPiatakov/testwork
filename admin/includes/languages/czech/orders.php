<?php
/*
  $Id: orders.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Objednávky');
define('HEADING_TITLE_SEARCH', 'ID objednávky:');
define('HEADING_TITLE_STATUS', 'Status');

define('TABLE_HEADING_COMMENTS', 'Komentáře');
define('TABLE_HEADING_CUSTOMERS', 'Zákazníci');
define('TABLE_HEADING_ORDER_TOTAL', 'Celkem objednávky');
define('TABLE_HEADING_DATE_PURCHASED', 'Datum nákupu');
define('TABLE_HEADING_STATUS', 'Stav');
define('TABLE_HEADING_ACTION', 'Akce');
define('TABLE_HEADING_QUANTITY', 'Množství.');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Produkty');
define('TABLE_HEADING_TAX', 'Daň');
define('TABLE_HEADING_TOTAL', 'Celkem');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Cena (ex)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Cena (včetně)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Celkem (ex)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Celkem (včetně)');

define('TABLE_HEADING_DATE_ADDED', 'Datum přidání');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Zákazník upozorněn');

define('ENTRY_CUSTOMER', 'Zákazník:');
define('ENTRY_SOLD_TO', 'SOLD TO:');
define('ENTRY_DELIVERY_TO', 'Doručení:');
define('VSTUP_DO_DO', 'ODESLATE DO:');
define('ENTRY_SHIPPING_ADDRESS', 'Dodací adresa:');
define('ENTRY_BILLING_ADDRESS', 'Fakturační adresa:');
define('ENTRY_BILLING', 'Fakturace:');
define('ENTRY_PAYMENT_METHOD', 'Platební metoda:');
define('ENTRY_CREDIT_CARD_TYPE', 'Typ kreditní karty:');
define('ENTRY_CREDIT_CARD_OWNER', 'Vlastník kreditní karty:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Číslo kreditní karty:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Platnost kreditní karty vyprší:');
define('ENTRY_SUB_TOTAL', 'Mezisoučet:');
define('VSTUP_TAX', 'Daň:');
define('ENTRY_SHIPPING', 'Doprava:');
define('ENTRY_TOTAL', 'Celkem:');
define('ENTRY_DATE_PURCHASED', 'Datum nákupu:');
define('ENTRY_STATUS', 'Stav:');
define('ENTRY_DATE_LAST_UPDATED', 'Datum poslední aktualizace:');
define('ENTRY_NOTIFY_CUSTOMER', 'Upozornit zákazníka:');
define('ENTRY_NOTIFY_CUSTOMER_EMAIL', 'Upozornit zákazníka e-mailem? ');
define('ENTRY_NOTIFY_COMMENTS', 'Přidat komentáře:');
define('ENTRY_PRINTABLE', 'Tisk faktury');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Smazat objednávku');
define('TEXT_INFO_DELETE_INTRO', 'Opravdu chcete smazat tuto objednávku?');
define('TEXT_INFO_DELETE_DATA', 'Jméno zákazníka ');
define('TEXT_INFO_DELETE_DATA_OID', 'Číslo objednávky ');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Dodat množství produktu');
define('TEXT_DATE_ORDER_CREATED', 'Datum vytvoření:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Poslední úprava:');
define('TEXT_INFO_PAYMENT_METHOD', 'Platební metoda:');

define('TEXT_ALL_ORDERS', 'Všechny objednávky');
define('TEXT_NEW_CUSTOMER', 'Nový zákazník');
define('TEXT_EXIST_CUSTOMER', 'Existující zákazník');
define('TEXT_NO_ORDER_HISTORY', 'Žádná historie objednávek není k dispozici');

define('EMAIL_SEPARATOR', '------------------------------------------- -----------');
define('EMAIL_TEXT_SUBJECT', 'Aktualizace objednávky');
define('EMAIL_TEXT_ORDER_NUMBER', 'Číslo objednávky:');
define('EMAIL_TEXT_INVOICE_URL', 'Podrobná faktura:');
define('EMAIL_TEXT_DATE_ORDERED', 'Datum objednávky:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Vaše objednávka byla aktualizována na následující stav.' . "\n\n" . 'Nový stav: %s' . "\n\n" . 'Pokud máte, odpovězte na tento e-mail nějaké otázky.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Komentáře k vaší objednávce jsou' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Chyba: Objednávka neexistuje.');
define('SUCCESS_ORDER_UPDATED', 'Úspěch: Objednávka byla úspěšně aktualizována.');
define('WARNING_ORDER_NOT_UPDATED', 'Upozornění: Není co měnit. Objednávka nebyla aktualizována.');
// denuz
define('TABLE_HEADING_ORDER_NETTO', 'Netto');
define('TABLE_HEADING_ORDER_NUMBER', 'Nejmr');
define('TABLE_HEADING_ORDER_MARJA', 'Маржа');
define('TITLE_ORDER_NETTO', 'Netto:');
define('TITLE_ORDER_MARJA', 'Маржа:');
define('TEXT_TOTAL', 'Celkem: ');
define('TEXT_NETTO', 'Netto: ');
define('TEXT_MARJA', 'Маржа: ');
// eof denuz
define('EMAIL_TEXT_CUSTOMER_NAME', 'Zákazník:');
define('EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS', 'E-mail:');
define('EMAIL_TEXT_CUSTOMER_TELEPHONE', 'Telefon:');
define('EMAIL_ACC_DISCOUNT_INTRO_OWNER', 'Jeden z vašich zákazníků dosáhl limitu akumulovaných slev. ' . "\n\n" . 'Podrobnosti:');
define('EMAIL_TEXT_LIMIT', 'Akumulovaná sleva: ');
define('EMAIL_TEXT_CURRENT_GROUP', 'Nová skupina: ');
define('EMAIL_TEXT_DISCOUNT', 'Sleva: ');
define('EMAIL_ACC_SUBJECT', 'Akumulovaná sleva');
define('EMAIL_ACC_INTRO_CUSTOMER', 'Blahopřejeme, máte novou slevu. Všechny podrobnosti níže:');
define('EMAIL_ACC_FOOTER', 'Nyní můžete nakupovat s vaší novou diskontní sazbou.');

define('TEXT_REFERER', 'Referer: ');
define('TEXT_ORDER_DELETE', 'Smazat objednávky: ');

define('TEXT_OR_NAL', 'Hotovost');
define('TEXT_OR_BNAL', 'Banka');
define('TEXT_OR_PRIVAT', 'Jiné');
define('TEXT_OR_NALOZH', 'c.o.d.');
define('TEXT_OR_FROM', 'from');
define('TEXT_OR_TO', 'to');
define('TEXT_OR_CLEAR', 'vymazat filtr');
define('TEXT_OR_TOTAL', 'Celkem');
define('TEXT_OR_DATE', 'Datum doručení');
define('TEXT_OR_COURIER', 'Kurier');
define('TEXT_OR_STATUS', 'Stav');
define('TEXT_OR_PAYMENT', 'Způsob platby');
define('TEXT_OR_ACTION', 'Akce');
define('ENTRY_CUSTOMERS', 'Klient:');
define('ENTRY_DELIVERY', 'Adresa:');
define('ENTRY_INFO', 'Info:');
define('ENTRY_CREATE_ORDER', 'Vytvořit objednávku');

//nové objednávky
define('TEXT_NEW_ORDER', 'Nová objednávka');
define('TEXT_SELECT_CUST', 'Vyberte zákazníka');
define('TEXT_SELECT_CUST_PLACEHOLDER', 'Zadejte ID nebo Jméno nebo Příjmení');
define('TEXT_FIRST_NAME', 'Jméno');
define('TEXT_LAST_NAME', 'Příjmení');
define('TEXT_GROUPS_NAME', 'Název skupiny');
define('TEXT_EMAIL', 'E-mail');
define('TEXT_PHONE', 'Telefon');
define('TEXT_FAX', 'Fax');
define('TEXT_FIRM', 'Název společnosti');
define('TEXT_ADDRESS', 'Adresa');
define('TEXT_ADDRESS_BOOK', 'Adresář');
define('TEXT_SUBURB', 'Oblast');
define('TEXT_POSTCODE', 'Index');
define('TEXT_CITY', 'Město');
define('TEXT_ZONE', 'Region');
define('TEXT_COUNTRY', 'Země');
define('TEXT_OP_PRICE', 'Cena');
define('TEXT_OP_TAX', 'Daň');
define('TEXT_OP_SHIPPING', 'Doprava');
define('TEXT_OP_TOTAL', 'Celková cena');
define('TEXT_CURRENCY', 'Měna:');
define('TEXT_CURRENCY_VALUE', 'Sazba');
define('TEXT_EDIT_ORDER', 'Upravit objednávku');
?>