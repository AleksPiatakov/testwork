<?php
/*
  $Id: ukrainian.php,v 1.3 2003/09/28 23:37:26 anotherlango Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
// Google SiteMaps
define('BOX_TOOLS_COMMENT8R', 'Коментарі');
define('BOX_GOOGLE_SITEMAP', 'Google SiteMaps');
define('BOX_CLEAR_IMAGE_CACHE', 'Очистити кеш зображень');
define('TBL_LINK_TITLE', 'Ajax категорії');
define('TBL_HEADING_TITLE_BACK_TO_PARENT', 'Назад');
define('TBL_HEADING_TITLE_SEARCH', 'Пошук');
define('TBL_HEADING_CATEGORIES_PRODUCTS', 'Категорії/Товари');
define('TBL_HEADING_MODEL', 'Код');
define('TBL_HEADING_QUANTITY', 'К-сть');
define('TBL_HEADING_PRICE', 'Ціна');
define('TBL_HEADING_TITLE_BACK_TO_DEFAULT_ADMIN', 'Повернутись назад');
define('TBL_HEADING_PRODUCTS_COUNT', ' товарів');
define('TBL_HEADING_SUBCATEGORIES_COUNT', ' підкатегорій');
define('TBL_HEADING_SUBCATEGORIE_COUNT', ' підкатегорія');
define('TEXT_PRODILE_INFO_CHANGE_PASSWORD', 'Змінити свій пароль');
define('GOOGLE_FEED_MODULE_ENABLED_TITLE', 'Google Feed');

define('FACEBOOK_PIXEL_MODULE_ENABLED_TITLE','FaceBook Pixel');
define('DEFAULT_PIXEL_CURRENCY_TITLE','FaceBook Pixel валюта');
define('QUICK_PRODUCTS_UPDATE_ENABLED_TITLE','Оновлення Прайсу');
define('FACEBOOK_PIXEL_ID_TITLE','FaceBook Pixel ID');
define('TEXT_MENU_REVIEWS', 'Відгуки');
define('SQL_MODE_RECOMMENDATION_TEXT', "Для подальшої коректної роботи потрібно звернутися до адміністрації хостингу для обнулення змінної sql_mode в Mysql");
define('ROBOTS_TXT_RECOMMENDATION_TEXT', 'Robots.txt не включені на вашому сайті, для успішного просування рекоммендуем Вам включити його на <a target="_blank" href="/'.$admin.'/configuration.php?gID=1">сторінці</a>');
define('CRITICAL_CSS_TXT_RECOMMENDATION_TEXT', '<span class="critical-text">Потрібно згенерувати критичний CSS</span> <span class="critical-process">Обробка ...зачекайте, будь ласка</span><a class="start-generate-critical" href="javascript:void(0);">Старт</a>');
define('ALERT_ERRORS_BLOCK_TITLE', 'Сповіщення');
define('DOMEN_IN_ROBOTS_TXT_RECOMMENDATION_TEXT', '<span class="robots-txt-text">в Robots.txt не збігається деректива Host c іменем вашого сайта, для успішного просування рекомендуємо Вам його</span> <span class="generate-robots-txt-process">Обробка ...зачекайте, будь ласка</span><a class="start-generate-robots-txt" href="javascript:void(0);"> перегенерувати</a>');

//Admin begin
// header text in includes/header.php
define('HEADER_TITLE_ACCOUNT', 'Мій аккаунт');
define('HEADER_TITLE_LOGOFF', 'Вихід');
define('HEADER_TITLE_HELLO', 'Привіт');
define('HEADER_FRONT_LINK_TEXT', 'На сайт');
define('HEADER_ADMIN_TEXT', 'Адмінпанель');
define('HEADER_ORDERS_TODAY', 'Замовлень сьогодні: ');

define('HEADER_GO_TO_SITE', 'Перейти на сайт');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Адміни');
define('BOX_ADMINISTRATOR_MEMBERS', 'Групи користувачів');
define('BOX_ADMINISTRATOR_MEMBER', 'Користувачі');
define('BOX_ADMINISTRATOR_BOXES', 'Права доступу');
define('BOX_ADMINISTRATOR_ACCOUNT_UPDATE', 'Оновити інформацію про себе');

// limex: mod query performance START
define('TEXT_DISPLAY_NUMBER_OF_QUERIES', 'Відображено <b>%d</b> - <b>%d</b> (з <b>%d</b> запитів)');
define('BOX_TOOLS_MYSQL_PERFORMANCE', 'Повільні запити');
define('TEXT_DELETE', 'Видалити всі записи?');
define('IMAGE_BUTTON_DELETE', 'Видалити всі записи');
define('IMAGE_BUTTON_CANCEL', 'Не видаляти записи');
// limex: mod query performance END


//mod for ez price updater
define('BOX_CATALOG_PRICE_QUICK_UPDATES', 'Швидка зміна ціни');
define('BOX_CATALOG_PRICE_UPDATE_VISIBLE', 'Видима зміна ціни');
define('BOX_CATALOG_PRICE_UPDATE__ALL', 'змінити всі ціни');
define('BOX_CATALOG_PRICE_CANGE', 'Змінити ціну');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI', 'Керування товарами');
define('BOX_CATALOG_SEO_FILTER', "SEO filter");
define('BOX_CATALOG_STATS_SEARCH_KEYWORDS', "Планувальник ключів");
define('BOX_CATALOG_SEO_TEMPALTES', "SEO-шаблони");

define('TEXT_INDEX_LANGUAGE', 'Мова: ');
define('TEXT_SUMMARY_CUSTOMERS', 'Покупці');
define('TEXT_SUMMARY_ORDERS', 'Замовлення');
define('TEXT_SUMMARY_PRODUCTS', 'Товари');
define('TEXT_SUMMARY_HELP', 'Допомога');
define('TEXT_SUMMARY_STAT', 'Статистика');
define('TABLE_HEADING_CUSTOMERS', 'Покупці');

define('TEXT_GO_TO_CAT', 'Перейти в');
define('TEXT_GO_TO_SEARCH', 'Пошук');
define('TEXT_GO_TO_SEARCH2', 'по коду<br>товару');

// images
define('IMAGE_FILE_PERMISSION', 'Права доступу');
define('IMAGE_GROUPS', 'Список груп');
define('IMAGE_INSERT_FILE', 'Додати файл');
define('IMAGE_MEMBERS', 'Список користувачів');
define('IMAGE_NEW_GROUP', 'Додати групи');
define('IMAGE_NEW_MEMBER', 'Додати користувача');
define('IMAGE_NEXT', 'Далі');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> файлів)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> користувачів)');
//Admin end

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'en_US.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
//define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', '%d %B %Y р.'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_FORMAT_SPIFFYCAL', 'dd/MM/yyyy');  //Use only 'dd', 'MM' and 'yyyy' here in any order


define('TEXT_DAY_1','Понеділок');
define('TEXT_DAY_2','Вівторок');
define('TEXT_DAY_3','Середа');
define('TEXT_DAY_4','Четвер');
define('TEXT_DAY_5','П\'ятниця');
define('TEXT_DAY_6','Субота');
define('TEXT_DAY_7','Неділя');
define('TEXT_DAY_SHORT_1','Пн');
define('TEXT_DAY_SHORT_2','Вт');
define('TEXT_DAY_SHORT_3','Ср');
define('TEXT_DAY_SHORT_4','Чт');
define('TEXT_DAY_SHORT_5','Пт');
define('TEXT_DAY_SHORT_6','Сб');
define('TEXT_DAY_SHORT_7','Нед');
define('TEXT_MONTH_BASE_1','Січень');
define('TEXT_MONTH_BASE_2','Лютий');
define('TEXT_MONTH_BASE_3','Березень');
define('TEXT_MONTH_BASE_4','Квітень');
define('TEXT_MONTH_BASE_5','Травень');
define('TEXT_MONTH_BASE_6','Червень');
define('TEXT_MONTH_BASE_7','Липень');
define('TEXT_MONTH_BASE_8','Серпень');
define('TEXT_MONTH_BASE_9','Вересень');
define('TEXT_MONTH_BASE_10','Жовтень');
define('TEXT_MONTH_BASE_11','Листопад');
define('TEXT_MONTH_BASE_12','Грудень');
define('TEXT_MONTH_1','Січня');
define('TEXT_MONTH_2','Лютого');
define('TEXT_MONTH_3','Березня');
define('TEXT_MONTH_4','Квітня');
define('TEXT_MONTH_5','Травня');
define('TEXT_MONTH_6','Червня');
define('TEXT_MONTH_7','Липня');
define('TEXT_MONTH_8','Серпня');
define('TEXT_MONTH_9','Вересня');
define('TEXT_MONTH_10','Жовтня');
define('TEXT_MONTH_11','Листопада');
define('TEXT_MONTH_12','Грудня');


// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="uk"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// page title
define('TITLE', 'Адміністрування');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Адміністрування');
define('HEADER_TITLE_SUPPORT_SITE', 'Сайт підтримки');
define('HEADER_TITLE_ONLINE_CATALOG', 'Каталог');
define('HEADER_TITLE_ADMINISTRATION', 'Адміністрування');
define('HEADER_TITLE_CHAINREACTION', 'osCommerce');
define('HEADER_TITLE_PHESIS', 'Solomono');
// MaxiDVD Added Line For WYSIWYG HTML Area: BOF
define('BOX_CATALOG_DEFINE_MAINPAGE', 'Змінити головну сторінку');
// MaxiDVD Added Line For WYSIWYG HTML Area: EOF

define('CUSTOM_PANEL_DATE1', 'день');
define('CUSTOM_PANEL_DATE2', 'дня');
define('CUSTOM_PANEL_DATE3', 'днів');


// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Налаштування');
define('BOX_CONFIGURATION_MYSTORE', 'Магазин');
define('BOX_CONFIGURATION_LOGGING', 'Логи');
define('BOX_CONFIGURATION_CACHE', 'Кеш');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Модулі');
define('BOX_MODULES_PAYMENT', 'Оплата');
define('BOX_MODULES_SHIPPING', 'Доставка');
define('BOX_MODULES_SHIP2PAY', 'Доставка-Оплата (Ship 2 Pay)');
define('BOX_MODULES_ORDER_TOTAL', 'Заказ всього');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Каталог');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Категорії/Товари');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Атрибути');
define('BOX_CATALOG_PRODUCTS_PROPERTIES', 'Тех. Параметри');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES_NEW', 'Атрибути - Встановлення');
define('BOX_CATALOG_MANUFACTURERS', 'Виробники');
define('BOX_CATALOG_SPECIALS', 'Знижки');
define('BOX_CATALOG_EASYPOPULATE', 'Excel імпорт/експорт');

define('BOX_CATALOG_SALEMAKER', 'Масові знижки');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Покупці');
define('BOX_CUSTOMERS_CUSTOMERS', 'Покупці');
define('BOX_CUSTOMERS_ORDERS', 'Замовлення');
define('BOX_CUSTOMERS_EDIT_ORDERS', 'Редагувати замовлення');
define('BOX_CUSTOMERS_ENTRY', 'Кількість відвідувань');


// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Місця / Налоги');
define('BOX_TAXES_COUNTRIES', 'Країни');
define('BOX_TAXES_ZONES', 'Регіони');
define('BOX_TAXES_GEO_ZONES', 'Податкові зони');
define('BOX_TAXES_TAX_CLASSES', 'Типи податків');
define('BOX_TAXES_TAX_RATES', 'Ставки податків');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Звіти');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Переглянуті товари');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Замовлені товари');
define('BOX_REPORTS_PRODUCTS_PURCHASED_BY_CATEGORY', 'Замовлені товари по категоріям');
define('BOX_REPORTS_ORDERS_TOTAL', 'Кращі клієнти');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Інструменти');
define('BOX_TOOLS_BACKUP', 'Резервне копіювання БД');
define('BOX_TOOLS_CACHE', 'Контроль кешу');
define('BOX_TOOLS_MAIL', 'Надіслати Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Менеджер поштових розсилок');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Локалізація');
define('BOX_LOCALIZATION_CURRENCIES', 'Валюти');
define('BOX_LOCALIZATION_LANGUAGES', 'Мови');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Статуси замовлень');

// infobox box text in includes/boxes/info_boxes.php
define('BOX_HEADING_BOXES', 'Керування боксами');
define('BOX_HEADING_TEMPLATE_CONFIGURATION', 'Налаштування шаблонів');
define('BOX_HEADING_DESIGN_CONTROLS', 'Дизайн');

// javascript messages
define('JS_ERROR', 'При заповненні форми Ви припустились помилок!\nЗробіть, будь-ласка, наступні зміни:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Новий атрибут товару повинен мати ціну\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Новий атрибут товару повинен мати ціновий префікс\n');

define('JS_PRODUCTS_NAME', '* Для нового товару повинна бути вказана назва\n');
define('JS_PRODUCTS_DESCRIPTION', '* Для нового товару має бути зазначено опис\n');
define('JS_PRODUCTS_PRICE', '* Для нового товару повинна бути вказана ціна\n');
define('JS_PRODUCTS_WEIGHT', '* Для нового товару має бути вказана вага\n');
define('JS_PRODUCTS_QUANTITY', '* Для нового товару має бути вказана кількість\n');
define('JS_PRODUCTS_MODEL', '* Для нового товару має бути вказаний код товару\n');
define('JS_PRODUCTS_IMAGE', '* Для нового товару повинна бути картинка\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Для цього товару повинна бути встановлена нова ціна\n');

define('JS_FIRST_NAME', '* Поле \'Ім\'я\' повинно містити не менш як ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' символів.\n');
define('JS_LAST_NAME', '* Поле \'Прізвище\' повинно містити не менш як ' . ENTRY_LAST_NAME_MIN_LENGTH . ' символів.\n');
define('JS_DOB', '* Поле \'День народження\' має бути виконано у форматі: xx/xx/xxxx (день/місяць/рік).\n');
define('JS_EMAIL_ADDRESS', '* Поле \'E-Mail адреса\' повинно містити не менш як ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' символів.\n');
define('JS_ADDRESS', '* Поле \'Адреса\' повинно містити не менш як ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' символів.\n');
define('JS_POST_CODE', '* Поле \'Індекс\' повинно містити не менш як ' . ENTRY_POSTCODE_MIN_LENGTH . ' символів.\n');
define('JS_CITY', '* Поле \'Місто\' повинно містити не менш як ' . ENTRY_CITY_MIN_LENGTH . ' символів.\n');
define('JS_STATE', '* Поле \'Регіон\' має бути вибрано.\n');
define('JS_STATE_SELECT', '-- Виберіть вище --');
define('JS_ZONE', '* Поле \'Регіон\' має відповідати обраній країні.');
define('JS_COUNTRY', '* Поле \'Країна\' дожно бути заповнене.\n');
define('JS_TELEPHONE', '* Поле \'Телефон\' повинно містити не менш як ' . ENTRY_TELEPHONE_MIN_LENGTH . ' символів.\n');
define('JS_PASSWORD', '* Поля \'Пароль\' і \'Підтвердження\' повинні збігатися і містити не менш як ' . ENTRY_PASSWORD_MIN_LENGTH . ' символів.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Замовлення номер %s не знайдене!');

define('CATEGORY_PERSONAL', 'Персональний');
define('CATEGORY_ADDRESS', 'Адреса');
define('CATEGORY_CONTACT', 'Для контакту');
define('CATEGORY_COMPANY', 'Компанія');
define('CATEGORY_OPTIONS', 'Розсилка');
define('DISCOUNT_OPTIONS', 'Знижки');

define('ENTRY_FIRST_NAME', 'Ім\'я:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">минимум ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' символов</span>');
define('ENTRY_LAST_NAME', 'Прізвище:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">минимум ' . ENTRY_LAST_NAME_MIN_LENGTH . ' символов</span>');
define('ENTRY_DATE_OF_BIRTH', 'Дата народження:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(пример 21/05/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Адреса:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">минимум ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' символов</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Вы ввели неверный email адрес!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Данный email адрес уже зарегистрирован!</span>');
define('ENTRY_COMPANY', 'Назва компанії:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Адреса:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">минимум ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' символов</span>');
define('ENTRY_SUBURB', 'Район:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Індекс:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">минимум ' . ENTRY_POSTCODE_MIN_LENGTH . ' символов</span>');
define('ENTRY_CITY', 'Місто:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">минимум ' . ENTRY_CITY_MIN_LENGTH . ' символов</span>');
define('ENTRY_STATE', 'Регіон:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">обязательно</span>');
define('ENTRY_COUNTRY', 'Країна:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Телефон:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">минимум ' . ENTRY_TELEPHONE_MIN_LENGTH . ' символов</span>');
define('ENTRY_FAX_NUMBER', 'Факс:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Отримувати розсилку');
define('ENTRY_NEWSLETTER_YES', 'Підписан');
define('ENTRY_NEWSLETTER_NO', 'Не підписан');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Надіслати E-Mail');
define('IMAGE_BACK', 'Назад');
define('IMAGE_BACKUP', 'Рез. копія');
define('IMAGE_CANCEL', 'Скасувати');
define('IMAGE_CONFIRM', 'Підтвердити');
define('IMAGE_COPY', 'Копіювати');
define('IMAGE_COPY_TO', 'Копіювати в');
define('IMAGE_DETAILS', 'Налаштувати');
define('IMAGE_DELETE', 'Видалити');
define('IMAGE_LANG_DIR', 'Перейти до директорії перекладів');
define('IMAGE_EDIT', 'Редагувати');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'Менеджер файлів');
define('IMAGE_ICON_STATUS_GREEN', 'Активний');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Активізувати');
define('IMAGE_ICON_STATUS_RED', 'Неактивний');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Зробити неактивним');
define('IMAGE_ICON_INFO', 'Інформаційні сторінки');
define('IMAGE_INSERT', 'Додати');
define('IMAGE_LOCK', 'Замок');
define('IMAGE_MODULE_INSTALL', 'Встановити модуль');
define('IMAGE_MODULE_REMOVE', 'Видалити модуль');
define('IMAGE_MOVE', 'Перемістити');
define('IMAGE_NEW_BANNER', 'Новий банер');
define('IMAGE_NEW_CATEGORY', 'Нова категорія');
define('IMAGE_NEW_COUNTRY', 'Нова країна');
define('IMAGE_NEW_CURRENCY', 'Нова валюта');
define('IMAGE_NEW_FILE', 'Новий файл');
define('IMAGE_NEW_FOLDER', 'Нова папка');
define('IMAGE_NEW_LANGUAGE', 'Нова мова');
define('IMAGE_NEW_NEWSLETTER', 'Новий лист новин');
define('IMAGE_NEW_PRODUCT', 'Новий товар');
define('IMAGE_NEW_SALE', 'Нова розпродаж');
define('IMAGE_NEW_TAX_CLASS', 'Новий податок');
define('IMAGE_NEW_TAX_RATE', 'Нова ставка податку');
define('IMAGE_NEW_TAX_ZONE', 'Нова податкова зона');
define('IMAGE_NEW_ZONE', 'Нова зона');
define('IMAGE_ORDERS', 'Замовлення');
define('IMAGE_ORDERS_INVOICE', 'Рахунок-фактура');
define('IMAGE_ORDERS_PACKINGSLIP', 'Накладна');
define('IMAGE_PREVIEW', 'Предпросмотр');
define('IMAGE_RESTORE', 'Відновити');
define('IMAGE_RESET', 'Скидання');
define('IMAGE_SAVE', 'Зберегти');
define('IMAGE_SEARCH', 'Шукати');
define('IMAGE_SELECT', 'Вибрати');
define('IMAGE_SEND', 'Надіслати');
define('IMAGE_SEND_EMAIL', 'Надіслати Email');
define('IMAGE_UNLOCK', 'Розблокувати');
define('IMAGE_UPDATE', 'Оновити');
define('IMAGE_UPDATE_CURRENCIES', 'Скорегувати курси валют');
define('IMAGE_UPDATE_CURRENCIES_SHORT', 'Оновити валюти');
define('IMAGE_UPLOAD', 'Завантажити');
define('TEXT_IMAGE_NONEXISTENT', 'Немає картинки');

define('IMAGE_BUTTON_BUY_TEMPLATE','Перейти на платний пакет');
define('IMAGE_BUTTON_BUY_TEMPLATE_MOB', 'Купити');
define('TIME_LEFT', 'Залишилось: ');

define('ICON_CROSS', 'Недійсне');
define('ICON_CURRENT_FOLDER', 'Поточна директорія');
define('ICON_DELETE', 'Видалити');
define('ICON_ERROR', 'Помилка:');
define('ICON_FILE', 'Файл');
define('ICON_FILE_DOWNLOAD', 'Завантаження');
define('ICON_FOLDER', 'Папка');
define('ICON_LOCKED', 'Заблокувати');
define('ICON_PREVIOUS_LEVEL', 'Попередній рівень');
define('ICON_PREVIEW', 'Редагувати');
define('ICON_STATISTICS', 'Статистика');
define('ICON_SUCCESS', 'Виконано');
define('ICON_TICK', 'Істина');
define('ICON_UNLOCKED', 'Розблокувати');
define('ICON_WARNING', 'УВАГА');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Сторінка %s з %d');

define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> банерів)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> країн)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> клієнтів)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> валют)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> мовних модулів)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> виробників)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> розсилок)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> замовлень)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> статусів)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> позицій)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> спеціальних пропозицій)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> типів податків)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> податкових зон)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> ставок податків)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> зон)');

define('PREVNEXT_BUTTON_PREV', 'Попередня');
define('PREVNEXT_BUTTON_NEXT', 'Наступна');

define('TEXT_DEFAULT', 'за замовчуванням');
define('TEXT_SET_DEFAULT', 'Встановити за замовчуванням');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Обязательно</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Помилка: До теперішнього часу жодна валюта не була встановлена за замовчуванням. Будь ласка, встановіть одну з них в: Локалізація -> Валюта');

define('TEXT_CACHE_CATEGORIES', 'Бокс Категорій');
define('TEXT_CACHE_MANUFACTURERS', 'Бокс Виробників');
define('TEXT_CACHE_ALSO_PURCHASED', 'Також Модулі Покупок');

define('TEXT_NONE', '--ні--');
define('TEXT_TOP', 'Початок');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Помилка: Каталог не існує.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Помилка: Каталог захищений від запису, встановіть необхідні права доступу.');
define('ERROR_FILE_NOT_SAVED', 'Помилка: Файл не був завантажений.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Помилка: Не можна закачувати файли даного типу.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Виконано: Файл успішно завантажений.');
define('WARNING_NO_FILE_UPLOADED', 'Попередження: Жодного файлу не завантажено.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Попередження: Опція завантаження файлів відключена в конфігураційному файлі php.ini.');

define('BOX_CATALOG_XSELL_PRODUCTS', 'Супутні товари');


// X-Sell
REQUIRE(DIR_WS_LANGUAGES . 'add_ccgvdc_ukrainian.php');

// BOF: Lango Added for print order MOD
define('IMAGE_BUTTON_PRINT', 'Друкувати');
// EOF: Lango Added for print order MOD

// BOF: Lango Added for Featured product MOD
define('BOX_CATALOG_FEATURED', 'Рекомендовані товари');
// EOF: Lango Added for Featured product MOD

// BOF: Lango Added for Sales Stats MOD
define('BOX_REPORTS_MONTHLY_SALES', 'Статистика продажів');
// EOF: Lango Added for Sales Stats MOD


//BEGIN Dynamic information pages unlimited
define('BOX_HEADING_INFORMATION', 'Контент');
define('BOX_HEADING_SEO', 'SEO');
define('BOX_INFORMATION', 'Інфо-сторінки');
//END Dynamic information pages unlimited

define('BOX_TOOLS_KEYWORDS', 'Пошукові запити');

// RJW Begin Meta Tags Code
define('TEXT_META_TITLE', 'Meta Title');
define('TEXT_META_DESCRIPTION', 'Meta Description');
define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

// Article Manager
define('BOX_HEADING_ARTICLES', 'Статті');
define('BOX_TOPICS_ARTICLES', 'Статті');
define('BOX_ARTICLES_CONFIG', 'Налаштування');
define('BOX_ARTICLES_XSELL', 'Товари-Статті');
define('IMAGE_NEW_TOPIC', 'Новий розділ');
define('IMAGE_NEW_ARTICLE', 'Нова стаття');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> авторів)');

//TotalB2B start
define('BOX_CUSTOMERS_GROUPS', 'Групи');
define('BOX_MANUDISCOUNT', 'Знижки виробника');
//TotalB2B end

// add for Group minimum price to order start		
define('GROUP_MIN_PRICE', 'Мінімальна вартість замовлення групи');
// add for Group minimum price to order end

// add for color groups start
define('GROUP_COLOR_BAR', 'Колір групи');
// add for color groups end
//TotalB2B end
define('BOX_CATALOG_QUICK_UPDATES', 'Оновлення Прайсу');

define('IMAGE_PROPERTIES_POPUP_ADD_CHANGE_DELETE', 'Змінити / видалити тех. параметри');
define('IMAGE_PROPERTIES_POPUP_ADD', 'Додати тех. параметри');
define('IMAGE_PROPERTIES', 'Тех. параметри');

// polls box text in includes/boxes/polls.php

define('BOX_HEADING_POLLS', 'Опитування');
define('BOX_POLLS_POLLS', 'Опитування');
define('BOX_POLLS_CONFIG', 'Налаштування Опитувань');
define('BOX_CURRENCIES_CONFIG', 'Валюти');
define('BOX_COUPONS', 'Промо-коди');

define('BOX_INDEX_GIFTVOUCHERS', 'Сертифікати / Промо-коди');

define('BOX_REPORTS_SALES_REPORT2', 'Статистика продажів 2');
define('BOX_REPORTS_SALES_REPORT', 'Статистика продажів 3');
define('BOX_REPORTS_CUSTOMERS_ORDERS', 'Статистика клієнтів');

define('TEXT_NEW_ATTRIBUTE_EDIT', 'Редагувати атрибути товару');

define('ONE_PAGE_CHECKOUT_TITLE', 'Оформлення замовлення');
define('BROWSE_BY_CATEGORIES_TITLE', 'Вивід категорій');
define('SEO_TITLE', 'SEO URLs');
define('SEO_ENABLED_DESC', 'Модуль SEO URLs - призначений для перетворення звичайних посилань в ЧПУ-посилання');

/*define('ONEPAGE_ADDR_LAYOUT_TITLE', 'Addresses Layout');
define('ONEPAGE_CHECKOUT_HIDE_SHIPPING_TITLE', 'Dont show shipping and handling address checkbox or ship methods if weight of products = 0');
define('ONEPAGE_ZIP_BELOW_TITLE', '	Move zip/post code input boxes below state');
define('ONEPAGE_TELEPHONE_TITLE', 'Нужен телефон?');
define('ONEPAGE_CHECKOUT_LOADER_POPUP_TITLE', 'Make loader message popup');
define('ONEPAGE_CHECKOUT_SHOW_ADDRESS_INPUT_FIELDS_TITLE', 'Show Address in input Fields');
define('ONEPAGE_DEBUG_EMAIL_ADDRESS_TITLE', 'Send Debug Emails To:');
define('ONEPAGE_BOX_TWO_CONTENT_TITLE', 'Custom Colum Box #2 Content');
define('ONEPAGE_BOX_TWO_HEADING_TITLE', 'Custom Colum Box #2 Heading');
define('ONEPAGE_BOX_ONE_CONTENT_TITLE', 'Custom Colum Box #1 Content');
define('ONEPAGE_BOX_ONE_HEADING_TITLE', 'Custom Colum Box #1 Heading');
define('ONEPAGE_SHOW_OSC_COLUMNS_TITLE', 'Показывать колонки Oscommerce');
define('ONEPAGE_LOGIN_REQUIRED_TITLE', 'Требовать логиниться');
define('ONEPAGE_SHOW_CUSTOM_COLUMN_TITLE', 'Показывать правую колонку');
define('ONEPAGE_ACCOUNT_CREATE_TITLE', 'Создание аккаунта');
define('ONEPAGE_CHECKOUT_ENABLED_TITLE', 'Включить One Page Checkout');
define('ONEPAGE_AUTO_SHOW_DEFAULT_ZIP_TITLE', 'Auto-show billing/shipping Default zip code');
define('ONEPAGE_AUTO_SHOW_DEFAULT_STATE_TITLE', 'Auto-show billing/shipping Default State');
define('ONEPAGE_AUTO_SHOW_DEFAULT_COUNTRY_TITLE', 'Auto-show billing/shipping Default Country');
define('ONEPAGE_AUTO_SHOW_BILLING_SHIPPING_TITLE', 'Auto-show billing/shipping modules');*/


define('SMS_ENABLE_TITLE', 'Включити sms-сервіс');
define('SMS_GATENAME_TITLE', 'SMS шлюз');
define('SMS_CUSTOMER_ENABLE_TITLE', 'Відправляти sms клієнту при покупці?');
define('TELEGRAM_TOKEN_TITLE','Telegram Token');
define('TELEGRAM_NOTIFICATIONS_ENABLED_TITLE','Увімкнути Telegram нотифікації');
define('SMS_CHANGE_STATUS_TITLE', 'Відправляти sms клієнту при зміні статусу?');
define('SMS_OWNER_ENABLE_TITLE', 'Відправляти sms адміну при покупці?');
define('SMS_OWNER_ENABLE_BUY_ONE_CLICK_TITLE', 'Надсилати sms адміну при покупці в один клік?');
define('SMS_OWNER_TEL_TITLE', 'Номер телефону адміна');
define('SMS_TEXT_TITLE', 'Текст sms');
define('SMS_LOGIN_TITLE', 'Логін на SMS шлюз (або API ключ, Account SID)');
define('SMS_PASSWORD_TITLE', 'Пароль (або Auth token)');
define('SMS_SIGN_TITLE', 'Відправник (або Service SID)');
define('SMS_ENC_TITLE', 'код2');


define('ROBOTS_TXT_TITLE', 'robots.txt');

define('SMS_CONF_TITLE', 'sms-сервис');
define('MY_SHOP_CONF_TITLE', 'Мій магазин');
define('MIN_VALUES_CONF_TITLE', 'Мінімальні значення');
define('MAX_VALUES_CONF_TITLE', 'Максимальні значення');
define('IMAGES_CONF_TITLE', 'Зображення');
define('CUSTOMER_DETAILS_CONF_TITLE', 'Дані покупця');
define('MODULES_CONF_TITLE', 'Встановлені модулі');
define('SHIPPING_CONF_TITLE', 'Доставка/Упаковка');
define('LISTING_CONF_TITLE', 'Вивід товару');
define('STOCK_CONF_TITLE', 'Склад');
define('LOGS_CONF_TITLE', 'Логі');
define('CACHE_CONF_TITLE', 'Кеш');
define('EMAIL_CONF_TITLE', 'Налаштування E-Mail');
define('DOWNLOAD_CONF_TITLE', 'Завантаження');
define('GZIP_CONF_TITLE', 'GZip Компресія');
define('SESSIONS_CONF_TITLE', 'Сесії');
define('HTML_CONF_TITLE', 'HTML редактор');
define('DYMO_CONF_TITLE', 'Модуль Dynamic MoPics');
define('DOWN_CONF_TITLE', 'Тех. обслуговування');
define('GA_CONF_TITLE', 'Швидке оформлення');
define('LINKS_CONF_TITLE', 'Посилання');
define('QUICK_CONF_TITLE', 'Оновлення прайса');
define('WISHLIST_TITLE', 'Відкладені товари');
define('PAGE_CACHE_TITLE', 'Кеш сторінок');
define('GRAPHS_TITLE', 'Графік');
define('YANDEX_MARKET_CONF_TITLE', 'XML-вивантаження');


define('ATTRIBUTES_COPY_TEXT1', 'Увага: Не можна скопіювати атрибути з товару номер');
define('ATTRIBUTES_COPY_TEXT2', ' в товар номер');
define('ATTRIBUTES_COPY_TEXT3', '. Нічого не скопійовано.');
define('ATTRIBUTES_COPY_TEXT4', 'Увага: Немає атрибутів для копіювання з товару номер');
define('ATTRIBUTES_COPY_TEXT5', ' в товар ');
define('ATTRIBUTES_COPY_TEXT6', '. Нічого не скопійовано.');
define('ATTRIBUTES_COPY_TEXT7', ' Увага: Товар з номером');
define('ATTRIBUTES_COPY_TEXT8', ' не знайдений. Або Ви не вказали номер товару, або вказаний товар не існує. Нічого не скопійовано.');

//include('includes/languages/english_support.php');

// BOF FlyOpenair: Extra Product Price
define('BOX_EXTRA_PRODUCT_PRICE', 'Націнки');
define('EXTRA_PRODUCT_PRICE_ID_TITLE', 'Система націнок');
define('EXTRA_PRODUCT_PRICE_ID_DESC', 'Включення і вимикання модуля системи націнок');
// EOF FlyOpenair: Extra Product Price

define('TEXT_IMAGE_OVERWRITE_WARNING', 'Увага: Файл було змінено, але не перезаписано');

// 500 Page )
define('SERVICE_MENU', 'TOOLS');
define('SEO_CONFIGURATION','SEO TOOLS');

define('COMMENTS_MODULE_ENABLED_TITLE', 'Відгуки');
define('LANGUAGE_SELECTOR_MODULE_ENABLED_TITLE', 'Багатомовність');
define('PRODUCT_LABELS_MODULE_ENABLED_TITLE', 'Ярлики');
define('ATTRIBUTES_PRODUCTS_MODULE_ENABLED_TITLE', 'Фільтри');
define('AUTH_MODULE_ENABLED_TITLE', 'Авторизації (Google, Facebook)');
define('EXCEL_IMPORT_MODULE_ENABLED_TITLE', 'Імпорт/Експорт CSV');
define('CUPONES_MODULE_ENABLED_TITLE', 'Промо-коди');
define('COMPARE_MODULE_ENABLED_TITLE', 'Порівняння');
define('WISHLIST_MODULE_ENABLED_TITLE', 'Список бажань');
define('GOOGLE_FEED_CHOOSE_ALL_PRODUCTS_TITLE', 'активні товари');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_2_TITLE', 'товари зі статусом вигрузки XML');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_3_TITLE', 'товари за умови наявності на складі');
define('XSELL_PRODUCTS_BUYNOW_ENABLED_TITLE', 'Супутні товари');
define('STATS_PRODUCTS_PURCHASED_BY_CATEGORY_MODULE_ENABLED_TITLE', 'Статистика - Замовлені товари (по категоріях)');
define('SALEMAKER_MODULE_ENABLED_TITLE', 'Масові знижки');
define('SPECIALS_MODULE_ENABLED_TITLE', 'Знижки');
define('STATS_KEYWORDS_ENABLED_TITLE', 'Статистика пошукових запитів');
define('BACKUP_ENABLED_TITLE', 'Резервне копіювання бази даних');
define('PRODUCTS_MULTI_ENABLED_TITLE', 'Масове керування товарами');
define('SEO_TEMPLATES_ENABLED_TITLE', 'SEO Шаблони');
define('SHIP2PAY_ENABLED_TITLE', 'Доставка-Оплата (Ship 2 Pay)');
define('QTY_PRO_ENABLED_TITLE', 'Комбінації атрибутів');
define('MASTER_PASSWORD_MODULE_ENABLED_TITLE', '"Мастер" пароль');
define('YML_MODULE_ENABLED_TITLE', 'Імпорт XML (YML)');
define('OSC_IMPORT_MODULE_ENABLED_TITLE', 'Міграція бази даних (osCommerce)');
define('EXPORT_HOTLINE_MODULE_ENABLED_TITLE', 'XML-експорт товарів "Hotline"');
define('EXPORT_PROMUA_MODULE_ENABLED_TITLE', 'XML-експорт товарів "Prom"');
define('EXPORT_PRICEUA_MODULE_ENABLED_TITLE', 'XML-експорт товарів "Price.ua"');
define('EXPORT_ROZETKA_MODULE_ENABLED_TITLE', 'XML-експорт товарів "Rozetka"');
define('EXPORT_YANDEX_MARKET_MODULE_ENABLED_TITLE', 'Yandex Market експорт');
define('EXPORT_GOOGLE_SITEMAP_MODULE_ENABLED_TITLE', 'XML Sitemaps (карти сайту)');
define('EXPORT_FACEBOOK_FEED_MODULE_ENABLED_TITLE', 'XML фід для Facebook Product Catalog');
define('EXPORT_PDF_MODULE_ENABLED_TITLE', 'Експорт товарів в PDF');
define('PROMURLS_MODULE_ENABLED_TITLE', 'Prom.ua посилання');
define('PROM_EXCEL_MODULE_ENABLED_TITLE', 'Імпорт Prom.ua (Excel)');
define('MASTER_PASS_TITLE', '"Мастер" пароль');
define('SMSINFORM_MODULE_ENABLED_TITLE', 'Модуль SMS');
define('CARDS_ENABLED_TITLE', 'Оплата картками (13 способів)');
define('SOCIAL_WIDGETS_ENABLED_TITLE', 'Соц. віджети');
define('MULTICOLOR_ENABLED_TITLE', 'Мультиколір');
define('WATERMARK_ENABLED_TITLE', 'Водяний знак');
define('FACEBOOK_APP_ID_TITLE', 'Facebook app ID');
define('FACEBOOK_APP_SECRET_TITLE', 'Facebook секретний ключ');
define('VK_APP_ID_TITLE', 'Vkontakte app ID');
define('VK_APP_SECRET_TITLE', 'Vkontakte секретний ключ');

define('TABLE_HEADING_ORDERS', 'ЗАМОВЛЕННЯ:');
define('TABLE_HEADING_LAST_ORDERS', 'Останні замовлення');
define('TABLE_HEADING_CUSTOMER', 'Покупець');
define('TABLE_HEADING_ORDER_NUMBER', '№');
define('TABLE_HEADING_ORDER_TOTAL', 'Сума');
define('TABLE_HEADING_STATUS', 'Статус');
define('TABLE_HEADING_DATE', 'Дата');

include('includes/languages/order_edit_ukrainian.php');

define('TEXT_VALID_TITLE', 'Список категорій');
define('TEXT_VALID_TITLE_PROD', 'Список товарів');
define('TEXT_VALID_CLOSE', 'Закрити вікно');
define('TABLE_HEADING_LASTNAME', 'Прізвище');
define('TABLE_HEADING_FIRSTNAME', 'Ім\'я');
define('TABLE_HEADING_PRODUCT_NAME', 'Назва');
define('TABLE_HEADING_PRODUCT_PRICE', 'Ціна');
define('TEXT_SELECT_CUSTOMER', 'Виберіть покупця');
define('TEXT_SELECT_CUSTOMER_PLACEHOLDER', 'Почніть вводити ID / ім\'я / телефон / e-mail корстувача');
define('TEXT_SINGLE_CUSTOMER', 'Один покупець');
define('TEXT_EMAIL_RECIPIENT', 'E-mail отримувача');


define('TEXT_NOTIFICATIONS', 'Повідомлення');
define('TEXT_NOTIFICATIONS_MESSAGE', 'У вас %s неперевірених замовлень');
define('TEXT_NOTIFICATIONS_LINK', 'Перейти на сторінку замовлень');

define('TEXT_PROFILE', 'Профіль');
define('TEXT_PROFILE_GREETINGS', 'Привіт, %s!');
define('TEXT_PROFILE_LOGIN_COUNT', 'Кількість входів: %s');
define('TEXT_PROFILE_DAYS_WITH_US', 'Ви з нами вже %s днів');

define('TEXT_MENU_TITLE', 'Меню');
define('TEXT_MENU_HOME', 'Головна');
define('TEXT_MENU_PRODUCTS', 'Товари');
define('TEXT_MENU_CATALOGUE', 'Каталог');
define('TEXT_MENU_ATTRIBUTES', 'Атрибути');
define('TEXT_MENU_ORDERS', 'Замовлення');
define('TEXT_MENU_ORDERS_LIST', 'Список замовлень');
define('TEXT_MENU_CLIENTS_LIST', 'Список клієнтів');
define('TEXT_MENU_CLIENTS_GROUPS', 'Групи клієнтів');
define('TEXT_MENU_ADD_CLIENT', 'Додати клієнта');
define('TEXT_MENU_PAGES', 'Сторінки');
define('TEXT_MENU_EMAIL_CONTENT', 'Шаблони листів');
define('TEXT_MENU_SITE_MODULES', 'SOLO модулі');
define('TEXT_MENU_SITE_SEO_SETTINGS', 'Налаштування SEO');
define('TEXT_MENU_CKFINDER', 'Менеджер файлів');
define('TEXT_MENU_BACKUP', 'Резервне копіювання');
define('TEXT_MENU_TOTAL_CONFIG', 'Редактор налаштувань');
define('TEXT_MENU_NEWSLETTERS', 'Розсилки');
define('TEXT_MENU_SLOW_QUERIES_LOGS', 'Лог повільних запитів');
define('TEXT_MENU_PRODUCTS_VIEWS', 'Перегляди товарів');
define('TEXT_MENU_CLIENTS', 'Клієнти');
define('TEXT_MENU_SALES', 'Продажі');
define('TEXT_MENU_ADMINS_AND_GROUPS', 'Адміністратори і групи');
define('TEXT_MENU_UPDATE_PROFILE', 'Оновити свої дані');
define('TEXT_MENU_NOPHOTO', 'Без фото');
define('TEXT_MENU_OPENEDBY', 'Новi аккаунти');
define('TEXT_MENU_LAST_MODIFIED', 'Остання зміна');
define('TEXT_MENU_ZEROQTY', 'Нульова кількість');
define('TEXT_MENU_STATS_RECOVER_CART_SALES', 'Статистика незавершених замовлень');
define('TEXT_MENU_SEARCH', 'Пошук за категоріями');



define('TEXT_HEADING_ADD_NEW', 'Додати');
define('TEXT_HEADING_ADD_NEW_PRODUCT', 'Товар');
define('TEXT_HEADING_ADD_NEW_CATEGORY', 'Категорію');
define('TEXT_HEADING_ADD_NEW_PAGE', 'Сторінку');
define('TEXT_HEADING_ADD_NEW_CLIENT', 'Клієнта');
define('TEXT_HEADING_ADD_NEW_ORDER', 'Замовлення');
define('TEXT_HEADING_ADD_NEW_COUPON', 'Купон');

define('TEXT_BLOCK_ORDERS_STATUSES_COUNTERS', 'Статуси замовлень');

define('TEXT_BLOCK_ORDERS_TODAY_COUNTERS', 'Сьогодні');
define('TEXT_BLOCK_ORDERS_YESTERDAY_COUNTERS', 'Вчора');
define('TEXT_BLOCK_ORDERS_WEEK_COUNTERS', 'Тиждень');
define('TEXT_BLOCK_ORDERS_MONTH_COUNTERS', 'Місяць');
define('TEXT_BLOCK_ORDERS_QUARTER_COUNTERS', 'Квартал');
define('TEXT_BLOCK_ORDERS_ALL_TIME_COUNTERS', 'За весь час');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_CURRENCY', 'грн.');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_PREFIX', 'на');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_NOUN', 'замовлень');

define('TEXT_BLOCK_COUNTERS_PRODUCTS', 'Товарів');
define('TEXT_BLOCK_COUNTERS_ORDERS', 'Замовлень');
define('TEXT_BLOCK_COUNTERS_COMMENTS', 'Комметарів');
define('TEXT_BLOCK_COUNTERS_TOTAL_INCOME', 'Сума продажів');

define('TEXT_BLOCK_SETTINGS_TITLE', 'Налаштування');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_HEADER', 'Закріплена шапка');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_ASIDE', 'Закріплене бічне меню');
define('TEXT_BLOCK_SETTINGS_TITLE_FOLDED_ASIDE', 'Згорнуте бічне меню');
define('TEXT_BLOCK_SETTINGS_TITLE_DOCK_ASIDE', 'Бічне меню зверху');

define('TEXT_BLOCK_MODULES_STATS_USING', 'Використовується');
define('TEXT_BLOCK_MODULES_STATS_AMOUNT', ' шт.');
define('TEXT_BLOCK_MODULES_STATS_MODULES', 'модулів');
define('TEXT_BLOCK_MODULES_USED', 'Використовується модулів');
define('TEXT_BLOCK_MODULES_SEE_ALL', 'Переглянути всі модулі');

define('TEXT_BLOCK_OVERVIEW_TITLE', 'Огляд');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS', 'Замовлення');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED', 'ТОП переглядів');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD', 'ТОП продажів');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES', 'ТОП категорій');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS', 'Входи');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED', 'Пошуки');

define('TEXT_BLOCK_OVERVIEW_ACTION_EDIT', 'Редагувати');
define('TEXT_BLOCK_OVERVIEW_ACTION_VIEW', 'Переглянути');

define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_CUSTOMER_NAME', 'Покупець');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_DATE', 'Дата');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_AMOUNT', 'Сума');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_STATUS', 'Статус');

define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODUCT_IMAGE', 'Зображення');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODCUT_NAME', 'Назва');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_VIEWS', 'Переглядів');

define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODUCT_IMAGE', 'Зображення');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODCUT_NAME', 'Назва');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_ORDERS', 'Замовлень');

define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_CATEGORY_NAME', 'Назва');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_ORDERS', 'Замовлень');

define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_ADMIN_NAME', 'Ім\'я');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_DATE', 'Дата останнього входу');

define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_QUERY', 'Запит');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_COUNT', 'Кількість');

define('TEXT_BLOCK_NEWS_TITLE', 'Новини SoloMono');

define('TEXT_BLOCK_PLOT_TITLE', 'Графік доходів');
define('TEXT_BLOCK_PLOT_TAB_BY_DAYS', 'По днях');
define('TEXT_BLOCK_PLOT_TAB_BY_WEEKS', 'По тижнях');
define('TEXT_BLOCK_PLOT_TAB_BY_MONTHES', 'По місяцях');

define('TEXT_BLOCK_PLOT_XAXIS_LABEL', 'Загальна сума замовлень');
define('TEXT_BLOCK_PLOT_YAXIS_LABEL', 'Кількість замовлень');

define('TEXT_BLOCK_COMMENTS_TITLE', 'Відгуки');

define('TEXT_BLOCK_EVENTS_TITLE', 'Події');

define('TEXT_BLOCK_EVENTS_TOOLTIP_ALL_EVENTS', 'Всі події');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ADMINS', 'Адміністратори');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ORDERS', 'Замовлення');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CUSTOMERS', 'Покупці');
define('TEXT_BLOCK_EVENTS_TOOLTIP_NEW_PRODUCTS', 'Нові товари');
define('TEXT_BLOCK_EVENTS_TOOLTIP_COMMENTS', 'Коментарі');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CALL_ME_BACK', 'Передзвоніть мені');

define('TEXT_BLOCK_EVENTS_MESSAGE_ADMINS', '%s увійшов в систему');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS', 'Оформлений %s');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS_2', 'замовлення #%d');
define('TEXT_BLOCK_EVENTS_MESSAGE_CUSTOMERS', '%s зареєструвався на сайті');
define('TEXT_BLOCK_EVENTS_MESSAGE_NEW_PRODUCTS', 'Добавлен новый товар: "%s"');
define('TEXT_BLOCK_EVENTS_MESSAGE_COMMENTS', 'Користувач %s додав коментар');
define('TEXT_BLOCK_EVENTS_MESSAGE_CALL_ME_BACK', 'запросив дзвінок');

define('TEXT_BLOCK_GA_TITLE', 'Google Аналітика');

define('TEXT_SETTINGS_EDIT_FORM_SAVE', 'ОК');
define('TEXT_SETTINGS_EDIT_FORM_CANCEL', 'Скасувати');
define('TEXT_SETTINGS_EDIT_FORM_TOOLTIP', 'змінити');

define('TEXT_MODAL_ADD_ACTION', 'Добавити');
define('TEXT_MODAL_UPDATE_ACTION', 'Оновити');
define('TEXT_MODAL_DELETE_ACTION', 'Видалити');
define('TEXT_MODAL_CHANGE_STATUS', 'Змінити статус');
define('TEXT_MODAL_DETAILED', 'Детальніше');
define('TEXT_MODAL_ACTION', 'Дія');
define('TEXT_MODAL_INSTALL_ACTION', 'Встановити');
define('TEXT_MODAL_CONTINUE_ACTION', 'Продовжити');
define('TEXT_MODAL_CANCEL_ACTION', 'Відмінити');
define('TEXT_MODAL_CONFIRM_ACTION', 'Підтвердження');
define('TEXT_MODAL_CONFIRMATION_ACTION', 'Ви впевнені?');
define('TEXT_WAIT', 'Почекайте ..');
define('TEXT_SHOW', 'На сторінку:');
define('TEXT_RECORDS', 'Всього:');
define('TEXT_SAVE_DATA_OK', 'Дані успішно змінені');
define('TEXT_DEL_OK', 'Запис успішно видалена');
define('TEXT_ERROR', 'Виникла помилка');
define('TEXT_GENERAL_SETTING', 'Загальні');


//featured
define('TEXT_FEATURED_ADDED', 'Доданий');
define('TEXT_FEATURED_CHANGE', 'Змінено');
define('TEXT_FEATURED_EXPIRE_DATE', 'Дата закінчення');
define('TEXT_ENTER_PRODUCT', 'Введіть найменування');
define('TEXT_FEATURED_MODEL', 'Модель');
define('TEXT_PRODUCTS_ON_ATTRIBUTES_VAL', 'Список продуктів за значенням атрибута');

define('ADMIN_BTN_BUY_MODULE', 'Придбайте цей модуль!');
define('FOOTER_INSTRUCTION', 'Як користуватися Адмiнкою?');
define('FOOTER_NEWS', 'Новини Solomono');
define('FOOTER_SUPPORT_SOLOMONO', 'Тех. підтримка');
define('FOOTER_SUPPORT_CONSULTANT', 'Онлайн-консультант');
define('FOOTER_SUPPORT_TECHNICAL', 'Тех. підтримка');

//new admin
define('TEXT_ERROR_DEL_FILE', 'Неможливо видалити файл.');
define('TEXT_ERROR_UPDATE', 'Помилка оновлення.');

//languages_translater
define('TEXT_TRANSLATER_TITLE', 'Редактор мов');
define('TEXT_PRODUCT_FREE_SHIPPING', 'Безкоштовна доставка:');

define('TEXT_MOBILE_OPEN_COLLAPSE', 'Показати');
define('TEXT_MOBILE_CLOSE_COLLAPSE', 'Приховати');
define('TEXT_ORDER_STATISTICS', 'Статистика замовлень');
define('TEXT_WHO_ONLINE', 'Хто онлайн');
define('TEXT_VIEW_LIST', 'Дивитися список');
define('TEXT_ACTION_OVERVIEW', 'Огляд дій');
define('TEXT_SEE_ALL', 'Дивитися все');

define('TEXT_MOBILE_SHOW_MORE', 'Показати ще');
define('TEXT_MOBILE_INCOME', 'Доходи:');
define('TEXT_SHOW_ALL', 'Показати всі');
define('TEXT_REPLY_COMMENT', 'Відповісти на коментар - ');
define('TEXT_BTN_REPLY', 'Відповісти');
define('TEXT_BTN_ANSWERED', 'Відповіли');
define('TEXT_MODAL_APPLY_ACTION', 'Застосувати');

define('RCS_CONF_TITLE', 'Незавершені замовлення');
define('RECOVER_CART_SALES', 'Незавершені замовлення');

define('TEXT_REDIRECTS_TITLE', 'Перенаправлення');



define('INSTAGRAM_PRODUCTS_TITLE', 'Імпорт з instagram');
define('INSTAGRAM_PRODUCTS_RESULT', 'Продукти завантажені в бд');

define ('INSTAGRAM_SUCCESS', 'Публікації Instagram додані на наш сайт!');
define ('INSTAGRAM_LINK', 'Посилання на Instagram');
define ('INSTAGRAM_COUNT', 'Кількість постів');

define('INSTAGRAM_MODULE_ENABLE_TITLE', 'Instagram слайдер');

define('TEXT_ENABLE_MULTILANGUAGE_MODULE', 'Увімкніть багатомовний модуль');
define('TEXT_BUY_MULTILANGUAGE_MODULE', 'Будь ласка, придбайте багатомовний модуль');




define('TOOLTIP_STORE_NAME', 'Вкажіть оригінальну назву магазину, що приваблює покупців, запам\'ятовується, і служить для того, щоб виділитися та відзначитись серед подібних магазинів – конкурентів.');
define('TOOLTIP_STORE_OWNER', 'Вкажіть власника магазину');
define('TOOLTIP_SHOW_BASKET_ON_ADD_TO_CART', 'Увімкніть, кошик буде доступний при додаванні товару, щоб у відвідувача не виникло питань, що товар точно доданий до кошика.');
define('TOOLTIP_USE_DEFAULT_LANGUAGE_CURRENCY', 'Увімкніть, щоб валюта автоматично змінювалася відповідно до поточної мови сайту.');
define('TOOLTIP_CHANGE_BY_GEOLOCATION', 'Увімкніть, щоб валюта та мова сайту змінювалася залежно від геолокації.');
define('TOOLTIP_GET_BROWSER_LANGUAGE', 'Увімкніть, щоб валюта сайту змінювалася залежно від мови браузера.');
define('TOOLTIP_STORE_BANK_INFO', 'Дозволяє визначити точну інформацію про банк для реквізитів рахунок-фактури.');
define('TOOLTIP_ONEPAGE_LOGIN_REQUIRED', 'Увімкніть, і логін користувача/клієнта буде вимагатися завжди');
define('TOOLTIP_REVIEWS_WRITE_ACCESS', 'Увімкніть, і лише зареєстровані користувачі зможуть залишати свої коментарі');
define('TOOLTIP_ROBOTS_TXT', 'Захист всього сайту або деяких його розділів від індексації');
define('TOOLTIP_MENU_LOCATION', 'Виберіть розташування меню: зверху, ліворуч або ліворуч згорнуте');
define('TOOLTIP_DEFAULT_DATE_FORMAT', 'Виберіть формат дати');
define('TOOLTIP_SET_HTTPS', 'Увімкніть розширення протоколу HTTPS для підтримки шифрування з метою підвищення безпеки');
define('TOOLTIP_SET_WWW', 'Виберіть налаштування куди перенаправити: disable, www->no-www або no-www->www');
define('TOOLTIP_ENABLE_DEBUG_PAGE_SPEED', 'Увімкніть дебаг завантаження сторінки для пошуку та виправлення помилок у скрипті');
define('TOOLTIP_STORE_SCRIPTS', 'Ви можете підключити додаткові JS скрипти');
define('TOOLTIP_STORE_METAS', 'Ви можете підключити додаткові Meta-теги у head');
define('TOOLTIP_MYSQL_PERFORMANCE_TRESHOLD', 'Встановіть час у "секундах" понад який будуть логуватися повільні та потенційно проблемні запити до бази даних');
define('TOOLTIP_STOCK_REORDER_LEVEL', 'Вкажіть кількість товару на складі');

define('TOOLTIP_TELEGRAM_NOTIFICATIONS_ENABLED', 'Можна увімкнути/вимкнути Telegram повідомлення');
define('TOOLTIP_TELEGRAM_TOKEN', 'Спеціальні акаунти в Telegram, створені для того, щоб автоматично обробляти та надсилати повідомлення');
define('TOOLTIP_SMS_ENABLE', 'Можна увімкнути/вимкнути sms-сервіс');
define('TOOLTIP_SMS_CUSTOMER_ENABLE', 'Можна ввімкнути/вимкнути можливість надсилати SMS клієнту при покупці');
define('TOOLTIP_SMS_CHANGE_STATUS', 'Можна ввімкнути/вимкнути можливість надсилати SMS клієнту при зміні статусу');
define('TOOLTIP_SMS_OWNER_ENABLE', 'Можна ввімкнути/вимкнути можливість надсилати sms адміну при покупці');
define('TOOLTIP_SMS_OWNER_TEL', 'Вкажіть/змініть номер телефону адміністратора');


define('TOOLTIP_FACEBOOK_AUTH_STATUS', 'Ви можете дозволити користувачам входити на ваш сайт за допомогою облікового запису в Facebook. Це відмінний спосіб зробити цей процес простішим і зручнішим для ваших користувачів, а також збільшити кількість нових реєстрацій.');
define('TOOLTIP_FACEBOOK_APP_ID', 'Ідентифікаційний номер у соціальних мережах - комбінація цифр, що дозволяє відрізнити один обліковий запис від інших. В інтернеті це аналог паспорта, який часто потребує застосування надійних способів захисту. Ідентифікаційний номер створюється автоматично під час реєстрації профілю. З його допомогою можна знайти потрібну інформацію, людину або спільну спільноту.');
define('TOOLTIP_FACEBOOK_APP_SECRET', 'Секретний ключ – це пристрій для захисту облікового запису Facebook. Також це спосіб двофакторної аутентифікації, який підвищує рівень безпеки при вході до облікового запису.');
define('TOOLTIP_FACEBOOK_PIXEL_ID', 'За допомогою даних, які збирає Піксель Facebook, ви можете відслідковувати візити та конверсії на вашому сайті, оптимізувати рекламу та створювати індивідуалізовані аудиторії для ретаргетингу.');
define('TOOLTIP_DEFAULT_PIXEL_CURRENCY', 'Вкажіть валюту, в якій надсилатиметься ціна товару в FaceBook Pixel');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_BUG_REPORT', 'Призначений для опису виявлених багів, що дозволить команді розробки виправити помилки у програмі.');
define('TOOLTIP_FACEBOOK_GOALS_PHONE_CALL', 'Запустивши рекламу з номером телефону, ви можете спонукати людей зателефонувати до вашої компанії та зробити замовлення, дізнатися більше про ваші товари чи послуги або запланувати зустріч.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_FAST_BUY', 'Якщо товари купують регулярно, часто характеристики покупцю вже відомі, завдання не вибирати, а знайти потрібне, накидати у кошик та швидко оформити замовлення.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_CHAT', 'Кнопка чату — це піктограма, розміщена десь на вашому сайті, яка дозволяє клієнтам у режимі реального часу спілкуватися з командою клієнтської підтримки. За допомогою онлайн чату, ваші фахівці можуть швидко та ефективно вирішувати запити клієнтів.');
define('TOOLTIP_FACEBOOK_GOALS_CALLBACK', 'Завдання кнопки "зворотний дзвінок" - вивести на комунікацію потенційного клієнта.');
define('TOOLTIP_FACEBOOK_GOALS_FILTER', 'Фільтр дає можливість звузити асортименти до вибірки з характеристиками, найбільш релевантними індивідуальним потребам користувача.');
define('TOOLTIP_FACEBOOK_GOALS_SUBSCRIBE', 'Надає користувачам можливість організації та ведення тематичних e-mail-розсилок, на які можуть передплатити інші користувачі сервісу.');
define('TOOLTIP_FACEBOOK_GOALS_LOGIN', 'login – це слово, яке використовуватиметься для входу на сайт або сервіс. Дуже часто логін збігається з ім\'ям користувача, яке буде видно всім учасникам сервісу.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_REVIEW', 'Відгуки клієнтів — зворотний зв\'язок користувачів на ваші продукти або послуги. Щоб купити товар 89% покупців читають спочатку відгуки.');
define('TOOLTIP_FACEBOOK_GOALS_PAGE_VIEW', 'Ви можете знати, скільки людей бачили та запитували ваш сайт');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_CART', 'Кнопка «Додати в кошик» має на увазі покупку кількох товарів, коли вони спочатку все додаються в кошик і вже там оформляється замовлення.');
define('TOOLTIP_FACEBOOK_GOALS_CHECKOUT_PROCESS', 'Якість та зручність користування кошиком – запорука гарного настрою ваших покупців, ефективний спосіб підвищення конверсії сайту.');
define('TOOLTIP_FACEBOOK_GOALS_SEARCH_RESULTS', 'Перекладає користувача на сторінку результатів пошуку');
define('TOOLTIP_FACEBOOK_GOALS_VIEW_CONTENT', 'ViewContent повідомляє вам, чи відвідує хтось URL-адресу веб-сторінки.');
define('TOOLTIP_FACEBOOK_GOALS_COMPLETE_REGISTRATION', 'Надання клієнтом інформації в обмін на послугу вашої компанії');
define('TOOLTIP_FACEBOOK_GOALS_CONTACT_US_REQUEST', 'Контактні дані людини, який виявив реальну зацікавленість до товарів та послуг компанії та в майбутньому може стати реальним клієнтом.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_WISHLIST', 'Один із подій, що дозволяє стежити за діями користувачів, оптимізацію їх та створювати аудиторії');
define('TOOLTIP_FACEBOOK_GOALS_ADD_PAYMENT_INFO', 'Один із подій, що дозволяє стежити за діями користувачів, оптимізацію їх та створювати аудиторії');
define('TOOLTIP_FACEBOOK_GOALS_SUCCESS_PAGE', 'Клієнт бачить своєрідну накладну про досконале замовлення.');

define('TOOLTIP_GOOGLE_OAUTH_STATUS', 'Можливість увімкнення/вимкнення авторизації клієнта через Google');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_ID', 'За промовчанням Google визначає унікальний ідентифікатор клієнта – Client ID.');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_SECRET', 'CLIENT_SECRET використовується для зберігання трохи більш конфіденційної інформації, такої як використання api, інформація про трафік та платіжна інформація');
define('TOOLTIP_GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED', 'Має інструмент відстеження подій, дозволяє сервісам збирати дані та проводити аналіз');
define('TOOLTIP_GOOGLE_ECOMM_SUCCESS_PAGE', 'Можливість увімкнути/вимкнути сторінку "купівля" після підтвердження замовлення');
define('TOOLTIP_GOOGLE_ECOMM_CHECKOUT_PAGE', 'Можливість увімкнути/вимкнути сторінку оформлення замовлення');
define('TOOLTIP_GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE', 'Можливість увімкнути/вимкнути сторінку перегляду продукту');
define('TOOLTIP_GOOGLE_ECOMM_SEARCH_RESULTS', 'Можливість увімкнути/вимкнути сторінку результатів пошуку');
define('TOOLTIP_GOOGLE_ECOMM_HOME_PAGE', 'Можливість увімкнути/вимкнути стартову сторінку під час завантаження браузера');
define('TOOLTIP_GOOGLE_SITE_VERIFICATION_KEY', 'Ключ надає Google (необхідно вставити тільки сам ключ)');
define('TOOLTIP_GOOGLE_RECAPTCHA_STATUS', 'Ви можете увімкнути/вимкнути Google Recaptcha (захист веб-сайтів від інтернет-ботів та одночасної допомоги в оцифровці текстів книг)');
define('TOOLTIP_GOOGLE_RECAPTCHA_PUBLIC_KEY', 'Надає сервіс Google (для захисту веб-сайтів від інтернет-ботів та одночасної допомоги в оцифровці текстів книг)');
define('TOOLTIP_GOOGLE_RECAPTCHA_SECRET_KEY', 'Надає сервіс Google (для захисту веб-сайтів від інтернет-ботів та одночасної допомоги в оцифровці текстів книг)');




define('TOOLTIP_ENTRY_FIRST_NAME_MIN_LENGTH', "Вкажіть мінімальну кількість симфолів у колонці 'Значення' для кожного параметра");
define('TOOLTIP_ENTRY_LAST_NAME_MIN_LENGTH', "Вкажіть мінімальну кількість симфолів у колонці 'Значення' для кожного параметра");
define('TOOLTIP_ENTRY_EMAIL_ADDRESS_MIN_LENGTH', "Вкажіть мінімальну кількість симфолів у колонці 'Значення' для кожного параметра");
define('TOOLTIP_MIN_DISPLAY_XSELL', "Вкажіть мінімальну кількість симфолів у колонці 'Значення' для кожного параметра");

define('BOX_PRODUCTS_STATS_MENU_ITEM', 'Товари');

define('BOX_CLIENTS_STATS_TOP_CLIENTS', 'Топ клієнтів');
define('BOX_CLIENTS_STATS_NEW_CLIENTS', 'нові клієнти');


define('BOX_MENU_TOOLS_EMAILS', 'E-mail розсилки');
define('BOX_MENU_TOOLS_MASS_EMAILS', 'масові розсилки');


define('BOX_EXEL_IMPORT_EXPORT', 'Excel імпорт / експорт');
define('BOX_PROM_IMPORT_EXPORT', 'Prom.ua Excel імпорт');
define('IMPORT_EXPORT_MENU_BOX', 'Імпорт експорт');


define('BOX_MENU_TAXES', 'податки');


define('INTEGRATION_CONF_TITLE', 'Інші Інтеграції');

define('BOX_HEADING_INSTRUCTION', 'Інструкції');

define('BOX_CATALOG_YML', 'Імпорт YML');
define('TOOLTIP_CATEGORY_STATUS', 'При активізації категорія / підкатегорія / товар відображається на сторінці сайту');
define('TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS', 'Для додавання категорії / підкатегорії / товару в Google Feed. Щоб включити тільки один товар - повинна бути включена категорія і категорія, в якій знаходиться товар.');
define('TOOLTIP_PRODUCTS_FEATURED', 'Відображаються на головній сторінці.');
define('TOOLTIP_PRODUCTS_RELATED', 'Відображаються на сторінці товару, в статтях.');
define('TOOLTIP_PRODUCTS_ATTRIBUTES', 'Атрибути (фільтри) дозволяють визначати додаткові характеристики продукту, такі як розмір або колір. Детальніше в інструкції: ПОСИЛАННЯ');
define('TOOLTIP_ATTRIBUTES_VALUES', 'Після створення атрибута внесіть необхідні його значення.');
define('TOOLTIP_ATTRIBUTES_GROUPS', 'Для об\'єднання декількох атрибутів в одну групу.');
define('TOOLTIP_ATTRIBUTES_TYPES', 'Текст - текстовий опис характеристик; Dropdown - вибір зі списку; Radio - для вибору з наданих варіантів; Зображення - змінюється картика при виборі значення товару; Відображаються на сторінці товару.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_FILTER', 'Для відображення атрибутів товару в панелі фільтрів повзунок зробивши його активним.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_LISTING', 'При наведенні на товар відображаються атрибути в списку товарів.');
define('TOOLTIP_SPECIALS', 'Для установки спец ціни на один товар.');
define('TOOLTIP_SALES_MAKERS', 'Для установки знижки на кілька або на всі категорії товарів і / або виробників.');
define('TOOLTIP_EXPORT_IMPORT_CSV', 'Для завантаження / розвантаження бази з файлу з раширение .csv.');
define('TOOLTIP_EXPORT_IMPORT_PROM', 'Для експорту бази з файлу імпортованої з Prom.');
define('TOOLTIP_ORDER_DATE', 'Перегляд замовлень за вибраний діапазон часу.');
define('TOOLTIP_ORDER_DETAILS', 'деталі замовлення');
define('TOOLTIP_ORDER_EDIT', 'редагувати замовлення');
define('TOOLTIP_ORDER_STATUS', 'Для додавання нового статусу замовлення натисніть \"+\"');
define('TOOLTIP_CLIENT_EDIT', 'редагувати');
define('TOOLTIP_CLIENT_GROUP_PRICE', 'Ціна яка буде відображатися на сайті для клієнтів певної групи після авторизації. Кількість цін встановлюється в розділі \"Мій Магазин\"');
define('TOOLTIP_CLIENT_PRICE_GROUP_LIMIT', 'При досягненні суми межі, можна перевести клієнта в іншу групу.');
define('TOOLTIP_CLIENT_GROUP_EDIT', 'редагувати');
define('TOOLTIP_EMAIL_TEMPLATE', 'Готові шаблони листів для відправки клієнтам.');
define('TOOLTIP_EMAIL_TEMPLATE_EDIT', 'редагувати');
define('TOOLTIP_FILE_MANAGER', 'Для завантаження і редагування файлів на сайті.');
define('TOOLTIP_REDIRECTS', 'Наприклад, необхідно перенаправити зі сторінки https://demo.solomono.net/kontakty на сторінку https://demo.solomono.net/contact_us.php. Потрібно вказати в рядку \"перенаправити з\" kontakty \"перенаправіті на\" contact_us.php');
define('TOOLTIP_MODULES_PAYMENT', 'Додайте доступні способи оплати.');
define('TOOLTIP_MODULES_SHIPPING', 'Додайте доступні способи доставки.');
define('TOOLTIP_MODULES_TOTALS', 'Підсумкова вартість замовлення, відображається на сторінці оформлення замовлення.');
define('TOOLTIP_MODULES_ZONE', 'Вкажіть можливі способи доставки для певних зон, а так само дозволені способи оплати для цих зон. Створити нову зону можна в розділі Настройки> податки-> Податкові зони');
define('TOOLTIP_MODULES_LANGUAGES', 'Вибір мов сайту, установка мови за замовчуванням.');
define('TOOLTIP_MODULES_CURRENCY', 'Задайте валюту за замовчуванням і встановіть величину відповідно до курсу.');
define('TOOLTIP_MODULES_COUPONS', 'Створіть купон щоб покупець застосував його в кошику і отримав знижку.');
define('TOOLTIP_MODULES_POOLS', 'Створіть опитування, щоб отримати необхідну Вам статистику.');
define('TOOLTIP_MODULES_SOLOMONO', 'Список придбаних модулів + список доступних до покупки.');
define('TOOLTIP_CONFIGURATION_MAIN_EMAIL', 'Основна адреса куди приходять всі повідомлення.');
define('TOOLTIP_CONFIGURATION_FROM_EMAIL', 'Вкажіть адресу, від якого імені відправляти всі листи в масових розсилках.');
define('TOOLTIP_CONFIGURATION_ORDER_COPY_EMAIL', 'Вкажіть всі адреси куди будуть приходити копії листів із замовленнями. Можна вказувати кілька e-mail, через кому з пропуском.');
define('TOOLTIP_CONTACT_US_EMAIL', 'Вкажіть адресу куди будуть приходити звернення зі сторінки \"Зв\'яжіться з нами\"');
define('TOOLTIP_STORE_COUNTRY', 'Вкажіть країну магазину, вона буде обрана за замовчуванням при оформленні замовлення.');
define('TOOLTIP_STORE_REGION', 'Вкажіть регіон магазину, він буде обраний за замовчуванням при оформленні замовлення.');
define('TOOLTIP_CONTACT_ADDRESS', 'Вкажіть адресу магазину, він буде відображатися на сторінці \"Контакти\".');
define('TOOLTIP_MINIMUM_ORDER', 'За бажанням можна вказати мінімальну суму для успішного оформлення замовлення.');
define('TOOLTIP_MASTER_PASSWORD', 'Пароль, який підійде для входу в обліковий запис будь-якого клієнта, зареєстрованого на сайті.');
define('TOOLTIP_SHOW_PRICE_WITH_TAX', 'Перемістіть повзунок, щоб відображати ціни на всіх сторінках сайту з урахуванням податку.');
define('TOOLTIP_CALCULATE_TAX', 'При включенні буде вважатися встановлений податок на товар при оформленні замовлення.');
define('TOOLTIP_EXTRA_PRICE', 'За бажанням можна встановити націнку, яка буде відображатися для незареєстрованих користувачів сайту.');
define('TOOLTIP_PRICES_COUNT', 'Вкажіть можливе кількість цін, які будуть встановлюватись на товари (н-р, кілька цін для різних груп клієнтів)');
define('TOOLTIP_SHOW_PRICE_TO_NOT_AUTHORIZED_CUSTOMER', 'Відображення цін на товари для незареєстрованих користувачів');
define('TOOLTIP_LOGO', 'Виберіть логотип (зображення), який буде відображатися на головній сторінці');
define('TOOLTIP_WATERMARK', 'Виберіть зображення, яке буде накладено на фото товарів, захист від копіювання.');
define('TOOLTIP_FAVICON', 'Виберіть зображення, яке буде відображатися значком веб-сайту');
define('TOOLTIP_AUTO_STOCK', 'При формуванні замовлення автоматично перевіряється кількість товару на складі і доступність його до замовлення.');
define('TOOLTIP_DISABLED_BUY_BUTTON_FOR_ZERO_STOCK', 'На сторінці товару, якого немає на складі, буде відображатися кнопка \"купити\".');
define('TOOLTIP_STOCK_AUTO_INCREMENT', 'При оформленні замовлення автоматично вираховується кількість купленого товару з залишку на складі.');
define('TOOLTIP_ALLOW_ZERO_STOCK_ORDER', 'Дозволити оформлення замовлення на товар, якого немає на складі.');
define('TOOLTIP_MARK_ZERO_STOCK_PRODUCT', 'Якщо доданого в кошик товару немає в потрібній кількості на складі, товар буде відзначатися вказаним значенням.');
define('TOOLTIP_ZERO_STOCK_NOTIFICATION', 'При досягненні даного кол-ва на пошту приходить сповіщення, що товар закінчується.');
define('TOOLTIP_SMS_TEXT', 'Вкажіть текст, який буде приходити клієнту.');
define('TOOLTIP_SMS_LOGIN', 'Надає sms-провайдер.');
define('TOOLTIP_SMS_PASSWORD', 'Надає sms-провайдер.');
define('TOOLTIP_SMS_CODE_1', 'Номер телефону або алфавітно-цифровий відправник.');
define('TOOLTIP_SMS_CODE_2', 'Надає sms-провайдер.');
define('TOOLTIP_TAX_ADD', 'Для додавання нового типу податку натисніть \"+\" і заповніть необхідні поля.');
define('TOOLTIP_TAX_RATE_ADD', 'Для додавання% ставки, яка буде додаватися до вартості товару натисніть \"+\" і заповніть необхідні поля.');
define('TOOLTIP_TAX_ZONE_ADD', 'Для додавання зони (країни) на яку буде поширюватися податок натисніть \"+\" і заповніть необхідні поля.');
define('TOOLTIP_BACKUP_CREATE', 'Створити резервну копію поточної версії бази сайту.');
define('TOOLTIP_BACKUP_LOAD', 'Відновлення бази з обраного файлу.');
define('TOOLTIP_EMAILING', 'Відправка e-mail одному покупцеві, всім клієнтам або всім передплатникам новин.');
define('TOOLTIP_MASS_EMAILING', 'Відправка листів для окремого покупця або для обраної групи покупців.');
define('TOOLTIP_CLEAR_CACHE', 'Очищення завантажених зображень з кеша.');
define('TOOLTIP_STATS_SALES', 'Відображення статистики продажів.');
define('TOOLTIP_STATS_SALES_PRODUCTS_BY_TIME_PERIOD', 'Звіт з продажу по замовленим товарам за обраний період часу.');
define('TOOLTIP_STATS_SALES_CATEGORIES_BY_TIME_PERIOD', 'Звіт з продажу за категоріями товарів за обраний період часу.');
define('TOOLTIP_STATS_VIEWED_PRODUCTS', 'Статистика переглядаються товарів.');
define('TOOLTIP_STATS_ZERO_QUANTITY_PRODUCTS', 'Товар який відсутній на складі.');
define('TOOLTIP_STATS_CLIENTS_ORDERS', 'Звіт по закупкам клієнтів за обраний період часу.');
define('TOOLTIP_ADMINISTRATORS', 'Список адміністраторів сайту.');
define('TOOLTIP_ADMINISTRATORS_GROUPS', 'Поділ адміністраторів по групах.');
define('TOOLTIP_ADMINISTRATORS_ACCESS_RIGHTS', 'Права доступу до інформації на сайті в залежності від групи адміністраторів.');
define('TOOLTIP_TEXT_COPIED', 'Текст скопійовано');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY', 'купити');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON', 'увімкнути');
define('TOOLTIP_TEXT_TAB_LANGUAGES', 'Мовний функціонал');
define('TOOLTIP_TEXT_TAB_AUTO_TRANSLATE', 'Автоматичний масовий переклад контенту');
define('TOOLTIP_TEXT_TAB_EDIT_TRANSLATE', 'Редагувати переклади');
define('HIGHSLIDE_CLOSE', 'Закрити');
define('COMMENT_BY_ADMIN', 'Коментар адміністратора');
define('TEXT_MENU_WHO_IS_ONLINE', 'Хто в мережі');
define('INFO_ICON_NEED_MINIFY', 'Будь-які зміни в цьому модулі змінять статус стилів на Стиснути зараз');
define('INFO_ICON_ENABLE_SMTP', 'При включенні модуля - перевірте налаштування SMTP');
define('SMTP_CONF_TITLE', 'SMTP Налаштування');
define('INFO_ICON_NEED_GENERATE_CRITICAL', 'Зміни в цьому параметрі потребують перегенерації Critical CSS');
define('YANDEX_MARKET_MODULE_ENABLED_TITLE', 'XML (YML) експорт товарів "Яндекс.Маркет"');
define('AUTO_TRANSLATE_MODULE_ENABLED_TITLE', 'Автоматичний переклад');
define('TEXT_INFO_BUY_MODULE', 'Модуль «%s» вимкнений, щоб увімкнути його, використовуйте сторінку <a href="%s"><span style="color:blue;" >Модулів</span></a>');
define('TEXT_INFO_DISABLE_MODULE', 'Модуль «%s» відсутній, щоб додати його, використовуйте <a href="%s"><span style="color:blue;" >Магазин модулів SoloMono</span></a>');
define("TEXT_POPULAR_SEARCH_QUERIES", "Популярні пошукові запити");
define('STATS_KEYWORDS_POPULAR_ENABLED_TITLE','Сторінки пошуку');
define("LIST_MODAL_ON","Модалка товару");
define("SHOW_BASKET_ON_ADD_TO_CART_TITLE","Показувати корзину при додаванні товару");
define("TEXT_QUICK_ORDER", "Швидке замовлення");
define("TEXT_VIEWED","Переглянуто");
define('API_ENABLED_TITLE', 'Solomono API');
define('TEXT_MENU_API', 'API');
define('EMAIL_CONTENT_MODULE_ENABLED_TITLE', 'Шаблони листів');
define('ENTRY_CREDIT_CARD_CC_TYPE', 'Тип карти');
define('ENTRY_CREDIT_CARD_CC_OWNER', 'Власник карти');
define('ENTRY_CREDIT_CARD_CC_NUMBER', 'Номер карти');
define('ENTRY_CREDIT_CARD_CC_EXPIRES', 'Термін дії до');
define('TEXT_SEARCH_PAGES','Сторінки пошуку');
define('SMTP_MODULE_ENABLED_TITLE','SMTP');

define('LEFT_MENU_SECTION_TITLE_SHOP','Магазин');
define('LEFT_MENU_SECTION_TITLE_INFO','Інфо');
define('LEFT_MENU_SECTION_TITLE_CONTROL','Управління');
define('INTEGRATION_FACEBOOK_CONF_TITLE','Інтеграція Facebook');
define('INTEGRATION_GOOGLE_CONF_TITLE','Інтеграція GOOGLE');
define('SEO_SETTINGS_CONF_TITLE','Інтеграція GOOGLE');
define('TEXT_CLOSE_BUTTON', 'Закрити');
define('FACEBOOK_GOALS_ADD_PAYMENT_INFO_TITLE','Ціль \'AddPaymentInfo\' - заповнення платіжної інформації');
define('FACEBOOK_GOALS_ADD_TO_WISHLIST_TITLE','Ціль \'AddToWishlist\' - додавання до списку бажань');
define('FACEBOOK_GOALS_CONTACT_US_REQUEST_TITLE','Ціль \'Lead\' - запит на сторінці зв’язку з нами');
define('FACEBOOK_GOALS_VIEW_CONTENT_TITLE','Ціль \'ViewContent\' - перегляд сторінку товару');
define('FACEBOOK_GOALS_SUCCESS_PAGE_TITLE','Ціль \'Purchase\' - сторінка успішного оформлення замовлення');
define('FACEBOOK_GOALS_CHECKOUT_PROCESS_TITLE','Ціль \'InitiateCheckout\' - сторінка оформлення замовлення');
define('FACEBOOK_GOALS_SEARCH_RESULTS_TITLE','Ціль \'Search\' - сторінка результатів пошуку');
define('FACEBOOK_GOALS_COMPLETE_REGISTRATION_TITLE','Ціль \'CompleteRegistration\' - зареєстрацувався новий клієнт');
define('FACEBOOK_GOALS_ADD_TO_CART_TITLE','Ціль \'AddToCart\' - додавання в кошик');
define('FACEBOOK_GOALS_PAGE_VIEW_TITLE','Ціль \'PageView\' - перегляд любої сторінки');
define('FACEBOOK_GOALS_CLICK_FAST_BUY_TITLE','Ціль \'FastBuy\' - коли клієнт натискає кнопку \'Швидке замовлення\' на сторінці товару');
define('FACEBOOK_GOALS_CLICK_ON_CHAT_TITLE','Ціль \'ClickChat\' - коли клієнт натискає кнопку чату');
define('FACEBOOK_GOALS_CALLBACK_TITLE','Ціль \'Callback\' - коли клієнт натискає кнопку \'Зворотний дзвінок\' у заголовку сайту');
define('FACEBOOK_GOALS_FILTER_TITLE','Ціль \'filter\' - коли клієнт використовує фільтр для пошуку товарів');
define('FACEBOOK_GOALS_SUBSCRIBE_TITLE','Ціль \'Subscribe\' - коли клієнт підписався');
define('FACEBOOK_GOALS_LOGIN_TITLE','Ціль \'login\' - коли клієнт залогінився');
define('FACEBOOK_GOALS_ADD_REVIEW_TITLE','Ціль \'add_review\' - клієнт додав відгук');
define('FACEBOOK_GOALS_PHONE_CALL_TITLE','Ціль \'PhoneCall\' - коли клієнт натискає номер телефону в заголовку сайту');
define('FACEBOOK_GOALS_CLICK_ON_BUG_REPORT_TITLE','Ціль \'BugReport\' - коли клієнт натискає на \'Надіслати повідомлення про помилку\' у нижньому колонтитулі сайту');

define('NWPOSHTA_DELIVERY_TITLE', 'Адреса доставки нової пошти');

define('HEADER_BUY_TEMPLATE_LINK','Перейти на платний пакет');
define('HEADER_MARKETPLACE_LINK','Маркетплейс модулів');
define('TEXT_CATEGORIES', 'Категорії');
define('HEADING_TITLE_GOTO', 'Перейти до:');
define('ERROR_DOMAIN_IN_USE','Помилка! Цей домен вже використовується');
define('ERROR_ANAME_MISMATCH', 'Помилка! A-name не спiвпадає з 167.172.41.152. Спробуйте пiзнiше');
define('SUCCESS_DOMAIN_CHANGE', 'Успiх! Домен змiнено');
define('ERROR_ADD_DOMAIN_FIRST','Спершу підключіть персональний домен!');
define('ERROR_BASH_EXECUTION','Помилка виконання скрипта, зверніться до менеджера');
define('ERROR_SIMLINK_CREATE', 'Симлінк не створений');
define('ERROR_FOLDER_RENAME', 'Папка не скопіювалася');
define('PRODUCTS_LIMIT_REACHED_FREE', 'Перевищений ліміт товарів! Через %s днів ваш сайт буде автоматично вимкнений. <a href="%s">Оформіть платну оренду</a> або видаліть непотрібні товари');
define('PRODUCTS_LIMIT_REACHED_JUNIOR', 'Перевищений ліміт товарів! Через %s днів ваш сайт буде автоматично переведений на пакет seo.');
define('PRODUCTS_LIMIT_REACHED_SEO', 'Перевищений ліміт товарів! Через %s днів ваш сайт буде автоматично переведений на пакет pro');
define('PRODUCTS_LIMIT_REACHED_HEADING', 'Перевищений ліміт товарів!');