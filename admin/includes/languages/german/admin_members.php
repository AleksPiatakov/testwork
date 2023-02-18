<?php
/*
  $Id: admin_members.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

if ($_GET['gID']) {
  define('HEADING_TITLE', 'Gruppen');
} elseif ($_GET ['gPath']) {
  define('HEADING_TITLE', 'Gruppenkonfiguration');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_groups'){
	define('HEADING_TITLE', 'Administratorgruppen');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_files'){
	define('HEADING_TITLE', 'Zugangsrechte');
}else{
	define('HEADING_TITLE', 'Administrator');
}
define('ADMIN_LIST', 'Admin-Liste');


define('TEXT_COUNT_GROUPS', 'Gruppen:');
define('TABLE_HEADING_NAME', 'Name');
define('TABLE_HEADING_EMAIL', 'E-Mail-Adresse');
define('TABLE_HEADING_PASSWORD', 'Passwort');
define('TABLE_HEADING_CONFIRM', 'Passwort bestätigen');
define('TABLE_HEADING_GROUPS', 'Gruppe');
define('TABLE_HEADING_CREATED', 'Erstellungsdatum');
define('TABLE_HEADING_MODIFIED', 'Letzte Änderungen');
define('TABLE_HEADING_LOGDATE', 'Letzter Eintrag');
define('TABLE_HEADING_LOGNUM', 'Anzahl der Eingaben');
define('TABLE_HEADING_LOG_NUM', 'Anzahl der Eingaben');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_PAGES_REDIRECT', 'Admin-Weiterleitungsseite');

define('TABLE_HEADING_GROUPS_NAME', 'Gruppenname');
define('TABLE_HEADING_GROUPS_DEFINE', 'Für diese Gruppe verfügbare Boxen und Dateien');
define('TABLE_HEADING_GROUPS_GROUP', 'Gruppe');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Verfügbare Dateien und Boxen');
define('TEXT_ADMIN_LIST', 'Admin-Liste');
define('TEXT_ADMIN_GROUPS', 'Admin-Gruppen');
define('TEXT_ADMIN_ACCESS', 'Zugangsrechte');

define('TEXT_INFO_HEADING_DEFAULT', 'Administrator');
define('TEXT_INFO_HEADING_DELETE', 'Zugriff löschen');
define('TEXT_INFO_HEADING_EDIT', 'Gruppe bearbeiten /');
define('TEXT_INFO_HEADING_NEW', 'Neuer Administrator');

define('TEXT_INFO_DEFAULT_INTRO', 'Gruppe');
define('TEXT_INFO_DELETE_INTRO', 'Möchten Sie <nobr><b>%s</b></nobr> wirklich von <nobr> Administratoren entfernen?</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT', 'Sie können die Gruppe nicht löschen <nobr>%s!</nobr>');
define('TEXT_INFO_EDIT_INTRO', 'Berechtigungen für Boxen und Dateien:');
define('TEXT_INFO_CHANGE_PASSWORD', 'Ändern Sie Ihr eigenes Passwort');

define('TEXT_INFO_FULLNAME', 'Name:');
define('TEXT_INFO_FIRSTNAME', 'Name:');
define('TEXT_INFO_LASTNAME', 'Nachname:');
define('TEXT_INFO_EMAIL', 'E-Mail-Adresse:');
define('TEXT_INFO_PASSWORD', 'Passwort:');
define('TEXT_INFO_CONFIRM', 'Passwort bestätigen:');
define('TEXT_INFO_CREATED', 'Datensatz erstellt:');
define('TEXT_INFO_MODIFIED', 'Letzte Änderungen:');
define('TEXT_INFO_LOGDATE', 'Letzter Eintrag:');
define('TEXT_INFO_LOGNUM', 'Anzahl der Eingaben:');
define('TEXT_INFO_GROUP', 'Gruppe:');
define('TEXT_INFO_ERROR', 'Die eingegebene Email ist bereits registriert! Versuche eine andere Adresse anzugeben.');

define('JS_ALERT_FIRSTNAME', '- Du hast deinen Namen nicht angegeben. \n');
define('JS_ALERT_LASTNAME', '- Du hast Deinen Nachnamen nicht angegeben. \n');
define('JS_ALERT_EMAIL', '- Sie haben Ihre E-Mail-Adresse nicht angegeben. \n');
define('JS_ALERT_EMAIL_FORMAT', '- Du hast die falsche E-Mail Adresse geschrieben! \n');
define('JS_ALERT_EMAIL_USED', '- Die eingegebene Email-Adresse ist bereits registriert! \n');
define('JS_ALERT_LEVEL', '- Sie haben keine Gruppe angegeben \n');

define('ADMIN_EMAIL_SUBJECT', 'Neuer Administrator');
define('ADMIN_EMAIL_TEXT', 'Hallo, %s!'. "\n\n". 'Sie können gehen auf den Admin-Panel mit Ihnen nächstes Passwort ein. Nachdem Sie den Admin-Panel anmelden, werden dringend empfohlen, dass Sie Ihr Passwort ändern!'. "\n\n" . 'Website: %s' . "\n" . 'e-Mail: %s'. "\n" . 'Passwort: %s' . "\n\n" . 'Danke' . "\n" . '%s' . "\n\n" . 'Dieser Brief ist nicht erforderlich, es automatisch gesendet, antworten!');
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Ihre Daten werden vom Administrator geändert');
define('ADMIN_EMAIL_EDIT_TEXT', 'Hallo, %s!' . "\n\n" . 'Ihre Informationen durch den Administrator geändert werden.' . "\n\n" . 'Site: %s' . "\n" . 'E-Mail: %s' . "\n" . 'Passwort: %s' . "\n\n" . 'Danke!' . "\n" . '%s' . "\n\n" . 'Diese Mail wurde gesendet automatisch, du musst es nicht beantworten!');

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Gruppe');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Gruppe löschen');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>ACHTUNG:</b><li><b>ändern:</b> der Gruppenname ändern</li><li><b>löschen:</b> Gruppe löschen.</li><li><b> Zugriff auf Dateien:</b> Einrichten des Zugriffs auf Boxen und Dateien.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'Mit dieser Gruppe zu entfernen, werden Sie auch alle Administratoren löschen, die in dieser Gruppe sind, wollen Sie wirklich die Gruppe löschen <nobr><b>%s</b>?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'Diese Gruppe kann nicht gelöscht werden!');
define('TEXT_INFO_GROUPS_INTRO', 'Geben Sie den Namen der neuen Gruppe, klicken Sie dann auf "Weiter".');

define('TEXT_INFO_HEADING_GROUPS', 'Neue Gruppe');
define('TEXT_INFO_GROUPS_NAME', '<b>Gruppenname:</b><br>Geben Sie den neuen Gruppennamen ein und klicken Sie auf "Weiter"<br>.');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<b>Fehler:</b> Der Gruppenname mindestens zwei Zeichen bestehen muss!');
define('TEXT_INFO_GROUPS_NAME_USED', '<b>Fehler:</b> Der Gruppenname bereits vorhanden eintreten, versuchen, das Band in einer anderen Art und Weise zu nennen!');
define('TEXT_INFO_GROUPS_LEVEL', 'Gruppe:');
define('TEXT_INFO_GROUPS_BOXES', '<b>Berechtigungen Boxen:</b><br> Differenzierung der Zugriff auf die Box.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Datei zum Feld hinzufügen:');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Gruppenname bearbeiten');
define('TEXT_INFO_EDIT_GROUP_INTRO', 'Sie den Namen dieser Gruppe in den neuen ändern können, geben Sie einen neuen Namen ein, und klicken Sie auf <b>Speichern</b>');

define("stats_products_purchased.php", "Bestellte Produkte");
define("stats_customers_orders.php", "Sales Orders");
define("template_configuration.php", "Template configuration");
define("easypopulate_functions.php", ".. EASYPOPULATE_FUNCTIONS ..");
define("create_account_process.php", "Kontoerstellungsprozess");
define("create_account_success.php", "Erfolgreiche Registrierungsseite");
define("stats_customers_entry.php", "Kunden Login");
define("stats_products_viewed.php", "Angesehene Artikel");
define("languages_translater.php", "Übersetzung von Sprachen");
define("create_order_process.php", "Order Creation Process");
define("stats_sales_report2.php", "Verkaufsstatistik (2)");
define("total_configuration.php", "Einstellungseditor");
define("stats_monthly_sales.php", "Monthly sales");
define("extra_product_price.php", "Zusätzlicher Produktpreis");
define("products_attributes.php", "Product Attributes");
define("stats_last_modified.php", "Letzte Änderungen");
define("stats_sales_report.php", "Bericht zur Verkaufsstatistik");
define("attributeManager.php", "Attributes Manager");
define("mysqlperformance.php", "Slow Query Log");
define("customers_groups.php", "Kundengruppen");
define("validcategories.php", "Valid Categories");
define("stats_customers.php", "Kundenstatistik");
define("design_controls.php", "Design Controls");
define("stats_opened_by.php", "Statistiken für neue Accounts");
define("create_account.php", "Konto erstellen");
define("listcategories.php", "Liste der Kategorien");
define("stats_keywords.php", "Suchanfragen");
define("image_explorer.php", "Dateimanager");
define("xsell_products.php", "Zugehörige Produkte");
define("products_multi.php", "Produktmanagement");
define("manufacturers.php", "Manufacturers");
define("stats_zeroqty.php", "Produkte die nicht auf Lager sind");
define("configuration.php", "Configuration");

define("stats_nophoto.php", "Produkte ohne Fotos");
define("quick_updates.php", "Price Update");
define("validproducts.php", "Produktliste");
define("configuration.php", "Mein Shop");
define("admin_members.php", "Admin Management");
define("orders_status.php", "Auftragsstatus");
define("email_content.php", "Email Templates");
define("administrator.php", "Administratoren");
define("coupon_admin.php", "Promo codes");
define("listproducts.php", "Produktliste");
define("easypopulate.php", "Excel Import / Export");
define("manudiscount.php", "Herstellerrabatte");
define("localization.php", "Localization");
define("edit_orders.php", "Bestellungen bearbeiten");
define("newsletters.php", "Mailinglistenmanager");
define("tax_classes.php", "Liste der Steuern");
define("admin_files.php", "Menu of admin boxes");
define("whos_online.php", "Leute online");
define("currencies.php", "Currencies");
define("ajax_xsell.php", "AJAX Associated Products");
define("chart_data.php", ".. CHART_DATA ..");
define("categories.php", "Produktliste");
define("tax_rates.php", "Tax Rates");
define("salemaker.php", "Mengenrabatte");
define("languages.php", "Languages");
define("pollbooth.php", ".. POLLBOTH ..");
define("customers.php", "Kundenliste");
define("countries.php", "Countries");
define("geo_zones.php", "Geografische Gebiete");
define("customers.php", "Customers");
define("articles.php", "Articles");
define("products.php", "Produkteditor");
define("featured.php", "Featured Products");
define("gv_admin.php", ".. GV_ADMIN ..");
define("specials.php", "Rabatte");
define("gv_queue.php", "Zertifikatsaktivierung");
define("ship2pay.php", "Lieferung-Zahlung");
define("reviews.php", "Comments");
define("articles.php", "Pages");
define("modules.php", "Modules");
define("reports.php", "Reports");
define("catalog.php", "Catalog");
define("gv_mail.php", "Zertifikat senden");
define("gv_sent.php", "Gesendete Zertifikate");
define("modules.php", "Modules");
define("backup.php", "Database Backup");
define("orders.php", "Liste der Bestellungen");
define("taxes.php", "steuern");
define("cache.php", "Cache");
define("tools.php", "Tools");
define("polls.php", "Polls");
define("polls.php", "Voting");
define("zones.php", "Liste der Regionen");
define("mail.php", "Email senden");

define('FILENAME_DEFAULT_TEXT', 'Homepage');
define('FILENAME_CATEGORIES_TEXT', 'Kategorieseite');

define('TEXT_INFO_HEADING_DEFINE', 'Gruppeneinstellung');
if ($_GET ['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Sie nicht den Zugang zu den Boxen und Dateien für diese Gruppe ändern können.<br><br>');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Sie können einstellen, oder für eine bestimmte Gruppe zu den Boxen und Dateien. Zugriff entfernen und dann am unteren Rand des <b>Speichern</b> um Änderungen zu speichern.<br><br>');
}
?>