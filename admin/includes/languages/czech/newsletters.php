<?php
/*
  $Id: newsletters.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Správce newsletteru');

define('TABLE_HEADING_NEWSLETTERS', 'Zpravodaje');
define('TABLE_HEADING_SIZE', 'Velikost');
define('TABLE_HEADING_MODULE', 'Modul');
define('TABLE_HEADING_SENT', 'Odesláno');
define('TABLE_HEADING_STATUS', 'Stav');
define('TABLE_HEADING_ACTION', 'Akce');

define('TEXT_NEWSLETTER_MODULE', 'Modul:');
define('TEXT_NEWSLETTER_TITLE', 'Název zpravodaje:');
define('TEXT_NEWSLETTER_CONTENT', 'Obsah:');

define('TEXT_NEWSLETTER_DATE_ADDED', 'Datum přidání:');
define('TEXT_NEWSLETTER_DATE_SENT', 'Datum odeslání:');

define('TEXT_COUNT_CUSTOMERS_RECEIVE', 'Zákazníci dostávají newsletter:');

define('TEXT_INFO_DELETE_INTRO', 'Opravdu chcete smazat tento newsletter?');

define('TEXT_PLEASE_WAIT', 'Čekejte prosím .. odesílání e-mailů ..<br><br>Prosím nepřerušujte tento proces!');
define('TEXT_FINISHED_SENDING_EMAILS', 'Dokončeno odesílání e-mailů!');

define('ERROR_NEWSLETTER_TITLE', 'Chyba: Je vyžadován název zpravodaje');
define('ERROR_NEWSLETTER_MODULE', 'Chyba: Je vyžadován modul zpravodaje');
define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Chyba: Prosím zamkněte newsletter před jeho smazáním.');
define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'Chyba: Prosím zamkněte newsletter, než jej upravíte.');
define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Chyba: Prosím zamkněte newsletter před jeho odesláním.');

//Knoflík
define('BUTTON_CANCEL_NEW', 'zrušit');
define('BUTTON_EDIT_NEW', 'edit');
define('BUTTON_UNLOCK_NEW', 'odemknout');
define('BUTTON_PREVIEW_NEW', 'náhled');
define('BUTTON_BACK_NEW', 'zpět');
define('BUTTON_NEWSLETTER_NEW', 'newsletter');
define('BUTTON_DELETE_NEW', 'smazat');
define('BUTTON_LOCK_NEW', 'lock');
define('BUTTON_SEND_NEW', 'odeslat');
?>