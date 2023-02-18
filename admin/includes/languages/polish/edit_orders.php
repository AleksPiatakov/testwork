<?php
/*
  $Id: edit_orders.php,v 1.72 2003/08/07 00:28:44 jwh Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  
  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Edycja zamówienia');
define('HEADING_TITLE_NUMBER', 'numer');
define('HEADING_TITLE_DATE', 'od');
define('HEADING_SUBTITLE', 'Po zmianie danych w zamówieniu nie zapomnij kliknąć przycisku "Aktualizuj", aby zapisać zmiany.');
define('HEADING_TITLE_SEARCH', 'Kod zamówienia:');
define('HEADING_TITLE_STATUS', 'Status:');
define('ADDING_TITLE', 'Dodaj element do zamówienia');

define('HINT_UPDATE_TO_CC', '<font color="#FF0000">Wskazówka: </font>Ustaw metodę płatności "Karta kredytowa", aby uzyskać więcej informacji o płatności.');
define('HINT_DELETE_POSITION', '<font color="#FF0000">Wskazówka: </font>Aby usunąć produkt z zamówienia, ustaw ilość "0" przed żądanym produktem.');
define('HINT_TOTALS', '');
//define('HINT_TOTALS', '<font color="#FF0000">Hint: </font>Feel free to give discounts by adding negative amounts to the list.<br>Fields with "0" values are deleted when updating the order (exception: shipping).');
define('HINT_PRESS_UPDATE', 'Nie zapomnij kliknąć przycisku "Aktualizuj", aby zapisać zmiany.');

define('TABLE_HEADING_COMMENTS', 'Komentarz');
define('TABLE_HEADING_CUSTOMERS', 'Kupujący');
define('TABLE_HEADING_ORDER_TOTAL', 'Razem');
define('TABLE_HEADING_DATE_PURCHASED', 'Data zamówienia');
define('TABLE_HEADING_DELETE', 'Usuń');
define('TABLE_HEADING_STATUS', 'Nowy status');
define('TABLE_HEADING_ACTION', 'Działanie');
define('TABLE_HEADING_QUANTITY', 'Ilość');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Kod');
define('TABLE_HEADING_PRODUCTS', 'Produkt');
define('TABLE_HEADING_TAX', 'Podatek %');
define('TABLE_HEADING_TOTAL', 'Razem');
define('TABLE_HEADING_UNIT_PRICE', 'Koszt (bez podatku)');
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Koszt (z podatkiem)');
define('TABLE_HEADING_TOTAL_PRICE', 'Razem (bez podatku)');
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Razem (z podatkiem)');
define('TABLE_HEADING_TOTAL_MODULE', 'Całkowita wartość zamówienia');
define('TABLE_HEADING_TOTAL_AMOUNT', 'Suma');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Kupujący został powiadomiony');
define('TABLE_HEADING_DATE_ADDED', 'Data');

define('ENTRY_CUSTOMER', 'Kupujący');
define('ENTRY_CUSTOMER_NAME', 'Imię');
define('ENTRY_CUSTOMER_COMPANY', 'Firma');
define('ENTRY_CUSTOMER_ADDRESS', 'Adres kupującego');
define('ENTRY_SEARCH_CLIENT', 'Szukaj według imienia, nazwiska lub identyfikatora klienta.');
define('ENTRY_ADDRESS', 'Adres');
define('ENTRY_CUSTOMER_SUBURB', 'Dzielnica');
define('ENTRY_CUSTOMER_CITY', 'Miasto');
define('ENTRY_CUSTOMER_STATE', 'Gmina');
define('ENTRY_CUSTOMER_POSTCODE', 'Kod pocztowy');
define('ENTRY_CUSTOMER_COUNTRY', 'Kraj');
define('ENTRY_CUSTOMER_PHONE', 'Telefon');
define('ENTRY_CUSTOMER_FAX', 'Fax');
define('ENTRY_CUSTOMER_EMAIL', 'E-Mail');

define('ENTRY_SOLD_TO', 'Kupujący:');
define('ENTRY_DELIVERY_TO', 'Dostawa:');
define('ENTRY_SHIP_TO', 'Adres dostawy:');
define('ENTRY_SHIPPING_ADDRESS', 'Adres dostawy');
define('ENTRY_BILLING_ADDRESS', 'Adres kupującego');
define('ENTRY_PAYMENT_METHOD', 'Sposób płatności:');
define('ENTRY_CREDIT_CARD_TYPE', 'Rodzaj karty:');
define('ENTRY_CREDIT_CARD_OWNER', 'Właściciel karty:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Numer karty:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Ważny do:');
define('ENTRY_SUB_TOTAL', 'Koszt produktów:');
define('ENTRY_TAX', 'Podatek:');
define('ENTRY_SHIPPING', 'Dostawa:');
define('ENTRY_NEW_TOTAL', 'Dodaj pole:');
define('ENTRY_TOTAL', 'Razem:');
define('ENTRY_DATE_PURCHASED', 'Data zakupu:');
define('ENTRY_STATUS', 'Status zamówienia:');
define('ENTRY_DATE_LAST_UPDATED', 'Ostatnia aktualizacja:');
define('ENTRY_NOTIFY_CUSTOMER', 'Powiadom kupującego:');
define('ENTRY_NOTIFY_COMMENTS', 'Dodaj komentarz:');
define('ENTRY_PRINTABLE', 'Wydrukować rachunek');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Usuń zamówienie');
define('TEXT_INFO_DELETE_INTRO', 'Czy na pewno chcesz usunąć to zamówienie?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Przelicz ilość');
define('TEXT_DATE_ORDER_CREATED', 'Data utworzenia zamówienia:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Ostatnia modyfikacja:');
define('TEXT_DATE_ORDER_ADDNEW', 'Dodaj nowy produkt');
define('TEXT_INFO_PAYMENT_METHOD', 'Sposób płatności:');

define('TEXT_ALL_ORDERS', 'Zamówień łącznie ');
define('TEXT_NO_ORDER_HISTORY', 'Zamówienie nie zostało znalezione');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Twoje zamówienie zostało zaktualizowane');
define('EMAIL_TEXT_ORDER_NUMBER', 'Numer zamówienia:');
define('EMAIL_TEXT_INVOICE_URL', 'Szczegóły zamówienia:');
define('EMAIL_TEXT_DATE_ORDERED', 'Data zamówienia:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Dziękuję za twoje zamówienie!' . "\n\n" . 'Status Twojego zamówienia został zmieniony.' . "\n\n" . 'Nowy status: %s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', 'Jeśli masz jakiekolwiek pytania, wyślij nam e-mail.' . "\n\n" . 'Z szacunkiem, ' . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Komentarze do twojego zamówienia:' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Błąd: zamówienie nie zostało znalezione.');
define('SUCCESS_ORDER_UPDATED', 'Pomyślnie: zamówienie zostało pomyślnie zaktualizowane.');
define('WARNING_ORDER_NOT_UPDATED', 'Ostrzeżenie: nie wprowadzono żadnych zmian.');

define('ADDPRODUCT_TEXT_CATEGORY_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_PRODUCT', 'Wybierz produkt');
define('ADDPRODUCT_TEXT_PRODUCT_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_OPTIONS', 'Wybierz opcję');
define('ADDPRODUCT_TEXT_OPTIONS_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_OPTIONS_NOTEXIST', 'Produkt nie ma opcji, pomijamy ...');
define('ADDPRODUCT_TEXT_CONFIRM_QUANTITY', 'Ilość tego przedmiotu');
define('ADDPRODUCT_TEXT_CONFIRM_ADDNOW', 'Dodać');
define('ADDPRODUCT_TEXT_STEP', 'Krok');
define('ADDPRODUCT_TEXT_STEP1', ' &laquo; Wybierz sekcję. ');
define('ADDPRODUCT_TEXT_STEP2', ' &laquo; Wybierz produkt. ');
define('ADDPRODUCT_TEXT_STEP3', ' &laquo; Wybierz opcję. ');

define('MENUE_TITLE_CUSTOMER', '1. Dane kupującego');
define('MENUE_TITLE_PAYMENT', '2. Sposób płatności');
define('MENUE_TITLE_ORDER', '3. Zamówione produkty');
define('MENUE_TITLE_TOTAL', '4. Wysyłka i kwota');
define('MENUE_TITLE_STATUS', '5. Status i powiadomienia');
define('MENUE_TITLE_UPDATE', '6. Zaktualizuj dane');

define('EMAIL_ACC_DISCOUNT_INTRO_OWNER', 'Jeden z Twoich klientów osiągnął limit udzielonej zniżki i został przeniesiony do nowej grupy. ' . "\n\n" . 'Szczegóły:');
define('EMAIL_TEXT_LIMIT', 'Osiągnięty limit: ');
define('EMAIL_TEXT_CURRENT_GROUP', 'Nowa grupa: ');
define('EMAIL_TEXT_DISCOUNT', 'Rabat: ');
define('EMAIL_ACC_SUBJECT', 'Kumulacyjny rabat');
define('EMAIL_ACC_INTRO_CUSTOMER', 'Gratulacje, otrzymałeś nową skumulowaną zniżkę. Wszystkie szczegóły są poniżej:');
define('EMAIL_ACC_FOOTER', 'Teraz możesz zaoszczędzić, robiąc zakupy w naszym sklepie internetowym.');

define('EMAIL_TEXT_CUSTOMER_NAME', 'Kupujący:');
define('EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS', 'Email:');
define('EMAIL_TEXT_CUSTOMER_TELEPHONE', 'Telefon:');

define('TEXT_ORDER_COMMENTS', 'Komentarz do zamówienia');

//Button
define('BUTTON_BACK_NEW', 'Wróć');
?>
