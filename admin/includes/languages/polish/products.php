<?php
/*
  $Id: categories.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
define('TEXT_PROD_LOAD_FILES','Wczytaj pliki:');
define('TEXT_ALOWED_FILE_TYPES','Dozwolone typy plików:');
define('TEXT_PROD_FILES_DRAG','Przeciągnij pliki tutaj');
define('TEXT_PROD_DOWNLOADS','Pliki do pobrania');
define('TEXT_IS_DOWNLOAD_PRODUCT','Produkt elektroniczny:');
define('TEXT_PRODUCTS_SEO_URL', 'Products SEO URL:');
define('TEXT_EDIT_CATEGORIES_SEO_URL', 'Category SEO URL:');
define('TEXT_CATEGORIES_SEO_URL', 'Category SEO URL:');

// BOF MaxiDVD: Added For Ultimate-Images Pack!
define('TEXT_PRODUCTS_IMAGE_NOTE','<b>Zdjęcie produktu:</b><small><br>Główne zdjęcie produktu, które jest używane podczas przeglądania produktu w <br><u>kategoriach i na stronie szczegółowego opisu produktów.</u>. Zaleca się, aby główne zdjęcie nie było wysokiej jakości i rozmiaru, ze względu na szybkość ładowania stron sklepu i dla wygody klientów.<small>');
define('TEXT_PRODUCTS_IMAGE_MEDIUM', '<b>Duże zdjęcie:</b><br><small>ZASTĘPUJE główne zdjęcie produktu na stronie<br><u>szczegółowego opisu produktu</u>.</small>');
define('TEXT_PRODUCTS_IMAGE_LARGE', '<b>Zdjęcie dla Pop-up okna:</b><br><small>ZASTĘPUJE zdjęcie produktu <br><u>w wyskakującym okienku</u>.</small>');
define('TEXT_PRODUCTS_IMAGE_LINKED', '<u>Użyj to zdjęcie dla produktu=</u>');
define('TEXT_PRODUCTS_IMAGE_REMOVE', 'Czy na pewno chcesz <b>usunąć</b> to zdjęcie?');
define('TEXT_PRODUCTS_IMAGE_DELETE', '<b>Usunąć</b> to zdjęcie z serwera?');
define('TEXT_PRODUCTS_IMAGE_REMOVE_SHORT', 'Usuń obraz, pozostawiając plik obrazu na serwerze');
define('TEXT_PRODUCTS_IMAGE_DELETE_SHORT', 'Usuń obraz z plikiem');
define('TEXT_PRODUCTS_IMAGE_TH_NOTICE', '<b>MZ = Małe zdjęcie,</b> wyświetlane jest tylko<br> podczas przeglądania produktu w sklepie i przeglądania strony szczegółowego opisu produktu<br> Jeżeli nie określiłeś Dużego zdjęcia (DZ), wtedy w oknie Pop-up pojawi się Małe zdjęcie (MZ), ale jeśli określisz Duże zdjęcie (DZ), to w oknie Pop-Up wówczas wyświetli się Duże zdjęcie (DZ) -<br><br>');
define('TEXT_PRODUCTS_IMAGE_XL_NOTICE', '<b>DZ = Duże zdjęcie,</b> Wyświetlane w oknie Pop-up<br><br><br>');
define('TEXT_PRODUCTS_IMAGE_ADDITIONAL', '<b>Dodatkowe zdjęcia</b> produktu - Tutaj możesz dodać dodatkowe zdjęcia do produktu. Jeżeli produkt ma tylko jedno zdjęcie lub wcale nie ma zdjęcia, to możesz nie wypełniać poniższą sekcję.');

define('TEXT_XSELLS_ADD', 'Dodaj według kodu produktu:');
define('TEXT_XSELLS_ADD_BUTTON', 'Dodaj');
define('TEXT_XSELLS_DEL_BUTTON', 'Usuń');

define('TEXT_QTY_PRO_QUANTITY_LABEL', 'Ilość');
define('TEXT_QTY_PRO_COMBINATION_PRICE_LABEL', 'Cena');
define('TEXT_QTY_PRO_VENDOR_CODE_LABEL', 'Kod dostawcy');

// EOF MaxiDVD: Added For Ultimate-Images Pack!
define('HEADING_TITLE', 'Kategorie / Produkty');
define('HEADING_TITLE_SEARCH', 'Wyszukaj:');
define('HEADING_TITLE_GOTO', 'Przejdź do:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorie / Produkty');
define('TABLE_HEADING_ACTION', 'Działanie');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_NEW_PRODUCT', 'Nowy Produkt w &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Kategorii:');
define('TEXT_SUBCATEGORIES', 'Podkategorii:');
define('TEXT_PRODUCTS', 'Produktów na stronie:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Cena:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Klasa Podatków:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Średnia Ocena:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Ilość:');
define('TEXT_DATE_ADDED', 'Data dodania:');
define('TEXT_DELETE_IMAGE', 'Usuń Zdjęcie');

define('TEXT_DATE_AVAILABLE', 'Dostępne od:');
define('TEXT_LAST_MODIFIED', 'Data ostatniej modyfikacji:');
define('TEXT_IMAGE_NONEXISTENT', 'Nie znaleziono zdjęcia');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Dodaj nową kategorię lub produkt w<br>&nbsp;<br><b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Więcej informacji o tym produkcie <a href="http://%s" target="blank"><u>na tej stronie</u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Ten produkt został dodany do katalogu %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Ten produkt będzie w sprzedaży od %s.');

define('TEXT_EDIT_INTRO', 'Wprowadź niezbędne zmiany.');
define('TEXT_EDIT_CATEGORIES_ID', 'ID kategorii:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Nazwa kategorii:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Zdjęcie dla kategorii:');
define('TEXT_EDIT_SORT_ORDER', 'Kolejność sortowania:');
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'Szczegółowa nazwa:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Opis:');

define('TEXT_INFO_COPY_TO_INTRO', 'Wybierz nową kategorię, do której chcesz skopiować ten produkt');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Aktualne kategorie:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nowa Kategoria');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Zmień Kategorię');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Usuń Kategorię');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Przenieś Kategorię');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Usuń Produkt');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Przenieś Produkt');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopiuj Do');

define('TEXT_DELETE_CATEGORY_INTRO', 'Czy na pewno chcesz usunąć tę kategorię?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Czy na pewno chcesz usunąć ten produkt?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>UWAGA:</b> Są jeszcze %s podkategorii powiązanych z tą kategorią!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>UWAGA:</b> Są jeszcze %s nazw produktów, powiązanych z tą kategorią!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Wybierz kategorię do przeniesienia <b>%s</b> do');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Wybierz kategorię do przeniesienia <b>%s</b> do');
define('TEXT_MOVE', 'Przenieś <b>%s</b> do:');

define('TEXT_NEW_CATEGORY_INTRO', 'Proszę wypełnić następujące informacje dotyczące nowej kategorii');
define('TEXT_CATEGORIES_NAME', 'Nazwa Kategorii:');
define('TEXT_CATEGORIES_IMAGE', 'Zdjęcie Kategorii:');
define('TEXT_SORT_ORDER', 'Porządek Sortowania:');

define('TEXT_PRODUCTS_STATUS', 'Status Produktu:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Data przyjęcia:');
define('TEXT_PRODUCT_AVAILABLE', 'Dostępne');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Niedostępne');
define('TEXT_PRODUCT_STATUS','Status');
define('TEXT_PRODUCTS_MANUFACTURER', 'Producent:');
define('TEXT_PRODUCTS_NAME', 'Nazwa:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Opis produktu:');
define('TEXT_PRODUCTS_QUANTITY', 'Liczba produktów na magazynie:');
define('TEXT_PRODUCTS_MODEL', 'Kod produktu:');
define('TEXT_PRODUCTS_IMAGE', 'Zdjęcie produktu:');
define('TEXT_PRODUCTS_URL', 'URL produktu:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(bez http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Cena (bez podatku):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Cena (z podatkiem):');
define('TEXT_PRODUCTS_WEIGHT', 'Waga produktu:');
define('TEXT_NONE', '--brak--');

define('EMPTY_CATEGORY', 'Pusta kategoria');

define('TEXT_HOW_TO_COPY', 'Metoda kopiowania:');
define('TEXT_COPY_AS_LINK', 'Link na produkt');
define('TEXT_COPY_AS_DUPLICATE', 'Duplikuj produkt');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Błąd: Nie możesz robić link na produkt w tej samej kategorii.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Błąd: Katalog ze zdjęciami ma nieprawidłowe uprawnienia: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Błąd: Katalog ze zdjęciami nie istnieje: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Błąd: Kategoria nie może być przeniesiona.');


//
define('ENTRY_PRODUCTS_PRICE', 'Cena produktu');
define('ENTRY_PRODUCTS_PRICE_DISABLED', 'Nie określona');
//


define('TEXT_PRODUCTS_PAGE_TITLE', 'Meta Title:');
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Meta Description:');
define('TEXT_PRODUCTS_KEYWORDS', 'Meta Keywords:');


// RJW Begin Meta Tags Code
  define('TEXT_META_TITLE', 'Meta Title');
  define('TEXT_META_DESCRIPTION', 'Meta Description');
  define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

define('TABLE_HEADING_PARAMETERS', 'Parametry techniczne');

define('TEXT_PRODUCTS_INFO', 'Krótki opis:');

define('TEXT_ATTRIBUTE_HEAD', 'Atrybuty produktu:');
define('TABLE_HEADING_ATTRIBUTE_1', 'Aktywne atrybuty');
define('TABLE_HEADING_ATTRIBUTE_2', 'Prefiks');
define('TABLE_HEADING_ATTRIBUTE_3', 'Cena');
define('TABLE_HEADING_ATTRIBUTE_4', 'Kolejność sortowania');
define('TABLE_HEADING_ATTRIBUTE_5', 'Plik');
define('TABLE_HEADING_ATTRIBUTE_6', 'Link jest aktywny (dni)');
define('TABLE_HEADING_ATTRIBUTE_7', 'Maksymalna ilość pobrań');
define('TABLE_HEADING_ATTRIBUTE_9', 'Waga');

define('TABLE_HEADING_PRODUCT_SORT', 'Porządek');
define('TEXT_ATTRIBUTE_DESC', 'Możesz dodać atrybuty produktu, zaznaczając wymagane atrybuty i określając wartość. Jeżeli produkt nie posiada cech, możesz pominąć ten krok. Poniżej znajduje się lista aktywnych atrybutów. Grupy i wartości atrybutów są dodawane / modyfikowane w sekcji <a href="products_attributes.php">Katalog - Atrybuty - Ustawienia</a>.');

define('TEXT_EMPTY_ATTRIBUTES', 'Najpierw dodaj do produktu atrybut z co najmniej dwiema wartościami.');

#Add:
define('TABLE_HEADING_XML', 'XML');
define('TEXT_PRODUCTS_TO_XML', 'Pliki XML:');
define('TEXT_PRODUCT_AVAILABLE_TO_XML', 'Włącz');
define('TEXT_PRODUCT_NOT_AVAILABLE_TO_XML', 'Nie włączaj');

// BOF Enable - Disable Categories Contribution--------------------------------------
define('TEXT_EDIT_STATUS', 'Status');
define('TEXT_DEFINE_CATEGORY_STATUS', '1=Aktywna; 0=Nieaktywna');
define('TEXT_EDIT_ROBOTS_STATUS', 'Robots Index Status');
define('TEXT_DEFINE_CATEGORY_ROBOTS_STATUS', 'index, follow/noindex, nofollow');
// EOF Enable - Disable Categories Contribution--------------------------------------

define('TEXT_MIN_QUANTITY', 'Minimalna ilość jednostek dla zamówienia:');
define('TEXT_MIN_QUANTITY_UNITS', 'Krok:');


define('TEXT_PAGES', 'Strony: ');
define('TEXT_TOTAL_PRODUCTS', 'Produktów w tej kategorii: ');
define('TEXT_ATT_UPLOAD', 'Dodaj plik...');

define('TEXT_WEIGHT_HELP', '<span class="main"><b><font color="red">Uwaga:</font></b> Jeżeli nie dodajesz produktu wirtualnego, pamiętaj, aby wpisać wagę towarów powyżej 0, na przykład 0.1, w przeciwnym razie, przy składaniu zamówienia, etap wyboru sposobu dostawy produktu zostanie pominięty, jeżeli waga produktów wynosi 0, produkty uważa się za wirtualne, a więc dostawa takich towarów nie jest potrzebna(Towary wirtualne są po prostu pobierane jako plik), pamiętaj o tym podczas dodawania produktów do sklepu internetowego.</span>');

define('HEADING_TITLE_SEARCH_MODEL', 'według kodu<br />&nbsp;produktu');

define('TEXT_PRODUCTS_IMAGE_DIR', 'Katalog plików do pobrania:');
define('TEXT_IMAGES_MAIN_DIRECTORY', 'images');
define('TABLE_HEADING_YES','Tak');
define('TABLE_HEADING_NO','Nie');
define('TEXT_IMAGES_OVERWRITE', 'Zastąpić istniejące zdjęcie?');
define('TEXT_IMAGES_OVERWRITE1', 'Użyj "Nie", aby ręcznie wybrać zdjęcie');
define('TEXT_IMAGE_OVERWRITE_WARNING','Uwaga: Nazwa pliku została zmieniona, ale nie została zapisana ');     
     
define('TEXT_PROD_TEXTS','Teksty');
define('TEXT_PROD_IMGS','Zdjęcia');
define('TEXT_PROD_VIDEO','Wideo');
define('TEXT_PROD_ATTRS','Atrybuty');
define('TEXT_PROD_LINK','Link');
define('TEXT_PROD_PRICE','Cena');
define('TEXT_PROD_TOP','TOP');
define('TEXT_PROD_NEW','NEW');
define('TEXT_PROD_AKC','Oferta');
define('TEXT_PROD_WE','Waga');
define('TEXT_PROD_SORT','Sortowanie');
define('TEXT_PROD_QTY','Ilość');
define('TEXT_PROD_MINORD','Minimalne zamówienie');
define('TEXT_PROD_IMGS2','Zdjęcia produktu');
define('TEXT_PROD_IMGS3','na');
define('TEXT_PROD_IMGS_OR','lub');
define('TEXT_PROD_IMGS_DRAG','Przeciągnij obrazy tutaj');
define('TEXT_PROD_COLOR','Kolor');
define('TEXT_PROD_CROP','Wytnij!');
define('TEXT_PROD_SAVE_BEFORE','Zapisz towar przed dodaniem zdjęć.');
define('TEXT_PROD_LOAD_IMGS','Dodaj zdjęcia');
define('TEXT_PROD_LOAD_IMGS_BUT','Dodaj');
define('TEXT_PROD_ON','włącz.');
define('TEXT_PROD_OFF','wyłącz.');

//Button
define('BUTTON_BACK_NEW', 'Wróć');
define('BUTTON_QUICK_VIEW', 'Szybki podgląd');

define('TEXT_DISCOUNT','Discount');
define('TEXT_RECIPROCAL_LINK','Reciprocal Link');


define('TEXT_EDITED_FOR_SEO', 'Edytowane dla SEO');
define('TEXT_LINK_TO_YOUTUBE', 'Link do filmu na YouTube');
define('TEXT_IMAGE_PREVIEW', 'Podgląd');
define('TEXT_CHOOSE_ON_SERVER', 'Wybierz na serwerze');