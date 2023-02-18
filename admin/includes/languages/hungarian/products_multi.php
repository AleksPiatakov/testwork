<?php
/*
  $Id: products_multi.php, v 2.0

  autor: sr, 2003-07-31 / sr@ibis-project.de

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Products multi-manager');
define('HEADING_TITLE_SEARCH', 'Search:');
define('HEADING_TITLE_GOTO', 'Go to:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_CHOOSE', 'Select');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categories / Products');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_PRODUCTS_QUANTITY', 'Qty');
define('TABLE_HEADING_MANUFACTURERS_NAME', 'Manufacturer');
define('TABLE_HEADING_STATUS', 'Status');

define('DEL_DELETE', 'delete product');
define('DEL_CHOOSE_DELETE_ART', 'How to delete?');
define('DEL_THIS_CAT', 'only from this category');
define('DEL_COMPLETE', 'total product deleting ');

define('TEXT_NEW_PRODUCT', 'New product in &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Categories:');
define('TEXT_ATTENTION_DANGER', '');
/*
define('TEXT_ATTENTION_DANGER', '<br><br><span class="dataTableContentRedAlert">!!! Внимание !!! пожалуйста прочтите !!!</span><br><br><span class="dataTableContentRed">Этот инструмент меняет таблицы "products_to_categories" (и в случае  \' полностью удалить товар\' даже "products" и "products_description" among others; через функцию \'tep_remove_product\') - поэтому делать резервную копию этих таблиц перед каждым использованием этого инструмента ОЧЕНЬ рекомендуется. Причины:<br><br>This tool deletes, moves or copies all via checkbox selected products without any interim step or warning, that means immediately after clicking on the go-button.</span><br><br><span class="dataTableContentRedAlert">Please take care:</span><ul><li>Pay very great attention when using <strong>\'delete the complete product\'</strong>. This function deletes all selected products immediately, without interim step or warning, and completely from all tables where these products belong to.</strong></li><li>While choosing <strong>\'delete product only in this category\'</strong>, no products are deleted completely, but only their links to the actually opened category - even when it\'s the only category-link of the product, and without warning, that means: be careful with this delete tool as well.</li><li>While <strong>copying</strong>, products are not duplicated, they are only linked to the new category chosen.</li><li>Products are only <strong>moved</strong> resp. <strong>copied</strong> to a new category in case they do not exist there allready.</li></ul>');
*/
define('TEXT_MOVE_TO', 'move to');
define('TEXT_CHOOSE_ALL', 'check all');
define('TEXT_CHOOSE_ALL_REMOVE', 'uncheck');
define('TEXT_SUBCATEGORIES', 'Subcategories:');
define('TEXT_PRODUCTS', 'Products:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Price:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Tax class:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'av. rating:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'qty:');
define('TEXT_DATE_ADDED', 'added:');
define('TEXT_DATE_AVAILABLE', 'available:');
define('TEXT_LAST_MODIFIED', 'modified:');
define('TEXT_IMAGE_NONEXISTENT', 'IMAGE DOES NOT EXIST');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Please enter new category or product to <br>&nbsp;<br><b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Visit <a href="http://%s" target="blank"><u>this page</u></a> for more information.');
define('TEXT_PRODUCT_DATE_ADDED', 'This product was added to catalog %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'This product will be available in %s.');

define('TEXT_EDIT_INTRO', 'Please make changes');
define('TEXT_EDIT_CATEGORIES_ID', 'ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Name:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Image:');
define('TEXT_EDIT_SORT_ORDER', 'Sort order:');

define('TEXT_INFO_COPY_TO_INTRO', 'Please select new category you want to copy product');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Current categories:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'New category');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Change category');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Delete category');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Move category');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Delete product');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Move product');
define('TEXT_INFO_HEADING_COPY_TO', 'Copy to');
define('LINK_TO', 'Link to');

define('TEXT_DELETE_CATEGORY_INTRO', 'Are you sure you want to delete this category?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Are you sure you want to delete this product?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>WARNING:</b> %s subcategories still linked to this category!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>WARNING:</b> %s products still linked to this category!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Please select category you want to move <b>%s</b>');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Please select category you want to move <b>%s</b>');
define('TEXT_MOVE', 'Move <b>%s</b> to:');

define('TEXT_NEW_CATEGORY_INTRO', 'Please fill following information for new category');
define('TEXT_CATEGORIES_NAME', 'Name:');
define('TEXT_CATEGORIES_IMAGE', 'Image:');
define('TEXT_SORT_ORDER', 'Sort order:');     

define('TEXT_PRODUCTS_STATUS', 'Status:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Date available:');
define('TEXT_PRODUCT_AVAILABLE', 'In stock');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Not available');
define('TEXT_PRODUCTS_MANUFACTURER', 'Manufacturer:');
define('TEXT_PRODUCTS_NAME', 'Name:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Description:');
define('TEXT_PRODUCTS_QUANTITY', 'Qty:');
define('TEXT_PRODUCTS_MODEL', 'Model:');
define('TEXT_PRODUCTS_IMAGE', 'Image:');
define('TEXT_PRODUCTS_URL', 'URL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(without http://)</small>');
define('TEXT_PRODUCTS_PRICE', 'Price:');
define('TEXT_PRODUCTS_WEIGHT', 'Weight:');
define('TEXT_NONE', '--none--');

define('EMPTY_CATEGORY', 'Empty category');

define('TEXT_HOW_TO_COPY', 'How to copy:');
define('TEXT_COPY_AS_LINK', 'Copy as link');
define('TEXT_COPY_AS_DUPLICATE', 'Copy as duplicate');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Error: cannot link to same category.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: Folder with images is not writable: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: Folder with images does not exist: ' . DIR_FS_CATALOG_IMAGES);

define('TEXT_PMU_CANCEL', 'cancel');
define('TEXT_DUBLICATE_TO', 'duplicate to');
define('TEXT_PMU_LINK', 'link to');
define('TEXT_PMU_DEL', 'delete');
define('TEXT_PMU_DUBL_CATEGORY', 'Ismétlődő könyvtár:');

//Button
define('BUTTON_BACK_NEW', 'back');
define('BUTTON_PMU_SUBMIT', 'Beküldés');