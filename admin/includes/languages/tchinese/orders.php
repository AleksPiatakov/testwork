<?php
/*
  $Id: orders.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Orders');
define('HEADING_TITLE_SEARCH', 'Order ID:');
define('HEADING_TITLE_STATUS', 'Status');

define('TABLE_HEADING_COMMENTS', 'Comments');
define('TABLE_HEADING_CUSTOMERS', 'Customers');
define('TABLE_HEADING_ORDER_TOTAL', 'Order Total');
define('TABLE_HEADING_DATE_PURCHASED', 'Date Purchased');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_QUANTITY', 'Qty.');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Products');
define('TABLE_HEADING_TAX', 'Tax');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Price (ex)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Price (inc)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Total (ex)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Total (inc)');

define('TABLE_HEADING_DATE_ADDED', 'Date Added');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Customer notified');

define('ENTRY_CUSTOMER', 'Customer:');
define('ENTRY_SOLD_TO', 'SOLD TO:');
define('ENTRY_DELIVERY_TO', 'Delivery To:');
define('ENTRY_SHIP_TO', 'SHIP TO:');
define('ENTRY_SHIPPING_ADDRESS', 'Shipping Address:');
define('ENTRY_BILLING_ADDRESS', 'Billing Address:');
define('ENTRY_BILLING', 'Billing:');
define('ENTRY_PAYMENT_METHOD', 'Payment Method:');
define('ENTRY_CREDIT_CARD_TYPE', 'Credit Card Type:');
define('ENTRY_CREDIT_CARD_OWNER', 'Credit Card Owner:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Credit Card Number:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Credit Card Expires:');
define('ENTRY_SUB_TOTAL', 'Sub-Total:');
define('ENTRY_TAX', 'Tax:');
define('ENTRY_SHIPPING', 'Shipping:');
define('ENTRY_TOTAL', 'Total:');
define('ENTRY_DATE_PURCHASED', 'Date Purchased:');
define('ENTRY_STATUS', 'Status:');
define('ENTRY_DATE_LAST_UPDATED', 'Date Last Updated:');
define('ENTRY_NOTIFY_CUSTOMER', 'Notify Customer:');
define('ENTRY_NOTIFY_CUSTOMER_EMAIL', 'Notify Customer by email? ');
define('ENTRY_NOTIFY_COMMENTS', 'Append Comments:');
define('ENTRY_PRINTABLE', 'Print Invoice');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Delete Order');
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this order?');
define('TEXT_INFO_DELETE_DATA', 'Customers Name  ');
define('TEXT_INFO_DELETE_DATA_OID', '訂單編號');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Restock product quantity');
define('TEXT_DATE_ORDER_CREATED', 'Date Created:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Last Modified:');
define('TEXT_INFO_PAYMENT_METHOD', 'Payment Method:');

define('TEXT_ALL_ORDERS', 'All Orders');
define('TEXT_NEW_CUSTOMER', 'New Customer');
define('TEXT_EXIST_CUSTOMER', 'Exist Customer');
define('TEXT_NO_ORDER_HISTORY', 'No Order History Available');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Order Update');
define('EMAIL_TEXT_ORDER_NUMBER', 'Order Number:');
define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice:');
define('EMAIL_TEXT_DATE_ORDERED', 'Date Ordered:');
define('EMAIL_TEXT_STATUS_UPDATE', '您的訂單訊息已更新喔。\\n\\n\ 新訊息: %s\\n\\n\若您有任何疑問，可以直接回覆本封信件喔\\n');
define('EMAIL_TEXT_COMMENTS_UPDATE', 'The comments for your order are' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Error: Order does not exist.');
define('SUCCESS_ORDER_UPDATED', 'Success: Order has been successfully updated.');
define('WARNING_ORDER_NOT_UPDATED', 'Warning: Nothing to change. The order was not updated.');
// denuz
define('TABLE_HEADING_ORDER_NETTO', 'Нетто');
define('TABLE_HEADING_ORDER_NUMBER', 'Номер');
define('TABLE_HEADING_ORDER_MARJA', 'Маржа');
define('TITLE_ORDER_NETTO', 'Нетто:');
define('TITLE_ORDER_MARJA', 'Маржа:');
define('TEXT_TOTAL', 'Total: ');
define('TEXT_NETTO', 'Нетто: ');
define('TEXT_MARJA', 'Маржа: ');
// eof denuz
define('EMAIL_TEXT_CUSTOMER_NAME', 'Customer:');
define('EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS', 'Email:');
define('EMAIL_TEXT_CUSTOMER_TELEPHONE', 'Phone:');
define('EMAIL_ACC_DISCOUNT_INTRO_OWNER', 'One of your customers reach accumulated discount limit. ' . "\n\n" . 'Details:');
define('EMAIL_TEXT_LIMIT', 'Accumulated discount: ');
define('EMAIL_TEXT_CURRENT_GROUP', 'New group: ');
define('EMAIL_TEXT_DISCOUNT', 'Discount: ');
define('EMAIL_ACC_SUBJECT', 'Accumalated discount');
define('EMAIL_ACC_INTRO_CUSTOMER', 'Congratulations, you have new discount. All details below:');
define('EMAIL_ACC_FOOTER', 'Now you can buy with your new discount rate.');

define('TEXT_REFERER', 'Referer: ');
define('TEXT_ORDER_DELETE', 'Delete orders: ');

define('TEXT_OR_NAL', 'Cash');
define('TEXT_OR_BNAL', 'Bank');
define('TEXT_OR_PRIVAT', 'Other');
define('TEXT_OR_NALOZH', 'c.o.d.');
define('TEXT_OR_FROM', 'from');
define('TEXT_OR_TO', 'to');
define('TEXT_OR_CLEAR', 'clear filter');
define('TEXT_OR_TOTAL', 'Total');
define('TEXT_OR_DATE', 'Delivery date');
define('TEXT_OR_COURIER', 'Courier');
define('TEXT_OR_STATUS', 'Status');
define('TEXT_OR_PAYMENT', 'Payment method');
define('TEXT_OR_ACTION', 'Action');
define('ENTRY_CUSTOMERS', 'Client:');
define('ENTRY_DELIVERY', 'Address:');
define('ENTRY_INFO', 'Info:');
define('ENTRY_CREATE_ORDER', 'Create order');

//new orders
define('TEXT_NEW_ORDER', 'New order');
define('TEXT_SELECT_CUST', 'Select customer');
define('TEXT_SELECT_CUST_PLACEHOLDER', 'Enter id or Name or Surname');
define('TEXT_ADDRESS_BOOK', 'Address book');
define('TEXT_FIRST_NAME', 'First name');
define('TEXT_LAST_NAME', 'Last name');
define('TEXT_GROUPS_NAME', 'Group name');
define('TEXT_EMAIL', 'Email');
define('TEXT_PHONE', 'Phone');
define('TEXT_FAX', 'Fax');
define('TEXT_FIRM', 'Company name');
define('TEXT_ADDRESS', 'Address');
define('TEXT_SUBURB', 'Area');
define('TEXT_POSTCODE', 'Index');
define('TEXT_CITY', 'City');
define('TEXT_ZONE', 'Region');
define('TEXT_COUNTRY', 'Country');
define('TEXT_OP_PRICE', 'Price');
define('TEXT_OP_TAX', 'Tax');
define('TEXT_OP_SHIPPING', 'Shipping');
define('TEXT_OP_TOTAL', 'Total price');
define('TEXT_EDIT_ORDER', '编辑订单');
define('TEXT_CURRENCY', '货币：');
define('TEXT_CURRENCY_VALUE', '速度');
