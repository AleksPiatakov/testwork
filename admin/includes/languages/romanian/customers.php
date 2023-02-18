<?php
/*
  $Id: customers.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Customers');
define('HEADING_FORM_TITLE', 'Customer');
define('HEADING_TITLE_SEARCH', 'Search:');

//TotalB2B start
define('TABLE_HEADING_CUSTOMERS_STATUS', 'Status');
define('TABLE_HEADING_CUSTOMERS_GROUP', 'Group');
define('TABLE_HEADING_CUSTOMERS_DISCOUNT', 'Personal discount');
define('ENTRY_CUSTOMERS_DISCOUNT', 'Reducere personală:');
define('ENTRY_CUSTOMERS_GROUPS_NAME', 'Grup:');

// add for SPPC shipment and payment module start 
define('ENTRY_CUSTOMERS_PAYMENT_SET', 'Set payment modules for the customer');
define('ENTRY_CUSTOMERS_PAYMENT_DEFAULT', 'Use settings from Group or Configuration');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN', 'If you choose <b><i>Set payment modules for the customer</i></b> but do not check any of the boxes, default settings (Group settings or Configuration) will still be used.');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN2', '<i>Check the payment modules which are </i><b><font color="red">permited</font></b>.');

define('ENTRY_CUSTOMERS_SHIPPING_SET', 'Set shipping modules for the customer');
define('ENTRY_CUSTOMERS_SHIPPING_DEFAULT', 'Use settings from Group or Configuration');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN', 'If you choose <b><i>Set shipping modules for the customer</i></b> but do not check any of the boxes, default settings (Group settings or Configuration) will still be used.');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN2', '<i>Check the shipping modules which are </i><b><font color="red">permited</font></b>.');
// add for SPPC shipment and payment module end

//TotalB2B end


define('TABLE_HEADING_FIRSTNAME', 'First Name');
define('TABLE_HEADING_LASTNAME', 'Last Name');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Account Created');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_DATE_ACCOUNT_CREATED', 'Account Created:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Last Modified:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Last Logon:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Number of Logons:');
define('TEXT_INFO_COUNTRY', 'Country:');
define('TEXT_DELETE_INTRO', 'Are you sure you want to delete this customer?');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Delete Customer');
define('TYPE_BELOW', 'Type below');
define('PLEASE_SELECT', 'Please select');

define('NO_PERSONAL_DISCOUNT', 'No');
define('TEXT_PERCENT', '%');
define('TEXT_GROUP', '<br>Discount: ');
define('TEXT_HELP_HEADING', '');
define('TEXT_HELP_TEXT', '');

define('TEXT_CUST_STATUS_CHANGED', 'Your status was changed');
define('TEXT_CUST_HELLO', 'Hello');
define('TEXT_CUST_STATUS_CHANGED_FROM', 'Your status was changed from');
define('TEXT_CUST_STATUS_CHANGED_TO', 'to');
define('TEXT_CUST_STATUS_THX', 'Sincerely, administration of store ');

define('TEXT_CUST_NOTIFY', 'Notify customer');
define('TEXT_CUST_XLS', 'download xls');
define('TEXT_CUST_PERPAGE', 'Customers/page');
define('TEXT_CUST_SUM', 'Total');
define('TEXT_CUST_CITY', 'City');
define('TEXT_CUST_ALL', 'All');

define('TEXT_CUST_XLS', 'Price list');
define('TEXT_CUST_XLS_MODEL', 'id');
define('TEXT_CUST_XLS_NAME', 'Name');
define('TEXT_CUST_XLS_LASTNAME', 'Last name');
define('TEXT_CUST_XLS_CITY', 'City');
define('TEXT_CUST_XLS_PHONE', 'Phone');
define('TEXT_CUST_XLS_EMAIL', 'e-mail');
define('TEXT_CUST_XLS_ORDERS', 'Orders');
define('TEXT_CUST_XLS_GROUP', 'Group');
define('TEXT_CUST_XLS_DATE', 'Registered');

//Button
define('BUTTON_CANCEL_NEW', 'cancel');
define('BUTTON_EDIT_NEW', 'edit');
define('BUTTON_UNLOCK_NEW', 'unlock');
define('BUTTON_PREVIEW_NEW', 'preview');
define('BUTTON_BACK_NEW', 'back');
define('BUTTON_NEWSLETTER_NEW', 'newsletter');
define('BUTTON_DELETE_NEW', 'delete');
define('BUTTON_LOCK_NEW', 'lock');
define('BUTTON_SEND_NEW', 'send');
define('BUTTON_INSERT_NEW', 'insert');
define('BUTTON_RESET_NEW', 'reset');
define('BUTTON_ORDERS_NEW', 'orders');
define('BUTTON_EMAIL_NEW', 'email');
define('BUTTON_YES', 'da');
define('BUTTON_NO', 'nu');

define('CHECK_NOTIFY_CUSTOMER', 'Notify customer');

// view address_book
define('AD_CHOOSE_ADDRESS', 'Abordare');
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
define('ERROR_NEW_PASSWORD_MIN_LENGTH', 'Lungimea minimă a parolei este egală cu %s');
define('ERROR_CONFIRM_PASSWORD_EQUAL', 'Parolele trebuie să fie egale');

define('CUSTOMERS_STREET_ADDRESS', 'Address');
define('CUSTOMERS_FAX', 'Fax');
define('CUSTOMERS_BIRTHDAY', 'Date of birth');

define('SUBTITLE_PERSONAL', 'Personal');
define('SUBTITLE_COMPANY', 'Company');
define('SUBTITLE_ADDRESS', 'Address');
define('SUBTITLE_FOR_CONTACT', 'For contact');
define('SUBTITLE_SUBSCRIBE', 'Newsletter');
define('SUBTITLE_POSTCODE', 'Post Code');

define('MAIL_TO', 'Send');
define('MAIL_FROM', 'From');
define('MAIL_SUBJECT', 'Theme');
define('MAIL_MESSAGE', 'Message');
define('MAIL_ALL_CUSTOMERS', 'All clients');
define('MAIL_ALL_SUBSCRIBER', 'All customers to subscribers');
?>
