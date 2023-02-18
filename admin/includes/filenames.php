<?php
/*
  $Id: filenames.php,v 1.3 2003/09/28 23:37:26 anotherlango Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('CONTENT_PRODUCT_INFO', 'product_info');
define('DIR_WS_HTTP_CATALOG', '/');

//easyCommentz
define('FILENAME_COMMENT8R', 'comment8r.php');
define('FILENAME_PRODUCTS_MULTI', 'products_multi.php');

define('FILENAME_TABLEDATA', 'tbl.php');
define('FILENAME_TBL_AJAX', 'tbl_ajax.php');

define('FILENAME_API', 'api_keys.php');


// Fine
define('FILENAME_CLEAR_IMAGE_CACHE', 'ajax_clear_image_cache.php');
//Admin begin
define('FILENAME_ADMIN_ACCOUNT', 'admin_account.php');
define('FILENAME_ADMIN_FILES', 'admin_files.php');
define('FILENAME_ADMIN_MEMBERS', 'admin_members.php');
Define('FILENAME_FORBIDEN', 'forbiden.php');
define('FILENAME_LOGIN', 'login.php');
define('FILENAME_LOGOFF', 'logoff.php');
define('FILENAME_PASSWORD_FORGOTTEN', 'password_forgotten.php');
//Admin end

// limex: mod query performance START
define('FILENAME_MYSQL_PERFORMANCE', 'mysqlperformance.php');
define('FILENAME_TEMPLATE_CONFIGURATION', 'template_configuration.php');
define('FILENAME_INFOBOX_ADMIN', 'infobox_admin.php');
define('FILENAME_SALEMAKER', 'salemaker.php');
define('FILENAME_FEATURED', 'featured.php');

define('FILENAME_CREATE_ACCOUNT', 'create_account.tpl.php');
define('FILENAME_CREATE_ACCOUNT_PROCESS', 'create_account_process.php');
define('FILENAME_CREATE_ACCOUNT_SUCCESS', 'create_account_success.php');
define('FILENAME_CREATE_ORDER', 'create_order.php');
define('FILENAME_REVIEWS', 'reviews.php');
define('FILENAME_RECOVER_CART_SALES', 'recover_cart_sales.php');
define('FILENAME_EDIT_ORDERS', 'edit_orders.php');
define('FILENAME_STATS_MONTHLY_SALES', 'stats_monthly_sales.php');
define('FILENAME_STATS_NOPHOTO', 'stats_nophoto.php');
define('FILENAME_STATS_OPENED_BY', 'stats_opened_by.php');
define('FILENAME_STATS_ZEROQTY', 'stats_zeroqty.php');
define('FILENAME_STATS_LAST_MODIFIED', 'stats_last_modified.php');
define('FILENAME_STATS_RECOVER_CART_SALES', 'stats_recover_cart_sales.php');
// EOF: Lango Added for Sales Stats MOD

// define the filenames used in the project
define('FILENAME_BACKUP', 'backup.php');
//define('FILENAME_PRODUCTS_ATTRIBUTES', 'products_attributes.php');
define('FILENAME_TOTAL_CONFIGURATION', 'total_configuration.php');
define('FILENAME_CACHE', 'cache.php');
define('FILENAME_CATALOG_ACCOUNT_HISTORY_INFO', 'account_history_info.php');
define('FILENAME_CATEGORIES', 'categories.php');
define('FILENAME_PRODUCTS', 'products.php');
define('FILENAME_CONFIGURATION', 'configuration.php');
define('FILENAME_COUNTRIES', 'countries.php');
define('FILENAME_CURRENCIES', 'currencies.php');
define('FILENAME_CUSTOMERS', 'customers.php');
define('FILENAME_EMAIL_CONTENT', 'email_content.php');
define('FILENAME_DEFAULT', 'index.php');
define('FILENAME_GEO_ZONES', 'geo_zones.php');
define('FILENAME_IMPORT_EXPORT', 'importexport.php');
define('FILENAME_NEW_IMPORT_EXPORT', 'new_importexport.php');
define('FILENAME_LANGUAGES', 'languages.php');
define('FILENAME_LANGUAGES_TRANSLATER', 'languages_translater.php');
define('FILENAME_MAIL', 'mail.php');
define('FILENAME_MANUFACTURERS', 'manufacturers.php');
define('FILENAME_AUTO_TRANSLATE', 'auto_translate.php');
define('FILENAME_MODULES', 'modules.php');
define('FILENAME_NEWSLETTERS', 'newsletters.php');
define('FILENAME_ORDERS', 'orders.php');
define('FILENAME_ORDERS_INVOICE', 'invoice.php');
define('FILENAME_ORDERS_PACKINGSLIP', 'packingslip.php');
define('FILENAME_ORDERS_STATUS', 'orders_status.php');
define('FILENAME_ORDERS_EDIT', 'edit_orders.php');
define('FILENAME_POPUP_IMAGE', 'popup_image.php');
define('FILENAME_STOCK', 'stock.php');
define('FILENAME_NEW_PRODUCTS_ATTRIBUTES', 'products_attributes.php');
define('FILENAME_SHIPPING_MODULES', 'shipping_modules.php');
define('FILENAME_SPECIALS', 'specials.php');
define('FILENAME_STATS_CUSTOMERS', 'stats_customers.php');
define('FILENAME_STATS_PRODUCTS_PURCHASED', 'stats_products_purchased.php');
define('FILENAME_STATS_PRODUCTS_PURCHASED_BY_CATEGORY', 'stats_products_purchased_by_category.php');
define('FILENAME_STATS_PRODUCTS_VIEWED', 'stats_products_viewed.php');
define('FILENAME_STATS_CUSTOMERS_ENTRY', 'stats_customers_entry.php');
define('FILENAME_XSELL_PRODUCTS', 'xsell_products.php');
define('FILENAME_PRODUCT_INFO', CONTENT_PRODUCT_INFO . '.php');

define('FILENAME_TAX_CLASSES', 'tax_classes.php');
define('FILENAME_TAX_RATES', 'tax_rates.php');
define('FILENAME_WHOS_ONLINE', 'whos_online.php');
define('FILENAME_ZONES', 'zones.php');
define('FILENAME_PAYPALIPN_TRANSACTIONS', 'paypalipn_txn.php'); // PAYPALIPN
define('FILENAME_PAYPALIPN_TESTS', 'paypalipn_tests.php'); // PAYPALIPN
define('FILENAME_EASYPOPULATE', 'easypopulate.php');
define('FILENAME_EDIT_ORDERS', 'edit_orders.php');
define('FILENAME_GROUPS', 'customers_groups.php');
define('FILENAME_QUICK_ORDERS', 'quick_orders.php');
define('FILENAME_MANUAL_DISCOUNTS', 'manudiscount.php');
define('FILENAME_CATALOG_LOGIN', 'login.php');

define('FILENAME_KEYWORDS', 'stats_keywords.php');

define('FILENAME_ARTICLES', 'articles.php');
define('FILENAME_INSTRUCTIONS', 'instructions.php');
define('FILENAME_ARTICLES_CONFIG', 'articles_config.php');
define('FILENAME_ARTICLES_XSELL', 'articles_xsell.php');
define('FILENAME_AUTHORS', 'authors.php');
define('FILENAME_ERROR_403', '403.php');
define('FILENAME_ERROR_404', '404.php');
define('FILENAME_ARTICLE_INFO', 'article_info.php');

define('FILENAME_QUICK_UPDATES', 'quick_updates.php');

define('CONTENT_CHECKOUT_SUCCESS', 'checkout_success');
define('FILENAME_CHECKOUT_SUCCESS', CONTENT_CHECKOUT_SUCCESS . '.php');
define('FILENAME_CHECKOUT', 'checkout.php');
define('FILENAME_PROM', 'prom.php');

define('FILENAME_INSTRUCTIONS', 'instructions.php');


// begin mod for ProductsProperties v2.01
define('FILENAME_PRODUCTS_PROPERTIES', 'products_properties.php');
define('FILENAME_PRODUCTS_PROPERTIES_POPUP', 'products_properties_popup.php');
// end mod for ProductsProperties v2.01

define('FILENAME_STATS_SALES_REPORT2', 'stats_sales_report2.php');
define('FILENAME_STATS_SALES_REPORT', 'stats_sales_report.php');

//BEGIN Dynamic Information pages unlimited
define('FILENAME_INFORMATION', 'information_manager.php');
//END Dynamic Information pages unlimited

define('FILENAME_STATS_CUSTOMERS_ORDERS', 'stats_customers_orders.php');

// BOF FlyOpenair: Extra Product Price
define('FILENAME_EXTRA_PRODUCT_PRICE', 'extra_product_price.php');
// EOF FlyOpenair: Extra Product Price

define('FILENAME_SHIP2PAY', 'ship2pay.php');
define('FILENAME_SHIP2FIELDS', 'ship2fields.php');
define('FILENAME_SEO_FILTER', 'seo_filter.php');
define('FILENAME_STATS_SEARCH_KEYWORDS', 'stats_search_keywords.php');
define('FILENAME_SEO_TEMPLATES', 'seo_templates.php');
define('FILENAME_INSTAGRAM', 'instagram.php');
define("FILENAME_REDIRECTS", "redirects.php");
define('FILENAME_YML', 'yml.php');
define('FILENAME_OSC', 'osc_import.php');

define('FILENAME_WHO_IS_ONLINE', 'whos_online.php');
define('FILENAME_STATS_KEYWORDS_POPULAR', 'stats_keywords_popular.php');