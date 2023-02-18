<?php
/*
  $Id: products_multi.php, v 2.0

  autor: sr, 2003-07-31 / sr@ibis-project.de

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Масове редагування товарів');
define('HEADING_TITLE_SEARCH', 'Пошук:');
define('HEADING_TITLE_GOTO', 'Перехід:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_CHOOSE', 'Виберіть');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Категорії / Продукти');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Код');
define('TABLE_HEADING_ACTION', 'Дія');
define('TABLE_HEADING_PRODUCTS_QUANTITY', 'Кількість');
define('TABLE_HEADING_MANUFACTURERS_NAME', 'Виробник');
define('TABLE_HEADING_STATUS', 'Статус');

define('DEL_DELETE', 'видалити продукт');
define('DEL_CHOOSE_DELETE_ART', 'Як видалити?');
define('DEL_THIS_CAT', 'тільки в цій категорії');
define('DEL_COMPLETE', 'повністю видалити товар');

define('TEXT_NEW_PRODUCT', 'Новый товар в &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Категорії:');
define('TEXT_ATTENTION_DANGER', '');
/*
define('TEXT_ATTENTION_DANGER', '<br><br><span class="dataTableContentRedAlert">!!! Внимание !!! пожалуйста прочтите !!!</span><br><br><span class="dataTableContentRed">Этот инструмент меняет таблицы "products_to_categories" (и в случае  \' полностью удалить товар\' даже "products" и "products_description" among others; через функцию \'tep_remove_product\') - поэтому делать резервную копию этих таблиц перед каждым использованием этого инструмента ОЧЕНЬ рекомендуется. Причины:<br><br>This tool deletes, moves or copies all via checkbox selected products without any interim step or warning, that means immediately after clicking on the go-button.</span><br><br><span class="dataTableContentRedAlert">Please take care:</span><ul><li>Pay very great attention when using <strong>\'delete the complete product\'</strong>. This function deletes all selected products immediately, without interim step or warning, and completely from all tables where these products belong to.</strong></li><li>While choosing <strong>\'delete product only in this category\'</strong>, no products are deleted completely, but only their links to the actually opened category - even when it\'s the only category-link of the product, and without warning, that means: be careful with this delete tool as well.</li><li>While <strong>copying</strong>, products are not duplicated, they are only linked to the new category chosen.</li><li>Products are only <strong>moved</strong> resp. <strong>copied</strong> to a new category in case they do not exist there allready.</li></ul>');
*/
define('TEXT_MOVE_TO', 'перемістити в');
define('TEXT_CHOOSE_ALL', 'відзначити все');
define('TEXT_CHOOSE_ALL_REMOVE', 'зняти позначку');
define('TEXT_SUBCATEGORIES', 'Підкатегорії:');
define('TEXT_PRODUCTS', 'Товари:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Ціна:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Клас податків:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Сер.оцінка:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Кількість:');
define('TEXT_DATE_ADDED', 'Доданий:');
define('TEXT_DATE_AVAILABLE', 'Наявність:');
define('TEXT_LAST_MODIFIED', 'Зміна:');
define('TEXT_IMAGE_NONEXISTENT', 'IMAGE DOES NOT EXIST');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Будь ласка, додайте нову категорію або товар в <br>&nbsp;<br><b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Посетите <a href="http://%s" target="blank"><u>страницу</u></a> этого товара для получения информации.');
define('TEXT_PRODUCT_DATE_ADDED', 'Цей товар був доданий в наш каталог %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Цей товар буде в наявності %s.');

define('TEXT_EDIT_INTRO', 'Будь ласка, зробіть необхідні зміни');
define('TEXT_EDIT_CATEGORIES_ID', 'ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Ім\'я:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Зображення:');
define('TEXT_EDIT_SORT_ORDER', 'Сортування:');

define('TEXT_INFO_COPY_TO_INTRO', 'Будь ласка, виберіть нову категорію, в яку ви хочете скопіювати товар');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Існуючі категорії:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Нова категорія');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Змінити категорію');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Видалити категорію');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Перемістити категорію');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Видалити товар');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Перемістити товар');
define('TEXT_INFO_HEADING_COPY_TO', 'Копіювати в');
define('LINK_TO', 'Посилання на');

define('TEXT_DELETE_CATEGORY_INTRO', 'Ви впевнені, що хочете видалити цю категорію?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Ви впевнені, що ви хочете назавжди видалити цей товар?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>УВАГА:</b> %s підкатегорій все ще пов\'язані з цією категорією!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>УВАГА:</b> %s товарів все ще пов\'язані з цією категорією!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Будь ласка, виберіть категорію, в яку ви хочете помістити <b>%s</b>');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Будь ласка, виберіть категорію, в яку ви хочете помістити <b>%s</b>');
define('TEXT_MOVE', 'Перемістити <b>%s</b> в:');

define('TEXT_NEW_CATEGORY_INTRO', 'Будь ласка, заповніть наступні дані для нової категорії');
define('TEXT_CATEGORIES_NAME', 'Ім\'я:');
define('TEXT_CATEGORIES_IMAGE', 'Зображення:');
define('TEXT_SORT_ORDER', 'Сортування:');

define('TEXT_PRODUCTS_STATUS', 'Статус:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'В наявності:');
define('TEXT_PRODUCT_AVAILABLE', 'В наявності');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Немає в наявності');
define('TEXT_PRODUCTS_MANUFACTURER', 'Виробник:');
define('TEXT_PRODUCTS_NAME', 'Назва:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Опис:');
define('TEXT_PRODUCTS_QUANTITY', 'Кількість:');
define('TEXT_PRODUCTS_MODEL', 'Коду:');
define('TEXT_PRODUCTS_IMAGE', 'Зображення:');
define('TEXT_PRODUCTS_URL', 'URL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(без http://)</small>');
define('TEXT_PRODUCTS_PRICE', 'Ціна:');
define('TEXT_PRODUCTS_WEIGHT', 'Вага:');
define('TEXT_NONE', '--ні--');

define('EMPTY_CATEGORY', 'Порожня категорія');

define('TEXT_HOW_TO_COPY', 'Метод копіювання:');
define('TEXT_COPY_AS_LINK', 'Посилання на товар');
define('TEXT_COPY_AS_DUPLICATE', 'Дублювати товар');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Помилка: Не можу зробити посилання на товар в тій же категорії.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Ошибка: Папка изображений не доступна для записи: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Ошибка: Папка изображений не существует: ' . DIR_FS_CATALOG_IMAGES);

define('TEXT_PMU_CANCEL', 'відзначити');
define('TEXT_DUBLICATE_TO', 'Дублювати в');
define('TEXT_PMU_LINK', 'Посиланням в');
define('TEXT_PMU_DEL', 'вилучити');
define('TEXT_PMU_DUBL_CATEGORY', 'Дублювати категорію:');

//Button
define('BUTTON_BACK_NEW', 'назад');
define('BUTTON_PMU_SUBMIT', 'Виконати');