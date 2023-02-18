<?php
/*
  $Id: products_multi.php, v 2.0

  autor: sr, 2003-07-31 / sr@ibis-project.de

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Správce více produktů');
define('HEADING_TITLE_SEARCH', 'Hledat:');
define('HEADING_TITLE_GOTO', 'Přejít na:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_CHOOSE', 'Vybrat');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorie / Produkty');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_ACTION', 'Akce');
define('TABLE_HEADING_PRODUCTS_QUANTITY', 'Množství');
define('TABLE_HEADING_MANUFACTURERS_NAME', 'Výrobce');
define('TABLE_HEADING_STATUS', 'Stav');

define('DEL_DELETE', 'smazat produkt');
define('DEL_CHOOSE_DELETE_ART', 'Jak smazat?');
define('DEL_THIS_CAT', 'pouze z této kategorie');
define('DEL_COMPLETE', 'celkové smazání produktu ');

define('TEXT_NEW_PRODUCT', 'Nový produkt v &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Kategorie:');
define('TEXT_ATTENTION_DANGER', '');
/*
define('TEXT_ATTENTION_DANGER', '<br><br><span class="dataTableContentRedAlert">!!! Внимание !!! пожалуйста прочтите !!!</span><br><br><span class="dataTableContentRed" >Этот инструмент меняет таблицы "products_to_categories" (и в случае  \' полностью удалить товар\' даже "products" и "products_description" among others; через функцию \'tep_remove_product\') - поэтому делать резервную копию этих таблиц перед каждым использованием этого инструмента ОЧЕНЬ рекомендуется. Причины:<br><br>Tento nástroj odstraní, přesune nebo zkopíruje všechny vybrané produkty prostřednictvím zaškrtávacího políčka bez jakéhokoli přechodného kroku nebo varování, to znamená okamžitě po kliknutí na tlačítko Přejít.</span><br><br> ><span class="dataTableContentRedAlert">Dávejte prosím pozor:</span><ul><li>Věnujte velkou pozornost používání <strong>\'smazat celý produkt\'</strong>. Tato funkce smaže všechny vybrané produkty okamžitě, bez přechodného kroku nebo varování a úplně ze všech tabulek, kam tyto produkty patří.</strong></li><li>Zatímco ch po zobrazení <strong>\'smazat produkt pouze v této kategorii\'</strong> nejsou zcela smazány žádné produkty, ale pouze jejich odkazy na aktuálně otevřenou kategorii - i když je to jediný odkaz na kategorii produktu, a bez varování to znamená: buďte opatrní i s tímto nástrojem pro mazání.</li><li>Během <strong>kopírování</strong> nejsou produkty duplikovány, jsou pouze spojeny s nově zvolenou kategorií.</li><li>Během <strong>kopírování</strong> nejsou produkty duplikovány, jsou pouze spojeny s nově vybranou kategorií.</li><li>Během <strong>kopírování</strong> se produkty neduplikují. li><li>Produkty jsou pouze <strong>přesouvány</strong> resp. <strong>zkopírovány</strong> do nové kategorie v případě, že tam již neexistují.</li></ul>');
*/
define('TEXT_MOVE_TO', 'přesunout do');
define('TEXT_CHOOSE_ALL', 'zkontrolovat vše');
define('TEXT_CHOOSE_ALL_REMOVE', 'zrušit zaškrtnutí');
define('TEXT_SUBCATEGORIES', 'Podkategorie:');
define('TEXT_PRODUCTS', 'Produkty:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Cena:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Daňová třída:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'prům. hodnocení:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'množství:');
define('TEXT_DATE_ADDED', 'přidáno:');
define('TEXT_DATE_AVAILABLE', 'available:');
define('TEXT_LAST_MODIFIED', 'upraveno:');
define('TEXT_IMAGE_NONEEXISTENT', 'OBRÁZEK ​​NEEXISTUJE');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Zadejte novou kategorii nebo produkt do <br>&nbsp;<br><b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Navštivte <a href="http://%s" target="blank"><u>tuto stránku</u></a> pro více informací.');
define('TEXT_PRODUCT_DATE_ADDED', 'Tento produkt byl přidán do katalogu %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Tento produkt bude dostupný za %s.');

define('TEXT_EDIT_INTRO', 'Proveďte změny');
define('TEXT_EDIT_CATEGORIES_ID', 'ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Jméno:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Obrázek:');
define('TEXT_EDIT_SORT_ORDER', 'Pořadí řazení:');

define('TEXT_INFO_COPY_TO_INTRO', 'Vyberte prosím novou kategorii, kterou chcete kopírovat produkt');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Aktuální kategorie:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nová kategorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Změnit kategorii');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Smazat kategorii');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Přesunout kategorii');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Smazat produkt');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Přesun produktu');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopírovat do');
define('LINK_TO', 'Odkaz na');

define('TEXT_DELETE_CATEGORY_INTRO', 'Opravdu chcete smazat tuto kategorii?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Opravdu chcete smazat tento produkt?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>UPOZORNĚNÍ:</b> %s podkategorií je stále připojeno k této kategorii!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>UPOZORNĚNÍ:</b> %s produktů je stále připojeno k této kategorii!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Vyberte kategorii, kterou chcete přesunout <b>%s</b>');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Vyberte kategorii, kterou chcete přesunout <b>%s</b>');
define('TEXT_MOVE', 'Přesunout <b>%s</b> do:');

define('TEXT_NEW_CATEGORY_INTRO', 'Vyplňte prosím následující informace pro novou kategorii');
define('TEXT_CATEGORIES_NAME', 'Jméno:');
define('TEXT_CATEGORIES_IMAGE', 'Obrázek:');
define('TEXT_SORT_ORDER', 'Pořadí řazení:');

define('TEXT_PRODUCTS_STATUS', 'Stav:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Datum dostupnosti:');
define('TEXT_PRODUCT_AVAILABLE', 'Skladem');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Není k dispozici');
define('TEXT_PRODUCTS_MANUFACTURER', 'Výrobce:');
define('TEXT_PRODUCTS_NAME', 'Jméno:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Popis:');
define('TEXT_PRODUCTS_QUANTITY', 'Množství:');
define('TEXT_PRODUCTS_MODEL', 'Model:');
define('TEXT_PRODUCTS_IMAGE', 'Obrázek:');
define('TEXT_PRODUCTS_URL', 'URL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(bez http://)</small>');
define('TEXT_PRODUCTS_PRICE', 'Cena:');
define('TEXT_PRODUCTS_WEIGHT', 'Hmotnost:');
define('TEXT_NONE', '--none--');

define('EMPTY_CATEGORY', 'Prázdná kategorie');

define('TEXT_HOW_TO_COPY', 'Jak kopírovat:');
define('TEXT_COPY_AS_LINK', 'Kopírovat jako odkaz');
define('TEXT_COPY_AS_DUPLICATE', 'Kopírovat jako duplikát');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Chyba: nelze odkazovat na stejnou kategorii.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Chyba: Do složky s obrázky nelze zapisovat: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Chyba: Složka s obrázky neexistuje: ' . DIR_FS_CATALOG_IMAGES);

define('TEXT_PMU_CANCEL', 'zrušit');
define('TEXT_DUBLICATE_TO', 'duplikovat do');
define('TEXT_PMU_LINK', 'odkaz na');
define('TEXT_PMU_DEL', 'smazat');

//Knoflík
define('BUTTON_BACK_NEW', 'zpět');
?>