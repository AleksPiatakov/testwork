<?php
/*
  $Id: modules.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE_MODULES_PAYMENT', 'Модулі Оплати');
define('HEADING_TITLE_MODULES_SHIPPING', 'Модулі Доставки');
define('HEADING_TITLE_MODULES_ORDER_TOTAL', 'Модулі Замовлень');
define('TEXT_INSTALL_INTRO', 'Ви дійсно хочете встановити цей модуль?');
define('TEXT_DELETE_INTRO', 'Ви дійсно хочете видалити цей модуль?');


define('TABLE_HEADING_MODULES', 'Модулі');
define('TABLE_HEADING_MODULE_DESCRIPTION', 'Опис');
define('TABLE_HEADING_SORT_ORDER', 'Порядок Сортування');
define('TABLE_HEADING_ACTION', 'Дія');
define('TEXT_MODULE_DIRECTORY', 'Директорія модулів:');
define('TEXT_CLOSE_BUTTON', 'Закрити');

define('MODULE_PAYMENT_CC_STATUS_TITLE', 'Дозволити модуль оплати кредитна картка');
define('MODULE_PAYMENT_CC_STATUS_DESC', 'Чи хочете Ви приймати платежі за допомогою кредитних карток?');
define('MODULE_PAYMENT_CC_EMAIL_TITLE', 'E-Mail Адреса');
define('MODULE_PAYMENT_CC_EMAIL_DESC', 'Якщо вказано e-mail адрес, то на вказаний e-mail адрес будуть відправлятися середні цифри з номера кредитної картки (в базі даних буде зберігатися повний номер кредитної картки, за винятком даних середніх цифр)');
define('MODULE_PAYMENT_CC_ZONE_TITLE', 'Зона');
define('MODULE_PAYMENT_CC_ZONE_DESC', 'Якщо обрана зона, то даний модуль оплати буде видно тільки покупцям з обраної зони.');
define('MODULE_PAYMENT_CC_ORDER_STATUS_ID_TITLE', 'Статус замовлення');
define('MODULE_PAYMENT_CC_ORDER_STATUS_ID_DESC', 'Замовлення, оформлені з використанням даного модуля оплати прийматимуть вказаний статус.');
define('MODULE_PAYMENT_CC_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_PAYMENT_CC_SORT_ORDER_DESC', 'Порядок сортування модуля.');

define('MODULE_PAYMENT_COD_STATUS_TITLE', 'Дозволити модуль оплати Готівкою при отриманні');
define('MODULE_PAYMENT_COD_STATUS_DESC', 'Ви бажаєте дозволити використання модуля при оформленні замовлень?');
define('MODULE_PAYMENT_COD_ZONE_TITLE', 'Зона');
define('MODULE_PAYMENT_COD_ZONE_DESC', 'Якщо обрана зона, то даний модуль оплати буде видно тільки покупцям з обраної зони.');
define('MODULE_PAYMENT_COD_ORDER_STATUS_ID_TITLE', 'Статус замовлення');
define('MODULE_PAYMENT_COD_ORDER_STATUS_ID_DESC', 'Замовлення, оформлені з використанням даного модуля оплати прийматимуть вказаний статус.');
define('MODULE_PAYMENT_COD_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_PAYMENT_COD_SORT_ORDER_DESC', 'Порядок сортування модуля.');

define('MODULE_PAYMENT_FREECHARGER_STATUS_TITLE', 'Дозволити модуль Безкоштовне завантаження');
define('MODULE_PAYMENT_FREECHARGER_STATUS_DESC', 'Ви бажаєте дозволити модуль безкоштовне завантаження?');
define('MODULE_PAYMENT_FREECHARGER_ZONE_TITLE', 'Зона');
define('MODULE_PAYMENT_FREECHARGER_ZONE_DESC', 'Якщо обрана зона, то даний модуль оплати буде видно тільки покупцям з обраної зони.');
define('MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID_TITLE', 'Статус замовлення');
define('MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID_DESC', 'Замовлення, оформлені з використанням даного модуля оплати прийматимуть вказаний статус.');
define('MODULE_PAYMENT_FREECHARGER_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_PAYMENT_FREECHARGER_SORT_ORDER_DESC', 'Порядок сортування модуля.');

define('MODULE_PAYMENT_LIQPAY_STATUS_TITLE', 'Дозволити модуль оплати LiqPAY');
define('MODULE_PAYMENT_LIQPAY_STATUS_DESC', 'Дозволити модуль оплати LiqPAY?');
define('MODULE_PAYMENT_LIQPAY_ID_TITLE', 'Мерчант ID');
define('MODULE_PAYMENT_LIQPAY_ID_DESC', 'Вкажіть Ваш ідентіфікаціонниий номер (мерчант id).');
define('MODULE_PAYMENT_LIQPAY_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_PAYMENT_LIQPAY_SORT_ORDER_DESC', 'Порядок сортування модуля.');
define('MODULE_PAYMENT_LIQPAY_ZONE_TITLE', 'Зона оплати');
define('MODULE_PAYMENT_LIQPAY_ZONE_DESC', 'Якщо обрана зона, то даний модуль оплати буде видно тільки покупцям з обраної зони.');
define('MODULE_PAYMENT_LIQPAY_SECRET_KEY_TITLE', 'Мерчант пароль (підпис)');
define('MODULE_PAYMENT_LIQPAY_SECRET_KEY_DESC', 'У даній опції вкажіть пароль (підпис), зазначений в настройках на сайті LiqPAY.');
define('MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID_TITLE', 'Вкажіть оплачений статус замовлення');
define('MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID_DESC', 'Вкажіть оплачений статус замовлення');

define('MODULE_PAYMENT_LIQPAY_DEFAULT_ORDER_STATUS_ID_TITLE', 'Вкажіть статус замовлення замовчуванням');
define('MODULE_PAYMENT_LIQPAY_DEFAULT_ORDER_STATUS_ID_DESC', 'Вкажіть статус замовлення замовчуванням');

define('MODULE_PAYMENT_MONO_STATUS_TITLE', 'Дозволити модуль оплати Monobank');
define('MODULE_PAYMENT_MONO_STATUS_DESC', 'Дозволити модуль оплати Monobank?');
define('MODULE_PAYMENT_MONO_ID_TITLE', 'X-Token');
define('MODULE_PAYMENT_MONO_ID_DESC', 'Вкажіть Ваш ідентіфікаціонниий номер (X-Token).');
define('MODULE_PAYMENT_MONO_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_PAYMENT_MONO_SORT_ORDER_DESC', 'Порядок сортування модуля.');
define('MODULE_PAYMENT_MONO_ZONE_TITLE', 'Зона оплати');
define('MODULE_PAYMENT_MONO_ZONE_DESC', 'Якщо обрана зона, то даний модуль оплати буде видно тільки покупцям з обраної зони.');
define('MODULE_PAYMENT_MONO_ORDER_STATUS_ID_TITLE', 'Вкажіть оплачений статус замовлення');
define('MODULE_PAYMENT_MONO_ORDER_STATUS_ID_DESC', 'Вкажіть оплачений статус замовлення');

define('MODULE_PAYMENT_MONO_DEFAULT_ORDER_STATUS_ID_TITLE', 'Вкажіть статус замовлення за замовчуванням');
define('MODULE_PAYMENT_MONO_DEFAULT_ORDER_STATUS_ID_DESC', 'Вкажіть статус замовлення за замовчуванням');

define('MODULE_PAYMENT_BANK_TRANSFER_STATUS_TITLE', 'Предоплата на рахунок');
define('MODULE_PAYMENT_BANK_TRANSFER_STATUS_DESC', 'Ви бажаєте використовувати модуль Передплата на рахунок? 1 - так, 0 - ні');
define('MODULE_PAYMENT_BANK_TRANSFER_1_TITLE', 'Назва банку');
define('MODULE_PAYMENT_BANK_TRANSFER_1_DESC', 'Введіть назву банку');
define('MODULE_PAYMENT_BANK_TRANSFER_2_TITLE', 'Розрахунковий рахунок');
define('MODULE_PAYMENT_BANK_TRANSFER_2_DESC', 'Введіть Ваш розрахунковий рахунок');
define('MODULE_PAYMENT_BANK_TRANSFER_3_TITLE', 'МФО');
define('MODULE_PAYMENT_BANK_TRANSFER_3_DESC', 'Введіть МФО Банку');
define('MODULE_PAYMENT_BANK_TRANSFER_4_TITLE', 'Кор./рахунок');
define('MODULE_PAYMENT_BANK_TRANSFER_4_DESC', 'Введіть Кор./рахунок банку');
define('MODULE_PAYMENT_BANK_TRANSFER_5_TITLE', 'ЄДРПОУ/ІПН');
define('MODULE_PAYMENT_BANK_TRANSFER_5_DESC', 'Введіть ЄДРПОУ/ІПН');
define('MODULE_PAYMENT_BANK_TRANSFER_6_TITLE', 'Одержувач');
define('MODULE_PAYMENT_BANK_TRANSFER_6_DESC', 'Одержувач платежу');
define('MODULE_PAYMENT_BANK_TRANSFER_7_TITLE', 'КПП');
define('MODULE_PAYMENT_BANK_TRANSFER_7_DESC', 'Введіть КПП');
define('MODULE_PAYMENT_BANK_TRANSFER_8_TITLE', 'Призначення платежу');
define('MODULE_PAYMENT_BANK_TRANSFER_8_DESC', 'Вкажіть призначення платежу');
define('MODULE_PAYMENT_BANK_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_PAYMENT_BANK_SORT_ORDER_DESC', 'Порядок сортування модуля');

define('MODULE_PAYMENT_BANK_CART_TRANSFER_STATUS_TITLE', 'Предоплата на карту');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_STATUS_DESC', 'Ви бажаєте використовувати модуль Передплата на карту? 1 - так, 0 - ні');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_1_TITLE', 'Назва банку');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_1_DESC', 'Введіть назву банку');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_2_TITLE', 'Номер карти');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_2_DESC', 'Введіть Ваш номер карти');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_3_TITLE', 'Одержувач');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_3_DESC', 'Одержувач платежу');
define('MODULE_PAYMENT_BANK_CART_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_PAYMENT_BANK_CART_SORT_ORDER_DESC', 'Порядок сортування модуля');



define('MODULE_PAYMENT_WEBMONEY_STATUS_TITLE', 'Оплата через систему WebMoney');
define('MODULE_PAYMENT_WEBMONEY_STATUS_DESC', 'Ви бажаєте використовувати модуль Оплата через систему WebMoney? 1 - так, 0 - ні');
define('MODULE_PAYMENT_WEBMONEY_1_TITLE', 'Ваш WM Ідентифікатор');
define('MODULE_PAYMENT_WEBMONEY_1_DESC', 'Введіть Ваш WM ідентифікатор');
define('MODULE_PAYMENT_WEBMONEY_2_TITLE', 'Номер Вашого R гаманця');
define('MODULE_PAYMENT_WEBMONEY_2_DESC', 'Введіть номер Вашого R гаманця');
define('MODULE_PAYMENT_WEBMONEY_3_TITLE', 'Номер Вашого Z гаманця');
define('MODULE_PAYMENT_WEBMONEY_3_DESC', 'Введіть номер Вашого Z гаманця');
define('MODULE_PAYMENT_WEBMONEY_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_PAYMENT_WEBMONEY_SORT_ORDER_DESC', 'Порядок сортування модуля');

// -----------------------SHIPPING!!!!!---------------------------//

define('MODULE_SHIPPING_EXPRESS_STATUS_TITLE', 'Дозволити модуль кур\'єрська доставка');
define('MODULE_SHIPPING_EXPRESS_STATUS_DESC', 'Ви бажаєте дозволити модуль кур\'єрська доставка?');
define('MODULE_SHIPPING_EXPRESS_COST_TITLE', 'Вартість');
define('MODULE_SHIPPING_EXPRESS_COST_DESC', 'Вартість використання даного способу доставки.');
define('MODULE_SHIPPING_EXPRESS_TAX_CLASS_TITLE', 'Податок');
define('MODULE_SHIPPING_EXPRESS_TAX_CLASS_DESC', 'Використовувати податок.');
define('MODULE_SHIPPING_EXPRESS_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_EXPRESS_ZONE_DESC', 'Якщо обрана зона, то даний модуль оплати буде видно тільки покупцям з обраної зони.');
define('MODULE_SHIPPING_EXPRESS_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_SHIPPING_EXPRESS_SORT_ORDER_DESC', 'Порядок сортування модуля.');

define('MODULE_SHIPPING_FLAT_STATUS_TITLE', 'Дозволити модуль кур\'єрська доставка');
define('MODULE_SHIPPING_FLAT_STATUS_DESC', 'Ви бажаєте дозволити модуль кур\'єрська доставка?');
define('MODULE_SHIPPING_FLAT_COST_TITLE', 'Вартість');
define('MODULE_SHIPPING_FLAT_COST_DESC', 'Вартість використання даного способу доставки.');
define('MODULE_SHIPPING_FLAT_TAX_CLASS_TITLE', 'Податок');
define('MODULE_SHIPPING_FLAT_TAX_CLASS_DESC', 'Використовувати податок.');
define('MODULE_SHIPPING_FLAT_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_FLAT_ZONE_DESC', 'Якщо обрана зона, то даний модуль оплати буде видно тільки покупцям з обраної зони.');
define('MODULE_SHIPPING_FLAT_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_SHIPPING_FLAT_SORT_ORDER_DESC', 'Порядок сортування модуля.');

define('MODULE_SHIPPING_FREESHIPPER_STATUS_TITLE', 'Дозволити безкоштовну доставку');
define('MODULE_SHIPPING_FREESHIPPER_STATUS_DESC', 'Ви бажаєте дозволити модуль безкоштовна доставка?');
define('MODULE_SHIPPING_FREESHIPPER_COST_TITLE', 'Вартість');
define('MODULE_SHIPPING_FREESHIPPER_COST_DESC', 'Вартість використання даного способу доставки.');
define('MODULE_SHIPPING_FREESHIPPER_TAX_CLASS_TITLE', 'Податок');
define('MODULE_SHIPPING_FREESHIPPER_TAX_CLASS_DESC', 'Використовувати податок.');
define('MODULE_SHIPPING_FREESHIPPER_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_FREESHIPPER_ZONE_DESC', 'Якщо обрана зона, то даний модуль оплати буде видно тільки покупцям з обраної зони.');
define('MODULE_SHIPPING_FREESHIPPER_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_SHIPPING_FREESHIPPER_SORT_ORDER_DESC', 'Порядок сортування модуля.');

define('MODULE_SHIPPING_ITEM_STATUS_TITLE', 'Дозволити модуль на одиницю');
define('MODULE_SHIPPING_ITEM_STATUS_DESC', 'Ви бажаєте дозволити модуль на одиницю?');
define('MODULE_SHIPPING_ITEM_COST_TITLE', 'Вартість доставки');
define('MODULE_SHIPPING_ITEM_COST_DESC', 'Вартість доставки буде помножена на кількість одиниць товару в замовленні.');
define('MODULE_SHIPPING_ITEM_HANDLING_TITLE', 'Вартість');
define('MODULE_SHIPPING_ITEM_HANDLING_DESC', 'Вартість використання даного способу доставки.');
define('MODULE_SHIPPING_ITEM_TAX_CLASS_TITLE', 'Податок');
define('MODULE_SHIPPING_ITEM_TAX_CLASS_DESC', 'Використовувати податок.');
define('MODULE_SHIPPING_ITEM_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_ITEM_ZONE_DESC', 'Якщо обрана зона, то даний модуль оплати буде видно тільки покупцям з обраної зони.');
define('MODULE_SHIPPING_ITEM_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_SHIPPING_ITEM_SORT_ORDER_DESC', 'Порядок сортування модуля.');

define('MODULE_SHIPPING_NWPOCHTA_STATUS_TITLE', 'Дозволити модуль Нова Пошта');
define('MODULE_SHIPPING_NWPOCHTA_STATUS_DESC', 'Ви бажаєте дозволити модуль Нова Пошта?');
define('MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME_TITLE', 'Спец. Назва');
define('MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME_DESC', 'Залиште поле порожнім якщо хочете використовувати назву за замовчуванням');
define('MODULE_SHIPPING_NWPOCHTA_COST_TITLE', 'Вартість');
define('MODULE_SHIPPING_NWPOCHTA_COST_DESC', 'Вартість використання даного способу доставки.');
define('MODULE_SHIPPING_NWPOCHTA_TAX_CLASS_TITLE', 'Податок');
define('MODULE_SHIPPING_NWPOCHTA_TAX_CLASS_DESC', 'Використовувати податок.');
define('MODULE_SHIPPING_NWPOCHTA_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_NWPOCHTA_ZONE_DESC', 'Якщо обрана зона, то даний модуль оплати буде видно тільки покупцям з обраної зони.');
define('MODULE_SHIPPING_NWPOCHTA_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_SHIPPING_NWPOCHTA_SORT_ORDER_DESC', 'Порядок сортування модуля.');

define('MODULE_SHIPPING_NWPOSHTANEW_STATUS_TITLE', 'Дозволити модуль Нова Пошта');
define('MODULE_SHIPPING_NWPOSHTANEW_STATUS_DESC', 'Ви хочете дозволити модуль Нова Пошта?');
define('MODULE_SHIPPING_NWPOSHTANEW_COST_TITLE', 'Вартість');
define('MODULE_SHIPPING_NWPOSHTANEW_CUSTOM_NAME_TITLE', 'Спец. Назва');
define('MODULE_SHIPPING_NWPOSHTANEW_CUSTOM_NAME_DESC', 'Залиште поле порожнім якщо хочете використовувати назву за промовчанням');
define('MODULE_SHIPPING_EXPRESS_SHIPPING_PRICE_TEXT_TITLE', 'Ціна доставки текст');
define('MODULE_SHIPPING_EXPRESS_SHIPPING_PRICE_TEXT_DESC', 'Залишіть порожнім, якщо хочете використовувати ціну, яка вказана в полі вартість');
define('MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_PRICE_TEXT_TITLE', 'Ціна доставки текст');
define('MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_PRICE_TEXT_DESC', 'Залишіть порожнім, якщо хочете використовувати ціну, яка вказана в полі вартість');
define('MODULE_SHIPPING_NWPOCHTA_SHIPPING_PRICE_TEXT_TITLE', 'Ціна доставки текст');
define('MODULE_SHIPPING_NWPOCHTA_SHIPPING_PRICE_TEXT_DESC', 'Залишіть порожнім, якщо хочете використовувати ціну, яка вказана в полі вартість');
define('MODULE_SHIPPING_NWPOSHTANEW_COST_DESC', 'Вартість використання цього способу доставки.');
define('MODULE_SHIPPING_NWPOSHTANEW_TAX_CLASS_TITLE', 'Податок');
define('MODULE_SHIPPING_NWPOSHTANEW_TAX_CLASS_DESC', 'Використовувати податок');
define('MODULE_SHIPPING_NWPOSHTANEW_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_NWPOSHTANEW_ZONE_DESC', 'Якщо вибрана зона, то цей модуль доставки буде видно тільки покупцям із вибраної зони.');
define('MODULE_SHIPPING_NWPOSHTANEW_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_SHIPPING_NWPOSHTANEW_SORT_ORDER_DESC', 'Порядок сортування модуля.');
define('MODULE_SHIPPING_NWPOSHTANEW_API_KEY_TITLE', 'Ключ API');
define('MODULE_SHIPPING_NWPOSHTANEW_API_KEY_DESCRIPTION', 'Може знадобитися для оновлення складів');
define('MODULE_SHIPPING_NWPOSHTANEW_SHOW_SHIPPING_COST_STATUS_TITLE', 'Показувати вартість доставки');

define('MODULE_SHIPPING_NWPOSHTANEW_AUTODETECTION_DEPARTURE_TYPE_TITLE', 'Автовизначення типу відправлення');
define('MODULE_SHIPPING_NWPOSHTANEW_AUTODETECTION_DEPARTURE_TYPE_DESC', 'Визначати тип відправлення автоматично?');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_REGION_TITLE', 'Область відправника');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_REGION_DESC', 'Вкажіть область відправника');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_CITY_NAME_TITLE', 'Місто відправника');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_CITY_NAME_DESC', 'Виберіть місто з якого буде здійснюватись відправлення замовлення');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS_NAME_TITLE', 'Адреса відправника');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS_NAME_DESC', 'Виберіть адресу з якої буде надсилатися замовлення');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_TYPE_TITLE', 'Тип відправлення');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_TYPE_DESC', 'Вкажіть тип відправлення.');
define('MODULE_SHIPPING_NWPOSHTANEW_SEATS_AMOUNT_TITLE', 'Кількість місць');
define('MODULE_SHIPPING_NWPOSHTANEW_SEATS_AMOUNT_DESC', 'Вкажіть кількість місць за замовчуванням. Якщо залишити поле порожнім, кількість місць відповідатиме кількості товарів у замовленні.');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_DESCRIPTION_TITLE', 'Опис відправлення');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_DESCRIPTION_DESC', 'Використовується як опис товару за умовчанням під час створення «ЕН», зручно якщо у магазині багато товарів, які мають однаковий опис.');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_TITLE', 'Зворотня доставка');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_DESC', 'Вкажіть тип зворотної доставки за промовчанням.');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_TITLE', 'Оголошена вартість');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DESC', 'Вкажіть складові для оголошеної вартості відправлення.');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DEFAULT_TITLE', 'Оголошена вартість за промовчанням');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DEFAULT_DESC', 'Значення буде використано якщо оголошена вартість не задана або оплата на замовлення не післяплатою.');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_PAYER_TITLE', 'Платник зворотної доставки');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_PAYER_DESC', 'Вкажіть платника зворотної доставки за замовчуванням.');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_TYPE_TITLE', 'Форма оплати');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_TYPE_DESC', 'Вкажіть форму оплати за промовчанням.');
define('MODULE_SHIPPING_NWPOSHTANEW_MONEY_TRANSFER_METHOD_TITLE', 'Спосіб отримання грошового переказу');
define('MODULE_SHIPPING_NWPOSHTANEW_MONEY_TRANSFER_METHOD_DESC', 'Вкажіть спосіб отримання грошового переказу.');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD_TITLE', 'Метод оплати післяплатою');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD_DESC', 'Вкажіть спосіб оплати, що відповідає післяплаті.');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_CONTROL_TITLE', 'Контроль оплати');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_CONTROL_DESC', 'Вкажіть складові для контролю оплати. Якщо будуть відзначені позиції, то контроль оплати замінятиме грошовий переказ..');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_ADDITIONAL_INFORMATION_TITLE', 'Додаткова інформація про відправлення');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_ADDITIONAL_INFORMATION_DESC', 'Використовується як шаблон поля додаткової інформації про відправлення під час створення ТТН. Можливе застосування макросів. При використанні макросів товару розділяйте текст на два блоки символом «|» (макроси товару використовуйте у другому блоці).');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_FORMAT_TITLE', 'Формат друку');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_FORMAT_DESC', 'Вкажіть формат друку.');
define('MODULE_SHIPPING_NWPOSHTANEW_TEMPLATE_TYPE_TITLE', 'Тип шаблону');
define('MODULE_SHIPPING_NWPOSHTANEW_TEMPLATE_TYPE_DESC', 'Вкажіть тип шаблону.');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_TYPE_TITLE', 'Тип друку');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_TYPE_DESC', 'Вкажіть тип друку.');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_START_TITLE', 'Місце друку');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_START_DESC', 'Вкажіть місце, з якого починається друк.');
define('MODULE_SHIPPING_NWPOSHTANEW_NUMBER_OF_COPIES_TITLE', 'Кількість копій');
define('MODULE_SHIPPING_NWPOSHTANEW_NUMBER_OF_COPIES_DESC', 'Вкажіть кількість копій.');
define('MODULE_SHIPPING_NWPOSHTANEW_DISPLAY_ALL_CONSIGNMENTS_TITLE', 'Відображення всіх накладних облікових записів');
define('MODULE_SHIPPING_NWPOSHTANEW_DISPLAY_ALL_CONSIGNMENTS_DESC', 'Відображати всі накладні облікового запису поштової компанії? Якщо вибрати «Ні», відображатимуться лише ті накладні, які закріплені за замовленнями даного інтернет-магазину.');
define('MODULE_SHIPPING_NWPOSHTANEW_CONSIGNMENT_DISPLAYED_INFORMATION_TITLE', 'Відображувана інформація');
define('MODULE_SHIPPING_NWPOSHTANEW_CONSIGNMENT_DISPLAYED_INFORMATION_DESC', 'Виберіть інформацію для відображення.');
define('MODULE_SHIPPING_NWPOSHTANEW_DELIVERY_PAYER_TITLE', 'Платник доставки');
define('MODULE_SHIPPING_NWPOSHTANEW_DELIVERY_PAYER_DESC', 'Вкажіть платника доставки за замовчуванням');
define('MODULE_SHIPPING_NWPOSHTANEW_WEIGHT_TITLE', 'Вага');
define('MODULE_SHIPPING_NWPOSHTANEW_WEIGHT_DESC', 'Вкажіть фактичну вагу за промовчанням');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_W_TITLE', 'Ширина');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_W_DESC', 'Вкажіть ширину за замовчуванням');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_L_TITLE', 'Довжина');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_L_DESC', 'Вкажіть довжину за замовчуванням');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_H_TITLE', 'Висота');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_H_DESC', 'Вкажіть висоту за промовчанням');
define('MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE_TITLE', 'Налагоджувальний режим');
define('MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE_DESC', 'Увімкнути/вимкнути налагоджувальний режим');
define('MODULE_SHIPPING_NWPOSHTANEW_SAVE_TTN_ONE_CLICK_TITLE', 'Створювати ТТН за один клік');
define('MODULE_SHIPPING_NWPOSHTANEW_SAVE_TTN_ONE_CLICK_DESC', 'Включити/вимкнути створення ТТН в один клік');
define('MODULE_SHIPPING_NWPOSHTANEW_cn_identifier', 'Ідентифікатор накладної');
define('MODULE_SHIPPING_NWPOSHTANEW_cn_number', '№ накладний');
define('MODULE_SHIPPING_NWPOSHTANEW_order_number', '№ замовлення');
define('MODULE_SHIPPING_NWPOSHTANEW_create_date', 'Дата створення');
define('MODULE_SHIPPING_NWPOSHTANEW_actual_shipping_date', 'Фактична дата відправлення');
define('MODULE_SHIPPING_NWPOSHTANEW_preferred_shipping_date', 'Бажана дата доставки');
define('MODULE_SHIPPING_NWPOSHTANEW_estimated_shipping_date', 'Передбачувана дата доставки');
define('MODULE_SHIPPING_NWPOSHTANEW_recipient_date', 'Дата отримання');
define('MODULE_SHIPPING_NWPOSHTANEW_last_updated_status_date', 'Дата останнього оновлення статусу');
define('MODULE_SHIPPING_NWPOSHTANEW_sender', 'Відправник');
define('MODULE_SHIPPING_NWPOSHTANEW_sender_address', 'Адреса відправника');
define('MODULE_SHIPPING_NWPOSHTANEW_recipient', 'Одержувач');
define('MODULE_SHIPPING_NWPOSHTANEW_recipient_address', 'Адреса одержувача');
define('MODULE_SHIPPING_NWPOSHTANEW_weight', 'Вага, кг');
define('MODULE_SHIPPING_NWPOSHTANEW_seats_amount', 'Кількість місць');
define('MODULE_SHIPPING_NWPOSHTANEW_declared_cost', 'Оголошена вартість');
define('MODULE_SHIPPING_NWPOSHTANEW_shipping_cost', 'Вартість доставки');
define('MODULE_SHIPPING_NWPOSHTANEW_backward_delivery', 'Зворотня доставка');
define('MODULE_SHIPPING_NWPOSHTANEW_service_type', 'Технологія доставки');
define('MODULE_SHIPPING_NWPOSHTANEW_description', 'Опис');
define('MODULE_SHIPPING_NWPOSHTANEW_additional_information', 'Дополнительная информация');
define('MODULE_SHIPPING_NWPOSHTANEW_payer_type', 'Платник доставки');
define('MODULE_SHIPPING_NWPOSHTANEW_payment_method', 'Тип оплати');
define('MODULE_SHIPPING_NWPOSHTANEW_departure_type', 'Тип відправлення');
define('MODULE_SHIPPING_NWPOSHTANEW_packing_number', 'Номер упаковки');
define('MODULE_SHIPPING_NWPOSHTANEW_rejection_reason', 'Причина не розвезення');
define('MODULE_SHIPPING_NWPOSHTANEW_status', 'Статус');
define('MODULE_SHIPPING_NWPOSHTANEW_Cargo', 'Вантаж');
define('MODULE_SHIPPING_NWPOSHTANEW_Parcel', 'Посилка');
define('MODULE_SHIPPING_NWPOSHTANEW_Documents', 'Документи');
define('MODULE_SHIPPING_NWPOSHTANEW_TiresWheels', 'Шини-диски');
define('MODULE_SHIPPING_NWPOSHTANEW_Pallet', 'Палети');
define('MODULE_SHIPPING_NWPOSHTANEW_N', 'Немає зворотної доставки');
define('MODULE_SHIPPING_NWPOSHTANEW_Money', 'Грошовий переказ');
define('MODULE_SHIPPING_NWPOSHTANEW_ot_shipping', 'Доставка');
define('MODULE_SHIPPING_NWPOSHTANEW_ot_subtotal', 'Попередній Підсумок');
define('MODULE_SHIPPING_NWPOSHTANEW_ot_total', 'Замовлення Разом');
define('MODULE_SHIPPING_NWPOSHTANEW_Sender', 'Відправник');
define('MODULE_SHIPPING_NWPOSHTANEW_Recipient', 'Одержувач');
define('MODULE_SHIPPING_NWPOSHTANEW_ThirdPerson', 'Третя особа');
define('MODULE_SHIPPING_NWPOSHTANEW_on_warehouse', 'У відділення');
define('MODULE_SHIPPING_NWPOSHTANEW_to_payment_card', 'На карту');
define('MODULE_SHIPPING_NWPOSHTANEW_document_A4', 'EN A4 ');
define('MODULE_SHIPPING_NWPOSHTANEW_document_A5', 'EN A5 ');
define('MODULE_SHIPPING_NWPOSHTANEW_markings_A4', 'Маркування ');
define('MODULE_SHIPPING_NWPOSHTANEW_html', 'HTML');
define('MODULE_SHIPPING_NWPOSHTANEW_pdf', 'PDF');
define('MODULE_SHIPPING_NWPOSHTANEW_horPrint', 'Горизонтальна');
define('MODULE_SHIPPING_NWPOSHTANEW_verPrint', 'Вертикальна');
define('MODULE_SHIPPING_NWPOSHTANEW_Cash', 'Готівковий');
define('MODULE_SHIPPING_NWPOSHTANEW_NonCash', 'Безготівковий');

define('MODULE_SHIPPING_CUSTOMSHIPPER_STATUS_TITLE', 'Дозволити модуль кур\'єрська доставка');   
define('MODULE_SHIPPING_CUSTOMSHIPPER_NAME_TITLE', 'Назва перевізника');
define('MODULE_SHIPPING_CUSTOMSHIPPER_WAY_TITLE', 'Опис перевізника');
define('MODULE_SHIPPING_CUSTOMSHIPPER_COST_TITLE', 'Вартість');
define('MODULE_SHIPPING_CUSTOMSHIPPER_TAX_CLASS_TITLE', 'Податок');
define('MODULE_SHIPPING_CUSTOMSHIPPER_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_CUSTOMSHIPPER_ZONE_DESC', 'Якщо обрана зона, то даний модуль оплати буде видно тільки покупцям з обраної зони.');
define('MODULE_SHIPPING_CUSTOMSHIPPER_SORT_ORDER_TITLE', 'Порядок сортування');

define('MODULE_SHIPPING_PERCENT_STATUS_TITLE', 'Дозволити модуль процентна доставка');
define('MODULE_SHIPPING_PERCENT_STATUS_DESC', 'Ви бажаєте дозволити модуль процентна доставка?');
define('MODULE_SHIPPING_PERCENT_RATE_TITLE', 'Відсоток');
define('MODULE_SHIPPING_PERCENT_RATE_DESC', 'Вартість доставки даними модулем у відсотках від загальної вартості замовлення, значення від .01 до .99');
define('MODULE_SHIPPING_PERCENT_LESS_THEN_TITLE', 'Пряма вартість для замовлень до');
define('MODULE_SHIPPING_PERCENT_LESS_THEN_DESC', 'Пряма вартість доставки для замовлень, вартістю до зазначеного розміру.');
define('MODULE_SHIPPING_PERCENT_FLAT_USE_TITLE', 'Пряма процентна вартість');
define('MODULE_SHIPPING_PERCENT_FLAT_USE_DESC', 'Пряма вартість доставки в процентах від загальної вартості замовлення, дійсно для всіх замовлень.');
define('MODULE_SHIPPING_PERCENT_TAX_CLASS_TITLE', 'Податок');
define('MODULE_SHIPPING_PERCENT_TAX_CLASS_DESC', 'Використовувати податок.');
define('MODULE_SHIPPING_PERCENT_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_PERCENT_ZONE_DESC', 'Якщо обрана зона, то даний модуль оплати буде видно тільки покупцям з обраної зони.');
define('MODULE_SHIPPING_PERCENT_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_SHIPPING_PERCENT_SORT_ORDER_DESC', 'Порядок сортування модуля.');

define('MODULE_SHIPPING_SAT_STATUS_TITLE', 'Дозволити модуль кур\'єрська доставка');
define('MODULE_SHIPPING_SAT_STATUS_DESC', 'Ви бажаєте дозволити модуль кур\'єрська доставка?');
define('MODULE_SHIPPING_SAT_COST_TITLE', 'Вартість');
define('MODULE_SHIPPING_SAT_COST_DESC', 'Вартість використання даного способу доставки.');
define('MODULE_SHIPPING_SAT_TAX_CLASS_TITLE', 'Податок');
define('MODULE_SHIPPING_SAT_TAX_CLASS_DESC', 'Використовувати податок.');
define('MODULE_SHIPPING_SAT_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_SAT_ZONE_DESC', 'Якщо обрана зона, то даний модуль оплати буде видно тільки покупцям з обраної зони.');
define('MODULE_SHIPPING_SAT_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_SHIPPING_SAT_SORT_ORDER_DESC', 'Порядок сортування модуля.');

define('MODULE_SHIPPING_TABLE_STATUS_TITLE', 'Разрешить модуль "Без доставки"');
define('MODULE_SHIPPING_TABLE_STATUS_DESC', 'Вы хотите разрешить модуль доставки "Без доставки"?');
define('MODULE_SHIPPING_TABLE_COST_TITLE', 'Вартість доставки');
define('MODULE_SHIPPING_TABLE_COST_DESC', 'Вартість доставки розраховується на основі загальної ваги замовлення або загальної вартості замовлення. Наприклад: 25:8.50,50:5.50, і т.д ... Це означає, що до 25 доставка буде коштувати 8.50, від 25 до 50 буде коштувати 5.50 і т.д.');
define('MODULE_SHIPPING_TABLE_MODE_TITLE', 'Метод розрахунку');
define('MODULE_SHIPPING_TABLE_MODE_DESC', 'Вартість розрахунку доставки виходячи з загальної ваги замовлення (weight) або виходячи із загальної вартості замовлення (price).');
define('MODULE_SHIPPING_TABLE_HANDLING_TITLE', 'Вартість');
define('MODULE_SHIPPING_TABLE_HANDLING_DESC', 'Вартість використання даного способу доставки.');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_TITLE', 'Податок');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_DESC', 'Використовувати податок.');
define('MODULE_SHIPPING_TABLE_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_TABLE_ZONE_DESC', 'Якщо обрана зона, то даний модуль оплати буде видно тільки покупцям з обраної зони.');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_DESC', 'Порядок сортування модуля.');

define('MODULE_SHIPPING_ZONES_STATUS_TITLE', 'Дозволити модуль тарифи для зони');
define('MODULE_SHIPPING_ZONES_STATUS_DESC', 'Ви бажаєте дозволити модуль тарифи для зони?');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_TITLE', 'Податок');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_DESC', 'Використовувати податок.');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_DESC', 'Порядок сортування модуля.');
define('MODULE_SHIPPING_ZONES_COUNTRIES_1_TITLE', 'Країни 1 зони');
define('MODULE_SHIPPING_ZONES_COUNTRIES_1_DESC', 'Список країн через кому для зони 1.');
define('MODULE_SHIPPING_ZONES_COST_1_TITLE', 'Вартість доставки для 1 зони');
define('MODULE_SHIPPING_ZONES_COST_1_DESC', 'Вартість доставки через кому для зони 1 на базі максимальної вартість замовлення. Наприклад: 3:8.50,7:10.50, ... Це означає, що вартість доставки для замовлень, вагою до 3 кг. буде коштувати 8.50 для покупців з країн 1 зони.');
define('MODULE_SHIPPING_ZONES_HANDLING_1_TITLE', 'Вартість для 1 зони');
define('MODULE_SHIPPING_ZONES_HANDLING_1_DESC', 'Вартість використання даного способу доставки.');

// -----------------------ORDER TOTAL!!!!!---------------------------//

define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS_TITLE', 'Дозволити модуль Супутня знижка');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS_DESC', 'Ви бажаєте дозволити модуль Супутня знижка?');
define('MODULE_ORDER_TOTAL_OT_BETTER_TOGETHER_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_ORDER_TOTAL_OT_BETTER_TOGETHER_SORT_ORDER_DESC', 'Порядок сортування модуля.');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX_TITLE', 'Include Tax');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX_DESC', 'Використовувати податок');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX_TITLE', 'Re-calculate Tax');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX_DESC', 'Перераховувати податок');

define('MODULE_ORDER_TOTAL_COUPON_STATUS_TITLE', 'Показувати всього');
define('MODULE_ORDER_TOTAL_COUPON_STATUS_DESC', 'Ви бажаєте показувати номінал купона?');
define('MODULE_ORDER_TOTAL_OT_COUPON_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_ORDER_TOTAL_OT_COUPON_SORT_ORDER_DESC', 'Порядок сортування модуля.');
define('MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING_TITLE', 'Враховувати доставку');
define('MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING_DESC', 'Включати в розрахунок доставку.');
define('MODULE_ORDER_TOTAL_COUPON_INC_TAX_TITLE', 'Враховувати податок');
define('MODULE_ORDER_TOTAL_COUPON_INC_TAX_DESC', 'Включати в розрахунок податок.');
define('MODULE_ORDER_TOTAL_COUPON_CALC_TAX_TITLE', 'Перераховувати податок');
define('MODULE_ORDER_TOTAL_COUPON_CALC_TAX_DESC', 'Перераховувати податок.');
define('MODULE_ORDER_TOTAL_COUPON_TAX_CLASS_TITLE', 'Податок');
define('MODULE_ORDER_TOTAL_COUPON_TAX_CLASS_DESC', 'Використовувати податок для купонів.');

define('MODULE_ORDER_TOTAL_GV_STATUS_TITLE', 'Показувати всього');
define('MODULE_ORDER_TOTAL_GV_STATUS_DESC', 'Ви бажаєте показувати номінал подарункового сертифіката?');
define('MODULE_ORDER_TOTAL_OT_GV_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_ORDER_TOTAL_OT_GV_SORT_ORDER_DESC', 'Порядок сортування модуля.');
define('MODULE_ORDER_TOTAL_GV_QUEUE_TITLE', 'Активація сертифікатів');
define('MODULE_ORDER_TOTAL_GV_QUEUE_DESC', 'Ви бажаєте вручну активувати куплені подарункові сертифікати?');
define('MODULE_ORDER_TOTAL_GV_INC_SHIPPING_TITLE', 'Враховувати доставку');
define('MODULE_ORDER_TOTAL_GV_INC_SHIPPING_DESC', 'Включати в розрахунок доставку.');
define('MODULE_ORDER_TOTAL_GV_INC_TAX_TITLE', 'Враховувати податок');
define('MODULE_ORDER_TOTAL_GV_INC_TAX_DESC', 'Включати в розрахунок податок.');
define('MODULE_ORDER_TOTAL_GV_CALC_TAX_TITLE', 'Перераховувати податок');
define('MODULE_ORDER_TOTAL_GV_CALC_TAX_DESC', 'Перераховувати податок.');
define('MODULE_ORDER_TOTAL_GV_TAX_CLASS_TITLE', 'Податок');
define('MODULE_ORDER_TOTAL_GV_TAX_CLASS_DESC', 'Використовувати податок.');
define('MODULE_ORDER_TOTAL_GV_CREDIT_TAX_TITLE', 'Податок сертифіката');
define('MODULE_ORDER_TOTAL_GV_CREDIT_TAX_DESC', 'Додавати податок до до придбаних подарункових сертифікатів.');
define('MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID_TITLE', 'Статус замовлення');
define('MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID_DESC', 'Заказы, оформленные с использованием подарочного сертификата, покрывающего полную стоимость заказа, будут иметь указанный статус.');

define('MODULE_LEV_DISCOUNT_STATUS_TITLE', 'Показувати знижку');
define('MODULE_LEV_DISCOUNT_STATUS_DESC', 'Дозволити знижки?');
define('MODULE_ORDER_TOTAL_OT_LEV_DISCOUNT_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_ORDER_TOTAL_OT_LEV_DISCOUNT_SORT_ORDER_DESC', 'Порядок сортування модуля.');
define('MODULE_LEV_DISCOUNT_TABLE_TITLE', 'Відсоток знижки');
define('MODULE_LEV_DISCOUNT_TABLE_DESC', 'Встановіть цінові межі і відсотки знижки, через кому.');
define('MODULE_LEV_DISCOUNT_INC_SHIPPING_TITLE', 'Враховувати доставку');
define('MODULE_LEV_DISCOUNT_INC_SHIPPING_DESC', 'Включати в розрахунок доставку.');
define('MODULE_LEV_DISCOUNT_INC_TAX_TITLE', 'Враховувати податок');
define('MODULE_LEV_DISCOUNT_INC_TAX_DESC', 'Включати в розрахунок податок.');
define('MODULE_LEV_DISCOUNT_CALC_TAX_TITLE', 'Перераховувати податок');
define('MODULE_LEV_DISCOUNT_CALC_TAX_DESC', 'Перераховувати податок.');

define('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS_TITLE', 'Показувати нижчу вартість замовлення');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS_DESC', 'Ви хочете показати нижчу вартість замовлення?');
define('MODULE_ORDER_TOTAL_OT_LOWORDERFEE_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_ORDER_TOTAL_OT_LOWORDERFEE_SORT_ORDER_DESC', 'Порядок сортування модуля.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE_TITLE', 'Дозволити нижчу вартість замовлення');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE_DESC', 'Ви бажаєте дозволити модуль низької вартість замовлення?');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER_TITLE', 'Низька вартість для замовлень до');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER_DESC', 'Низька вартість замовлень для замовлень до зазначеного розміру.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE_TITLE', 'Плата');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE_DESC', 'Плата');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION_TITLE', 'Додавати плату до замовлення');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION_DESC', 'Додавати плату до наступних замовленнях.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS_TITLE', 'Податок');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS_DESC', 'Використовувати податок.');

define('MODULE_PAYMENT_DISC_STATUS_TITLE', 'Дозволити модуль');
define('MODULE_PAYMENT_DISC_STATUS_DESC', 'Активувати модуль?');
define('MODULE_ORDER_TOTAL_OT_PAYMENT_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_ORDER_TOTAL_OT_PAYMENT_SORT_ORDER_DESC', 'Порядок сортування модуля обов\'язково має бути нижче ніж модуль Всього.');
define('MODULE_PAYMENT_DISC_PERCENTAGE_TITLE', 'Знижка');
define('MODULE_PAYMENT_DISC_PERCENTAGE_DESC', 'Мінімальна сума замовлення для отримання знижки.');
define('MODULE_PAYMENT_DISC_MINIMUM_TITLE', 'Мінімальна сума замовлення');
define('MODULE_PAYMENT_DISC_MINIMUM_DESC', 'Мінімальна сума замовлення для отримання знижки.');
define('MODULE_PAYMENT_DISC_TYPE_TITLE', 'Спосіб оплати');
define('MODULE_PAYMENT_DISC_TYPE_DESC', 'Тут потрібно вказати назву класу модуля оплати, клас можо дізнатися в файлі модуля, наприклад /includes/modules/payment/webmoney.php. Зверху видно class webmoney, значить якщо ми хочемо дати знижку при оплаті через WebMoney, пишемо webmoney.');
define('MODULE_PAYMENT_DISC_INC_SHIPPING_TITLE', 'Враховувати доставку');
define('MODULE_PAYMENT_DISC_INC_SHIPPING_DESC', 'Включати доставку в розрахунки');
define('MODULE_PAYMENT_DISC_INC_TAX_TITLE', 'Враховувати податок');
define('MODULE_PAYMENT_DISC_INC_TAX_DESC', 'Включати податок в розрахунки.');
define('MODULE_PAYMENT_DISC_CALC_TAX_TITLE', 'Рахувати податок');
define('MODULE_PAYMENT_DISC_CALC_TAX_DESC', 'Враховувати податок при підрахунку знижки.');

define('MODULE_QTY_DISCOUNT_STATUS_TITLE', 'Показувати знижку від кількості');
define('MODULE_QTY_DISCOUNT_STATUS_DESC', 'Ви бажаєте дозволити знижки від кількості?');
define('MODULE_ORDER_TOTAL_OT_QTY_DISCOUNT_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_ORDER_TOTAL_OT_QTY_DISCOUNT_SORT_ORDER_DESC', 'Порядок сортування модуля.');
define('MODULE_QTY_DISCOUNT_RATE_TYPE_TITLE', 'Тип знижки');
define('MODULE_QTY_DISCOUNT_RATE_TYPE_DESC', 'Виберіть тип знижки - процентна (percentage) або пряма (flat rate)');
define('MODULE_QTY_DISCOUNT_RATES_TITLE', 'Знижка');
define('MODULE_QTY_DISCOUNT_RATES_DESC', 'Знижка вважається виходячи із загальної кількості замовлених одиниць товару. Наприклад: 10:5,20:10 ... і т.д. Це означає, що замовивши 10 або більше одиниць товару, покупець отримує знижку 5% або $5; 20 або більше одиниць - знижка 10% або $10; в залежності від типу');
define('MODULE_QTY_DISCOUNT_INC_SHIPPING_TITLE', 'Враховувати доставку');
define('MODULE_QTY_DISCOUNT_INC_SHIPPING_DESC', 'Включати в розрахунок доставку.');
define('MODULE_QTY_DISCOUNT_INC_TAX_TITLE', 'Враховувати податок');
define('MODULE_QTY_DISCOUNT_INC_TAX_DESC', 'Включати в розрахунок податок.');
define('MODULE_QTY_DISCOUNT_CALC_TAX_TITLE', 'Перераховувати податок');
define('MODULE_QTY_DISCOUNT_CALC_TAX_DESC', 'Перераховувати податок.');

define('MODULE_ORDER_TOTAL_SHIPPING_STATUS_TITLE', 'Показувати доставку');
define('MODULE_ORDER_TOTAL_SHIPPING_STATUS_DESC', 'Ви бажаєте показувати вартість доставки?');
define('MODULE_ORDER_TOTAL_OT_SHIPPING_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_ORDER_TOTAL_OT_SHIPPING_SORT_ORDER_DESC', 'Порядок сортування модуля.');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_TITLE', 'Дозволити безкоштовну доставку');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_DESC', 'Ви бажаєте дозволити безкоштовну доставку?');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_TITLE', 'Безкоштовна доставка для замовлень понад');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_DESC', 'Для замовлень, понад зазначеної величини, доставка буде безкоштовною ..');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_TITLE', 'Безкоштовна доставка для замовлень');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_DESC', 'Вкажіть, для яких саме замовлень буде дійсна безкоштовна доставка.');

define('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS_TITLE', 'Показувати вартість товару');
define('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS_DESC', 'Ви бажаєте показувати вартість товару?');
define('MODULE_ORDER_TOTAL_OT_SUBTOTAL_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_ORDER_TOTAL_OT_SUBTOTAL_SORT_ORDER_DESC', 'Порядок сортування модуля.');

define('MODULE_ORDER_TOTAL_TAX_STATUS_TITLE', 'Показувати податок');
define('MODULE_ORDER_TOTAL_TAX_STATUS_DESC', 'Ви бажаєте показувати податок?');
define('MODULE_ORDER_TOTAL_OT_TAX_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_ORDER_TOTAL_OT_TAX_SORT_ORDER_DESC', 'Порядок сортування модуля.');

define('MODULE_ORDER_TOTAL_TOTAL_STATUS_TITLE', 'Показувати всього');
define('MODULE_ORDER_TOTAL_TOTAL_STATUS_DESC', 'Ви бажаєте показувати загальну вартість замовлення?');
define('MODULE_ORDER_TOTAL_OT_TOTAL_SORT_ORDER_TITLE', 'Порядок сортування');
define('MODULE_ORDER_TOTAL_OT_TOTAL_SORT_ORDER_DESC', 'Порядок сортування модуля.');

define('SHIPPING_TAB_TITLE', 'Доставка');
define('SHIPPING_TO_PAYMENT_TAB_TITLE', 'Доставка до Оплати');
define('SHIPPING_TO_FIELDS_TAB_TITLE', 'Поля доставки');
define('SHIPPING_UPDATE_WAREHOUSES_TITLE', 'Оновити відділення');
define('SHIPPING_UPDATE_AREAS_TITLE', 'Оновити області');
define('SHIPPING_UPDATE_CITIES_TITLE', 'Оновити міста');
define('SHIPPING_UPDATE_REFERENCES_TITLE', 'Оновити довідники');

define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_STATUS_TITLE','Статус');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_STATUS_DESC', 'Ви хочете ввімкнути Знижку для країни?');
define('MODULE_ORDER_TOTAL_OT_COUNTRY_DISCOUNT_SORT_ORDER_TITLE','Сортування');
define('MODULE_ORDER_TOTAL_OT_COUNTRY_DISCOUNT_SORT_ORDER_DESC','Сортування');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COUNTRIES_1_TITLE','Країни зони 1');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COUNTRIES_1_DESC','Розділений комами список двозначних кодів країн ISO, які є частиною зони 1.');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COST_1_TITLE','Знижка 1 зони');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COST_1_DESC','Знижка 1 зони');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COUNTRIES_2_TITLE', 'Країни 2 зони');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COUNTRIES_2_DESC','Розділений комами список двозначних кодів країн ISO, які є частиною зони 2.');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COST_2_TITLE','Знижка 2 зони');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COST_2_DESC','Знижка 2 зони');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COUNTRIES_3_TITLE', 'Країни 3 зони');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COUNTRIES_3_DESC','Розділений комами список двозначних кодів країн ISO, які є частиною зони 3.');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COST_3_TITLE','Знижка 3 зони');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COST_3_DESC','Знижка 3 зони');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COUNTRIES_4_TITLE', 'Країни 4 зони');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COUNTRIES_4_DESC','Розділений комами список двозначних кодів країн ISO, які є частиною зони 4.');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COST_4_TITLE','Знижка 4 зони');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COST_4_DESC','Знижка 4 зони');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COUNTRIES_5_TITLE', 'Країни 5 зони');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COUNTRIES_5_DESC','Розділений комами список двозначних кодів країн ISO, які є частиною зони 5.');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COST_5_TITLE','Знижка 5 зони');
define('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COST_5_DESC','Знижка 5 зони');

?>