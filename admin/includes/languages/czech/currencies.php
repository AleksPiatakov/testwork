<?php
/*
  $Id: currencies.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Měny');

define('TABLE_HEADING_CURRENCY_NAME', 'Měna');
define('TABLE_HEADING_CURRENCY_CODES', 'Kód');
define('TABLE_HEADING_CURRENCY_VALUE', 'Hodnota');
define('TABLE_HEADING_ACTION', 'Akce');

define('TEXT_INFO_EDIT_INTRO', 'Proveďte prosím potřebné změny');
define('TEXT_INFO_CURRENCY_TITLE', 'Titul:');
define('TEXT_INFO_CURRENCY_CODE', 'Kód:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Symbol vlevo:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Symbol vpravo:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Desetinná čárka:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Tisíce bodů:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Desetinná místa:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Poslední aktualizace:');
define('TEXT_INFO_CURRENCY_VALUE', 'Hodnota:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Příklad výstupu:');
define('TEXT_INFO_INSERT_INTRO', 'Zadejte novou měnu s příslušnými údaji');
define('TEXT_INFO_DELETE_INTRO', 'Opravdu chcete smazat tuto měnu?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Nová měna');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Upravit měnu');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Smazat měnu');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (vyžaduje ruční aktualizaci hodnot měn)');
define('TEXT_INFO_CURRENCY_UPDATED', 'Směnný kurz pro %s (%s) byl úspěšně aktualizován prostřednictvím %s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Chyba: Výchozí měnu nelze odstranit. Nastavte prosím jinou měnu jako výchozí a zkuste to znovu.');
define('ERROR_CURRENCY_INVALID', 'Chyba: Směnný kurz pro %s (%s) nebyl aktualizován prostřednictvím %s. Je to platný kód měny?');
define('WARNING_PRIMARY_SERVER_FAILED', 'Upozornění: Primární server směnných kurzů (%s) selhal pro %s (%s) - zkuste sekundární server směnných kurzů.');
?>