<?php
/*
  $Id: salemaker.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Масові знижки');

define('TABLE_HEADING_SALE_NAME', 'Назва акції');
define('TABLE_HEADING_SALE_DEDUCTION', 'Відрахування');
define('TABLE_HEADING_SALE_DATE_START', 'Початок дії акції');
define('TABLE_HEADING_SALE_DATE_END', 'Дата закінчення');
define('TABLE_HEADING_STATUS', 'Статус');
define('TABLE_HEADING_ACTION', 'Дія');

define('TEXT_SALEMAKER_NAME', 'Назва акції:');
define('TEXT_SALEMAKER_DEDUCTION', 'Відрахування:');
define('TEXT_SALEMAKER_DEDUCTION_TYPE', 'Тип:');
define('TEXT_SALEMAKER_PRICERANGE_FROM', 'Товари вартістю від:');
define('TEXT_SALEMAKER_PRICERANGE_TO', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;до&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
define('TEXT_SALEMAKER_SPECIALS_CONDITION', 'Якщо товар вже знаходиться в знижках:');
define('TEXT_SALEMAKER_DATE_START', 'Початок дії акції:');
define('TEXT_SALEMAKER_DATE_END', 'Дата закінчення:');
define('TEXT_SALEMAKER_CATEGORIES', '<b>Або</b> виберіть категорії, для яких буде дійсна дана акція:');
define('TEXT_SALEMAKER_POPUP', '<a href="javascript:session_win();"><span class="errorText"><b>Рекомендації щодо створення і використання масових знижок.</b></span></a>');
define('TEXT_SALEMAKER_IMMEDIATELY', 'Негайно');
define('TEXT_SALEMAKER_NEVER', 'Немає обмеження');
define('TEXT_SALEMAKER_ENTIRE_CATALOG', 'Відзначте, якщо акція дійсна для <b>всіх</b> товарів магазину:');
define('TEXT_SALEMAKER_MANUFACTURERS', '<b>Або</b> виберіть виробників, для яких буде дійсна дана акція:');
define('TEXT_SALEMAKER_TOP', 'Знижка дійсна для всіх товарів магазину');

define('TEXT_INFO_DATE_ADDED', 'Дата створення:');
define('TEXT_INFO_DATE_MODIFIED', 'Останні зміни:');
define('TEXT_INFO_DATE_STATUS_CHANGE', 'Останній раз статус акції змінювався:');
define('TEXT_INFO_SPECIALS_CONDITION', 'Якщо товар вже в знижках:');
define('TEXT_INFO_DEDUCTION', 'Відрахування:');
define('TEXT_INFO_PRICERANGE_FROM', 'Товари вартістю від:');
define('TEXT_INFO_PRICERANGE_TO', ' до ');
define('TEXT_INFO_DATE_START', 'Початок дії акції:');
define('TEXT_INFO_DATE_END', 'Дата закінчення:');

define('SPECIALS_CONDITION_DROPDOWN_0', 'Ігнорувати спеціальну ціну і ставити умову масової знижки');
define('SPECIALS_CONDITION_DROPDOWN_1', 'Ігнорувати умова масової знижки до такого товару');
define('SPECIALS_CONDITION_DROPDOWN_2', 'Додати умову масової знижки до спеціальної ціни');

define('DEDUCTION_TYPE_DROPDOWN_0', 'Відрахування суми');
define('DEDUCTION_TYPE_DROPDOWN_1', 'Відсоток знижки');
define('DEDUCTION_TYPE_DROPDOWN_2', 'Нова ціна');

define('TEXT_INFO_HEADING_COPY_SALE', 'Копіювати акцію');
define('TEXT_INFO_COPY_INTRO', 'Введіть назву для копируемой акції<br>&nbsp;&nbsp;"%s"');

define('TEXT_INFO_HEADING_DELETE_SALE', 'Видалити акцію');
define('TEXT_INFO_DELETE_INTRO', 'Ви дійсно хочете видалити цю акцію?');
define('TEXT_DISPLAY_NUMBER_OF_SALES', 'Показано <b>%d</b> - <b>%d</b> (всього <b>%d</b> масових знижок)');

//Button
define('BUTTON_CANCEL_NEW', 'відмінити');
define('BUTTON_EDIT_NEW', 'змінити');
define('BUTTON_UNLOCK_NEW', 'розблокувати');
define('BUTTON_PREVIEW_NEW', 'предпросмотр');
define('BUTTON_BACK_NEW', 'назад');
define('BUTTON_NEWSLETTER_NEW', 'нова розсилка');
define('BUTTON_DELETE_NEW', 'видалити');
define('BUTTON_LOCK_NEW', 'заблокувати');
define('BUTTON_SEND_NEW', 'відправити');
define('BUTTON_INSERT_NEW', 'вставити');
define('BUTTON_RESET_NEW', 'зброс');
define('BUTTON_SALE_NEW', 'продаж');
define('BUTTON_COPY_TO_NEW', 'копіювати в');
?>