<?php
/*
  $Id: customers.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Οι πελάτες');
define('HEADING_FORM_TITLE', 'Οι πελάτης');
define('HEADING_TITLE_SEARCH', 'Αναζήτηση:');

//TotalB2B start
define('TABLE_HEADING_CUSTOMERS_STATUS', 'Κατάσταση');
define('TABLE_HEADING_CUSTOMERS_GROUP', 'Ομάδα');
define('TABLE_HEADING_CUSTOMERS_DISCOUNT', 'Προσωπική έκπτωση');
define('ENTRY_CUSTOMERS_DISCOUNT', 'Προσωπική έκπτωση:');
define('ENTRY_CUSTOMERS_GROUPS_NAME', 'Ομάδα:');

// add for SPPC shipment and payment module start 
define('ENTRY_CUSTOMERS_PAYMENT_SET', 'Ρύθμιση ενοτήτων πληρωμής για τον πελάτη');
define('ENTRY_CUSTOMERS_PAYMENT_DEFAULT', 'Χρήση ρυθμίσεων από ομάδα ή διαμόρφωση').
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN', 'Εάν επιλέξετε <b> <i> Ορισμός ενοτήτων πληρωμής για τον πελάτη </ i> </ b> αλλά δεν ελέγχετε κανένα από τα πλαίσια, θα χρησιμοποιηθούν οι προεπιλεγμένες ρυθμίσεις (ρυθμίσεις ομάδας ή διαμόρφωση).');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN2', '<i>Ελέγξτε τις ενότητες πληρωμής που επιτρέπονται </ i> <b> <font color = "red"></font></b>.');

define('ENTRY_CUSTOMERS_SHIPPING_SET', 'Ορίστε τις μονάδες αποστολής για τον πελάτη');
define('ENTRY_CUSTOMERS_SHIPPING_DEFAULT', 'Χρήση ρυθμίσεων από ομάδα ή διαμόρφωση').
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN', 'Εάν επιλέξετε <b> <i> Ορισμός ενοτήτων αποστολής για τον πελάτη </ i> </ b>, αλλά δεν ελέγχετε κανένα από τα πλαίσια, οι προεπιλεγμένες ρυθμίσεις (ρυθμίσεις ομάδας ή διαμόρφωση).');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN2', '<i>Ελέγξτε τα moduls αποστολής που επιτρέπονται </ i> <b> <font color = "red"></font></b>.');
// add for SPPC shipment and payment module end

//TotalB2B end


define('TABLE_HEADING_FIRSTNAME', 'ONOMA');
define('TABLE_HEADING_LASTNAME', 'Επίθετο');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Δημιουργήθηκε λογαριασμός');
define('TABLE_HEADING_ACTION', 'ΔΡΑΣΗ');

define('TEXT_DATE_ACCOUNT_CREATED', 'Δημιουργήθηκε Ο λογαριασμός:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Τελευταία τροποποίηση:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Τελευταία σύνδεση:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Αριθμός συνδέσεων:');
define('TEXT_INFO_COUNTRY', 'ΧΩΡΑ:');
define('TEXT_DELETE_INTRO', 'Είστε βέβαιοι ότι θέλετε να διαγράψετε αυτόν τον πελάτη; ');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Διαγραφή πελάτη');
define('TYPE_BELOW', 'Πληκτρολογήστε παρακάτω');
define('PLEASE_SELECT', 'Παρακαλώ επιλέξτε');

define('NO_PERSONAL_DISCOUNT', 'ΝΟΥΜΕΡΟ');
define('TEXT_PERCENT', '%');
define('TEXT_GROUP', '<br>Εκπτωση: ');
define('TEXT_HELP_HEADING', '');
define('TEXT_HELP_TEXT', '');

define('TEXT_CUST_STATUS_CHANGED', 'Η κατάσταση σας άλλαξε');
define('TEXT_CUST_HELLO', 'Χαίρετε');
define('TEXT_CUST_STATUS_CHANGED_FROM', 'Η κατάστασή σας άλλαξε από');
define('TEXT_CUST_STATUS_CHANGED_TO', 'ΣΕ');
define('TEXT_CUST_STATUS_THX', 'Με εκτίμηση, η διαχείριση του καταστήματος ');

define('TEXT_CUST_NOTIFY', 'Ειδοποιήστε τον πελάτη');
define('TEXT_CUST_XLS', 'download xls');
define('TEXT_CUST_PERPAGE', 'Πελάτες / σελίδα');
define('TEXT_CUST_SUM', 'Σύνολο');
define('TEXT_CUST_CITY', 'πολη');
define('TEXT_CUST_ALL', 'ολα');

define('TEXT_CUST_XLS', 'Λίστα τιμών');
define('TEXT_CUST_XLS_MODEL', 'ταυτότητα');
define('TEXT_CUST_XLS_NAME', 'Ονομα');
define('TEXT_CUST_XLS_LASTNAME', 'Επίθετο');
define('TEXT_CUST_XLS_CITY', 'Πόλη');
define('TEXT_CUST_XLS_PHONE', 'Τηλέφωνο');
define('TEXT_CUST_XLS_EMAIL', 'e-mail');
define('TEXT_CUST_XLS_ORDERS', 'Παραγγελίες');
define('TEXT_CUST_XLS_GROUP', 'Ομάδα');
define('TEXT_CUST_XLS_DATE', 'Εγραφή πραγματοποιήθηκε');

define('CHECK_NOTIFY_CUSTOMER', 'Notify customer');

// view address_book
define('AD_CHOOSE_ADDRESS', 'Διεύθυνση');
define('AD_CUSTOMERS_MAIN_INFO', 'Basic data');
define('AD_ORDER', 'Order');
define('AD_BOOK', 'Address Book');
define('AD_DEL', 'This is the address of the cabinet owner (you can not delete the default)');
define('AD_BY_DEFAULT', 'Set as default');
define('AD_WANT_TO_DEL', 'If you want to delete this address, press');
define('AD_SURE', 'Are you sure?');
define('AD_LIST', 'Address book list');
define('AD_DEFAULT', '(Default)');
define('AD_SUBSCRIBE', 'Subscriptions');
define('AD_CHANGE_PASSWORD', 'Change Password');
define('AD_NEW_PASSWORD', 'New password');
define('AD_CONFIRM_PASSWORD', 'Confirmation');

//Error form
define('ERROR_NEW_PASSWORD_MIN_LENGTH', 'Το ελάχιστο μήκος του κωδικού είναι ίσο με %s');
define('ERROR_CONFIRM_PASSWORD_EQUAL', 'Οι κωδικοί πρόσβασης πρέπει να είναι ίσοι');

define('CUSTOMERS_STREET_ADDRESS', 'Address');
define('CUSTOMERS_FAX', 'Fax');
define('CUSTOMERS_BIRTHDAY', 'Date of birth');

define('SUBTITLE_PERSONAL', 'προσωπικός');
define('SUBTITLE_COMPANY', 'Εταιρία');
define('SUBTITLE_ADDRESS', 'διεύθυνση');
define('SUBTITLE_FOR_CONTACT', 'Για επαφή
');
define('SUBTITLE_SUBSCRIBE', 'Newsletter');
define('SUBTITLE_POSTCODE', 'Post Code');

define('MAIL_TO', 'Send');
define('MAIL_FROM', 'From');
define('MAIL_SUBJECT', 'Theme');
define('MAIL_MESSAGE', 'Message');
define('MAIL_ALL_CUSTOMERS', 'All clients');
define('MAIL_ALL_SUBSCRIBER', 'All customers to subscribers');

define('BUTTON_YES', 'nαί');
define('BUTTON_NO', 'δεν');
?>
