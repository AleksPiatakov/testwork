<?php
/*
  $Id: configuration.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

// ultimate seo url (added by raid)

define('SEO_ENABLED_TITLE', 'Enable SEO URLs?');
define('SEO_ADD_CPATH_TO_PRODUCT_URLS_TITLE', 'Add cPath to product URLs?');
define('SEO_ADD_SLASH_BEFORE_PRODUCT_ID_TITLE', 'Add slash before product ID in URLs?');
define('SEO_ADD_SLASH_BEFORE_CATEGORY_ID_TITLE', 'Add slash before category ID in URLs?');
define('SEO_ADD_PARENT_CATEGORIES_TO_URL_TITLE', 'Добавить идентификаторы родительских категорий в URL?');
define('SEO_ADD_CAT_PARENT_TITLE', 'Add category parent to begining of URLs?');
define('SEO_URLS_USE_W3C_VALID_TITLE', 'Output W3C valid URLs (parameter string)?');
define('USE_SEO_CACHE_GLOBAL_TITLE', 'Enable SEO cache to save queries?');
define('USE_SEO_CACHE_PRODUCTS_TITLE', 'Enable product cache?');
define('USE_SEO_CACHE_CATEGORIES_TITLE', 'Enable categories cache?');
define('USE_SEO_CACHE_MANUFACTURERS_TITLE', 'Enable manufacturers cache?');
define('USE_SEO_CACHE_ARTICLES_TITLE', 'Enable articles cache?');
define('USE_SEO_CACHE_TOPICS_TITLE', 'Enable topics cache?');
define('USE_SEO_CACHE_INFO_PAGES_TITLE', 'Enable information cache?');
define('USE_SEO_CACHE_LINKS_TITLE', 'Enable link directory cache?');
define('USE_SEO_REDIRECT_TITLE', 'Enable automatic redirects?');
define('SEO_REWRITE_TYPE_TITLE', 'Choose URL Rewrite Type');
define('SEO_URLS_FILTER_SHORT_WORDS_TITLE', 'Filter Short Words');
define('SEO_CHAR_CONVERT_SET_TITLE', 'Enter special character conversions');
define('SEO_REMOVE_ALL_SPEC_CHARS_TITLE', 'Remove all non-alphanumeric characters?');
define('SEO_URLS_CACHE_RESET_TITLE', 'Обнулить кэш для SEO URLs');
define('GOOGLE_SITE_VERIFICATION_KEY_TITLE','Google site verification key');
define('SEO_FILTER_TITLE' , 'Включить SEO фильтры');
define('REVIEWS_WRITE_ACCESS_TITLE' , 'Требовать авторизацию для того, чтобы оставить отзыв');
define('STORE_SCRIPTS_TITLE' , 'Подключение JS скриптов');
define('STORE_METAS_TITLE' , 'Подключение Meta-тегов в head');

define('TABLE_HEADING_CONFIGURATION_TITLE', 'Заголовок');
define('TABLE_HEADING_CONFIGURATION_VALUE', 'Значение');
define('TABLE_HEADING_ACTION', 'Действие');

define('TEXT_INFO_EDIT_INTRO', 'Пожалуйста, внесите необходимые изменения');
define('TEXT_SAVE_BUTTON', 'Сохранить');
define('TEXT_CANCEL_BUTTON', 'Отмена');
define('TEXT_CLOSE_BUTTON', 'Закрыть');
define('TEXT_INFO_DATE_ADDED', 'Дата добавления:');
define('TEXT_INFO_LAST_MODIFIED', 'Последнее изменение:');
define('ERROR_TEMPLATE_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Директория защищена от записи, установите верные права доступа (например chmod 777) для директории ');
define('ERROR_TEMPLATE_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Директория отсутствует, создайте директорию ');

// Мой магазин

define('MYSQL_PERFORMANCE_TRESHOLD_TITLE' , 'Лог медленных запросов, от *сек');
define('MINIFY_CSSJS_TITLE' , 'Сжимать CSS и JS код?');
define('USE_CRITICAL_CSS_TITLE' , 'Использовать критический CSS?');
define('MENU_LOCATION_TITLE' , 'Расположение меню в админке: ');
define('MENU_TOP_LOCATION' , 'Cверху');
define('MENU_LEFT_LOCATION' , 'Cлева');
define('MENU_LEFT_MIN_LOCATION' , 'Cлева свернутое');
define('MINIFY_CSSJS_0_TITLE' , 'Не сжимать');
define('MINIFY_CSSJS_1_TITLE' , 'Сжать сейчас');
define('MINIFY_CSSJS_2_TITLE' , 'Использовать сжатые файлы');
define('IMAGE_CACHE_TITLE', 'Изменить IMAGE_CACHE');
define('IMAGE_CACHE_0_TITLE', 'Выключить');
define('IMAGE_CACHE_1_TITLE', 'Включить');
//define('ALLOW_AUTOLOGON_TITLE', 'Включить автологин');
define('DEFAULT_TEMPLATE_TITLE' , 'Шаблон по умолчанию');
define('LOGO_IMAGE_TITLE' , 'Логотип компании');
define('FAVICON_IMAGE_TITLE','Фавикон');
define('WATER_MARK_TITLE','Водяной знак');
define('STORE_NAME_TITLE' , 'Название магазина');
//define('MULTICOLOR_NAME_TITLE' , 'Название аттрибута (MULTICOLOR)');
define('STORE_OWNER_TITLE' , 'Владелец магазина');
define('STORE_ADDRESS_TITLE' , 'Адрес магазина');
define('STORE_LOGO_TITLE' , 'Логотип магазина');
define('STORE_OWNER_EMAIL_ADDRESS_TITLE' , 'E-Mail Адрес');
define('STORE_OWNER_ICQ_NUMBER_TITLE' , 'ICQ номер');
define('EMAIL_FROM_TITLE' , 'E-Mail От');
define('STORE_COUNTRY_TITLE' , 'Страна');
define('SET_HTTPS_TITLE' , 'Включить HTTPS?');
define('ENABLE_DEBUG_PAGE_SPEED_TITLE', 'Включить дебаг загрузки страницы');
define('SET_WWW_TITLE' , 'Перенаправить на www');
define('WWW_TOO_MANY_REDIRECTS' , 'Слишком много перенаправлений, значение не изменено');
define('STORE_ZONE_TITLE' , 'Регион');
define('EXPECTED_PRODUCTS_SORT_TITLE' , 'Порядок сортировки ожидаемых товаров');
define('EXPECTED_PRODUCTS_FIELD_TITLE' , 'Сортировка ожидаемых товаров');
define('USE_DEFAULT_LANGUAGE_CURRENCY_TITLE' , 'Переключение валюты в зависимости от выбранного языка');
define('SEND_EXTRA_ORDER_EMAILS_TO_TITLE' , 'Отправка копий писем с заказом');
define('SEARCH_ENGINE_FRIENDLY_URLS_TITLE' , 'Использовать короткие URL адреса (находится в разработке)');
define('DISPLAY_CART_TITLE' , 'Переходить в корзину после добавления товара');
define('ALLOW_GUEST_TO_TELL_A_FRIEND_TITLE' , 'Разрешить гостям использовать функцию Рассказать другу');
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_TITLE' , 'Оператор поиска по умолчанию');
define('STORE_NAME_ADDRESS_TITLE' , 'Адрес и телефон магазина');
define('ALLOW_CATEGORY_DESCRIPTIONS_TITLE' , 'Разрешить описания категорий');
define('TAX_DECIMAL_PLACES_TITLE' , 'Количество знаков после запятой у налогов');
define('SHOW_MAIN_FEATURED_PRODUCTS_TITLE' , 'Показывать рекомендуемые товары на главной странице');
define('DISPLAY_PRICE_WITH_TAX_TITLE' , 'Показывать цены с налогами');
define('XPRICES_NUM_TITLE' , 'Количество возможных цен для товара');
//define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_TITLE' , 'Номинал подарочного сертификата, который получат посетители');
define('ALLOW_GUEST_TO_SEE_PRICES_TITLE' , 'Показывать цены незарегистрированным пользователям');
//define('NEW_SIGNUP_DISCOUNT_COUPON_TITLE' , 'Код купона, который получат посетители, прошедшие регистрацию');
define('GUEST_DISCOUNT_TITLE' , 'Наценка для незарегистрированных пользователей');
define('CATEGORIES_SORT_ORDER_TITLE' , 'Сортировка товара, категорий');
define('QUICKSEARCH_IN_DESCRIPTION_TITLE' , 'Поиск в описаниях товара');
define('CONTACT_US_LIST_TITLE' , 'Получатели писем, отправленных со страницы Свяжитесь с нами');
//define('ALLOW_GIFT_VOUCHERS_TITLE' , 'Разрешить использование подарочных сертификатов и купонов');
define('ALLOW_ATTRIBUTES_IN_PRODUCT_EDIT_PAGE_TITLE' , 'Разрешить управление атрибутами на странице добавления товара');
define('SHOW_SUBCATEGORIES_WHEN_CATEGORIES_HAS_PRODUCTS_TITLE' , 'Выводить субкатегории при наличии товара в категории');
define('SHOW_PDF_DATASHEET_TITLE' , 'Показывать PDF описание товара');

// Минимальнаые значения

define('ENTRY_FIRST_NAME_MIN_LENGTH_TITLE' , 'Имя');
define('ENTRY_LAST_NAME_MIN_LENGTH_TITLE' , 'Фамилия');
define('ENTRY_DOB_MIN_LENGTH_TITLE' , 'Дата рождения');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_TITLE' , 'E-Mail адрес');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_TITLE' , 'Адрес');
define('ENTRY_COMPANY_MIN_LENGTH_TITLE' , 'Компания');
define('ENTRY_POSTCODE_MIN_LENGTH_TITLE' , 'Почтовый индекс');
define('ENTRY_CITY_MIN_LENGTH_TITLE' , 'Город');
define('ENTRY_STATE_MIN_LENGTH_TITLE' , 'Регион');
define('ENTRY_TELEPHONE_MIN_LENGTH_TITLE' , 'Телефон');
define('ENTRY_PASSWORD_MIN_LENGTH_TITLE' , 'Пароль');
define('CC_OWNER_MIN_LENGTH_TITLE' , 'Владелец кредитной карточки');
define('CC_NUMBER_MIN_LENGTH_TITLE' , 'Номер кредитной карточки');
define('REVIEW_TEXT_MIN_LENGTH_TITLE' , 'Текст отзыва');
define('MIN_DISPLAY_BESTSELLERS_TITLE' , 'Лидеры продаж');
define('MIN_DISPLAY_ALSO_PURCHASED_TITLE' , 'Также заказали');
define('MIN_DISPLAY_XSELL_TITLE' , 'Связанные товары');
define('MIN_ORDER_TITLE' , 'Минимальная сумма заказа');

// Максимальные значения

define('MAX_PROD_ADMIN_SIDE_TITLE' , 'Товаров на одной странице в администраторской');
define('MAX_ADDRESS_BOOK_ENTRIES_TITLE' , 'Записи в адресной книге');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE' , 'Товаров на одной странице в каталоге');
define('MAX_DISPLAY_PAGE_LINKS_TITLE' , 'Ссылок на страницы');
define('MAX_DISPLAY_SPECIAL_PRODUCTS_TITLE' , 'Специальные цены');
define('MAX_DISPLAY_NEW_PRODUCTS_TITLE' , 'Новинки');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_TITLE' , 'Ожидаемые товары');
define('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST_TITLE' , 'Список производителей');
define('MAX_MANUFACTURERS_LIST_TITLE' , 'Производители в виде развёрнутого меню');
define('MAX_DISPLAY_MANUFACTURER_NAME_LEN_TITLE' , 'Ограничение длины названия производителя');
define('MAX_RANDOM_SELECT_NEW_TITLE' , 'Выбор случайного товара в боксе Новинки');
define('MAX_RANDOM_SELECT_SPECIALS_TITLE' , 'Выбор случайного товара в боксе Скидки');
define('MAX_DISPLAY_CATEGORIES_PER_ROW_TITLE' , 'Количество категорий в строке');
define('MAX_DISPLAY_PRODUCTS_NEW_TITLE' , 'Количество Новинок на странице');
define('MAX_DISPLAY_BESTSELLERS_TITLE' , 'Лидеры продаж');
define('MAX_DISPLAY_ALSO_PURCHASED_TITLE' , 'Также заказали');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_TITLE' , 'Бокс История заказов');
define('MAX_DISPLAY_ORDER_HISTORY_TITLE' , 'История заказов');
define('MAX_DISPLAY_FEATURED_PRODUCTS_TITLE' , 'Товаров в боксе Рекомендуемые товары на главной странице');
define('MAX_DISPLAY_FEATURED_PRODUCTS_LISTING_TITLE' , 'Товаров на одной странице Рекомендуемых товаров');
define('SLIDER_HEIGHT_TITLE' , 'Высота слайдера');


// Картинки

define('SMALL_IMAGE_WIDTH_TITLE' , 'Ширина маленькой картинки');
define('SMALL_IMAGE_HEIGHT_TITLE' , 'Высота маленькой картинки');
define('HEADING_IMAGE_WIDTH_TITLE' , 'Ширина картинки категории');
define('HEADING_IMAGE_HEIGHT_TITLE' , 'Высота картинки категории');
define('SUBCATEGORY_IMAGE_WIDTH_TITLE' , 'Ширина картинки подкатегории');
define('SUBCATEGORY_IMAGE_HEIGHT_TITLE' , 'Высота картинки подкатегории');
define('CONFIG_CALCULATE_IMAGE_SIZE_TITLE' , 'Вычислять размер картинки');
define('IMAGE_REQUIRED_TITLE' , 'Картинка обязательна');
define('ULTIMATE_ADDITIONAL_IMAGES_TITLE' , 'Разрешить использование модуля дополнительных картинок?');
define('ULT_THUMB_IMAGE_WIDTH_TITLE' , 'Ширина дополнительной картинки');
define('ULT_THUMB_IMAGE_HEIGHT_TITLE' , 'Высота дополнительной картинки');
define('MEDIUM_IMAGE_WIDTH_TITLE' , 'Ширина большой картинки');
define('MEDIUM_IMAGE_HEIGHT_TITLE' , 'Высота большой картинки');
define('LARGE_IMAGE_WIDTH_TITLE' , 'Ширина картинки для pop-up окна');
define('LARGE_IMAGE_HEIGHT_TITLE' , 'Высота картинки для pop-up окна');

// Данные покупателя

define('ACCOUNT_GENDER_TITLE', 'Пол');
define('ACCOUNT_DOB_TITLE' , 'Дата рождения');
define('ACCOUNT_COMPANY_TITLE' , 'Компания');
define('ACCOUNT_SUBURB_TITLE' , 'Район');
define('ACCOUNT_STATE_TITLE' , 'Регион');
define('ACCOUNT_STREET_ADDRESS_TITLE' , 'Адрес');
define('ACCOUNT_CITY_TITLE' , 'Город');
define('ACCOUNT_POSTCODE_TITLE' , 'Почтовый индекс');
define('ACCOUNT_COUNTRY_TITLE' , 'Страна');
define('ACCOUNT_TELE_TITLE' , 'Телефон');
define('ACCOUNT_FAX_TITLE' , 'Факс');
define('ACCOUNT_NEWS_TITLE' , 'Рассылка');
define('ACCOUNT_LAST_NAME_TITLE' , 'Фамилия');

// Доставка/упаковка

define('SHIPPING_ORIGIN_COUNTRY_TITLE' , 'Страна магазина');
define('SHIPPING_ORIGIN_ZIP_TITLE' , 'Почтовый индекс магазина');
define('SHIPPING_MAX_WEIGHT_TITLE' , 'Максимальный вес доставки');
define('SHIPPING_BOX_WEIGHT_TITLE' , 'Минимальный вес упаковки');
define('SHIPPING_BOX_PADDING_TITLE' , 'Вес упаковки в процентах'); 
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_TITLE' , 'Разрешить бесплатную доставку');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_TITLE' , 'Бесплатная доставка для заказов на сумму свыше');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_TITLE' , 'Бесплатная доставка для заказов, оформленных из');
define('SHOW_SHIPPING_ESTIMATOR_TITLE' , 'Показывать способы и стоимость доставки в корзине');

// Вывод товара

define('PRODUCT_LISTING_DISPLAY_STYLE_TITLE' , 'Формат вывода товара');
define('PRODUCT_LIST_IMAGE_TITLE' , 'Показывать картинку товара');
define('PRODUCT_LIST_MANUFACTURER_TITLE' , 'Показывать производителя товара');
define('PRODUCT_LIST_MODEL_TITLE' , 'Показывать код товара');
define('PRODUCT_LIST_NAME_TITLE' , 'Показывать название товара');
define('PRODUCT_LIST_PRICE_TITLE' , 'Показывать стоимость товара');
define('PRODUCT_LIST_QUANTITY_TITLE' , 'Показывать количество товара на складе');
define('PRODUCT_LIST_WEIGHT_TITLE' , 'Показывать вес товара');
define('PRODUCT_LIST_BUY_NOW_TITLE' , 'Показывать кнопку Купить сейчас!');
define('PRODUCT_LIST_FILTER_TITLE' , 'Показывать PDF-ссылку');
define('PREV_NEXT_BAR_LOCATION_TITLE' , 'Расположение навигации Следующая/Предыдущая страница');
define('PRODUCT_LIST_INFO_TITLE' , 'Показывать краткое описание');
define('PRODUCT_SORT_ORDER_TITLE' , 'Показывать порядок сортировки');

// Склад

define('STOCK_CHECK_TITLE' , 'Проверять наличие товара на складе');
define('STOCK_SHOW_BUY_BUTTON_TITLE' , 'Показывать кнопку "купить" при отсутствии товара');
define('STOCK_LIMITED_TITLE' , 'Вычитать товар со склада');
define('STOCK_ALLOW_CHECKOUT_TITLE' , 'Разрешить оформление заказа');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_TITLE' , 'Отмечать товар, отсутствующий на складе');
define('STOCK_REORDER_LEVEL_TITLE' , 'Лимит количества товара на складе');

// Логи

define('STORE_PAGE_PARSE_TIME_TITLE' , 'Сохранять время парсинга страниц');
define('STORE_PAGE_PARSE_TIME_LOG_TITLE' , 'Директория хранения логов');
define('STORE_PARSE_DATE_TIME_FORMAT_TITLE' , 'Формат даты логов');
define('DISPLAY_PAGE_PARSE_TIME_TITLE' , 'Показывать время парсинга страниц');
define('STORE_DB_TRANSACTIONS_TITLE' , 'Сохранять запросы к базе дынных');

// Кэш

define('USE_CACHE_TITLE' , 'Использовать кэш');
define('DIR_FS_CACHE_TITLE' , 'Кэш директория');

// Настройка E-Mail

define('EMAIL_TRANSPORT_TITLE' , 'Способ отправки E-Mail');
define('EMAIL_LINEFEED_TITLE' , 'Разделитель строк в E-Mail');
define('EMAIL_USE_HTML_TITLE' , 'Использовать HTML формат при отправке писем');
define('ENTRY_EMAIL_ADDRESS_CHECK_TITLE' , 'Проверять E-Mail адрес через DNS');
define('SEND_EMAILS_TITLE' , 'Отправлять письма из магазина');

// Скачивание

define('DOWNLOAD_ENABLED_TITLE' , 'Разрешить функцию скачивания товаров');
define('DOWNLOAD_BY_REDIRECT_TITLE' , 'Использовать перенаправление при скачивании');
define('DOWNLOAD_MAX_DAYS_TITLE' , 'Срок существования ссылки для скачивания (дней)');
define('DOWNLOAD_MAX_COUNT_TITLE' , 'Максимальное количество скачиваний');
define('DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE_TITLE' , 'Сброс статистики скачиваний');
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG_TITLE' , 'Предупреждением о необходимости оплатить скачиваемый товар');
define('DOWNLOADS_CONTROLLER_ORDERS_STATUS_TITLE' , 'Скачивание разрешается только заказам, имеющим указанный статус');

// GZip Компрессия

define('GZIP_COMPRESSION_TITLE' , 'Разрешить GZip компрессию');
define('GZIP_LEVEL_TITLE' , 'Уровень компрессии');

// Сессии

define('SESSION_WRITE_DIRECTORY_TITLE' , 'Директория сессий');
define('SESSION_FORCE_COOKIE_USE_TITLE' , 'Принудительное использование Cookie');
define('SESSION_CHECK_SSL_SESSION_ID_TITLE' , 'Проверять ID SSL сессии');
define('SESSION_CHECK_USER_AGENT_TITLE' , 'Проверять переменную User Agent');
define('SESSION_CHECK_IP_ADDRESS_TITLE' , 'Проверять IP адрес');
define('SESSION_BLOCK_SPIDERS_TITLE' , 'Не показывать сессию в адресе паукам поисковых машин');
define('SESSION_RECREATE_TITLE' , 'Воссоздавать сессию');

// Тех. обслуживание

define('DOWN_FOR_MAINTENANCE_TITLE' , 'Техническое обслуживание: Вкл./Выкл.');
define('DOWN_FOR_MAINTENANCE_FILENAME_TITLE' , 'Техническое обслуживание: Имя файла');
define('DOWN_FOR_MAINTENANCE_HEADER_OFF_TITLE' , 'Техническое обслуживание: Не показывать шапку');
define('DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF_TITLE' , 'Техническое обслуживание: Не показывать левую колонку');
define('DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF_TITLE' , 'Техническое обслуживание: Не показывать правую колонку');
define('DOWN_FOR_MAINTENANCE_FOOTER_OFF_TITLE' , 'Техническое обслуживание: Не показывать нижнюю часть');
define('DOWN_FOR_MAINTENANCE_PRICES_OFF_TITLE' , 'Техническое обслуживание: Не показывать цены');
define('EXCLUDE_ADMIN_IP_FOR_MAINTENANCE_TITLE' , 'Техническое обслуживание: Исключить указанный IP адрес');
define('WARN_BEFORE_DOWN_FOR_MAINTENANCE_TITLE' , 'Уведомлять посетителей магазина перед уходом на Техническое обслуживание');
define('PERIOD_BEFORE_DOWN_FOR_MAINTENANCE_TITLE' , 'Текст уведомления');
define('DISPLAY_MAINTENANCE_TIME_TITLE' , 'Показывать дату активации режима Техническое обслуживание');
define('DISPLAY_MAINTENANCE_PERIOD_TITLE' , 'Показывать период работы режима Техническое обслуживание');
define('TEXT_MAINTENANCE_PERIOD_TIME_TITLE' , 'Время работы режима Техническое обслуживание');

// Оновлення Прайсу

define('DISPLAY_MODEL_TITLE' , 'Показывать код товара');
define('MODIFY_MODEL_TITLE' , 'Показывать код товара');
define('MODIFY_NAME_TITLE' , 'Показывать название товара');
define('DISPLAY_STATUT_TITLE' , 'Показывать статус товара');
define('DISPLAY_WEIGHT_TITLE' , 'Показывать вес товара');
define('DISPLAY_QUANTITY_TITLE' , 'Показывать количество товара');
define('DISPLAY_SORT_ORDER_TITLE' , 'Показывать порядок сортировки');
define('DISPLAY_ORDER_MIN_TITLE' , 'Показывать минимум для заказа');
define('DISPLAY_ORDER_UNITS_TITLE' , 'Показывать шаг');
define('DISPLAY_IMAGE_TITLE' , 'Показывать картинку товара');
define('DISPLAY_MANUFACTURER_TITLE' , 'Показывать производителя');
define('MODIFY_MANUFACTURER_TITLE' , 'Показывать производителей товара');
define('DISPLAY_TAX_TITLE' , 'Показывать налог');
define('MODIFY_TAX_TITLE' , 'Показывать налог');
define('DISPLAY_TVA_OVER_TITLE' , 'Показывать цены с налогами');
define('DISPLAY_TVA_UP_TITLE' , 'Показывать цены с налогами при изменении цены');
define('DISPLAY_PREVIEW_TITLE' , 'Показывать ссылку на описание товара');
define('DISPLAY_EDIT_TITLE' , 'Показывать ссылку на редактирование товара');
define('ACTIVATE_COMMERCIAL_MARGIN_TITLE' , 'Показывать возможность массового изменения цен');

// Отложенные товары

define('MAX_DISPLAY_WISHLIST_PRODUCTS_TITLE' , 'Количество отложенных товаров на странице');
define('MAX_DISPLAY_WISHLIST_BOX_TITLE' , 'Количество отложенных товаров в боксе');
define('DISPLAY_WISHLIST_EMAILS_TITLE' , 'Количество e-mail адресов');
define('WISHLIST_REDIRECT_TITLE' , 'Оставаться на странице карточки товара');

// Кэш страниц

define('ENABLE_PAGE_CACHE_TITLE' , 'Разрешить кэширование страниц');
define('PAGE_CACHE_LIFETIME_TITLE' , 'Срок жизни кэша');
define('PAGE_CACHE_DEBUG_MODE_TITLE' , 'Включить режим отладки?');
define('PAGE_CACHE_DISABLE_PARAMETERS_TITLE' , 'Отключать URL параметры?');
define('PAGE_CACHE_DELETE_FILES_TITLE' , 'Удалять кэш файлы?');
define('PAGE_CACHE_UPDATE_CONFIG_FILES_TITLE' , 'Настроить обновление кэш файлов?');

// Яндекс маркет

define('YML_NAME_TITLE' , 'Название магазина');
define('YML_COMPANY_TITLE' , 'Название компании');
define('YML_DELIVERYINCLUDED_TITLE' , 'Доставка включена');
define('YML_AVAILABLE_TITLE' , 'Товар в наличии');
define('YML_AUTH_USER_TITLE' , 'Логин');
define('YML_AUTH_PW_TITLE' , 'Пароль');
define('YML_REFERER_TITLE' , 'Ссылка');
define('YML_STRIP_TAGS_TITLE' , 'Теги');
define('YML_UTF8_TITLE' , 'Перекодировка в UTF-8');

// Описание полей

// Мой магазин

define('DEFAULT_TEMPLATE_DESC', 'Здесь Вы можете указать шаблон, используемый в магазине по умолчанию.');
define('STORE_NAME_DESC', 'Название Вашего магазина');
define('STORE_OWNER_DESC', 'Имя владельца магазина');
define('STORE_LOGO_DESC', 'Укажите логотип Вашего магазина');
define('STORE_OWNER_EMAIL_ADDRESS_DESC', 'E-Mail адрес владельца магазина');
define('STORE_OWNER_ICQ_NUMBER_DESC', 'ICQ номер, который будет выведен в боксе Консультант в магазине.');
define('EMAIL_FROM_DESC', 'E-Mail адрес в отправляемых письмах');
define('STORE_COUNTRY_DESC', 'Страна находения магазина.<br><br><b>Примечание: Не забудьте также указать Зону.</b>');
define('SET_HTTPS_DESC' , 'HTTP или HTTPS');
define('STORE_ZONE_DESC', 'Регион нахождения магазина');
define('EXPECTED_PRODUCTS_SORT_DESC', 'Укажите порядок сортировки для ожидаемых товаров, по возрастанию - asc или по убыванию - desc.');
define('EXPECTED_PRODUCTS_FIELD_DESC', 'По какому значению будут сортироваться ожидаемые товары.');
define('USE_DEFAULT_LANGUAGE_CURRENCY_DESC', 'Автоматическое переключение цен в магазине на валюту текущего языка.');
define('SEND_EXTRA_ORDER_EMAILS_TO_DESC', 'Если Вы хотите получать письма с заказами, т.е. такие же письма, что и получает клиент после оформления заказа, укажите e-mail адрес для получения копий писем в следующем формате: Имя 1 &lt;email@address1&gt;, Имя 2 &lt;email@address2&gt;');
define('SEARCH_ENGINE_FRIENDLY_URLS_DESC', 'Использовать короткие URL адреса в магазине');
define('DISPLAY_CART_DESC', 'Переходить в корзину после добавления товара в корзину или оставаться на той же странице.');
define('ALLOW_GUEST_TO_TELL_A_FRIEND_DESC', 'Позволить гостям использовать функцию магазина Рассказать другу, если нет, то данной функцией могут пользоваться только зарегистрированные пользователи магазина.');
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_DESC', 'Укажите, какой оператор будет использоваться по умолчанию при осуществлении посетителем поиска в магазине.');
define('STORE_NAME_ADDRESS_DESC', 'Здесь Вы можете указать адрес и телефон магазина');
define('SHOW_COUNTS_DESC', 'Показывает количество товара в каждой категории. При большом количестве товара в магазина рекомендуется отключать счётчик - false, чтобы снизить нагрузку на MySQL сервер, тем самых скорость загрузки страницы Вашего магазина увеличится.');
define('ALLOW_CATEGORY_DESCRIPTIONS_DESC', 'Разрешить добавление описаний для категорий.');
define('TAX_DECIMAL_PLACES_DESC', 'Количество знаков после целого числа у налогов.');
define('SHOW_MAIN_FEATURED_PRODUCTS_DESC', 'true - Показывать<br>false - Не показывать');
define('DISPLAY_PRICE_WITH_TAX_DESC', 'Показывать цены в магазине с налогами (true) или показывать налог только на заключительном этапе оформления заказа (false)');

define('XPRICES_NUM_DESC', 'Здесь Вы можете указать, какое количество цен может иметь каждый товар<br><br>Например, Вы можете покупателям из группы Покупатели показывать одну цену товара, покупателям из группы Оптовики - показывать другую.');
define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_DESC', 'Если Вы не хотите отправлять подарочный сертификат зарегистрированным в магазине покупателям, укажите 0. Чтобы отправлять зарегистрированным покупателям сертификат, например, номиналом в 10$ - укажите 10, если 25.5$ - укажите 25.5 и т.д.');
define('ALLOW_GUEST_TO_SEE_PRICES_DESC', 'Если стоит false, то цены в магазине могут видеть только зарегистрированные посетители, если true - все посетители могут видеть цены в магазине.');
define('NEW_SIGNUP_DISCOUNT_COUPON_DESC', 'Если Вы не хотите давать купон посетителям, прошедшим регистрацию, просто оставьте поле пустым, либо укажите код существующего купона, который Вы хотите давать всем зарегистрированным покупателям.');
define('GUEST_DISCOUNT_DESC', 'Наценка для простых посетителей магазина. Для зарегистрированных в магазине посетителей данная опция не действует. Указывайте наценку в процентах. Например укажите 10, это значит, что для простых посетителей все цены в магазине будут на 10% выше чем для зарегистрированных посетителей.');
define('CATEGORIES_SORT_ORDER_DESC', '<b>Возможные значения:<br>products_name<br>products_name-desc<br>model<br>model-desc</b>');
define('QUICKSEARCH_IN_DESCRIPTION_DESC', 'При поиске товара с помощью бокса быстрый поиск, Вы можете указать, как искать товары, только по названиям - FALSE или искать в названиях + описаниях - TRUE');
define('CONTACT_US_LIST_DESC', 'Вы можете указать разных получателей на странице Свяжитесь с нами. Формат записи: Имя 1 &lt;email@address1&gt;, Имя 2 &lt;email@address2&gt;. Если Вы хотите оставить всего одного получателя писем, просто оставьте поле пустым.');
define('ALLOW_GIFT_VOUCHERS_DESC', 'Вы можете включить - true или выключить - false возможность использования подарочных сертификатов и купонов при оформлении заказа.');
define('ALLOW_ATTRIBUTES_IN_PRODUCT_EDIT_PAGE_DESC', 'Вы можете включить - true или выключить - false возможность управления атрибутами товаров прямо на странице добавления/редактирования товаров.');
define('SHOW_SUBCATEGORIES_WHEN_CATEGORIES_HAS_PRODUCTS_DESC', 'Если в категории есть товар и в данной категории есть субкатегории, то по умолчанию (true), зайдя в такую категорию, Вы увидите список субкатегорий и список товаров категории. Можно отключить вывод субкатегорий, для этого поставьте false.');
define('SHOW_PDF_DATASHEET_DESC', 'Показывать (true) или нет (false) PDF описание товара на странице описания товара.');

// Минимальнаые значения

define('ENTRY_FIRST_NAME_MIN_LENGTH_DESC', 'Минимальное количество символов поля Имя');
define('ENTRY_LAST_NAME_MIN_LENGTH_DESC', 'Минимальное количество символов поля Фамилия');
define('ENTRY_DOB_MIN_LENGTH_DESC', 'Минимальное количество символов поля Дата рождения');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_DESC', 'Минимальное количество символов поля E-Mail адрес');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_DESC', 'Минимальное количество символов поля Адрес');
define('ENTRY_COMPANY_MIN_LENGTH_DESC', 'Минимальное количество символов поля Компания');
define('ENTRY_POSTCODE_MIN_LENGTH_DESC', 'Минимальное количество символов поля Почтовый индекс');
define('ENTRY_CITY_MIN_LENGTH_DESC', 'Минимальное количество символов поля Город');
define('ENTRY_STATE_MIN_LENGTH_DESC', 'Минимальное количество символов поля Регион');
define('ENTRY_TELEPHONE_MIN_LENGTH_DESC', 'Минимальное количество символов поля Телефон');
define('ENTRY_PASSWORD_MIN_LENGTH_DESC', 'Минимальное количество символов поля Пароль');
define('CC_OWNER_MIN_LENGTH_DESC', 'Минимальное количество символов поля Владелец кредитной карточки');
define('CC_NUMBER_MIN_LENGTH_DESC', 'Минимальное количество символов поля Номер кредитной карточки');
define('REVIEW_TEXT_MIN_LENGTH_DESC', 'Минимальное количество символов для отызов');
define('MIN_DISPLAY_BESTSELLERS_DESC', 'Минимальное количество товара, выводимого в блоке Лидеры продаж');
define('MIN_DISPLAY_ALSO_PURCHASED_DESC', 'Минимальное количество товара, выводимого в боксе Также заказали');
define('MIN_DISPLAY_XSELL_DESC', 'Минимальное количество товаров, выводимых в боксе Связанные товары');
define('MIN_ORDER_DESC', 'Если сумма заказа будет меньше указанной, такой заказ нельзя будет оформить. Указывайте просто число, без симолов валюты ($, руб. и т.д.). Поставьте 0, если Вы не хотите ограничивать минимальную сумму заказа.');

// Максимальные значения

define('MAX_PROD_ADMIN_SIDE_DESC', 'Количество товара на одной странице в администраторской');

define('MAX_ADDRESS_BOOK_ENTRIES_DESC', 'Максимальное количество записей, которые может сделать покупатель в своей адресной книге');
define('MAX_DISPLAY_SEARCH_RESULTS_DESC', 'Количество товара, выводимого на одной странице');
define('MAX_DISPLAY_PAGE_LINKS_DESC', 'Количество ссылок на другие страницы');
define('MAX_DISPLAY_SPECIAL_PRODUCTS_DESC', 'Максимальное количество товара, выводимого на странице Скидки');
define('MAX_DISPLAY_NEW_PRODUCTS_DESC', 'Максимальное количество товара, выводимых в боксе Новинки');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_DESC', 'Максимальное количество товара, выводимого в блоке Ожидаемые товары');
define('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST_DESC', 'Данная опция используется для настройки бокса производителей, если число производителей превышает указанное в данной опции, список производителей будет выводиться в виде drop-down списка, если число производителей меньше указанного в данной опции, производители будут выводиться в виде списка.');
define('MAX_MANUFACTURERS_LIST_DESC', 'Данная опция используется для настройки бокса производителей, если указана цифра \'1\', то список производителей выводится в виде стандартного drop-down списка. Если указана любая другая цифра, то выводится только X производителей в виде развёрнутого меню.');
define('MAX_DISPLAY_MANUFACTURER_NAME_LEN_DESC', 'Данная опция используется для настройки бокса производителей, Вы указываете количество символов, выводимого в боксе производителей, если название производителя будет состоять из большего количества символов, то будут выведены первые X символов названия');
define('MAX_RANDOM_SELECT_NEW_DESC', 'Количество товара, среди которого будет выбран случайный товар и выведен в бокс Новинок, т.е. если указано число X, то новый товар, который будет показан в боксе Новинок будет выбран из этих X новых товаров');
define('MAX_RANDOM_SELECT_SPECIALS_DESC', 'Количество товара, среди которого будет выбран случайный товар и выведен в бокс Скидки, т.е. если указано число X, то товар, который будет показан в боксе Скидки будет выбран из этих X товаров');
define('MAX_DISPLAY_CATEGORIES_PER_ROW_DESC', 'Сколько категорий выводить в одной строке');
define('MAX_DISPLAY_PRODUCTS_NEW_DESC', 'Максимальное количество новинок, выводимых на одной странице в разделе Новинки');
define('MAX_DISPLAY_BESTSELLERS_DESC', 'Максимальное количество лидеров продаж, выводимых в боксе Лидеры продаж');
define('MAX_DISPLAY_ALSO_PURCHASED_DESC', 'Максимальное количество товаров в боксе Наши покупатели также заказали');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_DESC', 'Максимальное количество товаров, выводимых в боксе История заказов');
define('MAX_DISPLAY_ORDER_HISTORY_DESC', 'Максимальное количество заказов, выводимых на странице История заказов');
define('MAX_DISPLAY_FEATURED_PRODUCTS_DESC', 'Максимальное количество товара в боксе Рекомендуемые товары на главной странице');
define('MAX_DISPLAY_FEATURED_PRODUCTS_LISTING_DESC', 'Количество товара на одной странице Рекомендуемых товаров');

// Картинки

define('SMALL_IMAGE_WIDTH_DESC', 'Ширина картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать ширину картинки. Ограничение ширины картинки не значит физического уменьшения размеров картинки.');
define('SMALL_IMAGE_HEIGHT_DESC', 'Высота картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать высоту картинки. Ограничение высоты картинки не значит физического уменьшения размеров картинки.');
define('HEADING_IMAGE_WIDTH_DESC', 'Ширина картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать ширину картинки. Ограничение ширины картинки не значит физического уменьшения размеров картинки.');
define('HEADING_IMAGE_HEIGHT_DESC', 'Высота картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать высоту картинки. Ограничение высоты картинки не значит физического уменьшения размеров картинки.');
define('SUBCATEGORY_IMAGE_WIDTH_DESC', 'Ширина картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать ширину картинки. Ограничение ширины картинки не значит физического уменьшения размеров картинки.');
define('SUBCATEGORY_IMAGE_HEIGHT_DESC', 'Высота картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать высоту картинки. Ограничение высоты картинки не значит физического уменьшения размеров картинки.');
define('CONFIG_CALCULATE_IMAGE_SIZE_DESC', 'Данная опция просто смотрит переменные, указанные выше и сжимает картинку до указанных размеров, это не значит, что физический размер картинки уменьшится, происходит принудительный вывод картинки определённого размера. Рекомендуется ставить значение false');
define('IMAGE_REQUIRED_DESC', 'Необходимо для поиска ошибок, в случае, если картинка не выводится.');
define('ULTIMATE_ADDITIONAL_IMAGES_DESC', 'Вы можете включить/выключить модуль дополнительных картинок для товара.');
define('ULT_THUMB_IMAGE_WIDTH_DESC', 'Ширина дополнительной картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать ширину картинки. Ограничение ширины картинки не значит физического уменьшения размеров картинки.');
define('ULT_THUMB_IMAGE_HEIGHT_DESC', 'Высота дополнительной картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать высоту картинки. Ограничение высоты картинки не значит физического уменьшения размеров картинки.');
define('MEDIUM_IMAGE_WIDTH_DESC', 'Ширина большой картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать ширину большой картинки. Ограничение ширины большой картинки не значит физического уменьшения размеров картинки.');
define('MEDIUM_IMAGE_HEIGHT_DESC', 'Высота большой картинки в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать высоту большой картинки. Ограничение высоты большой картинки не значит физического уменьшения размеров картинки.');
define('LARGE_IMAGE_WIDTH_DESC', 'Ширина картинки для pop-up окна в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать ширину картинки для pop-up окна. Ограничение ширины картинки для pop-up окна не значит физического уменьшения размеров картинки.');
define('LARGE_IMAGE_HEIGHT_DESC', 'Высота картинки для pop-up окна в пикселах. Оставьте поле пустым или поставьте 0, если не хотите ограничивать высоту картинки для pop-up окна. Ограничение высоты картинки для pop-up окна не значит физического уменьшения размеров картинки.');

// Данные покупателя

define('ACCOUNT_DOB_DESC', 'Показывать поле Дата рождения при регистрации покупателя в магазине и в адресной книге');
define('ACCOUNT_COMPANY_DESC', 'Показывать поле Компания при регистрации покупателя в магазине и в адресной книге');
define('ACCOUNT_SUBURB_DESC', 'Показывать поле Район при регистрации покупателя в магазине и в адресной книге');
define('ACCOUNT_STATE_DESC', 'Показывать поле Регион при регистрации покупателя в магазине и в адресной книге');
define('ACCOUNT_STREET_ADDRESS_DESC', 'Показывать поле Адрес при регистрации покупателя в магазине и в адресной книге');
define('ACCOUNT_CITY_DESC', 'Показывать поле Город при регистрации покупателя в магазине и в адресной книге');
define('ACCOUNT_POSTCODE_DESC', 'Показывать поле Почтовый индекс при регистрации покупателя в магазине и в адресной книге');
define('ACCOUNT_COUNTRY_DESC', 'Показывать поле Страна при регистрации покупателя в магазине и в адресной книге');
define('ACCOUNT_TELE_DESC', 'Показывать поле Телефон при регистрации покупателя в магазине и в адресной книге');
define('ACCOUNT_FAX_DESC', 'Показывать поле Факс при регистрации покупателя в магазине и в адресной книге');
define('ACCOUNT_NEWS_DESC', 'Показывать поле Рассылка при регистрации покупателя в магазине и в адресной книге');
define('ACCOUNT_LAST_NAME_DESC', 'Показывать поле Фамилия при регистрации покупателя в магазине и в адресной книге');
// Доставка/упаковка

define('SHIPPING_ORIGIN_COUNTRY_DESC', 'Страна, где находится магазин. Необходимо для некоторых модулей доставки.');
define('SHIPPING_ORIGIN_ZIP_DESC', 'Укажите почтовый индекс магазина. Необходимо для некоторых модулей доставки.');
define('SHIPPING_MAX_WEIGHT_DESC', 'Вы можете указать максимальный вес доставки, свыше которого заказы не доставляются. Необходимо для некоторых модулей доставки.');
define('SHIPPING_BOX_WEIGHT_DESC', 'Вы можете указать вес упаковки.');
define('SHIPPING_BOX_PADDING_DESC', 'Доставка заказов, вес которых больше указанного в переменной Максимальный вес доставки, увеличивается на указанный процент. Если Вы хотите увелить стоимость на 10%, пишите - 10');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_DESC', 'Вы хотите разрешить использование модуля бесплатной доставки?');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_DESC', 'Заказы, свыше суммы, указанной данной поле, будут доставляться бесплатно.');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_DESC', 'national - заказы из страны нахождения магазина(переменная Страна магазина), international - заказы из любой страны, кроме страны нахождения магазина, если both - тогда все заказы. При условии, что сумма заказы выше суммы, указанной в переменной выше.');
define('SHOW_SHIPPING_ESTIMATOR_DESC', 'Показывать информацию о способах и стоимости доставки в корзине?<br>true - показывать.<br>false - не показывать.');

// Вывод товара

define('PRODUCT_LISTING_DISPLAY_STYLE_DESC', 'Вы можете выбрать, в каком формате выводить товар, в виде таблицы - list, либо в столбец - columns.');
define('PRODUCT_LIST_IMAGE_DESC', 'Укажите порядок вывода, т.е. введите цифру. Если укажите 1, то картинка будет слева на первом месте, если 2, то картинка будет показана после(правее) поля, у которого указана цифра 1 и т.д.');
define('PRODUCT_LIST_MANUFACTURER_DESC', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д.');
define('PRODUCT_LIST_MODEL_DESC', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д.');
define('PRODUCT_LIST_NAME_DESC', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д.');
define('PRODUCT_LIST_PRICE_DESC', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д.');
define('PRODUCT_LIST_QUANTITY_DESC', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д.');
define('PRODUCT_LIST_WEIGHT_DESC', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д.');
define('PRODUCT_LIST_BUY_NOW_DESC', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д.');
define('PRODUCT_LIST_FILTER_DESC', 'Показывать бокс(drop-down) меню, с помощью которого можно сортировать товар в какой-либо категории магазина по Производителю.');
define('PREV_NEXT_BAR_LOCATION_DESC', 'Установите расположение навигации Следующая/Предыдущая страница (1-верх, 2-низ, 3-верх+низ)');
define('PRODUCT_LIST_INFO_DESC', 'Если Вы укажите 0, тогда краткое описание показываться не будет, если 1-99 - краткое описание будет показываться, но только если краткое описание было добавлено при добавлении товара.');
define('PRODUCT_SORT_ORDER_DESC', 'Укажите порядок вывода данного поля в Вашем магазине, т.е. введите цифру. Если укажите 1, то данное поле будет слева на первом месте, если 2, то поле будет показана после(правее) поля, у которого указана цифра 1 и т.д. 0 - значит не показывать данное поле');

// Склад

define('STOCK_CHECK_DESC', 'Проверять, есть ли необходимое количество товара на складе при оформлении заказа');
define('STOCK_LIMITED_DESC', 'Вычитать со склада то количество товара, которое будет заказываться в интернет-магазине');
define('STOCK_ALLOW_CHECKOUT_DESC', 'Разрешить покупателям оформлять заказ, даже если на складе нет достаточного количества единиц заказываемого товара');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_DESC', 'Показывать покупателю маркер напротив товара при оформлении заказа, если на складе нет необходимого количества единиц заказываемого товара');
define('STOCK_REORDER_LEVEL_DESC', 'Если количество товара на складе меньше, чем указанное число в данной переменной, то в корзине выводится предупреждение о недостаточном количестве товара на складе для выполнения заказа.');

// Логи

define('STORE_PAGE_PARSE_TIME_DESC', 'Хранить время, затраченное на генерацию(парсинг) страниц магазина.');
define('STORE_PAGE_PARSE_TIME_LOG_DESC', 'Полный путь до директории и файла, в который будет записываться лог парсинга страниц.');
define('STORE_PARSE_DATE_TIME_FORMAT_DESC', 'Формат даты');
define('DISPLAY_PAGE_PARSE_TIME_DESC', 'Показывать время парсинга страницы в интернет-магазине (опция Сохранять время парсинга страниц должна быть включена)');
define('STORE_DB_TRANSACTIONS_DESC', 'Сохранять все запросы к базе данных в файле, указанном в переменной Директория хранение логов (только для PHP4 и выше)');

// Кэш

define('USE_CACHE_DESC', 'Использовать кэширование информации.');
define('DIR_FS_CACHE_DESC', 'Директория, куда будут записываться и сохраняться кэш-файлы.');

// Настройка E-Mail

define('EMAIL_TRANSPORT_DESC', 'Укажите, какой способ отправки писем из магазина будет использоваться. Для серверов, работающих под управлением Windows или MacOS необходимо установить SMTP для отправки писем.');
define('EMAIL_LINEFEED_DESC', 'Используемая последовательность символов для разделения заголовков в письме.');
define('EMAIL_USE_HTML_DESC', 'Отправлять письма из магазина в HTML формате.');
define('ENTRY_EMAIL_ADDRESS_CHECK_DESC', 'Проверять, верные ли e-mail адреса указываются при регистрации в интернет-магазине. Для проверки используется DNS.');
define('SEND_EMAILS_DESC', 'Отправлять письма из магазина.');

// Скачивание

define('DOWNLOAD_ENABLED_DESC', 'Разрешить функцию скачивания товаров.');
define('DOWNLOAD_BY_REDIRECT_DESC', 'Использовать перенаправление в браузере для скачивания товара. Для не Unix систем(Windows, Mac OS и т.д.) должно стоять false.');
define('DOWNLOAD_MAX_DAYS_DESC', 'Установите количество дней, в течение которых покупатель может скачать свой товар. Если укажите 0, тогда срок существования ссылки для скачивания ограничен не будет.');
define('DOWNLOAD_MAX_COUNT_DESC', 'Установите максимальное количество скачиваний для одного товара. Если укажите 0, тогда никаких ограничений по количеству скачиваний не будет.');
define('DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE_DESC', 'Какой ID номер статуса заказа сбрасывает переменные Срок существования ссылки для скачивания (дней) и Максимальное количество скачиваний - По умолчанию Доставляется (id код 4).');
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG_DESC', 'Вы можете указать сообщение, которое будет показано клиенту, в случае, если он захочет скачать ещё неоплаченный товар.');
define('DOWNLOADS_CONTROLLER_ORDERS_STATUS_DESC', 'Скачивание файла (файлов) будет разрешено только в случае, если заказ будет иметь указанный статус (а именно id код статуса заказа). По умолчанию скачивание разрешено для заказов со статусом ждём оплаты (id код 2).');

// GZip Компрессия

define('GZIP_COMPRESSION_DESC', 'Разрешить HTTP GZip компрессию.');
define('GZIP_LEVEL_DESC', 'Вы можете указать уровень компрессии от 0 до 9 (0 = минимум, 9 = максимум).');

// Сессии

define('SESSION_WRITE_DIRECTORY_DESC', 'Если сессии хранятся в файлах, то здесь необходимо указать полный путь до папки, в которой будут храниться файлы сессий.');
define('SESSION_FORCE_COOKIE_USE_DESC', 'Принудительно использовать сессии, только когда в браузере активированы cookies.');
define('SESSION_CHECK_SSL_SESSION_ID_DESC', 'Проверять  SSL_SESSION_ID при каждом обращении к странице, защищённой протоколом HTTPS.');
define('SESSION_CHECK_USER_AGENT_DESC', 'Проверять переменную бразура user agent при каждом обращении к страницам интернет-магазина.');
define('SESSION_CHECK_IP_ADDRESS_DESC', 'Проверять IP адреса клиентов при каждом обращении к страницам интернет-магазина.');
define('SESSION_BLOCK_SPIDERS_DESC', 'Не показывать сессию в адресе при обращении к станицам магазина известных поисковых пауков. Список известных пауков находится в файле includes/spiders.txt.');
define('SESSION_RECREATE_DESC', 'Воссоздавать сессию для генерации нового ID кода сессии при входе зарегистрированного покупателя в магазин, либо при регистрации нового покупателя (Только для PHP 4.1 и выше).');

// Тех. обслуживание

define('DOWN_FOR_MAINTENANCE_DESC', 'Техническое обслуживание. Если включено, то в магазине нельзя будет делать заказы и будет выведено предупреждение о проведении технического обслуживания магазина.<br>true - Включено<br>false - Выключено');
define('DOWN_FOR_MAINTENANCE_FILENAME_DESC', 'Файл, который будет показан в магазине, если включено Техническое обслуживание магазина. По умолчанию - down_for_maintenance.php');
define('DOWN_FOR_MAINTENANCE_HEADER_OFF_DESC', 'При включённом техническом обслуживании Вы можете запретить показывать шапку магазина<br>true - Не показывать<Br>false - Показывать');
define('DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF_DESC', 'При включённом техническом обслуживании Вы можете запретить показывать левую колонку магазина<br>true - Не показывать<Br>false - Показывать');
define('DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF_DESC', 'При включённом техническом обслуживании Вы можете запретить показывать правую колонку магазина<br>true - Не показывать<Br>false - Показывать');
define('DOWN_FOR_MAINTENANCE_FOOTER_OFF_DESC', 'При включённом техническом обслуживании Вы можете запретить показывать нижнюю часть магазина<br>true - Не показывать<Br>false - Показывать');
define('DOWN_FOR_MAINTENANCE_PRICES_OFF_DESC', 'При включённом техническом обслуживании Вы можете запретить показывать цены на товары в магазине<br>true - Не показывать<Br>false - Показывать');
define('EXCLUDE_ADMIN_IP_FOR_MAINTENANCE_DESC', 'Для указанного IP адреса магазин будет доступен даже при включённом режиме Техническое обслуживание. Обычно здесь указывает IP адрес администратора магазина.');
define('WARN_BEFORE_DOWN_FOR_MAINTENANCE_DESC', 'Предупреждать посетителей перед уходом на техническое обслуживание. Если техническое обслуживание уже включено, то данная опция автоматически устанавливается в false.');
define('PERIOD_BEFORE_DOWN_FOR_MAINTENANCE_DESC', 'Укажите текст уведомления.');
define('DISPLAY_MAINTENANCE_TIME_DESC', 'Показывать дату активации режима Техническое обслуживание.');
define('DISPLAY_MAINTENANCE_PERIOD_DESC', 'Показывать в течение какого времени магазин будет находиться в режиме Техническое обслуживание.');
define('TEXT_MAINTENANCE_PERIOD_TIME_DESC', 'Укажите время работы магазина в режиме Техническое обслуживание');

// Оновлення Прайсу

define('DISPLAY_MODEL_DESC', 'Показывать/Не показывать код товара');
define('MODIFY_MODEL_DESC', 'Показывать/Не показывать код товара');
define('MODIFY_NAME_DESC', 'Показывать/Не показывать название товара');
define('DISPLAY_STATUT_DESC', 'Показывать/Не показывать статус товара');
define('DISPLAY_WEIGHT_DESC', 'Показывать/Не показывать вес товара');
define('DISPLAY_QUANTITY_DESC', 'Показывать/Не показывать количество товара');
define('DISPLAY_SORT_ORDER_DESC', 'Показывать/Не показывать порядок сортировки');
define('DISPLAY_ORDER_MIN_DESC', 'Показывать/Не показывать минимум для заказа');
define('DISPLAY_ORDER_UNITS_DESC', 'Показывать/Не показывать шаг');
define('DISPLAY_IMAGE_DESC', 'Показывать/Не показывать картинку товара');
define('MODIFY_MANUFACTURER_DESC', 'Показывать/Не показывать производителя товара');
define('MODIFY_TAX_DESC', 'Показывать/Не показывать налог');
define('DISPLAY_TVA_OVER_DESC', 'Показывать/Не показывать цены с налогами');
define('DISPLAY_TVA_UP_DESC', 'Показывать/Не показывать цены с налогами при изменении цены');
define('DISPLAY_PREVIEW_DESC', 'Показывать/Не показывать ссылку на описание товара');
define('DISPLAY_EDIT_DESC', 'Показывать/Не показывать ссылку на редактирование товара');
define('DISPLAY_MANUFACTURER_DESC', 'Показывать/Не показывать производителя');
define('DISPLAY_TAX_DESC', 'Показывать/Не показывать налог');
define('ACTIVATE_COMMERCIAL_MARGIN_DESC', 'Показывать/Не показывать возможность массового  изменения цен');

// Кэш страниц

define('ENABLE_PAGE_CACHE_DESC' , 'Разрешить кэширование страниц? Данная функция помогает снизить нагрузку на сервер и ускорить загрузку страниц.');
define('PAGE_CACHE_LIFETIME_DESC' , 'Как долго кэшировать страницы (в минутах)?');
define('PAGE_CACHE_DEBUG_MODE_DESC' , 'Включить режим отладки (внизу страницы)? Не включайте данную опцию на работающих магазинах! Вы можете включить режим отладки просто добавив к URL адресу параметр ?debug=1');
define('PAGE_CACHE_DISABLE_PARAMETERS_DESC' , 'В некоторых случаях (например, при включённых коротких адресах) или при большом количестве партнёров может привести к чрезмерному использованию дискового пространства.');
define('PAGE_CACHE_DELETE_FILES_DESC' , 'Если установлено в true, то при любом следующем просмотре любой страницы в каталоге, все кэш файлы будут удалены, после этого верните false.');
define('PAGE_CACHE_UPDATE_CONFIG_FILES_DESC' , 'Если у Вас установлен модуль configuration cache, укажите полный (абсолютный) путь до файла обновления.');

// Яндекс маркет

define('YML_NAME_DESC' , 'Название магазина для Яндекс-Маркет. Если поле пустое, то используется STORE_NAME.');
define('YML_COMPANY_DESC' , 'Название компании для Яндекс-Маркет. Если поле пустое, то используется STORE_OWNER.');
define('YML_DELIVERYINCLUDED_DESC' , 'Доставка включена в стоимость товара?');
define('YML_AVAILABLE_DESC' , 'Товар в наличии или под заказ?');
define('YML_AUTH_USER_DESC' , 'Логин для доступа к YML');
define('YML_AUTH_PW_DESC' , 'Пароль для доступа к YML');
define('YML_REFERER_DESC' , 'Добавить в адрес товара параметр с ссылкой на User agent или ip?');
define('YML_STRIP_TAGS_DESC' , 'Убирать html-теги в строках?');
define('YML_UTF8_DESC' , 'Перекодировать в UTF-8?');


//checkout
define('ONEPAGE_CHECKOUT_ENABLED_TITLE', 'Включить проверку одной страницы');
define('ONEPAGE_DEFAULT_COUNTRY_TITLE', 'Default Address Country');
define('ONEPAGE_ACCOUNT_CREATE_TITLE', 'Создание учетной записи');
define('ONEPAGE_SHOW_CUSTOM_COLUMN_TITLE', 'Показать пользовательский правый столбец');
define('ONEPAGE_LOGIN_REQUIRED_TITLE', 'Требовать авторизацию перед оформлением заказа');
define('ONEPAGE_SHOW_OSC_COLUMNS_TITLE', 'Показать столбцы Oscommerce');
define('ONEPAGE_BOX_ONE_HEADING_TITLE', 'Custom Colum Box # 1 Heading');
define('ONEPAGE_BOX_ONE_CONTENT_TITLE', 'Custom Colum Box # 1 Content');
define('ONEPAGE_BOX_TWO_HEADING_TITLE', 'Custom Colum Box # 2 Heading');
define('ONEPAGE_BOX_TWO_CONTENT_TITLE', 'Custom Colum Box # 2 Content');
define('ONEPAGE_DEBUG_EMAIL_ADDRESS_TITLE', 'Отправить отладочные письма для:');
define('ONEPAGE_CHECKOUT_SHOW_ADDRESS_INPUT_FIELDS_TITLE', 'Показать адрес во входных полях');
define('ONEPAGE_CHECKOUT_LOADER_POPUP_TITLE', 'Сделать всплывающее сообщение загрузчика');
define('ONEPAGE_AUTO_SHOW_BILLING_SHIPPING_TITLE', 'Auto-show billing / shipping modules');
define('ONEPAGE_AUTO_SHOW_DEFAULT_COUNTRY_TITLE', 'Автоматическое выставление счетов / отправка по умолчанию страны');
define('ONEPAGE_AUTO_SHOW_DEFAULT_STATE_TITLE', 'Автоматическое выставление счетов / отправка по умолчанию');
define('ONEPAGE_AUTO_SHOW_DEFAULT_ZIP_TITLE', 'Автоматическое выставление счетов / отправка почтового индекса по умолчанию');
define('ONEPAGE_ZIP_BELOW_TITLE', 'Переместить поля ввода почтового индекса / почтового индекса ниже состояния');
define('ONEPAGE_CHECKOUT_HIDE_SHIPPING_TITLE', 'Не показывать флажок отправки и обработки адреса или методы отправки, если вес продуктов = 0');
define('ONEPAGE_ADDR_LAYOUT_TITLE', 'Layles Layout');
define('ONEPAGE_TELEPHONE_TITLE', 'Telephone Required');
define('ONEPAGE_ADDRESS_TYPE_POSITION_TITLE' , 'Порядок адресов');

define('GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED_TITLE', 'Включить модуль Google Analytics и тегов');
define('GOOGLE_TAGS_ID_TITLE', 'Google Tags ID');
define('GOOGLE_TAGS_ID_STATUS_TITLE', 'Google Tags ID status');
define('GOOGLE_GOALS_ADD_TO_CART_TITLE', 'Цели Google добавление в корзину');
define('GOOGLE_GOALS_ON_CHECKOUT_TITLE', 'Цели Google на странице оформления заказа');
define('GOOGLE_GOALS_CHECKOUT_PROCESS_TITLE', 'Цели Google в процессе оформления заказа');
define('GOOGLE_GOALS_CLICK_ON_PHONE_TITLE', 'Цели Google нажатие на иконку телефон');
define('GOOGLE_GOALS_CLICK_ON_CHAT_TITLE', 'Цели Google нажатие на чате');
define('GOOGLE_OAUTH_STATUS_TITLE', 'Авторизация через Google');
define('GOOGLE_OAUTH_CLIENT_ID_TITLE', 'Google CLIENT_ID');
define('GOOGLE_OAUTH_CLIENT_SECRET_TITLE', 'Google CLIENT_SECRET');
define('GOOGLE_RECAPTCHA_STATUS_TITLE',"Google Recaptcha");
define('DEFAULT_CAPTCHA_STATUS_TITLE',"Captcha");

define('FACEBOOK_AUTH_STATUS_TITLE', 'Facebook Авторизация');

define ('RCS_BASE_DAYS_TITLE', 'Просмотр прошлых дней');
define ('RCS_SKIP_DAYS_TITLE', 'Пропустить дни');
define ('RCS_REPORT_DAYS_TITLE', 'Использовать рассчитанные налоги');
define ('RCS_INCLUDE_TAX_IN_PRICES_TITLE', 'Использовать фиксированную налоговую ставку');
define ('RCS_USE_FIXED_TAX_IN_PRICES_TITLE', 'Фиксированная налоговая ставка');
define ('RCS_FIXED_TAX_RATE_TITLE', 'Дни отчета о результатах продаж');
define ('RCS_EMAIL_TTL_TITLE', 'Время жизни электронной почты');
define ('RCS_EMAIL_FRIENDLY_TITLE', 'Дружественные электронные письма');
define ('RCS_EMAIL_COPIES_TO_TITLE', 'Электронная почта копируется в');
define ('RCS_SHOW_ATTRIBUTES_TITLE', 'Показать атрибуты');
define ('RCS_CHECK_SESSIONS_TITLE', 'Игнорировать клиентов с сессиями');
define ('RCS_CURCUST_COLOR_TITLE', 'Текущий клиент');
define ('RCS_UNCONTACTED_COLOR_TITLE', 'Несвязанный Hilight');
define ('RCS_CONTACTED_COLOR_TITLE', "Звонок в сумерках");
define ('RCS_MATCHED_ORDER_COLOR_TITLE', "Соответствующий ордер Hilight");
define ('RCS_SKIP_MATCHED_CARTS_TITLE', 'Пропустить записи с соответствующими заказами');
define ("RCS_AUTO_CHECK_TITLE", 'Автоматическая проверка  безопасных корзин для электронной почты');
define ('RCS_CARTS_MATCH_ALL_DATES_TITLE', 'Совпадение заказов на любую дату');
define ('RCS_PENDING_SALE_STATUS_TITLE', 'Статусы продаж в ожидании');
define ('RCS_REPORT_EVEN_STYLE_TITLE', 'Сообщить о стиле четной строки');
define ('RCS_REPORT_ODD_STYLE_TITLE', 'Стиль нечетной строки отчета');

define ('DEFAULT_DATE_FORMAT_TITLE', "Формат даты по умолчанию");
define ('DEFAULT_FORMATED_DATE_FORMAT_TITLE', "Форматированный заголовок формата даты по умолчанию");

define('DISPLAY_PRICE_WITH_TAX_CHECKOUT_TITLE', 'Считать налог при оформлении заказа');

define('SET_JIVOSITE_TITLE', 'Онлайн консультант');
define('INSTAGRAM_LINK_SLIDE_TITLE', 'Instagram ссылка для слайдера');

define('STORE_BANK_INFO_TITLE', 'Информация о банке для счет-фактуры');
define('CHANGE_BY_GEOLOCATION_TITLE', 'Переключение валюты и языка в зависимости от геолокации');

define('SUB_GROUP_TAXES', 'Taxes');

define('JIVOSITE_WIDGET_ID_TITLE', 'ID виджета JivoSite');