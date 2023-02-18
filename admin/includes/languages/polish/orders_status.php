<?php
/*
  $Id: orders_status.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Status zamówień');

define('TABLE_HEADING_ORDERS_STATUS', 'Status zamówień');
define('TABLE_HEADING_ORDER_STATUS_TEXT','Tekst statusu zamówienia');
define('TABLE_HEADING_DEFAULT', 'Domyślne');
define('TABLE_HEADING_ACTION', 'Działanie');
define('TABLE_HEADING_COLOR', 'Kolor');
define("TABLE_HEADING_STATUS_SHOW", "Pokaż na stronie głównej administratora");


define('TEXT_INFO_EDIT_INTRO', 'Wprowadź niezbędne zmiany.');
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Status zamówień:');
define('TEXT_INFO_INSERT_INTRO', 'Wprowadź status nowego zamówienia, na podstawie oryginalnych danych');
define('TEXT_INFO_DELETE_INTRO', 'Czy na pewno chcesz usunąć status tego zamówienia?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'Nowy status zamówienia');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Edytuj status zamówienia');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Usuń status zamówienia');

define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Błąd: Domyślny status zamówienia nie może zostać usunięty, zmień status i spróbuj ponownie.');
define('ERROR_STATUS_USED_IN_ORDERS', 'Błąd: Ten status jest obecnie w użyciu.');
define('ERROR_STATUS_USED_IN_HISTORY', 'Błąd: Ten status jest obecnie używany w historii zamówień.');



define('ERROR_ORDER_STATUS_IS_DEFAULT', 'Nie można usunąć domyślnego statusu zamówienia');
define('TABLE_HEADING_DOWNLOADS', 'Zezwalaj na pobieranie towarów elektronicznych');