<?php
/*
  $Id: categories.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

// BOF MaxiDVD: Added For Ultimate-Images Pack!
define('TEXT_COPY_LINK', 'Link');
define('TEXT_PRODUCTS_IMAGE_NOTE','<b>Products Image:</b><small><br>Main Image used in<br><u>catalog & description</u> page.<small>');
define('TEXT_PRODUCTS_IMAGE_MEDIUM', '<b>Bigger Image:</b><br><small>REPLACES Small Image on<br><u>products description</u> page.</small>');
define('TEXT_PRODUCTS_IMAGE_LARGE', '<b>Pop-up Image:</b><br><small>REPLACES Small Image on<br><u>pop-up window</u> page.</small>');
define('TEXT_PRODUCTS_IMAGE_LINKED', '<u>Store Product/s Sharring this Image =</u>');
define('TEXT_PRODUCTS_IMAGE_REMOVE', '<b>Remove</b> this Image from this Product?');
define('TEXT_PRODUCTS_IMAGE_DELETE', '<b>Delete</b> this Image from the Server (Permanent!)?');
define('TEXT_PRODUCTS_IMAGE_REMOVE_SHORT', 'Remove');
define('TEXT_PRODUCTS_IMAGE_DELETE_SHORT', 'Delete');
define('TEXT_PRODUCTS_IMAGE_TH_NOTICE', '<b>SM = Small Images,</b> if a "SM" image is used<br>(Alone) NO Pop-up window link is created, the "SM"<br>(small image) will be placed directly under the products<br>description. if used inconjunction with a<br>"XL" image on the right, A Pop-up Window Link<br> is created and the "XL" image will be<br>shown in a Pop-up window.<br><br>');
define('TEXT_PRODUCTS_IMAGE_XL_NOTICE', '<b>XL = Large Images,</b> Used for the Pop-up image<br><br><br>');
define('TEXT_PRODUCTS_IMAGE_ADDITIONAL', 'More Addition Images - These will appear below product description if used.');
// EOF MaxiDVD: Added For Ultimate-Images Pack!
define('HEADING_TITLE', 'Categories / Products');
define('HEADING_TITLE_SEARCH', 'Search:');
define('HEADING_TITLE_GOTO', 'Go To:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categories / Products');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_NEW_PRODUCT', 'New Product in &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Categories:');
define('TEXT_SUBCATEGORIES', 'Subcategories:');
define('TEXT_PRODUCTS', 'Products:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Price:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Tax Class:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Average Rating:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantity:');
define('TEXT_DATE_ADDED', 'Date Added:');
define('TEXT_DELETE_IMAGE', 'Delete Image');

define('TEXT_DATE_AVAILABLE', 'Date Available:');
define('TEXT_LAST_MODIFIED', 'Last Modified:');
define('TEXT_IMAGE_NONEXISTENT', 'IMAGE DOES NOT EXIST');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Please insert a new category or product in this level.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'For more information, please visit this products <a href="http://%s" target="blank"><u>webpage</u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'This product was added to our catalog on %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'This product will be in stock on %s.');

define('TEXT_EDIT_INTRO', 'Please make any necessary changes');
define('TEXT_EDIT_CATEGORIES_ID', 'Category ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Category Name:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Category Image:');
define('TEXT_EDIT_CATEGORIES_ICON', 'Category Icon:');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS', 'Mostrar productos:');
define('TEXT_EDIT_SORT_ORDER', 'Sort Order:');
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'Category heading title:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Category heading Description:');

define('TEXT_INFO_COPY_TO_INTRO', 'Please choose a new category you wish to copy this product to');
define('TEXT_INFO_DELETE_FROM_CATEGORY', 'Seleccione la categoría de la que desea eliminar este producto');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Current Categories:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'New Category');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Edit Category');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Delete Category');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Move Category');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Delete Product');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Move Product');
define('TEXT_INFO_HEADING_COPY_TO', 'Copy To');

define('TEXT_DELETE_CATEGORY_INTRO', 'Are you sure you want to delete this category?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Are you sure you want to permanently delete this product?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>WARNING:</b> There are %s (child-)categories still linked to this category!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>WARNING:</b> There are %s products still linked to this category!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Please select which category you wish <b>%s</b> to reside in');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Please select which category you wish <b>%s</b> to reside in');
define('TEXT_MOVE', 'Move <b>%s</b> to:');

define('TEXT_NEW_CATEGORY_INTRO', 'Please fill out the following information for the new category');
define('TEXT_CATEGORIES_NAME', 'Category Name:');
define('TEXT_CATEGORIES_IMAGE', 'Category Image:');
define('TEXT_SORT_ORDER', 'Sort Order:');

define('TEXT_PRODUCTS_STATUS', 'Products Status:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Date Available:');
define('TEXT_PRODUCT_AVAILABLE', 'In Stock');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Out of Stock');
define('TEXT_PRODUCTS_MANUFACTURER', 'Products Manufacturer:');
define('TEXT_PRODUCTS_NAME', 'Products Name:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Products Description:');
define('TEXT_PRODUCTS_QUANTITY', 'Products Quantity:');
define('TEXT_PRODUCTS_MODEL', 'Products Model:');
define('TEXT_PRODUCTS_IMAGE', 'Products Image:');
define('TEXT_PRODUCTS_URL', 'Products URL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(without http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Products Price (Net):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Products Price (Gross):');
define('TEXT_PRODUCTS_WEIGHT', 'Products Weight:');
define('TEXT_NONE', '--none--');

define('EMPTY_CATEGORY', 'Empty Category');

define('TEXT_HOW_TO_COPY', 'Copy Method:');
define('TEXT_COPY_AS_LINK', 'Link product');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicate product');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Error: Can not link products in the same category.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: Catalog images directory is not writeable: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: Catalog images directory does not exist: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Error: Category cannot be moved into child category.');


//
define('ENTRY_PRODUCTS_PRICE', 'Price');
define('ENTRY_PRODUCTS_PRICE_DISABLED', 'Price disabled');
//


define('TEXT_PRODUCTS_PAGE_TITLE', 'Meta Title:');
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Meta Description:');
define('TEXT_PRODUCTS_KEYWORDS', 'Meta Keywords:');


// RJW Begin Meta Tags Code
  define('TEXT_META_TITLE', 'Meta Title');
  define('TEXT_META_DESCRIPTION', 'Meta Description');
  define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code
define('TABLE_HEADING_PARAMETERS', 'Produts properties');

define('TEXT_PRODUCTS_INFO', 'Short Description:');

define('TEXT_ATTRIBUTE_HEAD', 'Product attributes:');
define('TABLE_HEADING_ATTRIBUTE_1', 'Active attributes');
define('TABLE_HEADING_ATTRIBUTE_2', 'Prefix');
define('TABLE_HEADING_ATTRIBUTE_3', 'Price');
define('TABLE_HEADING_ATTRIBUTE_4', 'Sort order');
define('TABLE_HEADING_ATTRIBUTE_5', 'Filename');
define('TABLE_HEADING_ATTRIBUTE_6', 'Link expiry (days)');
define('TABLE_HEADING_ATTRIBUTE_7', 'Maximum downloads');
define('TABLE_HEADING_ATTRIBUTE_9', 'Weight');

define('TABLE_HEADING_PRODUCT_SORT', 'Sort order');
define('TEXT_ATTRIBUTE_DESC', 'Product attributes setup.');

#Add:
define('TABLE_HEADING_XML', 'XML');
define('TEXT_PRODUCTS_TO_XML', 'XML files:');
define('TEXT_PRODUCT_AVAILABLE_TO_XML', 'Enable');
define('TEXT_PRODUCT_NOT_AVAILABLE_TO_XML', 'Disable');

// BOF Enable - Disable Categories Contribution--------------------------------------
define('TEXT_EDIT_STATUS', 'Status');
define('TEXT_DEFINE_CATEGORY_STATUS', 'Enable/Disable');
define('TEXT_EDIT_ROBOTS_STATUS', 'Robots Index Status');
define('TEXT_DEFINE_CATEGORY_ROBOTS_STATUS', 'index, follow/noindex, nofollow');
// EOF Enable - Disable Categories Contribution--------------------------------------

define('TEXT_MIN_QUANTITY', 'Min:');
define('TEXT_MIN_QUANTITY_UNITS', 'Units:');

define('ATTRIBUTES_COPY_MANAGER_1', 'Copy product attributes to category ...');
define('ATTRIBUTES_COPY_MANAGER_2', 'Copy product attributes ');
define('ATTRIBUTES_COPY_MANAGER_3', ' type product id');
define('ATTRIBUTES_COPY_MANAGER_4', 'to all products in category ');
define('ATTRIBUTES_COPY_MANAGER_5', 'Category number: ');
define('ATTRIBUTES_COPY_MANAGER_6', 'Delete all attributes and downloads before copying ');
define('ATTRIBUTES_COPY_MANAGER_7', 'Otherwise ...');
define('ATTRIBUTES_COPY_MANAGER_8', 'Duplicate attributes should be skipped ');
define('ATTRIBUTES_COPY_MANAGER_9', 'Duplicate attributes should be overwritten ');
define('ATTRIBUTES_COPY_MANAGER_10', 'Copy attributes with downloads ');
define('ATTRIBUTES_COPY_MANAGER_11', 'Select a category');
define('ATTRIBUTES_COPY_MANAGER_12', 'Copy attributes from all products to category ');
define('ATTRIBUTES_COPY_MANAGER_13', 'Products attributes copier');
define('ATTRIBUTES_COPY_MANAGER_14', 'Select a product');
define('ATTRIBUTES_COPY_MANAGER_15', 'Product number: ');
define('ATTRIBUTES_COPY_MANAGER_16', 'To product: ');
define('ATTRIBUTES_COPY_MANAGER_17', 'Delete all attributes before copying new attributes ');
define('ATTRIBUTES_COPY_MANAGER_COPY', 'Copy attributes');

define('TEXT_PAGES', 'Pages: ');
define('TEXT_TOTAL_PRODUCTS', 'Products in this category: ');
define('TEXT_ATT_UPLOAD', 'Upload...');

define('TEXT_WEIGHT_HELP', '<span class="main"><b>Warning:</b> Weight must be more than 0. For virtual products (downloadable products) weight must be 0.</span>');

define('HEADING_TITLE_SEARCH_MODEL', 'Product model search:');

define('TEXT_PRODUCTS_IMAGE_DIR', 'Upload to directory:');
define('TEXT_IMAGES_MAIN_DIRECTORY', 'images');
define('TABLE_HEADING_YES','Sí');
define('TABLE_HEADING_NO','No');
define('TEXT_IMAGES_OVERWRITE', 'Overwrite Existing Image?');
define('TEXT_IMAGES_OVERWRITE1', 'Use No for manually typed names');
define('TEXT_IMAGE_OVERWRITE_WARNING','WARNING: FILENAME was updated but not overwritten ');

define('TEXT_CAT_DELPHOTO', 'Delete Image');
define('TEXT_CAT_ACTION', 'Action');
define('TEXT_CAT_IMAGE', 'Image');
define('TEXT_CAT_EDIT', 'Edit');
define('TEXT_CAT_SUBCATS', 'Subcategories');
define('TEXT_CAT_PRODUCTS', 'Products in category');
define('TEXT_CAT_MODEL', 'model');
define('TEXT_CAT_QTY', 'qty');
define('TEXT_CAT_PRICE', 'price');
define('TEXT_FILTER_SPECIALS','With specials');
define('TEXT_FILTER_CONCOMITANT','Concomitant');
define('TEXT_FILTER_TOP','Top');
define('TEXT_FILTER_NEW','NEW');
define('TEXT_FILTER_STOCK','Stock');
define('TEXT_FILTER_RECOMMEND','Recommend');

//Button
define('BUTTON_CANCEL_NEW', 'Cancelar');
define('BUTTON_BACK_NEW', 'Espalda');
define('BUTTON_NEW_CATEGORY_NEW', 'Nueva categoría');
define('BUTTON_NEW_PRODUCT_NEW', 'Nuevo producto');

// WebMakers.com Added: Attribute Copy Option
define('TEXT_COPY_ATTRIBUTES_ONLY','Solo se usa para productos duplicados ...');
define('TEXT_COPY_ATTRIBUTES','Copie los atributos del producto para duplicar?');
define('TEXT_COPY_ATTRIBUTES_YES','Sí');
define('TEXT_COPY_ATTRIBUTES_NO','No');

define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_NOTHING','Nada');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_ALL','Todos los productos de las subcategorías');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_TOP','TOP ventas de esta categoría');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_RECOMMENDED','Recomendado para esta categoría');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_NEW','Novedades de esta categoría');
define('TEXT_ID_XML_CATEGORY','categoría de ID XML');
define('TEXT_VENDOR_XML_CATEGORY','categoría de Vendor XML');
define('ERROR_SYS_CATEGORY_EXIST','El ID XML de la categoría %s ya está ocupado por <a href="'.DIR_WS_ADMIN . 'categories.php?cID=%s&action=edit_category" target="_blank">otra categoría</a>');
?>