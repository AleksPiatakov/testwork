<?php
/*
  $ Id: edit_orders.php, v 1.72 2003/08/07 00:28:44 jwh Exp $

  osCommerce, Open Source E-Commerce Lösungen
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce
  
    Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Auftrag bearbeiten');
define('HEADING_TITLE_NUMBER', 'Nummer');
define('HEADING_TITLE_DATE', 'von');
define('HEADING_SUBTITLE', 'Nachdem Sie die Reihenfolge geändert haben, vergessen Sie nicht, auf die Schaltfläche "Aktualisieren" zu klicken, um die Änderungen zu speichern. ');
define('HEADING_TITLE_SEARCH', 'Bestellcode: ');
define('HEADING_TITLE_STATUS', 'Status: ');
define('ADDING_TITLE', 'Artikel zur Bestellung hinzufügen');

define('HINT_UPDATE_TO_CC', '<font color="#FF0000">Tipp: </font>Legen Sie die Zahlungsart "Kreditkarte" fest, um weitere Informationen über die Zahlung zu erhalten. ');
define('HINT_DELETE_POSITION', '<font color="#FF0000">Tipp: </font>Um ein Produkt aus der Bestellung zu entfernen, setzen Sie die Zahl "0" vor dem gewünschten Produkt. ');
define('HINT_TOTALS', '');
// define('HINT_TOTALS', '<font color="#FF0000">Hinweis:.</font>Fühlen Sie sich frei Rabatte zu geben, indem negative Beträge in die Liste<br>Felder Hinzufügen mit "0" Werte gelöscht werden, wenn die Aktualisierung die Bestellung(Ausnahme: Versand). ');
define('HINT_PRESS_UPDATE', 'Vergessen Sie nicht, auf die Schaltfläche Aktualisieren zu klicken, um die Änderungen zu speichern. ');

define('TABLE_HEADING_COMMENTS', 'Kommentar');
define('TABLE_HEADING_CUSTOMERS', 'Buyers');
define('TABLE_HEADING_ORDER_TOTAL', 'Total');
define('TABLE_HEADING_DATE_PURCHASED', 'Bestelldatum');
define('TABLE_HEADING_DELETE', 'Löschen');
define('TABLE_HEADING_STATUS', 'Neuer Status');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_QUANTITY', 'Menge');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Code');
define('TABLE_HEADING_PRODUCTS', 'Produkt');
define('TABLE_HEADING_TAX', 'Steuer %');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_UNIT_PRICE', 'Kosten (ohne Steuern)');
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Kosten (mit Steuern)');
define('TABLE_HEADING_TOTAL_PRICE', 'Gesamt (ohne Steuern)');
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Summe (mit Steuern)');
define('TABLE_HEADING_TOTAL_MODULE', 'Gesamtauftragswert');
define('TABLE_HEADING_TOTAL_AMOUNT', 'Summe');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Käufer benachrichtigt');
define('TABLE_HEADING_DATE_ADDED', 'Datum');

define('ENTRY_CUSTOMER', 'Käufer');
define('ENTRY_CUSTOMER_NAME', 'Name');
define('ENTRY_CUSTOMER_COMPANY', 'Firma');
define('ENTRY_CUSTOMER_ADDRESS', 'Adresse des Käufers');
define('ENTRY_SEARCH_CLIENT', 'Suche nach Vorname, Nachname oder Kundennummer.');
define('ENTRY_ADDRESS', 'Adresse');
define('ENTRY_CUSTOMER_SUBURB', 'Bereich');
define('ENTRY_CUSTOMER_CITY', 'Stadt');
define('ENTRY_CUSTOMER_STATE', 'Region');
define('ENTRY_CUSTOMER_POSTCODE', 'PLZ');
define('ENTRY_CUSTOMER_COUNTRY', 'Land');
define('ENTRY_CUSTOMER_PHONE', 'Telefon');
define('ENTRY_CUSTOMER_FAX', 'Fax');
define('ENTRY_CUSTOMER_EMAIL', 'E-Mail');

define('ENTRY_SOLD_TO', 'Käufer: ');
define('ENTRY_DELIVERY_TO', 'Lieferung: ');
define('ENTRY_SHIP_TO', 'Lieferadresse: ');
define('ENTRY_SHIPPING_ADDRESS', 'Lieferadresse');
define('ENTRY_BILLING_ADDRESS', 'Adresse des Käufers');
define('ENTRY_PAYMENT_METHOD', 'Zahlungsart: ');
define('ENTRY_CREDIT_CARD_TYPE', 'Kartentyp: ');
define('ENTRY_CREDIT_CARD_OWNER', 'Karteninhaber: ');
define('ENTRY_CREDIT_CARD_NUMBER', 'Kartennummer: ');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Gültig bis: ');
define('ENTRY_SUB_TOTAL', 'Produktkosten: ');
define('ENTRY_TAX', 'Steuer: ');
define('ENTRY_SHIPPING', 'Lieferung: ');
define('ENTRY_NEW_TOTAL', 'Feld hinzufügen: ');
define('ENTRY_TOTAL', 'Gesamt: ');
define('ENTRY_DATE_PURCHASED', 'Kaufdatum: ');
define('ENTRY_STATUS', 'Auftragsstatus: ');
define('ENTRY_DATE_LAST_UPDATED', 'letzte Aktualisierung: ');
define('ENTRY_NOTIFY_CUSTOMER', 'Den Käufer benachrichtigen: ');
define('ENTRY_NOTIFY_COMMENTS', 'Einen Kommentar abgeben: ');
define('ENTRY_PRINTABLE', 'Konto drucken');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Einen Auftrag löschen');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie diese Bestellung löschen möchten?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Menge neu berechnen');
define('TEXT_DATE_ORDER_CREATED', 'Erstellungsdatum der Bestellung: ');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Zuletzt geändert: ');
define('TEXT_DATE_ORDER_ADDNEW', 'Neues Produkt hinzufügen');
define('TEXT_INFO_PAYMENT_METHOD', 'Zahlungsart: ');

define('TEXT_ALL_ORDERS', 'Gesamtbestellungen');
define('TEXT_NO_ORDER_HISTORY', 'Auftrag nicht gefunden');

define('EMAIL_SEPARATOR', '------------------------------------------- -----------');
define('EMAIL_TEXT_SUBJECT', 'Ihre Bestellung wurde aktualisiert');
define('EMAIL_TEXT_ORDER_NUMBER', 'Auftragsnummer: ');
define('EMAIL_TEXT_INVOICE_URL', 'Details der Bestellung: ');
define('EMAIL_TEXT_DATE_ORDERED', 'Bestelldatum: ');
define('EMAIL_TEXT_STATUS_UPDATE', 'Vielen Dank für Ihre Bestellung!' . "\n\n" . 'den Status Ihrer Bestellung wird geändert.' . "\n\n" . 'Die neue Status: %s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', 'Wenn Sie Fragen haben, fragen Sie uns in seiner Antwort.' . "\n\n" . 'Mit freundlichen Grüßen. ' . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Anmerkungen zu Ihrer Bestellung:' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Fehler: Auftrag nicht gefunden.');
define('SUCCESS_ORDER_UPDATED', 'Erfolgreich: Auftrag wurde erfolgreich aktualisiert.');
define('WARNING_ORDER_NOT_UPDATED', 'Warnung: Es wurden keine Änderungen vorgenommen.');

define('ADDPRODUCT_TEXT_CATEGORY_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_PRODUCT', 'Wähle ein Produkt');
define('ADDPRODUCT_TEXT_PRODUCT_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_OPTIONS', 'Wähle eine Option');
define('ADDPRODUCT_TEXT_OPTIONS_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_OPTIONS_NOTEXIST', 'Ich habe keine Produktoptionen haben, überspringen... ');
define('ADDPRODUCT_TEXT_CONFIRM_QUANTITY', 'Nummer des item');
define('ADDPRODUCT_TEXT_CONFIRM_ADDNOW', 'Hinzufügen');
define('ADDPRODUCT_TEXT_STEP', 'Schritt');
define('ADDPRODUCT_TEXT_STEP1', '&laquo; Wähle eine Partition. ');
define('ADDPRODUCT_TEXT_STEP2', '&laquo; Wählen Sie ein Produkt. ');
define('ADDPRODUCT_TEXT_STEP3', '&laquo; Wählen Sie eine Option. ');

define('MENUE_TITLE_CUSTOMER', '1. Kundendaten');
define('MENUE_TITLE_PAYMENT', '2. Zahlungsart');
define('MENUE_TITLE_ORDER', '3. Bestellte Ware');
define('MENUE_TITLE_TOTAL', '4. Lieferung und Betrag');
define('MENUE_TITLE_STATUS', '5. Status und Benachrichtigungen');
define('MENUE_TITLE_UPDATE', '6. Daten aktualisieren');

define('EMAIL_ACC_DISCOUNT_INTRO_OWNER', 'Einer Ihrer Kunden hat die Grenze des kumulativen Rabatt erreicht und wurde in die neue Gruppe übertragen. ' . "\n\n" . 'Details:');
define('EMAIL_TEXT_LIMIT', 'Erreichtes Limit: ');
define('EMAIL_TEXT_CURRENT_GROUP', 'Neue Gruppe: ');
define('EMAIL_TEXT_DISCOUNT', 'Rabatt: ');
define('EMAIL_ACC_SUBJECT', 'Kumulativer Rabatt');
define('EMAIL_ACC_INTRO_CUSTOMER', 'Herzlicher Glückwunsch, Sie haben einen neuen Speicher Rabatt all Details unten. ');
define('EMAIL_ACC_FOOTER', 'Jetzt können Sie speichern, indem Sie in unserem Online-Shop einkaufen. ');

define('EMAIL_TEXT_CUSTOMER_NAME', 'Käufer');
define('EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS', 'Email: ');
define('EMAIL_TEXT_CUSTOMER_TELEPHONE', 'Telefon: ');

define('TEXT_ORDER_COMMENTS', 'Kommentar zum Auftrag');

//Button
define('BUTTON_BACK_NEW', 'Zurück');
?>