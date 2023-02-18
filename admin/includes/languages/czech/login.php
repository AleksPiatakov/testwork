<?php
/*
  $Id: login.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('NAVBAR_TITLE', 'Přihlášení');
define('HEADING_TITLE', 'Vítejte, přihlaste se prosím');
define('TEXT_STEP_BY_STEP', ''); // by mělo být prázdné

define('HEADING_RETURNING_ADMIN', 'Přihlašovací panel:');
define('HEADING_PASSWORD_FORGOTTEN', 'Zapomenuté heslo:');
define('TEXT_RETURNING_ADMIN', 'Pouze zaměstnanci!');
define('ENTRY_EMAIL_ADDRESS', 'E-mailová adresa:');
define('ENTRY_PASSWORD', 'Heslo:');
define('ENTRY_FIRSTNAME', 'Jméno:');
define('IMAGE_BUTTON_LOGIN', 'Odeslat');

define('TEXT_PASSWORD_FORGOTTEN', 'Zapomněli jste heslo?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>CHYBA:</b></font> Chybné uživatelské jméno nebo heslo!');
define('TEXT_LOGIN_ERROR_TRIED', '<font color="#ff0000"><b>CHYBA:</b></font> Překročený počet pokusů – zkuste to znovu později');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>CHYBA:</b></font> křestní jméno a email se neshodují!');
define('TEXT_FORGOTTEN_FAIL', 'Zkusili jste to více než 3krát. Z bezpečnostních důvodů prosím kontaktujte svého správce webu, aby vám získal nové heslo.<br>&nbsp;<br>&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'Nové heslo bylo zasláno na vaši e-mailovou adresu. Zkontrolujte prosím svůj e-mail a kliknutím zpět se přihlaste.<br>&nbsp;<br>&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'Nové heslo');
define('ADMIN_EMAIL_TEXT', 'Ahoj %s,' . "\n\n" . 'Do administrátorského panelu se dostanete s následujícím heslem. Jakmile se dostanete do administrátora, změňte si prosím heslo!' . "\n\n " . 'Web : %s' . "\n" . 'Uživatelské jméno: %s' . "\n" . 'Heslo: %s' . "\n\n" . 'Děkuji!' . "\n" . '%s' . "\n\n" . 'Toto je automatická odpověď, prosím neodpovídejte!');
?>