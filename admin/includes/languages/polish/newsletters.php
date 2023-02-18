<?php
/*
  $Id: newsletters.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Manager newsletterów');

define('TABLE_HEADING_NEWSLETTERS', 'Newsletter');
define('TABLE_HEADING_SIZE', 'Rozmiar');
define('TABLE_HEADING_MODULE', 'Moduł');
define('TABLE_HEADING_SENT', 'Wysłano');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Działanie');

define('TEXT_NEWSLETTER_MODULE', 'Moduł:');
define('TEXT_NEWSLETTER_TITLE', 'Tytuł:');
define('TEXT_NEWSLETTER_CONTENT', 'Treść:');

define('TEXT_NEWSLETTER_DATE_ADDED', 'Data dodania:');
define('TEXT_NEWSLETTER_DATE_SENT', 'Data wysyłki:');

define('TEXT_COUNT_CUSTOMERS_RECEIVE', 'Klienci, którzy otrzymują newsletter:');

define('TEXT_INFO_DELETE_INTRO', 'Czy na pewno chcesz usunąć ten newsletter?');

define('TEXT_PLEASE_WAIT', 'Proszę, czekaj .. e-maile są wysyłane  ..<br><br>Proszę nie przerywać tego procesu!');
define('TEXT_FINISHED_SENDING_EMAILS', 'Wysyłanie e-maili zostało pomyślnie zakończone!');

define('ERROR_NEWSLETTER_TITLE', 'Błąd: Tytuł jest wymagany');
define('ERROR_NEWSLETTER_MODULE', 'Błąd: Moduł jest wymagany');
define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Błąd: Proszę zablokować newsletter przed usunięciem.');
define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'Błąd:Proszę zablokować newsletter przed edycją.');
define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Błąd: Proszę zablokować newsletter przed wysłaniem.');

//Button
define('BUTTON_CANCEL_NEW', 'anuluj');
define('BUTTON_EDIT_NEW', 'edytować');
define('BUTTON_UNLOCK_NEW', 'odblokować');
define('BUTTON_PREVIEW_NEW', 'zapowiedź');
define('BUTTON_BACK_NEW', 'wróć');
define('BUTTON_NEWSLETTER_NEW', 'newsletter');
define('BUTTON_DELETE_NEW', 'usuń');
define('BUTTON_LOCK_NEW', 'zamknij');
define('BUTTON_SEND_NEW', 'wysłać');
?>
