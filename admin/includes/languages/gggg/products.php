<?php
/*
  $Id: categories.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('TEXT_PRODUCTS_SEO_URL', 'Products SEO URL:');
define('TEXT_EDIT_CATEGORIES_SEO_URL', 'Category SEO URL:');
define('TEXT_CATEGORIES_SEO_URL', 'Category SEO URL:');

// BOF MaxiDVD: Added For Ultimate-Images Pack!
define('TEXT_PRODUCTS_IMAGE_NOTE','<b>Картинка товара:</b><small><br>Основная картинка товара, которая используется при просмотре товара в <br><u>категориях и на странице подробного описания товара.</u>. Рекомендуется делать основную картинку не высокого качества и размера, ради быстроты загрузки страниц магазина и для удобства покупателей.<small>');
define('TEXT_PRODUCTS_IMAGE_MEDIUM', '<b>Большая картинка:</b><br><small>ЗАМЕНЯЕТ основную картинку товара на странице<br><u>подробного описания</u>.</small>');
define('TEXT_PRODUCTS_IMAGE_LARGE', '<b>Картинка для Pop-up окна:</b><br><small>ЗАМЕНЯЕТ картинку товара <br><u>во всплывающем окне</u>.</small>');
define('TEXT_PRODUCTS_IMAGE_LINKED', '<u>Использовать для товара эту картинку =</u>');
define('TEXT_PRODUCTS_IMAGE_REMOVE', 'Вы действительно хотите <b>удалить</b> эту картинку?');
define('TEXT_PRODUCTS_IMAGE_DELETE', '<b>Удалить</b> эту картинку с сервера?');
define('TEXT_PRODUCTS_IMAGE_REMOVE_SHORT', 'Удалить картинку, оставив файл картинки на сервере');
define('TEXT_PRODUCTS_IMAGE_DELETE_SHORT', 'Удалить картинку вместе с файлом');
define('TEXT_PRODUCTS_IMAGE_TH_NOTICE', '<b>МК = Маленькая картинка,</b> показывается только<br>при просмотре товара в магазине и просмотре страницы подробного описания товара<br>Если Вы не указали Большую картинку (БК), маленькая картинка также выводится в Pop-up окне, но если Вы указали Большую Картинку (БК), то в Pop-Up окне выводится именно Большая Картинка (БК)<br><br>');
define('TEXT_PRODUCTS_IMAGE_XL_NOTICE', '<b>БК = Большая Картинка,</b> Выводится в Pop-up окне<br><br><br>');
define('TEXT_PRODUCTS_IMAGE_ADDITIONAL', '<b>Дополнительные картинки</b> товара - Здесь Вы можете добавить к товару дополнительные картинки, если у товара только одна картинка или её нет совсем, то раздел, расположенный ниже, можно не заполнять.');

define('TEXT_XSELLS_ADD', 'Добавить по коду товара:');
define('TEXT_XSELLS_ADD_BUTTON', 'Добавить');
define('TEXT_XSELLS_DEL_BUTTON', 'Удалить');

define('TEXT_QTY_PRO_QUANTITY_LABEL', 'Количество');
define('TEXT_QTY_PRO_COMBINATION_PRICE_LABEL', 'Цена');
define('TEXT_QTY_PRO_VENDOR_CODE_LABEL', 'Артикул');

// EOF MaxiDVD: Added For Ultimate-Images Pack!
define('HEADING_TITLE', 'Категории / Товары');
define('HEADING_TITLE_SEARCH', 'Поиск:');
define('HEADING_TITLE_GOTO', 'Перейти в:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Категории / Товары');
define('TABLE_HEADING_ACTION', 'Действие');
define('TABLE_HEADING_STATUS', 'Статус');

define('TEXT_NEW_PRODUCT', 'Новый Товар в &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Категории:');
define('TEXT_SUBCATEGORIES', 'Субкатегории:');
define('TEXT_PRODUCTS', 'Товаров на странице:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Цена:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Класс Налогов:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Средняя Оценка:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Количество:');
define('TEXT_DATE_ADDED', 'Дата Добавления:');
define('TEXT_DELETE_IMAGE', 'Удалить Картинку');

define('TEXT_DATE_AVAILABLE', 'Доступно с:');
define('TEXT_LAST_MODIFIED', 'Последнее Изменение:');
define('TEXT_IMAGE_NONEXISTENT', 'Картинка не найдена');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Добавьте, пожалуйста, новую категорию или товар в<br>&nbsp;<br><b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Более подробная информация о товаре <a href="http://%s" target="blank"><u>на этой странице</u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Этот товар был добавлен в каталог %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Этот товар будет в продаже с %s.');

define('TEXT_EDIT_INTRO', 'Пожалуйста, внесите необходимые изменения');
define('TEXT_EDIT_CATEGORIES_ID', 'ID категории:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Название категории:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Картинка для категории:');
define('TEXT_EDIT_SORT_ORDER', 'Порядок сортировки:');
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'Название подробно:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Описание:');

define('TEXT_INFO_COPY_TO_INTRO', 'Выберите, пожалуйста, новую категорию, куда Вы хотите скопировать этот товар');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Текущие категории:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Новая Категория');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Изменить Категорию');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Удалить Категорию');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Перенести Категорию');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Удалить Товар');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Перенести Товар');
define('TEXT_INFO_HEADING_COPY_TO', 'Копировать В');

define('TEXT_DELETE_CATEGORY_INTRO', 'Вы действительно хотите удалить эту категорию?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Вы действительно хотите удалить этот товар?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ВНИМАНИЕ:</b> Есть еще %s субкатегорий, связанных с этой категорией!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ВНИМАНИЕ:</b> Есть еще %s наименований товара, связанных с этой категорией!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Пожалуйста, выберите категорию для перемещения <b>%s</b> в');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Пожалуйста, выберите категорию для перемещения <b>%s</b> в');
define('TEXT_MOVE', 'Переместить <b>%s</b> в:');

define('TEXT_NEW_CATEGORY_INTRO', 'Пожалуйста, заполните следующую информацию для новой категории');
define('TEXT_CATEGORIES_NAME', 'Название Категории:');
define('TEXT_CATEGORIES_IMAGE', 'Картинка Категории:');
define('TEXT_SORT_ORDER', 'Порядок Сортировки:');

define('TEXT_PRODUCTS_STATUS', 'Статус Товара:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Дата Поступления:');
define('TEXT_PRODUCT_AVAILABLE', 'В наличии');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Нет в наличии');
define('TEXT_PRODUCTS_MANUFACTURER', 'Производитель:');
define('TEXT_PRODUCTS_NAME', 'Название:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Описание товара:');
define('TEXT_PRODUCTS_QUANTITY', 'Количество товара на складе:');
define('TEXT_PRODUCTS_MODEL', 'Артикул:');
define('TEXT_PRODUCTS_IMAGE', 'Картинка Товара:');
define('TEXT_PRODUCTS_URL', 'URL товара:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(без http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Цена (Без налога):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Цена (С налогом):');
define('TEXT_PRODUCTS_WEIGHT', 'Вес товара:');
define('TEXT_NONE', '--нет--');

define('EMPTY_CATEGORY', 'Пустая Категория');

define('TEXT_HOW_TO_COPY', 'Метод Копирования:');
define('TEXT_COPY_AS_LINK', 'Ссылка на товар');
define('TEXT_COPY_AS_DUPLICATE', 'Дублировать товар');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Ошибка: Нельзя делать ссылку на товар в той же категории.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Ошибка: Каталог с картинками имеет неверные права доступа: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Ошибка: Каталог с картинками отсутствует: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Ошибка: Категория не может быть перенесена.');


//
define('ENTRY_PRODUCTS_PRICE', 'Цена товара');
define('ENTRY_PRODUCTS_PRICE_DISABLED', 'Не указана');
//


define('TEXT_PRODUCTS_PAGE_TITLE', 'Meta Title:');
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Meta Description:');
define('TEXT_PRODUCTS_KEYWORDS', 'Meta Keywords:');


// RJW Begin Meta Tags Code
  define('TEXT_META_TITLE', 'Meta Title');
  define('TEXT_META_DESCRIPTION', 'Meta Description');
  define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

define('TABLE_HEADING_PARAMETERS', 'Тех. параметры');

define('TEXT_PRODUCTS_INFO', 'Краткое описание:');

define('TEXT_ATTRIBUTE_HEAD', 'Атрибуты товара:');
define('TABLE_HEADING_ATTRIBUTE_1', 'Активные атрибуты');
define('TABLE_HEADING_ATTRIBUTE_2', 'Префикс');
define('TABLE_HEADING_ATTRIBUTE_3', 'Стоимость');
define('TABLE_HEADING_ATTRIBUTE_4', 'Порядок сортировки');
define('TABLE_HEADING_ATTRIBUTE_5', 'Файл');
define('TABLE_HEADING_ATTRIBUTE_6', 'Ссылка активна (дней)');
define('TABLE_HEADING_ATTRIBUTE_7', 'Максимум загрузок');
define('TABLE_HEADING_ATTRIBUTE_9', 'Вес');

define('TABLE_HEADING_PRODUCT_SORT', 'Порядок');
define('TEXT_ATTRIBUTE_DESC', 'Вы можете добавить атрибуты для товара, отметив необходимые атрибуты и указав стоимость. Если у товара нет атрибутов, просто пропустите данный этап. Ниже Вы можете видеть список активных атрибутов, группы и значения атрибутов добавляются/изменяются в разделе <a href="products_attributes.php">Каталог - Атрибуты - Настройка</a>.');

#Add:
define('TABLE_HEADING_XML', 'XML');
define('TEXT_PRODUCTS_TO_XML', 'Файлы XML:');
define('TEXT_PRODUCT_AVAILABLE_TO_XML', 'Включить');
define('TEXT_PRODUCT_NOT_AVAILABLE_TO_XML', 'Не включать');

// BOF Enable - Disable Categories Contribution--------------------------------------
define('TEXT_EDIT_STATUS', 'Статус');
define('TEXT_DEFINE_CATEGORY_STATUS', '1=Активна; 0=Неактивна');
define('TEXT_EDIT_ROBOTS_STATUS', 'Robots Index Status');
define('TEXT_DEFINE_CATEGORY_ROBOTS_STATUS', 'index, follow/noindex, nofollow');
// EOF Enable - Disable Categories Contribution--------------------------------------

define('TEXT_MIN_QUANTITY', 'Минимальное количество единиц для заказа:');
define('TEXT_MIN_QUANTITY_UNITS', 'Шаг:');


define('TEXT_PAGES', 'Страницы: ');
define('TEXT_TOTAL_PRODUCTS', 'Товаров в данной категории: ');
define('TEXT_ATT_UPLOAD', 'Обзор...');

define('TEXT_WEIGHT_HELP', '<span class="main"><b><font color="red">Внимание:</font></b> Если Вы добавляете не виртуальный товар, обязательно ставьте вес товара больше 0, например 0.1, иначе, при оформлении заказа будет пропущен этап выбора способа доставки товара, если вес товара 0, то товар считается виртуальным и, соотвественно, доставка такому товара не нужна (виртуальный товар просто скачивается в виде файла), учитывайте данный факт при добавлении товаров в интернет-магазин.</span>');

define('HEADING_TITLE_SEARCH_MODEL', 'по коду<br />&nbsp;товара');

define('TEXT_PRODUCTS_IMAGE_DIR', 'Директория загрузки:');
define('TEXT_IMAGES_MAIN_DIRECTORY', 'images');
define('TABLE_HEADING_YES','Да');
define('TABLE_HEADING_NO','Нет');
define('TEXT_IMAGES_OVERWRITE', 'Перезаписать существующее изображение?');
define('TEXT_IMAGES_OVERWRITE1', 'Используйте "Нет" для ручного указания картинки');
define('TEXT_IMAGE_OVERWRITE_WARNING','Внимание: Имя файла было изменено, но не перезаписано ');     
     
define('TEXT_PROD_TEXTS','Тексты');
define('TEXT_PROD_IMGS','Картинки');
define('TEXT_PROD_ATTRS','Атрибуты');
define('TEXT_PROD_LINK','Ссылка');
define('TEXT_PROD_PRICE','Цена');
define('TEXT_PROD_TOP','ТОП');
define('TEXT_PROD_NEW','NEW');
define('TEXT_PROD_AKC','АКЦИЯ');
define('TEXT_PROD_WE','Вес');
define('TEXT_PROD_SORT','Сортировка');
define('TEXT_PROD_QTY','Количество');
define('TEXT_PROD_MINORD','Минимум для заказа');
define('TEXT_PROD_IMGS2','Картинки товара');
define('TEXT_PROD_IMGS3','на');
define('TEXT_PROD_IMGS_OR','или');
define('TEXT_PROD_IMGS_DRAG','Перетяните сюда картинки');
define('TEXT_PROD_COLOR','Цвет');
define('TEXT_PROD_CROP','Вырезать!');
define('TEXT_PROD_SAVE_BEFORE','Сохраните товар перед добавлением картинок.');
define('TEXT_PROD_LOAD_IMGS','Загрузить картинки');
define('TEXT_PROD_LOAD_IMGS_BUT','Загрузить');
define('TEXT_PROD_ON','вкл.');
define('TEXT_PROD_OFF','выкл.');
define('TEXT_DISCOUNT','Скидка');
define('TEXT_RECIPROCAL_LINK','Reciprocal Link');

//Button
define('BUTTON_BACK_NEW', 'назад');
define('BUTTON_QUICK_VIEW', 'Быстрый просмотр');



define('TEXT_EDITED_FOR_SEO', 'Отредактировано для SEO');
