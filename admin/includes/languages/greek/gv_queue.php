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

define('HEADING_TITLE', 'Κουπόνι απελευθέρωσης δελτίων δώρων');

define('TABLE_HEADING_CUSTOMERS', ' πελάτες');
define('TABLE_HEADING_ORDERS_ID', 'Αριθμός παραγγελίας.');
define('TABLE_HEADING_VOUCHER_VALUE', 'Αξία κουπονιού');
define('TABLE_HEADING_DATE_PURCHASED', 'ημερομηνία αγοράς');
define('TABLE_HEADING_ACTION', 'ΔΡΑΣΗ');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Πρόσφατα αγόρασα ένα δελτίο δώρων από το ηλεκτρονικό μας κατάστημα.' . "\n"
                                          . 'Για λόγους ασφαλείας, αυτό δεν έγινε άμεσα διαθέσιμο σε εσάς.' . "\n"
                                          . 'Ωστόσο, το ποσό αυτό έχει πλέον κυκλοφορήσει. Τώρα μπορείτε να επισκεφτείτε το κατάστημά μας' . "\n"
                                          . 'και στείλτε την αξία μέσω ηλεκτρονικού ταχυδρομείου σε κάποιον άλλο' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', 'Το κουπόνι δώρου που αγοράσατε αξίζει %s' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_BODY', '');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_COUPON_SUBJECT', ' Αγορά Δωροεπιταγής  ');
?>