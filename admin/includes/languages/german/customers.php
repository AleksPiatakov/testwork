<?php
/*
  $Id: customers.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Kunden');
define('HEADING_FORM_TITLE', 'Kunde');
define('HEADING_TITLE_SEARCH', 'Suche:');

// TotalB2B start
define('TABLE_HEADING_CUSTOMERS_STATUS', 'Status');
define('TABLE_HEADING_CUSTOMERS_GROUP', 'Betritt die Gruppe');
define('TABLE_HEADING_CUSTOMERS_DISCOUNT', 'Persönlicher Rabatt');
define('ENTRY_CUSTOMERS_DISCOUNT', 'Persönlicher Rabatt:');
define('ENTRY_CUSTOMERS_GROUPS_NAME', 'Gruppe:');

// add for SPPC shipment and payment module start 
define('ENTRY_CUSTOMERS_PAYMENT_SET', 'Zahlungsmodule für den Käufer festlegen');
define('ENTRY_CUSTOMERS_PAYMENT_DEFAULT', 'Gruppeneinstellungen oder Standardeinstellungen verwenden');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN', 'Wenn Sie wählen <b>Set Zahlungsmodule für die Kunden</b>, aber nicht eine einzige Einheit wählt, wird für Gruppeneinstellungen oder Standardeinstellung gültig. ');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN2', 'bemerkte die Module, die werden <b><font color="red">verfügbar</font></b> der Kunde während des Bestellprozesses. ');

define('ENTRY_CUSTOMERS_SHIPPING_SET', 'Lieferungsmodule für den Käufer setzen');
define('ENTRY_CUSTOMERS_SHIPPING_DEFAULT', 'Gruppeneinstellungen oder Standardeinstellungen verwenden');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN', 'Wenn Sie wählen <b>Set-Fördermodule für die Kunden</b>, aber nicht eine einzige Einheit wählt, wird für Gruppeneinstellungen oder Standardeinstellung gültig. ');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN2', 'bemerkte die Module, die werden <b><font color="red">verfügbar</font></b> der Kunde während des Bestellprozesses. ');
// add for SPPC shipment and payment module end

// TotalB2B end

define('TABLE_HEADING_FIRSTNAME', 'Name');
define('TABLE_HEADING_LASTNAME', 'Nachname');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Datum');
define('TABLE_HEADING_ACCOUNT_R', 'Besuche');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_DATE_ACCOUNT_CREATED', 'Datum:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Zuletzt geändert:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Letzter Eintrag:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Anzahl der Eingaben:');
define('TEXT_INFO_COUNTRY', 'Land:');
define('TEXT_DELETE_INTRO', 'Wollen Sie den Client wirklich löschen?');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Kunde löschen');
define('TYPE_BELOW', 'Type Below');
define('PLEASE_SELECT', 'Wähle etwas');

define('NO_PERSONAL_DISCOUNT', 'Nein');
define('TEXT_PERCENT', '%');
define('TEXT_GROUP', '<br>Rabatt:');
define('TEXT_HELP_HEADING', 'Hilfe:');
define('TEXT_HELP_TEXT', 'Wenn Sie einen Rabatt und personalisieren und Gruppenrabatte gegeben werden, bitte beachten Sie, dass sie beiden Rabatte berücksichtigt werden. Wenn beispielsweise eine Gruppe Aufkäufer ausgewählt wird, erhält der Käufer einen Rabatt von 20% und enthält persönlichen Rabatt, zum Beispiel, -10 %, dann erhält der Käufer am Ende einen Rabatt von -30%. ');


define('TEXT_CUST_STATUS_CHANGED', 'Dein Status wurde geändert');
define('TEXT_CUST_HELLO', 'Guten Tag');
define('TEXT_CUST_STATUS_CHANGED_FROM', 'Ihr Status wurde geändert von');
define('TEXT_CUST_STATUS_CHANGED_TO', 'on');
define('TEXT_CUST_STATUS_THX', 'Mit freundlichen Grüßen, die Verwaltung des Online-Shops');

define('TEXT_CUST_NOTIFY', 'Benachrichtigen des Kunden');
define('TEXT_CUST_XLS', 'xls herunterladen');
define('TEXT_CUST_PERPAGE', 'Benutzer pro Seite');
define('TEXT_CUST_SUM', 'Summe');
define('TEXT_CUST_CITY', 'Stadt');
define('TEXT_CUST_ALL', 'alle');

define('TEXT_CUST_XLS', 'Preisliste');
define('TEXT_CUST_XLS_MODEL', 'id');
define('TEXT_CUST_XLS_NAME', 'Name');
define('TEXT_CUST_XLS_LASTNAME', 'Nachname');
define('TEXT_CUST_XLS_CITY', 'Stadt');
define('TEXT_CUST_XLS_PHONE', 'Telefon');
define('TEXT_CUST_XLS_EMAIL', 'E-Mail');
define('TEXT_CUST_XLS_ORDERS', 'Aufträge');
define('TEXT_CUST_XLS_GROUP', 'Gruppe');
define('TEXT_CUST_XLS_DATE', 'Registrierungsdatum');
define('TEXT_CUST_XLS_MODEL', 'id');

//Button
define('BUTTON_CANCEL_NEW', 'stornieren');
define('BUTTON_EDIT_NEW', 'bearbeiten');
define('BUTTON_UNLOCK_NEW', 'freischalten');
define('BUTTON_PREVIEW_NEW', 'vorschau');
define('BUTTON_BACK_NEW', 'zurück');
define('BUTTON_NEWSLETTER_NEW', 'newsletter');
define('BUTTON_DELETE_NEW', 'löschen');
define('BUTTON_LOCK_NEW', 'sperren');
define('BUTTON_SEND_NEW', 'senden');
define('BUTTON_INSERT_NEW', 'einfügen');
define('BUTTON_RESET_NEW', 'zurücksetzen');
define('BUTTON_ORDERS_NEW', 'aufträge');
define('BUTTON_EMAIL_NEW', 'email');
define('BUTTON_YES', 'ja');
define('BUTTON_NO', 'nein');

define('CHECK_NOTIFY_CUSTOMER', 'Notify customer');

// view address_book
define('AD_CHOOSE_ADDRESS', 'Adresse');
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
define('ERROR_NEW_PASSWORD_MIN_LENGTH', 'Die minimale Länge des Passworts beträgt %s');
define('ERROR_CONFIRM_PASSWORD_EQUAL', 'Passwörter müssen gleich sein');

define('CUSTOMERS_STREET_ADDRESS', 'Address');
define('CUSTOMERS_FAX', 'Fax');
define('CUSTOMERS_BIRTHDAY', 'Date of birth');

define('SUBTITLE_PERSONAL', 'Persönlich');
define('SUBTITLE_COMPANY', 'Unternehmen');
define('SUBTITLE_ADDRESS', 'Adresse');
define('SUBTITLE_FOR_CONTACT', 'Für den Kontakt');
define('SUBTITLE_SUBSCRIBE', 'Newsletter');
define('SUBTITLE_POSTCODE', 'Post Code');

define('MAIL_TO', 'Send');
define('MAIL_FROM', 'From');
define('MAIL_SUBJECT', 'Theme');
define('MAIL_MESSAGE', 'Message');
define('MAIL_ALL_CUSTOMERS', 'All clients');
define('MAIL_ALL_SUBSCRIBER', 'All customers to subscribers');
?>