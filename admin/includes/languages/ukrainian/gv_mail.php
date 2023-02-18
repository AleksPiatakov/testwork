<?php
/*
  $Id: gv_mail.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Надіслати сертифікат');

define('TEXT_CUSTOMER', 'Клієнт:');
define('TEXT_SUBJECT', 'Тема:');
define('TEXT_FROM', 'Від:');
define('TEXT_TO', 'Кому:');
define('TEXT_AMOUNT', 'Сума сертифіката');
define('TEXT_MESSAGE', 'Повідомлення:');
define('TEXT_SINGLE_EMAIL', '<span class="smallText">Используйте данное поле, чтобы отправить сертификат и на другие email адреса, которых нет в списке выше.</span>');
define('TEXT_SELECT_CUSTOMER', 'Виберіть клієнта');
define('TEXT_ALL_CUSTOMERS', 'Всі клієнти');
define('TEXT_NEWSLETTER_CUSTOMERS', 'Всім передплатникам розсилки магазину');

define('NOTICE_EMAIL_SENT_TO', 'Повідомлення: Email відправлений: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Помилка: Ви не обрали клієнта.');
define('ERROR_NO_AMOUNT_SELECTED', 'Помилка: Ви не вказали суму сертифіката..');

define('TEXT_GV_WORTH', 'Сертифікат на суму ');
define('TEXT_TO_REDEEM', 'Щоб активізувати сертифікат, натисніть на посилання нижче і вкажіть код сертифіката -');
define('TEXT_WHICH_IS', '');
define('TEXT_IN_CASE', '');
define('TEXT_OR_VISIT', 'або відвідавши наш інтернет-магазин за адресою ');
define('TEXT_ENTER_CODE', ' Ви можете вказати код сертифіката при оформленні замовлення.');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Вы активизировали свой сертификат, но его можно будет использовать при совершении покупок только после проверки администратором магазина, это сделано исключительно в целях безопасности. Как только сертификат будет проверен администратором. Вы получите уведомление на email.');
define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . 'Сертификат на сумму %s');
define('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . 'Вы можете отправить свой сертификат или часть суммы сертификата своим знакомым и друзьям.');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");

//Button
define('BUTTON_CANCEL_NEW', 'відмінити');
?>