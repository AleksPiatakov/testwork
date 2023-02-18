<?php
/*
  $Id: categories.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('TEXT_PRODUCTS_SEO_URL', 'Products SEO URL:');
define('TEXT_EDIT_CATEGORIES_SEO_URL', 'Category SEO URL:');
define('TEXT_CATEGORIES_SEO_URL', 'Category SEO URL:');
define('TEXT_COPY_LINK', 'Link');

// BOF MaxiDVD: Added For Ultimate-Images Pack!
define('TEXT_PRODUCTS_IMAGE_NOTE', '<b>Bild von Waren:</b><small><br>Das Hauptbild des Produkts, das verwendet wird<br><u>, wenn das Produkt in den Kategorien und auf der Produktdetailseite angezeigt wird.</u>. Es wird empfohlen, das Hauptbild nicht von hoher Qualität und Größe zu machen, um die Ladengeschwindigkeit der Seiten des Ladens und die Bequemlichkeit der Käufer zu erhöhen.<small>');
define('TEXT_PRODUCTS_IMAGE_MEDIUM', '<b>Big Picture:</b><br><small>ERSETZEN Sie das Hauptbild des Gegenstandes auf<br><u>die detaillierte Beschreibung</u>.</small>');
define('TEXT_PRODUCTS_IMAGE_LARGE', '<b>Bild für das Popup-Fenster:</b><br><small>ERSETZEN Sie das Bild des Produkts<br><u>im Popup-Fenster</u>.</small>');
define('TEXT_PRODUCTS_IMAGE_LINKED', '<u>Dieses Bild für das Produkt verwenden =</u>');
define('TEXT_PRODUCTS_IMAGE_REMOVE', 'Möchten Sie dieses Bild wirklich<b>löschen?');
define('TEXT_PRODUCTS_IMAGE_DELETE', '<b>Löschen</b>dieses Bild vom Server?');
define('TEXT_PRODUCTS_IMAGE_REMOVE_SHORT', 'Bild löschen, Bilddatei auf dem Server belassen');
define('TEXT_PRODUCTS_IMAGE_DELETE_SHORT', 'Bild mit Datei löschen');
define('TEXT_PRODUCTS_IMAGE_TH_NOTICE', '<b>Mb = Minibild,</b> wird nur angezeigt, wenn<br>Waren im Laden sehen und ausführliche Produktbeschreibung Seite<br>sieht Wenn Sie nicht über ein größeres Bild (GB) angeben, ein kleines Bild es ist auch in den Pop-up-Fenstern angezeigt, aber wenn Sie ein großes Bild angeben (GB), das Pop-up-Fenster zeigt genau großes Bild (GB)<br><br>');
define('TEXT_PRODUCTS_IMAGE_XL_NOTICE', '<b>BP = Big Picture,</b>im Pop-up-Fenster angezeigt wird<br><br><br>');
define('TEXT_PRODUCTS_IMAGE_ADDITIONAL', '<b>Weitere Bilder</b> Produkt - Hier gelangen Sie zum Produkt die weitere Bilder hinzufügen können, wenn das Produkt nur ein Bild, oder es existiert nicht, kann der Abschnitt weiter unten befindet, leer gelassen werden');
// EOF MaxiDVD: Added For Ultimate-Images Pack!
define('HEADING_TITLE', 'Kategorien/Produkte');
define('HEADING_TITLE_SEARCH', 'Suche:');
define('HEADING_TITLE_GOTO', 'Gehe zu:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorien/Produkte');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_NEW_PRODUCT', 'Neues Element in &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Kategorien:');
define('TEXT_SUBCATEGORIES', 'Unterkategorien:');
define('TEXT_PRODUCTS', 'Elemente auf Seite:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Preis:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Steuerklasse:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Durchschnittliche Bewertung:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Menge:');
define('TEXT_DATE_ADDED', 'Datum hinzugefügt:');
define('TEXT_DELETE_IMAGE', 'Bild löschen');

define('TEXT_DATE_AVAILABLE', 'Verfügbar von:');
define('TEXT_LAST_MODIFIED', 'Zuletzt geändert:');
define('TEXT_IMAGE_NONEXISTENT', 'Bild nicht gefunden');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Bitte fügen Sie eine neue Kategorie oder ein neues Produkt zu<br>&nbsp;<br> <b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Für weitere Informationen über das Produkt <a href="http://%s" target="blank"><u>Seite</u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Dieses Produkt wurde zum Verzeichnis %s hinzugefügt.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Dieses Produkt wird mit %s verkauft.');

define('TEXT_EDIT_INTRO', 'Bitte nehmen Sie die notwendigen Änderungen vor');
define('TEXT_EDIT_CATEGORIES_ID', 'Kategorie-ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Kategoriename:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Bild für Kategorie:');
define('TEXT_EDIT_CATEGORIES_ICON', 'Symbol für Kategorie:');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS', 'Produkte anzeigen:');
define('TEXT_EDIT_SORT_ORDER', 'Sortierreihenfolge:');
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'Name im Detail:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Beschreibung:');

define('TEXT_INFO_COPY_TO_INTRO', 'Bitte wählen Sie eine neue Kategorie aus, in die Sie dieses Produkt kopieren möchten');
define('TEXT_INFO_DELETE_FROM_CATEGORY', 'Wählen Sie die Kategorie aus, aus der Sie dieses Produkt entfernen möchten');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Aktuelle Kategorien:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Neue Kategorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Kategorie ändern');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Kategorie löschen');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Kategorie verschieben');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Artikel löschen');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Artikel verschieben');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopie in');

define('TEXT_DELETE_CATEGORY_INTRO', 'Sind Sie sicher, dass Sie diese Kategorie löschen möchten?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Wollen Sie dieses Produkt wirklich löschen?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ACHTUNG:</b> Zu dieser Kategorie gehören %s Unterkategorien!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ACHTUNG:</b> Es sind %s von Produktnamen mit dieser Kategorie verknüpft!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Bitte wählen Sie eine Kategorie aus, in die  <b>%s</b> verschoben werden soll');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Bitte wählen Sie eine Kategorie aus, in die  <b>%s</b> verschoben werden soll');
define('TEXT_MOVE', 'Verschiebe <b>%s</b> zu:');

define('TEXT_NEW_CATEGORY_INTRO', 'Bitte geben Sie die folgenden Informationen für die neue Kategorie ein');
define('TEXT_CATEGORIES_NAME', 'Kategoriename:');
define('TEXT_CATEGORIES_IMAGE', 'Bildkategorie:');
define('TEXT_SORT_ORDER', 'Sortierreihenfolge:');

define('TEXT_PRODUCTS_STATUS', 'Status der Waren:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Einkommensdatum:');
define('TEXT_PRODUCT_AVAILABLE', 'Auf Lager');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Nicht verfügbar');
define('TEXT_PRODUCTS_MANUFACTURER', 'Hersteller:');
define('TEXT_PRODUCTS_NAME', 'Name:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Produktbeschreibung:');
define('TEXT_PRODUCTS_QUANTITY', 'Warenmenge auf Lager:');
define('TEXT_PRODUCTS_MODEL', 'Artikelcode:');
define('TEXT_PRODUCTS_IMAGE', 'Bild der Waren:');
define('TEXT_PRODUCTS_URL', 'Waren-URL');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(ohne http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Preis (ohne Steuern):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Preis (mit Steuern):');
define('TEXT_PRODUCTS_WEIGHT', 'Warengewicht:');
define('TEXT_NONE', '--not--');

define('EMPTY_CATEGORY', 'Leere Kategorie');

define('TEXT_HOW_TO_COPY', 'Kopiermethode:');
define('TEXT_COPY_AS_LINK', 'Produktreferenz');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicate goods');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Fehler: Sie können nicht auf ein Produkt derselben Kategorie verweisen.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Fehler: Das Bildverzeichnis hat ungültige Berechtigungen:' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Das Verzeichnis mit Bildern fehlt:' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Fehler: Die Kategorie kann nicht verschoben werden.');


//
define('ENTRY_PRODUCTS_PRICE', 'Warenpreis');
define('ENTRY_PRODUCTS_PRICE_DISABLED', 'Nicht spezifiziert');
//


define('TEXT_PRODUCTS_PAGE_TITLE', 'Meta-Titel:');
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Meta Description:');
define('TEXT_PRODUCTS_KEYWORDS', 'Meta Keywords:');


// RJW Begin Meta Tags Code
  define('TEXT_META_TITLE', 'Meta-Titel');
  define('TEXT_META_DESCRIPTION', 'Meta Description');
  define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

define('TABLE_HEADING_PARAMETERS', 'Technische Parameter');

define('TEXT_PRODUCTS_INFO', 'Kurzbeschreibung:');

define('TEXT_ATTRIBUTE_HEAD', 'Produktattribute:');
define('TABLE_HEADING_ATTRIBUTE_1', 'Aktive Attribute');
define('TABLE_HEADING_ATTRIBUTE_2', 'Präfix');
define('TABLE_HEADING_ATTRIBUTE_3', 'Kosten');
define('TABLE_HEADING_ATTRIBUTE_4', 'Sortierung');
define('TABLE_HEADING_ATTRIBUTE_5', 'Datei');
define('TABLE_HEADING_ATTRIBUTE_6', 'Link aktiv(Tage)');
define('TABLE_HEADING_ATTRIBUTE_7', 'Maximale Downloads');
define('TABLE_HEADING_ATTRIBUTE_9', 'Gewicht');

define('TABLE_HEADING_PRODUCT_SORT', 'Bestellung');
define('TEXT_ATTRIBUTE_DESC', 'Sie können Attribute für das Produkt hinzufügen, indem Sie die erforderlichen Attribute notieren und die Kosten angeben. Wenn das Produkt keine Attribute hat, überspringen Sie einfach diesen Schritt. Um die Liste der aktiven Attribute anzuzeigen, werden die Gruppen- und Attributwerte im<hinzugefügt/geändert <a href="products_attributes.php">Verzeichnis - Attribute - Anpassung</a>.');

# Add:
define('TABLE_HEADING_XML', 'XML');
define('TEXT_PRODUCTS_TO_XML', 'XML-Dateien:');
define('TEXT_PRODUCT_AVAILABLE_TO_XML', 'Aktivieren');
define('TEXT_PRODUCT_NOT_AVAILABLE_TO_XML', 'Nicht einschließen');

// BOF Enable - Disable Categories Contribution--------------------------------------
define('TEXT_EDIT_STATUS', 'Status');
define('TEXT_DEFINE_CATEGORY_STATUS', 'Aktiv/Inaktiv');
define('TEXT_EDIT_ROBOTS_STATUS', 'Robots Index Status');
define('TEXT_DEFINE_CATEGORY_ROBOTS_STATUS', 'index, follow/noindex, nofollow');
// EOF Enable - Disable Categories Contribution --------------------------------------

define('TEXT_MIN_QUANTITY', 'Mindestanzahl an Einheiten für den Auftrag:');
define('TEXT_MIN_QUANTITY_UNITS', 'Schritt:');

define('ATTRIBUTES_COPY_MANAGER_1', 'Produktattribute in die Kategorie kopieren ...');
define('ATTRIBUTES_COPY_MANAGER_2', 'Produktattribute kopieren');
define('ATTRIBUTES_COPY_MANAGER_3', 'Produktnummer angeben');
define('ATTRIBUTES_COPY_MANAGER_4', 'Alle Produkte der Kategorie');
define('ATTRIBUTES_COPY_MANAGER_5', 'Kategorie Nummer:');
define('ATTRIBUTES_COPY_MANAGER_6', 'Löschen aller vorhandenen Attribute in der Kategorie vor dem Kopieren');
define('ATTRIBUTES_COPY_MANAGER_7', 'Oder sonst ...');
define('ATTRIBUTES_COPY_MANAGER_8', 'Doppelte Attribute werden weggelassen');
define('ATTRIBUTES_COPY_MANAGER_9', 'Doppelte Attribute werden überschrieben');
define('ATTRIBUTES_COPY_MANAGER_10', 'Attribute mit Dateien kopieren');
define('ATTRIBUTES_COPY_MANAGER_11', 'Wähle eine Kategorie');
define('ATTRIBUTES_COPY_MANAGER_12', 'Attribute von jedem Produkt in alle Produkte der Kategorie kopieren');
define('ATTRIBUTES_COPY_MANAGER_13', 'Attribute kopieren');
define('ATTRIBUTES_COPY_MANAGER_14', 'Wähle ein Produkt');
define('ATTRIBUTES_COPY_MANAGER_15', 'Artikelnummer:');
define('ATTRIBUTES_COPY_MANAGER_16', 'In der Ware:');
define('ATTRIBUTES_COPY_MANAGER_17', 'Löschen aller vorhandenen Attribute des Produkts vor dem Kopieren der neuen Attribute');
define('ATTRIBUTES_COPY_MANAGER_COPY', 'Attribute kopieren');

define('TEXT_PAGES', 'Seiten:');
define('TEXT_TOTAL_PRODUCTS', 'Artikel in dieser Kategorie:');
define('TEXT_ATT_UPLOAD', 'Übersicht...');

define('TEXT_WEIGHT_HELP', '<span class="main"><b>Hinweis:</b> Wenn Sie nicht-virtuelles Produkt hinzufügen, müssen Sie das Gewicht der Ware zu platzieren ist größer als 0, beispielsweise 0,1, andernfalls wird während des Bestellvorganges den Schritt der Auswahl übersprungen wird die Art der Lieferung der Waren, wenn die Waren Gewicht 0, so gilt die Ware als virtuelles, und dementsprechend Versand solcher Waren diese Tatsache nicht ein(virtuelles Produkt nur eine Datei heruntergeladen) benötigen, sollten Sie, wenn Sie Elemente zu einem Online-Shop in.</span>');

define('HEADING_TITLE_SEARCH_MODEL', 'nach dem<br />&nbsp;Produktcode');

define('TEXT_PRODUCTS_IMAGE_DIR', 'Download-Verzeichnis:');
define('TEXT_IMAGES_MAIN_DIRECTORY', 'images');
define('TABLE_HEADING_YES', 'Ja');
define('TABLE_HEADING_NO', 'Nein');
define('TEXT_IMAGES_OVERWRITE', 'bestehendes Bild überschreiben?');
define('TEXT_IMAGES_OVERWRITE1', 'Verwenden Sie "Nein", um das Bild manuell festzulegen');
define('TEXT_IMAGE_OVERWRITE_WARNING', 'Warnung: Der Dateiname wurde geändert, aber nicht überschrieben');

define('TEXT_CAT_DELPHOTO', 'Foto löschen');
define('TEXT_CAT_ACTION', 'Aktion');
define('TEXT_CAT_IMAGE', 'Bild');
define('TEXT_CAT_EDIT', 'edit');
define('TEXT_CAT_SUBCATS', 'Unterkategorien');
define('TEXT_CAT_PRODUCTS', 'Artikel im Abschnitt');
define('TEXT_CAT_MODEL', 'Code');
define('TEXT_CAT_QTY', 'auf Lager');
define('TEXT_CAT_PRICE', 'Preis');

define('TEXT_FILTER_SPECIALS', 'Rabatt');
define('TEXT_FILTER_CONCOMITANT', 'Assembling');
define('TEXT_FILTER_TOP', 'Top');
define('TEXT_FILTER_NEW', 'Neu');
define('TEXT_FILTER_STOCK', 'Teilen');
define('TEXT_FILTER_RECOMMEND', 'Empfohlen');

//Button
define('BUTTON_CANCEL_NEW', 'Stornieren');
define('BUTTON_BACK_NEW', 'Zurück');
define('BUTTON_NEW_CATEGORY_NEW', 'Neue kategorie');
define('BUTTON_NEW_PRODUCT_NEW', 'Neue produkt');

// WebMakers.com Added: Attribute Copy Option
define('TEXT_COPY_ATTRIBUTES_ONLY','Wird nur für doppelte Produkte verwendet ...');
define('TEXT_COPY_ATTRIBUTES','Produktattribute in Duplikate kopieren?');
define('TEXT_COPY_ATTRIBUTES_YES','Ja');
define('TEXT_COPY_ATTRIBUTES_NO','Nein');


define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_NOTHING','Nichts');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_ALL','Alle Produkte von Unterkategorien');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_TOP','TOP Verkäufe dieser Kategorie');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_RECOMMENDED','Empfohlen für diese Kategorie');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_NEW','Neuheiten dieser Kategorie');
define('TEXT_ID_XML_CATEGORY','ID XML');
define('TEXT_VENDOR_XML_CATEGORY','Vendor XML-Kategorie');
define('ERROR_SYS_CATEGORY_EXIST','Die XML-ID der Kategorie %s ist bereits von <a href="'.DIR_WS_ADMIN . 'categories.php?cID=%s&action=edit_category" target="_blank">einer anderen Kategorie belegt</a>');
?>