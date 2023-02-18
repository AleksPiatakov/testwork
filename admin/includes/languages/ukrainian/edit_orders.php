<?php
/*
  $Id: edit_orders.php,v 1.72 2003/08/07 00:28:44 jwh Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  
  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Редагування замовлення');
define('HEADING_TITLE_NUMBER', 'номер');
define('HEADING_TITLE_DATE', 'від');
define('HEADING_SUBTITLE', 'Після зміни замовлення не забудьте натиснути кнопку "Оновити" для збереження змін.');
define('HEADING_TITLE_SEARCH', 'Код замовлення:');
define('HEADING_TITLE_STATUS', 'Статус:');
define('ADDING_TITLE', 'Додати товар до замовлення');

define('HINT_UPDATE_TO_CC', '<font color="#FF0000">Порада: </font>Виберіть спосіб оплати "Кредитна картка" для отримання додаткових відомостей про платіж.');
define('HINT_DELETE_POSITION', '<font color="#FF0000">Порада: </font>Щоб видалити товар із замовлення, встановіть кількість "0" навпроти потрібного товару.');
define('HINT_TOTALS', '');
//define('HINT_TOTALS', '<font color="#FF0000">Hint: </font>Feel free to give discounts by adding negative amounts to the list.<br>Fields with "0" values are deleted when updating the order (exception: shipping).');
define('HINT_PRESS_UPDATE', 'Не забудьте натиснути кнопку "Оновити" для збереження змін.');

define('TABLE_HEADING_COMMENTS', 'Коментар');
define('TABLE_HEADING_CUSTOMERS', 'Покупці');
define('TABLE_HEADING_ORDER_TOTAL', 'Всього');
define('TABLE_HEADING_DATE_PURCHASED', 'Дата замовлення');
define('TABLE_HEADING_DELETE', 'Видалити');
define('TABLE_HEADING_STATUS', 'Новий статус');
define('TABLE_HEADING_ACTION', 'Дія');
define('TABLE_HEADING_QUANTITY', 'Кількість');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Код');
define('TABLE_HEADING_PRODUCTS', 'Товар');
define('TABLE_HEADING_TAX', 'Податок %');
define('TABLE_HEADING_TOTAL', 'Всього');
define('TABLE_HEADING_UNIT_PRICE', 'Вартість (без податку)');
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Вартість (з податком)');
define('TABLE_HEADING_TOTAL_PRICE', 'Всього (без податку)');
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Всього (з податком)');
define('TABLE_HEADING_TOTAL_MODULE', 'Загальна вартість замовлення');
define('TABLE_HEADING_TOTAL_AMOUNT', 'Сума');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Покупець повідомлений');
define('TABLE_HEADING_DATE_ADDED', 'Дата');

define('ENTRY_CUSTOMER', 'Покупець');
define('ENTRY_CUSTOMER_NAME', 'Ім\'я');
define('ENTRY_CUSTOMER_COMPANY', 'Компанія');
define('ENTRY_CUSTOMER_ADDRESS', 'Адреса покупця');
define('ENTRY_SEARCH_CLIENT', 'Пошук за ім\'ям, прізвищем або id клієнта.');
define('ENTRY_ADDRESS', 'Адреса');
define('ENTRY_CUSTOMER_SUBURB', 'Район');
define('ENTRY_CUSTOMER_CITY', 'Місто');
define('ENTRY_CUSTOMER_STATE', 'Регіон');
define('ENTRY_CUSTOMER_POSTCODE', 'Поштовий індекс');
define('ENTRY_CUSTOMER_COUNTRY', 'Країна');
define('ENTRY_CUSTOMER_PHONE', 'Телефон');
define('ENTRY_CUSTOMER_FAX', 'Факс');
define('ENTRY_CUSTOMER_EMAIL', 'E-Mail');

define('ENTRY_SOLD_TO', 'Покупець:');
define('ENTRY_DELIVERY_TO', 'Доставка:');
define('ENTRY_SHIP_TO', 'Адреса доставки:');
define('ENTRY_SHIPPING_ADDRESS', 'Адреса доставки');
define('ENTRY_BILLING_ADDRESS', 'Адреса оплати');
define('ENTRY_PAYMENT_METHOD', 'Спосіб оплати:');
define('ENTRY_CREDIT_CARD_TYPE', 'Тип картки:');
define('ENTRY_CREDIT_CARD_OWNER', 'Власник картки:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Номер картки:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Дійсна до:');
define('ENTRY_SUB_TOTAL', 'Вартість товару:');
define('ENTRY_TAX', 'Податок:');
define('ENTRY_SHIPPING', 'Доставка:');
define('ENTRY_NEW_TOTAL', 'Додати поле:');
define('ENTRY_TOTAL', 'Всього:');
define('ENTRY_DATE_PURCHASED', 'Дата купівлі:');
define('ENTRY_STATUS', 'Статус замовлення:');
define('ENTRY_DATE_LAST_UPDATED', 'останнє оновлення:');
define('ENTRY_NOTIFY_CUSTOMER', 'Повідомити покупця:');
define('ENTRY_NOTIFY_COMMENTS', 'Опублікувати коментар:');
define('ENTRY_PRINTABLE', 'Роздрукувати рахунок');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Видалення замовлення');
define('TEXT_INFO_DELETE_INTRO', 'Ви дійсно хочете видалити дане замовлення?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Перерахувати кількість');
define('TEXT_DATE_ORDER_CREATED', 'Дата створення замовлення:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Остання зміна:');
define('TEXT_DATE_ORDER_ADDNEW', 'Додати новий товар');
define('TEXT_INFO_PAYMENT_METHOD', 'Спосіб оплати:');

define('TEXT_ALL_ORDERS', 'Всього замовлення');
define('TEXT_NO_ORDER_HISTORY', 'Замовлення не знайдене');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Ваше замовлення було оновлено');
define('EMAIL_TEXT_ORDER_NUMBER', 'Номер замовлення:');
define('EMAIL_TEXT_INVOICE_URL', 'Детальна інформація про замовлення:');
define('EMAIL_TEXT_DATE_ORDERED', 'Дата замовлення:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Спасибо за Ваш заказ!' . "\n\n" . 'Статус Вашего заказа был изменён.' . "\n\n" . 'Новый статус: %s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', 'Если у Вас есть вопросы, задайте их нам в ответном письме.' . "\n\n" . 'С уважением, ' . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Комментарии к Вашему заказу:' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Помилка: Замовлення не знайдене.');
define('SUCCESS_ORDER_UPDATED', 'Успішно: Замовлення було успішно змінено.');
define('WARNING_ORDER_NOT_UPDATED', 'Попередження: Ніяких змін зроблено не було.');

define('ADDPRODUCT_TEXT_CATEGORY_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_PRODUCT', 'Виберіть товар');
define('ADDPRODUCT_TEXT_PRODUCT_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_OPTIONS', 'Виберіть опцію');
define('ADDPRODUCT_TEXT_OPTIONS_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_OPTIONS_NOTEXIST', 'У товару немає опцій, пропускаємо ...');
define('ADDPRODUCT_TEXT_CONFIRM_QUANTITY', 'кількість даного товару');
define('ADDPRODUCT_TEXT_CONFIRM_ADDNOW', 'Додати');
define('ADDPRODUCT_TEXT_STEP', 'Крок');
define('ADDPRODUCT_TEXT_STEP1', ' &laquo; Виберіть розділ. ');
define('ADDPRODUCT_TEXT_STEP2', ' &laquo; Виберіть товар. ');
define('ADDPRODUCT_TEXT_STEP3', ' &laquo; Виберіть опцію. ');

define('MENUE_TITLE_CUSTOMER', '1. Дані покупця');
define('MENUE_TITLE_PAYMENT', '2. Спосіб оплати');
define('MENUE_TITLE_ORDER', '3. Замовлені товари');
define('MENUE_TITLE_TOTAL', '4. Доставка і сума');
define('MENUE_TITLE_STATUS', '5. Статус і повідомлення');
define('MENUE_TITLE_UPDATE', '6. Оновити дані');

define('EMAIL_ACC_DISCOUNT_INTRO_OWNER', 'Один из ваших клиентов достиг предела накопительной скидки и был переведен в новую группу. ' . "\n\n" . 'Детали:');
define('EMAIL_TEXT_LIMIT', 'Досягнута межа:');
define('EMAIL_TEXT_CURRENT_GROUP', 'Нова група: ');
define('EMAIL_TEXT_DISCOUNT', 'Знижка:');
define('EMAIL_ACC_SUBJECT', 'Накопичувальна знижка');
define('EMAIL_ACC_INTRO_CUSTOMER', 'Вітаємо, Ви отримали нову накопичувальну знижку. Всі деталі нижче:');
define('EMAIL_ACC_FOOTER', 'Тепер Ви можете заощадити, роблячи покупки в нашому інтернет-магазині.');

define('EMAIL_TEXT_CUSTOMER_NAME', 'Покупець:');
define('EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS', 'Email:');
define('EMAIL_TEXT_CUSTOMER_TELEPHONE', 'Телефон:');

define('TEXT_ORDER_COMMENTS', 'Коментар до замовлення');
define('TEXT_PRODUCT_NAME_PLACEHOLDER', 'Введіть назву товару');

//Button
define('BUTTON_BACK_NEW', 'назад');
?>