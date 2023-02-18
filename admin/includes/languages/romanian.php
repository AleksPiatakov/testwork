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
define('TEXT_MENU_REVIEWS', 'Opinii');
define('SQL_MODE_RECOMMENDATION_TEXT', "For further correct work, you need to contact the hosting administration to reset the sql_mode variable in Mysql");
define('ROBOTS_TXT_RECOMMENDATION_TEXT', 'Robots.txt is not included on your site, for successful promotion we recommend that you enable it on <a target="_blank" href="/'.$admin.'/configuration.php?gID=1">page</a>');
define('CRITICAL_CSS_TXT_RECOMMENDATION_TEXT', '<span class="critical-text">Trebuie să generați CSS critice</span> <span class="critical-process">Se procesează...vă rugăm să așteptați</span><a class="start-generate-critical" href="javascript:void(0);">Start</a>');
define('ALERT_ERRORS_BLOCK_TITLE', 'Alerte');
define('DOMEN_IN_ROBOTS_TXT_RECOMMENDATION_TEXT', '<span class="robots-txt-text">în Robots.txt directiva Gazdă nu se potrivește cu numele site-ului dvs., pentru promovarea cu succes o recomandăm</span> <span class="generate-robots-txt-process">Se procesează... așteptați</span><a class="start-generate-robots-txt" href="javascript:void(0);"> a regenera</a>');

define('IMAGE_MEMBERS', 'Members List');
define('IMAGE_NEW_GROUP', 'New Group');
define('IMAGE_NEW_MEMBER', 'New Member');
define('IMAGE_NEXT', 'Next');

define('ONE_PAGE_CHECKOUT_TITLE', 'Checkout');
define('BROWSE_BY_CATEGORIES_TITLE', 'Browse by categories');
define('HEADER_FRONT_LINK_TEXT', 'Go to site');
define('SEO_TITLE', 'SEO URLs');


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
define('HEADER_GO_TO_SITE', 'Accesați site-ul');

// MaxiDVD Added Line For WYSIWYG HTML Area: BOF
define('BOX_CATALOG_DEFINE_MAINPAGE', 'Define MainPage');
// MaxiDVD Added Line For WYSIWYG HTML Area: EOF
define('BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI', 'Multiedit products');
define('BOX_TOOLS_COMMENT8R', 'Comments');
define('BOX_TOOLS_MYSQL_PERFORMANCE', 'Slow queries');
define('BOX_GOOGLE_SITEMAP', 'Google SiteMaps');
define('BOX_CLEAR_IMAGE_CACHE', 'Clear image cache');


define('TOOLTIP_STORE_NAME', 'Indicați numele original al magazinului care atrage clienți, este reținut de clienți și servește pentru a ieși în evidență și a se distinge de magazinele similare - concurenți.');
define('TOOLTIP_STORE_OWNER', 'Specificați proprietarul magazinului');
define('TOOLTIP_SHOW_BASKET_ON_ADD_TO_CART', 'Activați, coșul va fi disponibil la adăugarea unui produs, astfel încât vizitatorul să nu aibă întrebări că produsul a fost adăugat în coș.');
define('TOOLTIP_USE_DEFAULT_LANGUAGE_CURRENCY', 'Activați schimbarea automată a monedei în funcție de limba actuală a site-ului.');
define('TOOLTIP_CHANGE_BY_GEOLOCATION', 'Activați pentru a schimba moneda și limba site-ului în funcție de localizare geografică.');
define('TOOLTIP_GET_BROWSER_LANGUAGE', 'Activați modificarea monedei site-ului în funcție de limba browserului.');
define('TOOLTIP_STORE_BANK_INFO', 'Vă permite să definiți informații bancare exacte pentru detaliile facturii');
define('TOOLTIP_ONEPAGE_LOGIN_REQUIRED', 'Activarea și autentificarea utilizator/client va fi întotdeauna necesară');
define('TOOLTIP_REVIEWS_WRITE_ACCESS', 'Activați și numai utilizatorii înregistrați își vor putea lăsa comentariile');
define('TOOLTIP_ROBOTS_TXT', 'Protejarea întregului site sau a unora dintre secțiunile acestuia împotriva indexării');
define('TOOLTIP_MENU_LOCATION', 'Selectați poziția meniului: sus, stânga sau stânga restrâns');
define('TOOLTIP_DEFAULT_DATE_FORMAT', 'Alegeți formatul de dată');
define('TOOLTIP_SET_HTTPS', 'Activați extensia de protocol HTTPS pentru a accepta criptarea pentru o securitate sporită');
define('TOOLTIP_SET_WWW', 'Selectați setarea unde să redirecționați: dezactivați, www->no-www sau no-www->www');
define('TOOLTIP_ENABLE_DEBUG_PAGE_SPEED', 'Activați depanarea încărcării paginii pentru a găsi și remedia erorile din script');
define('TOOLTIP_STORE_SCRIPTS', 'Puteți include scripturi JS suplimentare');
define('TOOLTIP_STORE_METAS', 'Puteți include metaetichete suplimentare în cap');
define('TOOLTIP_MYSQL_PERFORMANCE_TRESHOLD', 'Setați timpul în „secunde” peste care interogările lente și potențial problematice vor fi înregistrate în baza de date');







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
define('BOX_CATALOG_STATS_SEARCH_KEYWORDS', "Planificator de cuvinte cheie");
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
define('BOX_CATALOG_SEO_TEMPALTES', "Șabloane SEO");
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

define('IMAGE_BUTTON_BUY_TEMPLATE','Comută la pachet plătit');
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
define('BOX_HEADING_INFORMATION', 'Conţinut');
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

define('TEXT_NEW_ATTRIBUTE_EDIT', 'Edit productc attributes');

define('SMS_ENABLE_TITLE', 'Turn on sms-service');
define('SMS_GATENAME_TITLE', 'SMS gatename');
define('SMS_CUSTOMER_ENABLE_TITLE', 'Sent sms to customer on checkout?');
define('TELEGRAM_TOKEN_TITLE','Telegram Token');
define('TELEGRAM_NOTIFICATIONS_ENABLED_TITLE','Enable Telegram notifications');
define('SMS_CHANGE_STATUS_TITLE', 'Sent sms to customer on change order status?');
define('SMS_OWNER_ENABLE_TITLE', 'Sent sms to admin on checkout?');
define('SMS_OWNER_ENABLE_BUY_ONE_CLICK_TITLE', 'Trimiteți sms administratorului când cumpărați cu un singur clic?');
define('SMS_OWNER_TEL_TITLE', 'Admin tel. number');
define('SMS_TEXT_TITLE', 'text sms');
define('SMS_LOGIN_TITLE', 'Conectați-vă la gateway-ul SMS (sau cheia API, Account SID)');
define('SMS_PASSWORD_TITLE', 'pass (or Auth token)');
define('SMS_SIGN_TITLE', 'Expeditor (or Service SID)');
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
define('GOOGLE_FEED_CHOOSE_ALL_PRODUCTS_TITLE', 'produsele active');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_2_TITLE', 'produsele cu statut XML activ');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_3_TITLE', 'produsele cu disponibilitate în stoc');
define('XSELL_PRODUCTS_BUYNOW_ENABLED_TITLE', 'Produse asemanatoare');
define('STATS_PRODUCTS_PURCHASED_BY_CATEGORY_MODULE_ENABLED_TITLE', 'Report - Products purchased (by Category)');
define('SALEMAKER_MODULE_ENABLED_TITLE', 'Mass Discounts (SaleMaker)');
define('SPECIALS_MODULE_ENABLED_TITLE', 'Reduceri');
define('STATS_KEYWORDS_ENABLED_TITLE', 'Interogări de căutare');
define('BACKUP_ENABLED_TITLE', 'Database Backup');
define('PRODUCTS_MULTI_ENABLED_TITLE', 'Products multi-manager');
define('SEO_TEMPLATES_ENABLED_TITLE', 'Șabloane SEO');
define('SHIP2PAY_ENABLED_TITLE', 'Ship 2 Pay');
define('QTY_PRO_ENABLED_TITLE', 'Combinații de atribute');
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
define('TEXT_MENU_ORDERS_LIST', 'Orders List');
define('TEXT_MENU_CLIENTS_LIST', 'Customer List');
define('TEXT_MENU_CLIENTS_GROUPS', 'Customer Groups');
define('TEXT_MENU_ADD_CLIENT', 'Add Customer');
define('TEXT_MENU_PAGES', 'Pages');
define('TEXT_MENU_SITE_MODULES', 'SOLO modules');
define('TEXT_MENU_SITE_SEO_SETTINGS', 'Setări SEO');
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
define('TEXT_MENU_SEARCH', 'Căutare după categorie');

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
define('TOOLTIP_STOCK_REORDER_LEVEL', 'Precizati cantitatea de marfa din stoc');

define('TOOLTIP_TELEGRAM_NOTIFICATIONS_ENABLED', 'Puteți activa/dezactiva notificările Telegram');
define('TOOLTIP_TELEGRAM_TOKEN', 'Conturi speciale Telegram create pentru a procesa și trimite automat mesaje');
define('TOOLTIP_SMS_ENABLE', 'Poate activa/dezactiva serviciul sms');
define('TOOLTIP_SMS_CUSTOMER_ENABLE', 'Puteți activa/dezactiva posibilitatea de a trimite sms-uri către client la cumpărare');
define('TOOLTIP_SMS_CHANGE_STATUS', 'Puteți activa/dezactiva posibilitatea de a trimite sms către client atunci când schimbați starea');
define('TOOLTIP_SMS_OWNER_ENABLE', 'Puteți activa/dezactiva capacitatea de a trimite sms-uri către administrator la cumpărare');
define('TOOLTIP_SMS_OWNER_TEL', 'Introduceți/modificați numărul de telefon al administratorului');


define('TOOLTIP_FACEBOOK_AUTH_STATUS', 'Puteți permite utilizatorilor să se conecteze la site-ul dvs. cu un cont Facebook. Aceasta este o modalitate excelentă de a face acest proces mai ușor și mai convenabil pentru utilizatorii dvs., precum și de a crește numărul de noi înregistrări.');
define('TOOLTIP_FACEBOOK_APP_ID', 'Un ID de social media este o combinație de numere care distinge un cont de alții. Pe Internet, acesta este un analog al pașaportului, care necesită adesea utilizarea unor metode de protecție fiabile. Un număr de identificare este generat automat la înregistrarea unui profil. Cu el, puteți găsi informațiile de care aveți nevoie, o persoană sau o comunitate de interese.');
define('TOOLTIP_FACEBOOK_APP_SECRET', 'Cheia secretă este un dispozitiv pentru a vă proteja contul de Facebook. Este, de asemenea, o metodă de autentificare cu doi factori care crește nivelul de securitate atunci când vă conectați la contul dvs.');
define('TOOLTIP_FACEBOOK_PIXEL_ID', 'Cu datele pe care le colectează Facebook Pixel, puteți urmări vizitele și conversiile pe site-ul dvs., puteți optimiza reclamele și puteți crea segmente de public personalizate pentru redirecționare.');
define('TOOLTIP_DEFAULT_PIXEL_CURRENCY', 'Specificați moneda în care prețul produsului va fi trimis către FaceBook Pixel');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_BUG_REPORT', 'Este destinat să descrie erorile detectate, ceea ce va permite echipei de dezvoltare să repare erorile din program.');
define('TOOLTIP_FACEBOOK_GOALS_PHONE_CALL', 'Prin difuzarea de anunțuri cu un număr de telefon, puteți încuraja oamenii să vă sune compania pentru a plasa o comandă, pentru a afla mai multe despre produsele sau serviciile dvs. sau pentru a programa o întâlnire.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_FAST_BUY', 'Dacă mărfurile sunt cumpărate în mod regulat, adesea caracteristicile sunt deja cunoscute de cumpărător, sarcina nu este să o alegeți, ci să o găsiți pe cea potrivită, să o adăugați în coș și să plasați rapid o comandă.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_CHAT', 'Un buton de chat este o pictogramă plasată undeva pe site-ul dvs. care permite clienților să comunice în timp real cu echipa de asistență pentru clienți. Cu ajutorul chat-ului online, specialiștii tăi pot rezolva rapid și eficient solicitările clienților.');
define('TOOLTIP_FACEBOOK_GOALS_CALLBACK', 'Sarcina butonului de apel invers este de a aduce un potențial client la comunicare.');
define('TOOLTIP_FACEBOOK_GOALS_FILTER', 'Filtrul face posibilă restrângerea sortimentului la o selecție cu caracteristicile care sunt cele mai relevante pentru nevoile individuale ale utilizatorului.');
define('TOOLTIP_FACEBOOK_GOALS_SUBSCRIBE', 'Oferă utilizatorilor posibilitatea de a organiza și menține buletine informative tematice prin e-mail la care alți utilizatori ai serviciului se pot abona.');
define('TOOLTIP_FACEBOOK_GOALS_LOGIN', 'autentificare este cuvântul care va fi folosit pentru a intra pe site sau serviciu. Foarte des, autentificarea se potrivește cu numele de utilizator, care va fi vizibil pentru toți participanții la serviciu.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_REVIEW', 'Recenziile clienților - Feedback de la utilizatori cu privire la produsele sau serviciile dvs. Pentru a cumpăra un produs, 89% dintre cumpărători citesc mai întâi recenziile.');
define('TOOLTIP_FACEBOOK_GOALS_PAGE_VIEW', 'Puteți ști câte persoane au văzut și au solicitat site-ul dvs');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_CART', 'Butonul „Adaugă în coș” implică achiziția mai multor produse, atunci când acestea sunt adăugate pentru prima dată în coș și o comandă este deja plasată acolo.');
define('TOOLTIP_FACEBOOK_GOALS_CHECKOUT_PROCESS', 'Calitatea și comoditatea utilizării coșului de cumpărături este o garanție a bunei dispoziții pentru clienții dvs., o modalitate eficientă de a crește conversia site-ului.');
define('TOOLTIP_FACEBOOK_GOALS_SEARCH_RESULTS', 'Conduce utilizatorul la pagina cu rezultatele căutării');
define('TOOLTIP_FACEBOOK_GOALS_VIEW_CONTENT', 'ViewContent vă spune dacă cineva vizitează adresa URL a unei pagini web.');
define('TOOLTIP_FACEBOOK_GOALS_COMPLETE_REGISTRATION', 'Furnizarea de informații de către un client în schimbul unui serviciu furnizat de compania dumneavoastră');
define('TOOLTIP_FACEBOOK_GOALS_CONTACT_US_REQUEST', 'Datele de contact ale unei persoane care și-a manifestat un interes real pentru produsele și serviciile companiei și poate deveni un adevărat client în viitor.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_WISHLIST', 'Unul dintre evenimentele care vă permite să monitorizați acțiunile utilizatorilor, să le optimizați și să creați audiențe');
define('TOOLTIP_FACEBOOK_GOALS_ADD_PAYMENT_INFO', 'Unul dintre evenimentele care vă permite să monitorizați acțiunile utilizatorilor, să le optimizați și să creați audiențe');
define('TOOLTIP_FACEBOOK_GOALS_SUCCESS_PAGE', 'Clientul vede un fel de factura despre comanda perfecta.');

define('TOOLTIP_GOOGLE_OAUTH_STATUS', 'Posibilitatea de a activa/dezactiva autorizarea clientului prin Google');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_ID', 'În mod implicit, Google atribuie un ID de client unic - ID de client.');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_SECRET', 'CLIENT_SECRET este folosit pentru a stoca informații ceva mai sensibile, cum ar fi utilizarea API-ului, informațiile despre trafic și informațiile de facturare');
define('TOOLTIP_GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED', 'Are un instrument de urmărire a evenimentelor, permite serviciilor să colecteze date și să efectueze analize');
define('TOOLTIP_GOOGLE_ECOMM_SUCCESS_PAGE', 'Posibilitatea de a activa/dezactiva pagina „cumpărare” după confirmarea comenzii');
define('TOOLTIP_GOOGLE_ECOMM_CHECKOUT_PAGE', 'Posibilitatea de a activa/dezactiva pagina de plată');
define('TOOLTIP_GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE', 'Posibilitatea de a activa/dezactiva pagina de vizualizare a produsului');
define('TOOLTIP_GOOGLE_ECOMM_SEARCH_RESULTS', 'Posibilitatea de a activa/dezactiva pagina cu rezultatele căutării');
define('TOOLTIP_GOOGLE_ECOMM_HOME_PAGE', 'Posibilitatea de a activa/dezactiva pagina de pornire la încărcarea browserului');
define('TOOLTIP_GOOGLE_SITE_VERIFICATION_KEY', 'Cheie furnizată de Google ()');
define('TOOLTIP_GOOGLE_RECAPTCHA_STATUS', 'Puteți activa/dezactiva Google Recaptcha (protejând site-urile web de roboții de pe Internet și, în același timp, ajutând la digitizarea textelor cărților)');
define('TOOLTIP_GOOGLE_RECAPTCHA_PUBLIC_KEY', 'Oferă un serviciu Google (pentru a proteja site-urile web de roboții de pe Internet și, în același timp, ajută la digitizarea textelor cărților)');
define('TOOLTIP_GOOGLE_RECAPTCHA_SECRET_KEY', 'Oferă un serviciu Google (pentru a proteja site-urile web de roboții de pe Internet și, în același timp, ajută la digitizarea textelor cărților)');



define('TOOLTIP_ENTRY_FIRST_NAME_MIN_LENGTH', "Specificați numărul minim de caractere în coloana 'Valoare' pentru fiecare parametru");
define('TOOLTIP_ENTRY_LAST_NAME_MIN_LENGTH', "Specificați numărul minim de caractere în coloana 'Valoare' pentru fiecare parametru");
define('TOOLTIP_ENTRY_EMAIL_ADDRESS_MIN_LENGTH', "Specificați numărul minim de caractere în coloana 'Valoare' pentru fiecare parametru");
define('TOOLTIP_MIN_DISPLAY_XSELL', "Specificați numărul minim de caractere în coloana 'Valoare' pentru fiecare parametru");

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
define('TEXT_SHOW', 'Show');
define('TEXT_RECORDS', 'Records');
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

define('INSTAGRAM_MODULE_ENABLE_TITLE', 'Diapozitive Instagram');
define('TEXT_ENABLE_MULTILANGUAGE_MODULE', 'Vă rugăm să activați modulul multilingv');
define('TEXT_BUY_MULTILANGUAGE_MODULE', 'Vă rugăm să cumpărați modulul multilingv');

















define('BOX_PRODUCTS_STATS_MENU_ITEM', 'Produse');


define('BOX_CLIENTS_STATS_TOP_CLIENTS', 'Clienți de top');
define('BOX_CLIENTS_STATS_NEW_CLIENTS', 'Clienti noi');


define('BOX_MENU_TOOLS_EMAILS', 'Email Newsletter');
define('BOX_MENU_TOOLS_MASS_EMAILS', 'Distributie in vrac');


define('BOX_EXEL_IMPORT_EXPORT', 'Excel import / export');
define('BOX_PROM_IMPORT_EXPORT', 'Prom.ua Import Excel');
define('IMPORT_EXPORT_MENU_BOX', 'Import Export');


define('BOX_MENU_TAXES', 'Impozit');


define('INTEGRATION_CONF_TITLE', 'Alte integrări');

define('BOX_HEADING_INSTRUCTION', 'Instrucțiuni');

define('BOX_CATALOG_YML', 'Import YML');
define('TOOLTIP_CATEGORY_STATUS', 'Când este activat, categoria / subcategoria / produsul este afișat pe pagina site-ului');
define('TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS', 'Pentru a adăuga o categorie / subcategorie / produs în Google Feed. Pentru a include un singur produs - categoria și subcategoria în care se află produsul trebuie să fie incluse.');
define('TOOLTIP_PRODUCTS_FEATURED', 'Afișat pe pagina principală.');
define('TOOLTIP_PRODUCTS_RELATED', 'Afișat pe pagina produsului, în articole.');
define('TOOLTIP_PRODUCTS_ATTRIBUTES', 'Atributele (filtre) vă permit să definiți caracteristici suplimentare ale produsului, cum ar fi dimensiunea sau culoarea. Citiți mai multe în instrucțiuni: LINK');
define('TOOLTIP_ATTRIBUTES_VALUES', 'După crearea atributului, completați valorile necesare.');
define('TOOLTIP_ATTRIBUTES_GROUPS', 'Pentru a combina mai multe atribute într-un singur grup.');
define('TOOLTIP_ATTRIBUTES_TYPES', 'Text - o descriere textuală a caracteristicilor; Dropdown - selecție din lista derulantă; Radio - pentru a alege dintre opțiunile oferite; Imagine - cardul se schimbă la selectarea valorii articolului; Afișat pe pagina produsului.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_FILTER', 'Pentru a afișa atributele produsului în panoul filtrului, mutați glisorul pentru a-l activa.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_LISTING', 'Trecerea peste un produs afișează atributele din lista de produse.');
define('TOOLTIP_SPECIALS', 'Pentru a stabili un preț special pentru un produs.');
define('TOOLTIP_SALES_MAKERS', 'Pentru a stabili reduceri pentru mai multe sau toate categoriile de bunuri și / sau producători.');
define('TOOLTIP_EXPORT_IMPORT_CSV', 'Pentru a încărca / descărca o bază de date dintr-un fișier cu o extensie .csv.');
define('TOOLTIP_EXPORT_IMPORT_PROM', 'Pentru a exporta o bază de date dintr-un fișier importat din Prom.');
define('TOOLTIP_ORDER_DATE', 'Vizualizați comenzile pentru intervalul de timp selectat.');
define('TOOLTIP_ORDER_DETAILS', 'Comanda Detalii');
define('TOOLTIP_ORDER_EDIT', 'comanda de editare');
define('TOOLTIP_ORDER_STATUS', 'Pentru a adăuga o nouă stare a comenzii, faceți clic pe &quot;+&quot;');
define('TOOLTIP_CLIENT_EDIT', 'Editați | ×');
define('TOOLTIP_CLIENT_GROUP_PRICE', 'Prețul care va fi afișat pe site pentru clienții unui anumit grup după autorizare. Numărul prețurilor este stabilit în secțiunea „Magazinul meu”');
define('TOOLTIP_CLIENT_PRICE_GROUP_LIMIT', 'Când suma atinge limita, puteți transfera clientul către un alt grup.');
define('TOOLTIP_CLIENT_GROUP_EDIT', 'Editați | ×');
define('TOOLTIP_EMAIL_TEMPLATE', 'Șabloane de scrisori gata pregătite pentru trimiterea către clienți.');
define('TOOLTIP_EMAIL_TEMPLATE_EDIT', 'Editați | ×');
define('TOOLTIP_FILE_MANAGER', 'Pentru a încărca și edita fișiere pe site.');
define('TOOLTIP_REDIRECTS', 'De exemplu, trebuie să redirecționați de la https://demo.solomono.net/kontakty la https://demo.solomono.net/contact_us.php. Trebuie să specificați în linia „redirecționare de la„ kontakty ”redirecționare la„ contact_us.php');
define('TOOLTIP_MODULES_PAYMENT', 'Adăugați metode de plată disponibile.');
define('TOOLTIP_MODULES_SHIPPING', 'Adăugați metode de expediere disponibile.');
define('TOOLTIP_MODULES_TOTALS', 'Costul total al comenzii este afișat pe pagina de checkout.');
define('TOOLTIP_MODULES_ZONE', 'Specificați metodele posibile de livrare pentru anumite zone, precum și metodele de plată permise pentru aceste zone. Puteți crea o zonă nouă în Setări-&gt; Impozite-&gt; Zonele fiscale');
define('TOOLTIP_MODULES_LANGUAGES', 'Selectarea limbilor site-ului, setarea limbii implicite.');
define('TOOLTIP_MODULES_CURRENCY', 'Setați moneda implicită și setați valoarea în funcție de tarif.');
define('TOOLTIP_MODULES_COUPONS', 'Creați un cupon pentru ca clientul să aplice în coș și să primească o reducere.');
define('TOOLTIP_MODULES_POOLS', 'Creați un sondaj pentru a obține statisticile de care aveți nevoie.');
define('TOOLTIP_MODULES_SOLOMONO', 'Lista modulelor cumpărate + lista celor disponibile pentru cumpărare.');
define('TOOLTIP_CONFIGURATION_MAIN_EMAIL', 'Adresa principală unde sosesc toate notificările.');
define('TOOLTIP_CONFIGURATION_FROM_EMAIL', 'Specificați adresa de la ce nume să trimiteți toate scrisorile prin trimiteri în vrac.');
define('TOOLTIP_CONFIGURATION_ORDER_COPY_EMAIL', 'Specificați toate adresele unde vor fi trimise copii ale scrisorilor cu comenzi. Puteți specifica mai multe e-mail-uri, separate prin virgule cu spații.');
define('TOOLTIP_CONTACT_US_EMAIL', 'Specificați adresa unde vor fi trimise cererile de pe pagina „Contactați-ne”');
define('TOOLTIP_STORE_COUNTRY', 'Specificați țara magazinului, acesta va fi selectat implicit la plasarea unei comenzi.');
define('TOOLTIP_STORE_REGION', 'Precizați regiunea magazinului, acesta va fi selectat implicit la plasarea unei comenzi.');
define('TOOLTIP_CONTACT_ADDRESS', 'Introdu adresa de magazin, aceasta va fi afișată pe pagina „Contacte”.');
define('TOOLTIP_MINIMUM_ORDER', 'Opțional, puteți specifica suma minimă pentru o comandă reușită.');
define('TOOLTIP_MASTER_PASSWORD', 'Parola care este potrivită pentru a intra în contul oricărui client înregistrat pe site.');
define('TOOLTIP_SHOW_PRICE_WITH_TAX', 'Mutați glisorul pentru a afișa prețurile pe toate paginile site-ului, inclusiv taxele.');
define('TOOLTIP_CALCULATE_TAX', 'Dacă este inclus, taxa de produs stabilită va fi luată în considerare la finalizare.');
define('TOOLTIP_EXTRA_PRICE', 'Opțional, puteți seta un marcaj care va fi afișat pentru utilizatorii neînregistrați ai site-ului.');
define('TOOLTIP_PRICES_COUNT', 'Indicați numărul posibil de prețuri care vor fi stabilite pentru mărfuri (de exemplu, mai multe prețuri pentru diferite grupuri de clienți)');
define('TOOLTIP_SHOW_PRICE_TO_NOT_AUTHORIZED_CUSTOMER', 'Afișarea prețurilor produselor pentru utilizatorii neînregistrați');
define('TOOLTIP_LOGO', 'Selectați logo-ul (imaginea) care va fi afișat pe pagina de pornire');
define('TOOLTIP_WATERMARK', 'Selectați o imagine care urmează să fie suprapusă fotografiei produsului, protecție la copiere.');
define('TOOLTIP_FAVICON', 'Selectați imaginea care va fi afișată de pictograma site-ului web');
define('TOOLTIP_AUTO_STOCK', 'La plasarea unei comenzi, se verifică automat numărul de mărfuri din depozit și disponibilitatea acestuia pentru comandă.');
define('TOOLTIP_DISABLED_BUY_BUTTON_FOR_ZERO_STOCK', 'Pe pagina unui produs care nu este disponibil, va fi afișat un buton „cumpăra”.');
define('TOOLTIP_STOCK_AUTO_INCREMENT', 'La plasarea unei comenzi, suma mărfurilor cumpărate se scade automat din soldul din depozit.');
define('TOOLTIP_ALLOW_ZERO_STOCK_ORDER', 'Permiteți plasarea unei comenzi pentru un produs care nu este în stoc.');
define('TOOLTIP_MARK_ZERO_STOCK_PRODUCT', 'Dacă articolul adăugat la coș nu se află în cantitatea necesară în stoc, articolul va fi marcat cu valoarea specificată.');
define('TOOLTIP_ZERO_STOCK_NOTIFICATION', 'Când această cantitate este atinsă, o notificare este trimisă la poștă că mărfurile se termină.');
define('TOOLTIP_SMS_TEXT', 'Specificați textul care va fi trimis clientului.');
define('TOOLTIP_SMS_LOGIN', 'Furnizat de furnizorul de sms.');
define('TOOLTIP_SMS_PASSWORD', 'Furnizat de furnizorul de sms.');
define('TOOLTIP_SMS_CODE_1', 'Număr de telefon sau expeditor alfanumeric.');
define('TOOLTIP_SMS_CODE_2', 'Furnizat de furnizorul de sms.');
define('TOOLTIP_TAX_ADD', 'Pentru a adăuga un nou tip de taxă, faceți clic pe &quot;+&quot; și completați câmpurile obligatorii.');
define('TOOLTIP_TAX_RATE_ADD', 'Pentru a adăuga o rată de% care va fi adăugată la costul produsului, faceți clic pe &quot;+&quot; și completați câmpurile obligatorii.');
define('TOOLTIP_TAX_ZONE_ADD', 'Pentru a adăuga o zonă (țară) pentru care se va aplica taxa, faceți clic pe &quot;+&quot; și completați câmpurile obligatorii.');
define('TOOLTIP_BACKUP_CREATE', 'Creați o copie de rezervă a versiunii curente a bazei de date a site-ului.');
define('TOOLTIP_BACKUP_LOAD', 'Restaurarea bazei de date din fișierul selectat.');
define('TOOLTIP_EMAILING', 'Trimiterea unui e-mail către un singur client, tuturor clienților sau tuturor abonaților de știri.');
define('TOOLTIP_MASS_EMAILING', 'Trimiterea de e-mailuri către un client individual sau către un grup selectat de clienți.');
define('TOOLTIP_CLEAR_CACHE', 'Ștergerea imaginilor încărcate din cache.');
define('TOOLTIP_STATS_SALES', 'Afișarea statisticilor de vânzări.');
define('TOOLTIP_STATS_SALES_PRODUCTS_BY_TIME_PERIOD', 'Raport de vânzări pentru mărfurile comandate pentru perioada de timp selectată.');
define('TOOLTIP_STATS_SALES_CATEGORIES_BY_TIME_PERIOD', 'Raport de vânzări pe categorii de produse pentru perioada de timp selectată.');
define('TOOLTIP_STATS_VIEWED_PRODUCTS', 'Statistici ale produselor vizualizate.');
define('TOOLTIP_STATS_ZERO_QUANTITY_PRODUCTS', 'Produsul este in stoc.');
define('TOOLTIP_STATS_CLIENTS_ORDERS', 'Raport cu privire la achizițiile efectuate de clienți pentru o anumită perioadă de timp.');
define('TOOLTIP_ADMINISTRATORS', 'Lista administratorilor site-ului.');
define('TOOLTIP_ADMINISTRATORS_GROUPS', 'Împărțirea administratorilor în grupuri.');
define('TOOLTIP_ADMINISTRATORS_ACCESS_RIGHTS', 'Drepturi de acces la informații de pe site, în funcție de grupul de administratori.');
define('TOOLTIP_TEXT_COPIED', 'Text copiat');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY', 'Cumpără');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON', 'aprinde');
define('TOOLTIP_TEXT_TAB_LANGUAGES', 'Funcționalitate lingvistică');
define('TOOLTIP_TEXT_TAB_AUTO_TRANSLATE', 'Traducere automată în bloc a conținutului');
define('TOOLTIP_TEXT_TAB_EDIT_TRANSLATE', 'Editați traducerile');
define('HIGHSLIDE_CLOSE', 'Închide');
define('COMMENT_BY_ADMIN', 'Comentariu de administrator');
define('TEXT_MENU_WHO_IS_ONLINE', 'Cine este online');
define('INFO_ICON_NEED_MINIFY', 'Orice modificare a acestui modul va schimba starea stilurilor la Minify Now');
define('INFO_ICON_ENABLE_SMTP', 'La pornire, verificați setările SMTP-ului');
define('SMTP_CONF_TITLE', 'Setări SMTP');
define('INFO_ICON_NEED_GENERATE_CRITICAL', 'Modificările aduse acestui parametru necesită regenerarea CSS critică');
define('YANDEX_MARKET_MODULE_ENABLED_TITLE', 'XML (YML) products export "Yandex Market"');
define('AUTO_TRANSLATE_MODULE_ENABLED_TITLE', 'Traducere automată');
define('TEXT_INFO_BUY_MODULE', 'Modulul «%s» este dezactivat, pentru a-l activa, utilizați pagina <a href="%s"><span style="color:blue;" >Module</span></a>');
define('TEXT_INFO_DISABLE_MODULE', 'Nu există modul «%s» pentru al adăuga, folosiți <a href="%s"><span style="color:blue;" >Magazin de module SoloMono</span></a>');
define("TEXT_POPULAR_SEARCH_QUERIES", "Popular search queries");
define('STATS_KEYWORDS_POPULAR_ENABLED_TITLE',"Căutați pagini");
define("LIST_MODAL_ON","Product modal");
define("SHOW_BASKET_ON_ADD_TO_CART_TITLE","Show cart when adding item");
define("TEXT_QUICK_ORDER", "Solicita informatii pentru acest produs");
define("TEXT_VIEWED","Viewed");
define('API_ENABLED_TITLE', 'Solomono API');
define('TEXT_MENU_API', 'API');
define('EMAIL_CONTENT_MODULE_ENABLED_TITLE', 'Șabloane de e-mail');
define('ENTRY_CREDIT_CARD_CC_TYPE', 'Tip card');
define('ENTRY_CREDIT_CARD_CC_OWNER', 'Card Owner');
define('ENTRY_CREDIT_CARD_CC_NUMBER', 'Număr card');
define('ENTRY_CREDIT_CARD_CC_EXPIRES', 'Card Expires');
define('TEXT_SEARCH_PAGES','Search pages');
define('SMTP_MODULE_ENABLED_TITLE','SMTP');

define('LEFT_MENU_SECTION_TITLE_SHOP','Magazin');
define('LEFT_MENU_SECTION_TITLE_INFO','Informații');
define('LEFT_MENU_SECTION_TITLE_CONTROL','Control');

define('TEXT_CLOSE_BUTTON', 'Close');
define('TBL_LINK_TITLE', 'Categorii Ajax');
define('TBL_HEADING_TITLE_BACK_TO_PARENT', 'Înapoi');
define('TBL_HEADING_TITLE_SEARCH', 'Căutare');
define('TBL_HEADING_CATEGORIES_PRODUCTS', 'Categorii / Produse');
define('TBL_HEADING_MODEL', 'Cod');
define('TBL_HEADING_QUANTITY', 'Cantitate');
define('TBL_HEADING_PRICE', 'Preț');
define('TBL_HEADING_TITLE_BACK_TO_DEFAULT_ADMIN', 'Înapoi la administrarea implicită');
define('TBL_HEADING_PRODUCTS_COUNT', ' produse');
define('TBL_HEADING_SUBCATEGORIES_COUNT', ' subcategorii');
define('TBL_HEADING_SUBCATEGORIE_COUNT', ' subcategorie');
define('INTEGRATION_FACEBOOK_CONF_TITLE','Integrare Facebook');
define('INTEGRATION_GOOGLE_CONF_TITLE','Integrare GOOGLE');
define('SEO_SETTINGS_CONF_TITLE','Setări SEO');

define('FACEBOOK_GOALS_ADD_PAYMENT_INFO_TITLE','Poartă \'AddPaymentInfo\' - completarea informațiilor de plată');
define('FACEBOOK_GOALS_ADD_TO_WISHLIST_TITLE','Poartă \'AddToWishlist\' - adaugă la lista de dorințe');
define('FACEBOOK_GOALS_CONTACT_US_REQUEST_TITLE','Poartă \'Lead\' - cerere pe pagina de contact');
define('FACEBOOK_GOALS_VIEW_CONTENT_TITLE','Poartă \'ViewContent\' - vizualizați pagina produsului');
define('FACEBOOK_GOALS_SUCCESS_PAGE_TITLE','Poartă \'Purchase\' - pagină după comandă confirmată');
define('FACEBOOK_GOALS_CHECKOUT_PROCESS_TITLE','Poartă \'InitiateCheckout\' - pagina de verificare');
define('FACEBOOK_GOALS_SEARCH_RESULTS_TITLE','Poartă \'Search\' - pagina cu rezultatele căutării');
define('FACEBOOK_GOALS_COMPLETE_REGISTRATION_TITLE','Poartă \'CompleteRegistration\' - când clientul s-a înregistrat');
define('FACEBOOK_GOALS_ADD_TO_CART_TITLE','Poartă \'AddToCart\' - adaugă în coș');
define('FACEBOOK_GOALS_PAGE_VIEW_TITLE','Poartă \'PageView\' - pe fiecare pagină');
define('FACEBOOK_GOALS_CLICK_FAST_BUY_TITLE','Poartă \'FastBuy\' - când clientul face clic pe butonul \'Comandă rapidă\' din pagina produsului');
define('FACEBOOK_GOALS_CLICK_ON_CHAT_TITLE','Poartă \'ClickChat\' - când clientul face clic pe butonul Chat');
define('FACEBOOK_GOALS_CALLBACK_TITLE','Poartă \'Callback\' - atunci când clientul face clic pe butonul \'Rambursare\' din antetul site-ului');
define('FACEBOOK_GOALS_FILTER_TITLE','Poartă \'filter\' - atunci când clientul folosește un filtru pentru a căuta produse');
define('FACEBOOK_GOALS_SUBSCRIBE_TITLE','Poartă \'Subscribe\' - când clientul s-a abonat');
define('FACEBOOK_GOALS_LOGIN_TITLE','Poartă \'login\' - când clientul s-a autentificat');
define('FACEBOOK_GOALS_ADD_REVIEW_TITLE','Poartă \'add_review\' - când clientul a adăugat recenzie');
define('FACEBOOK_GOALS_PHONE_CALL_TITLE','Poartă \'PhoneCall\' - când clientul face clic pe numărul de telefon din antetul site-ului');
define('FACEBOOK_GOALS_CLICK_ON_BUG_REPORT_TITLE','Poartă \'BugReport\' - când clientul dă clic pe \'Trimiteți un mesaj de eroare\' în subsolul site-ului');

define('HEADER_BUY_TEMPLATE_LINK','Comută la pachet plătit');
define('HEADER_MARKETPLACE_LINK','Piața modulelor');

define('NWPOSHTA_DELIVERY_TITLE', 'Adresă nouă de livrare a e-mailului');
define('TEXT_CATEGORIES', 'Categorii');
define('HEADING_TITLE_GOTO', 'Mergi la:');
define('ERROR_DOMAIN_IN_USE','Eroare! Acest domeniu este deja utilizat');
define('ERROR_ANAME_MISMATCH', 'Eroare! Numele A nu se potrivește cu 167.172.41.152. Încercați mai târziu');
define('SUCCESS_DOMAIN_CHANGE', 'Succes! Domeniul schimbat');
define('ERROR_ADD_DOMAIN_FIRST','Conectează-ți mai întâi domeniul personalizat!');
define('ERROR_BASH_EXECUTION','Eroare la executarea scriptului, manager de contacte');
define('ERROR_SIMLINK_CREATE', 'Legătura simbolică nu a fost creată');
define('ERROR_FOLDER_RENAME', 'Folderul nu a fost copiat');

define('PRODUCTS_LIMIT_REACHED_FREE', 'Limita de produse depășită! Site-ul dvs. va fi dezactivat automat în %s zile. <a href="%s">Închiriați o taxă</a> sau eliminați produsele nedorite');
define('PRODUCTS_LIMIT_REACHED_JUNIOR', 'Limita de produse a fost depășită! În %s zile site-ul dvs. va fi actualizat automat la pachet seo.');
define('PRODUCTS_LIMIT_REACHED_SEO', 'Limita de produs depășită! În %s zile site-ul dvs. va fi actualizat automat la pachet pro');
define('PRODUCTS_LIMIT_REACHED_HEADING', 'Limita de produse depășită!');