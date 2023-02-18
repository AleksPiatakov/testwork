<?php
/*
  $Id: configuration.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('TABLE_HEADING_CONFIGURATION_TITLE', 'Název');
define('TABLE_HEADING_CONFIGURATION_VALUE', 'Hodnota');
define('TABLE_HEADING_CONFIGURATION_SHOW_FIELD', 'Zobrazit pole');
define('TABLE_HEADING_CONFIGURATION_REQUIRED_VALUE', 'Požadované');
define('TABLE_HEADING_ACTION', 'Akce');

define('TEXT_INFO_EDIT_INTRO', 'Proveďte prosím potřebné změny');
define('TEXT_SAVE_BUTTON', 'Uložit');
define('TEXT_CANCEL_BUTTON', 'Zrušit');
define('TEXT_CLOSE_BUTTON', 'Zavřít');
define('TEXT_INFO_DATE_ADDED', 'Datum přidání:');
define('TEXT_INFO_LAST_MODIFIED', 'Poslední úprava:');
define('ERROR_TEMPLATE_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Do adresáře nelze zapisovat. Změňte oprávnění.');
define('ERROR_TEMPLATE_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Adresář neexistuje.');
define('GOOGLE_SITE_VERIFICATION_KEY_TITLE','Ověřovací klíč webu Google');
// Мой магазин
define('TELEGRAM_BOT_TOKEN_TITLE' , 'Token telegramového bota');
define('TELEGRAM_BOT_ENABLE_TITLE' , 'Povolení telegramového robota');
define('ONEPAGE_ADDRESS_TYPE_POSITION_TITLE' , 'Objednávka adresy');
define('REVIEWS_WRITE_ACCESS_TITLE' , 'Povolit pouze registrovaným uživatelům psát recenze');
define('MYSQL_PERFORMANCE_TRESHOLD_TITLE' , 'Čas záznamu výkonu MySQL "od"');
define('MINIFY_CSSJS_TITLE' , 'Minifikovat CSS a JS?');
define('MENU_LOCATION_TITLE' , 'Umístění nabídky administrátora: ');
define('MENU_TOP_LOCATION' , 'Nahoře');
define('MENU_LEFT_LOCATION' , 'Vlevo');
define('MENU_LEFT_MIN_LOCATION' , 'Levá sbalená');
define('MINIFY_CSSJS_0_TITLE' , 'Neminifikovat');
define('MINIFY_CSSJS_1_TITLE' , 'Minifikujte nyní');
define('MINIFY_CSSJS_2_TITLE' , 'Použít minifikovaný soubor');
define('IMAGE_CACHE_TITLE', 'Změnit IMAGE_CACHE');
define('IMAGE_CACHE_0_TITLE', 'Vypnout');
define('IMAGE_CACHE_1_TITLE', 'Povolit');
define('SEO_URLS_CACHE_RESET_TITLE', 'Resetovat mezipaměť pro SEO URL');
//define('ALLOW_AUTOLOGON_TITLE', 'Povolit automatické přihlášení');
define('DEFAULT_TEMPLATE_TITLE', 'Výchozí motiv');
define('LOGO_IMAGE_TITLE' , 'Logo společnosti');
define('FAVICON_IMAGE_TITLE','Favicon');
define ('USE_CRITICAL_CSS_TITLE', 'Použít kritické CSS?');
define('WATER_MARK_TITLE','Vodoznak');
define('STORE_NAME_TITLE', 'Název obchodu');
//define('MULTICOLOR_NAME_TITLE' , 'Název atributu (MULTICOLOR)');
define('STORE_OWNER_TITLE', 'Vlastník obchodu');
define('STORE_ADDRESS_TITLE' , 'Adresa obchodu');
define('STORE_LOGO_TITLE', 'Logo obchodu');
define('STORE_OWNER_EMAIL_ADDRESS_TITLE', 'E-mailová adresa');
define('STORE_OWNER_ICQ_NUMBER_TITLE' , 'Číslo ICQ');
define('EMAIL_FROM_TITLE', 'E-mail od');
define('STORE_COUNTRY_TITLE', 'Země');
define('STORE_ZONE_TITLE', 'Zóna');
define('EXPECTED_PRODUCTS_SORT_TITLE', 'Očekávané pořadí řazení');
define('EXPECTED_PRODUCTS_FIELD_TITLE', 'Očekávané pole řazení');
define('USE_DEFAULT_LANGUAGE_CURRENCY_TITLE', 'Přepnout na výchozí jazykovou měnu');
define('SEARCH_ENGINE_FRIENDLY_URLS_TITLE', 'Používejte bezpečné adresy URL pro vyhledávače (stále ve vývoji)');
define('DISPLAY_CART_TITLE', 'Zobrazit košík po přidání produktu');
define('ALLOW_GUEST_TO_TELL_A_FRIEND_TITLE', 'Povolit hostu, aby to řekl příteli');
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_TITLE', 'Výchozí operátor vyhledávání');
define('STORE_NAME_ADDRESS_TITLE', 'Adresa obchodu a telefon');
define('ALLOW_CATEGORY_DESCRIPTIONS_TITLE', 'Povolit popisy kategorií');
define('TAX_DECIMAL_PLACES_TITLE', 'Daňová desetinná místa');
define('SHOW_MAIN_FEATURED_PRODUCTS_TITLE', 'Zobrazit doporučené produkty na hlavní stránce');
define('DISPLAY_PRICE_WITH_TAX_TITLE', 'Zobrazit ceny s daní');
define('XPRICES_NUM_TITLE' , 'Počet cen za produkty');
define('SEO_FILTER_TITLE' , 'Povolit SEO filtry');
//define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_TITLE', 'Částka dárkového poukazu na uvítanou');
define('ALLOW_GUEST_TO_SEE_PRICES_TITLE' , 'Umožnit hostům vidět ceny');
//define('NEW_SIGNUP_DISCOUNT_COUPON_TITLE', 'Uvítací kód slevového kupónu');
define('GUEST_DISCOUNT_TITLE' , 'Sleva pro hosty');
define('CATEGORIES_SORT_ORDER_TITLE' , 'Pořadí zobrazení kategorií/produktů');
define('QUICKSEARCH_IN_DESCRIPTION_TITLE' , 'Hledat v popisu produktů');
define('SET_HTTPS_TITLE' , 'Zapnout HTTPS?');
//define('ALLOW_GIFT_VOUCHERS_TITLE' , 'Povolit dárkové poukazy a kupony');
define('ALLOW_ATTRIBUTES_IN_PRODUCT_EDIT_PAGE_TITLE' , 'Povolit atributy na stránce úprav produktu');
define('SHOW_SUBCATEGORIES_WHEN_CATEGORIES_HAS_PRODUCTS_TITLE' , 'Zobrazit podkategorie, pokud kategorie obsahuje produkty');
define('SHOW_PDF_DATASHEET_TITLE' , 'Datový list PDF');

// Минимальнаые значения

define('ENTRY_FIRST_NAME_MIN_LENGTH_TITLE', 'Jméno');
define('ENTRY_LAST_NAME_MIN_LENGTH_TITLE', 'Příjmení');
define('ENTRY_DOB_MIN_LENGTH_TITLE', 'Datum narození');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_TITLE', 'E-mailová adresa');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_TITLE', 'Adresa ulice');
define('ENTRY_COMPANY_MIN_LENGTH_TITLE', 'Společnost');
define('ENTRY_POSTCODE_MIN_LENGTH_TITLE', 'PSČ');
define('ENTRY_CITY_MIN_LENGTH_TITLE', 'Město');
define('ENTRY_STATE_MIN_LENGTH_TITLE', 'Stát');
define('ENTRY_TELEPHONE_MIN_LENGTH_TITLE', 'Telefonní číslo');
define('ENTRY_PASSWORD_MIN_LENGTH_TITLE', 'Heslo');
define('CC_OWNER_MIN_LENGTH_TITLE', 'Jméno vlastníka kreditní karty');
define('CC_NUMBER_MIN_LENGTH_TITLE', 'Číslo kreditní karty');
define('REVIEW_TEXT_MIN_LENGTH_TITLE', 'Text recenze');
define('MIN_DISPLAY_BESTSELLERS_TITLE', 'Nejprodávanější');
define('MIN_DISPLAY_ALSO_PURCHASED_TITLE', 'Také zakoupeno');
define('MIN_DISPLAY_XSELL_TITLE', 'X-Sell');
define('MIN_ORDER_TITLE' , 'Minimální částka objednávky');
define('MAIN_COLOR_TITLE' , 'Hlavní barva webu');
define('SECOND_COLOR_TITLE' , 'Druhá barva webu');
define('BACKGROUND_COLOR_TITLE' , 'Pozadí webu');

// Максимальные значения

define('MAX_PROD_ADMIN_SIDE_TITLE' , 'Produkty na stránku v admin');
define('MAX_ADDRESS_BOOK_ENTRIES_TITLE', 'Záznamy v adresáři');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE', 'Výsledky hledání');
define('MAX_DISPLAY_PAGE_LINKS_TITLE', 'Odkazy na stránky');
define('MAX_DISPLAY_SPECIAL_PRODUCTS_TITLE', 'Speciální produkty');
define('MAX_DISPLAY_NEW_PRODUCTS_TITLE', 'Modul nových produktů');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_TITLE', 'Očekávané produkty');
define('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST_TITLE', 'Seznam výrobců');
define('MAX_MANUFACTURERS_LIST_TITLE', 'Výběr velikosti výrobce');
define('MAX_DISPLAY_MANUFACTURER_NAME_LEN_TITLE', 'Délka názvu výrobce');
define('MAX_RANDOM_SELECT_NEW_TITLE', 'Výběr náhodných nových produktů');
define('MAX_RANDOM_SELECT_SPECIALS_TITLE', 'Výběr speciálních produktů');
define('MAX_DISPLAY_CATEGORIES_PER_ROW_TITLE', 'Výpis kategorií na řádek');
define('MAX_DISPLAY_PRODUCTS_NEW_TITLE', 'Výpis nových produktů');
define('MAX_DISPLAY_BESTSELLERS_TITLE', 'Nejprodávanější');
define('MAX_DISPLAY_ALSO_PURCHASED_TITLE', 'Také zakoupeno');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_TITLE', 'Pole historie objednávek zákazníka');
define('MAX_DISPLAY_ORDER_HISTORY_TITLE', 'Historie objednávek');
define('MAX_DISPLAY_FEATURED_PRODUCTS_TITLE', 'Maximální zobrazení produktu');
define('MAX_DISPLAY_FEATURED_PRODUCTS_LISTING_TITLE', 'Výsledky zobrazení doporučeného produktu');
define('SLIDER_HEIGHT_TITLE' , 'Výška posuvníku');

// Картинки

define('SMALL_IMAGE_WIDTH_TITLE', 'Malá šířka obrázku');
define('SMALL_IMAGE_HEIGHT_TITLE', 'Výška malého obrázku');
define('HEADING_IMAGE_WIDTH_TITLE', 'Šířka záhlaví obrázku');
define('HEADING_IMAGE_HEIGHT_TITLE', 'Výška záhlaví obrázku');
define('SUBCATEGORY_IMAGE_WIDTH_TITLE', 'Šířka obrázku podkategorie');
define('SUBCATEGORY_IMAGE_HEIGHT_TITLE', 'Výška obrázku podkategorie');
define('CONFIG_CALCULATE_IMAGE_SIZE_TITLE', 'Vypočítat velikost obrázku');
define('IMAGE_REQUIRED_TITLE', 'Vyžadován obrázek');
define('ULTIMATE_ADDITIONAL_IMAGES_TITLE', 'Povolit další obrázky?');
define('ULT_THUMB_IMAGE_WIDTH_TITLE', 'Další šířka palce');
define('ULT_THUMB_IMAGE_HEIGHT_TITLE', 'Další výška palce');
define('MEDIUM_IMAGE_WIDTH_TITLE', 'Střední šířka obrázku');
define('MEDIUM_IMAGE_HEIGHT_TITLE', 'Střední výška obrázku');
define('LARGE_IMAGE_WIDTH_TITLE', 'Velká šířka obrázku (vyskakovací okno)');
define('LARGE_IMAGE_HEIGHT_TITLE', 'Výška velkého obrázku (vyskakovací okno)');

// Данные покупателя

define('ACCOUNT_GENDER_TITLE', 'Pohlaví');
define('ACCOUNT_DOB_TITLE', 'Datum narození');
define('ACCOUNT_COMPANY_TITLE', 'Společnost');
define('ACCOUNT_SUBURB_TITLE', 'Předměstí');
define('ACCOUNT_STATE_TITLE', 'State');
define('ACCOUNT_STREET_ADDRESS_TITLE' , 'Adresa ulice');
define('ACCOUNT_CITY_TITLE' , 'Město');
define('ACCOUNT_POSTCODE_TITLE' , 'PSČ/PSČ');
define('ACCOUNT_COUNTRY_TITLE' , 'Země');
define('ACCOUNT_TELE_TITLE' , 'Telefon');
define('ACCOUNT_FAX_TITLE' , 'Fax');
define('ACCOUNT_LAST_NAME_TITLE' , 'Příjmení');
define('ACCOUNT_NEWS_TITLE' , 'Newsletter');

// Доставка/упаковка

define('SHIPPING_ORIGIN_COUNTRY_TITLE', 'Země původu');
define('SHIPPING_ORIGIN_ZIP_TITLE', 'PSČ');
define('SHIPPING_MAX_WEIGHT_TITLE', 'Zadejte maximální hmotnost balíku, který budete odesílat');
define('SHIPPING_BOX_WEIGHT_TITLE', 'Tárová hmotnost balíku.');
define('SHIPPING_BOX_PADDING_TITLE', 'Větší balíky - procentuální nárůst.');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_TITLE', 'Povolit dopravu zdarma');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_TITLE', 'Doprava zdarma pro objednávky nad');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_TITLE', 'Poskytnout dopravu zdarma pro provedené objednávky');
define('SHOW_SHIPPING_ESTIMATOR_TITLE', 'Odhad dodávky');

// Вывод товара

define('PRODUCT_LISTING_DISPLAY_STYLE_TITLE' , 'Typ výpisu produktu');
define('PRODUCT_LIST_IMAGE_TITLE' , 'Zobrazit obrázek produktu');
define('PRODUCT_LIST_MANUFACTURER_TITLE', 'Zobrazte jméno výrobce produktu');
define('PRODUCT_LIST_MODEL_TITLE', 'Zobrazení modelu produktu');
define('PRODUCT_LIST_NAME_TITLE', 'Zobrazený název produktu');
define('PRODUCT_LIST_PRICE_TITLE', 'Zobrazená cena produktu');
define('PRODUCT_LIST_QUANTITY_TITLE', 'Zobrazit množství produktu');
define('PRODUCT_LIST_WEIGHT_TITLE', 'Zobrazení hmotnosti produktu');
define('PRODUCT_LIST_BUY_NOW_TITLE', 'Zobrazit sloupec Koupit');
define('PRODUCT_LIST_FILTER_TITLE', 'Zobrazit odkaz na PDF');
define('PREV_NEXT_BAR_LOCATION_TITLE', 'Umístění předchozí/následující navigační lišty (1-nahoře, 2-dole, 3-obě)');
define('PRODUCT_LIST_INFO_TITLE' , 'Zobrazit krátký popis');
define('PRODUCT_SORT_ORDER_TITLE' , 'Zobrazení pořadí řazení');

// Склад

define('STOCK_CHECK_TITLE', 'Kontrola stavu zásob');
define('STOCK_SHOW_BUY_BUTTON_TITLE' , 'Zobrazit tlačítko Koupit, pokud položka chybí');
define('STOCK_LIMITED_TITLE', 'Odečíst zásoby');
define('STOCK_ALLOW_CHECKOUT_TITLE', 'Povolit pokladnu');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_TITLE', 'Označit produkt není skladem');
define('STOCK_REORDER_LEVEL_TITLE', 'Úroveň opětovného objednání zásob');

// Логи

define('STORE_PAGE_PARSE_TIME_TITLE', 'Store Page Parse Time');
define('STORE_PAGE_PARSE_TIME_LOG_TITLE', 'Zaznamenat cíl');
define('STORE_PARSE_DATE_TIME_FORMAT_TITLE', 'Formát data protokolu');
define('DISPLAY_PAGE_PARSE_TIME_TITLE', 'Zobrazit čas analýzy stránky');
define('STORE_DB_TRANSACTIONS_TITLE', 'Dotazy na databázi obchodů');

// Кэш

define('USE_CACHE_TITLE', 'Použít mezipaměť');
define('DIR_FS_CACHE_TITLE', 'Adresář mezipaměti');

// Настройка E-mail

define('EMAIL_TRANSPORT_TITLE', 'Způsob přenosu e-mailem');
define('EMAIL_LINEFEED_TITLE', 'E-mailové řádky');
define('EMAIL_USE_HTML_TITLE', 'Použít MIME HTML při odesílání e-mailů');
define('ENTRY_EMAIL_ADDRESS_CHECK_TITLE', 'Ověření e-mailových adres prostřednictvím DNS');
define('SEND_EMAILS_TITLE', 'Odeslat e-maily');

// Скачивание

define('DOWNLOAD_ENABLED_TITLE', 'Povolit stahování');
define('DOWNLOAD_BY_REDIRECT_TITLE', 'Stažení přesměrováním');
define('DOWNLOAD_MAX_DAYS_TITLE', 'Prodleva vypršení platnosti (dny)');
define('DOWNLOAD_MAX_COUNT_TITLE', 'Maximální počet stažení');
define('DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE_TITLE', 'Stažení hodnoty stavu aktualizace řadiče');
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG_TITLE', 'Stažení zprávy o pozastavení stahování ovladače');
define('DOWNLOADS_CONTROLLER_ORDERS_STATUS_TITLE', 'Stažení hodnoty stavu objednávky řadiče');

// GZip Компрессия

define('GZIP_COMPRESSION_TITLE', 'Povolit kompresi GZip');
define('GZIP_LEVEL_TITLE', 'Úroveň komprese');

// Сессии

define('SESSION_WRITE_DIRECTORY_TITLE', 'Adresář relace');
define('SESSION_FORCE_COOKIE_USE_TITLE', 'Vynutit používání souborů cookie');
define('SESSION_CHECK_SSL_SESSION_ID_TITLE', 'Zkontrolujte ID relace SSL');
define('SESSION_CHECK_USER_AGENT_TITLE', 'Zkontrolovat uživatelského agenta');
define('SESSION_CHECK_IP_ADDRESS_TITLE', 'Zkontrolujte IP adresu');
define('SESSION_BLOCK_SPIDERS_TITLE', 'Zabránit Spider Sessions');
define('SESSION_RECREATE_TITLE', 'Znovu vytvořit relaci');

// Tех. обслуживание

define('DOWN_FOR_MAINTENANCE_TITLE', 'Dolů kvůli údržbě: ON/OFF');
define('DOWN_FOR_MAINTENANCE_FILENAME_TITLE', 'Skončeno kvůli údržbě: název_souboru');
define('DOWN_FOR_MAINTENANCE_HEADER_OFF_TITLE', 'Dolů kvůli údržbě: Skrýt záhlaví');
define('DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF_TITLE', 'Dolů pro údržbu: Skrýt sloupec vlevo');
define('DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF_TITLE', 'Dolů pro údržbu: Skrýt sloupec vpravo');
define('DOWN_FOR_MAINTENANCE_FOOTER_OFF_TITLE', 'Dolů kvůli údržbě: Skrýt zápatí');
define('DOWN_FOR_MAINTENANCE_PRICES_OFF_TITLE', 'Dole kvůli údržbě: Skrýt ceny');
define('EXCLUDE_ADMIN_IP_FOR_MAINTENANCE_TITLE', 'Ukončeno kvůli údržbě (vyloučit tuto IP-adresu)');
define('WARN_BEFORE_DOWN_FOR_MAINTENANCE_TITLE', 'UPOZORNĚNÍ VEŘEJNOSTI, než půjdete dolů kvůli údržbě: ON/OFF');
define('PERIOD_BEFORE_DOWN_FOR_MAINTENANCE_TITLE', 'Datum a hodiny upozornění před údržbou');
define('DISPLAY_MAINTENANCE_TIME_TITLE', 'Zobrazit, když webmaster povolil údržbu');
define('DISPLAY_MAINTENANCE_PERIOD_TITLE', 'Období údržby webové stránky');
define('TEXT_MAINTENANCE_PERIOD_TIME_TITLE', 'Období údržby webových stránek');

// Обновление прайса

define('DISPLAY_MODEL_TITLE' , 'Zobrazit model');
define('MODIFY_MODEL_TITLE' , 'Upravit model');
define('MODIFY_NAME_TITLE' , 'Upravte názvy produktů');
define('DISPLAY_STATUT_TITLE' , 'Upravit statut produktů');
define('DISPLAY_WEIGHT_TITLE' , 'Upravte hmotnost produktů');
define('DISPLAY_QUANTITY_TITLE' , 'Upravte množství produktů');
define('DISPLAY_SORT_ORDER_TITLE' , 'Zobrazit pořadí řazení');
define('DISPLAY_ORDER_MIN_TITLE' , 'Zobrazit min');
define('DISPLAY_ORDER_UNITS_TITLE' , 'Zobrazte jednotky');
define('DISPLAY_IMAGE_TITLE' , 'Upravit obrázek produktů');
define('DISPLAY_MANUFACTURER_TITLE' , 'Zobrazit výrobce');
define('MODIFY_MANUFACTURER_TITLE' , 'Upravit výrobce produktů');
define('DISPLAY_TAX_TITLE' , 'Zobrazit daň');
define('MODIFY_TAX_TITLE' , 'Upravit třídu daně produktů');
define('DISPLAY_TVA_OVER_TITLE' , 'Zobrazená cena včetně všech daní');
define('DISPLAY_TVA_UP_TITLE' , 'Zobrazená cena se vším včetně daně');
define('DISPLAY_PREVIEW_TITLE' , 'Zobrazit odkaz na stránku s informacemi o produktech');
define('DISPLAY_EDIT_TITLE' , 'Zobrazte odkaz na stránku, kde budete moci upravovat produkt');
define('ACTIVATE_COMMERCIAL_MARGIN_TITLE' , 'Aktivujte nebo deaktivujte obchodní marži');

// Отложенные товары

define('MAX_DISPLAY_WISHLIST_PRODUCTS_TITLE' , 'Maximální seznam přání');
define('MAX_DISPLAY_WISHLIST_BOX_TITLE' , 'Maximální seznam přání');
define('DISPLAY_WISHLIST_EMAILS_TITLE' , 'Zobrazit e-maily');
define('WISHLIST_REDIRECT_TITLE' , 'Přesměrování seznamu přání');

// Кэш страниц

define('ENABLE_PAGE_CACHE_TITLE' , 'Povolit mezipaměť stránek');
define('PAGE_CACHE_LIFETIME_TITLE' , 'Životnost mezipaměti');
define('PAGE_CACHE_DEBUG_MODE_TITLE' , 'Zapnout režim ladění?');
define('PAGE_CACHE_DISABLE_PARAMETERS_TITLE' , 'Zakázat parametry URL?');
define('PAGE_CACHE_DELETE_FILES_TITLE' , 'Smazat soubory mezipaměti?');
define('PAGE_CACHE_UPDATE_CONFIG_FILES_TITLE' , 'Konfigurační soubor aktualizace mezipaměti?');

// Яндекс маркет

define('YML_NAME_TITLE' , 'Název obchodu');
define('YML_COMPANY_TITLE' , 'Vlastník obchodu');
define('YML_DELIVERYINCLUDED_TITLE' , 'Včetně dodávky');
define('YML_AVAILABLE_TITLE' , 'Dostupnost produktu');
define('YML_AUTH_USER_TITLE' , 'Přihlášení');
define('YML_AUTH_PW_TITLE' , 'Heslo');
define('YML_REFERER_TITLE' , 'Referer');
define('YML_STRIP_TAGS_TITLE' , 'Strip tagy');
define('YML_UTF8_TITLE' , 'Kódovat do UTF-8');

// Описание полей

// Мой магазин

define('DEFAULT_TEMPLATE_DESC', 'Použijte k nastavení výchozího motivu.');
define('STORE_NAME_DESC', 'Název mého obchodu');
define('STORE_OWNER_DESC', 'Jméno vlastníka mého obchodu');
define('STORE_LOGO_DESC', 'Toto je logo mého obchodu');
define('STORE_OWNER_EMAIL_ADDRESS_DESC', 'E-mailová adresa majitele mého obchodu');
define('STORE_OWNER_ICQ_NUMBER_DESC', 'Číslo ICQ se zobrazí v postranním poli nápovědy.');
define('EMAIL_FROM_DESC', 'E-mailová adresa používaná v (odesílaných) e-mailech');
define('STORE_COUNTRY_DESC', 'Země, ve které se nachází můj obchod <br><br><b>Poznámka: Nezapomeňte prosím aktualizovat zónu obchodu.</b>');
define('STORE_ZONE_DESC', 'Zóna, ve které se nachází můj obchod');
define('EXPECTED_PRODUCTS_SORT_DESC', 'Toto je pořadí řazení použité v poli očekávaných produktů.');
define('EXPECTED_PRODUCTS_FIELD_DESC', 'Sloupec, podle kterého se má třídit v poli očekávaných produktů.');
define('USE_DEFAULT_LANGUAGE_CURRENCY_DESC', 'Automaticky přepnout na měnu jazyka, když se změní');
define('SEARCH_ENGINE_FRIENDLY_URLS_DESC', 'Použít bezpečné adresy URL vyhledávače pro všechny odkazy na stránky');
define('DISPLAY_CART_DESC', 'Zobrazte nákupní košík po přidání produktu (nebo se vraťte zpět k jeho původu)');
define('ALLOW_GUEST_TO_TELL_A_FRIEND_DESC', 'Umožněte hostům říci přátelům o produktu');
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_DESC', 'Výchozí vyhledávací operátory');
define('STORE_NAME_ADDRESS_DESC', 'Toto je název obchodu, adresa a telefon používaný na tisknutelných dokumentech a zobrazený online');
define('SHOW_COUNTS_DESC', 'Rekurzivně spočítejte, kolik produktů je v každé kategorii');
define('ALLOW_CATEGORY_DESCRIPTIONS_DESC', 'Povolit použití plných textových popisů pro kategorie');
define('TAX_DECIMAL_PLACES_DESC', 'Doplňte daňovou hodnotu o toto množství desetinných míst');
define('SHOW_MAIN_FEATURED_PRODUCTS_DESC', 'true - Povolit<br>false - Zakázat');
define('DISPLAY_PRICE_WITH_TAX_DESC', 'Zobrazit ceny s daní (true) nebo přidat daň na konec (false)');
define('XPRICES_NUM_DESC', 'Počet cen za produkty<br><br><b>UPOZORNĚNÍ: Změnou této hodnoty smažete položku cen v tabulce produktů!</b><br><br><b>Všechny skupiny, které použít smazanou cenu použije výchozí cenu produktu.</b>');
define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_DESC', 'Částka dárkového poukazu na uvítanou: Pokud si nepřejete zasílat dárkový poukaz v e-mailu pro vytvoření účtu, zadejte 0 pro žádnou částku, pokud zde částku uvedete, tj. 10,00 nebo 50,00 bez označení měny');
define('ALLOW_GUEST_TO_SEE_PRICES_DESC', 'Povolit hostům zobrazit výchozí ceny');
define('NEW_SIGNUP_DISCOUNT_COUPON_DESC', 'Vítejte kód slevového kupónu: pokud nechcete posílat kupón v e-mailu pro vytvoření účtu, ponechte prázdné, jinak vložte kód kupónu, který chcete použít');
define('GUEST_DISCOUNT_DESC', 'Sleva pro hosty.');
define('CATEGORIES_SORT_ORDER_DESC', '<b>Platné objednávky:<br>název_produktu<br>název_produktu-desc<br>model<br>popis modelu</b>');
define('QUICKSEARCH_IN_DESCRIPTION_DESC', 'Pokud je nastaveno na TRUE, zákazník může vyhledávat v popisech, jinak je vyhledávání omezeno na název produktu');
define('ALLOW_GIFT_VOUCHERS_DESC', 'Povolit - pravda<br>Zakázat - nepravda.');
define('SET_HTTPS_DESC' ,'HTTP nebo HTTPS');
define('ALLOW_ATTRIBUTES_IN_PRODUCT_EDIT_PAGE_DESC', 'Povolit - pravda<br>Zakázat - nepravda.');
define('SHOW_SUBCATEGORIES_WHEN_CATEGORIES_HAS_PRODUCTS_DESC', 'Zobrazit podkategorie, když kategorie obsahuje produkty.');
define('SHOW_PDF_DATASHEET_DESC', 'Povolit - pravda<br>Zakázat - nepravda.');

// Минимальнаые значения

define('ENTRY_FIRST_NAME_MIN_LENGTH_DESC', 'Minimální délka křestního jména');
define('ENTRY_LAST_NAME_MIN_LENGTH_DESC', 'Minimální délka příjmení');
define('ENTRY_DOB_MIN_LENGTH_DESC', 'Minimální délka data narození');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_DESC', 'Minimální délka e-mailové adresy');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_DESC', 'Minimální délka adresy');
define('ENTRY_COMPANY_MIN_LENGTH_DESC', 'Minimální délka názvu společnosti');
define('ENTRY_POSTCODE_MIN_LENGTH_DESC', 'Minimální délka PSČ');
define('ENTRY_CITY_MIN_LENGTH_DESC', 'Minimální délka města');
define('ENTRY_STATE_MIN_LENGTH_DESC', 'Minimální délka stavu');
define('ENTRY_TELEPHONE_MIN_LENGTH_DESC', 'Minimální délka telefonního čísla');
define('ENTRY_PASSWORD_MIN_LENGTH_DESC', 'Minimální délka hesla');
define('CC_OWNER_MIN_LENGTH_DESC', 'Minimální délka jména vlastníka kreditní karty');
define('CC_NUMBER_MIN_LENGTH_DESC', 'Minimální délka čísla kreditní karty');
define('REVIEW_TEXT_MIN_LENGTH_DESC', 'Minimální délka textu recenze');
define('MIN_DISPLAY_BESTSELLERS_DESC', 'Minimální počet bestsellerů k zobrazení');
define('MIN_DISPLAY_ALSO_PURCHASED_DESC', 'Minimální počet produktů k zobrazení v poli \'Tento zákazník také zakoupil\'');
define('MIN_DISPLAY_XSELL_DESC', 'Minimální počet X-sell produktů k zobrazení');
define('MIN_ORDER_DESC', 'Minimální částka objednávky.');

// Максимальные значения

define('MAX_PROD_ADMIN_SIDE_DESC', 'Maximální počet produktů na stránku v admin');
define('MAX_ADDRESS_BOOK_ENTRIES_DESC', 'Maximální počet položek v adresáři, které může zákazník mít');
define('MAX_DISPLAY_SEARCH_RESULTS_DESC', 'Počet produktů k seznamu');
define('MAX_DISPLAY_PAGE_LINKS_DESC', 'Počet \'číslo\' odkazů používaných pro sady stránek');
define('MAX_DISPLAY_SPECIAL_PRODUCTS_DESC', 'Maximální počet speciálních produktů k zobrazení');
define('MAX_DISPLAY_NEW_PRODUCTS_DESC', 'Maximální počet nových produktů k zobrazení v kategorii');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_DESC', 'Očekávaný maximální počet produktů k zobrazení');
define('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST_DESC', 'Používá se v poli výrobců; když počet výrobců překročí toto číslo, místo výchozího seznamu se zobrazí rozbalovací seznam');
define('MAX_MANUFACTURERS_LIST_DESC', 'Použito v poli výrobců; když je tato hodnota \'1\', použije se pro pole výrobců klasický rozevírací seznam. V opačném případě se zobrazí seznam se zadaným počtem řádků .');
define('MAX_DISPLAY_MANUFACTURER_NAME_LEN_DESC', 'Použito v poli výrobců; maximální délka jména výrobce k zobrazení');
define('MAX_RANDOM_SELECT_NEW_DESC', 'Kolik záznamů vybrat pro výběr jednoho náhodného nového produktu k zobrazení');
define('MAX_RANDOM_SELECT_SPECIALS_DESC', 'Kolik záznamů vybrat pro výběr jednoho náhodného speciálního produktu k zobrazení');
define('MAX_DISPLAY_CATEGORIES_PER_ROW_DESC', 'Kolik kategorií vypsat na řádek');
define('MAX_DISPLAY_PRODUCTS_NEW_DESC', 'Maximální počet nových produktů k zobrazení na stránce nových produktů');
define('MAX_DISPLAY_BESTSELLERS_DESC', 'Maximální počet nejprodávanějších k zobrazení');
define('MAX_DISPLAY_ALSO_PURCHASED_DESC', 'Maximální počet produktů k zobrazení v poli \'Tento zákazník také zakoupil\'');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_DESC', 'Maximální počet produktů k zobrazení v poli historie objednávek zákazníka');
define('MAX_DISPLAY_ORDER_HISTORY_DESC', 'Maximální počet objednávek k zobrazení na stránce historie objednávek');
define('MAX_DISPLAY_FEATURED_PRODUCTS_DESC', 'Počet produktů na hlavní stránku');
define('MAX_DISPLAY_FEATURED_PRODUCTS_LISTING_DESC', 'Počet produktů k seznamu na stránce');

// Картинки

define('SMALL_IMAGE_WIDTH_DESC', 'Šířka malých obrázků v pixelech');
define('SMALL_IMAGE_HEIGHT_DESC', 'Výška malých obrázků v pixelech');
define('HEADING_IMAGE_WIDTH_DESC', 'Šířka obrázků nadpisů v pixelech');
define('HEADING_IMAGE_HEIGHT_DESC', 'Výška záhlaví obrázků v pixelech');
define('SUBCATEGORY_IMAGE_WIDTH_DESC', 'Šířka obrázků podkategorie v pixelech');
define('SUBCATEGORY_IMAGE_HEIGHT_DESC', 'Výška obrázků podkategorie v pixelech');
define('CONFIG_CALCULATE_IMAGE_SIZE_DESC', 'Vypočítat velikost obrázků?');
define('IMAGE_REQUIRED_DESC', 'Povolit zobrazení poškozených obrázků. Dobré pro vývoj.');
define('ULTIMATE_ADDITIONAL_IMAGES_DESC', 'Zobrazit další obrázky pod popisem produktu?');
define('ULT_THUMB_IMAGE_WIDTH_DESC', 'Šířka pixelů dalších miniaturních obrázků');
define('ULT_THUMB_IMAGE_HEIGHT_DESC', 'Výška dalších miniatur v pixelech');
define('MEDIUM_IMAGE_WIDTH_DESC', 'Šířka obrázků média v pixelech');
define('MEDIUM_IMAGE_HEIGHT_DESC', 'Výška obrazových bodů středních obrázků');
define('LARGE_IMAGE_WIDTH_DESC', 'Šířka pixelů velkých obrázků (vyskakovací)<br>(Použijte 0 pro nespecifickou velikost)');
define('LARGE_IMAGE_HEIGHT_DESC', 'Výška velkých obrázků v pixelech (vyskakovací okno)<br>(Použijte 0 pro nespecifickou velikost)');

// Данные покупателя

define('ACCOUNT_DOB_DESC', 'Zobrazení data narození v zákaznickém účtu');
define('ACCOUNT_COMPANY_DESC', 'Zobrazení společnosti v zákaznickém účtu');
define('ACCOUNT_SUBURB_DESC', 'Zobrazit předměstí v zákaznickém účtu');
define('ACCOUNT_STATE_DESC', 'Zobrazení stavu v zákaznickém účtu');
define('ACCOUNT_STREET_ADDRESS_DESC', 'Zobrazit adresu na stránce Vytvořit účet');
define('ACCOUNT_CITY_DESC', 'Zobrazit město na stránce Vytvořit účet');
define('ACCOUNT_POSTCODE_DESC', 'Zobrazit PSČ/PSČ na stránce Vytvořit účet');
define('ACCOUNT_COUNTRY_DESC', 'Zobrazená země na stránce Vytvořit účet');
define('ACCOUNT_TELE_DESC', 'Zobrazit telefon na stránce Vytvořit účet');
define('ACCOUNT_FAX_DESC', 'Zobrazit fax na stránce Vytvořit účet');
define('ACCOUNT_NEWS_DESC', 'Zobrazit newsletter na stránce Vytvořit účet');
define('ACCOUNT_LAST_NAME_DESC', 'Zobrazit příjmení na stránce Vytvořit účet');

// Доставка/упаковка

define('SHIPPING_ORIGIN_COUNTRY_DESC', 'Vyberte zemi původu, která bude použita v nabídkách dopravy.');
define('SHIPPING_ORIGIN_ZIP_DESC', 'Zadejte poštovní směrovací číslo (ZIP) obchodu, které bude použito v nabídkách přepravy.');
define('SHIPPING_MAX_WEIGHT_DESC', 'Dopravci mají maximální hmotnostní limit pro jeden balík. Toto je společné pro všechny.');
define('SHIPPING_BOX_WEIGHT_DESC', 'Jaká je hmotnost typického balení malých až středních balíků?');
define('SHIPPING_BOX_PADDING_DESC', 'Pro 10 % zadejte 10');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_DESC', 'Chcete povolit dopravu zdarma?');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_DESC', 'Poskytněte dopravu zdarma pro objednávky nad stanovenou částku.');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_DESC', 'Poskytněte dopravu zdarma pro objednávky odeslané na zadané místo určení.');
define('SHOW_SHIPPING_ESTIMATOR_DESC', 'Zobrazit odhad dopravy v nákupním košíku <br>true= vždy <br>false= pouze vyskakovací okno s tlačítkem');

// Вывод товара

define('PRODUCT_LISTING_DISPLAY_STYLE_DESC', 'Vyberte, který styl chcete použít k zobrazení vašich produktů na stránkách s produktovými informacemi.<br><br>Ať už zvolíte jakýkoli styl, ujistěte se, že jste nakonfigurovali vhodná nastavení pro vybraný styl výpisu .');
define('PRODUCT_LIST_IMAGE_DESC', 'Chcete zobrazit obrázek produktu?');
define('PRODUCT_LIST_MANUFACTURER_DESC', 'Chcete zobrazit název výrobce produktu?');
define('PRODUCT_LIST_MODEL_DESC', 'Chcete zobrazit model produktu?');
define('PRODUCT_LIST_NAME_DESC', 'Chcete zobrazit název produktu?');
define('PRODUCT_LIST_PRICE_DESC', 'Chcete zobrazit cenu produktu');
define('PRODUCT_LIST_QUANTITY_DESC', 'Chcete zobrazit množství produktu?');
define('PRODUCT_LIST_WEIGHT_DESC', 'Chcete zobrazit hmotnost produktu?');
define('PRODUCT_LIST_BUY_NOW_DESC', 'Chcete zobrazit sloupec Koupit?');
define('PRODUCT_LIST_FILTER_DESC', 'Chcete zobrazit filtr kategorie/výrobce?');
define('PREV_NEXT_BAR_LOCATION_DESC', 'Nastaví umístění předchozí/následující navigační lišty (1-nahoře, 2-dole, 3-obě)');
define('PRODUCT_LIST_INFO_DESC', 'Chcete zobrazit krátký popis?');
define('PRODUCT_SORT_ORDER_DESC', 'Chcete zobrazit pořadí řazení produktů?');

// Склад

define('STOCK_CHECK_DESC', 'Zkontrolujte, zda je dostatek zásob');
define('STOCK_LIMITED_DESC', 'Odečíst produkt na skladě od objednávek produktu');
define('STOCK_ALLOW_CHECKOUT_DESC', 'Umožněte zákazníkovi provést pokladnu, i když není dostatek zásob');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_DESC', 'Zobrazte něco na obrazovce, aby zákazník viděl, který produkt nemá dostatečné zásoby');
define('STOCK_REORDER_LEVEL_DESC', 'Definujte, kdy je třeba zásoby znovu objednat');

// Логи

define('STORE_PAGE_PARSE_TIME_DESC', 'Uložte čas potřebný k analýze stránky');
define('STORE_PAGE_PARSE_TIME_LOG_DESC', 'Adresář a název souboru časového protokolu analýzy stránky');
define('STORE_PARSE_DATE_TIME_FORMAT_DESC', 'Formát data');
define('DISPLAY_PAGE_PARSE_TIME_DESC', 'Zobrazit čas analýzy stránky (musí být povolen čas analýzy stránky úložiště)');
define('STORE_DB_TRANSACTIONS_DESC', 'Uložte databázové dotazy do protokolu času analýzy stránky (pouze PHP4)');

// Кэш

define('USE_CACHE_DESC', 'Použít funkce ukládání do mezipaměti');
define('DIR_FS_CACHE_DESC', 'Adresář, kde jsou uloženy soubory uložené v mezipaměti');

// Настройка E-mail
define('EMAIL_TRANSPORT_DESC', 'Definuje, zda tento server používá místní připojení k odesílání pošty nebo používá připojení SMTP přes TCP/IP. Servery běžící na Windows a MacOS by měly toto nastavení změnit na SMTP.');
define('EMAIL_LINEFEED_DESC', 'Definuje sekvenci znaků používanou k oddělení hlaviček pošty.');
define('EMAIL_USE_HTML_DESC','Posílat e-maily ve formátu HTML');
define('ENTRY_EMAIL_ADDRESS_CHECK_DESC', 'Ověřte e-mailovou adresu přes DNS server');
define('SEND_EMAILS_DESC', 'Posílejte e-maily');

// Скачивание

define('DOWNLOAD_ENABLED_DESC', 'Povolte funkce stahování produktů.');
define('DOWNLOAD_BY_REDIRECT_DESC', 'Použít pro stahování přesměrování prohlížeče. Zakázat na systémech mimo Unix.');
define('DOWNLOAD_MAX_DAYS_DESC', 'Nastavte počet dní, než vyprší platnost odkazu ke stažení. 0 znamená žádný limit.');
define('DOWNLOAD_MAX_COUNT_DESC', 'Nastavte maximální počet stahování. 0 znamená, že stahování není povoleno.');
define('DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE_DESC', 'Jaký stav orders_status resetuje dny stahování a maximální počet stažení - výchozí je 4');
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG_DESC', 'Stažení zprávy o pozastavení stahování ovladače');
define('DOWNLOADS_CONTROLLER_ORDERS_STATUS_DESC', 'Hodnota stavu objednávky řadiče ke stažení - Výchozí=2');

// GZip Компрессия

define('GZIP_COMPRESSION_DESC', 'Povolit HTTP GZip kompresi.');
define('GZIP_LEVEL_DESC', 'Použijte tuto úroveň komprese 0-9 (0 = minimum, 9 = maximum).');

// Сессии

define('SESSION_WRITE_DIRECTORY_DESC', 'Pokud jsou relace založeny na souborech, uložte je do tohoto adresáře.');
define('SESSION_FORCE_COOKIE_USE_DESC', 'Vynutit použití relací, když jsou povoleny pouze cookies.');
define('SESSION_CHECK_SSL_SESSION_ID_DESC', 'Ověřte SSL_SESSION_ID na každém požadavku zabezpečené stránky HTTPS.');
define('SESSION_CHECK_USER_AGENT_DESC', 'Ověřte uživatelského agenta prohlížeče klienta při každém požadavku na stránku.');
define('SESSION_CHECK_IP_ADDRESS_DESC', 'Ověřte IP adresu klienta při každém požadavku na stránku.');
define('SESSION_BLOCK_SPIDERS_DESC', 'Zabraňte známým pavoukům v zahájení relace.');
define('SESSION_RECREATE_DESC', 'Znovu vytvořte relaci pro vygenerování nového ID relace, když se zákazník přihlásí nebo vytvoří účet (je potřeba PHP >=4.1).');

// Tех. обслуживание

define('DOWN_FOR_MAINTENANCE_DESC', 'Neúdržba <br>(true=on false=off)');
define('DOWN_FOR_MAINTENANCE_FILENAME_DESC', 'Dolů pro soubor údržby Default=down_for_maintenance.php');
define('DOWN_FOR_MAINTENANCE_HEADER_OFF_DESC', 'Dolů pro údržbu: Skrýt záhlaví <br>(true=skrýt false=zobrazit)');
define('DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF_DESC', 'Dolů pro údržbu: Skrýt sloupec vlevo <br>(true=skrýt false=zobrazit)');
define('DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF_DESC', 'Dolů pro údržbu: Skrýt sloupec vpravo <br>(true=skrýt false=zobrazit)r');
define('DOWN_FOR_MAINTENANCE_FOOTER_OFF_DESC', 'Dole kvůli údržbě: Skrýt zápatí <br>(true=skrýt false=zobrazit)');
define('DOWN_FOR_MAINTENANCE_PRICES_OFF_DESC', 'Dole kvůli údržbě: Skrýt ceny <br>(true=skrýt false=zobrazit)');
define('EXCLUDE_ADMIN_IP_FOR_MAINTENANCE_DESC', 'Tato IP adresa má přístup k webu, když je mimo provoz (jako webmaster)');
define('WARN_BEFORE_DOWN_FOR_MAINTENANCE_DESC', 'Upozorněte na nějaký čas, než odstavíte svůj web z důvodu údržby<br>(true=on false=off)<br>Pokud nastavíte \'Spustit z důvodu údržby: ON/OFF\' na true toto bude automaticky aktualizováno na false');
define('PERIOD_BEFORE_DOWN_FOR_MAINTENANCE_DESC', 'Datum a hodiny pro upozornění před webovou stránkou údržby, zadejte datum a hodiny pro web údržby');
define('DISPLAY_MAINTENANCE_TIME_DESC', 'Zobrazí, když webmaster povolil údržbu <br>(true=on false=off)<br>');
define('DISPLAY_MAINTENANCE_PERIOD_DESC', 'Období údržby webové stránky <br>(true=on false=off)<br>');
define('TEXT_MAINTENANCE_PERIOD_TIME_DESC', 'Zadejte periodu údržby webu (hh:mm)');

// Обновление прайса

define('DISPLAY_MODEL_DESC', 'Povolit/zakázat zobrazení modelu');
define('MODIFY_MODEL_DESC', 'Povolit/zakázat modifikaci modelu');
define('MODIFY_NAME_DESC', 'Povolit/zakázat úpravu názvu?');
define('DISPLAY_STATUT_DESC', 'Povolit/zakázat zobrazení a úpravy Statutu');
define('DISPLAY_WEIGHT_DESC', 'Povolit/zakázat zobrazení a úpravy hmotnosti?');
define('DISPLAY_QUANTITY_DESC', 'Povolit/zakázat zobrazení a úpravu množství?');
define('DISPLAY_SORT_ORDER_DESC', 'Povolit/zakázat zobrazování a úpravy pořadí řazení?');
define('DISPLAY_ORDER_MIN_DESC', 'Povolit/zakázat zobrazení a úpravy Min?');
define('DISPLAY_ORDER_UNITS_DESC', 'Povolit/zakázat zobrazení a úpravy jednotek?');
define('DISPLAY_IMAGE_DESC', 'Povolit/zakázat zobrazování a úpravy obrázku?');
define('MODIFY_MANUFACTURER_DESC', 'Povolit/zakázat zobrazení a úpravy výrobce');
define('MODIFY_TAX_DESC', 'Povolit/zakázat třídu zobrazení a úprav daní');
define('DISPLAY_TVA_OVER_DESC', 'Povolit/zakázat zobrazování ceny se všemi daněmi, když je myš nad produktem');
define('DISPLAY_TVA_UP_DESC', 'Povolit/zakázat zobrazování ceny se všemi daněmi při zadávání ceny?');
define('DISPLAY_PREVIEW_DESC', 'Povolit/zakázat zobrazení odkazu na stránku s informacemi o produktech');
define('DISPLAY_EDIT_DESC', 'Povolit/zakázat zobrazení odkazu na stránku, kde budete moci produkt upravovat');
define('DISPLAY_MANUFACTURER_DESC', 'Chcete zobrazit pouze výrobce ?');
define('DISPLAY_TAX_DESC', 'Chcete pouze zobrazit daň?');
define('ACTIVATE_COMMERCIAL_MARGIN_DESC', 'Chcete aktivovat obchodní marži nebo ne?');

// Кэш страниц

define('ENABLE_PAGE_CACHE_DESC' , 'Povolit funkce mezipaměti stránek pro snížení zatížení serveru a rychlejší vykreslování stránek?');
define('PAGE_CACHE_LIFETIME_DESC' , 'Jak dlouho ukládat stránky do mezipaměti (v minutách)?');
define('PAGE_CACHE_DEBUG_MODE_DESC' , 'Zapnout výstup globálního ladění (umístěný v zápatí) ? To ovlivní VŠECHNY prohlížeče a NENÍ pro živé obchody! Režim ladění můžete zapnout POUZE pro svůj prohlížeč přidáním ?debug=1 do vaší adresy URL .');
define('PAGE_CACHE_DISABLE_PARAMETERS_DESC' , 'V některých případech (jako jsou adresy URL bezpečné pro vyhledávače) nebo velký počet affiliate doporučení způsobí nadměrné psaní stránek.');
define('PAGE_CACHE_DELETE_FILES_DESC' , 'Pokud je nastaveno na hodnotu true, další požadavek na stránku katalogu vymaže všechny soubory mezipaměti a poté znovu nastaví tuto hodnotu na false.');
define('PAGE_CACHE_UPDATE_CONFIG_FILES_DESC' , 'Pokud máte příspěvek konfigurační mezipaměti, zadejte ÚPLNOU cestu k aktualizačnímu souboru.');

// Яндекс маркет

define('YML_NAME_DESC' , 'Název obchodu pro Yandex-Market. Pokud je toto pole prázdné, použije se STORE_NAME.');
define('YML_COMPANY_DESC' , 'Vlastník obchodu pro Yandex-Market. Pokud je toto pole prázdné, použije se STORE_OWNER.');
define('YML_DELIVERYINCLUDED_DESC' , 'Včetně dodávky?');
define('YML_AVAILABLE_DESC' , 'Dostupnost produktu?');
define('YML_AUTH_USER_DESC' , 'Přihlášení do YML');
define('YML_AUTH_PW_DESC' , 'Heslo pro YML');
define('YML_REFERER_DESC' , 'Přidat odkaz na produktový odkaz (IP nebo uživatelský agent)?');
define('YML_STRIP_TAGS_DESC' , 'Odstranit html značky?');
define('YML_UTF8_DESC' , 'Kódovat do UTF-8?');

//Překontrolovat
define('ONEPAGE_CHECKOUT_ENABLED_TITLE', 'Povolit kontrolu jedné stránky');
define('ONEPAGE_ACCOUNT_CREATE_TITLE', 'Vytvoření účtu');
define('ONEPAGE_SHOW_CUSTOM_COLUMN_TITLE', 'Zobrazit vlastní pravý sloupec');
define('ONEPAGE_LOGIN_REQUIRED_TITLE', 'Vyžadovat přihlášení');
define('ONEPAGE_SHOW_OSC_COLUMNS_TITLE', 'Zobrazit sloupce Oscommerce');
define('ONEPAGE_BOX_ONE_HEADING_TITLE', 'Vlastní záhlaví sloupce č. 1');
define('ONEPAGE_BOX_ONE_CONTENT_TITLE', 'Vlastní obsah sloupce č. 1');
define('ONEPAGE_BOX_TWO_HEADING_TITLE', 'Vlastní pole sloupce č. 2 nadpis');
define('ONEPAGE_BOX_TWO_CONTENT_TITLE', 'Vlastní obsah sloupce č. 2');
define('ONEPAGE_DEBUG_EMAIL_ADDRESS_TITLE', 'Posílat ladicí emaily na:');
define('ONEPAGE_CHECKOUT_SHOW_ADDRESS_INPUT_FIELDS_TITLE', 'Zobrazit adresu ve vstupních polích');
define('ONEPAGE_CHECKOUT_LOADER_POPUP_TITLE', 'Vytvořit vyskakovací okno se zprávou zavaděče');
define('ONEPAGE_AUTO_SHOW_BILLING_SHIPPING_TITLE', 'Automaticky zobrazit fakturační/dopravní moduly');
define('ONEPAGE_AUTO_SHOW_DEFAULT_COUNTRY_TITLE', 'Automaticky zobrazit výchozí zemi fakturace/dodání');
define('ONEPAGE_AUTO_SHOW_DEFAULT_STATE_TITLE', 'Automaticky zobrazit výchozí stav fakturace/dopravy');
define('ONEPAGE_AUTO_SHOW_DEFAULT_ZIP_TITLE', 'Automaticky zobrazit fakturaci/dopravu výchozí PSČ');
define('ONEPAGE_ZIP_BELOW_TITLE', 'Přesunout vstupní pole PSČ pod stav');
define('ONEPAGE_CHECKOUT_HIDE_SHIPPING_TITLE', 'Nezobrazovat zaškrtávací políčko dodací a manipulační adresy ani způsoby odeslání, pokud hmotnost produktů = 0');
define('ONEPAGE_ADDR_LAYOUT_TITLE', 'Rozvržení adres');
define('ONEPAGE_TELEPHONE_TITLE', 'Vyžadován telefon');

define('GOOGLE_TAGS_ID_TITLE', 'Google Tag ID (gtag.js) for Google Analytics');
define('GOOGLE_TAGS_ID_STATUS_TITLE', 'stav ID značek Google');
define('GOOGLE_TAG_MANAGER_ID_TITLE', 'Google Tag Manager ID');

define('GOOGLE_GOALS_PAGE_VIEW_TITLE', 'Cílem \'page_view\' je zobrazení každé stránky');
define('GOOGLE_GOALS_ADD_TO_CART_TITLE', 'Cíl \'přidat_do_košíku\' je, když zákazník přidá položku do košíku');
define('GOOGLE_GOALS_ON_CHECKOUT_TITLE', 'Cílem \'checkout_view\' je zobrazení stránky pokladny');
define('GOOGLE_GOALS_CHECKOUT_PROCESS_TITLE', 'Cíl \'pokrok_pokladny\' - zákazník úspěšně zadal objednávku');
define('GOOGLE_GOALS_CHECKOUT_SUCCESS_TITLE', 'Cílem \'checkout_success\' je zobrazit stránku po potvrzení objednávky');
define('GOOGLE_GOALS_CLICK_FAST_BUY_TITLE', 'Target \'fast_buy\' - když zákazník klikne na tlačítko "Rychlá objednávka" na stránce produktu');
define('GOOGLE_GOALS_LOGIN_TITLE', 'Cíl \'přihlášení\' je, když je klient přihlášen');
define('GOOGLE_GOALS_ADD_REVIEW_TITLE', 'Cíl \'add_review\' je, když zákazník přidal recenzi');
define('GOOGLE_GOALS_FILTER_TITLE', 'Cílem \'filtru\' je situace, kdy zákazník používá filtr k vyhledávání produktů');
define('GOOGLE_GOALS_CALLBACK_TITLE', 'Cíl \'zpětné volání\' - když klient klikne na tlačítko \'Zpětné volání\' v záhlaví webu');
define('GOOGLE_GOALS_CLICK_ON_PHONE_TITLE', 'Cíl \'telefonní_hovor\' je, když klient klikne na ikonu telefonu');
define('GOOGLE_GOALS_CLICK_ON_CHAT_TITLE', 'Cíl \'click_chat\' je, když klient klikne na chat');
define('GOOGLE_GOALS_CONTACT_US_TITLE', 'Cíl \'kontaktujte nás\' - když klient zadal požadavek na kontaktní stránce');
define('GOOGLE_GOALS_SUBSCRIBE_TITLE', 'Target \'subscribe\' - když se klient přihlásil k odběru');
define('GOOGLE_GOALS_CLICK_ON_BUG_REPORT_TITLE', 'Cílem \'bug_report\' je, když klient klikne na \'Odeslat hlášení o chybě\' v patičce webu');

define('GOOGLE_ECOMM_SUCCESS_PAGE_TITLE', 'Nákup elektronického obchodu \'nákup\' - zobrazení stránky po potvrzení objednávky');
define('GOOGLE_ECOMM_CHECKOUT_PAGE_TITLE', 'Cíl elektronického obchodu \'košík\' – stránka pokladny');
define('GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE_TITLE', 'Cílem elektronického obchodu \'produkt\' je zobrazit stránku produktu');
define('GOOGLE_ECOMM_SEARCH_RESULTS_TITLE', 'Cíl elektronického obchodu \'searchresults\' - zobrazení stránky s výsledky vyhledávání');
define('GOOGLE_ECOMM_HOME_PAGE_TITLE', 'Cílem elektronického obchodu \'domovskou stránkou\' je zobrazení produktové stránky');
define('GOOGLE_ECOMM_CLICK_FAST_BUY_TITLE', 'Ecommerce Goal \'Purchase\' - when customer accept \'Quick order\' on product page');

define('GOOGLE_OAUTH_STATUS_TITLE', 'Autorizace Google');
define('GOOGLE_OAUTH_CLIENT_ID_TITLE', 'Google CLIENT_ID');
define('GOOGLE_OAUTH_CLIENT_SECRET_TITLE', 'Google CLIENT_SECRET');
define('GOOGLE_RECAPTCHA_STATUS_TITLE',"Google Recaptcha");

define('RCS_BASE_DAYS_TITLE', 'Ohlédnutí za dny ');
define('RCS_SKIP_DAYS_TITLE', 'Přeskočit dny');
define('RCS_REPORT_DAYS_TITLE', 'Použít vypočítané daně');
define('RCS_INCLUDE_TAX_IN_PRICES_TITLE', 'Použít pevnou daňovou sazbu');
define('RCS_USE_FIXED_TAX_IN_PRICES_TITLE', 'Pevná sazba daně ');
define('RCS_FIXED_TAX_RATE_TITLE', 'Dny zprávy o výsledcích prodeje ');
define('RCS_EMAIL_TTL_TITLE', 'Čas e-mailu žít ');
define('RCS_EMAIL_FRIENDLY_TITLE', 'Přátelské e-maily ');
define('RCS_EMAIL_COPIES_TO_TITLE', 'E-mailové kopie do ');
define('RCS_SHOW_ATTRIBUTES_TITLE', 'Zobrazit atributy ');
define('RCS_CHECK_SESSIONS_TITLE', 'Ignoni zákazníci s relacemi ');
define('RCS_CURCUST_COLOR_TITLE', ' Aktuální zákazník ');
define('RCS_UNCONTACTED_COLOR_TITLE', 'Nekontaktovaný Hilight ');
define('RCS_CONTACTED_COLOR_TITLE', "Kontaktovaný Hilight ");
define('RCS_MATCHED_ORDER_COLOR_TITLE', "Highlight odpovídající pořadí ");
define('RCS_SKIP_MATCHED_CARTS_TITLE', 'Přeskočit záznamy s odpovídajícími objednávkami ');
define("RCS_AUTO_CHECK_TITLE", 'Automatická kontrola \"bezpečných\" košíků na e-mail ');
define('RCS_CARTS_MATCH_ALL_DATES_TITLE', 'Spárovat objednávky od libovolného data ');
define('RCS_PENDING_SALE_STATUS_TITLE', 'Nevyřízené stavy prodeje ');
define('RCS_REPORT_EVEN_STYLE_TITLE', 'Nahlásit styl sudých řádků');
define('RCS_REPORT_ODD_STYLE_TITLE', 'Nahlásit styl lichého řádku ');


define('DEFAULT_DATE_FORMAT_TITLE', "Výchozí název formátu data");

define('DISPLAY_PRICE_WITH_TAX_CHECKOUT_TITLE', 'Výpočet daně v pokladně');

define('SET_JIVOSITE_TITLE', 'Povolit nebo zakázat JivoSite');
define('INSTAGRAM_LINK_SLIDE_TITLE', 'Instagram odkazový snímek');

define('STORE_BANK_INFO_TITLE', 'Bankovní informace pro fakturu');

define('JIVOSITE_WIDGET_ID_TITLE', 'ID widgetu JivoSite');
define('STORE_SCRIPTS_TITLE' , 'Včetně vlastního JS');
define('STORE_METAS_TITLE' , 'Včetně vlastních meta tagů v hlavě');

define('CHANGE_BY_GEOLOCATION_TITLE', 'Přepínání měny a jazyka v závislosti na geolokaci');
define('GET_BROWSER_LANGUAGE_TITLE', 'Přepněte web na jazyk prohlížeče');

define('FACEBOOK_GOALS_ADD_PAYMENT_INFO_TITLE', 'Cíl \'AddPaymentInfo\' - vyplnění platebních údajů');
define('FACEBOOK_GOALS_ADD_TO_WISHLIST_TITLE', 'Cíl \'AddToWishlist\' - přidat do seznamu přání');
define('FACEBOOK_GOALS_CONTACT_US_REQUEST_TITLE', 'Cíl \'Lead\' - požadavek na stránce kontaktujte nás');
define('FACEBOOK_GOALS_VIEW_CONTENT_TITLE', 'Cíl \'Zobrazit obsah\' - zobrazit stránku produktu');
define('FACEBOOK_GOALS_SUCCESS_PAGE_TITLE', 'Cíl \'Nákup\' - stránka po potvrzení objednávky');
define('FACEBOOK_GOALS_CHECKOUT_PROCESS_TITLE', 'Cíl \'InitiateCheckout\' - stránka pokladny');
define('FACEBOOK_GOALS_SEARCH_RESULTS_TITLE', 'Cíl \'Hledat\' - stránka výsledků hledání');
define('FACEBOOK_GOALS_COMPLETE_REGISTRATION_TITLE', 'Cíl \'CompleteRegistration\' - při registraci zákazníka');
define('FACEBOOK_GOALS_ADD_TO_CART_TITLE', 'Cíl \'Přidat do košíku\' - přidat do košíku');
define('FACEBOOK_GOALS_PAGE_VIEW_TITLE', 'Cíl \'PageView\' - na každé stránce');
define('FACEBOOK_GOALS_CLICK_FAST_BUY_TITLE', 'Cíl \'FastBuy\' - když zákazník klikne na tlačítko \'Rychlá objednávka\' na stránce produktu');
define('FACEBOOK_GOALS_CLICK_ON_CHAT_TITLE', 'Cíl \'ClickChat\' - když zákazník klikne na tlačítko Chat');
define('FACEBOOK_GOALS_CALLBACK_TITLE', 'Cíl \'Zpětné volání\' - když zákazník klikne na tlačítko \'Zpětné volání\' v záhlaví stránky');
define('FACEBOOK_GOALS_FILTER_TITLE', 'Cíl \'filtr\' - když zákazník používá filtr k vyhledávání produktů');
define('FACEBOOK_GOALS_SUBSCRIBE_TITLE', 'Cíl \'Přihlásit se\' - když se zákazník přihlásil k odběru');
define('FACEBOOK_GOALS_LOGIN_TITLE', 'Cíl \'přihlášení\' - když se zákazník přihlásí');
define('FACEBOOK_GOALS_ADD_REVIEW_TITLE', 'Cíl \'add_review\' - když zákazník přidal recenzi');
define('FACEBOOK_GOALS_PHONE_CALL_TITLE', 'Cíl \'Telefonní hovor\' - když zákazník klikne na telefonní číslo v záhlaví stránky');
define('FACEBOOK_GOALS_CLICK_ON_BUG_REPORT_TITLE', 'Cíl \'Hlášení o chybě\' - když zákazník klikne na \'Odeslat zprávu o chybě\' v zápatí webu');

define('DEFAULT_CAPTCHA_STATUS_TITLE', 'Captcha');
define('GOOGLE_RECAPTCHA_PUBLIC_KEY_TITLE', 'VEŘEJNÝ KLÍČ Google Recaptcha');
define('GOOGLE_RECAPTCHA_SECRET_KEY_TITLE', 'TAJNÝ KLÍČ Google Recaptcha');
define('GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED_TITLE', 'Povolit Google Analytics');
define('DOMEN_URL_TITLE', 'Adresa domény');
define('STORE_TIME_ZONE_TITLE', 'Časové pásmo');
define('DOMEN_URL_DESC', 'Můžete si nastavit své vlastní doménové jméno');
define('STOCK_ALLOW_CHECKOUT_WITH_ATTR_COUNT_0_TITLE', 'Povolit nákup s 0 v atributech produktu');
define('STOCK_ALLOW_CHECKOUT_WITH_ATTR_COUNT_0_DESC', 'Povolit nákup, když je množství v atributech produktu 0');
define('WWW_TOO_MANY_REDIRECTS' , 'Příliš mnoho přesměrování, hodnota se nezměnila');
define('QUICK_ORDER_ENABLED_TITLE' , 'Tlačítko Rychlá objednávka.');