<?php
/*
  $Id: currencies.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Waluty');

define('TABLE_HEADING_CURRENCY_NAME', 'Waluta');
define('TABLE_HEADING_CURRENCY_CODES', 'Kod');
define('TABLE_HEADING_CURRENCY_VALUE', 'Wartość');
define('TABLE_HEADING_ACTION', 'Działanie');

define('TEXT_INFO_EDIT_INTRO', 'Wprowadź niezbędne zmiany.');
define('TEXT_INFO_CURRENCY_TITLE', 'Tytuł:');
define('TEXT_INFO_CURRENCY_CODE', 'Kod:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Symbol po lewej stronie:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Symbol po prawej stronie:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Znak dziesiętny:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Separator tysięcy:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Zamówienia dziesiętne:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Ostatnio edytowano:');
define('TEXT_INFO_CURRENCY_VALUE', 'Wartość:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Przykład:');
define('TEXT_INFO_INSERT_INTRO', 'Wprowadź szczegóły dotyczące nowej waluty');
define('TEXT_INFO_DELETE_INTRO', 'Czy na pewno chcesz usunąć tę walutę?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Nowa waluta');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Edytuj walutę');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Usuń walutę');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (Ta waluta musi zostać edytowana ręcznie)');
define('TEXT_INFO_CURRENCY_UPDATED', 'Kurs wymiany dla %s (%s) pomyślnie zaktualizowany za pomocą %s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Błąd: domyślna waluta nie może zostać usunięta. Określ inną domyślną walutę i spróbuj ponownie.');
define('ERROR_CURRENCY_INVALID', 'Błąd: Kurs wymiany dla %s (%s) nie został zaktualizowany za pomocą %s. Czy poprawnie wprowadziłeś kod waluty? Aby zaktualizować kurs wymiany, musisz być podłączony do Internetu.');
define('WARNING_PRIMARY_SERVER_FAILED', 'Ostrzeżenie: Nie można połączyć się z serwerem (%s) i zaktualizować kurs wymiany dla %s (%s) - spróbuj połączyć się z innym serwerem. Aby zaktualizować kurs wymiany, musisz być podłączony do Internetu.');
?>
