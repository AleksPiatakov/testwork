<?php
/*
  $ Id: modules.php, v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Lösungen
  http://www.oscommerce.com

  Copyright(c) 2003 osCommerce

    Released under the GNU General Public License
*/

define('HEADING_TITLE_MODULES_PAYMENT', 'Zahlungsmodule');
define('HEADING_TITLE_MODULES_SHIPPING', 'Lieferungsmodule');
define('HEADING_TITLE_MODULES_ORDER_TOTAL', 'Auftragsmodule');
define('TEXT_INSTALL_INTRO', 'Wollen Sie dieses Modul wirklich installieren?');
define('TEXT_DELETE_INTRO', 'Wollen Sie dieses Modul wirklich löschen?');


define('TABLE_HEADING_MODULES', 'Module');
define('TABLE_HEADING_MODULE_DESCRIPTION', 'Beschreibung');
define('TABLE_HEADING_SORT_ORDER', 'Sortierung');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_MODULE_DIRECTORY', 'Modulverzeichnis');
define('TEXT_CLOSE_BUTTON', 'Schließen');

define('MODULE_PAYMENT_CC_STATUS_TITLE', 'Kreditkarten-Zahlungsmodul aktivieren');
define('MODULE_PAYMENT_CC_STATUS_DESC', 'Möchten Sie Zahlungen mit Kreditkarten akzeptieren?');
define('MODULE_PAYMENT_CC_EMAIL_TITLE', 'E-Mail Adresse');
define('MODULE_PAYMENT_CC_EMAIL_DESC', 'Wenn Sie eine E-Mail-Adresse angeben, an die angegebenen E-Mail-Adresse wird zu den durchschnittlichen Zahlen der Kreditkartennummer gesendet werden(in der Datenbank die vollständige Kreditkartennummer speichern, mit Ausnahme der mittleren Ziffern der Daten)');
define('MODULE_PAYMENT_CC_ZONE_TITLE', 'Zone');
define('MODULE_PAYMENT_CC_ZONE_DESC', 'Wenn eine Zone ausgewählt ist, ist dieses Zahlungsmodul nur für Käufer aus der ausgewählten Zone sichtbar. ');
define('MODULE_PAYMENT_CC_ORDER_STATUS_ID_TITLE', 'Auftragsstatus');
define('MODULE_PAYMENT_CC_ORDER_STATUS_ID_DESC', 'Aufträge, die mit diesem Zahlungsmodul ausgeführt werden, erhalten den angegebenen Status. ');
define('MODULE_PAYMENT_CC_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_PAYMENT_CC_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls. ');

define('MODULE_PAYMENT_COD_STATUS_TITLE', 'Zahlungsmodul Nachnahme zulassen');
define('MODULE_PAYMENT_COD_STATUS_DESC', 'Soll das Modul bei Bestellungen verwendet werden?');
define('MODULE_PAYMENT_COD_ZONE_TITLE', 'Zone');
define('MODULE_PAYMENT_COD_ZONE_DESC', 'Wenn eine Zone ausgewählt ist, ist dieses Zahlungsmodul nur für Käufer aus der ausgewählten Zone sichtbar. ');
define('MODULE_PAYMENT_COD_ORDER_STATUS_ID_TITLE', 'Auftragsstatus');
define('MODULE_PAYMENT_COD_ORDER_STATUS_ID_DESC', 'Aufträge, die mit diesem Zahlungsmodul ausgeführt werden, erhalten den angegebenen Status. ');
define('MODULE_PAYMENT_COD_SORT_ORDER_TITLE', 'Reihenfolge sortieren');
define('MODULE_PAYMENT_COD_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls.');

define('MODULE_PAYMENT_FREECHARGER_STATUS_TITLE', 'Modul freien Download erlauben');
define('MODULE_PAYMENT_FREECHARGER_STATUS_DESC', 'Möchten Sie das Modul kostenlos herunterladen?');
define('MODULE_PAYMENT_FREECHARGER_ZONE_TITLE', 'Zone');
define('MODULE_PAYMENT_FREECHARGER_ZONE_DESC', 'Wenn Sie Bereich ausgewählt haben, wird diese Zahlungsmodul nur für Käufer der gewählten Zone sichtbar. ');
define('MODULE_PAYMENT_FRECHARGER_ORDER_STATUS_ID_TITLE', 'Bestellstatus');
define('MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID_DESC', 'Aufträge, die mit diesem Zahlungsmodul bearbeitet wurden, erhalten den angegebenen Status. ');
define('MODULE_PAYMENT_FRECHARGER_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_PAYMENT_FREECHARGER_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls');

define('MODULE_PAYMENT_LIQPAY_STATUS_TITLE', 'LiqPAY-Zahlungsmodul zulassen');
define('MODULE_PAYMENT_LIQPAY_STATUS_DESC', 'LiqPAY Zahlungsmodul aktivieren?');
define('MODULE_PAYMENT_LIQPAY_ID_TITLE', 'Händler-ID');
define('MODULE_PAYMENT_LIQPAY_ID_DESC', 'Gib deine Identifikationsnummer ein(Händler-ID). ');
define('MODULE_PAYMENT_LIQPAY_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_PAYMENT_LIQPAY_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls. ');
define('MODULE_PAYMENT_LIQPAY_ZONE_TITLE', 'Zahlungszone');
define('MODULE_PAYMENT_LIQPAY_ZONE_DESC', 'Wenn eine Zone ausgewählt ist, ist dieses Zahlungsmodul nur für Käufer aus der angegebenen Zone verfügbar. ');
define('MODULE_PAYMENT_LIQPAY_SECRET_KEY_TITLE', 'Händler-Passwort(Signatur)');
define('MODULE_PAYMENT_LIQPAY_SECRET_KEY_DESC', 'Bei dieser Option geben Sie das Passwort(Signatur) an, das in den Einstellungen auf der LiqPAY-Website angegeben ist. ');
define('MODULE_PAYMENT_LIQPAY_DEFAULT_ORDER_STATUS_ID_TITLE', 'Festlegen des Standardbestellstatus');
define('MODULE_PAYMENT_LIQPAY_DEFAULT_ORDER_STATUS_ID_DESC', 'Festlegen des Standardbestellstatus');

define('MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID_TITLE', 'Geben Sie den bezahlten Auftragsstatus an');
define('MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID_DESC', 'Geben Sie den bezahlten Auftragsstatus an');

define('MODULE_PAYMENT_BANK_TRANSFER_STATUS_TITLE', 'Vorauszahlung an Konto');
define('MODULE_PAYMENT_BANK_TRANSFER_STATUS_DESC', 'Möchten Sie das Prepayment-Modul auf dem Konto verwenden? 1 - ja, 0 - nein');
define('MODULE_PAYMENT_BANK_TRANSFER_1_TITLE', 'Bankname');
define('MODULE_PAYMENT_BANK_TRANSFER_1_DESC', 'Geben Sie den Namen der Bank ein');
define('MODULE_PAYMENT_BANK_TRANSFER_2_TITLE', 'Abrechnungskonto');
define('MODULE_PAYMENT_BANK_TRANSFER_2_DESC', 'Geben Sie Ihr aktuelles Konto ein');
define('MODULE_PAYMENT_BANK_TRANSFER_3_TITLE', 'BIC');
define('MODULE_PAYMENT_BANK_TRANSFER_3_DESC', 'Enter Bank BIC');
define('MODULE_PAYMENT_BANK_TRANSFER_4_TITLE', 'Cor/account');
define('MODULE_PAYMENT_BANK_TRANSFER_4_DESC', 'Korrespondenz/Bankverbindung eingeben');
define('MODULE_PAYMENT_BANK_TRANSFER_5_TITLE', 'INN');
define('MODULE_PAYMENT_BANK_TRANSFER_5_DESC', 'Banksteuer-ID eingeben');
define('MODULE_PAYMENT_BANK_TRANSFER_6_TITLE', 'Empfänger');
define('MODULE_PAYMENT_BANK_TRANSFER_6_DESC', 'Zahlungsempfänger');
define('MODULE_PAYMENT_BANK_TRANSFER_7_TITLE', 'KPP');
define('MODULE_PAYMENT_BANK_TRANSFER_7_DESC', 'Eingabe der PPC');
define('MODULE_PAYMENT_BANK_TRANSFER_8_TITLE', 'Zahlungszweck');
define('MODULE_PAYMENT_BANK_TRANSFER_8_DESC', 'Verwendungszweck angeben');
define('MODULE_PAYMENT_BANK_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_PAYMENT_BANK_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls');

define('MODULE_PAYMENT_BANK_CART_TRANSFER_STATUS_TITLE', 'Vorauszahlung auf die Karte');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_STATUS_DESC', 'Möchten Sie das Kartenabonnement-Modul verwenden? 1 - ja, 0 - nein');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_1_TITLE', 'Bankname');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_1_DESC', 'Geben Sie den Namen der Bank ein');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_2_TITLE', 'Kartennummer');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_2_DESC', 'Geben Sie Ihre Kartennummer ein');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_3_TITLE', 'Empfänger');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_3_DESC', 'Zahlungsempfänger');
define('MODULE_PAYMENT_BANK_CART_SORT_ORDER_TITLE', 'Sortierreihenfolge');
define('MODULE_PAYMENT_BANK_CART_SORT_ORDER_DESC', 'Modulsortierreihenfolge');

define('MODULE_PAYMENT_WEBMONEY_STATUS_TITLE', 'Zahlung über WebMoney');
define('MODULE_PAYMENT_WEBMONEY_STATUS_DESC', 'Möchten Sie das Zahlungsmodul über WebMoney nutzen? 1 - ja, 0 - nein');
define('MODULE_PAYMENT_WEBMONEY_1_TITLE', 'Deine WM-ID');
define('MODULE_PAYMENT_WEBMONEY_1_DESC', 'Gib deine WM-ID ein');
define('MODULE_PAYMENT_WEBMONEY_2_TITLE', 'Deine R-Nummer');
define('MODULE_PAYMENT_WEBMONEY_2_DESC', 'Geben Sie die Nummer Ihrer R-Geldbörse ein');
define('MODULE_PAYMENT_WEBMONEY_3_TITLE', 'Die Geldbörse deines Z');
define('MODULE_PAYMENT_WEBMONEY_3_DESC', 'Geben Sie die Nummer Ihrer Z-Geldbörse ein');
define('MODULE_PAYMENT_WEBMONEY_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_PAYMENT_WEBMONEY_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls');

// ----------------------- SHIPPING!!!!! ------------------- -------- //

define('MODULE_SHIPPING_EXPRESS_STATUS_TITLE', 'Kurier-Lieferungsmodul zulassen');
define('MODULE_SHIPPING_EXPRESS_STATUS_DESC', 'Möchten Sie das Kurierdienstmodul zulassen?');
define('MODULE_SHIPPING_EXPRESS_COST_TITLE', 'Kosten');
define('MODULE_SHIPPING_EXPRESS_COST_DESC', 'Kosten für die Verwendung dieser Liefermethode.');
define('MODULE_SHIPPING_EXPRESS_TAX_CLASS_TITLE', 'Steuer');
define('MODULE_SHIPPING_EXPRESS_TAX_CLASS_DESC', 'Use tax. ');
define('MODULE_SHIPPING_EXPRESS_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_EXPRESS_ZONE_DESC', 'Wenn eine Zone ausgewählt ist, ist dieses Liefermodul nur für Käufer aus der ausgewählten Zone sichtbar. ');
define('MODULE_SHIPPING_EXPRESS_SORT_ORDER_TITLE', 'Sortierreihenfolge');
define('MODULE_SHIPPING_EXPRESS_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls. ');
define('MODULE_SHIPPING_EXPRESS_SHIPPING_PRICE_TEXT_TITLE', 'Lieferpreistext');
define('MODULE_SHIPPING_EXPRESS_SHIPPING_PRICE_TEXT_DESC', 'Lassen Sie das Feld leer, wenn Sie den im Kostenfeld angegebenen Preis verwenden möchten');

define('MODULE_SHIPPING_FLAT_STATUS_TITLE', 'Kurierzustellungsmodul zulassen');
define('MODULE_SHIPPING_FLAT_STATUS_DESC', 'Möchten Sie das Kurierdienstmodul zulassen?');
define('MODULE_SHIPPING_FLAT_COST_TITLE', 'Kosten');
define('MODULE_SHIPPING_FLAT_COST_DESC', 'Kosten für die Verwendung dieser Liefermethode.');
define('MODULE_SHIPPING_FLAT_TAX_CLASS_TITLE', 'Steuern');
define('MODULE_SHIPPING_FLAT_TAX_CLASS_DESC', 'Use tax. ');
define('MODULE_SHIPPING_FLAT_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_FLAT_ZONE_DESC', 'Wenn eine Zone ausgewählt ist, ist dieses Liefermodul nur für Käufer aus der ausgewählten Zone sichtbar. ');
define('MODULE_SHIPPING_FLAT_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_SHIPPING_FLAT_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls.');

define('MODULE_SHIPPING_FREESHIPPER_STATUS_TITLE', 'Kostenloser Versand');
define('MODULE_SHIPPING_FREESHIPPER_STATUS_DESC', 'Soll das Modul versandkostenfrei sein?');
define('MODULE_SHIPPING_FREESHIPPER_COST_TITLE', 'Kosten');
define('MODULE_SHIPPING_FREESHIPPER_COST_DESC', 'Die Kosten für die Verwendung dieser Liefermethode.');
define('MODULE_SHIPPING_FREESHIPPER_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_FREESHIPPER_TAX_CLASS_DESC', 'Use tax. ');
define('MODULE_SHIPPING_FREESHIPPER_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_FREESHIPPER_ZONE_DESC', 'Wenn eine Zone ausgewählt ist, ist dieses Liefermodul nur für Käufer aus der ausgewählten Zone sichtbar. ');
define('MODULE_SHIPPING_FREESHIPPER_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_SHIPPING_FREESHIPPER_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls.');

define('MODULE_SHIPPING_ITEM_STATUS_TITLE', 'Modul pro Einheit erlauben');
define('MODULE_SHIPPING_ITEM_STATUS_DESC', 'Wollen Sie das Modul pro Einheit zulassen?');
define('MODULE_SHIPPING_ITEM_COST_TITLE', 'Versandkosten');
define('MODULE_SHIPPING_ITEM_COST_DESC', 'Die Versandkosten werden mit der Anzahl der Artikel in der Bestellung multipliziert. ');
define('MODULE_SHIPPING_ITEM_HANDLING_TITLE', 'Cost');
define('MODULE_SHIPPING_ITEM_HANDLING_DESC', 'Die Kosten für die Verwendung dieser Liefermethode.');
define('MODULE_SHIPPING_ITEM_TAX_CLASS_TITLE', 'Steuern');
define('MODULE_SHIPPING_ITEM_TAX_CLASS_DESC', 'Use tax. ');
define('MODULE_SHIPPING_ITEM_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_ITEM_ZONE_DESC', 'Wenn die Zone ausgewählt ist, ist dieses Liefermodul nur für Käufer aus der ausgewählten Zone sichtbar. ');
define('MODULE_SHIPPING_ITEM_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_SHIPPING_ITEM_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls.');

define('MODULE_SHIPPING_NWPOCHTA_STATUS_TITLE', 'New Mail Modul erlauben');
define('MODULE_SHIPPING_NWPOCHTA_STATUS_DESC', 'Möchten Sie das New Mail-Modul zulassen?');
define('MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME_TITLE', 'Name des benutzerdefinierten Moduls');
define('MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME_DESC', 'Lassen Sie leer, wenn Sie den Standard-Modulnamen verwenden möchten');
define('MODULE_SHIPPING_NWPOCHTA_COST_TITLE', 'Kosten');
define('MODULE_SHIPPING_NWPOCHTA_COST_DESC', 'Kosten für die Verwendung dieser Liefermethode.');
define('MODULE_SHIPPING_NWPOCHTA_TAX_CLASS_TITLE', 'Steuern');
define('MODULE_SHIPPING_NWPOCHTA_TAX_CLASS_DESC', 'Use tax. ');
define('MODULE_SHIPPING_NWPOCHTA_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_NWPOCHTA_ZONE_DESC', 'wenn die ausgewählte Zone wird diese Fördermodul nur für Kunden in einem ausgewählten Bereich sichtbar. ');
define('MODULE_SHIPPING_NWPOCHTA_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_SHIPPING_NWPOCHTA_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls. ');
define('MODULE_SHIPPING_NWPOCHTA_SHIPPING_PRICE_TEXT_TITLE', 'Lieferpreistext');
define('MODULE_SHIPPING_NWPOCHTA_SHIPPING_PRICE_TEXT_DESC', 'Lassen Sie das Feld leer, wenn Sie den im Kostenfeld angegebenen Preis verwenden möchten');

define('MODULE_SHIPPING_CUSTOMSHIPPER_STATUS_TITLE', 'Allow the module courier delivery');
define('MODULE_SHIPPING_CUSTOMSHIPPER_NAME_TITLE', 'Module name');
define('MODULE_SHIPPING_CUSTOMSHIPPER_WAY_TITLE', 'Description');
define('MODULE_SHIPPING_CUSTOMSHIPPER_COST_TITLE', 'Cost');
define('MODULE_SHIPPING_CUSTOMSHIPPER_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_CUSTOMSHIPPER_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_CUSTOMSHIPPER_ZONE_DESC', 'If the zone is selected, then this delivery module will be visible only to buyers from the selected zone.');
define('MODULE_SHIPPING_CUSTOMSHIPPER_SORT_ORDER_TITLE', 'Sorting order');

define('MODULE_SHIPPING_PERCENT_STATUS_TITLE', 'Zulassen des prozentualen Lieferungsmoduls');
define('MODULE_SHIPPING_PERCENT_STATUS_DESC', 'Möchten Sie das prozentuale Zustellungsmodul zulassen?');
define('MODULE_SHIPPING_PERCENT_RATE_TITLE', 'Prozent');
define('MODULE_SHIPPING_PERCENT_RATE_DESC', 'Wert eines Abgabemodul als Prozentsatz der Gesamtkosten der Bestellung, die Werte von 0,01 bis 0,99');
define('MODULE_SHIPPING_PERCENT_LESS_THEN_TITLE', 'Flat Cost für Aufträge an');
define('MODULE_SHIPPING_PERCENT_LESS_THEN_DESC', 'Pauschale Versandkosten für Bestellungen, Wert bis zum angegebenen Wert. ');
define('MODULE_SHIPPING_PERCENT_FLAT_USE_TITLE', 'Flat Interest Cost');
define('MODULE_SHIPPING_PERCENT_FLAT_USE_DESC', 'Versandkostenpauschale als Prozentsatz des gesamten Bestellwertes, gültig für alle Bestellungen. ');
define('MODULE_SHIPPING_PERCENT_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_PERCENT_TAX_CLASS_DESC', 'Use tax. ');
define('MODULE_SHIPPING_PERCENT_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_PERCENT_ZONE_DESC', 'Wenn eine Zone ausgewählt ist, ist dieses Liefermodul nur für Käufer aus der ausgewählten Zone sichtbar. ');
define('MODULE_SHIPPING_PERCENT_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_SHIPPING_PERCENT_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls.');

define('MODULE_SHIPPING_SAT_STATUS_TITLE', 'Kurierdienstmodul zulassen');
define('MODULE_SHIPPING_SAT_STATUS_DESC', 'Möchten Sie das Kurierdienstmodul zulassen?');
define('MODULE_SHIPPING_SAT_COST_TITLE', 'Cost');
define('MODULE_SHIPPING_SAT_COST_DESC', 'Kosten für die Verwendung dieser Liefermethode.');
define('MODULE_SHIPPING_SAT_TAX_CLASS_TITLE', 'Steuer');
define('MODULE_SHIPPING_SAT_TAX_CLASS_DESC', 'Use tax. ');
define('MODULE_SHIPPING_SAT_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_SAT_ZONE_DESC', 'Wenn die Zone ausgewählt ist, ist dieses Liefermodul nur für Käufer aus der ausgewählten Zone sichtbar. ');
define('MODULE_SHIPPING_SAT_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_SHIPPING_SAT_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls.');

define('MODULE_SHIPPING_TABLE_STATUS_TITLE', 'Modul zulassen "Keine Zustellung"');
define('MODULE_SHIPPING_TABLE_STATUS_DESC', 'Soll das Liefermodul "Keine Lieferung" erlaubt werden?');
define('MODULE_SHIPPING_TABLE_COST_TITLE', 'Versandkosten');
define('MODULE_SHIPPING_TABLE_COST_DESC', 'Transportkosten bezogen auf das Gesamtgewicht der Ordnung berechnet wird, oder die Gesamtauftragswert für Beispiel:. 25: 8.50,50: 5.50, und so weiter... Dies bedeutet, dass 8,50 bis 25 Abgabe kosten, 25 bis zu 50 kostet 5,50 usw. ');
define('MODULE_SHIPPING_TABLE_MODE_TITLE', 'Berechnungsmethode');
define('MODULE_SHIPPING_TABLE_MODE_DESC', 'Versandkostenberechnung basierend auf dem Gesamtgewicht der Reihenfolge(Gewicht) oder auf der Basis des gesamten Auftragswert(Preis). ');
define('MODULE_SHIPPING_TABLE_HANDLING_TITLE', 'Kosten');
define('MODULE_SHIPPING_TABLE_HANDLING_DESC', 'Kosten für die Verwendung dieser Liefermethode.');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_TITLE', 'Tax');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_DESC', 'Use tax. ');
define('MODULE_SHIPPING_TABLE_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_TABLE_ZONE_DESC', 'Wenn eine Zone ausgewählt ist, ist dieses Liefermodul nur für Käufer aus der ausgewählten Zone sichtbar. ');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls. ');

define('MODULE_SHIPPING_ZONES_STATUS_TITLE', 'Modultarife für die Zone erlauben');
define('MODULE_SHIPPING_ZONES_STATUS_DESC', 'Wollen Sie die Modultarife für die Zone zulassen?');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_TITLE', 'Steuer');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_DESC', 'Use tax. ');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls. ');
define('MODULE_SHIPPING_ZONES_COUNTRIES_1_TITLE', 'Zone 1');
define('MODULE_SHIPPING_ZONES_COUNTRIES_1_DESC', 'Eine Liste von Ländern getrennt durch ein Komma für Zone 1. ');
define('MODULE_SHIPPING_ZONES_COST_1_TITLE', 'Versandkosten für 1 Zone');
define('MODULE_SHIPPING_ZONES_COST_1_DESC', 'Die Versandkosten Komma für Zone 1 auf der Grundlage des Maximalwertes der Bestellung Zum Beispiel:. 3: 8.50,7: 10.50... das bedeutet, dass die Kosten für die Lieferung für Bestellungen bis zu 3 kg 8,50 kosten. für Käufer aus den Ländern der 1. Zone.');
define('MODULE_SHIPPING_ZONES_HANDLING_1_TITLE', 'Kosten der Zone 1');
define('MODULE_SHIPPING_ZONES_HANDLING_1_DESC', 'Die Kosten für die Verwendung dieser Liefermethode.');

// ----------------------- ORDER TOTAL!!!!! ------------------ --------- //

define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS_TITLE', 'Begleitetes Rabattmodul zulassen');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS_DESC', 'Haben Sie das Modul mit Bezug aus zulassen möchten?');
define('MODULE_ORDER_TOTAL_OT_BETTER_TOGETHER_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_ORDER_TOTAL_OT_BETTER_TOGETHER_SORT_ORDER_DESC', 'Sortierung Modul');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX_TITLE', 'Include Tax');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX_DESC', 'Use tax');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX_TITLE', 'neu zu berechnen Tax');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX_DESC', 'Neuberechnen Steuer');

define('MODULE_ORDER_TOTAL_COUPON_STATUS_TITLE', 'Zeige alle');
define('MODULE_ORDER_TOTAL_COUPON_STATUS_DESC', 'Soll der Gutscheinwert angezeigt werden?');
define('MODULE_ORDER_TOTAL_OT_COUPON_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_ORDER_TOTAL_OT_COUPON_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls.');
define('MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING_TITLE', 'Lieferung berücksichtigen');
define('MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING_DESC', 'Versand einschließen');
define('MODULE_ORDER_TOTAL_COUPON_INC_TAX_TITLE', 'Steuern berücksichtigen');
define('MODULE_ORDER_TOTAL_COUPON_INC_TAX_DESC', 'Steuer in die Berechnung einbeziehen. ');
define('MODULE_ORDER_TOTAL_COUPON_CALC_TAX_TITLE', 'Steuern neu berechnen');
define('MODULE_ORDER_TOTAL_COUPON_CALC_TAX_DESC', 'Steuern neu berechnen');
define('MODULE_ORDER_TOTAL_COUPON_TAX_CLASS_TITLE', 'Steuer');
define('MODULE_ORDER_TOTAL_COUPON_TAX_CLASS_DESC', 'Steuern für Gutscheine verwenden.');

define('MODULE_ORDER_TOTAL_GV_STATUS_TITLE', 'Alle anzeigen');
define('MODULE_ORDER_TOTAL_GV_STATUS_DESC', 'Möchten Sie den Wert des Geschenkgutscheins anzeigen?');
define('MODULE_ORDER_TOTAL_OT_GV_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_ORDER_TOTAL_OT_GV_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls. ');
define('MODULE_ORDER_TOTAL_GV_QUEUE_TITLE', 'Zertifikate aktivieren');
define('MODULE_ORDER_TOTAL_GV_QUEUE_DESC', 'Möchten Sie gekaufte Geschenkgutscheine manuell aktivieren?');
define('MODULE_ORDER_TOTAL_GV_INC_SHIPPING_TITLE', 'Lieferung berücksichtigen');
define('MODULE_ORDER_TOTAL_GV_INC_SHIPPING_DESC', 'Versand einschließen');
define('MODULE_ORDER_TOTAL_GV_INC_TAX_TITLE', 'Berücksichtigung der Steuer');
define('MODULE_ORDER_TOTAL_GV_INC_TAX_DESC', 'Eine Steuer in die Berechnung einbeziehen. ');
define('MODULE_ORDER_TOTAL_GV_CALC_TAX_TITLE', 'Steuer neu berechnen');
define('MODULE_ORDER_TOTAL_GV_CALC_TAX_DESC', 'Steuern neu berechnen');
define('MODULE_ORDER_TOTAL_GV_TAX_CLASS_TITLE', 'Steuern');
define('MODULE_ORDER_TOTAL_GV_TAX_CLASS_DESC', 'Use tax. ');
define('MODULE_ORDER_TOTAL_GV_CREDIT_TAX_TITLE', 'Steuerbescheinigung');
define('MODULE_ORDER_TOTAL_GV_CREDIT_TAX_DESC', 'Steuern zu gekauften Geschenkgutscheinen hinzufügen');
define('MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID_TITLE', 'Auftragsstatus');
define('MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID_DESC', 'Orders mit der Verwendung von einem Gutschein platziert, um die Gesamtkosten der Reihenfolge abdeckt den angegebenen Status hat. ');

define('MODULE_LEV_DISCOUNT_STATUS_TITLE', 'Rabatt anzeigen');
define('MODULE_LEV_DISCOUNT_STATUS_DESC', 'Rabatte erlauben?');
define('MODULE_ORDER_TOTAL_OT_LEV_DISCOUNT_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_ORDER_TOTAL_OT_LEV_DISCOUNT_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls. ');
define('MODULE_LEV_DISCOUNT_TABLE_TITLE', 'Prozentsatz des Rabattes');
define('MODULE_LEV_DISCOUNT_TABLE_DESC', 'Preisgrenzen und Prozentsätze des Rabatts festlegen, durch Kommas getrennt. ');
define('MODULE_LEV_DISCOUNT_INC_SHIPPING_TITLE', 'Lieferung berücksichtigen');
define('MODULE_LEV_DISCOUNT_INC_SHIPPING_DESC', 'Versand einschließen');
define('MODULE_LEV_DISCOUNT_INC_TAX_TITLE', 'Berücksichtigung der Steuer');
define('MODULE_LEV_DISCOUNT_INC_TAX_DESC', 'Eine Steuer in die Berechnung einbeziehen. ');
define('MODULE_LEV_DISCOUNT_CALC_TAX_TITLE', 'Steuern neu berechnen');
define('MODULE_LEV_DISCOUNT_CALC_TAX_DESC', 'Steuern neu berechnen');

define('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS_TITLE', 'Niedrigen Auftragswert anzeigen');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS_DESC', 'Haben Sie die niedrigen Kosten der Bestellung angezeigt werden soll?');
define('MODULE_ORDER_TOTAL_OT_LOWORDERFEE_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_ORDER_TOTAL_OT_LOWORDERFEE_SORT_ORDER_DESC', 'Sortierung Modul. ');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE_TITLE', 'niederwertigen Wert zulassen');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE_DESC', 'Haben Sie niedrig Stückkosten in der Größenordnung zulassen wollen?');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER_TITLE', 'Niedrig Kosten für Bestellungen bis');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER_DESC', 'Low Cost Aufträge für Aufträge bis zu einem bestimmten Wert. ');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE_TITLE', 'Gebühr');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE_DESC', 'Gebühr');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION_TITLE', 'erhöht die Kosten, um');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION_DESC', 'Ladung wurde auf die folgenden Aufträge gegeben. ');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS_TITLE', 'Tax');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS_DESC', 'Use tax. ');

define('MODULE_PAYMENT_DISC_STATUS_TITLE', 'Modul erlauben');
define('MODULE_PAYMENT_DISC_STATUS_DESC', 'Modul aktivieren?');
define('MODULE_ORDER_TOTAL_OT_PAYMENT_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_ORDER_TOTAL_OT_PAYMENT_SORT_ORDER_DESC', 'Sortierung Modul muss das gesamte Modul niedriger als. ');
define('MODULE_PAYMENT_DISC_PERCENTAGE_TITLE', 'Rabatt');
define('MODULE_PAYMENT_DISC_PERCENTAGE_DESC', 'Mindestbestellwert um einen Rabatt zu erhalten. ');
define('MODULE_PAYMENT_DISC_MINIMUM_TITLE', 'Mindestbestellmenge');
define('MODULE_PAYMENT_DISC_MINIMUM_DESC', 'Mindestbestellwert für den Erhalt eines Rabatts');
define('MODULE_PAYMENT_DISC_TYPE_TITLE', 'Zahlungsart');
define('MODULE_PAYMENT_DISC_TYPE_DESC', 'Hier können Sie den Namen der Klasse Zahlungsmodul mozho Klasse lernen in der Modul-Datei, zum Beispiel /includes/modules/payment/webmoney.php angeben. Vor Klasse webmoney gesehen, also, wenn wir wollen, um einen Rabatt geben, wenn Sie durch WebMoney bezahlen, schreibe webmoney. ');
define('MODULE_PAYMENT_DISC_INC_SHIPPING_TITLE', 'Lieferung berücksichtigen');
define('MODULE_PAYMENT_DISC_INC_SHIPPING_DESC', 'Versand in Berechnungen einschließen');
define('MODULE_PAYMENT_DISC_INC_TAX_TITLE', 'Berücksichtigung der Steuer');
define('MODULE_PAYMENT_DISC_INC_TAX_DESC', 'Steuern in Berechnungen einschließen');
define('MODULE_PAYMENT_DISC_CALC_TAX_TITLE', 'Steuer berechnen');
define('MODULE_PAYMENT_DISC_CALC_TAX_DESC', 'beinhalten Steuern, wenn die Preise zu berechnen. ');

define('MODULE_QTY_DISCOUNT_STATUS_TITLE', 'Rabatt von Menge anzeigen');
define('MODULE_QTY_DISCOUNT_STATUS_DESC', 'Möchten Sie Rabatte von der Menge zulassen?');
define('MODULE_ORDER_TOTAL_OT_QTY_DISCOUNT_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_ORDER_TOTAL_OT_QTY_DISCOUNT_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls.');
define('MODULE_QTY_DISCOUNT_RATE_TYPE_TITLE', 'Rabattart');
define('MODULE_QTY_DISCOUNT_RATE_TYPE_DESC', 'Wählen Sie den Typen von Rabatten - Interesse(in Prozent) oder flach(Flatrate)');
define('MODULE_QTY_DISCOUNT_RATES_TITLE', 'Rabatt');
define('MODULE_QTY_DISCOUNT_RATES_DESC', 'Rabatt wird auf der Grundlage der Gesamtzahl der Einheiten zum Beispiel bestellt betrachtet:. 10: 5,20: 10,..., usw. Das bedeutet, dass, wenn 10 Bestellung oder mehr Einheiten des Produkts, die Käufer einen Rabatt von 5% bekommen oder $ 5; 20 oder mehr Einheiten - ein 10% Rabatt oder $ 10; je nach Typ');
define('MODULE_QTY_DISCOUNT_INC_SHIPPING_TITLE', 'Lieferung berücksichtigen');
define('MODULE_QTY_DISCOUNT_INC_SHIPPING_DESC', 'Versand einschließen');
define('MODULE_QTY_DISCOUNT_INC_TAX_TITLE', 'Berücksichtigung der Steuer');
define('MODULE_QTY_DISCOUNT_INC_TAX_DESC', 'Eine Steuer in die Berechnung einbeziehen. ');
define('MODULE_QTY_DISCOUNT_CALC_TAX_TITLE', 'Steuer neu berechnen');
define('MODULE_QTY_DISCOUNT_CALC_TAX_DESC', 'Steuern neu berechnen');

define('MODULE_ORDER_TOTAL_SHIPPING_STATUS_TITLE', 'Lieferung anzeigen');
define('MODULE_ORDER_TOTAL_SHIPPING_STATUS_DESC', 'Möchten Sie die Versandkosten anzeigen?');
define('MODULE_ORDER_TOTAL_OT_SHIPPING_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_ORDER_TOTAL_OT_SHIPPING_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls.');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_TITLE', 'frei Anlieferung');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_DESC', 'Haben Sie Lieferung in weitere Länder erlauben wollen?');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_TITLE', 'Kostenloser Versand für Bestellungen über');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_DESC', 'bei Buchungen von mehr als ein spezifizierter Wert, wird die Lieferung frei sein.. ');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_TITLE', 'Kostenloser Versand für Bestellungen');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_DESC', 'Geben Sie an, welche Bestellungen für die kostenlose Lieferung gültig sein sollen. ');

define('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS_TITLE', 'Wert des Produkts anzeigen');
define('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS_DESC', 'Möchten Sie den Preis des Artikels anzeigen?');
define('MODULE_ORDER_TOTAL_OT_SUBTOTAL_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_ORDER_TOTAL_OT_SUBTOTAL_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls.');

define('MODULE_ORDER_TOTAL_TAX_STATUS_TITLE', 'Steuern anzeigen');
define('MODULE_ORDER_TOTAL_TAX_STATUS_DESC', 'Möchten Sie Steuern anzeigen?');
define('MODULE_ORDER_TOTAL_OT_TAX_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_ORDER_TOTAL_OT_TAX_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls.');

define('MODULE_ORDER_TOTAL_TOTAL_STATUS_TITLE', 'Alle anzeigen');
define('MODULE_ORDER_TOTAL_TOTAL_STATUS_DESC', 'Möchten Sie die Gesamtkosten der Bestellung anzeigen?');
define('MODULE_ORDER_TOTAL_OT_TOTAL_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_ORDER_TOTAL_OT_TOTAL_SORT_ORDER_DESC', 'Sortierreihenfolge des Moduls.');

define('SHIPPING_TAB_TITLE', 'Versand');
define('SHIPPING_TO_PAYMENT_TAB_TITLE', 'Versand zum Bezahlen');
define('SHIPPING_TO_FIELDS_TAB_TITLE', 'Versand an Felder');
define('SHIPPING_UPDATE_WAREHOUSES_TITLE', 'Lager aktualisieren');
define('MODULE_SHIPPING_NWPOSHTANEW_STATUS_TITLE', 'Neues Mail-Modul aktivieren');
define('MODULE_SHIPPING_NWPOSHTANEW_STATUS_DESC', 'Möchten Sie das Modul Neue Mail aktivieren?');
define('MODULE_SHIPPING_NWPOSHTANEW_COST_TITLE', 'Kosten');
define('MODULE_SHIPPING_NWPOSHTANEW_CUSTOM_NAME_TITLE', 'Benutzerdefinierter Name');
define('MODULE_SHIPPING_NWPOSHTANEW_CUSTOM_NAME_DESC', 'Lassen Sie dieses Feld leer, wenn Sie den Standardnamen verwenden möchten');
define('MODULE_SHIPPING_NWPOSHTANEW_COST_DESC', 'Die Kosten für diese Versandart.');
define('MODULE_SHIPPING_NWPOSHTANEW_TAX_CLASS_TITLE', 'Steuer');
define('MODULE_SHIPPING_NWPOSHTANEW_TAX_CLASS_DESC', 'Steuer verwenden.');
define('MODULE_SHIPPING_NWPOSHTANEW_ZONE_TITLE', 'Zone');
define('MODULE_SHIPPING_NWPOSHTANEW_ZONE_DESC', 'Wenn eine Zone ausgewählt ist, ist dieses Versandmodul nur für Kunden in der ausgewählten Zone sichtbar.');
define('MODULE_SHIPPING_NWPOSHTANEW_SORT_ORDER_TITLE', 'Sortierung');
define('MODULE_SHIPPING_NWPOSHTANEW_SORT_ORDER_DESC', 'Sortierreihenfolge der Module.');
define('MODULE_SHIPPING_NWPOSHTANEW_API_KEY_TITLE', 'API Key');
define('MODULE_SHIPPING_NWPOSHTANEW_API_KEY_DESCRIPTION', 'Kann erforderlich sein, um Warenlager zu aktualisieren');
define('MODULE_SHIPPING_NWPOSHTANEW_SHOW_SHIPPING_COST_STATUS_TITLE', 'Versandkosten anzeigen');
define('MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_PRICE_TEXT_TITLE', 'Lieferpreistext');
define('MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_PRICE_TEXT_DESC', 'Lassen Sie das Feld leer, wenn Sie den im Kostenfeld angegebenen Preis verwenden möchten');
define('MODULE_SHIPPING_NWPOSHTANEW_AUTODETECTION_DEPARTURE_TYPE_TITLE', 'Auto-detection of shipment type');
define('MODULE_SHIPPING_NWPOSHTANEW_AUTODETECTION_DEPARTURE_TYPE_DESC', 'Detect shipment type automatically?');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_REGION_TITLE', 'Sender area');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_REGION_DESC', 'Specify sender area');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_CITY_NAME_TITLE', 'Sender city');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_CITY_NAME_DESC', '\Select the city from which the order will be sent');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS_NAME_TITLE', 'Sender\'s address');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS_NAME_DESC', '\Select the address from which the order will be sent');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_TYPE_TITLE', 'Departure type');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_TYPE_DESC', 'Specify the type of shipment.');
define('MODULE_SHIPPING_NWPOSHTANEW_SEATS_AMOUNT_TITLE', 'Number of seats');
define('MODULE_SHIPPING_NWPOSHTANEW_SEATS_AMOUNT_DESC', 'Specify the default number of seats. If the field is left blank, then the number of seats will correspond to the number of products in the order.');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_DESCRIPTION_TITLE', 'Departure Description');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_DESCRIPTION_DESC', 'It is used as the default description of the product when creating "EN", it is convenient if there are many products in the store that have the same description.');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_TITLE', 'Return shipping');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_DESC', 'Specify the default return shipping type.');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_TITLE', 'Declared value');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DESC', 'Specify the components for the declared value of the shipment.');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DEFAULT_TITLE', 'Declared default value');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DEFAULT_DESC', 'The value will be used if the declared value is not set or if the order is not paid by cash on delivery.');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_PAYER_TITLE', 'Return shipping payer');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_PAYER_DESC', 'Specify the default return shipping payer.');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_TYPE_TITLE', 'Payment form');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_TYPE_DESC', 'Specify the default form of payment.');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD_TITLE', 'Cash on delivery payment method');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD_DESC', 'Specify the payment method corresponding to the cash on delivery.');
define('MODULE_SHIPPING_NWPOSHTANEW_MONEY_TRANSFER_METHOD_TITLE', 'How to receive a money transfer');
define('MODULE_SHIPPING_NWPOSHTANEW_MONEY_TRANSFER_METHOD_DESC', 'Specify the method of receiving money transfer.');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_CONTROL_TITLE', 'Payment control');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_CONTROL_DESC', 'Specify components for payment control. If items are marked, the payment control will replace the money transfer.');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_ADDITIONAL_INFORMATION_TITLE', 'Additional shipping information');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_ADDITIONAL_INFORMATION_DESC', 'It is used as a template for the field of additional information about the shipment when creating a waybill. Macros can be used. When using product macros, separate the text into two blocks using the symbol "|" (use product macros in the second block).');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_FORMAT_TITLE', 'Print format');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_FORMAT_DESC', 'Specify the print format.');
define('MODULE_SHIPPING_NWPOSHTANEW_TEMPLATE_TYPE_TITLE', 'Template type');
define('MODULE_SHIPPING_NWPOSHTANEW_TEMPLATE_TYPE_DESC', 'Specify template type.');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_TYPE_TITLE', 'Print type');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_TYPE_DESC', 'Specify Print Type.');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_START_TITLE', 'Place of printing');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_START_DESC', 'Specify the location where printing will start.');
define('MODULE_SHIPPING_NWPOSHTANEW_NUMBER_OF_COPIES_TITLE', 'Number of copies');
define('MODULE_SHIPPING_NWPOSHTANEW_NUMBER_OF_COPIES_DESC', 'Specify the number of copies.');
define('MODULE_SHIPPING_NWPOSHTANEW_DISPLAY_ALL_CONSIGNMENTS_TITLE', 'Display all invoices for an account');
define('MODULE_SHIPPING_NWPOSHTANEW_DISPLAY_ALL_CONSIGNMENTS_DESC', 'Show all invoices for a postal company account? If you select "No", then only those invoices that are assigned to the orders of this online store will be displayed.');
define('MODULE_SHIPPING_NWPOSHTANEW_CONSIGNMENT_DISPLAYED_INFORMATION_TITLE', 'Displayed Information');
define('MODULE_SHIPPING_NWPOSHTANEW_CONSIGNMENT_DISPLAYED_INFORMATION_DESC', 'Select information to display.');
define('MODULE_SHIPPING_NWPOSHTANEW_DELIVERY_PAYER_TITLE', 'Delivery payer');
define('MODULE_SHIPPING_NWPOSHTANEW_DELIVERY_PAYER_DESC', 'Specify the default shipping payer');
define('MODULE_SHIPPING_NWPOSHTANEW_WEIGHT_TITLE', 'The weight');
define('MODULE_SHIPPING_NWPOSHTANEW_WEIGHT_DESC', 'Specify the default actual weight');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_W_TITLE', 'Width');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_W_DESC', 'Specify a default width');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_L_TITLE', 'Length');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_L_DESC', 'Specify a default length');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_H_TITLE', 'Height');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_H_DESC', 'Specify a default height');
define('MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE_TITLE', 'Debug mode');
define('MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE_DESC', 'Enable/disable debug mode');
define('MODULE_SHIPPING_NWPOSHTANEW_SAVE_TTN_ONE_CLICK_TITLE', 'Create TTN in one click');
define('MODULE_SHIPPING_NWPOSHTANEW_SAVE_TTN_ONE_CLICK_DESC', 'Enable / disable the creation of TTN in one click');
define('MODULE_SHIPPING_NWPOSHTANEW_cn_identifier', 'Invoice ID');
define('MODULE_SHIPPING_NWPOSHTANEW_cn_number', 'invoice number');
define('MODULE_SHIPPING_NWPOSHTANEW_order_number', 'order no.');
define('MODULE_SHIPPING_NWPOSHTANEW_create_date', 'date of creation');
define('MODULE_SHIPPING_NWPOSHTANEW_actual_shipping_date', 'Actual departure date');
define('MODULE_SHIPPING_NWPOSHTANEW_preferred_shipping_date', 'Desired delivery date');
define('MODULE_SHIPPING_NWPOSHTANEW_estimated_shipping_date', 'Estimated delivery date');
define('MODULE_SHIPPING_NWPOSHTANEW_recipient_date', 'Date of receiving');
define('MODULE_SHIPPING_NWPOSHTANEW_last_updated_status_date', 'Date of last status update');
define('MODULE_SHIPPING_NWPOSHTANEW_sender', 'Sender');
define('MODULE_SHIPPING_NWPOSHTANEW_sender_address', 'Sender\'s address');
define('MODULE_SHIPPING_NWPOSHTANEW_recipient', 'Recipient');
define('MODULE_SHIPPING_NWPOSHTANEW_recipient_address', 'Address of the recipient');
define('MODULE_SHIPPING_NWPOSHTANEW_weight', 'Weight, kg');
define('MODULE_SHIPPING_NWPOSHTANEW_seats_amount', 'Number of seats');
define('MODULE_SHIPPING_NWPOSHTANEW_declared_cost', 'Declared value');
define('MODULE_SHIPPING_NWPOSHTANEW_shipping_cost', 'Cost of delivery');
define('MODULE_SHIPPING_NWPOSHTANEW_backward_delivery', 'Return shipping');
define('MODULE_SHIPPING_NWPOSHTANEW_service_type', 'Delivery technology');
define('MODULE_SHIPPING_NWPOSHTANEW_description', 'Description');
define('MODULE_SHIPPING_NWPOSHTANEW_additional_information', 'Additional Information');
define('MODULE_SHIPPING_NWPOSHTANEW_payer_type', 'Delivery payer');
define('MODULE_SHIPPING_NWPOSHTANEW_payment_method', 'Payment type');
define('MODULE_SHIPPING_NWPOSHTANEW_departure_type', 'Departure type');
define('MODULE_SHIPPING_NWPOSHTANEW_packing_number', 'Packing number');
define('MODULE_SHIPPING_NWPOSHTANEW_rejection_reason', 'Reason for not delivering');
define('MODULE_SHIPPING_NWPOSHTANEW_status', 'Status');
define('MODULE_SHIPPING_NWPOSHTANEW_Cargo', 'Cargo');
define('MODULE_SHIPPING_NWPOSHTANEW_Parcel', 'Parcel');
define('MODULE_SHIPPING_NWPOSHTANEW_Documents', 'Documents');
define('MODULE_SHIPPING_NWPOSHTANEW_TiresWheels', 'TiresWheels');
define('MODULE_SHIPPING_NWPOSHTANEW_Pallet', 'Pallet');
define('MODULE_SHIPPING_NWPOSHTANEW_N', 'No return shipping');
define('MODULE_SHIPPING_NWPOSHTANEW_Money', 'Money');
define('MODULE_SHIPPING_NWPOSHTANEW_ot_shipping', 'Delivery');
define('MODULE_SHIPPING_NWPOSHTANEW_ot_subtotal', 'Preliminary Total');
define('MODULE_SHIPPING_NWPOSHTANEW_ot_total', 'Order Total');
define('MODULE_SHIPPING_NWPOSHTANEW_Sender', 'Sender');
define('MODULE_SHIPPING_NWPOSHTANEW_Recipient', 'Recipient');
define('MODULE_SHIPPING_NWPOSHTANEW_ThirdPerson', 'Third Person');
define('MODULE_SHIPPING_NWPOSHTANEW_on_warehouse', 'On warehouse');
define('MODULE_SHIPPING_NWPOSHTANEW_to_payment_card', 'To payment card');
define('MODULE_SHIPPING_NWPOSHTANEW_document_A4', 'Document A4 ');
define('MODULE_SHIPPING_NWPOSHTANEW_document_A5', 'Document A5 ');
define('MODULE_SHIPPING_NWPOSHTANEW_markings_A4', 'Markings A4 ');
define('MODULE_SHIPPING_NWPOSHTANEW_html', 'HTML');
define('MODULE_SHIPPING_NWPOSHTANEW_pdf', 'PDF');
define('MODULE_SHIPPING_NWPOSHTANEW_horPrint', 'Horizontal');
define('MODULE_SHIPPING_NWPOSHTANEW_verPrint', 'Vertical');
define('MODULE_SHIPPING_NWPOSHTANEW_Cash', 'Cash');
define('MODULE_SHIPPING_NWPOSHTANEW_NonCash', 'Non Cash');

define('SHIPPING_UPDATE_AREAS_TITLE', 'Update areas');
define('SHIPPING_UPDATE_CITIES_TITLE', 'Update cities');
define('SHIPPING_UPDATE_REFERENCES_TITLE', 'Update directories');

?>