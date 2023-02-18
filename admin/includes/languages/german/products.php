<?php
/*
  $Id: categories.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce

  Released under the GNU General Public License
*/
define('TEXT_PROD_LOAD_FILES','Dateien laden:');
define('TEXT_ALOWED_FILE_TYPES','Erlaubte Dateitypen:');
define('TEXT_PROD_FILES_DRAG','Dateien hierher ziehen');
define('TEXT_PROD_DOWNLOADS','Dateien zum Herunterladen');
define('TEXT_IS_DOWNLOAD_PRODUCT','Elektronisches Produkt:');
define('TEXT_PRODUCTS_SEO_URL', 'Products SEO URL: ');
define('TEXT_EDIT_CATEGORIES_SEO_URL', 'Category SEO URL: ');
define('TEXT_CATEGORIES_SEO_URL', 'Category SEO URL: ');

// BOF MaxiDVD: Added For Ultimate-Images Pack!
define('TEXT_PRODUCTS_IMAGE_NOTE', '<b>Artikelbild:</b><small><br>Hauptbild der Ware, die verwendet wird, wenn das Produkt in <br><u>Anzeigeund Kategorien auf der Seite ausführliche Beschreibung der Waren.</u>. aus Gründen der Geschwindigkeit der Laden von Seiten und Speicher für die Bequemlichkeit der Kunden nicht von hohen Qualität und Größe ist das Grundbild zu tun Es wird empfohlen.<small>');
define('TEXT_PRODUCTS_IMAGE_MEDIUM', '<b>Das große Bild:.</b><br><small>ERSATZPRODUKTEN Hauptbild auf der Seite<br><u>detaillierte Beschreibung des</u>.</small>');
define('TEXT_PRODUCTS_IMAGE_LARGE', '<b>Bild zu Pop-up-Fenster.</b><br><small>ERSETZEN Bild Produkt<br><u>im Popup-Fenstern</u>.</small>') ;
define('TEXT_PRODUCTS_IMAGE_LINKED', '<u>Dieses Bild für das Produkt verwenden =</u>');
define('TEXT_PRODUCTS_IMAGE_REMOVE', 'Sind Sie sicher, dass Sie auf <b>Löschen</b> dieses Bild?');
define('TEXT_PRODUCTS_IMAGE_DELETE', '<b>Löschen</b> das Bild vom Server?');
define('TEXT_PRODUCTS_IMAGE_REMOVE_SHORT', 'Bild löschen, Bilddatei auf dem Server belassen');
define('TEXT_PRODUCTS_IMAGE_DELETE_SHORT', 'Bild mit Datei löschen');
define('TEXT_PRODUCTS_IMAGE_TH_NOTICE', '<b>Mb = Minibild,</b>wird nur angezeigt, wenn<br>Waren im Laden sehen und ausführliche Produktbeschreibung Seite<br>sieht Wenn Sie nicht über ein größeres Bild(GB) angeben, ein kleines Bild es ist auch in den Pop-up-Fenstern angezeigt, aber wenn Sie ein großes Bild angeben(BC), das Pop-up-Fenster zeigt genau großes Bild(GB)<br>');
define('TEXT_PRODUCTS_IMAGE_XL_NOTICE', '<b>BK = Big Picture,</b>im Pop-up-Fenster angezeigt wird<br>');
define('TEXT_PRODUCTS_IMAGE_ADDITIONAL', '<b>Weitere Bilder</b>Produkt -. Hier gelangen Sie zum Produkt die weitere Bilder hinzufügen können, wenn das Produkt nur ein Bild, oder es existiert nicht, kann der Abschnitt weiter unten befindet, leer gelassen werden');

define('TEXT_XSELLS_ADD', 'Nach Produktcode hinzufügen: ');
define('TEXT_XSELLS_ADD_BUTTON', 'Hinzufügen');
define('TEXT_XSELLS_DEL_BUTTON', 'Löschen');

define('TEXT_QTY_PRO_QUANTITY_LABEL', 'Menge');
define('TEXT_QTY_PRO_COMBINATION_PRICE_LABEL', 'Preis');
define('TEXT_QTY_PRO_VENDOR_CODE_LABEL', 'Lieferantencode');

// EOF MaxiDVD: Added For Ultimate-Images Pack!
define('HEADING_TITLE', 'Kategorien/Produkte');
define('HEADING_TITLE_SEARCH', 'Suche: ');
define('HEADING_TITLE_GOTO', 'Gehe zu: ');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorien/Produkte');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_NEW_PRODUCT', 'Neues Element in &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Kategorien: ');
define('TEXT_SUBCATEGORIES', 'Unterkategorien: ');
define('TEXT_PRODUCTS', 'Elemente auf Seite: ');
define('TEXT_PRODUCTS_PRICE_INFO', 'Preis: ');
define('TEXT_PRODUCTS_TAX_CLASS', 'Steuerklasse: ');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Durchschnittliche Bewertung: ');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Menge: ');
define('TEXT_DATE_ADDED', 'Datum hinzugefügt: ');
define('TEXT_DELETE_IMAGE', 'Bild löschen');

define('TEXT_DATE_AVAILABLE', 'Verfügbar von: ');
define('TEXT_LAST_MODIFIED', 'Zuletzt geändert: ');
define('TEXT_IMAGE_NONEXISTENT', 'Bild nicht gefunden');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Bitte fügen Sie eine neue Kategorie oder ein neues Produkt zu<br>&nbsp;<br><b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Für weitere Informationen über das Produkt <a href="http://%s" target="blank"><u>Seite</u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Dieses Produkt wurde zum Verzeichnis %s hinzugefügt. ');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Dieses Produkt wird mit %s verkauft. ');

define('TEXT_EDIT_INTRO', 'Bitte nehmen Sie die notwendigen Änderungen vor');
define('TEXT_EDIT_CATEGORIES_ID', 'Kategorie-ID: ');
define('TEXT_EDIT_CATEGORIES_NAME', 'Kategoriename: ');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Bild für Kategorie: ');
define('TEXT_EDIT_SORT_ORDER', 'Sortierreihenfolge: ');
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'Name im Detail: ');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Beschreibung: ');

define('TEXT_INFO_COPY_TO_INTRO', 'Bitte wählen Sie eine neue Kategorie, wo Sie diesen Artikel kopieren möchten');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Aktuelle Kategorien: ');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Neue Kategorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Kategorie ändern');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Kategorie löschen');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Kategorie verschieben');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Artikel löschen');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Artikel verschieben');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopie zu');

define('TEXT_DELETE_CATEGORY_INTRO', 'Sind Sie sicher, dass Sie diese Kategorie löschen möchten?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Wollen Sie dieses Produkt wirklich löschen?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ACHTUNG:</b>Zu dieser Kategorie gehören %s Unterkategorien!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ACHTUNG:</b>Es sind %s von Produktnamen mit dieser Kategorie verknüpft!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Bitte wählen Sie eine Kategorie, die bewegen <b>%s</b> zu');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Bitte wählen Sie eine Kategorie aus, in die <b>%s</b> verschoben werden soll');
define('TEXT_MOVE', 'Verschiebe <b>%s</b> zu:');

define('TEXT_NEW_CATEGORY_INTRO', 'Bitte geben Sie die folgenden Informationen für die neue Kategorie ein');
define('TEXT_CATEGORIES_NAME', 'Kategoriename: ');
define('TEXT_CATEGORIES_IMAGE', 'Bildkategorie: ');
define('TEXT_SORT_ORDER', 'Sortierreihenfolge: ');

define('TEXT_PRODUCTS_STATUS', 'Status der Waren: ');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Einkommensdatum: ');
define('TEXT_PRODUCT_AVAILABLE', 'Auf Lager');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Nicht verfügbar');
define('TEXT_PRODUCT_STATUS','Status');
define('TEXT_PRODUCTS_MANUFACTURER', 'Hersteller: ');
define('TEXT_PRODUCTS_NAME', 'Name: ');
define('TEXT_PRODUCTS_DESCRIPTION', 'Produktbeschreibung: ');
define('TEXT_PRODUCTS_QUANTITY', 'Warenmenge auf Lager: ');
define('TEXT_PRODUCTS_MODEL', 'Artikelcode: ');
define('TEXT_PRODUCTS_IMAGE', 'Bild der Waren: ');
define('TEXT_PRODUCTS_URL', 'Waren-URL');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(ohne http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Preis (ohne Steuern): ');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Preis (mit Steuern): ');
define('TEXT_PRODUCTS_WEIGHT', 'Warengewicht: ');
define('TEXT_NONE', '-- not--');

define('EMPTY_CATEGORY', 'Leere Kategorie');

define('TEXT_HOW_TO_COPY', 'Kopiermethode: ');
define('TEXT_COPY_AS_LINK', 'Produktreferenz');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicate goods');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Fehler: Sie können nicht auf ein Produkt derselben Kategorie verweisen. ');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Fehler: Das Bildverzeichnis hat ungültige Berechtigungen:' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Das Verzeichnis mit Bildern fehlt:' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Fehler: Die Kategorie kann nicht verschoben werden. ');


//
define('ENTRY_PRODUCTS_PRICE', 'Warenpreis');
define('ENTRY_PRODUCTS_PRICE_DISABLED', 'Nicht spezifiziert');
//


define('TEXT_PRODUCTS_PAGE_TITLE', 'Meta-Titel: ');
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Meta Description: ');
define('TEXT_PRODUCTS_KEYWORDS', 'Meta Keywords: ');


// RJW Begin Meta Tags Code
  define('TEXT_META_TITLE', 'Meta-Titel');
  define('TEXT_META_DESCRIPTION', 'Meta Description');
  define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

define('TABLE_HEADING_PARAMETERS', 'Technische Parameter');

define('TEXT_PRODUCTS_INFO', 'Kurzbeschreibung: ');

define('TEXT_ATTRIBUTE_HEAD', 'Produktattribute: ');
define('TABLE_HEADING_ATTRIBUTE_1', 'Aktive Attribute');
define('TABLE_HEADING_ATTRIBUTE_2', 'Präfix');
define('TABLE_HEADING_ATTRIBUTE_3', 'Kosten');
define('TABLE_HEADING_ATTRIBUTE_4', 'Sortierung');
define('TABLE_HEADING_ATTRIBUTE_5', 'Datei');
define('TABLE_HEADING_ATTRIBUTE_6', 'Link aktiv(Tage)');
define('TABLE_HEADING_ATTRIBUTE_7', 'Maximale Downloads');
define('TABLE_HEADING_ATTRIBUTE_9', 'Gewicht');

define('TABLE_HEADING_PRODUCT_SORT', 'Bestellung');
define('TEXT_ATTRIBUTE_DESC', 'Sie Attribute zum Produkt hinzufügen können, unter Hinweis auf die notwendigen Attribute und den Wert angeben. Wenn das Produkt keine Attribute hat, können Sie diesen Schritt überspringen. Im Folgenden finden Sie eine Liste der aktiven Attributgruppe sehen und Attributwerte werden addiert/in der modifizierten< <a href="products_attributes.php">Verzeichnis - Attribute - Anpassung</a>. ');

define('TEXT_EMPTY_ATTRIBUTES', 'Fügen Sie dem Produkt zunächst ein Attribut mit mindestens zwei Werten hinzu.');

#Add:
define('TABLE_HEADING_XML', 'XML');
define('TEXT_PRODUCTS_TO_XML', 'XML-Dateien: ');
define('TEXT_PRODUCT_AVAILABLE_TO_XML', 'Aktivieren');
define('TEXT_PRODUCT_NOT_AVAILABLE_TO_XML', 'Nicht einschließen');

// BOF Enable - Disable Categories Contribution --------------------------------------
define('TEXT_EDIT_STATUS', 'Status');
define('TEXT_DEFINE_CATEGORY_STATUS', '1 = Aktiv, 0 = Inaktiv');
define('TEXT_EDIT_ROBOTS_STATUS', 'Robots Index Status');
define('TEXT_DEFINE_CATEGORY_ROBOTS_STATUS', 'index, follow/noindex, nofollow');
// EOF Enable - Deaktiviert Kategorienbeitrag --------------------------------------

define('TEXT_MIN_QUANTITY', 'Mindestanzahl an Einheiten für den Auftrag: ');
define('TEXT_MIN_QUANTITY_UNITS', 'Schritt: ');


define('TEXT_PAGES', 'Seiten: ');
define('TEXT_TOTAL_PRODUCTS', 'Artikel in dieser Kategorie: ');
define('TEXT_ATT_UPLOAD', 'Übersicht... ');

define('TEXT_WEIGHT_HELP', '<span class="main"><b><font color="red">Bitte beachten Sie:</font></b>Wenn Sie kein virtuelles Produkt hinzufügen, stellen Sie sicher, dass das Gewicht des Produkts über 0 liegt. 0,1 zB andernfalls wird während des Bestellvorgangs der Auswahl der Art der Lieferung der Ware den Schritt übersprungen werden, wenn das Warengewicht 0 ist, dann werden die Waren virtuellen betrachtet und dementsprechend Versand dieser Waren keine (virtuelles Produkt nur eine Datei heruntergeladen) benötigen, sollten diese Tatsache während Produkte Hinzufügen zum Online-Shop.</span>');

define('HEADING_TITLE_SEARCH_MODEL', 'nach dem<br/>&nbsp;Produktcode');

define('TEXT_PRODUCTS_IMAGE_DIR', 'Download-Verzeichnis: ');
define('TEXT_IMAGES_MAIN_DIRECTORY', 'images');
define('TABLE_HEADING_YES', 'Ja');
define('TABLE_HEADING_NO', 'Nein');
define('TEXT_IMAGES_OVERWRITE', 'bestehendes Bild überschreiben?');
define('TEXT_IMAGES_OVERWRITE1', 'Verwenden Sie "Nein", um das Bild manuell festzulegen');
define('TEXT_IMAGE_OVERWRITE_WARNING', 'Warnung: Der Dateiname geändert wurde, aber nicht überschrieben');
     
define('TEXT_PROD_TEXTS', 'Texte');
define('TEXT_PROD_IMGS', 'Bilder');
define('TEXT_PROD_VIDEO','Video');
define('TEXT_PROD_ATTRS', 'Attribute');
define('TEXT_PROD_LINK', 'Link');
define('TEXT_PROD_PRICE', 'Preis');
define('TEXT_PROD_TOP', 'TOP');
define('TEXT_PROD_NEW', 'NEW');
define('TEXT_PROD_AKC', 'ACTION');
define('TEXT_PROD_WE', 'Gewicht');
define('TEXT_PROD_SORT', 'Sortieren');
define('TEXT_PROD_QTY', 'Menge');
define('TEXT_PROD_MINORD', 'Minimum für den Auftrag');
define('TEXT_PROD_IMGS2', 'Produktbilder');
define('TEXT_PROD_IMGS3', 'on');
define('TEXT_PROD_IMGS_OR', 'oder');
define('TEXT_PROD_IMGS_DRAG', 'Bilder hier ziehen');
define('TEXT_PROD_COLOR', 'Farbe');
define('TEXT_PROD_CROP', 'Cut!');
define('TEXT_PROD_SAVE_BEFORE', 'Speichere die Waren vor dem Hinzufügen von Bildern. ');
define('TEXT_PROD_LOAD_IMGS', 'Bilder laden');
define('TEXT_PROD_LOAD_IMGS_BUT', 'Laden');
define('TEXT_PROD_ON', 'on');
define('TEXT_PROD_OFF', 'aus');

define('TEXT_DISCOUNT','Discount');
define('TEXT_RECIPROCAL_LINK','Reciprocal Link');

//Button
define('BUTTON_BACK_NEW', 'zurück');
define('BUTTON_QUICK_VIEW', 'Schnellansicht');


define('TEXT_EDITED_FOR_SEO', 'Bearbeitet für SEO');
define('TEXT_LINK_TO_YOUTUBE', 'Link zu Youtube-Video');
define('TEXT_IMAGE_PREVIEW', 'Vorschau');
define('TEXT_CHOOSE_ON_SERVER', 'Wählen Sie auf dem Server');