<?php
/*
  $Id: products_multi.php, v 2.0

  autor: sr, 2003-07-31 / sr@ibis-project.de

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Multi-Manager');
define('HEADING_TITLE_SEARCH', 'Wyszukaj:');
define('HEADING_TITLE_GOTO', 'Przejdź:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_CHOOSE', 'Wybierz');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorie / Produkty');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Kod');
define('TABLE_HEADING_ACTION', 'Działanie');
define('TABLE_HEADING_PRODUCTS_QUANTITY', 'Ilość');
define('TABLE_HEADING_MANUFACTURERS_NAME', 'Producent');
define('TABLE_HEADING_STATUS', 'Status');

define('DEL_DELETE', 'usuń produkt');
define('DEL_CHOOSE_DELETE_ART', 'Jak usunąć?');
define('DEL_THIS_CAT', 'tylko w tej kategorii');
define('DEL_COMPLETE', 'całkowicie usunąć produkt');

define('TEXT_NEW_PRODUCT', 'Nowy produkt w &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Kategorii:');
define('TEXT_ATTENTION_DANGER', '');
/*
define('TEXT_ATTENTION_DANGER', '<br><br><span class="dataTableContentRedAlert">!!! Uwaga !!! Proszę przeczytać !!!</span><br><br><span class="dataTableContentRed">To narzędzie zmienia tabele "products_to_categories" (oraz w przypadku  \' całkowicie usunąć produkty\' nawet "products" oraz "products_description" among others; przez funkcję \'tep_remove_product\') - dlatego BARDZO zalecanym jest wykonanie kopii zapasowej (backup) tych tabel przed każdym użyciem tego narzędzia. Przyczyny:<br><br>This tool deletes, moves or copies all via checkbox selected products without any interim step or warning, that means immediately after clicking on the go-button.</span><br><br><span class="dataTableContentRedAlert">Please take care:</span><ul><li>Pay very great attention when using <strong>\'delete the complete product\'</strong>. This function deletes all selected products immediately, without interim step or warning, and completely from all tables where these products belong to.</strong></li><li>While choosing <strong>\'delete product only in this category\'</strong>, no products are deleted completely, but only their links to the actually opened category - even when it\'s the only category-link of the product, and without warning, that means: be careful with this delete tool as well.</li><li>While <strong>copying</strong>, products are not duplicated, they are only linked to the new category chosen.</li><li>Products are only <strong>moved</strong> resp. <strong>copied</strong> to a new category in case they do not exist there allready.</li></ul>');
*/
define('TEXT_MOVE_TO', 'przenieś do');
define('TEXT_CHOOSE_ALL', 'zaznacz wszystkie');
define('TEXT_CHOOSE_ALL_REMOVE', 'odznacz');
define('TEXT_SUBCATEGORIES', 'Podkategorie:');
define('TEXT_PRODUCTS', 'Produkty:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Cena:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Klasa podatków:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Średnia cena:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Ilość:');
define('TEXT_DATE_ADDED', 'Dodany:');
define('TEXT_DATE_AVAILABLE', 'Dostępność:');
define('TEXT_LAST_MODIFIED', 'Ostatnia zmiana:');
define('TEXT_IMAGE_NONEXISTENT', 'IMAGE DOES NOT EXIST');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Proszę wstawić nową kategorię lub produkty do <br>&nbsp;<br><b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Odwiedź <a href="http://%s" target="blank"><u>stronę</u></a> tego produktu, aby uzyskać więcej informacji.');
define('TEXT_PRODUCT_DATE_ADDED', 'Ten produkt został dodany do naszego katalogu %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Ten produkt będzie dostępny w magazynie %s.');

define('TEXT_EDIT_INTRO', 'Wprowadź niezbędne zmiany.');
define('TEXT_EDIT_CATEGORIES_ID', 'ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Imię:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Zdjęcie:');
define('TEXT_EDIT_SORT_ORDER', 'Sortowanie:');

define('TEXT_INFO_COPY_TO_INTRO', 'Wybierz nową kategorię, do której chcesz skopiować produkty');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Istniejące kategorie:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nowa kategoria');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Zmień kategorię');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Usuń kategorię');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Przenieś kategorię');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Usuń produkt');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Przenieś produkt');
define('TEXT_INFO_HEADING_COPY_TO', 'Skopiuj do');
define('LINK_TO', 'Link do');

define('TEXT_DELETE_CATEGORY_INTRO', 'Czy na pewno chcesz usunąć tę kategorię?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Czy na pewno chcesz na zawsze usunąć ten produkt?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>UWAGA:</b> %s podkategorii wciąż jest powiązanych z tą kategorią!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>UWAGA:</b> %s produktów wciąż jest powiązanych z tą kategorią!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Wybierz kategorię, do której chcesz przenieść <b>%s</b>');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Wybierz kategorię, do której chcesz przenieść <b>%s</b>');
define('TEXT_MOVE', 'Przenieść <b>%s</b> do:');

define('TEXT_NEW_CATEGORY_INTRO', 'Proszę wypełnić następujące informacje dotyczące nowej kategorii');
define('TEXT_CATEGORIES_NAME', 'Nazwa:');
define('TEXT_CATEGORIES_IMAGE', 'Zdjęcie:');
define('TEXT_SORT_ORDER', 'Sortowanie:');

define('TEXT_PRODUCTS_STATUS', 'Status:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Dostępny:');
define('TEXT_PRODUCT_AVAILABLE', 'Dostępny');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Niedostępny');
define('TEXT_PRODUCTS_MANUFACTURER', 'Producent:');
define('TEXT_PRODUCTS_NAME', 'Nazwa:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Opis:');
define('TEXT_PRODUCTS_QUANTITY', 'Ilość:');
define('TEXT_PRODUCTS_MODEL', 'Kodu:');
define('TEXT_PRODUCTS_IMAGE', 'Zdjęcie:');
define('TEXT_PRODUCTS_URL', 'URL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(bez http://)</small>');
define('TEXT_PRODUCTS_PRICE', 'Cena:');
define('TEXT_PRODUCTS_WEIGHT', 'Waga:');
define('TEXT_NONE', '--brak--');

define('EMPTY_CATEGORY', 'Pusta kategoria');

define('TEXT_HOW_TO_COPY', 'Metoda kopiowania:');
define('TEXT_COPY_AS_LINK', 'Link na produkt');
define('TEXT_COPY_AS_DUPLICATE', 'Duplikuj produkt');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Błąd: nie mogę utworzyć linku do elementu w tej samej kategorii.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Błąd: folder obrazu nie jest zapisywalny: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Błąd: folder obrazu nie istnieje: ' . DIR_FS_CATALOG_IMAGES);

define('TEXT_PMU_CANCEL', 'Zaznacz');
define('TEXT_DUBLICATE_TO', 'Duplikuj do');
define('TEXT_PMU_LINK', 'Linkiem do');
define('TEXT_PMU_DEL', 'usuń');
define('TEXT_PMU_DUBL_CATEGORY', 'Zduplikowany katalog:');

//Button
define('BUTTON_BACK_NEW', 'Wróć');
define('BUTTON_PMU_SUBMIT', 'Składać');
