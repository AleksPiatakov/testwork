<?php
/*
  $ Id: stats_monthly_sales.php, v 1.1 2003/09/28 23:39:22 anotherlango Exp $

  osCommerce, Open Source E-Commerce Lösungen
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce

    Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Verkaufsstatistik');
define('HEADING_TITLE_STATUS', 'Status');
define('HEADING_TITLE_REPORTED', 'Datum');
define('TEXT_ALL_ORDERS', 'Alle Bestellungen');
define('TEXT_NOTHING_FOUND', 'Es gab keine Aufträge für den ausgewählten Zeitraum');
define('TEXT_BUTTON_REPORT_PRINT', 'Druckbare Version');
define('TEXT_BUTTON_REPORT_FILE', 'Datei');
define('TEXT_BUTTON_REPORT_HELP', 'Hilfe');
define('TEXT_BUTTON_REPORT_PRINT_DESC', 'Druckbare Version anzeigen');
define('TEXT_BUTTON_REPORT_FILE_DESC', 'Report im txt-Format herunterladen, durch Komma getrennt');
define('TEXT_BUTTON_REPORT_HELP_DESC', 'Über diesen Bericht');
define('TEXT_REPORT_DATE_FORMAT', 'j M Y - g:i a'); // Datumsformat-String
// wie in php Handbuch hier angegeben: http://www.php.net/manual/en/function.date.php
define('TABLE_HEADING_YEAR', 'Jahr');
define('TABLE_HEADING_MONTH', 'Monat');
define('TABLE_HEADING_DAYS', 'Day');
define('TABLE_HEADING_INCOME', 'Total<br>');
define('TABLE_HEADING_PRODUCTS_QUANTITY', 'Bestellungen insgesamt<br>');
define('TABLE_HEADING_SALES', 'Gesamtkosten der Waren');
define('TABLE_HEADING_NONTAXED', 'Die Kosten der Waren');
define('TABLE_HEADING_TAXED', 'Inklusive Steuern');
define('TABLE_HEADING_TAX_COLL', 'Steuern');
define('TABLE_HEADING_SHIPHNDL', 'Lieferung');
define('TABLE_HEADING_LOWORDER', 'Niedrig zu Wert');
define('TABLE_HEADING_OTHER', 'Zertifikate'); // könnte jeder andere zusätzliche Klassenwert sein
define('TABLE_FOOTER_YTD', 'Year');
define('TABLE_FOOTER_YEAR', 'Year');
define('SHOW_TEXT','Zeigen');
?>