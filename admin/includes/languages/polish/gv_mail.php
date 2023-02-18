<?php
/*
  $Id: gv_mail.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Wyślij certyfikat');

define('TEXT_CUSTOMER', 'Klient:');
define('TEXT_SUBJECT', 'Podmiot:');
define('TEXT_FROM', 'Od:');
define('TEXT_TO', 'Do:');
define('TEXT_AMOUNT', 'Kwota certyfikatu');
define('TEXT_MESSAGE', 'Wiadomość:');
define('TEXT_SINGLE_EMAIL', '<span class="smallText">Użyj tego pola, aby wysłać certyfikat na inne adresy e-mail, które nie są wymienione powyżej.</span>');
define('TEXT_SELECT_CUSTOMER', 'Wybierz klienta');
define('TEXT_ALL_CUSTOMERS', 'Wszyscy klienci');
define('TEXT_NEWSLETTER_CUSTOMERS', 'Do wszystkich subskrybentów newsletter');

define('NOTICE_EMAIL_SENT_TO', 'Powiadomienie: e-mail wysłany: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Błąd: Nie wybrano klienta.');
define('ERROR_NO_AMOUNT_SELECTED', 'Błąd: nie podałeś kwoty certyfikatu.');

define('TEXT_GV_WORTH', 'Certyfikat na kwotę ');
define('TEXT_TO_REDEEM', 'Aby aktywować certyfikat, kliknij poniższy link i podaj kod certyfikatu - ');
define('TEXT_WHICH_IS', '');
define('TEXT_IN_CASE', '');
define('TEXT_OR_VISIT', 'lub odwiedź nasz sklep internetowy pod adresem ');
define('TEXT_ENTER_CODE', ' Możesz podać kod certyfikatu podczas składania zamówienia.');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Aktywowałeś swój certyfikat, ale możesz go używać przy dokonywaniu zakupów tylko po sprawdzeniu przez administratora sklepu, dzieje się to wyłącznie ze względów bezpieczeństwa. Po zweryfikowaniu certyfikatu przez administratora. Otrzymasz powiadomienie e-mail.');
define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . 'Certyfikat na kwotę %s');
define('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . 'Możesz wysłać certyfikat lub część kwoty zaświadczenia swoim znajomym i znajomym.');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");

//Button
define('BUTTON_CANCEL_NEW', 'Anuluj');
?>
