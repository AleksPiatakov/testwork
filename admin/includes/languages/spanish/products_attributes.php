<?php
/*
  $Id: products_attributes.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Product Options');
define('HEADING_TITLE_OPT', 'Product Options');
define('HEADING_TITLE_VAL', 'Option Values');
define('HEADING_TITLE_ATRIB', 'Products Attributes');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_PRODUCT', 'Product Name');
define('TABLE_HEADING_OPT_NAME', 'Option Name');

// otf 1.71 New field definitions
define('TABLE_HEADING_OPT_TYPE', 'Type');
define('TABLE_HEADING_OPT_GROUP', 'Option Group');
define('TABLE_HEADING_OPT_LENGTH', 'Show in the filter');
define('TABLE_HEADING_OPT_COMMENT', 'Show in the list of products');

define('TABLE_HEADING_OPT_VALUE', 'Option Value');
define('TABLE_HEADING_OPT_PRICE', 'Value Price');
define('TABLE_HEADING_OPT_PRICE_PREFIX', 'Prefix');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_DOWNLOAD', 'Downloadable products:');
define('TABLE_TEXT_FILENAME', 'Filename:');
define('TABLE_TEXT_MAX_DAYS', 'Expiry days:');
define('TABLE_TEXT_MAX_COUNT', 'Maximum download count:');

define('MAX_ROW_LISTS_OPTIONS', 10);

define('TEXT_WARNING_OF_DELETE', 'This option has products and values linked to it - it is not safe to delete it.');
define('TEXT_OK_TO_DELETE', 'This option has no products and values linked to it - it is safe to delete it.');
define('TEXT_OPTION_ID', 'Option ID');
define('TEXT_OPTION_NAME', 'Option Name');
define('TEXT_OPTION_SORT_ORDER', 'Sort order:');

define('TEXT_PRAT_DEL', 'delete');
define('TEXT_PRAT_COLOR', 'Image');
define('TEXT_ALERT1', 'Error: there are products (in the amount of <b>%d</b>) in which the value of this attribute is specified');
define('TEXT_ALERT2', 'This attribute has associated values (in the amount of <b>%d</b>), when deleting the aribut, the values will be deleted. Are you sure that you want to delete the attribute?');

define('TEXT_TYPE_TEXT','Texto');
define('TEXT_TYPE_SELECT','Select');
define('TEXT_TYPE_RADIO','Radio');
define('TEXT_TYPE_CHECKBOX','Checkbox');
define('TEXT_TYPE_TEXTAREA','Color');

define('HEADING_TITLE_GROUP', 'Attribute groups');
define('TEXT_OPTION_GROUP_NAME', 'Nombre del grupo de atributos');
define('TEXT_OPTION_VALUE_NAME','Nombre del valor del atributo');
?>