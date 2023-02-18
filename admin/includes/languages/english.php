<?php
/*
  $Id: english.php,v 1.3 2003/09/28 23:37:26 anotherlango Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

//Admin begin
// header text in includes/header.php
define('HEADER_TITLE_LOGOFF', 'Logoff');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Admins');
define('BOX_ADMINISTRATOR_MEMBERS', 'Member Groups');
define('BOX_ADMINISTRATOR_MEMBER', 'Members');
define('BOX_ADMINISTRATOR_BOXES', 'File Access');
define('BOX_ADMINISTRATOR_ACCOUNT_UPDATE', 'Update Account');
define('TEXT_PRODILE_INFO_CHANGE_PASSWORD', 'Change own Password ');

// images
define('IMAGE_FILE_PERMISSION', 'File Permission');
define('IMAGE_GROUPS', 'Groups List');
define('IMAGE_INSERT_FILE', 'Insert File');
define('IMAGE_MEMBERS', 'Members List');
define('IMAGE_NEW_GROUP', 'New Group');
define('IMAGE_NEW_MEMBER', 'New Member');
define('IMAGE_NEXT', 'Next');

define('ONE_PAGE_CHECKOUT_TITLE', 'Checkout');
define('BROWSE_BY_CATEGORIES_TITLE', 'Browse by categories');
define('SEO_TITLE', 'SEO URLs');
define('HEADER_FRONT_LINK_TEXT', 'Go to site');
define('HEADER_GO_TO_SITE', 'Go to site');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> filenames)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> members)');
//Admin end

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'en_US.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
//define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', '%d %B %Y'); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'm/d/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_FORMAT_SPIFFYCAL', 'MM/dd/yyyy');  //Use only 'dd', 'MM' and 'yyyy' here in any order


define('TEXT_DAY_1','Monday');
define('TEXT_DAY_2','Tuesday');
define('TEXT_DAY_3','Environment');
define('TEXT_DAY_4','Thursday');
define('TEXT_DAY_5','Friday');
define('TEXT_DAY_6','Saturday');
define('TEXT_DAY_7','Sunday');
define('TEXT_DAY_SHORT_1','MON');
define('TEXT_DAY_SHORT_2','TUE');
define('TEXT_DAY_SHORT_3','WED');
define('TEXT_DAY_SHORT_4','THU');
define('TEXT_DAY_SHORT_5','FRI');
define('TEXT_DAY_SHORT_6','SAT');
define('TEXT_DAY_SHORT_7','SUN');
define('TEXT_MONTH_BASE_1','January');
define('TEXT_MONTH_BASE_2','February');
define('TEXT_MONTH_BASE_3','March');
define('TEXT_MONTH_BASE_4','April');
define('TEXT_MONTH_BASE_5','May');
define('TEXT_MONTH_BASE_6','June');
define('TEXT_MONTH_BASE_7','July');
define('TEXT_MONTH_BASE_8','August');
define('TEXT_MONTH_BASE_9','September');
define('TEXT_MONTH_BASE_10','October');
define('TEXT_MONTH_BASE_11','November');
define('TEXT_MONTH_BASE_12','December');
define('TEXT_MONTH_1','Jan');
define('TEXT_MONTH_2','Feb');
define('TEXT_MONTH_3','Mar');
define('TEXT_MONTH_4','APR');
define('TEXT_MONTH_5','May');
define('TEXT_MONTH_6','Jun');
define('TEXT_MONTH_7','July');
define('TEXT_MONTH_8','Aug');
define('TEXT_MONTH_9','Sep');
define('TEXT_MONTH_10','Oct');
define('TEXT_MONTH_11','Nov');
define('TEXT_MONTH_12','Dec');

// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="en"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// page title
define('TITLE', 'Solomono');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Admin');
define('HEADER_TITLE_SUPPORT_SITE', 'osCommerce');
define('HEADER_TITLE_ONLINE_CATALOG', 'Catalog');
define('HEADER_TITLE_ADMINISTRATION', 'Admin');
define('HEADER_TITLE_CHAINREACTION', 'Chainreactionweb');
define('HEADER_TITLE_PHESIS', 'PHESIS Loaded6');

define('HEADER_TITLE_HELLO', 'Hello');
define('HEADER_ADMIN_TEXT', 'Admin panel');
define('HEADER_ORDERS_TODAY', 'Orders today: ');

// MaxiDVD Added Line For WYSIWYG HTML Area: BOF
define('BOX_CATALOG_DEFINE_MAINPAGE', 'Define MainPage');
// MaxiDVD Added Line For WYSIWYG HTML Area: EOF
define('BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI', 'Multiedit products');
define('BOX_TOOLS_COMMENT8R', 'Comments');
define('BOX_TOOLS_MYSQL_PERFORMANCE', 'Slow queries');
define('BOX_GOOGLE_SITEMAP', 'Google SiteMaps');
define('BOX_CLEAR_IMAGE_CACHE', 'Clear image cache');


define('TOOLTIP_STORE_NAME', 'Indicate the original name of the store that attracts customers, is remembered by customers, and serves to stand out and distinguish itself from similar stores - competitors.');
define('TOOLTIP_STORE_OWNER', 'Specify the store owner');
define('TOOLTIP_SHOW_BASKET_ON_ADD_TO_CART', 'Enable, the cart will be available when adding a product, so that the visitor does not have questions that the product has been added to the cart.');
define('TOOLTIP_USE_DEFAULT_LANGUAGE_CURRENCY', 'Enable to change the currency automatically according to the current site language.');
define('TOOLTIP_CHANGE_BY_GEOLOCATION', 'Enable to change site currency and language based on geolocation.');
define('TOOLTIP_GET_BROWSER_LANGUAGE', 'Enable to change the site currency depending on the browser language.');
define('TOOLTIP_STORE_BANK_INFO', 'Allows you to define exact bank information for invoice details');
define('TOOLTIP_ONEPAGE_LOGIN_REQUIRED', 'Enable and user/client login will always be required');
define('TOOLTIP_REVIEWS_WRITE_ACCESS', 'Enable and only registered users will be able to leave their comments');
define('TOOLTIP_ROBOTS_TXT', 'Protection of the entire site or some of its sections from indexing');
define('TOOLTIP_MENU_LOCATION', 'Select menu position: top, left, or left collapsed');
define('TOOLTIP_DEFAULT_DATE_FORMAT', 'Choose date format');
define('TOOLTIP_SET_HTTPS', 'Enable the HTTPS protocol extension to support encryption for increased security');
define('TOOLTIP_SET_WWW', 'Select the setting where to redirect: disable, www->no-www or no-www->www');
define('TOOLTIP_ENABLE_DEBUG_PAGE_SPEED', 'Enable page load debug to find and fix errors in the script');
define('TOOLTIP_STORE_SCRIPTS', 'You can include additional JS scripts');
define('TOOLTIP_STORE_METAS', 'You can include additional meta tags in the head');
define('TOOLTIP_MYSQL_PERFORMANCE_TRESHOLD', 'Set the time in "seconds" above which slow and potentially problematic queries will be logged to the database');






// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuration');
define('BOX_CONFIGURATION_MYSTORE', 'My Store');
define('BOX_CONFIGURATION_LOGGING', 'Logging');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Modules');
define('BOX_MODULES_PAYMENT', 'Payment');
define('BOX_MODULES_SHIPPING', 'Shipping');
define('BOX_MODULES_ORDER_TOTAL', 'Order Total');
define('BOX_MODULES_SHIP2PAY', 'Ship&Pay');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Catalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categories/Products');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Attributes - Add values');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES_NEW', 'Attributes - Set values');
define('BOX_CATALOG_MANUFACTURERS', 'Manufacturers');
define('BOX_CATALOG_SPECIALS', 'Specials');
define('BOX_CATALOG_EASYPOPULATE', 'EasyPopulate');
define('BOX_CATALOG_STATS_SEARCH_KEYWORDS', "Keywords planner");

define('BOX_CATALOG_SALEMAKER', 'SaleMaker');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Customers');
define('BOX_CUSTOMERS_CUSTOMERS', 'Customers');
define('BOX_CUSTOMERS_ORDERS', 'Orders');
define('BOX_CUSTOMERS_EDIT_ORDERS', 'Edit Orders');
define('BOX_CUSTOMERS_ENTRY', 'Number of Enries');


// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Locations / Taxes');
define('BOX_TAXES_COUNTRIES', 'Countries');
define('BOX_TAXES_ZONES', 'Zones');
define('BOX_TAXES_GEO_ZONES', 'Tax Zones');
define('BOX_TAXES_TAX_CLASSES', 'Tax Classes');
define('BOX_TAXES_TAX_RATES', 'Tax Rates');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Reports');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Products Viewed');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Products Purchased');
define('BOX_REPORTS_PRODUCTS_PURCHASED_BY_CATEGORY', 'Report - Products purchased (by Category)');
define('BOX_REPORTS_ORDERS_TOTAL', 'Customer Orders-Total');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Tools');
define('BOX_TOOLS_BACKUP', 'Database Backup');
define('BOX_TOOLS_CACHE', 'Cache Control');
define('BOX_TOOLS_MAIL', 'Send Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Newsletter Manager');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localization');
define('BOX_LOCALIZATION_CURRENCIES', 'Currencies');
define('BOX_LOCALIZATION_LANGUAGES', 'Languages');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Orders Status');
define('BOX_CATALOG_SEO_FILTER', "SEO filter");
define('BOX_CATALOG_SEO_TEMPALTES', "SEO templates");
// infobox box text in includes/boxes/info_boxes.php
define('BOX_HEADING_BOXES', 'Infobox Admin');
define('BOX_HEADING_TEMPLATE_CONFIGURATION', 'Template Admin');
define('BOX_HEADING_DESIGN_CONTROLS', 'Design controls');

// javascript messages
define('JS_ERROR', 'Errors have occured during the process of your form!\nPlease make the following corrections:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* The new product atribute needs a price value\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* The new product atribute needs a price prefix\n');

define('JS_PRODUCTS_NAME', '* The new product needs a name\n');
define('JS_PRODUCTS_DESCRIPTION', '* The new product needs a description\n');
define('JS_PRODUCTS_PRICE', '* The new product needs a price value\n');
define('JS_PRODUCTS_WEIGHT', '* The new product needs a weight value\n');
define('JS_PRODUCTS_QUANTITY', '* The new product needs a quantity value\n');
define('JS_PRODUCTS_MODEL', '* The new product needs a model value\n');
define('JS_PRODUCTS_IMAGE', '* The new product needs an image value\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* A new price for this product needs to be set\n');

define('JS_FIRST_NAME', '* The \'First Name\' entry must have at least ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_LAST_NAME', '* The \'Last Name\' entry must have at least ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_DOB', '* The \'Date of Birth\' entry must be in the format: xx/xx/xxxx (month/date/year).\n');
define('JS_EMAIL_ADDRESS', '* The \'E-Mail Address\' entry must have at least ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_ADDRESS', '* The \'Street Address\' entry must have at least ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_POST_CODE', '* The \'Post Code\' entry must have at least ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.\n');
define('JS_CITY', '* The \'City\' entry must have at least ' . ENTRY_CITY_MIN_LENGTH . ' characters.\n');
define('JS_STATE', '* The \'State\' entry is must be selected.\n');
define('JS_STATE_SELECT', '-- Select Above --');
define('JS_ZONE', '* The \"State\" entry must be selected from the list for this country.');
define('JS_COUNTRY', '* The \'Country\' value must be chosen.\n');
define('JS_TELEPHONE', '* The \'Telephone Number\' entry must have at least ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.\n');
define('JS_PASSWORD', '* The \'Password\' amd \'Confirmation\' entries must match amd have at least ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Order Number %s does not exist!');

define('CATEGORY_PERSONAL', 'Personal');
define('CATEGORY_ADDRESS', 'Address');
define('CATEGORY_CONTACT', 'Contact');
define('CATEGORY_COMPANY', 'Company');
define('CATEGORY_OPTIONS', 'Options');
define('DISCOUNT_OPTIONS', 'Discounts');

define('ENTRY_FIRST_NAME', 'First Name:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' chars</span>');
define('ENTRY_LAST_NAME', 'Last Name:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' chars</span>');
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(eg. 05/21/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Address:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">The email address doesn\'t appear to be valid!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">This email address already exists!</span>');
define('ENTRY_COMPANY', 'Company name:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Street Address:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_SUBURB', 'Suburb:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Post Code:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' chars</span>');
define('ENTRY_CITY', 'City:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' chars</span>');
define('ENTRY_STATE', 'State:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">required</span>');
define('ENTRY_COUNTRY', 'Country:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telephone Number:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' chars</span>');
define('ENTRY_FAX_NUMBER', 'Fax Number:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_YES', 'Subscribed');
define('ENTRY_NEWSLETTER_NO', 'Unsubscribed');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Sending E-Mail');
define('IMAGE_BACK', 'Back');
define('IMAGE_BACKUP', 'Database Backup');
define('IMAGE_CANCEL', 'Cancel');
define('IMAGE_CONFIRM', 'Confirm');
define('IMAGE_COPY', 'Copy');
define('IMAGE_COPY_TO', 'Copy To');
define('IMAGE_DETAILS', 'Details');
define('IMAGE_DELETE', 'Delete');
define('IMAGE_LANG_DIR', 'Link to directory lang');
define('IMAGE_EDIT', 'Edit');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'File Manager');
define('IMAGE_ICON_STATUS_GREEN', 'Active');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Set Active');
define('IMAGE_ICON_STATUS_RED', 'Inactive');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Set Inactive');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Insert');
define('IMAGE_LOCK', 'Lock');
define('IMAGE_MODULE_INSTALL', 'Install Module');
define('IMAGE_MODULE_REMOVE', 'Remove Module');
define('IMAGE_MOVE', 'Move');
define('IMAGE_NEW_BANNER', 'New Banner');
define('IMAGE_NEW_CATEGORY', 'New Category');
define('IMAGE_NEW_COUNTRY', 'New Country');
define('IMAGE_NEW_CURRENCY', 'New Currency');
define('IMAGE_NEW_FILE', 'New File');
define('IMAGE_NEW_FOLDER', 'New Folder');
define('IMAGE_NEW_LANGUAGE', 'New Language');
define('IMAGE_NEW_NEWSLETTER', 'New Newsletter');
define('IMAGE_NEW_PRODUCT', 'New Product');
define('IMAGE_NEW_SALE', 'New Sale');
define('IMAGE_NEW_TAX_CLASS', 'New Tax Class');
define('IMAGE_NEW_TAX_RATE', 'New Tax Rate');
define('IMAGE_NEW_TAX_ZONE', 'New Tax Zone');
define('IMAGE_NEW_ZONE', 'New Zone');
define('IMAGE_ORDERS', 'Orders');
define('IMAGE_ORDERS_INVOICE', 'Invoice');
define('IMAGE_ORDERS_PACKINGSLIP', 'Packing Slip');
define('IMAGE_PREVIEW', 'Preview');
define('IMAGE_RESTORE', 'Restore');
define('IMAGE_RESET', 'Reset');
define('IMAGE_SAVE', 'Save');
define('IMAGE_SEARCH', 'Search');
define('IMAGE_SELECT', 'Select');
define('IMAGE_SEND', 'Send');
define('IMAGE_SEND_EMAIL', 'Send Email');
define('IMAGE_UNLOCK', 'Unlock');
define('IMAGE_UPDATE', 'Update');
define('IMAGE_UPDATE_CURRENCIES', 'Update Exchange Rate');
define('IMAGE_UPDATE_CURRENCIES_SHORT', 'Update currencies');
define('IMAGE_UPLOAD', 'Upload');
define('TEXT_IMAGE_NONEXISTENT', 'No image');

define('ICON_CROSS', 'False');
define('ICON_CURRENT_FOLDER', 'Current Folder');
define('ICON_DELETE', 'Delete');
define('ICON_ERROR', 'Error');
define('ICON_FILE', 'File');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Folder');
define('ICON_LOCKED', 'Locked');
define('ICON_PREVIOUS_LEVEL', 'Previous Level');
define('ICON_PREVIEW', 'Preview');
define('ICON_STATISTICS', 'Statistics');
define('ICON_SUCCESS', 'Success');
define('ICON_TICK', 'True');
define('ICON_UNLOCKED', 'Unlocked');
define('ICON_WARNING', 'Warning');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Page %s of %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> countries)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> customers)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> currencies)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> languages)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> manufacturers)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> newsletters)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders status)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products)');
define('TEXT_DISPLAY_NUMBER_OF_SALES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> sales)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products on special)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax classes)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax zones)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax rates)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> zones)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('IMAGE_BUTTON_BUY_TEMPLATE','Switch to paid package');
define('IMAGE_BUTTON_BUY_TEMPLATE_MOB', 'Buy');
define('TIME_LEFT', 'Time left: ');

define('TEXT_DEFAULT', 'default');
define('TEXT_SET_DEFAULT', 'Set as default');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Required</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Error: There is currently no default currency set. Please set one at: Administration Tool->Localization->Currencies');

define('TEXT_CACHE_CATEGORIES', 'Categories Box');
define('TEXT_CACHE_MANUFACTURERS', 'Manufacturers Box');
define('TEXT_CACHE_ALSO_PURCHASED', 'Also Purchased Module');

define('TEXT_NONE', '--none--');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: Destination does not exist.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: Destination not writeable.');
define('ERROR_FILE_NOT_SAVED', 'Error: File upload not saved.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: File upload type not allowed.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Success: File upload saved successfully.');
define('WARNING_NO_FILE_UPLOADED', 'Warning: No file uploaded.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warning: File uploads are disabled in the php.ini configuration file.');

define('BOX_CATALOG_XSELL_PRODUCTS', 'Cross Sell Products');

define('CUSTOM_PANEL_DATE1', 'day');
define('CUSTOM_PANEL_DATE2', 'days');
define('CUSTOM_PANEL_DATE3', 'days');


// X-Sell
REQUIRE(DIR_WS_LANGUAGES . 'add_ccgvdc_english.php');

// BOF: Lango Added for print order MOD
define('IMAGE_BUTTON_PRINT', 'Print');
// EOF: Lango Added for print order MOD

// BOF: Lango Added for Featured product MOD
define('BOX_CATALOG_FEATURED', 'Featured Products');
// EOF: Lango Added for Featured product MOD

// BOF: Lango Added for Sales Stats MOD
define('BOX_REPORTS_MONTHLY_SALES', 'Monthly Sales/Tax');
// EOF: Lango Added for Sales Stats MOD

//BEGIN Dynamic information pages unlimited
define('BOX_HEADING_INFORMATION', 'Content');
define('BOX_HEADING_SEO', 'SEO');
define('BOX_INFORMATION', 'Pages');
//END Dynamic information pages unlimited

define('BOX_TOOLS_KEYWORDS', 'Keyword Manager');

// RJW Begin Meta Tags Code
define('TEXT_META_TITLE', 'Meta Title');
define('TEXT_META_DESCRIPTION', 'Meta Description');
define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

// Article Manager
define('BOX_HEADING_ARTICLES', 'Article Manager');
define('BOX_TOPICS_ARTICLES', 'Topics/Articles');
define('BOX_ARTICLES_CONFIG', 'Configuration');
define('BOX_ARTICLES_AUTHORS', 'Authors');
define('BOX_ARTICLES_XSELL', 'Cross-Sell Articles');
define('IMAGE_NEW_TOPIC', 'New Topic');
define('IMAGE_NEW_ARTICLE', 'New Article');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> authors)');

//TotalB2B start
define('BOX_CUSTOMERS_GROUPS', 'Groups');
define('BOX_MANUDISCOUNT', 'Manu Discount');

// add for Group minimum price to order start		
define('GROUP_MIN_PRICE', 'Group min price');
// add for Group minimum price to order end
// add for color groups start
define('GROUP_COLOR_BAR', 'Group Color');
// add for color groups end
//TotalB2B end
define('BOX_CATALOG_QUICK_UPDATES', 'Quick Updates');

define('IMAGE_PROPERTIES_POPUP_ADD_CHANGE_DELETE', 'Add, change, delete Properties');
define('IMAGE_PROPERTIES_POPUP_ADD', 'Add Properties');
define('IMAGE_PROPERTIES', 'Define your Products Properties');

// polls box text in includes/boxes/polls.php

define('BOX_HEADING_POLLS', 'Polls');
define('BOX_POLLS_POLLS', 'Poll Manager');
define('BOX_POLLS_CONFIG', 'Poll Configuration');
define('BOX_CURRENCIES_CONFIG', 'Currencies');
define('BOX_COUPONS', 'Promo codes');
define('BOX_INDEX_GIFTVOUCHERS', 'Gift vouchers / Promo codes');

define('BOX_REPORTS_SALES_REPORT2', 'Stats sales 2');
define('BOX_REPORTS_SALES_REPORT', 'Stats sales 3');
define('BOX_REPORTS_CUSTOMERS_ORDERS', 'Customers report');

define('TEXT_NEW_ATTRIBUTE_EDIT', 'Edit products attributes');

define('SMS_ENABLE_TITLE', 'Turn on sms-service');
define('SMS_GATENAME_TITLE', 'SMS gatename');
define('SMS_CUSTOMER_ENABLE_TITLE', 'Sent sms to customer on checkout?');
define('TELEGRAM_TOKEN_TITLE','Telegram Token');
define('TELEGRAM_NOTIFICATIONS_ENABLED_TITLE','Enable Telegram notifications');
define('SMS_CHANGE_STATUS_TITLE', 'Sent sms to customer on change order status?');
define('SMS_OWNER_ENABLE_TITLE', 'Sent sms to admin on checkout?');
define('SMS_OWNER_ENABLE_BUY_ONE_CLICK_TITLE', 'Send sms to admin when buying in one click?');
define('SMS_OWNER_TEL_TITLE', 'Admin tel. number');
define('SMS_TEXT_TITLE', 'text sms');
define('SMS_LOGIN_TITLE', 'Login to SMS gateway (or API key, Account SID)');
define('SMS_PASSWORD_TITLE', 'pass (or Auth token)');
define('SMS_SIGN_TITLE', 'Sender (or Service SID)');
define('SMS_ENC_TITLE', 'code2');

define('ROBOTS_TXT_TITLE', 'robots.txt');

define('SMS_CONF_TITLE', 'Sms-service');
define('MY_SHOP_CONF_TITLE', 'My Store');
define('MIN_VALUES_CONF_TITLE', 'Minimum Values');
define('MAX_VALUES_CONF_TITLE', 'Maximum Values');
define('IMAGES_CONF_TITLE', 'Images');
define('CUSTOMER_DETAILS_CONF_TITLE', 'Customer Details');
define('MODULES_CONF_TITLE', 'Installed Modules');
define('SHIPPING_CONF_TITLE', 'Shipping/Packaging');
define('LISTING_CONF_TITLE', 'Product Listing');
define('STOCK_CONF_TITLE', 'Stock');
define('LOGS_CONF_TITLE', 'Logging');
define('CACHE_CONF_TITLE', 'Cache');
define('EMAIL_CONF_TITLE', 'E-Mail Options');
define('DOWNLOAD_CONF_TITLE', 'Download');
define('GZIP_CONF_TITLE', 'GZip Compression');
define('SESSIONS_CONF_TITLE', 'Sessions');
define('HTML_CONF_TITLE', 'TinyMCE Editor');
define('DYMO_CONF_TITLE', 'Dynamic MoPics');
define('DOWN_CONF_TITLE', 'Site Maintenance');
define('GA_CONF_TITLE', 'Guests');
define('LINKS_CONF_TITLE', 'Links');
define('QUICK_CONF_TITLE', 'Quick Updates');
define('WISHLIST_TITLE', 'Wish List Settings');
define('PAGE_CACHE_TITLE', 'Page cache');
define('YANDEX_MARKET_CONF_TITLE', 'XML upload');


define('ATTRIBUTES_COPY_TEXT1', ' WARNING: Cannot copy from Product ID # ');
define('ATTRIBUTES_COPY_TEXT2', ' to Product ID # ');
define('ATTRIBUTES_COPY_TEXT3', ' ... No copy was made');
define('ATTRIBUTES_COPY_TEXT4', ' WARNING: No Attributes to copy from Product ID # ');
define('ATTRIBUTES_COPY_TEXT5', ' for: ');
define('ATTRIBUTES_COPY_TEXT6', ' ... No copy was made');
define('ATTRIBUTES_COPY_TEXT7', ' WARNING: There is no Product ID # ');
define('ATTRIBUTES_COPY_TEXT8', ' ... No copy was made');

//include('includes/languages/english_support.php');

// BOF FlyOpenair: Extra Product Price
define('BOX_EXTRA_PRODUCT_PRICE', 'Extra Product Price');
define('EXTRA_PRODUCT_PRICE_ID_TITLE', 'Enable Extra Product Price');
define('EXTRA_PRODUCT_PRICE_ID_DESC', 'Enable/Disable Extra Product Price)');
// EOF FlyOpenair: Extra Product Price

define('TEXT_IMAGE_OVERWRITE_WARNING', 'WARNING: FILENAME was updated but not overwritten ');

define('SERVICE_MENU', 'TOOLS');
define('SEO_CONFIGURATION','SEO TOOLS');
define('RCS_CONF_TITLE', 'RCS');

define('TEXT_INDEX_LANGUAGE', 'Language: ');
define('TEXT_SUMMARY_CUSTOMERS', 'Customers');
define('TEXT_SUMMARY_ORDERS', 'Orders');
define('TEXT_SUMMARY_PRODUCTS', 'Products');
define('TEXT_SUMMARY_HELP', 'Help');
define('TEXT_SUMMARY_STAT', 'Statistics');
define('TABLE_HEADING_CUSTOMERS', 'Customers');

define('API_ENABLED_TITLE', 'Solomono API');
define('TEXT_MENU_API', 'API');
define('COMMENTS_MODULE_ENABLED_TITLE', 'Reviews');
define('QUICK_PRODUCTS_UPDATE_ENABLED_TITLE','Quick Updates');
define('FACEBOOK_PIXEL_MODULE_ENABLED_TITLE','FaceBook Pixel');
define('DEFAULT_PIXEL_CURRENCY_TITLE','FaceBook Pixel currency');
define('FACEBOOK_PIXEL_ID_TITLE','FaceBook Pixel ID');
define('LANGUAGE_SELECTOR_MODULE_ENABLED_TITLE', 'Multilanguage');
define('PRODUCT_LABELS_MODULE_ENABLED_TITLE', 'Labels');
define('ATTRIBUTES_PRODUCTS_MODULE_ENABLED_TITLE', 'Filters');
define('AUTH_MODULE_ENABLED_TITLE', 'Authorization (Google, Facebook)');
define('EXCEL_IMPORT_MODULE_ENABLED_TITLE', 'Import/Export CSV (Easy Populate)');
define('CUPONES_MODULE_ENABLED_TITLE', 'Promo codes');
define('COMPARE_MODULE_ENABLED_TITLE', 'Comparison');
define('WISHLIST_MODULE_ENABLED_TITLE', 'Products Wishlist');
define('GOOGLE_FEED_CHOOSE_ALL_PRODUCTS_TITLE', 'active products');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_2_TITLE', 'products with XML active status');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_3_TITLE', 'products with stock availability');
define('XSELL_PRODUCTS_BUYNOW_ENABLED_TITLE', 'Cross sell products');
define('STATS_PRODUCTS_PURCHASED_BY_CATEGORY_MODULE_ENABLED_TITLE', 'Report - Products purchased (by Category)');
define('SALEMAKER_MODULE_ENABLED_TITLE', 'Mass Discounts (SaleMaker)');
define('SPECIALS_MODULE_ENABLED_TITLE', 'Specials (price discounts)');
define('STATS_KEYWORDS_ENABLED_TITLE', 'Statistics of search requests');
define('BACKUP_ENABLED_TITLE', 'Database Backup');
define('PRODUCTS_MULTI_ENABLED_TITLE', 'Products multi-manager');
define('SEO_TEMPLATES_ENABLED_TITLE', 'SEO Templates');
define('SHIP2PAY_ENABLED_TITLE', 'Ship 2 Pay');
define('QTY_PRO_ENABLED_TITLE', 'Combinations of attributes');
define('MASTER_PASSWORD_MODULE_ENABLED_TITLE', 'Master Password');
define('YML_MODULE_ENABLED_TITLE', 'Import XML (YML)');
define('OSC_IMPORT_MODULE_ENABLED_TITLE', 'Database migration (osCommerce)');
define('EXPORT_HOTLINE_MODULE_ENABLED_TITLE', 'XML products export "Hotline"');
define('EXPORT_PROMUA_MODULE_ENABLED_TITLE', 'XML products export "Prom"');
define('EXPORT_PRICEUA_MODULE_ENABLED_TITLE', 'XML products export "Price.ua"');
define('EXPORT_ROZETKA_MODULE_ENABLED_TITLE', 'XML products export "Rozetka"');
define('EXPORT_YANDEX_MARKET_MODULE_ENABLED_TITLE', 'Yandex Market export');
define('EXPORT_GOOGLE_SITEMAP_MODULE_ENABLED_TITLE', 'XML Sitemaps');
define('EXPORT_FACEBOOK_FEED_MODULE_ENABLED_TITLE', 'XML feed for Facebook Product Catalog');
define('EXPORT_PDF_MODULE_ENABLED_TITLE', 'Export catalog to PDF');
define('PROMURLS_MODULE_ENABLED_TITLE', 'Prom.ua Urls');
define('PROM_EXCEL_MODULE_ENABLED_TITLE', 'Import Prom.ua (Excel)');
define('GOOGLE_FEED_MODULE_ENABLED_TITLE', 'Google Feed');
define('MASTER_PASS_TITLE', 'Master Password');
define('SMSINFORM_MODULE_ENABLED_TITLE', 'SMS module');
define('CARDS_ENABLED_TITLE', 'Credit cards (13 methods)');
define('SOCIAL_WIDGETS_ENABLED_TITLE', 'Social widgets');
define('MULTICOLOR_ENABLED_TITLE', 'Multicolor');
define('WATERMARK_ENABLED_TITLE', 'Watermarking');

define('FACEBOOK_APP_ID_TITLE', 'Facebook app ID');
define('FACEBOOK_APP_SECRET_TITLE', 'Facebook secret key');
define('VK_APP_ID_TITLE', 'Vkontakte app ID');
define('VK_APP_SECRET_TITLE', 'Vkontakte secret key');

define('TABLE_HEADING_ORDERS', 'Orders:');
define('TABLE_HEADING_LAST_ORDERS', 'Last orders');
define('TABLE_HEADING_CUSTOMER', 'Customer');
define('TABLE_HEADING_ORDER_NUMBER', '#');
define('TABLE_HEADING_ORDER_TOTAL', 'Total');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_DATE', 'Date');

define('TEXT_GO_TO_CAT', 'Select category');
define('TEXT_GO_TO_SEARCH', 'Search');
define('TEXT_GO_TO_SEARCH2', 'by product<br>model');

include('includes/languages/order_edit_english.php');

define('TEXT_VALID_TITLE', 'Categories list');
define('TEXT_VALID_TITLE_PROD', 'Products list');
define('TEXT_VALID_CLOSE', 'Close window');

define('TABLE_HEADING_LASTNAME', 'Last name');
define('TABLE_HEADING_FIRSTNAME', 'First name');
define('TABLE_HEADING_PRODUCT_NAME', 'Name');
define('TABLE_HEADING_PRODUCT_PRICE', 'Price');

define('TEXT_SELECT_CUSTOMER', 'Select customer');
define('TEXT_SELECT_CUSTOMER_PLACEHOLDER', 'Start entering customer ID / name / telephone / email address');
define('TEXT_SINGLE_CUSTOMER', 'Single customer');
define('TEXT_EMAIL_RECIPIENT', 'Email recipient');


define('TEXT_NOTIFICATIONS', 'Notifications');
define('TEXT_NOTIFICATIONS_MESSAGE', 'You have %s orders awaiting for review');
define('TEXT_NOTIFICATIONS_LINK', 'Go to the orders page');

define('TEXT_PROFILE', 'Profile');
define('TEXT_PROFILE_GREETINGS', 'Hi, %s!');
define('TEXT_PROFILE_LOGIN_COUNT', 'Login count: %s');
define('TEXT_PROFILE_DAYS_WITH_US', 'You are with us for %s days');

define('TEXT_MENU_TITLE', 'Navigation');
define('TEXT_MENU_HOME', 'Home');
define('TEXT_MENU_PRODUCTS', 'Products');
define('TEXT_MENU_CATALOGUE', 'Catalog');
define('TEXT_MENU_ATTRIBUTES', 'Attributes');
define('TEXT_MENU_ORDERS', 'Orders');
define('TEXT_MENU_REVIEWS', 'Reviews');
define('SQL_MODE_RECOMMENDATION_TEXT', "For further correct work, you need to contact the hosting administration to reset the sql_mode variable in Mysql");
define('ROBOTS_TXT_RECOMMENDATION_TEXT', 'Robots.txt is not included on your site, for successful promotion we recommend that you enable it on <a target="_blank" href="/'.$admin.'/configuration.php?gID=1">page</a>');
define('CRITICAL_CSS_TXT_RECOMMENDATION_TEXT', '<span class="critical-text">Need generate critical CSS</span> <span class="critical-process">Processing...please wait</span><a class="start-generate-critical" href="javascript:void(0);">Start</a>');
define('ALERT_ERRORS_BLOCK_TITLE', 'Alerts');
define('DOMEN_IN_ROBOTS_TXT_RECOMMENDATION_TEXT', '<span class="robots-txt-text">in Robots.txt the Host directive does not match the name of your site, for successful promotion we recommend it</span> <span class="generate-robots-txt-process">Processing ...please wait</span><a class="start-generate-robots-txt" href="javascript:void(0);"> to regenerate</a>');

define('TEXT_MENU_ORDERS_LIST', 'Orders List');
define('TEXT_MENU_CLIENTS_LIST', 'Customer List');
define('TEXT_MENU_CLIENTS_GROUPS', 'Customer Groups');
define('TEXT_MENU_ADD_CLIENT', 'Add Customer');
define('TEXT_MENU_PAGES', 'Pages');
define('TEXT_MENU_SITE_MODULES', 'SOLO modules');
define('TEXT_MENU_SITE_SEO_SETTINGS', 'SEO settings');
define('TEXT_MENU_BACKUP', 'Database Backup');
define('TEXT_MENU_TOTAL_CONFIG', 'Total configuration');
define('TEXT_MENU_NEWSLETTERS', 'Newsletters');
define('TEXT_MENU_SLOW_QUERIES_LOGS', 'Slow Queries Logs');
define('TEXT_MENU_PRODUCTS_VIEWS', 'Products Views');
define('TEXT_MENU_CLIENTS', 'Customers');
define('TEXT_MENU_SALES', 'Sales');
define('TEXT_MENU_ADMINS_AND_GROUPS', 'Admins & Groups');
define('TEXT_MENU_UPDATE_PROFILE', 'Update Profile');
define('TEXT_MENU_NOPHOTO', 'No photo');
define('TEXT_MENU_OPENEDBY', 'Opened by');
define('TEXT_MENU_LAST_MODIFIED', 'Last modified');
define('TEXT_MENU_ZEROQTY', 'Zero quantity');
define('TEXT_MENU_STATS_RECOVER_CART_SALES', 'Stats Recover Cart Sales');
define('TEXT_MENU_SEARCH', 'Search by category');

define('TEXT_HEADING_ADD_NEW', 'Add');
define('TEXT_HEADING_ADD_NEW_PRODUCT', 'Product');
define('TEXT_HEADING_ADD_NEW_CATEGORY', 'Category');
define('TEXT_HEADING_ADD_NEW_PAGE', 'Page');
define('TEXT_HEADING_ADD_NEW_CLIENT', 'Customer');
define('TEXT_HEADING_ADD_NEW_ORDER', 'Order');
define('TEXT_HEADING_ADD_NEW_COUPON', 'Coupon');

define('TEXT_BLOCK_ORDERS_STATUSES_COUNTERS', 'Orders\' Statuses');

define('TEXT_BLOCK_ORDERS_TODAY_COUNTERS', 'Today');
define('TEXT_BLOCK_ORDERS_YESTERDAY_COUNTERS', 'Yesterday');
define('TEXT_BLOCK_ORDERS_WEEK_COUNTERS', 'Week');
define('TEXT_BLOCK_ORDERS_MONTH_COUNTERS', 'Month');
define('TEXT_BLOCK_ORDERS_QUARTER_COUNTERS', 'Quarter');
define('TEXT_BLOCK_ORDERS_ALL_TIME_COUNTERS', 'All Time');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_CURRENCY', 'uah');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_PREFIX', 'for');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_NOUN', 'orders');

define('TEXT_BLOCK_COUNTERS_PRODUCTS', 'Products');
define('TEXT_BLOCK_COUNTERS_ORDERS', 'Orders');
define('TEXT_BLOCK_COUNTERS_COMMENTS', 'Comments');
define('TEXT_BLOCK_COUNTERS_TOTAL_INCOME', 'Total Income');

define('TEXT_BLOCK_SETTINGS_TITLE', 'Settings');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_HEADER', 'Fixed header');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_ASIDE', 'Fixed aside');
define('TEXT_BLOCK_SETTINGS_TITLE_FOLDED_ASIDE', 'Folded aside');
define('TEXT_BLOCK_SETTINGS_TITLE_DOCK_ASIDE', 'Dock aside');

define('TEXT_BLOCK_MODULES_STATS_USING', 'Using');
define('TEXT_BLOCK_MODULES_STATS_AMOUNT', 'pc.');
define('TEXT_BLOCK_MODULES_STATS_MODULES', 'of modules');
define('TEXT_BLOCK_MODULES_USED', 'Modules used');
define('TEXT_BLOCK_MODULES_SEE_ALL', 'See all modules');

define('TEXT_BLOCK_OVERVIEW_TITLE', 'Overview');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS', 'Orders');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED', 'TOP Views');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD', 'TOP Sales');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES', 'Top Categories');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS', 'Logins');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED', 'Searches');

define('TEXT_BLOCK_OVERVIEW_ACTION_EDIT', 'Edit');
define('TEXT_BLOCK_OVERVIEW_ACTION_VIEW', 'View');

define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_CUSTOMER_NAME', 'Customer Name');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_DATE', 'Date');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_AMOUNT', 'Amount');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_STATUS', 'Status');
define('TEXT_MENU_EMAIL_CONTENT', 'Email templates');
define('TEXT_MENU_CKFINDER', 'File manager');

define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODUCT_IMAGE', 'Product Image');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODCUT_NAME', 'Product Name');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_VIEWS', 'Views');

define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODUCT_IMAGE', 'Product Image');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODCUT_NAME', 'Product Name');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_ORDERS', 'Orders');

define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_CATEGORY_NAME', 'Category Name');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_ORDERS', 'Orders');

define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_ADMIN_NAME', 'Admin Name');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_DATE', 'Last Login Date');

define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_QUERY', 'Search Query');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_COUNT', 'Search Count');

define('TEXT_BLOCK_NEWS_TITLE', 'SoloMono News');

define('TEXT_BLOCK_PLOT_TITLE', 'Income Plot');
define('TEXT_BLOCK_PLOT_TAB_BY_DAYS', 'By days');
define('TEXT_BLOCK_PLOT_TAB_BY_WEEKS', 'By weeks');
define('TEXT_BLOCK_PLOT_TAB_BY_MONTHES', 'By monthes');

define('TEXT_BLOCK_PLOT_XAXIS_LABEL', 'Total income');
define('TEXT_BLOCK_PLOT_YAXIS_LABEL', 'Orders count');

define('TEXT_BLOCK_COMMENTS_TITLE', 'Comments');

define('TEXT_BLOCK_EVENTS_TITLE', 'Events');

define('TEXT_BLOCK_EVENTS_TOOLTIP_ALL_EVENTS', 'All events');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ADMINS', 'Admins');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ORDERS', 'Orders');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CUSTOMERS', 'Customers');
define('TEXT_BLOCK_EVENTS_TOOLTIP_NEW_PRODUCTS', 'New products');
define('TEXT_BLOCK_EVENTS_TOOLTIP_COMMENTS', 'Comments');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CALL_ME_BACK', 'Call me back');
define('TOOLTIP_STOCK_REORDER_LEVEL', 'Specify the quantity of goods in stock');





define('TEXT_BLOCK_EVENTS_MESSAGE_ADMINS', '%s entered system');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS', 'Got %s');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS_2', 'order #%d');
define('TEXT_BLOCK_EVENTS_MESSAGE_CUSTOMERS', '%s registered on the site');
define('TEXT_BLOCK_EVENTS_MESSAGE_NEW_PRODUCTS', 'New product added: "%s"');
define('TEXT_BLOCK_EVENTS_MESSAGE_COMMENTS', 'User %s added comment');
define('TEXT_BLOCK_EVENTS_MESSAGE_CALL_ME_BACK', 'asked for call back');

define('TEXT_BLOCK_GA_TITLE', 'Google Analytics');

define('TEXT_SETTINGS_EDIT_FORM_SAVE', 'OK');
define('TEXT_SETTINGS_EDIT_FORM_CANCEL', 'Cancel');
define('TEXT_SETTINGS_EDIT_FORM_TOOLTIP', 'edit');

define('TEXT_MODAL_ADD_ACTION', 'Add');
define('TEXT_MODAL_UPDATE_ACTION', 'Update');
define('TEXT_MODAL_DELETE_ACTION', 'Delete');
define('TEXT_MODAL_CHANGE_STATUS', 'Change status');
define('TEXT_MODAL_DETAILED', 'Detailed');
define('TEXT_MODAL_ACTION', 'Action');
define('TEXT_MODAL_INSTALL_ACTION', 'Install');
define('TEXT_MODAL_CONTINUE_ACTION', 'Continue');
define('TEXT_MODAL_CANCEL_ACTION', 'Cancel');
define('TEXT_MODAL_CONFIRM_ACTION', 'Confirm');
define('TEXT_MODAL_CONFIRMATION_ACTION', 'Are you sure?');
define('TEXT_WAIT', 'Wait ..');
define('TEXT_SHOW', 'To the page:');
define('TEXT_RECORDS', 'Total:');
define('TEXT_SAVE_DATA_OK', 'Data successfully changed');
define('TEXT_DEL_OK', 'Record deleted successfully');
define('TEXT_ERROR', 'There was an error');
define('TEXT_GENERAL_SETTING', 'General');

//featured
define('TEXT_FEATURED_ADDED', 'Added');
define('TEXT_FEATURED_CHANGE', 'Changed');
define('TEXT_FEATURED_EXPIRE_DATE', 'Expire date');
define('TEXT_ENTER_PRODUCT', 'Enter product name');
define('TEXT_FEATURED_MODEL', 'Model');
define('TEXT_PRODUCTS_ON_ATTRIBUTES_VAL', 'Products with this option value');

define('ADMIN_BTN_BUY_MODULE', 'Buy this module!');
define('FOOTER_INSTRUCTION', 'How to use Admin?');
define('FOOTER_NEWS', 'Solomono News');
define('FOOTER_SUPPORT_SOLOMONO', 'Technical Support');
define('FOOTER_SUPPORT_CONSULTANT', 'Online Consultant');
define('FOOTER_SUPPORT_TECHNICAL', 'Technical Support');

//new admin
define('TEXT_ERROR_DEL_FILE', 'Could not delete file.');
define('TEXT_ERROR_UPDATE', 'Update error.');

//languages_translater
define('TEXT_TRANSLATER_TITLE', 'Language Editor');

define('TEXT_REDIRECTS_TITLE', 'Redirects');

define('TEXT_PRODUCT_FREE_SHIPPING', 'Free shipping:');

define('TEXT_MOBILE_OPEN_COLLAPSE', 'Show');
define('TEXT_MOBILE_CLOSE_COLLAPSE', 'Hide');
define('TEXT_ORDER_STATISTICS', 'Order Statistics');
define('TEXT_WHO_ONLINE', 'Who is online');
define('TEXT_VIEW_LIST', 'View list');
define('TEXT_ACTION_OVERVIEW', 'Action Overview');
define('TEXT_SEE_ALL', 'See all');

define('TEXT_MOBILE_SHOW_MORE', 'Show more');
define('TEXT_MOBILE_INCOME', 'Income:');
define('TEXT_SHOW_ALL', 'Show all');
define('TEXT_REPLY_COMMENT', 'Reply to comment - ');
define('TEXT_BTN_REPLY', 'Reply');
define('TEXT_BTN_ANSWERED', 'Answered');
define('TEXT_MODAL_APPLY_ACTION', 'Apply');

define('RECOVER_CART_SALES', 'Recover Cart Sales');


define ('INSTAGRAM_PRODUCTS_TITLE', 'Import from Instagram');
define ('INSTAGRAM_PRODUCTS_RESULT', 'Products uploaded to the database');
define('INSTAGRAM_SUCCESS', 'Instagram posts have been added to our site!');
define('INSTAGRAM_ERROR', 'Instagram posts have been added to our site!');
define('INSTAGRAM_LINK', 'Link to Instagram');
define('INSTAGRAM_COUNT', 'Number of posts');

define('INSTAGRAM_MODULE_ENABLE_TITLE', 'Instagram slider');

define('BOX_PRODUCTS_STATS_MENU_ITEM', 'Products');


define('BOX_CLIENTS_STATS_TOP_CLIENTS', 'Top customers');
define('BOX_CLIENTS_STATS_NEW_CLIENTS', 'New customers');


define('BOX_MENU_TOOLS_EMAILS', 'Email Newsletter');
define('BOX_MENU_TOOLS_MASS_EMAILS', 'Bulk Mailing');


define('BOX_EXEL_IMPORT_EXPORT', 'Excel import / export');
define('BOX_PROM_IMPORT_EXPORT', 'Prom.ua Excel import');
define('IMPORT_EXPORT_MENU_BOX', 'Import Export');

define('TEXT_ENABLE_MULTILANGUAGE_MODULE', 'Please enable the multilingual module');
define('TEXT_BUY_MULTILANGUAGE_MODULE', 'Please buy the multilingual module');

define('BOX_MENU_TAXES', 'Tax');


define('INTEGRATION_CONF_TITLE', 'Other Integrations');

define('BOX_HEADING_INSTRUCTION', 'Instructions');

define('BOX_CATALOG_YML', 'Import XML (YML)');
define('TOOLTIP_CATEGORY_STATUS', 'When activated, the category / subcategory / product is displayed on the site page');
define('TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS', 'To add a category / subcategory / product to Google Feed. To include only one product, the category and subcategory in which the product is located must be included.');
define('TOOLTIP_PRODUCTS_FEATURED', 'Displayed on the home page.');
define('TOOLTIP_PRODUCTS_RELATED', 'Displayed on the product page, in articles.');
define('TOOLTIP_PRODUCTS_ATTRIBUTES', 'Attributes (filters) allow you to define additional product characteristics such as size or color. Read more in the instructions: LINK');
define('TOOLTIP_ATTRIBUTES_VALUES', 'After creating the attribute, fill in the required values.');
define('TOOLTIP_ATTRIBUTES_GROUPS', 'To combine multiple attributes into one group.');
define('TOOLTIP_ATTRIBUTES_TYPES', 'Text - a textual description of the characteristics; Dropdown - selection from the drop-down list; Radio - to choose from the options provided; Image - the card changes when the item value is selected; Displayed on the product page.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_FILTER', 'To display product attributes in the filter panel, move the slider to make it active.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_LISTING', 'Hovering over a product displays the attributes in the product list.');
define('TOOLTIP_SPECIALS', 'To set a special price for one product.');
define('TOOLTIP_SALES_MAKERS', 'To set discounts for several or all categories of goods and / or manufacturers.');
define('TOOLTIP_EXPORT_IMPORT_CSV', 'To load / unload a database from a file with a .csv extension.');
define('TOOLTIP_EXPORT_IMPORT_PROM', 'To export a database from a file imported from Prom.');
define('TOOLTIP_ORDER_DATE', 'View orders for the selected time range.');
define('TOOLTIP_ORDER_DETAILS', 'order details');
define('TOOLTIP_ORDER_EDIT', 'edit order');
define('TOOLTIP_ORDER_STATUS', 'To add a new order status, click &quot;+&quot;');
define('TOOLTIP_CLIENT_EDIT', 'edit');
define('TOOLTIP_CLIENT_GROUP_PRICE', 'The price that will be displayed on the site for clients of a certain group after authorization. The number of prices is set in the &quot;My Shop&quot; section');
define('TOOLTIP_CLIENT_PRICE_GROUP_LIMIT', 'When the amount reaches the limit, you can transfer the client to another group.');
define('TOOLTIP_CLIENT_GROUP_EDIT', 'edit');
define('TOOLTIP_EMAIL_TEMPLATE', 'Ready-made letter templates for sending to clients.');
define('TOOLTIP_EMAIL_TEMPLATE_EDIT', 'edit');
define('TOOLTIP_FILE_MANAGER', 'To upload and edit files on the site.');
define('TOOLTIP_REDIRECTS', 'For example, you need to redirect from https://demo.solomono.net/kontakty to https://demo.solomono.net/contact_us.php. You need to specify in the line &quot;redirect from&quot; kontakty &quot;redirect to&quot; contact_us.php');
define('TOOLTIP_MODULES_PAYMENT', 'Add available payment methods.');
define('TOOLTIP_MODULES_SHIPPING', 'Add available shipping methods.');
define('TOOLTIP_MODULES_TOTALS', 'The total cost of the order is displayed on the checkout page.');
define('TOOLTIP_MODULES_ZONE', 'Specify the possible delivery methods for certain zones, as well as the allowed payment methods for these zones. You can create a new zone in the Settings-&gt; Taxes-&gt; Tax zones section');
define('TOOLTIP_MODULES_LANGUAGES', 'Selecting site languages, setting the default language.');
define('TOOLTIP_MODULES_CURRENCY', 'Set the default currency and set the value according to the rate.');
define('TOOLTIP_MODULES_COUPONS', 'Create a coupon for the customer to apply in the cart and get a discount.');
define('TOOLTIP_MODULES_POOLS', 'Create a survey to get the statistics you need.');
define('TOOLTIP_MODULES_SOLOMONO', 'List of purchased modules + list of available for purchase.');
define('TOOLTIP_CONFIGURATION_MAIN_EMAIL', 'The main address where all notifications arrive.');
define('TOOLTIP_CONFIGURATION_FROM_EMAIL', 'Specify the address from which name to send all letters in bulk mailings.');
define('TOOLTIP_CONFIGURATION_ORDER_COPY_EMAIL', 'Specify all addresses where copies of letters with orders will be sent. You can specify multiple e-mails, separated by commas with spaces.');
define('TOOLTIP_CONTACT_US_EMAIL', 'Specify the address where requests will be sent from the &quot;Contact us&quot; page');
define('TOOLTIP_STORE_COUNTRY', 'Specify the country of the store, it will be selected by default when placing an order.');
define('TOOLTIP_STORE_REGION', 'Specify the region of the store, it will be selected by default when placing an order.');
define('TOOLTIP_CONTACT_ADDRESS', 'Enter the store address, it will be displayed on the &quot;Contacts&quot; page.');
define('TOOLTIP_MINIMUM_ORDER', 'Optionally, you can specify the minimum amount for a successful ordering.');
define('TOOLTIP_MASTER_PASSWORD', 'The password that is suitable for entering the account of any client registered on the site.');
define('TOOLTIP_SHOW_PRICE_WITH_TAX', 'Move the slider to display the prices on all pages of the site, including tax.');
define('TOOLTIP_CALCULATE_TAX', 'If included, the set product tax at checkout will be considered.');
define('TOOLTIP_EXTRA_PRICE', 'Optionally, you can set a markup that will be displayed for unregistered users of the site.');
define('TOOLTIP_PRICES_COUNT', 'Indicate the possible number of prices that will be set for the goods (e.g., several prices for different groups of customers)');
define('TOOLTIP_SHOW_PRICE_TO_NOT_AUTHORIZED_CUSTOMER', 'Displaying product prices for unregistered users');
define('TOOLTIP_LOGO', 'Select the logo (image) to be displayed on the home page');
define('TOOLTIP_WATERMARK', 'Select an image to be superimposed on the product photo, copy protection.');
define('TOOLTIP_FAVICON', 'Select the image to be displayed by the website icon');
define('TOOLTIP_AUTO_STOCK', 'When placing an order, the number of goods in the warehouse and its availability for the order are automatically checked.');
define('TOOLTIP_DISABLED_BUY_BUTTON_FOR_ZERO_STOCK', 'On the page of a product that is out of stock, a &quot;buy&quot; button will be displayed.');
define('TOOLTIP_STOCK_AUTO_INCREMENT', 'When placing an order, the quantity of purchased goods is automatically deducted from the balance in the warehouse.');
define('TOOLTIP_ALLOW_ZERO_STOCK_ORDER', 'Allow placing an order for a product that is not in stock.');
define('TOOLTIP_MARK_ZERO_STOCK_PRODUCT', 'If the item added to the cart is not in the required quantity in stock, the item will be marked with the specified value.');
define('TOOLTIP_ZERO_STOCK_NOTIFICATION', 'When this quantity is reached, a notification is sent to the mail that the goods are running out.');
define('TOOLTIP_SMS_TEXT', 'Specify the text that will be sent to the client.');
define('TOOLTIP_SMS_LOGIN', 'Provided by sms provider.');
define('TOOLTIP_SMS_PASSWORD', 'Provided by sms provider.');
define('TOOLTIP_SMS_CODE_1', 'Phone number or alphanumeric sender.');
define('TOOLTIP_SMS_CODE_2', 'Provided by sms provider.');
define('TOOLTIP_TAX_ADD', 'To add a new type of tax, click &quot;+&quot; and fill in the required fields.');
define('TOOLTIP_TAX_RATE_ADD', 'To add a% rate that will be added to the cost of the product, click &quot;+&quot; and fill in the required fields.');
define('TOOLTIP_TAX_ZONE_ADD', 'To add a zone (country) to which the tax will apply, click &quot;+&quot; and fill in the required fields.');
define('TOOLTIP_BACKUP_CREATE', 'Create a backup copy of the current version of the site database.');
define('TOOLTIP_BACKUP_LOAD', 'Restoring the database from the selected file.');
define('TOOLTIP_EMAILING', 'Sending an e-mail to one customer, all customers or all news subscribers.');
define('TOOLTIP_MASS_EMAILING', 'Sending emails to an individual customer or to a selected group of customers.');
define('TOOLTIP_CLEAR_CACHE', 'Clearing uploaded images from cache.');
define('TOOLTIP_STATS_SALES', 'Display of sales statistics.');
define('TOOLTIP_STATS_SALES_PRODUCTS_BY_TIME_PERIOD', 'Sales report for ordered goods for the selected period of time.');
define('TOOLTIP_STATS_SALES_CATEGORIES_BY_TIME_PERIOD', 'Sales report by product categories for the selected time period.');
define('TOOLTIP_STATS_VIEWED_PRODUCTS', 'Statistics of viewed products.');
define('TOOLTIP_STATS_ZERO_QUANTITY_PRODUCTS', 'The product is out of stock.');
define('TOOLTIP_STATS_CLIENTS_ORDERS', 'Report on customer purchases for a selected period of time.');
define('TOOLTIP_ADMINISTRATORS', 'List of site administrators.');
define('TOOLTIP_ADMINISTRATORS_GROUPS', 'Separation of administrators into groups.');
define('TOOLTIP_ADMINISTRATORS_ACCESS_RIGHTS', 'Access rights to information on the site, depending on the group of administrators.');
define('TOOLTIP_TEXT_COPIED', 'Text copied');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY', 'buy');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON', 'turn on');
define('TOOLTIP_TEXT_TAB_LANGUAGES', 'Language functionality');
define('TOOLTIP_TEXT_TAB_AUTO_TRANSLATE', 'Automatic bulk translation of content');
define('TOOLTIP_TEXT_TAB_EDIT_TRANSLATE', 'Edit translations');

define('TOOLTIP_TELEGRAM_NOTIFICATIONS_ENABLED', 'You can enable/disable Telegram notifications');
define('TOOLTIP_TELEGRAM_TOKEN', 'Special Telegram accounts created to automatically process and send messages');
define('TOOLTIP_SMS_ENABLE', 'Can enable/disable sms service');
define('TOOLTIP_SMS_CUSTOMER_ENABLE', 'You can enable / disable the ability to send sms to the client upon purchase');
define('TOOLTIP_SMS_CHANGE_STATUS', 'You can enable / disable the ability to send sms to the client when changing the status');
define('TOOLTIP_SMS_OWNER_ENABLE', 'You can enable / disable the ability to send sms to the admin upon purchase');
define('TOOLTIP_SMS_OWNER_TEL', 'Enter/change administrator phone number');


define('TOOLTIP_FACEBOOK_AUTH_STATUS', 'You can allow users to sign in to your site with a Facebook account. This is a great way to make this process easier and more convenient for your users, as well as increase the number of new registrations.');
define('TOOLTIP_FACEBOOK_APP_ID', 'A social media ID is a combination of numbers that distinguishes one account from others. On the Internet, this is an analogue of a passport, which often needs the use of reliable methods of protection. An identification number is generated automatically when registering a profile. With it, you can find the information you need, a person or a community of interest.');
define('TOOLTIP_FACEBOOK_APP_SECRET', 'The secret key is a device to protect your Facebook account. It is also a two-factor authentication method that increases the level of security when logging into your account.');
define('TOOLTIP_FACEBOOK_PIXEL_ID', 'With the data that the Facebook Pixel collects, you can track visits and conversions on your site, optimize ads, and create custom audiences for retargeting.');
define('TOOLTIP_DEFAULT_PIXEL_CURRENCY', 'Specify the currency in which the product price will be sent to FaceBook Pixel');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_BUG_REPORT', 'It is intended to describe the detected bugs, which will allow the development team to fix the errors in the program.');
define('TOOLTIP_FACEBOOK_GOALS_PHONE_CALL', 'By running ads with a phone number, you can encourage people to call your company to place an order, learn more about your products or services, or schedule a meeting.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_FAST_BUY', 'If goods are bought regularly, often the characteristics are already known to the buyer, the task is not to choose, but to find the right one, add it to the basket and quickly place an order.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_CHAT', 'A chat button is an icon placed somewhere on your site that allows customers to communicate in real time with the customer support team. With the help of online chat, your specialists can quickly and efficiently resolve customer requests.');
define('TOOLTIP_FACEBOOK_GOALS_CALLBACK', 'The task of the callback button is to bring a potential client to communication.');
define('TOOLTIP_FACEBOOK_GOALS_FILTER', 'The filter makes it possible to narrow down the assortment to a selection with the characteristics that are most relevant to the individual needs of the user.');
define('TOOLTIP_FACEBOOK_GOALS_SUBSCRIBE', 'Provides users with the ability to organize and maintain thematic e-mail newsletters that other users of the service can subscribe to.');
define('TOOLTIP_FACEBOOK_GOALS_LOGIN', 'login is the word that will be used to enter the site or service. Very often, the login matches the username, which will be visible to all participants in the service.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_REVIEW', 'Customer Reviews - Feedback from users on your products or services. To buy a product, 89% of buyers read reviews first.');
define('TOOLTIP_FACEBOOK_GOALS_PAGE_VIEW', 'You can know how many people have seen and requested your site');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_CART', 'The "Add to Cart" button implies the purchase of several products, when they are first added to the basket and an order is already placed there.');
define('TOOLTIP_FACEBOOK_GOALS_CHECKOUT_PROCESS', 'The quality and convenience of using the shopping cart is a guarantee of a good mood for your customers, an effective way to increase website conversion.');
define('TOOLTIP_FACEBOOK_GOALS_SEARCH_RESULTS', 'Takes the user to the search results page');
define('TOOLTIP_FACEBOOK_GOALS_VIEW_CONTENT', 'ViewContent tells you if someone is visiting the URL of a web page.');
define('TOOLTIP_FACEBOOK_GOALS_COMPLETE_REGISTRATION', 'Providing information by a client in exchange for a service provided by your company');
define('TOOLTIP_FACEBOOK_GOALS_CONTACT_US_REQUEST', 'Contact details of a person who has shown a real interest in the company\'s products and services and may become a real client in the future.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_WISHLIST', 'One of the events that allows you to monitor user actions, optimize them and create audiences');
define('TOOLTIP_FACEBOOK_GOALS_ADD_PAYMENT_INFO', 'One of the events that allows you to monitor user actions, optimize them and create audiences');
define('TOOLTIP_FACEBOOK_GOALS_SUCCESS_PAGE', 'The client sees a kind of invoice about the perfect order.');


define('TOOLTIP_GOOGLE_OAUTH_STATUS', 'Ability to enable/disable client authorization via Google');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_ID', 'By default, Google assigns a unique client ID - Client ID.');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_SECRET', 'CLIENT_SECRET is used to store slightly more sensitive information such as api usage, traffic information and billing information');
define('TOOLTIP_GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED', 'Has an event tracking tool, allows services to collect data and conduct analysis');
define('TOOLTIP_GOOGLE_ECOMM_SUCCESS_PAGE', 'Ability to enable/disable the "purchase" page after order confirmation');
define('TOOLTIP_GOOGLE_ECOMM_CHECKOUT_PAGE', 'Ability to enable/disable the checkout page');
define('TOOLTIP_GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE', 'Ability to enable/disable the product view page');
define('TOOLTIP_GOOGLE_ECOMM_SEARCH_RESULTS', 'Ability to enable/disable search results page');
define('TOOLTIP_GOOGLE_ECOMM_HOME_PAGE', 'Ability to enable / disable the start page when loading the browser');
define('TOOLTIP_GOOGLE_SITE_VERIFICATION_KEY', 'Key provided by Google (it is necessary to insert only the key itself)');
define('TOOLTIP_GOOGLE_RECAPTCHA_STATUS', 'You can turn on/off Google Recaptcha (protecting websites from Internet bots and at the same time helping to digitize book texts)');
define('TOOLTIP_GOOGLE_RECAPTCHA_PUBLIC_KEY', 'Provides a Google service (to protect websites from Internet bots and at the same time help in the digitization of texts of books)');
define('TOOLTIP_GOOGLE_RECAPTCHA_SECRET_KEY', 'Provides a Google service (to protect websites from Internet bots and at the same time help in the digitization of texts of books)');




define('TOOLTIP_ENTRY_FIRST_NAME_MIN_LENGTH', "Specify the minimum number of characters in the 'Value' column for each parameter");
define('TOOLTIP_ENTRY_LAST_NAME_MIN_LENGTH', "Specify the minimum number of characters in the 'Value' column for each parameter");
define('TOOLTIP_ENTRY_EMAIL_ADDRESS_MIN_LENGTH', "Specify the minimum number of characters in the 'Value' column for each parameter");
define('TOOLTIP_MIN_DISPLAY_XSELL', "Specify the minimum number of characters in the 'Value' column for each parameter");

define('HIGHSLIDE_CLOSE', 'Close');
define('COMMENT_BY_ADMIN', 'Comment by admin');
define('AUTO_TRANSLATE_MODULE_ENABLED_TITLE', 'Automatic translation');
define('TEXT_CLOSE_BUTTON', 'Close');
define('TEXT_MENU_WHO_IS_ONLINE', 'Who is online');
define('INFO_ICON_NEED_MINIFY', 'Any changes in this module will change the status of the styles to Minify Now');
define('INFO_ICON_ENABLE_SMTP', 'When switching on, check the settings of the SMTP');
define('SMTP_CONF_TITLE', 'SMTP Settings');
define('INFO_ICON_NEED_GENERATE_CRITICAL', 'Changes to this parameter require Critical CSS regeneration');
define('YANDEX_MARKET_MODULE_ENABLED_TITLE', 'XML (YML) products export "Yandex Market"');
define('TEXT_INFO_BUY_MODULE', 'The module «%s» is disabled, to turn it on, use the page <a href="%s"><span style="color:blue;" >Modules</span></a>');
define('TEXT_INFO_DISABLE_MODULE', 'There is no «%s» module, to add it, use <a href="%s"><span style="color:blue;" >SoloMono Modules Store</span></a>');
define("TEXT_POPULAR_SEARCH_QUERIES", "Popular searches");
define("STATS_KEYWORDS_POPULAR_ENABLED_TITLE", "Search pages");
define("LIST_MODAL_ON","Product modal");
define("SHOW_BASKET_ON_ADD_TO_CART_TITLE","Show cart when adding item");
define("TEXT_QUICK_ORDER", "Quick order");
define("TEXT_VIEWED","Viewed");
define('EMAIL_CONTENT_MODULE_ENABLED_TITLE', 'Email Templates');
define('ENTRY_CREDIT_CARD_CC_TYPE', 'Card Type');
define('ENTRY_CREDIT_CARD_CC_OWNER', 'Card Owner');
define('ENTRY_CREDIT_CARD_CC_NUMBER', 'Card Number');
define('ENTRY_CREDIT_CARD_CC_EXPIRES', ' Card Expires');
define('TEXT_SEARCH_PAGES','Search pages');
define('SMTP_MODULE_ENABLED_TITLE','SMTP');

define('LEFT_MENU_SECTION_TITLE_SHOP','Store');
define('LEFT_MENU_SECTION_TITLE_INFO','Info');
define('LEFT_MENU_SECTION_TITLE_CONTROL','Control');
define('TBL_LINK_TITLE', 'Ajax categories');
define('TBL_HEADING_TITLE_BACK_TO_PARENT', 'Back');
define('TBL_HEADING_TITLE_SEARCH', 'Search');
define('TBL_HEADING_CATEGORIES_PRODUCTS', 'Category/Products');
define('TBL_HEADING_MODEL', 'Cod');
define('TBL_HEADING_QUANTITY', 'Qty');
define('TBL_HEADING_PRICE', 'Price');
define('TBL_HEADING_TITLE_BACK_TO_DEFAULT_ADMIN', 'Back To Default Administration');
define('TBL_HEADING_PRODUCTS_COUNT', ' products');
define('TBL_HEADING_SUBCATEGORIES_COUNT', ' subcategories');
define('TBL_HEADING_SUBCATEGORIE_COUNT', ' subcategory');
define('INTEGRATION_FACEBOOK_CONF_TITLE','Integration Facebook');
define('INTEGRATION_GOOGLE_CONF_TITLE','Integration GOOGLE');
define('SEO_SETTINGS_CONF_TITLE','SEO Settings');

define('NWPOSHTA_DELIVERY_TITLE', 'New mail delivery address');

define('HEADER_BUY_TEMPLATE_LINK','Switch to paid package');
define('HEADER_MARKETPLACE_LINK','Modules marketplace');
define('TEXT_CATEGORIES', 'Categories');
define('HEADING_TITLE_GOTO', 'Go to:');
define('ERROR_DOMAIN_IN_USE','Error! This domain is already in use');
define('ERROR_ANAME_MISMATCH', 'Error! A-name doesn`t match 167.172.41.152. Try later');
define('SUCCESS_DOMAIN_CHANGE', 'Success! Domain changed');
define('ERROR_ADD_DOMAIN_FIRST','Connect your custom domain first!');
define('ERROR_BASH_EXECUTION','Error executing script, contact manager');
define('PRODUCTS_LIMIT_REACHED_FREE', 'Product limit exceeded! Your site will be automatically disabled in %s days. <a href="%s">Rent a fee</a> or remove unwanted products');
define('PRODUCTS_LIMIT_REACHED_JUNIOR', 'Product limit exceeded! In %s days your site will be automatically upgraded to seo package.');
define('PRODUCTS_LIMIT_REACHED_SEO', 'Product limit exceeded! In %s days your site will be automatically upgraded to pro package');
define('PRODUCTS_LIMIT_REACHED_HEADING', 'Product limit exceeded!');
define('ERROR_SIMLINK_CREATE', 'Symlink not created');
define('ERROR_FOLDER_RENAME', 'Folder not copied');
