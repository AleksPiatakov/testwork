<?php
/*
  $Id: password_forgotten.php,v 1.8 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Vydáno pod GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Přihlášení');
define('NAVBAR_TITLE_2', 'Zapomenuté heslo');

define('HEADING_TITLE', 'Zapomněl jsem heslo!');

define('TEXT_MAIN', 'Pokud jste zapomněli své heslo, zadejte níže svou e-mailovou adresu a my vám zašleme e-mailovou zprávu obsahující vaše nové heslo.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Chyba: E-mailová adresa nebyla nalezena v našich záznamech, zkuste to prosím znovu.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nové heslo');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Nové heslo bylo požadováno od ');
define('EMAIL_PASSWORD_REMINDER_BODY2', 'Vaše nové heslo do \'' . STORE_NAME . '\' je:' . ' %s');
define('SUCCESS_PASSWORD_SENT', 'Úspěch: Na vaši e-mailovou adresu bylo zasláno nové heslo.');
define('SUCCESS_PASSWORD_TOKEN_SENT', 'Úspěch: Na vaši e-mailovou adresu byl odeslán odkaz pro obnovení hesla.');
define('EMAIL_PASSWORD_REMINDER_SUBJECT2', STORE_NAME . ' - žádost o změnu hesla');
define('EMAIL_PASSWORD_REMINDER_BODY3', 'pokud jste to udělali, klikněte na odkaz níže a heslo bude změněno');
define('EMAIL_TOKEN_ERROR', 'Token již není platný');