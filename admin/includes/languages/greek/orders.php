<?php
/*
  $Id: orders.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Παραγγελίες');
define('HEADING_TITLE_SEARCH', 'Αριθμός Παραγγελίας:');
define('HEADING_TITLE_STATUS', 'Κατάσταση:');

define('TABLE_HEADING_COMMENTS', 'Σχόλια');
define('TABLE_HEADING_CUSTOMERS', 'Οι πελάτες');
define('TABLE_HEADING_ORDER_TOTAL', ' Σύνολο Παραγγελίας ');
define('TABLE_HEADING_DATE_PURCHASED', 'Ημερομηνία αγοράς');
define('TABLE_HEADING_STATUS', 'Κατάσταση');
define('TABLE_HEADING_ACTION', 'Δράση');
define('TABLE_HEADING_QUANTITY', 'Ποσότητα.');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Μοντέλο');
define('TABLE_HEADING_PRODUCTS', 'Προϊόντα');
define('TABLE_HEADING_TAX', 'Φόρος');
define('TABLE_HEADING_TOTAL', 'Σύνολο');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Τιμή (ex)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Τιμη (inc)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Συνολο (ex)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'συνολο (inc)');
define('TEXT_NEW_CUSTOMER', 'Νέος πελάτης');
define('TEXT_EXIST_CUSTOMER', 'Υπάρχει πελάτης');

define('TABLE_HEADING_DATE_ADDED', 'Ημερομηνία προστέθηκε');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Ο πελάτης ειδοποιήθηκε');
define('ENTRY_NOTIFY_CUSTOMER_EMAIL', 'Ειδοποιήστε τον πελάτη μέσω ηλεκτρονικού ταχυδρομείου; ');

define('ENTRY_CUSTOMER', 'Ο πελάτης :');
define('ENTRY_SOLD_TO', 'Πουληθηκε σε:');
define('ENTRY_DELIVERY_TO', 'Παράδοση σε:');
define('ENTRY_SHIP_TO', 'ΑΠΟΣΤΟΛΗ ΠΡΟΣ:');
define('ENTRY_SHIPPING_ADDRESS', 'Διεύθυνση αποστολής:');
define('ENTRY_BILLING_ADDRESS', 'διεύθυνση χρέωσης:');
define('ENTRY_PAYMENT_METHOD', 'Μέθοδος πληρωμής:');
define('ENTRY_CREDIT_CARD_TYPE', 'Τύπος πιστωτικής κάρτας:');
define('ENTRY_CREDIT_CARD_OWNER', 'Ιδιοκτήτης πιστωτικής κάρτας:');
define('ENTRY_CREDIT_CARD_NUMBER', 'αριθμός πιστωτικής κάρτας:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Η πιστωτική κάρτα λήγει:');
define('ENTRY_SUB_TOTAL', 'ΜΕΡΙΚΟ ΣΥΝΟΛΟ:');
define('ENTRY_TAX', 'Tax:');
define('ENTRY_SHIPPING', 'Αποστολή:');
define('ENTRY_TOTAL', 'Σύνολο:');
define('ENTRY_DATE_PURCHASED', 'ημερομηνία αγοράς:');
define('ENTRY_STATUS', 'Status:');
define('ENTRY_DATE_LAST_UPDATED', 'Ημερομηνία Τελευταία Ενημέρωση:');
define('ENTRY_NOTIFY_CUSTOMER', 'Ειδοποιήστε τον Πελάτη:');
define('ENTRY_NOTIFY_COMMENTS', 'Προσθήκη σχολίων:');
define('ENTRY_PRINTABLE', 'Εκτύπωση τιμολογίου');

define('TEXT_INFO_HEADING_DELETE_ORDER', ' Διαγραφή παραγγελίας ');
define('TEXT_INFO_DELETE_INTRO', ' Είστε βέβαιοι ότι θέλετε να διαγράψετε αυτή τη σειρά; ');
define('TEXT_INFO_DELETE_DATA', ' Όνομα Πελάτη ');
define('TEXT_INFO_DELETE_DATA_OID', ' Αριθμός παραγγελίας ');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', ' Επαναφορά ποσότητας προϊόντος ');
define('TEXT_DATE_ORDER_CREATED', ' Ημερομηνία δημιουργίας: ');
define('TEXT_DATE_ORDER_LAST_MODIFIED', ' Τελευταία τροποποίηση: ');
define('TEXT_INFO_PAYMENT_METHOD', ' Μέθοδος πληρωμής: ');

define('TEXT_ALL_ORDERS', ' Όλες οι παραγγελίες ');
define('TEXT_NO_ORDER_HISTORY', 'Δεν υπάρχει διαθέσιμο ιστορικό παραγγελιών');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', ' Ενημέρωση Παραγγελίας ');
define('EMAIL_TEXT_ORDER_NUMBER', ' Αριθμός παραγγελίας: ');
define('EMAIL_TEXT_INVOICE_URL', ' Λεπτομερές Τιμολόγιο: ');
define('EMAIL_TEXT_DATE_ORDERED', ' Ημερομηνία παραγγελίας: ');
define('EMAIL_TEXT_STATUS_UPDATE', ' Η παραγγελία σας έχει ενημερωθεί με την ακόλουθη κατάσταση. ' . "\n\n" . 'Νέα κατάσταση:%s' . "\n\n" . 'Παρακαλώ απαντήστε σε αυτό το μήνυμα ηλεκτρονικού ταχυδρομείου αν έχετε ερωτήσεις.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Τα σχόλια για την παραγγελία σας είναι');

define('ERROR_ORDER_DOES_NOT_EXIST', 'Σφάλμα: Η εντολή δεν υπάρχει. ');
define('SUCCESS_ORDER_UPDATED', 'Επιτυχία: Η παραγγελία ενημερώθηκε με επιτυχία. ');
define('WARNING_ORDER_NOT_UPDATED', 'Προειδοποίηση: Τίποτα δεν αλλάζει. Η παραγγελία δεν ενημερώθηκε. ');
// denuz
define('TABLE_HEADING_ORDER_NETTO', 'Νετο');
define('TABLE_HEADING_ORDER_NUMBER', 'Αριθμός');
define('TABLE_HEADING_ORDER_MARJA', 'Περιθώριο');
define('TITLE_ORDER_NETTO', 'Νετο:');
define('TITLE_ORDER_MARJA', 'Περιθώριο:');
define('TEXT_TOTAL', 'Συνολο: ');
define('TEXT_NETTO', 'Νετο: ');
define('TEXT_MARJA', 'Περιθώριο: ');
// eof denuz
define('EMAIL_TEXT_CUSTOMER_NAME', ' Πελάτης: ');
define('EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS', 'Διευθηνση email:');
define('EMAIL_TEXT_CUSTOMER_TELEPHONE', 'Τηλέφωνο:');
define('EMAIL_ACC_DISCOUNT_INTRO_OWNER', 'Ένας από τους πελάτες σας φτάνει το συσσωρευμένο όριο έκπτωσης. ' . "\n\n" . 'Λεπτομέριες:');
define('EMAIL_TEXT_LIMIT', 'Συσσωρευμένη έκπτωση: ');
define('EMAIL_TEXT_CURRENT_GROUP', 'Νέα ομάδα: ');
define('EMAIL_TEXT_DISCOUNT', 'Έκπτωση: ');
define('EMAIL_ACC_SUBJECT', 'Συσσωρευμένη έκπτωση');
define('EMAIL_ACC_INTRO_CUSTOMER', 'Συγχαρητήρια, έχετε νέα έκπτωση. Όλες οι λεπτομέρειες παρακάτω:');
define('EMAIL_ACC_FOOTER', 'Τώρα μπορείτε να αγοράσετε με το νέο σας έκπτωση.');

define('TEXT_REFERER', 'Αναφέρετε: ');
define('TEXT_ORDER_DELETE', 'Διαγραφή παραγγελιών: ');

define('TEXT_OR_NAL', 'Μετρητά');
define('TEXT_OR_BNAL', 'Τράπεζα');
define('TEXT_OR_PRIVAT', 'Αλλος τροπος');
define('TEXT_OR_NALOZH', 'Μετρητά στην παράδωση.');
define('TEXT_OR_FROM', 'από');
define('TEXT_OR_TO', 'σε');
define('TEXT_OR_CLEAR', 'καθαρίστε το φίλτρο');
define('TEXT_OR_TOTAL', 'Σύνολο');
define('TEXT_OR_DATE', 'Ημερομηνία παράδοσης');
define('TEXT_OR_COURIER', 'Κούριερ');
define('TEXT_OR_STATUS', ' Κατάσταση ');
define('TEXT_OR_PAYMENT', ' Μέθοδος πληρωμής ');
define('TEXT_OR_ACTION', ' Ενέργεια ');
define('ENTRY_CUSTOMERS', ' Πελάτης: ');
define('ENTRY_DELIVERY', ' Διεύθυνση: ');
define('ENTRY_INFO', ' Πληροφορίες: ');
define('ENTRY_CREATE_ORDER', ' Δημιουργία παραγγελίας ');

//new orders
define('TEXT_NEW_ORDER', 'Νέα παραγγελία');
define('TEXT_SELECT_CUST', 'Επιλέξτε πελάτη');
define('TEXT_SELECT_CUST_PLACEHOLDER', 'Εισαγάγετε αναγνωριστικό ή όνομα ή επώνυμο');
define('TEXT_ADDRESS_BOOK', 'Address book');
define('TEXT_FIRST_NAME', 'Ονομα');
define('TEXT_LAST_NAME', 'Επίθετο');
define('TEXT_GROUPS_NAME', 'Ονομα ομάδας');
define('TEXT_EMAIL', 'Email');
define('TEXT_PHONE', 'Τηλέφωνο');
define('TEXT_FAX', 'Fax');
define('TEXT_FIRM', 'Ονομα εταιρείας');
define('TEXT_ADDRESS', 'Διεύθυνση');
define('TEXT_SUBURB', 'Περιοχή');
define('TEXT_POSTCODE', 'Index');
define('TEXT_CITY', 'Πόλη');
define('TEXT_ZONE', 'Περιοχή');
define('TEXT_COUNTRY', 'Χώρα');
define('TEXT_OP_PRICE', 'Τιμή');
define('TEXT_OP_TAX', 'Φόρος');
define('TEXT_OP_SHIPPING', 'Αποστολή');
define('TEXT_OP_TOTAL', 'Συνολικό ποσό');
define('TEXT_EDIT_ORDER', 'Επεξεργασία παραγγελίας');
define('TEXT_CURRENCY', 'Νόμισμα:');
    define('TEXT_CURRENCY_VALUE', 'Τιμή');
define('ENTRY_BILLING', 'Χρέωση:');
