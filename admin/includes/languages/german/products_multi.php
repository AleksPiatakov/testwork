<?php
/*
  $ Id: products_multi.php, v 2.0

  autor: sr, 2003-07-31/sr@ibis-project.de

  osCommerce, Open Source E-Commerce Lösungen
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce

    Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Multi-Manager');
define('HEADING_TITLE_SEARCH', 'Suche: ');
define('HEADING_TITLE_GOTO', 'Gehe zu: ');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_CHOOSE', 'Auswählen');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorien/Produkte');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Code');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_PRODUCTS_QUANTITY', 'Qty');
define('TABLE_HEADING_MANUFACTURERS_NAME', 'Hersteller');
define('TABLE_HEADING_STATUS', 'Status');

define('DEL_DELETE', 'Produkt entfernen');
define('DEL_CHOOSE_DELETE_ART', 'Wie lösche ich?');
define('DEL_THIS_CAT', 'nur in dieser Kategorie');
define('DEL_COMPLETE', 'vollständige Entfernung der Waren');

define('TEXT_NEW_PRODUCT', 'Neuer Artikel in &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Kategorien: ');
define('TEXT_ATTENTION_DANGER', '');
/*
define('TEXT_ATTENTION_DANGER', '<br><span class = "dataTableContentRedAlert">!!! Achtung !!! Bitte lesen !!!</span><br><span class = "dataTableContentRed" >dieses Werkzeug, um die Tabelle 'products_to_categories“(im Fall von \ 'vollständig den Gegenstand entfernen \“, auch 'Produkte“ und 'products_description“, unter anderem, durch die Funktion\' tep_remove_product \') ändert - so eine Sicherungskopie dieser Tabellen machen vor jedem Gebrauch des Werkzeugs hoch Gründen empfohlen:.<br>Dieses Tool löscht, verschiebt oder kopiert alle über Checkbox ausgewählte Produkte ohne Zwischenschritt oder eine Warnung, die sofort bedeutet, nach dem Einschalten der go-Taste klicken</span><br><br. ><span class = "dataTableContentRedAlert">Bitte achten Sie darauf:</span><ul><li>Achten Sie sehr darauf, wenn Sie<strong>\'delete compl verwenden ete Produkt\' </ strong>. Diese Funktion löscht alle ausgewählten Produkte sofort, ohne Zwischenschritt oder Warnung und vollständig von allen Tabellen, in denen diese Produkte gehören.</ strong></li><li>Bei der Auswahl<strong>\'Produkt nur in dieser Kategorie löschen \'</ strong>, aber nur deren Links zu der tatsächlich geöffneten Kategorie - auch wenn es die einzige Kategorie-Verknüpfung des Produkts ist, und ohne Vorwarnung, Das heißt: seien Sie vorsichtig mit diesem Löschwerkzeug.</li><li>Während<strong>Kopieren</ strong>werden die Produkte nicht dupliziert,</li><li >Produkte werden nur<strong>verschoben</ strong>bzw.<strong>kopiert</ strong>in eine neue Kategorie, falls sie dort noch nicht existieren.</li></ul>');
*/
define('TEXT_MOVE_TO', 'gehe zu');
define('TEXT_CHOOSE_ALL', 'alle überprüfen');
define('TEXT_CHOOSE_ALL_REMOVE', 'uncheck');
define('TEXT_SUBCATEGORIES', 'Unterkategorien: ');
define('TEXT_PRODUCTS', 'Produkte: ');
define('TEXT_PRODUCTS_PRICE_INFO', 'Preis: ');
define('TEXT_PRODUCTS_TAX_CLASS', 'Steuerklasse: ');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Durchschnittliche Bewertung: ');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Menge: ');
define('TEXT_DATE_ADDED', 'Hinzugefügt: ');
define('TEXT_DATE_AVAILABLE', 'Verfügbarkeit: ');
define('TEXT_LAST_MODIFIED', 'Änderung: ');
define('TEXT_IMAGE_NONEXISTENT', 'BILD BESTEHT NICHT');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Bitte geben Sie eine neue Kategorie oder ein Element in <br>&nbsp;<br><b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Besuchen Sie <a href="http://%s" target="blank"><u>Seite</u></a>dieses Produkt für weitere Informationen. ');
define('TEXT_PRODUCT_DATE_ADDED', 'Dieses Produkt wurde zu unserem %s Verzeichnis hinzugefügt. ');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Dieser Artikel ist im Lager %s. ');

define('TEXT_EDIT_INTRO', 'Bitte nehmen Sie die notwendigen Änderungen vor');
define('TEXT_EDIT_CATEGORIES_ID', 'ID: ');
define('TEXT_EDIT_CATEGORIES_NAME', 'Name: ');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Bild: ');
define('TEXT_EDIT_SORT_ORDER', 'Sortierung: ');

define('TEXT_INFO_COPY_TO_INTRO', 'Bitte wählen Sie eine neue Kategorie, in die das Produkt kopiert werden soll');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Vorhandene Kategorien: ');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Neue Kategorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Kategorie ändern');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Kategorie löschen');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Kategorie verschieben');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Artikel löschen');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Waren verschieben');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopieren nach');
define('LINK_TO', 'Link zu');

define('TEXT_DELETE_CATEGORY_INTRO', 'Sind Sie sicher, dass Sie diese Kategorie löschen möchten?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Sind Sie sicher, dass Sie dieses Produkt endgültig löschen möchten?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ACHTUNG:</b> %s Unterkategorien sind immer noch mit dieser Kategorie verbunden!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ACHTUNG:</b> %s Elemente sind immer noch mit dieser Kategorie verbunden!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Bitte wählen Sie die Kategorie aus, die Sie platzieren möchten <b>%s</b>');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Bitte wählen Sie die Kategorie, in die Sie einfügen möchten <b>%s</b>' );
define('TEXT_MOVE', 'Verschiebe <b>%s</b>zu: ');

define('TEXT_NEW_CATEGORY_INTRO', 'Bitte füllen Sie die folgenden Informationen für die neue Kategorie aus');
define('TEXT_CATEGORIES_NAME', 'Name: ');
define('TEXT_CATEGORIES_IMAGE', 'Bild: ');
define('TEXT_SORT_ORDER', 'Sortierung: ');

define('TEXT_PRODUCTS_STATUS', 'Status: ');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Auf Lager: ');
define('TEXT_PRODUCT_AVAILABLE', 'Auf Lager');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Nicht verfügbar');
define('TEXT_PRODUCTS_MANUFACTURER', 'Hersteller: ');
define('TEXT_PRODUCTS_NAME', 'Name: ');
define('TEXT_PRODUCTS_DESCRIPTION', 'Beschreibung: ');
define('TEXT_PRODUCTS_QUANTITY', 'Menge: ');
define('TEXT_PRODUCTS_MODEL', 'Code: ');
define('TEXT_PRODUCTS_IMAGE', 'Bild: ');
define('TEXT_PRODUCTS_URL', 'URL: ');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(ohne http://)</small>');
define('TEXT_PRODUCTS_PRICE', 'Preis: ');
define('TEXT_PRODUCTS_WEIGHT', 'Weight: ');
define('TEXT_NONE', '--not--');

define('EMPTY_CATEGORY', 'Leere Kategorie');

define('TEXT_HOW_TO_COPY', 'Kopiermethode: ');
define('TEXT_COPY_AS_LINK', 'Produktreferenz');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicate goods');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Fehler: Kann keine Verknüpfung zu einem Element derselben Kategorie herstellen. ');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Fehler: Der Image-Ordner ist nicht beschreibbar:' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Der Image-Ordner existiert nicht:' . DIR_FS_CATALOG_IMAGES);

define('TEXT_PMU_CANCEL', 'Notiz');
define('TEXT_DUBLICATE_TO', 'Duplizieren in');
define('TEXT_PMU_LINK', 'Link zu');
define('TEXT_PMU_DEL', 'löschen');
define('TEXT_PMU_DUBL_CATEGORY', 'Doppeltes Verzeichnis:');

//Button
define('BUTTON_BACK_NEW', 'zurück');
define('BUTTON_PMU_SUBMIT', 'Einreichen');