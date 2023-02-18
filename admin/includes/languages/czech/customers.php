<?php
/*
  $Id: customers.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Zákazníci');
define('HEADING_FORM_TITLE', 'Zákazník');
define('HEADING_TITLE_SEARCH', 'Hledat:');

//Začátek TotalB2B
define('TABLE_HEADING_CUSTOMERS_STATUS', 'Stav');
define('TABLE_HEADING_CUSTOMERS_GROUP', 'Skupina');
define('TABLE_HEADING_CUSTOMERS_DISCOUNT', 'Osobní sleva');
define('ENTRY_CUSTOMERS_DISCOUNT', 'Osobní sleva:');
define('ENTRY_CUSTOMERS_GROUPS_NAME', 'Skupina:');

// přidat pro spuštění SPPC zásilky a platebního modulu
define('ENTRY_CUSTOMERS_PAYMENT_SET', 'Nastavení platebních modulů pro zákazníka');
define('ENTRY_CUSTOMERS_PAYMENT_DEFAULT', 'Použít nastavení ze skupiny nebo konfigurace');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN', 'Pokud zvolíte <b><i>Nastavit platební moduly pro zákazníka</i></b>, ale nezaškrtnete žádné z políček, výchozí nastavení (nastavení skupiny nebo konfigurace) bude stále použitý.');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN2', '<i>Zkontrolujte platební moduly, které jsou </i><b><font color="red">povoleny</font></b>.');

define('ENTRY_CUSTOMERS_SHIPPING_SET', 'Nastavení expedičních modulů pro zákazníka');
define('ENTRY_CUSTOMERS_SHIPPING_DEFAULT', 'Použít nastavení ze skupiny nebo konfigurace');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN', 'Pokud zvolíte <b><i>Nastavit expediční moduly pro zákazníka</i></b>, ale nezaškrtnete žádné z políček, výchozí nastavení (nastavení skupiny nebo konfigurace) budou stále použitý.');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN2', '<i>Zkontrolujte přepravní moduly, které jsou </i><b><font color="red">povoleny</font></b>.');
// přidat pro SPPC zásilku a konec platebního modulu

//TotalB2B konec


define('TABLE_HEADING_FIRSTNAME', 'Křestní jméno');
define('TABLE_HEADING_LASTNAME', 'Příjmení');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Účet vytvořen');
define('TABLE_HEADING_ACTION', 'Akce');

define('TEXT_DATE_ACCOUNT_CREATED', 'Účet vytvořen:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Poslední úprava:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Poslední přihlášení:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Počet přihlášení:');
define('TEXT_INFO_COUNTRY', 'Země:');
define('TEXT_DELETE_INTRO', 'Opravdu chcete smazat tohoto zákazníka?');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Smazat zákazníka');
define('TYPE_BELOW', 'Type níže');
define('PLEASE_SELECT', 'Vyberte prosím');

define('NO_PERSONAL_DISCOUNT', 'Ne');
define('TEXT_PERCENT', '%');
define('TEXT_GROUP', '<br>Sleva: ');
define('TEXT_HELP_HEADING', '');
define('TEXT_HELP_TEXT', '');

define('TEXT_CUST_STATUS_CHANGED', 'Váš stav byl změněn');
define('TEXT_CUST_HELLO', 'Ahoj');
define('TEXT_CUST_STATUS_CHANGED_FROM', 'Váš stav byl změněn z');
define('TEXT_CUST_STATUS_CHANGED_TO', 'do');
define('TEXT_CUST_STATUS_THX', 'S pozdravem administrace obchodu ');

define('TEXT_CUST_NOTIFY', 'Upozornit zákazníka');
define('TEXT_CUST_XLS', 'stáhnout xls');
define('TEXT_CUST_PERPAGE', 'Zákazníci/stránka');
define('TEXT_CUST_SUM', 'Celkem');
define('TEXT_CUST_CITY', 'Město');
define('TEXT_CUST_ALL', 'Vše');

define('TEXT_CUST_XLS', 'Ceník');
define('TEXT_CUST_XLS_MODEL', 'id');
define('TEXT_CUST_XLS_NAME', 'Jméno');
define('TEXT_CUST_XLS_LASTNAME', 'Příjmení');
define('TEXT_CUST_XLS_CITY', 'Město');
define('TEXT_CUST_XLS_PHONE', 'Telefon');
define('TEXT_CUST_XLS_EMAIL', 'e-mail');
define('TEXT_CUST_XLS_ORDERS', 'Objednávky');
define('TEXT_CUST_XLS_GROUP', 'Skupina');
define('TEXT_CUST_XLS_DATE', 'Registrováno');

//Knoflík
define('BUTTON_CANCEL_NEW', 'zrušit');
define('BUTTON_EDIT_NEW', 'edit');
define('BUTTON_UNLOCK_NEW', 'odemknout');
define('BUTTON_PREVIEW_NEW', 'náhled');
define('BUTTON_BACK_NEW', 'zpět');
define('BUTTON_NEWSLETTER_NEW', 'newsletter');
define('BUTTON_DELETE_NEW', 'smazat');
define('BUTTON_LOCK_NEW', 'lock');
define('BUTTON_SEND_NEW', 'odeslat');
define('BUTTON_INSERT_NEW', 'vložit');
define('BUTTON_RESET_NEW', 'reset');
define('BUTTON_ORDERS_NEW', 'objednávky');
define('BUTTON_EMAIL_NEW', 'e-mail');
define('BUTTON_YES', 'ano');
define('BUTTON_NO', 'ne');

define('CHECK_NOTIFY_CUSTOMER', 'Upozornit zákazníka');

// zobrazení adresáře
define('AD_CHOOSE_ADDRESS', 'Adresa');
define('AD_CUSTOMERS_MAIN_INFO', 'Základní údaje');
define('AD_ORDER', 'Objednávka');
define('AD_BOOK', 'Adresář');
define('AD_DEL', 'Toto je adresa vlastníka skříně (nemůžete smazat výchozí)');
define('AD_BY_DEFAULT', 'Nastavit jako výchozí');
define('AD_WANT_TO_DEL', 'Pokud chcete tuto adresu smazat, stiskněte');
define('AD_SURE', 'Jste si jistý?');
define('AD_LIST', 'Seznam adresáře');
define('AD_DEFAULT', '(Výchozí)');
define('AD_SUBSCRIBE', 'Předplatné');
define('AD_CHANGE_PASSWORD', 'Změnit heslo');
define('AD_NEW_PASSWORD', 'Nové heslo');
define('AD_CONFIRM_PASSWORD', 'Potvrzení');

//Formulář chyby
define('ERROR_NEW_PASSWORD_MIN_LENGTH', 'Minimální délka hesla je rovna %s');
define('ERROR_CONFIRM_PASSWORD_EQUAL', 'Hesla se musí shodovat');

define('CUSTOMERS_STREET_ADDRESS', 'Adresa');
define('CUSTOMERS_FAX', 'Fax');
define('CUSTOMERS_BIRTHDAY', 'Datum narození');

define('SUBTITLE_PERSONAL', 'Osobní');
define('SUBTITLE_COMPANY', 'Company');
define('SUBTITLE_ADDRESS', 'Adresa');
define('SUBTITLE_FOR_CONTACT', 'Pro kontakt');
define('SUBTITLE_SUBSCRIBE', 'Newsletter');
define('SUBTITLE_POSTCODE', 'PSČ');

define('MAIL_TO', 'Odeslat');
define('MAIL_FROM', 'Od');
define('MAIL_SUBJECT', 'Téma');
define('MAIL_MESSAGE', 'Zpráva');
define('MAIL_ALL_CUSTOMERS', 'Všichni klienti');
define('MAIL_ALL_SUBSCRIBER', 'Všichni zákazníci předplatitelům');
?>