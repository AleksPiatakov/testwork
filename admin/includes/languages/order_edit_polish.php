<?php
/*
  $Id: order_edit_english.php,v 1.1 2003/09/24 14:33:18 wilt Exp $

  
  Contribution based on:
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Released under the GNU General Public License
*/

// pull down default text
define('PULL_DOWN_DEFAULT', 'Wybierz');
define('TYPE_BELOW', 'Wybierz poniżej');

define('JS_ERROR', 'Błąd podczas wypełniania formularza!\n\nPopraw proszę:\n\n');

define('JS_GENDER', '* Musisz określić swoją płeć.\n');
define('JS_FIRST_NAME', '* Pole Imię musi zawierać co najmniej ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaków.\n');
define('JS_LAST_NAME', '* Pole Nazwisko musi zawierać co najmniej ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaków.\n');
define('JS_DOB', '* Data urodzenia powinna być wpisana w następującym formacie: MM/DD/YYYY (przykład 05/21/1970)\n');
define('JS_EMAIL_ADDRESS', '* Pole E-mail musi zawierać co najmniej ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaków.\n');
define('JS_ADDRESS', '* Pole Adres i Numer domu muszą zawierać co najmniej ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaków.\n');
define('JS_POST_CODE', '* Pole Kod Pocztowy musi zawierać co najmniej ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaków.\n');
define('JS_CITY', '* Pole Miasto musi zawierać co najmniej ' . ENTRY_CITY_MIN_LENGTH . ' znaków.\n');
define('JS_STATE', '* Pole Województwo musi zostać wypełnione..\n');
define('JS_STATE_SELECT', '-- Wybierz wyżej --');
define('JS_ZONE', '* Pole Gmina musi zostać wypełnione.\n');
define('JS_COUNTRY', '* Pole Kraj musi zostać wypełnione.\n');
define('JS_TELEPHONE', '* Pole Telefon musi zawierać co najmniej ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaków.\n');
define('JS_PASSWORD', '* Pole Potwierdź Hasło musi pasować do pola Hasło i musi zawierać co najmniej ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaków.\n');

define('CATEGORY_COMPANY', 'Organizacja');
define('CATEGORY_PERSONAL', 'Twoje dane osobowe');
define('CATEGORY_ADDRESS', 'Twój adres');
define('CATEGORY_CONTACT', 'Informacje kontaktowe');
define('CATEGORY_OPTIONS', 'Newsletter');
define('CATEGORY_CORRECT', 'Jeśli kupujący jest wybrany prawidłowo, kliknij przycisk Potwierdź poniżej.');
define('ENTRY_CUSTOMERS_ID', 'ID:');
define('ENTRY_CUSTOMERS_ID_TEXT', '&nbsp;<small><font color="red">To pole jest wymagane</font></small>');
    define('ENTRY_COMPANY', 'Nazwa firmy:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Płeć:');
define('ENTRY_GENDER_ERROR', '&nbsp;<small><font color="red">To pole jest wymagane</font></small>');
define('ENTRY_GENDER_TEXT', '&nbsp;<small><font color="red">To pole jest wymagane</font></small>');
define('ENTRY_FIRST_NAME', 'Imię:');
define('ENTRY_FIRST_NAME_ERROR', 'Pole Imię musi zawierać co najmniej ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaków.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Nazwisko:');
define('ENTRY_LAST_NAME_ERROR', 'Pole Nazwisko musi zawierać co najmniej ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaków.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Data urodzenia:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Data urodzenia powinna być wpisana w następującym formacie: MM/DD/YYYY (przykład 05/21/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (przykład 05/21/1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Pole E-mail musi zawierać co najmniej ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaków.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Twój adres e-mail jest nieprawidłowy, spróbuj ponownie.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Wprowadzona wiadomość e-mail jest już zarejestrowana w naszym sklepie, spróbuj podać inny adres e-mail.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Adres:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Pole Adres i Numer domu muszą zawierać co najmniej ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaków.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Powiat:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Kod pocztowy:');
define('ENTRY_POST_CODE_ERROR', 'Pole Kod pocztowy musi zawierać co najmniej ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaków.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Miasto:');
define('ENTRY_CITY_ERROR', 'Pole Miasto musi zawierać co najmniej ' . ENTRY_CITY_MIN_LENGTH . ' znaków.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Województwo:');
define('ENTRY_STATE_ERROR', 'Pole Województwo musi zawierać co najmniej ' . ENTRY_STATE_MIN_LENGTH . ' znaków.');
define('ENTRY_STATE_ERROR_SELECT', 'Wybierz województwo.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Kraj:');
define('ENTRY_COUNTRY_ERROR', 'Wybierz Kraj.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Telefon:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Pole Telefon musi zawierać co najmniej ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaków.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Aktualności:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Subskrybuj');
define('ENTRY_NEWSLETTER_NO', 'Zrezygnuj z subskrypcji');
define('ENTRY_PASSWORD', 'Hasło:');
define('ENTRY_PASSWORD_ERROR', 'Twoje Hasło musi zawierać co najmniej ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaków.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Pole Potwierdź hasło musi pasować do pola Hasło.');
define('ENTRY_PASSWORD_CONFIRMATION', 'Potwierdź hasło:');
define('ENTRY_PASSWORD_CURRENT', 'Aktualne hasło:');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Pole Hasło musi zawierać co najmniej' . ENTRY_PASSWORD_MIN_LENGTH . ' znaków.');
define('ENTRY_PASSWORD_NEW', 'Nowe hasło:');
define('ENTRY_PASSWORD_NEW_ERROR', 'Twoje nowe hasło musi zawierać co najmniej ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaków.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Pola Potwierdź hasło i Nowe hasło muszą być zgodne.');

// manual order box text in includes/boxes/manual_order.php

define('BOX_HEADING_MANUAL_ORDER', 'Złożyć zamówienie przez panel administracyjny');
define('BOX_MANUAL_ORDER_CREATE_ACCOUNT', 'Rejestracja klienta');
define('BOX_MANUAL_ORDER_CREATE_ORDER', 'Złożyć zamówienie');
?>
