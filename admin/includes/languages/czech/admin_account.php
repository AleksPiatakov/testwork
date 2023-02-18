<?php
/*
  $Id: admin_account.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Účet správce');

define('TABLE_HEADING_ACCOUNT', 'Můj účet');

define('TEXT_INFO_FULLNAME', '<b>Jméno: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Jméno: </b>');
define('TEXT_INFO_LASTNAME', '<b>Příjmení: </b>');
define('TEXT_INFO_EMAIL', '<b>E-mailová adresa: </b>');
define('TEXT_INFO_PASSWORD', '<b>Heslo: </b>');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Potvrzení hesla: </b>');
define('TEXT_INFO_CREATED', '<b>Účet vytvořen: </b>');
define('TEXT_INFO_LOGDATE', '<b>Poslední přístup: </b>');
define('TEXT_INFO_LOGNUM', '<b>Číslo protokolu: </b>');
define('TEXT_INFO_GROUP', '<b>Úroveň skupiny: </b>');
define('TEXT_INFO_ERROR', 'E-mailová adresa již byla použita! Zkuste to prosím znovu.');
define('TEXT_INFO_MODIFIED', 'Upraveno: ');
define('TEXT_INFO_PASSWORD_HIDDEN', '**************');

define('TEXT_INFO_HEADING_DEFAULT', 'Upravit účet ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Potvrzení hesla ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Heslo:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<b>CHYBA:</b> špatné heslo!');
define('TEXT_INFO_INTRO_DEFAULT', 'Kliknutím na <b>tlačítko upravit</b> níže změníte svůj účet.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br><b>UPOZORNĚNÍ:</b><br>Dobrý den <b>%s</b>, jste zde poprvé. Doporučujeme vám změnit heslo! ');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br><b>UPOZORNĚNÍ:</b><br>Dobrý den <b>%s</b>, doporučujeme vám změnit svůj e-mail (admin@localhost) a heslo!') ;
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Všechna pole jsou povinná. Odešlete kliknutím na tlačítko Uložit.');

define('JS_ALERT_FIRSTNAME', '- Povinné: Jméno \n');
define('JS_ALERT_LASTNAME', '- Povinné: Příjmení \n');
define('JS_ALERT_EMAIL', '- Povinné: E-mailová adresa \n');
define('JS_ALERT_PASSWORD', '- Povinné: Heslo \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Délka jména musí být větší než ');
define('JS_ALERT_LASTNAME_LENGTH', '- Délka příjmení musí být větší než ');
define('JS_ALERT_PASSWORD_LENGTH', '- Délka hesla musí přesáhnout ');
define('JS_ALERT_EMAIL_FORMAT', '- Formát e-mailové adresy je neplatný! \n');
define('JS_ALERT_EMAIL_USED', '- E-mailová adresa již byla použita! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- Chybí zadání hesla do pole pro potvrzení hesla! \n');

define('ADMIN_EMAIL_SUBJECT', 'Změna osobních údajů');
define('ADMIN_EMAIL_TEXT', 'Ahoj %s,' . "\n\n" . 'Vaše osobní údaje, možná včetně vašeho hesla, byly změněny. Pokud se tak stalo bez vašeho vědomí nebo souhlasu, kontaktujte prosím neprodleně administrátora!' . "\n\n" . 'Webové stránky : %s' . "\n" . 'Uživatelské jméno: %s' . "\n" . 'Heslo: %s' . "\n\n" . 'Děkuji!' . "\n" . '%s' . "\n\n". "Toto je automatická odpověď, prosím neodpovídejte!");

//Knoflík
define('BUTTON_BACK_NEW', 'zpět');