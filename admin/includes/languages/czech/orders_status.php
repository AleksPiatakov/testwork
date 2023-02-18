<?php
/*
  $Id: orders_status.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Stav objednávky');

define('TABLE_HEADING_ORDERS_STATUS', 'Stav objednávky');
define('TABLE_HEADING_ORDER_STATUS_TEXT','Text stavu objednávky');

define('TABLE_HEADING_DEFAULT', 'Výchozí');
define('TABLE_HEADING_ACTION', 'Akce');
define('TABLE_HEADING_COLOR', 'Barva');
define ('TABLE_HEADING_STATUS_SHOW', 'Zobrazit na domovské stránce správce');

define('TEXT_INFO_EDIT_INTRO', 'Proveďte prosím potřebné změny');
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Stav objednávky:');
define('TEXT_INFO_INSERT_INTRO', 'Zadejte prosím stav nové objednávky s příslušnými údaji');
define('TEXT_INFO_DELETE_INTRO', 'Opravdu chcete smazat tento stav objednávky?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'Stav nových objednávek');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Upravit stav objednávky');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Smazat stav objednávky');

define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Chyba: Výchozí stav objednávky nelze odstranit. Nastavte prosím jiný stav objednávky jako výchozí a zkuste to znovu.');
define('ERROR_STATUS_USED_IN_ORDERS', 'Chyba: Tento stav objednávky se aktuálně používá v objednávkách.');
define('ERROR_STATUS_USED_IN_HISTORY', 'Chyba: Tento stav objednávky je aktuálně použit v historii stavu objednávky.');
define('ERROR_ORDER_STATUS_IS_DEFAULT', "Nelze smazat výchozí stav objednávky");
define('TABLE_HEADING_DOWNLOADS', 'Povolit stahování elektronických produktů');