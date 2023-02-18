<?php
/*
  $Id: template_configuration.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Налаштування шаблону');
define('TABLE_HEADING_TEMPLATE', 'Назва');
define('TABLE_HEADING_TEMPLATE_FOLDER', 'Папка');
define('TABLE_HEADING_ACTION', 'Дія');
define('TABLE_HEADING_ACTIVE', 'Статус');
define('TABLE_HEADING_COLOR', 'Колір');

define('TABLE_HEADING_DISPLAY_COLUMN_LEFT', 'Показувати ліву колонку?');
define('SLIDER_SIZE_CONTENT', 'Розміщення слайдера');
define('SLIDER_RIGHT', 'У правій колонці');
define('SLIDER_CONTENT_WIDTH', 'По ширині контенту');
define('SLIDER_CONTENT_WIDTH_100', 'По ширині сторінки(100%)');
define('CONTENT_WIDTH', 'Ширина контенту');
define('CONTENT_WIDTH_CONTENT', 'Максимальна ширина 100%');
define('CONTENT_WIDTH_FIX', 'Максимальна ширина 1440 пікселів');
define('SHOW_SHORTCUT_TREE', 'Показувати підкатегорії тільки для поточної категорії');
define('SHOW_ALL_LABELS_ON_DESKTOP', 'Показувати всі лейбли на робочому столі');
define('SHOW_ALL_LABELS_ON_MOBILE', 'Показувати всі лейбли на мобільному телефоні');
define('SHOW_SPECIAL_LABEL_WITH_SPECIAL', 'Показувати лейблу знижки, якщо є знижка');

define('GENERAL_MODULES', 'Основні блоки сайта');
define('HEADER_MODULES', 'Блоки шапки');
define('LEFT_MODULES', 'Блоки в лівій колонці');
define('MAINPAGE_MODULES', 'Блоки на головній сторінці');
define('FOOTER_MODULES', 'Блоки підвалу');
define('OTHER_MODULES', 'Інші блоки');

#from c\templates\solo\boxes\configuration.php:
define('ARTICLE_NAME', 'Назва статті');
define('TOPIC_NAME', 'Назва категорії');
define('LIMIT', 'Ліміт');
define('LIMIT_MOBILE', 'Ліміт мобільний вид');
define('COLS', 'Кіл. стовпців');
define('SLIDER_WIDTH_TITLE', 'Ширина');   
define('SLIDER_HEIGHT_TITLE', 'Висота');
define('SLIDER_HEIGHT_MOBILE_TITLE', 'Висота (мобільний вигляд)');  
define('SLIDER_AUTOPLAY_TITLE', 'Затримка Автопрокрутки');
define('SLIDER_AUTOPLAY_DELAY_TITLE', 'Автопрокрутка');

#from BD table infobox_configuration:
##FOOTER BOXES
define('F_ARTICLES_BOTTOM', 'Статті в футері');
define('F_FOOTER_CATEGORIES_MENU', 'Категорії в футері');
define('F_TOP_LINKS', 'Інфосторінки в футері');
define('F_MONEY_SYSTEM', 'Показати платіжні системи');
define('F_SOCIAL', 'Показати соціальні мережі футера');
define('F_CONTACTS_FOOTER', 'Показати контакти в підвалі');
define('F_WEB_STUDIO_LINK', 'Посилання на постачальника послуги');
define('TEXT_UNAVAILABLE_IN_FREE_PACKAGE', 'Недоступно в пакеті free');

##HEADER BOXES
define('H_LOGIN', 'Логін');
define('H_LOGO', 'Лого');
define('H_COMPARE', 'Порівняння');
define('H_LANGUAGES', 'Мови');
define('H_CURRENCIES', 'Валюта');
define('H_ONLINE', 'Показувати Онлайн консультант');
define('H_SEARCH', 'Пошук');
define('H_SHOPPING_CART', 'Кошик');
define('H_WISHLIST', 'Список побажань');
define('H_TEMPLATE_SELECT', 'Вибір шаблону');
define('H_TOP_MENU', 'Меню категорій');
define('H_TOP_MENU_MOBILE', 'Мобільний меню категорій');
define('H_CALLBACK', 'Передзвоніть мені');
define('H_TOP_LINKS', 'Верхнє меню');
define('H_TOGGLE_MOBILE_VISIBLE', 'Видимість категорій');
define('H_LOGIN_FB', 'Показувати вхід через Facebook');

##OTHER_MODULES
/*define('O_LOGIN', 'Логин');
define('O_TEMPLATE_SELECT', 'Вибір шаблону');
define('O_SHOPPING_CART', 'Корзина');
define('O_SEARCH', 'Пошук');
define('O_ONLINE', 'В сети');
define('O_COMPARE', 'Порівняння');
define('O_CURRENCIES', 'Валюта');
define('O_LANGUAGES', 'Мови');
define('O_TOP_LINKS', 'Верхнє меню');
define('O_CALLBACK', 'Передзвоніть мені');
define('O_TOP_MENU', 'Меню категорій');*/
define('O_FILTER', 'Фільтри');
define('LIST_FILTER', 'Фільтри');

##LEFT_MODULES
define('L_FEATURED', 'Рекомендовані');
define('L_WHATS_NEW', 'Новинки');
define('L_SPECIALS', 'Знижки');
define('L_MANUFACTURERS', 'Виробники');
define('L_BESTSELLERS', 'Топ продажів');
define('L_ARTICLES', 'Статті');
define('L_POLLS', 'Опитування');
define('L_FILTER', 'Фільтри');
define('L_BANNER_1', 'Банер 1');
define('L_BANNER_2', 'Банер 2');
define('L_BANNER_3', 'Банер 3');
define('L_SUPER', 'Категорії');
define('L_SUPER_TOPIC', 'Розділи статей');


##MAINPAGE_MODULES
define('M_ARTICLES_MAIN', 'Новини');
define('M_BANNER_LONG', 'Банер довгий');
define('M_BEST_SELLERS', 'Топ продажів');
define('M_BROWSE_CATEGORY', 'Категорії');
define('M_DEFAULT_SPECIALS', 'Знижки');
define('M_FEATURED', 'Рекомендовані');
define('M_LAST_COMMENTS', 'Останні коментарі');
define('M_VIEW_PRODUCTS', 'Переглянуті товари ');
define('M_MAINPAGE', 'Текст головної');
define('M_MANUFACTURERS', 'Виробники');
define('M_MOST_VIEWED', 'Топ переглядів');
define('M_NEW_PRODUCTS', 'Новинки');
define('M_SLIDE_MAIN', 'Слайдер');
define('M_BANNER_1', 'Банер 1');
define('M_CATEGORIES_TABS', 'Таби категорій');
define('M_CATEGORIES_TABS_NEW', 'Новинки');
define('M_CATEGORIES_TABS_FEATURED', 'Рекомендовані');
define('M_CATEGORIES_TABS_SPECIAL', 'Знижки');
define('M_CATEGORIES_TABS_BEST_SELLERS', 'Топ продажів');
define('M_CATEGORIES_TABS_NEW_PRODUCTS', 'Новинки');
define('M_SUBSCRIBE', 'Підписка на нову розсилку');
define('M_SUBSCRIBE_SPECIAL', 'Знижка за підписку');
define('M_SUBSCRIBE_SPECIAL_PERCENT', 'Відсоток знижки %');
define('M_SUBSCRIBE_COUPONE_MAIL', 'Надсилати купон');
define('M_SUBSCRIBE_COUPONE', 'Купон');

##MAINPAGE_MODULES
define('G_HEADER_1', 'Горизонтальна смуга в шапці 1');
define('G_HEADER_2', 'Горизонтальна смуга в шапці 2');
define('G_LEFT_COLUMN', 'Ліва колонка');
define('G_FOOTER_1', 'Горизонтальна смуга внизу 1');
define('G_FOOTER_2', 'Горизонтальна смуга внизу 2');
define('M_BANNER_BLOCK', 'Подвійний банер на головну');

##MAINCONF
define('ADD_MODULE_MODULES', 'Add module');
define('MAINCONF_MODULES', 'Основні налаштування');
define('MC_COLOR_1', 'Колір тексту');
define('MC_COLOR_2', 'Колір посилань');
define('MC_COLOR_3', 'Колір фону');
define('MC_COLOR_4', 'Фон шапки');
define('MC_COLOR_5', 'Фон підвалу');
define('MC_COLOR_6', 'Колір кнопок');
define('MC_COLOR_BTN_TEXT', 'Текст кнопок');
define('MC_COLOR_GREY', 'Сірі елементи');
define('MC_SHOW_LEFT_COLUMN', 'Показати / приховати ліву колонку');
define('MC_PRODUCT_QNT_IN_ROW', 'Кількість товарів в рядку');
define('MC_PRODUCT_MARGIN','Відступ між товарами');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE', 'Кількість товарів на сторінці');
define('MC_THUMB_WIDTH', 'Ширина маленького зображення');
define('MC_THUMB_HEIGHT', 'Висота маленького зображення');
define('H_LOGO_WIDTH', 'Ширина логотипу');
define('H_LOGO_HEIGHT', 'Висота логотипу');
define('H_LOGO_WIDTH_MOBILE', 'Ширина логотипу (mobile)');
define('H_LOGO_HEIGHT_MOBILE', 'Висота логотипу (mobile)');
define('MC_SHOW_THUMB2', 'Змінювати картинку при наведенні');
define('MC_THUMB_FIT', 'Розтягувати картинку товару');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO', 'Вкажіть потрібну кількість товарів на сторінці');
define('CONTENT_WIDTH_INFO', 'Виберіть ширину контенту із запропонованих варіантів');
define('MC_PRODUCT_QNT_IN_ROW_INFO', 'Вкажіть потрібну кількість товарів у рядку');
define('MC_THUMB_HEIGHT_INFO', 'Вкажіть висоту маленького зображення');
define('MC_THUMB_WIDTH_INFO', 'Вкажіть ширину маленького зображення');
define('MC_SHOW_LEFT_COLUMN_INFO', 'Ви можете увімкнути/вимкнути виведення лівої колонки контенту');
define('MC_LOGO_WIDTH_INFO', 'Вкажіть ширину логотипу вашого сайту');
define('MC_LOGO_HEIGHT_INFO', 'Вкажіть висоту логотипу вашого сайту');
define('MC_PRODUCT_MARGIN_INFO', 'Можете вказати потрібний відступ між товарами');
define('LIST_DISPLAY_TYPE_INFO', 'Можете вказати формат виведення товару: list – списком, columns – таблицею');
define('MC_THUMB_FIT_INFO', 'Виберіть потрібне значення: contain - збереження пропорцій картинки, cover-масштабує зображення на весь блок');
define('MC_SHOW_THUMB2_INFO', 'Можете увімкнути/вимкнути ефект зміни однієї картинки на іншу при наведенні на неї курсору');
define('MC_COLOR_1_INFO', 'Натисніть на палітру, щоб змінити колір тексту для Вашого сайту');
define('MC_COLOR_4_INFO', 'Натисніть на палітру, щоб змінити фон шапки сайту');
define('MC_COLOR_5_INFO', 'Натисніть на палітру для зміни фону підвалу');
define('MC_COLOR_2_INFO', 'Натисніть на палітру, щоб змінити колір посилань Вашого сайту');
define('MC_COLOR_6_INFO', 'Натисніть на палітру, щоб змінити колір кнопок сайту');
define('MC_COLOR_3_INFO', 'Натисніть на палітру, щоб змінити колір фону Вашого сайту');
define('MC_COLOR_BTN_TEXT_INFO', 'Натисніть на панелі, щоб змінити колір тексту для кнопок');
define('MC_COLOR_GREY_INFO', 'Натисніть на панелі, щоб змінити колір сірих елементів');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_DEL', 'Видалити значення');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_ADD', 'Додати значення');
define('MC_PRODUCT_QNT_IN_ROW_INFO_0', 'Телефон < 768px. Значення \'3\' прирівнюється до \'2\', якщо ≤ 480px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_1', 'Планшет (вертикально) < 992px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_2', 'Планшет (горизонтально) < 1200px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_3', 'Дисплей < 1600px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_4', 'Дисплей ≥ 1600px');

##LISTING
define('LISTING_MODULES', 'Список товарів');
define('LIST_MODEL', 'Показувати код товару');
define('LIST_BREADCRUMB', 'Показувати хлібні крихти');
define('LIST_CONCLUSION', 'Показувати формат виведення товару');
define('LIST_QUANTITY_PAGE', 'Показувати кількість товарів на сторінці');
define('LIST_SORTING', 'Показувати сортування товарів');
define('LIST_LOAD_MORE', 'Показувати кнопку "Показати ще"');
define('LIST_NUMBER_OF_ROWS', 'Показувати нумерацію сторінок');
define('LIST_PRESENCE', 'Показувати наявність товару');
define('LIST_LABELS', 'Показувати лейбли');

##PRODUCT_INFO
define('PRODUCT_INFO_MODULES', 'Сторінка товару');
define('P_MODEL', 'Показувати код товару');
define('P_BREADCRUMB', 'Показувати хлібні крихти');
define('P_SOCIAL_LIKE', 'Показувати лайки через соцмережі');
define('P_PRESENCE', 'Показувати наявність товару');
define('P_BUY_ONE_CLICK', 'Показувати "Купити в один клік"');
define('P_ATTRIBUTES', 'Показувати атрибути товару');
define('P_SHARE', 'Показувати поділитися в соціальних мережах');
define('P_COMPARE', 'Показувати позначку порівняння');
define('P_WISHLIST', 'Показувати позначку списку бажань');
define('P_RATING', 'Показувати рейтинг продукту');
define('P_SHORT_DESCRIPTION', 'Показувати короткий опис');
define('P_RIGHT_SIDE', 'Показувати праву колонку');
define('P_TAB_DESCRIPTION', 'Показувати вкладку опису');
define('P_TAB_CHARACTERISTICS', 'Показувати вкладку характеристик');
define('P_TAB_COMMENTS', 'Показувати вкладку коментарів');
define('P_TAB_PAYMENT_SHIPPING', 'Показувати вкладку оплати і доставки');
define('P_WARRANTY', 'Гарантія');
define('P_DRUGIE', 'Показувати схожі товари');
define('P_XSELL', 'Показувати супутні товари');
define('P_SHOW_QUANTITY_INPUT', 'Показувати поле "кількість товару"');
define('P_FILTER', 'Фільтри');
define('P_BETTER_TOGETHER', 'Показати блок "Краще разом"');
define('LIST_SHOW_PDF_LINK', 'Показати PDF-посилання');
define('LIST_DISPLAY_TYPE', 'Формат виведення товару');
define('INSTAGRAM_URL', 'Посилання для слайдера');
define('M_INSTAGRAM', 'Instagram');
define('M_SEARCH_QUERIES', 'Пошукові запити');
define('SHOW_SHORTCUT_LEFT_TREE', 'Показати згорнуте ліве дерево');
define('F_FOOTER_CATEGORIES', 'Категорії в футері');
define('P_SHOW_PROD_QTY_ON_PAGE', 'Показувати залишок товару на складі');
define('P_LABELS', 'Показувати лейбли');