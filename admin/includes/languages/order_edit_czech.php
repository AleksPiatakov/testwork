<?php
/*
  $Id: order_edit_english.php,v 1.1 2003/09/24 14:33:18 vadne Exp $

  
  Příspěvek na základě:
  
  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Vydáno pod GNU General Public License
*/

// stáhnout výchozí text
define('PULL_DOWN_DEFAULT', 'Vyberte prosím');
define('TYPE_BELOW', 'Type below');

define('JS_ERROR', 'Během zpracování vašeho formuláře došlo k chybám!\nProveďte prosím následující opravy:\n\n');

define('JS_FIRST_NAME', '* Položka \'Jméno\' musí mít alespoň ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaků.\n');
define('JS_LAST_NAME', '* Záznam \'Příjmení\' musí mít alespoň ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaků.\n');
define('JS_DOB', '* Záznam \'Datum narození\' musí být ve formátu: xx/xx/xxxx (měsíc/den/rok).\n');
define('JS_EMAIL_ADDRESS', '* Položka \'E-Mail Address\' musí mít alespoň ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaků.\n');
define('JS_ADDRESS', '* Položka \'Ulice\' musí mít alespoň ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaků.\n');
define('JS_POST_CODE', '* Položka \'Post Code\' musí mít alespoň ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaků.\n');
define('JS_CITY', '* Položka \'Předměstí\' musí mít alespoň ' . ENTRY_CITY_MIN_LENGTH . ' znaků.\n');
define('JS_STATE', '* Musí být vybrána položka \'State\'.\n');
define('JS_STATE_SELECT', '-- Vybrat výše --');
define('JS_ZONE', '* Položka \'Stát\' musí být vybrána ze seznamu pro tuto zemi.\n');
define('JS_COUNTRY', '* Musí být vybrána položka \'Země\'.\n');
define('JS_TELEPHONE', '* Záznam \'Telefonní číslo\' musí mít alespoň ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaků.\n');
define('JS_PASSWORD', '* Položky \'Heslo\' a \'Potvrzení\' se musí shodovat a mít alespoň ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaků.\n');

define('CATEGORY_COMPANY', 'Podrobnosti o společnosti');
define('CATEGORY_PERSONAL', 'Osobní údaje');
define('CATEGORY_ADDRESS', 'Adresa');
define('CATEGORY_CONTACT', 'Kontaktní informace');
define('CATEGORY_OPTIONS', 'Možnosti');
define('CATEGORY_CORRECT', 'Pokud je toto správný zákazník, stiskněte tlačítko Potvrdit níže.');
define('ID_CUSTOMERS_VSTUPU', 'ID:');
define('ENTRY_CUSTOMERS_ID_TEXT', '&nbsp;<small><font color="#AABBDD">povinné</font></small>');
define('ENTRY_COMPANY', 'Název společnosti:');
define('VSTUPNÍ_CHYBA_SPOLEČNOSTI', '');
define('VSTUP_FIRMA_TEXT', '');
define('ENTRY_FIRST_NAME', 'Jméno:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">povinné</font></small>');
define('ENTRY_LAST_NAME', 'Příjmení:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaky</font></small>');
define('ENTRY_LAST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">povinné</font></small>');
define('ENTRY_DATE_OF_BIRTH', 'Datum narození:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<small><font color="#FF0000">(např. 21.05.1970)</font></small>');
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<small>(např. 05/21/1970) <font color="#AABBDD">povinné</font></small>');
define('ENTRY_EMAIL_ADDRESS', 'E-mailová adresa:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<small><font color="#FF0000">Vaše e-mailová adresa se nezdá být platná!</font></small>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<small><font color="#FF0000">e-mailová adresa již existuje!</font></small>');
define('ENTRY_EMAIL_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">povinné</font></small>');
define('ENTRY_STREET_ADDRESS', 'Adresa ulice:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaky</font></small>');
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">povinné</font></small>');
define('ENTRY_SUBURB', 'Předměstí:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'PSČ:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaky</font></small>');
define('ENTRY_POST_CODE_TEXT', '&nbsp;<small><font color="#AABBDD">povinné</font></small>');
define('ENTRY_CITY', 'Předměstí:');
define('ENTRY_CITY_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_CITY_MIN_LENGTH . ' znaky</font></small>');
define('ENTRY_CITY_TEXT', '&nbsp;<small><font color="#AABBDD">povinné</font></small>');
define('ENTRY_STATE', 'Stát/provincie:');
define('ENTRY_STATE_ERROR', '&nbsp;<small><font color="#FF0000">povinné</font></small>');
define('ENTRY_STATE_ERROR_SELECT', 'Vyberte stát/provincii.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Země:');define('ENRY_COUNTRY_ERROR', '');
define('ENTRY_COUNTRY_TEXT', '&nbsp;<small><font color="#AABBDD">povinné</font></small>');
define('ENTRY_TELEPHONE_NUMBER', 'Telefonní číslo:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;<small><font color="#AABBDD">povinné</font></small>');
define('ENTRY_FAX_NUMBER', 'Číslo faxu:');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Přihlášeno');
define('ENTRY_NEWSLETTER_NO', 'Odhlášeno');
define('ENTRY_PASSWORD', 'Heslo:');
define('ENTRY_PASSWORD_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_PASSWORD_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Pokračovat v tom, aby se to nevrátilo.');
define('ENTRY_PASSWORD_CONFIRMATION', 'Potvrzení hesla:');
define('ENTRY_PASSWORD_CURRENT', 'Aktuální heslo:');
define('ENTRY_PASSWORD_CURRENT_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaky</font></small>');
define('ENTRY_PASSWORD_NEW', 'Nové heslo:');
define('ENTRY_PASSWORD_NEW_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_PASSWORD_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Vaše hesla se neshodují.');

// text pole ruční objednávky v include/boxes/manual_order.php

define('BOX_HEADING_MANUAL_ORDER', 'Ruční objednávky');
define('BOX_MANUAL_ORDER_CREATE_ACCOUNT', 'Vytvořit účet');
define('BOX_MANUAL_ORDER_CREATE_ORDER', 'Vytvořit objednávku');
?>
