<?php
/*
  $Id: products_attributes.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Атрибуты товаров');
define('HEADING_TITLE_OPT', 'Атрибуты товаров');
define('HEADING_TITLE_VAL', 'Значения атрибутов');
define('HEADING_TITLE_ATRIB', 'Атрибуты товаров');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_PRODUCT', 'Название товара');
define('TABLE_HEADING_OPT_NAME', 'Название атрибута');

// otf 1.71 New field definitions
define('TABLE_HEADING_OPT_TYPE', 'Тип атрибута');
define('TABLE_HEADING_OPT_GROUP', 'Группа атрибута');
define('TABLE_HEADING_OPT_LENGTH', 'Показывать в фильтре');
define('TABLE_HEADING_OPT_COMMENT', 'Показывать в списке товаров');

define('TABLE_HEADING_OPT_VALUE', 'Значение атрибута');
define('TABLE_HEADING_OPT_PRICE', 'Цена');
define('TABLE_HEADING_OPT_PRICE_PREFIX', 'Префикс');
define('TABLE_HEADING_ACTION', 'Действие');
define('TABLE_HEADING_DOWNLOAD', 'Скачиваемые товары:');
define('TABLE_TEXT_FILENAME', 'Имя файла:');
define('TABLE_HEADING_FILENAME', 'Имя файла');
define('TABLE_TEXT_MAX_DAYS', 'Дата окончания:');
define('TABLE_TEXT_MAX_COUNT', 'Максимум загрузок:');

define('MAX_ROW_LISTS_OPTIONS', 10);

define('TEXT_WARNING_OF_DELETE', 'Эта опция связана с товарами и не сохранится после ее удаления.');
define('TEXT_OK_TO_DELETE', 'Эта опция не связана с товарами и не сохранится после ее удаления.');
define('TEXT_OPTION_ID', 'Код атрибута');
define('TEXT_OPTION_NAME', 'Название атрибута');
define('TEXT_OPTION_SORT_ORDER', 'Порядок сортировки:');

define('TEXT_PRAT_DEL', 'удалить');
define('TEXT_PRAT_COLOR', 'Изображение');
define('TEXT_ALERT1', 'Ошибка: есть товары (в количестве <b>%d</b>) в котрых указано значение данного атрибута');
define('TEXT_ALERT2', 'У этого атрибута есть связанные значения (в количестве <b>%d</b>), при удалении арибута заначения будут удалены. Вы уверены что хотете удалить атрибут?');

define('TEXT_TYPE_TEXT','Текст');
define('TEXT_TYPE_SELECT','Dropdown');
define('TEXT_TYPE_RADIO','Radio');
define('TEXT_TYPE_CHECKBOX','Checkbox');
define('TEXT_TYPE_TEXTAREA','Изображение');

define('HEADING_TITLE_GROUP', 'Группы атрибутов');
define('TEXT_OPTION_GROUP_NAME', 'Название группы атрибутов');
?>