<?php
/*
  $Id: gv_mail.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Zaslat dárkový poukaz zákazníkům');

define('TEXT_CUSTOMER', 'Zákazník:');
define('TEXT_SUBJECT', 'Předmět:');
define('TEXT_FROM', 'Od:');
define('TEXT_TO', 'E-mail Komu:');
define('TEXT_AMOUNT', 'Částka');
define('TEXT_MESSAGE', 'Zpráva:');
define('TEXT_SINGLE_EMAIL', '<span class="smallText">Používejte pro odesílání jednotlivých e-mailů, jinak použijte rozevírací seznam výše</span>');
define('TEXT_SELECT_CUSTOMER', 'Vyberte zákazníka');
define('TEXT_ALL_CUSTOMERS', 'Všichni zákazníci');
define('TEXT_NEWSLETTER_CUSTOMERS', 'Všem odběratelům newsletteru');

define('NOTICE_EMAIL_SENT_TO', 'Upozornění: Email odeslán na: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Chyba: Nebyl vybrán žádný zákazník.');
define('ERROR_NO_AMOUNT_SELECTED', 'Chyba: Nebyla vybrána žádná částka.');

define('TEXT_GV_WORTH', 'Dárkový poukaz má hodnotu ');
define('TEXT_TO_REDEEM', 'Chcete-li uplatnit tento dárkový poukaz, klikněte na odkaz níže. Zapište si prosím také kód pro uplatnění');
define('TEXT_WHICH_IS', 'což je');
define('TEXT_IN_CASE', '');
define('TEXT_OR_VISIT', 'nebo navštivte náš obchod ');
define('TEXT_ENTER_CODE', ' Dárkový poukaz můžete použít při placení.');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Nedávno jste na našem webu zakoupili dárkový poukaz, z bezpečnostních důvodů vám částka dárkového poukazu nebyla okamžitě připsána. Majitel obchodu nyní tuto částku uvolnil.');
define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . 'Hodnota dárkového poukazu byla %s');
define('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . 'Nyní můžete navštívit naše stránky, přihlásit se a poslat částku dárkového poukazu komukoli chcete.');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");

//Knoflík
define('BUTTON_CANCEL_NEW', 'zrušit');
?>