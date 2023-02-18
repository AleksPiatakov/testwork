<?php
/*
  $Id: customers.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Klienci');
define('HEADING_FORM_TITLE', 'Klienc');
define('HEADING_TITLE_SEARCH', 'Wyszukaj:');

//TotalB2B start
define('TABLE_HEADING_CUSTOMERS_STATUS', 'Status');
define('TABLE_HEADING_CUSTOMERS_GROUP', 'Jest w grupie');
define('TABLE_HEADING_CUSTOMERS_DISCOUNT', 'Osobisty rabat');
define('ENTRY_CUSTOMERS_DISCOUNT', 'Zniżka osobista:');
define('ENTRY_CUSTOMERS_GROUPS_NAME', 'Grupa:');

// add for SPPC shipment and payment module start 
define('ENTRY_CUSTOMERS_PAYMENT_SET', 'Zainstaluj moduły płatności dla kupującego');
define('ENTRY_CUSTOMERS_PAYMENT_DEFAULT', 'Użyj ustawień grupowych lub ustawień domyślnych');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN', 'Jeśli wybierzesz <b>Zainstalować moduły płatności dla kupującego</b>, ale nie wybierzesz żadnych modułów, będą działać ustawienia grupowe lub ustawienia standardowe.');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN2', 'Oznacz modułe, które będą <b><font color="red">dostępne</font></b> kupującemu przy składaniu zamówienia.');

define('ENTRY_CUSTOMERS_SHIPPING_SET', 'Zainstaluj moduły dostawy dla kupującego');
define('ENTRY_CUSTOMERS_SHIPPING_DEFAULT', 'Użyj ustawień grupowych lub ustawień domyślnych');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN', 'Jeśli wybierzesz <b>Zainstalować moduły płatności dla kupującego</b>, ale nie wybierzesz żadnych modułów, będą działać ustawienia grupowe lub ustawienia standardowe.');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN2', 'Oznacz modułe, które będą <b><font color="red">dostępne</font></b> kupującemu przy składaniu zamówienia.');
// add for SPPC shipment and payment module end

//TotalB2B end

define('TABLE_HEADING_FIRSTNAME', 'Imię');
define('TABLE_HEADING_LASTNAME', 'Nazwisko');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Data');
define('TABLE_HEADING_ACCOUNT_R', 'Wizyty');
define('TABLE_HEADING_ACTION', 'Działanie');

define('TEXT_DATE_ACCOUNT_CREATED', 'Data:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Ostatnia modyfikacja:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Ostatnie logowanie:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Liczba wejść:');
define('TEXT_INFO_COUNTRY', 'Kraj:');
define('TEXT_DELETE_INTRO', 'Czy na pewno chcesz usunąć klienta?');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Usuń klienta');
define('TYPE_BELOW', 'Wpisz poniżej');
define('PLEASE_SELECT', 'Wybierz tylko jedno');

define('NO_PERSONAL_DISCOUNT', 'Nie');
define('TEXT_PERCENT', '%');
define('TEXT_GROUP', '<br>Rabat: ');
define('TEXT_HELP_HEADING', 'Pomoc:');
define('TEXT_HELP_TEXT', 'Jeśli podasz zarówno osobistą zniżkę, jak i zniżkę grupową, pamiętaj, że uwzględnione zostaną oba rabaty. Jeśli na przykład wybrano grupę "Klienci hurtowi", kupujący otrzymuje zniżkę w wysokości -20%, a na przykład -10% wskazuje zniżkę osobistą, a następnie kupujący otrzyma łączną zniżkę w wysokości -30%.');


define('TEXT_CUST_STATUS_CHANGED', 'Twój status został zmieniony');
define('TEXT_CUST_HELLO', 'Dzień dobry');
define('TEXT_CUST_STATUS_CHANGED_FROM', 'Twój status został zmieniony z');
define('TEXT_CUST_STATUS_CHANGED_TO', 'na');
define('TEXT_CUST_STATUS_THX', 'Z poważaniem, administracja sklepu internetowego');

define('TEXT_CUST_NOTIFY', 'Powiadom klienta');
define('TEXT_CUST_XLS', 'Pobierz xls');
define('TEXT_CUST_PERPAGE', 'Użytkownicy na stronie');
define('TEXT_CUST_SUM', 'Suma');
define('TEXT_CUST_CITY', 'Miasto');
define('TEXT_CUST_ALL', 'Wszystkich');

define('TEXT_CUST_XLS', 'Cennik');
define('TEXT_CUST_XLS_MODEL', 'Id');
define('TEXT_CUST_XLS_NAME', 'Imię');
define('TEXT_CUST_XLS_LASTNAME', 'Nazwisko');
define('TEXT_CUST_XLS_CITY', 'Miasto');
define('TEXT_CUST_XLS_PHONE', 'Numer telefonu');
define('TEXT_CUST_XLS_EMAIL', 'E-mail');
define('TEXT_CUST_XLS_ORDERS', 'Zamówień');
define('TEXT_CUST_XLS_GROUP', 'Grupa');
define('TEXT_CUST_XLS_DATE', 'Data rejestracji');
define('TEXT_CUST_XLS_MODEL', 'Id');

//Button
define('BUTTON_CANCEL_NEW', 'anuluj');
define('BUTTON_EDIT_NEW', 'edytować');
define('BUTTON_UNLOCK_NEW', 'odblokować');
define('BUTTON_PREVIEW_NEW', 'zapowiedź');
define('BUTTON_BACK_NEW', 'wróć');
define('BUTTON_NEWSLETTER_NEW', 'newsletter');
define('BUTTON_DELETE_NEW', 'usuń');
define('BUTTON_LOCK_NEW', 'zamknij');
define('BUTTON_SEND_NEW', 'wysłać');
define('BUTTON_INSERT_NEW', 'wstawić');
define('BUTTON_RESET_NEW', 'zresetuj');
define('BUTTON_ORDERS_NEW', 'zamówić');
define('BUTTON_EMAIL_NEW', 'email');
define('BUTTON_YES', 'tak');
define('BUTTON_NO', 'nie');

define('CHECK_NOTIFY_CUSTOMER', 'Notify customer');

// view address_book
define('AD_CHOOSE_ADDRESS', 'Adres');
define('AD_CUSTOMERS_MAIN_INFO', 'Basic data');
define('AD_ORDER', 'Order');
define('AD_BOOK', 'Address Book');
define('AD_DEL', 'This is the address of the cabinet owner (you can not delete the default)');
define('AD_BY_DEFAULT', 'Set as default');
define('AD_WANT_TO_DEL', 'If you want to delete this address, press');
define('AD_SURE', 'Are you sure?');
define('AD_LIST', 'Address book list');
define('AD_DEFAULT', '(Default)');
define('AD_SUBSCRIBE', 'Subscriptions');
define('AD_CHANGE_PASSWORD', 'Change Password');
define('AD_NEW_PASSWORD', 'New password');
define('AD_CONFIRM_PASSWORD', 'Confirmation');

//Error form
define('ERROR_NEW_PASSWORD_MIN_LENGTH', 'Minimalna długość hasła to %s');
define('ERROR_CONFIRM_PASSWORD_EQUAL', 'Hasła muszą być równe');

define('CUSTOMERS_STREET_ADDRESS', 'Address');
define('CUSTOMERS_FAX', 'Fax');
define('CUSTOMERS_BIRTHDAY', 'Date of birth');

define('SUBTITLE_PERSONAL', 'osobisty');
define('SUBTITLE_COMPANY', 'firma');
define('SUBTITLE_ADDRESS', 'adres');
define('SUBTITLE_FOR_CONTACT', 'dla kontaktu');
define('SUBTITLE_SUBSCRIBE', 'Newsletter');
define('SUBTITLE_POSTCODE', 'Post Code');

define('MAIL_TO', 'Send');
define('MAIL_FROM', 'From');
define('MAIL_SUBJECT', 'Theme');
define('MAIL_MESSAGE', 'Message');
define('MAIL_ALL_CUSTOMERS', 'All clients');
define('MAIL_ALL_SUBSCRIBER', 'All customers to subscribers');
?>
