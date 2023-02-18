<?php
/*
  $Id: modules.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE_MODULES_PAYMENT', 'Модули Оплаты');
define('HEADING_TITLE_MODULES_SHIPPING', 'Модули Доставки');
define('HEADING_TITLE_MODULES_ORDER_TOTAL', 'Модули Заказов');
define('TEXT_INSTALL_INTRO', 'Вы действительно хотите установить данный модуль?');
define('TEXT_DELETE_INTRO', 'Вы действительно хотите удалить данный модуль?');


define('TABLE_HEADING_MODULES', 'Модули');
define('TABLE_HEADING_MODULE_DESCRIPTION', 'Описание');
define('TABLE_HEADING_SORT_ORDER', 'Порядок Сортировки');
define('TABLE_HEADING_ACTION', 'Действие');
define('TEXT_MODULE_DIRECTORY', 'Директория Модулей:');
define('TEXT_CLOSE_BUTTON', 'Закрыть');

define('MODULE_PAYMENT_CC_STATUS_TITLE', 'Разрешить модуль оплаты кредитная карточка');
define('MODULE_PAYMENT_CC_STATUS_DESC', 'Хотите ли Вы принимать платежи с помощью кредитных карточек?');
define('MODULE_PAYMENT_CC_EMAIL_TITLE', 'E-Mail Адрес');
define('MODULE_PAYMENT_CC_EMAIL_DESC', 'Если указан e-mail адрес, то на указанный e-mail адрес будут отправляться средние цифры из номера кредитной карточки (в базе данных будет храниться полный номер кредитной карты, за исключением данных средних цифр)');
define('MODULE_PAYMENT_CC_ZONE_TITLE', 'Зона');
define('MODULE_PAYMENT_CC_ZONE_DESC', 'Если выбрана зона, то данный модуль оплаты будет виден только покупателям из выбранной зоны.');
define('MODULE_PAYMENT_CC_ORDER_STATUS_ID_TITLE', 'Статус заказа');
define('MODULE_PAYMENT_CC_ORDER_STATUS_ID_DESC', 'Заказы, оформленные с использованием данного модуля оплаты будут принимать указанный статус.');
define('MODULE_PAYMENT_CC_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_PAYMENT_CC_SORT_ORDER_DESC', 'Порядок сортировки модуля.');

define('MODULE_PAYMENT_COD_STATUS_TITLE', 'Разрешить модуль оплаты Наличными при получении');
define('MODULE_PAYMENT_COD_STATUS_DESC', 'Вы хотите разрешить использование модуля при оформлении заказов?');
define('MODULE_PAYMENT_COD_ZONE_TITLE', 'Зона');
define('MODULE_PAYMENT_COD_ZONE_DESC', 'Если выбрана зона, то данный модуль оплаты будет виден только покупателям из выбранной зоны.');
define('MODULE_PAYMENT_COD_ORDER_STATUS_ID_TITLE', 'Статус заказа');
define('MODULE_PAYMENT_COD_ORDER_STATUS_ID_DESC', 'Заказы, оформленные с использованием данного модуля оплаты будут принимать указанный статус.');
define('MODULE_PAYMENT_COD_SORT_ORDER_TITLE', 'Порядок сортировки.');
define('MODULE_PAYMENT_COD_SORT_ORDER_DESC', 'Порядок сортировки модуля.');

define('MODULE_PAYMENT_FREECHARGER_STATUS_TITLE', 'Разрешить модуль Бесплатная загрузка');
define('MODULE_PAYMENT_FREECHARGER_STATUS_DESC', 'Вы хотите разрешить модуль бесплатная загрузка?');
define('MODULE_PAYMENT_FREECHARGER_ZONE_TITLE', 'Зона');
define('MODULE_PAYMENT_FREECHARGER_ZONE_DESC', 'Если выбрана зона, то данный модуль оплаты будет виден только покупателям из выбранной зоны.');
define('MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID_TITLE', 'Статус заказа');
define('MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID_DESC', 'Заказы, оформленные с использованием данного модуля оплаты будут принимать указанный статус.');
define('MODULE_PAYMENT_FREECHARGER_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_PAYMENT_FREECHARGER_SORT_ORDER_DESC', 'Порядок сортировки модуля.');

define('MODULE_PAYMENT_LIQPAY_STATUS_TITLE', 'Разрешить модуль оплаты LiqPAY');
define('MODULE_PAYMENT_LIQPAY_STATUS_DESC', 'Разрешить модуль оплаты LiqPAY?');
define('MODULE_PAYMENT_LIQPAY_ID_TITLE', 'Мерчант ID');
define('MODULE_PAYMENT_LIQPAY_ID_DESC', 'Укажите Ваш идентификационныый номер (мерчант id).');
define('MODULE_PAYMENT_LIQPAY_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_PAYMENT_LIQPAY_SORT_ORDER_DESC', 'Порядок сортировки модуля.');
define('MODULE_PAYMENT_LIQPAY_ZONE_TITLE', 'Зона оплаты');
define('MODULE_PAYMENT_LIQPAY_ZONE_DESC', 'Если выбрана зона, данный модуль оплаты будет доступен только покупателям из указанной зоны.');
define('MODULE_PAYMENT_LIQPAY_SECRET_KEY_TITLE', 'Мерчант пароль (подпись)');
define('MODULE_PAYMENT_LIQPAY_SECRET_KEY_DESC', 'В данной опции укажите пароль (подпись), указанный в настройках на сайте LiqPAY.');
define('MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID_TITLE', 'Укажите оплаченный статус заказа');
define('MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID_DESC', 'Укажите оплаченный статус заказа');

define('MODULE_PAYMENT_LIQPAY_DEFAULT_ORDER_STATUS_ID_TITLE', 'Укажите статус заказа по умолчанию');
define('MODULE_PAYMENT_LIQPAY_DEFAULT_ORDER_STATUS_ID_DESC', 'Укажите статус заказа по умолчанию');

define('MODULE_PAYMENT_BANK_TRANSFER_STATUS_TITLE', 'Предоплата на счёт');
define('MODULE_PAYMENT_BANK_TRANSFER_STATUS_DESC', 'Вы хотите использовать модуль Предоплата на счёт? 1 - да, 0 - нет');
define('MODULE_PAYMENT_BANK_TRANSFER_1_TITLE', 'Название банка');
define('MODULE_PAYMENT_BANK_TRANSFER_1_DESC', 'Введите название банка');
define('MODULE_PAYMENT_BANK_TRANSFER_2_TITLE', 'Расчетный счет');
define('MODULE_PAYMENT_BANK_TRANSFER_2_DESC', 'Введите Ваш расчетный счет');
define('MODULE_PAYMENT_BANK_TRANSFER_3_TITLE', 'МФО');
define('MODULE_PAYMENT_BANK_TRANSFER_3_DESC', 'Введите МФО Банка');
define('MODULE_PAYMENT_BANK_TRANSFER_4_TITLE', 'Кор./счет');
define('MODULE_PAYMENT_BANK_TRANSFER_4_DESC', 'Введите Кор./счет банка');
define('MODULE_PAYMENT_BANK_TRANSFER_5_TITLE', 'ИНН');
define('MODULE_PAYMENT_BANK_TRANSFER_5_DESC', 'Введите ИНН банка');
define('MODULE_PAYMENT_BANK_TRANSFER_6_TITLE', 'Получатель');
define('MODULE_PAYMENT_BANK_TRANSFER_6_DESC', 'Получатель платежа');
define('MODULE_PAYMENT_BANK_TRANSFER_7_TITLE', 'КПП');
define('MODULE_PAYMENT_BANK_TRANSFER_7_DESC', 'Введите КПП');
define('MODULE_PAYMENT_BANK_TRANSFER_8_TITLE', 'Назначение платежа');
define('MODULE_PAYMENT_BANK_TRANSFER_8_DESC', 'Укажите назначение платежа');
define('MODULE_PAYMENT_BANK_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_PAYMENT_BANK_SORT_ORDER_DESC', 'Порядок сортировки модуля');

define('MODULE_PAYMENT_WEBMONEY_STATUS_TITLE', 'Оплата через систему WebMoney');
define('MODULE_PAYMENT_WEBMONEY_STATUS_DESC', 'Вы хотите использовать модуль Оплата через систему WebMoney? 1 - да, 0 - нет');
define('MODULE_PAYMENT_WEBMONEY_1_TITLE', 'Ваш WM Идентификатор');
define('MODULE_PAYMENT_WEBMONEY_1_DESC', 'Введите Ваш WM идентификатор');
define('MODULE_PAYMENT_WEBMONEY_2_TITLE', 'Номер Вашего R кошелька');
define('MODULE_PAYMENT_WEBMONEY_2_DESC', 'Введите номер Вашего R кошелька');
define('MODULE_PAYMENT_WEBMONEY_3_TITLE', 'Номер Вашего Z кошелька');
define('MODULE_PAYMENT_WEBMONEY_3_DESC', 'Введите номер Вашего Z кошелька');
define('MODULE_PAYMENT_WEBMONEY_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_PAYMENT_WEBMONEY_SORT_ORDER_DESC', 'Порядок сортировки модуля');

// -----------------------SHIPPING!!!!!---------------------------//

define('MODULE_SHIPPING_EXPRESS_STATUS_TITLE', 'Разрешить модуль курьерская доставка');
define('MODULE_SHIPPING_EXPRESS_STATUS_DESC', 'Вы хотите разрешить модуль курьерская доставка?');
define('MODULE_SHIPPING_EXPRESS_COST_TITLE', 'Стоимость');
define('MODULE_SHIPPING_EXPRESS_COST_DESC', 'Стоимость использования данного способа доставки.');
define('MODULE_SHIPPING_EXPRESS_TAX_CLASS_TITLE', 'Налог');
define('MODULE_SHIPPING_EXPRESS_TAX_CLASS_DESC', 'Использовать налог.');
define('MODULE_SHIPPING_EXPRESS_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_EXPRESS_ZONE_DESC', 'Если выбрана зона, то данный модуль доставки будет виден только покупателям из выбранной зоны.');
define('MODULE_SHIPPING_EXPRESS_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_SHIPPING_EXPRESS_SORT_ORDER_DESC', 'Порядок сортировки модуля.');

define('MODULE_SHIPPING_FLAT_STATUS_TITLE', 'Разрешить модуль курьерская доставка');
define('MODULE_SHIPPING_FLAT_STATUS_DESC', 'Вы хотите разрешить модуль курьерская доставка?');
define('MODULE_SHIPPING_FLAT_COST_TITLE', 'Стоимость');
define('MODULE_SHIPPING_FLAT_COST_DESC', 'Стоимость использования данного способа доставки.');
define('MODULE_SHIPPING_FLAT_TAX_CLASS_TITLE', 'Налог');
define('MODULE_SHIPPING_FLAT_TAX_CLASS_DESC', 'Использовать налог.');
define('MODULE_SHIPPING_FLAT_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_FLAT_ZONE_DESC', 'Если выбрана зона, то данный модуль доставки будет виден только покупателям из выбранной зоны.');
define('MODULE_SHIPPING_FLAT_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_SHIPPING_FLAT_SORT_ORDER_DESC', 'Порядок сортировки модуля.');

define('MODULE_SHIPPING_FREESHIPPER_STATUS_TITLE', 'Разрешить бесплатную доставку');
define('MODULE_SHIPPING_FREESHIPPER_STATUS_DESC', 'Вы хотите разрешить модуль бесплатная доставка?');
define('MODULE_SHIPPING_FREESHIPPER_COST_TITLE', 'Стоимость');
define('MODULE_SHIPPING_FREESHIPPER_COST_DESC', 'Стоимость использования данного способа доставки.');
define('MODULE_SHIPPING_FREESHIPPER_TAX_CLASS_TITLE', 'Налог');
define('MODULE_SHIPPING_FREESHIPPER_TAX_CLASS_DESC', 'Использовать налог.');
define('MODULE_SHIPPING_FREESHIPPER_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_FREESHIPPER_ZONE_DESC', 'Если выбрана зона, то данный модуль доставки будет виден только покупателям из выбранной зоны.');
define('MODULE_SHIPPING_FREESHIPPER_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_SHIPPING_FREESHIPPER_SORT_ORDER_DESC', 'Порядок сортировки модуля.');

define('MODULE_SHIPPING_ITEM_STATUS_TITLE', 'Разрешить модуль на единицу');
define('MODULE_SHIPPING_ITEM_STATUS_DESC', 'Вы хотите разрешить модуль на единицу?');
define('MODULE_SHIPPING_ITEM_COST_TITLE', 'Стоимость доставки');
define('MODULE_SHIPPING_ITEM_COST_DESC', 'Стоимость доставки будет умножена на количество единиц товара в заказе.');
define('MODULE_SHIPPING_ITEM_HANDLING_TITLE', 'Стоимость');
define('MODULE_SHIPPING_ITEM_HANDLING_DESC', 'Стоимость использования данного способа доставки.');
define('MODULE_SHIPPING_ITEM_TAX_CLASS_TITLE', 'Налог');
define('MODULE_SHIPPING_ITEM_TAX_CLASS_DESC', 'Использовать налог.');
define('MODULE_SHIPPING_ITEM_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_ITEM_ZONE_DESC', 'Если выбрана зона, то данный модуль доставки будет виден только покупателям из выбранной зоны.');
define('MODULE_SHIPPING_ITEM_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_SHIPPING_ITEM_SORT_ORDER_DESC', 'Порядок сортировки модуля.');

define('MODULE_SHIPPING_NWPOCHTA_STATUS_TITLE', 'Разрешить модуль Новая Почта');
define('MODULE_SHIPPING_NWPOCHTA_STATUS_DESC', 'Вы хотите разрешить модуль Новая Почта?');
define('MODULE_SHIPPING_NWPOCHTA_COST_TITLE', 'Стоимость');
define('MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME_TITLE', 'Спец. Название');
define('MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME_DESC', 'Оставьте поле пустым если хотите использовать название по умолчанию');
define('MODULE_SHIPPING_NWPOCHTA_COST_DESC', 'Стоимость использования данного способа доставки.');
define('MODULE_SHIPPING_NWPOCHTA_TAX_CLASS_TITLE', 'Налог');
define('MODULE_SHIPPING_NWPOCHTA_TAX_CLASS_DESC', 'Использовать налог.');
define('MODULE_SHIPPING_NWPOCHTA_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_NWPOCHTA_ZONE_DESC', 'Если выбрана зона, то данный модуль доставки будет виден только покупателям из выбранной зоны.');
define('MODULE_SHIPPING_NWPOCHTA_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_SHIPPING_NWPOCHTA_SORT_ORDER_DESC', 'Порядок сортировки модуля.');   

define('MODULE_SHIPPING_CUSTOMSHIPPER_STATUS_TITLE', 'Разрешить модуль курьерская доставка');   
define('MODULE_SHIPPING_CUSTOMSHIPPER_NAME_TITLE', 'Название перевозчика');
define('MODULE_SHIPPING_CUSTOMSHIPPER_WAY_TITLE', 'Описание перевозчика');
define('MODULE_SHIPPING_CUSTOMSHIPPER_COST_TITLE', 'Стоимость');
define('MODULE_SHIPPING_CUSTOMSHIPPER_TAX_CLASS_TITLE', 'Налог');
define('MODULE_SHIPPING_CUSTOMSHIPPER_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_CUSTOMSHIPPER_ZONE_DESC', 'Если выбрана зона, то данный модуль доставки будет виден только покупателям из выбранной зоны.');
define('MODULE_SHIPPING_CUSTOMSHIPPER_SORT_ORDER_TITLE', 'Порядок сортировки');

define('MODULE_SHIPPING_PERCENT_STATUS_TITLE', 'Разрешить модуль процентная доставка');
define('MODULE_SHIPPING_PERCENT_STATUS_DESC', 'Вы хотите разрешить модуль процентная доставка?');
define('MODULE_SHIPPING_PERCENT_RATE_TITLE', 'Процент');
define('MODULE_SHIPPING_PERCENT_RATE_DESC', 'Стоимость доставки данным модулем в процентах от общей стоимости заказа, значения от .01 до .99');
define('MODULE_SHIPPING_PERCENT_LESS_THEN_TITLE', 'Плоская стоимость для заказов до');
define('MODULE_SHIPPING_PERCENT_LESS_THEN_DESC', 'Плоская стоимость доставки для заказов, стоимостью до указанной величины.');
define('MODULE_SHIPPING_PERCENT_FLAT_USE_TITLE', 'Плоская процентная стоимость');
define('MODULE_SHIPPING_PERCENT_FLAT_USE_DESC', 'Плоская стоимость доставки в процентах от общей стоимости заказа, действительно для всех заказов.');
define('MODULE_SHIPPING_PERCENT_TAX_CLASS_TITLE', 'Налог');
define('MODULE_SHIPPING_PERCENT_TAX_CLASS_DESC', 'Использовать налог.');
define('MODULE_SHIPPING_PERCENT_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_PERCENT_ZONE_DESC', 'Если выбрана зона, то данный модуль доставки будет виден только покупателям из выбранной зоны.');
define('MODULE_SHIPPING_PERCENT_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_SHIPPING_PERCENT_SORT_ORDER_DESC', 'Порядок сортировки модуля.');

define('MODULE_SHIPPING_SAT_STATUS_TITLE', 'Разрешить модуль курьерская доставка');
define('MODULE_SHIPPING_SAT_STATUS_DESC', 'Вы хотите разрешить модуль курьерская доставка?');
define('MODULE_SHIPPING_SAT_COST_TITLE', 'Стоимость');
define('MODULE_SHIPPING_SAT_COST_DESC', 'Стоимость использования данного способа доставки.');
define('MODULE_SHIPPING_SAT_TAX_CLASS_TITLE', 'Налог');
define('MODULE_SHIPPING_SAT_TAX_CLASS_DESC', 'Использовать налог.');
define('MODULE_SHIPPING_SAT_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_SAT_ZONE_DESC', 'Если выбрана зона, то данный модуль доставки будет виден только покупателям из выбранной зоны.');
define('MODULE_SHIPPING_SAT_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_SHIPPING_SAT_SORT_ORDER_DESC', 'Порядок сортировки модуля.');

define('MODULE_SHIPPING_TABLE_STATUS_TITLE', 'Разрешить модуль "Без доставки"');
define('MODULE_SHIPPING_TABLE_STATUS_DESC', 'Вы хотите разрешить модуль доставки "Без доставки"?');
define('MODULE_SHIPPING_TABLE_COST_TITLE', 'Стоимость доставки');
define('MODULE_SHIPPING_TABLE_COST_DESC', 'Стоимость доставки рассчитывается на основе общего веса заказа или общей стоимости заказа. Например: 25:8.50,50:5.50,и т.д... Это значит, что до 25 доставка будет стоить 8.50, от 25 до 50 будет стоить 5.50 и т.д.');
define('MODULE_SHIPPING_TABLE_MODE_TITLE', 'Метод расчёта');
define('MODULE_SHIPPING_TABLE_MODE_DESC', 'Стоимость расчёта доставки исходя из общего веса заказа (weight) или исходя из общей стоимости заказа (price).');
define('MODULE_SHIPPING_TABLE_HANDLING_TITLE', 'Стоимость');
define('MODULE_SHIPPING_TABLE_HANDLING_DESC', 'Стоимость использования данного способа доставки.');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_TITLE', 'Налог');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_DESC', 'Использовать налог.');
define('MODULE_SHIPPING_TABLE_ZONE_TITLE', 'Зона');
define('MODULE_SHIPPING_TABLE_ZONE_DESC', 'Если выбрана зона, то данный модуль доставки будет виден только покупателям из выбранной зоны.');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_DESC', 'Порядок сортировки модуля.');

define('MODULE_SHIPPING_ZONES_STATUS_TITLE', 'Разрешить модуль тарифы для зоны');
define('MODULE_SHIPPING_ZONES_STATUS_DESC', 'Вы хотите разрешить модуль тарифы для зоны?');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_TITLE', 'Налог');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_DESC', 'Использовать налог.');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_DESC', 'Порядок сортировки модуля.');
define('MODULE_SHIPPING_ZONES_COUNTRIES_1_TITLE', 'Страны 1 зоны');
define('MODULE_SHIPPING_ZONES_COUNTRIES_1_DESC', 'Список стран через запятую для зоны 1.');
define('MODULE_SHIPPING_ZONES_COST_1_TITLE', 'Стоимость доставки для 1 зоны');
define('MODULE_SHIPPING_ZONES_COST_1_DESC', 'Стоимость доставки через запятую для зоны 1 на базе максимальной стоимость заказа. Например: 3:8.50,7:10.50,... Это значит, что стоимость доставки для заказов, весом до 3 кг. будет стоить 8.50 для покупателей из стран 1 зоны.');
define('MODULE_SHIPPING_ZONES_HANDLING_1_TITLE', 'Стоимость для 1 зоны');
define('MODULE_SHIPPING_ZONES_HANDLING_1_DESC', 'Стоимость использования данного способа доставки.');

// -----------------------ORDER TOTAL!!!!!---------------------------//

define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS_TITLE', 'Разрешить модуль Сопутствующая скидка');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS_DESC', 'Вы хотите разрешить модуль Сопутствующая скидка?');
define('MODULE_ORDER_TOTAL_OT_BETTER_TOGETHER_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_ORDER_TOTAL_OT_BETTER_TOGETHER_SORT_ORDER_DESC', 'Порядок сортировки модуля');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX_TITLE', 'Include Tax');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX_DESC', 'Использовать налог');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX_TITLE', 'Re-calculate Tax');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX_DESC', 'Пересчитывать налог');

define('MODULE_ORDER_TOTAL_COUPON_STATUS_TITLE', 'Показывать всего');
define('MODULE_ORDER_TOTAL_COUPON_STATUS_DESC', 'Вы хотите показывать номинал купона?');
define('MODULE_ORDER_TOTAL_OT_COUPON_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_ORDER_TOTAL_OT_COUPON_SORT_ORDER_DESC', 'Порядок сортировки модуля.');
define('MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING_TITLE', 'Учитывать доставку');
define('MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING_DESC', 'Включать в расчёт доставку.');
define('MODULE_ORDER_TOTAL_COUPON_INC_TAX_TITLE', 'Учитывать налог');
define('MODULE_ORDER_TOTAL_COUPON_INC_TAX_DESC', 'Включать в расчёт налог.');
define('MODULE_ORDER_TOTAL_COUPON_CALC_TAX_TITLE', 'Пересчитывать налог');
define('MODULE_ORDER_TOTAL_COUPON_CALC_TAX_DESC', 'Пересчитывать налог.');
define('MODULE_ORDER_TOTAL_COUPON_TAX_CLASS_TITLE', 'Налог');
define('MODULE_ORDER_TOTAL_COUPON_TAX_CLASS_DESC', 'Использовать налог для купонов.');

define('MODULE_ORDER_TOTAL_GV_STATUS_TITLE', 'Показывать всего');
define('MODULE_ORDER_TOTAL_GV_STATUS_DESC', 'Вы хотите показывать номинал подарочного сертификата?');
define('MODULE_ORDER_TOTAL_OT_GV_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_ORDER_TOTAL_OT_GV_SORT_ORDER_DESC', 'Порядок сортировки модуля.');
define('MODULE_ORDER_TOTAL_GV_QUEUE_TITLE', 'Активация сертификатов');
define('MODULE_ORDER_TOTAL_GV_QUEUE_DESC', 'Вы хотите вручную активировать купленные подарочные сертификаты?');
define('MODULE_ORDER_TOTAL_GV_INC_SHIPPING_TITLE', 'Учитывать доставку');
define('MODULE_ORDER_TOTAL_GV_INC_SHIPPING_DESC', 'Включать в расчёт доставку.');
define('MODULE_ORDER_TOTAL_GV_INC_TAX_TITLE', 'Учитывать налог');
define('MODULE_ORDER_TOTAL_GV_INC_TAX_DESC', 'Включать в расчёт налог.');
define('MODULE_ORDER_TOTAL_GV_CALC_TAX_TITLE', 'Пересчитывать налог');
define('MODULE_ORDER_TOTAL_GV_CALC_TAX_DESC', 'Пересчитывать налог.');
define('MODULE_ORDER_TOTAL_GV_TAX_CLASS_TITLE', 'Налог');
define('MODULE_ORDER_TOTAL_GV_TAX_CLASS_DESC', 'Использовать налог.');
define('MODULE_ORDER_TOTAL_GV_CREDIT_TAX_TITLE', 'Налог сертификата');
define('MODULE_ORDER_TOTAL_GV_CREDIT_TAX_DESC', 'Добавлять налог к купленным подарочным сертификатам.');
define('MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID_TITLE', 'Статус заказа');
define('MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID_DESC', 'Заказы, оформленные с использованием подарочного сертификата, покрывающего полную стоимость заказа, будут иметь указанный статус.');

define('MODULE_LEV_DISCOUNT_STATUS_TITLE', 'Показывать скидку');
define('MODULE_LEV_DISCOUNT_STATUS_DESC', 'Разрешить скидки?');
define('MODULE_ORDER_TOTAL_OT_LEV_DISCOUNT_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_ORDER_TOTAL_OT_LEV_DISCOUNT_SORT_ORDER_DESC', 'Порядок сортировки модуля.');
define('MODULE_LEV_DISCOUNT_TABLE_TITLE', 'Процент скидки');
define('MODULE_LEV_DISCOUNT_TABLE_DESC', 'Установите ценовые пределы и проценты скидки, через запятую.');
define('MODULE_LEV_DISCOUNT_INC_SHIPPING_TITLE', 'Учитывать доставку');
define('MODULE_LEV_DISCOUNT_INC_SHIPPING_DESC', 'Включать в расчёт доставку.');
define('MODULE_LEV_DISCOUNT_INC_TAX_TITLE', 'Учитывать налог');
define('MODULE_LEV_DISCOUNT_INC_TAX_DESC', 'Включать в расчёт налог.');
define('MODULE_LEV_DISCOUNT_CALC_TAX_TITLE', 'Пересчитывать налог');
define('MODULE_LEV_DISCOUNT_CALC_TAX_DESC', 'Пересчитывать налог.');

define('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS_TITLE', 'Показывать низкую стоимость заказа');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS_DESC', 'Вы хотите показывать низкую стоимость заказа?');
define('MODULE_ORDER_TOTAL_OT_LOWORDERFEE_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_ORDER_TOTAL_OT_LOWORDERFEE_SORT_ORDER_DESC', 'Порядок сортировки модуля.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE_TITLE', 'Разрешить низкую стоимость заказа');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE_DESC', 'Вы хотите разрешить модуль низкой стоимость заказа?');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER_TITLE', 'Низкая стоимость для заказов до');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER_DESC', 'Низкая стоимость заказов для заказов до указанной величины.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE_TITLE', 'Плата');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE_DESC', 'Плата');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION_TITLE', 'Прибавлять плату к заказу');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION_DESC', 'Прибавлять плату к следующим заказам.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS_TITLE', 'Налог');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS_DESC', 'Использовать налог.');

define('MODULE_PAYMENT_DISC_STATUS_TITLE', 'Разрешить модуль');
define('MODULE_PAYMENT_DISC_STATUS_DESC', 'Активировать модуль?');
define('MODULE_ORDER_TOTAL_OT_PAYMENT_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_ORDER_TOTAL_OT_PAYMENT_SORT_ORDER_DESC', 'Порядок сортировки модуля обязательно должен быть ниже чем модуль Всего.');
define('MODULE_PAYMENT_DISC_PERCENTAGE_TITLE', 'Скидка');
define('MODULE_PAYMENT_DISC_PERCENTAGE_DESC', 'Минимальная сумма заказа для получения скидки.');
define('MODULE_PAYMENT_DISC_MINIMUM_TITLE', 'Минимальная сумма заказа');
define('MODULE_PAYMENT_DISC_MINIMUM_DESC', 'Минимальная сумма заказа для получения скидки.');
define('MODULE_PAYMENT_DISC_TYPE_TITLE', 'Способ оплаты');
define('MODULE_PAYMENT_DISC_TYPE_DESC', 'Здесь нужно указать название класса модуля оплаты, класс можо узнать в файле модуля, например /includes/modules/payment/webmoney.php. Сверху видно class webmoney, значит если мы хотим дать скидку при оплате через WebMoney, пишем webmoney.');
define('MODULE_PAYMENT_DISC_INC_SHIPPING_TITLE', 'Учитывать доставку');
define('MODULE_PAYMENT_DISC_INC_SHIPPING_DESC', 'Включать доставку в расчёты');
define('MODULE_PAYMENT_DISC_INC_TAX_TITLE', 'Учитывать налог');
define('MODULE_PAYMENT_DISC_INC_TAX_DESC', 'Включать налог в расчёты.');
define('MODULE_PAYMENT_DISC_CALC_TAX_TITLE', 'Считать налог');
define('MODULE_PAYMENT_DISC_CALC_TAX_DESC', 'Учитывать налог при подсчёте скидки.');

define('MODULE_QTY_DISCOUNT_STATUS_TITLE', 'Показывать скидку от количества');
define('MODULE_QTY_DISCOUNT_STATUS_DESC', 'Вы хотите разрешить скидки от количества?');
define('MODULE_ORDER_TOTAL_OT_QTY_DISCOUNT_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_ORDER_TOTAL_OT_QTY_DISCOUNT_SORT_ORDER_DESC', 'Порядок сортировки модуля.');
define('MODULE_QTY_DISCOUNT_RATE_TYPE_TITLE', 'Тип скидки');
define('MODULE_QTY_DISCOUNT_RATE_TYPE_DESC', 'Выберите тип скидки - процентная (percentage) или плоская (flat rate)');
define('MODULE_QTY_DISCOUNT_RATES_TITLE', 'Скидка');
define('MODULE_QTY_DISCOUNT_RATES_DESC', 'Скидка считается исходя из общего количества заказанных единиц товара. Например: 10:5,20:10... и т.д. Это значит, что заказав 10 или более единиц товара, покупатель получает скидку 5% или $5; 20 или более единиц - скидка 10% или $10; в зависимости от типа');
define('MODULE_QTY_DISCOUNT_INC_SHIPPING_TITLE', 'Учитывать доставку');
define('MODULE_QTY_DISCOUNT_INC_SHIPPING_DESC', 'Включать в расчёт доставку.');
define('MODULE_QTY_DISCOUNT_INC_TAX_TITLE', 'Учитывать налог');
define('MODULE_QTY_DISCOUNT_INC_TAX_DESC', 'Включать в расчёт налог.');
define('MODULE_QTY_DISCOUNT_CALC_TAX_TITLE', 'Пересчитывать налог');
define('MODULE_QTY_DISCOUNT_CALC_TAX_DESC', 'Пересчитывать налог.');

define('MODULE_ORDER_TOTAL_SHIPPING_STATUS_TITLE', 'Показывать доставку');
define('MODULE_ORDER_TOTAL_SHIPPING_STATUS_DESC', 'Вы хотите показывать стоимость доставки?');
define('MODULE_ORDER_TOTAL_OT_SHIPPING_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_ORDER_TOTAL_OT_SHIPPING_SORT_ORDER_DESC', 'Порядок сортировки модуля.');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_TITLE', 'Разрешить бесплатную доставку');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_DESC', 'Вы хотите разрешить беслатную доставку?');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_TITLE', 'Бесплатная доставка для заказов свыше');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_DESC', 'Для заказов, свыше указанной величины, доставка будет бесплатной..');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_TITLE', 'Бесплатная доставка для заказов');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_DESC', 'Укажите, для каких именно заказов будет действительна бесплатная доставка.');

define('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS_TITLE', 'Показывать стоимость товара');
define('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS_DESC', 'Вы хотите показывать стоимость товара?');
define('MODULE_ORDER_TOTAL_OT_SUBTOTAL_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_ORDER_TOTAL_OT_SUBTOTAL_SORT_ORDER_DESC', 'Порядок сортировки модуля.');

define('MODULE_ORDER_TOTAL_TAX_STATUS_TITLE', 'Показывать налог');
define('MODULE_ORDER_TOTAL_TAX_STATUS_DESC', 'Вы хотите показывать налог?');
define('MODULE_ORDER_TOTAL_OT_TAX_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_ORDER_TOTAL_OT_TAX_SORT_ORDER_DESC', 'Порядок сортировки модуля.');

define('MODULE_ORDER_TOTAL_TOTAL_STATUS_TITLE', 'Показывать всего');
define('MODULE_ORDER_TOTAL_TOTAL_STATUS_DESC', 'Вы хотите показывать общую стоимость заказа?');
define('MODULE_ORDER_TOTAL_OT_TOTAL_SORT_ORDER_TITLE', 'Порядок сортировки');
define('MODULE_ORDER_TOTAL_OT_TOTAL_SORT_ORDER_DESC', 'Порядок сортировки модуля.');

?>
