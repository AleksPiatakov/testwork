<?php
/*
  $Id: currencies.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Νομίσματα');

define('TABLE_HEADING_CURRENCY_NAME', 'Νόμισμα');
define('TABLE_HEADING_CURRENCY_CODES', 'Κώδικας');
define('TABLE_HEADING_CURRENCY_VALUE', 'αξία');
define('TABLE_HEADING_ACTION', 'Δράση');

define('TEXT_INFO_EDIT_INTRO', 'Κάντε τις απαραίτητες αλλαγές');
define('TEXT_INFO_CURRENCY_TITLE', 'Τίτλος:');
define('TEXT_INFO_CURRENCY_CODE', 'Κώδικας:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Σύμβολο Αριστερό:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Σύμβολο ΔΕΞΙΟΣ:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Δεκαδικό σημείο:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Χιλιάδες σημεία:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Δεκαδικά ψηφία:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Τελευταία ενημέρωση:');
define('TEXT_INFO_CURRENCY_VALUE', 'Αξία:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Παράδειγμα Εξόδου:');
define('TEXT_INFO_INSERT_INTRO', 'Εισαγάγετε το νέο νόμισμα με τα σχετικά δεδομένα του ');
define('TEXT_INFO_DELETE_INTRO', 'Είστε βέβαιοι ότι θέλετε να διαγράψετε αυτό το νόμισμα?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Νέο νόμισμα?');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Επεξεργασία νομίσματος');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Διαγραφή νομίσματος');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (απαιτεί τη μη αυτόματη ενημέρωση των τιμών νομίσματος)');
define('TEXT_INFO_CURRENCY_UPDATED', 'Η συναλλαγματική ισοτιμία για το% s (% s) ενημερώθηκε επιτυχώς μέσω του%s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Σφάλμα: Το προεπιλεγμένο νόμισμα δεν μπορεί να καταργηθεί. Ορίστε άλλο νόμισμα ως προεπιλογή και δοκιμάστε ξανά.');
define('ERROR_CURRENCY_INVALID', 'Σφάλμα: Η συναλλαγματική ισοτιμία για το% s (% s) δεν ενημερώθηκε μέσω του% s. Είναι έγκυρος κωδικός νομίσματος;');
define('WARNING_PRIMARY_SERVER_FAILED', 'Προειδοποίηση: Ο κεντρικός διακομιστής συναλλαγματικής ισοτιμίας (% s) απέτυχε για το% s (% s) - προσπαθεί ο διακομιστής δευτερεύουσας συναλλαγματικής ισοτιμίας.');
?>
