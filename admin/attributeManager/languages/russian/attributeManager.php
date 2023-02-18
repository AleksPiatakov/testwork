<?php
/*
  $Id: attributeManager.php,v 1.0 21/02/06 Sam West$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
  
  English translation to AJAX-AttributeManager-V2.7
  
  by Shimon Doodkin
  http://help.me.pro.googlepages.com
  helpmepro1@gmail.com
*/

//attributeManagerPrompts.inc.php

define('AM_AJAX_YES', 'Да');
define('AM_AJAX_NO', 'Нет');
define('AM_AJAX_UPDATE', 'Обновить');
define('AM_AJAX_CANCEL', 'Отменить');
define('AM_AJAX_OK', 'ОК');

define('AM_AJAX_SORT', 'Порядок сортировки:');
define('AM_AJAX_TRACK_STOCK', 'Отслеживать кол-во?');
define('AM_AJAX_TRACK_STOCK_IMGALT', 'Отслеживать кол-во данного атрибута?');

define('AM_AJAX_ENTER_NEW_OPTION_NAME', 'Введите название нового атрибута');
define('AM_AJAX_ENTER_NEW_OPTION_VALUE_NAME', 'Введите название нового атрибута');
define('AM_AJAX_ENTER_NEW_OPTION_VALUE_NAME_TO_ADD_TO', 'Введите название нового атрибута добавляемой к %s');

define('AM_AJAX_PROMPT_REMOVE_OPTION_AND_ALL_VALUES', 'Вы уверены, что хотите удалить %s и все связанные значения для этого товара?');
define('AM_AJAX_PROMPT_REMOVE_OPTION', 'Вы уверены, что хотите удалить %s для этого товара?');
define('AM_AJAX_PROMPT_STOCK_COMBINATION', 'Вы уверены, что хотите удалить эту комбинацию опций для товара?');

define('AM_AJAX_PROMPT_LOAD_TEMPLATE', 'Вы уверены, что хотите загрузить шаблон %s? <br />Все текущий атрибута товара будут изменены. Изменения невозможно будет отменить.');
define('AM_AJAX_NEW_TEMPLATE_NAME_HEADER', 'Введите название для нового шаблона. Или...');
define('AM_AJAX_NEW_NAME', 'Новое наименование:');
define('AM_AJAX_CHOOSE_EXISTING_TEMPLATE_TO_OVERWRITE', ' ...<br /> ... выберите существующий для его замены');
define('AM_AJAX_CHOOSE_EXISTING_TEMPLATE_TITLE', 'Существующий:');
define('AM_AJAX_RENAME_TEMPLATE_ENTER_NEW_NAME', 'Введите новое название для шаблона %s');
define('AM_AJAX_PROMPT_DELETE_TEMPLATE', 'Вы уверены, что хотите удалить шаблон %s?<br>Изменения нельзя будет отменить!');

//attributeManager.php

define('AM_AJAX_ADDS_ATTRIBUTE_TO_OPTION', 'Добавить указанный атрибут к атрибуту %s');
define('AM_AJAX_ADDS_NEW_VALUE_TO_OPTION', 'Добавить новое значение к атрибуту %s');
define('AM_AJAX_PRODUCT_REMOVES_OPTION_AND_ITS_VALUES', 'Удалить опцию %1$s и %2$d значений данного атрибута с этого товара');
define('AM_AJAX_CHANGES', 'Изменения');
define('AM_AJAX_LOADS_SELECTED_TEMPLATE', 'Загрузить указанный шаблон');
define('AM_AJAX_SAVES_ATTRIBUTES_AS_A_NEW_TEMPLATE', 'Сохранить текущие настройки в качестве шаблона');
define('AM_AJAX_RENAMES_THE_SELECTED_TEMPLATE', 'Переименовать выбранный шаблон');
define('AM_AJAX_DELETES_THE_SELECTED_TEMPLATE', 'Удалить выбранный шаблон');
define('AM_AJAX_NAME', 'Атрибуты');
define('AM_AJAX_ACTION', 'Действие');
define('AM_AJAX_OPTION_VALUES_NAME', 'Значение');
define('AM_AJAX_OPTION_VALUES_PRICE_PREFIX', 'Преф. цены');
define('AM_AJAX_OPTION_VALUES_PRICE', 'Цена');
define('AM_AJAX_OPTION_VALUES_QUANTITY', 'Количество');
define('AM_AJAX_OPTION_VALUES_ARTICLE', 'Артикул');
define('AM_AJAX_OPTION_VALUES_ADD', 'Добавить');
define('AM_AJAX_OPTION_VALUES_CREATE', 'Создать');
define('AM_AJAX_OPTION_VALUES_DELETE', 'Удалить');
define('AM_AJAX_OPTION_VALUES_OK', 'Oк');
define('AM_AJAX_PRODUCT_REMOVES_VALUE_FROM_OPTION', 'Удалить %1$s из атрибута %2$s этого товара');
define('AM_AJAX_MOVES_VALUE_UP', 'Переместить атрибут вверх');
define('AM_AJAX_MOVES_VALUE_DOWN', 'Переместить атрибут вниз');
define('AM_AJAX_ADDS_NEW_OPTION', 'Добавить новый атрибут в список');
define('AM_AJAX_OPTION', 'Атрибут:');
define('AM_AJAX_VALUE', 'Значение:');
define('AM_AJAX_PREFIX', 'Преф.цены:');
define('AM_AJAX_PRICE', 'Цена:');
define('AM_AJAX_OR', 'или');
define('AM_AJAX_WEIGHT_PREFIX', 'Преф.вес:');
define('AM_AJAX_WEIGHT', 'Вес:');
define('AM_AJAX_SORT', 'Позиция:');
define('AM_AJAX_ADDS_NEW_OPTION_VALUE', 'Добавить новое значение атрибута в список');
define('AM_AJAX_ADDS_ATTRIBUTE_TO_PRODUCT', 'Добавить новый атрибут к товару');
define('AM_AJAX_DELETES_ATTRIBUTE_FROM_PRODUCT', 'Удалить этот атрибут или комбинацию опций');
define('AM_AJAX_QUANTITY', 'Количество:');
define('AM_AJAX_PRODUCT_REMOVE_ATTRIBUTE_COMBINATION_AND_STOCK', 'Удалить комбинацию опций и их количество для этого товара');
define('AM_AJAX_UPDATE_OR_INSERT_ATTRIBUTE_COMBINATIONBY_QUANTITY', 'Обновить или вставить комбинацию опций с указанным количеством');
define('AM_AJAX_UPDATE_PRODUCT_QUANTITY', 'Установить указанное количество товара');

//attributeManager.class.php
define('AM_AJAX_TEMPLATES', '-- Шаблоны --');

//----------------------------
// Change: download attributes for AM
//
// author: mytool
//-----------------------------
define('AM_AJAX_FILENAME', 'Файл');
define('AM_AJAX_FILE_DAYS', 'Дней');
define('AM_AJAX_FILE_COUNT', 'Максимум скачиваний');
define('AM_AJAX_DOWLNOAD_EDIT', 'Редактировать атрибут скачивания');
define('AM_AJAX_DOWLNOAD_ADD_NEW', 'Добавить атрибут скачивания');
define('AM_AJAX_DOWLNOAD_DELETE', 'Удалить атрибут скачивания');
define('AM_AJAX_HEADER_DOWLNOAD_ADD_NEW', 'Добавить атрибут скачивания для \"%s\"');
define('AM_AJAX_HEADER_DOWLNOAD_EDIT', 'Редактировать атрибут скачивания для \"%s\"');
define('AM_AJAX_HEADER_DOWLNOAD_DELETE', 'Удалить атрибут скачивания для \"%s\"');
define('AM_AJAX_FIRST_SAVE', 'Сохраните товар перед добавлением опций.');

//----------------------------
// EOF Change: download attributes for AM
//-----------------------------

define('AM_AJAX_OPTION_NEW_PANEL','Новый атрибут');
define('AM_AJAX_PC','шт.');
?>
