<?php
/*
  $Id: customers.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Клієнти');
define('HEADING_FORM_TITLE', 'Клієнт');
define('HEADING_TITLE_SEARCH', 'Пошук:');

//TotalB2B start
define('TABLE_HEADING_CUSTOMERS_STATUS', 'Статус');
define('TABLE_HEADING_CUSTOMERS_GROUP', 'Входить в групу');
define('TABLE_HEADING_CUSTOMERS_DISCOUNT', 'Особиста знижка');
define('ENTRY_CUSTOMERS_DISCOUNT', 'Персональна знижка:');
define('ENTRY_CUSTOMERS_GROUPS_NAME', 'Група:');

// add for SPPC shipment and payment module start 
define('ENTRY_CUSTOMERS_PAYMENT_SET', 'Встановити модулі оплати для покупця');
define('ENTRY_CUSTOMERS_PAYMENT_DEFAULT', 'Використовувати налаштування групи або стандартні настройки');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN', 'Якщо Ви вибираєте <b> Встановити модулі оплати для покупця</b>, але не вибираєте жодного модуля, будуть дійсні настройки групи або стандартні настройки.');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN2', 'Відзначте ті модулі, які будуть <b><font color="red">доступні</font></b> даному покупцю при оформленні замовлення.');

define('ENTRY_CUSTOMERS_SHIPPING_SET', 'Встановити модулі доставки для покупця');
define('ENTRY_CUSTOMERS_SHIPPING_DEFAULT', 'Використовувати налаштування групи або стандартні настройки');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN', 'Якщо Ви вибираєте <b> Встановити модулі доставки для покупця</b>, але не вибираєте жодного модуля, будуть дійсні настройки групи або стандартні настройки.');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN2', 'Відзначте ті модулі, які будуть <b><font color="red">доступні</font></b> даному покупцю при оформленні замовлення.');
// add for SPPC shipment and payment module end

//TotalB2B end

define('TABLE_HEADING_FIRSTNAME', 'Ім\'я');
define('TABLE_HEADING_LASTNAME', 'Прізвище');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Дата');
define('TABLE_HEADING_ACCOUNT_R', 'Відвідування');
define('TABLE_HEADING_ACTION', 'Дія');

define('TEXT_DATE_ACCOUNT_CREATED', 'Дата:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Остання Зміна:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Останній вхід:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Кількість входів:');
define('TEXT_INFO_COUNTRY', 'Країна:');
define('TEXT_DELETE_INTRO', 'Ви дійсно хочете видалити клієнта?');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Видалити Клієнта');
define('TYPE_BELOW', 'Тип Нижче');
define('PLEASE_SELECT', 'Виберіть щось одне');

define('NO_PERSONAL_DISCOUNT', 'Ні');
define('TEXT_PERCENT', '%');
define('TEXT_GROUP', '<br>Знижка: ');
define('TEXT_HELP_HEADING', 'Довідка:');
define('TEXT_HELP_TEXT', 'Якщо будуть вказані і персональна знижка і знижка групи, врахуйте, що обидві знижки будуть рахуватися. Наприклад, якщо обрана група Оптові покупці, даний покупець отримує знижку -20%, і вказана персональна знижка, наприклад, -10%, тоді в результаті покупець отримає загальну знижку -30%.');


define('TEXT_CUST_STATUS_CHANGED', 'Ваш статус змінено');
define('TEXT_CUST_HELLO', 'Доброго дня');
define('TEXT_CUST_STATUS_CHANGED_FROM', 'Ваш статус був змінений з');
define('TEXT_CUST_STATUS_CHANGED_TO', 'на');
define('TEXT_CUST_STATUS_THX', 'З повагою, адміністрація інтернет-магазину');

define('TEXT_CUST_NOTIFY', 'Повідомити Клієнта');
define('TEXT_CUST_XLS', 'скачати xls');
define('TEXT_CUST_PERPAGE', 'Користувачів на сторінку');
define('TEXT_CUST_SUM', 'Сума');
define('TEXT_CUST_CITY', 'Місто');
define('TEXT_CUST_ALL', 'усе');

define('TEXT_CUST_XLS', 'Прайс-лист');
define('TEXT_CUST_XLS_MODEL', 'id');
define('TEXT_CUST_XLS_NAME', 'Ім\'я');
define('TEXT_CUST_XLS_LASTNAME', 'Прізвище');
define('TEXT_CUST_XLS_CITY', 'Місто');
define('TEXT_CUST_XLS_PHONE', 'Телефон');
define('TEXT_CUST_XLS_EMAIL', 'e-mail');
define('TEXT_CUST_XLS_ORDERS', 'Замовлень');
define('TEXT_CUST_XLS_GROUP', 'Група');
define('TEXT_CUST_XLS_DATE', 'Дата реєстрації');
define('TEXT_CUST_XLS_MODEL', 'id');

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
define('BUTTON_ORDERS_NEW', 'замовлення');
define('BUTTON_EMAIL_NEW', 'email');
define('BUTTON_YES', 'так');
define('BUTTON_NO', 'ні');

define('CHECK_NOTIFY_CUSTOMER', 'Повідомити клієнту');

// view address_book
define('AD_CHOOSE_ADDRESS', 'Адреса');
define('AD_CUSTOMERS_MAIN_INFO', 'Основні дані');
define('AD_ORDER', 'Замовлення');
define('AD_BOOK', 'Адресна книга');
define('AD_DEL', 'Це адреса власника кабінету (Ви не можете видалити встановлений за замовчуванням)');
define('AD_BY_DEFAULT', 'За замовчуванням');
define('AD_WANT_TO_DEL', 'Якщо Ви хочете видалити цю адресу, натисніть');
define('AD_SURE', 'Ви впевнені?');
define('AD_LIST', 'Список адресних книг');
define('AD_DEFAULT', '(За замовчуванням)');
define('AD_SUBSCRIBE', 'Підписки');
define('AD_CHANGE_PASSWORD', 'Змінити пароль');
define('AD_NEW_PASSWORD', 'Новий пароль');
define('AD_CONFIRM_PASSWORD', 'Підтвердження');

//Error form
define('ERROR_NEW_PASSWORD_MIN_LENGTH', 'Мінімальна довжина пароля дорівнює %s');
define('ERROR_CONFIRM_PASSWORD_EQUAL', 'Паролі повинні бути однаковими');

define('CUSTOMERS_STREET_ADDRESS', 'Адреса');
define('CUSTOMERS_FAX', 'Факс');
define('CUSTOMERS_BIRTHDAY', 'Дата народження');

define('SUBTITLE_PERSONAL', 'Персональний');
define('SUBTITLE_COMPANY', 'Компанія');
define('SUBTITLE_ADDRESS', 'Адреса');
define('SUBTITLE_FOR_CONTACT', 'Для контакту');
define('SUBTITLE_SUBSCRIBE', 'Розсилка');
define('SUBTITLE_POSTCODE', 'Поштовий індекс');

define('MAIL_TO', 'Відправити');
define('MAIL_FROM', 'Від');
define('MAIL_SUBJECT', 'Тема');
define('MAIL_MESSAGE', 'Повідомлення');
define('MAIL_ALL_CUSTOMERS', 'Всім клієнтам');
define('MAIL_ALL_SUBSCRIBER', 'Всім клієнтам передплатникам');
?>
