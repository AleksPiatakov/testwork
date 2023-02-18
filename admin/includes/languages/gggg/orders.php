<?php
/*
  $Id: orders.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Заказы');
define('HEADING_TITLE_SEARCH', 'Поиск по ID заказа');
define('HEADING_TITLE_STATUS', 'Статус');

define('TABLE_HEADING_COMMENTS', 'Комментарий');
define('TABLE_HEADING_CUSTOMERS', 'Клиенты');
define('TABLE_HEADING_ORDER_TOTAL', 'Заказ итого');
define('TABLE_HEADING_DATE_PURCHASED', 'Дата Заказа');
define('TABLE_HEADING_STATUS', 'Состояние');
define('TABLE_HEADING_ACTION', 'Действие');
define('TABLE_HEADING_QUANTITY', 'Количество');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Код товара');
define('TABLE_HEADING_PRODUCTS', 'Товары');
define('TABLE_HEADING_TAX', 'Налог');
define('TABLE_HEADING_TOTAL', 'Всего');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Цена (не включая налог)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Цена');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Общая (не включая налог)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Всего');
define('TEXT_NEW_CUSTOMER', 'Новый клиент');
define('TEXT_EXIST_CUSTOMER', 'Существующий клиент');

define('TABLE_HEADING_DATE_ADDED', 'Дата добавления');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Клиент уведомлён');

define('ENTRY_CUSTOMER', 'Клиент:');
define('ENTRY_SOLD_TO', 'ПОКУПАТЕЛЬ:');
define('ENTRY_DELIVERY_TO', 'Адрес:');
define('ENTRY_SHIP_TO', 'АДРЕС ДОСТАВКИ:');
define('ENTRY_SHIPPING_ADDRESS', 'Адрес Доставки:');
define('ENTRY_BILLING_ADDRESS', 'Адрес Покупателя:');
define('ENTRY_PAYMENT_METHOD', 'Способ Оплаты:');
define('ENTRY_CREDIT_CARD_TYPE', 'Тип Кредитной Карточки:');
define('ENTRY_CREDIT_CARD_OWNER', 'Владелец Кредитной Карточки:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Номер Кредитной Карточки:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Срок окончания действия кредитной карточки:');
define('ENTRY_SUB_TOTAL', 'Предварительный Итог:');
define('ENTRY_TAX', 'Налог:');
define('ENTRY_SHIPPING', 'Доставка:');
define('ENTRY_TOTAL', 'Всего:');
define('ENTRY_DATE_PURCHASED', 'Дата Покупки:');
define('ENTRY_STATUS', 'Состояние:');
define('ENTRY_DATE_LAST_UPDATED', 'Последнее изменение:');
define('ENTRY_NOTIFY_CUSTOMER', 'Уведомить Клиента:');
define('ENTRY_NOTIFY_CUSTOMER_EMAIL', 'Уведомить Клиента по email? ');
define('ENTRY_NOTIFY_COMMENTS', 'Добавить комментарии:');
define('ENTRY_PRINTABLE', 'Напечатать счёт');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Удалить Заказ');
define('TEXT_INFO_DELETE_INTRO', 'Вы действительно хотите удалить этот заказ?');
define('TEXT_INFO_DELETE_DATA', 'Покупатель:');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Пересчитать количество товара на складе');
define('TEXT_INFO_DELETE_DATA_OID', 'Номер заказа:');
define('TEXT_DATE_ORDER_CREATED', 'Дата Создания:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Последние Изменения:');
define('TEXT_INFO_PAYMENT_METHOD', 'Способ Оплаты:');

define('TEXT_ALL_ORDERS', 'Все Заказы');
define('TEXT_NO_ORDER_HISTORY', 'История заказа отсутствует');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Статус Вашего заказа изменён');
define('EMAIL_TEXT_ORDER_NUMBER', 'Номер заказа:');
define('EMAIL_TEXT_INVOICE_URL', 'Информация о заказе:');
define('EMAIL_TEXT_DATE_ORDERED', 'Дата заказа:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Статус Вашего заказа изменён.' . "\n\n" . 'Новый статус: %s' . "\n\n" . 'Если у Вас возникли вопросы, просто задайте нам их в ответном письме.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Комментарии к Вашему заказу' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Ошибка: Заказ не существует.');
define('SUCCESS_ORDER_UPDATED', 'Выполнено: Заказ успешно обновлён.');
define('WARNING_ORDER_NOT_UPDATED', 'Внимание: Изменять нечего. Заказ НЕ обновлён.');
// denuz
define('TABLE_HEADING_ORDER_NETTO', 'Нетто');
define('TABLE_HEADING_ORDER_NUMBER', 'Номер');
define('TABLE_HEADING_ORDER_MARJA', 'Маржа');
define('TITLE_ORDER_NETTO', 'Нетто:');
define('TITLE_ORDER_MARJA', 'Маржа:');
define('TEXT_TOTAL', 'Всего: ');
define('TEXT_NETTO', 'Нетто: ');
define('TEXT_MARJA', 'Маржа: ');
// eof denuz
define('EMAIL_TEXT_CUSTOMER_NAME', 'Покупатель:');
define('EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS', 'Email:');
define('EMAIL_TEXT_CUSTOMER_TELEPHONE', 'Телефон:');
define('EMAIL_ACC_DISCOUNT_INTRO_OWNER', 'Один из Ваших клиентов достиг предела накопительной скидки и был переведён в новую группу. ' . "\n\n" . 'Детали:');
define('EMAIL_TEXT_LIMIT', 'Достигнутый предел: ');
define('EMAIL_TEXT_CURRENT_GROUP', 'Новая группа: ');
define('EMAIL_TEXT_DISCOUNT', 'Новая скидка: ');
define('EMAIL_ACC_SUBJECT', 'Накопительная скидка');
define('EMAIL_ACC_INTRO_CUSTOMER', 'Поздравляем, Вы получили новую накопительную скидку. Все детали ниже:');
define('EMAIL_ACC_FOOTER', 'Если у Вас есть вопросы, задайте нам их в ответном письме.');

define('TEXT_REFERER', 'Откуда пришёл: ');
define('TEXT_ORDER_DELETE', 'Удалить: ');

define('TEXT_OR_NAL', 'Нал');
define('TEXT_OR_BNAL', 'Безнал');
define('TEXT_OR_PRIVAT', 'Приват');
define('TEXT_OR_NALOZH', 'Наложенный');
define('TEXT_OR_FROM', 'с');
define('TEXT_OR_TO', 'по');
define('TEXT_OR_CLEAR', 'сбросить фильтр');
define('TEXT_OR_TOTAL', 'Сумма');
define('TEXT_OR_DATE', 'Дата доставки');
define('TEXT_OR_COURIER', 'Курьер');
define('TEXT_OR_STATUS', 'Статус заказа');
define('TEXT_OR_PAYMENT', 'Способ оплаты');
define('TEXT_OR_ACTION', 'Действие');
define('ENTRY_CUSTOMERS', 'Клиент:');
define('ENTRY_DELIVERY', 'Адрес:');
define('ENTRY_INFO', 'Инфо:');
define('ENTRY_CREATE_ORDER', 'Создать заказ');


//new orders
define('TEXT_NEW_ORDER', 'Новый заказ');
define('TEXT_SELECT_CUST', 'Выберите покупателя');
define('TEXT_SELECT_CUST_PLACEHOLDER', 'Введите id или Имя или Фамилию');
define('TEXT_ADDRESS_BOOK', 'Адресная книга');
define('TEXT_FIRST_NAME', 'Имя');
define('TEXT_LAST_NAME', 'Фамилия');
define('TEXT_GROUPS_NAME', 'Входит в группу');
define('TEXT_EMAIL', 'Email');
define('TEXT_PHONE', 'Телефон');
define('TEXT_FAX', 'Факс');
define('TEXT_FIRM', 'Название компании');
define('TEXT_ADDRESS', 'Адрес');
define('TEXT_SUBURB', 'Район');
define('TEXT_POSTCODE', 'Индекс');
define('TEXT_CITY', 'Город');
define('TEXT_ZONE', 'Регион');
define('TEXT_COUNTRY', 'Страна');
define('TEXT_OP_PRICE', 'Стоимость товара');
define('TEXT_OP_TAX', 'Налог');
define('TEXT_OP_SHIPPING', 'Доставка');
define('TEXT_OP_TOTAL', 'Стоимость заказа');



define('ENTRY_BILLING', 'Billing:');
