<?php
/*
  $Id: russian.php,v 1.3 2003/09/28 23:37:26 anotherlango Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
// Google SiteMaps
define('BOX_TOOLS_COMMENT8R', 'Kommentare');
define  ('BOX_GOOGLE_SITEMAP', 'Google SiteMaps');
define('BOX_CLEAR_IMAGE_CACHE', 'Cache für Bilder leeren');

define('TBL_LINK_TITLE', 'Ajax-Kategorie');
define('TBL_HEADING_TITLE_BACK_TO_PARENT', 'Zurück');
define('TBL_HEADING_TITLE_SEARCH', 'Suche');
define('TBL_HEADING_CATEGORIES_PRODUCTS', 'Kategorien/Produkte');
define('TBL_HEADING_MODEL', 'Code');
define('TBL_HEADING_QUANTITY', 'Menge');
define('TBL_HEADING_PRICE', 'Preis');
define('TEXT_MENU_REVIEWS', 'Bewertungen');
define('SQL_MODE_RECOMMENDATION_TEXT', "For further correct work, you need to contact the hosting administration to reset the sql_mode variable in Mysql");
define('ROBOTS_TXT_RECOMMENDATION_TEXT', 'Robots.txt is not included on your site, for successful promotion we recommend that you enable it on <a target="_blank" href="/'.$admin.'/configuration.php?gID=1">page</a>');
define('CRITICAL_CSS_TXT_RECOMMENDATION_TEXT', '<span class="critical-text">Müssen kritisches CSS generieren</span> <span class="critical-process">Verarbeite...Bitte warten</span><a class="start-generate-critical" href="javascript:void(0);">Start</a>');
define('ALERT_ERRORS_BLOCK_TITLE', 'Warnungen');
define('DOMEN_IN_ROBOTS_TXT_RECOMMENDATION_TEXT', '<span class="robots-txt-text">in Robots.txt stimmt die Host-Direktive nicht mit dem Namen Ihrer Website überein, für eine erfolgreiche Werbung empfehlen wir dies</span> <span class="generate-robots-txt-process">Verarbeite .. Bitte warten</span><a class="start-generate-robots-txt" href="javascript:void(0);"> zu regenerieren</a>');

define('TBL_HEADING_TITLE_BACK_TO_DEFAULT_ADMIN', 'Zurück zur Standardverwaltung');
define('TBL_HEADING_PRODUCTS_COUNT', 'Waren');
define('GOOGLE_FEED_MODULE_ENABLED_TITLE', 'Google Feed');
define('TBL_HEADING_SUBCATEGORIES_COUNT', 'Unterkategorien');
define('TBL_HEADING_SUBCATEGORIE_COUNT', 'Unterkategorie');
define('TEXT_PRODILE_INFO_CHANGE_PASSWORD', 'Ändern Sie Ihr eigenes Passwort');

//Admin begin
// header text in includes/header.php
define('HEADER_TITLE_LOGOFF', 'Exit');
define('HEADER_TITLE_HELLO', 'Hallo');
define('HEADER_FRONT_LINK_TEXT', 'Go to site');
define('HEADER_ADMIN_TEXT', 'Adminpanel');
define('HEADER_ORDERS_TODAY', 'Bestellungen heute: ');
define('HEADER_GO_TO_SITE', 'Zur Website gehen');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Admins');
define('BOX_ADMINISTRATOR_MEMBERS', 'Benutzergruppen');
define('BOX_ADMINISTRATOR_MEMBER', 'Benutzer');
define('BOX_ADMINISTRATOR_BOXES', 'Berechtigungen');
define('BOX_ADMINISTRATOR_ACCOUNT_UPDATE', 'Informationen über dich aktualisieren');
define('BOX_CATALOG_SEO_FILTER', "SEO filter");
define('BOX_CATALOG_SEO_TEMPALTES', "SEO-Vorlagen");
define('BOX_CATALOG_STATS_SEARCH_KEYWORDS', "Schlagwortplaner");
// limex: mod query performance START
define('TEXT_DISPLAY_NUMBER_OF_QUERIES', 'Anzeige <b>%d</b> - <b>%d</b> (aus <b>%d</b> Abfragen)');
define('BOX_TOOLS_MYSQL_PERFORMANCE', 'Langsame Abfragen');
define('TEXT_DELETE', 'Alle Datensätze löschen?');
define('IMAGE_BUTTON_DELETE', 'Alle Datensätze löschen');
define('IMAGE_BUTTON_CANCEL', 'Einträge nicht löschen');
// limex: mod query performance END


// mod for ez price updater
define('BOX_CATALOG_PRICE_QUICK_UPDATES', 'Schnelle Preisänderung');
define('BOX_CATALOG_PRICE_UPDATE_VISIBLE', 'Sichtbare Preisänderung');
define('BOX_CATALOG_PRICE_UPDATE__ALL', 'alle Preise ändern');
define('BOX_CATALOG_PRICE_CANGE', 'Preis ändern');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI', 'Waren verwalten');


define('TEXT_INDEX_LANGUAGE', 'Sprache:');
define('TEXT_SUMMARY_CUSTOMERS', 'Buyers');
define('TEXT_SUMMARY_ORDERS', 'Bestellungen');
define('TEXT_SUMMARY_PRODUCTS', 'Produkte');
define('TEXT_SUMMARY_HELP', 'Hilfe');
define('TEXT_SUMMARY_STAT', 'Statistiken');
define('TABLE_HEADING_CUSTOMERS', 'Buyers');

define('TEXT_MENU_TOTAL_CONFIG', 'Gesamtkonfiguration');

define('TEXT_GO_TO_CAT', 'Gehe zu');
define('TEXT_GO_TO_SEARCH', 'Suche');
define('TEXT_GO_TO_SEARCH2', 'nach Produktcode');

// images
define('IMAGE_FILE_PERMISSION', 'Zugriffsrechte');
define('IMAGE_GROUPS', 'Gruppenliste');
define('IMAGE_INSERT_FILE', 'Datei hinzufügen');
define('IMAGE_MEMBERS', 'Liste der Benutzer');
define('IMAGE_NEW_GROUP', 'Gruppen hinzufügen');
define('IMAGE_NEW_MEMBER', 'Benutzer hinzufügen');
define('IMAGE_NEXT', 'Next');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Zeige <b>%d</b> - <b>%d</b> (insgesamt <b>%d</b> Dateien)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Zeige <b>%d</b> - <b>%d</b> (Gesamt <b>%d</b> Benutzer)');
//Admin end

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'de_DE.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
//define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', '%d %B %Y y.'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_FORMAT_SPIFFYCAL', 'dd/MM/yyyy');  //Use only 'dd', 'MM' and 'yyyy' here in any order


define('TEXT_DAY_1','Montag');
define('TEXT_DAY_2','Dienstag');
define('TEXT_DAY_3','Mittwoch');
define('TEXT_DAY_4','Donnerstag');
define('TEXT_DAY_5','Freitag');
define('TEXT_DAY_6','Samstag');
define('TEXT_DAY_7','Sonntag');
define('TEXT_DAY_SHORT_1','MON');
define('TEXT_DAY_SHORT_2','TUE');
define('TEXT_DAY_SHORT_3','WED');
define('TEXT_DAY_SHORT_4','THU');
define('TEXT_DAY_SHORT_5','FRI');
define('TEXT_DAY_SHORT_6','SAT');
define('TEXT_DAY_SHORT_7','SUN');
define('TEXT_MONTH_BASE_1','Januar');
define('TEXT_MONTH_BASE_2','Februar');
define('TEXT_MONTH_BASE_3','März');
define('TEXT_MONTH_BASE_4','April');
define('TEXT_MONTH_BASE_5','Mai');
define('TEXT_MONTH_BASE_6','Juni');
define('TEXT_MONTH_BASE_7','Juli');
define('TEXT_MONTH_BASE_8','August');
define('TEXT_MONTH_BASE_9','September');
define('TEXT_MONTH_BASE_10','Oktober');
define('TEXT_MONTH_BASE_11','November');
define('TEXT_MONTH_BASE_12','Dezember');
define('TEXT_MONTH_1','Januar');
define('TEXT_MONTH_2','Februar');
define('TEXT_MONTH_3','März');
define('TEXT_MONTH_4','April');
define('TEXT_MONTH_5','Mai');
define('TEXT_MONTH_6','Juni');
define('TEXT_MONTH_7','Juli');
define('TEXT_MONTH_8','August');
define('TEXT_MONTH_9','September');
define('TEXT_MONTH_10','Oktober');
define('TEXT_MONTH_11','November');
define('TEXT_MONTH_12','Dezember');

// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="de"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// page title
define('TITLE', 'Administration');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administration');
define('HEADER_TITLE_SUPPORT_SITE', 'Support-Site');
define('HEADER_TITLE_ONLINE_CATALOG', 'Katalog');
define('HEADER_TITLE_ADMINISTRATION', 'Administration');
define('HEADER_TITLE_CHAINREACTION', 'osCommerce');
define('HEADER_TITLE_PHESIS', 'Loaded6');
// MaxiDVD Zeile für WYSIWYG-HTML-Bereich hinzugefügt: BOF
define('BOX_CATALOG_DEFINE_MAINPAGE', 'Homepage bearbeiten');
// MaxiDVD Added Line For WYSIWYG HTML Area: EOF


// text for gender
define('MALE', 'Mann');
define('FEMALE', 'Frau');


// сonfiguration box text in includes / boxes / configuration.php
define('BOX_HEADING_CONFIGURATION', 'Einstellungen');
define('BOX_CONFIGURATION_MYSTORE', "Geschäft");
define('BOX_CONFIGURATION_LOGGING', 'Logs');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Module');
define('BOX_MODULES_PAYMENT', 'Zahlung');
define('BOX_MODULES_SHIPPING', 'Lieferung');
define('BOX_MODULES_SHIP2PAY', 'Lieferung-Zahlung');
define('BOX_MODULES_ORDER_TOTAL', 'Auftragssumme');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Katalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategorien/Produkte');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Attribute');
define('BOX_CATALOG_PRODUCTS_PROPERTIES', 'Technische Parameter');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES_NEW', 'Attribute - Installation');
define('BOX_CATALOG_MANUFACTURERS', 'Hersteller');
define('BOX_CATALOG_SPECIALS', 'Rabatte');
define('BOX_CATALOG_EASYPOPULATE', 'Excel Import/Export');

define('BOX_CATALOG_SALEMAKER', 'Mengenrabatt');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Kunden');
define('BOX_CUSTOMERS_CUSTOMERS', 'Kunden');
define('BOX_CUSTOMERS_ORDERS', 'Aufträge');
define('BOX_CUSTOMERS_EDIT_ORDERS', 'Aufträge bearbeiten');
define('BOX_CUSTOMERS_ENTRY', 'Anzahl der Besuche');


// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Orte/Steuern');
define('BOX_TAXES_COUNTRIES', 'Länder');
define('BOX_TAXES_ZONES', 'Regionen');
define('BOX_TAXES_GEO_ZONES', 'Steuerzonen');
define('BOX_TAXES_TAX_CLASSES', 'Steuerarten');
define('BOX_TAXES_TAX_RATES', 'Steuersätze');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Berichte');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Angesehene Artikel');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Bestellte Ware');
define('BOX_REPORTS_PRODUCTS_PURCHASED_BY_CATEGORY', 'Nach Kategorie gekaufte Produkte');
define('BOX_REPORTS_ORDERS_TOTAL', 'Beste Kunden');

// tools text in includes / boxes / tools.php
define('BOX_HEADING_TOOLS', 'Werkzeuge');
define('BOX_TOOLS_BACKUP', 'Sicherung der Datenbank');
define('BOX_TOOLS_CACHE', 'Cache Control');
define('BOX_TOOLS_MAIL', 'Email senden');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Mailing Manager');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Lokalisierung');
define('BOX_LOCALIZATION_CURRENCIES', 'Währungen');
define('BOX_LOCALIZATION_LANGUAGES', 'Languages');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Bestellstatus');

// infobox box text in includes/boxes/info_boxes.php
define('BOX_HEADING_BOXES', 'Boxen verwalten');
define('BOX_HEADING_TEMPLATE_CONFIGURATION', 'Vorlagen anpassen');
define('BOX_HEADING_DESIGN_CONTROLS', 'Design');

// javascript messages
define('JS_ERROR', 'Wenn Sie das Formular ausgefüllt haben, haben Sie einen Fehler gemacht!\nBitte nehmen Sie die folgenden Korrekturen vor:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Das neue Warenattribut muss einen Preis haben\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Das neue Produktattribut muss ein Preispräfix haben\n');

define('JS_PRODUCTS_NAME', '* Der Name des neuen Produkts ist\n');
define('JS_PRODUCTS_DESCRIPTION', '* Die Beschreibung für den neuen Artikel lautet\n');
define('JS_PRODUCTS_PRICE', '* Bei einem neuen Produkt sollte der Preis angegeben werden\n');
define('JS_PRODUCTS_WEIGHT', '* Das Gewicht muss für den neuen Artikel angegeben werden\n');
define('JS_PRODUCTS_QUANTITY', '* Die Anzahl neuer Produkte muss angegeben werden\n');
define('JS_PRODUCTS_MODEL', '* Der Produktcode muss für den neuen Artikel angegeben werden\n');
define('JS_PRODUCTS_IMAGE', '* Es muss ein Bild für das neue Produkt vorhanden sein\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Für dieses Produkt muss ein neuer Preis festgelegt werden\n');

define('JS_GENDER', '* Field \'Gender\' sollte ausgewählt werden.\n');
define('JS_FIRST_NAME', '* Field \'Name\' muss mindestens'. ENTRY_FIRST_NAME_MIN_LENGTH. 'Zeichen enthalten.\n');
define('JS_LAST_NAME', '* Field \'LastName\' muss mindestens'. ENTRY_LAST_NAME_MIN_LENGTH. 'Zeichen enthalten.\n');
define('JS_DOB', '* Field \'Birthday\'sollte folgendes Format haben: xx/xx/xxxx (Tag/Monat/Jahr).\n');
define('JS_EMAIL_ADDRESS', '* Das Feld \'E-Mail-Adresse\'muss mindestens'. ENTRY_EMAIL_ADDRESS_MIN_LENGTH. 'Zeichen enthalten.\n');
define('JS_ADDRESS', '* Field \'Address\'muss mindestens'. ENTRY_STREET_ADDRESS_MIN_LENGTH. 'Zeichen enthalten.\n');
define('JS_POST_CODE', '* Field \'Index\'muss mindestens'. ENTRY_POSTCODE_MIN_LENGTH. 'Zeichen enthalten.\n');
define('JS_CITY', '* Field \'City\'muss mindestens'. ENTRY_CITY_MIN_LENGTH. 'Zeichen enthalten.\n');
define('JS_STATE', '* Field \'Region\'muss ausgewählt sein.\n');
define('JS_STATE_SELECT', '-- Wähle oben --');
define('JS_ZONE', '* Field \'Region\'muss mit dem ausgewählten Land übereinstimmen.');
define('JS_COUNTRY', '* Field \'Country\'muss ausgefüllt werden.\n');
define('JS_TELEPHONE', '* Field \'Phone\'muss mindestens'. ENTRY_TELEPHONE_MIN_LENGTH. 'Zeichen enthalten.\n');
define('JS_PASSWORD', '* Felder \'Passwort\'und \'Bestätigung\'müssen übereinstimmen und mindestens'. ENTRY_PASSWORD_MIN_LENGTH. 'Zeichen enthalten.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Auftragsnummer %s nicht gefunden!');

define('CATEGORY_PERSONAL', 'Personal');
define('CATEGORY_ADDRESS', 'Adresse');
define('CATEGORY_CONTACT', 'Für Kontakt');
define('CATEGORY_COMPANY', 'Firma');
define('CATEGORY_OPTIONS', 'Newsletter');
define('DISCOUNT_OPTIONS', 'Rabatte');

define('ENTRY_GENDER', 'Geschlecht:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class = "errorText">erforderlich</span>');
define('ENTRY_FIRST_NAME', 'Name:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class = "errorText">minimum'. ENTRY_FIRST_NAME_MIN_LENGTH. 'Zeichen</span>');
define('ENTRY_LAST_NAME', 'Nachname:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class = "errorText">minimum'. ENTRY_LAST_NAME_MIN_LENGTH. 'Zeichen</span>');
define('ENTRY_DATE_OF_BIRTH', 'Geburtsdatum:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class = "errorText">(Beispiel 21/05/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail-Adresse:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class = "errorText">Minimum'. ENTRY_EMAIL_ADDRESS_MIN_LENGTH. 'Zeichen</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class = "errorText">Sie haben eine ungültige E-Mail-Adresse eingegeben!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class = "errorText">Diese E-Mail-Adresse ist bereits registriert!</span>');
define  ('ENTRY_COMPANY', 'Firmenname:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Adresse:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class = "errorText">minimales' .ENTRY_STREET_ADDRESS_MIN_LENGTH. 'Zeichen</span>');
define('ENTRY_SUBURB', 'Bereich:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Index:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class = "errorText"> Minimum'. ENTRY_POSTCODE_MIN_LENGTH. 'Zeichen</span>');
define  ('ENTRY_CITY', 'Stadt:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class = "errorText">Minimum'. ENTRY_CITY_MIN_LENGTH. 'Zeichen</span>');
define  ('ENTRY_STATE', 'Region:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class = "errorText">erforderlich</span>');
define  ('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefon:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class = "errorText">Minimum'. ENTRY_TELEPHONE_MIN_LENGTH. 'Zeichen</span>');
define  ('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Newsletter erhalten:');
define('ENTRY_NEWSLETTER_YES', 'Signiert');
define('ENTRY_NEWSLETTER_NO', 'Nicht signiert');

// images
define('IMAGE_ANI_SEND_EMAIL', 'E-Mail senden');
define('IMAGE_BACK', 'Zurück');
define('IMAGE_BACKUP', 'Ergebniskopie');
define('IMAGE_CANCEL', 'Abbrechen');
define('IMAGE_CONFIRM', 'Confirm');
define('IMAGE_COPY', 'Kopieren');
define('IMAGE_COPY_TO', 'Kopieren nach');
define('IMAGE_DETAILS', 'Configure');
define('IMAGE_DELETE', 'Löschen');
define('IMAGE_EDIT', 'Edit');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'Dateimanager');
define('IMAGE_ICON_STATUS_GREEN', 'Aktiv');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Aktivieren');
define('IMAGE_ICON_STATUS_RED', 'Inaktiv');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Inaktiv');
define('IMAGE_ICON_INFO', 'Informationsseiten');
define('IMAGE_INSERT', 'Add');
define('IMAGE_LOCK', 'Lock');
define('IMAGE_MODULE_INSTALL', 'Modul installieren');
define('IMAGE_MODULE_REMOVE', 'Modul löschen');
define('IMAGE_MOVE', 'Move');
define('IMAGE_NEW_BANNER', 'Neues Banner');
define('IMAGE_NEW_CATEGORY', 'Neue Kategorie');
define('IMAGE_NEW_COUNTRY', 'Neues Land');
define('IMAGE_NEW_CURRENCY', 'Neue Währung');
define('IMAGE_NEW_FILE', 'Neue Datei');
define('IMAGE_NEW_FOLDER', 'Neuer Ordner');
define('IMAGE_NEW_LANGUAGE', 'Neue Sprache');
define('IMAGE_NEW_NEWSLETTER', 'Neuer Newsletter');
define('IMAGE_NEW_PRODUCT', 'Neues Produkt');
define('IMAGE_NEW_SALE', 'Neuer Verkauf');
define('IMAGE_NEW_TAX_CLASS', 'Neue Steuer');
define('IMAGE_NEW_TAX_RATE', 'Neuer Steuersatz');
define('IMAGE_NEW_TAX_ZONE', 'Neue Steuerzone');
define('IMAGE_NEW_ZONE', 'Neue Zone');
define('IMAGE_ORDERS', 'Orders');
define('IMAGE_ORDERS_INVOICE', 'Rechnung');
define('IMAGE_ORDERS_PACKINGSLIP', 'Frachtbrief');
define('IMAGE_PREVIEW', 'Vorschau');
define('IMAGE_RESTORE', 'Restore');
define('IMAGE_RESET', 'Reset');
define('IMAGE_SAVE', 'Speichern');
define('IMAGE_SEARCH', 'Suche');
define('IMAGE_SELECT', 'Auswählen');
define('IMAGE_SEND', 'Senden');
define('IMAGE_SEND_EMAIL', 'E-Mail senden');
define('IMAGE_UNLOCK', 'Unblock');
define('IMAGE_UPDATE', 'Refresh');
define('IMAGE_UPDATE_CURRENCIES', 'Wechselkurse anpassen');
define('IMAGE_UPDATE_CURRENCIES_SHORT', 'Währungen aktualisieren');
define('IMAGE_UPLOAD', 'Download');
define('TEXT_IMAGE_NONEXISTENT', 'Kein Bild');

define('IMAGE_BUTTON_BUY_TEMPLATE','Zum kostenpflichtigen Paket wechseln');
define('IMAGE_BUTTON_BUY_TEMPLATE_MOB', 'Kaufen');
define('TIME_LEFT', 'Bleib:');

define('ICON_CROSS', 'Ungültig');
define('ICON_CURRENT_FOLDER', 'Aktuelles Verzeichnis');
define('ICON_DELETE', 'Löschen');
define('ICON_ERROR', 'Fehler:');
define('ICON_FILE', 'Datei');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Ordner');
define('ICON_LOCKED', 'Block');
define('ICON_PREVIOUS_LEVEL', 'Vorheriges Level');
define('ICON_PREVIEW', 'Bearbeiten');
define('ICON_STATISTICS', 'Statistics');
define('ICON_SUCCESS', 'Done');
define('ICON_TICK', 'Wahrheit');
define('ICON_UNLOCKED', 'Entsperren');
define('ICON_WARNING', 'ACHTUNG');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Seite %s von %d');

define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Zeige <b>%d</b> - <b>%d</b> (insgesamt <b>%d</b> Banner)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Zeige <b>%d</b> - <b>%d</b> (gesamt <b>%d</b> Länder)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Zeige <b>%d</b> - <b>%d</b> (gesamt <b>%d</b> Clients)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Zeige <b>%d</b> - <b>%d</b> (Gesamt <b>%d</b> Währungen)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Zeige <b>%d</b> - <b>%d</b> (insgesamt <b>%d</b> Sprachmodule)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Zeige <b>%d</b> - <b>%d</b> (gesamt <b>%d</b> Produzenten)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Zeige <b>%d</b> - <b>%d</b> (Gesamt <b>%d</b> Mailings)');
define( 'TEXT_DISPLAY_NUMBER_OF_ORDERS', 'angezeigte <b>%d</b> - <b>%d</b> (alle <b>%d</b> Aufträge)');
define( 'TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'angezeigte <b>%d</b> - <b>%d</b> (alle <b>%d</b> Status)');
define( 'TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'angezeigte <b>%d</b> - <b>%d</b> (alle <b>%d</b> Produkte)');
define( 'TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'angezeigte <b>%d</b> - <b>%d</b> (alle <b>%d</b> Specials)');
define( 'TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'angezeigte <b>%d</b> - <b>%d</b> (alle <b>%d</b> Steuerart)');
define( 'TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'angezeigte <b>%d</b> - <b>%d</b> (alle <b>%d </b> Steuerzonen)');
define( 'TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'angezeigte <b>%d</ b> - <b>%d</ b> (alle <b>%d</b> Steuersätze)');
define( 'TEXT_DISPLAY_NUMBER_OF_ZONES', 'angezeigte <b>%d</b> - <b>%d</b> (alle <b>%d</b> Zonen)');

define('PREVNEXT_BUTTON_PREV', 'Zurück');
define('PREVNEXT_BUTTON_NEXT', 'Weiter');

define('TEXT_DEFAULT', 'standardmäßig');
define('TEXT_SET_DEFAULT', 'Als Standard setzen');
define( 'TEXT_FIELD_REQUIRED', '&nbsp;<span class = "fieldRequired">* Erforderlich</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Fehler: Bisher wurde keine Währung standardmäßig nicht installiert Bitte installieren Sie eine von ihnen. Localization -> Währung');

define('TEXT_CACHE_CATEGORIES', 'Kategorie Boxen');
define("TEXT_CACHE_MANUFACTURERS", "Hersteller-Box");
define('TEXT_CACHE_ALSO_PURCHASED', 'Auch Einkaufsmodule');

define('TEXT_NONE', '--not--');
define('TEXT_TOP', 'Start');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Fehler: Verzeichnis existiert nicht.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Fehler: Das Verzeichnis ist schreibgeschützt, setze die notwendigen Berechtigungen.');
define('ERROR_FILE_NOT_SAVED', 'Fehler: Die Datei wurde nicht hochgeladen.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Fehler: Dateien dieses Typs können nicht hochgeladen werden.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Done: Die Datei wurde erfolgreich heruntergeladen.');
define('WARNING_NO_FILE_UPLOADED', 'Warnung: Es wurden keine Dateien hochgeladen.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warnung: Die Option zum Herunterladen von Dateien ist in der Konfigurationsdatei php.ini deaktiviert.');

define('BOX_CATALOG_XSELL_PRODUCTS', 'Verwandte Produkte');


define('CUSTOM_PANEL_DATE1', 'Tag');
define('CUSTOM_PANEL_DATE2', 'Tage');
define('CUSTOM_PANEL_DATE3', 'Tage');

// X-Sell 
require(DIR_WS_LANGUAGES. 'add_ccgvdc_russian.php');

//  BOF: Lango Added for print order MOD
define('IMAGE_BUTTON_PRINT', 'Drucken');
// EOF: Lango Added for print order MOD

// BOF: Lango Added for Featured product MOD
define('BOX_CATALOG_FEATURED', 'Ausgewählte Produkte');
// EOF: Lango Added for Featured product MOD

// BOF: Lango Added for Sales Stats MOD
define('BOX_REPORTS_MONTHLY_SALES', 'Verkaufsstatistik');
// EOF: Lango Added for Sales Stats MOD


// BEGIN Dynamic information pages unlimited
define('BOX_HEADING_INFORMATION', 'Inhalt');
define('BOX_HEADING_SEO', 'SEO');
define('BOX_INFORMATION', 'Infoseiten');
// END Dynamic information pages unlimited

define('BOX_TOOLS_KEYWORDS', 'Suchabfragen');

// RJW Begin Meta Tags Code
define('TEXT_META_TITLE', 'Meta-Titel');
define('TEXT_META_DESCRIPTION', 'Meta Description');
define('TEXT_META_KEYWORDS', 'Meta-Schlüsselwörter');
// RJW End Meta Tags Code

// Article Manager
define('BOX_HEADING_ARTICLES', 'Artikel');
define('BOX_TOPICS_ARTICLES', 'Artikel');
define('BOX_ARTICLES_CONFIG', 'Setup');
define('BOX_ARTICLES_XSELL', 'Artikel-Artikel');
define('IMAGE_NEW_TOPIC', 'Neuer Abschnitt');
define('IMAGE_NEW_ARTICLE', 'Neuer Artikel');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Zeige <b>%d</b> - <b>%d</b> (insgesamt <b>%d</b> Autoren)');

// TotalB2B start
define('BOX_CUSTOMERS_GROUPS', 'Gruppen');
define('BOX_MANUDISCOUNT', 'Herstellerrabatte');
//TotalB2B end

// add for Group minimum price to order start   
define('GROUP_MIN_PRICE', 'Minimale Kosten für die Bestellung einer Gruppe');
// add for Group minimum price to order end

// add for color groups start
define('GROUP_COLOR_BAR', 'Gruppenfarbe');
// add for color groups end
//TotalB2B end
define('BOX_CATALOG_QUICK_UPDATES', 'Preis aktualisieren');

define('IMAGE_PROPERTIES_POPUP_ADD_CHANGE_DELETE', 'Technische Parameter bearbeiten / entfernen');
define('IMAGE_PROPERTIES_POPUP_ADD', 'Technische Parameter hinzufügen');
define('IMAGE_PROPERTIES', 'Technische Parameter');

// polls box text in includes/boxes/polls.php

define('BOX_HEADING_POLLS', 'Umfragen');
define('BOX_POLLS_POLLS', 'Umfragen');
define('BOX_POLLS_CONFIG', 'Abrufeinstellungen');
define('BOX_CURRENCIES_CONFIG', 'Währungen');
define('BOX_COUPONS', 'Promo codes');

define('BOX_INDEX_GIFTVOUCHERS', 'Zertifikate / Promo codes');

define('BOX_REPORTS_SALES_REPORT2', 'Umsatzstatistik 2');
define('BOX_REPORTS_SALES_REPORT', 'Verkaufsstatistik 3');
define('BOX_REPORTS_CUSTOMERS_ORDERS', 'Kundenstatistik');

define('TEXT_NEW_ATTRIBUTE_EDIT', 'Produktattribute bearbeiten');

define('ONE_PAGE_CHECKOUT_TITLE', 'Bestellung');
define('BROWSE_BY_CATEGORIES_TITLE', 'Ausgabe von Kategorien');
define('SEO_TITLE', 'SEO URLs');
define('SEO_ENABLED_DESC', 'SEO URLs Modul - entworfen, um normale Links zu CNC-Links zu konvertieren');

define('ONEPAGE_ADDR_LAYOUT_TITLE', 'Addresses Layout');
define('ONEPAGE_CHECKOUT_HIDE_SHIPPING_TITLE', 'Kontrollkästchen für Liefer- und Bearbeitungsadresse nicht anzeigen oder Versandmethoden, wenn das Gewicht der Produkte = 0');
define('ONEPAGE_ZIP_BELOW_TITLE', 'Postleitzahlen-Eingabefelder unterhalb des Status verschieben');
define('ONEPAGE_TELEPHONE_TITLE', 'Benötigen Sie ein Telefon?');
define('ONEPAGE_CHECKOUT_LOADER_POPUP_TITLE', 'Make loader message popup');
define('ONEPAGE_CHECKOUT_SHOW_ADDRESS_INPUT_FIELDS_TITLE', 'Show Address in input Fields');
define('ONEPAGE_DEBUG_EMAIL_ADDRESS_TITLE', 'Send Debug Emails To:');
define('ONEPAGE_BOX_TWO_CONTENT_TITLE', 'Custom Colum Box #2 Content');
define('ONEPAGE_BOX_TWO_HEADING_TITLE', 'Custom Colum Box #2 Heading');
define('ONEPAGE_BOX_ONE_CONTENT_TITLE', 'Custom Colum Box #1 Content');
define('ONEPAGE_BOX_ONE_HEADING_TITLE', 'Custom Colum Box #1 Heading');
define('ONEPAGE_SHOW_OSC_COLUMNS_TITLE', 'Spalten Oscommerce anzeigen');
define('ONEPAGE_LOGIN_REQUIRED_TITLE', 'Anmeldung erforderlich');
define('ONEPAGE_SHOW_CUSTOM_COLUMN_TITLE', 'Zeige die rechte Spalte');
define('ONEPAGE_ACCOUNT_CREATE_TITLE', 'Konto erstellen');
define('ONEPAGE_CHECKOUT_ENABLED_TITLE', 'One Page Checkout aktivieren');
define('ONEPAGE_AUTO_SHOW_DEFAULT_ZIP_TITLE', 'Auto-show billing/shipping Default zip code');
define('ONEPAGE_AUTO_SHOW_DEFAULT_STATE_TITLE', 'Auto-show billing/shipping Default State');
define('ONEPAGE_AUTO_SHOW_DEFAULT_COUNTRY_TITLE', 'Auto-show billing/shipping Default Country');
define('ONEPAGE_AUTO_SHOW_BILLING_SHIPPING_TITLE', 'Auto-show billing/shipping modules');

define('SMS_ENABLE_TITLE', 'SMS Dienst aktivieren');
define('SMS_GATENAME_TITLE', 'SMS gatename');
define('SMS_CUSTOMER_ENABLE_TITLE', 'Sende SMS an den Kunden beim Kauf?');
define('TELEGRAM_TOKEN_TITLE','Telegram Token');
define('TELEGRAM_NOTIFICATIONS_ENABLED_TITLE','Aktivieren Sie Telegrammbenachrichtigungen');
define('SMS_CHANGE_STATUS_TITLE', 'SMS an den Client senden, wenn der Status geändert wird?');
define('SMS_OWNER_ENABLE_TITLE', 'SMS beim Kauf an den Administrator senden?');
define('SMS_OWNER_ENABLE_BUY_ONE_CLICK_TITLE', 'Beim Kauf mit einem Klick eine SMS an den Administrator senden?');
define('SMS_OWNER_TEL_TITLE', 'Admin-Nummer');
define('SMS_TEXT_TITLE', 'Text SMS');
define('SMS_LOGIN_TITLE', 'Anmeldung am SMS-Gateway (oder API-Schlüssel, Account SID)');
define('SMS_PASSWORD_TITLE', 'Passwort (or Auth token)');
define('SMS_SIGN_TITLE', 'Absender (or Service SID)');
define('SMS_ENC_TITLE', 'code2');


define('ROBOTS_TXT_TITLE', 'robots.txt');

define('SMS_CONF_TITLE', 'sms-service');
define('MY_SHOP_CONF_TITLE', 'Mein Store');
define('MIN_VALUES_CONF_TITLE', 'Minimalwerte');
define('MAX_VALUES_CONF_TITLE', 'Maximalwerte');
define('IMAGES_CONF_TITLE', 'Bilder');
define('CUSTOMER_DETAILS_CONF_TITLE', 'Käuferdaten');
define('MODULES_CONF_TITLE', 'Installierte Module');
define('SHIPPING_CONF_TITLE', 'Lieferung/Verpackung');
define('LISTING_CONF_TITLE', 'Warenausgang');
define('STOCK_CONF_TITLE', 'Lager');
define('LOGS_CONF_TITLE', 'Logs');
define('CACHE_CONF_TITLE', 'Cache');
define('EMAIL_CONF_TITLE', 'E-Mail Setup');
define('DOWNLOAD_CONF_TITLE', 'Download');
define('GZIP_CONF_TITLE', 'GZip-Komprimierung');
define('SESSIONS_CONF_TITLE', 'Sessions');
define('HTML_CONF_TITLE', 'HTML-Editor');
define('DYMO_CONF_TITLE', 'Dynamic MoPics Modul');
define('DOWN_CONF_TITLE', 'Technische Wartung');
define('GA_CONF_TITLE', 'Schnellform');
define('LINKS_CONF_TITLE', 'Referenzen');
define('QUICK_CONF_TITLE', 'Preis aktualisieren');
define('WISHLIST_TITLE', 'aufgeschobene Waren');
define('PAGE_CACHE_TITLE', 'Seitencache');
define('GRAPHS_TITLE', 'Graph');
define('YANDEX_MARKET_CONF_TITLE', 'XML-Entladen');


define('ATTRIBUTES_COPY_TEXT1', 'Warnung: Sie können Attribute nicht von der Positionsnummer kopieren');
define('ATTRIBUTES_COPY_TEXT2', 'in der Produktnummer');
define('ATTRIBUTES_COPY_TEXT3', '. Nichts wird kopiert.');
define('ATTRIBUTES_COPY_TEXT4', 'Warnung: Es gibt keine Attribute zum Kopieren von der Artikelnummer');
define('ATTRIBUTES_COPY_TEXT5', 'in den Waren');
define('ATTRIBUTES_COPY_TEXT6', '. Nichts wird kopiert.');
define('ATTRIBUTES_COPY_TEXT7', 'Achtung: Artikel mit Nummer');
define('ATTRIBUTES_COPY_TEXT8', 'nicht gefunden, oder Sie haben die Produktnummer nicht angegeben oder das angegebene Produkt existiert nicht.) Nichts wird kopiert.');

//include('includes/languages/english_support.php');

// BOF FlyOpenair: Extra Product Price
define('BOX_EXTRA_PRODUCT_PRICE', 'Extra Gebühren');
define('EXTRA_PRODUCT_PRICE_ID_TITLE', 'Margin-System');
define('EXTRA_PRODUCT_PRICE_ID_DESC', 'Aktivieren oder Deaktivieren des Randmodulmoduls');
// EOF FlyOpenair: Extra Product Price

define('TEXT_IMAGE_OVERWRITE_WARNING', 'Warnung: Der Dateiname wurde geändert, aber nicht überschrieben');

// 500 Page )
define  ('SERVICE_MENU', 'TOOLS');
define('SEO_CONFIGURATION','SEO TOOLS');


define('COMMENTS_MODULE_ENABLED_TITLE', 'Reviews');
define('LANGUAGE_SELECTOR_MODULE_ENABLED_TITLE', 'Multilanguage');
define('FACEBOOK_PIXEL_MODULE_ENABLED_TITLE','FaceBook Pixel');
define('DEFAULT_PIXEL_CURRENCY_TITLE','FaceBook Pixel currency');
define('QUICK_PRODUCTS_UPDATE_ENABLED_TITLE','De bijgewerkte prijs');
define('FACEBOOK_PIXEL_ID_TITLE','FaceBook Pixel ID');
define('PRODUCT_LABELS_MODULE_ENABLED_TITLE', 'Labels');
define('ATTRIBUTES_PRODUCTS_MODULE_ENABLED_TITLE', 'Filter');
define('AUTH_MODULE_ENABLED_TITLE', 'Authorizations');
define('EXCEL_IMPORT_MODULE_ENABLED_TITLE', 'Import / Export');
define('CUPONES_MODULE_ENABLED_TITLE', 'Gutscheine');
define('COMPARE_MODULE_ENABLED_TITLE', 'Vergleich');
define('WISHLIST_MODULE_ENABLED_TITLE', 'Wunschzettel');
define('GOOGLE_FEED_CHOOSE_ALL_PRODUCTS_TITLE', 'aktiven Produkte');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_2_TITLE', 'Produkte mit aktivem XML-Status');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_3_TITLE', 'Produkte mit Lagerverfügbarkeit');
define('XSELL_PRODUCTS_BUYNOW_ENABLED_TITLE', 'Verwandte Produkte');
define('STATS_PRODUCTS_PURCHASED_BY_CATEGORY_MODULE_ENABLED_TITLE', 'Nach Kategorie gekaufte Produkte');
define('SALEMAKER_MODULE_ENABLED_TITLE', 'Mengenrabatt');
define('SPECIALS_MODULE_ENABLED_TITLE', 'Rabatte');
define('STATS_KEYWORDS_ENABLED_TITLE', 'Suchanfragen');
define('BACKUP_ENABLED_TITLE', 'Database Backup');
define('PRODUCTS_MULTI_ENABLED_TITLE', 'Waren verwalten');
define('SEO_TEMPLATES_ENABLED_TITLE', 'SEO-Vorlagen');
define('SHIP2PAY_ENABLED_TITLE', 'Lieferung-Zahlung');
define('QTY_PRO_ENABLED_TITLE', 'Kombinationen von Attributen');
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
define('SMSINFORM_MODULE_ENABLED_TITLE', 'SMS-Modul');
define('CARDS_ENABLED_TITLE', 'Zahlung mit Karten');
define('SOCIAL_WIDGETS_ENABLED_TITLE', 'Soziale Widgets');
define('MULTICOLOR_ENABLED_TITLE', 'Multicolor');
define  ('WATERMARK_ENABLED_TITLE', 'Wasserzeichen');

define('FACEBOOK_APP_ID_TITLE', 'Facebook-App-ID');
define('FACEBOOK_APP_SECRET_TITLE', 'Facebook privater Schlüssel');
define('VK_APP_ID_TITLE', 'VKontakte App ID');
define('VK_APP_SECRET_TITLE', 'Vkontakte secret key');

define('TABLE_HEADING_ORDERS', 'ORDERS:');
define('TABLE_HEADING_LAST_ORDERS', 'Letzte Bestellungen');
define('TABLE_HEADING_CUSTOMER', 'Käufer');
define('TABLE_HEADING_ORDER_NUMBER', 'Nr.');
define('TABLE_HEADING_ORDER_TOTAL', 'Summe');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_DATE', 'Date');

include ('includes/languages/order_edit_russian.php');

define('TEXT_VALID_TITLE', 'Liste der Kategorien');
define('TEXT_VALID_TITLE_PROD', 'Produktliste');
define('TEXT_VALID_CLOSE', 'Fenster schließen');
define('TABLE_HEADING_LASTNAME', 'Nachname');
define('TABLE_HEADING_FIRSTNAME', 'Name');
define('TABLE_HEADING_PRODUCT_NAME', 'Name');
define('TABLE_HEADING_PRODUCT_PRICE', 'Price');
define('TEXT_SELECT_CUSTOMER', 'Käufer auswählen');
define('TEXT_SELECT_CUSTOMER_PLACEHOLDER', 'Beginnen Sie mit der Eingabe von Kundennummer / Name / Telefon / E-Mail-Adresse');
define('TEXT_SINGLE_CUSTOMER', 'Einzelner Kunde');
define('TEXT_EMAIL_RECIPIENT', 'E-Mail Empfänger');

define('TEXT_NOTIFICATIONS', 'Notifications');
define('TEXT_NOTIFICATIONS_MESSAGE', 'Sie haben %s von ungeprüften Bestellungen');
define('TEXT_NOTIFICATIONS_LINK', 'Gehe zur Bestellseite');

define('TEXT_PROFILE', 'Profil');
define('TEXT_PROFILE_GREETINGS', 'Hallo, %s!');
define('TEXT_PROFILE_LOGIN_COUNT', 'Anzahl der Eingaben: %s');
define('TEXT_PROFILE_DAYS_WITH_US', 'Sie sind bereits für %s Tage bei uns');

define('TEXT_MENU_TITLE', 'Menü');
define('TEXT_MENU_HOME', 'Home');
define('TEXT_MENU_PRODUCTS', 'Produkte');
define('TEXT_MENU_CATALOGUE', 'Katalog');
define('TEXT_MENU_EMAIL_CONTENT', 'E-Mail-Vorlagen');
define('TEXT_MENU_CKFINDER', 'File manager');
define('TEXT_MENU_ATTRIBUTES', 'Attribute');
define('TEXT_MENU_ORDERS', 'Aufträge');
define('TEXT_MENU_ORDERS_LIST', 'Auftragsliste');
define('TEXT_MENU_CLIENTS_LIST', 'Kundenliste');
define('TEXT_MENU_CLIENTS_GROUPS', 'Kundengruppen');
define('TEXT_MENU_ADD_CLIENT', 'Client hinzufügen');
define('TEXT_MENU_PAGES', 'Seiten');
define('TEXT_MENU_SITE_MODULES', 'SOLO-Module');
define('TEXT_MENU_SITE_SEO_SETTINGS', 'SEO-Einstellungen');
define('TEXT_MENU_BACKUP', 'Database Backup');
define('TEXT_MENU_NEWSLETTERS', 'Newsletter');
define('TEXT_MENU_SLOW_QUERIES_LOGS', 'Log der langsamen Abfragen');
define('TEXT_MENU_PRODUCTS_VIEWS', 'Produktansichten');
define('TEXT_MENU_CLIENTS', 'Clients');
define('TEXT_MENU_SALES', 'Verkauf');
define('TEXT_MENU_ADMINS_AND_GROUPS', 'Administratoren und Gruppen');
define('TEXT_MENU_UPDATE_PROFILE', 'Daten aktualisieren');
define('TEXT_MENU_NOPHOTO', 'Kein Foto');
define('TEXT_MENU_OPENEDBY', 'Geöffnet von');
define('TEXT_MENU_LAST_MODIFIED', 'Zuletzt bearbeitet');
define('TEXT_MENU_ZEROQTY', 'Nullmenge');
define('TEXT_MENU_STATS_RECOVER_CART_SALES', 'Stats Recover Cart Sales');
define('TEXT_MENU_SEARCH', 'Suche nach Kategorie');

define('TEXT_HEADING_ADD_NEW', 'Hinzufügen');
define('TEXT_HEADING_ADD_NEW_PRODUCT', 'Produkt');
define('TEXT_HEADING_ADD_NEW_CATEGORY', 'Kategorie');
define('TEXT_HEADING_ADD_NEW_PAGE', 'Seite');
define('TEXT_HEADING_ADD_NEW_CLIENT', 'Kunde');
define('TEXT_HEADING_ADD_NEW_ORDER', 'Bestellung');
define('TEXT_HEADING_ADD_NEW_COUPON', 'Coupon');

define('TEXT_BLOCK_ORDERS_STATUSES_COUNTERS', 'Auftragsstatus');

define('TEXT_BLOCK_ORDERS_TODAY_COUNTERS', 'Heute');
define('TEXT_BLOCK_ORDERS_YESTERDAY_COUNTERS', 'Gestern');
define('TEXT_BLOCK_ORDERS_WEEK_COUNTERS', 'Woche');
define('TEXT_BLOCK_ORDERS_MONTH_COUNTERS', 'Monat');
define('TEXT_BLOCK_ORDERS_QUARTER_COUNTERS', 'Quartal');
define('TEXT_BLOCK_ORDERS_ALL_TIME_COUNTERS', 'Die ganze Zeit');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_CURRENCY', 'Griwna');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_PREFIX', 'on');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_NOUN', 'Aufträge');

define('TEXT_BLOCK_COUNTERS_PRODUCTS', 'Items');
define('TEXT_BLOCK_COUNTERS_ORDERS', 'Aufträge');
define('TEXT_BLOCK_COUNTERS_COMMENTS', 'Kommentare');
define('TEXT_BLOCK_COUNTERS_TOTAL_INCOME', 'Umsatzbetrag');

define('TEXT_BLOCK_SETTINGS_TITLE', 'Einstellungen');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_HEADER', 'Feste Cap');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_ASIDE', 'Gesperrte Sidebar');
define('TEXT_BLOCK_SETTINGS_TITLE_FOLDED_ASIDE', 'Collapsed sidebar');
define('TEXT_BLOCK_SETTINGS_TITLE_DOCK_ASIDE', 'Sidebar-Menü von oben');

define('TEXT_BLOCK_MODULES_STATS_USING', 'Verwendet');
define('TEXT_BLOCK_MODULES_STATS_AMOUNT', 'Stk.');
define('TEXT_BLOCK_MODULES_STATS_MODULES', 'Module');
define('TEXT_BLOCK_MODULES_USED', 'Verwendete Module');
define('TEXT_BLOCK_MODULES_SEE_ALL', 'Alle Module anzeigen');

define('TEXT_BLOCK_OVERVIEW_TITLE', 'Übersicht');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS', 'Aufträge');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED', 'TOP-Ansichten');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD', 'TOP sales');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES', 'TOP Kategorien');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS', 'Eingaben');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED', 'Suchen');

define('TEXT_BLOCK_OVERVIEW_ACTION_EDIT', 'Bearbeiten');
define('TEXT_BLOCK_OVERVIEW_ACTION_VIEW', 'Ansicht');

define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_CUSTOMER_NAME', 'Käufer');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_DATE', 'Datum');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_AMOUNT', 'Summe');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_STATUS', 'Status');

define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODUCT_IMAGE', 'Bild');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODCUT_NAME', 'Name');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_VIEWS', 'Ansichten');

define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODUCT_IMAGE', 'Bilder');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODCUT_NAME', 'Name');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_ORDERS', 'Aufträge');

define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_CATEGORY_NAME', 'Name');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_ORDERS', 'Aufträge');

define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_ADMIN_NAME', 'Name');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_DATE', 'Datum der letzten Anmeldung');

define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_QUERY', 'Query');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_COUNT', 'Menge');

define('TEXT_BLOCK_NEWS_TITLE', 'News');

define('TEXT_BLOCK_PLOT_TITLE', 'Einkommensplan');
define('TEXT_BLOCK_PLOT_TAB_BY_DAYS', 'Täglich');
define('TEXT_BLOCK_PLOT_TAB_BY_WEEKS', 'Nach Woche');
define('TEXT_BLOCK_PLOT_TAB_BY_MONTHES', 'Nach Monaten');

define('TEXT_BLOCK_PLOT_XAXIS_LABEL', 'Gesamtauftragsmenge');
define('TEXT_BLOCK_PLOT_YAXIS_LABEL', 'Anzahl der Aufträge');

define('TEXT_BLOCK_COMMENTS_TITLE', 'Bewertungen');

define('TEXT_BLOCK_EVENTS_TITLE', 'Ereignisse');

define('TEXT_BLOCK_EVENTS_TOOLTIP_ALL_EVENTS', 'Alle Ereignisse');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ADMINS', 'Administratoren');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ORDERS', 'Aufträge');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CUSTOMERS', 'Käufer');
define('TEXT_BLOCK_EVENTS_TOOLTIP_NEW_PRODUCTS', 'Neue Produkte');
define('TEXT_BLOCK_EVENTS_TOOLTIP_COMMENTS', 'Kommentare');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CALL_ME_BACK', 'Rufen Sie mich zurück');
define('TOOLTIP_GOOGLE_SITE_VERIFICATION_KEY', 'Von Google bereitgestellter Schlüssel (sie müssen nur den Schlüssel selbst einstecken)');

define('TOOLTIP_GOOGLE_OAUTH_STATUS', 'Möglichkeit, die Client-Autorisierung über Google zu aktivieren/deaktivieren');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_ID', 'Standardmäßig weist Google eine eindeutige Client-ID zu - Client-ID.');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_SECRET', 'CLIENT_SECRET wird verwendet, um etwas sensiblere Informationen wie API-Nutzung, Verkehrsinformationen und Rechnungsinformationen zu speichern');
define('TOOLTIP_GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED', 'Verfügt über ein Event-Tracking-Tool, ermöglicht es Diensten, Daten zu sammeln und Analysen durchzuführen');
define('TOOLTIP_GOOGLE_ECOMM_SUCCESS_PAGE', 'Möglichkeit, die Seite „Kaufen“ nach der Auftragsbestätigung zu aktivieren/deaktivieren');
define('TOOLTIP_GOOGLE_ECOMM_CHECKOUT_PAGE', 'Möglichkeit, die Checkout-Seite zu aktivieren/deaktivieren');
define('TOOLTIP_GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE', 'Möglichkeit, die Produktansichtsseite zu aktivieren/deaktivieren');
define('TOOLTIP_GOOGLE_ECOMM_SEARCH_RESULTS', 'Möglichkeit, die Suchergebnisseite zu aktivieren/deaktivieren');
define('TOOLTIP_GOOGLE_ECOMM_HOME_PAGE', 'Möglichkeit zum Aktivieren / Deaktivieren der Startseite beim Laden des Browsers');
define('TOOLTIP_GOOGLE_RECAPTCHA_STATUS', 'Sie können Google Recaptcha ein-/ausschalten (Schutz von Websites vor Internet-Bots und gleichzeitig Hilfe bei der Digitalisierung von Buchtexten)');
define('TOOLTIP_GOOGLE_RECAPTCHA_PUBLIC_KEY', 'Stellt einen Google-Dienst bereit (um Websites vor Internet-Bots zu schützen und gleichzeitig bei der Digitalisierung von Buchtexten zu helfen)');
define('TOOLTIP_GOOGLE_RECAPTCHA_SECRET_KEY', 'Stellt einen Google-Dienst bereit (um Websites vor Internet-Bots zu schützen und gleichzeitig bei der Digitalisierung von Buchtexten zu helfen)');



define('TEXT_BLOCK_EVENTS_MESSAGE_ADMINS', '%s angemeldet');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS', 'Execute %s');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS_2', 'Auftrag #%d');
define('TEXT_BLOCK_EVENTS_MESSAGE_CUSTOMERS', '%s registriert auf der Seite');
define('TEXT_BLOCK_EVENTS_MESSAGE_NEW_PRODUCTS', 'Neues Produkt hinzugefügt: "%s"');
define('TEXT_BLOCK_EVENTS_MESSAGE_COMMENTS', 'Benutzer %s hat einen Kommentar hinzugefügt');
define('TEXT_BLOCK_EVENTS_MESSAGE_CALL_ME_BACK', 'angeforderter Ruf');

define  ('TEXT_BLOCK_GA_TITLE', 'Google Analytics');

define('TEXT_SETTINGS_EDIT_FORM_SAVE', 'OK');
define('TEXT_SETTINGS_EDIT_FORM_CANCEL', 'Abbrechen');
define('TEXT_SETTINGS_EDIT_FORM_TOOLTIP', 'ändern');

define('TEXT_MODAL_ADD_ACTION', 'Hinzufügen');
define('TEXT_MODAL_UPDATE_ACTION', 'Aktualisieren');
define('TEXT_MODAL_DELETE_ACTION', 'Löschen');
define('TEXT_MODAL_CHANGE_STATUS', 'Status ändern');
define('TEXT_MODAL_DETAILED', 'Details');
define('TEXT_MODAL_ACTION', 'Aktion');
define('TEXT_MODAL_INSTALL_ACTION', 'Set');
define('TEXT_MODAL_CONTINUE_ACTION', 'Weiter');
define('TEXT_MODAL_CANCEL_ACTION', 'Abbrechen');
define('TEXT_MODAL_CONFIRM_ACTION', 'Bestätigung');
define('TEXT_MODAL_CONFIRMATION_ACTION', 'Sind Sie sicher?');
define('TEXT_WAIT', 'Warten ..');
define('TEXT_SHOW', 'Zur Seite:');
define('TEXT_RECORDS', 'Gesamt:');
define('TEXT_SAVE_DATA_OK', 'Daten erfolgreich geändert');
define('TEXT_DEL_OK', 'Erfolgreich gelöscht');
define('TEXT_ERROR', 'Ein Fehler ist aufgetreten');
define('TEXT_GENERAL_SETTING', 'Allgemein');

//featured
define('TEXT_FEATURED_ADDED', 'Hinzugefügt');
define('TEXT_FEATURED_CHANGE', 'Modifiziert');
define('TEXT_FEATURED_EXPIRE_DATE', 'Ablaufdatum');
define('TEXT_ENTER_PRODUCT', 'Geben Sie den Namen ein');
define('TEXT_FEATURED_MODEL', 'Model');
define('TEXT_PRODUCTS_ON_ATTRIBUTES_VAL', 'Liste der Produkte nach Attributwert');

define('ADMIN_BTN_BUY_MODULE', 'Dieses Modul kaufen!');
define('FOOTER_INSTRUCTION', 'Wie benutze ich das Admin-Panel?');
define("FOOTER_NEWS", "News");
define('FOOTER_SUPPORT_SOLOMONO', 'Technischer Support');
define('FOOTER_SUPPORT_CONSULTANT', 'Online-Berater');
define('FOOTER_SUPPORT_TECHNICAL', 'Technischer Support');

//languages_translater
define('TEXT_TRANSLATER_TITLE', 'Spracheditor');

define('TEXT_PRODUCT_FREE_SHIPPING', 'Kostenloser Versand:');


define('TEXT_MOBILE_OPEN_COLLAPSE', 'Zeigen');
define('TEXT_MOBILE_CLOSE_COLLAPSE', 'Verstecken');
define('TEXT_ORDER_STATISTICS', 'Auftragsstatistik');
define('TEXT_WHO_ONLINE', 'Wer ist online');
define('TEXT_VIEW_LIST', 'Liste anzeigen');
define('TEXT_ACTION_OVERVIEW', 'Aktionsübersicht');
define('TEXT_SEE_ALL', 'Alles sehen');

define('TEXT_MOBILE_SHOW_MORE', 'Mehr anzeigen');
define('TEXT_MOBILE_INCOME', 'Einnahmen:');
define('TEXT_SHOW_ALL', 'Zeige alles');
define('TEXT_REPLY_COMMENT', 'Auf Kommentar antworten - ');
define('TEXT_BTN_REPLY', 'Antworte');
define('TEXT_BTN_ANSWERED', 'Beantwortet');
define('TEXT_MODAL_APPLY_ACTION', 'Bewerben');


define('RECOVER_CART_SALES', 'Recover Cart Sales');



define('TEXT_REDIRECTS_TITLE', 'Weiterleitungen');

define('RCS_CONF_TITLE', 'Unvollständige Bestellungen');


define ('INSTAGRAM_PRODUCTS_TITLE', 'Von Instagram importieren');
define ('INSTAGRAM_PRODUCTS_RESULT', 'In die Datenbank hochgeladene Produkte');
define ('INSTAGRAM_SUCCESS', 'Instagram-Beiträge wurden zu unserer Site hinzugefügt!');
define ('INSTAGRAM_LINK', 'Instagram Link');
define ('INSTAGRAM_COUNT', 'Anzahl der Beiträge');


define('INSTAGRAM_MODULE_ENABLE_TITLE', 'Instagram-Folien');

define('BOX_PRODUCTS_STATS_MENU_ITEM', 'Produkte');


define('BOX_CLIENTS_STATS_TOP_CLIENTS', 'Top-Kunden');
define('BOX_CLIENTS_STATS_NEW_CLIENTS', 'Neue Kunden');


define('BOX_MENU_TOOLS_EMAILS', 'E-Mail-Newsletter');
define('BOX_MENU_TOOLS_MASS_EMAILS', 'Massenversand');


define('BOX_EXEL_IMPORT_EXPORT', 'Excel Import / Export');
define('BOX_PROM_IMPORT_EXPORT', 'Prom.ua Excel-Import');
define('IMPORT_EXPORT_MENU_BOX', 'Import Export');

define('TEXT_ENABLE_MULTILANGUAGE_MODULE', 'Bitte aktivieren Sie das mehrsprachige Modul');
define('TEXT_BUY_MULTILANGUAGE_MODULE', 'Bitte kaufen Sie das mehrsprachige Modul');

define('BOX_MENU_TAXES', 'MwSt');


define('INTEGRATION_CONF_TITLE', 'Andere Integrationen');

define('BOX_HEADING_INSTRUCTION', 'Anleitung');

define('BOX_CATALOG_YML', 'YML-Import');
define('TOOLTIP_CATEGORY_STATUS', 'Bei Aktivierung wird die Kategorie / Unterkategorie / das Produkt auf der Site-Seite angezeigt');
define('TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS', 'So fügen Sie Google Feed eine Kategorie / Unterkategorie / ein Produkt hinzu Um nur ein Produkt einzuschließen, müssen die Kategorie und Unterkategorie, in der sich das Produkt befindet, enthalten sein.');
define('TOOLTIP_PRODUCTS_FEATURED', 'Wird auf der Homepage angezeigt.');
define('TOOLTIP_PRODUCTS_RELATED', 'Wird auf der Produktseite in Artikeln angezeigt.');
define('TOOLTIP_PRODUCTS_ATTRIBUTES', 'Mit Attributen (Filtern) können Sie zusätzliche Produkteigenschaften wie Größe oder Farbe definieren. Lesen Sie mehr in der Anleitung: LINK');
define('TOOLTIP_ATTRIBUTES_VALUES', 'Geben Sie nach dem Erstellen des Attributs die erforderlichen Werte ein.');
define('TOOLTIP_ATTRIBUTES_GROUPS', 'Mehrere Attribute in einer Gruppe kombinieren.');
define('TOOLTIP_ATTRIBUTES_TYPES', 'Text - eine Textbeschreibung der Merkmale; Dropdown - Auswahl aus der Dropdown-Liste; Radio - zur Auswahl aus den angebotenen Optionen; Bild - Die Karte ändert sich, wenn der Artikelwert ausgewählt wird. Wird auf der Produktseite angezeigt.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_FILTER', 'Bewegen Sie den Schieberegler, um Produktattribute im Filterbereich anzuzeigen, um ihn zu aktivieren.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_LISTING', 'Wenn Sie den Mauszeiger über ein Produkt bewegen, werden die Attribute in der Produktliste angezeigt.');
define('TOOLTIP_SPECIALS', 'Festlegen eines Sonderpreises für ein Produkt.');
define('TOOLTIP_SALES_MAKERS', 'Festlegen von Rabatten für mehrere oder alle Kategorien von Waren und / oder Herstellern.');
define('TOOLTIP_EXPORT_IMPORT_CSV', 'Laden / Entladen einer Datenbank aus einer Datei mit der Erweiterung .csv.');
define('TOOLTIP_EXPORT_IMPORT_PROM', 'So exportieren Sie eine Datenbank aus einer aus Prom importierten Datei.');
define('TOOLTIP_ORDER_DATE', 'Bestellungen für den ausgewählten Zeitraum anzeigen.');
define('TOOLTIP_ORDER_DETAILS', 'Bestelldetails');
define('TOOLTIP_ORDER_EDIT', 'Reihenfolge bearbeiten');
define('TOOLTIP_ORDER_STATUS', 'Klicken Sie auf &quot;+&quot;, um einen neuen Bestellstatus hinzuzufügen.');
define('TOOLTIP_CLIENT_EDIT', 'bearbeiten');
define('TOOLTIP_CLIENT_GROUP_PRICE', 'Der Preis, der nach der Autorisierung auf der Website für Kunden einer bestimmten Gruppe angezeigt wird. Die Anzahl der Preise wird im Bereich &quot;Mein Shop&quot; festgelegt');
define('TOOLTIP_CLIENT_PRICE_GROUP_LIMIT', 'Wenn der Betrag das Limit erreicht, können Sie den Kunden an eine andere Gruppe übertragen.');
define('TOOLTIP_CLIENT_GROUP_EDIT', 'bearbeiten');
define('TOOLTIP_EMAIL_TEMPLATE', 'Fertige Briefvorlagen zum Versenden an Kunden.');
define('TOOLTIP_EMAIL_TEMPLATE_EDIT', 'bearbeiten');
define('TOOLTIP_FILE_MANAGER', 'Hochladen und Bearbeiten von Dateien auf der Site.');
define('TOOLTIP_REDIRECTS', 'Beispielsweise müssen Sie von https://demo.solomono.net/kontakty zu https://demo.solomono.net/contact_us.php umleiten. Sie müssen in der Zeile &quot;Weiterleitung von&quot; kontakty &quot;Weiterleitung zu&quot; contact_us.php &quot;angeben');
define('TOOLTIP_MODULES_PAYMENT', 'Verfügbare Zahlungsmethoden hinzufügen.');
define('TOOLTIP_MODULES_SHIPPING', 'Verfügbare Versandmethoden hinzufügen.');
define('TOOLTIP_MODULES_TOTALS', 'Die Gesamtkosten der Bestellung werden auf der Bestellseite angezeigt.');
define('TOOLTIP_MODULES_ZONE', 'Geben Sie die möglichen Versandmethoden für bestimmte Zonen sowie die zulässigen Zahlungsmethoden für diese Zonen an. Sie können eine neue Zone unter Einstellungen-&gt; Steuern-&gt; Steuerzonen erstellen');
define('TOOLTIP_MODULES_LANGUAGES', 'Auswählen von Websitesprachen, Festlegen der Standardsprache.');
define('TOOLTIP_MODULES_CURRENCY', 'Stellen Sie die Standardwährung und den Wert entsprechend dem Kurs ein.');
define('TOOLTIP_MODULES_COUPONS', 'Erstellen Sie einen Gutschein, den der Kunde im Warenkorb einlösen kann, und erhalten Sie einen Rabatt.');
define('TOOLTIP_MODULES_POOLS', 'Erstellen Sie eine Umfrage, um die Statistiken zu erhalten, die Sie benötigen.');
define('TOOLTIP_MODULES_SOLOMONO', 'Liste der gekauften Module + Liste der zum Kauf verfügbaren Module.');
define('TOOLTIP_CONFIGURATION_MAIN_EMAIL', 'Die Hauptadresse, an der alle Benachrichtigungen eingehen.');
define('TOOLTIP_CONFIGURATION_FROM_EMAIL', 'Geben Sie die Adresse an, von der aus alle Briefe in Massenmailings gesendet werden sollen.');
define('TOOLTIP_CONFIGURATION_ORDER_COPY_EMAIL', 'Geben Sie alle Adressen an, an die Kopien von Briefen mit Bestellungen gesendet werden. Sie können mehrere E-Mails angeben, die durch Kommas mit Leerzeichen getrennt sind.');
define('TOOLTIP_CONTACT_US_EMAIL', 'Geben Sie auf der Seite &quot;Kontakt&quot; die Adresse an, an die Anfragen gesendet werden sollen');
define('TOOLTIP_STORE_COUNTRY', 'Geben Sie das Land des Geschäfts an. Es wird standardmäßig bei der Bestellung ausgewählt.');
define('TOOLTIP_STORE_REGION', 'Geben Sie die Region des Geschäfts an. Diese wird standardmäßig bei der Bestellung ausgewählt.');
define('TOOLTIP_CONTACT_ADDRESS', 'Geben Sie die Geschäftsadresse ein, diese wird auf der Seite &quot;Kontakte&quot; angezeigt.');
define('TOOLTIP_MINIMUM_ORDER', 'Optional können Sie den Mindestbetrag für eine erfolgreiche Bestellung angeben.');
define('TOOLTIP_MASTER_PASSWORD', 'Ein Passwort, mit dem Sie das Konto eines auf der Website registrierten Kunden eingeben können.');
define('TOOLTIP_SHOW_PRICE_WITH_TAX', 'Bewegen Sie den Schieberegler, um die Preise auf allen Seiten der Website einschließlich Steuern anzuzeigen.');
define('TOOLTIP_CALCULATE_TAX', 'Falls enthalten, wird die festgelegte Produktsteuer an der Kasse berücksichtigt.');
define('TOOLTIP_EXTRA_PRICE', 'Optional können Sie ein Markup festlegen, das für nicht registrierte Benutzer der Site angezeigt wird.');
define('TOOLTIP_PRICES_COUNT', 'Geben Sie die mögliche Anzahl von Preisen an, die für die Waren festgelegt werden (z. B. mehrere Preise für verschiedene Kundengruppen).');
define('TOOLTIP_SHOW_PRICE_TO_NOT_AUTHORIZED_CUSTOMER', 'Anzeigen der Produktpreise für nicht registrierte Benutzer');
define('TOOLTIP_LOGO', 'Wählen Sie ein Logo (Bild) aus, das auf der Startseite angezeigt werden soll');
define('TOOLTIP_WATERMARK', 'Wählen Sie ein Bild aus, das dem Produktfoto überlagert werden soll, Kopierschutz.');
define('TOOLTIP_FAVICON', 'Wählen Sie das Bild aus, das vom Website-Symbol angezeigt werden soll');
define('TOOLTIP_AUTO_STOCK', 'Bei der Bestellung werden automatisch die Anzahl der Waren im Lager und deren Verfügbarkeit für die Bestellung überprüft.');
define('TOOLTIP_DISABLED_BUY_BUTTON_FOR_ZERO_STOCK', 'Auf der Seite eines Produkts, das nicht vorrätig ist, wird eine Schaltfläche &quot;Kaufen&quot; angezeigt.');
define('TOOLTIP_STOCK_AUTO_INCREMENT', 'Bei der Bestellung wird die Menge der gekauften Waren automatisch vom Restbetrag im Lager abgezogen.');
define('TOOLTIP_ALLOW_ZERO_STOCK_ORDER', 'Ermöglichen Sie die Bestellung eines Produkts, das nicht auf Lager ist.');
define('TOOLTIP_MARK_ZERO_STOCK_PRODUCT', 'Wenn der zum Warenkorb hinzugefügte Artikel nicht in der erforderlichen Menge auf Lager ist, wird der Artikel mit dem angegebenen Wert gekennzeichnet.');
define('TOOLTIP_ZERO_STOCK_NOTIFICATION', 'Wenn diese Menge erreicht ist, wird eine Benachrichtigung an die Post gesendet, dass die Ware ausgeht.');
define('TOOLTIP_SMS_TEXT', 'Geben Sie den Text an, der an den Client gesendet werden soll.');
define('TOOLTIP_SMS_LOGIN', 'Bereitgestellt vom SMS-Anbieter.');
define('TOOLTIP_SMS_PASSWORD', 'Bereitgestellt vom SMS-Anbieter.');
define('TOOLTIP_SMS_CODE_1', 'Telefonnummer oder alphanumerischer Absender.');
define('TOOLTIP_SMS_CODE_2', 'Bereitgestellt vom SMS-Anbieter.');
define('TOOLTIP_TAX_ADD', 'Um einen neuen Steuertyp hinzuzufügen, klicken Sie auf &quot;+&quot; und füllen Sie die erforderlichen Felder aus.');
define('TOOLTIP_TAX_RATE_ADD', 'Klicken Sie auf &quot;+&quot; und füllen Sie die erforderlichen Felder aus, um einen Prozentsatz hinzuzufügen, der zu den Produktkosten hinzugefügt wird.');
define('TOOLTIP_TAX_ZONE_ADD', 'Um eine Zone (ein Land) hinzuzufügen, für die die Steuer gilt, klicken Sie auf &quot;+&quot; und füllen Sie die erforderlichen Felder aus.');
define('TOOLTIP_BACKUP_CREATE', 'Erstellen Sie eine Sicherungskopie der aktuellen Version der Site-Datenbank.');
define('TOOLTIP_BACKUP_LOAD', 'Wiederherstellen der Datenbank aus der ausgewählten Datei.');
define('TOOLTIP_EMAILING', 'Senden einer E-Mail an einen Kunden, alle Kunden oder alle News-Abonnenten.');
define('TOOLTIP_MASS_EMAILING', 'Senden von E-Mails an einen einzelnen Kunden oder an eine ausgewählte Kundengruppe.');
define('TOOLTIP_CLEAR_CACHE', 'Hochgeladene Bilder aus dem Cache löschen.');
define('TOOLTIP_STATS_SALES', 'Anzeige der Verkaufsstatistik.');
define('TOOLTIP_STATS_SALES_PRODUCTS_BY_TIME_PERIOD', 'Verkaufsbericht für bestellte Waren für den ausgewählten Zeitraum.');
define('TOOLTIP_STATS_SALES_CATEGORIES_BY_TIME_PERIOD', 'Verkaufsbericht nach Produktkategorien für den ausgewählten Zeitraum.');
define('TOOLTIP_STATS_VIEWED_PRODUCTS', 'Statistik der angesehenen Produkte.');
define('TOOLTIP_STATS_ZERO_QUANTITY_PRODUCTS', 'Das Produkt ist nicht vorrätig.');
define('TOOLTIP_STATS_CLIENTS_ORDERS', 'Bericht über Kundenkäufe für einen ausgewählten Zeitraum.');
define('TOOLTIP_ADMINISTRATORS', 'Liste der Site-Administratoren.');
define('TOOLTIP_ADMINISTRATORS_GROUPS', 'Aufteilung der Administratoren in Gruppen.');
define('TOOLTIP_ADMINISTRATORS_ACCESS_RIGHTS', 'Zugriffsrechte auf Informationen auf der Site, abhängig von der Gruppe der Administratoren.');
define('TOOLTIP_TEXT_COPIED', 'Text kopiert');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY', 'Kaufen');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON', 'schalte ein');
define('TOOLTIP_TEXT_TAB_LANGUAGES', 'Sprachfunktionalität');
define('TOOLTIP_TEXT_TAB_AUTO_TRANSLATE', 'Automatische Massenübersetzung von Inhalten');
define('TOOLTIP_TEXT_TAB_EDIT_TRANSLATE', 'Übersetzungen bearbeiten');
define('HIGHSLIDE_CLOSE', 'Schließen');
define('COMMENT_BY_ADMIN', 'Kommentar von admin');
define('TEXT_MENU_WHO_IS_ONLINE', 'Wer ist Online');
define('INFO_ICON_NEED_MINIFY', 'Alle Änderungen in diesem Modul ändern den Status der Stile in Jetzt minimieren');
define('INFO_ICON_ENABLE_SMTP', 'Überprüfen Sie beim Einschalten die Einstellungen des SMTP');
define('SMTP_CONF_TITLE', 'SMTP-Einstellungen');
define('INFO_ICON_NEED_GENERATE_CRITICAL', 'Änderungen an diesem Parameter erfordern eine kritische CSS-Regeneration');
define('YANDEX_MARKET_MODULE_ENABLED_TITLE', 'XML (YML) products export "Yandex Market"');
define('AUTO_TRANSLATE_MODULE_ENABLED_TITLE', 'Automatische Übersetzung');
define('TEXT_INFO_BUY_MODULE', 'Das Modul «%s» ist deaktiviert. Um es einzuschalten, verwenden Sie die Seite <a href="%s"><span style="color:blue;" >Module</span></a>');
define('TEXT_INFO_DISABLE_MODULE', 'Es gibt kein «%s» -Modul, um es hinzuzufügen, verwenden Sie <a href="%s"><span style="color:blue;" >SoloMono Modules Store</span></a>');
define("TEXT_POPULAR_SEARCH_QUERIES", "Beliebte Suchanfragen");
define("STATS_KEYWORDS_POPULAR_ENABLED_TITLE", "Seiten durchsuchen");
define("LIST_MODAL_ON","Produktmodalfenster");
define("SHOW_BASKET_ON_ADD_TO_CART_TITLE","Warenkorb anzeigen, wenn Artikel hinzugefügt werden");
define("TEXT_QUICK_ORDER", "Schnelle Bestellung");
define("TEXT_VIEWED","Gesehen");
define('API_ENABLED_TITLE', 'Solomono API');
define('TEXT_MENU_API', 'API');
define('EMAIL_CONTENT_MODULE_ENABLED_TITLE', 'E-Mail-Vorlagen');
define('ENTRY_CREDIT_CARD_CC_TYPE', 'Kartentyp');
define('ENTRY_CREDIT_CARD_CC_OWNER', 'Karteninhaber');
define('ENTRY_CREDIT_CARD_CC_NUMBER', 'Kartennummer');
define('ENTRY_CREDIT_CARD_CC_EXPIRES', 'Karte läuft ab');
define('TEXT_SEARCH_PAGES','Rechercher des pages');
define('SMTP_MODULE_ENABLED_TITLE','SMTP');
define('TEXT_CLOSE_BUTTON', 'Schließen');
define('LEFT_MENU_SECTION_TITLE_SHOP','Geschäft');
define('LEFT_MENU_SECTION_TITLE_INFO','Die Info');
define('LEFT_MENU_SECTION_TITLE_CONTROL','Steuerung');
define('INTEGRATION_FACEBOOK_CONF_TITLE','Integration Facebook');
define('INTEGRATION_GOOGLE_CONF_TITLE','Integration GOOGLE');
define('SEO_SETTINGS_CONF_TITLE','SEO-Einstellungen');

define('FACEBOOK_GOALS_ADD_PAYMENT_INFO_TITLE','Tor \'AddPaymentInfo\' - Zahlungsinformationen ausfüllen');
define('FACEBOOK_GOALS_ADD_TO_WISHLIST_TITLE','Tor \'AddToWishlist\' - zur Wunschliste hinzufügen');
define('FACEBOOK_GOALS_CONTACT_US_REQUEST_TITLE','Tor \'Lead\' - Anfrage auf Kontaktseite');
define('FACEBOOK_GOALS_VIEW_CONTENT_TITLE','Tor \'ViewContent\' - Produktseite anzeigen');
define('FACEBOOK_GOALS_SUCCESS_PAGE_TITLE','Tor \'Purchase\' - Seite nach Bestellung bestätigt');
define('FACEBOOK_GOALS_CHECKOUT_PROCESS_TITLE','Tor \'InitiateCheckout\' - Checkout-Seite');
define('FACEBOOK_GOALS_SEARCH_RESULTS_TITLE','Tor \'Search\' - Suchergebnisseite');
define('FACEBOOK_GOALS_COMPLETE_REGISTRATION_TITLE','Tor \'CompleteRegistration\' - wenn der Kunde registriert ist');
define('FACEBOOK_GOALS_ADD_TO_CART_TITLE','Tor \'AddToCart\' - in den Warenkorb legen');
define('FACEBOOK_GOALS_PAGE_VIEW_TITLE','Tor \'PageView\' - auf jeder Seite');
define('FACEBOOK_GOALS_CLICK_FAST_BUY_TITLE','Tor \'FastBuy\' - Wenn der Kunde auf der Produktseite auf die Schaltfläche \'Schnellbestellung\' klickt');
define('FACEBOOK_GOALS_CLICK_ON_CHAT_TITLE','Tor \'ClickChat\' - Wenn der Kunde auf die Schaltfläche Chat klickt');
define('FACEBOOK_GOALS_CALLBACK_TITLE','Tor \'Callback\' - Wenn der Kunde im Site-Header auf die Schaltfläche \'Rückruf\' klickt');
define('FACEBOOK_GOALS_FILTER_TITLE','Tor \'filter\' - wenn der Kunde einen Filter verwendet, um nach Produkten zu suchen');
define('FACEBOOK_GOALS_SUBSCRIBE_TITLE','Tor \'Subscribe\' - wenn der Kunde abonniert hat');
define('FACEBOOK_GOALS_LOGIN_TITLE','Tor \'login\' - wenn sich der Kunde angemeldet hat');
define('FACEBOOK_GOALS_ADD_REVIEW_TITLE','Tor \'add_review\' - wenn der Kunde eine Bewertung hinzufügt');
define('FACEBOOK_GOALS_PHONE_CALL_TITLE','Tor \'PhoneCall\' - Wenn der Kunde auf die Telefonnummer in der Kopfzeile der Website klickt');
define('FACEBOOK_GOALS_CLICK_ON_BUG_REPORT_TITLE','Tor \'BugReport\' - Wenn der Kunde in der Fußzeile der Site auf \'Fehlermeldung senden\' klickt');

define('NWPOSHTA_DELIVERY_TITLE', 'Neue Postzustelladresse');

define('HEADER_BUY_TEMPLATE_LINK','Zum kostenpflichtigen Paket wechseln');
define('HEADER_MARKETPLACE_LINK','Marktplatz der Module');
define('TEXT_CATEGORIES', 'Kategorien');
define('HEADING_TITLE_GOTO', 'Gehe zu:');
define('ERROR_DOMAIN_IN_USE','Fehler! Diese Domain wird bereits verwendet');
define('ERROR_ANAME_MISMATCH', 'Fehler! A-Name stimmt nicht mit 167.172.41.152 überein. Versuchen Sie es später');
define('SUCCESS_DOMAIN_CHANGE', 'Erfolgreich! Domain geändert');
define('ERROR_ADD_DOMAIN_FIRST','Verbinden Sie zuerst Ihre benutzerdefinierte Domain!');
define('ERROR_BASH_EXECUTION','Fehler beim Ausführen des Skripts, Manager kontaktieren');

// повторные константы
define('TOOLTIP_STORE_NAME', 'Geben Sie den Originalnamen des Ladens an, der Kunden anzieht, den sich die Kunden merken und der dazu dient, sich von ähnlichen Läden - Mitbewerbern - abzuheben und abzuheben.');
define('TOOLTIP_STORE_OWNER', 'Ladenbesitzer angeben');
define('TOOLTIP_SHOW_BASKET_ON_ADD_TO_CART', 'Aktivieren, der Warenkorb wird verfügbar sein, wenn ein Produkt hinzugefügt wird, damit der Besucher keine Fragen hat, dass das Produkt zum Warenkorb hinzugefügt wurde.');
define('TOOLTIP_USE_DEFAULT_LANGUAGE_CURRENCY', 'Aktivieren Sie die automatische Änderung der Währung entsprechend der aktuellen Seitensprache.');
define('TOOLTIP_CHANGE_BY_GEOLOCATION', 'Änderung der Website-Währung und -Sprache basierend auf Geolokalisierung aktivieren.');
define('TOOLTIP_GET_BROWSER_LANGUAGE', 'Aktivieren Sie diese Option, um die Website-Währung abhängig von der Browsersprache zu ändern.');
define('TOOLTIP_STORE_BANK_INFO', 'Ermöglicht es Ihnen, genaue Bankinformationen für Rechnungsdetails zu definieren');
define('TOOLTIP_ONEPAGE_LOGIN_REQUIRED', 'Aktivieren und Benutzer-/Client-Login wird immer erforderlich sein');
define('TOOLTIP_REVIEWS_WRITE_ACCESS', 'Einschalten und nur registrierte Benutzer können Kommentare hinterlassen');
define('TOOLTIP_ROBOTS_TXT', 'Schutz der gesamten Website oder einiger ihrer Bereiche vor Indizierung');
define('TOOLTIP_MENU_LOCATION', 'Menüposition auswählen: oben, links oder links eingeklappt');
define('TOOLTIP_DEFAULT_DATE_FORMAT', 'Datumsformat auswählen');
define('TOOLTIP_SET_HTTPS', 'HTTPS-Protokollerweiterung aktivieren, um Verschlüsselung für erhöhte Sicherheit zu unterstützen');
define('TOOLTIP_SET_WWW', 'Wählen Sie die Einstellung, wohin umgeleitet werden soll: disable, www->no-www oder no-www->www');
define('TOOLTIP_ENABLE_DEBUG_PAGE_SPEED', 'Seitenlade-Debug aktivieren, um Skriptfehler zu finden und zu beheben');
define('TOOLTIP_STORE_SCRIPTS', 'Sie können zusätzliche JS-Skripte einbinden');
define('TOOLTIP_STORE_METAS', 'Sie können zusätzliche Meta-Tags in den Kopf einfügen');
define('TOOLTIP_MYSQL_PERFORMANCE_TRESHOLD', 'Legen Sie die Zeit in "Sekunden" fest, über der langsame und potenziell problematische Abfragen in der Datenbank protokolliert werden');
define('TOOLTIP_STOCK_REORDER_LEVEL', 'Geben Sie die Bestandsmengen ein');

define('TOOLTIP_TELEGRAM_NOTIFICATIONS_ENABLED', 'Sie können Telegram-Benachrichtigungen aktivieren/deaktivieren');
define('TOOLTIP_TELEGRAM_TOKEN', 'Spezielle Telegrammkonten erstellt, um Nachrichten automatisch zu verarbeiten und zu versenden');
define('TOOLTIP_SMS_ENABLE', 'Sie können den SMS-Dienst aktivieren/deaktivieren');
define('TOOLTIP_SMS_CUSTOMER_ENABLE', 'Sie können die Möglichkeit aktivieren/deaktivieren, beim Kauf SMS an einen Kunden zu senden');
define('TOOLTIP_SMS_CHANGE_STATUS', 'Sie können die Fähigkeit aktivieren/deaktivieren, SMS an den Client zu senden, wenn Sie den Status ändern');
define('TOOLTIP_SMS_OWNER_ENABLE', 'Sie können die Möglichkeit aktivieren/deaktivieren, beim Kauf SMS an den Administrator zu senden');
define('TOOLTIP_SMS_OWNER_TEL', 'Telefonnummer des Administrators eingeben/ändern');

define('TOOLTIP_FACEBOOK_AUTH_STATUS', 'Sie können Benutzern erlauben, sich mit einem Facebook-Konto auf Ihrer Website anzumelden. Dies ist eine großartige Möglichkeit, diesen Vorgang für Ihre Benutzer einfacher und bequemer zu gestalten und die Anzahl neuer Registrierungen zu erhöhen.') ;
define('TOOLTIP_FACEBOOK_APP_ID', 'Eine Social-Media-ID ist eine Zahlenkombination, die es Ihnen ermöglicht, ein Konto von anderen zu unterscheiden. Im Internet ist dies ein Analogon eines Reisepasses, der häufig zuverlässige Schutzmethoden verwenden muss. Eine Identifizierung Nummer wird bei der Registrierung eines Profils automatisch generiert, damit Sie Informationen, Personen oder Interessengemeinschaften finden können.');
define('TOOLTIP_FACEBOOK_APP_SECRET', 'Der geheime Schlüssel ist ein Gerät zum Schutz Ihres Facebook-Kontos. Es ist auch eine Zwei-Faktor-Authentifizierungsmethode, die die Sicherheit beim Einloggen in Ihr Konto erhöht.');
define('TOOLTIP_FACEBOOK_PIXEL_ID', 'Anhand der vom Facebook-Pixel gesammelten Daten können Sie Besuche und Konversionen auf Ihrer Website nachverfolgen, Anzeigen optimieren und benutzerdefinierte Zielgruppen für das Retargeting erstellen.');
define('TOOLTIP_DEFAULT_PIXEL_CURRENCY', 'Geben Sie die Währung an, in der der Produktpreis an FaceBook Pixel gesendet wird');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_BUG_REPORT', 'Entwickelt, um entdeckte Fehler zu beschreiben, was es dem Entwicklungsteam ermöglicht, Fehler im Programm zu beheben.');
define('TOOLTIP_FACEBOOK_GOALS_PHONE_CALL', 'Indem Sie eine Anzeige mit einer Telefonnummer schalten, können Sie die Leute dazu ermutigen, Ihr Unternehmen anzurufen, um eine Bestellung aufzugeben, mehr über Ihre Produkte oder Dienstleistungen zu erfahren oder einen Termin zu vereinbaren.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_FAST_BUY', 'Wenn regelmäßig Waren gekauft werden, sind die Eigenschaften dem Käufer oft schon bekannt, die Aufgabe ist nicht die Auswahl, sondern die richtige zu finden, in den Warenkorb zu legen und schnell zu bestellen.') ;
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_CHAT', 'Eine Chat-Schaltfläche ist ein Symbol, das irgendwo auf Ihrer Website platziert wird und es Kunden ermöglicht, in Echtzeit mit dem Kundensupport-Team zu kommunizieren. Mithilfe des Online-Chats können Ihre Spezialisten Kundenanfragen schnell und effizient lösen.' );
define('TOOLTIP_FACEBOOK_GOALS_CALLBACK', 'Der Zweck des Callback-Buttons ist es, mit einem potenziellen Kunden zu kommunizieren.');
define('TOOLTIP_FACEBOOK_GOALS_FILTER', 'Der Filter ermöglicht es Ihnen, das Sortiment auf eine Auswahl mit Merkmalen einzugrenzen, die für die individuellen Bedürfnisse des Benutzers am relevantesten sind.');
define('TOOLTIP_FACEBOOK_GOALS_SUBSCRIBE', 'Gibt Benutzern die Möglichkeit, thematische E-Mail-Newsletter zu organisieren und zu verwalten, die andere Benutzer des Dienstes abonnieren können.');
define('TOOLTIP_FACEBOOK_GOALS_LOGIN', 'Login ist das Wort, das verwendet wird, um auf die Seite oder den Dienst zuzugreifen. Sehr oft ist der Login derselbe wie der Benutzername, der für alle Teilnehmer des Dienstes sichtbar ist.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_REVIEW', 'Kundenrezensionen - Feedback von Benutzern zu Ihren Produkten oder Dienstleistungen. Um ein Produkt zu kaufen, lesen 89 % der Käufer zuerst Rezensionen.');
define('TOOLTIP_FACEBOOK_GOALS_PAGE_VIEW', 'Sie können sehen, wie viele Leute Ihre Seite gesehen und angefragt haben');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_CART', 'Die Schaltfläche "In den Warenkorb" impliziert den Kauf mehrerer Produkte, wenn sie zum ersten Mal in den Warenkorb gelegt werden und dort bereits eine Bestellung aufgegeben wird.');
define('TOOLTIP_FACEBOOK_GOALS_CHECKOUT_PROCESS', 'Die Qualität und Benutzerfreundlichkeit des Warenkorbs ist ein Garant für gute Laune bei Ihren Kunden, ein effektiver Weg, um die Website-Conversion zu steigern.');
define('TOOLTIP_FACEBOOK_GOALS_SEARCH_RESULTS', 'Führt den Benutzer zur Suchergebnisseite');
define('TOOLTIP_FACEBOOK_GOALS_VIEW_CONTENT', 'ViewContent teilt Ihnen mit, ob jemand eine Webseiten-URL besucht.');
define('TOOLTIP_FACEBOOK_GOALS_COMPLETE_REGISTRATION', 'Bereitstellung von Informationen durch den Kunden im Austausch für eine Dienstleistung Ihres Unternehmens');
define('TOOLTIP_FACEBOOK_GOALS_CONTACT_US_REQUEST', 'Kontaktdaten einer Person, die echtes Interesse an den Produkten und Dienstleistungen des Unternehmens gezeigt hat und in Zukunft ein echter Kunde werden könnte.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_WISHLIST', 'Eines der Ereignisse, mit dem Sie Benutzeraktionen überwachen, optimieren und Zielgruppen erstellen können');
define('TOOLTIP_FACEBOOK_GOALS_ADD_PAYMENT_INFO', 'Eines der Ereignisse, mit dem Sie Benutzeraktionen überwachen, optimieren und Zielgruppen erstellen können');
define('TOOLTIP_FACEBOOK_GOALS_SUCCESS_PAGE', 'Kunde sieht eine Art Rechnung für eine abgeschlossene Bestellung.');

define('TOOLTIP_ENTRY_FIRST_NAME_MIN_LENGTH', "Geben Sie für jeden Parameter die Mindestanzahl an Zeichen in der Spalte 'Wert' an");
define('TOOLTIP_ENTRY_LAST_NAME_MIN_LENGTH', "Geben Sie für jeden Parameter die Mindestanzahl an Zeichen in der Spalte 'Wert' an");
define('TOOLTIP_ENTRY_EMAIL_ADDRESS_MIN_LENGTH', "Geben Sie für jeden Parameter die Mindestanzahl an Zeichen in der Spalte 'Wert' an");
define('TOOLTIP_MIN_DISPLAY_XSELL', "Geben Sie für jeden Parameter die Mindestanzahl an Zeichen in der Spalte 'Wert' an");
define('PRODUCTS_LIMIT_REACHED_FREE', 'Produktlimit überschritten! Ihre Website wird in %s Tagen automatisch deaktiviert. <a href="%s">Gebühr mieten</a> oder unerwünschte Produkte entfernen');
define('PRODUCTS_LIMIT_REACHED_JUNIOR', 'Produktlimit überschritten! In %s Tagen wird Ihre Website automatisch auf das SEO-Paket aktualisiert.');
define('PRODUCTS_LIMIT_REACHED_SEO', 'Produktlimit überschritten! In %s Tagen wird Ihre Seite automatisch auf das Pro-Paket aktualisiert');
define('PRODUCTS_LIMIT_REACHED_HEADING', 'Produktlimit überschritten!');

define('ERROR_SIMLINK_CREATE', 'Symlink nicht erstellt');
define('ERROR_FOLDER_RENAME', 'Ordner nicht kopiert');
