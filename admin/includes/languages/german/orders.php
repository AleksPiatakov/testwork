<?php
/*
  $Id: orders.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Auftragsliste');
define('HEADING_TITLE_SEARCH', 'Suche nach Auftrags-ID');
define('HEADING_TITLE_STATUS', 'Status: ');

define('TABLE_HEADING_COMMENTS', 'Kommentar');
define('TABLE_HEADING_CUSTOMERS', 'Clients');
define('TABLE_HEADING_ORDER_TOTAL', 'Auftragssumme');
define('TABLE_HEADING_DATE_PURCHASED', 'Kaufdatum');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_QUANTITY', 'Menge');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Artikelcode');
define('TABLE_HEADING_PRODUCTS', 'Produkte');
define('TABLE_HEADING_TAX', 'Tax');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Preis(ohne Steuern)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Preis');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Allgemein(ohne Steuern)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Gesamt');
define('TEXT_NEW_CUSTOMER', 'Neukunde');
define('TEXT_EXIST_CUSTOMER', 'Kunden existieren');

define('TABLE_HEADING_DATE_ADDED', 'Datum hinzugefügt');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Kunde benachrichtigt');
define('ENTRY_NOTIFY_CUSTOMER_EMAIL', 'Kunden per E-Mail benachrichtigen? ');

define('ENTRY_CUSTOMER', 'Kunde: ');
define('ENTRY_SOLD_TO', 'KÄUFER: ');
define('ENTRY_DELIVERY_TO', 'Adresse: ');
define('ENTRY_SHIP_TO', 'LIEFERADRESSE: ');
define('ENTRY_SHIPPING_ADDRESS', 'Lieferadresse: ');
define('ENTRY_BILLING_ADDRESS', 'Adresse des Käufers');
define('ENTRY_PAYMENT_METHOD', 'Zahlungsart: ');
define('ENTRY_CREDIT_CARD_TYPE', 'Kreditkartenart: ');
define('ENTRY_CREDIT_CARD_OWNER', 'Kreditkarteninhaber: ');
define('ENTRY_CREDIT_CARD_NUMBER', 'Kreditkartennummer: ');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Ablaufdatum der Kreditkarte: ');
define('ENTRY_SUB_TOTAL', 'Vorschau gesamt: ');
define('ENTRY_TAX', 'Steuer: ');
define('ENTRY_SHIPPING', 'Lieferung: ');
define('ENTRY_TOTAL', 'Gesamt: ');
define('ENTRY_DATE_PURCHASED', 'Kaufdatum: ');
define('ENTRY_STATUS', 'Status: ');
define('ENTRY_DATE_LAST_UPDATED', 'Zuletzt geändert: ');
define('ENTRY_NOTIFY_CUSTOMER', 'Benachrichtigen des Kunden: ');
define('ENTRY_NOTIFY_COMMENTS', 'Kommentare hinzufügen: ');
define('ENTRY_PRINTABLE', 'Konto drucken');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Auftrag löschen');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie diese Bestellung löschen möchten?');
define('TEXT_INFO_DELETE_DATA', 'Käufer: ');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Inventarmenge neu berechnen');
define('TEXT_INFO_DELETE_DATA_OID', 'Auftragsnummer: ');
define('TEXT_DATE_ORDER_CREATED', 'Erstellungsdatum: ');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Letzte Änderungen: ');
define('TEXT_INFO_PAYMENT_METHOD', 'Zahlungsart: ');

define('TEXT_ALL_ORDERS', 'Alle Bestellungen');
define('TEXT_NO_ORDER_HISTORY', 'Bestellhistorie fehlt');

define('EMAIL_SEPARATOR', '------------------------------------------- -----------');
define('EMAIL_TEXT_SUBJECT', 'Der Status Ihrer Bestellung wird geändert');
define('EMAIL_TEXT_ORDER_NUMBER', 'Auftragsnummer: ');
define('EMAIL_TEXT_INVOICE_URL', 'Bestellinformation: ');
define('EMAIL_TEXT_DATE_ORDERED', 'Bestelldatum: ');
define('EMAIL_TEXT_STATUS_UPDATE', 'Ihr Auftragsstatus geändert.' . "\n\n" . 'Der neue Status: %s' . "\n\n" . 'Wenn Sie Fragen haben, fragen Sie uns eine Antwort auf diese E-Mail.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Kommentare zu Ihrer Bestellung'. "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Fehler: Auftrag existiert nicht. ');
define('SUCCESS_ORDER_UPDATED', 'Fertig: Auftrag wurde erfolgreich aktualisiert. ');
define('WARNING_ORDER_NOT_UPDATED', 'Hinweis: Es gibt nichts zu ändern, der Auftrag wurde NICHT aktualisiert. ');
// denuz
define('TABLE_HEADING_ORDER_NETTO', 'Net');
define('TABLE_HEADING_ORDER_NUMBER', 'Nummer');
define('TABLE_HEADING_ORDER_MARJA', 'Marge');
define('TITLE_ORDER_NETTO', 'Net: ');
define('TITLE_ORDER_MARJA', 'Marge: ');
define('TEXT_TOTAL', 'Gesamt: ');
define('TEXT_NETTO', 'Net: ');
define('TEXT_MARJA', 'Marge: ');
// eof denuz
define('EMAIL_TEXT_CUSTOMER_NAME', 'Käufer');
define('EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS', 'Email: ');
define('EMAIL_TEXT_CUSTOMER_TELEPHONE', 'Telefon: ');
define('EMAIL_ACC_DISCOUNT_INTRO_OWNER', 'Einer Ihrer Kunden hat die Grenze des kumulativen Rabatt erreicht und wurde in die neue Gruppe übertragen. ' . "\n\n" . 'Details:');
define('EMAIL_TEXT_LIMIT', 'Erreichtes Limit: ');
define('EMAIL_TEXT_CURRENT_GROUP', 'Neue Gruppe: ');
define('EMAIL_TEXT_DISCOUNT', 'Neuer Rabatt: ');
define('EMAIL_ACC_SUBJECT', 'Kumulativer Rabatt');
define('EMAIL_ACC_INTRO_CUSTOMER', 'Herzlicher Glückwunsch, Sie haben einen neuen Speicher Rabatt all Details unten. ');
define('EMAIL_ACC_FOOTER', 'Wenn Sie irgendwelche Fragen haben, fragen Sie uns im Antwortbrief. ');

define('TEXT_REFERER', 'Woher kam: ');
define('TEXT_ORDER_DELETE', 'Löschen: ');

define('TEXT_OR_NAL', 'Nal');
define('TEXT_OR_BNAL', 'Beznal');
define('TEXT_OR_PRIVAT', 'Privat');
define('TEXT_OR_NALOZH', 'Überlagerung');
define('TEXT_OR_FROM', 'c');
define('TEXT_OR_TO', 'zu');
define('TEXT_OR_CLEAR', 'Filter zurücksetzen');
define('TEXT_OR_TOTAL', 'Summe');
define('TEXT_OR_DATE', 'Lieferdatum');
define('TEXT_OR_COURIER', 'Courier');
define('TEXT_OR_STATUS', 'Auftragsstatus');
define('TEXT_OR_PAYMENT', 'Zahlungsart');
define('TEXT_OR_ACTION', 'Aktion');
define('ENTRY_CUSTOMERS', 'Kunde: ');
define('ENTRY_DELIVERY', 'Adresse: ');
define('ENTRY_INFO', 'Info: ');
define('ENTRY_CREATE_ORDER', 'Bestellung erstellen');


// neue orders
define('TEXT_NEW_ORDER', 'Neuer Auftrag');
define('TEXT_SELECT_CUST', 'Käufer auswählen');
define('TEXT_SELECT_CUST_PLACEHOLDER', 'ID oder Vor- oder Nachname eingeben');
define('TEXT_ADDRESS_BOOK', 'Address book');
define('TEXT_FIRST_NAME', 'Name');
define('TEXT_LAST_NAME', 'Nachname');
define('TEXT_GROUPS_NAME', 'Betritt die Gruppe');
define('TEXT_EMAIL', 'Email');
define('TEXT_PHONE', 'Telefon');
define('TEXT_FAX', 'Fax');
define('TEXT_FIRM', 'Firmenname');
define('TEXT_ADDRESS', 'Adresse');
define('TEXT_SUBURB', 'Bereich');
define('TEXT_POSTCODE', 'Index');
define('TEXT_CITY', 'Stadt');
define('TEXT_ZONE', 'Region');
define('TEXT_COUNTRY', 'Land');
define('TEXT_OP_PRICE', 'Produktwert');
define('TEXT_OP_TAX', 'Steuer');
define('TEXT_OP_SHIPPING', 'Lieferung');
define('TEXT_OP_TOTAL', 'Bestellwert');
define('TEXT_EDIT_ORDER', 'Bestellung bearbeiten');
define('TEXT_CURRENCY', 'Währung:');
define('TEXT_CURRENCY_VALUE', 'Wechselkurs');

define('ENTRY_BILLING', 'Abrechnung:');
