<?php
/*
  $ Id: create_account_process.php, v 1.1 2003/09/24 14:33:18 wilt Exp $

  osCommerce, Open Source E-Commerce Lösungen
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce

  Released under the GNU General Public License
*/
define('NAVBAR_TITLE', 'Kundenregistrierung');
define('HEADING_TITLE', 'Persönliche Informationen');
define('HEADING_NEW', 'Bestellung');
define('NAVBAR_NEW_TITLE', 'Bestellung');

define('EMAIL_SUBJECT', 'Willkommen in ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Sehr geehrter Herr %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Sehr geehrte Frau %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Sehr geehrter Herr %s' . "\n\n");
define('EMAIL_WELCOME', 'Wir freuen uns, Sie zu einem Online-Shop laden <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_CONTACT', 'Wenn Sie Fragen haben, schreiben Sie: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_TEXT', 'Nun können Sie die<b>Zusatzdienste verwenden</b>, wir freuen uns, diese Dienste gehören zu bieten:.' . "\n\n" . '<li><b>Permanent Warenkorb</b> - Alle dort in den Warenkorb gelegt Produkte bleiben so lange, wie Sie sie kaufen nicht entscheiden oder, bis Sie sie aus dem Papierkorb löschen.' . "\n" . '<li><b>Adressbuch</b> - Wir können die Waren, die Sie gekauft haben, an die angegebene Adresse liefern, nicht nur an Ihre Privatadresse! Dies ist ein hervorragendes Angebot, um Geburtstagsgeschenke oder Ferien an Ihre Verwandten und Freunde zu senden, auch wenn dies der Fall ist lebt in einer anderen Stadt' . "\n" . '<li><b>Bestellverlauf</b> - Hier können Sie Ihre Bestellhistorie sehen Sie in unserem Speicher gemacht haben' . "\n" . '<li><b>Kundenmeinungen</b> - Jetzt können unsere Kunden ihre Ansichten über Ihre Meinung zu einem breiten Publikum von Käufern, die sicherlich in der Consumer-Bewertung benötigen verschiedene Waren verfügbar sein wird in unserem Shop gekaufte Artikel auszudrücken' . "\n");
define('EMAIL_WARNING', '<b>Achtung:</b> Diese E-Mail-Adresse wurde von einem unserer Kunden, die uns gegeben Wenn Sie nicht registriert sind, und sind nicht Mitglied in unserem Club der Verbraucher, lassen Sie uns wissen, an.' STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

  define('EMAIL_PASS_1', 'Dein Passwort');
  define('EMAIL_PASS_2', ', vergiss es nicht!' . "\n\n");
?>