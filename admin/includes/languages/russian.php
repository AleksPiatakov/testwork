<?php
/*
  $Id: russian.php,v 1.3 2003/09/28 23:37:26 anotherlango Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
// Google SiteMaps
define('BOX_TOOLS_COMMENT8R', 'Комментарии');
define('BOX_GOOGLE_SITEMAP', 'Google SiteMaps');
define('BOX_CLEAR_IMAGE_CACHE', 'Очистить кэш изображений');
define('TBL_LINK_TITLE', 'Ajax категории');
define('TBL_HEADING_TITLE_BACK_TO_PARENT', 'Назад');
define('TBL_HEADING_TITLE_SEARCH', 'Поиск');
define('TBL_HEADING_CATEGORIES_PRODUCTS', 'Категории/Товары');
define('TBL_HEADING_MODEL', 'Код');
define('TBL_HEADING_QUANTITY', 'Кол-во');
define('TBL_HEADING_PRICE', 'Цена');
define('TBL_HEADING_TITLE_BACK_TO_DEFAULT_ADMIN', 'Back To Default Administration');
define('TBL_HEADING_PRODUCTS_COUNT', ' товаров');
define('TBL_HEADING_SUBCATEGORIES_COUNT', ' подкатегорий');
define('TBL_HEADING_SUBCATEGORIE_COUNT', ' подкатегория');
define('TEXT_PRODILE_INFO_CHANGE_PASSWORD', 'Сменить свой пароль ');
define('GOOGLE_FEED_MODULE_ENABLED_TITLE', 'Google Feed');
define('BOX_CATALOG_SEO_FILTER', "SEO filter");
define('BOX_CATALOG_SEO_TEMPALTES', "SEO Шаблоны");
define('TEXT_MENU_REVIEWS', 'Отзывы');
define('BOX_CATALOG_INSATGRAM', "Instagram");
define('SQL_MODE_RECOMMENDATION_TEXT', "Для дальнейшей корректной работы нужно обратиться к администрации хостинга для обнуления переменной sql_mode в Mysql");
define('ROBOTS_TXT_RECOMMENDATION_TEXT', 'Robots.txt не включён на вашем сайте, для успешного продвижения рекоммендуем Вам включить его на <a target="_blank" href="/'.$admin.'/configuration.php?gID=1">странице</a>');
define('CRITICAL_CSS_TXT_RECOMMENDATION_TEXT', '<span class="critical-text">Необходимо создать критический CSS</span> <span class="critical-process">Обработка ...Пожалуйста, подождите</span><a class="start-generate-critical" href="javascript:void(0);">Старт</a>');
define('ALERT_ERRORS_BLOCK_TITLE', 'Оповещения');
define('DOMEN_IN_ROBOTS_TXT_RECOMMENDATION_TEXT', '<span class="robots-txt-text">в Robots.txt не совпадает деректива Host c именем вашего сайта, для успешного продвижения рекомендуем Вам его</span> <span class="generate-robots-txt-process">Обработка ...подождите, пожалуйста</span><a class="start-generate-robots-txt" href="javascript:void(0);"> перегенерировать</a>');

//Admin begin
// header text in includes/header.php
define('HEADER_TITLE_LOGOFF', 'Выход');
define('HEADER_TITLE_HELLO', 'Привет');
define('HEADER_FRONT_LINK_TEXT', 'На сайт');
define('HEADER_ADMIN_TEXT', 'Админпанель');
define('HEADER_ORDERS_TODAY', 'Заказов сегодня: ');
define('HEADER_GO_TO_SITE', 'Перейти на сайт');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Админы');
define('BOX_ADMINISTRATOR_MEMBERS', 'Группы пользователей');
define('BOX_ADMINISTRATOR_MEMBER', 'Пользователи');
define('BOX_ADMINISTRATOR_BOXES', 'Права доступа');
define('BOX_ADMINISTRATOR_ACCOUNT_UPDATE', 'Обновить информацию о себе');

// limex: mod query performance START
define('TEXT_DISPLAY_NUMBER_OF_QUERIES', 'Выводится <b>%d</b> - <b>%d</b> (из <b>%d</b> запросов)');
define('BOX_TOOLS_MYSQL_PERFORMANCE', 'Медленные запросы');
define('TEXT_DELETE', 'Удалить все записи?');
define('IMAGE_BUTTON_DELETE', 'Удалить все записи');
define('IMAGE_BUTTON_CANCEL', 'Не удалять записи');
// limex: mod query performance END


//mod for ez price updater
define('BOX_CATALOG_PRICE_QUICK_UPDATES', 'БЫстрое изменение цены');
define('BOX_CATALOG_PRICE_UPDATE_VISIBLE', 'Видимое изменение цены');
define('BOX_CATALOG_PRICE_UPDATE__ALL', 'изменить все цены');
define('BOX_CATALOG_PRICE_CANGE', 'Изменить цену');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI', 'Управление товарами');
define('BOX_CATALOG_STATS_SEARCH_KEYWORDS', "Планировщик ключей");

define('TEXT_INDEX_LANGUAGE', 'Язык: ');
define('TEXT_SUMMARY_CUSTOMERS', 'Покупатели');
define('TEXT_SUMMARY_ORDERS', 'Заказы');
define('TEXT_SUMMARY_PRODUCTS', 'Товары');
define('TEXT_SUMMARY_HELP', 'Помощь');
define('TEXT_SUMMARY_STAT', 'Статистика');
define('TABLE_HEADING_CUSTOMERS', 'Покупатель');

define('TEXT_GO_TO_CAT', 'Перейти в');
define('TEXT_GO_TO_SEARCH', 'Поиск');
define('TEXT_GO_TO_SEARCH2', 'по коду<br>товара');

// images
define('IMAGE_FILE_PERMISSION', 'Права доступа');
define('IMAGE_GROUPS', 'Список групп');
define('IMAGE_INSERT_FILE', 'Добавить файл');
define('IMAGE_MEMBERS', 'Список пользователей');
define('IMAGE_NEW_GROUP', 'Добавить группы');
define('IMAGE_NEW_MEMBER', 'Добавить пользователя');
define('IMAGE_NEXT', 'Далее');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> файлов)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> пользователей)');
//Admin end

define('TEXT_DAY_1','Понедельник');
define('TEXT_DAY_2','Вторник');
define('TEXT_DAY_3','Среда');
define('TEXT_DAY_4','Четверг');
define('TEXT_DAY_5','Пятница');
define('TEXT_DAY_6','Суббота');
define('TEXT_DAY_7','Воскресенье');
define('TEXT_DAY_SHORT_1','Пн');
define('TEXT_DAY_SHORT_2','Вт');
define('TEXT_DAY_SHORT_3','Ср');
define('TEXT_DAY_SHORT_4','Чт');
define('TEXT_DAY_SHORT_5','Пт');
define('TEXT_DAY_SHORT_6','Сб');
define('TEXT_DAY_SHORT_7','ВС');
define('TEXT_MONTH_BASE_1','Январь');
define('TEXT_MONTH_BASE_2','Февраль');
define('TEXT_MONTH_BASE_3','Март');
define('TEXT_MONTH_BASE_4','Апрель');
define('TEXT_MONTH_BASE_5','Май');
define('TEXT_MONTH_BASE_6','Июнь');
define('TEXT_MONTH_BASE_7','Июль');
define('TEXT_MONTH_BASE_8','Август');
define('TEXT_MONTH_BASE_9','Сентябрь');
define('TEXT_MONTH_BASE_10','Октябрь');
define('TEXT_MONTH_BASE_11','Ноябрь');
define('TEXT_MONTH_BASE_12','Декабрь');
define('TEXT_MONTH_1','Января');
define('TEXT_MONTH_2','Февраля');
define('TEXT_MONTH_3','Марта');
define('TEXT_MONTH_4','Апреля');
define('TEXT_MONTH_5','Мая');
define('TEXT_MONTH_6','Июня');
define('TEXT_MONTH_7','Июля');
define('TEXT_MONTH_8','Августа');
define('TEXT_MONTH_9','Сентября');
define('TEXT_MONTH_10','Октября');
define('TEXT_MONTH_11','Ноября');
define('TEXT_MONTH_12','Декабря');
// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'en_US.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
//define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', '%d %B %Y г.'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_FORMAT_SPIFFYCAL', 'dd/MM/yyyy');  //Use only 'dd', 'MM' and 'yyyy' here in any order


// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="ru"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// page title
define('TITLE', 'Администрирование');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Администрирование');
define('HEADER_TITLE_SUPPORT_SITE', 'Сайт поддержки');
define('HEADER_TITLE_ONLINE_CATALOG', 'Каталог');
define('HEADER_TITLE_ADMINISTRATION', 'Администрирование');
define('HEADER_TITLE_CHAINREACTION', 'osCommerce');
define('HEADER_TITLE_PHESIS', 'Loaded6');
// MaxiDVD Added Line For WYSIWYG HTML Area: BOF
define('BOX_CATALOG_DEFINE_MAINPAGE', 'Изменить главную страницу');
// MaxiDVD Added Line For WYSIWYG HTML Area: EOF

define('CUSTOM_PANEL_DATE1', 'день');
define('CUSTOM_PANEL_DATE2', 'дня');
define('CUSTOM_PANEL_DATE3', 'дней');


// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Настройки');
define('BOX_CONFIGURATION_MYSTORE', 'Магазин');
define('BOX_CONFIGURATION_LOGGING', 'Логи');
define('BOX_CONFIGURATION_CACHE', 'Кэш');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Модули');
define('BOX_MODULES_PAYMENT', 'Оплата');
define('BOX_MODULES_SHIPPING', 'Доставка');
define('BOX_MODULES_SHIP2PAY', 'Доставка-Оплата (Ship 2 Pay)');
define('BOX_MODULES_ORDER_TOTAL', 'Заказ итого');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Каталог');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Категории/Товары');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Атрибуты');
define('BOX_CATALOG_PRODUCTS_PROPERTIES', 'Тех. Параметры');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES_NEW', 'Атрибуты - Установка');
define('BOX_CATALOG_MANUFACTURERS', 'Производители');
define('BOX_CATALOG_SPECIALS', 'Скидки');
define('BOX_CATALOG_EASYPOPULATE', 'Excel импорт/экспорт');

define('BOX_CATALOG_SALEMAKER', 'Массовые скидки');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Клиенты');
define('BOX_CUSTOMERS_CUSTOMERS', 'Клиенты');
define('BOX_CUSTOMERS_ORDERS', 'Заказы');
define('BOX_CUSTOMERS_EDIT_ORDERS', 'Редактировать заказы');
define('BOX_CUSTOMERS_ENTRY', 'Количество посещений');


// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Места / Налоги');
define('BOX_TAXES_COUNTRIES', 'Страны');
define('BOX_TAXES_ZONES', 'Регионы');
define('BOX_TAXES_GEO_ZONES', 'Налоговые зоны');
define('BOX_TAXES_TAX_CLASSES', 'Типы налогов');
define('BOX_TAXES_TAX_RATES', 'Ставки налогов');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Отчёты');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Просмотренные товары');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Заказанные товары');
define('BOX_REPORTS_PRODUCTS_PURCHASED_BY_CATEGORY', 'Заказанные товары по категориям');
define('BOX_REPORTS_ORDERS_TOTAL', 'Лучшие клиенты');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Инструменты');
define('BOX_TOOLS_BACKUP', 'Резервное копирование БД');
define('BOX_TOOLS_CACHE', 'Контроль кэша');
define('BOX_TOOLS_MAIL', 'Отправить Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Менеджер почтовых рассылок');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Локализация');
define('BOX_LOCALIZATION_CURRENCIES', 'Валюты');
define('BOX_LOCALIZATION_LANGUAGES', 'Языки');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Статусы заказов');

// infobox box text in includes/boxes/info_boxes.php
define('BOX_HEADING_BOXES', 'Управление боксами');
define('BOX_HEADING_TEMPLATE_CONFIGURATION', 'Настройка шаблонов');
define('BOX_HEADING_DESIGN_CONTROLS', 'Дизайн');

// javascript messages
define('JS_ERROR', 'При заполнении формы Вы допустили ошибки!\nСделайте, пожалуйста, следующие исправления:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Новый атрибут товара дожен иметь цену\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Новый атрибут товара дожен иметь ценовой префикс\n');

define('JS_PRODUCTS_NAME', '* Для нового товара должно быть указано наименование\n');
define('JS_PRODUCTS_DESCRIPTION', '* Для нового товара должно быть указано описание\n');
define('JS_PRODUCTS_PRICE', '* Для нового товара должна быть указана цена\n');
define('JS_PRODUCTS_WEIGHT', '* Для нового товара должен быть указан вес\n');
define('JS_PRODUCTS_QUANTITY', '* Для нового товара должно быть указано количество\n');
define('JS_PRODUCTS_MODEL', '* Для нового товара должен быть указан код товара\n');
define('JS_PRODUCTS_IMAGE', '* Для нового товара должна быть картинка\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Для этого товара должна быть установлена новая цена\n');

define('JS_FIRST_NAME', '* Поле \'Имя\' должно содержать не менее ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' символов.\n');
define('JS_LAST_NAME', '* Поле \'Фамилия\' должно содержать не менее ' . ENTRY_LAST_NAME_MIN_LENGTH . ' символов.\n');
define('JS_DOB', '* Поле \'День рождения\' должно иметь формат: xx/xx/xxxx (день/месяц/год).\n');
define('JS_EMAIL_ADDRESS', '* Поле \'E-Mail адрес\' должно содержать не менее ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' символов.\n');
define('JS_ADDRESS', '* Поле \'Адрес\' должно содержать не менее ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' символов.\n');
define('JS_POST_CODE', '* Поле \'Индекс\' должно содержать не менее ' . ENTRY_POSTCODE_MIN_LENGTH . ' символов.\n');
define('JS_CITY', '* Поле \'Город\' должно содержать не менее ' . ENTRY_CITY_MIN_LENGTH . ' символов.\n');
define('JS_STATE', '* Поле \'Регион\' должно быть выбрано.\n');
define('JS_STATE_SELECT', '-- Выберите выше --');
define('JS_ZONE', '* Поле \'Регион\' должно соответствовать выбраной стране.');
define('JS_COUNTRY', '* Поле \'Страна\' дожно быть заполнено.\n');
define('JS_TELEPHONE', '* Поле \'Телефон\' должно содержать не менее ' . ENTRY_TELEPHONE_MIN_LENGTH . ' символов.\n');
define('JS_PASSWORD', '* Поля \'Пароль\' и \'Подтверждение\' должны совпадать и содержать не менее ' . ENTRY_PASSWORD_MIN_LENGTH . ' символов.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Заказ номер %s не найден!');

define('CATEGORY_PERSONAL', 'Персональный');
define('CATEGORY_ADDRESS', 'Адрес');
define('CATEGORY_CONTACT', 'Для контакта');
define('CATEGORY_COMPANY', 'Компания');
define('CATEGORY_OPTIONS', 'Рассылка');
define('DISCOUNT_OPTIONS', 'Скидки');

define('ENTRY_FIRST_NAME', 'Имя:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">минимум ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' символов</span>');
define('ENTRY_LAST_NAME', 'Фамилия:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">минимум ' . ENTRY_LAST_NAME_MIN_LENGTH . ' символов</span>');
define('ENTRY_DATE_OF_BIRTH', 'Дата рождения:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(пример 21/05/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Адрес:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">минимум ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' символов</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Вы ввели неверный email адрес!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Данный email адрес уже зарегистрирован!</span>');
define('ENTRY_COMPANY', 'Название компании:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Адрес:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">минимум ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' символов</span>');
define('ENTRY_SUBURB', 'Район:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Индекс:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">минимум ' . ENTRY_POSTCODE_MIN_LENGTH . ' символов</span>');
define('ENTRY_CITY', 'Город:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">минимум ' . ENTRY_CITY_MIN_LENGTH . ' символов</span>');
define('ENTRY_STATE', 'Регион:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">обязательно</span>');
define('ENTRY_COUNTRY', 'Страна:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Телефон:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">минимум ' . ENTRY_TELEPHONE_MIN_LENGTH . ' символов</span>');
define('ENTRY_FAX_NUMBER', 'Факс:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Получать рассылку');
define('ENTRY_NEWSLETTER_YES', 'Подписан');
define('ENTRY_NEWSLETTER_NO', 'Не подписан');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Отправить E-Mail');
define('IMAGE_BACK', 'Назад');
define('IMAGE_BACKUP', 'Рез. копия');
define('IMAGE_CANCEL', 'Отменить');
define('IMAGE_CONFIRM', 'Подтвердить');
define('IMAGE_COPY', 'Копировать');
define('IMAGE_COPY_TO', 'Копировать в');
define('IMAGE_DETAILS', 'Настроить');
define('IMAGE_DELETE', 'Удалить');
define('IMAGE_LANG_DIR', 'Перейти в директорию переводов');
define('IMAGE_EDIT', 'Редактировать');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'Менеджер файлов');
define('IMAGE_ICON_STATUS_GREEN', 'Активный');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Активизировать');
define('IMAGE_ICON_STATUS_RED', 'Неактивный');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Сделать неактивным');
define('IMAGE_ICON_INFO', 'Информационные страницы');
define('IMAGE_INSERT', 'Добавить');
define('IMAGE_LOCK', 'Замок');
define('IMAGE_MODULE_INSTALL', 'Установить модуль');
define('IMAGE_MODULE_REMOVE', 'Удалить модуль');
define('IMAGE_MOVE', 'Переместить');
define('IMAGE_NEW_BANNER', 'Новый баннер');
define('IMAGE_NEW_CATEGORY', 'Новая категория');
define('IMAGE_NEW_COUNTRY', 'Новая страна');
define('IMAGE_NEW_CURRENCY', 'Новая валюта');
define('IMAGE_NEW_FILE', 'Новый файл');
define('IMAGE_NEW_FOLDER', 'Новая папка');
define('IMAGE_NEW_LANGUAGE', 'Новый язык');
define('IMAGE_NEW_NEWSLETTER', 'Новое письмо новостей');
define('IMAGE_NEW_PRODUCT', 'Новый товар');
define('IMAGE_NEW_SALE', 'Новая распродажа');
define('IMAGE_NEW_TAX_CLASS', 'Новый налог');
define('IMAGE_NEW_TAX_RATE', 'Новая ставка налога');
define('IMAGE_NEW_TAX_ZONE', 'Новая налоговая зона');
define('IMAGE_NEW_ZONE', 'Новая зона');
define('IMAGE_ORDERS', 'Заказы');
define('IMAGE_ORDERS_INVOICE', 'Счёт-фактура');
define('IMAGE_ORDERS_PACKINGSLIP', 'Накладная');
define('IMAGE_PREVIEW', 'Предпросмотр');
define('IMAGE_RESTORE', 'Восстановить');
define('IMAGE_RESET', 'Сброс');
define('IMAGE_SAVE', 'Сохранить');
define('IMAGE_SEARCH', 'Искать');
define('IMAGE_SELECT', 'Выбрать');
define('IMAGE_SEND', 'Отправить');
define('IMAGE_SEND_EMAIL', 'Отправить Email');
define('IMAGE_UNLOCK', 'Разблокировать');
define('IMAGE_UPDATE', 'Обновить');
define('IMAGE_UPDATE_CURRENCIES', 'Скорректировать курсы валют');
define('IMAGE_UPDATE_CURRENCIES_SHORT', 'Обновить валюты');
define('IMAGE_UPLOAD', 'Загрузить');
define('TEXT_IMAGE_NONEXISTENT', 'Нет картинки');

define('IMAGE_BUTTON_BUY_TEMPLATE','Перейти на платный пакет');
define('IMAGE_BUTTON_BUY_TEMPLATE_MOB', 'Купить');
define('TIME_LEFT', 'Осталось : ');

define('ICON_CROSS', 'Недействительно');
define('ICON_CURRENT_FOLDER', 'Текущая директория');
define('ICON_DELETE', 'Удалить');
define('ICON_ERROR', 'Ошибка:');
define('ICON_FILE', 'Файл');
define('ICON_FILE_DOWNLOAD', 'Загрузка');
define('ICON_FOLDER', 'Папка');
define('ICON_LOCKED', 'Заблокировать');
define('ICON_PREVIOUS_LEVEL', 'Предыдущий уровень');
define('ICON_PREVIEW', 'Редактировать');
define('ICON_STATISTICS', 'Статистика');
define('ICON_SUCCESS', 'Выполнено');
define('ICON_TICK', 'Истина');
define('ICON_UNLOCKED', 'Разблокировать');
define('ICON_WARNING', 'ВНИМАНИЕ');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Страница %s из %d');

define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> баннеров)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> стран)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> клиентов)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> валют)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> языковых модулей)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> производителей)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> рассылок)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> заказов)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> статуса)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> позиций)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> специальных предложений)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> типов налогов)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> налоговых зон)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> ставок налогов)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> зон)');

define('PREVNEXT_BUTTON_PREV', 'Предыдущая');
define('PREVNEXT_BUTTON_NEXT', 'Следующая');

define('TEXT_DEFAULT', 'по умолчанию');
define('TEXT_SET_DEFAULT', 'Установить по умолчанию');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Обязательно</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Ошибка: К настоящему времени ни одна валюта не была установлена по умолчанию. Пожалуйста, установите одну из них в: Локализация -> Валюта');

define('TEXT_CACHE_CATEGORIES', 'Бокс Категорий');
define('TEXT_CACHE_MANUFACTURERS', 'Бокс Производителей');
define('TEXT_CACHE_ALSO_PURCHASED', 'Также Модули Покупок');

define('TEXT_NONE', '--нет--');
define('TEXT_TOP', 'Начало');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Ошибка: Каталог не существует.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Ошибка: Каталог защищён от записи, установите необходимые права доступа.');
define('ERROR_FILE_NOT_SAVED', 'Ошибка: Файл не был загружен.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Ошибка: Нельзя закачивать файлы данного типа.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Выполнено: Файл успешно загружен.');
define('WARNING_NO_FILE_UPLOADED', 'Предупреждение: Ни одного файла не загружено.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Предупреждение: Опция загрузки файлов отключена в конфигурационном файле php.ini.');

define('BOX_CATALOG_XSELL_PRODUCTS', 'Сопутствующие товары');


// X-Sell
REQUIRE(DIR_WS_LANGUAGES . 'add_ccgvdc_russian.php');

// BOF: Lango Added for print order MOD
define('IMAGE_BUTTON_PRINT', 'Печатать');
// EOF: Lango Added for print order MOD

// BOF: Lango Added for Featured product MOD
define('BOX_CATALOG_FEATURED', 'Рекомендуемые товары');
// EOF: Lango Added for Featured product MOD

// BOF: Lango Added for Sales Stats MOD
define('BOX_REPORTS_MONTHLY_SALES', 'Статистика продаж');
// EOF: Lango Added for Sales Stats MOD


//BEGIN Dynamic information pages unlimited
define('BOX_HEADING_INFORMATION', 'Контент');
define('BOX_HEADING_SEO', 'SEO');
define('BOX_INFORMATION', 'Инфо-страницы');
//END Dynamic information pages unlimited

define('BOX_TOOLS_KEYWORDS', 'Поисковые запросы');

// RJW Begin Meta Tags Code
define('TEXT_META_TITLE', 'Meta Title');
define('TEXT_META_DESCRIPTION', 'Meta Description');
define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

// Article Manager
define('BOX_HEADING_ARTICLES', 'Статьи');
define('BOX_TOPICS_ARTICLES', 'Статьи');
define('BOX_ARTICLES_CONFIG', 'Настройка');
define('BOX_ARTICLES_XSELL', 'Товары-Статьи');
define('IMAGE_NEW_TOPIC', 'Новый раздел');
define('IMAGE_NEW_ARTICLE', 'Новая статья');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Показано <b>%d</b> - <b>%d</b> (всего <b>%d</b> авторов)');

//TotalB2B start
define('BOX_CUSTOMERS_GROUPS', 'Группы');
define('BOX_MANUDISCOUNT', 'Скидки производителя');
//TotalB2B end

// add for Group minimum price to order start		
define('GROUP_MIN_PRICE', 'Минимальная стоимость заказа группы');
// add for Group minimum price to order end

// add for color groups start
define('GROUP_COLOR_BAR', 'Цвет группы');
// add for color groups end
//TotalB2B end
define('BOX_CATALOG_QUICK_UPDATES', 'Обновление Прайса');

define('IMAGE_PROPERTIES_POPUP_ADD_CHANGE_DELETE', 'Изменить/удалить тех. параметры');
define('IMAGE_PROPERTIES_POPUP_ADD', 'Добавить тех. параметры');
define('IMAGE_PROPERTIES', 'Тех. параметры');

// polls box text in includes/boxes/polls.php

define('BOX_HEADING_POLLS', 'Опросы');
define('BOX_POLLS_POLLS', 'Опросы');
define('BOX_POLLS_CONFIG', 'Настройки Опросов');
define('BOX_CURRENCIES_CONFIG', 'Валюты');
define('BOX_COUPONS', 'Промо-коды');

define('BOX_INDEX_GIFTVOUCHERS', 'Сертификаты / Промо-коды');

define('BOX_REPORTS_SALES_REPORT2', 'Статистика продаж 2');
define('BOX_REPORTS_SALES_REPORT', 'Статистика продаж 3');
define('BOX_REPORTS_CUSTOMERS_ORDERS', 'Статистика клиентов');

define('TEXT_NEW_ATTRIBUTE_EDIT', 'Редактировать атрибуты товара');

define('ONE_PAGE_CHECKOUT_TITLE', 'Оформление заказа');
define('BROWSE_BY_CATEGORIES_TITLE', 'Вывод категорий');
define('SEO_TITLE', 'SEO URLs');
define('SEO_ENABLED_DESC', 'Модуль SEO URLs - предназначен для преобразования обычных ссылок в ЧПУ-ссылки');

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

define('SMS_ENABLE_TITLE', 'Включить sms-сервис');
define('SMS_GATENAME_TITLE', 'SMS шлюз');
define('SMS_CUSTOMER_ENABLE_TITLE', 'Отправлять sms клиенту при покупке?');
define('TELEGRAM_TOKEN_TITLE','Telegram Token');
define('TELEGRAM_NOTIFICATIONS_ENABLED_TITLE','Включить Telegram уведомления');
define('SMS_CHANGE_STATUS_TITLE', 'Отправлять sms клиенту при смене статуса?');
define('SMS_OWNER_ENABLE_TITLE', 'Отправлять sms админу при покупке?');
define('SMS_OWNER_ENABLE_BUY_ONE_CLICK_TITLE', 'Отправлять sms админу при покупке в один клик?');
define('SMS_OWNER_TEL_TITLE', 'Номер телефона админа');
define('SMS_TEXT_TITLE', 'Текст sms');
define('SMS_LOGIN_TITLE', 'Логин на SMS шлюз (или API ключ, Account SID)');
define('SMS_PASSWORD_TITLE', 'Пароль (или Auth token)');
define('SMS_SIGN_TITLE', 'Отправитель (или Service SID)');
define('SMS_ENC_TITLE', 'код2');


define('ROBOTS_TXT_TITLE', 'robots.txt');

define('SMS_CONF_TITLE', 'sms-сервис');
define('MY_SHOP_CONF_TITLE', 'Мой магазин');
define('MIN_VALUES_CONF_TITLE', 'Минимальные значения');
define('MAX_VALUES_CONF_TITLE', 'Максимальные значения');
define('IMAGES_CONF_TITLE', 'Картинки');
define('CUSTOMER_DETAILS_CONF_TITLE', 'Данные покупателя');
define('MODULES_CONF_TITLE', 'Установленные модули');
define('SHIPPING_CONF_TITLE', 'Доставка/Упаковка');
define('LISTING_CONF_TITLE', 'Вывод товара');
define('STOCK_CONF_TITLE', 'Склад');
define('LOGS_CONF_TITLE', 'Логи');
define('CACHE_CONF_TITLE', 'Кэш');
define('EMAIL_CONF_TITLE', 'Настройка E-Mail');
define('DOWNLOAD_CONF_TITLE', 'Скачивание');
define('GZIP_CONF_TITLE', 'GZip Компрессия');
define('SESSIONS_CONF_TITLE', 'Сессии');
define('HTML_CONF_TITLE', 'HTML редактор');
define('DYMO_CONF_TITLE', 'Модуль Dynamic MoPics');
define('DOWN_CONF_TITLE', 'Тех. обслуживание');
define('GA_CONF_TITLE', 'Быстрое оформление');
define('LINKS_CONF_TITLE', 'Ссылки');
define('QUICK_CONF_TITLE', 'Обновление Прайса');
define('WISHLIST_TITLE', 'Отложенные товары');
define('PAGE_CACHE_TITLE', 'Кэш страниц');
define('GRAPHS_TITLE', 'График');
define('YANDEX_MARKET_CONF_TITLE', 'XML-выгрузка');


define('ATTRIBUTES_COPY_TEXT1', ' Внимание: Нельзя скопировать атрибуты из товара номер ');
define('ATTRIBUTES_COPY_TEXT2', ' в товар номер');
define('ATTRIBUTES_COPY_TEXT3', '. Ничего не скопировано.');
define('ATTRIBUTES_COPY_TEXT4', ' Внимание: Нет атрибутов для копирования из товара номер ');
define('ATTRIBUTES_COPY_TEXT5', ' в товар ');
define('ATTRIBUTES_COPY_TEXT6', '. Ничего не скопировано.');
define('ATTRIBUTES_COPY_TEXT7', ' Внимание: Товар с номером ');
define('ATTRIBUTES_COPY_TEXT8', ' не найден. Либо Вы не указали номер товара, либо указанный товар не существует. Ничего не скопировано.');

//include('includes/languages/english_support.php');

// BOF FlyOpenair: Extra Product Price
define('BOX_EXTRA_PRODUCT_PRICE', 'Наценки');
define('EXTRA_PRODUCT_PRICE_ID_TITLE', 'Система наценок');
define('EXTRA_PRODUCT_PRICE_ID_DESC', 'Включение и выключение модуля системы наценок');
// EOF FlyOpenair: Extra Product Price

define('TEXT_IMAGE_OVERWRITE_WARNING', 'Внимание: Имя файла было изменено, но не перезаписано ');

// 500 Page )
define('SERVICE_MENU', 'TOOLS');
define('SEO_CONFIGURATION','SEO TOOLS');


define('COMMENTS_MODULE_ENABLED_TITLE', 'Отзывы');
define('LANGUAGE_SELECTOR_MODULE_ENABLED_TITLE', 'Мультиязычность');
define('PRODUCT_LABELS_MODULE_ENABLED_TITLE', 'Ярлыки');
define('ATTRIBUTES_PRODUCTS_MODULE_ENABLED_TITLE', 'Фильтры');
define('FACEBOOK_PIXEL_MODULE_ENABLED_TITLE','FaceBook Pixel');
define('DEFAULT_PIXEL_CURRENCY_TITLE','FaceBook Pixel валюта');
define('QUICK_PRODUCTS_UPDATE_ENABLED_TITLE','Обновление Прайса');
define('FACEBOOK_PIXEL_ID_TITLE','FaceBook Pixel ID');
define('AUTH_MODULE_ENABLED_TITLE', 'Авторизации (Google, Facebook)');
define('EXCEL_IMPORT_MODULE_ENABLED_TITLE', 'Импорт/Экспорт CSV');
define('CUPONES_MODULE_ENABLED_TITLE', 'Промо-коды');
define('COMPARE_MODULE_ENABLED_TITLE', 'Сравнение');
define('WISHLIST_MODULE_ENABLED_TITLE', 'Список желаний');
define('GOOGLE_FEED_CHOOSE_ALL_PRODUCTS_TITLE', 'активные товары');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_2_TITLE', 'товары со статусом выгрузки XML');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_3_TITLE', 'товары учитывая наличие на складе');
define('XSELL_PRODUCTS_BUYNOW_ENABLED_TITLE', 'Сопутствующие товары');
define('STATS_PRODUCTS_PURCHASED_BY_CATEGORY_MODULE_ENABLED_TITLE', 'Статистика - Заказанные товары (по категориям)');
define('SALEMAKER_MODULE_ENABLED_TITLE', 'Массовые скидки');
define('SPECIALS_MODULE_ENABLED_TITLE', 'Скидки');
define('STATS_KEYWORDS_ENABLED_TITLE', 'Статистика поисковых запросов');
define('BACKUP_ENABLED_TITLE', 'Резервное копирование базы данных');
define('PRODUCTS_MULTI_ENABLED_TITLE', 'Массовое управление товарами');
define('SEO_TEMPLATES_ENABLED_TITLE', 'SEO шаблоны');
define('SHIP2PAY_ENABLED_TITLE', 'Доставка-Оплата (Ship 2 Pay)');
define('QTY_PRO_ENABLED_TITLE', 'Комбинации атрибутов');
define('MASTER_PASSWORD_MODULE_ENABLED_TITLE', '"Мастер" пароль');
define('YML_MODULE_ENABLED_TITLE', 'Импорт XML (YML)');
define('OSC_IMPORT_MODULE_ENABLED_TITLE', 'Миграция базы данных (osCommerce)');
define('YML_MODULE_ENABLED_TITLE', 'YML импорт');
define('EXPORT_HOTLINE_MODULE_ENABLED_TITLE', 'XML-экспорт товаров "Hotline"');
define('EXPORT_PROMUA_MODULE_ENABLED_TITLE', 'XML-экспорт товаров "Prom"');
define('EXPORT_PRICEUA_MODULE_ENABLED_TITLE', 'XML-экспорт товаров "Price.ua"');
define('EXPORT_ROZETKA_MODULE_ENABLED_TITLE', 'XML-экспорт товаров "Rozetka"');
define('EXPORT_YANDEX_MARKET_MODULE_ENABLED_TITLE', 'Yandex Market экспорт');
define('EXPORT_GOOGLE_SITEMAP_MODULE_ENABLED_TITLE', 'XML Sitemaps (карты сайта)');
define('EXPORT_FACEBOOK_FEED_MODULE_ENABLED_TITLE', 'XML фид для Facebook Product Catalog');
define('EXPORT_PDF_MODULE_ENABLED_TITLE', 'Экспорт товаров в PDF');
define('PROMURLS_MODULE_ENABLED_TITLE', 'Prom.ua ЧПУ ссылки');
define('PROM_EXCEL_MODULE_ENABLED_TITLE', 'Импорт Prom.ua (Excel)');
define('MASTER_PASS_TITLE', '"Мастер" пароль');
define('SMSINFORM_MODULE_ENABLED_TITLE', 'Модуль SMS');
define('CARDS_ENABLED_TITLE', 'Оплата картами (13 методов)');
define('SOCIAL_WIDGETS_ENABLED_TITLE', 'Соц. виджеты');
define('MULTICOLOR_ENABLED_TITLE', 'Мультицвет');
define('WATERMARK_ENABLED_TITLE', 'Водяной знак');

define('FACEBOOK_APP_ID_TITLE', 'Facebook app ID');
define('FACEBOOK_APP_SECRET_TITLE', 'Facebook секретный ключ');
define('VK_APP_ID_TITLE', 'Vkontakte app ID');
define('VK_APP_SECRET_TITLE', 'Vkontakte секретный ключ');

define('TABLE_HEADING_ORDERS', 'ЗАКАЗЫ:');
define('TABLE_HEADING_LAST_ORDERS', 'Последние заказы');
define('TABLE_HEADING_CUSTOMER', 'Покупатель');
define('TABLE_HEADING_ORDER_NUMBER', '№');
define('TABLE_HEADING_ORDER_TOTAL', 'Сумма');
define('TABLE_HEADING_STATUS', 'Статус');
define('TABLE_HEADING_DATE', 'Дата');

include('includes/languages/order_edit_russian.php');

define('TEXT_VALID_TITLE', 'Список категорий');
define('TEXT_VALID_TITLE_PROD', 'Список товаров');
define('TEXT_VALID_CLOSE', 'Закрыть окно');
define('TABLE_HEADING_LASTNAME', 'Фамилия');
define('TABLE_HEADING_FIRSTNAME', 'Имя');
define('TABLE_HEADING_PRODUCT_NAME', 'Название');
define('TABLE_HEADING_PRODUCT_PRICE', 'Цена');
define('TEXT_SELECT_CUSTOMER', 'Выберите покупателя');
define('TEXT_SELECT_CUSTOMER_PLACEHOLDER', 'Начните вводить  ID / имя / телефон / e-mail покупателя');
define('TEXT_SINGLE_CUSTOMER', 'Один покупатель');
define('TEXT_EMAIL_RECIPIENT', 'E-mail получателя');

define('TEXT_NOTIFICATIONS', 'Уведомления');
define('TEXT_NOTIFICATIONS_MESSAGE', 'У вас %s непроверенных заказов');
define('TEXT_NOTIFICATIONS_LINK', 'Перейти на страницу заказов');

define('TEXT_PROFILE', 'Профиль');
define('TEXT_PROFILE_GREETINGS', 'Привет, %s!');
define('TEXT_PROFILE_LOGIN_COUNT', 'Количество входов: %s');
define('TEXT_PROFILE_DAYS_WITH_US', 'Вы с нами уже %s дней');

define('TEXT_MENU_TITLE', 'Меню');
define('TEXT_MENU_HOME', 'Главная');
define('TEXT_MENU_PRODUCTS', 'Товары');
define('TEXT_MENU_CATALOGUE', 'Каталог');
define('TEXT_MENU_ATTRIBUTES', 'Атрибуты');
define('TEXT_MENU_ORDERS', 'Заказы');
define('TEXT_MENU_ORDERS_LIST', 'Список заказов');
define('TEXT_MENU_CLIENTS_LIST', 'Список клиентов');
define('TEXT_MENU_CLIENTS_GROUPS', 'Группы клиентов');
define('TEXT_MENU_ADD_CLIENT', 'Добавить клиента');
define('TEXT_MENU_PAGES', 'Страницы');
define('TEXT_MENU_EMAIL_CONTENT', 'Шаблоны писем');
define('TEXT_MENU_SITE_MODULES', 'SOLO модули');
define('TEXT_MENU_SITE_SEO_SETTINGS', 'Настройки SEO');
define('TEXT_MENU_BACKUP', 'Резервное копирование');
define('TEXT_MENU_CKFINDER', 'Менеджер файлов');
define('TEXT_MENU_TOTAL_CONFIG', 'Редактор настроек');
define('TEXT_MENU_NEWSLETTERS', 'Рассылки');
define('TEXT_MENU_SLOW_QUERIES_LOGS', 'Лог медленных запросов');
define('TEXT_MENU_PRODUCTS_VIEWS', 'Просмотры товаров');
define('TEXT_MENU_CLIENTS', 'Клиенты');
define('TEXT_MENU_SALES', 'Продажи');
define('TEXT_MENU_ADMINS_AND_GROUPS', 'Администраторы и группы');
define('TEXT_MENU_UPDATE_PROFILE', 'Обновить свои данные');
define('TEXT_MENU_NOPHOTO', 'Без фото');
define('TEXT_MENU_OPENEDBY', 'Новые аккаунты');
define('TEXT_MENU_LAST_MODIFIED', 'Последние изменения');
define('TEXT_MENU_ZEROQTY', 'Нулевое количество');
define('TEXT_MENU_STATS_RECOVER_CART_SALES', 'Статистика незавершенных заказов');
define('TEXT_MENU_SEARCH', 'Поиск по категориям');

define('TEXT_HEADING_ADD_NEW', 'Добавить');
define('TEXT_HEADING_ADD_NEW_PRODUCT', 'Товар');
define('TEXT_HEADING_ADD_NEW_CATEGORY', 'Категорию');
define('TEXT_HEADING_ADD_NEW_PAGE', 'Страницу');
define('TEXT_HEADING_ADD_NEW_CLIENT', 'Клиента');
define('TEXT_HEADING_ADD_NEW_ORDER', 'Заказ');
define('TEXT_HEADING_ADD_NEW_COUPON', 'Купон');

define('TEXT_BLOCK_ORDERS_STATUSES_COUNTERS', 'Статусы заказов');

define('TEXT_BLOCK_ORDERS_TODAY_COUNTERS', 'Сегодня');
define('TEXT_BLOCK_ORDERS_YESTERDAY_COUNTERS', 'Вчера');
define('TEXT_BLOCK_ORDERS_WEEK_COUNTERS', 'Неделя');
define('TEXT_BLOCK_ORDERS_MONTH_COUNTERS', 'Месяц');
define('TEXT_BLOCK_ORDERS_QUARTER_COUNTERS', 'Квартал');
define('TEXT_BLOCK_ORDERS_ALL_TIME_COUNTERS', 'За все время');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_CURRENCY', 'грн.');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_PREFIX', 'на');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_NOUN', 'заказов');

define('TEXT_BLOCK_COUNTERS_PRODUCTS', 'Товаров');
define('TEXT_BLOCK_COUNTERS_ORDERS', 'Заказов');
define('TEXT_BLOCK_COUNTERS_COMMENTS', 'Комметариев');
define('TEXT_BLOCK_COUNTERS_TOTAL_INCOME', 'Сумма продаж');

define('TEXT_BLOCK_SETTINGS_TITLE', 'Настройки');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_HEADER', 'Закрепленная шапка');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_ASIDE', 'Закрепленное боковое меню');
define('TEXT_BLOCK_SETTINGS_TITLE_FOLDED_ASIDE', 'Свернутое боковое меню');
define('TEXT_BLOCK_SETTINGS_TITLE_DOCK_ASIDE', 'Боковое меню сверху');

define('TEXT_BLOCK_MODULES_STATS_USING', 'Используется');
define('TEXT_BLOCK_MODULES_STATS_AMOUNT', 'шт.');
define('TEXT_BLOCK_MODULES_STATS_MODULES', 'модулей');
define('TEXT_BLOCK_MODULES_USED', 'Используется модулей');
define('TEXT_BLOCK_MODULES_SEE_ALL', 'Просмотреть все модули');

define('TEXT_BLOCK_OVERVIEW_TITLE', 'Обзор');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS', 'Заказы');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED', 'ТОП просмотров');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD', 'ТОП продаж');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES', 'ТОП категорий');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS', 'Входы');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED', 'Поиски');

define('TEXT_BLOCK_OVERVIEW_ACTION_EDIT', 'Редактировать');
define('TEXT_BLOCK_OVERVIEW_ACTION_VIEW', 'Просмотреть');

define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_CUSTOMER_NAME', 'Покупатель');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_DATE', 'Дата');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_AMOUNT', 'Сумма');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_STATUS', 'Статус');

define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODUCT_IMAGE', 'Изображение');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODCUT_NAME', 'Название');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_VIEWS', 'Просмотров');

define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODUCT_IMAGE', 'Изображения');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODCUT_NAME', 'Название');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_ORDERS', 'Заказов');

define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_CATEGORY_NAME', 'Название');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_ORDERS', 'Заказов');

define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_ADMIN_NAME', 'Имя');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_DATE', 'Дата последнего входа');

define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_QUERY', 'Запрос');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_COUNT', 'Количество');

define('TEXT_BLOCK_NEWS_TITLE', 'Новости SoloMono');

define('TEXT_BLOCK_PLOT_TITLE', 'График доходов');
define('TEXT_BLOCK_PLOT_TAB_BY_DAYS', 'По дням');
define('TEXT_BLOCK_PLOT_TAB_BY_WEEKS', 'По неделям');
define('TEXT_BLOCK_PLOT_TAB_BY_MONTHES', 'По месяцам');

define('TEXT_BLOCK_PLOT_XAXIS_LABEL', 'Общая сумма заказов');
define('TEXT_BLOCK_PLOT_YAXIS_LABEL', 'Количество заказов');

define('TEXT_BLOCK_COMMENTS_TITLE', 'Отзывы');

define('TEXT_BLOCK_EVENTS_TITLE', 'События');

define('TEXT_BLOCK_EVENTS_TOOLTIP_ALL_EVENTS', 'Все события');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ADMINS', 'Администраторы');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ORDERS', 'Заказы');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CUSTOMERS', 'Покупатели');
define('TEXT_BLOCK_EVENTS_TOOLTIP_NEW_PRODUCTS', 'Новые товары');
define('TEXT_BLOCK_EVENTS_TOOLTIP_COMMENTS', 'Комментарии');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CALL_ME_BACK', 'Перезвоните мне');

define('TEXT_BLOCK_EVENTS_MESSAGE_ADMINS', '%s вошел в систему');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS', 'Оформлен %s');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS_2', 'заказ #%d');
define('TEXT_BLOCK_EVENTS_MESSAGE_CUSTOMERS', '%s зарегистрировался на сайте');
define('TEXT_BLOCK_EVENTS_MESSAGE_NEW_PRODUCTS', 'Добавлен новый товар: "%s"');
define('TEXT_BLOCK_EVENTS_MESSAGE_COMMENTS', 'Пользователь %s добавил комментарий');
define('TEXT_BLOCK_EVENTS_MESSAGE_CALL_ME_BACK', 'запросил звонок');

define('TEXT_BLOCK_GA_TITLE', 'Google Аналитика');

define('TEXT_SETTINGS_EDIT_FORM_SAVE', 'ОК');
define('TEXT_SETTINGS_EDIT_FORM_CANCEL', 'Отмена');
define('TEXT_SETTINGS_EDIT_FORM_TOOLTIP', 'изменить');

define('TEXT_MODAL_ADD_ACTION', 'Добавить');
define('TEXT_MODAL_UPDATE_ACTION', 'Обновить');
define('TEXT_MODAL_DELETE_ACTION', 'Удалить');
define('TEXT_MODAL_CHANGE_STATUS', 'Изменить статус');
define('TEXT_MODAL_DETAILED', 'Подробней');
define('TEXT_MODAL_ACTION', 'Действие');
define('TEXT_MODAL_INSTALL_ACTION', 'Установить');
define('TEXT_MODAL_CONTINUE_ACTION', 'Продолжить');
define('TEXT_MODAL_CANCEL_ACTION', 'Отменить');
define('TEXT_MODAL_CONFIRM_ACTION', 'Подтверждение');
define('TEXT_MODAL_CONFIRMATION_ACTION', 'Вы уверены?');
define('TEXT_WAIT', 'Загрузка...');
define('TEXT_SHOW', 'На страницу:');
define('TEXT_RECORDS', 'Всего:');
define('TEXT_SAVE_DATA_OK', 'Данные успешно изменены');
define('TEXT_DEL_OK', 'Запись успешно удалена');
define('TEXT_ERROR', 'Возникла ошибка');
define('TEXT_GENERAL_SETTING', 'Общие');

//featured
define('TEXT_FEATURED_ADDED', 'Добавлен');
define('TEXT_FEATURED_CHANGE', 'Изменён');
define('TEXT_FEATURED_EXPIRE_DATE', 'Дата истечения');
define('TEXT_ENTER_PRODUCT', 'Введите наименование');
define('TEXT_FEATURED_MODEL', 'Модель');
define('TEXT_PRODUCTS_ON_ATTRIBUTES_VAL', 'Cписок продуктов по значению атрибута');

define('ADMIN_BTN_BUY_MODULE', 'Купите этот модуль!');
define('FOOTER_INSTRUCTION', 'Как пользоваться Админкой?');
define('FOOTER_NEWS', 'Новости Solomono');
define('FOOTER_SUPPORT_SOLOMONO', 'Тех. поддержка');
define('FOOTER_SUPPORT_CONSULTANT', 'Онлайн-консультант');
define('FOOTER_SUPPORT_TECHNICAL', 'Тех. поддержка');

//new admin
define('TEXT_ERROR_DEL_FILE', 'Не удалось удалить файл.');
define('TEXT_ERROR_UPDATE', 'Ошибка обновления.');

//languages_translater
define('TEXT_TRANSLATER_TITLE', 'Редактор языков');

define('TEXT_PRODUCT_FREE_SHIPPING', 'Бесплатная доставка:');

define('TEXT_MOBILE_OPEN_COLLAPSE', 'Показать');
define('TEXT_MOBILE_CLOSE_COLLAPSE', 'Скрыть');
define('TEXT_ORDER_STATISTICS', 'Статистика заказов');
define('TEXT_WHO_ONLINE', 'Кто онлайн');
define('TEXT_VIEW_LIST', 'Смотреть список');
define('TEXT_ACTION_OVERVIEW', 'Обзор действий');
define('TEXT_SEE_ALL', 'Смотреть все');

define('TEXT_MOBILE_SHOW_MORE', 'Показать еще');
define('TEXT_MOBILE_INCOME', 'Доходы:');
define('TEXT_SHOW_ALL', 'Показать все');
define('TEXT_REPLY_COMMENT', 'Ответить на комментарий - ');
define('TEXT_BTN_REPLY', 'Ответить');
define('TEXT_BTN_ANSWERED', 'Отвечено');
define('TEXT_MODAL_APPLY_ACTION', 'Применить');

define('RECOVER_CART_SALES', 'Незавершенные заказы');

define('TEXT_REDIRECTS_TITLE', 'Перенаправления');


define('RCS_CONF_TITLE', 'Незавершенные заказы');


define('INSTAGRAM_PRODUCTS_TITLE', 'Импорт из Instagram');
define('INSTAGRAM_PRODUCTS_RESULT', 'Продукты загружены в бд');
define ('INSTAGRAM_SUCCESS', 'Посты Instagram были добавлены на наш сайт!');
define('INSTAGRAM_LINK', 'Ссылка на Instagram');
define('INSTAGRAM_COUNT', 'Количество постов');

define('INSTAGRAM_MODULE_ENABLE_TITLE', 'Instagram слайдер');
define("LIST_MODAL_ON","Модалка товара");

define('TEXT_SEARCH_PAGES','Страницы поиска');
define('TEXT_ENABLE_MULTILANGUAGE_MODULE', 'Пожалуйста, включите многоязычный модуль');
define('TEXT_BUY_MULTILANGUAGE_MODULE', 'Пожалуйста, купите многоязычный модуль');








define('BOX_PRODUCTS_STATS_MENU_ITEM', 'Товары');


define('BOX_CLIENTS_STATS_TOP_CLIENTS', 'Топ клиентов');
define('BOX_CLIENTS_STATS_NEW_CLIENTS', 'Новые клиенты');


define('BOX_MENU_TOOLS_EMAILS', 'E-mail рассылки');
define('BOX_MENU_TOOLS_MASS_EMAILS', 'Массовые рассылки');


define('BOX_EXEL_IMPORT_EXPORT', 'Excel импорт/экспорт');
define('BOX_PROM_IMPORT_EXPORT', 'Prom.ua Excel импорт');
define('IMPORT_EXPORT_MENU_BOX', 'Импорт/Экспорт');


define('BOX_MENU_TAXES', 'Налоги');


define('INTEGRATION_CONF_TITLE', 'Другие Интеграции');

define('BOX_HEADING_INSTRUCTION', 'Инструкции');

define('BOX_CATALOG_YML', 'YML импорт');
define('TOOLTIP_CATEGORY_STATUS', 'При активизации категория/подкатегория/товар отображается на странице сайта');
define('TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS', 'Для добавления категории/подкатегории/товара в Google Feed. Чтобы включить только один товар - должна быть включена категория и подкатегория, в которой находится товар.');
define('TOOLTIP_PRODUCTS_FEATURED', 'Отображаются на главной странице.');
define('TOOLTIP_PRODUCTS_RELATED', 'Отображаются на странице товара, в статьях.');
define('TOOLTIP_PRODUCTS_ATTRIBUTES', 'Атрибуты (фильтры) позволяют определять дополнительные характеристики продукта, такие как размер или цвет. Подробнее в инструкции: ССЫЛКА');
define('TOOLTIP_ATTRIBUTES_VALUES', 'После создания атрибута внесите необходимые его значения.');
define('TOOLTIP_ATTRIBUTES_GROUPS', 'Для объеденения нескольких атрибутов в одну группу.');
define('TOOLTIP_ATTRIBUTES_TYPES', 'Текст - текстовое описание характеристик; Dropdown - выбор из выпадающего списка; Radio - для выбора из предоставленных вариантов; Изображение - изменяется картика при выборе значения товара; Отображаются на странице товара.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_FILTER', 'Для отображения атрибутов товара в панели фильтров переместите ползунок сделав его активным.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_LISTING', 'При наведении на товар отображаются атрибуты в списке товаров.');
define('TOOLTIP_SPECIALS', 'Для установки спец цены на один товар.');
define('TOOLTIP_SALES_MAKERS', 'Для установки скидки на несколько или на все категории товаров и/или производителей.');
define('TOOLTIP_EXPORT_IMPORT_CSV', 'Для загрузки/выгрузки базы из файла с раширение .csv.');
define('TOOLTIP_EXPORT_IMPORT_PROM', 'Для экспорта базы из файла импортированого из Prom.');
define('TOOLTIP_ORDER_DATE', 'Просмотр заказов за выбранный диапазон времени.');
define('TOOLTIP_ORDER_DETAILS', 'детали заказа');
define('TOOLTIP_ORDER_EDIT', 'редактировать заказ');
define('TOOLTIP_ORDER_STATUS', 'Для добавления нового статуса заказа нажмите &quot;+&quot;');
define('TOOLTIP_CLIENT_EDIT', 'редактировать');
define('TOOLTIP_CLIENT_GROUP_PRICE', 'Цена которая будет отображатся на сайте для клиентов определенной группы после авторизации. Кол-во цен устанавливается в разделе &quot;Мой Магазин&quot;');
define('TOOLTIP_CLIENT_PRICE_GROUP_LIMIT', 'При достижении суммы предела, можно перевести клиента в другую группу.');
define('TOOLTIP_CLIENT_GROUP_EDIT', 'редактировать');
define('TOOLTIP_EMAIL_TEMPLATE', 'Готовые шаблоны писем для отправки клиентам.');
define('TOOLTIP_EMAIL_TEMPLATE_EDIT', 'редактировать');
define('TOOLTIP_FILE_MANAGER', 'Для загрузки и редактирования файлов на сайте.');
define('TOOLTIP_REDIRECTS', 'Например, необходимио перенаправить со страницы https://demo.solomono.net/kontakty на страницу https://demo.solomono.net/contact_us.php. Нужно указать в строке &quot;перенаправить с&quot;  kontakty &quot;перенаправити на&quot; contact_us.php');
define('TOOLTIP_MODULES_PAYMENT', 'Добавьте доступные способы оплаты.');
define('TOOLTIP_MODULES_SHIPPING', 'Добавьте доступные способы доставки.');
define('TOOLTIP_MODULES_TOTALS', 'Итоговая стоимость заказа, отображается на странице оформления заказа.');
define('TOOLTIP_MODULES_ZONE', 'Укажите возможные способы доставки для определенных зон, а так же разрешенные способы оплаты для этих зон. Создать новую зону можно в разделе Настройки-&gt;Налоги-&gt;Налоговые зоны');
define('TOOLTIP_MODULES_LANGUAGES', 'Выбор языков сайта, установка языка по умолчанию.');
define('TOOLTIP_MODULES_CURRENCY', 'Задайте валюту по умолчанию и установите величину в соответствии с курсом.');
define('TOOLTIP_MODULES_COUPONS', 'Создайте купон чтобы покупатель применил его в корзине и получил скидку.');
define('TOOLTIP_MODULES_POOLS', 'Создайте опрос, чтобы получить необходимую Вам статистику.');
define('TOOLTIP_MODULES_SOLOMONO', 'Список приобретенных модулей + список доступных к покупке.');
define('TOOLTIP_CONFIGURATION_MAIN_EMAIL', 'Основной адрес куда приходят все уведомления.');
define('TOOLTIP_CONFIGURATION_FROM_EMAIL', 'Укажите адрес, от какого имени отправлять все письма в массовых рассылках.');
define('TOOLTIP_CONFIGURATION_ORDER_COPY_EMAIL', 'Укажите все адреса куда будут приходить копии писем с заказами. Можно указывать несколько e-mail, через запятую с пробелом.');
define('TOOLTIP_CONTACT_US_EMAIL', 'Укажите адрес куда будут приходить обращения со страницы &quot;Свяжитесь с нами&quot;');
define('TOOLTIP_STORE_COUNTRY', 'Укажите страну магазина, она будет выбрана по умолчанию при оформлении заказа.');
define('TOOLTIP_STORE_REGION', 'Укажите регион магазина, он будет выбран по умолчанию при оформлении заказа.');
define('TOOLTIP_CONTACT_ADDRESS', 'Укажите адрес магазина, он будет отображаться на странице &quot;Контакты&quot;.');
define('TOOLTIP_MINIMUM_ORDER', 'По желанию можно указать минимальную сумму для успешного оформления заказа.');
define('TOOLTIP_MASTER_PASSWORD', 'Пароль, который подойдёт для входа в учётную запись любого клиента, зарегистрированого на сайте.');
define('TOOLTIP_SHOW_PRICE_WITH_TAX', 'Переместите ползунок, чтобы отображать цены на всех страницах сайта с учётом налога.');
define('TOOLTIP_CALCULATE_TAX', 'При включении будет считаться установленный налог на товар при оформлении заказа.');
define('TOOLTIP_EXTRA_PRICE', 'По желанию можно установить наценку, которая будет отображаться для незарегистрированных пользователей сайта.');
define('TOOLTIP_PRICES_COUNT', 'Укажите возможное кол-во цен, которые будут устанавливатся на товары (н-р, несколько цен для разных групп клиентов)');
define('TOOLTIP_SHOW_PRICE_TO_NOT_AUTHORIZED_CUSTOMER', 'Отображение цен на товары для незаригестрированных пользователей');
define('TOOLTIP_LOGO', 'Выберите логотип (изображение), который будет отображаться на главной странице');
define('TOOLTIP_WATERMARK', 'Выберите изображение, которое будет наложено на фото товаров, защита от копирования.');
define('TOOLTIP_FAVICON', 'Выберите изображение, которое будет отображаться значком веб-сайта');
define('TOOLTIP_AUTO_STOCK', 'При формировании заказа автоматически проверяется кол-во товара на складе и доступность его к заказу.');
define('TOOLTIP_DISABLED_BUY_BUTTON_FOR_ZERO_STOCK', 'На странице товара, которого нет на складе, будет отображаться кнопка &quot;купить&quot;.');
define('TOOLTIP_STOCK_AUTO_INCREMENT', 'При оформлении заказа автоматически вычитывается кол-во купленного товара с остатка на складе.');
define('TOOLTIP_ALLOW_ZERO_STOCK_ORDER', 'Разрешить оформление заказа на товар, которого нет на складе.');
define('TOOLTIP_MARK_ZERO_STOCK_PRODUCT', 'Если добавленного в корзину товара нет в нужном количестве на складе, товар будет отмечаться указанным значением.');
define('TOOLTIP_ZERO_STOCK_NOTIFICATION', 'При достижении данного кол-ва на почту приходит оповещение, что товар заканчивается.');
define('TOOLTIP_SMS_TEXT', 'Укажите текст, который будет приходить клиенту.');
define('TOOLTIP_SMS_LOGIN', 'Предоставляет sms-провайдер.');
define('TOOLTIP_SMS_PASSWORD', 'Предоставляет sms-провайдер.');
define('TOOLTIP_SMS_CODE_1', 'Номер телефона или aлфавитно-цифровой отправитель.');
define('TOOLTIP_SMS_CODE_2', 'Предоставляет sms-провайдер.');
define('TOOLTIP_TAX_ADD', 'Для добавления нового типа налога нажмите &quot;+&quot; и заполните необходимые поля.');
define('TOOLTIP_TAX_RATE_ADD', 'Для добавления % ставки, которая будет прибавляться к стоимости товара нажмите &quot;+&quot; и заполните необходимые поля.');
define('TOOLTIP_TAX_ZONE_ADD', 'Для добавления зоны (страны) на которую будет распространятся налог нажмите &quot;+&quot; и заполните необходимые поля.');
define('TOOLTIP_BACKUP_CREATE', 'Создать резервную копию текущей версии базы сайта.');
define('TOOLTIP_BACKUP_LOAD', 'Восстановление базы из выбранного файла.');
define('TOOLTIP_EMAILING', 'Отправка e-mail одному покупателю, всем клиентам или всем подписчикам новостей.');
define('TOOLTIP_MASS_EMAILING', 'Отправка писем для отдельного покупателя или для выбранной группы покупателей.');
define('TOOLTIP_CLEAR_CACHE', 'Очистка загруженных изображений из кеша.');
define('TOOLTIP_STATS_SALES', 'Отображение статистики продаж.');
define('TOOLTIP_STATS_SALES_PRODUCTS_BY_TIME_PERIOD', 'Отчёт по продажам по заказанным товарам за выбранный период времени.');
define('TOOLTIP_STATS_SALES_CATEGORIES_BY_TIME_PERIOD', 'Отчёт по продажам по категориям товаров за выбранный период времени.');
define('TOOLTIP_STATS_VIEWED_PRODUCTS', 'Статистика просматриваемых товаров.');
define('TOOLTIP_STATS_ZERO_QUANTITY_PRODUCTS', 'Товар который отсутствует на складе.');
define('TOOLTIP_STATS_CLIENTS_ORDERS', 'Отчёт по закупкам клиентов за выбранный период времени.');
define('TOOLTIP_ADMINISTRATORS', 'Список администраторов сайта.');
define('TOOLTIP_ADMINISTRATORS_GROUPS', 'Разделение администраторов по группам.');
define('TOOLTIP_ADMINISTRATORS_ACCESS_RIGHTS', 'Права доступа к информации на сайте в зависимости от группы администраторов.');
define('TOOLTIP_TEXT_COPIED', 'Текст скопирован');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY', 'купить');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON', 'включить');
define('TOOLTIP_TEXT_TAB_LANGUAGES', 'Языковой функционал');
define('TOOLTIP_TEXT_TAB_AUTO_TRANSLATE', 'Автоматический массовый перевод контента');
define('TOOLTIP_TEXT_TAB_EDIT_TRANSLATE', 'Редактировать переводы');
define('HIGHSLIDE_CLOSE', 'Закрыть');
define('COMMENT_BY_ADMIN', 'Комментарий администратора');
define('TEXT_MENU_WHO_IS_ONLINE', 'Кто в сети');
define('INFO_ICON_NEED_MINIFY', 'Любые изменения в этом модуле изменят статус стилей на Minify Now');
define('INFO_ICON_ENABLE_SMTP', 'При включении модуля - проверьте настройки SMTP');
define('SMTP_CONF_TITLE', 'SMTP Настройки');
define('TEXT_CLOSE_BUTTON', 'Закрыть');


define('TOOLTIP_STORE_NAME', 'Укажите оригинальное название магазина, что привлекает покупателей, запоминается покупателям, и служит для того чтобы выделится и отличится среди подобных магазинов – конкурентов.');
define('TOOLTIP_STORE_OWNER', 'Укажите владельца магазина');
define('TOOLTIP_SHOW_BASKET_ON_ADD_TO_CART', 'Включите, корзина будет доступна при добавлении товара, чтобы у посетителя не возникло вопросов, что товар точно добавлен в корзину.');
define('TOOLTIP_USE_DEFAULT_LANGUAGE_CURRENCY', 'Включите, чтобы валюта изменялась автоматически согласно текущего языка сайта.');
define('TOOLTIP_CHANGE_BY_GEOLOCATION', 'Включите, чтобы валюта и язык сайта изменялась в зависимости от геолокации.');
define('TOOLTIP_GET_BROWSER_LANGUAGE', 'Включите, чтобы валюта сайта изменялась  в зависимости от языка браузера.');
define('TOOLTIP_STORE_BANK_INFO', 'Позволяет определить точную информацию о банке для реквизитов счет-фактуры');
define('TOOLTIP_ONEPAGE_LOGIN_REQUIRED', 'Включите, и логин пользователя/клиента будет требоваться всегда');
define('TOOLTIP_REVIEWS_WRITE_ACCESS', 'Включите, и только зарегистрированные пользователи смогут оставлять свои коментарии');
define('TOOLTIP_ROBOTS_TXT', 'Защита всего сайта или некоторых его разделов от индексации');
define('TOOLTIP_MENU_LOCATION', 'Выберите расположение меню: сверху, слева или слева свернутое');
define('TOOLTIP_DEFAULT_DATE_FORMAT', 'Выберите формат даты');
define('TOOLTIP_SET_HTTPS', 'Включите расширение протокола HTTPS для поддержки шифрования в целях повышения безопасности');
define('TOOLTIP_SET_WWW', 'Выберите настройку куда перенаправить: disable,  www->no-www  либо  no-www->www');
define('TOOLTIP_ENABLE_DEBUG_PAGE_SPEED', 'Включите дебаг загрузки страницы для поиска и исправления ошибок в скрипте');
define('TOOLTIP_STORE_SCRIPTS', 'Вы можете подключить дополнительные JS скрипты');
define('TOOLTIP_STORE_METAS', 'Вы можете подключить дополнительные Meta-теги в head');
define('TOOLTIP_MYSQL_PERFORMANCE_TRESHOLD', 'Установите время в "секундах" свыше которого будут логироваться медленные и потенциально проблемные запросы в базу данных');
define('TOOLTIP_STOCK_REORDER_LEVEL', 'Укажите количества товара на складе');

define('TOOLTIP_TELEGRAM_NOTIFICATIONS_ENABLED', 'Можно включить/выключить Telegram уведомления');
define('TOOLTIP_TELEGRAM_TOKEN', 'Специальные аккаунты в Telegram, созданные для того, чтобы автоматически обрабатывать и отправлять сообщения');
define('TOOLTIP_SMS_ENABLE', 'Можно включить/выключить sms-сервис');
define('TOOLTIP_SMS_CUSTOMER_ENABLE', 'Можно включить/выключить возможность отправлять sms клиенту при покупке');
define('TOOLTIP_SMS_CHANGE_STATUS', 'Можно включить/выключить возможность отправлять sms клиенту при смене статуса');
define('TOOLTIP_SMS_OWNER_ENABLE', 'Можно включить/выключить возможность отправлять sms админу при покупке');
define('TOOLTIP_SMS_OWNER_TEL', 'Укажите/измените номер телефона администратора');


define('TOOLTIP_FACEBOOK_AUTH_STATUS', 'Вы можете разрешить пользователям входить на ваш сайт с помощью аккаунта в Facebook. Это отличный способ сделать этот процесс проще и удобней для ваших пользователей, а также увеличить количество новых регистраций.');
define('TOOLTIP_FACEBOOK_APP_ID', 'Идентификационный номер в социальных сетях - комбинация цифр, позволяющая отличить один аккаунт от других. В интернете это аналог паспорта, который часто нуждается в применении надежных способов защиты. Идентификационный номер создается автоматически при регистрации профиля. С его помощью можно найти нужную информацию, человека или интересующее сообщество.');
define('TOOLTIP_FACEBOOK_APP_SECRET', 'Секретный ключ - это устройство для защиты аккаунта Facebook. Также это способ двухфакторной аутентификации, который повышает уровень безопасности при входе в аккаунт.');
define('TOOLTIP_FACEBOOK_PIXEL_ID', 'С помощью данных, которые собирает Пиксель Facebook, вы можете отслеживать визиты и конверсии на вашем сайте, оптимизировать рекламу и создавать индивидуализированные аудитории для ретаргетинга.');
define('TOOLTIP_DEFAULT_PIXEL_CURRENCY', 'Укажите валюту, в которой будет отправляться цена товара в FaceBook Pixel');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_BUG_REPORT', 'Предназначен для описания обнаруженных багов, что позволит команде разработки исправить ошибки в программе.');
define('TOOLTIP_FACEBOOK_GOALS_PHONE_CALL', 'Запустив рекламу с номером телефона, вы можете побудить людей позвонить в вашу компанию и сделать заказ, узнать больше о ваших товарах или услугах либо запланировать встречу.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_FAST_BUY', 'Если товары покупают регулярно, часто характеристики покупателю уже известны, задача не выбирать, а найти нужное, накидать в корзину и быстро оформить заказ.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_CHAT', 'Кнопка чата — это значок, размещенный где-либо на вашем сайте, который позволяет клиентам в режиме реального времени общаться с командой клиентской поддержки. С помощью онлайн чата, ваши специалисты могут быстро и эффективно разрешать запросы клиентов.');
define('TOOLTIP_FACEBOOK_GOALS_CALLBACK', 'Задача кнопки «обратный звонок» — вывести на коммуникацию потенциального клиента.');
define('TOOLTIP_FACEBOOK_GOALS_FILTER', 'Фильтр дает возможность сузить ассортимент до выборки с характеристиками, наиболее релевантными индивидуальным потребностям пользователя.');
define('TOOLTIP_FACEBOOK_GOALS_SUBSCRIBE', 'Предоставляет пользователям возможность организации и ведения тематических e-mail-рассылок, на которые могут подписаться другие пользователи сервиса.');
define('TOOLTIP_FACEBOOK_GOALS_LOGIN', 'login – это слово, которое будет использоваться для входа на сайт или сервис. Очень часто логин совпадает с именем пользователя, которое будет видно всем участникам сервиса.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_REVIEW', 'Отзывы клиентов — обратная связь от пользователей на ваши продукты или услуги. Что бы купить товар 89% покупателей читают сначала отзывы.');
define('TOOLTIP_FACEBOOK_GOALS_PAGE_VIEW', 'Вы можете знать, сколько людей видели и запрашивали ваш сайт');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_CART', 'Кнопка «Добавить в корзину» подразумевает покупку нескольких товаров, когда они сначала все добавляются в корзину и уже там оформляется заказ.');
define('TOOLTIP_FACEBOOK_GOALS_CHECKOUT_PROCESS', 'Качество и удобство пользования корзиной — залог хорошего настроения ваших покупателей, эффективный способ повышения конверсии сайта.');
define('TOOLTIP_FACEBOOK_GOALS_SEARCH_RESULTS', 'Переводит пользователя на страницу результатов поиска');
define('TOOLTIP_FACEBOOK_GOALS_VIEW_CONTENT', 'ViewContentсообщает вам, посещает ли кто-то URL-адрес веб-страницы.');
define('TOOLTIP_FACEBOOK_GOALS_COMPLETE_REGISTRATION', 'Предоставление клиентом информации в обмен на услугу, оказываемую вашей компанией');
define('TOOLTIP_FACEBOOK_GOALS_CONTACT_US_REQUEST', 'Контактные данные человека, который проявил реальную заинтересованность к товарам и услугам компании и в будущем может стать реальным клиентом.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_WISHLIST', 'Одно из собитий, что позволяет следить за действиями пользователей, оптимизацию их и создавать аудитории');
define('TOOLTIP_FACEBOOK_GOALS_ADD_PAYMENT_INFO', 'Одно из собитий, что позволяет следить за действиями пользователей, оптимизацию их и создавать аудитории');
define('TOOLTIP_FACEBOOK_GOALS_SUCCESS_PAGE', 'Клиент видит своего рода накладную об совершенном заказе.');

define('TOOLTIP_GOOGLE_OAUTH_STATUS', 'Возможность включить/выключить авторизацию клиента через Google');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_ID', 'По умолчанию Google назначает уникальный идентификатор клиента – Client ID.');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_SECRET', 'CLIENT_SECRET используется для хранения немного более конфиденциальной информации, такой как использование api, информация о трафике и платежная информация');
define('TOOLTIP_GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED', 'Обладает инструментом отслеживания событий, позволяет сервисам собирать данные и проводить анализ');
define('TOOLTIP_GOOGLE_ECOMM_SUCCESS_PAGE', 'Возможность включить/выключить страница "покупка" после подтверждения заказа');
define('TOOLTIP_GOOGLE_ECOMM_CHECKOUT_PAGE', 'Возможность включить/выключить страницу оформления заказа');
define('TOOLTIP_GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE', 'Возможность включить/выключить страницу просмотра продукта');
define('TOOLTIP_GOOGLE_ECOMM_SEARCH_RESULTS', 'Возможность включить/выключить страницу результатов поиска');
define('TOOLTIP_GOOGLE_ECOMM_HOME_PAGE', 'Возможность включить/выключить стартовую страницу при загрузке браузера');
define('TOOLTIP_GOOGLE_SITE_VERIFICATION_KEY', 'Ключ предоставляет Google (необходимо вставить только сам ключ)');
define('TOOLTIP_GOOGLE_RECAPTCHA_STATUS', 'Можете включить/выключить Google Recaptcha (защита веб-сайтов от интернет-ботов и одновременной помощи в оцифровке текстов книг)');
define('TOOLTIP_GOOGLE_RECAPTCHA_PUBLIC_KEY', 'Предоставляет сервис Google (для защиты веб-сайтов от интернет-ботов и одновременной помощи в оцифровке текстов книг)');
define('TOOLTIP_GOOGLE_RECAPTCHA_SECRET_KEY', 'Предоставляет сервис Google (для защиты веб-сайтов от интернет-ботов и одновременной помощи в оцифровке текстов книг)');
//define('TOOLTIP_', '');






define('TOOLTIP_ENTRY_FIRST_NAME_MIN_LENGTH', "Укажите минимальное количество симфолов в колонке 'Значение' для каждого параметра");
define('TOOLTIP_ENTRY_LAST_NAME_MIN_LENGTH', "Укажите минимальное количество симфолов в колонке 'Значение' для каждого параметра");
define('TOOLTIP_ENTRY_EMAIL_ADDRESS_MIN_LENGTH', "Укажите минимальное количество симфолов в колонке 'Значение' для каждого параметра");
define('TOOLTIP_MIN_DISPLAY_XSELL', "Укажите минимальное количество симфолов в колонке 'Значение' для каждого параметра");

define('INFO_ICON_NEED_GENERATE_CRITICAL', 'Изменения в этом параметре требуют перегенерации Critical CSS');
define('YANDEX_MARKET_MODULE_ENABLED_TITLE', 'XML (YML) экспорт товаров "Яндекс.Маркет"');
define('AUTO_TRANSLATE_MODULE_ENABLED_TITLE', 'Автоматический перевод');
define('EMAIL_CONTENT_MODULE_ENABLED_TITLE', 'Шаблоны писем');
define('TEXT_INFO_BUY_MODULE', 'Модуль «%s» выключен, чтобы включить его, используйте страницу <a href="%s"><span style="color:blue;" >Модулей</span></a>');
define('TEXT_INFO_DISABLE_MODULE', 'Модуль «%s» отсутствует, чтобы добавить его, используйте <a href="%s"><span style="color:blue;" >Магазин модулей SoloMono</span></a>');
define("TEXT_POPULAR_SEARCH_QUERIES", "Популярные поисковые запросы");
define('STATS_KEYWORDS_POPULAR_ENABLED_TITLE','Страницы поиска');
define("SHOW_BASKET_ON_ADD_TO_CART_TITLE","Показывать корзину при добавлении товара");
define("TEXT_QUICK_ORDER", "Быстрый заказ");
define("TEXT_VIEWED","Просмотрено");
define('API_ENABLED_TITLE', 'Solomono API');
define('TEXT_MENU_API', 'API');
define('ENTRY_CREDIT_CARD_CC_TYPE', 'Тип карты');
define('ENTRY_CREDIT_CARD_CC_OWNER', 'Владелец карты');
define('ENTRY_CREDIT_CARD_CC_NUMBER', 'Номер карты');
define('ENTRY_CREDIT_CARD_CC_EXPIRES', 'Срок действия карты истекает');
define('SMTP_MODULE_ENABLED_TITLE','SMTP');

define('LEFT_MENU_SECTION_TITLE_SHOP','Магазин');
define('LEFT_MENU_SECTION_TITLE_INFO','Инфо');
define('LEFT_MENU_SECTION_TITLE_CONTROL','Управление');
define('INTEGRATION_FACEBOOK_CONF_TITLE','Интеграция Facebook');
define('INTEGRATION_GOOGLE_CONF_TITLE','Интеграция GOOGLE');
define('SEO_SETTINGS_CONF_TITLE','Настройки SEO');

define('FACEBOOK_GOALS_ADD_PAYMENT_INFO_TITLE','Цель \'AddPaymentInfo\' - заполнение платежной информации');
define('FACEBOOK_GOALS_ADD_TO_WISHLIST_TITLE','Цель \'AddToWishlist\' - добавить в список желаний');
define('FACEBOOK_GOALS_CONTACT_US_REQUEST_TITLE','Цель \'Lead\' - запрос на странице контактов');
define('FACEBOOK_GOALS_VIEW_CONTENT_TITLE','Цель \'ViewContent\' - просмотреть страницу продукта');
define('FACEBOOK_GOALS_SUCCESS_PAGE_TITLE','Цель \'Purchase\' - страница успешного заказа');
define('FACEBOOK_GOALS_CHECKOUT_PROCESS_TITLE','Цель \'InitiateCheckout\' - страница оформления заказа');
define('FACEBOOK_GOALS_SEARCH_RESULTS_TITLE','Цель \'Search\' - страница результатов поиска');
define('FACEBOOK_GOALS_COMPLETE_REGISTRATION_TITLE','Цель \'CompleteRegistration\' - когда клиент зарегистрировался');
define('FACEBOOK_GOALS_ADD_TO_CART_TITLE','Цель \'AddToCart\' - добавить в корзину');
define('FACEBOOK_GOALS_PAGE_VIEW_TITLE','Цель \'PageView\' - просмотр каждой страницы');
define('FACEBOOK_GOALS_CLICK_FAST_BUY_TITLE','Цель \'FastBuy\' - когда клиент нажимает кнопку \'Быстрый заказ\' на странице продукта');
define('FACEBOOK_GOALS_CLICK_ON_CHAT_TITLE','Цель \'ClickChat\' - когда клиент нажимает кнопку чата');
define('FACEBOOK_GOALS_CALLBACK_TITLE','Цель \'Callback\' - когда клиент нажимает кнопку \'Обратный звонок\' в заголовке сайта');
define('FACEBOOK_GOALS_FILTER_TITLE','Цель \'filter\' - когда покупатель использует фильтр для поиска товаров');
define('FACEBOOK_GOALS_SUBSCRIBE_TITLE','Цель \'Subscribe\' - когда клиент подписался');
define('FACEBOOK_GOALS_LOGIN_TITLE','Цель \'login\' - когда клиент вошел в систему');
define('FACEBOOK_GOALS_ADD_REVIEW_TITLE','Цель \'add_review\' - когда клиент добавил отзыв');
define('FACEBOOK_GOALS_PHONE_CALL_TITLE','Цель \'PhoneCall\' - когда клиент нажимает на номер телефона в заголовке сайта');
define('FACEBOOK_GOALS_CLICK_ON_BUG_REPORT_TITLE','Цель \'BugReport\' - когда клиент нажимает \'Отправить сообщение об ошибке\' в нижнем колонтитуле сайта');

define('NWPOSHTA_DELIVERY_TITLE', 'Адрес доставки новой почты');

define('HEADER_BUY_TEMPLATE_LINK','Перейти на платный пакет');
define('HEADER_MARKETPLACE_LINK','Маркетплейс модулей');
define('TEXT_CATEGORIES', 'Категории');
define('HEADING_TITLE_GOTO', 'Перейти в:');
define('ERROR_DOMAIN_IN_USE','Ошибка! Этот домен уже занят');
define('ERROR_ANAME_MISMATCH', 'Ошибка! A-name домена не сответствуют 167.172.41.152. Попробуйте позже');
define('SUCCESS_DOMAIN_CHANGE', 'Успешно! Домен изменен');
define('ERROR_ADD_DOMAIN_FIRST','Сначала подключите персональный домен!');
define('ERROR_BASH_EXECUTION','Ошибка выполнения скрипта, обратитесь к менеджеру');
define('PRODUCTS_LIMIT_REACHED_FREE', 'Превышен лимит товаров! Через %s дней ваш сайт будет автоматически отключен. <a href="%s">Оформите платную аренду</a> или удалите ненужные товары');
define('PRODUCTS_LIMIT_REACHED_JUNIOR', 'Превышен лимит товаров! Через %s дней ваш сайт будет автоматически переведен на пакет seo.');
define('PRODUCTS_LIMIT_REACHED_SEO', 'Превышен лимит товаров! Через %s дней ваш сайт будет автоматически переведен на пакет pro');
define('PRODUCTS_LIMIT_REACHED_HEADING', 'Превышен лимит товаров!');
define('ERROR_SIMLINK_CREATE', 'Симлинк не создан');
define('ERROR_FOLDER_RENAME', 'Папка не скопировалась');
