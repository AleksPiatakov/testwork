<?php
/*
  $Id: template_configuration.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Настройка шаблона');
define('TABLE_HEADING_TEMPLATE', 'Название');
define('TABLE_HEADING_TEMPLATE_FOLDER', 'Папка');
define('TABLE_HEADING_ACTION', 'Действие');
define('TABLE_HEADING_ACTIVE', 'Статус');
define('TABLE_HEADING_COLOR', 'Цвет');
define('CONTENT_WIDTH', 'Ширина контента');
define('CONTENT_WIDTH_CONTENT', 'Максимальная ширина 100%');
define('CONTENT_WIDTH_FIX', 'Максимальная ширина 1440 пикселей');
define('SHOW_SHORTCUT_TREE', 'Показывать подкатегории только для текущей категории');


define('TABLE_HEADING_DISPLAY_COLUMN_LEFT', 'Показывать левую колонку?');
define('SLIDER_SIZE_CONTENT', 'Размещение слайдера');
define('SLIDER_RIGHT', 'В правой колонке');
define('SLIDER_CONTENT_WIDTH', 'По ширине контента');
define('SLIDER_CONTENT_WIDTH_100', 'По ширине страницы(100%)');

define('GENERAL_MODULES', 'Основные блоки сайта');
define('HEADER_MODULES', 'Блоки шапки');
define('LEFT_MODULES', 'Блоки в левой колонке');
define('MAINPAGE_MODULES', 'Блоки на главной странице');
define('FOOTER_MODULES', 'Блоки подвала');
define('OTHER_MODULES', 'Другие блоки');

#from c\templates\solo\boxes\configuration.php:
define('ARTICLE_NAME', 'Название статьи');      
define('TOPIC_NAME', 'Название категории');
define('LIMIT', 'Лимит');
define('INSTAGRAM_URL', 'Ссылка для слайдера');
define('LIMIT_MOBILE', 'Лимит мобильный вид');
define('COLS', 'Кол. столбцов');
define('SLIDER_WIDTH_TITLE', 'Ширина');   
define('SLIDER_HEIGHT_TITLE', 'Высота');
define('SLIDER_HEIGHT_MOBILE_TITLE', 'Высота мобильный вид');  
define('SLIDER_AUTOPLAY_TITLE', 'Автопрокрутка');
define('SLIDER_AUTOPLAY_DELAY_TITLE', 'Задержка Автопрокрутки');

#from BD table infobox_configuration:

##FOOTER BOXES
define('F_ARTICLES_BOTTOM', 'Статьи в подвале');
define('F_FOOTER_CATEGORIES_MENU', 'Категории в подвале');
define('F_TOP_LINKS', 'Инфостраницы в подвале');
define('F_MONEY_SYSTEM', 'Показать платежные системы');
define('F_SOCIAL', 'Показать социальные сети футера');
define('F_CONTACTS_FOOTER', 'Показать контакты в подвале');
define('F_WEB_STUDIO_LINK', 'Ссылка на вебстудию');

##HEADER BOXES
define('H_LOGIN', 'Логин');
define('H_LOGO', 'Лого');
define('H_COMPARE', 'Сравнение');
define('H_LANGUAGES', 'Языки');
define('H_CURRENCIES', 'Валюта');
define('H_ONLINE', 'Показывать "Онлайн консультант"');
define('H_SEARCH', 'Поиск');
define('H_SHOPPING_CART', 'Корзина');
define('H_WISHLIST', 'Список пожеланий');
define('H_TEMPLATE_SELECT', 'Выбор шаблона');
define('H_TOP_MENU', 'Меню категорий');
define('H_TOP_MENU_MOBILE', 'Мобильное меню категорий');
define('H_CALLBACK', 'Перезвоните мне');
define('H_TOP_LINKS', 'Верхнее меню');
define('H_TOGGLE_MOBILE_VISIBLE', 'Видимость категорий');
define('H_LOGIN_FB', 'Показывать вход через Facebook');

##OTHER_MODULES
/*define('O_LOGIN', 'Логин');
define('O_INFORMATION', 'Информация');
define('O_TEMPLATE_SELECT', 'Выбор шаблона');
define('O_SHOPPING_CART', 'Корзина');
define('O_SEARCH', 'Поиск');
define('O_ONLINE', 'Онлайн чат');
define('O_COMPARE', 'Сравнение');
define('O_CURRENCIES', 'Валюта');
define('O_LANGUAGES', 'Языки');
define('O_TOP_LINKS', 'Верхнее меню');
define('O_CALLBACK', 'Перезвоните мне');
define('O_TOP_MENU', 'Меню категорий');*/
define('O_FILTER', 'Фильтры');
define('LIST_FILTER', 'Фильтры');

##LEFT_MODULES
define('L_FEATURED', 'Рекомендуемые');
define('L_WHATS_NEW', 'Новинки');
define('L_SPECIALS', 'Скидки');
define('L_MANUFACTURERS', 'Производители');
define('L_BESTSELLERS', 'Топ продаж');
define('L_ARTICLES', 'Статьи');
define('L_POLLS', 'Опросы');
define('L_FILTER', 'Фильтры');
define('L_BANNER_1', 'Баннер 1');
define('L_BANNER_2', 'Баннер 2');
define('L_BANNER_3', 'Баннер 3');
define('L_SUPER', 'Категории');
define('L_SUPER_TOPIC', 'Разделы Статей');

##MAINPAGE_MODULES
define('M_INSTAGRAM', 'Instagram');
define('M_SEARCH_QUERIES', 'Поисковые запросы');
define('M_ARTICLES_MAIN', 'Новости');
define('M_BANNER_LONG', 'Баннер длинный');
define('M_BEST_SELLERS', 'Топ продаж');
define('M_BROWSE_CATEGORY', 'Категории');
define('M_DEFAULT_SPECIALS', 'Скидки');
define('M_FEATURED', 'Рекомендуемые');
define('M_LAST_COMMENTS', 'Последние комментарии');
define('M_VIEW_PRODUCTS', 'Просмотренные товары');
define('M_MAINPAGE', 'Текст главной');
define('M_MANUFACTURERS', 'Производители');
define('M_MOST_VIEWED', 'Топ просмотров');
define('M_NEW_PRODUCTS', 'Новинки');
define('M_SLIDE_MAIN', 'Слайдер');
define('M_BANNER_1', 'Баннер 1');
define('M_CATEGORIES_TABS', 'Табы категорий');
define('M_CATEGORIES_TABS_NEW', 'Новинки');
define('M_CATEGORIES_TABS_FEATURED', 'Рекомендуемые');
define('M_CATEGORIES_TABS_SPECIAL', 'Скидки');
define('M_CATEGORIES_TABS_BEST_SELLERS', 'Топ продаж');
define('M_CATEGORIES_TABS_NEW_PRODUCTS', 'Новинки');

##MAINPAGE_MODULES
define('G_HEADER_1', 'Горизонтальная полоса в шапке 1');
define('G_HEADER_2', 'Горизонтальная полоса в шапке 2');
define('G_LEFT_COLUMN', 'Левая колонка');
define('G_FOOTER_1', 'Горизонтальная полоса внизу 1');
define('G_FOOTER_2', 'Горизонтальная полоса внизу 2');
define('M_BANNER_BLOCK', 'Двойной баннер на главной');

##MAINCONF
define('ADD_MODULE_MODULES', 'Add module');
define('MAINCONF_MODULES', 'Основные настройки');
define('MC_COLOR_1', 'Цвет текста');
define('MC_COLOR_2', 'Цвет ссылок');
define('MC_COLOR_3', 'Цвет фона');
define('MC_COLOR_4', 'Фон шапки');
define('MC_COLOR_5', 'Фон подвала');
define('MC_COLOR_6', 'Цвет кнопок');
define('MC_COLOR_BTN_TEXT', 'Текст кнопок');
define('MC_COLOR_GREY', 'Серые элементы');
define('MC_SHOW_LEFT_COLUMN', 'Показать левую колонку');
define('MC_PRODUCT_QNT_IN_ROW', 'Количество товаров в строке');
define('MC_PRODUCT_MARGIN','Отступ между товарами');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE', 'Количество товаров на странице');
define('MC_THUMB_WIDTH', 'Ширина маленького изображения');
define('MC_THUMB_HEIGHT', 'Высота маленького изображения');
define('MC_SHOW_THUMB2', 'Менять картинку при наведении');
define('MC_THUMB_FIT', 'Растягивать картинку товара');

##LISTING
define('LISTING_MODULES', 'Список товаров');
define('LIST_MODEL', 'Показывать код товара');
define('LIST_BREADCRUMB', 'Показывать хлебные крошки');
define('LIST_CONCLUSION', 'Показывать формат вывода товара');
define('LIST_QUANTITY_PAGE', 'Показывать количество товаров на странице');
define('LIST_SORTING', 'Показывать сортировку товаров');
define('LIST_LOAD_MORE', 'Показывать кнопку "Показать еще"');
define('LIST_NUMBER_OF_ROWS', 'Показывать нумерацию страниц');
define('LIST_SHOW_FORMAT', 'Формат вывода товара');
define('LIST_PRESENCE', 'Показывать наличие товара');

##PRODUCT_INFO
define('PRODUCT_INFO_MODULES', 'Страница товара');
define('P_MODEL', 'Показывать код товара');
define('P_BREADCRUMB', 'Показывать хлебные крошки');
define('P_SOCIAL_LIKE', 'Показывать лайки через соцсети');
define('P_PRESENCE', 'Показывать наличие товара');
define('P_BUY_ONE_CLICK', 'Показывать "Купить в один клик"');
define('P_ATTRIBUTES', 'Показывать атрибуты товара');
define('P_SHARE', 'Показывать поделиться в соцсетях');
define('P_COMPARE', 'Показывать отметку сравнения');
define('P_WISHLIST', 'Показывать отметку списка желаний');
define('P_RATING', 'Показывать рейтинг продукта');
define('P_SHORT_DESCRIPTION', 'Показывать краткое описание');
define('P_RIGHT_SIDE', 'Показывать правую колонку');
define('P_TAB_DESCRIPTION', 'Показывать вкладку описания');
define('P_TAB_CHARACTERISTICS', 'Показывать вкладку характеристик');
define('P_TAB_COMMENTS', 'Показывать вкладку комментариев');
define('P_TAB_PAYMENT_SHIPPING', 'Показывать вкладку оплаты и доставки');
define('P_WARRANTY', 'Гарантия');
define('P_DRUGIE', 'Показывать похожие товары');
define('P_XSELL', 'Показывать сопутствующие товары');
define('P_SHOW_QUANTITY_INPUT', 'Показывать поле "количество товара"');
define('P_FILTER', 'Фильтры');
define('P_BETTER_TOGETHER', 'Показать блок "Лучше вместе"');
define('LIST_SHOW_PDF_LINK', 'Показать PDF-ссылку');
define('LIST_DISPLAY_TYPE', 'Формат вывода товара');