<?php
/*
  $ Id: coupon_admin.php, v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Lösungen
  http://www.oscommerce.com
  Copyright(c) 2002 osCommerce

    Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Gutscheine');
define('HEADING_TITLE_STATUS', 'Sortierung:');
define('TEXT_CUSTOMER', 'Kunde:');
define('TEXT_COUPON', 'Couponname');
define('TEXT_COUPON_ALL', 'Alle Promo codes');
define('TEXT_COUPON_ACTIVE', 'Aktive Gutscheine');
define('TEXT_COUPON_INACTIVE', 'Inaktive Promo codes');
define('TEXT_SUBJECT', 'Betreff:');
define('TEXT_FROM', 'Von:');
define('TEXT_FREE_SHIPPING', 'Kostenloser Versand');
define('TEXT_MESSAGE', 'Nachricht:');
define('TEXT_SELECT_CUSTOMER', 'Kunde auswählen');
define('TEXT_ALL_CUSTOMERS', 'Alle Clients');
define('TEXT_NEWSLETTER_CUSTOMERS', 'All subscribe zum Shop Newsletter');
define('TEXT_CONFIRM_DELETE', 'Sind Sie sicher, dass Sie mit diesem Gutschein löschen wollen?');

define('TEXT_TO_REDEEM', 'Sie diesen Code im Bestellvorgang in unserem Speicher während des Prüfungsprozesses werden Sie aufgefordert können einen Gutscheincode einzugeben, geben Sie Ihren Gutscheincode ein und klicken Sie auf "Übernehmen".');
define('TEXT_IN_CASE', 'bei Problemen.');
define('TEXT_VOUCHER_IS', 'Gutscheincode:');
define('TEXT_REMEMBER', 'Sie den Gutschein-Code nicht vergessen, wenn Sie den Gutschein-Code vergessen, Sie werden es nicht in unserem Online-Shop nutzen können.');
define('TEXT_VISIT', 'wenn Sie unser Online-Shop unter besuchen'. HTTP_SERVER . DIR_WS_CATALOG);
define('TEXT_ENTER_CODE', 'und gib den Gutscheincode ein');

define('TABLE_HEADING_ACTION', 'Aktion');

define('KUNDE_ID', 'Kundencode');
define('KUNDE_NAME', 'Name');
define('REDEEM_DATE', 'Coupon-Nutzungsdatum');
define('IP_ADDRESS', 'IP-Adresse');

define('TEXT_REDEMPTIONS', 'Coupon Nutzungsstatistiken');
define('TEXT_REDEMPTIONS_TOTAL', 'Gesamtnutzungsdauer');
define('TEXT_REDEMPTIONS_CUSTOMER', 'Dieser Client wurde einmal verwendet');
define('TEXT_NO_FREE_SHIPPING', 'Kein kostenloser Versand');

define('NOTICE_EMAIL_SENT_TO', 'Benachrichtigung: E-Mail gesendet: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Fehler: Sie haben den Client nicht ausgewählt.');
define('COUPON_NAME', 'Couponname');
// define('COUPON_VALUE', 'Coupon Value');
define('COUPON_AMOUNT', 'Coupon Nominal');
define('COUPON_CODE', 'Gutscheincode');
define('COUPON_STARTDATE', 'Der Coupon ist gültig mit');
define('COUPON_FINISHDATE', 'Der Coupon ist gültig bis');
define('COUPON_FREE_SHIP', 'Kostenloser Versand');
define('COUPON_FOR_EVERY_PRODUCT', 'Verwenden Sie für jedes geeignete Produkt');
define('COUPON_DESC', 'Coupon Description');
define('COUPON_MIN_ORDER', 'Mindestbestellwert');
define('COUPON_USES_COUPON', 'Wie oft können Sie den Gutschein bei Bestellungen verwenden');
define('COUPON_USES_USER', 'Wie oft kann dieser Gutschein von einem Käufer verwendet werden');
define('COUPON_PRODUCTS', 'Der Coupon gilt nur für bestimmte Waren');
define('COUPON_CATEGORIES', 'Der Gutschein ist nur für bestimmte Kategorien gültig');
define('VOUCHER_NUMBER_USED', 'Einmaliger Coupon');
define('DATE_CREATED', 'Erstellungsdatum');
define('DATE_MODIFIED', 'Letzte Änderungen');
define('TEXT_HEADING_NEW_COUPON', 'Neuen Gutschein erstellen');
define('TEXT_NEW_INTRO', 'Um einen neuen Gutschein zu erstellen, müssen Sie das folgende Formular ausfüllen.<br>');

define('COUPON_BUTTON_PREVIEW', 'Vorschau');
define('COUPON_BUTTON_CONFIRM', 'Confirm');
define('COUPON_BUTTON_BACK', 'Zurück');

define('ERROR_NO_COUPON_AMOUNT', 'Fehler: Couponbezeichnung wird nicht angegeben');
define('ERROR_NO_COUPON_NAME', 'Fehler: Der Gutscheinname ist nicht angegeben');
define('ERROR_COUPON_EXISTS', 'Fehler: Coupon existiert bereits');

define('COUPON_VIEW', 'Watch');

define('COUPON_NAME_HELP', 'Geben Sie den Kurznamen des Promo codes an.');
define('COUPON_AMOUNT_HELP', 'Sie entweder den Betrag des Gutscheins angeben können(geben Sie einfach die Summe der Zahlen, so dass die Summe der Coupon $100, war nur schreiben - 100) oder einen prozentualen Rabatt(bitte den Prozentsatz an, die an den Käufer gegeben werden, um den Gutschein verwenden bei der Bestellung um zum Beispiel einen Rabatt von 10% zu erhalten, und schreiben - 10%) mit diesem Code erhält der Käufer einen Gutschein Betrag als Abzug von der Gesamtbetrag der Bestellung, oder erhält einen Rabatt auf die Gesamtmenge der Bestellung, je nachdem, was Sie in dieser angeben Feld oder der Betrag des Abzugs oder der Prozentsatz des Rabattes.');
define('COUPON_CODE_HELP', 'Sie den Gutschein-Code angeben können, selbst, aber wenn Sie dieses Feld leer lassen (nur wird dieses Feld nicht ausfüllen), wird der Gutscheincode automatisch generiert werden.');
define('COUPON_STARTDATE_HELP', 'Das Datum, ab dem der Coupon aktiv ist und Sie ihn bei Bestellungen verwenden können.');
define('COUPON_FINISHDATE_HELP', 'Das Datum, nach dem der Gutschein bei der Bestellung nicht mehr angewendet werden kann.');
define('COUPON_FREE_SHIP_HELP', 'Aktivieren Sie diese Option, wenn Sie die Käufer wollen, einen Coupon bei der Bestellung, kostenlosen Versand Ihrer Bestellung erhalten. Bitte beachten Sie. Diese Option mit "einem Nennwert von je Coupon", dh Sie können nicht nur nicht geben in Verbindung verwendet werden, den entsprechenden Betrag des Käufers (oder Rabatt) Coupon und gleichzeitig freie Versandzeit, nur eine Sache oder einen Abzug (oder Rabatt) oder kostenlosen Versand. Diese Option berücksichtigt den "Wert des Mindestbestellwertes", dh Sie können zum Beispiel zu geben, Käufer mit dem Gutschein, kostenloser Versand, nur dann, wenn die Summe der Bestellung über einer bestimmte Suche, und kann nicht die Höhe der Mindestbestell begrenzen und kostenlosen Versand an jeden, der einen Gutschein an der Kasse verwendet.');
define('COUPON_FOR_EVERY_PRODUCT_HELP', 'Der Coupon-Rabatt wird auf jeden berechtigten Artikel im Warenkorb angewendet. Die Option funktioniert nur, wenn es eine Einschränkung für das Produkt oder die Kategorie gibt.');
define('COUPON_DESC_HELP', 'Beschreiben Sie kurz den erstellten Gutschein.');
define('COUPON_MIN_ORDER_HELP', 'Sie beschränken können(und nicht begrenzen können) Menge den Gutschein Mindestbestell, das heißt, wenn die Auftragsmenge als die in diesem Feld angegebene Menge weniger ist, kann der Gutschein nicht auf diese angewendet werden, bei Bestellung über nur Überspringen Sie dieses Feld, wenn Sie keine Einschränkungen festlegen möchten.');
define('COUPON_USES_COUPON_HELP', 'Die maximale Anzahl der Zeiten kann der Gutschein verwendet werden, füllen Sie nicht in diesem Bereich, wenn Sie den Gutschein nicht einschränken wollen.');
define('COUPON_USES_USER_HELP', 'Die maximale Anzahl der Zeiten kann der Coupon von einem Käufer verwendet werden, füllen Sie nicht in diesem Bereich, wenn Sie den Gutschein nicht einschränken wollen.');
define('COUPON_PRODUCTS_HELP', 'nur für bestimmte Produkte in Ihrem Online-Shop Sie können den Effekt von Coupon begrenzen, Warencodes Auflistung, die durch Kommas getrennt dieses Feld überspringen, wenn Sie es nicht beschränken wollen.');
define('COUPON_CATEGORIES_HELP', 'Sie können den Effekt des Kupons beschränken sich nur auf bestimmte Kategorien in Ihrem Online-Shop, Kategoriecodes Auflistung, die durch Kommas getrennt dieses Feld überspringen, wenn Sie wollen es nicht beschränken.');

define('TEXT_TOOLTIP_VOUCHER_EMAIL', 'Coupon an E-Mail senden');
define('TEXT_TOOLTIP_VOUCHER_EDIT', 'Coupon bearbeiten');
define('TEXT_TOOLTIP_VOUCHER_DELETE', 'Coupon löschen');
define('TEXT_TOOLTIP_VOUCHER_REPORT', 'Coupon Report');

?>