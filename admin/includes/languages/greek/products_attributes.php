<?php
/*
  $Id: products_attributes.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Επιλογές προϊόντος');
define('HEADING_TITLE_OPT', 'Επιλογές προϊόντος');
define('HEADING_TITLE_VAL', 'Επιλογες');
define('HEADING_TITLE_ATRIB', 'Χαρακτηριστικά προϊόντων');

define('TABLE_HEADING_ID', 'Ταυτότητα');
define('TABLE_HEADING_PRODUCT', 'Ονομα προϊόντος');
define('TABLE_HEADING_OPT_NAME', 'Όνομα επιλογής');

// otf 1.71 New field definitions
define('TABLE_HEADING_OPT_TYPE', 'Tύπος');
define('TABLE_HEADING_OPT_GROUP', 'Ομάδα χαρακτηριστικών');
define('TABLE_HEADING_OPT_LENGTH', 'Εμφάνιση στο φίλτρο');
define('TABLE_HEADING_OPT_COMMENT', 'Εμφάνιση στη λίστα των προϊόντων');

define('TABLE_HEADING_OPT_VALUE', 'Τιμή επιλογής');
define('TABLE_HEADING_OPT_PRICE', 'Τιμή Αξίας');
define('TABLE_HEADING_OPT_PRICE_PREFIX', 'Πρόθεμα');
define('TABLE_HEADING_ACTION', 'Δράση');
define('TABLE_HEADING_DOWNLOAD', 'Προϊόντα προς λήψη:');
define('TABLE_TEXT_FILENAME', 'Ονομα αρχείου:');
define('TABLE_TEXT_MAX_DAYS', 'Ημέρες λήξης:');
define('TABLE_TEXT_MAX_COUNT', 'Μέγιστος αριθμός λήψεων:');

define('MAX_ROW_LISTS_OPTIONS', 10);

define('TEXT_WARNING_OF_DELETE', 'Αυτή η επιλογή έχει προϊόντα και τιμές συνδεδεμένες με αυτήν - δεν είναι ασφαλές να τη διαγράψετε.');
define('TEXT_OK_TO_DELETE', 'Αυτή η επιλογή δεν έχει προϊόντα και τιμές συνδεδεμένες με αυτήν - είναι ασφαλές να τη διαγράψετε.');
define('TEXT_OPTION_ID', 'Αναγνωριστικό ταυτότητα');
define('TEXT_OPTION_NAME', 'Όνομα επιλογής');
define('TEXT_OPTION_SORT_ORDER', 'Σειρά ταξινόμησης:');

define('TEXT_PRAT_DEL', 'Διαγραφή');
define('TEXT_PRAT_COLOR', 'Εικόνα');
define('TEXT_ALERT1', 'Σφάλμα: υπάρχουν προϊόντα (ύψους 0,00%) <b>%d</b>) στην οποία προσδιορίζεται η τιμή αυτού του χαρακτηριστικού');
define('TEXT_ALERT2', 'Αυτό το χαρακτηριστικό έχει συσχετισμένες τιμές (στο ποσό των <b>%d</b>), κατά τη διαγραφή του χαρακτηριστικού, οι τιμές θα διαγραφούν. Είστε βέβαιοι ότι θέλετε να διαγράψετε το χαρακτηριστικό?');

define('TEXT_TYPE_TEXT','Κείμενο');
define('TEXT_TYPE_SELECT','Dropdown');
define('TEXT_TYPE_RADIO','Radio');
define('TEXT_TYPE_CHECKBOX','Checkbox');
define('TEXT_TYPE_TEXTAREA','Image');

define('HEADING_TITLE_GROUP', 'ομάδες χαρακτηριστικών');
define('TEXT_OPTION_GROUP_NAME', 'Όνομα της ομάδας χαρακτηριστικών');
define('TEXT_OPTION_VALUE_NAME','Όνομα τιμής χαρακτηριστικού');
?>