<?php
/*
  $Id: orders_status.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Статус Заказов');

define('TABLE_HEADING_ORDERS_STATUS', 'Статус заказов');
define('TABLE_HEADING_ORDER_STATUS_TEXT','Текст статуса заказов');

define('TABLE_HEADING_DEFAULT', 'По умолчанию');
define('TABLE_HEADING_ACTION', 'Действие');
define('TABLE_HEADING_COLOR', 'Цвет');
define('TABLE_HEADING_STATUS_SHOW', 'Показывать на на главной странице администратора');


define('TEXT_INFO_EDIT_INTRO', 'Пожалуйста, внесите необходимые изменения');
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Статус заказов:');
define('TEXT_INFO_INSERT_INTRO', 'Введите, пожалуйста, новый статус заказа, на основе исходных данных');
define('TEXT_INFO_DELETE_INTRO', 'Вы действительно хотите удалить статус этого заказа?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'Новый статус заказа');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Редактировать статус заказа');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Удалить статус заказа');

define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Ошибка: Статус заказа по умолчанию не может быть удален, измените статус и попробуйте снова.');
define('ERROR_STATUS_USED_IN_ORDERS', 'Ошибка: Этот статус используется в настоящее время.');
define('ERROR_STATUS_USED_IN_HISTORY', 'Ошибка: Этот статус используется сейчас в истории заказов.');


define('ERROR_ORDER_STATUS_IS_DEFAULT', 'Вы не можете удалить статус заказа по умолчанию');
