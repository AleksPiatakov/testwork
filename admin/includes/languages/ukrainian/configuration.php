<?php
/*
  $Id: configuration.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

// ultimate seo url (added by raid)

define('SEO_ENABLED_TITLE', 'Enable SEO URLs');
define('SEO_ADD_CPATH_TO_PRODUCT_URLS_TITLE', 'Add cPath to product URLs');
define('SEO_ADD_SLASH_BEFORE_PRODUCT_ID_TITLE', 'Add slash before product ID in URLs');
define('SEO_ADD_SLASH_BEFORE_CATEGORY_ID_TITLE', 'Add slash before category ID in URLs');
define('SEO_ADD_PARENT_CATEGORIES_TO_URL_TITLE', 'Додати ідентифікатори батьківських категорій до URL -адреси');
define('SEO_ADD_CAT_PARENT_TITLE', 'Add category parent to begining of URLs');
define('SEO_URLS_USE_W3C_VALID_TITLE', 'Output W3C valid URLs (parameter string)');
define('USE_SEO_CACHE_GLOBAL_TITLE', 'Enable SEO cache to save queries');
define('USE_SEO_CACHE_PRODUCTS_TITLE', 'Enable product cache');
define('USE_SEO_CACHE_CATEGORIES_TITLE', 'Enable categories cache');
define('USE_SEO_CACHE_MANUFACTURERS_TITLE', 'Enable manufacturers cache');
define('USE_SEO_CACHE_ARTICLES_TITLE', 'Enable articles cache');
define('USE_SEO_CACHE_TOPICS_TITLE', 'Enable topics cache');
define('USE_SEO_CACHE_INFO_PAGES_TITLE', 'Enable information cache');
define('GOOGLE_SITE_VERIFICATION_KEY_TITLE', 'Google site verification key');
define('USE_SEO_CACHE_LINKS_TITLE', 'Enable link directory cache');
define('USE_SEO_REDIRECT_TITLE', 'Enable automatic redirects');
define('SEO_REWRITE_TYPE_TITLE', 'Choose URL Rewrite Type');
define('SEO_URLS_FILTER_SHORT_WORDS_TITLE', 'Filter Short Words');
define('ONEPAGE_ADDRESS_TYPE_POSITION_TITLE' , 'Порядок адрес');
define('SEO_CHAR_CONVERT_SET_TITLE', 'Enter special character conversions');
define('SEO_REMOVE_ALL_SPEC_CHARS_TITLE', 'Remove all non-alphanumeric characters');
define('SEO_URLS_CACHE_RESET_TITLE', 'Обнулити кеш для SEO URLs');
define('SEO_FILTER_TITLE' , 'Ввімкнути SEO фільтри');

define('REVIEWS_WRITE_ACCESS_TITLE' , 'Вимагати авторизацію для того, щоб залишити відгук');


define('TABLE_HEADING_CONFIGURATION_TITLE', 'Заголовок');
define('TABLE_HEADING_CONFIGURATION_SHOW_FIELD', 'Показувати поле');
define('TABLE_HEADING_CONFIGURATION_VALUE', 'Значення');
define('TABLE_HEADING_CONFIGURATION_REQUIRED_VALUE', 'Обов\'язковість');
define('TABLE_HEADING_ACTION', 'Дія');
define ('USE_CRITICAL_CSS_TITLE', 'Використовувати критичний CSS');
define('TEXT_INFO_EDIT_INTRO', 'Будь ласка, внесіть необхідні зміни');
define('TEXT_SAVE_BUTTON', 'Зберегти');
define('TEXT_CANCEL_BUTTON', 'Скасувати');
define('TEXT_CLOSE_BUTTON', 'Закрити');
define('TEXT_INFO_DATE_ADDED', 'Дата додавання:');
define('TEXT_INFO_LAST_MODIFIED', 'Остання зміна:');
define('ERROR_TEMPLATE_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Директорія захищена від запису, встановіть вірні права доступу (наприклад chmod 777) для директорії');
define('ERROR_TEMPLATE_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Директорія відсутня, створіть директорію');

// Мой магазин

define('MYSQL_PERFORMANCE_TRESHOLD_TITLE' , 'Лог повільних запитів, від *сек');
define('MINIFY_CSSJS_TITLE' , 'Стискати CSS і JS код');
define('MENU_LOCATION_TITLE' , 'Розташування меню в адмiнцi: ');
define('MENU_TOP_LOCATION' , 'зверху');
define('MENU_LEFT_LOCATION' , 'зліва');
define('MENU_LEFT_MIN_LOCATION' , 'зліва та згорнуте');
define('MINIFY_CSSJS_0_TITLE' , 'Не стискати');
define('MINIFY_CSSJS_1_TITLE' , 'Стиснути зараз');
define('MINIFY_CSSJS_2_TITLE' , 'Використовувати стиснуті файли');
define('IMAGE_CACHE_TITLE', 'Змінити IMAGE_CACHE');
define('IMAGE_CACHE_0_TITLE', 'Вимкнути');
define('IMAGE_CACHE_1_TITLE', 'Увімкнути');
//define('ALLOW_AUTOLOGON_TITLE', 'включити Автологін');
define('DEFAULT_TEMPLATE_TITLE' , 'Шаблон за замовчуванням');
define('LOGO_IMAGE_TITLE' , 'Логотип компанії');
define('FAVICON_IMAGE_TITLE', 'Фавікон');
define('WATER_MARK_TITLE', 'Водяний знак');
define('STORE_NAME_TITLE' , 'Назва магазину');
//define('MULTICOLOR_NAME_TITLE' , 'Назва атрибуту (MULTICOLOR)');
define('STORE_OWNER_TITLE' , 'Власник магазину');
define('STORE_ADDRESS_TITLE' , 'Адреса магазину');
define('STORE_LOGO_TITLE' , 'Логотип магазину');
define('STORE_OWNER_EMAIL_ADDRESS_TITLE' , 'E-Mail Адреса');
define('STORE_OWNER_ICQ_NUMBER_TITLE' , 'ICQ номер');
define('EMAIL_FROM_TITLE' , 'E-Mail Від');
define('STORE_COUNTRY_TITLE' , 'Країна');
define('SET_HTTPS_TITLE' , 'Включити HTTPS');
define('ENABLE_DEBUG_PAGE_SPEED_TITLE', 'Включити дебаг завантаження сторінки');
define('SET_WWW_TITLE' , 'Перенаправлення для www');
define('WWW_TOO_MANY_REDIRECTS' , 'Забагато перенаправлень, значення не змінено');
define('STORE_ZONE_TITLE' , 'Регіон');
define('EXPECTED_PRODUCTS_SORT_TITLE' , 'Порядок сортування очікуваних товарів');
define('EXPECTED_PRODUCTS_FIELD_TITLE' , 'Сортування очікуваних товарів');
define('USE_DEFAULT_LANGUAGE_CURRENCY_TITLE' , 'Перемикання на валюту в залежності від вибранної мови');
define('SEND_EXTRA_ORDER_EMAILS_TO_TITLE' , 'Надсилання копій листів із замовленням');
define('SEARCH_ENGINE_FRIENDLY_URLS_TITLE' , 'Використовувати короткі URL адреси (знаходиться в розробці)');
define('DISPLAY_CART_TITLE' , 'Переходити в кошик після додавання товару');
define('ALLOW_GUEST_TO_TELL_A_FRIEND_TITLE' , 'Дозволити гостям використовувати функцію Розповісти другу');
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_TITLE' , 'Оператор пошуку за замовчуванням');
define('STORE_NAME_ADDRESS_TITLE' , 'Адреса і телефон магазину');
define('ALLOW_CATEGORY_DESCRIPTIONS_TITLE' , 'Дозволити опис категорій');
define('TAX_DECIMAL_PLACES_TITLE' , 'Кількість знаків після коми у податків');
define('SHOW_MAIN_FEATURED_PRODUCTS_TITLE' , 'Показувати рекомендовані товари на головній сторінці');
define('DISPLAY_PRICE_WITH_TAX_TITLE' , 'Показывать цены с налогами');
define('XPRICES_NUM_TITLE' , 'Кількість можливих цін для товару');
//define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_TITLE' , 'Номінал подарункового сертифіката, який отримають відвідувачі');
define('ALLOW_GUEST_TO_SEE_PRICES_TITLE' , 'Показувати ціни незареєстрованим користувачам');
//define('NEW_SIGNUP_DISCOUNT_COUPON_TITLE' , 'Код купона, який отримають відвідувачі, які пройшли реєстрацію');
define('GUEST_DISCOUNT_TITLE' , 'Націнка для незареєстрованих користувачів');
define('CATEGORIES_SORT_ORDER_TITLE' , 'Сортування товару, категорій');
define('QUICKSEARCH_IN_DESCRIPTION_TITLE' , 'Пошук в описах товару');
define('CONTACT_US_LIST_TITLE' , 'Одержувачі листів, відправлених зі сторінки Зв\'яжіться з нами');
//define('ALLOW_GIFT_VOUCHERS_TITLE' , 'Разрешить использование подарочных сертификатов и купонов');
define('ALLOW_ATTRIBUTES_IN_PRODUCT_EDIT_PAGE_TITLE' , 'Дозволити управління атрибутами на сторінці додавання товару');
define('SHOW_SUBCATEGORIES_WHEN_CATEGORIES_HAS_PRODUCTS_TITLE' , 'Виводити субкатегоріі при наявності товару в категорії');
define('SHOW_PDF_DATASHEET_TITLE' , 'Показувати PDF опис товару');

// Минимальнаые значения

define('ENTRY_FIRST_NAME_MIN_LENGTH_TITLE' , 'Ім\'я');
define('ENTRY_LAST_NAME_MIN_LENGTH_TITLE' , 'Прізвище');
define('ENTRY_DOB_MIN_LENGTH_TITLE' , 'Дата народження');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_TITLE' , 'E-Mail адреса');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_TITLE' , 'Адреса');
define('ENTRY_COMPANY_MIN_LENGTH_TITLE' , 'Компанія');
define('ENTRY_POSTCODE_MIN_LENGTH_TITLE' , 'Поштовий індекс');
define('ENTRY_CITY_MIN_LENGTH_TITLE' , 'Місто');
define('ENTRY_COUNTRY_MIN_LENGTH_TITLE', 'Країна');
define('ENTRY_FAX_MIN_LENGTH_TITLE', 'Факс');
define('ENTRY_SUBURB_MIN_LENGTH_TITLE', 'Район');
define('ENTRY_STATE_MIN_LENGTH_TITLE' , 'Регіон');
define('ENTRY_TELEPHONE_MIN_LENGTH_TITLE' , 'Телефон');
define('ENTRY_PASSWORD_MIN_LENGTH_TITLE' , 'Пароль');
define('CC_OWNER_MIN_LENGTH_TITLE' , 'Власник кредитної картки');
define('CC_NUMBER_MIN_LENGTH_TITLE' , 'Номер кредитної картки');
define('REVIEW_TEXT_MIN_LENGTH_TITLE' , 'Текст відгуку');
define('MIN_DISPLAY_BESTSELLERS_TITLE' , 'Лідер продажу');
define('MIN_DISPLAY_ALSO_PURCHASED_TITLE' , 'Також замовили');
define('MIN_DISPLAY_XSELL_TITLE' , 'Пов\'язані товари');
define('MIN_ORDER_TITLE' , 'Мінімальна сума замовлення');

// Максимальные значения

define('MAX_PROD_ADMIN_SIDE_TITLE' , 'Товарів на одній сторінці в адміністраторській');
define('MAX_ADDRESS_BOOK_ENTRIES_TITLE' , 'Записи в адресній книзі');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE' , 'Товарів на одній сторінці в каталозі');
define('MAX_DISPLAY_PAGE_LINKS_TITLE' , 'Посилань на сторінки');
define('MAX_DISPLAY_SPECIAL_PRODUCTS_TITLE' , 'Спеціальні ціни');
define('MAX_DISPLAY_NEW_PRODUCTS_TITLE' , 'Новинки');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_TITLE' , 'Очікувані товари');
define('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST_TITLE' , 'Список виробників');
define('MAX_MANUFACTURERS_LIST_TITLE' , 'Виробники у вигляді розгорнутого меню');
define('MAX_DISPLAY_MANUFACTURER_NAME_LEN_TITLE' , 'Обмеження довжини назви виробника');
define('MAX_RANDOM_SELECT_NEW_TITLE' , 'Вибір випадкового товару в боксі Новинки');
define('MAX_RANDOM_SELECT_SPECIALS_TITLE' , 'Вибір випадкового товару в боксі Знижки');
define('MAX_DISPLAY_CATEGORIES_PER_ROW_TITLE' , 'Кількість категорій в рядку');
define('MAX_DISPLAY_PRODUCTS_NEW_TITLE' , 'Кількість Новинок на сторінці');
define('MAX_DISPLAY_BESTSELLERS_TITLE' , 'Лідер продажу');
define('MAX_DISPLAY_ALSO_PURCHASED_TITLE' , 'Також замовили');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_TITLE' , 'Бокс Історія замовлень');
define('MAX_DISPLAY_ORDER_HISTORY_TITLE' , 'Історія замовлень');
define('MAX_DISPLAY_FEATURED_PRODUCTS_TITLE' , 'Товарів в боксі Рекомендовані товари на головній сторінці');
define('MAX_DISPLAY_FEATURED_PRODUCTS_LISTING_TITLE' , 'Товарів на одній сторінці Рекомендованих товарів');
define('SLIDER_HEIGHT_TITLE' , 'Висота слайдера');

// Картинки

define('SMALL_IMAGE_WIDTH_TITLE' , 'Ширина маленької картинки');
define('SMALL_IMAGE_HEIGHT_TITLE' , 'Висота маленької картинки');
define('HEADING_IMAGE_WIDTH_TITLE' , 'Ширина картинки категорії');
define('HEADING_IMAGE_HEIGHT_TITLE' , 'Висота картинки категорії');
define('SUBCATEGORY_IMAGE_WIDTH_TITLE' , 'Ширина картинки підкатегорії');
define('SUBCATEGORY_IMAGE_HEIGHT_TITLE' , 'Висота картинки підкатегорії');
define('CONFIG_CALCULATE_IMAGE_SIZE_TITLE' , 'Обчислювати розмір картинки');
define('IMAGE_REQUIRED_TITLE' , 'Картинка обов\'язкова');
define('ULTIMATE_ADDITIONAL_IMAGES_TITLE' , 'Дозволити використання модуля додаткових картинок');
define('ULT_THUMB_IMAGE_WIDTH_TITLE' , 'Ширина додаткової картинки');
define('ULT_THUMB_IMAGE_HEIGHT_TITLE' , 'Висота додаткової картинки');
define('MEDIUM_IMAGE_WIDTH_TITLE' , 'Ширина великої картинки');
define('MEDIUM_IMAGE_HEIGHT_TITLE' , 'Висота великої картинки');
define('LARGE_IMAGE_WIDTH_TITLE' , 'Ширина картинки для pop-up вікна');
define('LARGE_IMAGE_HEIGHT_TITLE' , 'Висота картинки для pop-up вікна');

// Данные покупателя

define('ACCOUNT_GENDER_TITLE' , 'Стати');
define('ACCOUNT_DOB_TITLE' , 'Дата народження');
define('ACCOUNT_COMPANY_TITLE' , 'Компанія');
define('ACCOUNT_SUBURB_TITLE' , 'Район');
define('ACCOUNT_STATE_TITLE' , 'Регіон');
define('ACCOUNT_STREET_ADDRESS_TITLE' , 'Адреса');
define('ACCOUNT_CITY_TITLE' , 'Місто');
define('ACCOUNT_POSTCODE_TITLE' , 'Поштовий індекс');
define('ACCOUNT_COUNTRY_TITLE' , 'Країна');
define('ACCOUNT_TELE_TITLE' , 'Телефон');
define('ACCOUNT_FAX_TITLE' , 'Факс');
define('ACCOUNT_NEWS_TITLE' , 'Розсилка');
define('ACCOUNT_LAST_NAME_TITLE' , 'Прізвище');
define('ACCOUNT_FIRST_NAME_TITLE' , 'Ім\'я');

// Доставка/упаковка

define('SHIPPING_ORIGIN_COUNTRY_TITLE' , 'Країна магазину');
define('SHIPPING_ORIGIN_ZIP_TITLE' , 'Поштовий індекс магазину');
define('SHIPPING_MAX_WEIGHT_TITLE' , 'Максимальна вага доставки');
define('SHIPPING_BOX_WEIGHT_TITLE' , 'Мінімальна вага упаковки');
define('SHIPPING_BOX_PADDING_TITLE' , 'Вага упаковки у відсотках');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_TITLE' , 'Дозволити безкоштовну доставку');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_TITLE' , 'Безкоштовна доставка для замовлень на суму понад');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_TITLE' , 'Безкоштовна доставка для замовлень, оформлених з');
define('SHOW_SHIPPING_ESTIMATOR_TITLE' , 'Показувати способи і вартість доставки в кошику');

// Вывод товара

define('PRODUCT_LISTING_DISPLAY_STYLE_TITLE' , 'Формат виведення товару');
define('PRODUCT_LIST_IMAGE_TITLE' , 'Показувати картинку товару');
define('PRODUCT_LIST_MANUFACTURER_TITLE' , 'Показувати виробника товару');
define('PRODUCT_LIST_MODEL_TITLE' , 'Показувати код товару');
define('PRODUCT_LIST_NAME_TITLE' , 'Показувати назву товару');
define('PRODUCT_LIST_PRICE_TITLE' , 'Показувати вартість товару');
define('PRODUCT_LIST_QUANTITY_TITLE' , 'Показувати кількість товару на складі');
define('PRODUCT_LIST_WEIGHT_TITLE' , 'Показувати вагу товару');
define('PRODUCT_LIST_BUY_NOW_TITLE' , 'Показувати кнопку Купити зараз!');
define('PRODUCT_LIST_FILTER_TITLE' , 'Показувати PDF-лінк');
define('PREV_NEXT_BAR_LOCATION_TITLE' , 'Розташування навігації Наступна / Попередня сторінка');
define('PRODUCT_LIST_INFO_TITLE' , 'Показувати короткий опис');
define('PRODUCT_SORT_ORDER_TITLE' , 'Показувати порядок сортування');

// Склад

define('STOCK_CHECK_TITLE' , 'Перевіряти наявність товару на складі');
define('STOCK_SHOW_BUY_BUTTON_TITLE' , 'Показати кнопку «Купити», якщо товар відсутній');
define('STOCK_LIMITED_TITLE' , 'Віднімати товар зі складу');
define('STOCK_ALLOW_CHECKOUT_TITLE' , 'Дозволити оформлення замовлення');
define('STOCK_DISABLE_NON_EXISTENT_PRODUCT_ON_CHECKOUT_TITLE', 'Вимикати викуплені товари');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_TITLE' , 'Відзначати товар, відсутній на складі');
define('STOCK_REORDER_LEVEL_TITLE' , 'Ліміт кількості товару на складі');

// Логи

define('STORE_PAGE_PARSE_TIME_TITLE' , 'Зберігати час парсинга сторінок');
define('STORE_PAGE_PARSE_TIME_LOG_TITLE' , 'Директорія зберігання логів');
define('STORE_PARSE_DATE_TIME_FORMAT_TITLE' , 'Формат дати логів');
define('DISPLAY_PAGE_PARSE_TIME_TITLE' , 'Показувати час парсинга сторінок');
define('STORE_DB_TRANSACTIONS_TITLE' , 'Зберігати запити до бази динних');

// Кэш

define('USE_CACHE_TITLE' , 'Використовувати кеш');
define('DIR_FS_CACHE_TITLE' , 'Кеш директорія');

// Настройка E-Mail

define('EMAIL_TRANSPORT_TITLE' , 'Спосіб відправки E-Mail');
define('EMAIL_LINEFEED_TITLE' , 'Роздільник рядків в E-Mail');
define('EMAIL_USE_HTML_TITLE' , 'Використовувати HTML формат при відправці листів');
define('ENTRY_EMAIL_ADDRESS_CHECK_TITLE' , 'Перевіряти E-Mail адреса через DNS');
define('SEND_EMAILS_TITLE' , 'Відправляти листи з магазину');

// Скачивание

define('DOWNLOAD_ENABLED_TITLE' , 'Дозволити функцію скачування товарів');
define('DOWNLOAD_BY_REDIRECT_TITLE' , 'Використовувати перенаправлення при скачуванні');
define('DOWNLOAD_MAX_DAYS_TITLE' , 'Термін існування посилання для скачування (днів)');
define('DOWNLOAD_MAX_COUNT_TITLE' , 'Максимальна кількість завантажень');
define('DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE_TITLE' , 'Скидання статистики завантажень');
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG_TITLE' , 'Попередженням про необхідність оплатити скачуваний товар');
define('DOWNLOADS_CONTROLLER_ORDERS_STATUS_TITLE' , 'Завантаження дозволяється тільки замовленнями, які мають зазначений статус');

// GZip Компрессия

define('GZIP_COMPRESSION_TITLE' , 'Дозволити GZip компресію');
define('GZIP_LEVEL_TITLE' , 'Рівень стиснення');

// Сессии

define('SESSION_WRITE_DIRECTORY_TITLE' , 'Директорія сесій');
define('SESSION_FORCE_COOKIE_USE_TITLE' , 'Примусове використання Cookie');
define('SESSION_CHECK_SSL_SESSION_ID_TITLE' , 'Перевіряти ID SSL сесії');
define('SESSION_CHECK_USER_AGENT_TITLE' , 'Перевіряти змінну User Agent');
define('SESSION_CHECK_IP_ADDRESS_TITLE' , 'Перевіряти IP адресу');
define('SESSION_BLOCK_SPIDERS_TITLE' , 'Не показувати сесію в адресі павукам пошукових машин');
define('SESSION_RECREATE_TITLE' , 'Відтворювати сесію');

// Тех. обслуживание

define('DOWN_FOR_MAINTENANCE_TITLE' , 'Технічне обслуговування: Вкл./Викл.');
define('DOWN_FOR_MAINTENANCE_FILENAME_TITLE' , 'Технічне обслуговування: Файл');
define('DOWN_FOR_MAINTENANCE_HEADER_OFF_TITLE' , 'Технічне обслуговування: Не показувати шапку');
define('DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF_TITLE' , 'Технічне обслуговування: Не показувати ліву колонку');
define('DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF_TITLE' , 'Технічне обслуговування: Не показувати праву колонку');
define('DOWN_FOR_MAINTENANCE_FOOTER_OFF_TITLE' , 'Технічне обслуговування: Не показувати нижню частину');
define('DOWN_FOR_MAINTENANCE_PRICES_OFF_TITLE' , 'Технічне обслуговування: Не показувати ціни');
define('EXCLUDE_ADMIN_IP_FOR_MAINTENANCE_TITLE' , 'Технічне обслуговування: Виключити вказаний IP адрес');
define('WARN_BEFORE_DOWN_FOR_MAINTENANCE_TITLE' , 'Повідомляти відвідувачів магазину перед відходом на Технічне обслуговування');
define('PERIOD_BEFORE_DOWN_FOR_MAINTENANCE_TITLE' , 'Текст повідомлення');
define('DISPLAY_MAINTENANCE_TIME_TITLE' , 'Показувати дату активації режиму Технічне обслуговування');
define('DISPLAY_MAINTENANCE_PERIOD_TITLE' , 'Показувати період роботи режиму Технічне обслуговування');
define('TEXT_MAINTENANCE_PERIOD_TIME_TITLE' , 'Час роботи режиму Технічне обслуговування');

// Оновлення Прайсу

define('DISPLAY_MODEL_TITLE' , 'Показувати код товару');
define('MODIFY_MODEL_TITLE' , 'Показувати код товару');
define('MODIFY_NAME_TITLE' , 'Показувати назву товару');
define('DISPLAY_STATUT_TITLE' , 'Показувати статус товару');
define('DISPLAY_WEIGHT_TITLE' , 'Показувати вагу товару');
define('DISPLAY_QUANTITY_TITLE' , 'Показувати кількість товару');
define('DISPLAY_SORT_ORDER_TITLE' , 'Показувати порядок сортування');
define('DISPLAY_ORDER_MIN_TITLE' , 'Показувати мінімум для замовлення');
define('DISPLAY_ORDER_UNITS_TITLE' , 'Показувати крок');
define('DISPLAY_IMAGE_TITLE' , 'Показувати картинку товару');
define('DISPLAY_MANUFACTURER_TITLE' , 'Показувати виробника');
define('MODIFY_MANUFACTURER_TITLE' , 'Показувати виробників товару');
define('DISPLAY_TAX_TITLE' , 'Показувати податок');
define('MODIFY_TAX_TITLE' , 'Показувати податок');
define('DISPLAY_TVA_OVER_TITLE' , 'Показувати ціни з податками');
define('DISPLAY_TVA_UP_TITLE' , 'Показувати ціни з податками при зміні ціни');
define('DISPLAY_PREVIEW_TITLE' , 'Показувати посилання на опис');
define('DISPLAY_EDIT_TITLE' , 'Показувати посилання на редагування товару');
define('ACTIVATE_COMMERCIAL_MARGIN_TITLE' , 'Показувати можливість масової зміни цін');

// Отложенные товары

define('MAX_DISPLAY_WISHLIST_PRODUCTS_TITLE' , 'Кількість відкладених товарів на сторінці');
define('MAX_DISPLAY_WISHLIST_BOX_TITLE' , 'Кількість відкладених товарів в боксі');
define('DISPLAY_WISHLIST_EMAILS_TITLE' , 'Кількість e-mail адрес');
define('WISHLIST_REDIRECT_TITLE' , 'Залишатися на сторінці картки товару');

// Кэш страниц

define('ENABLE_PAGE_CACHE_TITLE' , 'Дозволити кешування сторінок');
define('PAGE_CACHE_LIFETIME_TITLE' , 'Термін життя кешу');
define('PAGE_CACHE_DEBUG_MODE_TITLE' , 'Включити режим налагодження');
define('PAGE_CACHE_DISABLE_PARAMETERS_TITLE' , 'Відключати URL параметри');
define('PAGE_CACHE_DELETE_FILES_TITLE' , 'Видаляти кеш файли');
define('PAGE_CACHE_UPDATE_CONFIG_FILES_TITLE' , 'Налаштувати оновлення кеш файлів');

// Яндекс маркет

define('YML_NAME_TITLE' , 'Назва магазину');
define('YML_COMPANY_TITLE' , 'Назва компанії');
define('YML_DELIVERYINCLUDED_TITLE' , 'Доставка включена');
define('YML_AVAILABLE_TITLE' , 'Товар в наявності');
define('YML_AUTH_USER_TITLE' , 'Логін');
define('YML_AUTH_PW_TITLE' , 'Пароль');
define('YML_REFERER_TITLE' , 'Посилання');
define('YML_STRIP_TAGS_TITLE' , 'Теги');
define('YML_UTF8_TITLE' , 'Перекодування в UTF-8');

// Описание полей

// Мой магазин

define('DEFAULT_TEMPLATE_DESC' , 'Тут Ви можете вказати шаблон, який використовується в магазині за замовчуванням.');
define('STORE_NAME_DESC' , 'Назва Вашого магазину');
define('STORE_OWNER_DESC' , 'Ім\'я власника магазину');
define('STORE_LOGO_DESC' , 'Вкажіть логотип Вашого магазину');
define('STORE_OWNER_EMAIL_ADDRESS_DESC' , 'E-Mail адреса власника магазину');
define('STORE_OWNER_ICQ_NUMBER_DESC' , 'ICQ номер, який буде виведений в боксі Консультант в магазині.');
define('EMAIL_FROM_DESC' , 'E-Mail адреса в відправлених листах');
define('STORE_COUNTRY_DESC' , 'Країна знаходження магазину. <br> <br> <b> Зауваження: Не забудьте також вказати Зону. </ b>');
define('SET_HTTPS_DESC' , 'HTTP або HTTPS');
define('STORE_ZONE_DESC' , 'Регіон знаходження магазину');
define('EXPECTED_PRODUCTS_SORT_DESC' , 'Вкажіть порядок сортування для очікуваних товарів, по зростанню - asc чи спадний - desc.');
define('EXPECTED_PRODUCTS_FIELD_DESC' , 'За яким значенням будуть сортуватися очікувані товари.');
define('USE_DEFAULT_LANGUAGE_CURRENCY_DESC' , 'Автоматичне перемикання цін в магазині на валюту поточної мови.');
define('SEND_EXTRA_ORDER_EMAILS_TO_DESC' , 'Якщо Ви хочете отримувати листи із замовленнями, тобто такі ж листи, що і отримує клієнт після оформлення замовлення, вкажіть email адресу для отримання копій листів в наступному форматі: Ім\'я 1 &lt;email@address1&gt;, Ім\'я 2 &lt;email@address2&gt;');
define('SEARCH_ENGINE_FRIENDLY_URLS_DESC' , 'Використовувати короткі URL адреси в магазині');
define('DISPLAY_CART_DESC' , 'Переходити в кошик після додавання товару в корзину або залишатися на тій же сторінці.');
define('ALLOW_GUEST_TO_TELL_A_FRIEND_DESC' , 'Дозволити гостям використовувати функцію магазину Розповісти другу, якщо немає, то цією функцією можуть користуватися тільки зареєстровані користувачі магазину.');
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_DESC' , 'Вкажіть, який оператор буде використовуватися за замовчуванням при здійсненні відвідувачем пошуку в магазині.');
define('STORE_NAME_ADDRESS_DESC' , 'Тут Ви можете вказати адресу і телефон магазину');
define('SHOW_COUNTS_DESC' , 'Показує кількість товару в кожній категорії. При великій кількості товару в магазині рекомендується відключати лічильник - false, щоб знизити навантаження на MySQL сервер, тим самих швидкість завантаження сторінки Вашого магазину збільшиться.');
define('ALLOW_CATEGORY_DESCRIPTIONS_DESC' , 'Дозволити додавання описів для категорій.');
define('TAX_DECIMAL_PLACES_DESC' , 'Кількість знаків після цілого числа у податків.');
define('SHOW_MAIN_FEATURED_PRODUCTS_DESC' , 'true - Показувати<br>false - Не показувати');
define('DISPLAY_PRICE_WITH_TAX_DESC' , 'Показувати ціни в магазині з податками (true) або показувати податок тільки на заключному етапі оформлення замовлення (false)');

define('XPRICES_NUM_DESC' , 'Тут Ви можете вказати, яка кількість цін може мати кожен товар<br><br>Наприклад, Ви можете покупцям з групи Покупці показувати одну ціну товару, покупцям з групи Оптовики - показувати іншу.');
define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_DESC' , 'Якщо Ви не хочете відправляти подарунковий сертифікат зареєстрованим в магазині покупцям, вкажіть 0. Щоб відправляти зареєстрованим покупцям сертифікат, наприклад, номіналом в 10$ - вкажіть 10, якщо 25.5$ - вкажіть 25.5 і т.д.' );
define('ALLOW_GUEST_TO_SEE_PRICES_DESC' , 'Якщо стоїть false, то ціни в магазині можуть бачити тільки зареєстровані відвідувачі, якщо true - всі відвідувачі можуть бачити ціни в магазині.');
define('NEW_SIGNUP_DISCOUNT_COUPON_DESC' , 'Якщо Ви не хочете давати купон відвідувачам, які пройшли реєстрацію, просто залиште поле порожнім, або вкажіть код існуючого купона, який Ви хочете давати всім зареєстрованим покупцям.');
define('GUEST_DISCOUNT_DESC' , 'Націнка для простих відвідувачів магазину. Для зареєстрованих в магазині відвідувачів дана опція не діє. Вказуйте націнку у відсотках. Наприклад вкажіть 10, це означає, що для простих відвідувачів всі ціни в магазині будуть на 10% вище ніж для зареєстрованих відвідувачів. ');
define('CATEGORIES_SORT_ORDER_DESC' , '<b>Можливі значення:<br>products_name<br>products_name-desc<br>model<br>model-desc</b>');
define('QUICKSEARCH_IN_DESCRIPTION_DESC' , 'При пошуку товару за допомогою боксу швидкий пошук, Ви можете вказати, як шукати товари, тільки за назвами - FALSE або шукати в назвах + описах - TRUE');
define('CONTACT_US_LIST_DESC' , 'Ви можете вказати різних одержувачів на сторінці Зв\'яжіться з нами. Формат запису: Ім\'я 1 &lt;email@address1&gt;, Ім\'я 2&lt;email@address2&gt;. Якщо Ви хочете залишити всього одного одержувача листів, просто залиште поле порожнім.');
define('ALLOW_GIFT_VOUCHERS_DESC' , 'Ви можете включити - true або вимкнути - false можливість використання подарункових сертифікатів і купонів при оформленні замовлення.');
define('ALLOW_ATTRIBUTES_IN_PRODUCT_EDIT_PAGE_DESC' , 'Ви можете включити - true або вимкнути - false можливість управління атрибутами товарів прямо на сторінці додавання / редагування товарів.');
define('SHOW_SUBCATEGORIES_WHEN_CATEGORIES_HAS_PRODUCTS_DESC' , 'Якщо в категорії є товар і в даній категорії є субкатегоріі, то за замовчуванням (true), зайшовши в таку категорію, Ви побачите список субкатегорій і список товарів категорії. Можна відключити висновок субкатегорій, для цього поставте false.');
define('SHOW_PDF_DATASHEET_DESC' , 'Показувати (true) чи ні (false) PDF опис товару на сторінці опису товару.');


// Минимальнаые значения

define('ENTRY_FIRST_NAME_MIN_LENGTH_DESC', 'Мінімальна кількість символів поля Ім\'я');
define('ENTRY_LAST_NAME_MIN_LENGTH_DESC', 'Мінімальна кількість символів поля Прізвище');
define('ENTRY_DOB_MIN_LENGTH_DESC', 'Мінімальна кількість символів поля Дата народження');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_DESC', 'Мінімальна кількість символів поля E-Mail адреса');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_DESC', 'Мінімальна кількість символів поля Адреса');
define('ENTRY_COMPANY_MIN_LENGTH_DESC', 'Мінімальна кількість символів поля Компанія');
define('ENTRY_POSTCODE_MIN_LENGTH_DESC', 'Мінімальна кількість символів поля Поштовий індекс');
define('ENTRY_CITY_MIN_LENGTH_DESC', 'Мінімальна кількість символів поля Місто');
define('ENTRY_STATE_MIN_LENGTH_DESC', 'Мінімальна кількість символів поля Регіон');
define('ENTRY_TELEPHONE_MIN_LENGTH_DESC', 'Мінімальна кількість символів поля Телефон');
define('ENTRY_PASSWORD_MIN_LENGTH_DESC', 'Мінімальна кількість символів поля Пароль');
define('CC_OWNER_MIN_LENGTH_DESC', 'Мінімальна кількість символів поля Власник кредитної картки');
define('CC_NUMBER_MIN_LENGTH_DESC', 'Мінімальна кількість символів поля Номер кредитної картки');
define('REVIEW_TEXT_MIN_LENGTH_DESC', 'Мінімальна кількість символів для відгуків');
define('MIN_DISPLAY_BESTSELLERS_DESC', 'Мінімальна кількість товару, що виводиться в блоці Лідери продажів');
define('MIN_DISPLAY_ALSO_PURCHASED_DESC', 'Мінімальна кількість товару, що виводиться в боксі Також замовили');
define('MIN_DISPLAY_XSELL_DESC', 'Мінімальна кількість товарів, виведених в боксі пов\'язані товари');
define('MIN_ORDER_DESC', 'Якщо сума замовлення буде меншим за вказаний, таке замовлення можна буде оформити. Вказуйте просто число, без симолів валюти ($, руб. і т.д.). Поставте 0, якщо Ви не хочете обмежувати мінімальну суму замовлення.');

// Максимальные значения

define('MAX_PROD_ADMIN_SIDE_DESC' , 'Кількість товару на одній сторінці в адміністраторській');

define('MAX_ADDRESS_BOOK_ENTRIES_DESC' , 'Максимальна кількість записів, які може зробити покупець у своїй адресній книзі');
define('MAX_DISPLAY_SEARCH_RESULTS_DESC' , 'Кількість товару, що виводиться на одній сторінці');
define('MAX_DISPLAY_PAGE_LINKS_DESC' , 'Кількість посилань на інші сторінки');
define('MAX_DISPLAY_SPECIAL_PRODUCTS_DESC' , 'Максимальна кількість товару, що виводиться на сторінці Знижки');
define('MAX_DISPLAY_NEW_PRODUCTS_DESC' , 'Максимальна кількість товару, що виводяться в боксі Новинки');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_DESC' , 'Максимальна кількість товару, що виводиться в блоці Очікувані товари');
define('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST_DESC' , 'Дана опція використовується для налаштування боксу виробників, якщо число виробників перевищує вказане в даній опції, список виробників буде виводитися у вигляді drop-down списку, якщо число виробників менше зазначеного в даній опції, виробники будуть виводитися у вигляді списку.');
define('MAX_MANUFACTURERS_LIST_DESC' , 'Дана опція використовується для налаштування боксу виробників, якщо вказана цифра \'1\', то список виробників виводиться у вигляді стандартного drop-down списку. Якщо вказана будь-яка інша цифра, то виводиться тільки X виробників у вигляді розгорнутого меню.');
define('MAX_DISPLAY_MANUFACTURER_NAME_LEN_DESC' , 'Дана опція використовується для налаштування боксу виробників, Ви вказуєте кількість символів, що виводиться в боксі виробників, якщо назва виробника буде складатися з більшої кількості символів, то будуть виведені перші X символів назви');
define('MAX_RANDOM_SELECT_NEW_DESC' , 'Кількість товару, серед якого буде обраний випадковий товар і виведений в бокс Новинок, тобто якщо вказано число X, то новий товар, який буде показаний в боксі Новинок буде обраний з цих X нових товарів') ;
define('MAX_RANDOM_SELECT_SPECIALS_DESC' , 'Кількість товару, серед якого буде обраний випадковий товар і виведений в бокс Знижки, тобто якщо вказано число X, то товар, який буде показаний в боксі Знижки буде обраний з цих X товарів');
define('MAX_DISPLAY_CATEGORIES_PER_ROW_DESC' , 'Скільки категорій виводити в одному рядку');
define('MAX_DISPLAY_PRODUCTS_NEW_DESC' , 'Максимальна кількість новинок, що виводяться на одній сторінці в розділі Новинки');
define('MAX_DISPLAY_BESTSELLERS_DESC' , 'Максимальна кількість лідерів продажів, що виводяться в боксі Лідери продажів');
define('MAX_DISPLAY_ALSO_PURCHASED_DESC' , 'Максимальна кількість товарів в боксі Наші покупці також замовили');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_DESC', 'Максимальна кількість товарів, виведених в боксі Історія замовлень');
define('MAX_DISPLAY_ORDER_HISTORY_DESC' , 'Максимальна кількість замовлень, що виводяться на сторінці Історія замовлень');
define('MAX_DISPLAY_FEATURED_PRODUCTS_DESC' , 'Максимальна кількість товару в боксі Рекомендовані товари на головній сторінці');
define('MAX_DISPLAY_FEATURED_PRODUCTS_LISTING_DESC' , 'Кількість товару на одній сторінці Рекомендованих товарів');

// Картинки

define('SMALL_IMAGE_WIDTH_DESC' , 'Ширина картинки в пікселах. Залиште поле порожнім або поставте 0, якщо не хочете обмежувати ширину картинки. Обмеження ширини картинки не означає фізичне зменшення розмірів картинки.');
define('SMALL_IMAGE_HEIGHT_DESC' , 'Висота картинки в пікселах. Залиште поле порожнім або поставте 0, якщо не хочете обмежувати висоту картинки. Обмеження висоти картинки не означає фізичне зменшення розмірів картинки.');
define('HEADING_IMAGE_WIDTH_DESC' , 'Ширина картинки в пікселах. Залиште поле порожнім або поставте 0, якщо не хочете обмежувати ширину картинки. Обмеження ширини картинки не означає фізичне зменшення розмірів картинки.');
define('HEADING_IMAGE_HEIGHT_DESC' , 'Висота картинки в пікселах. Залиште поле порожнім або поставте 0, якщо не хочете обмежувати висоту картинки. Обмеження висоти картинки не означає фізичне зменшення розмірів картинки.');
define('SUBCATEGORY_IMAGE_WIDTH_DESC' , 'Ширина картинки в пікселах. Залиште поле порожнім або поставте 0, якщо не хочете обмежувати ширину картинки. Обмеження ширини картинки не означає фізичне зменшення розмірів картинки.');
define('SUBCATEGORY_IMAGE_HEIGHT_DESC' , 'Висота картинки в пікселах. Залиште поле порожнім або поставте 0, якщо не хочете обмежувати висоту картинки. Обмеження висоти картинки не означає фізичне зменшення розмірів картинки.');
define('CONFIG_CALCULATE_IMAGE_SIZE_DESC' , 'Дана опція просто дивиться змінні, зазначені вище і стискає картинку до зазначених розмірів, це не означає, що фізичний розмір картинки зменшиться, відбувається примусовий вивід картинки певного розміру. Рекомендується ставити значення false');
define('IMAGE_REQUIRED_DESC' , 'Необхідно для пошуку помилок, в разі, якщо картинка не виводиться.');
define('ULTIMATE_ADDITIONAL_IMAGES_DESC' , 'Ви можете включити / вимкнути модуль додаткових картинок для товару.');
define('ULT_THUMB_IMAGE_WIDTH_DESC' , 'Ширина додаткової картинки в пікселах. Залиште поле порожнім або поставте 0, якщо не хочете обмежувати ширину картинки. Обмеження ширини картинки не означає фізичне зменшення розмірів картинки.');
define('ULT_THUMB_IMAGE_HEIGHT_DESC' , 'Висота додаткової картинки в пікселах. Залиште поле порожнім або поставте 0, якщо не хочете обмежувати висоту картинки. Обмеження висоти картинки не означає фізичне зменшення розмірів картинки.');
define('MEDIUM_IMAGE_WIDTH_DESC' , 'Ширина великої картинки в пікселах. Залиште поле порожнім або поставте 0, якщо не хочете обмежувати ширину великий картинки. Обмеження ширини великий картинки не означає фізичне зменшення розмірів картинки.');
define('MEDIUM_IMAGE_HEIGHT_DESC' , 'Висота великої картинки в пікселах. Залиште поле порожнім або поставте 0, якщо не хочете обмежувати висоту великий картинки. Обмеження висоти великої картинки не означає фізичне зменшення розмірів картинки.');
define('LARGE_IMAGE_WIDTH_DESC' , 'Ширина картинки для pop-up вікна в пікселах. Залиште поле порожнім або поставте 0, якщо не хочете обмежувати ширину картинки для pop-up вікна. Обмеження ширини картинки для pop-up вікна не означає фізичне зменшення розмірів картинки .');
define('LARGE_IMAGE_HEIGHT_DESC' , 'Висота картинки для pop-up вікна в пікселах. Залиште поле порожнім або поставте 0, якщо не хочете обмежувати висоту картинки для pop-up вікна. Обмеження висоти картинки для pop-up вікна не означає фізичне зменшення розмірів картинки.');

// Данные покупателя

define('ACCOUNT_DOB_DESC' , 'Показувати поле Дата народження при реєстрації покупця в магазині і в адресній книзі');
define('ACCOUNT_COMPANY_DESC' , 'Показувати поле Компанія при реєстрації покупця в магазині і в адресній книзі');
define('ACCOUNT_SUBURB_DESC' , 'Показувати поле Район при реєстрації покупця в магазині і в адресній книзі');
define('ACCOUNT_STATE_DESC' , 'Показувати поле Регіон при реєстрації покупця в магазині і в адресній книзі');
define('ACCOUNT_STREET_ADDRESS_DESC' , 'Показувати поле Адреса при реєстрації покупця в магазині і в адресній книзі');
define('ACCOUNT_CITY_DESC' , 'Показувати поле Місто при реєстрації покупця в магазині і в адресній книзі');
define('ACCOUNT_POSTCODE_DESC' , 'Показувати поле Поштовий індекс при реєстрації покупця в магазині і в адресній книзі');
define('ACCOUNT_COUNTRY_DESC' , 'Показувати поле Країна при реєстрації покупця в магазині і в адресній книзі');
define('ACCOUNT_TELE_DESC' , 'Показувати поле Телефон при реєстрації покупця в магазині і в адресній книзі');
define('ACCOUNT_FAX_DESC' , 'Показувати поле Факс при реєстрації покупця в магазині і в адресній книзі');
define('ACCOUNT_NEWS_DESC' , 'Показувати поле Розсилка при реєстрації покупця в магазині і в адресній книзі');
define('ACCOUNT_LAST_NAME_DESC' , 'Показувати поле Прізвище при реєстрації покупця в магазині і в адресній книзі');

// Доставка/упаковка

define('SHIPPING_ORIGIN_COUNTRY_DESC' , 'Країна, де знаходиться магазин. Необхідно для деяких модулів доставки.');
define('SHIPPING_ORIGIN_ZIP_DESC' , 'Вкажіть поштовий індекс магазину. Необхідно для деяких модулів доставки.');
define('SHIPPING_MAX_WEIGHT_DESC' , 'Ви можете вказати максимальну вагу доставки, понад якого замовлення не доставляються. Необхідно для деяких модулів доставки.');
define('SHIPPING_BOX_WEIGHT_DESC' , 'Ви можете вказати вагу упаковки.');
define('SHIPPING_BOX_PADDING_DESC' , 'Доставка замовлень, вага яких більше зазначеного в змінної Максимальна вага доставки, збільшується на вказаний відсоток. Якщо Ви хочете повів вартість на 10%, пишіть - 10');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_DESC' , 'Ви хочете дозволити використання модуля безкоштовної доставки?');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_DESC' , 'Замовлення, понад суми, зазначеної цій сфері, будуть доставлятися безкоштовно.');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_DESC' , 'national - замовлення з країни перебування магазину (змінна Країна магазину), international - замовлення з будь-якої країни, крім країни перебування магазину, якщо both - тоді все замовлення. За умови, що сума замовлення вище суми, зазначеної в змінної вище.');
define('SHOW_SHIPPING_ESTIMATOR_DESC' , 'Показувати інформацію про способи і вартості доставки в кошику?<br>true - показувати.<br>false - не показувати');

// Вывод товара

define('PRODUCT_LISTING_DISPLAY_STYLE_DESC', 'Ви можете вибрати, в якому форматі виводити товар, у вигляді таблиці - list, або в стовпець - columns.');
define('PRODUCT_LIST_IMAGE_DESC', 'Вкажіть порядок виведення, тобто введіть цифру. Якщо вкажіть 1, то картинка буде зліва на першому місці, якщо 2, то картинка буде показана після (праворуч) поля, у якого вказана цифра 1 і т . Д.');
define('PRODUCT_LIST_MANUFACTURER_DESC', 'Вкажіть порядок виведення даного поля в Вашому магазині, тобто введіть цифру. Якщо вкажіть 1, то дане поле буде зліва на першому місці, якщо 2, то поле буде показана після (праворуч) поля, у якого вказана цифра 1 і т.д.');
define('PRODUCT_LIST_MODEL_DESC', 'Вкажіть порядок виведення даного поля в Вашому магазині, тобто введіть цифру. Якщо вкажіть 1, то дане поле буде зліва на першому місці, якщо 2, то поле буде показана після (праворуч) поля, у якого вказана цифра 1 і т.д.');
define('PRODUCT_LIST_NAME_DESC', 'Вкажіть порядок виведення даного поля в Вашому магазині, тобто введіть цифру. Якщо вкажіть 1, то дане поле буде зліва на першому місці, якщо 2, то поле буде показана після (праворуч) поля, у якого вказана цифра 1 і т.д.');
define('PRODUCT_LIST_PRICE_DESC', 'Вкажіть порядок виведення даного поля в Вашому магазині, тобто введіть цифру. Якщо вкажіть 1, то дане поле буде зліва на першому місці, якщо 2, то поле буде показана після (праворуч) поля, у якого вказана цифра 1 і т.д.');
define('PRODUCT_LIST_QUANTITY_DESC', 'Вкажіть порядок виведення даного поля в Вашому магазині, тобто введіть цифру. Якщо вкажіть 1, то дане поле буде зліва на першому місці, якщо 2, то поле буде показана після (праворуч) поля, у якого вказана цифра 1 і т.д.');
define('PRODUCT_LIST_WEIGHT_DESC', 'Вкажіть порядок виведення даного поля в Вашому магазині, тобто введіть цифру. Якщо вкажіть 1, то дане поле буде зліва на першому місці, якщо 2, то поле буде показана після (праворуч) поля, у якого вказана цифра 1 і т.д.');
define('PRODUCT_LIST_BUY_NOW_DESC', 'Вкажіть порядок виведення даного поля в Вашому магазині, тобто введіть цифру. Якщо вкажіть 1, то дане поле буде зліва на першому місці, якщо 2, то поле буде показана після (праворуч) поля, у якого вказана цифра 1 і т.д.');
define('PRODUCT_LIST_FILTER_DESC', 'Показувати бокс (drop-down) меню, за допомогою якого можна сортувати товар в будь-якої категорії магазину по Виробникові.');
define('PREV_NEXT_BAR_LOCATION_DESC', 'Встановіть розташування навігації Наступна / Попередня сторінка (1-верх, 2-низ, 3-верх + низ)');
define('PRODUCT_LIST_INFO_DESC', 'Якщо Ви вкажете 0, тоді короткий опис показуватися не буде, якщо 1-99 - короткий опис буде показуватися, але тільки якщо короткий опис було додано при додаванні товару.');
define('PRODUCT_SORT_ORDER_DESC', 'Вкажіть порядок виведення даного поля в Вашому магазині, тобто введіть цифру. Якщо вкажіть 1, то дане поле буде зліва на першому місці, якщо 2, то поле буде показана після (праворуч) поля, у якого вказана цифра 1 і т.д. 0 - значить не показувати дане поле');

// Склад

define('STOCK_CHECK_DESC' , 'Перевіряти, чи є необхідна кількість товару на складі при оформленні замовлення');
define('STOCK_LIMITED_DESC' , 'Віднімати зі складу та кількість товару, яке буде замовлятися в інтернет-магазині');
define('STOCK_ALLOW_CHECKOUT_DESC' , 'Дозволити покупцям оформляти замовлення, навіть якщо на складі немає достатньої кількості одиниць товару, що замовляється');
define('STOCK_DISABLE_NON_EXISTENT_PRODUCT_ON_CHECKOUT_DESC', 'Вимикати товари з кількістю 0 після купівлі');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_DESC' , 'Показувати покупцеві маркер навпроти товару при оформленні замовлення, якщо на складі немає необхідної кількості одиниць товару, що замовляється');
define('STOCK_REORDER_LEVEL_DESC' , 'Якщо кількість товару на складі менше, ніж вказане число в даній змінної, то в кошику виводиться попередження про недостатню кількість товару на складі для виконання замовлення.');

// Логи

define('STORE_PAGE_PARSE_TIME_DESC' , 'Зберігати час, витрачений на генерацію (парсинг) сторінок магазину.');
define('STORE_PAGE_PARSE_TIME_LOG_DESC' , 'Повний шлях до директорії і файлу, в який буде записуватися лог парсинга сторінок.');
define('STORE_PARSE_DATE_TIME_FORMAT_DESC' , 'Формат дати');
define('DISPLAY_PAGE_PARSE_TIME_DESC' , 'Показувати час парсинга сторінки в інтернет-магазині (опція Зберігати час парсинга сторінок повинна бути включена)');
define('STORE_DB_TRANSACTIONS_DESC' , 'Зберігати всі запити до бази даних у файлі, вказаному у змінній Директорія зберігання логів (тільки для PHP4 і вище)');

// Кэш

define('USE_CACHE_DESC' , 'Використовувати кешування інформації.');
define('DIR_FS_CACHE_DESC' , 'Директорія, куди будуть записуватися і зберігатися кеш-файли.');

// Настройка E-Mail

define('EMAIL_TRANSPORT_DESC' , 'Вкажіть, який спосіб відправки листів з магазина буде використовуватися. Для серверів, що працюють під управлінням Windows або MacOS необхідно встановити SMTP для відправки листів.');
define('EMAIL_LINEFEED_DESC' , 'Використовувана послідовність символів для поділу заголовків в листі.');
define('EMAIL_USE_HTML_DESC' , 'Відправляти листи з магазину в HTML форматі.');
define('ENTRY_EMAIL_ADDRESS_CHECK_DESC' , 'Перевіряти, чи вірні e-mail адреси вказуються при реєстрації в інтернет-магазині. Для перевірки використовується DNS.');
define('SEND_EMAILS_DESC' , 'Відправляти листи з магазину.');

// Скачивание

define('DOWNLOAD_ENABLED_DESC' , 'Дозволити функцію скачування товарів.');
define('DOWNLOAD_BY_REDIRECT_DESC' , 'Використовувати перенаправлення в браузері для скачування товару. Для не Unix систем (Windows, Mac OS і т.д.) повинно стояти false.');
define('DOWNLOAD_MAX_DAYS_DESC' , 'Встановіть кількість днів, протягом яких покупець може скачати свій товар. Якщо вкажіть 0, тоді термін існування посилання для скачування обмежений не буде.');
define('DOWNLOAD_MAX_COUNT_DESC' , 'Встановіть максимальну кількість завантажень для одного товару. Якщо вкажіть 0, тоді ніяких обмежень за кількістю скачувань не буде.');
define('DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE_DESC' , 'Який ID номер статусу замовлення скидає змінні Термін існування посилання для скачування (днів) і Максимальна кількість завантажень - За замовчуванням Доставляється (id код 4).');
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG_DESC' , 'Ви можете вказати повідомлення, яке буде показано клієнту, в разі, якщо він захоче завантажити ще неоплачений товар.');
define('DOWNLOADS_CONTROLLER_ORDERS_STATUS_DESC' , 'Завантаження файлу (файлів) буде дозволено тільки в разі, якщо замовлення буде мати вказаний статус (а саме id код статусу замовлення). За замовчуванням скачування дозволено для замовлень зі статусом чекаємо оплати (id код 2).');

// GZip Компрессия

define('GZIP_COMPRESSION_DESC', 'Дозволити HTTP GZip компресію.');
define('GZIP_LEVEL_DESC', 'Ви можете вказати рівень компресії від 0 до 9 (0 = мінімум, 9 = максимум).');

// Сессии

define('SESSION_WRITE_DIRECTORY_DESC', 'Якщо сесії зберігаються в файлах, то тут необхідно вказати повний шлях до папки, в якій будуть зберігатися файли сесій.');
define('SESSION_FORCE_COOKIE_USE_DESC', 'Примусово використовувати сесії, тільки коли в браузері активовані cookies.');
define('SESSION_CHECK_SSL_SESSION_ID_DESC', 'Перевіряти SSL_SESSION_ID при кожному зверненні до сторінки, захищеної протоколом HTTPS.');
define('SESSION_CHECK_USER_AGENT_DESC', 'Перевіряти змінну бразура user agent при кожному зверненні до сторінок інтернет-магазину.');
define('SESSION_CHECK_IP_ADDRESS_DESC', 'Перевіряти IP адреси клієнтів при кожному зверненні до сторінок інтернет-магазину.');
define('SESSION_BLOCK_SPIDERS_DESC', 'Не показувати сесію в адресі при зверненні до станицях магазину відомих пошукових павуків. Список відомих павуків знаходиться в файлі includes / spiders.txt.');
define('SESSION_RECREATE_DESC', 'Відтворювати сесію для генерації нового ID коду сесії при вході зареєстрованого покупця в магазин, або при реєстрації нового покупця (Тільки для PHP 4.1 і вище).');

// Тех. обслуживание

define('DOWN_FOR_MAINTENANCE_DESC' , 'Технічне обслуговування. Якщо включено, то в магазині не можна буде робити замовлення і буде виведено попередження про проведення технічного обслуговування магазину.<br>true - Включено<br>false - Виключено');
define('DOWN_FOR_MAINTENANCE_FILENAME_DESC' , 'Файл, який буде показаний в магазині, якщо включено Технічне обслуговування магазину. За замовчуванням - down_for_maintenance.php');
define('DOWN_FOR_MAINTENANCE_HEADER_OFF_DESC' , 'При включеному технічному обслуговуванні Ви можете заборонити показувати шапку магазину<br>true - Не показувати<Br>false - Показувати');
define('DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF_DESC' , 'При включеному технічному обслуговуванні Ви можете заборонити показувати ліву колонку магазину<br> true - Не показувати<Br>false - Показувати');
define('DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF_DESC' , 'При включеному технічному обслуговуванні Ви можете заборонити показувати праву колонку магазину<br>true - Не показувати<Br>false - Показувати');
define('DOWN_FOR_MAINTENANCE_FOOTER_OFF_DESC' , 'При включеному технічному обслуговуванні Ви можете заборонити показувати нижню частину магазина<br>true - Не показувати<Br>false - Показувати');
define('DOWN_FOR_MAINTENANCE_PRICES_OFF_DESC' , 'При включеному технічному обслуговуванні Ви можете заборонити показувати ціни на товари в магазині<br>true - Не показувати<Br>false - Показувати');
define('EXCLUDE_ADMIN_IP_FOR_MAINTENANCE_DESC' , 'Для зазначеного IP адреси магазин буде доступний навіть при включеному режимі Технічне обслуговування. Зазвичай тут вказує IP адреса адміністратора магазину.');
define('WARN_BEFORE_DOWN_FOR_MAINTENANCE_DESC' , 'Попереджати відвідувачів перед відходом на технічне обслуговування. Якщо технічне обслуговування вже включено, то ця опція автоматично встановлюється в false.');
define('PERIOD_BEFORE_DOWN_FOR_MAINTENANCE_DESC' , 'Вкажіть текст повідомлення.');
define('DISPLAY_MAINTENANCE_TIME_DESC' , 'Показувати дату активації режиму Технічне обслуговування.');
define('DISPLAY_MAINTENANCE_PERIOD_DESC' , 'Показувати протягом якого часу магазин буде знаходитись в режимі Технічне обслуговування.');
define('TEXT_MAINTENANCE_PERIOD_TIME_DESC' , 'Вкажіть час роботи магазину в режимі Технічне обслуговування');

// Оновлення Прайсу

define('DISPLAY_MODEL_DESC' , 'Показувати / Не відображати код товару');
define('MODIFY_MODEL_DESC' , 'Показувати / Не відображати код товару');
define('MODIFY_NAME_DESC' , 'Показувати / Не відображати назву товару');
define('DISPLAY_STATUT_DESC' , 'Показувати / Не відображати статус товару');
define('DISPLAY_WEIGHT_DESC' , 'Показувати / Не відображати вага товару');
define('DISPLAY_QUANTITY_DESC' , 'Показувати / Не відображати кількість товару');
define('DISPLAY_SORT_ORDER_DESC' , 'Показувати / Не відображати порядок сортування');
define('DISPLAY_ORDER_MIN_DESC' , 'Показувати / Не відображати мінімум для замовлення');
define('DISPLAY_ORDER_UNITS_DESC' , 'Показувати / Не відображати крок');
define('DISPLAY_IMAGE_DESC' , 'Показувати / Не відображати картинку товару');
define('MODIFY_MANUFACTURER_DESC' , 'Показувати / Не відображати виробника товару');
define('MODIFY_TAX_DESC' , 'Показувати / Не відображати податок');
define('DISPLAY_TVA_OVER_DESC' , 'Показувати / Не відображати ціни з податками');
define('DISPLAY_TVA_UP_DESC' , 'Показувати / Не відображати ціни з податками при зміні ціни');
define('DISPLAY_PREVIEW_DESC' , 'Показувати / Не відображати посилання на опис');
define('DISPLAY_EDIT_DESC' , 'Показувати / Не відображати посилання на редагування товару');
define('DISPLAY_MANUFACTURER_DESC' , 'Показувати / Не відображати виробника');
define('DISPLAY_TAX_DESC' , 'Показувати / Не відображати податок');
define('ACTIVATE_COMMERCIAL_MARGIN_DESC' , 'Показувати / Не відображати можливість масового зміни цін');

// Кэш страниц

define('ENABLE_PAGE_CACHE_DESC' , 'Дозволити кешування сторінок. Ця функція допомагає знизити навантаження на сервер і прискорити завантаження сторінок.');
define('PAGE_CACHE_LIFETIME_DESC' , 'Як довго кешувати сторінки (в хвилинах).');
define('PAGE_CACHE_DEBUG_MODE_DESC' , 'Включити режим налагодження (внизу сторінки). Не вмикайте цю опцію на працюючих магазинах! Ви можете включити режим налагодження просто додавши до URL адресою параметр ?debug = 1');
define('PAGE_CACHE_DISABLE_PARAMETERS_DESC' , 'В деяких випадках (наприклад, при включених коротких адресах) або при великій кількості партнерів може привести до надмірного використання дискового простору.');
define('PAGE_CACHE_DELETE_FILES_DESC' , 'Якщо встановлено в true, то при будь-якому наступному перегляді будь-якої сторінки в каталозі, все кеш файли будуть видалені, після цього поверніть false.');
define('PAGE_CACHE_UPDATE_CONFIG_FILES_DESC' , 'Якщо у Вас встановлений модуль configuration cache, вкажіть повний (абсолютний) шлях до файлу оновлення.');

// Яндекс маркет

define('YML_NAME_DESC' , 'Назва магазину для Яндекс-Маркет. Якщо поле пусте, то використовується STORE_NAME.');
define('YML_COMPANY_DESC' , 'Назва компанії для Яндекс-Маркет. Якщо поле пусте, то використовується STORE_OWNER.');
define('YML_DELIVERYINCLUDED_DESC' , 'Доставка включена у вартість товару');
define('YML_AVAILABLE_DESC' , 'Товар в наявності або під замовлення');
define('YML_AUTH_USER_DESC' , 'Логін для доступу до YML');
define('YML_AUTH_PW_DESC' , 'Пароль для доступу до YML');
define('YML_REFERER_DESC' , 'Додати в адресу товару параметр з посиланням на User agent або ip');
define('YML_STRIP_TAGS_DESC' , 'Прибирати html-теги в рядках');
define('YML_UTF8_DESC', 'Перекодувати в UTF-8');

//checkout

define('ONEPAGE_CHECKOUT_ENABLED_TITLE' , 'Увімкнуті перевірку однієї Сторінки');
define('ONEPAGE_DEFAULT_COUNTRY_TITLE' , 'Країна адреси за умовчанням');
define('ONEPAGE_ACCOUNT_CREATE_TITLE' , 'Створення облікового запису');
define('ONEPAGE_SHOW_CUSTOM_COLUMN_TITLE' , 'Показати спеціальну правильну колонку');
define('ONEPAGE_LOGIN_REQUIRED_TITLE' , 'Вимагати авторизацію перед оформленням замовлення');
define('ONEPAGE_SHOW_OSC_COLUMNS_TITLE' , 'Показати стовпці Oscommerce');
define('ONEPAGE_BOX_ONE_HEADING_TITLE' , 'Custom Colum Box # 1 Heading');
define('ONEPAGE_BOX_ONE_CONTENT_TITLE' , 'Спеціальна колонка № 1 вмісту');
define('ONEPAGE_BOX_TWO_HEADING_TITLE' , 'Спеціальна колонка № 2 заголовка');
define('ONEPAGE_BOX_TWO_CONTENT_TITLE' , 'Custom Colum Box 2 Content');
define('ONEPAGE_DEBUG_EMAIL_ADDRESS_TITLE' , 'Надіслаті відлагоджувальні електронні листи до:');
define('ONEPAGE_CHECKOUT_SHOW_ADDRESS_INPUT_FIELDS_TITLE' , 'Показати адресою у полях введення');
define('ONEPAGE_CHECKOUT_LOADER_POPUP_TITLE' , 'Зробити ПОВІДОМЛЕННЯ завантажувача');
define('ONEPAGE_AUTO_SHOW_BILLING_SHIPPING_TITLE' , 'Модулі виставленна рахунків / доставки автоматично відображаються');
define('ONEPAGE_AUTO_SHOW_DEFAULT_COUNTRY_TITLE' , 'Автоматичне виставленна рахунків / Пересилання за замовчуванню');
define('ONEPAGE_AUTO_SHOW_DEFAULT_STATE_TITLE' , 'Автоматичне виставленна рахунків / Пересилання за умовчанням');
define('ONEPAGE_AUTO_SHOW_DEFAULT_ZIP_TITLE' , 'Автосінхронне покази / доставка поштового індексу за замовчуванню');
define('ONEPAGE_ZIP_BELOW_TITLE', 'Перемістіті в поле Введення zip / поштового коду нижчих стан');
define('ONEPAGE_CHECKOUT_HIDE_SHIPPING_TITLE' , 'Чи не Показувати прапорці або способи доставки, если вага продуктів = 0');
define('ONEPAGE_ADDR_LAYOUT_TITLE' , 'Макет адреси');
define('ONEPAGE_TELEPHONE_TITLE' , 'Телефон потрібно');

define('GOOGLE_OAUTH_STATUS_TITLE', 'Ввімкнути Google Authorization');
define('GOOGLE_OAUTH_CLIENT_ID_TITLE', 'Google CLIENT ID');
define('GOOGLE_OAUTH_CLIENT_SECRET_TITLE', 'Google CLIENT SECRET');
define('GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED_TITLE', 'Увімкнути Google Analytics');
define('GOOGLE_TAGS_ID_TITLE', 'Google Tag ID (gtag.js) for Google Analytics');
define('GOOGLE_TAG_MANAGER_ID_TITLE', 'Google Tag Manager ID');
define('GOOGLE_TAGS_ID_STATUS_TITLE', 'Google Tags ID status');

define('GOOGLE_GOALS_PAGE_VIEW_TITLE', 'Ціль \'page_view\' - перегляд кожної сторінки');
define('GOOGLE_GOALS_ADD_TO_CART_TITLE', 'Ціль \'add_to_cart\' - коли клієнт додає товар у кошик');
define('GOOGLE_GOALS_ON_CHECKOUT_TITLE', 'Ціль \'checkout_view\' - перегляд сторінки оформлення замовлення');
define('GOOGLE_GOALS_CHECKOUT_PROCESS_TITLE', 'Ціль \'checkout_progress\' - клієнт успішно оформив замовлення');
define('GOOGLE_GOALS_CHECKOUT_SUCCESS_TITLE', 'Ціль \'checkout_success\' - перегляд сторінки після підтвердження замовлення');
define('GOOGLE_GOALS_CLICK_FAST_BUY_TITLE', 'Ціль \'fast_buy\' - коли клієнт натискає кнопку "Швидке замовлення" на сторінці товару');
define('GOOGLE_GOALS_LOGIN_TITLE', 'Ціль \'login\' - коли клієнт увійшов до системи');
define('GOOGLE_GOALS_ADD_REVIEW_TITLE', 'Ціль \'add_review\' - коли клієнт додав відгук');
define('GOOGLE_GOALS_FILTER_TITLE', 'Ціль \'filter\' - коли клієнт використовує фільтр для пошуку товарів');
define('GOOGLE_GOALS_CALLBACK_TITLE', 'Ціль \'callback\' - коли клієнт натискає кнопку \'Зворотний дзвінок\' у шапці сайту');
define('GOOGLE_GOALS_CLICK_ON_PHONE_TITLE', 'Ціль \'phone_call\' - коли клієнт натискає на іконку телефону');
define('GOOGLE_GOALS_CLICK_ON_CHAT_TITLE', 'Ціль \'click_chat\' - коли клієнт натискає на чат');
define('GOOGLE_GOALS_CONTACT_US_TITLE', 'Ціль \'contact_us\' - коли клієнт створив запит на сторінці контактів');
define('GOOGLE_GOALS_SUBSCRIBE_TITLE', 'Ціль \'subscribe\' - коли клієнт підписався');
define('GOOGLE_GOALS_CLICK_ON_BUG_REPORT_TITLE', 'Ціль \'bug_report\' - коли клієнт натискає \'Надіслати повідомлення про помилку\' в нижньому колонтитулі сайту');

define('GOOGLE_ECOMM_SUCCESS_PAGE_TITLE', 'Ціль електронної торгівлі \'purchase\' - перегляд сторінки після підтвердження замовлення');
define('GOOGLE_ECOMM_CHECKOUT_PAGE_TITLE', 'Ціль електронної торгівлі \'cart\' - сторінка оформлення замовлення');
define('GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE_TITLE', 'Ціль електронної торгівлі \'product\' - перегляд сторінки продукту');
define('GOOGLE_ECOMM_SEARCH_RESULTS_TITLE', 'Ціль електронної торгівлі \'searchresults\'- перегляд сторінки результатів пошуку');
define('GOOGLE_ECOMM_HOME_PAGE_TITLE', 'Ціль електронної торгівлі \'home\' - перегляд сторінки продукту');
define('GOOGLE_ECOMM_CLICK_FAST_BUY_TITLE', 'Ціль електронної комерції \'Purchase\' - коли клієнт підтверджує \'Quick order\' на сторінці товару');

define('DEFAULT_CAPTCHA_STATUS_TITLE', 'Captcha');
define('GOOGLE_RECAPTCHA_STATUS_TITLE', 'Google Recaptcha Status');
define('GOOGLE_RECAPTCHA_PUBLIC_KEY_TITLE', 'Google Recaptcha PUBLIC KEY');
define('GOOGLE_RECAPTCHA_SECRET_KEY_TITLE', 'Google Recaptcha SECRET KEY');

define('FACEBOOK_AUTH_STATUS_TITLE', 'Facebook Авторизація');

define('RCS_BASE_DAYS_TITLE', 'Продивитись минулі дні');
define('RCS_SKIP_DAYS_TITLE', 'Кількість днів, які потрібно пропустити');
define('RCS_REPORT_DAYS_TITLE', 'Використовуйте обчислені податки');
define('RCS_INCLUDE_TAX_IN_PRICES_TITLE', 'Використовуйте фіксовану ставку податку');
define('RCS_USE_FIXED_TAX_IN_PRICES_TITLE', 'Фіксована ставка податку ');
define('RCS_FIXED_TAX_RATE_TITLE', 'Дні звітів про результати продажів');
define('RCS_EMAIL_TTL_TITLE', 'Час життя email.');
define('RCS_EMAIL_FRIENDLY_TITLE', 'Дружні електронні листи');
define('RCS_EMAIL_COPIES_TO_TITLE', 'Копії електронною поштою на');
define('RCS_SHOW_ATTRIBUTES_TITLE', 'Показати атрибути');
define('RCS_CHECK_SESSIONS_TITLE', 'Ігноруйте клієнтів сеансами');
define('RCS_CURCUST_COLOR_TITLE', ' Поточний клієнт');
define('RCS_UNCONTACTED_COLOR_TITLE', 'Колір виділення рядків для безконтактних клієнтів.');
define('RCS_CONTACTED_COLOR_TITLE', "Колір виділення рядків для зв'язаних клієнтів.  ");
define('RCS_MATCHED_ORDER_COLOR_TITLE', "Узгодження порядку замовлення");
define('RCS_SKIP_MATCHED_CARTS_TITLE', 'Пропустіть записи з / відповідними замовленнями');
define("RCS_AUTO_CHECK_TITLE", "Автоматично перевірити \"безпечні\" візки на електронну пошту");
define('RCS_CARTS_MATCH_ALL_DATES_TITLE', 'Збігайте замовлення з будь-якої дати');
define('RCS_PENDING_SALE_STATUS_TITLE', 'Очікує статусів продажів');
define('RCS_REPORT_EVEN_STYLE_TITLE', 'Повідомте навіть про стиль стилю');
define('RCS_REPORT_ODD_STYLE_TITLE', 'Повідомити про стиль непарних рядків');
define('STORE_SCRIPTS_TITLE' , 'Підключення JS скриптів');
define('STORE_METAS_TITLE' , 'Підключення Meta-тегів в head');

define ('DEFAULT_DATE_FORMAT_TITLE', "Формат дати за замовчуванням");
define ('DEFAULT_FORMATED_DATE_FORMAT_TITLE', "Заголовок форматованого формату дати за замовчуванням");

define('DISPLAY_PRICE_WITH_TAX_CHECKOUT_TITLE', 'Рахувати податок при оформленні замовлення');

define('SET_JIVOSITE_TITLE', 'Онлайн консультант');
define('INSTAGRAM_LINK_SLIDE_TITLE', 'Instagram ссилка для слайдера');

define('STORE_BANK_INFO_TITLE', 'Інформація про банк для рахунок-фактури');
define('STORE_TIME_ZONE_TITLE', 'Часовий пояс');

define('JIVOSITE_WIDGET_ID_TITLE', 'Ідентифікатор віджету JivoSite');
define('CHANGE_BY_GEOLOCATION_TITLE', 'Переключення валюти та мови залежно від геолокації');
define('GET_BROWSER_LANGUAGE_TITLE', 'Перемикати сайт на мову браузера');
define('DOMEN_URL_TITLE', 'Адреса домену');
define('DOMEN_URL_DESC', 'Вы можете встановити власне iм\'я домену');
define('STOCK_ALLOW_CHECKOUT_WITH_ATTR_COUNT_0_TITLE', 'Дозволити купувати при 0 в атрибутах товару');
define('STOCK_ALLOW_CHECKOUT_WITH_ATTR_COUNT_0_DESC', 'Дозволити купувати при кількості 0 в атрибутах товару');
define('SSL_EXIST', 'Сертифікат випущений');
define('SSL_NON_EXIST', 'Випустити сертифікат');
define('SSL_ARE_YOU_SURE', 'Це запустить процедуру генерації персонального сертифіката SSL для домену. Ви впевнені?');
define('QUICK_ORDER_ENABLED_TITLE' , "Кнопка \"Швидке замовлення\"");