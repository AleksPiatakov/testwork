<?php
/*
  $Id: specials.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Скидки');

define('TABLE_HEADING_PRODUCTS', 'Товары');
define('TABLE_HEADING_PRODUCTS_ID', 'ID');
define('TABLE_HEADING_PRODUCTS_PRICE', 'Цена');
define('TABLE_HEADING_PRODUCTS_VENDOR_CODE', 'Артикул');
define('TABLE_HEADING_STATUS', 'Состояние');
define('TABLE_HEADING_ACTION', 'Действие');
define('TABLE_HEADING_MODEL', 'Модель');

define('TEXT_SPECIALS_PRODUCT', 'Товар:');
define('TEXT_SPECIALS_PRODUCT_WITHOUT_ATTRIBUTES', 'Без атрибутов');
define('TEXT_SPECIALS_PRODUCT_All_ATTRIBUTES', 'Все атрибуты');
define('TEXT_SPECIALS_SPECIAL_PRICE', 'Специальная цена:');
define('TEXT_SPECIALS_EXPIRES_DATE', 'Действует До:');
define('TEXT_SPECIALS_START_DATE', 'Действует c:');
define('TEXT_DISPLAY_COUNTDOWN', 'Показывать отсчет:');
define('TEXT_SPECIALS_PRICE_TIP', '<b>Примечание:</b><ul><li>Вы можете ввести процент скидки в поле "Специальная Цена", например: <b>20%</b></li><li>Если Вы вводите новую цену, десятичный разделитель должен быть \'.\' (точка), например: <b>49.99</b></li></ul>');

//TotalB2B start
define('TEXT_SPECIALS_CUSTOMERS', 'Customer Special Price:');
define('TEXT_ENTER_NAME','Введите название или код товара:');
define('TEXT_SPECIALS_GROUPS', 'Group Special Price:');
//TotalB2B end


define('TEXT_INFO_DATE_ADDED', 'Дата добавления:');
define('TEXT_INFO_LAST_MODIFIED', 'Последнее изменение:');
define('TEXT_INFO_NEW_PRICE', 'Новая Цена:');
define('TEXT_INFO_ORIGINAL_PRICE', 'Исходная Цена:');
define('TEXT_INFO_PERCENTAGE', 'Процент:');
define('TEXT_INFO_EXPIRES_DATE', 'Действует до:');
define('TEXT_INFO_STATUS_CHANGE', 'Изменить статус:');

define('TEXT_INFO_HEADING_DELETE_SPECIALS', 'Удалить Скидку');
define('TEXT_INFO_DELETE_INTRO', 'Вы действительно хотите удалить специальнцю цену для товара?');

define('TABLE_HEADING_NAME', 'Имя');
define('TABLE_HEADING_PRICE', 'Цена');
define('TABLE_HEADING_PRICE_DISCOUNT', 'Цена со скидкой');
define('TABLE_HEADING_DISCOUNT_PERCENT', 'Скидка в %');
define('TABLE_HEADING_DATE_ADD_DISCOUNT', 'Дата создание скидки');
define('TABLE_HEADING_EXPIRES_DATE', 'Действует До');
define('TABLE_HEADING_ATTR', 'Атрибуты');

define('TEXT_INFO_ONLY_DISCOUNT', 'Только со скидкой');
define('TEXT_INFO_CATEGORY', 'Все категории');
define('TEXT_INFO_MANUFACTURERS', 'Все бренды');

// Validation
define('TEXT_SPECIAL_ALREADY_EXIST', 'Скидка для этого товара и пользователя или группы уже есть.');
define('TEXT_EMPTY_PRODUCT', 'Выберите товар.');
define('TEXT_EMPTY_CUSTOMER', 'Выберите пользователя или группу.');

//Button
define('BUTTON_CANCEL_NEW', 'отменить');
define('BUTTON_EDIT_NEW', 'изменить');
define('BUTTON_DELETE_NEW', 'удалить');
define('BUTTON_NEW_PRODUCT_NEW', 'новый товар');

?>