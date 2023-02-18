<?php
/*
  $Id: orders.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Замовлення');
define('HEADING_TITLE_SEARCH', 'Пошук по ID замовлення');
define('HEADING_TITLE_STATUS', 'Стан');

define('TABLE_HEADING_COMMENTS', 'Коментар');
define('TABLE_HEADING_CUSTOMERS', 'Клієнти');
define('TABLE_HEADING_ORDER_TOTAL', 'Замовлення разом');
define('TABLE_HEADING_DATE_PURCHASED', 'Дата купівлі');
define('TABLE_HEADING_STATUS', 'Стан');
define('TABLE_HEADING_ACTION', 'Дія');
define('TABLE_HEADING_QUANTITY', 'Кількість');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Код товару');
define('TABLE_HEADING_PRODUCTS', 'Товари');
define('TABLE_HEADING_TAX', 'Податок');
define('TABLE_HEADING_TOTAL', 'Всього');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Ціна (без урахування податку)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Ціна');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Загальна (не включаючи податок)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Всього');
define('TEXT_NEW_CUSTOMER', 'Новий клієнт');
define('TEXT_EXIST_CUSTOMER', 'Існуючий клієнт');

define('TABLE_HEADING_DATE_ADDED', 'Дата додавання');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Клієнт повідомлений');

define('ENTRY_CUSTOMER', 'Клієнт:');
define('ENTRY_SOLD_TO', 'ПОКУПЕЦЬ:');
define('ENTRY_DELIVERY_TO', 'Адреса:');
define('ENTRY_SHIP_TO', 'АДРЕСА ДОСТАВКИ:');
define('ENTRY_SHIPPING_ADDRESS', 'Адреса Доставки:');
define('ENTRY_BILLING_ADDRESS', 'Адреса Оплати:');
define('ENTRY_PAYMENT_METHOD', 'Спосіб Оплати:');
define('ENTRY_CREDIT_CARD_TYPE', 'Тип Кредитною Картки:');
define('ENTRY_CREDIT_CARD_OWNER', 'Власник Кредитною Картки:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Номер Кредитною Картки:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Термін закінчення дії кредитної картки:');
define('ENTRY_SUB_TOTAL', 'Попередній Підсумок:');
define('ENTRY_TAX', 'Податок:');
define('ENTRY_SHIPPING', 'Доставка:');
define('ENTRY_TOTAL', 'Всього:');
define('ENTRY_DATE_PURCHASED', 'Дата Купівлі:');
define('ENTRY_STATUS', 'Стан:');
define('ENTRY_DATE_LAST_UPDATED', 'Остання зміна:');
define('ENTRY_NOTIFY_CUSTOMER', 'Повідомити Клієнта:');
define('ENTRY_NOTIFY_CUSTOMER_EMAIL', 'Повідоміті Клієнта по email?');
define('ENTRY_NOTIFY_COMMENTS', 'Додати коментарі:');
define('ENTRY_PRINTABLE', 'Надрукувати рахунок');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Видалити Замовлення');
define('TEXT_INFO_DELETE_INTRO', 'Ви дійсно хочете видалити це замовлення?');
define('TEXT_INFO_DELETE_DATA', 'Покупець:');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Перерахувати кількість товару на складі');
define('TEXT_INFO_DELETE_DATA_OID', 'Номер замовлення:');
define('TEXT_DATE_ORDER_CREATED', 'Дата створення:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Останні зміни:');
define('TEXT_INFO_PAYMENT_METHOD', 'Спосіб оплати:');

define('TEXT_ALL_ORDERS', 'Всі Замовлення');
define('TEXT_NO_ORDER_HISTORY', 'Історія замовлення відсутня');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Статус Вашого замовлення змінений');
define('EMAIL_TEXT_ORDER_NUMBER', 'Номер замовлення:');
define('EMAIL_TEXT_INVOICE_URL', 'Інформація про замовлення:');
define('EMAIL_TEXT_DATE_ORDERED', 'Дата замовлення:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Статус Вашего заказа изменён.' . "\n\n" . 'Новый статус: %s' . "\n\n" . 'Если у Вас возникли вопросы, просто задайте нам их в ответном письме.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Комментарии к Вашему заказу' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Помилка: Замовлення не існує.');
define('SUCCESS_ORDER_UPDATED', 'Выполнено: Заказ успешно обновлён.');
define('WARNING_ORDER_NOT_UPDATED', 'Увага: Змінювати нічого. Замовлення НЕ оновлено.');
// denuz
define('TABLE_HEADING_ORDER_NETTO', 'Нетто');
define('TABLE_HEADING_ORDER_NUMBER', 'Номер');
define('TABLE_HEADING_ORDER_MARJA', 'Маржа');
define('TITLE_ORDER_NETTO', 'Нетто:');
define('TITLE_ORDER_MARJA', 'Маржа:');
define('TEXT_TOTAL', 'Всього:');
define('TEXT_NETTO', 'Нетто: ');
define('TEXT_MARJA', 'Маржа: ');
// eof denuz
define('EMAIL_TEXT_CUSTOMER_NAME', 'Покупець:');
define('EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS', 'Email:');
define('EMAIL_TEXT_CUSTOMER_TELEPHONE', 'Телефон:');
define('EMAIL_ACC_DISCOUNT_INTRO_OWNER', 'Один из Ваших клиентов достиг предела накопительной скидки и был переведён в новую группу. ' . "\n\n" . 'Детали:');
define('EMAIL_TEXT_LIMIT', 'Досягнута межа:');
define('EMAIL_TEXT_CURRENT_GROUP', 'Нова група: ');
define('EMAIL_TEXT_DISCOUNT', 'Нова знижка:');
define('EMAIL_ACC_SUBJECT', 'Накопичувальна знижка');
define('EMAIL_ACC_INTRO_CUSTOMER', 'Вітаємо, Ви отримали нову накопичувальну знижку. Всі деталі нижче:');
define('EMAIL_ACC_FOOTER', 'Якщо у Вас є питання, задайте нам їх в листі.');

define('TEXT_REFERER', 'Звідки прийшов:');
define('TEXT_ORDER_DELETE', 'Видалити:');

define('TEXT_OR_NAL', 'Нал');
define('TEXT_OR_BNAL', 'Безнал');
define('TEXT_OR_PRIVAT', 'Приват');
define('TEXT_OR_NALOZH', 'Накладений');
define('TEXT_OR_FROM', 'с');
define('TEXT_OR_TO', 'по');
define('TEXT_OR_CLEAR', 'скинути фільтр');
define('TEXT_OR_TOTAL', 'Сума');
define('TEXT_OR_DATE', 'Дата доставки');
define('TEXT_OR_COURIER', 'Кур\'єр');
define('TEXT_OR_STATUS', 'Статус замовлення');
define('TEXT_OR_PAYMENT', 'Спосіб оплати');
define('TEXT_OR_ACTION', 'Дія');

define('ENTRY_CUSTOMERS', 'Клієнт:');
define('ENTRY_DELIVERY', 'Адреса:');
define('ENTRY_INFO', 'Інфо:');
define('ENTRY_CREATE_ORDER', 'Створити заказ');

//new orders
define('TEXT_NEW_ORDER', 'Новий заказ');
define('TEXT_SELECT_CUST', 'Виберіть покупця');
define('TEXT_SELECT_CUST_PLACEHOLDER', 'Веедіте id або Ім\'я або Прізвище');
define('TEXT_ADDRESS_BOOK', 'Адресна книга');
define('TEXT_FIRST_NAME', 'Ім\'я');
define('TEXT_LAST_NAME', 'Прізвище');
define('TEXT_GROUPS_NAME', 'Входить в групу');
define('TEXT_EMAIL', 'Email');
define('TEXT_PHONE', 'Телефон');
define('TEXT_FAX', 'Факс');
define('TEXT_FIRM', 'Назва компанії');
define('TEXT_ADDRESS', 'Адреса');
define('TEXT_SUBURB', 'Район');
define('TEXT_POSTCODE', 'Індекс');
define('TEXT_CITY', 'Місто');
define('TEXT_ZONE', 'Регіон');
define('TEXT_COUNTRY', 'Країна');
define('TEXT_OP_PRICE', 'Вартість товару');
define('TEXT_OP_TAX', 'Налог');
define('TEXT_OP_SHIPPING', 'Доставка');
define('TEXT_OP_TOTAL', 'Вартість замовлення');
define('TEXT_EDIT_ORDER', 'Редагувати замовлення');
define('TEXT_CURRENCY', 'Валюта:');
define('TEXT_CURRENCY_VALUE', 'Курс валюти');
define('ENTRY_BILLING', 'Рахунки:');
