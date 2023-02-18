<?php
/*
  $Id: customers.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Клиенты');
define('HEADING_FORM_TITLE', 'Клиент');
define('HEADING_TITLE_SEARCH', 'Поиск:');

//TotalB2B start
define('TABLE_HEADING_CUSTOMERS_STATUS', 'Статус');
define('TABLE_HEADING_CUSTOMERS_GROUP', 'Входит в группу');
define('TABLE_HEADING_CUSTOMERS_DISCOUNT', 'Личная скидка');
define('ENTRY_CUSTOMERS_DISCOUNT', 'Персональная скидка:');
define('ENTRY_CUSTOMERS_GROUPS_NAME', 'Группа:');

// add for SPPC shipment and payment module start 
define('ENTRY_CUSTOMERS_PAYMENT_SET', 'Установить модули оплаты для покупателя');
define('ENTRY_CUSTOMERS_PAYMENT_DEFAULT', 'Использовать настройки группы или стандартные настройки');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN', 'Если Вы выбираете <b>Установить модули оплаты для покупателя</b>, но не выбираете ни одного модуля, будут действительны настройки группы или стандартные настройки.');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN2', 'Отметье те модули, которые будут <b><font color="red">доступны</font></b> данному покупателю при оформлении заказа.');

define('ENTRY_CUSTOMERS_SHIPPING_SET', 'Установить модули доставки для покупателя');
define('ENTRY_CUSTOMERS_SHIPPING_DEFAULT', 'Использовать настройки группы или стандартные настройки');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN', 'Если Вы выбираете <b>Установить модули доставки для покупателя</b>, но не выбираете ни одного модуля, будут действительны настройки группы или стандартные настройки.');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN2', 'Отметье те модули, которые будут <b><font color="red">доступны</font></b> данному покупателю при оформлении заказа.');
// add for SPPC shipment and payment module end

//TotalB2B end

define('TABLE_HEADING_FIRSTNAME', 'Имя');
define('TABLE_HEADING_LASTNAME', 'Фамилия');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Дата');
define('TABLE_HEADING_ACCOUNT_R', 'Посещения');
define('TABLE_HEADING_ACTION', 'Действие');

define('TEXT_DATE_ACCOUNT_CREATED', 'Дата:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Последнее Изменение:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Последний Вход:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Количество Входов:');
define('TEXT_INFO_COUNTRY', 'Страна:');
define('TEXT_DELETE_INTRO', 'Вы действительно хотите удалить клиента?');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Удалить Клиента');
define('TYPE_BELOW', 'Тип Ниже');
define('PLEASE_SELECT', 'Выберите что-то одно');

define('NO_PERSONAL_DISCOUNT', 'Нет');
define('TEXT_PERCENT', '%');
define('TEXT_GROUP', '<br>Скидка: ');
define('TEXT_HELP_HEADING', 'Справка:');
define('TEXT_HELP_TEXT', 'Если будут указаны и персональная скидка и скидка группы, учтите, что обе скидки будут считаться. Например, если выбрана группа Оптовые покупатели, данный покупатель получает скидку -20%, и указана персональная скидка, например, -10%, тогда в итоге покупатель получит общую скидку -30%.');


define('TEXT_CUST_STATUS_CHANGED', 'Ваш статус изменен');
define('TEXT_CUST_HELLO', 'Добрый день');
define('TEXT_CUST_STATUS_CHANGED_FROM', 'Ваш статус был изменен с');
define('TEXT_CUST_STATUS_CHANGED_TO', 'на');
define('TEXT_CUST_STATUS_THX', 'С уважением, администрация интернет-магазина');

define('TEXT_CUST_NOTIFY', 'Уведомить Клиента');
define('TEXT_CUST_XLS', 'скачать xls');
define('TEXT_CUST_PERPAGE', 'Пользователей на страницу');
define('TEXT_CUST_SUM', 'Сумма');
define('TEXT_CUST_CITY', 'Город');
define('TEXT_CUST_ALL', 'все');

define('TEXT_CUST_XLS', 'Прайс-лист');
define('TEXT_CUST_XLS_MODEL', 'id');
define('TEXT_CUST_XLS_NAME', 'Имя');
define('TEXT_CUST_XLS_LASTNAME', 'Фамилия');
define('TEXT_CUST_XLS_CITY', 'Город');
define('TEXT_CUST_XLS_PHONE', 'Телефон');
define('TEXT_CUST_XLS_EMAIL', 'e-mail');
define('TEXT_CUST_XLS_ORDERS', 'Заказов');
define('TEXT_CUST_XLS_GROUP', 'Группа');
define('TEXT_CUST_XLS_DATE', 'Дата регистрации');
define('TEXT_CUST_XLS_MODEL', 'id');

//Button
define('BUTTON_CANCEL_NEW', 'отменить');
define('BUTTON_EDIT_NEW', 'изменить');
define('BUTTON_UNLOCK_NEW', 'разблокировать');
define('BUTTON_PREVIEW_NEW', 'предпросмотр');
define('BUTTON_BACK_NEW', 'назад');
define('BUTTON_NEWSLETTER_NEW', 'новая рассылка');
define('BUTTON_DELETE_NEW', 'удалить');
define('BUTTON_LOCK_NEW', 'заблокировать');
define('BUTTON_SEND_NEW', 'отправить');
define('BUTTON_INSERT_NEW', 'вставить');
define('BUTTON_RESET_NEW', 'сброс');
define('BUTTON_ORDERS_NEW', 'заказы');
define('BUTTON_EMAIL_NEW', 'email');
define('BUTTON_YES', 'да');
define('BUTTON_NO', 'нет');

define('CHECK_NOTIFY_CUSTOMER', 'Уведомить клиента');

//view address_book
define('AD_CHOOSE_ADDRESS', 'Адрес');
define('AD_CUSTOMERS_MAIN_INFO', 'Основные данные');
define('AD_ORDER', 'Заказ');
define('AD_BOOK', 'Адресная книга');
define('AD_DEL', 'Это адрес владельца кабинета (Вы не можете удалить установленный по умолчанию)');
define('AD_BY_DEFAULT', 'По умолчанию');
define('AD_WANT_TO_DEL', 'Если Вы хотите удалить этот адрес, нажмите');
define('AD_SURE', 'Вы уверены?');
define('AD_LIST', 'Список адресных книг');
define('AD_DEFAULT', ' (По умолчанию)');
define('AD_SUBSCRIBE', 'Подписки');
define('AD_CHANGE_PASSWORD', 'Изменить пароль');
define('AD_NEW_PASSWORD', 'Новый пароль');
define('AD_CONFIRM_PASSWORD', 'Подтверждение');

//Error form
define('ERROR_NEW_PASSWORD_MIN_LENGTH', 'Минимальная длина пароля равна %s');
define('ERROR_CONFIRM_PASSWORD_EQUAL', 'Пароли должны быть одинаковыми');

define('CUSTOMERS_STREET_ADDRESS', 'Адрес');
define('CUSTOMERS_FAX', 'Факс');
define('CUSTOMERS_BIRTHDAY', 'Дата рождения');

define('SUBTITLE_PERSONAL', 'Персональный');
define('SUBTITLE_COMPANY', 'Компания');
define('SUBTITLE_ADDRESS', 'Адрес');
define('SUBTITLE_POSTCODE' , 'Почтовый индекс');
define('SUBTITLE_FOR_CONTACT', 'Для контакта');
define('SUBTITLE_SUBSCRIBE', 'Рассылка');

define('MAIL_TO', 'Отправить');
define('MAIL_FROM', 'От');
define('MAIL_SUBJECT', 'Тема');
define('MAIL_MESSAGE', 'Сообщение');
define('MAIL_ALL_CUSTOMERS', 'Всем клиентам');
define('MAIL_ALL_SUBSCRIBER', 'Всем клиентам подписчикам');
?>
