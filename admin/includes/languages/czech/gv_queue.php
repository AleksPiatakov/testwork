<?php
/*
  $Id: gv_queue.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Systém dárkových poukazů v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Fronta na vydání dárkového poukazu');

define('TABLE_HEADING_CUSTOMERS', 'Zákazníci');
define('TABLE_HEADING_ORDERS_ID', 'Číslo objednávky');
define('TABLE_HEADING_VOUCHER_VALUE', 'Hodnota voucheru');
define('TABLE_HEADING_DATE_PURCHASED', 'Datum nákupu');
define('TABLE_HEADING_ACTION', 'Akce');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Nedávno jste zakoupili dárkový poukaz v našem internetovém obchodě.' . "\n"
    . "Z bezpečnostních důvodů vám to nebylo okamžitě k dispozici." . "\n"
    . "Nicméně tato částka byla nyní uvolněna. Nyní můžete navštívit naši prodejnu". "\n"
                                          . 'a poslat hodnotu e-mailem někomu jinému' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', 'Zakoupené dárkové poukazy mají hodnotu %s' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_BODY', '');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_COUPON_SUBJECT', 'Nákup dárkového poukazu');

//Knoflík
define('BUTTON_CONFIRM_NEW', 'potvrdit');
define('BUTTON_RELEASE_NEW', 'uplatnit');
define('BUTTON_CANCEL_NEW', 'zrušit');
?>