<?php
/*
  $ Id: orders_status.php, v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Lösungen
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce

    Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Bestellstatus');

define('TABLE_HEADING_ORDERS_STATUS', 'Bestellstatus');
define('TABLE_HEADING_ORDER_STATUS_TEXT','Bestellstatus-Text');
define('TABLE_HEADING_DEFAULT', 'Standard');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_COLOR', 'Farbe');
define ('TABLE_HEADING_STATUS_SHOW', 'Auf der Admin-Homepage anzeigen');

define('TEXT_INFO_EDIT_INTRO', 'Bitte nehmen Sie die notwendigen Änderungen vor');
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Bestellstatus: ');
define('TEXT_INFO_INSERT_INTRO', 'Bitte geben Sie den neuen Bestellstatus basierend auf den Originaldaten ein');
define('TEXT_INFO_DELETE_INTRO', 'Möchten Sie den Status dieser Bestellung wirklich löschen?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'Neuer Auftragsstatus');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Bestellstatus bearbeiten');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Auftragsstatus löschen');

define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Fehler: Der Standardauftragsstatus kann nicht gelöscht werden, ändern Sie den Status und versuchen Sie es erneut. ');
define('ERROR_STATUS_USED_IN_ORDERS', 'Fehler: Dieser Status wird gerade verwendet. ');
define('ERROR_STATUS_USED_IN_HISTORY', 'Fehler: Dieser Status wird derzeit in der Bestellhistorie verwendet. ');


define('ERROR_ORDER_STATUS_IS_DEFAULT', 'Sie können den Standardbestellstatus nicht löschen');
define('TABLE_HEADING_DOWNLOADS', 'Download von elektronischen Waren erlauben');