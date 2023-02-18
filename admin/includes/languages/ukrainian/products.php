<?php
/*
  $Id: categories.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
define('TEXT_PROD_LOAD_FILES','Завантажте файли:');
define('TEXT_ALOWED_FILE_TYPES','Дозволенi типи файлiв:');
define('TEXT_PROD_FILES_DRAG','Перетягнiть файли сюди');
define('TEXT_PROD_DOWNLOADS','Файли для завантаження');
define('TEXT_IS_DOWNLOAD_PRODUCT','Електронний товар:');
define('TEXT_PRODUCTS_SEO_URL', 'Products SEO URL:');
define('TEXT_EDIT_CATEGORIES_SEO_URL', 'Category SEO URL:');
define('TEXT_CATEGORIES_SEO_URL', 'Category SEO URL:');

// BOF MaxiDVD: Added For Ultimate-Images Pack!
define('TEXT_PRODUCTS_IMAGE_NOTE','<b>Картинка товару:</b><small><br>Основна картинка товару, яка використовується при перегляді товару в <br><u>категоріях і на сторінці докладного опису товару.</u>. Рекомендується робити основну картинку не високої якості і розміру, заради швидкості завантаження сторінок магазину і для зручності покупців.<small>');
define('TEXT_PRODUCTS_IMAGE_MEDIUM', '<b>Велика картинка:</b><br><small>ЗАМІНЮЄ основну картинку товару на сторінці<br><u>докладного опису</u>.</small>');
define('TEXT_PRODUCTS_IMAGE_LARGE', '<b>Картинка для Pop-up вікна:</b><br><small>ЗАМІНЮЄ картинку товару <br><u>у спливаючому вікні</u>.</small>');
define('TEXT_PRODUCTS_IMAGE_LINKED', '<u>Використовувати для товара цю картинку =</u>');
define('TEXT_PRODUCTS_IMAGE_REMOVE', 'Ви дійсно хочете <b>видалити</b> цю картинку?');
define('TEXT_PRODUCTS_IMAGE_DELETE', '<b>Видалити</b> цю картинку з сервера?');
define('TEXT_PRODUCTS_IMAGE_REMOVE_SHORT', 'Видалити картинку, залишивши файл картинки на сервері');
define('TEXT_PRODUCTS_IMAGE_DELETE_SHORT', 'Видалити картинку разом з файлом');
define('TEXT_PRODUCTS_IMAGE_TH_NOTICE', '<b>МК = Маленька картинка,</b> показується тільки<br>при перегляді товару в магазині і перегляді сторінки докладного опису товару<br>Якщо Ви не вказали Велику картинку (ВК), маленька картинка також виводиться в Pop-up вікні, але якщо Ви вказали Велику Картинку (ВК), то в Pop-Up вікні виводиться саме Велика Картинка (ВК)<br><br>');
define('TEXT_PRODUCTS_IMAGE_XL_NOTICE', '<b>ВК = Велика Картинка,</b> Виводиться в Pop-up вікні<br><br><br>');
define('TEXT_PRODUCTS_IMAGE_ADDITIONAL', '<b>Додаткові картинки</b> товара - Тут Ви можете додати до товару додаткові картинки, якщо у товару тільки одна картинка або її немає зовсім, то розділ, розташований нижче, можна не заповнювати.');

define('TEXT_XSELLS_ADD', 'Додати за кодом товару:');
define('TEXT_XSELLS_ADD_BUTTON', 'Додати');
define('TEXT_XSELLS_DEL_BUTTON', 'Видалити');

define ('TEXT_QTY_PRO_QUANTITY_LABEL', 'Кількість');
define('TEXT_QTY_PRO_COMBINATION_PRICE_LABEL', 'Ціна');
define ('TEXT_QTY_PRO_VENDOR_CODE_LABEL', 'Артикул');

// EOF MaxiDVD: Added For Ultimate-Images Pack!
define('HEADING_TITLE', 'Категорії / Товари');
define('HEADING_TITLE_SEARCH', 'Пошук:');
define('HEADING_TITLE_GOTO', 'Перейти в:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Категорії / Товари');
define('TABLE_HEADING_ACTION', 'Дія');
define('TABLE_HEADING_STATUS', 'Статус');

define('TEXT_NEW_PRODUCT', 'Новый Товар в &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Категорії:');
define('TEXT_SUBCATEGORIES', 'Субкатегоріі:');
define('TEXT_PRODUCTS', 'Товарів на сторінці:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Ціна:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Клас Податків:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Середня Оцінка:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Кількість:');
define('TEXT_DATE_ADDED', 'Дата Додавання:');
define('TEXT_DELETE_IMAGE', 'Видалити Картинку');

define('TEXT_DATE_AVAILABLE', 'Доступно з:');
define('TEXT_LAST_MODIFIED', 'Остання Зміна:');
define('TEXT_IMAGE_NONEXISTENT', 'Зображення не знайдено');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Додайте, будь ласка, нову категорію або товар в<br>&nbsp;<br><b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Более подробная информация о товаре <a href="http://%s" target="blank"><u>на этой странице</u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Цей товар був доданий в каталог %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Цей товар буде в продажу з %s.');

define('TEXT_EDIT_INTRO', 'Будь ласка, внесіть необхідні зміни');
define('TEXT_EDIT_CATEGORIES_ID', 'ID категорії:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Назва категорії:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Картинка для категорії:');
define('TEXT_EDIT_SORT_ORDER', 'Порядок сортування:');
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'Назва детально:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Опис:');

define('TEXT_INFO_COPY_TO_INTRO', 'Виберіть, будь ласка, нову категорію, куди Ви хочете скопіювати цей товар');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Поточні категорії:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Нова Категорія');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Змінити Категорію');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Видалити Категорію');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Перенести Категорію');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Видалити Товар');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Перенести Товар');
define('TEXT_INFO_HEADING_COPY_TO', 'Копіювати В');

define('TEXT_DELETE_CATEGORY_INTRO', 'Ви дійсно хочете видалити цю категорію?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Ви дійсно хочете видалити цей товар?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>УВАГА:</b> Є ще %s субкатегорій, пов\'язаних з цією категорією!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>УВАГА:</b> Є ще %s найменувань товару, пов\'язаних з цією категорією!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Будь ласка, виберіть категорію для переміщення <b>%s</b> в');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Будь ласка, виберіть категорію для переміщення <b>%s</b> в');
define('TEXT_MOVE', 'Перемістити <b>%s</b> в:');

define('TEXT_NEW_CATEGORY_INTRO', 'Будь ласка, заповніть наступну інформацію для нової категорії');
define('TEXT_CATEGORIES_NAME', 'Назва Категорії:');
define('TEXT_CATEGORIES_IMAGE', 'Картинка Категорії:');
define('TEXT_SORT_ORDER', 'Порядок сортування:');

define('TEXT_PRODUCTS_STATUS', 'Статус Товару:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Дата Надходження:');
define('TEXT_PRODUCT_AVAILABLE', 'В наявності');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Немає в наявності');
define('TEXT_PRODUCT_STATUS','Статус');
define('TEXT_PRODUCTS_MANUFACTURER', 'Виробник:');
define('TEXT_PRODUCTS_NAME', 'Назва:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Опис товару:');
define('TEXT_PRODUCTS_QUANTITY', 'Кількість товару на складі:');
define('TEXT_PRODUCTS_MODEL', 'Артикул:');
define('TEXT_PRODUCTS_IMAGE', 'Картинка Товару:');
define('TEXT_PRODUCTS_URL', 'URL товару:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(без http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Ціна (Без податку):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Ціна (З податком):');
define('TEXT_PRODUCTS_WEIGHT', 'Вага товару:');
define('TEXT_NONE', '--ні--');

define('EMPTY_CATEGORY', 'Порожня Категорія');

define('TEXT_HOW_TO_COPY', 'Метод Копіювання:');
define('TEXT_COPY_AS_LINK', 'Посилання на товар');
define('TEXT_COPY_AS_DUPLICATE', 'Дублювати товар');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Помилка: Не можна робити посилання на товар в тій же категорії.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Ошибка: Каталог с картинками имеет неверные права доступа: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Ошибка: Каталог с картинками отсутствует: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Помилка: Категорія не може бути перенесена.');


//
define('ENTRY_PRODUCTS_PRICE', 'Ціна товару');
define('ENTRY_PRODUCTS_PRICE_DISABLED', 'Не вказана');
//


define('TEXT_PRODUCTS_PAGE_TITLE', 'Meta Title:');
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Meta Description:');
define('TEXT_PRODUCTS_KEYWORDS', 'Meta Keywords:');


// RJW Begin Meta Tags Code
  define('TEXT_META_TITLE', 'Meta Title');
  define('TEXT_META_DESCRIPTION', 'Meta Description');
  define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

define('TABLE_HEADING_PARAMETERS', 'Тех. параметри');

define('TEXT_PRODUCTS_INFO', 'Короткий опис:');

define('TEXT_ATTRIBUTE_HEAD', 'Атрибути товару:');
define('TABLE_HEADING_ATTRIBUTE_1', 'Активні атрибути');
define('TABLE_HEADING_ATTRIBUTE_2', 'Префікс');
define('TABLE_HEADING_ATTRIBUTE_3', 'Вартість');
define('TABLE_HEADING_ATTRIBUTE_4', 'Порядок сортування');
define('TABLE_HEADING_ATTRIBUTE_5', 'Файл');
define('TABLE_HEADING_ATTRIBUTE_6', 'Посилання активне (днів)');
define('TABLE_HEADING_ATTRIBUTE_7', 'Максимум завантажень');
define('TABLE_HEADING_ATTRIBUTE_9', 'Вага');

define('TABLE_HEADING_PRODUCT_SORT', 'Порядок');
define('TEXT_ATTRIBUTE_DESC', 'Вы можете добавить атрибуты для товара, отметив необходимые атрибуты и указав стоимость. Если у товара нет атрибутов, просто пропустите данный этап. Ниже Вы можете видеть список активных атрибутов, группы и значения атрибутов добавляются/изменяются в разделе <a href="products_attributes.php">Каталог - Атрибуты - Настройка</a>.');

define('TEXT_EMPTY_ATTRIBUTES', 'Спочатку додайте товару атрибут як мінімум із двома значеннями.');

#Add:
define('TABLE_HEADING_XML', 'XML');
define('TEXT_PRODUCTS_TO_XML', 'Файли XML:');
define('TEXT_PRODUCT_AVAILABLE_TO_XML', 'Увімкнути');
define('TEXT_PRODUCT_NOT_AVAILABLE_TO_XML', 'Не вмикати');

// BOF Enable - Disable Categories Contribution--------------------------------------
define('TEXT_EDIT_STATUS', 'Статус');
define('TEXT_DEFINE_CATEGORY_STATUS', '1=Активна; 0=Неактивна');
define('TEXT_EDIT_ROBOTS_STATUS', 'Robots Index Status');
define('TEXT_DEFINE_CATEGORY_ROBOTS_STATUS', 'index, follow/noindex, nofollow');
// EOF Enable - Disable Categories Contribution--------------------------------------

define('TEXT_MIN_QUANTITY', 'Мінімальна кількість одиниць для замовлення:');
define('TEXT_MIN_QUANTITY_UNITS', 'Крок:');


define('TEXT_PAGES', 'Сторінки:');
define('TEXT_TOTAL_PRODUCTS', 'Товарів в даній категорії:');
define('TEXT_ATT_UPLOAD', 'Огляд ...');

define('TEXT_WEIGHT_HELP', '<span class="main"><b><font color="red">Внимание:</font></b> Если Вы добавляете не виртуальный товар, обязательно ставьте вес товара больше 0, например 0.1, иначе, при оформлении заказа будет пропущен этап выбора способа доставки товара, если вес товара 0, то товар считается виртуальным и, соотвественно, доставка такому товара не нужна (виртуальный товар просто скачивается в виде файла), учитывайте данный факт при добавлении товаров в интернет-магазин.</span>');

define('HEADING_TITLE_SEARCH_MODEL', 'за кодом<br />&nbsp;товару');

define('TEXT_PRODUCTS_IMAGE_DIR', 'Директорія завантаження:');
define('TEXT_IMAGES_MAIN_DIRECTORY', 'images');
define('TABLE_HEADING_YES','Так');
define('TABLE_HEADING_NO','Ні');
define('TEXT_IMAGES_OVERWRITE', 'Перезаписати існуюче зображення?');
define('TEXT_IMAGES_OVERWRITE1', 'Используйте "Нет" для ручного указания картинки');
define('TEXT_IMAGE_OVERWRITE_WARNING','Увага: Файл було змінено, але не перезаписано');     
     
define('TEXT_PROD_TEXTS','Тексти');
define('TEXT_PROD_IMGS','Зображення');
define('TEXT_PROD_VIDEO','Відео');
define('TEXT_PROD_ATTRS','Атрибути');
define('TEXT_PROD_LINK','Посилання');
define('TEXT_PROD_PRICE','Ціна');
define('TEXT_PROD_TOP','ТОП');
define('TEXT_PROD_NEW','NEW');
define('TEXT_PROD_AKC','АКЦІЯ');
define('TEXT_PROD_WE','Вага');
define('TEXT_PROD_SORT','Сортування');
define('TEXT_PROD_QTY','Кількість');
define('TEXT_PROD_MINORD','Мінімум для замовлення');
define('TEXT_PROD_IMGS2','Зображення товару');
define('TEXT_PROD_IMGS3','на');
define('TEXT_PROD_IMGS_OR','або');
define('TEXT_PROD_IMGS_DRAG','Перетягніть сюди картинки');
define('TEXT_PROD_COLOR','Колір');
define('TEXT_PROD_CROP','Вирізати!');
define('TEXT_PROD_SAVE_BEFORE','Збережіть товар перед додаванням картинок.');
define('TEXT_PROD_LOAD_IMGS','Завантажити картинки');
define('TEXT_PROD_LOAD_IMGS_BUT','Завантажити');
define('TEXT_PROD_ON','вкл.');
define('TEXT_PROD_OFF','викл.');
define('TEXT_DISCOUNT','Знижка');
define('TEXT_RECIPROCAL_LINK','Reciprocal Link');


//Button
define('BUTTON_BACK_NEW', 'назад');
define('BUTTON_QUICK_VIEW', 'Швидкий перегляд');

define('TEXT_EDITED_FOR_SEO', 'Відредаговано для SEO');
define('TEXT_LINK_TO_YOUTUBE', 'Посилання на Youtube відео');
define('TEXT_IMAGE_PREVIEW', 'Прев\'ю');
define('TEXT_CHOOSE_ON_SERVER', 'Вибрати на сервері');