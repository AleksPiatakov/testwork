<?php
/*
  $Id: edit_orders.php,v 1.72 2003/08/07 00:28:44 jwh Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  
  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Επεξεργασία παραγγελίας');
define('HEADING_TITLE_NUMBER', 'No.');
define('HEADING_TITLE_DATE', 'of');
define('HEADING_SUBTITLE', 'Παρακαλούμε να επεξεργαστείτε όλα τα μέρη όπως θέλετε και κάντε κλικ στο κουμπί" Ενημέρωση "παρακάτω.');
define('HEADING_TITLE_SEARCH', 'Αριθμός Παραγγελίας:');
define('HEADING_TITLE_STATUS', 'Κατάσταση:');
define('ADDING_TITLE', 'Προσθέστε ένα προϊόν σε αυτήν την παραγγελία');

define('HINT_UPDATE_TO_CC', '<font color="#FF0000">Hint: </γραμματοσειρά> Ορίστε την πληρωμή στην "Πιστωτική Κάρτα" για να εμφανίσετε ορισμένα επιπλέον πεδία.');
define('HINT_DELETE_POSITION', '<font color="#FF0000">Hint: </font>Για να διαγράψετε ένα προϊόν, ορίστε την ποσότητα του σε "0".');
define('HINT_TOTALS', '<font color="#FF0000">Hint: </font>Fελεύθερο για να δώσετε εκπτώσεις προσθέτοντας αρνητικά ποσά στη λίστα <br> <br> Τα πεδία με τιμές "0" διαγράφονται κατά την ενημέρωση της παραγγελίας (εξαίρεση: αποστολή).');
define('HINT_PRESS_UPDATE', 'Κάντε κλικ στο "Ενημέρωση" για να αποθηκεύσετε όλες τις αλλαγές που έγιναν παραπάνω.');

define('TABLE_HEADING_COMMENTS', 'Σχόλιο');
define('TABLE_HEADING_CUSTOMERS', 'Οι πελάτες');
define('TABLE_HEADING_ORDER_TOTAL', 'Παραγγελίες συνολικά');
define('TABLE_HEADING_DATE_PURCHASED', 'Ημερομηνία παραγγελίας');
define('TABLE_HEADING_DELETE', 'Delete');
define('TABLE_HEADING_STATUS', 'Νέα κατάσταση');
define('TABLE_HEADING_ACTION', 'δραση');
define('TABLE_HEADING_QUANTITY', 'Ποσοτητα');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Μοντέλο');
define('TABLE_HEADING_PRODUCTS', 'Προϊόν');
define('TABLE_HEADING_TAX', 'Φόρος%');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_UNIT_PRICE', 'Τιμή (εκτός μαλλον καθαρή )');
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Τιμή (πληρης μαλλον .)');
define('TABLE_HEADING_TOTAL_PRICE', 'Σύνολο (excl.)');
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Σύνολο(incl.)');
define('TABLE_HEADING_TOTAL_MODULE', 'Σύνολο αξίας');
define('TABLE_HEADING_TOTAL_AMOUNT', 'Ποσό');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Ο πελάτης ειδοποιήθηκε');
define('TABLE_HEADING_DATE_ADDED', 'Ημερομηνία εισαγωγής');

define('ENTRY_CUSTOMER', 'Πελάτης');
define('ENTRY_CUSTOMER_NAME', 'Ονομα');
define('ENTRY_CUSTOMER_COMPANY', 'Company');
define('ENTRY_CUSTOMER_ADDRESS', 'Διεύθυνση Πελατη');
define('ENTRY_SEARCH_CLIENT', 'Αναζήτηση με όνομα, επώνυμο ή αναγνωριστικό πελάτη.');
define('ENTRY_ADDRESS', 'Διεύθυνση');
define('ENTRY_CUSTOMER_SUBURB', 'Προάστιο');
define('ENTRY_CUSTOMER_CITY', 'Πολη');
define('ENTRY_CUSTOMER_STATE', 'State');
define('ENTRY_CUSTOMER_POSTCODE', 'ΤΑΧΥΔΡΟΜΙΚΟΣ ΚΩΔΙΚΟΣ');
define('ENTRY_CUSTOMER_COUNTRY', 'Country');
define('ENTRY_CUSTOMER_PHONE', 'Phone');
define('ENTRY_CUSTOMER_FAX', 'Fax');
define('ENTRY_CUSTOMER_EMAIL', 'E-Mail');

define('ENTRY_SOLD_TO', 'Sold to:');
define('ENTRY_DELIVERY_TO', 'Delivery to:');
define('ENTRY_SHIP_TO', 'Shipping to:');
define('ENTRY_SHIPPING_ADDRESS', 'Shipping Address');
define('ENTRY_BILLING_ADDRESS', 'Billing Address');
define('ENTRY_PAYMENT_METHOD', 'Payment Method:');
define('ENTRY_CREDIT_CARD_TYPE', 'Card Type:');
define('ENTRY_CREDIT_CARD_OWNER', 'Card Owner:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Card Number:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Card Expires:');
define('ENTRY_SUB_TOTAL', 'Sub Total:');
define('ENTRY_TAX', 'Tax:');
define('ENTRY_SHIPPING', 'Shipping:');
define('ENTRY_TOTAL', 'Total:');
define('ENTRY_NEW_TOTAL', 'Add field:');
define('ENTRY_DATE_PURCHASED', 'Date Purchased:');
define('ENTRY_STATUS', 'Order Status:');
define('ENTRY_DATE_LAST_UPDATED', 'last updated:');
define('ENTRY_NOTIFY_CUSTOMER', 'Notify customer:');
define('ENTRY_NOTIFY_COMMENTS', 'Send comments:');
define('ENTRY_PRINTABLE', 'Print Invoice');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Delete Order');
define('TEXT_INFO_DELETE_INTRO', 'Shall this order really be deleted?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Adjust Quantity');
define('TEXT_DATE_ORDER_CREATED', 'Created:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Last Update:');
define('TEXT_DATE_ORDER_ADDNEW', 'Add New Product');
define('TEXT_INFO_PAYMENT_METHOD', 'Payment Method:');

define('TEXT_ALL_ORDERS', 'All Orders');
define('TEXT_NO_ORDER_HISTORY', 'No order found');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Your order has been updated');
define('EMAIL_TEXT_ORDER_NUMBER', 'Order number:');
define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice URL:');
define('EMAIL_TEXT_DATE_ORDERED', 'Order date:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Thank you so much for your order with us!' . "\n\n" . 'The status of your order has been updated.' . "\n\n" . 'New status: %s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', 'If you have questions, please reply to this email.' . "\n\n" . 'With warm regards from your friends at the ' . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Here are the comments for your order:' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Error: No such order.');
define('SUCCESS_ORDER_UPDATED', 'Completed: Order has been successfully updated.');
define('WARNING_ORDER_NOT_UPDATED', 'Attention: No changes have been made.');

define('ADDPRODUCT_TEXT_CATEGORY_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_PRODUCT', 'Choose a product');
define('ADDPRODUCT_TEXT_PRODUCT_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_OPTIONS', 'Choose an option');
define('ADDPRODUCT_TEXT_OPTIONS_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_OPTIONS_NOTEXIST', 'Product has no options, so skipping...');
define('ADDPRODUCT_TEXT_CONFIRM_QUANTITY', 'pieces of this product');
define('ADDPRODUCT_TEXT_CONFIRM_ADDNOW', 'Add');
define('ADDPRODUCT_TEXT_STEP', 'Step');
define('ADDPRODUCT_TEXT_STEP1', ' &laquo; Choose a catalogue. ');
define('ADDPRODUCT_TEXT_STEP2', ' &laquo; Choose a product. ');
define('ADDPRODUCT_TEXT_STEP3', ' &laquo; Choose an option. ');

define('MENUE_TITLE_CUSTOMER', '1. Customer Data');
define('MENUE_TITLE_PAYMENT', '2. Payment Method');
define('MENUE_TITLE_ORDER', '3. Ordered Products');
define('MENUE_TITLE_TOTAL', '4. Discount, Shipping and Total');
define('MENUE_TITLE_STATUS', '5. Status and Notification');
define('MENUE_TITLE_UPDATE', '6. Update Data');

define('EMAIL_ACC_DISCOUNT_INTRO_OWNER', 'One of your customers reach accumulated discount limit. ' . "\n\n" . 'Details:');
define('EMAIL_TEXT_LIMIT', 'Accumulated discount: ');
define('EMAIL_TEXT_CURRENT_GROUP', 'New group: ');
define('EMAIL_TEXT_DISCOUNT', 'Discount: ');
define('EMAIL_ACC_SUBJECT', 'Accumalated discount');
define('EMAIL_ACC_INTRO_CUSTOMER', 'Congratulations, you have new discount. All details below:');
define('EMAIL_ACC_FOOTER', 'Now you can buy with your new discount rate.');

define('EMAIL_TEXT_CUSTOMER_NAME', 'Customer:');
define('EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS', 'Email:');
define('EMAIL_TEXT_CUSTOMER_TELEPHONE', 'Phone:');

define('TEXT_ORDER_COMMENTS', 'Order comments');

?>