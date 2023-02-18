<?php
/*
  $Id: category.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

// BOF MaxiDVD: Přidáno pro balíček Ultimate-Images!
define('TEXT_COPY_LINK', 'Odkaz');
define('TEXT_PRODUCTS_IMAGE_NOTE','<b>Obrázek produktů:</b><small><br>Hlavní obrázek použitý na stránce<br><u>katalog a popis</u>.<small>');
define('TEXT_PRODUCTS_IMAGE_MEDIUM', '<b>Větší obrázek:</b><br><small>NAHRAZUJE malý obrázek na stránce<br><u>popisu produktu</u>.</small>');
define('TEXT_PRODUCTS_IMAGE_LARGE', '<b>Vyskakovací obrázek:</b><br><small>NAHRAZUJE malý obrázek na stránce<br><u>vyskakovací okno</u>.</small>' );
define('TEXT_PRODUCTS_IMAGE_LINKED', '<u>Produkty obchodu sdílející tento obrázek =</u>');
define('TEXT_PRODUCTS_IMAGE_REMOVE', '<b>Odstranit</b> tento obrázek z tohoto produktu?');
define('TEXT_PRODUCTS_IMAGE_DELETE', '<b>Smazat</b> tento obrázek ze serveru (trvale!)?');
define('TEXT_PRODUCTS_IMAGE_REMOVE_SHORT', 'Odebrat');
define('TEXT_PRODUCTS_IMAGE_DELETE_SHORT', 'Smazat');
define('TEXT_PRODUCTS_IMAGE_TH_NOTICE', '<b>SM = Malé obrázky,</b> pokud je použit obrázek "SM"<br>(Samotný) ŽÁDNÝ odkaz na vyskakovací okno je vytvořen, "SM"<br>( malý obrázek) bude umístěn přímo pod <br>popisem produktů. při použití ve spojení s <br>obrázkem "XL" vpravo se vytvoří odkaz na vyskakovací okno<br> a obrázek "XL" bude <br>zobrazeno ve vyskakovacím okně.<br><br>');
define('TEXT_PRODUCTS_IMAGE_XL_NOTICE', '<b>XL = Velké obrázky,</b> Používá se pro vyskakovací obrázek<br><br><br>');
define('TEXT_PRODUCTS_IMAGE_ADDITIONAL', 'Další doplňkové obrázky – pokud jsou použity, zobrazí se pod popisem produktu.');
// EOF MaxiDVD: Přidáno pro balíček Ultimate-Images!
define('HEADING_TITLE', 'Kategorie / Produkty');
define('HEADING_TITLE_SEARCH', 'Hledat:');
define('HEADING_TITLE_GOTO', 'Přejít na:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorie / Produkty');
define('TABLE_HEADING_ACTION', 'Akce');
define('TABLE_HEADING_STATUS', 'Stav');

define('TEXT_NEW_PRODUCT', 'Nový produkt v &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Kategorie:');
define('TEXT_SUBCATEGORIES', 'Podkategorie:');
define('TEXT_PRODUCTS', 'Produkty:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Cena:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Daňová třída:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Průměrné hodnocení:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Množství:');
define('TEXT_DATE_ADDED', 'Datum přidání:');
define('TEXT_DELETE_IMAGE', 'Smazat obrázek');

define('TEXT_DATE_AVAILABLE', 'Datum dostupnosti:');
define('TEXT_LAST_MODIFIED', 'Poslední úprava:');
define('TEXT_IMAGE_NONEEXISTENT', 'OBRÁZEK ​​NEEXISTUJE');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Vložte prosím novou kategorii nebo produkt do této úrovně.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Pro více informací prosím navštivte <a href="http://%s" target="blank"><u>webovou stránku</u></a> tohoto produktu.');
define('TEXT_PRODUCT_DATE_ADDED', 'Tento produkt byl přidán do našeho katalogu dne %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Tento produkt bude na skladě %s.');

define('TEXT_EDIT_INTRO', 'Proveďte prosím potřebné změny');
define('TEXT_EDIT_CATEGORIES_ID', 'ID kategorie:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Název kategorie:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Obrázek kategorie:');
define('TEXT_EDIT_CATEGORIES_ICON', 'Ikona kategorie:');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS', 'Zobrazit produkty:');
define('TEXT_EDIT_SORT_ORDER', 'Pořadí řazení:');
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'Název nadpisu kategorie:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Popis nadpisu kategorie:');

define('TEXT_INFO_COPY_TO_INTRO', 'Vyberte prosím novou kategorii, do které chcete zkopírovat tento produkt');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Aktuální kategorie:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nová kategorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Upravit kategorii');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Smazat kategorii');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Přesunout kategorii');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Smazat produkt');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Přesunout produkt');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopírovat do');

define('TEXT_DELETE_CATEGORY_INTRO', 'Opravdu chcete smazat tuto kategorii?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Opravdu chcete trvale smazat tento produkt?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>UPOZORNĚNÍ:</b> K této kategorii je stále připojeno %s (dítě-)kategorií!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>UPOZORNĚNÍ:</b> K této kategorii je stále připojeno %s produktů!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Vyberte prosím kategorii, ve které chcete <b>%s</b> sídlit');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Vyberte prosím kategorii, ve které chcete <b>%s</b> sídlit');
define('TEXT_MOVE', 'Přesunout <b>%s</b> do:');

define('TEXT_NEW_CATEGORY_INTRO', 'Vyplňte prosím následující informace pro novou kategorii');
define('TEXT_CATEGORIES_NAME', 'Název kategorie:');
define('TEXT_CATEGORIES_IMAGE', 'Obrázek kategorie:');
define('TEXT_SORT_ORDER', 'Pořadí řazení:');

define('TEXT_PRODUCTS_STATUS', 'Stav produktů:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Datum dostupnosti:');
define('TEXT_PRODUCT_AVAILABLE', 'Skladem');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Není skladem');
define('TEXT_PRODUCTS_MANUFACTURER', 'Výrobce produktů:');
define('TEXT_PRODUCTS_NAME', 'Název produktů:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Popis produktu:');
define('TEXT_PRODUCTS_QUANTITY', 'Množství produktů:');
define('TEXT_PRODUCTS_MODEL', 'Model produktů:');
define('TEXT_PRODUCTS_IMAGE', 'Obrázek produktů:');
define('TEXT_PRODUCTS_URL', 'Adresa URL produktů:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(bez http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Cena produktů (netto):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Cena produktů (hrubá):');
define('TEXT_PRODUCTS_WEIGHT', 'Hmotnost produktů:');
define('TEXT_NONE', '--none--');

define('EMPTY_CATEGORY', 'Prázdná kategorie');

define('TEXT_HOW_TO_COPY', 'Metoda kopírování:');
define('TEXT_COPY_AS_LINK', 'Odkaz na produkt');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicitní produkt');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Chyba: Nelze propojit produkty ve stejné kategorii.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Chyba: Adresář katalogových obrázků není zapisovatelný: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Chyba: Adresář katalogových obrázků neexistuje: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Chyba: Kategorie nemůže být přesunuta do podřízené kategorie.');


//
define('ENTRY_PRODUCTS_PRICE', 'Cena');
define('ENTRY_PRODUCTS_PRICE_DISABLED', 'Cena zakázána');
//


define('TEXT_PRODUCTS_PAGE_TITLE', 'Meta Title:');
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Meta popis:');
define('TEXT_PRODUCTS_KEYWORDS', 'Meta Keywords:');


// RJW Begin Meta Tags Code
  define('TEXT_META_TITLE', 'Meta Title');
  define('TEXT_META_DESCRIPTION', 'Meta popis');
  define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code
define('TABLE_HEADING_PARAMETERS', 'Vlastnosti produktů');

define('TEXT_PRODUCTS_INFO', 'Stručný popis:');

define('TEXT_ATTRIBUTE_HEAD', 'Atributy produktu:');
define('TABLE_HEADING_ATTRIBUTE_1', 'Aktivní atributy');
define('TABLE_HEADING_ATTRIBUTE_2', 'Prefix');
define('TABLE_HEADING_ATTRIBUTE_3', 'Cena');
define('TABLE_HEADING_ATTRIBUTE_4', 'Pořadí řazení');
define('TABLE_HEADING_ATTRIBUTE_5', 'Název souboru');
define('TABLE_HEADING_ATTRIBUTE_6', 'Vypršení platnosti odkazu (dny)');
define('TABLE_HEADING_ATTRIBUTE_7', 'Maximální počet stažení');
define('TABLE_HEADING_ATTRIBUTE_9', 'Hmotnost');

define('TABLE_HEADING_PRODUCT_SORT', 'Pořadí řazení');
define('TEXT_ATTRIBUTE_DESC', 'Nastavení atributů produktu.');

#Přidat:
define('TABLE_HEADING_XML', 'XML');
define('TEXT_PRODUCTS_TO_XML', 'XML soubory:');
define('TEXT_PRODUCT_AVAILABLE_TO_XML', 'Povolit');
define('TEXT_PRODUCT_NOT_AVAILABLE_TO_XML', 'Zakázat');

// Povolit BOF - Zakázat příspěvek kategorií--------------------------------------
define('TEXT_EDIT_STATUS', 'Stav');
define('TEXT_DEFINE_CATEGORY_STATUS', '1=Povolit; 0=Zakázat');
// Povolit EOF - Zakázat příspěvek kategorií--------------------------------------

define('TEXT_MIN_QUANTITY', 'Min:');
define('TEXT_MIN_QUANTITY_UNITS', 'Jednotky:');

define('ATTRIBUTES_COPY_MANAGER_1', 'Kopírovat atributy produktu do kategorie ...');
define('ATTRIBUTES_COPY_MANAGER_2', 'Kopírovat atributy produktu ');
define('ATTRIBUTES_COPY_MANAGER_3', ' ID produktu typu');
define('ATTRIBUTES_COPY_MANAGER_4', 'všem produktům v kategorii ');
define('ATTRIBUTES_COPY_MANAGER_5', 'Číslo kategorie: ');
define('ATTRIBUTES_COPY_MANAGER_6', 'Před kopírováním smažte všechny atributy a stažené soubory ');
define('ATTRIBUTES_COPY_MANAGER_7', 'Jinak ...');
define('ATTRIBUTES_COPY_MANAGER_8', 'Duplicitní atributy by měly být přeskočeny ');
define('ATTRIBUTES_COPY_MANAGER_9', 'Duplicitní atributy by měly být přepsány ');
define('ATTRIBUTES_COPY_MANAGER_10', 'Kopírovat atributy se staženými soubory ');
define('ATTRIBUTES_COPY_MANAGER_11', 'Vyberte kategorii');
define('ATTRIBUTES_COPY_MANAGER_12', 'Kopírovat atributy ze všech produktů do kategorie ');
define('ATTRIBUTES_COPY_MANAGER_13', 'Kopírka atributů produktů');
define('ATTRIBUTES_COPY_MANAGER_14', 'Vyberte produkt');
define('ATTRIBUTES_COPY_MANAGER_15', 'Číslo produktu: ');
define('ATTRIBUTES_COPY_MANAGER_16', 'Do produktu: ');
define('ATTRIBUTES_COPY_MANAGER_17', 'Před kopírováním nových atributů smažte všechny atributy ');
define('ATTRIBUTES_COPY_MANAGER_COPY', 'Kopírovat atributy');

define('TEXT_PAGES', 'Stránky: ');
define('TEXT_TOTAL_PRODUCTS', 'Produkty v této kategorii: ');
define('TEXT_ATT_UPLOAD', 'Nahrát...');

define('TEXT_WEIGHT_HELP', '<span class="main"><b>Upozornění:</b> Hmotnost musí být větší než 0. U virtuálních produktů (produktů ke stažení) musí být hmotnost 0.</span>');

define('HEADING_TITLE_SEARCH_MODEL', 'Hledání modelu produktu:');

define('TEXT_PRODUCTS_IMAGE_DIR', 'Nahrát do adresáře:');
define('TEXT_IMAGES_MAIN_DIRECTORY', 'obrázky');
define('TABLE_HEADING_YES','Ano');
define('TABLE_HEADING_NO','Ne');
define('TEXT_IMAGES_OVERWRITE', 'Přepsat existující obrázek?');
define('TEXT_IMAGES_OVERWRITE1', 'Použít Ne pro ručně zadávaná jména');
define('TEXT_IMAGE_OVERWRITE_WARNING','UPOZORNĚNÍ: FILENAME byl aktualizován, ale nebyl přepsán ');

define('TEXT_CAT_DELPHOTO', 'Smazat obrázek');
define('TEXT_CAT_ACTION', 'Akce');
define('TEXT_CAT_IMAGE', 'Obrázek');
define('TEXT_CAT_EDIT', 'Upravit');
define('TEXT_CAT_SUBCATS', 'Podkategorie');
define('TEXT_CAT_PRODUCTS', 'Produkty v kategorii');
define('TEXT_CAT_MODEL', 'model');
define('TEXT_CAT_QTY', 'množství');
define('TEXT_CAT_PRICE', 'price');
define('TEXT_FILTER_SPECIALS','Se specialitami');
define('TEXT_FILTER_CONCOMITANT','Concomitant');
define('TEXT_FILTER_TOP','Top');
define('TEXT_FILTER_NEW','NEW');
define('TEXT_FILTER_STOCK','Zásoba');
define('TEXT_FILTER_RECOMMEND','Doporučit');

//Knoflík
define('BUTTON_CANCEL_NEW', 'Zrušit');
define('BUTTON_BACK_NEW', 'Zpět');
define('BUTTON_NEW_CATEGORY_NEW', 'Nová kategorie');
define('BUTTON_NEW_PRODUCT_NEW', 'Nový produkt');

// WebMakers.com Přidáno: Možnost kopírování atributů
define('TEXT_COPY_ATTRIBUTES_ONLY','Pouze pro duplicitní produkty ...');
define('TEXT_COPY_ATTRIBUTES','Kopírovat atributy produktu do duplikace?');
define('TEXT_COPY_ATTRIBUTES_YES','Ano');
define('TEXT_COPY_ATTRIBUTES_NO','Ne');

define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_NOTHING','Nic');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_ALL','Všechny produkty podkategorií');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_TOP','NEJLEPŠÍ prodeje této kategorie');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_RECOMMENDED','Doporučeno pro tuto kategorii');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_NEW','Novinky této kategorie');
define('TEXT_ID_XML_CATEGORY','ID XML kategorie');
define('TEXT_VENDOR_XML_CATEGORY','Vendor XML kategorie');
define('ERROR_SYS_CATEGORY_EXIST','ID XML kategorie %s je již obsazeno <a href="'.DIR_WS_ADMIN . 'categories.php?cID=%s&action=edit_category" target="_blank">jinou kategorií</a>');
?>