<?php
/*
  $Id: database_tables.php,v 1.2 2003/09/24 13:57:07 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

//Admin begin
define('TABLE_ADMIN', 'admin');
define('TABLE_ADMIN_FILES', 'admin_files');
define('TABLE_ADMIN_GROUPS', 'admin_groups');
//Admin end

// Lango Added Line For Infobox & Template configuration: BOF
define('TABLE_INFOBOX_CONFIGURATION', 'infobox_configuration');
define('TABLE_TEMPLATE', 'template');
// Lango Added Line For Infobox & Template configuration: BOF

// Lango Added Line For Salemaker Mod: BOF
define('TABLE_SALEMAKER_SALES', 'salemaker_sales');
// Lango Added Line For Salemaker Mod: EOF

// BOF: Lango Added for Featured product MOD
define('TABLE_FEATURED', 'featured');
// EOF: Lango Added for Featured product MOD

// define the database table names used in the project
define('TABLE_ADDRESS_BOOK', 'address_book');
define('TABLE_ADDRESS_FORMAT', 'address_format');
define('TABLE_BANNERS', 'banners');
define('TABLE_BANNERS_HISTORY', 'banners_history');
define('TABLE_CATEGORIES', 'categories');
define('TABLE_CATEGORIES_DESCRIPTION', 'categories_description');
define('TABLE_CONFIGURATION', 'configuration');
define('TABLE_CONFIGURATION_GROUP', 'configuration_group');
define('TABLE_SUB_CONFIGURATION', 'sub_configuration');
define('TABLE_COUNTRIES', 'countries');
define('TABLE_TIME_ZONE', 'time_zones');
define('TABLE_CURRENCIES', 'currencies');
define('TABLE_CUSTOMERS', 'customers');
define('TABLE_CUSTOMERS_BASKET', 'customers_basket');
define('TABLE_CUSTOMERS_BASKET_ATTRIBUTES', 'customers_basket_attributes');
define('TABLE_CUSTOMERS_INFO', 'customers_info');
define('TABLE_EMAIL_CONTENT', 'email_content');
define('TABLE_LANGUAGES', 'languages');
define('TABLE_MANUFACTURERS', 'manufacturers');
define('TABLE_MANUFACTURERS_INFO', 'manufacturers_info');
define('TABLE_NEWSLETTERS', 'newsletters');
define('TABLE_ORDERS', 'orders');
define('TABLE_ORDERS_PRODUCTS', 'orders_products');
define('TABLE_ORDERS_PRODUCTS_ATTRIBUTES', 'orders_products_attributes');
define('TABLE_ORDERS_PRODUCTS_DOWNLOAD', 'orders_products_download');
define('TABLE_ORDERS_STATUS', 'orders_status');
define('TABLE_ORDERS_STATUS_HISTORY', 'orders_status_history');
define('TABLE_ORDERS_TOTAL', 'orders_total');
define('TABLE_PRODUCTS', 'products');
define('TABLE_PRODUCTS_STOCK', 'products_stock');
define('TABLE_PRODUCTS_ATTRIBUTES', 'products_attributes');
define('TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD', 'products_attributes_download');
define('TABLE_PRODUCTS_DESCRIPTION', 'products_description');
define('TABLE_PRODUCTS_NOTIFICATIONS', 'products_notifications');
define('TABLE_PRODUCTS_OPTIONS', 'products_options');
define('TABLE_PRODUCTS_OPTIONS_VALUES', 'products_options_values');
define('TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS', 'products_options_values_to_products_options');
define('TABLE_PRODUCTS_TO_CATEGORIES', 'products_to_categories');
define('TABLE_PRODUCTS_TO_DOWNLOAD', 'products_to_download');
define('TABLE_REVIEWS', 'reviews');
define('TABLE_REVIEWS_DESCRIPTION', 'reviews_description');
define('TABLE_SESSIONS', 'sessions');
define('TABLE_SPECIALS', 'specials');
define('TABLE_TAX_CLASS', 'tax_class');
define('TABLE_TAX_RATES', 'tax_rates');
define('TABLE_GEO_ZONES', 'geo_zones');
define('TABLE_ZONES_TO_GEO_ZONES', 'zones_to_geo_zones');
define('TABLE_WHOS_ONLINE', 'whos_online');
define('TABLE_ZONES', 'zones');
define('TABLE_PAYPALIPN_TXN', 'paypalipn_txn'); // PAYPALIPN

define('TABLE_SEO_FILTER', 'seo_filter');
define('TABLE_SEO_FILTER_DESCRIPTION', 'seo_filter_description');

// RJW Begin Meta Tags Code
define('TABLE_METATAGS', 'meta_tags');
// RJW End Meta Tags Code

define('TABLE_ARTICLES', 'articles');
define('TABLE_ARTICLES_DESCRIPTION', 'articles_description');
define('TABLE_ARTICLES_TO_TOPICS', 'articles_to_topics');
define('TABLE_PRODUCTS_XSELL', 'products_xsell');
define('TABLE_ARTICLES_XSELL', 'articles_xsell');
define('TABLE_AUTHORS', 'authors');
define('TABLE_AUTHORS_INFO', 'authors_info');
define('TABLE_TOPICS', 'topics');
define('TABLE_TOPICS_DESCRIPTION', 'topics_description');
define('TABLE_PHESIS_POLL_DATA', 'phesis_poll_data');
define('TABLE_PHESIS_POLL_DESC', 'phesis_poll_desc');
define('TABLE_PHESIS_POLL_CHECK', 'phesis_poll_check');
define('TABLE_PHESIS_POLL_CONFIG', 'phesis_poll_config');

//TotalB2B start
define('TABLE_CUSTOMERS_GROUPS', 'customers_groups');
define('TABLE_MANUDISCOUNT', 'manudiscount');
//TotalB2B end

//TotalB2B start
define('TABLE_CUSTOMERS_GROUPS', 'customers_groups');
define('TABLE_MANUDISCOUNT', 'manudiscount');
//TotalB2B end

// BOF FlyOpenair: Extra Product Price
define('TABLE_EXTRA_PRODUCT_PRICE', 'extra_product_price');
// EOF FlyOpenair: Extra Product Price

define('TABLE_WISHLIST', 'customers_wishlist');
define('TABLE_WISHLIST_ATTRIBUTES', 'customers_wishlist_attributes');

define('TABLE_SHIP2FIELDS', 'ship2fields');
define('TABLE_SHIP2FIELDS_DESCRIPTION', 'ship2fields_description');
define('TABLE_SHIP2PAY', 'ship2pay');
define('TABLE_CACHE', 'cache');
define('TABLE_SEO_TEMLATES', 'seo_templates');
define('TABLE_SEO_TEMLATES_DESCRIPTION', 'seo_templates_description');
define('TABLE_STATS_KEYWORDS_POPULAR','stats_keywords_popular');
define('TABLE_QUICK_ORDERS','quick_orders');
define('TABLE_TEMP_CUSTOMER', 'temp_customer_data');
define('TABLE_PRODUCTS_VIDEO', 'products_video');