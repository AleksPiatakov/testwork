<?php
/*
  $Id: english.php,v 1.3 2003/09/28 23:37:26 otherlango Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Vydáno pod GNU General Public License
*/

//Správce začíná
// text záhlaví v include/header.php
define('HEADER_TITLE_LOGOFF', 'Odhlášení');

// text konfiguračního pole v include/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Správci');
define('BOX_ADMINISTRATOR_MEMBERS', 'Skupiny členů');
define('BOX_ADMINISTRATOR_MEMBER', 'Členové');
define('BOX_ADMINISTRATOR_BOXES', 'Přístup k souboru');
define('BOX_ADMINISTRATOR_ACCOUNT_UPDATE', 'Aktualizovat účet');
define('TEXT_PRODILE_INFO_CHANGE_PASSWORD', 'Změnit vlastní heslo ');

// snímky
define('IMAGE_FILE_PERMISSION', 'Povolení souboru');
define('IMAGE_GROUPS', 'Seznam skupin');
define('IMAGE_INSERT_FILE', 'Vložit soubor');
define('IMAGE_MEMBERS', 'Seznam členů');
define('IMAGE_NEW_GROUP', 'Nová skupina');
define('IMAGE_NEW_MEMBER', 'Nový člen');
define('IMAGE_NEXT', 'Další');

define('ONE_PAGE_CHECKOUT_TITLE', 'Pokladna');
define('BROWSE_BY_CATEGORIES_TITLE', 'Procházet podle kategorií');
define('SEO_TITLE', 'SEO URL');
define('HEADER_FRONT_LINK_TEXT', 'Přejít na web');
define('HEADER_GO_TO_SITE', 'Přejít na web');

// konstanty pro použití ve funkci tep_prev_next_display
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> názvů souborů)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> členů)');
//Konec správce

// hledejte ve svém adresáři $PATH_LOCALE/locale dostupná národní prostředí..
// na RedHat6.0 jsem použil 'en_US'
// na FreeBSD 4.0 používám 'en_US.ISO_8859-1'
// toto nemusí fungovat v prostředí win32..
setlocale(LC_TIME, 'cs_US.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%m/%d/%Y'); // toto se používá pro strftime()
//define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // toto se používá pro strftime()
define('DATE_FORMAT_LONG', '%d %B %Y'); // toto se používá pro strftime()
define('DATE_FORMAT', 'm/d/Y'); // toto se používá pro date()
define('PHP_DATE_TIME_FORMAT', 'm/d/Y H:i:s'); // toto se používá pro date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_FORMAT_SPIFFYCAL', 'MM/dd/rrrr'); //Zde použijte pouze 'dd', 'MM' a 'yyyy' v libovolném pořadí


define('TEXT_DAY_1','Pondělí');
define('TEXT_DAY_2','úterý');
define('TEXT_DAY_3','Prostředí');
define('TEXT_DAY_4','Thursday');
define('TEXT_DAY_5','Pátek');
define('TEXT_DAY_6','Sobota');
define('TEXT_DAY_7','Neděle');
define('TEXT_DAY_SHORT_1','MON');
define('TEXT_DAY_SHORT_2','TUE');
define('TEXT_DAY_SHORT_3','ST');
define('TEXT_DAY_SHORT_4','THU');
define('TEXT_DAY_SHORT_5','PÁ');
define('TEXT_DAY_SHORT_6','SAT');
define('TEXT_DAY_SHORT_7','SUN');
define('TEXT_MONTH_BASE_1','Leden');
define('TEXT_MONTH_BASE_2','Únor');
define('TEXT_MONTH_BASE_3','Březen');
define('TEXT_MONTH_BASE_4','Duben');
define('TEXT_MONTH_BASE_5','May');
define('TEXT_MONTH_BASE_6','Červen');
define('TEXT_MONTH_BASE_7','Červenec');
define('TEXT_MONTH_BASE_8','Srpen');
define('TEXT_MONTH_BASE_9','Září');
define('TEXT_MONTH_BASE_10','Říjen');
define('TEXT_MONTH_BASE_11','Listopad');
define('TEXT_MONTH_BASE_12','Prosinec');
define('TEXT_MONTH_1','Jan');
define('TEXT_MONTH_2','Feb');
define('TEXT_MONTH_3','Mar');
define('TEXT_MONTH_4','APR');
define('TEXT_MONTH_5','May');
define('TEXT_MONTH_6','Červen');
define('TEXT_MONTH_7','Červenec');
define('TEXT_MONTH_8','Aug');
define('TEXT_MONTH_9','Sep');
define('TEXT_MONTH_10','Oct');
define('TEXT_MONTH_11','Nov');
define('TEXT_MONTH_12','Dec');

// Globální položky pro značku <html>
define('HTML_PARAMS', 'dir="ltr" lang="en"');

// znaková sada pro webové stránky a e-maily
define('CHARSET', 'utf-8');

// název stránky
define('TITLE', 'Solomono');

// text záhlaví v include/header.php
define('HEADER_TITLE_TOP', 'Admin');
define('HEADER_TITLE_SUPPORT_SITE', 'osCommerce');
define('HEADER_TITLE_ONLINE_CATALOG', 'Katalog');
define('HEADER_TITLE_ADMINISTRATION', 'Admin');
define('HEADER_TITLE_CHAINREACTION', 'Chainreactionweb');
define('HEADER_TITLE_PHESIS', 'PHESIS načteno6');

define('HEADER_TITLE_HELLO', 'Ahoj');
define('HEADER_ADMIN_TEXT', 'Administrátorský panel');
define('HEADER_ORDERS_TODAY', 'Dnes objednávky: ');

// MaxiDVD přidán řádek pro oblast WYSIWYG HTML: BOF
define('BOX_CATALOG_DEFINE_MAINPAGE', 'Definujte hlavní stránku');
// MaxiDVD přidán řádek pro oblast WYSIWYG HTML: EOF
define('BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI', 'Multiedit produkty');
define('BOX_TOOLS_COMMENT8R', 'Komentáře');
define('BOX_TOOLS_MYSQL_PERFORMANCE', 'Pomalé dotazy');
define('BOX_GOOGLE_SITEMAP', 'Google SiteMaps');
define('BOX_CLEAR_IMAGE_CACHE', 'Vymazat mezipaměť obrázků');


define('TOOLTIP_STORE_NAME', 'Uveďte původní název obchodu, který přitahuje zákazníky, který si zákazníci pamatují a slouží k tomu, aby vynikl a odlišil se od podobných obchodů – konkurentů.');
define('TOOLTIP_STORE_OWNER', 'Určete vlastníka obchodu');
define('TOOLTIP_SHOW_BASKET_ON_ADD_TO_CART', 'Povolte, košík bude k dispozici při přidávání produktu, takže návštěvník nebude mít dotazy, že produkt byl přidán do košíku.');
define('TOOLTIP_USE_DEFAULT_LANGUAGE_CURRENCY', 'Povolit automatickou změnu měny podle aktuálního jazyka webu.');
define('TOOLTIP_CHANGE_BY_GEOLOCATION', 'Povolit změnu měny a jazyka webu na základě geolokace.');
define('TOOLTIP_GET_BROWSER_LANGUAGE', 'Povolit změnu měny webu v závislosti na jazyku prohlížeče.');
define('TOOLTIP_STORE_BANK_INFO', 'Umožňuje definovat přesné bankovní informace pro fakturační údaje');
define('TOOLTIP_ONEPAGE_LOGIN_REQUIRED', 'Povolení a přihlášení uživatele/klienta bude vždy vyžadováno');
define('TOOLTIP_REVIEWS_WRITE_ACCESS', 'Povolit a pouze registrovaní uživatelé budou moci zanechat své komentáře');
define('TOOLTIP_ROBOTS_TXT', 'Ochrana celého webu nebo některých jeho částí před indexováním');
define('TOOLTIP_MENU_LOCATION', 'Vyberte pozici nabídky: nahoře, vlevo nebo vlevo sbalené');
define('TOOLTIP_DEFAULT_DATE_FORMAT', 'Vyberte formát data');
define('TOOLTIP_SET_HTTPS', 'Povolte rozšíření protokolu HTTPS pro podporu šifrování pro zvýšení bezpečnosti');
define('TOOLTIP_SET_WWW', 'Vyberte nastavení, kam chcete přesměrovat: zakázat, www->ne-www nebo ne-www->www');
define('TOOLTIP_ENABLE_DEBUG_PAGE_SPEED', 'Povolte ladění načítání stránky pro nalezení a opravu chyb ve skriptu');
define('TOOLTIP_STORE_SCRIPTS', 'Můžete zahrnout další skripty JS');
define('TOOLTIP_STORE_METAS', 'Do hlavičky můžete přidat další meta tagy');
define('TOOLTIP_MYSQL_PERFORMANCE_TRESHOLD', 'Nastavte čas v "sekundách", po jehož uplynutí budou pomalé a potenciálně problematické dotazy zaznamenávány do databáze');






// text konfiguračního pole v include/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Konfigurace');
define('BOX_CONFIGURATION_MYSTORE', 'Můj obchod');
define('BOX_CONFIGURATION_LOGGING', 'Logging');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// text rámečku modulů v include/boxes/modules.php
define('BOX_HEADING_MODULES', 'Moduly');
define('BOX_MODULES_PAYMENT', 'Platba');
define('BOX_MODULES_SHIPPING', 'Doprava');
define('BOX_MODULES_ORDER_TOTAL', 'Celkem objednávky');
define('BOX_MODULES_SHIP2PAY', 'Zaslat a zaplatit');

// text pole kategorií v include/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Katalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategorie/Produkty');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Atributy - Přidat hodnoty');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES_NEW', 'Atributy - Nastavené hodnoty');
define('BOX_CATALOG_MANUFACTURERS', 'Výrobci');
define('BOX_CATALOG_SPECIALS', 'Speciální akce');
define('BOX_CATALOG_EASYPOPULATE', 'EasyPopulate');
define('BOX_CATALOG_STATS_SEARCH_KEYWORDS', "Plánovač klíčových slov");

define('BOX_CATALOG_SALEMAKER', 'SaleMaker');

// text pole zákazníků v include/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Zákazníci');
define('BOX_CUSTOMERS_CUSTOMERS', 'Zákazníci');
define('BOX_CUSTOMERS_ORDERS', 'Objednávky');
define('BOX_CUSTOMERS_EDIT_ORDERS', 'Upravit objednávky');
define('BOX_CUSTOMERS_ENTRY', 'Počet záznamů');


// text pole daní v include/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Místa / Daně');
define('BOX_TAXES_COUNTRIES', 'Země');
define('BOX_TAXES_ZONES', 'Zóny');
define('BOX_TAXES_GEO_ZONES', 'Daňové zóny');
define('BOX_TAXES_TAX_CLASSES', 'Daňové třídy');
define('BOX_TAXES_TAX_RATES', 'Sazby daně');

// text pole zpráv v include/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Zprávy');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Zobrazené produkty');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Zakoupené produkty');
define('BOX_REPORTS_PRODUCTS_PURCHASED_BY_CATEGORY', 'Zpráva - Zakoupené produkty (podle kategorie)');
define('BOX_REPORTS_ORDERS_TOTAL', 'Objednávky zákazníků-celkem');

// text nástrojů v include/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Nástroje');
define('BOX_TOOLS_BACKUP', 'Záloha databáze');
define('BOX_TOOLS_CACHE', 'Kontrola mezipaměti');
define('BOX_TOOLS_MAIL', 'Odeslat email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Správce newsletteru');

// text textového pole lokalizace v include/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Lokalizace');
define('BOX_LOCALIZATION_CURRENCIES', 'Měny');
define('BOX_LOCALIZATION_LANGUAGES', 'Jazyky');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Stav objednávky');
define('BOX_CATALOG_SEO_FILTER', "SEO filtr");
define('BOX_CATALOG_SEO_TEMPALTES', "SEO šablony");
// text pole infoboxu v include/boxes/info_boxes.php
define('BOX_HEADING_BOXES', 'Administrátor infoboxu');
define('BOX_HEADING_TEMPLATE_CONFIGURATION', 'Správce šablony');
define('BOX_HEADING_DESIGN_CONTROLS', 'Ovládací prvky návrhu');

// javascriptové zprávy
define('JS_ERROR', 'Během zpracování vašeho formuláře došlo k chybám!\nProveďte prosím následující opravy:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Atribut nový produkt vyžaduje hodnotu ceny\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Nový produktatribut potřebuje předponu ceny\n');

define('JS_PRODUCTS_NAME', '* Nový produkt potřebuje název\n');
define('JS_PRODUCTS_DESCRIPTION', '* Nový produkt potřebuje popis\n');
define('JS_PRODUCTS_PRICE', '* Nový produkt potřebuje hodnotu ceny\n');
define('JS_PRODUCTS_WEIGHT', '* Nový produkt potřebuje hodnotu hmotnosti\n');
define('JS_PRODUCTS_QUANTITY', '* Nový produkt potřebuje hodnotu množství\n');
define('JS_PRODUCTS_MODEL', '* Nový produkt potřebuje hodnotu modelu\n');
define('JS_PRODUCTS_IMAGE', '* Nový produkt potřebuje hodnotu obrázku\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Pro tento produkt je třeba nastavit novou cenu\n');

define('JS_FIRST_NAME', '* Položka \'Jméno\' musí mít alespoň ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaků.\n');
define('JS_LAST_NAME', '* Záznam \'Příjmení\' musí mít alespoň ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaků.\n');
define('JS_DOB', '* Záznam \'Datum narození\' musí být ve formátu: xx/xx/xxxx (měsíc/datum/rok).\n');
define('JS_EMAIL_ADDRESS', '* Položka \'E-Mail Address\' musí mít alespoň ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaků.\n');
define('JS_ADDRESS', '* Položka \'Ulice\' musí mít alespoň ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaků.\n');
define('JS_POST_CODE', '* Položka \'Post Code\' musí mít alespoň ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaků.\n');
define('JS_CITY', '* Položka \'Město\' musí mít alespoň ' . ENTRY_CITY_MIN_LENGTH . ' znaků.\n');
define('JS_STATE', '* Musí být vybrána položka \'State\'.\n');
define('JS_STATE_SELECT', '-- Vybrat výše --');
define('JS_ZONE', '* Položka \"Stát\" musí být vybrána ze seznamu pro tuto zemi.');
define('JS_COUNTRY', '* Musí být zvolena hodnota \'Země\'.\n');
define('JS_TELEPHONE', '* Záznam \'Telefonní číslo\' musí mít alespoň ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaků.\n');
define('JS_PASSWORD', '* Položky \'Heslo\' a položky \'Potvrzení\' se musí shodovat a musí mít alespoň ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaků.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Číslo objednávky %s neexistuje!');

define('CATEGORY_PERSONAL', 'Osobní');
define('CATEGORY_ADDRESS', 'Adresa');
define('CATEGORY_CONTACT', 'Kontakt');
define('CATEGORY_COMPANY', 'Společnost');
define('CATEGORY_OPTIONS', 'Možnosti');
define('DISCOUNT_OPTIONS', 'Slevy');

define('ENTRY_FIRST_NAME', 'Jméno:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaky</span>');
define('ENTRY_LAST_NAME', 'Příjmení:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaky</span>');
define('ENTRY_DATE_OF_BIRTH', 'Datum narození:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(např. 05/21/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-mailová adresa:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaky</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">E-mailová adresa se nezdá být platná!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Tato e-mailová adresa již existuje!</span>');
define('ENTRY_COMPANY', 'Název společnosti:');
define('VSTUPNÍ_CHYBA_SPOLEČNOSTI', '');
define('ENTRY_STREET_ADDRESS', 'Adresa ulice:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaky</span>');
define('ENTRY_SUBURB', 'Předměstí:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'PSČ:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaky</span>');
define('ENTRY_CITY', 'Město:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' znaky</span>');
define('ENTRY_STATE', 'State:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">povinné</span>');
define('ENTRY_COUNTRY', 'Země:');
define('ENRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefonní číslo:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaky</span>');
define('ENTRY_FAX_NUMBER', 'Číslo faxu:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_YES', 'Přihlášeno');
define('ENTRY_NEWSLETTER_NO', 'Odhlášeno');

// snímky
define('IMAGE_ANI_SEND_EMAIL', 'Odesílání e-mailu');
define('IMAGE_BACK', 'Zpět');
define('IMAGE_BACKUP', 'Záloha databáze');
define('IMAGE_CANCEL', 'Zrušit');
define('IMAGE_CONFIRM', 'Potvrdit');
define('IMAGE_COPY', 'Kopírovat');
define('IMAGE_COPY_TO', 'Kopírovat do');
define('IMAGE_DETAILS', 'Detaily');
define('IMAGE_DELETE', 'Smazat');
define('IMAGE_LANG_DIR', 'Odkaz na jazyk adresáře');
define('IMAGE_EDIT', 'Upravit');
define('IMAGE_EMAIL', 'E-mail');
define('IMAGE_FILE_MANAGER', 'Správce souborů');
define('IMAGE_ICON_STATUS_GREEN', 'Aktivní');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Nastavit aktivní');
define('IMAGE_ICON_STATUS_RED', 'Neaktivní');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Nastavit neaktivní');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Vložit');
define('IMAGE_LOCK', 'Zámek');
define('IMAGE_MODULE_INSTALL', 'Instalovat modul');
define('IMAGE_MODULE_REMOVE', 'Odebrat modul');
define('IMAGE_MOVE', 'Přesunout');
define('IMAGE_NEW_BANNER', 'Nový banner');
define('IMAGE_NEW_CATEGORY', 'Nová kategorie');
define('IMAGE_NEW_COUNTRY', 'Nová země');
define('IMAGE_NEW_CURRENCY', 'Nová měna');
define('IMAGE_NEW_FILE', 'Nový soubor');
define('IMAGE_NEW_FOLDER', 'Nová složka');
define('IMAGE_NEW_LANGUAGE', 'Nový jazyk');
define('IMAGE_NEW_NEWSLETTER', 'Nový zpravodaj');
define('IMAGE_NEW_PRODUCT', 'Nový produkt');
define('IMAGE_NEW_SALE', 'Nový prodej');
define('IMAGE_NEW_TAX_CLASS', 'Nová daňová třída');
define('IMAGE_NEW_TAX_RATE', 'Nová daňová sazba');
define('IMAGE_NEW_TAX_ZONE', 'Nová daňová zóna');
define('IMAGE_NEW_ZONE', 'Nová zóna');
define('IMAGE_ORDERS', 'Objednávky');
define('IMAGE_ORDERS_INVOICE', 'Faktura');
define('IMAGE_ORDERS_PACKINGSLIP', 'Dodací list');
define('IMAGE_PREVIEW', 'Náhled');
define('IMAGE_RESTORE', 'Obnovit');
define('IMAGE_RESET', 'Reset');
define('IMAGE_SAVE', 'Uložit');
define('IMAGE_SEARCH', 'Hledat');
define('IMAGE_SELECT', 'Vybrat');
define('IMAGE_SEND', 'Odeslat');
define('IMAGE_SEND_EMAIL', 'Odeslat email');
define('IMAGE_UNLOCK', 'Odemknout');
define('IMAGE_UPDATE', 'Aktualizace');
define('IMAGE_UPDATE_CURRENCIES', 'Aktualizovat směnný kurz');
define('IMAGE_UPDATE_CURRENCIES_SHORT', 'Aktualizace měn');
define('IMAGE_UPLOAD', 'Nahrát');
define('TEXT_IMAGE_NONEXISTENT', 'Žádný obrázek');

define('ICON_CROSS', 'False');
define('ICON_CURRENT_FOLDER', 'Aktuální složka');
define('ICON_DELETE', 'Smazat');
define('ICON_ERROR', 'Chyba');
define('ICON_FILE', 'Soubor');
define('ICON_FILE_DOWNLOAD', 'Stáhnout');
define('ICON_FOLDER', 'Složka');
define('ICON_LOCKED', 'Uzamčeno');
define('ICON_PREVIOUS_LEVEL', 'Předchozí úroveň');
define('ICON_PREVIEW', 'Náhled');
define('ICON_STATISTICS', 'Statistika');
define('ICON_SUCCESS', 'Úspěch');
define('ICON_TICK', 'True');
define('ICON_UNLOCKED', 'Odemčeno');
define('ICON_WARNING', 'Upozornění');

// konstanty pro použití ve funkci tep_prev_next_display
define('TEXT_RESULT_PAGE', 'Stránka %s z %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> bannerů)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> zemí)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Zobrazuje se <b>%d</b> <b>%d</b> (z <b>%d</b> zákazníků)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Zobrazení <b>%d</b> až <b>%d</b> (z <b>%d</b> měn)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> jazyků)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> výrobců)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> zpravodajů)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> objednávek)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> stavu objednávek)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> produktů)');
define('TEXT_DISPLAY_NUMBER_OF_SALES', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> prodejů)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Zobrazuji <b>%d</b> až <b>%d</b> (z <b>%d</b> produktů ve speciálu)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Zobrazení <b>%d</b> až <b>%d</b> (z <b>%d</b> daňových tříd)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> daňových zón)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> daňových sazeb)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Zobrazení <b>%d</b> až <b>%d</b> (z <b>%d</b> zón)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('IMAGE_BUTTON_BUY_TEMPLATE','Přepnout na placený balíček');
define('IMAGE_BUTTON_BUY_TEMPLATE_MOB', 'Koupit');
define('TIME_LEFT', 'Zbývající čas: ');

define('TEXT_DEFAULT', 'výchozí');
define('TEXT_SET_DEFAULT', 'Nastavit jako výchozí');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Povinné</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Chyba: Momentálně není nastavena žádná výchozí měna. Nastavte ji prosím v: Nástroj pro správu->Lokalizace->Měny');

define('TEXT_CACHE_CATEGORIES', 'Pole kategorií');
define('TEXT_CACHE_MANUFACTURERS', 'Box výrobců');
define('TEXT_CACHE_ALSO_PURCHASED', 'Také zakoupený modul');

define('TEXT_NONE', '--none--');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Chyba: Cíl neexistuje.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Chyba: Cíl nelze zapisovat.');
define('ERROR_FILE_NOT_SAVED', 'Chyba: FNahrání souboru nebylo uloženo.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Chyba: Typ nahrávání souboru není povolen.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Úspěch: Nahrání souboru bylo úspěšně uloženo.');
define('WARNING_NO_FILE_UPLOADED', 'Upozornění: Nebyl nahrán žádný soubor.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Upozornění: Nahrávání souborů je v konfiguračním souboru php.ini zakázáno.');

define('BOX_CATALOG_XSELL_PRODUCTS', 'Křížový prodej produktů');

define('CUSTOM_PANEL_DATE1', 'den');
define('CUSTOM_PANEL_DATE2', 'dny');
define('CUSTOM_PANEL_DATE3', 'dny');


// X-Sell
REQUIRE(DIR_WS_LANGUAGES . 'add_ccgvdc_english.php');

// BOF: Lango Přidáno pro tiskovou objednávku MOD
define('IMAGE_BUTTON_PRINT', 'Tisk');
// EOF: Lango Přidáno pro tiskovou objednávku MOD

// BOF: Lango Přidáno pro Doporučený produkt MOD
define('BOX_CATALOG_FEATURED', 'Vybrané produkty');
// EOF: Lango Přidáno pro Doporučený produkt MOD

// BOF: Lango přidáno pro statistiky prodeje MOD
define('BOX_REPORTS_MONTHLY_SALES', 'Měsíční tržby/daň');
// EOF: Lango přidáno pro statistiky prodeje MOD

//BEGIN Dynamické informační stránky neomezené
define('BOX_HEADING_INFORMATION', 'Obsah');
define('BOX_HEADING_SEO', 'SEO');
define('BOX_INFORMATION', 'Stránky');
//END Dynamické informační stránky neomezené

define('BOX_TOOLS_KEYWORDS', 'Správce klíčových slov');

// RJW Begin Meta Tags Code
define('TEXT_META_TITLE', 'Meta Title');
define('TEXT_META_DESCRIPTION', 'Meta popis');
define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

// Správce článků
define('BOX_HEADING_ARTICLES', 'Správce článků');
define('BOX_TOPICS_ARTICLES', 'Témata/Články');
define('BOX_ARTICLES_CONFIG', 'Konfigurace');
define('BOX_ARTICLES_AUTHORS', 'Autoři');
define('BOX_ARTICLES_XSELL', 'Cross-sell články');
define('IMAGE_NEW_TOPIC', 'Nové téma');
define('IMAGE_NEW_ARTICLE', 'Nový článek');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Zobrazuje se <b>%d</b> pro <b>%d</b> (z <b>%d</b> autorů)');

//Začátek TotalB2B
define('BOX_CUSTOMERS_GROUPS', 'Skupiny');
define('BOX_MANUDISCOUNT', 'Manuální sleva');

// přidat pro skupinu minimální cenu pro zahájení objednávky
define('GROUP_MIN_PRICE', 'Minimální cena skupiny');
// přidat pro skupinu minimální cenu do konce objednávky
// přidat pro začátek skupin barev
define('GROUP_COLOR_BAR', 'Barva skupiny');
// přidat pro konec skupin barev
//TotalB2B konec
define('BOX_CATALOG_QUICK_UPDATES', 'Rychlé aktualizace');

define('IMAGE_PROPERTIES_POPUP_ADD_CHANGE_DELETE', 'Přidat, změnit, odstranit vlastnosti');
define('IMAGE_PROPERTIES_POPUP_ADD', 'Přidat vlastnosti');
define('IMAGE_PROPERTIES', 'Definujte vlastnosti vašich produktů');

// text pole ankety v include/boxes/polls.php

define('BOX_HEADING_POLLS', 'Ankety');
define('BOX_POLLS_POLLS', 'Správce anket');
define('BOX_POLLS_CONFIG', 'Konfigurace dotazování');
define('BOX_CURRENCIES_CONFIG', 'Měny');
define('BOX_CUPONS', 'Propagační kódy');
define('BOX_INDEX_GIFTVOUCHERS', 'Dárkové poukazy / Promo kódy');

define('BOX_REPORTS_SALES_REPORT2', 'Statistiky prodeje 2');
define('BOX_REPORTS_SALES_REPORT', 'Statistiky prodeje 3');
define('BOX_REPORTS_CUSTOMERS_ORDERS', 'Zpráva zákazníků');

define('TEXT_NEW_ATTRIBUTE_EDIT', 'Upravit atributy produktů');

define('SMS_ENABLE_TITLE', 'Zapnout službu sms');
define('SMS_GATENAME_TITLE', 'Název SMS brány');
define('SMS_CUSTOMER_ENABLE_TITLE', 'Poslat sms zákazníkovi při pokladně?');
define('TELEGRAM_TOKEN_TITLE','Token telegramu');
define('TELEGRAM_NOTIFICATIONS_ENABLED_TITLE','Povolit telegramová upozornění');
define('SMS_CHANGE_STATUS_TITLE', 'Poslat sms zákazníkovi o změně stavu objednávky?');
define('SMS_OWNER_ENABLE_TITLE', 'Poslat sms adminovi při pokladně?');
define('SMS_OWNER_ENABLE_BUY_ONE_CLICK_TITLE', 'Poslat sms adminovi při nákupu jedním kliknutím?');
define('SMS_OWNER_TEL_TITLE', 'Tel. číslo správce');
define('SMS_TEXT_TITLE', 'textová sms');
define('SMS_LOGIN_TITLE', 'Přihlášení k SMS bráně (nebo API klíč, Account SID)');
define('SMS_PASSWORD_TITLE', 'pass (nebo Auth token)');
define('SMS_SIGN_TITLE', 'Sender (nebo SID služby)');
define('SMS_ENC_TITLE', 'kód2');

define('ROBOTS_TXT_TITLE', 'robots.txt');

define('SMS_CONF_TITLE', 'Služba SMS');
define('MY_SHOP_CONF_TITLE', 'Můj obchod');
define('MIN_VALUES_CONF_TITLE', 'Minimální hodnoty');
define('MAX_VALUES_CONF_TITLE', 'Maximální hodnoty');
define('IMAGES_CONF_TITLE', 'Obrázky');
define('CUSTOMER_DETAILS_CONF_TITLE', 'Podrobnosti zákazníka');
define('MODULES_CONF_TITLE', 'Instalované moduly');
define('SHIPPING_CONF_TITLE', 'Doprava/balení');
define('LISTING_CONF_TITLE', 'Výpis produktu');
define('STOCK_CONF_TITLE', 'Sklad');
define('LOGS_CONF_TITLE', 'Logging');
define('CACHE_CONF_TITLE', 'Cache');
define('EMAIL_CONF_TITLE', 'Možnosti e-mailu');
define('DOWNLOAD_CONF_TITLE', 'Stáhnout');
define('GZIP_CONF_TITLE', 'Komprese GZip');
define('SESSIONS_CONF_TITLE', 'Relace');
define('HTML_CONF_TITLE', 'TinyMCE Editor');
define('DYMO_CONF_TITLE', 'Dynamické MoPics');
define('DOWN_CONF_TITLE', 'Údržba webu');
define('GA_CONF_TITLE', 'Hosté');
define('LINKS_CONF_TITLE', 'Odkazy');
define('QUICK_CONF_TITLE', 'Rychlé aktualizace');
define('WISHLIST_TITLE', 'Nastavení seznamu přání');
define('PAGE_CACHE_TITLE', 'Cache stránky');
define('YANDEX_MARKET_CONF_TITLE', 'nahrání XML');


define('ATTRIBUTES_COPY_TEXT1', ' VAROVÁNÍ: Nelze kopírovat z ID produktu # ');
define('ATTRIBUTES_COPY_TEXT2', ' k ID produktu # ');
define('ATTRIBUTES_COPY_TEXT3', ' ... Nebyla vytvořena žádná kopie');
define('ATTRIBUTES_COPY_TEXT4', ' VAROVÁNÍ: Žádné atributy ke kopírování z ID produktu # ');
define('ATTRIBUTES_COPY_TEXT5', ' for: ');
define('ATTRIBUTES_COPY_TEXT6', ' ... nebyla vytvořena žádná kopie');
define('ATTRIBUTES_COPY_TEXT7', ' VAROVÁNÍ: Neexistuje žádné ID produktu # ');
define('ATTRIBUTES_COPY_TEXT8', ' ... Nebyla vytvořena žádná kopie');

//include('includes/languages/english_support.php');

// BOF FlyOpenair: Extra cena produktu
define('BOX_EXTRA_PRODUCT_PRICE', 'Cena extra produktu');
define('EXTRA_PRODUCT_PRICE_ID_TITLE', 'Povolit extra cenu produktu');
define('EXTRA_PRODUCT_PRICE_ID_DESC', 'Povolit/zakázat cenu extra produktu)');
// EOF FlyOpenair: Extra cena produktu

define('TEXT_IMAGE_OVERWRITE_WARNING', 'UPOZORNĚNÍ: FILENAME byl aktualizován, ale nebyl přepsán ');

define('SERVICE_MENU', 'TOOLS');
define('SEO_CONFIGURATION','SEO TOOLS');
define('RCS_CONF_TITLE', 'RCS');

define('TEXT_INDEX_LANGUAGE', 'Jazyk: ');
define('TEXT_SUMMARY_CUSTOMERS', 'Zákazníci');
define('TEXT_SUMMARY_ORDERS', 'Objednávky');
define('TEXT_SUMMARY_PRODUCTS', 'Produkty');
define('TEXT_SUMMARY_HELP', 'Nápověda');
define('TEXT_SUMMARY_STAT', 'Statistika');
define('TABLE_HEADING_CUSTOMERS', 'Zákazníci');

define('API_ENABLED_TITLE', 'Solomono API');
define('TEXT_MENU_API', 'API');
define('COMMENTS_MODULE_ENABLED_TITLE', 'Recenze');
define('QUICK_PRODUCTS_UPDATE_ENABLED_TITLE','Rychlé aktualizace');
define('FACEBOOK_PIXEL_MODULE_ENABLED_TITLE','FaceBook Pixel');
define('DEFAULT_PIXEL_CURRENCY_TITLE','FaceBook Pixel měna');
define('FACEBOOK_PIXEL_ID_TITLE','FaceBook Pixel ID');
define('LANGUAGE_SELECTOR_MODULE_ENABLED_TITLE', 'Vícejazyčné');
define('PRODUCT_LABELS_MODULE_ENABLED_TITLE', 'Štítky');
define('ATTRIBUTES_PRODUCTS_MODULE_ENABLED_TITLE', 'Filtry');
define('AUTH_MODULE_ENABLED_TITLE', 'Autorizace (Google, Facebook)');
define('EXCEL_IMPORT_MODULE_ENABLED_TITLE', 'Import/Export CSV (Easy Populate)');
define('CUPONES_MODULE_ENABLED_TITLE', 'Propagační kódy');
define('COMPARE_MODULE_ENABLED_TITLE', 'Porovnání');
define('WISHLIST_MODULE_ENABLED_TITLE', 'Seznam přání produktů');
define('GOOGLE_FEED_CHOOSE_ALL_PRODUCTS_TITLE', 'aktivní produkty');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_2_TITLE', 'produkty s aktivním stavem XML');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_3_TITLE', 'produkty skladem');
define('XSELL_PRODUCTS_BUYNOW_ENABLED_TITLE', 'Křížový prodej produktů');
define('STATS_PRODUCTS_PURCHASED_BY_CATEGORY_MODULE_ENABLED_TITLE', 'Přehled – zakoupené produkty (podle kategorie)');
define('SALEMAKER_MODULE_ENABLED_TITLE', 'Hromadné slevy (SaleMaker)');
define('SPECIALS_MODULE_ENABLED_TITLE', 'Speciální (cenové slevy)');
define('STATS_KEYWORDS_ENABLED_TITLE', 'Statistika požadavků na vyhledávání');
define('BACKUP_ENABLED_TITLE', 'Záloha databáze');
define('PRODUCTS_MULTI_ENABLED_TITLE', 'Produkty s více správci');
define('SEO_TEMPLATES_ENABLED_TITLE', 'SEO šablony');
define('SHIP2PAY_ENABLED_TITLE', 'Platba za 2');
define('QTY_PRO_ENABLED_TITLE', 'Kombinace atributů');
define('MASTER_PASSWORD_MODULE_ENABLED_TITLE', 'Hlavní heslo');
define('YML_MODULE_ENABLED_TITLE', 'Import XML (YML)');
define('OSC_IMPORT_MODULE_ENABLED_TITLE', 'Migrace databáze (osCommerce)');
define('EXPORT_HOTLINE_MODULE_ENABLED_TITLE', 'Export XML produktů "Hotline"');
define('EXPORT_PROMUA_MODULE_ENABLED_TITLE', 'Export XML produktů "Prom"');
define('EXPORT_PRICEUA_MODULE_ENABLED_TITLE', 'export XML produktů "Price.ua"');
define('EXPORT_ROZETKA_MODULE_ENABLED_TITLE', 'Export XML produktů "Rozetka"');
define('EXPORT_YANDEX_MARKET_MODULE_ENABLED_TITLE', 'Export z trhu Yandex');
define('EXPORT_GOOGLE_SITEMAP_MODULE_ENABLED_TITLE', 'XML Sitemaps');
define('EXPORT_FACEBOOK_FEED_MODULE_ENABLED_TITLE', 'XML zdroj pro produktový katalog Facebooku');
define('EXPORT_PDF_MODULE_ENABLED_TITLE', 'Export katalogu do PDF');
define('PROMURLS_MODULE_ENABLED_TITLE', 'Adresy URL Prom.ua');
define('PROM_EXCEL_MODULE_ENABLED_TITLE', 'Importovat Prom.ua (Excel)');
define('GOOGLE_FEED_MODULE_ENABLED_TITLE', 'Google Feed');
define('MASTER_PASS_TITLE', 'Hlavní heslo');
define('SMSINFORM_MODULE_ENABLED_TITLE', 'SMS modul');
define('CARDS_ENABLED_TITLE', 'Kreditní karty (13 metod)');
define('SOCIAL_WIDGETS_ENABLED_TITLE', 'Sociální widgety');
define('MULTICOLOR_ENABLED_TITLE', 'Multicolor');
define('WATERMARK_ENABLED_TITLE', 'Vodoznaky');

define('FACEBOOK_APP_ID_TITLE', 'ID aplikace na Facebooku');
define('FACEBOOK_APP_SECRET_TITLE', 'Tajný klíč Facebooku');
define('VK_APP_ID_TITLE', 'ID aplikace Vkontakte');
define('VK_APP_SECRET_TITLE', 'Tajný klíč Vkontakte');

define('TABLE_HEADING_ORDERS', 'Objednávky:');
define('TABLE_HEADING_LAST_ORDERS', 'Poslední objednávky');
define('TABLE_HEADING_CUSTOMER', 'Zákazník');
define('TABLE_HEADING_ORDER_NUMBER', '#');
define('TABLE_HEADING_ORDER_TOTAL', 'Celkem');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_DATE', 'Datum');

define('TEXT_GO_TO_CAT', 'Vyberte kategorii');
define('TEXT_GO_TO_SEARCH', 'Hledat');
define('TEXT_GO_TO_SEARCH2', 'podle produktu<br>modelu');

include('includes/languages/order_edit_english.php');

define('TEXT_VALID_TITLE', 'Seznam kategorií');
define('TEXT_VALID_TITLE_PROD', 'Seznam produktů');
define('TEXT_VALID_CLOSE', 'Zavřít okno');

define('TABLE_HEADING_LASTNAME', 'Příjmení');
define('TABLE_HEADING_FIRSTNAME', 'Jméno');
define('TABLE_HEADING_PRODUCT_NAME', 'Název');
define('TABLE_HEADING_PRODUCT_PRICE', 'Cena');

define('TEXT_SELECT_CUSTOMER', 'Vyberte zákazníka');
define('TEXT_SELECT_CUSTOMER_PLACEHOLDER', 'Začněte zadávat ID zákazníka / jméno / telefon / e-mailovou adresu');
define('TEXT_SINGLE_CUSTOMER', 'Jeden zákazník');
define('TEXT_EMAIL_RECIPIENT', 'Příjemce e-mailu');


define('TEXT_NOTIFICATIONS', 'Upozornění');
define('TEXT_NOTIFICATIONS_MESSAGE', 'Máte %s objednávek čekajících na kontrolu');
define('TEXT_NOTIFICATIONS_LINK', 'Přejít na stránku objednávek');

define('TEXT_PROFILE', 'Profil');
define('TEXT_PROFILE_GREETINGS', 'Ahoj, %s!');
define('TEXT_PROFILE_LOGIN_COUNT', 'Počet přihlášení: %s');
define('TEXT_PROFILE_DAYS_WITH_US', 'Jste s námi %s dní');

define('TEXT_MENU_TITLE', 'Navigace');
define('TEXT_MENU_HOME', 'Domů');
define('TEXT_MENU_PRODUCTS', 'Produkty');
define('TEXT_MENU_CATALOGUE', 'Katalog');
define('TEXT_MENU_ATTRIBUTES', 'Atributy');
define('TEXT_MENU_ORDERS', 'Objednávky');
define('TEXT_MENU_REVIEWS', 'Recenze');
define('SQL_MODE_RECOMMENDATION_TEXT', "Pro další správnou práci je třeba kontaktovat administraci hostingu, aby resetovala proměnnou sql_mode v Mysql");
define('ROBOTS_TXT_RECOMMENDATION_TEXT', 'Robots.txt není součástí vašeho webu, pro úspěšnou propagaci jej doporučujeme povolit na <a target="_blank" href="/'.$admin.'/configuration.php?gID =1">stránka</a>');
define('CRITICAL_CSS_TXT_RECOMMENDATION_TEXT', '<span class="critical-text">Potřebuji vygenerovat kritické CSS</span> <span class="critical-process">Zpracovává se...čekejte prosím</span><a class=" start-generate-critical" href="javascript:void(0);">Start</a>');
define('ALERT_ERRORS_BLOCK_TITLE', 'Upozornění');

define('TEXT_MENU_ORDERS_LIST', 'Seznam objednávek');
define('TEXT_MENU_CLIENTS_LIST', 'Seznam zákazníků');
define('TEXT_MENU_CLIENTS_GROUPS', 'Skupiny zákazníků');
define('TEXT_MENU_ADD_CLIENT', 'Přidat zákazníka');
define('TEXT_MENU_PAGES', 'Stránky');
define('TEXT_MENU_SITE_MODULES', 'SOLO moduly');
define('TEXT_MENU_SITE_SEO_SETTINGS', 'Nastavení SEO');
define('TEXT_MENU_BACKUP', 'Záloha databáze');
define('TEXT_MENU_TOTAL_CONFIG', 'Celková konfigurace');
define('TEXT_MENU_NEWSLETTERS', 'Zpravodaje');
define('TEXT_MENU_SLOW_QUERIES_LOGS', 'Protokoly pomalých dotazů');
define('TEXT_MENU_PRODUCTS_VIEWS', 'Zobrazení produktů');
define('TEXT_MENU_CLIENTS', 'Zákazníci');
define('TEXT_MENU_SALES', 'Prodej');
define('TEXT_MENU_ADMINS_AND_GROUPS', 'Správci a skupiny');
define('TEXT_MENU_UPDATE_PROFILE', 'Aktualizovat profil');
define('TEXT_MENU_NOPHOTO', 'Žádná fotografie');
define('TEXT_MENU_OPENEDBY', 'Otevřeno');
define('TEXT_MENU_LAST_MODIFIED', 'Naposledy upraveno');
define('TEXT_MENU_ZEROQTY', 'Nulové množství');
define('TEXT_MENU_STATS_RECOVER_CART_SALES', 'Statistiky obnoví prodeje košíku');
define('TEXT_MENU_SEARCH', 'Hledat podle kategorie');

define('TEXT_HEADING_ADD_NEW', 'Přidat');
define('TEXT_HEADING_ADD_NEW_PRODUCT', 'Produkt');
define('TEXT_HEADING_ADD_NEW_CATEGORY', 'Kategorie');
define('TEXT_HEADING_ADD_NEW_PAGE', 'Stránka');
define('TEXT_HEADING_ADD_NEW_CLIENT', 'Zákazník');
define('TEXT_HEADING_ADD_NEW_ORDER', 'Objednávka');
define('TEXT_HEADING_ADD_NEW_COUPON', 'Kupón');

define('TEXT_BLOCK_ORDERS_STATUSES_COUNTERS', 'Stavy objednávek');

define('TEXT_BLOCK_ORDERS_TODAY_COUNTERS', 'Dnes');
define('TEXT_BLOCK_ORDERS_YESTERDAY_COUNTERS', 'Včera');
define('TEXT_BLOCK_ORDERS_WEEK_COUNTERS', 'Týden');
define('TEXT_BLOCK_ORDERS_MONTH_COUNTERS', 'Měsíc');
define('TEXT_BLOCK_ORDERS_QUARTER_COUNTERS', 'Čtvrtletí');
define('TEXT_BLOCK_ORDERS_ALL_TIME_COUNTERS', 'Všechny časy');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_CURRENCY', 'uah');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_PREFIX', 'pro');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_NOUN', 'objednávky');

define('TEXT_BLOCK_COUNTERS_PRODUCTS', 'Produkty');
define('TEXT_BLOCK_COUNTERS_ORDERS', 'Objednávky');
define('TEXT_BLOCK_COUNTERS_COMMENTS', 'Komentáře');
define('TEXT_BLOCK_COUNTERS_TOTAL_INCOME', 'Celkový příjem');

define('TEXT_BLOCK_SETTINGS_TITLE', 'Nastavení');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_HEADER', 'Opravené záhlaví');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_ASIDE', 'Opraveno');
define('TEXT_BLOCK_SETTINGS_TITLE_FOLDED_ASIDE', 'Složeno stranou');
define('TEXT_BLOCK_SETTINGS_TITLE_DOCK_ASIDE', 'Ukotvit stranou');

define('TEXT_BLOCK_MODULES_STATS_USING', 'Používání');
define('TEXT_BLOCK_MODULES_STATS_AMOUNT', 'pc.');
define('TEXT_BLOCK_MODULES_STATS_MODULES', 'modulů');
define('TEXT_BLOCK_MODULES_USED', 'Použité moduly');
define('TEXT_BLOCK_MODULES_SEE_ALL', 'Zobrazit všechny moduly');

define('TEXT_BLOCK_OVERVIEW_TITLE', 'Přehled');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS', 'Objednávky');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED', 'NEJLEPŠÍ pohledy');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD', 'NEJLEPŠÍ Prodej');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES', 'Nejlepší kategorie');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS', 'Přihlášení');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED', 'Vyhledávání');

define('TEXT_BLOCK_OVERVIEW_ACTION_EDIT', 'Upravit');
define('TEXT_BLOCK_OVERVIEW_ACTION_VIEW', 'Zobrazit');

define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_CUSTOMER_NAME', 'Jméno zákazníka');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_DATE', 'Datum');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_AMOUNT', 'Částka');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_STATUS', 'Stav');
define('TEXT_MENU_EMAIL_CONTENT', 'Šablony e-mailů');
define('TEXT_MENU_CKFINDER', 'Správce souborů');

define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODUCT_IMAGE', 'Obrázek produktu');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODCUT_NAME', 'Název produktu');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_VIEWS', 'Zobrazení');

define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODUCT_IMAGE', 'Obrázek produktu');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODCUT_NAME', 'Název produktu');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_ORDERS', 'Objednávky');

define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_CATEGORY_NAME', 'Název kategorie');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_ORDERS', 'Objednávky');

define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_ADMIN_NAME', 'Jméno správce');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_DATE', 'Datum posledního přihlášení');

define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_QUERY', 'Vyhledávací dotaz');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_COUNT', 'Počet hledání');

define('TEXT_BLOCK_NEWS_TITLE', 'SoloMono News');

define('TEXT_BLOCK_PLOT_TITLE', 'Graf příjmů');
define('TEXT_BLOCK_PLOT_TAB_BY_DAYS', 'Po dnech');
define('TEXT_BLOCK_PLOT_TAB_BY_WEEKS', 'Po týdnech');
define('TEXT_BLOCK_PLOT_TAB_BY_MONTHES', 'Podle měsíců');

define('TEXT_BLOCK_PLOT_XAXIS_LABEL', 'Celkový příjem');
define('TEXT_BLOCK_PLOT_YAXIS_LABEL', 'Počet objednávek');

define('TEXT_BLOCK_COMMENTS_TITLE', 'Komentáře');

define('TEXT_BLOCK_EVENTS_TITLE', 'Události');

define('TEXT_BLOCK_EVENTS_TOOLTIP_ALL_EVENTS', 'Všechny události');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ADMINS', 'Správci');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ORDERS', 'Objednávky');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CUSTOMERS', 'Zákazníci');
define('TEXT_BLOCK_EVENTS_TOOLTIP_NEW_PRODUCTS', 'Nové produkty');
define('TEXT_BLOCK_EVENTS_TOOLTIP_COMMENTS', 'Komentáře');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CALL_ME_BACK', 'Zavolejte mi zpět');
define('TOOLTIP_STOCK_REORDER_LEVEL', 'Určete množství zboží na skladě');





define('TEXT_BLOCK_EVENTS_MESSAGE_ADMINS', '%s zadáno do systému');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS', 'Mám %s');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS_2', 'objednávka #%d');
define('TEXT_BLOCK_EVENTS_MESSAGE_CUSTOMERS', '%s registrováno na webu');
define('TEXT_BLOCK_EVENTS_MESSAGE_NEW_PRODUCTS', 'Přidán nový produkt: "%s"');
define('TEXT_BLOCK_EVENTS_MESSAGE_COMMENTS', 'Uživatel %s přidal komentář');
define('TEXT_BLOCK_EVENTS_MESSAGE_CALL_ME_BACK', 'požádal o zpětné volání');

define('TEXT_BLOCK_GA_TITLE', 'Google Analytics');

define('TEXT_SETTINGS_EDIT_FORM_SAVE', 'OK');
define('TEXT_SETTINGS_EDIT_FORM_CANCEL', 'Zrušit');
define('TEXT_SETTINGS_EDIT_FORM_TOOLTIP', 'upravit');

define('TEXT_MODAL_ADD_ACTION', 'Přidat');
define('TEXT_MODAL_UPDATE_ACTION', 'Aktualizovat');
define('TEXT_MODAL_DELETE_ACTION', 'Smazat');
define('TEXT_MODAL_CHANGE_STATUS', 'Změnit stav');
define('TEXT_MODAL_DETAILED', 'Podrobné');
define('TEXT_MODAL_ACTION', 'Akce');
define('TEXT_MODAL_INSTALL_ACTION', 'Instalovat');
define('TEXT_MODAL_CONTINUE_ACTION', 'Pokračovat');
define('TEXT_MODAL_CANCEL_ACTION', 'Zrušit');
define('TEXT_MODAL_CONFIRM_ACTION', 'Potvrdit');
define('TEXT_MODAL_CONFIRMATION_ACTION', 'Jste si jistý?');
define('TEXT_WAIT', 'Počkejte ..');
define('TEXT_SHOW', 'Na stránku:');
define('TEXT_RECORDS', 'Celkem:');
define('TEXT_SAVE_DATA_OK', 'Data úspěšně změněna');
define('TEXT_DEL_OK', 'Záznam byl úspěšně smazán');
define('TEXT_ERROR', 'Došlo k chybě');
define('TEXT_GENERAL_SETTING', 'Obecné');

//vybrané
define('TEXT_FEATURED_ADDED', 'Přidáno');
define('TEXT_FEATURED_CHANGE', 'Změněno');
define('TEXT_FEATURED_EXPIRE_DATE', 'Datum vypršení platnosti');
define('TEXT_ENTER_PRODUCT', 'Zadejte název produktu');
define('TEXT_FEATURED_MODEL', 'Model');
define('TEXT_PRODUCTS_ON_ATTRIBUTES_VAL', 'Produkty s touto hodnotou volby');

define('ADMIN_BTN_BUY_MODULE', 'Kupte si tento modul!');
define('FOOTER_INSTRUCTION', 'Jak používat správce?');
define('FOOTER_NEWS', 'Solomono News');
define('FOOTER_SUPPORT_SOLOMONO', 'Technická podpora');
define('FOOTER_SUPPORT_CONSULTANT', 'Online poradce');
define('FOOTER_SUPPORT_TECHNICAL', 'Technická podpora');

//nový admin
define('TEXT_ERROR_DEL_FILE', 'Nelze smazat soubor.');
define('TEXT_ERROR_UPDATE', 'Chyba aktualizace.');

//languages_translater
define('TEXT_TRANSLATER_TITLE', 'Jazykový editor');

define('TEXT_REDIRECTS_TITLE', 'Rediobdélníky');

define('TEXT_PRODUCT_FREE_SHIPPING', 'Doprava zdarma:');

define('TEXT_MOBILE_OPEN_COLLAPSE', 'Zobrazit');
define('TEXT_MOBILE_CLOSE_COLLAPSE', 'Skrýt');
define('TEXT_ORDER_STATISTICS', 'Statistika objednávek');
define('TEXT_WHO_ONLINE', 'Kdo je online');
define('TEXT_VIEW_LIST', 'Zobrazit seznam');
define('TEXT_ACTION_OVERVIEW', 'Přehled akce');
define('TEXT_SEE_ALL', 'Zobrazit vše');

define('TEXT_MOBILE_SHOW_MORE', 'Zobrazit více');
define('TEXT_MOBILE_INCOME', 'Příjem:');
define('TEXT_SHOW_ALL', 'Zobrazit vše');
define('TEXT_REPLY_COMMENT', 'Odpovědět na komentář - ');
define('TEXT_BTN_REPLY', 'Odpovědět');
define('TEXT_BTN_ANSWERED', 'Odpovězeno');
define('TEXT_MODAL_APPLY_ACTION', 'Použít');

define('RECOVER_CART_SALES', 'Obnovení prodeje košíku');


define ('INSTAGRAM_PRODUCTS_TITLE', 'Import z Instagramu');
define ('INSTAGRAM_PRODUCTS_RESULT', 'Produkty nahrané do databáze');
define('INSTAGRAM_SUCCESS', 'Na naše stránky byly přidány příspěvky na Instagramu!');
define('INSTAGRAM_ERROR', 'Na naše stránky byly přidány příspěvky na Instagramu!');
define('INSTAGRAM_LINK', 'Odkaz na Instagram');
define('INSTAGRAM_COUNT', 'Počet příspěvků');

define('INSTAGRAM_MODULE_ENABLE_TITLE', 'Instagram slider');

define('BOX_PRODUCTS_STATS_MENU_ITEM', 'Produkty');


define('BOX_CLIENTS_STATS_TOP_CLIENTS', 'Nejlepší zákazníci');
define('BOX_CLIENTS_STATS_NEW_CLIENTS', 'Noví zákazníci');


define('BOX_MENU_TOOLS_EMAILS', 'E-mailový newsletter');
define('BOX_MENU_TOOLS_MASS_EMAILS', 'Hromadné rozesílání');


define('BOX_EXEL_IMPORT_EXPORT', 'Import / export Excelu');
define('BOX_PROM_IMPORT_EXPORT', 'Import Prom.ua Excel');
define('IMPORT_EXPORT_MENU_BOX', 'Import Export');

define('TEXT_ENABLE_MULTILANGUAGE_MODULE', 'Povolte prosím vícejazyčný modul');
define('TEXT_BUY_MULTILANGUAGE_MODULE', 'Zakupte si prosím vícejazyčný modul');

define('BOX_MENU_TAXES', 'Daň');


define('INTEGRATION_CONF_TITLE', 'Další integrace');

define('BOX_HEADING_INSTRUCTION', 'Pokyny');

define('BOX_CATALOG_YML', 'Import XML (YML)');
define('TOOLTIP_CATEGORY_STATUS', 'Po aktivaci se kategorie / podkategorie / produkt zobrazí na stránce webu');
define('TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS', 'Chcete-li přidat kategorii / podkategorii / produkt do kanálu Google. Chcete-li zahrnout pouze jeden produkt, musí být zahrnuta kategorie a podkategorie, ve které se produkt nachází.');
define('TOOLTIP_PRODUCTS_FEATURED', 'Zobrazeno na domovské stránce.');
define('TOOLTIP_PRODUCTS_RELATED', 'Zobrazuje se na stránce produktu v článcích.');
define('TOOLTIP_PRODUCTS_ATTRIBUTES', 'Atributy (filtry) vám umožňují definovat další vlastnosti produktu, jako je velikost nebo barva. Přečtěte si více v pokynech: LINK');
define('TOOLTIP_ATTRIBUTES_VALUES', 'Po vytvoření atributu vyplňte požadované hodnoty.');
define('TOOLTIP_ATTRIBUTES_GROUPS', 'Pro sloučení více atributů do jedné skupiny.');
define('TOOLTIP_ATTRIBUTES_TYPES', 'Text – textový popis vlastností; Rozbalovací nabídka – výběr z rozevíracího seznamu; Rádio – výběr z nabízených možností; Obrázek – karta se změní, když je vybrána hodnota položky; Zobrazí se na stránka produktu.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_FILTER', 'Chcete-li zobrazit atributy produktu v panelu filtru, přesuňte posuvník, aby byl aktivní.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_LISTING', 'Najetím na produkt zobrazíte atributy v seznamu produktů.');
define('TOOLTIP_SPECIALS', 'Pro nastavení speciální ceny pro jeden produkt.');
define('TOOLTIP_SALES_MAKERS', 'Pro nastavení slev pro několik nebo všechny kategorie zboží a/nebo výrobců.');
define('TOOLTIP_EXPORT_IMPORT_CSV', 'Pro načtení/uvolnění databáze ze souboru s příponou .csv.');
define('TOOLTIP_EXPORT_IMPORT_PROM', 'Pro export databáze ze souboru importovaného z Prom.');
define('TOOLTIP_ORDER_DATE', 'Zobrazit objednávky pro zvolené časové období.');
define('TOOLTIP_ORDER_DETAILS', 'podrobnosti objednávky');
define('TOOLTIP_ORDER_EDIT', 'upravit objednávku');
define('TOOLTIP_ORDER_STATUS', 'Chcete-li přidat nový stav objednávky, klikněte na &quot;+&quot;');
define('TOOLTIP_CLIENT_EDIT', 'edit');
define('TOOLTIP_CLIENT_GROUP_PRICE', 'Cena, která se po autorizaci zobrazí na stránkách pro klienty určité skupiny. Počet cen je nastaven v sekci "Můj obchod"');
define('TOOLTIP_CLIENT_PRICE_GROUP_LIMIT', 'Když částka dosáhne limitu, můžete klienta převést do jiné skupiny.');
define('TOOLTIP_CLIENT_GROUP_EDIT', 'upravit');
define('TOOLTIP_EMAIL_TEMPLATE', 'Hotové šablony dopisů pro odeslání klientům.');
define('TOOLTIP_EMAIL_TEMPLATE_EDIT', 'upravit');
define('TOOLTIP_FILE_MANAGER', 'Pro nahrávání a úpravu souborů na webu.');
define('TOOLTIP_REDIRECTS', 'Například potřebujete přesměrovat z https://demo.solomono.net/kontakty na https://demo.solomono.net/contact_us.php. Musíte zadat v řádku &quot; přesměrovat z" kontakty "přesměrovat na" contact_us.php');
define('TOOLTIP_MODULES_PAYMENT', 'Přidejte dostupné způsoby platby.');
define('TOOLTIP_MODULES_SHIPPING', 'Přidat dostupnou dopravu mmetody.');
define('TOOLTIP_MODULES_TOTALS', 'Celková cena objednávky je zobrazena na stránce pokladny.');
define('TOOLTIP_MODULES_ZONE', 'Upřesněte možné způsoby doručení pro určité zóny a také povolené způsoby platby pro tyto zóny. Novou zónu můžete vytvořit v sekci Nastavení-&gt; Daně-&gt; Daňové zóny');
define('TOOLTIP_MODULES_LANGUAGES', 'Výběr jazyků stránek, nastavení výchozího jazyka.');
define('TOOLTIP_MODULES_CURRENCY', 'Nastavte výchozí měnu a nastavte hodnotu podle kurzu.');
define('TOOLTIP_MODULES_COUPONS', 'Vytvořte kupon, který může zákazník uplatnit v košíku a získat slevu.');
define('TOOLTIP_MODULES_POOLS', 'Vytvořte průzkum pro získání statistik, které potřebujete.');
define('TOOLTIP_MODULES_SOLOMONO', 'Seznam zakoupených modulů + seznam dostupných ke koupi.');
define('TOOLTIP_CONFIGURATION_MAIN_EMAIL', 'Hlavní adresa, kam přicházejí všechna upozornění.');
define('TOOLTIP_CONFIGURATION_FROM_EMAIL', 'Určete adresu, ze které chcete posílat všechny dopisy hromadně.');
define('TOOLTIP_CONFIGURATION_ORDER_COPY_EMAIL', 'Uveďte všechny adresy, na které budou zasílány kopie dopisů s objednávkami. Můžete zadat více e-mailů oddělených čárkami s mezerami.');
define('TOOLTIP_CONTACT_US_EMAIL', 'Zadejte adresu, na kterou budou zasílány požadavky ze stránky "Kontaktujte nás"');
define('TOOLTIP_STORE_COUNTRY', 'Uveďte zemi obchodu, bude vybrána jako výchozí při zadávání objednávky.');
define('TOOLTIP_STORE_REGION', 'Zadejte oblast obchodu, bude vybrána ve výchozím nastavení při zadávání objednávky.');
define('TOOLTIP_CONTACT_ADDRESS', 'Zadejte adresu obchodu, zobrazí se na stránce &quot;Kontakty&quot;.');
define('TOOLTIP_MINIMUM_ORDER', 'Volitelně můžete zadat minimální částku pro úspěšnou objednávku.');
define('TOOLTIP_MASTER_PASSWORD', 'Heslo, které je vhodné pro zadání účtu libovolného klienta registrovaného na stránce.');
define('TOOLTIP_SHOW_PRICE_WITH_TAX', 'Posunutím posuvníku zobrazíte ceny na všech stránkách webu, včetně daně.');
define('TOOLTIP_CALCULATE_TAX', 'Pokud je zahrnuta, bude zohledněna nastavená daň z produktu při placení.');
define('TOOLTIP_EXTRA_PRICE', 'Volitelně můžete nastavit označení, které se bude zobrazovat neregistrovaným uživatelům webu.');
define('TOOLTIP_PRICES_COUNT', 'Uveďte možný počet cen, které budou nastaveny pro zboží (např. několik cen pro různé skupiny zákazníků)');
define('TOOLTIP_SHOW_PRICE_TO_NOT_AUTHORIZED_CUSTOMER', 'Zobrazení cen produktů pro neregistrované uživatele');
define('TOOLTIP_LOGO', 'Vyberte logo (obrázek), které se má zobrazit na domovské stránce');
define('TOOLTIP_WATERMARK', 'Vyberte obrázek, který se má vložit na fotografii produktu, ochrana proti kopírování.');
define('TOOLTIP_FAVICON', 'Vyberte obrázek, který má být zobrazen ikonou webové stránky');
define('TOOLTIP_AUTO_STOCK', 'Při zadávání objednávky se automaticky kontroluje počet zboží na skladě a jeho dostupnost pro objednávku.');
define('TOOLTIP_DISABLED_BUY_BUTTON_FOR_ZERO_STOCK', 'Na stránce produktu, který není skladem, se zobrazí tlačítko "koupit".');
define('TOOLTIP_STOCK_AUTO_INCREMENT', 'Při zadávání objednávky je množství zakoupeného zboží automaticky odečteno ze zůstatku ve skladu.');
define('TOOLTIP_ALLOW_ZERO_STOCK_ORDER', 'Umožní zadat objednávku na produkt, který není skladem.');
define('TOOLTIP_MARK_ZERO_STOCK_PRODUCT', 'Pokud položka vložená do košíku není v požadovaném množství skladem, položka bude označena zadanou hodnotou.');
define('TOOLTIP_ZERO_STOCK_NOTIFICATION', 'Po dosažení tohoto množství je zasláno upozornění na e-mail, že zboží dochází.');
define('TOOLTIP_SMS_TEXT', 'Určete text, který bude odeslán klientovi.');
define('TOOLTIP_SMS_LOGIN', 'Poskytuje poskytovatel sms.');
define('TOOLTIP_SMS_PASSWORD', 'Poskytuje poskytovatel sms.');
define('TOOLTIP_SMS_CODE_1', 'Telefonní číslo nebo alfanumerický odesílatel.');
define('TOOLTIP_SMS_CODE_2', 'Poskytuje poskytovatel sms.');
define('TOOLTIP_TAX_ADD', 'Chcete-li přidat nový typ daně, klikněte na "+" a vyplňte požadovaná pole.');
define('TOOLTIP_TAX_RATE_ADD', 'Chcete-li přidat procentuální sazbu, která bude přidána k ceně produktu, klikněte na "+" a vyplňte požadovaná pole.');
define('TOOLTIP_TAX_ZONE_ADD', 'Chcete-li přidat zónu (země), na kterou se bude daň vztahovat, klikněte na &quot;+&quot; a vyplňte požadovaná pole.');
define('TOOLTIP_BACKUP_CREATE', 'Vytvořte záložní kopii aktuální verze databáze webu.');
define('TOOLTIP_BACKUP_LOAD', 'Obnova databáze z vybraného souboru.');
define('TOOLTIP_EMAILING', 'Zaslání e-mailu jednomu zákazníkovi, všem zákazníkům nebo všem odběratelům novinek.');
define('TOOLTIP_MASS_EMAILING', 'Zasílání e-mailů jednotlivému zákazníkovi nebo vybrané skupině zákazníků.');
define('TOOLTIP_CLEAR_CACHE', 'Vymazání nahraných obrázků z mezipaměti.');
define('TOOLTIP_STATS_SALES', 'Zobrazení statistik prodeje.');
define('TOOLTIP_STATS_SALES_PRODUCTS_BY_TIME_PERIOD', 'Výkaz prodeje objednaného zboží za zvolené časové období.');
define('TOOLTIP_STATS_SALES_CATEGORIES_BY_TIME_PERIOD', 'Přehled prodeje podle kategorií produktů za zvolené časové období.');
define('TOOLTIP_STATS_VIEWED_PRODUCTS', 'Statistiky prohlížených produktů.');
define('TOOLTIP_STATS_ZERO_QUANTITY_PRODUCTS', 'Produkt není na skladě.');
define('TOOLTIP_STATS_CLIENTS_ORDERS', 'Hlášení o nákupech zákazníků za zvolené časové období.');
define('TOOLTIP_ADMINISTRATORS', 'Seznam správců webu.');
define('TOOLTIP_ADMINISTRATORS_GROUPS', 'Rozdělení administrátorů do skupin.');
define('TOOLTIP_ADMINISTRATORS_ACCESS_RIGHTS', 'Přístupová práva k informacím na webu v závislosti na skupině administrátorů.');
define('TOOLTIP_TEXT_COPIED', 'Text zkopírován');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY', 'koupit');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON', 'zapnout');
define('TOOLTIP_TEXT_TAB_LANGUAGES', 'Funkce jazyka');
define('TOOLTIP_TEXT_TAB_AUTO_TRANSLATE', 'Automatický hromadný překlad obsahu');
define('TOOLTIP_TEXT_TAB_EDIT_TRANSLATE', 'Upravit překlady');

define('TOOLTIP_TELEGRAM_NOTIFICATIONS_ENABLED', 'Můžete povolit/zakázat telegramová upozornění');
define('TOOLTIP_TELEGRAM_TOKEN', 'Speciální telegramové účty vytvořené pro automatické zpracování a odesílání zpráv');
define('TOOLTIP_SMS_ENABLE', 'Lze povolit/zakázat službu SMS');
define('TOOLTIP_SMS_CUSTOMER_ENABLE', 'Můžete povolit / zakázat možnost posílat sms klientovi při nákupu');
define('TOOLTIP_SMS_CHANGE_STATUS', 'Můžete povolit / zakázat možnost odesílání SMS na klienta při změně stavu');
define('TOOLTIP_SMS_OWNER_ENABLE', 'Můžete povolit / zakázat možnost posílat sms správci při nákupu');
define('TOOLTIP_SMS_OWNER_TEL', 'Zadejte/změňte telefonní číslo správce');


define('TOOLTIP_FACEBOOK_AUTH_STATUS', 'Můžete umožnit uživatelům přihlásit se na vaše stránky pomocí účtu na Facebooku. Je to skvělý způsob, jak tento proces zjednodušit a usnadnit vašim uživatelům a také zvýšit počet nových registrací.' );
define('TOOLTIP_FACEBOOK_APP_ID', 'ID sociální sítě je kombinace čísel, která odlišuje jeden účet od ostatních. Na internetu je to obdoba pasu, který často vyžaduje použití spolehlivých metod ochrany. Identifikační číslo je generuje se automaticky při registraci profilu. Pomocí něj můžete najít informace, které potřebujete, osobu nebo zájmovou komunitu.');
define('TOOLTIP_FACEBOOK_APP_SECRET', 'Tajný klíč je zařízení k ochraně vašeho účtu na Facebooku. Je to také dvoufaktorová metoda ověřování, která zvyšuje úroveň zabezpečení při přihlašování k vašemu účtu.');
define('TOOLTIP_FACEBOOK_PIXEL_ID', 'Pomocí dat, která Facebook Pixel shromažďuje, můžete sledovat návštěvy a konverze na vašem webu, optimalizovat reklamy a vytvářet vlastní publikum pro retargeting.');
define('TOOLTIP_DEFAULT_PIXEL_CURRENCY', 'Určete měnu, ve které bude cena produktu odeslána na FaceBook Pixel');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_BUG_REPORT', 'Je určen k popisu zjištěných chyb, které umožní vývojovému týmu opravit chyby v programu.');
define('TOOLTIP_FACEBOOK_GOALS_PHONE_CALL', 'Spouštěním reklam s telefonním číslem můžete povzbudit lidi, aby zavolali do vaší společnosti a zadali objednávku, dozvěděli se více o vašich produktech nebo službách nebo si naplánovali schůzku.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_FAST_BUY', 'Pokud je zboží nakupováno pravidelně, často jsou vlastnosti již kupujícímu známé, není úkolem vybrat si, ale najít to správné, přidat do košíku a rychle zadat objednávku.') ;
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_CHAT', 'Tlačítko chatu je ikona umístěná někde na vašem webu, která umožňuje zákazníkům komunikovat v reálném čase s týmem zákaznické podpory. Pomocí online chatu mohou vaši specialisté rychle a efektivně řešit požadavky zákazníků.' );
define('TOOLTIP_FACEBOOK_GOALS_CALLBACK', 'Úkolem tlačítka zpětného volání je přivést potenciálního klienta ke komunikaci.');
define('TOOLTIP_FACEBOOK_GOALS_FILTER', 'Filtr umožňuje zúžit sortiment na výběr s vlastnostmi, které nejvíce odpovídají individuálním potřebám uživatele.');
define('TOOLTIP_FACEBOOK_GOALS_SUBSCRIBE', 'Poskytuje uživatelům možnost organizovat a udržovat tematické e-mailové zpravodaje, které mohou odebírat ostatní uživatelé služby.');
define('TOOLTIP_FACEBOOK_GOALS_LOGIN', 'login je slovo, které bude použito pro vstup na stránku nebo službu. Velmi často se přihlašovací jméno shoduje s uživatelským jménem, ​​které bude viditelné všem účastníkům služby.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_REVIEW', 'Zákaznické recenze – Zpětná vazba od uživatelů na vaše produkty nebo služby. Aby si 89 % kupujících koupilo produkt, nejprve si přečte recenze.');
define('TOOLTIP_FACEBOOK_GOALS_PAGE_VIEW', 'Můžete vědět, kolik lidí vidělo a vyžádalo si vášstránky');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_CART', 'Tlačítko "Přidat do košíku" znamená nákup několika produktů, když jsou poprvé přidány do košíku a je zde již zadána objednávka.');
define('TOOLTIP_FACEBOOK_GOALS_CHECKOUT_PROCESS', 'Kvalita a pohodlí používání nákupního košíku je zárukou dobré nálady pro vaše zákazníky, efektivní způsob, jak zvýšit konverzi webových stránek.');
define('TOOLTIP_FACEBOOK_GOALS_SEARCH_RESULTS', 'Přenese uživatele na stránku s výsledky vyhledávání');
define('TOOLTIP_FACEBOOK_GOALS_VIEW_CONTENT', 'ViewContent vám řekne, zda někdo navštěvuje URL webové stránky.');
define('TOOLTIP_FACEBOOK_GOALS_COMPLETE_REGISTRATION', 'Poskytování informací klientem výměnou za službu poskytovanou vaší společností');
define('TOOLTIP_FACEBOOK_GOALS_CONTACT_US_REQUEST', 'Kontaktní údaje osoby, která projevila skutečný zájem o produkty a služby společnosti a může se v budoucnu stát skutečným klientem.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_WISHLIST', 'Jedna z událostí, která vám umožní sledovat akce uživatelů, optimalizovat je a vytvářet publikum');
define('TOOLTIP_FACEBOOK_GOALS_ADD_PAYMENT_INFO', 'Jedna z událostí, která vám umožní sledovat akce uživatelů, optimalizovat je a vytvářet publikum');
define('TOOLTIP_FACEBOOK_GOALS_SUCCESS_PAGE', 'Klient vidí jakousi fakturu o dokonalé objednávce.');


define('TOOLTIP_GOOGLE_OAUTH_STATUS', 'Možnost aktivovat/deaktivovat autorizaci klienta přes Google');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_ID', 'Ve výchozím nastavení Google přiděluje jedinečné ID klienta – ID klienta.');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_SECRET', 'CLIENT_SECRET se používá k ukládání trochu citlivějších informací, jako je použití rozhraní API, informace o provozu a fakturační údaje');
define('TOOLTIP_GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED', 'Má nástroj pro sledování událostí, umožňuje službám shromažďovat data a provádět analýzy');
define('TOOLTIP_GOOGLE_ECOMM_SUCCESS_PAGE', 'Možnost aktivovat/deaktivovat stránku "nákup" po potvrzení objednávky');
define('TOOLTIP_GOOGLE_ECOMM_CHECKOUT_PAGE', 'Možnost aktivovat/deaktivovat stránku pokladny');
define('TOOLTIP_GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE', 'Možnost aktivovat/deaktivovat stránku zobrazení produktu');
define('TOOLTIP_GOOGLE_ECOMM_SEARCH_RESULTS', 'Možnost aktivovat/deaktivovat stránku s výsledky vyhledávání');
define('TOOLTIP_GOOGLE_ECOMM_HOME_PAGE', 'Možnost aktivovat / deaktivovat úvodní stránku při načítání prohlížeče');
define('TOOLTIP_GOOGLE_SITE_VERIFICATION_KEY', 'Klíč poskytnutý společností Google (stačí vložit samotný klíč)');
define('TOOLTIP_GOOGLE_RECAPTCHA_STATUS', 'Můžete zapnout/vypnout Google Recaptcha (ochrana webových stránek před internetovými roboty a zároveň pomoc při digitalizaci textů knih)');
define('TOOLTIP_GOOGLE_RECAPTCHA_PUBLIC_KEY', 'Poskytuje službu Google (pro ochranu webových stránek před internetovými roboty a zároveň pomáhá při digitalizaci textů knih)');
define('TOOLTIP_GOOGLE_RECAPTCHA_SECRET_KEY', 'Poskytuje službu Google (pro ochranu webových stránek před internetovými roboty a zároveň pomáhá při digitalizaci textů knih)');




define('TOOLTIP_ENTRY_FIRST_NAME_MIN_LENGTH', "Uveďte minimální počet znaků ve sloupci 'Hodnota' pro každý parametr");
define('TOOLTIP_ENTRY_LAST_NAME_MIN_LENGTH', "Specifikujte minimální počet znaků ve sloupci 'Hodnota' pro každý parametr");
define('TOOLTIP_ENTRY_EMAIL_ADDRESS_MIN_LENGTH', "Uveďte minimální počet znaků ve sloupci 'Hodnota' pro každý parametr");
define('TOOLTIP_MIN_DISPLAY_XSELL', "Specifikujte minimální počet znaků ve sloupci 'Hodnota' pro každý parametr");

define('HIGHSLIDE_CLOSE', 'Zavřít');
define('COMMENT_BY_ADMIN', 'Komentář administrátora');
define('AUTO_TRANSLATE_MODULE_ENABLED_TITLE', 'Automatický překlad');
define('TEXT_CLOSE_BUTTON', 'Zavřít');
define('TEXT_MENU_WHO_IS_ONLINE', 'Kdo je online');
define('INFO_ICON_NEED_MINIFY', 'Jakékoli změny v tomto modulu změní stav stylů na Minify Now');
define('INFO_ICON_ENABLE_SMTP', 'Při zapnutí zkontrolujte nastavení SMTP');
define('SMTP_CONF_TITLE', 'Nastavení SMTP');
define('INFO_ICON_NEED_GENERATE_CRITICAL', 'Změny tohoto parametru vyžadují kritickou regeneraci CSS');
define('YANDEX_MARKET_MODULE_ENABLED_TITLE', 'export XML (YML) produktů "Yandex Market"');
define('TEXT_INFO_BUY_MODULE', 'Modul «%s» je vypnutý, pro jeho zapnutí použijte stránku <a href="%s"><span style="color:blue;" >Moduly</span>< /a>');
define('TEXT_INFO_DISABLE_MODULE', 'Neexistuje žádný modul «%s», pro jeho přidání použijte <a href="%s"><span style="color:blue;" >SoloMono Modules Store</span></ a>');
define("TEXT_POPULAR_SEARCH_QUERIES", "Populární vyhledávání");
define("STATS_KEYWORDS_POPULAR_ENABLED_TITLE", "Vyhledat stránky");
define("LIST_MODAL_ON","modální produkt");
define("SHOW_KOŠÍK_ON_ADD_TO_KOŠÍKU_TITLE","Zobrazit košík při přidávání položky");
define("TEXT_QUICK_ORDER", "Rychlá objednávka");
define("TEXT_VIEWED","Zobrazeno");
define('EMAIL_CONTENT_MODULE_ENABLED_TITLE', 'Šablony e-mailu');
define('ENTRY_CREDIT_CARD_CC_TYPE', 'Typ karty');
define('ENTRY_CREDIT_CARD_CC_OWNER', 'Vlastník karty');
define('ENTRY_CREDIT_CARD_CC_NUMBER', 'Číslo karty');
define('ENTRY_CREDIT_CARD_CC_EXPIRES', ' Platnost karty vyprší');
define('TEXT_SEARCH_PAGES','Hledat stránky');
define('SMTP_MODULE_ENABLED_TITLE','SMTP');

define('LEFT_MENU_SECTION_TITLE_SHOP','Obchod');
define('LEFT_MENU_SECTION_TITLE_INFO','Info');
define('LEFT_MENU_SECTION_TITLE_CONTROL','Ovládání');
define('TBL_LINK_TITLE', 'Kategorie Ajax');
define('TBL_HEADING_TITLE_BACK_TO_PARENT', 'Zpět');
define('TBL_HEADING_TITLE_SEARCH', 'Hledat');
define('TBL_HEADING_CATEGORIES_PRODUCTS', 'Kategorie/Produkty');
define('TBL_HEADING_MODEL', 'Cod');
define('TBL_HEADING_QUANTITY', 'Množství');
define('TBL_HEADING_PRICE', 'Cena');
define('TBL_HEADING_TITLE_BACK_TO_DEFAULT_ADMIN', 'Zpět na výchozí administraci');
define('TBL_HEADING_PRODUCTS_COUNT', ' produkty');
define('TBL_HEADING_SUBCATEGORIES_COUNT', ' podkategorie');
define('TBL_HEADING_SUBCATEGORIE_COUNT', ' podkategorie');
define('INTEGRATION_FACEBOOK_CONF_TITLE','Integrace Facebook');
define('INTEGRATION_GOOGLE_CONF_TITLE','Integrace GOOGLE');
define('SEO_SETTINGS_CONF_TITLE','Nastavení SEO');

define('NWPOSHTA_DELIVERY_TITLE', 'Nová adresa pro doručování pošty');

define('HEADER_BUY_TEMPLATE_LINK','Přepnout na placený balíček');
define('HEADER_MARKETPLACE_LINK','Tržiště modulů');

define('ERROR_DOMAIN_IN_USE','Chyba! Tato doména se již používá');
define('ERROR_ANAME_MISMATCH', 'Chyba! Jméno A neodpovídá 167.172.41.152. Zkuste později');
define('SUCCESS_DOMAIN_CHANGE', 'Úspěch! Doména změněna');
define('ERROR_ADD_DOMAIN_FIRST','Nejprve připojte svou vlastní doménu!');
define('ERROR_BASH_EXECUTION','Chyba při provádění skriptu, správce kontaktů');
define('BOX_COUPONS', 'Promo codes');
define('PRODUCTS_LIMIT_REACHED_FREE', 'Překročen limit produktu! Vaše stránky budou automaticky deaktivovány za %s dní. <a href="%s">Pronajměte si poplatek</a> nebo odstraňte nežádoucí produkty');
define('PRODUCTS_LIMIT_REACHED_JUNIOR', 'Překročen limit produktu! Za %s dní bude váš web automaticky upgradován na seo balíček.');
define('PRODUCTS_LIMIT_REACHED_SEO', 'Překročen limit produktu! Za %s dní bude váš web automaticky upgradován na profesionální balíček');
define('PRODUCTS_LIMIT_REACHED_HEADING', 'Překročen limit produktu!');