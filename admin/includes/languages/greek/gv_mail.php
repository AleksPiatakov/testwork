<?php
/*
  $Id: gv_mail.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Αποστολή δελτίου δώρων στους πελάτες');

define('TEXT_CUSTOMER', 'Πελάτης:');
define('TEXT_SUBJECT', 'Θέμα:');
define('TEXT_FROM', 'ΑΠΟ:');
define('TEXT_TO', 'Email ΠΡΟΣ:');
define('TEXT_AMOUNT', 'Ποσό');
define('TEXT_MESSAGE', 'MΗΝΥΜΑ:');
define('TEXT_SINGLE_EMAIL', '<span class="smallText">Χρησιμοποιήστε αυτό για την αποστολή μεμονωμένων μηνυμάτων ηλεκτρονικού ταχυδρομείου, διαφορετικά χρησιμοποιήστε το αναπτυσσόμενο μενού πιο πάνω</span>');
define('TEXT_SELECT_CUSTOMER', 'Επιλέξτε Πελάτη');
define('TEXT_ALL_CUSTOMERS', 'Επιλέξτε ολους Πελάτες');
define('TEXT_NEWSLETTER_CUSTOMERS', 'Για όλους τους συνδρομητές Newsletter');

define('NOTICE_EMAIL_SENT_TO', 'Σημείωση: Το ηλεκτρονικό ταχυδρομείο στάλθηκε στο: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Σφάλμα: Δεν έχει επιλεγεί πελάτης.');
define('ERROR_NO_AMOUNT_SELECTED', 'Σφάλμα: Δεν έχει επιλεγεί ποσό.');

define('TEXT_GV_WORTH', 'Το κουπόνι δώρων αξίζει');
define('TEXT_TO_REDEEM', 'Για να εξαργυρώσετε αυτό το Κουπόνι δώρων, κάντε κλικ στον παρακάτω σύνδεσμο. Καταχωρίστε επίσης τον κωδικό εξαργύρωσης');
define('TEXT_WHICH_IS', 'το οποίο είναι');
define('TEXT_IN_CASE', '');
define('TEXT_OR_VISIT', 'ή επισκεφθείτε το κατάστημά μας ');
define('TEXT_ENTER_CODE', ' Μπορείτε να χρησιμοποιήσετε τη Δωροεπιταγή σας στη διαδικασία πληρωμής.');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Πρόσφατα αγόρασα μια Δωροεπιταγή από τον ιστότοπό σας, για λόγους ασφαλείας, το ποσό της δωροεπιταγής δεν σας πιστώθηκε αμέσως. Ο Διαχειρηστής του καταστήματος έχει κυκλοφορήσει τώρα αυτό το ποσό.');
define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . 'Η αξία της Δωροεπιταγής ήταν %s');
define('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . 'Τώρα μπορείτε να επισκεφτείτε τον ιστότοπό μας, να συνδεθείτε και να στείλετε το ποσό της Δωροεπιταγής σε οποιονδήποτε θέλετε.');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");

?>