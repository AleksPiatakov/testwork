<?php
/*
  $ Id: easypopulate.php, v 1.4 2004.09.21 zip1 Exp $

  osCommerce, Open Source E-Commerce Lösungen
  http://www.oscommerce.com

  Copyright(c) 20042 osCommerce

    Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Configure Excel Modul Import/Export');
define('EASY_VERSION_A', 'Excel-Import/Export');
define('EASY_DEFAULT_LANGUAGE', '- Standard-Sprache -');
define('EASY_UPLOAD_FILE', 'Datei geladen. ');
define('EASY_UPLOAD_TEMP', 'temporärer Dateiname: ');
define('EASY_UPLOAD_USER_FILE', 'User Dateiname: ');
define('EASY_SIZE', 'size');
define('EASY_FILENAME', 'Dateiname: ');
define('EASY_SPLIT_DOWN', 'Sie können Ihre getrennten Dateien aus dem temporären Ordner herunterladen');
define('EASY_UPLOAD_EP_FILE', 'Datei importieren');
define('EASY_SPLIT_EP_FILE', 'Laden und Teilen der Datei in Teile');
define('EASY_INSERT', 'Import');
define('EASY_SPLIT', 'Split');
define('EASY_LIMIT', 'Export anpassen');

define('TEXT_IMPORT_TEMP', 'Importieren von Daten aus dem Ordner %s<br>');
define('TEXT_INSERT_INTO_DB', 'Import');
define('TEXT_SELECT_ONE', 'Wähle die zu importierende Datei');
define('TEXT_SPLIT_FILE', 'Datei auswählen');
define('EASY_LABEL_CREATE', 'Export: ');
define('EASY_LABEL_IMPORT', 'Import: ');
define('EASY_LABEL_CREATE_SELECT', 'So speichern Sie die exportierte Datei: ');
define('EASY_LABEL_CREATE_SAVE', 'Im temporären Ordner auf dem Server speichern');
define('EASY_LABEL_SELECT_DOWN', 'Wähle Felder zum Laden: ');
define('EASY_LABEL_SORT', 'Wählen Sie die Sortierreihenfolge: ');
define('EASY_LABEL_PRODUCT_RANGE', 'Waren mit ID-Nummer exportieren');
define('EASY_LABEL_LIMIT_CAT', 'Waren aus der Kategorie exportieren: ');
define('EASY_LABEL_LIMIT_MAN', 'Export der Waren des Herstellers: ');

define('EASY_LABEL_PRODUCT_AVAIL', 'Verfügbare Bereichs-ID-Nummern: ');
define('EASY_LABEL_PRODUCT_FROM', 'von');
define('EASY_LABEL_PRODUCT_TO', 'zu');
define('EASY_LABEL_PRODUCT_RECORDS', 'Gesamtsätze: ');
define('EASY_LABEL_PRODUCT_BEGIN', 'von: ');
define('EASY_LABEL_PRODUCT_END', 'zu: ');
define('EASY_LABEL_PRODUCT_START', 'Export');

define('EASY_FILE_LOCATE', 'Du kannst deine Datei in den Ordner aufnehmen');
define('EASY_FILE_LOCATE_2', '');
define('EASY_FILE_RETURN', 'Sie können durch Klicken auf diesen Link zurückkehren. ');
define('EASY_IMPORT_TEMP_DIR', 'Import- und temp Ordner');
define('EASY_LABEL_DOWNLOAD', 'Datei herunterladen');
define('EASY_LABEL_COMPLETE', 'Alle Felder');
define('EASY_LABEL_TAB', 'tab-limitierte.txt-Datei zum Bearbeiten');
define('EASY_LABEL_MPQ', 'Artikelcode/Preis/Menge');
define('EASY_LABEL_EP_MC', 'Artikelcode/Kategorie');
define('EASY_LABEL_EP_FROGGLE', 'Datendatei für das Fruhl System');
define('EASY_LABEL_EP_ATTRIB', 'Produktattribute');
define('EASY_LABEL_NONE', 'Nein');
define('EASY_LABEL_CATEGORY', 'Root-Partition');
define('PULL_DOWN_MANUFACTURES', 'Alle Produzenten');
define('EASY_LABEL_PRODUCT', 'ID-Artikelnummer');
define('EASY_LABEL_MANUFACTURE', 'ID-Nummer des Herstellers');
define('EASY_LABEL_EP_FROGGLE_HEADER', 'Datei oder Datei herunterladen');
define('EASY_LABEL_EP_MA', 'Artikelcode/Attribute');
define('EASY_LABEL_EP_FR_TITLE', 'Eine Datendatei oder -datei im temporären Ordner erstellen');
define('EASY_LABEL_EP_DOWN_TAB', 'Create <b>Complete</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MPQ', 'Create <b>Model/Price/Qty</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MC', 'Create <b>Model/Category</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MA', 'Create <b>Model/Attributes</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_FROOGLE', 'Create<b>Froogle</b>Tab-separierte.txt-Datei in temp dir');

define('EASY_LABEL_NEW_PRODUCT', '<font color=blue> Artikel hinzugefügt</font><br>');
define('EASY_LABEL_UPDATED', '<font color=green> Produkt wurde aktualisiert</font><br>');
define('EASY_LABEL_DELETE_STATUS_1', '<font color=red>Produkt</font><font color=black> ');
define('EASY_LABEL_DELETE_STATUS_2', '</font><font color=red> deleted!</font>');
define('EASY_LABEL_LINE_COUNT_1', 'Hinzugefügt');
define('EASY_LABEL_LINE_COUNT_2', 'Datensätze und Datei ist geschlossen... ');
define('EASY_LABEL_FILE_COUNT_1', 'Create EP_Split file');
define('EASY_LABEL_FILE_COUNT_2', '.txt... ');
define('EASY_LABEL_FILE_CLOSE_1', 'Added');
define('EASY_LABEL_FILE_CLOSE_2', 'Datensätze und Datei ist geschlossen... ');
// errormessages 
define('EASY_ERROR_1', 'Seltsam, aber die Standardsprache ist nicht gesetzt... Es ist in Ordnung, nur eine Warnung... ');
define('EASY_ERROR_2', '... ERROR! - Zu viele Zeichen im Feld für den Artikelcode.<br>
12 Zeichen ist die maximale Anzahl im Standard OsCommerce.<br>
Die maximale Länge des Felds product_model, die in den Moduleinstellungen festgelegt wurde: ');
define('EASY_ERROR_2A', '<br>Sie können entweder den Produktcode verkürzen oder die Länge des Feldes in der Datenbank erhöhen.</font>');
define('EASY_ERROR_2B', "<font color ='red'>");
define('EASY_ERROR_3', '<p class=smallText>Das Feld products_id ist nicht ausgefüllt. Diese Zeile wurde nicht importiert. <br><br>');
define('EASY_ERROR_4', '<font color=red>ERROR! - v_customer_group_id and v_customer_price must occur in pairs</font>');
define('EASY_ERROR_5', '</b><font color=red>ERROR! - You are trying to use a file created with EP Advanced, please try with Easy Populate Advanced </font>');
define('EASY_ERROR_5a', '<font color=red><b><u>  Click here to return to Easy Populate Basic </u></b></font>');
define('EASY_ERROR_6', '</b><font color=red>ERROR! - You are trying to use a file created with EP Basic, please try with Easy Populate Basic </font>');
define('EASY_ERROR_6a', '<font color=red><b><u>  Click here to return to Easy Populate Advanced </u></b></font>');

define('EASY_R_NAME', 'Name');
define('EASY_R_DESC', 'Beschreibung');
define('EASY_R_CAT', 'Kategorie');
define('EASY_R_LANGUAGE', 'Sprache');
define('EASY_R_MODEL', 'Code');
define('EASY_R_IMAGES', 'Bilder');
define('EASY_R_MANUF', 'Produzent');
define('EASY_R_DISC', 'Rabatt');
define('EASY_R_PRICE', 'Preis');
define('EASY_R_QTY', 'Nummer');
define('EASY_R_DATE', 'Datum');
define('EASY_R_STATUS', 'Status');
define('EASY_R_STATUS_ACT', 'aktiv');
define('EASY_R_STATUS_NOACT', 'inaktiv');
define('EASY_R_STATUS_DELETE', 'löschen');
define('EASY_R_DOWNLOAD', 'Sie können Ihre Datei hier herunterladen');
define('EASY_R_NORMAL', 'Normal');
define('EASY_R_ADD', 'Add');
define('EASY_R_REFRESH', 'Aktualisieren');
define('EASY_R_DEL', 'Löschen');
define('EASY_R_FULLFILE', 'Vollständige Datei');
define('EASY_R_ID_PRICE', 'Artikel/Preis/Menge');
define('EASY_R_DOWN_NOW', 'Download im laufenden Betrieb');
define('EASY_R_DOWN_CREATE', 'Erstellen und Herunterladen');
define('EASY_R_TMP_DIR', 'Im temporären Ordner erstellen');
define('EASY_R_ALL', 'Alle');
define('EASY_R_PRICEQTY', 'Preis/Menge');
define('EASY_R_CATS', 'Kategorien');
define('EASY_R_ATTRS', 'Attribute');
define('EASY_R_FILE3', 'Datei(der Produktcode ist immer da). ');
define('EASY_R_SORT', 'Sortierung');
define('EASY_R_FILTER', 'Filtration');
define('EASY_LABEL_ALGORITHM', 'Algorithmus importieren');
define('EASY_LABEL_DELIMITER', 'Trennzeichen');
define('EASY_SELECT_FILE', 'Wählen Sie eine Datei aus');
define('EASY_EXPORT_DATA', 'Export von Daten');
define('EASY_LABEL_EXPORT_FULL_ATTR_INF', 'Vollständige Attributinformationen herunterladen');
define('EASY_LABEL_IMPORT_FULL_ATTR_INF', 'Vollständige Attributinformationen herunterladen');

?>