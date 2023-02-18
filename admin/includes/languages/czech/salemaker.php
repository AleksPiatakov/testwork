<?php
/*
  $Id: salemaker.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'SaleMaker');

define('TABLE_HEADING_SALE_NAME', 'Název prodeje');
define('TABLE_HEADING_SALE_DEDUCTION', 'Odpočet');
define('TABLE_HEADING_SALE_DATE_START', 'Datum zahájení');
define('TABLE_HEADING_SALE_DATE_END', 'Konec');
define('TABLE_HEADING_STATUS', 'Stav');
define('TABLE_HEADING_ACTION', 'Akce');

define('TEXT_SALEMAKER_NAME', 'Název prodeje:');
define('TEXT_SALEMAKER_DEDUCTION', 'Odpočet:');
define('TEXT_SALEMAKER_DEDUCTION_TYPE', 'Typ:');
define('TEXT_SALEMAKER_PRICERANGE_FROM', 'Cenový rozsah produktů:');
define('TEXT_SALEMAKER_PRICERANGE_TO', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Komu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
define('TEXT_SALEMAKER_SPECIALS_CONDITION', 'Pokud je produkt speciální:');
define('TEXT_SALEMAKER_DATE_START', 'Datum zahájení:');
define('TEXT_SALEMAKER_DATE_END', 'Datum ukončení:');
define('TEXT_SALEMAKER_CATEGORIES', '<b>Nebo</b> zkontrolujte kategorie, kterých se tento prodej týká:');
define('TEXT_SALEMAKER_MANUFACTURERS', '<b>Nebo</b> zkontrolujte výrobce, na které se tento prodej vztahuje:');
define('TEXT_SALEMAKER_POPUP', '<a href="javascript:session_win();"><span class="errorText"><b>Kliknutím sem zobrazíte tipy k použití prodejce.</b></span></a> ');
define('TEXT_SALEMAKER_IMMEDIATELY', 'Ihned');
define('TEXT_SALEMAKER_NEVER', 'Nikdy');
define('TEXT_SALEMAKER_ENTIRE_CATALOG', 'Zaškrtněte toto políčko, pokud chcete, aby se akce vztahovala na <b>všechny produkty</b>:');
define('TEXT_SALEMAKER_TOP', 'Celý katalog');

define('TEXT_INFO_DATE_ADDED', 'Datum přidání:');
define('TEXT_INFO_DATE_MODIFIED', 'Poslední úprava:');
define('TEXT_INFO_DATE_STATUS_CHANGE', 'Poslední změna stavu:');
define('TEXT_INFO_SPECIALS_CONDITION', 'Speciální stav:');
define('TEXT_INFO_DEDUCTION', 'Odpočet:');
define('TEXT_INFO_PRICERANGE_FROM', 'Cenové rozpětí:');
define('TEXT_INFO_PRICERANGE_TO', ' až ');
define('TEXT_INFO_DATE_START', 'Začátek:');
define('TEXT_INFO_DATE_END', 'Platnost vyprší:');

define('SPECIALS_CONDITION_DROPDOWN_0', 'Ignorovat speciální cenu');
define('SPECIALS_CONDITION_DROPDOWN_1', 'Ignorovat podmínky prodeje');
define('SPECIALS_CONDITION_DROPDOWN_2', 'Použít slevu z prodeje na speciální cenu');

define('DEDUCTION_TYPE_DROPDOWN_0', 'Částka odečtení');
define('DEDUCTION_TYPE_DROPDOWN_1', 'Procenta');
define('DEDUCTION_TYPE_DROPDOWN_2', 'Nová cena');

define('TEXT_INFO_HEADING_COPY_SALE', 'Kopírovat prodej');
define('TEXT_INFO_COPY_INTRO', 'Zadejte název pro kopii<br>&nbsp;&nbsp;"%s"');

define('TEXT_INFO_HEADING_DELETE_SALE', 'Smazat prodej');
define('TEXT_INFO_DELETE_INTRO', 'Opravdu chcete trvale smazat tento prodej?');
define('TEXT_DISPLAY_NUMBER_OF_SALES', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> prodejů)');

//Knoflík
define('BUTTON_CANCEL_NEW', 'zrušit');
define('BUTTON_EDIT_NEW', 'edit');
define('BUTTON_UNLOCK_NEW', 'odemknout');
define('BUTTON_PREVIEW_NEW', 'náhled');
define('BUTTON_BACK_NEW', 'zpět');
define('BUTTON_NEWSLETTER_NEW', 'newsletter');
define('BUTTON_DELETE_NEW', 'smazat');
define('BUTTON_LOCK_NEW', 'lock');
define('BUTTON_SEND_NEW', 'odeslat');
define('BUTTON_INSERT_NEW', 'vložit');
define('BUTTON_RESET_NEW', 'reset');
define('BUTTON_SALE_NEW', 'prodej');
define('BUTTON_COPY_TO_NEW', 'kopírovat do');
?>