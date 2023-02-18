<?php
/*
  $ Id: extra_product_price.php, v 1.0 2005/09/11 15:18:15 wacht Exp $


    Released under the GNU General Public License
*/

// BOF FlyOpenair: Extra Product Price

define('HEADING_TITLE', 'Randsystem');

define('TABLE_EXTRA_PRODUCT_PRICE_NAME', 'Name');
define('TABLE_EXTRA_PRODUCT_PRICE_DEDUCTION', 'Extra charge');
define('TABLE_EXTRA_PRODUCT_PRICE_HEADING_DEDUCTION_STATUS', 'Status');
define('TABLE_EXTRA_PRODUCT_PRICE_HEADING_ACTION', 'Aktion');



define('TEXT_EXTRA_PRODUCT_PRICE_DEDUCTION_TYPE', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Typ:&nbsp;&nbsp;');
define('TEXT_EXTRA_PRODUCT_PRICE_PRICERANGE_FROM', 'Kosten für Waren');
define('TEXT_EXTRA_PRODUCT_PRICE_PRICERANGE_TO', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;zu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');

define('TEXT_EXTRA_PRODUCT_PRICE_CATEGORIES', '<b>oder</b>, wählen Sie die Kategorie, für die gegebenen gültig ist der Marge: ');


define('TEXT_EXTRA_PRODUCT_PRICE_ENTIRE_CATALOG', 'Überprüfen Sie, ob die Marge gilt <b>alle</b> von Speicherwaren: ');
define('TEXT_EXTRA_PRODUCT_PRICE_TOP', 'gilt Zuschlag für alle Waren lagern');

define('TEXT_INFO_DATE_ADDED', 'Erstellungsdatum: ');
define('TEXT_INFO_DATE_MODIFIED', 'Letzte Änderungen: ');
define('TEXT_INFO_DEDUCTION', 'Zuschlag: ');
define('TEXT_INFO_PRICERANGE_FROM', 'Warenwert von: ');
define('TEXT_INFO_PRICERANGE_TO', 'zu');

define('DEDUCTION_TYPE_DROPDOWN_0', 'Addition zum Betrag');
define('DEDUCTION_TYPE_DROPDOWN_1', 'Prozentsatz der zusätzlichen Gebühr');
define('DEDUCTION_TYPE_DROPDOWN_2', 'Neuer Preis');

define('TEXT_INFO_HEADING_COPY_SALE', 'Kopieren eines Zuschlags');
define('TEXT_INFO_COPY_INTRO', 'Geben Sie<Br>&nbsp einen Namen für den kopierten Rand<br>&nbsp;&nbsp;"%s"');

define('TEXT_INFO_HEADING_DELETE_SALE', 'Zuschlag entfernen');
define('TEXT_INFO_DELETE_INTRO', 'Möchten Sie diesen Zuschlag wirklich löschen?');
define('TEXT_DISPLAY_NUMBER_OF_EXTRA_PRODUCT_PRICE', 'angezeigte <b>% d</b> - <b>%d</b> (all <b>%d</b> Ladung)');
define('IMAGE_NEW_EXTRA_PRODUCT_PRICE', 'Neues Markup');


// EOF FlyOpenair: Extra Product Price
//Button
define('BUTTON_CANCEL_NEW', 'stornieren');
define('BUTTON_EDIT_NEW', 'bearbeiten');
define('BUTTON_BACK_NEW', 'zurück');
define('BUTTON_DELETE_NEW', 'löschen');
define('BUTTON_NEW_SALE_NEW', 'neuer Verkauf');
define('BUTTON_COPY_TO_NEW', 'kopieren nach');
?>