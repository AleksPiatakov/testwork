<?php
/*
  $ Id: newsletters.php, v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Lösungen
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce

    Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Mailing Manager');

define('TABLE_HEADING_NEWSLETTERS', 'Letters');
define('TABLE_HEADING_SIZE', 'Größe');
define('TABLE_HEADING_MODULE', 'Modul');
define('TABLE_HEADING_SENT', 'Sent');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_NEWSLETTER_MODULE', 'Modul: ');
define('TEXT_NEWSLETTER_TITLE', 'Thema: ');
define('TEXT_NEWSLETTER_CONTENT', 'Inhalt: ');

define('TEXT_NEWSLETTER_DATE_ADDED', 'Datum hinzugefügt: ');
define('TEXT_NEWSLETTER_DATE_SENT', 'Datum der Einreichung: ');

define('TEXT_COUNT_CUSTOMERS_RECEIVE', 'Kunden, die den Newsletter erhalten: ');

define('TEXT_INFO_DELETE_INTRO', 'Möchten Sie diese E-Mail wirklich löschen?');

define('TEXT_PLEASE_WAIT', 'Bitte warten... E-Mails werden gesendet..<br><br>Bitte unterbrechen Sie diesen Vorgang nicht!');
define('TEXT_FINISHED_SENDING_EMAILS', 'Senden von Nachrichten erfolgreich abgeschlossen!');

define('ERROR_NEWSLETTER_TITLE', 'Fehler: Betreff ist erforderlich');
define('ERROR_NEWSLETTER_MODULE', 'Fehler: Erforderlich');
define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Fehler: Bitte blocken Sie den Newsletter, bevor Sie ihn löschen. ');
define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'Fehler: Bitte blocken Sie den Newsletter, bevor Sie diesen bearbeiten. ');
define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Fehler: Bitte blockieren Sie den Newsletter, bevor Sie diesen senden. ');

//Button
define('BUTTON_CANCEL_NEW', 'stornieren');
define('BUTTON_EDIT_NEW', 'bearbeiten');
define('BUTTON_UNLOCK_NEW', 'freischalten');
define('BUTTON_PREVIEW_NEW', 'vorschau');
define('BUTTON_BACK_NEW', 'zurück');
define('BUTTON_NEWSLETTER_NEW', 'newsletter');
define('BUTTON_DELETE_NEW', 'löschen');
define('BUTTON_LOCK_NEW', 'sperren');
define('BUTTON_SEND_NEW', 'senden');
?>