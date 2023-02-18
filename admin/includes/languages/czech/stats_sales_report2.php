<?php
/*
  $Id: stats_customers.php,v 1.9 2002/03/30 15:03:59 harley_vb Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('REPORT_DATE_FORMAT', 'm. d. Y');

define('HEADING_TITLE', 'Zpráva o prodeji');

define('REPORT_TYPE_YEARLY', 'Ročně');
define('REPORT_TYPE_MONTHLY', 'Měsíčně');
define('REPORT_TYPE_WEEKLY', 'Týdně');
define('REPORT_TYPE_DAILY', 'Denně');
define('REPORT_START_DATE', 'od data');
define('REPORT_END_DATE', 'to date (včetně)');
define('REPORT_DETAIL', 'detail');
define('REPORT_MAX', 'zobrazit top');
define('REPORT_ALL', 'all');
define('REPORT_SORT', 'sort');
define('REPORT_EXP', 'export');
define('REPORT_SEND', 'send');
define('EXP_NORMAL', 'normální');
define('EXP_HTML', 'Pouze HTML');
define('EXP_CSV', 'CSV');

define('TABLE_HEADING_DATE', 'Datum');
define('TABLE_HEADING_ORDERS', '#Objednávky');
define('TABLE_HEADING_ITEMS', '#Items');
define('TABLE_HEADING_REVENUE', 'Tržby');
define('TABLE_HEADING_SHIPPING', 'Doprava');

define('DET_HEAD_ONLY', 'žádné podrobnosti');
define('DET_DETAIL', 'zobrazit podrobnosti');
define('DET_DETAIL_ONLY', 'podrobnosti s částkou');

define('SORT_VAL0', 'standardní');
define('SORT_VAL1', 'popis');
define('SORT_VAL2', 'description desc');
define('SORT_VAL3', '#Položky');
define('SORT_VAL4', '#Popis položek');
define('SORT_VAL5', 'Tržby');
define('SORT_VAL6', 'Sestup tržeb');

define('REPORT_STATUS_FILTER', 'Stav');

define('SR_SEPARATOR1', ';');
define('SR_SEPARATOR2', ';');
define('SR_NEWLINE', '\n\r');
?>