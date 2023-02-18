<?php
/*
  $Id: coupon_admin.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com
  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Slevové kupony');
define('HEADING_TITLE_STATUS', 'Stav: ');
define('TEXT_CUSTOMER', 'Zákazník:');
define('TEXT_COUPON', 'Název kupónu');
define('TEXT_COUPON_ALL', 'Všechny kupóny');
define('TEXT_COUPON_ACTIVE', 'Aktivní kupóny');
define('TEXT_COUPON_INACTIVE', 'Neaktivní kupony');
define('TEXT_SUBJECT', 'Předmět:');
define('TEXT_FROM', 'Od:');
define('TEXT_FREE_SHIPPING', 'Doprava zdarma');
define('TEXT_MESSAGE', 'Zpráva:');
define('TEXT_SELECT_CUSTOMER', 'Vyberte zákazníka');
define('TEXT_ALL_CUSTOMERS', 'Všichni zákazníci');
define('TEXT_NEWSLETTER_CUSTOMERS', 'Všem odběratelům newsletteru');
define('TEXT_CONFIRM_DELETE', 'Opravdu chcete smazat tento kupón?');

define('TEXT_TO_REDEEM', 'Tento kupón můžete uplatnit při placení. Stačí zadat kód do příslušného pole a kliknout na tlačítko pro uplatnění.');
define('TEXT_IN_CASE', ' v případě, že máte nějaké problémy. ');
define('TEXT_VOUCHER_IS', 'Kód kupónu je ');
define('TEXT_REMEMBER', 'Neztraťte kód kupónu, ujistěte se, že kód uschovejte, abyste mohli využít této speciální nabídky.');
define('TEXT_VISIT', 'když navštívíte ' . HTTP_SERVER . DIR_WS_CATALOG);
define('TEXT_ENTER_CODE', ' a zadejte kód ');

define('TABLE_HEADING_ACTION', 'Akce');

define('CUSTOMER_ID', 'ID zákazníka');
define('CUSTOMER_NAME', 'Jméno zákazníka');
define('REDEEM_DATE', 'Datum uplatnění');
define('IP_ADDRESS', 'IP adresa');

define('TEXT_REDEMPTIONS', 'Uplatnění');
define('TEXT_REDEMPTIONS_TOTAL', 'Celkem');
define('TEXT_REDEMPTIONS_CUSTOMER', 'Pro tohoto zákazníka');
define('TEXT_NO_FREE_SHIPPING', 'Bez dopravy zdarma');

define('NOTICE_EMAIL_SENT_TO', 'Upozornění: Email odeslán na: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Chyba: Nebyl vybrán žádný zákazník.');
define('COUPON_NAME', 'Název kupónu');
//define('COUPON_VALUE', 'Hodnota kuponu');
define('COUPON_AMOUNT', 'Částka kupónu');
define('COUPON_CODE', 'Kód kupónu');
define('COUPON_STARTDATE', 'Datum zahájení');
define('COUPON_FINISHDATE', 'Datum ukončení');
define('COUPON_FREE_SHIP', 'Doprava zdarma');
define('COUPON_DESC', 'Popis kupónu');
define('COUPON_MIN_ORDER', 'Minimální objednávka kuponu');
define('COUPON_USES_COUPON', 'Použití na kupón');
define('COUPON_USES_USER', 'Použití na zákazníka');
define('COUPON_PRODUCTS', 'Platný seznam produktů');
define('COUPON_CATEGORIES', 'Seznam platných kategorií');
define('VOUCHER_NUMBER_USED', 'Použité číslo');
define('DATE_CREATED', 'Datum vytvoření');
define('DATE_MODIFIED', 'Datum změny');
define('TEXT_HEADING_NEW_COUPON', 'Vytvořit nový kupón');
define('TEXT_NEW_INTRO', 'Vyplňte prosím následující informace pro nový kupón.<br>');

define('COUPON_BUTTON_PREVIEW', 'Náhled');
define('COUPON_BUTTON_CONFIRM', 'Potvrdit');
define('COUPON_BUTTON_BACK', 'Zpět');

define('ERROR_NO_COUPON_AMOUNT', 'Chyba: Žádná částka kupónu');
define('ERROR_NO_COUPON_NAME', 'Chyba: Žádný název kupónu');
define('ERROR_COUPON_EXISTS', 'Chyba: Kupón již existuje');

define('COUPON_VIEW', 'View');

define('COUPON_NAME_HELP', 'Krátký název pro kupón');
define('COUPON_AMOUNT_HELP', 'Hodnota slevy pro kupón, buď absolutní nebo v % pro slevu z celkové objednávky.');
define('COUPON_CODE_HELP', 'Sem můžete zadat svůj vlastní kód, nebo nechat prázdné pro automaticky generovaný kód.');
define('COUPON_STARTDATE_HELP', 'Datum, od kterého bude kupón platit');
define('COUPON_FINISHDATE_HELP', 'Datum vypršení platnosti kupónu');
define('COUPON_FREE_SHIP_HELP', 'Kupon poskytuje dopravu zdarma na objednávku. Poznámka: Toto přepíše hodnotu kuponu_amount, ale respektuje minimální hodnotu objednávky');
define('COUPON_DESC_HELP', 'Popis kuponu pro zákazníka');
define('COUPON_MIN_ORDER_HELP', 'Minimální hodnota objednávky před platností kupónu');
define('COUPON_USES_COUPON_HELP', 'Maximální počet, kolikrát lze kupón použít; ponechte prázdné, pokud nechcete žádný limit.');
define('COUPON_USES_USER_HELP', 'Kolikkrát může uživatel použít kupón, ponechte prázdné, aby nebyl limit.');
define('COUPON_PRODUCTS_HELP', 'Čárkami oddělený seznam product_id, se kterými lze tento kupón použít. Nechejte prázdné, aby nebyla žádná omezení.');
define('COUPON_CATEGORIES_HELP', 'Čárkami oddělený seznam cpath, se kterými lze tento kupón použít, ponechte prázdné, aby nebyla omezena.');

define('TEXT_TOOLTIP_VOUCHER_EMAIL', 'E-mailový poukaz');
define('TEXT_TOOLTIP_VOUCHER_EDIT', 'Upravit voucher');
define('TEXT_TOOLTIP_VOUCHER_DELETE', 'Smazat voucher');
define('TEXT_TOOLTIP_VOUCHER_REPORT', 'Zpráva o voucheru');
define('COUPON_FOR_EVERY_PRODUCT', 'Použijte pro každý vhodný produkt');
define('COUPON_FOR_EVERY_PRODUCT_HELP', 'Sleva kuponu bude uplatněna na každou způsobilou položku v košíku. Tato možnost funguje pouze v případě, že existuje omezení na produkt nebo kategorii.');