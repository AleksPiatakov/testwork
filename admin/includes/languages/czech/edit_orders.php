<?php
/*
  $Id: edit_orders.php,v 1.72 2003/08/07 00:28:44 jwh Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Upravit objednávku');
define('HEADING_TITLE_NUMBER', 'Ne.');
define('HEADING_TITLE_DATE', 'z');
define('HEADING_SUBTITLE', 'Upravte prosím všechny části podle potřeby a klikněte na tlačítko "Aktualizovat" níže.');
define('HEADING_TITLE_SEARCH', 'ID objednávky:');
define('HEADING_TITLE_STATUS', 'Stav:');
define('ADDING_TITLE', 'Přidat produkt k této objednávce');

define('HINT_UPDATE_TO_CC', '<font color="#FF0000">Tip: </font>Nastavte platbu na "Kreditní karta", aby se zobrazila některá další pole.');
define('HINT_DELETE_POSITION', '<font color="#FF0000">Nápověda: </font>Chcete-li odstranit produkt, nastavte jeho množství na "0".');
define('HINT_TOTALS', '<font color="#FF0000">Tip: </font>Neváhejte poskytnout slevy přidáním záporných částek do seznamu.<br>Pole s hodnotami "0" se při aktualizaci objednávky smažou (výjimka: doprava).');
define('HINT_PRESS_UPDATE', 'Prosím, klikněte na "Aktualizovat" pro uložení všech výše provedených změn.');

define('TABLE_HEADING_COMMENTS', 'Komentář');
define('TABLE_HEADING_CUSTOMERS', 'Zákazníci');
define('TABLE_HEADING_ORDER_TOTAL', 'Celkový počet objednávek');
define('TABLE_HEADING_DATE_PURCHASED', 'Datum objednávky');
define('TABLE_HEADING_DELETE', 'Smazat');
define('TABLE_HEADING_STATUS', 'Nový stav');
define('TABLE_HEADING_ACTION', 'Akce');
define('TABLE_HEADING_QUANTITY', 'Množství');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Produkt');
define('TABLE_HEADING_TAX', 'Daň %');
define('TABLE_HEADING_TOTAL', 'Celkem');
define('TABLE_HEADING_UNIT_PRICE', 'Cena (bez)');
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Cena (včetně)');
define('TABLE_HEADING_TOTAL_PRICE', 'Celkem (mimo)');
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Celkem (včetně)');
define('TABLE_HEADING_TOTAL_MODULE', 'Složka celkové ceny');
define('TABLE_HEADING_TOTAL_AMOUNT', 'Částka');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Zákazník upozorněn');
define('TABLE_HEADING_DATE_ADDED', 'Datum vstupu');

define('ENTRY_CUSTOMER', 'Obecný zákazník');
define('ENTRY_CUSTOMER_NAME', 'Jméno');
define('ENTRY_CUSTOMER_COMPANY', 'Společnost');
define('ENTRY_CUSTOMER_ADDRESS', 'Adresa zákazníka');
define('ENTRY_ADDRESS', 'Adresa');
define('ENTRY_CUSTOMER_SUBURB', 'Předměstí');
define('ENTRY_CUSTOMER_CITY', 'Město');
define('ENTRY_CUSTOMER_STATE', 'Stát');
define('ENTRY_CUSTOMER_POSTCODE', 'PSČ');
define('ENTRY_CUSTOMER_COUNTRY', 'Země');
define('ENTRY_CUSTOMER_PHONE', 'Telefon');
define('ENTRY_CUSTOMER_FAX', 'Fax');
define('ENTRY_CUSTOMER_EMAIL', 'E-mail');

define('ENTRY_SOLD_TO', 'Prodáno:');
define('ENTRY_DELIVERY_TO', 'Doručení do:');
define('ENTRY_SHIP_TO', 'Doprava do:');
define('ENTRY_SHIPPING_ADDRESS', 'Dodací adresa');
define('ENTRY_BILLING_ADDRESS', 'Fakturační adresa');
define('ENTRY_PAYMENT_METHOD', 'Platební metoda:');
define('ENTRY_CREDIT_CARD_TYPE', 'Typ karty:');
define('ENTRY_CREDIT_CARD_OWNER', 'Vlastník karty:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Číslo karty:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Platnost karty vyprší:');
define('ENTRY_SUB_TOTAL', 'Mezisoučet:');
define('VSTUP_TAX', 'Daň:');
define('ENTRY_SHIPPING', 'Doprava:');
define('ENTRY_TOTAL', 'Celkem:');
define('ENTRY_NEW_TOTAL', 'Přidat pole:');
define('ENTRY_DATE_PURCHASED', 'Datum nákupu:');
define('ENTRY_STATUS', 'Stav objednávky:');
define('ENTRY_DATE_LAST_UPDATED', 'poslední aktualizace:');
define('ENTRY_NOTIFY_CUSTOMER', 'Upozornit zákazníka:');
define('ENTRY_NOTIFY_COMMENTS', 'Odeslat komentáře:');
define('ENTRY_PRINTABLE', 'Tisk faktury');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Smazat objednávku');
define('TEXT_INFO_DELETE_INTRO', 'Opravdu bude tato objednávka smazána?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Upravit množství');
define('TEXT_DATE_ORDER_CREATED', 'Vytvořeno:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Poslední aktualizace:');
define('TEXT_DATE_ORDER_ADDNEW', 'Přidat nový produkt');
define('TEXT_INFO_PAYMENT_METHOD', 'Platební metoda:');

define('TEXT_ALL_ORDERS', 'Všechny objednávky');
define('TEXT_NO_ORDER_HISTORY', 'Nenalezena žádná objednávka');

define('EMAIL_SEPARATOR', '------------------------------------------- -----------');
define('EMAIL_TEXT_SUBJECT', 'Vaše objednávka byla aktualizována');
define('EMAIL_TEXT_ORDER_NUMBER', 'Číslo objednávky:');
define('EMAIL_TEXT_INVOICE_URL', 'Podrobná adresa URL faktury:');
define('EMAIL_TEXT_DATE_ORDERED', 'Datum objednávky:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Mockrát děkujeme za vaši objednávku u nás!' . "\n\n" . 'Stav vaší objednávky byl aktualizován.' . "\n\n" . 'Nový stav: % s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', 'Máte-li dotazy, odpovězte prosím na tento e-mail.' . "\n\n" . 'S pozdravem od vašich přátel v ' . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Zde jsou komentáře k vaší objednávce:' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Chyba: Žádná taková objednávka.');
define('SUCCESS_ORDER_UPDATED', 'Completed: Objednávka byla úspěšně aktualizována.');
define('WARNING_ORDER_NOT_UPDATED', 'Pozor: Nebyly provedeny žádné změny.');

define('ADDPRODUCT_TEXT_CATEGORY_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_PRODUCT', 'Vyberte produkt');
define('ADDPRODUCT_TEXT_PRODUCT_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_OPTIONS', 'Vyberte možnost');
define('ADDPRODUCT_TEXT_OPTIONS_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_OPTIONS_NOTEXIST', 'Produkt nemá žádné možnosti, takže přeskakování...');
define('ADDPRODUCT_TEXT_CONFIRM_QUANTITY', 'kusy tohoto produktu');
define('ADDPRODUCT_TEXT_CONFIRM_ADDNOW', 'Přidat');
define('ADDPRODUCT_TEXT_STEP', 'Krok');
define('ADDPRODUCT_TEXT_STEP1', ' &laquo; Vyberte katalog. ');
define('ADDPRODUCT_TEXT_STEP2', ' &laquo; Vyberte produkt. ');
define('ADDPRODUCT_TEXT_STEP3', ' &laquo; Vyberte možnost. ');

define('MENUE_TITLE_CUSTOMER', '1. Zákaznická data');
define('MENUE_TITLE_PAYMENT', '2. Způsob platby');
define('MENUE_TITLE_ORDER', '3. Objednané produkty');
define('MENUE_TITLE_TOTAL', '4. Sleva, doprava a celkem');
define('MENUE_TITLE_STATUS', '5. Stav a upozornění');
define('MENUE_TITLE_UPDATE', '6. Aktualizace dat');

define('EMAIL_ACC_DISCOUNT_INTRO_OWNER', 'Jeden z vašich zákazníků dosáhl limitu akumulovaných slev. ' . "\n\n" . 'Podrobnosti:');
define('EMAIL_TEXT_LIMIT', 'Akumulovaná sleva: ');
define('EMAIL_TEXT_CURRENT_GROUP', 'Nová skupina: ');
define('EMAIL_TEXT_DISCOUNT', 'Sleva: ');
define('EMAIL_ACC_SUBJECT', 'Akumulovaná sleva');
define('EMAIL_ACC_INTRO_CUSTOMER', 'Blahopřejeme, máte novou slevu. Všechny podrobnosti níže:');
define('EMAIL_ACC_FOOTER', 'Nyní můžete nakupovat s vaší novou diskontní sazbou.');

define('EMAIL_TEXT_CUSTOMER_NAME', 'Zákazník:');
define('EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS', 'E-mail:');
define('EMAIL_TEXT_CUSTOMER_TELEPHONE', 'Telefon:');

define('TEXT_ORDER_COMMENTS', 'Komentáře k objednávce');
define('TEXT_PRODUCT_NAME_PLACEHOLDER', 'Zadejte název produktu');

//Knoflík
define('BUTTON_BACK_NEW', 'zpět');
?>