<?php
/*
  $Id: orders.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Lista zamówień');
define('HEADING_TITLE_SEARCH', 'Szukaj wg ID zamówienia');
define('HEADING_TITLE_STATUS', 'Status:');

define('TABLE_HEADING_COMMENTS', 'Komentarz');
define('TABLE_HEADING_CUSTOMERS', 'Klienci');
define('TABLE_HEADING_ORDER_TOTAL', 'Łączne zamówienia');
define('TABLE_HEADING_DATE_PURCHASED', 'Data zakupu');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Działanie');
define('TABLE_HEADING_QUANTITY', 'Ilość');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Kod produktu');
define('TABLE_HEADING_PRODUCTS', 'Produkty');
define('TABLE_HEADING_TAX', 'Podatek');
define('TABLE_HEADING_TOTAL', 'Razem');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Cena (netto)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Cena');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Łączna (netto)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Łączna');
define('TEXT_NEW_CUSTOMER', 'Nowy klient');
define('TEXT_EXIST_CUSTOMER', 'Istniejący klient');

define('TABLE_HEADING_DATE_ADDED', 'Data dodania');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Klient powiadomiony');
define('ENTRY_NOTIFY_CUSTOMER_EMAIL', 'Powiadomić klienta przez e-mail? ');

define('ENTRY_CUSTOMER', 'Klient:');
define('ENTRY_SOLD_TO', 'KLIENT:');
define('ENTRY_DELIVERY_TO', 'Adres:');
define('ENTRY_SHIP_TO', 'Adres DOSTAWY:');
define('ENTRY_SHIPPING_ADDRESS', 'Adres dostawy:');
define('ENTRY_BILLING_ADDRESS', 'Adres kupującego:');
define('ENTRY_PAYMENT_METHOD', 'Sposób Płatności:');
define('ENTRY_CREDIT_CARD_TYPE', 'Typ Karty Płatniczej:');
define('ENTRY_CREDIT_CARD_OWNER', 'Właściciel Karty Płatniczej:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Numer Karty Płatniczej:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Data ważności Karty Płatniczej:');
define('ENTRY_SUB_TOTAL', 'Wstępne Podsumowanie:');
define('ENTRY_TAX', 'Podatek:');
define('ENTRY_SHIPPING', 'Dostawa:');
define('ENTRY_TOTAL', 'Łącznie:');
define('ENTRY_DATE_PURCHASED', 'Data zakupu:');
define('ENTRY_STATUS', 'Status:');
define('ENTRY_DATE_LAST_UPDATED', 'Ostatnia zmiana:');
define('ENTRY_NOTIFY_CUSTOMER', 'Powiadomić Klienta:'); 
define('ENTRY_NOTIFY_COMMENTS', 'Dodaj komentarz:');
define('ENTRY_PRINTABLE', 'Wydrukuj rachunek');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Usuń Zamówienie');
define('TEXT_INFO_DELETE_INTRO', 'Czy na pewno chcesz usunąć to zamówienie?');
define('TEXT_INFO_DELETE_DATA', 'Klient:');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Policz ilość towaru na magazynie');
define('TEXT_INFO_DELETE_DATA_OID', 'Numer zamówienia:');
define('TEXT_DATE_ORDER_CREATED', 'Data Utworzenia:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Ostatnie Zmiany:');
define('TEXT_INFO_PAYMENT_METHOD', 'Sposób Płatności:');

define('TEXT_ALL_ORDERS', 'Wszystkie Zamówienia');
define('TEXT_NO_ORDER_HISTORY', 'Brak historii zamówienia');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Status Twojego zamówienia został zmieniony');
define('EMAIL_TEXT_ORDER_NUMBER', 'Numer zamówienia:');
define('EMAIL_TEXT_INVOICE_URL', 'Informacje o zamówieniu:');
define('EMAIL_TEXT_DATE_ORDERED', 'Data zamówienia:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Status Twojego zamówienia został zmieniony.' . "\n\n" . 'Nowy status: %s' . "\n\n" . 'Jeśli Masz jakieś pytania, zapytaj nas.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Komentarze do zamówienia' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Błąd: zamówienie nie istnieje.');
define('SUCCESS_ORDER_UPDATED', 'Gotowe: zamówienie zostało pomyślnie zaktualizowane.');
define('WARNING_ORDER_NOT_UPDATED', 'Uwaga: nie ma nic do zmiany. Zamówienie NIE zaktualizowane.');
// denuz
define('TABLE_HEADING_ORDER_NETTO', 'Netto');
define('TABLE_HEADING_ORDER_NUMBER', 'Numer');
define('TABLE_HEADING_ORDER_MARJA', 'Marża');
define('TITLE_ORDER_NETTO', 'Netto:');
define('TITLE_ORDER_MARJA', 'Marża:');
define('TEXT_TOTAL', 'Łącznie: ');
define('TEXT_NETTO', 'Netto: ');
define('TEXT_MARJA', 'Marża: ');
// eof denuz
define('EMAIL_TEXT_CUSTOMER_NAME', 'Klient:');
define('EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS', 'Email:');
define('EMAIL_TEXT_CUSTOMER_TELEPHONE', 'Numer telefonu:');
define('EMAIL_ACC_DISCOUNT_INTRO_OWNER', 'Jeden z Twoich klientów osiągnął limit rabatu kumulacyjnego i został przeniesiony do nowej grupy. ' . "\n\n" . 'Szczegóły:');
define('EMAIL_TEXT_LIMIT', 'Osiągnięty limit: ');
define('EMAIL_TEXT_CURRENT_GROUP', 'Nowa grupa: ');
define('EMAIL_TEXT_DISCOUNT', 'Nowy rabat: ');
define('EMAIL_ACC_SUBJECT', 'Rabat kumulacyjny');
define('EMAIL_ACC_INTRO_CUSTOMER', 'Gratulacje, otrzymałeś nowy skumulowany rabat. Wszystkie szczegóły poniżej:');
define('EMAIL_ACC_FOOTER', 'Jeżeli masz jakiekolwiek pytania, odpowiedz na ten e-mail..');

define('TEXT_REFERER', 'Skąd przyszedł: ');
define('TEXT_ORDER_DELETE', 'Usuń: ');

define('TEXT_OR_NAL', 'Gotówka');
define('TEXT_OR_BNAL', 'Płatność bezgotówkowa');
define('TEXT_OR_PRIVAT', 'PrivatBank');
define('TEXT_OR_NALOZH', 'Za pobraniem');
define('TEXT_OR_FROM', 'od');
define('TEXT_OR_TO', 'do');
define('TEXT_OR_CLEAR', 'wyczyść filtr');
define('TEXT_OR_TOTAL', 'Łącznie');
define('TEXT_OR_DATE', 'Data dostawy');
define('TEXT_OR_COURIER', 'Kurier');
define('TEXT_OR_STATUS', 'Status zamówienia');
define('TEXT_OR_PAYMENT', 'Sposób płatności');
define('TEXT_OR_ACTION', 'Działanie');
define('ENTRY_CUSTOMERS', 'Klient:');
define('ENTRY_DELIVERY', 'Adres:');
define('ENTRY_INFO', 'Informacje:');
define('ENTRY_CREATE_ORDER', 'Utwórz zamówienie');


//new orders
define('TEXT_NEW_ORDER', 'Nowe zamówienie');
define('TEXT_SELECT_CUST', 'Wybierz klienta');
define('TEXT_SELECT_CUST_PLACEHOLDER', 'Wpisz ID lub Imię lub Nazwisko');
define('TEXT_ADDRESS_BOOK', 'Address book');
define('TEXT_FIRST_NAME', 'Imię');
define('TEXT_LAST_NAME', 'Nazwisko');
define('TEXT_GROUPS_NAME', 'Członek grupy');
define('TEXT_EMAIL', 'Email');
define('TEXT_PHONE', 'Numer telefonu');
define('TEXT_FAX', 'Fax');
define('TEXT_FIRM', 'Nazwa Firmy');
define('TEXT_ADDRESS', 'Adres');
define('TEXT_SUBURB', 'Dzielnica');
define('TEXT_POSTCODE', 'Kod pocztowy');
define('TEXT_CITY', 'Miasto');
define('TEXT_ZONE', 'Województwo');
define('TEXT_COUNTRY', 'Kraj');
define('TEXT_OP_PRICE', 'Cena produktu');
define('TEXT_OP_TAX', 'Podatek');
define('TEXT_OP_SHIPPING', 'Dostawa');
define('TEXT_OP_TOTAL', 'Koszt zamówienia');
define('TEXT_EDIT_ORDER', 'Edytować zamówienie');
define('TEXT_CURRENCY', 'Waluta:');
define('TEXT_CURRENCY_VALUE', 'Wskaźnik');


define('ENTRY_BILLING', 'Dane do faktury:');
