<?php
/*
  $Id: stats_monthly_sales.php,v 1.1 2003/09/28 23:39:22 otherlango Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Měsíční tržby/přehled daní');
define('HEADING_TITLE_STATUS','Status');
define('HEADING_TITLE_REPORTED','Nahlášeno');
define('TEXT_ALL_ORDERS', 'Všechny objednávky');
define('TEXT_NOTHING_FOUND', 'Pro toto datum/výběr stavu nebyl nalezen žádný příjem');
define('TEXT_BUTTON_REPORT_PRINT','Tisk');
define('TEXT_BUTTON_REPORT_FILE','Soubor');
define('TEXT_BUTTON_REPORT_HELP','Nápověda');
define('TEXT_BUTTON_REPORT_PRINT_DESC', 'Zobrazit zprávu v okně pro tisk');
define('TEXT_BUTTON_REPORT_FILE_DESC', 'Stáhnout textový soubor s daty v této zprávě jako hodnoty oddělené čárkami');
define('TABLE_HEADING_PRODUCTS_QUANTITY', 'Celkový počet objednávek<br>');
define('TEXT_BUTTON_REPORT_HELP_DESC', 'O tomto přehledu a jak používat jeho funkce');
define('TEXT_REPORT_DATE_FORMAT', 'j M Y - g:i a'); // řetězec formátu data
// jak je uvedeno v php manuálu zde: http://www.php.net/manual/en/function.date.php
define('TABLE_HEADING_YEAR','Rok');
define('TABLE_HEADING_MONTH', 'Měsíc');
define('TABLE_HEADING_DAYS', 'Dny');
define('TABLE_HEADING_INCOME', 'Hrubý<br> příjem');
define('TABLE_HEADING_SALES', 'Prodej<br> produktu');
define('TABLE_HEADING_NONTAXED', 'Výjimka<br> prodej');
define('TABLE_HEADING_TAXED', 'Zdanitelné<br> prodeje');
define('TABLE_HEADING_TAX_COLL', 'Daň<br> zaplacená');
define('TABLE_HEADING_SHIPHNDL', 'Shpg<br> & Hndlg');
define('TABLE_HEADING_LOWORDER', 'Nízké poplatky<br> objednávky');
define('TABLE_HEADING_OTHER', 'Dárkové<br> poukázky'); // může být jakákoli jiná hodnota extra třídy
define('TABLE_FOOTER_YTD','YTD');
define('TABLE_FOOTER_YEAR','YEAR');
define('SHOW_TEXT','Show');
?>