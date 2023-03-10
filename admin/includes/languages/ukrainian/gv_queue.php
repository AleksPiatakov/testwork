<?php
/*
  $Id: gv_queue.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Gift Voucher System v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Активація сертифікатів');

define('TABLE_HEADING_CUSTOMERS', 'Покупець');
define('TABLE_HEADING_ORDERS_ID', 'Номер замовлення');
define('TABLE_HEADING_VOUCHER_VALUE', 'Сума сертифіката');
define('TABLE_HEADING_DATE_PURCHASED', 'Дата купівлі');
define('TABLE_HEADING_ACTION', 'Дія');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Вы покупали сертификат в нашем интернет-магазине.' . "\n"
                                          . 'В целях безопасноти сертификат должен быть проверен администратором, прежде чем его можно будет использовать для совершения покупок в нашем интернет-магазине.' . "\n"
                                          . 'Рады сообщить, что Ваш сертификат проверен администратором и активизирован. Теперь Вы можете' . "\n"
                                          . 'с помощью своего сертификата совершать покупки в нашем интернет-магазине, либо можете подарить свой сертификат кому-либо ещё.' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', 'Сертификат на сумму %s' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_BODY', '');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_COUPON_SUBJECT', 'Ваш сертифікат перевірений і активізований!');

//Button
define('BUTTON_CONFIRM_NEW', 'підтвердити');
define('BUTTON_RELEASE_NEW', 'активувати');
define('BUTTON_CANCEL_NEW', 'відмінити');
?>