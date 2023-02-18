<?php
/*
  $Id: coupon_admin.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Промо-коди');
define('HEADING_TITLE_STATUS', 'Сортування:');
define('TEXT_CUSTOMER', 'Клієнт:');
define('TEXT_COUPON', 'Назва купона');
define('TEXT_COUPON_ALL', 'Всі купони');
define('TEXT_COUPON_ACTIVE', 'Активні купони');
define('TEXT_COUPON_INACTIVE', 'Неактивні купони');
define('TEXT_SUBJECT', 'Тема:');
define('TEXT_FROM', 'Від:');
define('TEXT_FREE_SHIPPING', 'Безкоштовна доставка');
define('TEXT_MESSAGE', 'Повідомлення:');
define('TEXT_SELECT_CUSTOMER', 'Виберіть клієнта');
define('TEXT_ALL_CUSTOMERS', 'Всі клієнти');
define('TEXT_NEWSLETTER_CUSTOMERS', 'Всім хто підписався на розсилку магазину');
define('TEXT_CONFIRM_DELETE', 'Ви дійсно хочете видалити цей купон?');

define('TEXT_TO_REDEEM', 'Вы можете использовать этот купон в процессе оформления заказа в нашем магазине. В процессе оформления заказа Вам будет предложено ввести код купона, вводите код своего купона и нажимайте кнопку "Применить".');
define('TEXT_IN_CASE', 'в разі виникнення будь-яких проблем.');
define('TEXT_VOUCHER_IS', 'Код купона: ');
define('TEXT_REMEMBER', 'Не забувайте код купона, якщо Ви забули код купона, Ви не зможете ним скористатися в нашому інтернет-магазині.');
define('TEXT_VISIT', 'когда Вы посещаете наш интернет-магазин по адресу ' . HTTP_SERVER . DIR_WS_CATALOG);
define('TEXT_ENTER_CODE', 'і вводите код купона');

define('TABLE_HEADING_ACTION', 'Дія');

define('CUSTOMER_ID', 'Код клієнта');
define('CUSTOMER_NAME', 'Ім\'я');
define('REDEEM_DATE', 'Дата використання купона');
define('IP_ADDRESS', 'IP Адреса');

define('TEXT_REDEMPTIONS', 'Статистика використання купона');
define('TEXT_REDEMPTIONS_TOTAL', 'Всього використано раз');
define('TEXT_REDEMPTIONS_CUSTOMER', 'Даний клієнт використовував раз');
define('TEXT_NO_FREE_SHIPPING', 'Немає безкоштовної доставки');

define('NOTICE_EMAIL_SENT_TO', 'Повідомлення: Email відправлений: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Помилка: Ви не обрали клієнта.');
define('COUPON_NAME', 'Назва купона');
//define('COUPON_VALUE', 'Coupon Value');
define('COUPON_AMOUNT', 'Номінал купона');
define('COUPON_CODE', 'Код купона');
define('COUPON_STARTDATE', 'Купон дійсний з');
define('COUPON_FINISHDATE', 'Купон дійсний до');
define('COUPON_FREE_SHIP', 'Безкоштовна доставка');
define('COUPON_FOR_EVERY_PRODUCT', 'Використовувати для кожного відповідного продукту');
define('COUPON_DESC', 'Опис купона');
define('COUPON_MIN_ORDER', 'Сума мінімального замовлення');
define('COUPON_USES_COUPON', 'Скільки разів можна використовувати купон при оформленні замовлень');
define('COUPON_USES_USER', 'Скільки разів може використовувати цей купон один покупець');
define('COUPON_PRODUCTS', 'Купон дійсний тільки для конкретних товарів');
define('COUPON_CATEGORIES', 'Купон дійсний тільки для конкретних категорій');
define('VOUCHER_NUMBER_USED', 'Купон використаний раз');
define('DATE_CREATED', 'Дата створення');
define('DATE_MODIFIED', 'Останні зміни');
define('TEXT_HEADING_NEW_COUPON', 'Створити новий купон');
define('TEXT_NEW_INTRO', 'Щоб створити новий купон, Ви повинні заповнити наступну форму.<br>');

define('COUPON_BUTTON_PREVIEW', 'Попередній перегляд');
define('COUPON_BUTTON_CONFIRM', 'Підтвердити');
define('COUPON_BUTTON_BACK', 'Повернутися');

define('ERROR_NO_COUPON_AMOUNT', 'Помилка: Не вказаний номінал купона');
define('ERROR_NO_COUPON_NAME', 'Помилка: Не вказано назву купона');
define('ERROR_COUPON_EXISTS', 'Помилка: Купон вже існує');

define('COUPON_VIEW', 'Дивитися');

define('COUPON_NAME_HELP', 'Вкажіть коротку назву купона.');
define('COUPON_AMOUNT_HELP', 'Вы можете указать либо сумму купона(укажите просто сумму цифрами, например чтобы сумма купона был 100$, просто пишите "100"), либо процент скидки(укажите процент, который будет дан покупателю, использовавшему купон при оформлении заказа, например, чтобы дать скидку 10%, так и пишите "10%"), используя данный купон, покупатель получает либо вычет суммы купона из общей суммы заказа, либо получает скидку от общей суммы заказа, в зависимости от того, что Вы укажите в данном поле, либо сумму вычета, либо процент скидки.');
define('COUPON_CODE_HELP', 'Ви можете вказати код купона самостійно, але якщо ви залишите дане поле порожнім (просто не будете заповнювати дане поле), код купона буде створений автоматично.');
define('COUPON_STARTDATE_HELP', 'Дата, починаючи з якої, купон буде активний і його можна буде використовувати при оформленні замовлень.');
define('COUPON_FINISHDATE_HELP', 'Дата, після якої купон вже не можна буде застосувати при оформленні замовлень.');
define('COUPON_FREE_SHIP_HELP', 'Отметьте данное поле, если Вы хотите чтобы покупатель, использующий купон при оформлении заказа, получил бесплатную доставку своего заказа. Внимание. Данная опция не может совместно использоваться с "Номиналом купона", т.е. нельзя сразу дать покупателю вычет суммы(или скидку) по купону и одновременно бесплатную доставку, только что-то одно, либо вычет(или скидка), либо бесплатная доставка. Данная опция учитывает "Сумму минимального заказа", т.е. Вы можете, например, давать покупателю, использующему купон, бесплатную доставку, только если сумма его заказа выше определённой Вами, а можете и не ограничивать сумму минимального заказа и давать бесплатную доставку всем, кто использует купон при оформлении заказа.');
define('COUPON_FOR_EVERY_PRODUCT_HELP', 'Купонна знижка застосовуватиметься до кожного відповідного товару в кошику. Варіант працює лише за наявності обмежень щодо товару чи категорії.');
define('COUPON_DESC_HELP', 'Коротко опишіть створюваний купон.');
define('COUPON_MIN_ORDER_HELP', 'Ви можете обмежити (а можете не обмежувати) дію купона мінімальною сумою замовлення, тобто якщо сума замовлення менше зазначеної в даному полі суми, то купон не може бути застосований для даного замовлення, тільки для замовлень вище зазначеної суми. Пропустіть дане поле, якщо Ви не хочете встановлювати обмежень.');
define('COUPON_USES_COUPON_HELP', 'Максимальна кількість разів, яке може бути використаний купон, не заповнюється на цьому полі, якщо Ви не хочете обмежувати дію купона.');
define('COUPON_USES_USER_HELP', 'Максимальна кількість разів, яку може бути використати купон одним покупцем, не заповнюється на цьому полі, якщо Ви не хочете обмежувати дію купона.');
define('COUPON_PRODUCTS_HELP', 'Ви можете обмежити дію купона тільки на конкретні товари у Вашому інтернет-магазині, перерахувавши коди товарів через кому. Пропустіть дане поле, якщо Ви не хочете встановлювати обмежень.');
define('COUPON_CATEGORIES_HELP', 'Ви можете обмежити дію купона тільки на конкретні категорії у Вашому інтернет-магазині, перерахувавши коди категорій через кому. Пропустіть дане поле, якщо Ви не хочете встановлювати обмежень.');

define('TEXT_TOOLTIP_VOUCHER_EMAIL', 'Надіслати купон на e-mail');
define('TEXT_TOOLTIP_VOUCHER_EDIT', 'Редагувати купон');
define('TEXT_TOOLTIP_VOUCHER_DELETE', 'Видалити купон');
define('TEXT_TOOLTIP_VOUCHER_REPORT', 'Звіт по купону');