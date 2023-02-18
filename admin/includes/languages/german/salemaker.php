<?php
/*
  $Id: salemaker.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Mengenrabatt');

define('TABLE_HEADING_SALE_NAME', 'Freigabename');
define('TABLE_HEADING_SALE_DEDUCTION', 'Deduction');
define('TABLE_HEADING_SALE_DATE_START', 'Valid Aktionen');
define('TABLE_HEADING_SALE_DATE_END', 'Enddatum');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_SALEMAKER_NAME', 'Freigabename: ');
define('TEXT_SALEMAKER_DEDUCTION', 'Deduction: ');
define('TEXT_SALEMAKER_DEDUCTION_TYPE', 'Typ:');
define('TEXT_SALEMAKER_PRICERANGE_FROM', 'Artikel kosten von: ');
define('TEXT_SALEMAKER_PRICERANGE_TO', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;zu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
define('TEXT_SALEMAKER_SPECIALS_CONDITION', 'Wenn ein Artikel bereits in Rabatten ist');
define('TEXT_SALEMAKER_DATE_START', 'Startdatum der Aktion: ');
define('TEXT_SALEMAKER_DATE_END', 'Enddatum: ');
define('TEXT_SALEMAKER_CATEGORIES', '<b>oder</b>, wählen Sie die Kategorie, für die für diese Aktion gültig ist: ');
define('TEXT_SALEMAKER_MANUFACTURERS', '<b>oder</b>, wählen Sie die hersteller, für die für diese Aktion gültig ist: ');
define('TEXT_SALEMAKER_POPUP', '<a href="javascript:session_win();"><span class="errorText"><b>Richtlinien für die Erstellung und Verwendung von massiven Rabatten.</b></span></a>');
define('TEXT_SALEMAKER_IMMIEDIATELY', 'Sofort');
define('TEXT_SALEMAKER_NEVER', 'Keine Einschränkungen');
define('TEXT_SALEMAKER_ENTIRE_CATALOG', 'Überprüfen Sie, ob die Förderung für <b>alle</b> von Filialwaren gültig ist: ');
define('TEXT_SALEMAKER_TOP', 'Der Rabatt ist für alle Vorratswaren valid');
define('TEXT_SALEMAKER_IMMEDIATELY', 'Sofort    ');

define('TEXT_INFO_DATE_ADDED', 'Erstellungsdatum: ');
define('TEXT_INFO_DATE_MODIFIED', 'Letzte Änderungen: ');
define('TEXT_INFO_DATE_STATUS_CHANGE', 'Das letzte Mal wurde der Status des Bestands geändert');
define('TEXT_INFO_SPECIALS_CONDITION', 'Wenn das Produkt bereits in Rabatten ist: ');
define('TEXT_INFO_DEDUCTION', 'Deduction: ');
define('TEXT_INFO_PRICERANGE_FROM', 'Warenwert von: ');
define('TEXT_INFO_PRICERANGE_TO', 'zu');
define('TEXT_INFO_DATE_START', 'Aktion Start Aktion: ');
define('TEXT_INFO_DATE_END', 'Enddatum: ');

define('SPECIALS_CONDITION_DROPDOWN_0', 'Ignorieren Sie den Sonderpreis und legte das Gesicht massive Rabatte');
define('SPECIALS_CONDITION_DROPDOWN_1', 'Ignoriere die Massenrabattbedingung für ein solches Produkt');
define('SPECIALS_CONDITION_DROPDOWN_2', 'In dem Masse Rabatt Sonderpreis eine Bedingung');

define('DEDUCTION_TYPE_DROPDOWN_0', 'Abzugsbetrag');
define('DEDUCTION_TYPE_DROPDOWN_1', 'prozentuale Rabatte');
define('DEDUCTION_TYPE_DROPDOWN_2', 'Neuer Preis');

define('TEXT_INFO_HEADING_COPY_SALE', 'Kopie teilen');
define('TEXT_INFO_COPY_INTRO', 'Geben Sie einen Namen für die kopierte Aktion<br>&nbsp;&nbsp;"%s"');

define('TEXT_INFO_HEADING_DELETE_SALE', 'Löschvorgang');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie diese Aktion löschen möchten?');
define('TEXT_DISPLAY_NUMBER_OF_SALES', 'angezeigte <b>%d</b> - <b>%d</b> (alle <b>%d</b> Massenrabatte)');

//Button
define('BUTTON_CANCEL_NEW', 'stornieren');
define('BUTTON_EDIT_NEW', 'bearbeiten');
define('BUTTON_UNLOCK_NEW', 'freischalten');
define('BUTTON_PREVIEW_NEW', 'vorschau');
define('BUTTON_BACK_NEW', 'zurück');
define('BUTTON_NEWSLETTER_NEW', 'newsletter');
define('BUTTON_DELETE_NEW', 'löschen');
define('BUTTON_LOCK_NEW', 'sperren');
define('BUTTON_SEND_NEW', 'senden');
define('BUTTON_INSERT_NEW', 'einfügen');
define('BUTTON_RESET_NEW', 'zurücksetzen');
define('BUTTON_SALE_NEW', 'verkauf');
define('BUTTON_COPY_TO_NEW', 'kopieren nach');
?>