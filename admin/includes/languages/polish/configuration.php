<?php
/*
  $Id: configuration.php,v 1.2 2003/09/24 13:57:08 wilt Exp $
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2002 osCommerce
  Released under the GNU General Public License
*/

// ultimate seo url (added by raid)

define('SEO_ENABLED_TITLE', 'Enable SEO URLs?');
define('SEO_ADD_CPATH_TO_PRODUCT_URLS_TITLE', 'Add cPath to product URLs?');
define('SEO_ADD_SLASH_BEFORE_PRODUCT_ID_TITLE', 'Add slash before product ID in URLs?');
define('SEO_ADD_SLASH_BEFORE_CATEGORY_ID_TITLE', 'Add slash before category ID in URLs?');
define('SEO_ADD_PARENT_CATEGORIES_TO_URL_TITLE', 'Dodać identyfikatory kategorii nadrzędnych do adresu URL?');
define('SEO_ADD_CAT_PARENT_TITLE', 'Add category parent to begining of URLs?');
define('SEO_URLS_USE_W3C_VALID_TITLE', 'Output W3C valid URLs (parameter string)?');
define('USE_SEO_CACHE_GLOBAL_TITLE', 'Enable SEO cache to save queries?');
define('USE_SEO_CACHE_PRODUCTS_TITLE', 'Enable product cache?');
define('USE_SEO_CACHE_CATEGORIES_TITLE', 'Enable categories cache?');
define('GOOGLE_SITE_VERIFICATION_KEY_TITLE', 'Google site verification key');
define('USE_SEO_CACHE_MANUFACTURERS_TITLE', 'Enable manufacturers cache?');
define('USE_SEO_CACHE_ARTICLES_TITLE', 'Enable articles cache?');
define('USE_SEO_CACHE_TOPICS_TITLE', 'Enable topics cache?');
define('USE_SEO_CACHE_INFO_PAGES_TITLE', 'Enable information cache?');
define('REVIEWS_WRITE_ACCESS_TITLE', 'Zezwalaj tylko zarejestrowanym użytkownikom na pisanie recenzji');
define('USE_SEO_CACHE_LINKS_TITLE', 'Enable link directory cache?');
define('USE_SEO_REDIRECT_TITLE', 'Enable automatic redirects?');
define('ONEPAGE_ADDRESS_TYPE_POSITION_TITLE', 'Zamówienie adresu');
define('SEO_REWRITE_TYPE_TITLE', 'Choose URL Rewrite Type');
define('SEO_URLS_FILTER_SHORT_WORDS_TITLE', 'Filter Short Words');
define('SEO_CHAR_CONVERT_SET_TITLE', 'Enter special character conversions');
define('SEO_REMOVE_ALL_SPEC_CHARS_TITLE', 'Remove all non-alphanumeric characters?');
define('SEO_URLS_CACHE_RESET_TITLE', 'Zresetować cache dla SEO URLs');
define('SEO_FILTER_TITLE', 'Włącz filtry SEO');
define('USE_CRITICAL_CSS_TITLE', 'Użyć krytycznego CSS?');
define('WATER_MARK_TITLE', 'Znak wodny');
define('FAVICON_IMAGE_TITLE', 'Obraz ikony favicon');


define('TABLE_HEADING_CONFIGURATION_TITLE', 'Nagłówek');
define('TABLE_HEADING_CONFIGURATION_VALUE', 'Wartość');
define('TABLE_HEADING_CONFIGURATION_SHOW_FIELD', 'Pokaż pole');
define('TABLE_HEADING_CONFIGURATION_REQUIRED_VALUE', 'Obowiązkowy');
define('TABLE_HEADING_ACTION', 'Działanie');

define('TEXT_INFO_EDIT_INTRO', 'Proszę wprowadzić niezbędne zmiany');
define('TEXT_SAVE_BUTTON', 'Zapisz');
define('TEXT_CANCEL_BUTTON', 'Anuluj');
define('TEXT_CLOSE_BUTTON', 'Zamknij');
define('TEXT_INFO_DATE_ADDED', 'Data dodania:');
define('TEXT_INFO_LAST_MODIFIED', 'Ostatnia modyfikacja:');
define('ERROR_TEMPLATE_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Katalog jest chroniony przed zapisem, ustaw poprawne uprawnienia (na przykład chmod 777) dla katalogu ');
define('ERROR_TEMPLATE_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Katalog nie istnieje, utwórz katalog ');

// Mój sklep

define('MYSQL_PERFORMANCE_TRESHOLD_TITLE', 'MySQL Performance Log czas "od"');
define('MINIFY_CSSJS_TITLE', 'Minify CSS i JS?');
define('MENU_LOCATION_TITLE', 'Lokalizacja menu administratora: ');
define('MENU_TOP_LOCATION', 'z góry');
define('MENU_LEFT_LOCATION', 'po lewej stronie');
define('MENU_LEFT_MIN_LOCATION', 'lewy i złożony');
define('MINIFY_CSSJS_0_TITLE', 'Nie minify');
define('MINIFY_CSSJS_1_TITLE', 'Zmodyfikuj teraz');
define('MINIFY_CSSJS_2_TITLE', 'Użyj pliku minified');
define('IMAGE_CACHE_TITLE', 'Edytuj IMAGE_CACHE');
define('IMAGE_CACHE_0_TITLE', 'Wyłącz');
define('IMAGE_CACHE_1_TITLE', 'Włącz');

//define('ALLOW_AUTOLOGON_TITLE', 'Włącz Autologin');
define('DEFAULT_TEMPLATE_TITLE', 'Domyślny szablon');
define('LOGO_IMAGE_TITLE', 'Logo firmy');
define('STORE_NAME_TITLE', 'Nazwa sklepu');
define('STORE_OWNER_TITLE', 'Właściciel sklepu');
define('STORE_ADDRESS_TITLE', 'Adres sklepu');
define('STORE_LOGO_TITLE', 'Logo sklepu');
define('STORE_OWNER_EMAIL_ADDRESS_TITLE', 'Adres E-Mail');
define('STORE_OWNER_ICQ_NUMBER_TITLE', 'ICQ numer');
define('EMAIL_FROM_TITLE', 'E-Mail od');
define('STORE_COUNTRY_TITLE', 'Kraj');
define('STORE_ZONE_TITLE', 'Województwo');
define('EXPECTED_PRODUCTS_SORT_TITLE', 'Kolejność sortowania oczekiwanych towarów');
define('EXPECTED_PRODUCTS_FIELD_TITLE', 'Sortowanie oczekiwanych towarów');
define('USE_DEFAULT_LANGUAGE_CURRENCY_TITLE', 'Przełączanie na walutę bieżącego języka');
define('SEARCH_ENGINE_FRIENDLY_URLS_TITLE', 'Używaj krótkich adresów URL (w opracowaniu)');
define('DISPLAY_CART_TITLE', 'Przejdź do koszyka po dodaniu przedmiotu');
define('ALLOW_GUEST_TO_TELL_A_FRIEND_TITLE', 'Zezwalaj gościom na używanie funkcji: Powiedz przyjacielowi');
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_TITLE', 'Domyślny operator wyszukiwania');
define('STORE_NAME_ADDRESS_TITLE', 'Adres i numer telefonu sklepu');
define('ALLOW_CATEGORY_DESCRIPTIONS_TITLE', 'Zezwalaj na opisy kategorii');
define('TAX_DECIMAL_PLACES_TITLE', 'Liczba znaków po przecinku w podatku');
define('SHOW_MAIN_FEATURED_PRODUCTS_TITLE', 'Pokaż polecane produkty na stronie głównej');
define('DISPLAY_PRICE_WITH_TAX_TITLE', 'Pokaż ceny z podatkami');
define('XPRICES_NUM_TITLE', 'Liczba możliwych cen towarów');
//define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_TITLE' , 'Wartość nominalna karty podarunkowej, którą otrzyma odwiedzający');
define('ALLOW_GUEST_TO_SEE_PRICES_TITLE', 'Pokaż ceny dla odwiedzających');
//define('NEW_SIGNUP_DISCOUNT_COUPON_TITLE' , 'Kod kuponu, który ma otrzymać zarejestrowany użytkownik');
define('GUEST_DISCOUNT_TITLE', 'Marża dla odwiedzających');
define('CATEGORIES_SORT_ORDER_TITLE', 'Sortowanie towarów, kategorie');
define('QUICKSEARCH_IN_DESCRIPTION_TITLE', 'Wyszukaj w opisach produktów');
define('SET_HTTPS_TITLE', 'Turn on HTTPS?');
define('ENABLE_DEBUG_PAGE_SPEED_TITLE', 'Włącz debugowanie ładowania strony');
define('SET_WWW_TITLE', 'Przekieruj do www');
define('WWW_TOO_MANY_REDIRECTS', 'Za dużo przekierowań, bez zmian');
//define('ALLOW_GIFT_VOUCHERS_TITLE' , 'Zezwól na używanie kart podarunkowych i kuponów');
define('ALLOW_ATTRIBUTES_IN_PRODUCT_EDIT_PAGE_TITLE', 'Włącz zarządzanie atrybutami na stronie Dodaj produkt');
define('SHOW_SUBCATEGORIES_WHEN_CATEGORIES_HAS_PRODUCTS_TITLE', 'Wyświetl podkategorie, jeśli istnieje produkt w kategorii');
define('SHOW_PDF_DATASHEET_TITLE', 'Pokaż opis produktu w formacie PDF');
define('MAIN_COLOR_TITLE', 'Główny kolor strony');
define('SECOND_COLOR_TITLE', 'Drugi kolor strony');
define('BACKGROUND_COLOR_TITLE', 'Tło strony internetowej');

// Minimalne wartości

define('ENTRY_FIRST_NAME_MIN_LENGTH_TITLE', 'Imię');
define('ENTRY_LAST_NAME_MIN_LENGTH_TITLE', 'Nazwisko');
define('ENTRY_DOB_MIN_LENGTH_TITLE', 'Data urodzenia');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_TITLE', 'Adres E-Mail');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_TITLE', 'Adres');
define('ENTRY_COMPANY_MIN_LENGTH_TITLE', 'Firma');
define('ENTRY_POSTCODE_MIN_LENGTH_TITLE', 'Kod pocztowy');
define('ENTRY_CITY_MIN_LENGTH_TITLE', 'Miasto');
define('ENTRY_COUNTRY_MIN_LENGTH_TITLE', 'Kraj');
define('ENTRY_FAX_MIN_LENGTH_TITLE', 'Faks');
define('ENTRY_SUBURB_MIN_LENGTH_TITLE', 'Przedmieście');
define('ENTRY_STATE_MIN_LENGTH_TITLE', 'Województwo');
define('ENTRY_TELEPHONE_MIN_LENGTH_TITLE', 'Telefon');
define('ENTRY_PASSWORD_MIN_LENGTH_TITLE', 'Hasło');
define('CC_OWNER_MIN_LENGTH_TITLE', 'Właściciel karty kredytowej');
define('CC_NUMBER_MIN_LENGTH_TITLE', 'Numer karty kredytowej');
define('REVIEW_TEXT_MIN_LENGTH_TITLE', 'Tekst opinii');
define('MIN_DISPLAY_BESTSELLERS_TITLE', 'Najlepsi sprzedawcy');
define('MIN_DISPLAY_ALSO_PURCHASED_TITLE', 'Także zamówili');
define('MIN_DISPLAY_XSELL_TITLE', 'Powiązane produkty');
define('MIN_ORDER_TITLE', 'Minimalna kwota zamówienia');

// Maksymalne wartości

define('MAX_PROD_ADMIN_SIDE_TITLE', 'Towarów na jednej stronie w administracji');
define('MAX_ADDRESS_BOOK_ENTRIES_TITLE', 'Pozycji książki adresowej');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE', 'Towarów na jednej stronie w katalogu');
define('MAX_DISPLAY_PAGE_LINKS_TITLE', 'Linków na stronie');
define('MAX_DISPLAY_SPECIAL_PRODUCTS_TITLE', 'Specjalnych cen');
define('MAX_DISPLAY_NEW_PRODUCTS_TITLE', 'Nowych produktów');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_TITLE', 'Oczekiwanych produktów');
define('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST_TITLE', 'Lista producentów');
define('MAX_MANUFACTURERS_LIST_TITLE', 'Producenci w postaci rozszerzonego menu');
define('MAX_DISPLAY_MANUFACTURER_NAME_LEN_TITLE', 'Ograniczenie długości nazwy producenta');
define('MAX_RANDOM_SELECT_NEW_TITLE', 'Wybieranie losowego elementu w boxie Nowe produkty');
define('MAX_RANDOM_SELECT_SPECIALS_TITLE', 'Wybór losowego elementu w boxie Zniżki');
define('MAX_DISPLAY_CATEGORIES_PER_ROW_TITLE', 'Liczba kategorii w linii');
define('MAX_DISPLAY_PRODUCTS_NEW_TITLE', 'Liczba nowych produktów na stronie');
define('MAX_DISPLAY_BESTSELLERS_TITLE', 'Najlepsi sprzedawcy');
define('MAX_DISPLAY_ALSO_PURCHASED_TITLE', 'Także zamówili');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_TITLE', 'Box Historia zamówień');
define('MAX_DISPLAY_ORDER_HISTORY_TITLE', 'Historia zamówień');
define('MAX_DISPLAY_FEATURED_PRODUCTS_TITLE', 'Towarów w boxie Polecane produkty na stronie głównej');
define('MAX_DISPLAY_FEATURED_PRODUCTS_LISTING_TITLE', 'Towarów na jednej stronie Zalecanych Towarów');
define('SLIDER_HEIGHT_TITLE', 'wysokość suwaka');

// Obraz

define('SMALL_IMAGE_WIDTH_TITLE', 'Szerokość małego obrazu');
define('SMALL_IMAGE_HEIGHT_TITLE', 'Wysokość małego obrazu');
define('HEADING_IMAGE_WIDTH_TITLE', 'Szerokość kategorii obrazu');
define('HEADING_IMAGE_HEIGHT_TITLE', 'Wysokość obrazu kategorii');
define('SUBCATEGORY_IMAGE_WIDTH_TITLE', 'Szerokość obrazu podkategorii');
define('SUBCATEGORY_IMAGE_HEIGHT_TITLE', 'Wysokość obrazu podkategorii');
define('CONFIG_CALCULATE_IMAGE_SIZE_TITLE', 'Oblicz rozmiar obrazu');
define('IMAGE_REQUIRED_TITLE', 'Obraz obowiązkowy');
define('ULTIMATE_ADDITIONAL_IMAGES_TITLE', 'Zezwól na użycie modułu dodatkowych zdjęć?');
define('ULT_THUMB_IMAGE_WIDTH_TITLE', 'Szerokość dodatkowego obrazu');
define('ULT_THUMB_IMAGE_HEIGHT_TITLE', 'Wysokość dodatkowego obrazu');
define('MEDIUM_IMAGE_WIDTH_TITLE', 'Szerokość dużego obrazu');
define('MEDIUM_IMAGE_HEIGHT_TITLE', 'Wysokość dużego obrazu');
define('LARGE_IMAGE_WIDTH_TITLE', 'Szerokość obrazu dla pop-up okienka');
define('LARGE_IMAGE_HEIGHT_TITLE', 'Wysokość obrazu dla pop-up okienka');

// Dane kupującego

define('ACCOUNT_GENDER_TITLE', 'Płeć');
define('ACCOUNT_DOB_TITLE', 'Data urodzenia');
define('ACCOUNT_COMPANY_TITLE', 'Firma');
define('ACCOUNT_SUBURB_TITLE', 'Województwo');
define('ACCOUNT_STATE_TITLE', 'Gmina');
define('ACCOUNT_STREET_ADDRESS_TITLE', 'Adres');
define('ACCOUNT_CITY_TITLE', 'Miasto');
define('ACCOUNT_POSTCODE_TITLE', 'Kod pocztowy');
define('ACCOUNT_COUNTRY_TITLE', 'Kraj');
define('ACCOUNT_TELE_TITLE', 'Telefon');
define('ACCOUNT_FAX_TITLE', 'Fax');
define('ACCOUNT_NEWS_TITLE', 'Newsletter');
define('ACCOUNT_LAST_NAME_TITLE', 'Nazwisko');
define('ACCOUNT_FIRST_NAME_TITLE', 'Nazwać');

// Dostawa / pakowanie

define('SHIPPING_ORIGIN_COUNTRY_TITLE', 'Kraj sklepu');
define('SHIPPING_ORIGIN_ZIP_TITLE', 'Kod pocztowy sklepu');
define('SHIPPING_MAX_WEIGHT_TITLE', 'Maksymalna waga dostawy');
define('SHIPPING_BOX_WEIGHT_TITLE', 'Minimalna waga paczki');
define('SHIPPING_BOX_PADDING_TITLE', 'Waga opakowania w procentach');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_TITLE', 'Zezwól na bezpłatną wysyłkę');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_TITLE', 'Bezpłatna wysyłka przy zamówieniu powyżej');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_TITLE', 'Bezpłatna wysyłka dla zamówień złożonych z');
define('SHOW_SHIPPING_ESTIMATOR_TITLE', 'Pokaż metody i koszty wysyłki w koszyku');

// Wyświetlacz produkt

define('PRODUCT_LISTING_DISPLAY_STYLE_TITLE', 'Format wyświetlania produktu');
define('PRODUCT_LIST_IMAGE_TITLE', 'Wyświetl zdjęcie produktu');
define('PRODUCT_LIST_MANUFACTURER_TITLE', 'Pokaż producenta towarów');
define('PRODUCT_LIST_MODEL_TITLE', 'Pokaż kod produktu');
define('PRODUCT_LIST_NAME_TITLE', 'Pokaż nazwę produktu');
define('PRODUCT_LIST_PRICE_TITLE', 'Pokaż cenę produktu');
define('PRODUCT_LIST_QUANTITY_TITLE', 'Pokaż ilość towarów w dostępności');
define('PRODUCT_LIST_WEIGHT_TITLE', 'Wyświetl wagę produktu');
define('PRODUCT_LIST_BUY_NOW_TITLE', 'Pokaż przycisk Kup teraz!');
define('PRODUCT_LIST_FILTER_TITLE', 'Pokaż PDF-link');
define('PREV_NEXT_BAR_LOCATION_TITLE', 'Lokalizacja nawigacji Następna / Poprzednia strona');
define('PRODUCT_LIST_INFO_TITLE', 'Pokaż krótki opis');
define('PRODUCT_SORT_ORDER_TITLE', 'Pokaż porządek sortowania');

// Magazyn

define('STOCK_CHECK_TITLE', 'Sprawdź dostępność towarów');
define('STOCK_SHOW_BUY_BUTTON_TITLE', 'Pokaż przycisk Kup, jeśli brakuje elementu');
define('STOCK_LIMITED_TITLE', 'Odejmij produkt z magazynu');
define('STOCK_ALLOW_CHECKOUT_TITLE', 'Pozwól na przetwarzanie zamówień');
define('STOCK_DISABLE_NON_EXISTENT_PRODUCT_ON_CHECKOUT_TITLE', 'Wyłącz wykupione produkty');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_TITLE', 'Zaznacz produkty, których nie ma w magazynie');
define('STOCK_REORDER_LEVEL_TITLE', 'Limit ilości towarów w magazynie');

// Logi

define('STORE_PAGE_PARSE_TIME_TITLE', 'Zapisz czas analizowania strony');
define('STORE_PAGE_PARSE_TIME_LOG_TITLE', 'Katalog przechowywania logów');
define('STORE_PARSE_DATE_TIME_FORMAT_TITLE', 'Format daty logu');
define('DISPLAY_PAGE_PARSE_TIME_TITLE', 'Pokaż czas analizowania strony');
define('STORE_DB_TRANSACTIONS_TITLE', 'Zapisz zapytania do bazy danych');

// Cache

define('USE_CACHE_TITLE', 'Korzystać z cache');
define('DIR_FS_CACHE_TITLE', 'Cache katalog');

// Konfiguracja e-mail

define('EMAIL_TRANSPORT_TITLE', 'Sposób wysłania E-Mail');
define('EMAIL_LINEFEED_TITLE', 'Separator wierszy w E-Mail');
define('EMAIL_USE_HTML_TITLE', 'Użyj HTML podczas wysyłania wiadomości');
define('ENTRY_EMAIL_ADDRESS_CHECK_TITLE', 'Sprawdź adres e-mail przez DNS');
define('SEND_EMAILS_TITLE', 'Wysyłaj listy ze sklepu');

// Pobieranie

define('DOWNLOAD_ENABLED_TITLE', 'Włącz funkcję pobierania produktu');
define('DOWNLOAD_BY_REDIRECT_TITLE', 'Użyj przekierowania przy pobieraniu');
define('DOWNLOAD_MAX_DAYS_TITLE', 'Czas życia linku do pobierania (dni)');
define('DOWNLOAD_MAX_COUNT_TITLE', 'Maksymalna liczba pobrań');
define('DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE_TITLE', 'Zresetuj statystyki pobierania');
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG_TITLE', 'Ostrzeżenie o konieczności zapłaty za pobrane towary');
define('DOWNLOADS_CONTROLLER_ORDERS_STATUS_TITLE', 'Pobieranie jest dozwolone tylko w przypadku zamówień o określonym statusie');

// GZip Kompresja

define('GZIP_COMPRESSION_TITLE', 'Zezwalaj na kompresję GZip');
define('GZIP_LEVEL_TITLE', 'Poziom kompresji');

// Sesje

define('SESSION_WRITE_DIRECTORY_TITLE', 'Katalog sesji');
define('SESSION_FORCE_COOKIE_USE_TITLE', 'Wymuszone użycie Cookie');
define('SESSION_CHECK_SSL_SESSION_ID_TITLE', 'Sprawdź ID SSL sesji');
define('SESSION_CHECK_USER_AGENT_TITLE', 'Sprawdź zmienną User Agent');
define('SESSION_CHECK_IP_ADDRESS_TITLE', 'Zweryfikuj IP adres');
define('SESSION_BLOCK_SPIDERS_TITLE', 'Nie pokazuj sesji w adresie wyszukiwarek dla pająków');
define('SESSION_RECREATE_TITLE', 'Odtworzyć sesję');

// Tech. serwisowanie

define('DOWN_FOR_MAINTENANCE_TITLE', 'Tech. serwisowanie: On / Off.');
define('DOWN_FOR_MAINTENANCE_FILENAME_TITLE', 'Tech. serwisowanie: Nazwa pliku');
define('DOWN_FOR_MAINTENANCE_HEADER_OFF_TITLE', 'Tech. serwisowanie: Nie wyświetlać czapkę');
define('DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF_TITLE', 'Tech. serwisowanie: Nie pokazuj lewej kolumny');
define('DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF_TITLE', 'Tech. serwisowanie: Nie pokazuj prawej kolumny');
define('DOWN_FOR_MAINTENANCE_FOOTER_OFF_TITLE', 'Tech. serwisowanie: Nie pokazuj dolną część');
define('DOWN_FOR_MAINTENANCE_PRICES_OFF_TITLE', 'Tech. serwisowanie: Nie pokazuj ceny');
define('EXCLUDE_ADMIN_IP_FOR_MAINTENANCE_TITLE', 'Tech. serwisowanie: Wyklucz określony adres IP');
define('WARN_BEFORE_DOWN_FOR_MAINTENANCE_TITLE', 'Powiadom klientów zanim wejdziesz do Obsługi technicznej');
define('PERIOD_BEFORE_DOWN_FOR_MAINTENANCE_TITLE', 'Tekst powiadomienia');
define('DISPLAY_MAINTENANCE_TIME_TITLE', 'Pokaż datę aktywacji trybu Technicznej obsługi');
define('DISPLAY_MAINTENANCE_PERIOD_TITLE', 'Pokaż okres pracy trybu Technicznej obsługi');
define('TEXT_MAINTENANCE_PERIOD_TIME_TITLE', 'Czas pracy Obsługi Technicznej');

// Aktualizacja ceny

define('DISPLAY_MODEL_TITLE', 'Wyświetl kod produktu');
define('MODIFY_MODEL_TITLE', 'Wyświetl kod produktu');
define('MODIFY_NAME_TITLE', 'Wyświetl nazwę produktu');
define('DISPLAY_STATUT_TITLE', 'Wyświetl status produktu');
define('DISPLAY_WEIGHT_TITLE', 'Wyświetl wagę produktu');
define('DISPLAY_QUANTITY_TITLE', 'Wyświetl ilość produktu');
define('DISPLAY_SORT_ORDER_TITLE', 'Wyświetl porządek sortowania');
define('DISPLAY_ORDER_MIN_TITLE', 'Wyświetl minimum dla zamówień');
define('DISPLAY_ORDER_UNITS_TITLE', 'Pokaż krok');
define('DISPLAY_IMAGE_TITLE', 'Wyświetl zdjęcie produktu');
define('DISPLAY_MANUFACTURER_TITLE', 'Pokaż producenta');
define('MODIFY_MANUFACTURER_TITLE', 'Pokaż producentów produktów');
define('DISPLAY_TAX_TITLE', 'Pokaż podatek');
define('MODIFY_TAX_TITLE', 'Pokaż podatek');
define('DISPLAY_TVA_OVER_TITLE', 'Wyświetl ceny z podatkami');
define('DISPLAY_TVA_UP_TITLE', 'Wyświetl ceny z podatkami przy zmianie ceny');
define('DISPLAY_PREVIEW_TITLE', 'Wyświetl link do opisu produktu');
define('DISPLAY_EDIT_TITLE', 'Wyświetl link do edycji elementu');
define('ACTIVATE_COMMERCIAL_MARGIN_TITLE', 'Pokaż możliwość masowej zmiany ceny');

// Żądane produkty

define('MAX_DISPLAY_WISHLIST_PRODUCTS_TITLE', 'Ilość żądanych produktów na stronie');
define('MAX_DISPLAY_WISHLIST_BOX_TITLE', 'Ilość żądanych produktów w boxie');
define('DISPLAY_WISHLIST_EMAILS_TITLE', 'Ilość adresów e-mail');
define('WISHLIST_REDIRECT_TITLE', 'Pozostań na stronie produktu');

// Strona cache

define('ENABLE_PAGE_CACHE_TITLE', 'Zezwalaj na buforowanie stron');
define('PAGE_CACHE_LIFETIME_TITLE', 'Czas życia cache');
define('PAGE_CACHE_DEBUG_MODE_TITLE', 'Włącz tryb debugowania?');
define('PAGE_CACHE_DISABLE_PARAMETERS_TITLE', 'Dezaktywować parametry adresu URL?');
define('PAGE_CACHE_DELETE_FILES_TITLE', 'Usuń cache pliki?');
define('PAGE_CACHE_UPDATE_CONFIG_FILES_TITLE', 'Skonfiguruj aktualizację cache plików?');
// Yandex Market

define('YML_NAME_TITLE', 'Nazwa sklepu');
define('YML_COMPANY_TITLE', 'Nazwa firmy');
define('YML_DELIVERYINCLUDED_TITLE', 'Wysyłka w zestawie');
define('YML_AVAILABLE_TITLE', 'Produkt w magazynie');
define('YML_AUTH_USER_TITLE', 'Login');
define('YML_AUTH_PW_TITLE', 'Hasło');
define('YML_REFERER_TITLE', 'Link');
define('YML_STRIP_TAGS_TITLE', 'Tagi');
define('YML_UTF8_TITLE', 'Transkodowanie w UTF-8');

// Opis pól

// Mój sklep

define('DEFAULT_TEMPLATE_DESC', 'Tutaj możesz domyślnie określić szablon używany w sklepie.');
define('STORE_NAME_DESC', 'Nazwa Twojego sklepu');
define('STORE_OWNER_DESC', 'Imię właściciela sklepu');
define('STORE_LOGO_DESC', 'Podaj logo swojego sklepu');
define('STORE_OWNER_EMAIL_ADDRESS_DESC', 'Adres e-mail właściciela sklepu');
define('STORE_OWNER_ICQ_NUMBER_DESC', 'ICQ Numer, który będzie wyświetlany w polu Konsultant w sklepie.');
define('EMAIL_FROM_DESC', 'Adres e-mail w wysłanych listach');
define('STORE_COUNTRY_DESC', 'Kraj, w którym znajduje się sklep.<br><br><b>Uwaga: Nie zapomnij również podać Strefy.</b>');
define('STORE_ZONE_DESC', 'Lokalizacja sklepu');
define('EXPECTED_PRODUCTS_SORT_DESC', 'Określ porządek sortowania dla oczekiwanych produktów, w kolejności rosnącej - asc lub zmniejszającej - desc.');
define('EXPECTED_PRODUCTS_FIELD_DESC', 'Przez jaką wartość będą sortowane oczekiwane produkty.');
define('USE_DEFAULT_LANGUAGE_CURRENCY_DESC', 'Automatyczne przełączanie cen w sklepie na walutę bieżącego języka.');
define('SEARCH_ENGINE_FRIENDLY_URLS_DESC', 'Użyj krótkich adresów URL w sklepie');
define('DISPLAY_CART_DESC', 'Przejdź do koszyka po dodaniu produktu do koszyka lub pozostaw na tej samej stronie.');
define('ALLOW_GUEST_TO_TELL_A_FRIEND_DESC', 'Zezwalaj gościom na korzystanie z funkcji sklepu Powiadom znajomego, jeśli nie, ta funkcja może być używana tylko przez zarejestrowanych użytkowników sklepu.');
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_DESC', 'Określ, który operator będzie używany domyślnie, gdy użytkownik przeprowadzi wyszukiwanie w sklepie.');
define('STORE_NAME_ADDRESS_DESC', 'Tutaj możesz podać adres i numer telefonu sklepu');
define('SHOW_COUNTS_DESC', 'Pokazuje ilość towarów w każdej kategorii. Przy dużej ilości towaru w sklepie zaleca się wyłączenie licznika - false, aby zmniejszyć obciążenie serwera MySQL, zwiększy się prędkość ładowania strony sklepu.');
define('ALLOW_CATEGORY_DESCRIPTIONS_DESC', 'Pozwól na dodawanie opisów dla kategorii.');
define('TAX_DECIMAL_PLACES_DESC', 'Ilość znaków w podatku po całej liczbie.');
define('SHOW_MAIN_FEATURED_PRODUCTS_DESC', 'True - Pokaż<br>False - Nie pokazuj');
define('DISPLAY_PRICE_WITH_TAX_DESC', 'Pokaż ceny w sklepie z podatkami (true) lub pokaż podatek tylko na ostatnim etapie składania zamówienia (false)');

define('XPRICES_NUM_DESC', 'Tutaj możesz określić, ile cen może mieć każdy produkt<br><br>Na przykład, kupującym z grupy możesz pokazać jedną cenę produktów, a kupującym z grupy Hurtownicy - pokaż inną.');
define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_DESC', 'Jeśli nie chcesz wysyłać karty podarunkowej do zarejestrowanego użytkownika sklepu, podaj 0. Aby wysłać kartę podarunkowej do zarejestrowanych użytkowników, na przykład o wartości 10 USD - napisz 10, jeśli 25,5 $ - podaj 25,5 itd.');
define('ALLOW_GUEST_TO_SEE_PRICES_DESC', 'Jeśli jest false, tylko zarejestrowani użytkownicy mogą zobaczyć ceny w sklepie, jeśli true - wszyscy odwiedzające mogą zobaczyć ceny w sklepie.');
define('NEW_SIGNUP_DISCOUNT_COUPON_DESC', 'Jeśli nie chcesz przekazywać kuponu odwiedzającym, którzy zarejestrowali się, po prostu zostaw to pole puste lub podaj kod istniejącego kuponu, który chcesz przekazać wszystkim zarejestrowanym klientom.');
define('GUEST_DISCOUNT_DESC', 'Marża jest dla zwykłych użytkowników sklepu. Dla zarejestrowanych użytkowników ta opcja w sklepie nie działa. Określ marżę w procentach. Na przykład napisz 10, co oznacza, że dla zwykłych użytkowników wszystkie ceny w sklepie będą o 10% wyższe niż dla zarejestrowanych użytkowników.');
define('CATEGORIES_SORT_ORDER_DESC', '<b>Możliwe wartości to:<br>products_name<br>products_name-desc<br>model<br>model-desc</b>');
define('QUICKSEARCH_IN_DESCRIPTION_DESC', 'Szukając produktu za pomocą szybkiego pola wyszukiwania, możesz określić sposób wyszukiwania przedmiotów, tylko według nazwy - FALSE lub szukaj w nazwach + opisach - TRUE');
define('ALLOW_GIFT_VOUCHERS_DESC', 'Możesz włączyć - true lub wyłączyć - false możliwość korzystania z kart podarunkowych i kuponów przy składaniu zamówienia.');
define('ALLOW_ATTRIBUTES_IN_PRODUCT_EDIT_PAGE_DESC', 'Możesz włączyć - true lub wyłączyć - false możliwość kontrolowania atrybutów towarów bezpośrednio na stronie dodawania / edycji towarów.');
define('SHOW_SUBCATEGORIES_WHEN_CATEGORIES_HAS_PRODUCTS_DESC', 'Jeśli istnieje kategoria w kategorii i istnieją podkategorie w tej kategorii, domyślnie, przechodząc do tej kategorii, zobaczysz listę podkategorii i listę produktów danej kategorii. Możesz wyłączyć wyjście podkategorii, ustawić na false.');
define('SHOW_PDF_DATASHEET_DESC', 'Pokaż (true) lub nie (false) PDF opis towarów na stronie opisu produktu.');

// Minimalne wartości

define('ENTRY_FIRST_NAME_MIN_LENGTH_DESC', 'Minimalna liczba znaków w polu Nazwa');
define('ENTRY_LAST_NAME_MIN_LENGTH_DESC', 'Minimalna liczba znaków w polu Nazwisko');
define('ENTRY_DOB_MIN_LENGTH_DESC', 'Minimalna liczba znaków w polu Data urodzenia');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_DESC', 'Minimalna liczba znaków w polu Adres e-mail');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_DESC', 'Minimalna liczba znaków w polu Adres');
define('ENTRY_COMPANY_MIN_LENGTH_DESC', 'Minimalna liczba znaków pola Firma');
define('ENTRY_POSTCODE_MIN_LENGTH_DESC', 'Minimalna liczba znaków w polu Kod pocztowy');
define('ENTRY_CITY_MIN_LENGTH_DESC', 'Minimalna liczba znaków w polu Miasto');
define('ENTRY_STATE_MIN_LENGTH_DESC', 'Minimalna liczba znaków w polu Województwo');
define('ENTRY_TELEPHONE_MIN_LENGTH_DESC', 'Minimalna liczba znaków w polu Telefon');
define('ENTRY_PASSWORD_MIN_LENGTH_DESC', 'Minimalna liczba znaków w polu Hasło');
define('CC_OWNER_MIN_LENGTH_DESC', 'Minimalna liczba znaków w polu Właściciel karty kredytowej');
define('CC_NUMBER_MIN_LENGTH_DESC', 'Minimalna liczba znaków w polu Numer karty kredytowej');
define('REVIEW_TEXT_MIN_LENGTH_DESC', 'Minimalna liczba znaków dla opinii');
define('MIN_DISPLAY_BESTSELLERS_DESC', 'Minimalna ilość towarów wyświetlana w bloku Najlepsi sprzedawcy ');
define('MIN_DISPLAY_ALSO_PURCHASED_DESC', 'Minimalna ilość towarów wyświetlana w boxie Także Zamówili');
define('MIN_DISPLAY_XSELL_DESC', 'Minimalna ilość towarów wyświetlana w boxie Powiązane produkty');
define('MIN_ORDER_DESC', 'Jeśli kwota zamówienia jest mniejsza niż określona kwota, takie zamówienie nie może zostać wykonane. Podaj po prostu liczbę bez symboli waluty ($, rub, itp.). Ustaw go na 0, jeśli nie chcesz ograniczać minimalnej kwoty zamówienia.');

// Maksymalne wartości

define('MAX_PROD_ADMIN_SIDE_DESC', 'Ilość towarów na jednej stronie w administracji');

define('MAX_ADDRESS_BOOK_ENTRIES_DESC', 'Maksymalna liczba rekordów, które klient może wprowadzić do swojej książce adresowej');
define('MAX_DISPLAY_SEARCH_RESULTS_DESC', 'Liczba produktów wyświetlanych na jednej stronie');
define('MAX_DISPLAY_PAGE_LINKS_DESC', 'Liczba linków do innych stron');
define('MAX_DISPLAY_SPECIAL_PRODUCTS_DESC', 'Maksymalna ilość towarów wyświetlanych na stronie Rabaty');
define('MAX_DISPLAY_NEW_PRODUCTS_DESC', 'Maksymalna ilość towarów wyświetlana w boxie Nowe produkty');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_DESC', 'Maksymalna ilość towarów wyświetlana w bloku Towarów Oczekiwanych');
define('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST_DESC', 'Ta opcja służy do konfiguracji boxa producentów, jeśli liczba producentów przekracza liczbę określoną w tej opcji, lista producentów będzie wyświetlana jako lista rozwijana, jeśli liczba producentów jest mniejsza niż liczba określona w tej opcji, producenci będą wyświetleni na liście.');
define('MAX_MANUFACTURERS_LIST_DESC', 'Ta opcja służy do konfiguracji boxa producentów, jeśli podana jest cyfra \'1\', lista producentów jest wyświetlana jako standardowa lista rozwijana. Jeśli zostanie podana jakakolwiek inna cyfra, tylko producenci X są wyświetlani w postaci rozwiniętego menu.');
define('MAX_DISPLAY_MANUFACTURER_NAME_LEN_DESC', 'Ta opcja służy do konfiguracji boxa producenta, określasz liczbę znaków wyświetlanych w polu producenta, jeśli nazwa producenta składa się z większej liczby znaków, zostaną wyświetlone pierwsze X znaki nazwy');
define('MAX_RANDOM_SELECT_NEW_DESC', 'Ilość towarów, spośród których losowe towary zostaną wybrane i wyświetlone w boxie Nowe produkty, czyli jeśli podana jest liczba X, wówczas nowy produkt, który będzie wyświetlany w boxie Nowe produkty, zostanie wybrany spośród tych nowych produktów');
define('MAX_RANDOM_SELECT_SPECIALS_DESC', 'Ilości towarów, spośród których zostanie wybrany losowy produkt i wyświetlane w boxie Rabaty, czyli jeśli podana jest liczba X, elementy do wyświetlenia w boxie Rabaty zostaną wybrane z tych X elementów');
define('MAX_DISPLAY_CATEGORIES_PER_ROW_DESC', 'Ile kategorii jest wyświetlanych w jednym wierszu');
define('MAX_DISPLAY_PRODUCTS_NEW_DESC', 'Maksymalna liczba nowych produktów wyświetlanych na jednej stronie w dziale Nowe produkty');
define('MAX_DISPLAY_BESTSELLERS_DESC', 'Maksymalna liczba liderów sprzedaży, które są wyświetlane w boxie Najlepsi sprzedawcy');
define('MAX_DISPLAY_ALSO_PURCHASED_DESC', 'Maksymalna liczba produktów w boxie Nasi klienci również zamówili');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_DESC', 'Maksymalna liczba produktów wyświetlana w boxie Historia zamówień');
define('MAX_DISPLAY_ORDER_HISTORY_DESC', 'Maksymalna liczba zamówień wyświetlana na stronie Historia zamówień');
define('MAX_DISPLAY_FEATURED_PRODUCTS_DESC', 'Maksymalna ilość towarów w boxie Zalecane towary na stronie głównej');
define('MAX_DISPLAY_FEATURED_PRODUCTS_LISTING_DESC', 'Ilość towarów na jednej stronie Zalecanych towarów');

// Obraz

define('SMALL_IMAGE_WIDTH_DESC', 'Szerokość obrazu w pikselach. Pozostaw pole puste lub ustaw wartość 0, jeśli nie chcesz ograniczać szerokości obrazu. Ograniczenie szerokości obrazu nie oznacza fizycznej redukcji rozmiaru obrazu.');
define('SMALL_IMAGE_HEIGHT_DESC', 'Wysokość obrazu w pikselach. Pozostaw pole puste lub ustaw wartość 0, jeśli nie chcesz ograniczać wysokości obrazu. Ograniczenie wysokości obrazu nie oznacza fizycznej redukcji rozmiaru obrazu.');
define('HEADING_IMAGE_WIDTH_DESC', 'Szerokość obrazu w pikselach. Pozostaw pole puste lub ustaw wartość 0, jeśli nie chcesz ograniczać szerokości obrazu. Ograniczenie szerokości obrazu nie oznacza fizycznej redukcji rozmiaru obrazu.');
define('HEADING_IMAGE_HEIGHT_DESC', 'Wysokość obrazu w pikselach. Pozostaw pole puste lub ustaw wartość 0, jeśli nie chcesz ograniczać wysokości obrazu. Ograniczenie wysokości obrazu nie oznacza fizycznej redukcji rozmiaru obrazu.');
define('SUBCATEGORY_IMAGE_WIDTH_DESC', 'Szerokość obrazu w pikselach. Pozostaw pole puste lub ustaw wartość 0, jeśli nie chcesz ograniczać szerokości obrazu. Ograniczenie szerokości obrazu nie oznacza fizycznej redukcji rozmiaru obrazu.');
define('SUBCATEGORY_IMAGE_HEIGHT_DESC', 'Wysokość obrazu w pikselach. Pozostaw pole puste lub ustaw wartość 0, jeśli nie chcesz ograniczać wysokości obrazu. Ograniczenie wysokości obrazu nie oznacza fizycznej redukcji rozmiaru obrazu.');
define('CONFIG_CALCULATE_IMAGE_SIZE_DESC', 'Ta opcja analizuje wymienione powyżej zmienne i kompresuje obraz do określonych rozmiarów, co nie oznacza, że fizyczny rozmiar obrazu będzie się zmniejszał, a wymuszony obraz o określonym rozmiarze będzie wyprowadzany. Zaleca się ustawienie false');
define('IMAGE_REQUIRED_DESC', 'Konieczne jest dla wyszukania błędów, na wypadek gdyby obraz nie był wyświetlany.');
define('ULTIMATE_ADDITIONAL_IMAGES_DESC', 'Możesz włączyć / wyłączyć moduł dodatkowych zdjęć do produktu.');
define('ULT_THUMB_IMAGE_WIDTH_DESC', 'Szerokość dodatkowego obrazu w pikselach. Pozostaw pole puste lub ustaw wartość 0, jeśli nie chcesz ograniczać szerokości obrazu. Ograniczenie szerokości obrazu nie oznacza fizycznej redukcji rozmiaru obrazu.');
define('ULT_THUMB_IMAGE_HEIGHT_DESC', 'Wysokość dodatkowego obrazu w pikselach. Pozostaw pole puste lub ustaw wartość 0, jeśli nie chcesz ograniczać wysokości obrazu. Ograniczenie wysokości obrazu nie oznacza fizycznej redukcji rozmiaru obrazu.');
define('MEDIUM_IMAGE_WIDTH_DESC', 'Szerokość dużego obrazu w pikselach. Pozostaw pole puste lub ustaw wartość 0, jeśli nie chcesz ograniczać szerokości dużego obrazu. Ograniczenie szerokości dużego obrazu nie oznacza fizycznej redukcji rozmiaru obrazu.');
define('MEDIUM_IMAGE_HEIGHT_DESC', 'Wysokość dużego obrazu w pikselach. Pozostaw pole puste lub ustaw wartość 0, jeśli nie chcesz ograniczać wysokości dużego obrazu. Ograniczenie wysokości dużego obrazu nie oznacza fizycznej redukcji rozmiaru obrazu.');
define('LARGE_IMAGE_WIDTH_DESC', 'Szerokość obrazu dla wyskakującego okna w pikselach. Pozostaw pole puste lub ustaw wartość 0, jeśli nie chcesz ograniczać szerokości okna wyskakującego. Ograniczanie szerokości obrazu w oknie podręcznym nie oznacza fizycznej redukcji rozmiaru obrazu.');
define('LARGE_IMAGE_HEIGHT_DESC', 'Wysokość obrazu dla wyskakującego okienka w pikselach. Pozostaw pole puste lub ustaw wartość 0, jeśli nie chcesz ograniczać wysokości obrazu w wyskakującym oknie. Ograniczenie wysokości obrazu do wyskakującego okienka nie oznacza fizycznej redukcji rozmiaru obrazu.');

// Dane kupującego

define('ACCOUNT_GENDER_DESC', 'Pokaż pole Płeć, gdy klient jest zarejestrowany w sklepie i w książce adresowej');
define('ACCOUNT_DOB_DESC', 'Pokaż pole Data urodzenia podczas rejestracji kupującego w sklepie i w książce adresowej');
define('ACCOUNT_COMPANY_DESC', 'Pokaż pole Firma podczas rejestracji kupującego w sklepie i w książce adresowej');
define('ACCOUNT_SUBURB_DESC', 'Pokaż pole Gmina podczas rejestrowania klienta w sklepie i w książce adresowej');
define('ACCOUNT_STATE_DESC', 'Pokaż pole Województwo podczas rejestrowania kupującego w sklepie i w książce adresowej');
define('ACCOUNT_STREET_ADDRESS_DESC', 'Pokaż pole Adres podczas rejestrowania kupującego w sklepie i w książce adresowej');
define('ACCOUNT_CITY_DESC', 'Pokaż pole Miasto, gdy klient jest zarejestrowany w sklepie i w książce adresowej');
define('ACCOUNT_POSTCODE_DESC', 'Pokaż pole Kod pocztowy podczas rejestracji klienta w sklepie i w książce adresowej');
define('ACCOUNT_COUNTRY_DESC', 'Pokaż pole Kraj, gdy klient jest zarejestrowany w sklepie i w książce adresowej');
define('ACCOUNT_TELE_DESC', 'Pokaż pole Telefon podczas rejestracji klienta w sklepie i w książce adresowej');
define('ACCOUNT_FAX_DESC', 'Pokaż pole Fax podczas rejestracji klienta w sklepie i w książce adresowej');
define('ACCOUNT_NEWS_DESC', 'Pokaż listę mailingową podczas rejestracji kupującego w sklepie oraz w książce adresowej');
define('ACCOUNT_LAST_NAME_DESC', 'Pokaż pole Nazwisko podczas rejestracji klienta w sklepie oraz w książce adresowej');
// Dostawa / pakowanie

define('SHIPPING_ORIGIN_COUNTRY_DESC', 'Kraj, w którym znajduje się sklep. Wymagany w przypadku niektórych modułów dostawy.');
define('SHIPPING_ORIGIN_ZIP_DESC', 'Wprowadź kod pocztowy sklepu. Wymagany w przypadku niektórych modułów dostawy.');
define('SHIPPING_MAX_WEIGHT_DESC', 'Możesz określić maksymalną wagę przesyłki, z której nie są dostarczane zamówienia. Wymagany w przypadku niektórych modułów dostawy.');
define('SHIPPING_BOX_WEIGHT_DESC', 'Możesz określić wagę paczki.');
define('SHIPPING_BOX_PADDING_DESC', 'Dostawa zamówień, których waga jest większa niż określona w zmiennej Maksymalna waga dostawy, jest zwiększona o określony procent. Jeśli chcesz zwiększyć koszt o 10%, napisz - 10');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_DESC', 'Czy chcesz zezwolić na korzystanie z modułu bezpłatnej dostawy?');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_DESC', 'Zamówienia, przekraczające kwotę określoną w tym polu, będą dostarczane bezpłatnie.');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_DESC', 'national - zamówienia z kraju lokalizacji sklepu (zmienna Kraj sklepu), , international - zamówienia z dowolnego kraju, z wyjątkiem kraju sklepu, jeśli oba - to wszystkie zamówienia. Pod warunkiem, że ilość zamówień jest wyższa niż kwota podana w powyższej zmiennej.');
define('SHOW_SHIPPING_ESTIMATOR_DESC', 'Pokaż informacje o metodach i kosztach dostawy w koszyku?<br>true - pokaż.<br>false - nie pokazuj.');

// Wyświetlanie towaru

define('PRODUCT_LISTING_DISPLAY_STYLE_DESC', 'Możesz wybrać, w jakim formacie chcesz wyświetlać produkt, w formie tabeli - list lub w kolumnie - columns.');
define('PRODUCT_LIST_IMAGE_DESC', 'Określ kolejność wyświetlania, czyli wprowadź cyfrę. Jeśli wybierzesz 1, to zdjęcie będzie po lewej stronie, a jeśli 2, zdjęcie zostanie wyświetlone po polu o numerze 1 (po prawej od 1) itd.');
define('PRODUCT_LIST_MANUFACTURER_DESC', 'Określ kolejność, w jakiej to pole jest wyświetlane w twoim sklepie, tj. Wprowadź numer. Jeśli podasz 1, to pole będzie po lewej na pierwszym miejscu, jeśli 2, to pole będzie wyświetlane po (po prawej) pola, z cyfrą 1 itd.');
define('PRODUCT_LIST_MODEL_DESC', 'Określ kolejność, w jakiej to pole jest wyświetlane w twoim sklepie, tj. Wprowadź numer. Jeśli podasz 1, to pole będzie po lewej na pierwszym miejscu, jeśli 2, to pole będzie wyświetlane po (po prawej) pola, z cyfrą 1 itd.');
define('PRODUCT_LIST_NAME_DESC', 'Określ kolejność, w jakiej to pole jest wyświetlane w twoim sklepie, tj. Wprowadź numer. Jeśli podasz 1, to pole będzie po lewej na pierwszym miejscu, jeśli 2, to pole będzie wyświetlane po (po prawej) pola, z cyfrą 1 itd.');
define('PRODUCT_LIST_PRICE_DESC', 'Określ kolejność, w jakiej to pole jest wyświetlane w twoim sklepie, tj. Wprowadź numer. Jeśli podasz 1, to pole będzie po lewej na pierwszym miejscu, jeśli 2, to pole będzie wyświetlane po (po prawej) pola, z cyfrą 1 itd.');
define('PRODUCT_LIST_QUANTITY_DESC', 'Określ kolejność, w jakiej to pole jest wyświetlane w twoim sklepie, tj. Wprowadź numer. Jeśli podasz 1, to pole będzie po lewej na pierwszym miejscu, jeśli 2, to pole będzie wyświetlane po (po prawej) pola, z cyfrą 1 itd.');
define('PRODUCT_LIST_WEIGHT_DESC', 'Określ kolejność, w jakiej to pole jest wyświetlane w twoim sklepie, tj. Wprowadź numer. Jeśli podasz 1, to pole będzie po lewej na pierwszym miejscu, jeśli 2, to pole będzie wyświetlane po (po prawej) pola, z cyfrą 1 itd.');
define('PRODUCT_LIST_BUY_NOW_DESC', 'Określ kolejność, w jakiej to pole jest wyświetlane w twoim sklepie, tj. Wprowadź numer. Jeśli podasz 1, to pole będzie po lewej na pierwszym miejscu, jeśli 2, to pole będzie wyświetlane po (po prawej) pola, z cyfrą 1 itd.');
define('PRODUCT_LIST_FILTER_DESC', 'Pokaż box (menu rozwijane), za pomocą którego możesz posortować produkt w dowolnej kategorii sklepu według producenta.');
define('PREV_NEXT_BAR_LOCATION_DESC', 'Ustaw lokalizację nawigacji Następna / Poprzednia strona (1-góra, 2-dół, 3-góra + dół)');
define('PRODUCT_LIST_INFO_DESC', 'Jeśli podasz 0, krótki opis nie będzie wyświetlany, jeśli 1-99 - zostanie wyświetlony krótki opis, ale tylko wtedy, gdy dodany został krótki opis.');
define('PRODUCT_SORT_ORDER_DESC', 'Określ kolejność, w jakiej to pole jest wyświetlane w twoim sklepie, tj. Wprowadź numer. Jeśli podasz 1, to pole będzie po lewej na pierwszym miejscu, jeśli 2, to pole będzie wyświetlane po po prawej, z cyfrą 1 itd. 0 - oznacza nie wyświetlaj tego pola');

// Magazyn

define('STOCK_CHECK_DESC', 'Sprawdź, czy wymagana ilość towaru w zamówieniu jest na magazynie');
define('STOCK_LIMITED_DESC', 'Odjąć z magazynu tę ilość towarów, która zostanie zamówiona w sklepie internetowym');
define('STOCK_ALLOW_CHECKOUT_DESC', 'Pozwól klientom składać zamówienia, nawet jeśli w magazynie brakuje wystarczającej liczby zamówionych towarów');
define('STOCK_DISABLE_NON_EXISTENT_PRODUCT_ON_CHECKOUT_DESC', 'Wyłącz produkty z ilością 0 po zakupie');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_DESC', 'Pokaż znacznik kupującemu przed towarem przy składaniu zamówienia, jeśli w magazynie nie ma potrzebnej ilości zamówionego towaru');
define('STOCK_REORDER_LEVEL_DESC', 'Jeśli ilość towarów w magazynie jest mniejsza niż podana liczba w tej zmiennej, w koszu wyświetlane jest ostrzeżenie o niewystarczającej ilości towarów w magazynie do realizacji zamówienia.');

// Logi

define('STORE_PAGE_PARSE_TIME_DESC', 'Zachowaj czas poświęcony na generowanie (analizowanie) stron sklepu.');
define('STORE_PAGE_PARSE_TIME_LOG_DESC', 'Pełna ścieżka do katalogu i pliku, w którym zostanie zapisany log analizowania stron.');
define('STORE_PARSE_DATE_TIME_FORMAT_DESC', 'Format daty');
define('DISPLAY_PAGE_PARSE_TIME_DESC', 'Pokaż czas analizowania strony w sklepie internetowym (opcja "Zapisz czas analizowania strony" musi być włączona)');
define('STORE_DB_TRANSACTIONS_DESC', 'Zapisz wszystkie zapytania do bazy danych w pliku określonym w zmiennej Katalog przechowywania logów (tylko dla PHP4 i wyższych)');

// Cache

define('USE_CACHE_DESC', 'Użyj buforowania informacji.');
define('DIR_FS_CACHE_DESC', 'Katalog, w którym będą zapisywane i przechowywane cache-pliki');

// Ustawienia E-Mail

define('EMAIL_TRANSPORT_DESC', 'Określ sposób, w jaki będą wysyłane listy ze sklepu. W przypadku serwerów z systemem Windows lub MacOS, musisz zainstalować SMTP, aby wysyłać pocztę.');
define('EMAIL_LINEFEED_DESC', 'Sekwencja znaków używanych do rozdzielania nagłówków w liście.');
define('EMAIL_USE_HTML_DESC', 'Wysyłaj listy ze sklepu w formacie HTML.');
define('ENTRY_EMAIL_ADDRESS_CHECK_DESC', 'Sprawdź, czy prawidłowe adresy e-mail są wskazane podczas rejestracji w sklepie internetowym. DNS służy do weryfikacji.');
define('SEND_EMAILS_DESC', 'Wysyłaj listy ze sklepu.');

// Pobieranie

define('DOWNLOAD_ENABLED_DESC', 'Włącz funkcję pobierania.');
define('DOWNLOAD_BY_REDIRECT_DESC', 'Użyj przekierowanie w przeglądarce, aby pobrać produkt. W systemach innych niż systemy uniksowe (Windows, Mac OS itp.) powinno być false.');
define('DOWNLOAD_MAX_DAYS_DESC', 'Ustaw liczbę dni, w których kupujący może pobrać swoje towary. Jeśli podasz 0, to czas życia linku pobierania nie będzie ograniczony.');
define('DOWNLOAD_MAX_COUNT_DESC', 'Ustaw maksymalną liczbę pobrań dla jednego produktu. Jeśli podasz 0, nie będzie żadnych ograniczeń co do liczby pobrań.');
define('DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE_DESC', 'Jaki ID numer statusu zamówienia resetuje Czas życia linka do pobierania (dni) i Maksymalna liczba pobrań - Domyślnie Dostarczony (kod id 4).');
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG_DESC', 'Możesz określić wiadomość, która zostanie wyświetlona klientowi, w przypadku gdyby chciał pobrać więcej jeszcze niezapłaconych towarów.');
define('DOWNLOADS_CONTROLLER_ORDERS_STATUS_DESC', 'Pobieranie plików będzie dozwolone tylko, jeśli zamówienie ma określony status (a w szczególności ID kodu statusu zamówienia). Domyślnie pobieranie jest dozwolone dla zamówień ze statusem oczekującym na płatność (kod ID 2).');

// Kompresja GZip

define('GZIP_COMPRESSION_DESC', 'Zezwalaj HTTP na kompresję GZip.');
define('GZIP_LEVEL_DESC', 'Możesz określić poziom kompresji od 0 do 9 (0 = minimum, 9 = maksimum).');

// Sesje

define('SESSION_WRITE_DIRECTORY_DESC', 'Jeśli sesje są przechowywane w plikach, to tutaj musisz podać pełną ścieżkę do folderu, w którym będą przechowywane pliki sesji.');
define('SESSION_FORCE_COOKIE_USE_DESC', 'Wymuszaj sesje tylko wtedy, gdy w przeglądarce włączono obsługę plików cookie.');
define('SESSION_CHECK_SSL_SESSION_ID_DESC', 'Sprawdź SSL_SESSION_ID za każdym razem, gdy uzyskujesz dostęp do strony chronionej protokołem HTTPS.');
define('SESSION_CHECK_USER_AGENT_DESC', 'Sprawdź zmienną wyszukiwarki user agent dla każdego dostępu do stron sklepu internetowego.');
define('SESSION_CHECK_IP_ADDRESS_DESC', 'Sprawdź adresy IP klientów za każdym razem, gdy wchodzisz na stronę sklepu internetowego.');
define('SESSION_BLOCK_SPIDERS_DESC', 'Nie pokazuj sesji w adresie podczas uzyskiwania dostępu do stron sklepu znanych pająków wyszukiwania. Lista znanych pająków znajduje się w pliku includes/spiders.txt.');
define('SESSION_RECREATE_DESC', 'Odtworzyć sesję, aby wygenerować nowy kod identyfikacyjny sesji, gdy zarejestrowany klient wejdzie do sklepu lub zarejestruje nowego kupującego (tylko dla PHP 4.1 i wyższych).');

// Tech. obsługa

define('DOWN_FOR_MAINTENANCE_DESC', 'Tech. obsługa. Jeśli jest włączona, nie będzie można składać zamówień w sklepie i zostanie wydane ostrzeżenie o technicznej obsłudze prowadzonej w sklepie.<br>true - Włączone<br>false - Wyłączone');
define('DOWN_FOR_MAINTENANCE_FILENAME_DESC', 'Plik, który zostanie wyświetlony w sklepie, jeśli włączona jest obsługa sklepu. Domyślne - down_for_maintenance.php');
define('DOWN_FOR_MAINTENANCE_HEADER_OFF_DESC', 'Przy włączonej technicznej obsłudze sklepu można zabronić wyświetlaniu magazynu<br>true - Nie pokazuj<Br>false - Pokazuj');
define('DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF_DESC', 'Przy włączonej technicznej obsłudze sklepu możesz wyłączyć wyświetlanie lewej kolumny sklepu<br>true - Nie pokazuj<Br>false - Pokaż');
define('DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF_DESC', 'Przy włączonej technicznej obsłudze sklepu możesz wyłączyć wyświetlanie prawej kolumny sklepu<br>true - Nie pokazuj<Br>false - Pokaż');
define('DOWN_FOR_MAINTENANCE_FOOTER_OFF_DESC', 'Przy włączonej technicznej obsłudze sklepu możesz zabronić wyświetlania dolnej części sklepu<br>true - Nie pokazuj<Br>false - Pokaż');
define('DOWN_FOR_MAINTENANCE_PRICES_OFF_DESC', 'Przy włączonej technicznej obsłudze sklepu możesz zabronić wyświetlania cen towarów w sklepie<br>true - Nie pokazuj<Br>false - Pokaż');
define('EXCLUDE_ADMIN_IP_FOR_MAINTENANCE_DESC', 'Dla podanego adresu IP magazyn będzie dostępny, nawet jeśli jest włączony tryb Technicznej obsługi. Zwykle tutaj jest wskazany adres IP administratora sklepu.');
define('WARN_BEFORE_DOWN_FOR_MAINTENANCE_DESC', 'Ostrzegaj odwiedzających przed rozpoczęciem obsługi technicznej. Jeśli techniczna obsługa jest już włączona, ta opcja jest automatycznie ustawiana jako false.');
define('PERIOD_BEFORE_DOWN_FOR_MAINTENANCE_DESC', 'Wpisz tekst powiadomienia.');
define('DISPLAY_MAINTENANCE_TIME_DESC', 'Pokaż datę aktywacji trybu Technicznej obsługi.');
define('DISPLAY_MAINTENANCE_PERIOD_DESC', 'Pokaż, jak długo sklep będzie w trybie Technicznej obsługi.');
define('TEXT_MAINTENANCE_PERIOD_TIME_DESC', 'Określ czas pracy sklepu w trybie Technicznej obsługi');

// Aktualizacja ceny

define('DISPLAY_MODEL_DESC', 'Pokaż / Ukryj kod produktu');
define('MODIFY_MODEL_DESC', 'Pokaż / Ukryj kod produktu');
define('MODIFY_NAME_DESC', 'Pokaż / Ukryj nazwę produktu');
define('DISPLAY_STATUT_DESC', 'Pokaż / Nie pokazuj statusu produktu');
define('DISPLAY_WEIGHT_DESC', 'Pokaż / Ukryj wagę produktu');
define('DISPLAY_QUANTITY_DESC', 'Pokaż / Nie pokazuj ilości produktów');
define('DISPLAY_SORT_ORDER_DESC', 'Pokaż / Nie pokazuj porządku sortowania');
define('DISPLAY_ORDER_MIN_DESC', 'Pokaż / Nie pokazuj minimum dla zamówienia');
define('DISPLAY_ORDER_UNITS_DESC', 'Pokaż / Nie pokazuj kroku');
define('DISPLAY_IMAGE_DESC', 'Pokaż / Nie pokazuj obrazu produktu');
define('MODIFY_MANUFACTURER_DESC', 'Pokaż / Nie pokazuj producenta produktów');
define('MODIFY_TAX_DESC', 'Pokaż / Nie pokazuj podatku');
define('DISPLAY_TVA_OVER_DESC', 'Pokaż / Nie pokazuj cen z podatkami');
define('DISPLAY_TVA_UP_DESC', 'Pokaż / Nie pokazuj ceny z podatkami, przy zmianie ceny');
define('DISPLAY_PREVIEW_DESC', 'Pokaż / Ukryj link do opisu produktu');
define('DISPLAY_EDIT_DESC', 'Pokaż / Nie pokazuj linku do edycji elementu');
define('DISPLAY_MANUFACTURER_DESC', 'Pokaż / Nie pokazuj producenta');
define('DISPLAY_TAX_DESC', 'Pokaż / Nie pokazuj podatku');
define('ACTIVATE_COMMERCIAL_MARGIN_DESC', 'Pokaż / Nie pokazuj możliwości masowej zmiany ceny');

// Cache stron

define('ENABLE_PAGE_CACHE_DESC', 'Zezwalaj na buforowanie stron? Ta funkcja pomaga zmniejszyć obciążenie serwera i przyspieszyć ładowanie stron.');
define('PAGE_CACHE_LIFETIME_DESC', 'Jak długo powinienem buforować strony (w minutach)?');
define('PAGE_CACHE_DEBUG_MODE_DESC', 'Włącz tryb debugowania (u dołu strony)? Nie włączaj tej opcji w działających sklepach! Możesz włączyć tryb debugowania, po prostu dodając opcję do adresu URL?debug=1');
define('PAGE_CACHE_DISABLE_PARAMETERS_DESC', 'W niektórych przypadkach (na przykład w przypadku krótkich adresów) lub w przypadku dużej liczby partnerów może to prowadzić do nadmiernego wykorzystania miejsca na dysku.');
define('PAGE_CACHE_DELETE_FILES_DESC', 'Jeśli ustawione na true, to dla każdego następnego oglądania dowolnej strony w katalogu wszystkie cache-pliki zostaną usunięte, a następnie zwrócą wartość false.');
define('PAGE_CACHE_UPDATE_CONFIG_FILES_DESC', 'Jeśli zainstalowałeś moduł configuration cache, określ pełną (bezwzględną) ścieżkę do pliku aktualizacji.');

// Yandex Market

define('YML_NAME_DESC', 'Nazwa sklepu dla Yandex-Market. Jeśli pole jest puste, to jest używane STORE_NAME.');
define('YML_COMPANY_DESC', 'Nazwa firmy dla Yandex-Market. Jeśli pole jest puste, to jest używane STORE_OWNER.');
define('YML_DELIVERYINCLUDED_DESC', 'Wysyłka jest wliczona w cenę towaru?');
define('YML_AVAILABLE_DESC', 'Produkt dostępny lub na zamówienie?');
define('YML_AUTH_USER_DESC', 'Login dostępu do YML');
define('YML_AUTH_PW_DESC', 'Hasło dostępu do YML');
define('YML_REFERER_DESC', 'Dodać do adresu produktu parametr z linkiem do User agent lub adresu IP?');
define('YML_STRIP_TAGS_DESC', 'Usunąć html-tagi w wierszach?');
define('YML_UTF8_DESC', 'Transkodować do UTF-8?');

define('GOOGLE_OAUTH_STATUS_TITLE', 'Enable Google Authorization');
define('GOOGLE_OAUTH_CLIENT_ID_TITLE', 'Google CLIENT ID');
define('GOOGLE_OAUTH_CLIENT_SECRET_TITLE', 'Google CLIENT SECRET');
define('GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED_TITLE', 'Włącz Google Analytics');
define('GOOGLE_TAGS_ID_TITLE', 'Google Tag ID (gtag.js) for Google Analytics');
define('GOOGLE_TAG_MANAGER_ID_TITLE', 'Google Tag Manager ID');
define('GOOGLE_TAGS_ID_STATUS_TITLE', 'Google Tags ID status');

define('GOOGLE_GOALS_PAGE_VIEW_TITLE', 'Celem \'page_view\' jest wyświetlenie każdej strony');
define('GOOGLE_GOALS_ADD_TO_CART_TITLE', 'Target \'add_to_cart\' oznacza, że ​​klient dodaje produkt do koszyka');
define('GOOGLE_GOALS_ON_CHECKOUT_TITLE', 'Celem \'checkout_view\' jest wyświetlenie strony kasy');
define('GOOGLE_GOALS_CHECKOUT_PROCESS_TITLE', 'Target \'checkout_progress\' - klient z powodzeniem złożył zamówienie');
define('GOOGLE_GOALS_CHECKOUT_SUCCESS_TITLE', 'Celem \'checkout_success\' jest wyświetlenie strony po potwierdzeniu zamówienia');
define('GOOGLE_GOALS_CLICK_FAST_BUY_TITLE', 'Target \'fast_buy\' - gdy klient kliknie przycisk "Szybkie zamówienie" na stronie produktu');
define('GOOGLE_GOALS_LOGIN_TITLE', 'Cel \'login\' oznacza, że ​​klient jest zalogowany');
define('GOOGLE_GOALS_ADD_REVIEW_TITLE', 'Cel \'add_review\' oznacza, że ​​klient dodał recenzję');
define('GOOGLE_GOALS_FILTER_TITLE', 'Celem \'filtra\' jest użycie przez klienta filtra do wyszukiwania produktów');
define('GOOGLE_GOALS_CALLBACK_TITLE', 'Target \"callback\" - gdy klient kliknie przycisk \"Callback\" w nagłówku strony');
define('GOOGLE_GOALS_CLICK_ON_PHONE_TITLE', 'Cel \'phone_call\' oznacza, że ​​klient kliknie ikonę telefonu');
define('GOOGLE_GOALS_CLICK_ON_CHAT_TITLE', 'Cel \'click_chat\' oznacza, że ​​klient kliknie na czacie');
define('GOOGLE_GOALS_CONTACT_US_TITLE', 'Target \'contact_us\' - kiedy klient złożył zapytanie na stronie kontaktowej');
define('GOOGLE_GOALS_SUBSCRIBE_TITLE', 'Cel \'subscribe\' - gdy klient subskrybuje');
define('GOOGLE_GOALS_CLICK_ON_BUG_REPORT_TITLE', 'Celem \'bug_report\' jest kliknięcie przez klienta \'Prześlij raport o błędzie\' w stopce strony');

define('GOOGLE_ECOMM_SUCCESS_PAGE_TITLE', 'Zakup e-commerce \'zakup\' - wyświetlenie strony po potwierdzeniu zamówienia');
define('GOOGLE_ECOMM_CHECKOUT_PAGE_TITLE', 'Cel e-commerce \'koszyk\' — strona kasy');
define('GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE_TITLE', 'Celem e-commerce \'produkt\' jest wyświetlenie strony produktu');
define('GOOGLE_ECOMM_SEARCH_RESULTS_TITLE', 'Cel e-commerce \'searchresults\' - wyświetl stronę wyników wyszukiwania');
define('GOOGLE_ECOMM_HOME_PAGE_TITLE', 'Celem e-commerce \'home\' jest wyświetlenie strony produktu');
define('GOOGLE_ECOMM_CLICK_FAST_BUY_TITLE', 'Ecommerce Goal \'Purchase\' - when customer accept \'Quick order\' on product page');

define('DEFAULT_CAPTCHA_STATUS_TITLE', 'Captcha');
define('GOOGLE_RECAPTCHA_STATUS_TITLE', 'Google Recaptcha Status');
define('GOOGLE_RECAPTCHA_PUBLIC_KEY_TITLE', 'Google Recaptcha PUBLIC KEY');
define('GOOGLE_RECAPTCHA_SECRET_KEY_TITLE', 'Google Recaptcha SECRET KEY');

define('FACEBOOK_AUTH_STATUS_TITLE', 'Facebook Upoważnienie');

define('RCS_BASE_DAYS_TITLE', 'Spójrz wstecz dni');
define('RCS_SKIP_DAYS_TITLE', 'Pomiń dni');
define('RCS_REPORT_DAYS_TITLE', 'Użyj obliczonych podatków');
define('RCS_INCLUDE_TAX_IN_PRICES_TITLE', 'Użyj stałej stawki podatkowej');
define('RCS_USE_FIXED_TAX_IN_PRICES_TITLE', 'Stała stawka podatkowa	');
define('RCS_FIXED_TAX_RATE_TITLE', 'Wyniki raportu sprzedaży dni	');
define('RCS_EMAIL_TTL_TITLE', 'Czas wysłania wiadomości e-mail');
define('RCS_EMAIL_FRIENDLY_TITLE', 'Przyjazne e-maile');
define('RCS_EMAIL_COPIES_TO_TITLE', 'E-mail Kopiuje do');
define('RCS_SHOW_ATTRIBUTES_TITLE', 'Pokaż atrybuty');
define('RCS_CHECK_SESSIONS_TITLE', 'Ignoruj klientów podczas sesji');
define('RCS_CURCUST_COLOR_TITLE', 'Obecny klient');
define('RCS_UNCONTACTED_COLOR_TITLE', 'Bezkontaktowy Hilight');
define('RCS_CONTACTED_COLOR_TITLE', "Skontaktowałem się z Hilight");
define('RCS_MATCHED_ORDER_COLOR_TITLE', "Odpowiednia kolejność światła");
define('RCS_SKIP_MATCHED_CARTS_TITLE', 'Pomiń wpisy z pasującymi zamówieniami');
define("RCS_AUTO_CHECK_TITLE", 'Automatyczne sprawdzanie „bezpiecznych” koszyków na e-mail');
define('RCS_CARTS_MATCH_ALL_DATES_TITLE', 'Dopasuj zamówienia z dowolnej daty');
define('RCS_PENDING_SALE_STATUS_TITLE', 'Oczekujące statusy sprzedaży');
define('RCS_REPORT_EVEN_STYLE_TITLE', 'Zgłoś parzysty styl wiersza');
define('RCS_REPORT_ODD_STYLE_TITLE', 'Zgłoś styl wierszy nieparzystych');

define('DEFAULT_DATE_FORMAT_TITLE', "Domyślny tytuł formatu daty");

define('DISPLAY_PRICE_WITH_TAX_CHECKOUT_TITLE', 'Oblicz podatek w kasie');

define('SET_JIVOSITE_TITLE', 'Włącz lub wyłącz JivoSite');
define('INSTAGRAM_LINK_SLIDE_TITLE', 'Slajd linku do Instagrama');

define('STORE_BANK_INFO_TITLE', 'Informacje bankowe do faktury');

define('JIVOSITE_WIDGET_ID_TITLE', 'Identyfikator widżetu JivoSite');
define('STORE_SCRIPTS_TITLE', 'W tym niestandardowy JS');
define('STORE_METAS_TITLE', 'Zawiera niestandardowe metatagi w head');
define('STORE_TIME_ZONE_TITLE', 'Strefa czasowa');
define('CHANGE_BY_GEOLOCATION_TITLE', 'Zmiana waluty i języka w zależności od geolokalizacji');
define('GET_BROWSER_LANGUAGE_TITLE', 'Przełącz witrynę na język przeglądarki');
define('DOMEN_URL_TITLE', 'Adres domeny');
define('DOMEN_URL_DESC', 'Możesz ustawić własną nazwę domeny');
define('STOCK_ALLOW_CHECKOUT_WITH_ATTR_COUNT_0_TITLE', 'Pozwól kupować z 0 w atrybutach produktu');
define('STOCK_ALLOW_CHECKOUT_WITH_ATTR_COUNT_0_DESC', 'Zezwalaj na zakup, gdy ilość wynosi 0 w atrybutach produktu');
define('SSL_EXIST', 'Wystawiono certyfikat');
define('SSL_NON_EXIST', 'Wydaj certyfikat');
define('SSL_ARE_YOU_SURE', 'Rozpocznie się generowanie osobistego certyfikatu SSL dla domeny. Czy na pewno?');
define('QUICK_ORDER_ENABLED_TITLE', 'Przycisk szybkiego zamówienia');
