<?php
/*
  $Id: russian.php,v 1.3 2003/09/28 23:37:26 anotherlango Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
// Google SiteMaps
define('BOX_TOOLS_COMMENT8R', 'Komentarze');
define('BOX_CLEAR_IMAGE_CACHE', 'Wyczyść pamięć podręczną obrazów');
define('BOX_GOOGLE_SITEMAP', 'Google SiteMaps');
define('TBL_LINK_TITLE', 'Ajax kategorie');
define('TBL_HEADING_TITLE_BACK_TO_PARENT', 'Wróć');
define('TBL_HEADING_TITLE_SEARCH', 'Wyszukaj');
define('TBL_HEADING_CATEGORIES_PRODUCTS', 'Kategorie / Produkty');
define('TBL_HEADING_MODEL', 'Kod');
define('TBL_HEADING_QUANTITY', 'Ilość');
define('TBL_HEADING_PRICE', 'Cena');
define('TBL_HEADING_TITLE_BACK_TO_DEFAULT_ADMIN', 'Back To Default Administration');
define('TBL_HEADING_PRODUCTS_COUNT', ' produktów');
define('TBL_HEADING_SUBCATEGORIES_COUNT', ' podkategorii');
define('TBL_HEADING_SUBCATEGORIE_COUNT', ' podkategoria');
define('GOOGLE_FEED_MODULE_ENABLED_TITLE', 'Google Feed');
define('TEXT_MENU_REVIEWS', 'Opinie');
define('SQL_MODE_RECOMMENDATION_TEXT', "For further correct work, you need to contact the hosting administration to reset the sql_mode variable in Mysql");
define('ROBOTS_TXT_RECOMMENDATION_TEXT', 'Robots.txt is not included on your site, for successful promotion we recommend that you enable it on <a target="_blank" href="/'.$admin.'/configuration.php?gID=1">page</a>');
define('CRITICAL_CSS_TXT_RECOMMENDATION_TEXT', '<span class="critical-text">Potrzebujesz wygenerować krytyczny CSS</span> <span class="critical-process">Przetwarzanie...Proszę czekać</span><a class="start-generate-critical" href="javascript:void(0);">Początek</a>');
define('ALERT_ERRORS_BLOCK_TITLE', 'Alerty');
define('DOMEN_IN_ROBOTS_TXT_RECOMMENDATION_TEXT', '<span class="robots-txt-text">w Robots.txt dyrektywa Host nie pasuje do nazwy Twojej witryny, zalecamy ją dla udanej promocji</span> <span class="generate-robots-txt-process">Przetwarzanie ... Proszę czekać</span><a class="start-generate-robots-txt" href="javascript:void(0);"> zregenerować się</a>');

define('TEXT_PRODILE_INFO_CHANGE_PASSWORD', 'Zmień własne hasło ');

//Admin begin
// header text in includes/header.php
define('HEADER_TITLE_LOGOFF', 'Wyloguj');
define('HEADER_TITLE_HELLO', 'Witamy');
define('HEADER_FRONT_LINK_TEXT', 'Go to site');
define('HEADER_ADMIN_TEXT', 'Adminpanel');
define('HEADER_ORDERS_TODAY', 'Zamówienia dzisiaj: ');
define('HEADER_GO_TO_SITE', 'Przejdź do witryny');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Administratorzy');
define('BOX_ADMINISTRATOR_MEMBERS', 'Grupy użytkowników');
define('BOX_ADMINISTRATOR_MEMBER', 'Użytkownicy');
define('BOX_ADMINISTRATOR_BOXES', 'Prawa dostępu');
define('BOX_ADMINISTRATOR_ACCOUNT_UPDATE', 'Zaktualizuj informacje o sobie');

// limex: mod query performance START
define('TEXT_DISPLAY_NUMBER_OF_QUERIES', 'Wyświetlano <b>%d</b> - <b>%d</b> (z <b>%d</b> zapytań)');
define('BOX_TOOLS_MYSQL_PERFORMANCE', 'Powolne zapytania');
define('TEXT_DELETE', 'Usunąć wszystkie wpisy?');
define('IMAGE_BUTTON_DELETE', 'Usuń wszystkie wpisy');
define('IMAGE_BUTTON_CANCEL', 'Nie usuwaj wpisów');
// limex: mod query performance END


//mod for ez price updater
define('BOX_CATALOG_PRICE_QUICK_UPDATES', 'Szybka zmiana cen');
define('BOX_CATALOG_PRICE_UPDATE_VISIBLE', 'Widoczna zmiana ceny');
define('BOX_CATALOG_PRICE_UPDATE__ALL', 'Zmień wszystkie ceny');
define('BOX_CATALOG_PRICE_CANGE', 'Edytuj cenę');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI', 'Zarządzanie produktami');
define('BOX_CATALOG_STATS_SEARCH_KEYWORDS', "Planer słów kluczowych");

define('TEXT_INDEX_LANGUAGE', 'Język: ');
define('TEXT_SUMMARY_CUSTOMERS', 'Kupujący');
define('TEXT_SUMMARY_ORDERS', 'Zamówienia');
define('TEXT_SUMMARY_PRODUCTS', 'Produkty');
define('TEXT_SUMMARY_HELP', 'Pomoc');
define('TEXT_SUMMARY_STAT', 'Statystyki');
define('TABLE_HEADING_CUSTOMERS', 'Kupujący');

define('TEXT_GO_TO_CAT', 'Przejdź do');
define('TEXT_GO_TO_SEARCH', 'Wyszukaj');
define('TEXT_GO_TO_SEARCH2', 'według kodu<br>produktu');

define('TEXT_MENU_TOTAL_CONFIG', 'Całkowita konfiguracja');

// images
define('IMAGE_FILE_PERMISSION', 'Prawa dostępu');
define('IMAGE_GROUPS', 'Lista grup');
define('IMAGE_INSERT_FILE', 'Dodaj plik');
define('IMAGE_MEMBERS', 'Lista użytkowników');
define('IMAGE_NEW_GROUP', 'Dodaj grupy');
define('IMAGE_NEW_MEMBER', 'Dodaj użytkownika');
define('IMAGE_NEXT', 'Dalej');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Wyświetlono <b>%d</b> - <b>%d</b> (wszystkich <b>%d</b> plików)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Wyświetlono <b>%d</b> - <b>%d</b> (wszystkich <b>%d</b> użytkowników)');
//Admin end

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'pl_PL.UTF-8');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
//define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', '%d %B %Y r.'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_FORMAT_SPIFFYCAL', 'dd/MM/yyyy');  //Use only 'dd', 'MM' and 'yyyy' here in any order


define('TEXT_DAY_1','Poniedziałek');
define('TEXT_DAY_2','Wtorek');
define('TEXT_DAY_3','Środa');
define('TEXT_DAY_4','Czwartek');
define('TEXT_DAY_5','Piątek');
define('TEXT_DAY_6','Sobota');
define('TEXT_DAY_7','Niedziela');
define('TEXT_DAY_SHORT_1','MON');
define('TEXT_DAY_SHORT_2','TUE');
define('TEXT_DAY_SHORT_3','WED');
define('TEXT_DAY_SHORT_4','THU');
define('TEXT_DAY_SHORT_5','FRI');
define('TEXT_DAY_SHORT_6','SAT');
define('TEXT_DAY_SHORT_7','SUN');
define('TEXT_MONTH_BASE_1','Styczeń');
define('TEXT_MONTH_BASE_2','Stycznia');
define('TEXT_MONTH_BASE_3','Marzec');
define('TEXT_MONTH_BASE_4','Kwiecień');
define('TEXT_MONTH_BASE_5','Maj');
define('TEXT_MONTH_BASE_6','Czerwiec');
define('TEXT_MONTH_BASE_7','Lipiec');
define('TEXT_MONTH_BASE_8','Sierpień');
define('TEXT_MONTH_BASE_9','Wrzesień');
define('TEXT_MONTH_BASE_10','Październik');
define('TEXT_MONTH_BASE_11','Listopad');
define('TEXT_MONTH_BASE_12','Grudzień');
define('TEXT_MONTH_1','Stycznia');
define('TEXT_MONTH_2','Lutego');
define('TEXT_MONTH_3','Marca');
define('TEXT_MONTH_4','Kwietnia');
define('TEXT_MONTH_5','Maja');
define('TEXT_MONTH_6','Czerwca');
define('TEXT_MONTH_7','Lipca');
define('TEXT_MONTH_8','Sierpnia');
define('TEXT_MONTH_9','Września');
define('TEXT_MONTH_10','Października');
define('TEXT_MONTH_11','Listopada');
define('TEXT_MONTH_12','Grudnia');

// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="pl"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// page title
define('TITLE', 'Administracja');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administracja');
define('HEADER_TITLE_SUPPORT_SITE', 'Witryna wsparcia');
define('HEADER_TITLE_ONLINE_CATALOG', 'Katalog');
define('HEADER_TITLE_ADMINISTRATION', 'Administracja');
define('HEADER_TITLE_CHAINREACTION', 'osCommerce');
define('HEADER_TITLE_PHESIS', 'Loaded6');
// MaxiDVD Added Line For WYSIWYG HTML Area: BOF
define('BOX_CATALOG_DEFINE_MAINPAGE', 'Edytuj stronę główną');
// MaxiDVD Added Line For WYSIWYG HTML Area: EOF

define('CUSTOM_PANEL_DATE1', 'dzień');
define('CUSTOM_PANEL_DATE2', 'dni');
define('CUSTOM_PANEL_DATE3', 'dni');

// text for gender
define('MALE', 'Mężczyzna');
define('FEMALE', 'Kobieta');


// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Ustawienia');
define('BOX_CONFIGURATION_MYSTORE', 'Sklep');
define('BOX_CONFIGURATION_LOGGING', 'Logs');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Moduły');
define('BOX_MODULES_PAYMENT', 'Opłata');
define('BOX_MODULES_SHIPPING', 'Dostawa');
define('BOX_MODULES_SHIP2PAY', 'Dostawa-Opłata');
define('BOX_MODULES_ORDER_TOTAL', 'Zamówienie razem');
define('BOX_CATALOG_SEO_FILTER', "SEO filter");
define('BOX_CATALOG_SEO_TEMPALTES', "Szablony SEO");
// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Katalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategorie / Produkty');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Atrybuty');
define('BOX_CATALOG_PRODUCTS_PROPERTIES', 'Tech. Parametry');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES_NEW', 'Atrybuty - Instalacja');
define('BOX_CATALOG_MANUFACTURERS', 'Producenci');
define('BOX_CATALOG_SPECIALS', 'Rabaty');
define('BOX_CATALOG_EASYPOPULATE', 'Excel import / eksport');

define('BOX_CATALOG_SALEMAKER', 'Masowe rabaty');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Klienci');
define('BOX_CUSTOMERS_CUSTOMERS', 'Klienci');
define('BOX_CUSTOMERS_ORDERS', 'Zamówienia');
define('BOX_CUSTOMERS_EDIT_ORDERS', 'Edytuj zamówienia');
define('BOX_CUSTOMERS_ENTRY', 'Liczba odwiedzin');


// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Miejsca / podatki');
define('BOX_TAXES_COUNTRIES', 'Kraje');
define('BOX_TAXES_ZONES', 'Regiony');
define('BOX_TAXES_GEO_ZONES', 'Strefy podatku');
define('BOX_TAXES_TAX_CLASSES', 'Rodzaje podatków');
define('BOX_TAXES_TAX_RATES', 'Stawki podatkowe');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Raporty');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Oglądane produkty');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Zamówione towary');
define('BOX_REPORTS_PRODUCTS_PURCHASED_BY_CATEGORY', 'Produkty zakupione według kategorii');
define('BOX_REPORTS_ORDERS_TOTAL', 'Najlepsi klienci');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Narzędzia');
define('BOX_TOOLS_BACKUP', 'Tworzenie kopii zapasowej bazy danych');
define('BOX_TOOLS_CACHE', 'Kontrola cache');
define('BOX_TOOLS_MAIL', 'Nadawca Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Menedżer listy mailingowej');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Lokalizacja');
define('BOX_LOCALIZATION_CURRENCIES', 'Waluty');
define('BOX_LOCALIZATION_LANGUAGES', 'Języki');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Statusy zamówień');

// infobox box text in includes/boxes/info_boxes.php
define('BOX_HEADING_BOXES', 'Zarządzanie boxami');
define('BOX_HEADING_TEMPLATE_CONFIGURATION', 'Dostosowywanie szablonów');
define('BOX_HEADING_DESIGN_CONTROLS', 'Interfejs');

// javascript messages
define('JS_ERROR', 'Popełniłeś błąd podczas wypełniania formularza!\nZrób następujące poprawki:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Nowy atrybut towaru musi mieć cenę\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Nowy atrybut towaru musi mieć prefiks ceny\n');

define('JS_PRODUCTS_NAME', '* W przypadku nowego produktu należy podać jego nazwę\n');
define('JS_PRODUCTS_DESCRIPTION', '* W przypadku nowego produktu należy podać opis\n');
define('JS_PRODUCTS_PRICE', '* W przypadku nowego produktu należy podać cenę\n');
define('JS_PRODUCTS_WEIGHT', '* W przypadku nowego produktu należy podać wagę\n');
define('JS_PRODUCTS_QUANTITY', '* W przypadku nowego produktu należy podać ilość\n');
define('JS_PRODUCTS_MODEL', '* W przypadku nowego produktu musisz wprowadzić kod towaru\n');
define('JS_PRODUCTS_IMAGE', '* W przypadku nowego produktu powinien być obraz\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Dla tego produktu należy ustawić nową cenę\n');

define('JS_GENDER', '* Pole \'Płeć\' musi zostać wybrana.\n');
define('JS_FIRST_NAME', '* Pole \'Imię\' musi zawierać co najmniej ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaków.\n');
define('JS_LAST_NAME', '* Pole \'Nazwisko\' musi zawierać co najmniej ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaków.\n');
define('JS_DOB', '* Pole \'Data urodzenia\' musi być w formacie: xx/xx/xxxx (dzień/miesiąc/rok).\n');
define('JS_EMAIL_ADDRESS', '* Pole \'Adres E-Mail\' musi zawierać co najmniej ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaków.\n');
define('JS_ADDRESS', '* Pole \'Adres\' musi zawierać co najmniej' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaków.\n');
define('JS_POST_CODE', '* Pole \'Kod pocztowy\' musi zawierać co najmniej ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaków.\n');
define('JS_CITY', '* Pole \'Miasto\' musi zawierać co najmniej ' . ENTRY_CITY_MIN_LENGTH . ' znaków.\n');
define('JS_STATE', '* Pole \'Województwo\' musi zostać wybrane.\n');
define('JS_STATE_SELECT', '-- Wybierz wyżej --');
define('JS_ZONE', '* Pole \'Zona\' musi pasować do wybranego kraju.');
define('JS_COUNTRY', '* Pole \'Kraj\' należy wypełnić.\n');
define('JS_TELEPHONE', '* Pole \'Telefon\' musi zawierać co najmniej ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaków.\n');
define('JS_PASSWORD', '* Pola \'Hasło\' i \'Potwierdzenie\' muszą się pokrywać i zawierać przynajmniej ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaków.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Zamówienie numer %s nie znaleziono!');

define('CATEGORY_PERSONAL', 'Prywatny');
define('CATEGORY_ADDRESS', 'Adres');
define('CATEGORY_CONTACT', 'Do kontaktu');
define('CATEGORY_COMPANY', 'Firma');
define('CATEGORY_OPTIONS', 'Newsletter');
define('DISCOUNT_OPTIONS', 'Rabaty');

define('ENTRY_GENDER', 'Płeć:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">koniecznie</span>');
    define('ENTRY_FIRST_NAME', 'Imię: ');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaków</span>');
define('ENTRY_LAST_NAME', 'Nazwisko:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaków</span>');
define('ENTRY_DATE_OF_BIRTH', 'Data urodzenia:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(przykład 21/05/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'Adres E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaków</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Został wprowadzony nieprawidłowy adres e-mail!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Ten adres e-mail jest już zarejestrowany!</span>');
define('ENTRY_COMPANY', 'Nazwa firmy:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Adres:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaków</span>');
define('ENTRY_SUBURB', 'Powiat:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Kod pocztowy:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaków</span>');
define('ENTRY_CITY', 'Miasto:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_CITY_MIN_LENGTH . ' znaków</span>');
define('ENTRY_STATE', 'Województwo');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">koniecznie</span>');
define('ENTRY_COUNTRY', 'Kraj:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefon:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaków</span>');
define('ENTRY_FAX_NUMBER', 'Faks:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Otrzymywać newsletter:');
define('ENTRY_NEWSLETTER_YES', 'Subskrybujesz');
define('ENTRY_NEWSLETTER_NO', 'Nie Subskrybujesz');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Wyślij wiadomość e-mail');
define('IMAGE_BACK', 'Wróć');
define('IMAGE_BACKUP', 'Kopia rezerwowa');
define('IMAGE_CANCEL', 'Cofnij');
define('IMAGE_CONFIRM', 'Potwierdź');
define('IMAGE_COPY', 'Kopiuj');
define('IMAGE_COPY_TO', 'Skopiuj do');
define('IMAGE_DETAILS', 'Dostosuj');
define('IMAGE_DELETE', 'Usuń');
define('IMAGE_EDIT', 'Edytuj');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'Menedżer plików');
define('IMAGE_ICON_STATUS_GREEN', 'Aktywny');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Aktywuj');
define('IMAGE_ICON_STATUS_RED', 'Nieaktywny');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Dezaktywować');
define('IMAGE_ICON_INFO', 'Strony informacyjne');
define('IMAGE_INSERT', 'Dodać');
define('IMAGE_LOCK', 'Zamek');
define('IMAGE_MODULE_INSTALL', 'Zainstaluj moduł');
define('IMAGE_MODULE_REMOVE', 'Usuń moduł');
define('IMAGE_MOVE', 'Przenieś');
define('IMAGE_NEW_BANNER', 'Nowy baner');
define('IMAGE_NEW_CATEGORY', 'Nowa kategoria');
define('IMAGE_NEW_COUNTRY', 'Nowy kraj');
define('IMAGE_NEW_CURRENCY', 'Nowa waluta');
define('IMAGE_NEW_FILE', 'Nowy plik');
define('IMAGE_NEW_FOLDER', 'Nowy folder');
define('IMAGE_NEW_LANGUAGE', 'Nowy język');
define('IMAGE_NEW_NEWSLETTER', 'Nowa wiadomość aktualności');
define('IMAGE_NEW_PRODUCT', 'Nowy produkt');
define('IMAGE_NEW_SALE', 'Nowa wyprzedaż');
define('IMAGE_NEW_TAX_CLASS', 'Nowy podatek');
define('IMAGE_NEW_TAX_RATE', 'Nowa stawka podatku');
define('IMAGE_NEW_TAX_ZONE', 'Nowa podatkowa strefa ');
define('IMAGE_NEW_ZONE', 'Nowa strefa');
define('IMAGE_ORDERS', 'Zamówienia');
define('IMAGE_ORDERS_INVOICE', 'Faktura');
define('IMAGE_ORDERS_PACKINGSLIP', 'List przewozowy');
define('IMAGE_PREVIEW', 'Podgląd');
define('IMAGE_RESTORE', 'Przywrócić');
define('IMAGE_RESET', 'Zresetuj');
define('IMAGE_SAVE', 'Zapisz');
define('IMAGE_SEARCH', 'Wyszukaj');
define('IMAGE_SELECT', 'Wybierz');
define('IMAGE_SEND', 'Wyślij');
define('IMAGE_SEND_EMAIL', 'Wyślij e-mail');
define('IMAGE_UNLOCK', 'Odblokuj');
define('IMAGE_UPDATE', 'Uaktualnij');
define('IMAGE_UPDATE_CURRENCIES', 'Dostosuj kursy wymiany');
define('IMAGE_UPDATE_CURRENCIES_SHORT', 'Zaktualizuj waluty');
define('IMAGE_UPLOAD', 'Pobierz');
define('TEXT_IMAGE_NONEXISTENT', 'Brak obrazu');

define('IMAGE_BUTTON_BUY_TEMPLATE','Przełącz na płatny pakiet');
define('IMAGE_BUTTON_BUY_TEMPLATE_MOB', 'Kupić');
define('TIME_LEFT', 'Pozostało: ');

define('ICON_CROSS', 'Nieważne');
define('ICON_CURRENT_FOLDER', 'Aktualny katalog');
define('ICON_DELETE', 'Usuń');
define('ICON_ERROR', 'Błąd:');
define('ICON_FILE', 'Plik');
define('ICON_FILE_DOWNLOAD', 'Pobierz');
define('ICON_FOLDER', 'Folder');
define('ICON_LOCKED', 'Blokuj');
define('ICON_PREVIOUS_LEVEL', 'Poprzedni poziom');
define('ICON_PREVIEW', 'Edytuj');
define('ICON_STATISTICS', 'Statystyki');
define('ICON_SUCCESS', 'Zrobione');
define('ICON_TICK', 'Prawda');
define('ICON_UNLOCKED', 'Odblokuj');
define('ICON_WARNING', 'UWAGA');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Strona %s z %d');

define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> banerów)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> krajów)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> klientów)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> walut)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> językowych modułów)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> producentów)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie<b>%d</b> newsletter)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> zamówień)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> statusów)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> pozycji)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> ofert specjalnych )');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> rodzajów podatku)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> stref podatkowych)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> stawek podatkowych)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> stref)');

define('PREVNEXT_BUTTON_PREV', 'Poprzednia');
define('PREVNEXT_BUTTON_NEXT', 'Następna');

define('TEXT_DEFAULT', 'domyślnie');
define('TEXT_SET_DEFAULT', 'Ustaw jako domyślny');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Koniecznie</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Błąd: Obecnie żadna z walut nie jest domyślnie ustawiona. Zainstaluj jedną z nich w: Lokalizacja -> Waluta');

define('TEXT_CACHE_CATEGORIES', 'Box kategorii');
define('TEXT_CACHE_MANUFACTURERS', 'Box producentów');
define('TEXT_CACHE_ALSO_PURCHASED', 'Również moduły zakupów');

define('TEXT_NONE', '--nie--');
define('TEXT_TOP', 'Początek');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Błąd: katalog nie istnieje.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Błąd: katalog jest chroniony przed zapisem, ustaw niezbędne prawa dostępu.');
define('ERROR_FILE_NOT_SAVED', 'Błąd: plik nie został przesłany.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Błąd: nie możesz przesyłać plików tego typu.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Gotowe: plik został pomyślnie przesłany.');
define('WARNING_NO_FILE_UPLOADED', 'Ostrzeżenie: żadne pliki nie zostały przesłane.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Ostrzeżenie: Opcja pobierania pliku jest wyłączona w pliku konfiguracyjnym php.ini.');

define('BOX_CATALOG_XSELL_PRODUCTS', 'Powiązane towary');


// X-Sell
REQUIRE(DIR_WS_LANGUAGES . 'add_ccgvdc_russian.php');

// BOF: Lango Added for print order MOD
define('IMAGE_BUTTON_PRINT', 'Drukuj');
// EOF: Lango Added for print order MOD

// BOF: Lango Added for Featured product MOD
define('BOX_CATALOG_FEATURED', 'Polecane produkty');
// EOF: Lango Added for Featured product MOD

// BOF: Lango Added for Sales Stats MOD
define('BOX_REPORTS_MONTHLY_SALES', 'Statystyki sprzedaży');
// EOF: Lango Added for Sales Stats MOD


//BEGIN Dynamic information pages unlimited
define('BOX_HEADING_INFORMATION', 'Zadowolony');
define('BOX_HEADING_SEO', 'SEO');
define('BOX_INFORMATION', 'Strony informacyjne');
//END Dynamic information pages unlimited

define('BOX_TOOLS_KEYWORDS', 'Zapytania wyszukiwania');

// RJW Begin Meta Tags Code
define('TEXT_META_TITLE', 'Meta Title');
define('TEXT_META_DESCRIPTION', 'Meta Description');
define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

// Article Manager
define('BOX_HEADING_ARTICLES', 'Artykuły');
define('BOX_TOPICS_ARTICLES', 'Artykuły');
define('BOX_ARTICLES_CONFIG', 'Ustawienia');
define('BOX_ARTICLES_XSELL', 'Towary-artykuły');
define('IMAGE_NEW_TOPIC', 'Nowa sekcja');
define('IMAGE_NEW_ARTICLE', 'Nowy artykuł');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> autorów)');

//TotalB2B start
define('BOX_CUSTOMERS_GROUPS', 'Grupy');
define('BOX_MANUDISCOUNT', 'Rabaty dla producentów');
//TotalB2B end

// add for Group minimum price to order start		
define('GROUP_MIN_PRICE', 'Minimalny koszt zamówienia grupy');
// add for Group minimum price to order end

// add for color groups start
define('GROUP_COLOR_BAR', 'Kolor grupy');
// add for color groups end
//TotalB2B end
define('BOX_CATALOG_QUICK_UPDATES', 'Aktualizacja ceny');

define('IMAGE_PROPERTIES_POPUP_ADD_CHANGE_DELETE', 'Zmień / Usuń tech. parametry');
define('IMAGE_PROPERTIES_POPUP_ADD', 'Dodaj nowy. parametry');
define('IMAGE_PROPERTIES', 'Tech. parametry');

// polls box text in includes/boxes/polls.php

define('BOX_HEADING_POLLS', 'Ankiety');
define('BOX_POLLS_POLLS', 'Ankiety');
define('BOX_POLLS_CONFIG', 'Ustawienia ankiety');
define('BOX_CURRENCIES_CONFIG', 'Waluty');
define('BOX_COUPONS', 'Kupony');

define('BOX_INDEX_GIFTVOUCHERS', 'Karty podarunkowe / Kupony');

define('BOX_REPORTS_SALES_REPORT2', 'Statystyki sprzedaży 2');
define('BOX_REPORTS_SALES_REPORT', 'Statystyki sprzedaży 3');
define('BOX_REPORTS_CUSTOMERS_ORDERS', 'Statystyki klientów');

define('TEXT_NEW_ATTRIBUTE_EDIT', 'Edytuj atrybuty produktu');

define('ONE_PAGE_CHECKOUT_TITLE', 'Złożyć zamówienie');
define('BROWSE_BY_CATEGORIES_TITLE', 'Wyświetlanie kategorii');
define('SEO_TITLE', 'SEO URLs');
define('SEO_ENABLED_DESC', 'Moduł SEO URLs - Moduł przeznaczony jest do konwersji zwykłych linków do połączeń CNC');

define('ONEPAGE_ADDR_LAYOUT_TITLE', 'Addresses Layout');
define('ONEPAGE_CHECKOUT_HIDE_SHIPPING_TITLE', 'Dont show shipping and handling address checkbox or ship methods if weight of products = 0');
define('ONEPAGE_ZIP_BELOW_TITLE', '	Move zip/post code input boxes below state');
define('ONEPAGE_TELEPHONE_TITLE', 'Czy potrzebujesz kontakt');
define('ONEPAGE_CHECKOUT_LOADER_POPUP_TITLE', 'Make loader message popup');
define('ONEPAGE_CHECKOUT_SHOW_ADDRESS_INPUT_FIELDS_TITLE', 'Show Address in input Fields');
define('ONEPAGE_DEBUG_EMAIL_ADDRESS_TITLE', 'Send Debug Emails To:');
define('ONEPAGE_BOX_TWO_CONTENT_TITLE', 'Custom Colum Box #2 Content');
define('ONEPAGE_BOX_TWO_HEADING_TITLE', 'Custom Colum Box #2 Heading');
define('ONEPAGE_BOX_ONE_CONTENT_TITLE', 'Custom Colum Box #1 Content');
define('ONEPAGE_BOX_ONE_HEADING_TITLE', 'Custom Colum Box #1 Heading');
define('ONEPAGE_SHOW_OSC_COLUMNS_TITLE', 'Pokaż kolumny Oscommerce');
define('ONEPAGE_LOGIN_REQUIRED_TITLE', 'Wymagaj logowania');
define('ONEPAGE_SHOW_CUSTOM_COLUMN_TITLE', 'Pokaż prawą kolumnę');
define('ONEPAGE_ACCOUNT_CREATE_TITLE', 'Utwórz konto');
define('ONEPAGE_CHECKOUT_ENABLED_TITLE', 'Włącz One Page Checkout');
define('ONEPAGE_AUTO_SHOW_DEFAULT_ZIP_TITLE', 'Auto-show billing/shipping Default zip code');
define('ONEPAGE_AUTO_SHOW_DEFAULT_STATE_TITLE', 'Auto-show billing/shipping Default State');
define('ONEPAGE_AUTO_SHOW_DEFAULT_COUNTRY_TITLE', 'Auto-show billing/shipping Default Country');
define('ONEPAGE_AUTO_SHOW_BILLING_SHIPPING_TITLE', 'Auto-show billing/shipping modules');

define('SMS_ENABLE_TITLE', 'Włącz usługę SMS');
define('SMS_GATENAME_TITLE', 'SMS gatename');
define('SMS_CUSTOMER_ENABLE_TITLE', 'Wyślij SMS do klienta przy zakupie?');
define('TELEGRAM_TOKEN_TITLE','Telegram Token');
define('TELEGRAM_NOTIFICATIONS_ENABLED_TITLE','Włącz powiadomienia Telegram');
define('SMS_CHANGE_STATUS_TITLE', 'Wysłać SMS do klienta przy zmianie statusu?');
define('SMS_OWNER_ENABLE_TITLE', 'Wyślij SMS do administratora przy zakupie?');
define('SMS_OWNER_ENABLE_BUY_ONE_CLICK_TITLE', 'Wysłać sms do administratora przy zakupie jednym kliknięciem?');
define('SMS_OWNER_TEL_TITLE', 'Numer telefonu administratora');
define('SMS_TEXT_TITLE', 'Tekst sms');
define('SMS_LOGIN_TITLE', 'Zaloguj się do bramki SMS (lub klucza API, Account SID)');
define('SMS_PASSWORD_TITLE', 'Hasło (or Auth token)');
define('SMS_SIGN_TITLE', 'Nadawca (or Service SID)');
define('SMS_ENC_TITLE', 'Kod2');


define('ROBOTS_TXT_TITLE', 'robots.txt');

define('SMS_CONF_TITLE', 'sms-serwis');
define('MY_SHOP_CONF_TITLE', 'Mój sklep');
define('MIN_VALUES_CONF_TITLE', 'Minimalne wartości');
define('MAX_VALUES_CONF_TITLE', 'Maksymalne wartości');
define('IMAGES_CONF_TITLE', 'Zdjęcia');
define('CUSTOMER_DETAILS_CONF_TITLE', 'Dane kupującego');
define('MODULES_CONF_TITLE', 'Zainstalowane moduły');
define('SHIPPING_CONF_TITLE', 'Wysyłka / pakowanie');
define('LISTING_CONF_TITLE', 'Wyświetlenie towarów');
define('STOCK_CONF_TITLE', 'Magazyn');
define('LOGS_CONF_TITLE', 'Login');
define('CACHE_CONF_TITLE', 'Cash');
define('EMAIL_CONF_TITLE', 'Konfigurowanie wiadomości e-mail');
define('DOWNLOAD_CONF_TITLE', 'Pobierz');
define('GZIP_CONF_TITLE', 'GZip Kompresja');
define('SESSIONS_CONF_TITLE', 'Sesje');
define('HTML_CONF_TITLE', 'HTML Edytor');
define('DYMO_CONF_TITLE', 'Moduł Dynamic MoPics');
define('DOWN_CONF_TITLE', 'Tech. serwisowanie');
define('GA_CONF_TITLE', 'Szybka rejestracja');
define('LINKS_CONF_TITLE', 'Linki');
define('QUICK_CONF_TITLE', 'Aktualizacja ceny');
define('WISHLIST_TITLE', 'Lista życzeń');
define('PAGE_CACHE_TITLE', 'Strona cache');
define('GRAPHS_TITLE', 'Wykres');
define('YANDEX_MARKET_CONF_TITLE', 'XML-eksport');


define('ATTRIBUTES_COPY_TEXT1', ' Ostrzeżenie: nie można kopiować atrybutów z numeru przedmiotu ');
define('ATTRIBUTES_COPY_TEXT2', ' w numer towaru');
define('ATTRIBUTES_COPY_TEXT3', '. Nic nie zostało skopiowane.');
define('ATTRIBUTES_COPY_TEXT4', ' Uwaga: nie ma atrybutów do skopiowania z numeru przedmiotu ');
define('ATTRIBUTES_COPY_TEXT5', ' w towar ');
define('ATTRIBUTES_COPY_TEXT6', '. Nic nie jest skopiowane.');
define('ATTRIBUTES_COPY_TEXT7', ' Ostrzeżenie: nie znaleziono  ');
define('ATTRIBUTES_COPY_TEXT8', ' produktu z numerem. Albo nie podałeś numeru produktu, albo określony produkt nie istnieje. Nic nie jest skopiowane.');

//include('includes/languages/english_support.php');

// BOF FlyOpenair: Extra Product Price
define('BOX_EXTRA_PRODUCT_PRICE', 'Marża');
define('EXTRA_PRODUCT_PRICE_ID_TITLE', 'System marży');
define('EXTRA_PRODUCT_PRICE_ID_DESC', 'Włącz lub wyłącz moduł systemu marży');
// EOF FlyOpenair: Extra Product Price

define('TEXT_IMAGE_OVERWRITE_WARNING', 'UWAGA: nazwa pliku została zmieniona, ale nie została zastąpiona ');

// 500 Page )
define('SERVICE_MENU', 'TOOLS');
define('SEO_CONFIGURATION','SEO TOOLS');


define('COMMENTS_MODULE_ENABLED_TITLE', 'Opinie');
define('FACEBOOK_PIXEL_MODULE_ENABLED_TITLE','FaceBook Pixel');
define('DEFAULT_PIXEL_CURRENCY_TITLE','FaceBook Pixel currency');
define('QUICK_PRODUCTS_UPDATE_ENABLED_TITLE','Aktualizacja ceny');
define('FACEBOOK_PIXEL_ID_TITLE','FaceBook Pixel ID');
define('LANGUAGE_SELECTOR_MODULE_ENABLED_TITLE', 'Wielojęzyczność');
define('PRODUCT_LABELS_MODULE_ENABLED_TITLE', 'Skrót');
define('ATTRIBUTES_PRODUCTS_MODULE_ENABLED_TITLE', 'Filtry');
define('AUTH_MODULE_ENABLED_TITLE', 'Autoryzacja');
define('EXCEL_IMPORT_MODULE_ENABLED_TITLE', 'Importuj / eksportuj');
define('CUPONES_MODULE_ENABLED_TITLE', 'Kupony');
define('COMPARE_MODULE_ENABLED_TITLE', 'Porównanie');
define('WISHLIST_MODULE_ENABLED_TITLE', 'Lista życzeń');
define('GOOGLE_FEED_CHOOSE_ALL_PRODUCTS_TITLE', 'aktywne produkty');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_2_TITLE', 'produkty z aktywnym statusem XML');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_3_TITLE', 'produkty z dostępnością w magazynie');
define('XSELL_PRODUCTS_BUYNOW_ENABLED_TITLE', 'Produkty powiązane');
define('STATS_PRODUCTS_PURCHASED_BY_CATEGORY_MODULE_ENABLED_TITLE', 'Produkty zakupione według kategorii');
define('SALEMAKER_MODULE_ENABLED_TITLE', 'Masowe rabaty');
define('SPECIALS_MODULE_ENABLED_TITLE', 'Rabaty');
define('STATS_KEYWORDS_ENABLED_TITLE', 'Zapytania');
define('BACKUP_ENABLED_TITLE', 'Database Backup');
define('PRODUCTS_MULTI_ENABLED_TITLE', 'Zarządzanie produktami');
define('SEO_TEMPLATES_ENABLED_TITLE', 'Szablony SEO');
define('SHIP2PAY_ENABLED_TITLE', 'Wysyłka i Płatności');
define('QTY_PRO_ENABLED_TITLE', 'Kombinacje atrybutów');
define('MASTER_PASSWORD_MODULE_ENABLED_TITLE', 'Master Password');
define('YML_MODULE_ENABLED_TITLE', 'Import XML (YML)');
define('OSC_IMPORT_MODULE_ENABLED_TITLE', 'Database migration (osCommerce)');
define('EXPORT_HOTLINE_MODULE_ENABLED_TITLE', 'XML products export "Hotline"');
define('EXPORT_PROMUA_MODULE_ENABLED_TITLE', 'XML products export "Prom"');
define('EXPORT_PRICEUA_MODULE_ENABLED_TITLE', 'XML products export "Price.ua"');
define('EXPORT_ROZETKA_MODULE_ENABLED_TITLE', 'XML products export "Rozetka"');
define('EXPORT_YANDEX_MARKET_MODULE_ENABLED_TITLE', 'Yandex Market export');
define('EXPORT_GOOGLE_SITEMAP_MODULE_ENABLED_TITLE', 'XML Sitemaps');
define('EXPORT_FACEBOOK_FEED_MODULE_ENABLED_TITLE', 'XML feed for Facebook Product Catalog');
define('EXPORT_PDF_MODULE_ENABLED_TITLE', 'Export catalog to PDF');
define('PROMURLS_MODULE_ENABLED_TITLE', 'Prom.ua Urls');
define('PROM_EXCEL_MODULE_ENABLED_TITLE', 'Import Prom.ua (Excel)');
define('MASTER_PASS_TITLE', 'Master Password');
define('SMSINFORM_MODULE_ENABLED_TITLE', 'Moduł SMS');
define('CARDS_ENABLED_TITLE', 'Płatność kartami');
define('SOCIAL_WIDGETS_ENABLED_TITLE', 'Soc. widżety');
define('MULTICOLOR_ENABLED_TITLE', 'Multicolor');
define('WATERMARK_ENABLED_TITLE', 'Znak wodny');

define('FACEBOOK_APP_ID_TITLE', 'Facebook app ID');
define('FACEBOOK_APP_SECRET_TITLE', 'Facebook sekretny klucz');
define('VK_APP_ID_TITLE', 'Vkontakte app ID');
define('VK_APP_SECRET_TITLE', 'Vkontakte sekretny klucz');

define('TABLE_HEADING_ORDERS', 'ZAMÓWIENIA:');
define('TABLE_HEADING_LAST_ORDERS', 'Ostatnie zamówienia');
define('TABLE_HEADING_CUSTOMER', 'Kupujący');
define('TABLE_HEADING_ORDER_NUMBER', '№');
define('TABLE_HEADING_ORDER_TOTAL', 'Suma');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_DATE', 'Data');

include('includes/languages/order_edit_polish.php');

define('TEXT_VALID_TITLE', 'Lista kategorii');
define('TEXT_VALID_TITLE_PROD', 'Lista produktów');
define('TEXT_VALID_CLOSE', 'Zamknij okno');
define('TABLE_HEADING_LASTNAME', 'Nazwisko');
define('TABLE_HEADING_FIRSTNAME', 'Imię');
define('TABLE_HEADING_PRODUCT_NAME', 'Nazwa');
define('TABLE_HEADING_PRODUCT_PRICE', 'Cena');
define('TEXT_SELECT_CUSTOMER', 'Wybierz klienta');
define('TEXT_SELECT_CUSTOMER_PLACEHOLDER', 'Rozpocznij wprowadzanie identyfikatora klienta / nazwy / telefonu / adresu e-mail');
define('TEXT_SINGLE_CUSTOMER', 'Jeden klient');
define('TEXT_EMAIL_RECIPIENT', 'Odbiorca emaila');

define('TEXT_NOTIFICATIONS', 'Powiadomienia');
define('TEXT_NOTIFICATIONS_MESSAGE', 'Masz %s niezweryfikowanych zamówień');
define('TEXT_NOTIFICATIONS_LINK', 'Przejdź do strony zamówienia');

define('TEXT_PROFILE', 'Konto');
define('TEXT_PROFILE_GREETINGS', 'Witamy, %s!');
define('TEXT_PROFILE_LOGIN_COUNT', 'Liczba wejść: %s');
define('TEXT_PROFILE_DAYS_WITH_US', 'Jesteś już z nami przez %s dni');



define('TOOLTIP_STORE_NAME', 'Wskaż oryginalną nazwę sklepu, który przyciąga klientów, jest zapamiętywany przez klientów oraz służy do wyróżnienia się i odróżnienia od podobnych sklepów – konkurentów.');
define('TOOLTIP_STORE_OWNER', 'Określ właściciela sklepu');
define('TOOLTIP_SHOW_BASKET_ON_ADD_TO_CART', 'Włącz, koszyk będzie dostępny podczas dodawania produktu, dzięki czemu odwiedzający nie będzie miał pytań, że produkt został dodany do koszyka.');
define('TOOLTIP_USE_DEFAULT_LANGUAGE_CURRENCY', 'Włącz automatyczną zmianę waluty zgodnie z bieżącym językiem witryny.');
define('TOOLTIP_CHANGE_BY_GEOLOCATION', 'Włącz zmianę waluty i języka witryny na podstawie geolokalizacji.');
define('TOOLTIP_GET_BROWSER_LANGUAGE', 'Włącz, aby zmienić walutę witryny w zależności od języka przeglądarki.');
define('TOOLTIP_STORE_BANK_INFO', 'Umożliwia zdefiniowanie dokładnych informacji bankowych dla szczegółów faktury');
define('TOOLTIP_ONEPAGE_LOGIN_REQUIRED', 'Włącz i logowanie użytkownika/klienta będzie zawsze wymagane');
define('TOOLTIP_REVIEWS_WRITE_ACCESS', 'Włącz i tylko zarejestrowani użytkownicy będą mogli dodawać komentarze');
define('TOOLTIP_ROBOTS_TXT', 'Ochrona całej witryny lub niektórych jej sekcji przed indeksowaniem');
define('TOOLTIP_MENU_LOCATION', 'Wybierz pozycję menu: zwinięte u góry, w lewo lub w lewo');
define('TOOLTIP_DEFAULT_DATE_FORMAT', 'Wybierz format daty');
define('TOOLTIP_SET_HTTPS', 'Włącz rozszerzenie protokołu HTTPS, aby obsługiwać szyfrowanie w celu zwiększenia bezpieczeństwa');
define('TOOLTIP_SET_WWW', 'Wybierz ustawienie, do którego chcesz przekierować: wyłącz, www->no-www lub no-www->www');
define('TOOLTIP_ENABLE_DEBUG_PAGE_SPEED', 'Włącz debugowanie ładowania strony, aby znaleźć i naprawić błędy w skrypcie');
define('TOOLTIP_STORE_SCRIPTS', 'Możesz dołączyć dodatkowe skrypty JS');
define('TOOLTIP_STORE_METAS', 'Możesz dołączyć dodatkowe metatagi w głowie');
define('TOOLTIP_MYSQL_PERFORMANCE_TRESHOLD', 'Ustaw czas w „sekundach”, powyżej którego powolne i potencjalnie problematyczne zapytania będą rejestrowane w bazie danych');


define('TOOLTIP_FACEBOOK_AUTH_STATUS', 'Możesz zezwolić użytkownikom na logowanie się do Twojej witryny za pomocą konta na Facebooku. To świetny sposób, aby ten proces był łatwiejszy i wygodniejszy dla Twoich użytkowników, a także zwiększyć liczbę nowych rejestracji.');
define('TOOLTIP_FACEBOOK_APP_ID', 'Identyfikator w mediach społecznościowych to kombinacja liczb, która odróżnia jedno konto od innych. W Internecie jest to odpowiednik paszportu, który często wymaga zastosowania niezawodnych metod ochrony. Numer identyfikacyjny generowany jest automatycznie podczas rejestracji profilu. Dzięki niemu możesz znaleźć potrzebne informacje, osobę lub interesującą społeczność.');
define('TOOLTIP_FACEBOOK_APP_SECRET', 'Tajny klucz to urządzenie do ochrony Twojego konta na Facebooku. Jest to również dwuskładnikowa metoda uwierzytelniania, która zwiększa poziom bezpieczeństwa podczas logowania do konta.');
define('TOOLTIP_FACEBOOK_PIXEL_ID', 'Dzięki danym zbieranym przez Facebook Pixel możesz śledzić wizyty i konwersje w swojej witrynie, optymalizować reklamy i tworzyć niestandardowe grupy odbiorców do retargetowania.');
define('TOOLTIP_DEFAULT_PIXEL_CURRENCY', 'Określ walutę, w której cena produktu zostanie przesłana do FaceBook Pixel');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_BUG_REPORT', 'Ma on na celu opisanie wykrytych błędów, co pozwoli zespołowi programistycznemu naprawić błędy w programie.');
define('TOOLTIP_FACEBOOK_GOALS_PHONE_CALL', 'Wyświetlając reklamy z numerem telefonu, możesz zachęcić ludzi do skontaktowania się z Twoją firmą w celu złożenia zamówienia, dowiedzenia się więcej o Twoich produktach lub usługach lub umówienia spotkania.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_FAST_BUY', 'Jeśli towary kupowane są regularnie, często cechy są już znane kupującemu, zadaniem nie jest wybór, ale znalezienie właściwego, dodanie go do koszyka i szybkie złożenie zamówienia.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_CHAT', 'Przycisk czatu to ikona umieszczona gdzieś w Twojej witrynie, która pozwala klientom komunikować się w czasie rzeczywistym z zespołem obsługi klienta. Za pomocą czatu online Twoi specjaliści mogą szybko i skutecznie rozwiązywać zapytania klientów.');
define('TOOLTIP_FACEBOOK_GOALS_CALLBACK', 'Zadaniem przycisku oddzwaniania jest doprowadzenie potencjalnego klienta do komunikacji.');
define('TOOLTIP_FACEBOOK_GOALS_FILTER', 'Filtr umożliwia zawężenie asortymentu do selekcji o cechach najbardziej odpowiadających indywidualnym potrzebom użytkownika.');
define('TOOLTIP_FACEBOOK_GOALS_SUBSCRIBE', 'Zapewnia użytkownikom możliwość organizowania i utrzymywania tematycznych biuletynów e-mail, które mogą subskrybować inni użytkownicy usługi.');
define('TOOLTIP_FACEBOOK_GOALS_LOGIN', 'login to słowo, które zostanie użyte do wejścia na stronę lub usługę. Bardzo często login pasuje do nazwy użytkownika, która będzie widoczna dla wszystkich uczestników serwisu.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_REVIEW', 'Recenzje klientów — opinie użytkowników na temat Twoich produktów lub usług. Aby kupić produkt, 89% kupujących najpierw czyta recenzje.');
define('TOOLTIP_FACEBOOK_GOALS_PAGE_VIEW', 'Możesz wiedzieć, ile osób widziało i prosiło o Twoją witrynę');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_CART', 'Przycisk „Dodaj do koszyka” oznacza zakup kilku produktów, gdy są one po raz pierwszy dodane do koszyka i zamówienie jest już tam złożone.');
define('TOOLTIP_FACEBOOK_GOALS_CHECKOUT_PROCESS', 'Jakość i wygoda korzystania z koszyka to gwarancja dobrego nastroju dla Twoich klientów, skuteczny sposób na zwiększenie konwersji na stronie.');
define('TOOLTIP_FACEBOOK_GOALS_SEARCH_RESULTS', 'Przenosi użytkownika na stronę wyników wyszukiwania');
define('TOOLTIP_FACEBOOK_GOALS_VIEW_CONTENT', 'ViewContent informuje, czy ktoś odwiedza adres URL strony internetowej.');
define('TOOLTIP_FACEBOOK_GOALS_COMPLETE_REGISTRATION', 'Udzielanie informacji przez klienta w zamian za usługę świadczoną przez Twoją firmę');
define('TOOLTIP_FACEBOOK_GOALS_CONTACT_US_REQUEST', 'Dane kontaktowe osoby, która wykazała się realnym zainteresowaniem produktami i usługami firmy i może w przyszłości zostać prawdziwym klientem.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_WISHLIST', 'Jedno ze zdarzeń, które pozwala monitorować działania użytkowników, optymalizować je i tworzyć odbiorców');
define('TOOLTIP_FACEBOOK_GOALS_ADD_PAYMENT_INFO', 'Jedno ze zdarzeń, które pozwala monitorować działania użytkowników, optymalizować je i tworzyć odbiorców');
define('TOOLTIP_FACEBOOK_GOALS_SUCCESS_PAGE', 'Klient widzi rodzaj faktury o idealnym zamówieniu.');

define('TOOLTIP_GOOGLE_OAUTH_STATUS', 'Możliwość włączania/wyłączania autoryzacji klienta przez Google');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_ID', 'Domyślnie Google przypisuje unikalny identyfikator klienta — Identyfikator klienta.');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_SECRET', 'CLIENT_SECRET służy do przechowywania nieco bardziej wrażliwych informacji, takich jak wykorzystanie interfejsu API, informacje o ruchu i informacje rozliczeniowe');
define('TOOLTIP_GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED', 'Posiada narzędzie do śledzenia zdarzeń, umożliwia usługom zbieranie danych i przeprowadzanie analiz');
define('TOOLTIP_GOOGLE_ECOMM_SUCCESS_PAGE', 'Możliwość włączenia / wyłączenia strony "zakup" po potwierdzeniu zamówienia');
define('TOOLTIP_GOOGLE_ECOMM_CHECKOUT_PAGE', 'Możliwość włączenia/wyłączenia strony kasy');
define('TOOLTIP_GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE', 'Możliwość włączenia/wyłączenia strony widoku produktu');
define('TOOLTIP_GOOGLE_ECOMM_SEARCH_RESULTS', 'Możliwość włączenia/wyłączenia strony wyników wyszukiwania');
define('TOOLTIP_GOOGLE_ECOMM_HOME_PAGE', 'Możliwość włączenia / wyłączenia strony startowej podczas ładowania przeglądarki');
define('TOOLTIP_GOOGLE_SITE_VERIFICATION_KEY', 'Klucz dostarczony przez Google (wystarczy włożyć sam klucz!)');
define('TOOLTIP_GOOGLE_RECAPTCHA_STATUS', 'Możesz włączyć/wyłączyć Google Recaptcha (zabezpieczenie stron internetowych przed botami internetowymi i jednocześnie pomoc w digitalizacji tekstów książek)');
define('TOOLTIP_GOOGLE_RECAPTCHA_PUBLIC_KEY', 'Udostępnia usługę Google (w celu ochrony stron internetowych przed botami internetowymi i jednocześnie pomocy w digitalizacji tekstów książek)');
define('TOOLTIP_GOOGLE_RECAPTCHA_SECRET_KEY', 'Udostępnia usługę Google (w celu ochrony stron internetowych przed botami internetowymi i jednocześnie pomocy w digitalizacji tekstów książek)');



define('TEXT_MENU_TITLE', 'Menu');
define('TEXT_MENU_HOME', 'Strona główna');
define('TEXT_MENU_PRODUCTS', 'Produkty');
define("TEXT_MENU_EMAIL_CONTENT", "Szablony e-maili");
define('TEXT_MENU_CATALOGUE', 'Katalog');
define('TEXT_MENU_CKFINDER', 'File manager');
define('TEXT_MENU_ATTRIBUTES', 'Atrybuty');
define('TEXT_MENU_ORDERS', 'Zamówienia');
define('TEXT_MENU_ORDERS_LIST', 'Lista zamówień');
define('TEXT_MENU_CLIENTS_LIST', 'Lista klientów');
define('TEXT_MENU_CLIENTS_GROUPS', 'Grupy klientów');
define('TEXT_MENU_ADD_CLIENT', 'Dodaj klienta');
define('TEXT_MENU_PAGES', 'Strony');
define('TEXT_MENU_SITE_MODULES', 'Moduły SOLO');
define('TEXT_MENU_SITE_SEO_SETTINGS', 'Ustawienia SEO');
define('TEXT_MENU_BACKUP', 'Database Backup');
define('TEXT_MENU_NEWSLETTERS', 'Newsletter');
define('TEXT_MENU_SLOW_QUERIES_LOGS', 'Log powolnych zapytań');
define('TEXT_MENU_PRODUCTS_VIEWS', 'Wyświetlenia towarów');
define('TEXT_MENU_CLIENTS', 'Klienci');
define('TEXT_MENU_SALES', 'Sprzedaż');
define('TEXT_MENU_ADMINS_AND_GROUPS', 'Administratorzy i grupy');
define('TEXT_MENU_UPDATE_PROFILE', 'Zaktualizuj swoje dane');
define('TEXT_MENU_NOPHOTO', 'Otwarte przez');
define('TEXT_MENU_OPENEDBY', 'Opened by');
define('TEXT_MENU_LAST_MODIFIED', 'Ostatnio zmodyfikowany');
define('TEXT_MENU_ZEROQTY', 'Zero ilości');
define('TEXT_MENU_STATS_RECOVER_CART_SALES', 'Statystyki Odzyskaj sprzedaż koszyka');
define('TEXT_MENU_SEARCH', 'Szukaj według kategorii');

define('TEXT_HEADING_ADD_NEW', 'Dodać');
define('TEXT_HEADING_ADD_NEW_PRODUCT', 'Produkt');
define('TEXT_HEADING_ADD_NEW_CATEGORY', 'Kategorię');
define('TEXT_HEADING_ADD_NEW_PAGE', 'Stronę');
define('TEXT_HEADING_ADD_NEW_CLIENT', 'Klienta');
define('TEXT_HEADING_ADD_NEW_ORDER', 'Zamówienie');
define('TEXT_HEADING_ADD_NEW_COUPON', 'Kupon');

define('TEXT_BLOCK_ORDERS_STATUSES_COUNTERS', 'Statusy zamówień');

define('TEXT_BLOCK_ORDERS_TODAY_COUNTERS', 'Dzisiaj');
define('TEXT_BLOCK_ORDERS_YESTERDAY_COUNTERS', 'Wczoraj');
define('TEXT_BLOCK_ORDERS_WEEK_COUNTERS', 'Tydzień');
define('TEXT_BLOCK_ORDERS_MONTH_COUNTERS', 'Miesiąc');
define('TEXT_BLOCK_ORDERS_QUARTER_COUNTERS', 'Kwartał');
define('TEXT_BLOCK_ORDERS_ALL_TIME_COUNTERS', 'Za cały czas');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_CURRENCY', 'pln.');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_PREFIX', 'na');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_NOUN', 'zamówień');

define('TEXT_BLOCK_COUNTERS_PRODUCTS', 'Towarów');
define('TEXT_BLOCK_COUNTERS_ORDERS', 'Zamówień');
define('TEXT_BLOCK_COUNTERS_COMMENTS', 'Komentarze');
define('TEXT_BLOCK_COUNTERS_TOTAL_INCOME', 'Kwota sprzedaży');

define('TEXT_BLOCK_SETTINGS_TITLE', 'Ustawienia');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_HEADER', 'Zablokowana czapka');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_ASIDE', 'Zablokowane menu boczne');
define('TEXT_BLOCK_SETTINGS_TITLE_FOLDED_ASIDE', 'Zwinięte boczne menu');
define('TEXT_BLOCK_SETTINGS_TITLE_DOCK_ASIDE', 'Boczne menu od góry');

define('TEXT_BLOCK_MODULES_STATS_USING', 'Używano');
define('TEXT_BLOCK_MODULES_STATS_AMOUNT', 'szt.');
define('TEXT_BLOCK_MODULES_STATS_MODULES', 'modułów');
define('TEXT_BLOCK_MODULES_USED', 'Używano modułów');
define('TEXT_BLOCK_MODULES_SEE_ALL', 'Zobaczyć wszystkie moduły');

define('TEXT_BLOCK_OVERVIEW_TITLE', 'Przegląd');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS', 'Zamówienia');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED', 'TOP wyświetleń');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD', 'TOP sprzedaży');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES', 'TOP kategorii');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS', 'Wejścia');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED', 'Wyszukiwania');

define('TEXT_BLOCK_OVERVIEW_ACTION_EDIT', 'Edytuj');
define('TEXT_BLOCK_OVERVIEW_ACTION_VIEW', 'Wyświetl');

define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_CUSTOMER_NAME', 'Kupujący');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_DATE', 'Data');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_AMOUNT', 'Suma');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_STATUS', 'Status');

define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODUCT_IMAGE', 'Obraz');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODCUT_NAME', 'Nazwa');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_VIEWS', 'Wyświetleń');

define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODUCT_IMAGE', 'Obraz');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODCUT_NAME', 'Nazwa');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_ORDERS', 'Zamówień');

define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_CATEGORY_NAME', 'Nazwa');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_ORDERS', 'Zamówień');

define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_ADMIN_NAME', 'Imię');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_DATE', 'Data ostatniego logowania');

define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_QUERY', 'Zapytanie');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_COUNT', 'Ilość');

define('TEXT_BLOCK_NEWS_TITLE', 'Aktualności SoloMono');

define('TEXT_BLOCK_PLOT_TITLE', 'Wykres dochodów');
define('TEXT_BLOCK_PLOT_TAB_BY_DAYS', 'Codziennie');
define('TEXT_BLOCK_PLOT_TAB_BY_WEEKS', 'Co tydzień');
define('TEXT_BLOCK_PLOT_TAB_BY_MONTHES', 'Co miesiąc');

define('TEXT_BLOCK_PLOT_XAXIS_LABEL', 'Łączna wartość zamówień');
define('TEXT_BLOCK_PLOT_YAXIS_LABEL', 'Liczba zamówień');

define('TEXT_BLOCK_COMMENTS_TITLE', 'Opinie');

define('TEXT_BLOCK_EVENTS_TITLE', 'Wydarzenia');

define('TEXT_BLOCK_EVENTS_TOOLTIP_ALL_EVENTS', 'Wszystkie wydarzenia ');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ADMINS', 'Administratorzy');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ORDERS', 'Zamówienia');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CUSTOMERS', 'Kupujący');
define('TEXT_BLOCK_EVENTS_TOOLTIP_NEW_PRODUCTS', 'Nowe produkty');
define('TEXT_BLOCK_EVENTS_TOOLTIP_COMMENTS', 'Komentarze');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CALL_ME_BACK', 'Zostaw numer, zadzwonimy do ciebie');
define('TOOLTIP_STOCK_REORDER_LEVEL', 'Określ ilość towaru na magazynie');






define('TEXT_BLOCK_EVENTS_MESSAGE_ADMINS', '%s zalogowany');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS', 'Złożone %s');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS_2', 'zamówienie #%d');
define('TEXT_BLOCK_EVENTS_MESSAGE_CUSTOMERS', '%s zarejestrowany na stronie');
define('TEXT_BLOCK_EVENTS_MESSAGE_NEW_PRODUCTS', 'Dodano nowy produkt: "%s"');
define('TEXT_BLOCK_EVENTS_MESSAGE_COMMENTS', 'Użytkownik %s skomentował');
define('TEXT_BLOCK_EVENTS_MESSAGE_CALL_ME_BACK', 'poprosił o połączenie');

define('TEXT_BLOCK_GA_TITLE', 'Google Analitycs');

define('TEXT_SETTINGS_EDIT_FORM_SAVE', 'OK');
define('TEXT_SETTINGS_EDIT_FORM_CANCEL', 'Anulowanie');
define('TEXT_SETTINGS_EDIT_FORM_TOOLTIP', 'zmienić');

define('TEXT_MODAL_ADD_ACTION', 'Dodaj');
define('TEXT_MODAL_UPDATE_ACTION', 'Aktualizuj');
define('TEXT_MODAL_DELETE_ACTION', 'Usuń');
define('TEXT_MODAL_CHANGE_STATUS', 'Zmień status');
define('TEXT_MODAL_DETAILED', 'Więcej');
define('TEXT_MODAL_ACTION', 'Działanie');
define('TEXT_MODAL_INSTALL_ACTION', 'Zainstaluj');
define('TEXT_MODAL_CONTINUE_ACTION', 'Kontynuuj');
define('TEXT_MODAL_CANCEL_ACTION', 'Cofnij');
define('TEXT_MODAL_CONFIRM_ACTION', 'Potwierdzenie');
define('TEXT_MODAL_CONFIRMATION_ACTION', 'Jesteś pewien?');
define('TEXT_WAIT', 'Proszę czekać ...');
define('TEXT_SHOW', 'Do strony:');
define('TEXT_RECORDS', 'Całkowity:');
define('TEXT_SAVE_DATA_OK', 'Dane zostały zmienione');
define('TEXT_DEL_OK', 'Wpis został usunięty');
define('TEXT_ERROR', 'Wystąpił błąd');
define('TEXT_GENERAL_SETTING', 'Informacje ogólne');

//featured
define('TEXT_FEATURED_ADDED', 'Dodano');
define('TEXT_FEATURED_CHANGE', 'Zmodyfikowano');
define('TEXT_FEATURED_EXPIRE_DATE', 'Data wygaśnięcia');
define('TEXT_ENTER_PRODUCT', 'Wpisz nazwę');
define('TEXT_FEATURED_MODEL', 'Model');
define('TEXT_PRODUCTS_ON_ATTRIBUTES_VAL', 'Lista produktów według wartości atrybutów');

define('ADMIN_BTN_BUY_MODULE', 'Kup ten moduł!');
define('FOOTER_INSTRUCTION', 'Jak korzystać z panelu administracyjnego?');
define('FOOTER_NEWS', 'Aktualności Solomono');
define('FOOTER_SUPPORT_SOLOMONO', 'Tech. wsparcie');
define('FOOTER_SUPPORT_CONSULTANT', 'Konsultant online');
define('FOOTER_SUPPORT_TECHNICAL', 'Tech. wsparcie');

//languages_translater
define('TEXT_TRANSLATER_TITLE', 'Edytor języków');

define('TEXT_PRODUCT_FREE_SHIPPING', 'Darmowa dostawa:');

define('TEXT_MOBILE_OPEN_COLLAPSE', 'Pokaż');
define('TEXT_MOBILE_CLOSE_COLLAPSE', 'Ukryj');
define('TEXT_ORDER_STATISTICS', 'Zamów statystyki');
define('TEXT_WHO_ONLINE', 'Kto jest online');
define('TEXT_VIEW_LIST', 'Zobacz listę');
define('TEXT_ACTION_OVERVIEW', 'Przegląd akcji');
define('TEXT_SEE_ALL', 'Zobacz wszystko');

define('TEXT_MOBILE_SHOW_MORE', 'Pokaż więcej');
define('TEXT_MOBILE_INCOME', 'Przychody:');
define('TEXT_SHOW_ALL', 'Pokaż wszystko');
define('TEXT_REPLY_COMMENT', 'Odpowiedz na komentarz - ');
define('TEXT_BTN_REPLY', 'Odpowiedz');
define('TEXT_BTN_ANSWERED', 'Odpowiedział');
define('TEXT_MODAL_APPLY_ACTION', 'Aby złożyć wniosek');

define('RECOVER_CART_SALES', 'Odzyskaj sprzedaż koszyka');


define('TEXT_REDIRECTS_TITLE', 'Przekierowania');



define('RCS_CONF_TITLE', 'Niekompletne zamówienia');

define ('INSTAGRAM_PRODUCTS_TITLE', 'Importuj z Instagrama');
define ('INSTAGRAM_PRODUCTS_RESULT', 'Produkty przesłane do bazy danych');
define ('INSTAGRAM_SUCCESS', 'Do naszej witryny dodano posty na Instagramie!');
define ('INSTAGRAM_LINK', 'Instagram Link');
define ('INSTAGRAM_COUNT', 'Liczba postów');

define('INSTAGRAM_MODULE_ENABLE_TITLE', 'Slajdy na Instagramie');

define('BOX_PRODUCTS_STATS_MENU_ITEM', 'Produktu');


define('BOX_CLIENTS_STATS_TOP_CLIENTS', 'Najlepsi klienci');
define('BOX_CLIENTS_STATS_NEW_CLIENTS', 'Nowi Klienci');


define('BOX_MENU_TOOLS_EMAILS', 'Biuletyn e-mailowy');
define('BOX_MENU_TOOLS_MASS_EMAILS', 'Przesyłki masowe');


define('BOX_EXEL_IMPORT_EXPORT', 'Import / eksport do programu Excel');
define('BOX_PROM_IMPORT_EXPORT', 'Prom.ua Import do Excela');
define('IMPORT_EXPORT_MENU_BOX', 'Import Eksport');

define('TEXT_ENABLE_MULTILANGUAGE_MODULE', 'Włącz moduł wielojęzyczny');
define('TEXT_BUY_MULTILANGUAGE_MODULE', 'Proszę kupić wielojęzyczny moduł');

define('BOX_MENU_TAXES', 'Podatek');


define('INTEGRATION_CONF_TITLE', 'Inne integracje');

define('BOX_HEADING_INSTRUCTION', 'Instrukcje');

define('BOX_CATALOG_YML', 'Import YML');
define('TOOLTIP_CATEGORY_STATUS', 'Po aktywacji kategoria / podkategoria / produkt jest wyświetlana na stronie serwisu');
define('TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS', 'Aby dodać kategorię / podkategorię / produkt do Google Feed. Aby uwzględnić tylko jeden produkt - należy podać kategorię i podkategorię, w której produkt się znajduje.');
define('TOOLTIP_PRODUCTS_FEATURED', 'Wyświetlane na stronie głównej.');
define('TOOLTIP_PRODUCTS_RELATED', 'Wyświetlane na stronie produktu, w artykułach.');
define('TOOLTIP_PRODUCTS_ATTRIBUTES', 'Atrybuty (filtry) pozwalają zdefiniować dodatkowe cechy produktu, takie jak rozmiar czy kolor. Przeczytaj więcej w instrukcji: LINK');
define('TOOLTIP_ATTRIBUTES_VALUES', 'Po utworzeniu atrybutu podaj wymagane wartości.');
define('TOOLTIP_ATTRIBUTES_GROUPS', 'Aby połączyć wiele atrybutów w jedną grupę.');
define('TOOLTIP_ATTRIBUTES_TYPES', 'Tekst - tekstowy opis cech; Dropdown - wybór z rozwijanej listy; Radio - do wyboru spośród podanych opcji; Obraz - karta zmienia się po wybraniu wartości przedmiotu; Wyświetlane na stronie produktu.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_FILTER', 'Aby wyświetlić atrybuty produktu w panelu filtru, przesuń suwak, aby był aktywny.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_LISTING', 'Najechanie kursorem na produkt powoduje wyświetlenie atrybutów na liście produktów.');
define('TOOLTIP_SPECIALS', 'Aby ustawić specjalną cenę na jeden produkt.');
define('TOOLTIP_SALES_MAKERS', 'Aby ustawić rabaty dla kilku lub wszystkich kategorii towarów i / lub producentów.');
define('TOOLTIP_EXPORT_IMPORT_CSV', 'Aby załadować / usunąć bazę danych z pliku z rozszerzeniem .csv.');
define('TOOLTIP_EXPORT_IMPORT_PROM', 'Aby wyeksportować bazę danych z pliku zaimportowanego z Prom.');
define('TOOLTIP_ORDER_DATE', 'Wyświetl zamówienia dla wybranego przedziału czasu.');
define('TOOLTIP_ORDER_DETAILS', 'Szczegóły zamówienia');
define('TOOLTIP_ORDER_EDIT', 'edytować zamówienie');
define('TOOLTIP_ORDER_STATUS', 'Aby dodać nowy stan zamówienia, kliknij „+”');
define('TOOLTIP_CLIENT_EDIT', 'edytować');
define('TOOLTIP_CLIENT_GROUP_PRICE', 'Cena, która będzie wyświetlana w serwisie dla klientów z określonej grupy po autoryzacji. Ilość cen ustalana jest w sekcji „Mój Sklep”');
define('TOOLTIP_CLIENT_PRICE_GROUP_LIMIT', 'Gdy kwota osiągnie limit, możesz przenieść klienta do innej grupy.');
define('TOOLTIP_CLIENT_GROUP_EDIT', 'edytować');
define('TOOLTIP_EMAIL_TEMPLATE', 'Gotowe szablony listów do wysłania do klientów.');
define('TOOLTIP_EMAIL_TEMPLATE_EDIT', 'edytować');
define('TOOLTIP_FILE_MANAGER', 'Aby przesyłać i edytować pliki w serwisie.');
define('TOOLTIP_REDIRECTS', 'Na przykład musisz przekierować z https://demo.solomono.net/kontakty do https://demo.solomono.net/contact_us.php. W linii należy podać przekierowanie „przekierowanie z kontaktów” na adres „contact_us.php');
define('TOOLTIP_MODULES_PAYMENT', 'Dodaj dostępne metody płatności.');
define('TOOLTIP_MODULES_SHIPPING', 'Dodaj dostępne metody wysyłki.');
define('TOOLTIP_MODULES_TOTALS', 'Całkowity koszt zamówienia jest wyświetlany na stronie kasy.');
define('TOOLTIP_MODULES_ZONE', 'Określ możliwe metody dostawy dla niektórych stref, a także dozwolone metody płatności dla tych stref. Możesz utworzyć nową strefę w Ustawienia-&gt; Podatki-&gt; Strefy podatkowe');
define('TOOLTIP_MODULES_LANGUAGES', 'Wybór języków serwisu, ustawienie języka domyślnego.');
define('TOOLTIP_MODULES_CURRENCY', 'Ustaw domyślną walutę i ustaw wartość zgodnie z kursem.');
define('TOOLTIP_MODULES_COUPONS', 'Utwórz kupon, aby klient mógł złożyć wniosek w koszyku i otrzymać rabat.');
define('TOOLTIP_MODULES_POOLS', 'Utwórz ankietę, aby uzyskać potrzebne statystyki.');
define('TOOLTIP_MODULES_SOLOMONO', 'Lista zakupionych modułów + lista dostępnych do zakupu.');
define('TOOLTIP_CONFIGURATION_MAIN_EMAIL', 'Główny adres, na który przychodzą wszystkie powiadomienia.');
define('TOOLTIP_CONFIGURATION_FROM_EMAIL', 'Podaj adres, z którego mają być wysyłane wszystkie listy w przesyłkach zbiorczych.');
define('TOOLTIP_CONFIGURATION_ORDER_COPY_EMAIL', 'Podaj wszystkie adresy, na które będą wysyłane kopie listów z zamówieniami. Możesz określić wiele wiadomości e-mail, oddzielając je przecinkami ze spacjami.');
define('TOOLTIP_CONTACT_US_EMAIL', 'Podaj adres, na który będą wysyłane zapytania ze strony „Skontaktuj się z nami”');
define('TOOLTIP_STORE_COUNTRY', 'Podaj kraj sklepu, zostanie on wybrany domyślnie podczas składania zamówienia.');
define('TOOLTIP_STORE_REGION', 'Podaj region sklepu, zostanie on domyślnie wybrany podczas składania zamówienia.');
define('TOOLTIP_CONTACT_ADDRESS', 'Wpisz adres sklepu, zostanie on wyświetlony na stronie „Kontakty”.');
define('TOOLTIP_MINIMUM_ORDER', 'Opcjonalnie możesz określić minimalną kwotę za pomyślne zamówienie.');
define('TOOLTIP_MASTER_PASSWORD', 'Hasło, które jest odpowiednie do wejścia na konto dowolnego klienta zarejestrowanego w serwisie.');
define('TOOLTIP_SHOW_PRICE_WITH_TAX', 'Przesuń suwak, aby wyświetlić ceny na wszystkich stronach witryny, w tym podatek.');
define('TOOLTIP_CALCULATE_TAX', 'Jeśli zostanie uwzględniony, ustalony podatek od produktu zostanie uwzględniony przy kasie.');
define('TOOLTIP_EXTRA_PRICE', 'Opcjonalnie możesz ustawić znacznik, który będzie wyświetlany niezarejestrowanym użytkownikom witryny.');
define('TOOLTIP_PRICES_COUNT', 'Wskaż możliwą liczbę cen, które zostaną ustalone dla towarów (na przykład kilka cen dla różnych grup klientów)');
define('TOOLTIP_SHOW_PRICE_TO_NOT_AUTHORIZED_CUSTOMER', 'Wyświetlanie cen produktów dla niezarejestrowanych użytkowników');
define('TOOLTIP_LOGO', 'Wybierz logo (obraz), które ma być wyświetlane na stronie głównej');
define('TOOLTIP_WATERMARK', 'Wybierz zdjęcie do nałożenia na zdjęcie produktu, zabezpieczenie przed kopiowaniem.');
define('TOOLTIP_FAVICON', 'Wybierz obraz, który ma być wyświetlany przy ikonie witryny');
define('TOOLTIP_AUTO_STOCK', 'Podczas składania zamówienia automatycznie sprawdzana jest ilość towaru w magazynie oraz jego dostępność do zamówienia.');
define('TOOLTIP_DISABLED_BUY_BUTTON_FOR_ZERO_STOCK', 'Na stronie produktu, którego nie ma w magazynie, zostanie wyświetlony przycisk „kup”.');
define('TOOLTIP_STOCK_AUTO_INCREMENT', 'Przy składaniu zamówienia ilość zakupionego towaru jest automatycznie odejmowana od salda w magazynie.');
define('TOOLTIP_ALLOW_ZERO_STOCK_ORDER', 'Zezwalaj na złożenie zamówienia na produkt, którego nie ma w magazynie.');
define('TOOLTIP_MARK_ZERO_STOCK_PRODUCT', 'Jeśli pozycja dodana do koszyka nie znajduje się w wymaganej ilości w magazynie, zostanie oznaczona określoną wartością.');
define('TOOLTIP_ZERO_STOCK_NOTIFICATION', 'Po osiągnięciu tej ilości na pocztę wysyłane jest powiadomienie o wyczerpaniu się towarów.');
define('TOOLTIP_SMS_TEXT', 'Określ tekst, który zostanie wysłany do klienta.');
define('TOOLTIP_SMS_LOGIN', 'Dostarczone przez dostawcę sms.');
define('TOOLTIP_SMS_PASSWORD', 'Dostarczone przez dostawcę sms.');
define('TOOLTIP_SMS_CODE_1', 'Numer telefonu lub nadawca alfanumeryczny.');
define('TOOLTIP_SMS_CODE_2', 'Dostarczone przez dostawcę sms.');
define('TOOLTIP_TAX_ADD', 'Aby dodać nowy rodzaj podatku, kliknij „+” i wypełnij wymagane pola.');
define('TOOLTIP_TAX_RATE_ADD', 'Aby dodać stawkę%, która zostanie doliczona do ceny towaru, kliknij „+” i wypełnij wymagane pola.');
define('TOOLTIP_TAX_ZONE_ADD', 'Aby dodać strefę (kraj), do której będzie obowiązywał podatek, kliknij „+” i wypełnij wymagane pola.');
define('TOOLTIP_BACKUP_CREATE', 'Utwórz kopię zapasową bieżącej wersji bazy danych lokacji.');
define('TOOLTIP_BACKUP_LOAD', 'Przywracanie bazy danych z wybranego pliku.');
define('TOOLTIP_EMAILING', 'Wysyłanie wiadomości e-mail do jednego klienta, wszystkich klientów lub wszystkich subskrybentów wiadomości.');
define('TOOLTIP_MASS_EMAILING', 'Wysyłanie e-maili do klienta indywidualnego lub do wybranej grupy klientów.');
define('TOOLTIP_CLEAR_CACHE', 'Czyszczenie przesłanych obrazów z pamięci podręcznej.');
define('TOOLTIP_STATS_SALES', 'Wyświetlanie statystyk sprzedaży.');
define('TOOLTIP_STATS_SALES_PRODUCTS_BY_TIME_PERIOD', 'Raport sprzedaży dla zamówionych towarów za wybrany okres.');
define('TOOLTIP_STATS_SALES_CATEGORIES_BY_TIME_PERIOD', 'Raport sprzedaży według kategorii produktów w wybranym okresie.');
define('TOOLTIP_STATS_VIEWED_PRODUCTS', 'Statystyki oglądanych produktów.');
define('TOOLTIP_STATS_ZERO_QUANTITY_PRODUCTS', 'Produkt jest niedostępny.');
define('TOOLTIP_STATS_CLIENTS_ORDERS', 'Raport o zakupach klientów za wybrany okres.');
define('TOOLTIP_ADMINISTRATORS', 'Lista administratorów serwisu.');
define('TOOLTIP_ADMINISTRATORS_GROUPS', 'Rozdzielenie administratorów na grupy.');
define('TOOLTIP_ADMINISTRATORS_ACCESS_RIGHTS', 'Prawa dostępu do informacji w serwisie w zależności od grupy administratorów.');
define('TOOLTIP_TEXT_COPIED', 'Tekst skopiowany');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY', 'Kup');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON', 'włączyć');
define('TOOLTIP_TEXT_TAB_LANGUAGES', 'Funkcjonalność językowa');
define('TOOLTIP_TEXT_TAB_AUTO_TRANSLATE', 'Automatyczne tłumaczenie zbiorcze treści');
define('TOOLTIP_TEXT_TAB_EDIT_TRANSLATE', 'Edytuj tłumaczenia');

define('TOOLTIP_TELEGRAM_NOTIFICATIONS_ENABLED', 'Możesz włączyć/wyłączyć powiadomienia Telegram');
define('TOOLTIP_TELEGRAM_TOKEN', 'Specjalne konta Telegram stworzone do automatycznego przetwarzania i wysyłania wiadomości');
define('TOOLTIP_SMS_ENABLE', 'Może włączyć/wyłączyć usługę SMS');
define('TOOLTIP_SMS_CUSTOMER_ENABLE', 'Możesz włączyć / wyłączyć możliwość wysyłania sms do klienta przy zakupie');
define('TOOLTIP_SMS_CHANGE_STATUS', 'Możesz włączyć / wyłączyć możliwość wysyłania sms do klienta podczas zmiany statusu');
define('TOOLTIP_SMS_OWNER_ENABLE', 'Możesz włączyć / wyłączyć możliwość wysyłania sms do administratora przy zakupie');
define('TOOLTIP_SMS_OWNER_TEL', 'Wprowadź/zmień numer telefonu administratora');








define('TOOLTIP_ENTRY_FIRST_NAME_MIN_LENGTH', "Określ minimalną liczbę znaków w kolumnie 'Wartość' dla każdego parametru");
define('TOOLTIP_ENTRY_LAST_NAME_MIN_LENGTH', "Określ minimalną liczbę znaków w kolumnie 'Wartość' dla każdego parametru");
define('TOOLTIP_ENTRY_EMAIL_ADDRESS_MIN_LENGTH', "Określ minimalną liczbę znaków w kolumnie 'Wartość' dla każdego parametru");
define('TOOLTIP_MIN_DISPLAY_XSELL', "Określ minimalną liczbę znaków w kolumnie 'Wartość' dla każdego parametru");

define('HIGHSLIDE_CLOSE', 'Blisko');
define('COMMENT_BY_ADMIN', 'Komentarz administratora');
define('TEXT_MENU_WHO_IS_ONLINE', 'Kto jest online');
define('INFO_ICON_NEED_MINIFY', 'Wszelkie zmiany w tym module spowodują zmianę statusu stylów na Minify Now');
define('INFO_ICON_ENABLE_SMTP', 'Podczas włączania sprawdź ustawienia SMTP');
define('SMTP_CONF_TITLE', 'Ustawienia SMTP');
define('INFO_ICON_NEED_GENERATE_CRITICAL', 'Zmiany tego parametru wymagają krytycznej regeneracji CSS');
define('YANDEX_MARKET_MODULE_ENABLED_TITLE', 'XML (YML) products export "Yandex Market"');
define('AUTO_TRANSLATE_MODULE_ENABLED_TITLE', 'Automatyczne tłumaczenie');
define('TEXT_INFO_BUY_MODULE', 'Moduł «%s» jest wyłączony, aby go włączyć, użyj strony <a href="%s"><span style="color:blue;" >Moduły</span></a>');
define('TEXT_INFO_DISABLE_MODULE', 'Nie ma modułu «%s», aby go dodać, użyj <a href="%s"><span style="color:blue;" >Sklep z modułami SoloMono</span></a>');
define("TEXT_POPULAR_SEARCH_QUERIES", "Ricerche popolari");
define('STATS_KEYWORDS_POPULAR_ENABLED_TITLE',"Szukaj na stronach");
define("LIST_MODAL_ON","Okno modalne produktu");
define("SHOW_BASKET_ON_ADD_TO_CART_TITLE","Pokaż koszyk podczas dodawania przedmiotu");
define("TEXT_QUICK_ORDER", "Ordine veloce");
define("TEXT_VIEWED","Oglądane");
define('API_ENABLED_TITLE', 'Solomono API');
define('TEXT_MENU_API', 'API');
define('EMAIL_CONTENT_MODULE_ENABLED_TITLE', 'Szablony wiadomości');
define('ENTRY_CREDIT_CARD_CC_TYPE', 'Card Type');
define('ENTRY_CREDIT_CARD_CC_OWNER', 'Właściciel karty');
define('ENTRY_CREDIT_CARD_CC_NUMBER', 'Numer karty');
define('ENTRY_CREDIT_CARD_CC_EXPIRES', 'Karta wygaśnie');
define('TEXT_SEARCH_PAGES','Szukaj na stronach');
define('SMTP_MODULE_ENABLED_TITLE','SMTP');

define('LEFT_MENU_SECTION_TITLE_SHOP','Sklep');
define('LEFT_MENU_SECTION_TITLE_INFO','Informacje');
define('LEFT_MENU_SECTION_TITLE_CONTROL','Kontrola');
define('INTEGRATION_FACEBOOK_CONF_TITLE','Integracja Facebook');
define('INTEGRATION_GOOGLE_CONF_TITLE','Integracja GOOGLE');
define('SEO_SETTINGS_CONF_TITLE','Ustawienia SEO');
define('TEXT_CLOSE_BUTTON', 'Zamknij');
define('FACEBOOK_GOALS_ADD_PAYMENT_INFO_TITLE','Cel \'AddPaymentInfo\' - wypełnianie informacji o płatności');
define('FACEBOOK_GOALS_ADD_TO_WISHLIST_TITLE','Cel \'AddToWishlist\' - Dodaj do listy życzeń');
define('FACEBOOK_GOALS_CONTACT_US_REQUEST_TITLE','Cel \'Lead\' - zapytanie na stronie kontaktowej');
define('FACEBOOK_GOALS_VIEW_CONTENT_TITLE','Cel \'ViewContent\' - zobacz stronę produktu');
define('FACEBOOK_GOALS_SUCCESS_PAGE_TITLE','Cel \'Purchase\' - strona po potwierdzeniu zamówienia');
define('FACEBOOK_GOALS_CHECKOUT_PROCESS_TITLE','Cel \'InitiateCheckout\' - strona kasy');
define('FACEBOOK_GOALS_SEARCH_RESULTS_TITLE','Cel \'Search\' - strona wyników wyszukiwania');
define('FACEBOOK_GOALS_COMPLETE_REGISTRATION_TITLE','Cel \'CompleteRegistration\' - kiedy klient się zarejestrował');
define('FACEBOOK_GOALS_ADD_TO_CART_TITLE','Cel \'AddToCart\' - Dodaj do koszyka');
define('FACEBOOK_GOALS_PAGE_VIEW_TITLE','Cel \'PageView\' - na każdej stronie');
define('FACEBOOK_GOALS_CLICK_FAST_BUY_TITLE','Cel \'FastBuy\' - gdy klient kliknie przycisk \'Szybkie zamówienie\' na stronie produktu');
define('FACEBOOK_GOALS_CLICK_ON_CHAT_TITLE','Cel \'ClickChat\' - gdy klient kliknie przycisk Czat');
define('FACEBOOK_GOALS_CALLBACK_TITLE','Cel \'Callback\' - gdy klient kliknie przycisk \'Callback\' w nagłówku witryny');
define('FACEBOOK_GOALS_FILTER_TITLE','Cel \'filter\' - gdy klient używa filtra do wyszukiwania produktów');
define('FACEBOOK_GOALS_SUBSCRIBE_TITLE','Cel \'Subscribe\' - gdy klient dokonał subskrypcji');
define('FACEBOOK_GOALS_LOGIN_TITLE','Cel \'login\' - kiedy klient się zalogował');
define('FACEBOOK_GOALS_ADD_REVIEW_TITLE','Cel \'add_review\' - gdy klient dodał recenzję');
define('FACEBOOK_GOALS_PHONE_CALL_TITLE','Cel \'PhoneCall\' - gdy klient kliknie numer telefonu w nagłówku witryny');
define('FACEBOOK_GOALS_CLICK_ON_BUG_REPORT_TITLE','Cel \'BugReport\' - gdy klient kliknie \'Wyślij wiadomość o błędzie\' w stopce witryny');

define('HEADER_BUY_TEMPLATE_LINK','Przełącz na płatny pakiet');

define('NWPOSHTA_DELIVERY_TITLE', 'Nowy adres dostawy poczty');
define('TEXT_CATEGORIES', 'Kategorie');
define('HEADING_TITLE_GOTO', 'Przejdź do:');
define('ERROR_DOMAIN_IN_USE','Błąd! Ta domena jest już używana');
define('ERROR_ANAME_MISMATCH', 'Błąd! Nazwa A nie pasuje do 167.172.41.152. Spróbuj później');
define('SUCCESS_DOMAIN_CHANGE', 'Sukces! Domena zmieniona');
define('ERROR_ADD_DOMAIN_FIRST','Najpierw podłącz swoją domenę niestandardową!');
define('ERROR_BASH_EXECUTION','Błąd podczas wykonywania skryptu, menedżer kontaktu');
define('ERROR_SIMLINK_CREATE', 'Symlink nie został utworzony');
define('ERROR_FOLDER_RENAME', 'Folder nie skopiowany');

define('PRODUCTS_LIMIT_REACHED_FREE', 'Przekroczono limit produktów! Twoja witryna zostanie automatycznie wyłączona za %s dni. <a href="%s">Wypożycz opłatę</a> lub usuń niechciane produkty');
define('PRODUCTS_LIMIT_REACHED_JUNIOR', 'Przekroczono limit produktów! Za %s dni Twoja witryna zostanie automatycznie zaktualizowana do pakietu SEO.');
define('PRODUCTS_LIMIT_REACHED_SEO', 'Przekroczono limit produktów! Za %s dni Twoja witryna zostanie automatycznie zaktualizowana do pakietu pro');
define('PRODUCTS_LIMIT_REACHED_HEADING', 'Przekroczono limit produktów!');