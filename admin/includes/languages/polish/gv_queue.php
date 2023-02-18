<?php
/*
  $Id: gv_queue.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Gift Voucher System v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Aktywacja certyfikatów');

define('TABLE_HEADING_CUSTOMERS', 'Klient');
define('TABLE_HEADING_ORDERS_ID', 'Numer zamówienia');
define('TABLE_HEADING_VOUCHER_VALUE', 'Kwota certyfikatu');
define('TABLE_HEADING_DATE_PURCHASED', 'Data zakupu');
define('TABLE_HEADING_ACTION', 'Działanie');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Kupowałeś certyfikat w naszym sklepie internetowym.' . "\n"
                                          . 'Ze względów bezpieczeństwa certyfikat musi zostać zweryfikowany przez administratora, zanim będzie można go wykorzystać do robienia zakupów w naszym sklepie internetowym.' . "\n"
                                          . 'Z przyjemnością informujemy, że Twój certyfikat został zweryfikowany przez administratora i aktywowany. Teraz możesz' . "\n"
                                          . 'za pomocą certyfikatu możesz dokonywać zakupów w naszym sklepie internetowym, lub możesz przekazać swój certyfikat innym osobom.' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', 'Certyfikat na kwotę %s' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_BODY', '');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_COUPON_SUBJECT', 'Twój certyfikat jest sprawdzony i aktywowany!');

//Button
define('BUTTON_CONFIRM_NEW', 'Potwierdź');
define('BUTTON_RELEASE_NEW', 'Opublikuj');
define('BUTTON_CANCEL_NEW', 'Anuluj');
?>
