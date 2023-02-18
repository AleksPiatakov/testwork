<?php
/*
  $Id: orders_status.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Παραγγελίες Κατάσταση ');

define('TABLE_HEADING_ORDERS_STATUS', 'Παραγγελίες Κατάσταση ');
define('TABLE_HEADING_ORDER_STATUS_TEXT','Κείμενο κατάστασης παραγγελίας');
define('TABLE_HEADING_DEFAULT', 'Προκαθορισμένο');
define('TABLE_HEADING_ACTION', 'Δράση');
define('TABLE_HEADING_COLOR', 'χρωμα');
define ('TABLE_HEADING_STATUS_SHOW', 'Εμφάνιση στην αρχική σελίδα admin');

define('TEXT_INFO_EDIT_INTRO', 'Κάντε τις απαραίτητες αλλαγές');
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Κατάσταση παραγγελιών:');
define('TEXT_INFO_INSERT_INTRO', 'Καταχωρίστε την κατάσταση των νέων παραγγελιών με τα σχετικά δεδομένα');
define('TEXT_INFO_DELETE_INTRO', 'Είστε βέβαιοι ότι θέλετε να διαγράψετε την κατάσταση αυτής της παραγγελίας?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'Κατάσταση νέων παραγγελιών');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Επεξεργασία κατάστασης παραγγελιών ');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Διαγραφή κατάστασης παραγγελιών');

define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Σφάλμα: Δεν είναι δυνατή η κατάργηση της προεπιλεγμένης κατάστασης παραγγελίας. Ρυθμίστε την κατάσταση άλλης παραγγελίας ως προεπιλογή και δοκιμάστε ξανά.');
define('ERROR_STATUS_USED_IN_ORDERS', 'Σφάλμα: Αυτή η κατάσταση παραγγελίας χρησιμοποιείται αυτή τη στιγμή στις παραγγελίες.');
define('ERROR_STATUS_USED_IN_HISTORY', 'Σφάλμα: Αυτή η κατάσταση παραγγελίας χρησιμοποιείται αυτή τη στιγμή στο ιστορικό κατάστασης παραγγελιών.');


define('ERROR_ORDER_STATUS_IS_DEFAULT', 'Δεν μπορείτε να διαγράψετε την προεπιλεγμένη κατάσταση παραγγελίας');
define('TABLE_HEADING_DOWNLOADS', 'Να επιτρέπεται η λήψη ηλεκτρονικών προϊόντων');