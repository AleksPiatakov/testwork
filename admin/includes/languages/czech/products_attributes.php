<?php
/*
  $Id: products_attributes.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Možnosti produktu');
define('HEADING_TITLE_OPT', 'Možnosti produktu');
define('HEADING_TITLE_VAL', 'Hodnoty možností');
define('HEADING_TITLE_ATRIB', 'Atributy produktů');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_PRODUCT', 'Název produktu');
define('TABLE_HEADING_OPT_NAME', 'Název možnosti');

// otf 1.71 Nové definice polí
define('TABLE_HEADING_OPT_TYPE', 'Typ');
define('TABLE_HEADING_OPT_GROUP', 'Skupina možností');
define('TABLE_HEADING_OPT_LENGTH', 'Zobrazit ve filtru');
define('TABLE_HEADING_OPT_COMMENT', 'Zobrazit ve výpisu produktu');

define('TABLE_HEADING_OPT_VALUE', 'Hodnota volby');
define('TABLE_HEADING_OPT_PRICE', 'Hodnotná cena');
define('TABLE_HEADING_OPT_PRICE_PREFIX', 'Prefix');
define('TABLE_HEADING_ACTION', 'Akce');
define('TABLE_HEADING_DOWNLOAD', 'Produkty ke stažení:');
define('TABLE_TEXT_FILENAME', 'Název souboru:');
define('TABLE_TEXT_MAX_DAYS', 'Dny vypršení platnosti:');
define('TABLE_TEXT_MAX_COUNT', 'Maximální počet stažení:');

define('MAX_ROW_LISTS_OPTIONS', 10);

define('TEXT_WARNING_OF_DELETE', 'Tato volba má propojené produkty a hodnoty - není bezpečné ji smazat.');
define('TEXT_OK_TO_DELETE', 'S touto volbou nejsou spojeny žádné produkty a hodnoty - je bezpečné ji smazat.');
define('TEXT_OPTION_ID', 'ID možnosti');
define('TEXT_OPTION_NAME', 'Název možnosti');
define('TEXT_OPTION_SORT_ORDER', 'Pořadí řazení:');

define('TEXT_PRAT_DEL', 'smazat');
define('TEXT_PRAT_COLOR', 'Obrázek');
define('TEXT_ALERT1', 'Chyba: existují produkty (ve výši <b>%d</b>), ve kterých je uvedena hodnota tohoto atributu');
define('TEXT_ALERT2', 'Tento atribut má přidružené hodnoty (ve výši <b>%d</b>), při mazání aributu budou hodnoty smazány. Opravdu chcete atribut smazat? ');

define('TEXT_TYPE_TEXT','Text');
define('TEXT_TYPE_SELECT','Rozbalovací nabídka');
define('TEXT_TYPE_RADIO','Rádio');
define('TEXT_TYPE_CHECKBOX','Zaškrtávací políčko');
define('TEXT_TYPE_TEXTAREA','Obrázek');

define('HEADING_TITLE_GROUP', 'Skupiny atributů');
define('TEXT_OPTION_GROUP_NAME', 'Název skupiny atributů');
?>