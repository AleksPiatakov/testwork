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

define( 'AM_AJAX_YES', 'Так');
define( 'AM_AJAX_NO', 'Ні');
define( 'AM_AJAX_UPDATE', 'Оновити');
define( 'AM_AJAX_CANCEL', 'Скасувати');
define( 'AM_AJAX_OK', 'ОК');

define( 'AM_AJAX_SORT', 'Порядок сортування:');
define( 'AM_AJAX_TRACK_STOCK', 'Відстежувати кількість?');
define( 'AM_AJAX_TRACK_STOCK_IMGALT', 'Відстежувати кількість даного атрибута?');

define( 'AM_AJAX_ENTER_NEW_OPTION_NAME', 'Введіть назву нового атрибута');
define( 'AM_AJAX_ENTER_NEW_OPTION_VALUE_NAME', 'Введіть назву нового атрибута');
define( 'AM_AJAX_ENTER_NEW_OPTION_VALUE_NAME_TO_ADD_TO', 'Введіть назву нового атрибута додається до %s');

define( 'AM_AJAX_PROMPT_REMOVE_OPTION_AND_ALL_VALUES', 'Ви впевнені, що хочете видалити %s і всі пов/"язані значення для цього товару?');
define( 'AM_AJAX_PROMPT_REMOVE_OPTION', 'Ви впевнені, що хочете видалити %s для цього товару?');
define( 'AM_AJAX_PROMPT_STOCK_COMBINATION', 'Ви впевнені, що хочете видалити цю комбінацію опцій для товара?');

define( 'AM_AJAX_PROMPT_LOAD_TEMPLATE', 'Ви впевнені, що хочете завантажити шаблон %s? <br /> Все поточний атрибута товару будуть змінені. Зміни неможливо буде скасувати.');
define( 'AM_AJAX_NEW_TEMPLATE_NAME_HEADER', 'Введіть назву для нового шаблону. Або ...');
define( 'AM_AJAX_NEW_NAME', 'Нове найменування:');
define( 'AM_AJAX_CHOOSE_EXISTING_TEMPLATE_TO_OVERWRITE', '... <br /> ... виберіть існуючий для його заміни');
define( 'AM_AJAX_CHOOSE_EXISTING_TEMPLATE_TITLE', 'Існуючий:');
define( 'AM_AJAX_RENAME_TEMPLATE_ENTER_NEW_NAME', 'Введіть нову назву для шаблону %s');
define( 'AM_AJAX_PROMPT_DELETE_TEMPLATE', 'Ви впевнені, що хочете видалити шаблон %s? <br> Зміни можна буде скасувати!');

//attributeManager.php

define( 'AM_AJAX_ADDS_ATTRIBUTE_TO_OPTION', 'Додати вказаний атрибут до атрибуту %s');
define( 'AM_AJAX_ADDS_NEW_VALUE_TO_OPTION', 'Додати нове значення до атрибуту %s');
define( 'AM_AJAX_PRODUCT_REMOVES_OPTION_AND_ITS_VALUES', 'Видалити опцію %1$s і %2$d значень даного атрибута з цього товару');
define( 'AM_AJAX_CHANGES', 'Зміни');
define( 'AM_AJAX_LOADS_SELECTED_TEMPLATE', 'Завантажити вказаний шаблон');
define( 'AM_AJAX_SAVES_ATTRIBUTES_AS_A_NEW_TEMPLATE', 'Зберегти поточні налаштування як шаблон');
define( 'AM_AJAX_RENAMES_THE_SELECTED_TEMPLATE', 'Перейменувати вибраний шаблон');
define( 'AM_AJAX_DELETES_THE_SELECTED_TEMPLATE', 'Видалити обраний шаблон');
define( 'AM_AJAX_NAME', 'Атрибути');
define( 'AM_AJAX_ACTION', 'Дія');
define( 'AM_AJAX_OPTION_VALUES_NAME', 'Значення');
define( 'AM_AJAX_OPTION_VALUES_PRICE_PREFIX', 'Преф. ціни');
define( 'AM_AJAX_OPTION_VALUES_PRICE', 'Ціна');
define( 'AM_AJAX_OPTION_VALUES_QUANTITY', 'Кількість');
define('AM_AJAX_OPTION_VALUES_ARTICLE', 'Артикул');
define( 'AM_AJAX_OPTION_VALUES_ADD', 'Додати');
define( 'AM_AJAX_OPTION_VALUES_CREATE', 'Cтворити');
define( 'AM_AJAX_OPTION_VALUES_DELETE', 'Видалити');
define( 'AM_AJAX_OPTION_VALUES_OK', 'Oк');
define( 'AM_AJAX_PRODUCT_REMOVES_VALUE_FROM_OPTION', 'Видалити %1$s з атрибута %2$ s цього товару');
define( 'AM_AJAX_MOVES_VALUE_UP', 'Перемістити атрибут вгору');
define( 'AM_AJAX_MOVES_VALUE_DOWN', 'Перемістити атрибут вниз');
define( 'AM_AJAX_ADDS_NEW_OPTION', 'Додати новий атрибут в список');
define( 'AM_AJAX_OPTION', 'Атрибут:');
define( 'AM_AJAX_VALUE', 'Значення:');
define( 'AM_AJAX_PREFIX', 'Преф.цени:');
define( 'AM_AJAX_PRICE', 'Ціна:');
define( 'AM_AJAX_OR', 'або');
define( 'AM_AJAX_WEIGHT_PREFIX', 'Преф.вес:');
define( 'AM_AJAX_WEIGHT', 'Вага:');
define( 'AM_AJAX_SORT', 'Позиція:');
define( 'AM_AJAX_ADDS_NEW_OPTION_VALUE', 'Додати нове значення атрибута в список');
define( 'AM_AJAX_ADDS_ATTRIBUTE_TO_PRODUCT', 'Додати новий атрибут до товару');
define( 'AM_AJAX_DELETES_ATTRIBUTE_FROM_PRODUCT', 'Видалити цей атрибут або комбінацію опцій');
define( 'AM_AJAX_QUANTITY', 'Кількість:');
define( 'AM_AJAX_PRODUCT_REMOVE_ATTRIBUTE_COMBINATION_AND_STOCK', 'Видалити комбінацію опцій і їх кількість для цього товару');
define( 'AM_AJAX_UPDATE_OR_INSERT_ATTRIBUTE_COMBINATIONBY_QUANTITY', 'Оновити або вставити комбінацію опцій з вказаною кількістю');
define( 'AM_AJAX_UPDATE_PRODUCT_QUANTITY', 'Встановити вказану кількість товару');

//attributeManager.class.php
define( 'AM_AJAX_TEMPLATES', '- Шаблони -');

// ----------------------------
// Change: download attributes for AM
//
// author: mytool
// -----------------------------
define( 'AM_AJAX_FILENAME', 'Файл');
define( 'AM_AJAX_FILE_DAYS', 'Днів');
define( 'AM_AJAX_FILE_COUNT', 'Максимум завантажень');
define( 'AM_AJAX_DOWLNOAD_EDIT', 'Редагувати атрибут скачування');
define( 'AM_AJAX_DOWLNOAD_ADD_NEW', 'Додати атрибут скачування');
define( 'AM_AJAX_DOWLNOAD_DELETE', 'Видалити атрибут скачування');
define( 'AM_AJAX_HEADER_DOWLNOAD_ADD_NEW', 'Додати атрибут скачування для \"%s\"');
define( 'AM_AJAX_HEADER_DOWLNOAD_EDIT', 'Редагувати атрибут скачування для \"%s\"');
define( 'AM_AJAX_HEADER_DOWLNOAD_DELETE', 'Видалити атрибут скачування для \"%s\"');
define( 'AM_AJAX_FIRST_SAVE', 'Збережіть товар перед додаванням опцій.');

//----------------------------
// EOF Change: download attributes for AM
//-----------------------------
define('AM_AJAX_OPTION_NEW_PANEL', 'Новий атрибут');
define('AM_AJAX_PC', 'шт.');
?>
