<?php
/*
  $Id: attributeManager.php,v 1.0 21/02/06 Sam West$

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Vydáno pod GNU General Public License
  
  Anglický překlad do AJAX-AttributeManager-V2.7
  
  od Šimona Doodkina
  http://help.me.pro.googlepages.com
  helpmepro1@gmail.com
*/

//attributeManagerPrompts.inc.php

define('AM_AJAX_YES', 'Ano');
define('AM_AJAX_NO', 'Ne');
define('AM_AJAX_UPDATE', 'Aktualizovat');
define('AM_AJAX_CANCEL', 'Zrušit');
define('AM_AJAX_OK', 'OK');

define('AM_AJAX_SORT', 'Třídit:');
define('AM_AJAX_TRACK_STOCK', 'Sledovat zásoby?');
define('AM_AJAX_TRACK_STOCK_IMGALT', 'Sledovat zásoby tohoto atributu?');

define('AM_AJAX_ENTER_NEW_OPTION_NAME', 'Zadejte nový název možnosti');
define('AM_AJAX_ENTER_NEW_OPTION_VALUE_NAME', 'Zadejte nový název možnosti');
define('AM_AJAX_ENTER_NEW_OPTION_VALUE_NAME_TO_ADD_TO', 'Zadejte nový název hodnoty možnosti, který chcete přidat do %s');

define('AM_AJAX_PROMPT_REMOVE_OPTION_AND_ALL_VALUES', 'Opravdu chcete z tohoto produktu odstranit %s a všechny hodnoty pod ním?');
define('AM_AJAX_PROMPT_REMOVE_OPTION', 'Opravdu chcete odstranit %s z tohoto produktu?');
define('AM_AJAX_PROMPT_STOCK_COMBINATION', 'Opravdu chcete odstranit tuto skladovou kombinaci z tohoto produktu?');

define('AM_AJAX_PROMPT_LOAD_TEMPLATE', 'Opravdu chcete načíst šablonu %s? <br />Toto přepíše aktuální atributy tohoto produktu a nelze to vrátit zpět.');
define('AM_AJAX_NEW_TEMPLATE_NAME_HEADER', 'Zadejte prosím nový název nové šablony. Nebo...');
define('AM_AJAX_NEW_NAME', 'Nové jméno:');
define('AM_AJAX_CHOOSE_EXISTING_TEMPLATE_TO_OVERWRITE', ' ...<br /> ... Vyberte existující šablonu, kterou chcete přepsat');
define('AM_AJAX_CHOOSE_EXISTING_TEMPLATE_TITLE', 'Stávající:');
define('AM_AJAX_RENAME_TEMPLATE_ENTER_NEW_NAME', 'Zadejte prosím nový název pro %s šablonu');
define('AM_AJAX_PROMPT_DELETE_TEMPLATE', 'Opravdu chcete smazat šablonu %s?<br>Toto nelze vrátit zpět!');

//attributeManager.php

define('AM_AJAX_ADDS_ATTRIBUTE_TO_OPTION', 'Přidá vybraný atribut nalevo k atributu %s');
define('AM_AJAX_ADDS_NEW_VALUE_TO_OPTION', 'Přidá novou hodnotu do atributu %s');
define('AM_AJAX_PRODUCT_REMOVES_OPTION_AND_ITS_VALUES', 'Odstraní atribut %1$s a hodnotu(y) atributu %2$d pod ním z tohoto produktu');
define('AM_AJAX_CHANGES', 'Změny');
define('AM_AJAX_LOADS_SELECTED_TEMPLATE', 'Načte vybranou šablonu');
define('AM_AJAX_SAVES_ATTRIBUTES_AS_A_NEW_TEMPLATE', 'Uloží aktuální atributy jako novou šablonu');
define('AM_AJAX_RENAMES_THE_SELECTED_TEMPLATE', 'Přejmenuje vybranou šablonu');
define('AM_AJAX_DELETES_THE_SELECTED_TEMPLATE', 'Smaže vybranou šablonu');
define('AM_AJAX_NAME', 'Atributy');
define('AM_AJAX_ACTION', 'Akce');
define('AM_AJAX_OPTION_VALUES', 'Hodnoty možností');
define('AM_AJAX_OPTION_VALUES_NAME', 'Hodnota možnosti');
define('AM_AJAX_OPTION_VALUES_PRICE_PREFIX', 'Předpona ceny');
define('AM_AJAX_OPTION_VALUES_PRICE', 'Cena');
define('AM_AJAX_OPTION_VALUES_QUANTITY', 'Množství');
define('AM_AJAX_OPTION_VALUES_ADD', 'Přidat');
define('AM_AJAX_OPTION_VALUES_CREATE', 'Vytvořit');
define('AM_AJAX_OPTION_VALUES_DELETE', 'Smazat');
define('AM_AJAX_OPTION_VALUES_OK', 'OK');
define('AM_AJAX_PRODUCT_REMOVES_VALUE_FROM_OPTION', 'Odstraní %1$s z %2$s, z tohoto produktu');
define('AM_AJAX_MOVES_VALUE_UP', 'Posune hodnotu atributu nahoru');
define('AM_AJAX_MOVES_VALUE_DOWN', 'Posune hodnotu atributu dolů');
define('AM_AJAX_ADDS_NEW_OPTION', 'Přidá nový atribut do seznamu');
define('AM_AJAX_OPTION', 'Atribut:');
define('AM_AJAX_VALUE', 'Hodnota:');
define('AM_AJAX_PREFIX', 'Prefix:');
define('AM_AJAX_PRICE', 'Cena:');
define('AM_AJAX_OR', 'nebo');
define('AM_AJAX_WEIGHT_PREFIX', 'Wgt.Prefix:');
define('AM_AJAX_WEIGHT', 'Hmotnost:');
define('AM_AJAX_SORT', 'Třídit:');
define('AM_AJAX_ADDS_NEW_OPTION_VALUE', 'Přidá novou hodnotu atributu do seznamu');
define('AM_AJAX_ADDS_ATTRIBUTE_TO_PRODUCT', 'Přidá atribut k aktuálnímu produktu');
define('AM_AJAX_DELETES_ATTRIBUTE_FROM_PRODUCT', 'Smaže atribut nebo kombinaci atributů z aktuálního produktu');
define('AM_AJAX_QUANTITY', 'Množství:');
define('AM_AJAX_PRODUCT_REMOVE_ATTRIBUTE_COMBINATION_AND_STOCK', 'Odstraní tuto kombinaci atributů a zásoby z tohoto produktu');
define('AM_AJAX_UPDATE_OR_INSERT_ATTRIBUTE_COMBINATIONBY_QUANTITY', 'Aktualizujte nebo vložte kombinaci atributů s daným množstvím');
define('AM_AJAX_UPDATE_PRODUCT_QUANTITY', 'Nastavte dané množství na aktuální produkt');

//attributeManager.class.php
define('AM_AJAX_TEMPLATES', '-- Šablony --');

//-----------------------------
// Změna: stahování atributů pro AM
//
// autor: mytool
//------------------------------
define('AM_AJAX_FILENAME', 'Soubor');
define('AM_AJAX_FILE_DAYS', 'Dny');
define('AM_AJAX_FILE_COUNT', 'Max. počet stažení');
define('AM_AJAX_DOWLNOAD_EDIT', 'Upravit atribut stahování');
define('AM_AJAX_DOWLNOAD_ADD_NEW', 'Přidat attr stahováníibute');
define('AM_AJAX_DOWLNOAD_DELETE', 'Smazat atribut stahování');
define('AM_AJAX_HEADER_DOWLNOAD_ADD_NEW', 'Přidat atribut stahování pro \"%s\"');
define('AM_AJAX_HEADER_DOWLNOAD_EDIT', 'Upravit atribut stahování pro \"%s\"');
define('AM_AJAX_HEADER_DOWLNOAD_DELETE', 'Smazat atribut stahování z \"%s\"');
define('AM_AJAX_FIRST_SAVE', 'Před přidáním atributů uložte produkt');

//-----------------------------
// Změna EOF: stahování atributů pro AM
//------------------------------

define('AM_AJAX_OPTION_NEW_PANEL','Nový atribut');
define('AM_AJAX_PC','pc.');
?>
