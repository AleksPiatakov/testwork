<?php
/*
  $Id: mysqlperformance.php,v 1.0 2007/02/04 22:50:51 hpdl Exp $
  Jazykový soubor
  Příspěvek od Biznetstar.com

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'MYSQL PERFORMANCE');

define('TABLE_HEADING_NUMBER', '#');
define('TABLE_HEADING_QUERY', 'Dotaz');
define('TABLE_HEADING_QLOCATION', 'Dotaz na umístění');
define('TABLE_HEADING_QUERY_TIME', 'Čas dotazu');
define('TABLE_HEADING_DATE_CREATED', 'Datum vytvoření');

define('TEXT_NOTE_MYSQL_PERFORMANCE', 'Poznámka: Toto jsou pouze dotazy, které trvaly déle než ' . MYSQL_PERFORMANCE_TRESHOLD . ' sekund. <br/>Nejstarší záznamy jsou zobrazeny jako první. ');
define('TEXT_NOTE_2_MYSQL_PERFORMANCE', '');
define('TEXT_DELETE_QUERY','DELETE dotaz z logu.');
define('TEXT_INFO_HEADING_DELETE','DELETE dotaz');
define('TEXT_INFO_DELETE_INTRO','Smazat tento dotaz z logu?');
define('TEXT_DELETE','Smazat všechny záznamy?');

//Knoflík
define('BUTTON_DELETE_NEW','delete');
define('BUTTON_DELETE_ALL_NEW','smazat vše');
define('BUTTON_CANCEL_NEW','zrušit');
?>