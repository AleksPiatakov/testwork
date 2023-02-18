<?php
/*
  $ Id $
  Recover Cart Sales v 1.4 DEUTSCH Sprachdatei

  Recover Cart Sales Beitrag: JM Ivler(c)
  osCommerce, Open Source E-Commerce Lösungen
  http://www.oscommerce.com

    Released under the GNU General Public License

*/

define('MESSAGE_STACK_CUSTOMER_ID', 'Unfertiger Kundenauftrag(ID-Code');
define('MESSAGE_STACK_DELETE_SUCCESS', ') wurde erfolgreich gelöscht. ');
define('HEADING_TITLE', 'Nicht abgeschlossene Aufträge');
define('HEADING_EMAIL_SENT', 'Bericht über das Senden von Briefen');
define('EMAIL_SEPARATOR', '------------------------------------------- -----------');
define('EMAIL_TEXT_SUBJECT', 'Nachricht aus dem Online-Shop' . STORE_NAME);
define('EMAIL_TEXT_SALUTATION', 'Liebe');
define('EMAIL_TEXT_NEWCUST_INTRO', "\n\n" . "Sie haben begonnen, im Online-Shop eine Bestellung aufzugeben" .
                                   STORE_NAME . ', aber sie haben es bis zum Ende nicht vervollständigt.');
define('EMAIL_TEXT_CURCUST_INTRO', "\n\n" . "Sie haben begonnen, im Online-Shop eine Bestellung aufzugeben" .
                                   STORE_NAME . ', aber nicht bis zum Ende abgeschlossen.');
define('EMAIL_TEXT_COMMON_BODY', "\n\n" . 'Wir interessieren würden zu wissen, warum Sie es nicht bis zum Ende ausgegeben haben? Wenn Sie in der Kasse haben ein Problem sind, sind wir immer bereit, Ihnen bei der Registrierung zu helfen Wir werden Ihnen helfen, eine Bestellung aufzugeben.'.
                                  "\n\n" . 'Das Produkt, das Sie bestellt haben:' .
                                 "\n\n" . '%s' . "\n");
define('DAYS_FIELD_PREFIX', 'Bestellungen für den letzten anzeigen');
define('DAYS_FIELD_POSTFIX', 'Tage');
define('DAYS_FIELD_BUTTON', 'Watch');
define('TABLE_HEADING_DATE', 'Date');
define('TABLE_HEADING_CONTACT', 'Notified');
define('TABLE_HEADING_CUSTOMER', 'Kundenname');
define('TABLE_HEADING_EMAIL', 'E-Mail-Adresse');
define('TABLE_HEADING_PHONE', 'Telefon');
define('TABLE_HEADING_MODEL', 'Code');
define('TABLE_HEADING_DESCRIPTION', 'Produkt');
define('TABLE_HEADING_QUANTY', 'Nummer');
define('TABLE_HEADING_PRICE', 'Cost');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_GRAND_TOTAL', 'Gesamtkosten für nicht abgewickelte Aufträge: ');
define('TABLE_CART_TOTAL', 'Bestellwert: ');
define('TEXT_CURRENT_CUSTOMER', 'Käufer');
define('TEXT_SEND_EMAIL', 'E-Mail senden');
define('TEXT_RETURN', 'Zurück');
define('TEXT_NOT_CONTACTED', 'Nicht benachrichtigt');
define('PSMSG', 'Zusätzliche Nachricht: ');
?>