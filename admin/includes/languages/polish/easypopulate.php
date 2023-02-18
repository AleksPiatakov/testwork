<?php
/*
  $Id: easypopulate.php,v 1.4 2004/09/21  zip1 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 20042 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Konfigurowanie modułu importu / eksportu programu Excel');
define('EASY_VERSION_A', 'Excel import / eksport');
define('EASY_DEFAULT_LANGUAGE', '  -  Domyślny język - ');
define('EASY_UPLOAD_FILE', 'Plik przesłany. ');
define('EASY_UPLOAD_TEMP', 'Tymczasowa nazwa pliku: ');
define('EASY_UPLOAD_USER_FILE', 'Nazwa pliku użytkownika: ');
define('EASY_SIZE', 'Rozmiar: ');
define('EASY_FILENAME', 'Nazwa pliku: ');
define('EASY_SPLIT_DOWN', 'Możesz pobrać podzielone pliki z folderu temp');
define('EASY_UPLOAD_EP_FILE', 'Zaimportuj plik');
define('EASY_SPLIT_EP_FILE', 'Pobierz i podziel plik na części');
define('EASY_INSERT', 'Importuj');
define('EASY_SPLIT', 'Podziel się');
define('EASY_LIMIT', 'Eksportuj ustawienia:');

define('TEXT_IMPORT_TEMP', 'Importowanie danych z folderu %s<br>');
define('TEXT_INSERT_INTO_DB', 'Importuj');
define('TEXT_SELECT_ONE', 'Wybierz plik do zaimportowania');
define('TEXT_SPLIT_FILE', 'Wybierz plik');
define('EASY_LABEL_CREATE', 'Eksportuj:');
define('EASY_LABEL_IMPORT', 'Importuj:');
define('EASY_LABEL_CREATE_SELECT', 'Jak zapisać wyeksportowany plik: ');
define('EASY_LABEL_CREATE_SAVE', 'Zapisz w folderze temp na serwerze');
define('EASY_LABEL_SELECT_DOWN', 'Wybierz pola do przesłania: ');
define('EASY_LABEL_SORT', 'Wybierz kolejność sortowania: ');
define('EASY_LABEL_PRODUCT_RANGE', 'Eksportuj towary z ID numerem ');
define('EASY_LABEL_LIMIT_CAT', 'Eksportuj towary z kategorii: ');
define('EASY_LABEL_LIMIT_MAN', 'Wyeksportuj towar producenta: ');

define('EASY_LABEL_PRODUCT_AVAIL', 'Dostępne zakres ID numerów: ');
define('EASY_LABEL_PRODUCT_FROM', ' od ');
define('EASY_LABEL_PRODUCT_TO', ' do ');
define('EASY_LABEL_PRODUCT_RECORDS', 'Wszystkie rekordy: ');
define('EASY_LABEL_PRODUCT_BEGIN', 'od: ');
define('EASY_LABEL_PRODUCT_END', 'do: ');
define('EASY_LABEL_PRODUCT_START', 'Eksportuj');

define('EASY_FILE_LOCATE', 'Możesz zabrać swój plik z folderu ');
define('EASY_FILE_LOCATE_2', '');
define('EASY_FILE_RETURN', ' Możesz się wrócić, poprzez ten link.');
define('EASY_IMPORT_TEMP_DIR', 'Importuj z folderu temp ');
define('EASY_LABEL_DOWNLOAD', 'Pobierz plik');
define('EASY_LABEL_COMPLETE', 'Wszystkie pola');
define('EASY_LABEL_TAB', 'tab-delimited .txt file to edit');
define('EASY_LABEL_MPQ', 'Kod towaru/Cena/Ilość');
define('EASY_LABEL_EP_MC', 'Kod towarów/Kategoria');
define('EASY_LABEL_EP_FROGGLE', 'Plik danych dla systemu Frohl');
define('EASY_LABEL_EP_ATTRIB', 'Atrybuty produktu');
define('EASY_LABEL_NONE', 'Nie');
define('EASY_LABEL_CATEGORY', 'Partycja root');
define('PULL_DOWN_MANUFACTURES', 'Wszyscy producenci');
define('EASY_LABEL_PRODUCT', 'ID numer produktu');
define('EASY_LABEL_MANUFACTURE', 'ID numer producenta');
define('EASY_LABEL_EP_FROGGLE_HEADER', 'Pobierz plik lub Frohl plik');
define('EASY_LABEL_EP_MA', 'Kod towaru / atrybuty');
define('EASY_LABEL_EP_FR_TITLE', 'Utwórz plik danych lub Frohl plik w folderze');
define('EASY_LABEL_EP_DOWN_TAB', 'Create <b>Complete</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MPQ', 'Create <b>Model/Price/Qty</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MC', 'Create <b>Model/Category</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MA', 'Create <b>Model/Attributes</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_FROOGLE', 'Create <b>Froogle</b> tab-delimited .txt file in temp dir');

define('EASY_LABEL_NEW_PRODUCT', '<font color=blue> Produkt dodany</font><br>');
define('EASY_LABEL_UPDATED', "<font color=green> Produkt został zaktualizowany</font><br>");
define('EASY_LABEL_DELETE_STATUS_1', '<font color=red>Produkt</font><font color=black> ');
define('EASY_LABEL_DELETE_STATUS_2', ' </font><font color=red> został usunięty!</font>');
define('EASY_LABEL_LINE_COUNT_1', 'Dodane ');
define('EASY_LABEL_LINE_COUNT_2', ' rekordów i plik jest zamknięty... ');
define('EASY_LABEL_FILE_COUNT_1', 'Utwórz plik EP_Split ');
define('EASY_LABEL_FILE_COUNT_2', '.txt ...  ');
define('EASY_LABEL_FILE_CLOSE_1', 'Dodano ');
define('EASY_LABEL_FILE_CLOSE_2', ' rekordów i plik jest zamknięty...');
//errormessages
define('EASY_ERROR_1', 'Dziwne, ale domyślny język nie jest ustawiony... W porządku, tylko ostrzeżenie... ');
define('EASY_ERROR_2', '... BŁĄD! - Zbyt wiele znaków w polu kodu produktu.<br>
			12 znaków jest maksymalną liczbą w standardowym OsCommerce.<br>
			Maksymalna długość pola product_model, zainstalowana w ustawieniach modułu: ');
define('EASY_ERROR_2A', ' <br>Możesz skrócić kod produktu lub zwiększyć długość pola w bazie danych.</font>');
define('EASY_ERROR_2B',  "<font color='red'>");
define('EASY_ERROR_3', '<p class=smallText>Pole jest puste products_id. Ten wiersz nie został zaimportowany. <br><br>');
define('EASY_ERROR_4', '<font color=red>BŁĄD! - v_customer_group_id and v_customer_price must occur in pairs</font>');
define('EASY_ERROR_5', '</b><font color=red>BŁĄD! - You are trying to use a file created with EP Advanced, please try with Easy Populate Advanced </font>');
define('EASY_ERROR_5a', '<font color=red><b><u>  Click here to return to Easy Populate Basic </u></b></font>');
define('EASY_ERROR_6', '</b><font color=red>BŁĄD! - You are trying to use a file created with EP Basic, please try with Easy Populate Basic </font>');
define('EASY_ERROR_6a', '<font color=red><b><u>  Click here to return to Easy Populate Advanced </u></b></font>');

define('EASY_R_NAME', 'imię');
define('EASY_R_DESC', 'opis');
define('EASY_R_CAT', 'kategoria');
define('EASY_R_LANGUAGE', 'język');
define('EASY_R_MODEL', 'kod');
define('EASY_R_IMAGES', 'zdjęcia');
define('EASY_R_MANUF', 'producent');
define('EASY_R_DISC', 'rabat');
define('EASY_R_PRICE', 'cena');
define('EASY_R_QTY', 'Ilość');
define('EASY_R_DATE', 'Data');
define('EASY_R_STATUS', 'Status');
define('EASY_R_STATUS_ACT', 'Aktywny');
define('EASY_R_STATUS_NOACT', 'Nieaktywny');
define('EASY_R_STATUS_DELETE', 'kasować');
define('EASY_R_DOWNLOAD', 'Możesz pobrać swój plik tutaj.');
define('EASY_R_NORMAL', 'Normalny');
define('EASY_R_ADD', 'Dodaj');
define('EASY_R_REFRESH', 'Uaktualnij');
define('EASY_R_DEL', 'Usuń');
define('EASY_R_FULLFILE', 'Pełny plik');
define('EASY_R_ID_PRICE', 'Artykuł / Cena / Ilość');
define('EASY_R_DOWN_NOW', 'Pobrać');
define('EASY_R_DOWN_CREATE', 'Utwórz i pobierz');
define('EASY_R_TMP_DIR', 'Utwórz w folderze tymczasowym');
define('EASY_R_ALL', 'Wszystkie');
define('EASY_R_PRICEQTY', 'Cena / Ilość');
define('EASY_R_CATS', 'Kategorie');
define('EASY_R_ATTRS', 'Atrybuty');
define('EASY_R_FILE3', 'plik (kod produktu zawsze istnieje).');
define('EASY_R_SORT', 'Sortowanie');
define('EASY_R_FILTER', 'Filtrowanie');
define('EASY_LABEL_ALGORITHM', 'Algorytm importu');
define('EASY_LABEL_DELIMITER', 'Separator');
define('EASY_SELECT_FILE', 'Wybierz plik');
define('EASY_EXPORT_DATA', 'Eksportuj dane');
define('EASY_LABEL_EXPORT_FULL_ATTR_INF', 'Pobierz pełne informacje o atrybutach');
define('EASY_LABEL_IMPORT_FULL_ATTR_INF', 'Pobierz pełne informacje o atrybutach');

?>
