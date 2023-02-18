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

define('HEADING_TITLE', 'Zertifikate aktivieren');

define('TABLE_HEADING_CUSTOMERS', 'Käufer');
define('TABLE_HEADING_ORDERS_ID', 'Auftragsnummer');
define('TABLE_HEADING_VOUCHER_VALUE', 'Zertifikatsumme');
define('TABLE_HEADING_DATE_PURCHASED', 'Kaufdatum');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Sie kaufte das Zertifikat in unserem Online-Shop.' . "\n"
                                        . 'Aus Sicherheitsgründen muss das Zertifikat vom Administrator überprüft werden, bevor es für den Einkauf in unserem Online-Shop verwendet werden kann.' . "\n"
                                        . 'Wir freuen uns, Ihnen mitteilen zu können, dass Ihr Zertifikat vom Administrator verifiziert und aktiviert wurde. Jetzt kannst du' . "\n"
                                         . 'mit Ihrem Zertifikat in unserem Online-Shop einkaufen, oder Sie können Ihr Zertifikat an andere Personen spenden. ' . "\n\n");
define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', 'Zertifikat für den Betrag von %s' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_BODY', '');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_COUPON_SUBJECT', 'Ihr Zertifikat wird bestätigt und aktiviert!');

//Button
define('BUTTON_CONFIRM_NEW', 'bestätigen');
define('BUTTON_RELEASE_NEW', 'einlösen');
define('BUTTON_CANCEL_NEW', 'stornieren');
?>