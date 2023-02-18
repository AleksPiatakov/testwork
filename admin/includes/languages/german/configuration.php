<?php
/*
  $Id: configuration.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce

  Released under the GNU General Public License
*/

// ultimate seo url(added by raid)

define('SEO_ENABLED_TITLE', 'Enable SEO URLs?');
define('SEO_ADD_CPATH_TO_PRODUCT_URLS_TITLE', 'Add cPath to product URLs?');
define('SEO_ADD_SLASH_BEFORE_PRODUCT_ID_TITLE', 'Add slash before product ID in URLs?');
define('SEO_ADD_SLASH_BEFORE_CATEGORY_ID_TITLE', 'Add slash before category ID in URLs?');
define('SEO_ADD_PARENT_CATEGORIES_TO_URL_TITLE', 'IDs der übergeordneten Kategorien zur URL hinzufügen?');
define('SEO_ADD_CAT_PARENT_TITLE', 'Add category parent to begining of URLs?');
define('SEO_URLS_USE_W3C_VALID_TITLE', 'Output W3C valid URLs(parameter string)?');
define('USE_SEO_CACHE_GLOBAL_TITLE', 'Enable SEO cache to save queries?');
define('USE_SEO_CACHE_PRODUCTS_TITLE', 'Enable product cache?');
define('USE_SEO_CACHE_CATEGORIES_TITLE', 'Enable categories cache?');
define('GOOGLE_SITE_VERIFICATION_KEY_TITLE', 'Google site verification key');
define('USE_SEO_CACHE_MANUFACTURERS_TITLE', 'Enable manufacturers cache?');
define('USE_SEO_CACHE_ARTICLES_TITLE', 'Enable articles cache?');
define('USE_SEO_CACHE_TOPICS_TITLE', 'Enable topics cache?');
define('USE_SEO_CACHE_INFO_PAGES_TITLE', 'Enable information cache?');
define('USE_SEO_CACHE_LINKS_TITLE', 'Enable link directory cache?');
define('USE_SEO_REDIRECT_TITLE', 'Enable automatic redirects?');
define('SEO_REWRITE_TYPE_TITLE', 'Choose URL Rewrite Type');
define('SEO_URLS_FILTER_SHORT_WORDS_TITLE', 'Filter Short Words');
define('SEO_CHAR_CONVERT_SET_TITLE', 'Enter special character conversions');
define('SEO_REMOVE_ALL_SPEC_CHARS_TITLE', 'Remove all non-alphanumeric characters?');
define('REVIEWS_WRITE_ACCESS_TITLE' , 'Erlauben Sie nur registrierten Benutzern, Bewertungen zu schreiben');
define('SEO_URLS_CACHE_RESET_TITLE', 'Cache für SEO URLs zurücksetzen');
define('SEO_FILTER_TITLE' , 'Aktivieren Sie SEO-Filter');
define('ONEPAGE_ADDRESS_TYPE_POSITION_TITLE' , 'Adressreihenfolge');

define ('USE_CRITICAL_CSS_TITLE', 'Kritisches CSS verwenden?');
define('TABLE_HEADING_CONFIGURATION_TITLE', 'Kopfzeile');
define('TABLE_HEADING_CONFIGURATION_VALUE', 'Wert');
define('TABLE_HEADING_CONFIGURATION_SHOW_FIELD', 'Feld anzeigen');
define('TABLE_HEADING_CONFIGURATION_REQUIRED_VALUE', 'Obligatorisch');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_INFO_EDIT_INTRO', 'Bitte nehmen Sie die notwendigen Änderungen vor');
define('TEXT_SAVE_BUTTON', 'Speichern');
define('TEXT_CANCEL_BUTTON', 'Abbrechen');
define('TEXT_CLOSE_BUTTON', 'Schließen');
define('TEXT_INFO_DATE_ADDED', 'Datum hinzugefügt:');
define('TEXT_INFO_LAST_MODIFIED', 'Zuletzt geändert:');
define('ERROR_TEMPLATE_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Das Verzeichnis ist schreibgeschützt, setze die korrekten Berechtigungen(zB chmod 777) für das Verzeichnis');
define('ERROR_TEMPLATE_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Verzeichnis fehlt, Verzeichnis erstellen');

// Mein Geschäft

define('MYSQL_PERFORMANCE_TRESHOLD_TITLE', 'MySQL Performance Log time "von"');
define('MINIFY_CSSJS_TITLE' , 'CSS und JS reduzieren?');
define('MENU_LOCATION_TITLE' , 'Speicherort des Administratormenüs: ');
define('MENU_TOP_LOCATION' , 'von oben');
define('MENU_LEFT_LOCATION' , 'auf der linken Seite');
define('MENU_LEFT_MIN_LOCATION' , 'links und gefaltet');
define('MINIFY_CSSJS_0_TITLE' , 'Nicht abbauen');
define('MINIFY_CSSJS_1_TITLE' , 'Jetzt verkleinern');
define('MINIFY_CSSJS_2_TITLE' , 'Verwenden Sie eine reduzierte Datei');
define('IMAGE_CACHE_TITLE', 'Bearbeiten IMAGE_CACHE');
define('IMAGE_CACHE_0_TITLE', 'Ausschalten');
define('IMAGE_CACHE_1_TITLE', 'Aktivieren');
// define('ALLOW_AUTOLOGON_TITLE', 'Autologin aktivieren');
define('DEFAULT_TEMPLATE_TITLE', 'Standardvorlage');
define('LOGO_IMAGE_TITLE', 'Firmenlogo');
define('STORE_NAME_TITLE', 'Speichername');
define('STORE_OWNER_TITLE', 'Eigentümer speichern');
define('STORE_ADDRESS_TITLE' , 'Adresse speichern');
define('STORE_LOGO_TITLE', 'Logo speichern');
define('STORE_OWNER_EMAIL_ADDRESS_TITLE', 'E-Mail-Adresse');
define('STORE_OWNER_ICQ_NUMBER_TITLE', 'ICQ-Nummer');
define('EMAIL_FROM_TITLE', 'E-Mail von');
define('STORE_COUNTRY_TITLE', 'Land');
define('STORE_ZONE_TITLE', 'Region');
define('EXPECTED_PRODUCTS_SORT_TITLE', 'Sortierung der erwarteten Waren');
define('EXPECTED_PRODUCTS_FIELD_TITLE', 'Erwartete Artikel sortieren');
define('USE_DEFAULT_LANGUAGE_CURRENCY_TITLE', 'Wechsel in die Währung der aktuellen Sprache');
define('SEND_EXTRA_ORDER_EMAILS_TO_TITLE', 'Kopien von Briefen mit einem Auftrag senden');
define('SEARCH_ENGINE_FRIENDLY_URLS_TITLE', 'Kurze URLs verwenden(in Entwicklung)');
define('DISPLAY_CART_TITLE', 'Gehe zum Warenkorb nach dem Hinzufügen der Waren');
define('ALLOW_GUEST_TO_TELL_A_FRIEND_TITLE', 'Erlauben Sie den Gästen, die Tell a Friend Option zu verwenden');
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_TITLE', 'Standardsuchoperator');
define('STORE_NAME_ADDRESS_TITLE', 'Adresse und Telefonnummer speichern');
define('ALLOW_CATEGORY_DESCRIPTIONS_TITLE', 'Kategoriebeschreibungen erlauben');
define('TAX_DECIMAL_PLACES_TITLE', 'Anzahl der Nachkommastellen für Steuern');
define('SHOW_MAIN_FEATURED_PRODUCTS_TITLE', 'Empfohlene Produkte auf der Hauptseite anzeigen');
define('DISPLAY_PRICE_WITH_TAX_TITLE', 'Preise mit Steuern anzeigen');
define('XPRICES_NUM_TITLE', 'Anzahl der möglichen Preise für das Produkt');
// define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_TITLE', 'Nominaler Geschenkgutschein, den Besucher erhalten');
define('ALLOW_GUEST_TO_SEE_PRICES_TITLE', 'Preise für Besucher anzeigen');
// define('NEW_SIGNUP_DISCOUNT_COUPON_TITLE', 'Gutscheincode, der von registrierten Besuchern empfangen werden soll');
define('GUEST_DISCOUNT_TITLE', 'Markup für Besucher');
define('CATEGORIES_SORT_ORDER_TITLE', 'Waren sortieren, Kategorien');
define('QUICKSEARCH_IN_DESCRIPTION_TITLE', 'Suche in Produktbeschreibungen');
define('CONTACT_US_LIST_TITLE', 'Empfänger von Briefen, die von der Kontaktseite gesendet wurden');
define('SET_HTTPS_TITLE' , 'Turn on HTTPS?');
define('ENABLE_DEBUG_PAGE_SPEED_TITLE', 'Seitenlade-Debugging aktivieren');
define('SET_WWW_TITLE' , 'Weiterleitung zu www');
define('WWW_TOO_MANY_REDIRECTS' , 'Zu viele Weiterleitungen, keine Änderung');
// define('ALLOW_GIFT_VOUCHERS_TITLE', 'Verwendung von Gutscheinen und Promo codes erlauben');
define('ALLOW_ATTRIBUTES_IN_PRODUCT_EDIT_PAGE_TITLE', 'Attributverwaltung auf der Artikelseite zulassen');
define('SHOW_SUBCATEGORIES_WHEN_CATEGORIES_HAS_PRODUCTS_TITLE', 'Unterkategorien anzeigen, wenn in der Kategorie ein Produkt vorhanden ist');
define('SHOW_PDF_DATASHEET_TITLE', 'PDF-Beschreibung der Waren anzeigen');
define('MAIN_COLOR_TITLE', 'Hauptfarbe der Site');
define('SECOND_COLOR_TITLE', 'Zweite Farbe der Seite');
define('BACKGROUND_COLOR_TITLE', 'Site Background');

// Minimale Werte

define('ENTRY_FIRST_NAME_MIN_LENGTH_TITLE', 'Name');
define('ENTRY_LAST_NAME_MIN_LENGTH_TITLE', 'Nachname');
define('ENTRY_DOB_MIN_LENGTH_TITLE', 'Geburtsdatum');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_TITLE', 'E-Mail Adresse');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_TITLE', 'Adresse');
define('ENTRY_COMPANY_MIN_LENGTH_TITLE', 'Firma');
define('ENTRY_POSTCODE_MIN_LENGTH_TITLE', 'PLZ');
define('ENTRY_CITY_MIN_LENGTH_TITLE', 'Stadt');
define('ENTRY_COUNTRY_MIN_LENGTH_TITLE', 'Land');
define('ENTRY_FAX_MIN_LENGTH_TITLE', 'Fax');
define('ENTRY_SUBURB_MIN_LENGTH_TITLE', 'Vorort');
define('ENTRY_STATE_MIN_LENGTH_TITLE', 'Region');
define('ENTRY_TELEPHONE_MIN_LENGTH_TITLE', 'Telefon');
define('ENTRY_PASSWORD_MIN_LENGTH_TITLE', 'Passwort');
define('CC_OWNER_MIN_LENGTH_TITLE', 'Kreditkarteninhaber');
define('CC_NUMBER_MIN_LENGTH_TITLE', 'Kreditkartennummer');
define('REVIEW_TEXT_MIN_LENGTH_TITLE', 'Sperrtext');
define('MIN_DISPLAY_BESTSELLERS_TITLE', 'Verkaufsleiter');
define('MIN_DISPLAY_ALSO_PURCHASED_TITLE', 'Auch bestellt');
define('MIN_DISPLAY_XSELL_TITLE', 'Verwandte Produkte');
define('MIN_ORDER_TITLE', 'Mindestbestellmenge');

// Höchstwerte

define('MAX_PROD_ADMIN_SIDE_TITLE', 'Elemente auf einer Seite in der Admin-Seite');
define('MAX_ADDRESS_BOOK_ENTRIES_TITLE', 'Einträge im Adressbuch');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE', 'Elemente auf einer Seite im Verzeichnis');
define('MAX_DISPLAY_PAGE_LINKS_TITLE', 'Links zu Seiten');
define('MAX_DISPLAY_SPECIAL_PRODUCTS_TITLE', 'Sonderpreise');
define('MAX_DISPLAY_NEW_PRODUCTS_TITLE', 'Neu');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_TITLE', 'Erwartete Artikel');
define('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST_TITLE', 'Liste der Produzenten');
define('MAX_MANUFACTURERS_LIST_TITLE', 'Hersteller in Form eines erweiterten Menüs');
define('MAX_DISPLAY_MANUFACTURER_NAME_LEN_TITLE', 'Beschränkung der Länge des Herstellernamens');
define('MAX_RANDOM_SELECT_NEW_TITLE', 'Wahl eines zufälligen Gegenstandes in der Schachtel der Neuheit');
define('MAX_RANDOM_SELECT_SPECIALS_TITLE', 'Wähle einen zufälligen Gegenstand im Feld Rabatte');
define('MAX_DISPLAY_CATEGORIES_PER_ROW_TITLE', 'Anzahl der Kategorien pro Zeile');
define('MAX_DISPLAY_PRODUCTS_NEW_TITLE', 'Anzahl neuer Produkte auf der Seite');
define('MAX_DISPLAY_BESTSELLERS_TITLE', 'Verkaufsleiter');
define('MAX_DISPLAY_ALSO_PURCHASED_TITLE', 'Auch bestellt');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_TITLE', 'Boxing Order History');
define('MAX_DISPLAY_ORDER_HISTORY_TITLE', 'Bestellhistorie');
define('MAX_DISPLAY_FEATURED_PRODUCTS_TITLE', 'Artikel in der Box Empfohlene Waren auf der Hauptseite');
define('MAX_DISPLAY_FEATURED_PRODUCTS_LISTING_TITLE', 'Artikel auf einer Seite der empfohlenen Produkte');
define('SLIDER_HEIGHT_TITLE' , 'Höhe des Schiebers');

// Bilder

define('SMALL_IMAGE_WIDTH_TITLE', 'Breite eines kleinen Bildes');
define('SMALL_IMAGE_HEIGHT_TITLE', 'Höhe eines kleinen Bildes');
define('HEADING_IMAGE_WIDTH_TITLE', 'Image Category Width');
define('HEADING_IMAGE_HEIGHT_TITLE', 'Höhe der Bildkategorie');
define('SUBCATEGORY_IMAGE_WIDTH_TITLE', 'Bildbreite der Unterkategorie');
define('SUBCATEGORY_IMAGE_HEIGHT_TITLE', 'Die Höhe des Unterkategorienbildes');
define('CONFIG_CALCULATE_IMAGE_SIZE_TITLE', 'Bildgröße berechnen');
define('IMAGE_REQUIRED_TITLE', 'Bild ist erforderlich');
define('ULTIMATE_ADDITIONAL_IMAGES_TITLE', 'Verwendung des zusätzlichen Bildmoduls aktivieren?');
define('ULT_THUMB_IMAGE_WIDTH_TITLE', 'Breite des Zusatzbildes');
define('ULT_THUMB_IMAGE_HEIGHT_TITLE', 'Höhe des Zusatzbildes');
define('MEDIUM_IMAGE_WIDTH_TITLE', 'Breite des großen Bildes');
define('MEDIUM_IMAGE_HEIGHT_TITLE', 'Höhe des großen Bildes');
define('LARGE_IMAGE_WIDTH_TITLE', 'Bildbreite für Popup-Fenster');
define('LARGE_IMAGE_HEIGHT_TITLE', 'Bildhöhe für Popup-Fenster');

// Daten des Käufers

define('ACCOUNT_GENDER_TITLE', 'Geschlecht');
define('ACCOUNT_DOB_TITLE', 'Geburtsdatum');
define('ACCOUNT_COMPANY_TITLE', 'Firma');
define('ACCOUNT_SUBURB_TITLE', 'Bereich');
define('ACCOUNT_STATE_TITLE', 'Region');
define('ACCOUNT_STREET_ADDRESS_TITLE', 'Adresse');
define('ACCOUNT_CITY_TITLE', 'Stadt');
define('ACCOUNT_POSTCODE_TITLE', 'Postleitzahl');
define('ACCOUNT_COUNTRY_TITLE', 'Land');
define('ACCOUNT_TELE_TITLE', 'Telefon');
define('ACCOUNT_FAX_TITLE', 'Fax');
define('ACCOUNT_NEWS_TITLE', 'Newsletter');
define('ACCOUNT_LAST_NAME_TITLE', 'Nachname');
define('ACCOUNT_FIRST_NAME_TITLE' , 'Name');

// Versand/Verpackung

define('SHIPPING_ORIGIN_COUNTRY_TITLE', 'Land speichern');
define('SHIPPING_ORIGIN_ZIP_TITLE', 'Postleitzahl speichern');
define('SHIPPING_MAX_WEIGHT_TITLE', 'Maximales Liefergewicht');
define('SHIPPING_BOX_WEIGHT_TITLE', 'Minimales Paketgewicht');
define('SHIPPING_BOX_PADDING_TITLE', 'Verpackungsgewicht in Prozent');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_TITLE', 'Kostenloser Versand');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_TITLE', 'Kostenloser Versand für Bestellungen von mehr als einem');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_TITLE', 'Kostenloser Versand für Bestellungen von');
define('SHOW_SHIPPING_ESTIMATOR_TITLE', 'Methoden und Versandkosten im Warenkorb anzeigen');

// Warenausgang

define('PRODUCT_LISTING_DISPLAY_STYLE_TITLE', 'Ausgabeformat');
define('PRODUCT_LIST_IMAGE_TITLE', 'Produktbild anzeigen');
define('PRODUCT_LIST_MANUFACTURER_TITLE', 'Hersteller der Waren anzeigen');
define('PRODUCT_LIST_MODEL_TITLE', 'Produktcode anzeigen');
define('PRODUCT_LIST_NAME_TITLE', 'Produktname anzeigen');
define('PRODUCT_LIST_PRICE_TITLE', 'Kosten der Ware anzeigen');
define('PRODUCT_LIST_QUANTITY_TITLE', 'Warenmenge auf Lager anzeigen');
define('PRODUCT_LIST_WEIGHT_TITLE', 'Produktgewicht anzeigen');
define('PRODUCT_LIST_BUY_NOW_TITLE', 'Show Buy Now! - Schaltfläche');
define('PRODUCT_LIST_FILTER_TITLE', 'PDF-Link anzeigen');
define('PREV_NEXT_BAR_LOCATION_TITLE', 'Navigationsposition Nächste/Vorherige Seite');
define('PRODUCT_LIST_INFO_TITLE', 'Kurze Beschreibung anzeigen');
define('PRODUCT_SORT_ORDER_TITLE', 'Sortierreihenfolge anzeigen');

// Lager

define('STOCK_CHECK_TITLE', 'Inventarverfügbarkeit prüfen');
define('STOCK_SHOW_BUY_BUTTON_TITLE' , 'Schaltfläche "Kaufen" anzeigen, wenn Artikel fehlt');
define('STOCK_LIMITED_TITLE', 'Ware vom Lagerbestand abziehen');
define('STOCK_ALLOW_CHECKOUT_TITLE', 'Bestellung aktivieren');
define('STOCK_DISABLE_NON_EXISTENT_PRODUCT_ON_CHECKOUT_TITLE', 'Eingelöste Produkte deaktivieren');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_TITLE', 'Artikel nicht vorrätig');
define('STOCK_REORDER_LEVEL_TITLE', 'Bestandsmengenlimit');

// Logs

define('STORE_PAGE_PARSE_TIME_TITLE', 'Parsingzeit der Seite speichern');
define('STORE_PAGE_PARSE_TIME_LOG_TITLE', 'Log-Verzeichnis');
define('STORE_PARSE_DATE_TIME_FORMAT_TITLE', 'Format des Log-Datums');
define('DISPLAY_PAGE_PARSE_TIME_TITLE', 'Parsingzeit der Seite anzeigen');
define('STORE_DB_TRANSACTIONS_TITLE', 'Abfragen in der Melonendatenbank speichern');

// Cache

define('USE_CACHE_TITLE', 'Cache benutzen');
define('DIR_FS_CACHE_TITLE', 'Cache-Verzeichnis');

// E-Mail konfigurieren

define('EMAIL_TRANSPORT_TITLE', 'So senden Sie E-Mails');
define('EMAIL_LINEFEED_TITLE', 'Trennzeichen in E-Mail');
define('EMAIL_USE_HTML_TITLE', 'HTML-Format beim Senden von Nachrichten verwenden');
define('ENTRY_EMAIL_ADDRESS_CHECK_TITLE', 'E-Mail-Adresse über DNS prüfen');
define('SEND_EMAILS_TITLE', 'Briefe aus dem Geschäft senden');

// Herunterladen

define('DOWNLOAD_ENABLED_TITLE', 'Produktdownloadfunktion aktivieren');
define('DOWNLOAD_BY_REDIRECT_TITLE', 'Download-Umleitung verwenden');
define('DOWNLOAD_MAX_DAYS_TITLE', 'Die Lebensdauer des Downloadlinks(Tage)');
define('DOWNLOAD_MAX_COUNT_TITLE', 'Maximale Anzahl von Downloads');
define('DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE_TITLE', 'Download Statistiken zurücksetzen');
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG_TITLE', 'Warnung über die Notwendigkeit, für die heruntergeladene Ware zu bezahlen');
define('DOWNLOADS_CONTROLLER_ORDERS_STATUS_TITLE', 'Download ist nur für Aufträge mit dem angegebenen Status erlaubt');

// GZip-Komprimierung

define('GZIP_COMPRESSION_TITLE', 'GZip-Komprimierung zulassen');
define('GZIP_LEVEL_TITLE', 'Komprimierungsgrad');

// Sitzungen

define('SESSION_WRITE_DIRECTORY_TITLE', 'Sitzungsverzeichnis');
define('SESSION_FORCE_COOKIE_USE_TITLE', 'Erzwungene Verwendung von Cookies');
define('SESSION_CHECK_SSL_SESSION_ID_TITLE', 'SSL-Sitzungs-ID prüfen');
define('SESSION_CHECK_USER_AGENT_TITLE', 'Benutzer-Agent-Variable überprüfen');
define('SESSION_CHECK_IP_ADDRESS_TITLE', 'IP-Adresse prüfen');
define('SESSION_BLOCK_SPIDERS_TITLE', 'Zeige die Sitzung nicht in der Adresse für Suchmaschinen-Spider');
define('SESSION_RECREATE_TITLE', 'Die Sitzung neu erstellen');

// Tech. Wartung

define('DOWN_FOR_MAINTENANCE_TITLE', 'Maintenance: On/Off');
define('DOWN_FOR_MAINTENANCE_FILENAME_TITLE', 'Wartung: Dateiname');
define('DOWN_FOR_MAINTENANCE_HEADER_OFF_TITLE', 'Maintenance: Kopfzeile nicht anzeigen');
define('DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF_TITLE', 'Maintenance: Zeige die linke Spalte nicht');
define('DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF_TITLE', 'Wartung: Nicht die rechte Spalte anzeigen');
define('DOWN_FOR_MAINTENANCE_FOOTER_OFF_TITLE', 'Maintenance: Zeige den unteren Teil nicht');
define('DOWN_FOR_MAINTENANCE_PRICES_OFF_TITLE', 'Wartung: Preise nicht anzeigen');
define('EXCLUDE_ADMIN_IP_FOR_MAINTENANCE_TITLE', 'Maintenance: Eliminiere die angegebene IP-Adresse');
define('WARN_BEFORE_DOWN_FOR_MAINTENANCE_TITLE', 'Kunden vor der Abreise zur Wartung benachrichtigen');
define('PERIOD_BEFORE_DOWN_FOR_MAINTENANCE_TITLE', 'Benachrichtigungstext');
define('DISPLAY_MAINTENANCE_TIME_TITLE', 'Aktivierungsdatum für den Wartungsmodus anzeigen');
define('DISPLAY_MAINTENANCE_PERIOD_TITLE', 'Dauer des Wartungsmodus anzeigen');
define('TEXT_MAINTENANCE_PERIOD_TIME_TITLE', 'Servicezeit');

// Aktualisierung der Preisliste

define('DISPLAY_MODEL_TITLE', 'Produktcode anzeigen');
define('MODIFY_MODEL_TITLE', 'Produktcode anzeigen');
define('MODIFY_NAME_TITLE', 'Produktname anzeigen');
define('DISPLAY_STATUT_TITLE', 'Artikelstatus anzeigen');
define('DISPLAY_WEIGHT_TITLE', 'Zeige das Gewicht der Waren');
define('DISPLAY_QUANTITY_TITLE', 'Menge der Waren anzeigen');
define('DISPLAY_SORT_ORDER_TITLE', 'Sortierreihenfolge anzeigen');
define('DISPLAY_ORDER_MIN_TITLE', 'Minimum für Auftrag anzeigen');
define('DISPLAY_ORDER_UNITS_TITLE', 'Schritt anzeigen');
define('DISPLAY_IMAGE_TITLE', 'Produktbild anzeigen');
define('DISPLAY_MANUFACTURER_TITLE', 'Hersteller anzeigen');
define('MODIFY_MANUFACTURER_TITLE', 'Zeige Produzenten');
define('DISPLAY_TAX_TITLE', 'Steuern anzeigen');
define('MODIFY_TAX_TITLE', 'Show tax');
define('DISPLAY_TVA_OVER_TITLE', 'Preise anzeigen mit Steuern');
define('DISPLAY_TVA_UP_TITLE', 'Preise bei Preiserhöhungen anzeigen');
define('DISPLAY_PREVIEW_TITLE', 'Link zur Produktbeschreibung anzeigen');
define('DISPLAY_EDIT_TITLE', 'Verweis anzeigen, um die Waren zu bearbeiten');
define('ACTIVATE_COMMERCIAL_MARGIN_TITLE', 'Möglichkeit von Massenpreisänderungen anzeigen');

// Zurückgestellte Waren

define('MAX_DISPLAY_WISHLIST_PRODUCTS_TITLE', 'Die Anzahl der ausstehenden Einträge auf der Seite');
define('MAX_DISPLAY_WISHLIST_BOX_TITLE', 'Anzahl der ausstehenden Artikel in der Box');
define('DISPLAY_WISHLIST_EMAILS_TITLE', 'Anzahl der E-Mail-Adressen');
define('WISHLIST_REDIRECT_TITLE', 'Auf der Produktseite bleiben');

// Seitencache

define('ENABLE_PAGE_CACHE_TITLE', 'Seitencache erlauben');
define('PAGE_CACHE_LIFETIME_TITLE', 'Lebensdauer des Cache');
define('PAGE_CACHE_DEBUG_MODE_TITLE', 'Debug-Modus aktivieren?');
define('PAGE_CACHE_DISABLE_PARAMETERS_TITLE', 'URL-Parameter deaktivieren?');
define('PAGE_CACHE_DELETE_FILES_TITLE', 'Cachedateien löschen?');
define('PAGE_CACHE_UPDATE_CONFIG_FILES_TITLE', 'Datei-Cache-Update konfigurieren?');

// Yandex-Markt

define('YML_NAME_TITLE', 'Speichername');
define('YML_COMPANY_TITLE', 'Firmenname');
define('YML_DELIVERYINCLUDED_TITLE', 'Lieferung eingeschlossen');
define('YML_AVAILABLE_TITLE', 'Produkt auf Lager');
define('YML_AUTH_USER_TITLE', 'Login');
define('YML_AUTH_PW_TITLE', 'Passwort');
define('YML_REFERER_TITLE', 'Link');
define('YML_STRIP_TAGS_TITLE', 'Tags');
define('YML_UTF8_TITLE', 'Transcoding to UTF-8');

// Beschreibung der Felder

// Mein Geschäft

define('DEFAULT_TEMPLATE_DESC', 'Hier können Sie die vom Standardspeicher verwendete Vorlage angeben.');
define('STORE_NAME_DESC', 'Der Name Ihres Geschäftes');
define('STORE_OWNER_DESC', 'Eigentümername speichern');
define('STORE_LOGO_DESC', 'Geben Sie das Logo Ihres Geschäfts an');
define('STORE_OWNER_EMAIL_ADDRESS_DESC', 'E-Mail-Adresse des Geschäftsinhabers');
define('STORE_OWNER_ICQ_NUMBER_DESC', 'ICQ-Nummer, die im Geschäft des Beraters im Geschäft angezeigt werden soll.');
define('EMAIL_FROM_DESC', 'E-Mail-Adresse in gesendeten Briefen');
define('STORE_COUNTRY_DESC', 'Land nahodeniya store.<br><br><b>Hinweis: Achten Sie darauf, auch die Zoneangeben.</b>');
define('STORE_ZONE_DESC', 'Region Adresse Store');
define('EXPECTED_PRODUCTS_SORT_DESC', 'Geben Sie die Sortierreihenfolge für die vorgestellten Produkte, aufsteigend - asc oder desc - abw.');
define('EXPECTED_PRODUCTS_FIELD_DESC', 'Für welchen Wert wird sortiert erwarteten Produkte werden.');
define('USE_DEFAULT_LANGUAGE_CURRENCY_DESC', 'Automatische Schaltpreise im Laden auf der Währung der aktuellen Sprache.');
define('SEND_EXTRA_ORDER_EMAILS_TO_DESC', 'Wenn Sie Nachrichten mit Aufträgen erhalten möchten, dass gleichen Buchstaben, die den Kunden nach der Bestellung erhält, geben Sie Ihre E-Mail-Adresse Kopien der Briefe in folgendem Format zu erhalten: Name 1 &lt;E-Mail@address1&gt;, Name 2 &lt;E-Mail@address2&gt;');
define('SEARCH_ENGINE_FRIENDLY_URLS_DESC', 'Mit den kurzen URL-Adressen in dem Speicher');
define('DISPLAY_CART_DESC', 'Anzeigen Warenkorb nach einen Artikel in den Warenkorb legen können oder auf der gleichen Seite bleiben.');
define('ALLOW_GUEST_TO_TELL_A_FRIEND_DESC', 'können die Gäste die Shop-Funktionen an einen Freund verwenden, wenn nicht, dann kann diese Funktion nur registrierte Shop-Benutzer verwendet werden.');
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_DESC', 'auswählen, welcher Operator standardmäßig bei der Durchführung des Besuchers verwendet wird in dem Laden zu suchen.');
define('STORE_NAME_ADDRESS_DESC', 'Hier können Sie eine Adresse und Telefonspeicher eingeben');
define('SHOW_COUNTS_DESC', 'Zeige Anzahl Produkte in jeder Kategorie. mit einer großen Anzahl von Waren in den Laden empfohlen, den Zähler zu deaktivieren - false ist, die Last auf dem MySQL-Server zu reduzieren, erhöht sich die Download-Geschwindigkeit der meisten Ihrer Store-Seiten.');
define('ALLOW_CATEGORY_DESCRIPTIONS_DESC', 'Allow neben Beschreibungen Kategorien.');
define('TAX_DECIMAL_PLACES_DESC', 'Anzahl der ganzen Dezimalzahl in Steuern.');
define('SHOW_MAIN_FEATURED_PRODUCTS_DESC', 'true - zeigt<br>false - nicht anzeigen');
define('DISPLAY_PRICE_WITH_TAX_DESC', 'Zeige die Preise im Laden mit Steuern(true) oder die Steuer zeigen nur die letzte Stufe der Bestellung(false)');

define('XPRICES_NUM_DESC', 'Hier können Sie festlegen, wie viel die Preise jedes Element haben kann beispielsweise<br><br>, können Sie Gruppe Kunden von Konsumenten einen Preis von Waren zeigen, Einkäufer aus der Gruppe der Großhändler - zeigen eine andere.');
define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_DESC', 'Wenn Sie nicht über einen Gutschein senden für registrierte Kunden im Laden wollen, geben Sie 0 ein Zertifikat Kunden registriert zu senden, zum Beispiel im Wert von $10 - Geben Sie 10, wenn $25,5-25,5 Punkt usw.');
define('ALLOW_GUEST_TO_SEE_PRICES_DESC', 'Wenn auf false gesetzt, sind die Preise im Laden sichtbar nur für registrierte Besucher, wenn sie wahr ist - alle Besucher die Preise im Laden sehen kann.');
define('NEW_SIGNUP_DISCOUNT_COUPON_DESC', 'Wenn Sie die Besucher einen Gutschein nicht geben wollen, übergeben Registrierung, lassen Sie das Feld leer oder geben Sie besteht der Gutschein-Code, den Sie alle registrierten Kunden geben wollen.');
define('GUEST_DISCOUNT_DESC', 'Nachzahlung für die gewöhnlichen Besucher in den Laden. Für diese Option im Shop registriert ist nicht gültig Besucher. Include-Marge in Prozent. Zum Beispiel 10 angeben, bedeutet dies, dass alle Preise im Laden für die normalen Besucher um 10% höher sind als für registrierte Besucher.');
define('CATEGORIES_SORT_ORDER_DESC', '<b>Mögliche Werte:<br>products_name<br>products_name-desc<br>Modell<br>Modell-desc</b>');
define('QUICKSEARCH_IN_DESCRIPTION_DESC', 'Suche nach Artikeln eines Schnellsuchfeld verwenden, können Sie festlegen, wie Objekte nach Namen nur suchen - FALSE oder die Titel + Beschreibungen suchen - TRUE');
define('CONTACT_US_LIST_DESC', 'Sie verschiedene Empfänger auf der Seite angeben können, bitte kontaktieren Aufnahmeformat:. Name 1 &lt;E-Mail@address1&gt;, Name 2 &lt;E-Mail@address2&gt;. Wenn Sie nur einen einzigen Empfänger-E-Mails verlassen wollen, lassen Sie einfach Feld ist leer.');
define('ALLOW_GIFT_VOUCHERS_DESC', 'können Sie aktivieren - wahr oder aus - false die Verwendung von Gutscheinen und Promo codes an der Kasse.');
define('ALLOW_ATTRIBUTES_IN_PRODUCT_EDIT_PAGE_DESC', 'Sie aktivieren können - wahr oder ausschalten - falsee Attribute Opportunity-Management-Produkte direkt hinzufügen/bearbeiten Produkte Seite.');
define('SHOW_SUBCATEGORIES_WHEN_CATEGORIES_HAS_PRODUCTS_DESC', 'Wenn die Kategorie ist eine Ware, und in dieser Kategorie gibt es Unterkategorien, die Standardeinstellung (true), eine solche Kategorie gehen in, finden Sie eine Liste der Unterkategorien und eine Liste von Warengruppen sehen. Sie auch diese Unterkategorien deaktivieren können für diese false gesetzt.');
define('SHOW_PDF_DATASHEET_DESC', 'Show (true) oder nicht (false) PDF Produktbeschreibung auf der Artikelbeschreibung Seite.');

// Minimale Werte

define('ENTRY_FIRST_NAME_MIN_LENGTH_DESC', 'Mindestanzahl an Zeichen für das Feld Name');
define('ENTRY_LAST_NAME_MIN_LENGTH_DESC', 'Mindestanzahl von Zeichen für das Feld Nachname');
define('ENTRY_DOB_MIN_LENGTH_DESC', 'Mindestanzahl von Zeichen für das Geburtsdatum');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_DESC', 'Mindestanzahl von Symbolen Feld E-Mail-Adresse');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_DESC', 'Minimale Anzahl von Zeichen im Adressfeld');
define('ENTRY_COMPANY_MIN_LENGTH_DESC', 'Mindestanzahl von Zeichen im Feld Firma');
define('ENTRY_POSTCODE_MIN_LENGTH_DESC', 'Mindestanzahl von Zeichen im Postleitzahlfeld');
define('ENTRY_CITY_MIN_LENGTH_DESC', 'Mindestanzahl von Zeichen im Feld Stadt');
define('ENTRY_STATE_MIN_LENGTH_DESC', 'Mindestanzahl von Zeichen in der Region');
define('ENTRY_TELEPHONE_MIN_LENGTH_DESC', 'Mindestanzahl von Zeichen im Telefonfeld');
define('ENTRY_PASSWORD_MIN_LENGTH_DESC', 'Mindestanzahl von Zeichen im Feld Passwort');
define('CC_OWNER_MIN_LENGTH_DESC', 'Mindestanzahl von Zeichen für das Kreditkarteninhaberfeld');
define('CC_NUMBER_MIN_LENGTH_DESC', 'Mindestanzahl von Zeichen für das Kreditkartennummernfeld');
define('REVIEW_TEXT_MIN_LENGTH_DESC', 'Mindestanzahl an abzurufenden Zeichen');
define('MIN_DISPLAY_BESTSELLERS_DESC', 'Die Mindestmenge des im Leadership-Block angezeigten Produkts');
define('MIN_DISPLAY_ALSO_PURCHASED_DESC', 'Minimale Warenmenge in der Box Auch bestellt');
define('MIN_DISPLAY_XSELL_DESC', 'Minimale Anzahl von Artikeln, die im Feld Verwandte Artikel angezeigt werden');
define('MIN_ORDER_DESC', 'Wenn Ihre Auftragsmenge als dies weniger ist, eine solche Ordnung nicht formalisiert werden kann. Zahl angeben, ohne Währung($ simolov, reiben etc.). Setzen Sie 0, wenn Sie nicht den Mindestbetrag der Bestellung beschränken wollen.');

// Höchstwerte

define('MAX_PROD_ADMIN_SIDE_DESC', 'Die Menge der Waren auf einer Seite in der Admin-Seite');

define('MAX_ADDRESS_BOOK_ENTRIES_DESC', 'Die maximale Anzahl von Datensätzen, die ein Käufer in seinem Adressbuch machen kann');
define('MAX_DISPLAY_SEARCH_RESULTS_DESC', 'Anzahl der auf einer Seite angezeigten Produkte');
define('MAX_DISPLAY_PAGE_LINKS_DESC', 'Anzahl der Links zu anderen Seiten');
define('MAX_DISPLAY_SPECIAL_PRODUCTS_DESC', 'Die maximale Menge des auf der Seite "Rabatte" angezeigten Produkts');
define('MAX_DISPLAY_NEW_PRODUCTS_DESC', 'Maximale Warenmenge, die im Feld der Neuheit angezeigt wird');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_DESC', 'Maximale Warenmenge, die im Erwarteten Warenblock angezeigt wird');
define('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST_DESC', 'Mit dieser Option können die Box Hersteller anzupassen, wenn die Zahl der Hersteller, dass in dieser Option angegeben überschreitet, wird die Liste der Hersteller in einer Dropdown-Liste angezeigt werden, wenn die Zahl der Erzeuger weniger als in dieser Option angegeben, werden die Hersteller in einer Liste angezeigt werden.');
define('MAX_MANUFACTURERS_LIST_DESC', 'Mit dieser Option können die Box-Hersteller anpassen, wenn Ziffer \'1 \' enthält, wird die Liste der Hersteller als Standard-Dropdown-Liste angezeigt. Wenn Sie eine andere Zahl angeben, die nur in der Form X Hersteller Ausgabe von Full-Scale Menü.');
define('MAX_DISPLAY_MANUFACTURER_NAME_LEN_DESC', 'Mit dieser Option können die Box-Hersteller anzupassen, geben Sie die Anzahl der Zeichen in dem Feld Hersteller angezeigt, wenn der Name des Herstellers von einer großen Anzahl von Zeichen, die ersten X Zeichen Namen werden angezeigt bestehen');
define('MAX_RANDOM_SELECT_NEW_DESC', 'die Zahl der Waren, unter denen ein zufällig ausgewähltes Element sein wird, und in einem Feld von neuen Produkten gelegt ist, dh wenn die spezifizierte Anzahl von X, das neue Produkt, das in den Kasten Neuheiten gezeigt ist, wird aus dieser neuen Produkte X ausgewählt werden') ;
define('MAX_RANDOM_SELECT_SPECIALS_DESC', 'die Zahl der Waren, unter denen ein zufällig ausgewähltes Element und in einem Kasten Angebote platziert wird, das heißt, wenn die angegebene Anzahl von X, dann ist ein Produkt, das in Box Rabatten wird aus der X Waren gewählt werden');
define('MAX_DISPLAY_CATEGORIES_PER_ROW_DESC', 'Wie viele Kategorien werden in einer Zeile angezeigt');
define('MAX_DISPLAY_PRODUCTS_NEW_DESC', 'Die maximale Anzahl von neuen Produkten, die auf der gleichen Seite erscheinen, in der Was ist neu?');
define('MAX_DISPLAY_BESTSELLERS_DESC', 'Maximale Anzahl von Verkaufsführern, die in der Führungsbox angezeigt werden');
define('MAX_DISPLAY_ALSO_PURCHASED_DESC', 'Maximale Warenmenge in der Box Unsere Kunden haben auch bestellt');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_DESC', 'Maximale Anzahl der Elemente in einem Feld Bestellverlauf angezeigt');
define('MAX_DISPLAY_ORDER_HISTORY_DESC', 'Maximale Anzahl von Aufträgen, die auf der Seite Bestellhistorie angezeigt werden');
define('MAX_DISPLAY_FEATURED_PRODUCTS_DESC', 'Die maximale Menge an Waren in Feld Highlights auf der Startseite');
define('MAX_DISPLAY_FEATURED_PRODUCTS_LISTING_DESC', 'Anzahl der Elemente auf einer einzigen Seite vorgestellten Produkte');

// Bilder

define('SMALL_IMAGE_WIDTH_DESC', 'Die Breite des Bildes in Pixeln freilassen oder 0 setzen, wenn Sie nicht über die Breite des Bildes von begrenzten Breite Bildern begrenzen wollen, bedeuten nicht, die physische Größe des Bildes zu reduzieren..');
define('SMALL_IMAGE_HEIGHT_DESC', 'Die Höhe des Bildes in Pixeln freilassen oder 0 setzen, wenn Sie nicht über die Höhe der Bild Restriction Bildhöhe begrenzen wollen, bedeuten nicht, die physische Größe des Bildes zu reduzieren..');
define('HEADING_IMAGE_WIDTH_DESC', 'Die Breite des Bildes in Pixeln freilassen oder 0 setzen, wenn Sie nicht über die Breite des Bildes von begrenzten Breite Bildern begrenzen wollen, bedeuten nicht, die physische Größe des Bildes zu reduzieren..');
define('HEADING_IMAGE_HEIGHT_DESC', 'Die Höhe des Bildes in Pixeln freilassen oder 0 setzen, wenn Sie nicht über die Höhe der Bild Restriction Bildhöhe begrenzen wollen, bedeuten nicht, die physische Größe des Bildes zu reduzieren..');
define('SUBCATEGORY_IMAGE_WIDTH_DESC', 'Die Breite des Bildes in Pixeln freilassen oder 0 setzen, wenn Sie nicht über die Breite des Bildes von begrenzten Breite Bildern begrenzen wollen, bedeuten nicht, die physische Größe des Bildes zu reduzieren..');
define('SUBCATEGORY_IMAGE_HEIGHT_DESC', 'Die Höhe des Bildes in Pixeln freilassen oder 0 setzen, wenn Sie nicht über die Höhe der Bild Restriction Bildhöhe begrenzen wollen, bedeuten nicht, die physische Größe des Bildes zu reduzieren..');
define('CONFIG_CALCULATE_IMAGE_SIZE_DESC', 'Diese Option sieht nur die oben aufgelisteten Variablen und komprimiert das Bild auf die Größe angegeben, es bedeutet nicht, dass die physikalische Größe des Bildes verringert wird, wird ein erzwungener es wird ein Bild einer bestimmten Größe empfohlen false den Wert einzustellen.');
define('IMAGE_REQUIRED_DESC', 'Es ist notwendig, um Fehler zu suchen, wenn das Bild nicht angezeigt wird.');
define('ULTIMATE_ADDITIONAL_IMAGES_DESC', 'Sie können das Modul zusätzlicher Bilder für das Produkt aktivieren/deaktivieren.');
define('ULT_THUMB_IMAGE_WIDTH_DESC', 'Die Breite des zusätzlichen Bildes in Pixeln. Freilassen oder auf 0 gesetzt, wenn Sie die Breite des Bildes von begrenzten Breite Bildern nicht einschränken wollen, bedeuten nicht, die physische Größe des Bildes zu reduzieren.');
define('ULT_THUMB_IMAGE_HEIGHT_DESC', 'Die Höhe des zusätzlichen Bildes in Pixeln. Freilassen oder 0 setzen, wenn Sie nicht über die Höhe der Bild Restriction Bildhöhe begrenzen wollen, bedeuten nicht, die physische Größe des Bildes zu reduzieren.');
define('MEDIUM_IMAGE_WIDTH_DESC', 'Die Breite des größten Bildes in Pixeln auf 0 freilassen oder einstellen, wenn Sie nicht über die Breite der großen Bilder von begrenzten Breite des großen Bildes beschränken wollen, bedeuten nicht, die physische Größe des Bildes zu reduzieren.');
define('MEDIUM_IMAGE_HEIGHT_DESC', 'Die Höhe des größten Bildes in Pixeln. Freilassen oder 0 setzen, wenn Sie die Höhe des großen Bildes nicht über die Höhe des großen Bildes begrenzen wollen Begrenzung bedeutet nicht die physische Größe des Bildes zu reduzieren.');
define('LARGE_IMAGE_WIDTH_DESC', 'Breite Bilder Pop-up-Fenster in Pixel. freilassen oder 0 setzen, wenn Sie nicht für das Pop-up-Fenster, um die Breite des Bildes begrenzen wollen. für das Pop-up-Fenster, um die Breite des Bildes Begrenzung bedeutet nicht die physische Reduktion der Bildgröße.');
define('LARGE_IMAGE_HEIGHT_DESC', 'Die Höhe des Bildes, um Pop-up-Fenster in Pixel. freilassen oder 0 setzen, wenn Sie Fenster, um Pop-up nicht über die Höhe der Bilder beschränken wollen. Begrenzen Sie die Höhe des Bildes für das Pop-up-Fenster, bedeutet nicht, die physische Reduktion der Bildgröße.');

// Daten des Käufers

define('ACCOUNT_GENDER_DESC', 'zeigt das Feld Sex mit Käufern Anmeldung im Laden und im Adressbuch');
define('ACCOUNT_DOB_DESC', 'Das Feld Geburtsdatum anzeigen bei der Registrierung des Käufers im Geschäft und im Adressbuch');
define('ACCOUNT_COMPANY_DESC', 'Zeige das Firmenfeld bei der Registrierung des Käufers im Geschäft und im Adressbuch');
define('ACCOUNT_SUBURB_DESC', 'Das Gebietsfeld anzeigen, wenn der Käufer im Geschäft und im Adressbuch registriert wird');
define('ACCOUNT_STATE_DESC', 'Das Feld Region anzeigen bei der Registrierung des Käufers im Geschäft und im Adressbuch');
define('ACCOUNT_STREET_ADDRESS_DESC', 'Zeige das Adressfeld bei der Registrierung des Käufers im Geschäft und im Adressbuch');
define('ACCOUNT_CITY_DESC', 'Zeige das Feld Stadt bei der Registrierung des Käufers im Geschäft und im Adressbuch');
define('ACCOUNT_POSTCODE_DESC', 'Postleitzahl anzeigen bei der Registrierung des Käufers im Geschäft und im Adressbuch');
define('ACCOUNT_COUNTRY_DESC', 'Das Feld Land anzeigen, wenn der Käufer im Geschäft und im Adressbuch registriert wird');
define('ACCOUNT_TELE_DESC', 'Zeige das Telefonfeld bei der Registrierung des Käufers im Geschäft und im Adressbuch');
define('ACCOUNT_FAX_DESC', 'Zeige das Faxfeld bei der Registrierung des Käufers im Geschäft und im Adressbuch');
define('ACCOUNT_NEWS_DESC', 'Zeige die Mailingliste bei der Registrierung des Käufers im Geschäft und im Adressbuch');
define('ACCOUNT_LAST_NAME_DESC', 'Feld Anzeigenamen, wenn der Käufer Registrierung im Laden und im Adressbuch');
// Versand/Verpackung

define('SHIPPING_ORIGIN_COUNTRY_DESC', 'Land, in dem sich das Geschäft befindet, erforderlich für einige Liefermodule.');
define('SHIPPING_ORIGIN_ZIP_DESC', 'Geben Sie die Postleitzahl des Geschäfts an. Erforderlich für einige Liefermodule.');
define('SHIPPING_MAX_WEIGHT_DESC', 'Sie haben die maximale Fördermenge Gewicht angeben, über welche Aufträge für einige. Versandmodule geliefert werden soll.');
define('SHIPPING_BOX_WEIGHT_DESC', 'Sie können das Gewicht des Pakets angeben.');
define('SHIPPING_BOX_PADDING_DESC', 'Versandgewicht größer als in dem variablen maximalen Fördergewicht angegeben wird durch den Prozentsatz erhöht Wenn Sie die Kosten um 10% zurückgenommen haben wollen, schreiben - 10.');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_DESC', 'Haben Sie die Verwendung des Moduls kostenfrei zulassen?');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_DESC', 'Aufträge, über die Menge des Feldes gegeben wird frei ausgeliefert.');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_DESC', 'national - Aufträge aus der Speicherstelle des Landes(Variable Country Store), international - Aufträge aus einem anderen Land als der Speicherort, wenn both - dann Sofern alle Bestellungen. Dass die Menge der Bestellung angegebene Menge überschreitet in Variable oben.');
define('SHOW_SHIPPING_ESTIMATOR_DESC', ' Zeigen Sie Informationen über die Methoden und die Kosten für die Lieferung in den Warenkorb?<br>true - Show.<br>false - nicht zeigen.');

// Warenausgang

define('PRODUCT_LISTING_DISPLAY_STYLE_DESC', 'Sie das Format, in dem können wählen, um Elemente in einer Tabelle anzeigen - list oder Spalte - columns.');
define('PRODUCT_LIST_IMAGE_DESC', 'Geben Sie die Ausgabereihenfolge, dh die Zahl eingeben. Wenn Sie 1 eingeben, wird das Bild in dem ersten Platz belassen werden, wenn 2, wird das Bild nach (rechts) Feld angezeigt, das die Zahl 1 enthält, und so weiter.d.');
define('PRODUCT_LIST_MANUFACTURER_DESC', 'Select Ausgabereihenfolge der Felder im Geschäft, das heißt, geben Sie eine Nummer. Wenn Wählen einer, dann wird dieses Feld in dem ersten Platz belassen werden, wenn 2, wird das Feld nach(rechts) dem Feld gezeigt wird, in was die Nummer 1 usw. angibt');
define('PRODUCT_LIST_MODEL_DESC', 'Select Ausgabereihenfolge der Felder im Geschäft, das heißt, geben Sie eine Nummer. Wenn Wählen einer, dann wird dieses Feld in dem ersten Platz belassen werden, wenn 2, wird das Feld nach (rechts) dem Feld gezeigt wird, in was die Nummer 1 usw. angibt');
define('PRODUCT_LIST_NAME_DESC', 'Select Ausgabereihenfolge der Felder im Geschäft, das heißt, geben Sie eine Nummer. Wenn Wählen einer, dann wird dieses Feld in dem ersten Platz belassen werden, wenn 2, wird das Feld nach(rechts) dem Feld gezeigt wird, in was die Nummer 1 usw. angibt');
define('PRODUCT_LIST_PRICE_DESC', 'Select Ausgabereihenfolge der Felder im Geschäft, das heißt, geben Sie eine Nummer. Wenn Wählen einer, dann wird dieses Feld in dem ersten Platz belassen werden, wenn 2, wird das Feld nach(rechts) dem Feld gezeigt wird, in was die Nummer 1 usw. angibt');
define('PRODUCT_LIST_QUANTITY_DESC', 'Select Ausgabereihenfolge der Felder im Geschäft, das heißt, geben Sie eine Nummer. Wenn Wählen einer, dann wird dieses Feld in dem ersten Platz belassen werden, wenn 2, wird das Feld nach(rechts) dem Feld gezeigt wird, in was die Nummer 1 usw. angibt');
define('PRODUCT_LIST_WEIGHT_DESC', 'Select Ausgabereihenfolge der Felder im Geschäft, das heißt, geben Sie eine Nummer. Wenn Wählen einer, dann wird dieses Feld in dem ersten Platz belassen werden, wenn 2, wird das Feld nach(rechts) dem Feld gezeigt wird, in was die Nummer 1 usw. angibt');
define('PRODUCT_LIST_BUY_NOW_DESC', 'Select Ausgabereihenfolge der Felder im Geschäft, das heißt, geben Sie eine Nummer. Wenn Wählen einer, dann wird dieses Feld in dem ersten Platz belassen werden, wenn 2, wird das Feld nach(rechts) dem Feld gezeigt wird, in was die Nummer 1 usw. angibt');
define('PRODUCT_LIST_FILTER_DESC', 'Display Feld(drop-down) Menü, mit dem Sie die Elemente in jeder Kategorie von den Herstellern Speicher sortieren.');
define('PREV_NEXT_BAR_LOCATION_DESC', 'Set Navigations Lage Weiter/Zurück(1-Top, 2-Bottom, 3-top+unten)');
define('PRODUCT_LIST_INFO_DESC', 'Wenn Sie 0 eingeben, dann eine kurze Beschreibung nicht angezeigt werden, wenn 1-99 - eine kurze Beschreibung angezeigt wird, aber nur, wenn Sie eine kurze Beschreibung wurde mit der Zugabe des Produkts hinzugefügt.');
define('PRODUCT_SORT_ORDER_DESC', 'Select Ausgabereihenfolge der Felder im Geschäft, das heißt, geben Sie eine Nummer. Wenn Wählen einer, dann wird dieses Feld in dem ersten Platz belassen werden, wenn 2, wird das Feld nach (rechts) dem Feld gezeigt wird, in welches die Nummer 1 usw. angibt. 0 - bedeutet, dass dieses Feld nicht angezeigt wird');

// Lager

define('STOCK_CHECK_DESC', 'Um zu prüfen, ob die notwendige Menge an Waren auf Lager, wenn Sie bestellen');
define('STOCK_LIMITED_DESC', 'subtrahiert aus dem Bestand des Wert der Waren, die in dem Online-Shop bestellt werden');
define('STOCK_ALLOW_CHECKOUT_DESC', 'Käufer können den Auftrag auszuführen, auch wenn die Aktie nicht genügend Einheiten bestellte Ware');
define('STOCK_DISABLE_NON_EXISTENT_PRODUCT_ON_CHECKOUT_DESC', 'Deaktivieren Sie Produkte mit der Menge 0 nach dem Kauf');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_DESC', 'Zeige Käufer Marker vor der Ware während des Bestellvorgangs, wenn die Lagereinheiten bestellte Ware ist nicht die erforderliche Anzahl von');
define('STOCK_REORDER_LEVEL_DESC', 'Wenn die Menge der Waren im Lager ist geringer als die festgelegte Anzahl an eine gegebene Variable, der Korb eine Warnung über eine unzureichende Menge von Waren auf Lager um den Auftrag zu erfüllen.');

// Logs

define('STORE_PAGE_PARSE_TIME_DESC', 'speichern die Zeit genommen, die(Parsing) Store Seiten zu erzeugen.');
define('STORE_PAGE_PARSE_TIME_LOG_DESC', 'Full Pfad zu dem Verzeichnis und Datei, auf die wir schreiben das Protokoll Parsen Seiten.');
define('STORE_PARSE_DATE_TIME_FORMAT_DESC', 'Datumsformat');
define('DISPLAY_PAGE_PARSE_TIME_DESC', 'Zeige Zeit, um die Seite des Online-Shop-Parsing(Option spart Zeit Parsen von Seiten aktiviert werden muss)');
define('STORE_DB_TRANSACTIONS_DESC', 'Speichern Sie alle Anfragen an die Datenbank in der in den variablen Speichern angegebene Datei protokolliert Verzeichnis(für PHP4 und oben)');

// Cache

define('USE_CACHE_DESC', 'Informationscaching verwenden.');
define('DIR_FS_CACHE_DESC', 'Verzeichnis, in das Cache-Dateien geschrieben und gespeichert werden.');

// E-Mail konfigurieren

define('EMAIL_TRANSPORT_DESC', 'Geben Sie einen Weg, E-Mails aus dem Speicher senden verwendet werden, können Sie SMTP für das Senden von Mail an Server unter Windows oder MacOS-Steuerelement installieren müssen.');
define('EMAIL_LINEFEED_DESC', 'Die Zeichenfolge, die zum Trennen der Kopfzeilen in einem Buchstaben verwendet wird.');
define('EMAIL_USE_HTML_DESC', 'Briefe aus dem Geschäft im HTML-Format senden.');
define('ENTRY_EMAIL_ADDRESS_CHECK_DESC', 'Prüfen, ob korrekte E-Mail-Adresse des DNS zu überprüfen, während des Registrierungsprozesses Online-Shop verwendet angegeben wird.');
define('SEND_EMAILS_DESC', 'Briefe aus dem Geschäft senden.');

// Herunterladen

define('DOWNLOAD_ENABLED_DESC', 'Download-Funktion zulassen');
define('DOWNLOAD_BY_REDIRECT_DESC', 'Verwenden Sie den Browser umleiten das Produkt zum Download für nicht Unix-Systemen(Windows, Mac OS, etc.) false sein müssen..');
define('DOWNLOAD_MAX_DAYS_DESC', 'Die Anzahl der Tage, an denen der Käufer Ihr Produkt herunterladen kann Falls 0 angeben, dann wird die Zeit der Existenz von Links zu dem Download nicht beschränkt.');
define('DOWNLOAD_MAX_COUNT_DESC', 'Wenn 0 die maximale Anzahl von Downloads für ein einzelnes Produkt Set, dann wird keine Beschränkung für die Anzahl der Downloads nicht.');
define('DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE_DESC', 'Was ist der Status der Auftrags-ID-Nummer ist setzt Variablen Laufzeit der Download-Links(Tage) und die maximalen Anzahl von Downloads - Standard-Lieferung (ID-Code 4).');
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG_DESC', 'Sie eine Nachricht angeben, die an den Kunden angezeigt wird, wenn er mehr unbezahlte Waren herunterladen will.');
define('DOWNLOADS_CONTROLLER_ORDERS_STATUS_DESC', 'Datei-Download(Dateien) werden nur dann zulässig, wenn der Auftrag den angegebenen Status(dh ID-Code Auftragsstatus hat). In der Standardeinstellung für die Zahlung des Wartens auf Aufträge mit dem Status erlaubt downloading (ID-Code 2).');

// GZip-Komprimierung

define('GZIP_COMPRESSION_DESC', 'HTTP GZip-Komprimierung zulassen');
define('GZIP_LEVEL_DESC', 'Sie die Komprimierungsstufe von 0 bis 9 angeben(0 = niedrig, 9 = hoch).');

// Sitzungen

define('SESSION_WRITE_DIRECTORY_DESC', 'Wenn die Sitzung in Dateien gespeichert sind, besteht ein Bedarf den vollständigen Pfad zu dem Ordner angeben, in Session-Dateien gespeichert werden sollen.');
define('SESSION_FORCE_COOKIE_USE_DESC', 'Erzwingen einer Sitzung nur dann, wenn in den Browser-Cookies aktiviert.');
define('SESSION_CHECK_SSL_SESSION_ID_DESC', 'Check SSL_SESSION_ID jedesmal, wenn die Seite durch HTTPS geschützt.');
define('SESSION_CHECK_USER_AGENT_DESC', 'überprüfen variable brazura User-Agenten für jeden Zugriff auf den Seiten der Online-Shops.');
define('SESSION_CHECK_IP_ADDRESS_DESC', 'überprüfen Sie für jeden Zugriff des IP-Adresse des Clients auf den Seiten der Online-Shops.');
define('SESSION_BLOCK_SPIDERS_DESC', 'nicht zeigen in der Session-Adresse, wenn der Speicher Stanizas Zugriff befindet sich bekannten Suchmaschinen Liste der bekannten Spinnen in includes/spiders.txt Datei.');
define('SESSION_RECREATE_DESC', 'Erstellen Sie die Sitzung einen neuen Sitzungs-ID-Code zu generieren, wenn registrierten Kunden den Laden betreten oder wenn Sie einen neuen Käufer(nur PHP 4.1 oder höher) zu registrieren.');

// Tech. Wartung

define('DOWN_FOR_MAINTENANCE_DESC', 'Wartung Wenn aktiviert, wird der Speicher nicht in der Lage sein, Aufträge zu erteilen und zeigt eine Warnung an dem Wartungsgeschäft<br>true - aktiviert<br>false - Aus..');
define('DOWN_FOR_MAINTENANCE_FILENAME_DESC', 'Datei, die im Speicher angezeigt werden, wenn der Speicher technischen Service Standard inklusive - down_for_maintenance.php.');
define('DOWN_FOR_MAINTENANCE_HEADER_OFF_DESC', 'Wenn bei der Wartung verwendet, können Sie deaktivieren Hutladen<br>wahr zeigt - nicht zeigen<Br>false - Show');
define('DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF_DESC', 'Wenn bei der Wartung verwendet, können Sie deaktivieren die linke Spalte speichern<br>wahr zeigt - nicht zeigen<Br>false - Show');
define('DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF_DESC', 'Wenn bei der Wartung verwendet, können Sie die rechte Spalte des Ladens zeigt deaktivieren<br>true - nicht zeigen<Br>false - Show');
define('DOWN_FOR_MAINTENANCE_FOOTER_OFF_DESC', 'Wenn bei der Wartung verwendet, Sie deaktivieren den unteren Teil des Speichers<br>wahr zeigt - nicht zeigen<Br>false - Show');
define('DOWN_FOR_MAINTENANCE_PRICES_OFF_DESC', 'Wenn bei der Wartung verwendet, können Sie den Preis der Waren in dem Laden<br>wahr zeigen deaktivieren - nicht zeigen<Br>false - Show');
define('EXCLUDE_ADMIN_IP_FOR_MAINTENANCE_DESC', 'Die angegebene IP-Adresse des Shops auch verfügbar sein wird, wenn Normalerweise hier Modus Wartung eingeschaltet gibt die IP-Adresse des Speicher-Administrator..');
define('WARN_BEFORE_DOWN_FOR_MAINTENANCE_DESC', 'Benutzer warnt vor der Wartung gehen, wenn die Wartung bereits enthalten ist, wird diese Option automatisch auf false gesetzt..');
define('PERIOD_BEFORE_DOWN_FOR_MAINTENANCE_DESC', 'Geben Sie den Benachrichtigungstext an.');
define('DISPLAY_MAINTENANCE_TIME_DESC', 'Aktivierungsdatum des Wartungsmodus anzeigen.');
define('DISPLAY_MAINTENANCE_PERIOD_DESC', 'Zeigt an, wie lange sich der Store im Wartungsmodus befindet.');
define('TEXT_MAINTENANCE_PERIOD_TIME_DESC', 'Zeit des Geschäftsvorgangs im Wartungsmodus angeben');

// Aktualisierung der Preisliste

define('DISPLAY_MODEL_DESC', 'Show/Produktcode nicht anzeigen');
define('MODIFY_MODEL_DESC', 'Show/Produktcode nicht anzeigen');
define('MODIFY_NAME_DESC', 'Show/Produktname nicht anzeigen');
define('DISPLAY_STATUT_DESC', 'Show/Produktstatus nicht anzeigen');
define('DISPLAY_WEIGHT_DESC', 'Zeige/zeige nicht das Gewicht der Waren');
define('DISPLAY_QUANTITY_DESC', 'Warenmenge anzeigen/nicht anzeigen');
define('DISPLAY_SORT_ORDER_DESC', 'Show/Sortierung nicht anzeigen');
define('DISPLAY_ORDER_MIN_DESC', 'Zeige/zeige kein Minimum für den Auftrag');
define('DISPLAY_ORDER_UNITS_DESC', 'Zeige/zeige keinen Schritt');
define('DISPLAY_IMAGE_DESC', 'Zeige/zeige nicht das Bild der Waren');
define('MODIFY_MANUFACTURER_DESC', 'Zeige/zeige den Hersteller der Ware nicht');
define('MODIFY_TAX_DESC', 'Zeigen/Keine Steuern anzeigen');
define('DISPLAY_TVA_OVER_DESC', 'Show/Preise nicht mit Steuern anzeigen');
define('DISPLAY_TVA_UP_DESC', 'Show/Preise nicht anzeigen mit Steuern bei Preisänderungen');
define('DISPLAY_PREVIEW_DESC', 'Zeige/Zeige keinen Link zur Produktbeschreibung');
define('DISPLAY_EDIT_DESC', 'Show/Link nicht anzeigen, um die Waren zu bearbeiten');
define('DISPLAY_MANUFACTURER_DESC', 'Zeige/zeige keinen Hersteller');
define('DISPLAY_TAX_DESC', 'Zeigen/Keine Steuern anzeigen');
define('ACTIVATE_COMMERCIAL_MARGIN_DESC', 'Zeige/Zeige die Möglichkeit von Massenpreisänderungen');

// Seitencache

define('ENABLE_PAGE_CACHE_DESC', 'Seitencache zulassen? Diese Funktion hilft, die Belastung des Servers zu reduzieren und das Laden von Seiten zu beschleunigen.');
define('PAGE_CACHE_LIFETIME_DESC', 'Wie lange cache ich Seiten (in Minuten)?');
define('PAGE_CACHE_DEBUG_MODE_DESC', 'Debug-Modus aktiviert (unten auf der Seite)? Aktivieren Sie diese Option nicht in den Werkstätten! Sie die Debug-Modus durch einfaches Hinzufügen eines URL-Adresse Parameter ?debug=1');
define('PAGE_CACHE_DISABLE_PARAMETERS_DESC', 'In einigen Fällen (beispielsweise, wenn ein Kurzadresse enthalten) oder wenn eine große Anzahl von Partnern zu übermäßigem Gebrauch von Speicherplatz führen kann.');
define('PAGE_CACHE_DELETE_FILES_DESC', 'gesetzt Wenn true, dann für jedes nächste Mal, wenn Sie eine beliebige Seite im Katalog zu sehen, alle Cache-Dateien gelöscht werden, dann false zurück.');
define('PAGE_CACHE_UPDATE_CONFIG_FILES_DESC', 'Wenn Sie eine Modul configuration cache haben, geben Sie den vollständigen (absoluten) Pfad zur Update-Datei.');

// Yandex-Markt

define('YML_NAME_DESC', 'Name des Shops für Yandex Market.Wenn das Feld leer ist, wird STORE_NAME verwendet.');
define('YML_COMPANY_DESC', 'Firmenname für Yandex-Market.Wenn das Feld leer ist, wird STORE_OWNER verwendet.');
define('YML_DELIVERYINCLUDED_DESC', 'Versand ist im Preis des Artikels enthalten?');
define('YML_AVAILABLE_DESC', 'Artikel verfügbar oder bei Bestellung?');
define('YML_AUTH_USER_DESC', 'Login für den Zugriff auf YML');
define('YML_AUTH_PW_DESC', 'Passwort für den Zugriff auf YML');
define('YML_REFERER_DESC', 'Einen Parameter mit einem Link zum User-Agent oder ip hinzufügen?');
define('YML_STRIP_TAGS_DESC', 'HTML-Tags in Strings ausblenden?');
define('YML_UTF8_DESC', 'Recode to UTF-8?');

define('GOOGLE_OAUTH_STATUS_TITLE', 'Enable Google Authorization');
define('GOOGLE_OAUTH_CLIENT_ID_TITLE', 'Google CLIENT ID');
define('GOOGLE_OAUTH_CLIENT_SECRET_TITLE', 'Google CLIENT SECRET');
define('GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED_TITLE', 'Aktivieren Sie das Google Analytics');
define('GOOGLE_TAGS_ID_TITLE', 'Google Tag ID (gtag.js) for Google Analytics');
define('GOOGLE_TAG_MANAGER_ID_TITLE', 'Google Tag Manager ID');
define('GOOGLE_TAGS_ID_STATUS_TITLE', 'Google Tags ID status');

define('GOOGLE_GOALS_PAGE_VIEW_TITLE', 'Ziel ist \'page_view\', jede Seite anzuzeigen');
define('GOOGLE_GOALS_ADD_TO_CART_TITLE', 'Ziel \'add_to_cart\' ist, wenn ein Kunde einen Artikel in den Warenkorb legt');
define('GOOGLE_GOALS_ON_CHECKOUT_TITLE', 'Ziel ist \'checkout_view\', um die Checkout-Seite anzuzeigen');
define('GOOGLE_GOALS_CHECKOUT_PROCESS_TITLE', 'Target \'checkout_progress\' - der Kunde hat erfolgreich eine Bestellung aufgegeben');
define('GOOGLE_GOALS_CHECKOUT_SUCCESS_TITLE', 'Das Ziel von \'checkout_success\' ist es, die Seite nach der Bestellbestätigung anzuzeigen');
define('GOOGLE_GOALS_CLICK_FAST_BUY_TITLE', 'Target \'fast_buy\' - wenn ein Kunde auf der Produktseite auf die Schaltfläche "Schnellbestellung" klickt');
define('GOOGLE_GOALS_LOGIN_TITLE', 'Ziel \'login\' ist, wenn der Client angemeldet ist');
define('GOOGLE_GOALS_ADD_REVIEW_TITLE', 'Ziel \'add_review\' ist, wenn ein Kunde eine Rezension hinzugefügt hat');
define('GOOGLE_GOALS_FILTER_TITLE', 'Das Ziel von \'Filter\' ist, wenn ein Kunde einen Filter verwendet, um nach Produkten zu suchen');
define('GOOGLE_GOALS_CALLBACK_TITLE', 'Ziel auf \'Rückruf\' - wenn der Client auf die Schaltfläche \'Rückruf\' in der Kopfzeile der Website klickt');
define('GOOGLE_GOALS_CLICK_ON_PHONE_TITLE', 'Ziel \'Telefonanruf\' ist, wenn der Client auf das Telefonsymbol klickt');
define('GOOGLE_GOALS_CLICK_ON_CHAT_TITLE', 'Ziel \'click_chat\' ist, wenn der Kunde auf den Chat klickt');
define('GOOGLE_GOALS_CONTACT_US_TITLE', 'Target \'contact_us\' - wenn der Kunde eine Anfrage auf der Kontaktseite gestellt hat');
define('GOOGLE_GOALS_SUBSCRIBE_TITLE', 'Target \'subscribe\' - wenn der Client abonniert hat');
define('GOOGLE_GOALS_CLICK_ON_BUG_REPORT_TITLE', 'Das Ziel von \'bug_report\' ist, wenn der Client in der Fußzeile der Website auf \'Fehlerbericht senden\' klickt');

define('GOOGLE_ECOMM_SUCCESS_PAGE_TITLE', 'E-Commerce-Kauf \'Kauf\' - Seitenaufruf nach Bestellbestätigung');
define('GOOGLE_ECOMM_CHECKOUT_PAGE_TITLE', 'E-Commerce-Ziel \'Warenkorb\' - Checkout-Seite');
define('GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE_TITLE', 'Das E-Commerce-Ziel \'Produkt\' ist das Anzeigen der Produktseite');
define('GOOGLE_ECOMM_SEARCH_RESULTS_TITLE', 'E-Commerce-Ziel \'Suchergebnisse\' - Suchergebnisseite anzeigen');
define('GOOGLE_ECOMM_HOME_PAGE_TITLE', 'E-Commerce-Ziel \'Home\' ist das Anzeigen der Produktseite');
define('GOOGLE_ECOMM_CLICK_FAST_BUY_TITLE', 'Ecommerce Goal \'Purchase\' - when customer accept \'Quick order\' on product page');

define('DEFAULT_CAPTCHA_STATUS_TITLE', 'Captcha');
define('GOOGLE_RECAPTCHA_STATUS_TITLE', 'Google Recaptcha Status');
define('GOOGLE_RECAPTCHA_PUBLIC_KEY_TITLE', 'Google Recaptcha PUBLIC KEY');
define('GOOGLE_RECAPTCHA_SECRET_KEY_TITLE', 'Google Recaptcha SECRET KEY');

define('FACEBOOK_AUTH_STATUS_TITLE', 'Facebook Genehmigung');

define ('RCS_BASE_DAYS_TITLE', 'Tage zurückblicken');
define ('RCS_SKIP_DAYS_TITLE', 'Tage überspringen');
define ('RCS_REPORT_DAYS_TITLE', 'Berechnete Steuern verwenden');
define ('RCS_INCLUDE_TAX_IN_PRICES_TITLE', 'Festen Steuersatz verwenden');
define ('RCS_USE_FIXED_TAX_IN_PRICES_TITLE', 'Fester Steuersatz');
define ('RCS_FIXED_TAX_RATE_TITLE', 'Tage des Verkaufsergebnisberichts');
define ('RCS_EMAIL_TTL_TITLE', 'E-Mail time to live');
define ('RCS_EMAIL_FRIENDLY_TITLE', 'Freundliche E-Mails');
define ('RCS_EMAIL_COPIES_TO_TITLE', 'E-Mail Kopien an');
define ('RCS_SHOW_ATTRIBUTES_TITLE', 'Attribute anzeigen');
define ('RCS_CHECK_SESSIONS_TITLE', 'Kunden mit Sessions ignorieren');
define ('RCS_CURCUST_COLOR_TITLE', 'Aktueller Kunde');
define ('RCS_UNCONTACTED_COLOR_TITLE', 'Unkontaktiertes Hilight');
define ('RCS_CONTACTED_COLOR_TITLE', "Contacted Hilight");
define ('RCS_MATCHED_ORDER_COLOR_TITLE', "Matching Order Hilight");
define ('RCS_SKIP_MATCHED_CARTS_TITLE', 'Einträge mit übereinstimmenden Aufträgen überspringen');
define ("RCS_AUTO_CHECK_TITLE", 'Autocheck \ "safe \" carts to email');
define ('RCS_CARTS_MATCH_ALL_DATES_TITLE', 'Aufträge von jedem Datum abgleichen');
define ('RCS_PENDING_SALE_STATUS_TITLE', 'Ausstehende Verkaufsstatus');
define ('RCS_REPORT_EVEN_STYLE_TITLE', 'Report Even Row Style');
define ('RCS_REPORT_ODD_STYLE_TITLE', 'Report Odd Row Style');

define ('DEFAULT_DATE_FORMAT_TITLE', "Standardtitel für das Datumsformat");
define ('DEFAULT_FORMATED_DATE_FORMAT_TITLE', "Standardformatierter Datumsformat-Titel");

define('DISPLAY_PRICE_WITH_TAX_CHECKOUT_TITLE', 'Berechnen Sie die Steuer an der Kasse');

define('SET_JIVOSITE_TITLE', 'Aktivieren oder deaktivieren Sie JivoSite');
define('INSTAGRAM_LINK_SLIDE_TITLE', 'Instagram Link Folie');

define('STORE_BANK_INFO_TITLE', 'Bankdaten für Rechnung');

define('JIVOSITE_WIDGET_ID_TITLE', 'JivoSite-Widget-ID');
define('STORE_SCRIPTS_TITLE' , 'Einschließlich benutzerdefinierter JS');
define('STORE_METAS_TITLE' , 'Einschließlich benutzerdefinierter Meta-Tags im Kopf');
define('STORE_TIME_ZONE_TITLE', 'Zeitzone');
define('CHANGE_BY_GEOLOCATION_TITLE', 'Wechsel von Währung und Sprache je nach Standort');
define('GET_BROWSER_LANGUAGE_TITLE', 'Website auf Browsersprache umstellen');
define('DOMEN_URL_TITLE', 'Domen-Adresse');
define('DOMEN_URL_DESC', 'Sie können Ihren eigenen Domennamen festlegen');
define('STOCK_ALLOW_CHECKOUT_WITH_ATTR_COUNT_0_TITLE', 'Erlauben Sie den Kauf mit 0 in den Produktattributen');
define('STOCK_ALLOW_CHECKOUT_WITH_ATTR_COUNT_0_DESC', 'Kauf zulassen, wenn die Menge in den Produktattributen 0 ist');
define('SSL_EXIST', 'Zertifikat ausgestellt');
define('SSL_NON_EXIST', 'Zertifikat ausstellen');
define('SSL_ARE_YOU_SURE', 'Damit wird ein persönliches SSL-Zertifikat für die Domain erstellt. Sind Sie sicher?');
define('QUICK_ORDER_ENABLED_TITLE' , 'Schnellbestelltaste');