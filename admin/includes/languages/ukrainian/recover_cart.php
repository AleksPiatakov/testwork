<?php
/*
  $Id$
  Recover Cart Sales v 1.4 ENGLISH Language File

  Recover Cart Sales contrib: JM Ivler (c)
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License

*/

define('MESSAGE_STACK_CUSTOMER_ID', 'Незавершене замовлення покупця (id код ');
define('MESSAGE_STACK_DELETE_SUCCESS', ') успішно вилучено.');
define('HEADING_TITLE', 'Незавершені замовлення');
define('HEADING_EMAIL_SENT', 'Звіт про відправку листів');
define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Повідомлення від Інтернет-магазину '.  STORE_NAME );
define('EMAIL_TEXT_SALUTATION', 'Шановний ' );
define('EMAIL_TEXT_NEWCUST_INTRO', "\n\n" . 'Вы начинали оформлять заказ в Интернет-магазине ' .
                                   STORE_NAME . ', но так и не оформили его до конца.');
define('EMAIL_TEXT_CURCUST_INTRO', "\n\n" . 'Вы начинали оформлять заказ в Интернет-магазине ' .
                                   STORE_NAME . ', но так и не оформили его до конца.  ');
define('EMAIL_TEXT_COMMON_BODY', "\n\n" . 'Нам было бы интересно узнать, почему Вы так и не оформили его до конца? Если у Вас в процессе оформления заказа возникли какие-либо проблемы, мы всегда готовы Вам помочь с оформлением заказа и с удовольствием ответим на возникшие вопросы. Задайте нам их в ответном письме, мы поможем Вам оформить заказ.' .
                                  "\n\n" . 'Товар, который Вы заказывали:' .
                                 "\n\n" . '%s' . "\n");
define('DAYS_FIELD_PREFIX', 'Показати замовлення за останні ');
define('DAYS_FIELD_POSTFIX', ' днів ');
define('DAYS_FIELD_BUTTON', 'Дивитися');
define('TABLE_HEADING_DATE', 'Дата');
define('TABLE_HEADING_CONTACT', 'Повідомлений');
define('TABLE_HEADING_CUSTOMER', 'Ім\'я покупця');
define('TABLE_HEADING_EMAIL', 'E-mail адреса');
define('TABLE_HEADING_PHONE', 'Телефон');
define('TABLE_HEADING_MODEL', 'Код');
define('TABLE_HEADING_DESCRIPTION', 'Товар');
define('TABLE_HEADING_QUANTY', 'Кількість');
define('TABLE_HEADING_PRICE', 'Вартість');
define('TABLE_HEADING_TOTAL', 'Всього');
define('TABLE_GRAND_TOTAL', 'Загальна вартість незавершених замовлень:');
define('TABLE_CART_TOTAL', 'Вартість замовлення:');
define('TEXT_CURRENT_CUSTOMER', 'Покупець');
define('TEXT_SEND_EMAIL', 'Надіслати E-mail');
define('TEXT_RETURN', 'Повернутися назад');
define('TEXT_NOT_CONTACTED', 'Не повідомлений');
define('PSMSG', 'Додаткове повідомлення:');
?>