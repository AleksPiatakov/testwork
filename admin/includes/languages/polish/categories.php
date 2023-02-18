<?php
/*
  $Id: categories.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('TEXT_PRODUCTS_SEO_URL', 'Products SEO URL:');
define('TEXT_EDIT_CATEGORIES_SEO_URL', 'Category SEO URL:');
define('TEXT_CATEGORIES_SEO_URL', 'Category SEO URL:');
define('TEXT_COPY_LINK', 'Link');

// BOF MaxiDVD: Added For Ultimate-Images Pack!
define('TEXT_PRODUCTS_IMAGE_NOTE','<b>Obraz produktu:</b><small><br>Główny obraz produktu, który jest używany podczas przeglądania produktu w <br><u>kategorii i na stronie szczegółowego opisu towarów.</u>. Zaleca się, aby główny obraz nie był wysokiej jakości i rozmiaru, ze względu na szybkość ładowania stron sklepu i dla wygody klientów.<small>');
define('TEXT_PRODUCTS_IMAGE_MEDIUM', '<b>Duży obraz:</b><br><small>ZASTĘPUJE główny obraz produktu na stronie<br><u>szczegółowego opisu</u>.</small>');
define('TEXT_PRODUCTS_IMAGE_LARGE', '<b>Obraz dla Pop-up okna:</b><br><small>ZASTĘPUJE obraz produktu <br><u>w wyskakującym okienku</u>.</small>');
define('TEXT_PRODUCTS_IMAGE_LINKED', '<u>Użyj tego obrazu dla towarów =</u>');
define('TEXT_PRODUCTS_IMAGE_REMOVE', 'Czy na pewno chcesz <b>usunąć </b> ten obraz?');
define('TEXT_PRODUCTS_IMAGE_DELETE', '<b>Usunąć</b> ten obraz z serwera?');
define('TEXT_PRODUCTS_IMAGE_REMOVE_SHORT', 'Usuń obraz, pozostawiając plik obrazu na serwerze');
define('TEXT_PRODUCTS_IMAGE_DELETE_SHORT', 'Usuń obraz z plikiem');
define('TEXT_PRODUCTS_IMAGE_TH_NOTICE', '<b>МК = Mały obraz,</b> Wyświetlany jest tylko<br> podczas przeglądania produktu w sklepie i przeglądania strony szczegółów produktu.<br>Jeśli nie określono dużego obrazu (DO), mały obraz jest również wyświetlany w oknie Pop-up, ale jeśli określono Duży Obraz (DO), wyświetlono zostanie wyskakujące okno mianowicie Duży Obraz (DO)<br><br>');
define('TEXT_PRODUCTS_IMAGE_XL_NOTICE', '<b>DO = Duży obraz,</b> wyświetlany w oknie Pop-up<br><br><br>');
define('TEXT_PRODUCTS_IMAGE_ADDITIONAL', '<b>Dodatkowy obraz</b> produktu - Tutaj możesz dodać dodatkowe obrazy do produktu, jeśli produkt ma tylko jeden obraz lub nie ma wcale, to sekcja poniżej nie może być wypełniona.');
// EOF MaxiDVD: Added For Ultimate-Images Pack!
define('HEADING_TITLE', 'Kategorie / Produkty');
define('HEADING_TITLE_SEARCH', 'Szukaj:');
define('HEADING_TITLE_GOTO', 'Przejdź do:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorie / Produkty');
define('TABLE_HEADING_ACTION', 'Działanie');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_NEW_PRODUCT', 'Nowy produkt w &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Kategorie:');
define('TEXT_SUBCATEGORIES', 'Podkategorie:');
define('TEXT_PRODUCTS', 'Produktów na stronie:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Cena:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Klasa podatków:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Średnia ocena:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Ilość:');
define('TEXT_DATE_ADDED', 'Data Dodania:');
define('TEXT_DELETE_IMAGE', 'Usuń obraz');

define('TEXT_DATE_AVAILABLE', 'Dostępne od:');
define('TEXT_LAST_MODIFIED', 'Ostatnia zmiana:');
define('TEXT_IMAGE_NONEXISTENT', 'Nie znaleziono obrazu');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Dodaj nową kategorię lub produkt w<br>&nbsp;<br><b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Bardziej szczegółowe informacje o produkcie <a href="http://%s" target="blank"><u>na tej stronie</u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Ten produkt został dodany do katalogu%s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Ten produkt będzie w sprzedaży od %s.');

define('TEXT_EDIT_INTRO', 'Wprowadź niezbędne zmiany.');
define('TEXT_EDIT_CATEGORIES_ID', 'ID kategorii:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Nazwa kategorii:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Obraz dla kategorii:');
define('TEXT_EDIT_CATEGORIES_ICON', 'Ikona dla kategorii:');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS', 'Wyświetl produkty:');
define('TEXT_EDIT_SORT_ORDER', 'Kolejność sortowania:');
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'Nazwa szczegóły:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Opis:');

define('TEXT_INFO_COPY_TO_INTRO', 'Wybierz nową kategorię, do której chcesz skopiować ten produkt');
define('TEXT_INFO_DELETE_FROM_CATEGORY', 'Wybierz kategorię, z której chcesz usunąć ten produkt');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Aktualne kategorie:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nowa kategoria');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Edytuj kategorię');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Usuń kategorię');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Przenieś kategorię');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Usuń produkt');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Przenieś produkt');
define('TEXT_INFO_HEADING_COPY_TO', 'Skopiuj do');

define('TEXT_DELETE_CATEGORY_INTRO', 'Czy na pewno chcesz usunąć tę kategorię?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Czy na pewno chcesz usunąć ten produkt?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>UWAGA:</b> Jest jeszcze %s podkategorii związanych z tą kategorią!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>UWAGA:</b> Jest jeszcze %s produktów w ofercie, związanych z tą kategorią!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Proszę wybrać produkt, aby przenieść<b>%s</b> do');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Proszę wybrać kategorię, aby przenieść <b>%s</b> do');
define('TEXT_MOVE', 'Przenieść <b>%s</b> do:');

define('TEXT_NEW_CATEGORY_INTRO', 'Proszę, wypełnij poniższe informacje do nowej kategorii');
define('TEXT_CATEGORIES_NAME', 'Nazwa kategorii:');
define('TEXT_CATEGORIES_IMAGE', 'Obraz kategorii:');
define('TEXT_SORT_ORDER', 'Kolejność Sortowania:');

define('TEXT_PRODUCTS_STATUS', 'Status produktu:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Data wpływu:');
define('TEXT_PRODUCT_AVAILABLE', 'Dostępny w magazynie');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Nie dostępny w magazynie');
define('TEXT_PRODUCTS_MANUFACTURER', 'Producent:');
define('TEXT_PRODUCTS_NAME', 'Nazwa:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Opis produktu:');
define('TEXT_PRODUCTS_QUANTITY', 'Ilość produktów na magazynie:');
define('TEXT_PRODUCTS_MODEL', 'Kod produktu:');
define('TEXT_PRODUCTS_IMAGE', 'Obraz produktu:');
define('TEXT_PRODUCTS_URL', 'URL produktu:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(bez http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Cena (netto):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Cena (brutto):');
define('TEXT_PRODUCTS_WEIGHT', 'Waga produktu:');
define('TEXT_NONE', '--nie--');

define('EMPTY_CATEGORY', 'Pusta Kategoria');

define('TEXT_HOW_TO_COPY', 'Metoda Kopiowania:');
define('TEXT_COPY_AS_LINK', 'Link na produkt');
define('TEXT_COPY_AS_DUPLICATE', 'Zdublować produkt');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'BŁĄD: Nie można zrobić link na towar w tej samej kategorii.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'BŁĄD: Katalog z obrazkami ma niepoprawne uprawnienia: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'BŁĄD: Brak katalogu z obrazkami: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'BŁĄD: Kategoria nie może być przeniesiona.');


//
define('ENTRY_PRODUCTS_PRICE', 'Cena produktu');
define('ENTRY_PRODUCTS_PRICE_DISABLED', 'Nie podana');
//


define('TEXT_PRODUCTS_PAGE_TITLE', 'Meta Title:');
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Meta Description:');
define('TEXT_PRODUCTS_KEYWORDS', 'Meta Keywords:');


// RJW Begin Meta Tags Code
  define('TEXT_META_TITLE', 'Meta Title');
  define('TEXT_META_DESCRIPTION', 'Meta Description');
  define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

define('TABLE_HEADING_PARAMETERS', 'Tech. parametry');

define('TEXT_PRODUCTS_INFO', 'Krótki opis:');

define('TEXT_ATTRIBUTE_HEAD', 'Atrybuty produktu:');
define('TABLE_HEADING_ATTRIBUTE_1', 'Aktywne atrybuty');
define('TABLE_HEADING_ATTRIBUTE_2', 'Przedrostek');
define('TABLE_HEADING_ATTRIBUTE_3', 'Wartość');
define('TABLE_HEADING_ATTRIBUTE_4', 'Kolejność sortowania');
define('TABLE_HEADING_ATTRIBUTE_5', 'plik');
define('TABLE_HEADING_ATTRIBUTE_6', 'Link aktywny (dni)');
define('TABLE_HEADING_ATTRIBUTE_7', 'Maksymalne pliki do pobrania');
define('TABLE_HEADING_ATTRIBUTE_9', 'Waga');

define('TABLE_HEADING_PRODUCT_SORT', 'Kolejność');
define('TEXT_ATTRIBUTE_DESC', 'Możesz dodać atrybuty produktu, zaznaczając wymagane atrybuty i określając koszt. Jeśli produkt nie ma atrybutów, po prostu pomiń ten krok. Poniżej znajduje się lista aktywnych atrybutów, grup i wartości atrybutów dodanych / zmodyfikowanych w sekcji <a href="products_attributes.php">Katalog - Atrybuty - Ustawienia</a>.');

#Add:
define('TABLE_HEADING_XML', 'XML');
define('TEXT_PRODUCTS_TO_XML', 'pliki XML:');
define('TEXT_PRODUCT_AVAILABLE_TO_XML', 'Dołącz');
define('TEXT_PRODUCT_NOT_AVAILABLE_TO_XML', 'Nie dołączaj');

// BOF Enable - Disable Categories Contribution--------------------------------------
define('TEXT_EDIT_STATUS', 'Status');
define('TEXT_DEFINE_CATEGORY_STATUS', 'Aktywny/Nieaktywny');
define('TEXT_EDIT_ROBOTS_STATUS', 'Robots Index Status');
define('TEXT_DEFINE_CATEGORY_ROBOTS_STATUS', 'index, follow/noindex, nofollow');
// EOF Enable - Disable Categories Contribution--------------------------------------

define('TEXT_MIN_QUANTITY', 'Minimalna ilość jednostek do zamówienia:');
define('TEXT_MIN_QUANTITY_UNITS', 'Krok:');

define('ATTRIBUTES_COPY_MANAGER_1', 'Skopiuj atrybuty produktów do kategorii ...');
define('ATTRIBUTES_COPY_MANAGER_2', 'Skopiuj atrybuty produktów ');
define('ATTRIBUTES_COPY_MANAGER_3', ' podaj numer produktu');
define('ATTRIBUTES_COPY_MANAGER_4', 'Do wszystkich towarów kategorii');
define('ATTRIBUTES_COPY_MANAGER_5', 'Numer kategorii: ');
define('ATTRIBUTES_COPY_MANAGER_6', 'Usuń wszystkie istniejące atrybuty w kategorii przed kopiowaniem ');
define('ATTRIBUTES_COPY_MANAGER_7', 'Albo ...');
define('ATTRIBUTES_COPY_MANAGER_8', 'Zduplikowane atrybuty zostaną pominięte ');
define('ATTRIBUTES_COPY_MANAGER_9', 'Zduplikowane atrybuty zostaną nadpisane ');
define('ATTRIBUTES_COPY_MANAGER_10', 'Skopiuj atrybuty z plikami ');
define('ATTRIBUTES_COPY_MANAGER_11', 'Wybierz kategorię');
define('ATTRIBUTES_COPY_MANAGER_12', 'Skopiuj atrybuty z dowolnego produktu do wszystkich kategorii produktów ');
define('ATTRIBUTES_COPY_MANAGER_13', 'Kopiowanie atrybutów');
define('ATTRIBUTES_COPY_MANAGER_14', 'Wybierz produkt');
define('ATTRIBUTES_COPY_MANAGER_15', 'Numer produktu: ');
define('ATTRIBUTES_COPY_MANAGER_16', 'Do produktu: ');
define('ATTRIBUTES_COPY_MANAGER_17', 'Usuń wszystkie istniejące atrybuty przed skopiowaniem nowych atrybutów ');
define('ATTRIBUTES_COPY_MANAGER_COPY', 'Skopiuj atrybuty');

define('TEXT_PAGES', 'Strony: ');
define('TEXT_TOTAL_PRODUCTS', 'Produktów w tej kategorii: ');
define('TEXT_ATT_UPLOAD', 'Przegląd...');

define('TEXT_WEIGHT_HELP', '<span class="main"><b>Uwaga:</b> Jeśli dodajesz nie wirtualny towar, należy umieścić wagę produktu więcej niż 0, na przykład 0.1, w przeciwnym razie, przy składaniu zamówienia zostanie pominięty etap wyboru sposobu dostawy towaru, jeśli waga produktu 0, wtedy produkt jest uważany za wirtualny i, odpowiednio, dostawa takich towarów nie jest potrzebna (wirtualne produkty są po prostu pobierane jako plik), należy wziąć to pod uwagę przy dodawaniu produktów do sklepu internetowego</span>');

define('HEADING_TITLE_SEARCH_MODEL', 'wg kodu<br />&nbsp;produktu');

define('TEXT_PRODUCTS_IMAGE_DIR', 'Katalog pobierania:');
define('TEXT_IMAGES_MAIN_DIRECTORY', 'obrazki');
define('TABLE_HEADING_YES','Tak');
define('TABLE_HEADING_NO','Nie');
define('TEXT_IMAGES_OVERWRITE', 'Zastąpić istniejący obraz?');
define('TEXT_IMAGES_OVERWRITE1', 'Użyj "Nie" w celu ręcznego wskazania obrazu');
define('TEXT_IMAGE_OVERWRITE_WARNING','Uwaga: Nazwa pliku została zmieniona, ale nie nadpisana ');          

define('TEXT_CAT_DELPHOTO', 'Usuń zdjęcie');
define('TEXT_CAT_ACTION', 'Działanie');
define('TEXT_CAT_IMAGE', 'Obraz');
define('TEXT_CAT_EDIT', 'Edytuj');
define('TEXT_CAT_SUBCATS', 'Podkategoria');
define('TEXT_CAT_PRODUCTS', 'Produkty w kategorii');
define('TEXT_CAT_MODEL', 'Kod');
define('TEXT_CAT_QTY', 'Na magazynie');
define('TEXT_CAT_PRICE', 'Cena');

define('TEXT_FILTER_SPECIALS','Z rabatem');
define('TEXT_FILTER_CONCOMITANT','Powiązane');
define('TEXT_FILTER_TOP','Top');
define('TEXT_FILTER_NEW','Nowe');
define('TEXT_FILTER_STOCK','Oferta');
define('TEXT_FILTER_RECOMMEND','Rekomendowane');

//Button
define('BUTTON_CANCEL_NEW', 'Anuluj');
define('BUTTON_BACK_NEW', 'Wróć');
define('BUTTON_NEW_CATEGORY_NEW', 'Nowa kategoria');
define('BUTTON_NEW_PRODUCT_NEW', 'Nowy produkt');

// WebMakers.com Added: Attribute Copy Option
define('TEXT_COPY_ATTRIBUTES_ONLY','Używany tylko w przypadku duplikatów produktów ...');
define('TEXT_COPY_ATTRIBUTES','Skopiuj atrybuty produktu do duplikatu?');
define('TEXT_COPY_ATTRIBUTES_YES','Tak');
define('TEXT_COPY_ATTRIBUTES_NO','Nie');

define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_NOTHING','Nic');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_ALL','Wszystkie produkty z podkategorii');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_TOP','NAJLEPSZA sprzedaż w tej kategorii');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_RECOMMENDED','Zalecane dla tej kategorii');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_NEW','Nowości w tej kategorii');
define('TEXT_ID_XML_CATEGORY','ID kategorii XML');
define('TEXT_VENDOR_XML_CATEGORY','Vendor kategorii XML');
define('ERROR_SYS_CATEGORY_EXIST','Identyfikator XML kategorii %s jest już zajęty przez <a href="'.DIR_WS_ADMIN . 'categories.php?cID=%s&action=edit_category" target="_blank">inna kategoria</a>');
?>
