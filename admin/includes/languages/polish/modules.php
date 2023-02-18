<?php
/*
  $Id: modules.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE_MODULES_PAYMENT', 'Moduły płatności');
define('HEADING_TITLE_MODULES_SHIPPING', 'Moduły dostawy');
define('HEADING_TITLE_MODULES_ORDER_TOTAL', 'Moduły zamówień');
define('TEXT_INSTALL_INTRO', 'Czy na pewno chcesz zainstalować ten moduł?');
define('TEXT_DELETE_INTRO', 'Czy na pewno chcesz usunąć ten moduł??');


define('TABLE_HEADING_MODULES', 'Moduły');
define('TABLE_HEADING_MODULE_DESCRIPTION', 'Opis');
define('TABLE_HEADING_SORT_ORDER', 'Kolejność sortowania');
define('TABLE_HEADING_ACTION', 'Działanie');
define('TEXT_MODULE_DIRECTORY', 'Katalog modułów:');
define('TEXT_CLOSE_BUTTON', 'Zamknij');

define('MODULE_PAYMENT_CC_STATUS_TITLE', 'Zezwalaj na moduł płatności Karta kredytowa');
define('MODULE_PAYMENT_CC_STATUS_DESC', 'Czy chcesz akceptować płatności kartami kredytowymi?');
define('MODULE_PAYMENT_CC_EMAIL_TITLE', 'Adres E-Mail');
define('MODULE_PAYMENT_CC_EMAIL_DESC', 'Jeśli podany jest adres e-mail, to średnia cyfra z numeru karty kredytowej zostanie wysłana na podany adres e-mail (w bazie danych zostanie zapisany pełny numer karty kredytowej, z wyjątkiem średnich cyfr)');
define('MODULE_PAYMENT_CC_ZONE_TITLE', 'Strefa');
define('MODULE_PAYMENT_CC_ZONE_DESC', 'Jeśli strefa jest wybrana, to ten moduł płatności będzie widoczny tylko dla kupujących z wybranej strefy.');
define('MODULE_PAYMENT_CC_ORDER_STATUS_ID_TITLE', 'Status zamówienia');
define('MODULE_PAYMENT_CC_ORDER_STATUS_ID_DESC', 'Zamówienia przetworzone przy użyciu tego modułu płatności otrzymają określony status.');
define('MODULE_PAYMENT_CC_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_PAYMENT_CC_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');

define('MODULE_PAYMENT_COD_STATUS_TITLE', 'Zezwalaj na moduł płatności Płatność przy odbiorze');
define('MODULE_PAYMENT_COD_STATUS_DESC', 'Czy chcesz zezwolić na korzystanie z modułu podczas składania zamówień?');
define('MODULE_PAYMENT_COD_ZONE_TITLE', 'Strefa');
define('MODULE_PAYMENT_COD_ZONE_DESC', 'Jeśli strefa jest wybrana, to ten moduł płatności będzie widoczny tylko dla kupujących z wybranej strefy.');
define('MODULE_PAYMENT_COD_ORDER_STATUS_ID_TITLE', 'Status zamówienia');
define('MODULE_PAYMENT_COD_ORDER_STATUS_ID_DESC', 'Zamówienia przetworzone przy użyciu tego modułu płatności otrzymają określony status.');
define('MODULE_PAYMENT_COD_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_PAYMENT_COD_SORT_ORDER_DESC', 'Kolejność sortowania modułu');

define('MODULE_PAYMENT_FREECHARGER_STATUS_TITLE', 'Zezwalaj na moduł Darmowe pobieranie');
define('MODULE_PAYMENT_FREECHARGER_STATUS_DESC', 'Czy chcesz zezwolić na moduł `Bezpłatne pobranie?');
define('MODULE_PAYMENT_FREECHARGER_ZONE_TITLE', 'Strefa');
define('MODULE_PAYMENT_FREECHARGER_ZONE_DESC', 'Jeśli strefa jest wybrana, to ten moduł płatności będzie widoczny tylko dla kupujących z wybranej strefy.');
define('MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID_TITLE', 'Status zamówienia');
define('MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID_DESC', 'Zamówienia przetworzone przy użyciu tego modułu płatności otrzymają określony status.');
define('MODULE_PAYMENT_FREECHARGER_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_PAYMENT_FREECHARGER_SORT_ORDER_DESC', 'Kolejność sortowania modułu');

define('MODULE_PAYMENT_LIQPAY_STATUS_TITLE', 'Zezwalaj na moduł płatności LiqPAY');
define('MODULE_PAYMENT_LIQPAY_STATUS_DESC', 'Zezwalaj na moduł płatności LiqPAY?');
define('MODULE_PAYMENT_LIQPAY_ID_TITLE', 'ID Sprzedawcy');
define('MODULE_PAYMENT_LIQPAY_ID_DESC', 'Podaj swój numer identyfikacyjny (sprzedawca id).');
define('MODULE_PAYMENT_LIQPAY_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_PAYMENT_LIQPAY_SORT_ORDER_DESC', 'Kolejność sortowania modułów.');
define('MODULE_PAYMENT_LIQPAY_ZONE_TITLE', 'Strefa opłaty');
define('MODULE_PAYMENT_LIQPAY_ZONE_DESC', 'Jeśli strefa jest wybrana, to ten moduł płatności będzie widoczny tylko dla kupujących z wybranej strefy.');
define('MODULE_PAYMENT_LIQPAY_SECRET_KEY_TITLE', 'Hasło sprzedawcy (podpis)');
define('MODULE_PAYMENT_LIQPAY_SECRET_KEY_DESC', 'W tej opcji określ hasło (podpis) określone w ustawieniach w serwisie LiqPAY.');
define('MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID_TITLE', 'Wprowadź opłacony status zamówienia');
define('MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID_DESC', 'Wprowadź opłacony status zamówienia');

define('MODULE_PAYMENT_LIQPAY_DEFAULT_ORDER_STATUS_ID_TITLE', 'Ustaw domyślny status zamówienia');
define('MODULE_PAYMENT_LIQPAY_DEFAULT_ORDER_STATUS_ID_DESC', 'Ustaw domyślny status zamówienia');

define('MODULE_PAYMENT_BANK_TRANSFER_STATUS_TITLE', 'Przedpłata na rachunek');
define('MODULE_PAYMENT_BANK_TRANSFER_STATUS_DESC', 'Czy chcesz korzystać z modułu Przedpłata na koncie? 1 - tak, 0 - nie');
define('MODULE_PAYMENT_BANK_TRANSFER_1_TITLE', 'Nazwa banku');
define('MODULE_PAYMENT_BANK_TRANSFER_1_DESC', 'Wprowadź nazwę banku');
define('MODULE_PAYMENT_BANK_TRANSFER_2_TITLE', 'Rachunek bieżący');
define('MODULE_PAYMENT_BANK_TRANSFER_2_DESC', 'Wprowadź swój rachunek bieżący');
define('MODULE_PAYMENT_BANK_TRANSFER_3_TITLE', 'Kod identyfikacyjny banku');
define('MODULE_PAYMENT_BANK_TRANSFER_3_DESC', 'Wprowadź kod identyfikacyjny banku');
define('MODULE_PAYMENT_BANK_TRANSFER_4_TITLE', 'Konto korespondencyjne');
define('MODULE_PAYMENT_BANK_TRANSFER_4_DESC', 'Wprowadź konto korespondencyjne banku');
define('MODULE_PAYMENT_BANK_TRANSFER_5_TITLE', 'NIP');
define('MODULE_PAYMENT_BANK_TRANSFER_5_DESC', 'Wprowadź NIP');
define('MODULE_PAYMENT_BANK_TRANSFER_6_TITLE', 'Odbiorca');
define('MODULE_PAYMENT_BANK_TRANSFER_6_DESC', 'Odbiorca płatności');
define('MODULE_PAYMENT_BANK_TRANSFER_7_TITLE', 'Kod przyczyny oświadczenia');
define('MODULE_PAYMENT_BANK_TRANSFER_7_DESC', 'Wprowadź kod przyczyny oświadczenia ');
define('MODULE_PAYMENT_BANK_TRANSFER_8_TITLE', 'Cel płatności');
define('MODULE_PAYMENT_BANK_TRANSFER_8_DESC', 'Wprowadź cel płatności');
define('MODULE_PAYMENT_BANK_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_PAYMENT_BANK_SORT_ORDER_DESC', 'Kolejność sortowania modułu');

define('MODULE_PAYMENT_BANK_CART_TRANSFER_STATUS_TITLE', 'Przedpłata na kartę');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_STATUS_DESC', 'Czy chcesz korzystać z modułu Abonament na Kartę? 1 - tak, 0 - nie');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_1_TITLE', 'Nazwa banku');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_1_DESC', 'Podaj nazwę banku');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_2_TITLE', 'Numer karty');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_2_DESC', 'Wprowadź numer swojej karty');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_3_TITLE', 'Odbiorca');
define('MODULE_PAYMENT_BANK_CART_TRANSFER_3_DESC', 'Odbiorca płatności');
define('MODULE_PAYMENT_BANK_CART_SORT_ORDER_TITLE', 'Sortuj kolejność');
define('MODULE_PAYMENT_BANK_CART_SORT_ORDER_DESC', 'Kolejność sortowania modułów');

define('MODULE_PAYMENT_WEBMONEY_STATUS_TITLE', 'Płatność przez WebMoney');
define('MODULE_PAYMENT_WEBMONEY_STATUS_DESC', 'Czy chcesz korzystać z modułu płatności przez WebMoney? 1 - tak, 0 - nie');
define('MODULE_PAYMENT_WEBMONEY_1_TITLE', 'Twój identyfikator WM');
define('MODULE_PAYMENT_WEBMONEY_1_DESC', 'Wpisz swój identyfikator WM');
       define('MODULE_PAYMENT_WEBMONEY_2_TITLE', 'Numer twojego R portfelu');
define('MODULE_PAYMENT_WEBMONEY_2_DESC', 'Wprowadź numer twojego R portfelu');
define('MODULE_PAYMENT_WEBMONEY_3_TITLE', 'Numer twojego Z portfelu');
define('MODULE_PAYMENT_WEBMONEY_3_DESC', 'Wprowadź numer twojego Z portfelu');
define('MODULE_PAYMENT_WEBMONEY_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_PAYMENT_WEBMONEY_SORT_ORDER_DESC', 'Kolejność sortowania modułu');

// -----------------------SHIPPING!!!!!---------------------------//

       define('MODULE_SHIPPING_EXPRESS_STATUS_TITLE', 'Pozwól na moduł Dostawa kurierem');
define('MODULE_SHIPPING_EXPRESS_STATUS_DESC', 'Czy chcesz pozwolić na moduł Dostawa kurierem?');
define('MODULE_SHIPPING_EXPRESS_COST_TITLE', 'Koszt');
define('MODULE_SHIPPING_EXPRESS_COST_DESC', 'Koszt korzystania z tego sposobu dostawy.');
define('MODULE_SHIPPING_EXPRESS_TAX_CLASS_TITLE', 'Podatek');
define('MODULE_SHIPPING_EXPRESS_TAX_CLASS_DESC', 'Korzystać z podatku.');
define('MODULE_SHIPPING_EXPRESS_ZONE_TITLE', 'Strefa');
define('MODULE_SHIPPING_EXPRESS_ZONE_DESC', 'Jeśli wybrana jest strefa, ten moduł dostawy będzie widoczny tylko dla kupujących z wybranej strefy.');
define('MODULE_SHIPPING_EXPRESS_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_SHIPPING_EXPRESS_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');
define('MODULE_SHIPPING_EXPRESS_SHIPPING_PRICE_TEXT_TITLE', 'Tekst ceny dostawy');
define('MODULE_SHIPPING_EXPRESS_SHIPPING_PRICE_TEXT_DESC', 'Pozostaw puste, jeśli chcesz użyć ceny określonej w polu koszt');

define('MODULE_SHIPPING_FLAT_STATUS_TITLE', 'Pozwól na moduł Dostawa kurierem');
define('MODULE_SHIPPING_FLAT_STATUS_DESC', 'Czy chcesz pozwolić na moduł Dostawa kurierem?');
define('MODULE_SHIPPING_FLAT_COST_TITLE', 'Koszt');
define('MODULE_SHIPPING_FLAT_COST_DESC', 'Koszt korzystania z tego sposobu dostawy.');
define('MODULE_SHIPPING_FLAT_TAX_CLASS_TITLE', 'Podatek');
define('MODULE_SHIPPING_FLAT_TAX_CLASS_DESC', 'Korzystać z podatku.');
define('MODULE_SHIPPING_FLAT_ZONE_TITLE', 'Strefa');
define('MODULE_SHIPPING_FLAT_ZONE_DESC', 'Jeśli wybrana jest strefa, ten moduł dostawy będzie widoczny tylko dla kupujących z wybranej strefy.');
define('MODULE_SHIPPING_FLAT_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_SHIPPING_FLAT_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');

define('MODULE_SHIPPING_FREESHIPPER_STATUS_TITLE', 'Pozwól na moduł Dostawa bezpłatna');
define('MODULE_SHIPPING_FREESHIPPER_STATUS_DESC', 'Czy chcesz pozwolić na moduł Dostawa bezpłatna?');
define('MODULE_SHIPPING_FREESHIPPER_COST_TITLE','Koszt');
define('MODULE_SHIPPING_FREESHIPPER_COST_DESC', 'Koszt korzystania z tego sposobu dostawy.');
define('MODULE_SHIPPING_FREESHIPPER_TAX_CLASS_TITLE', 'Podatek');
define('MODULE_SHIPPING_FREESHIPPER_TAX_CLASS_DESC', 'Korzystać z podatku.');
define('MODULE_SHIPPING_FREESHIPPER_ZONE_TITLE', 'Strefa');
define('MODULE_SHIPPING_FREESHIPPER_ZONE_DESC', 'Jeśli wybrana jest strefa, ten moduł dostawy będzie widoczny tylko dla kupujących z wybranej strefy.');
define('MODULE_SHIPPING_FREESHIPPER_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_SHIPPING_FREESHIPPER_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');

define('MODULE_SHIPPING_ITEM_STATUS_TITLE', 'Pozwól na moduł Na jednostkę');
define('MODULE_SHIPPING_ITEM_STATUS_DESC', 'Czy chcesz pozwolić na moduł Na jednostkę');
define('MODULE_SHIPPING_ITEM_COST_TITLE', 'Koszt dostawy');
define('MODULE_SHIPPING_ITEM_COST_DESC', 'Koszt wysyłki zostanie pomnożony przez liczbę pozycji w zamówieniu.');
define('MODULE_SHIPPING_ITEM_HANDLING_TITLE', 'Koszt');
define('MODULE_SHIPPING_ITEM_HANDLING_DESC', 'Koszt korzystania z tego sposobu dostawy.');
define('MODULE_SHIPPING_ITEM_TAX_CLASS_TITLE', 'Podatek');
define('MODULE_SHIPPING_ITEM_TAX_CLASS_DESC', 'Korzystać z podatku.');
define('MODULE_SHIPPING_ITEM_ZONE_TITLE', 'Strefa');
define('MODULE_SHIPPING_ITEM_ZONE_DESC', 'Jeśli wybrana jest strefa, ten moduł dostawy będzie widoczny tylko dla kupujących z wybranej strefy.');
define('MODULE_SHIPPING_ITEM_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_SHIPPING_ITEM_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');

define('MODULE_SHIPPING_NWPOCHTA_STATUS_TITLE', 'Pozwól na moduł Nowa Poczta');
define('MODULE_SHIPPING_NWPOCHTA_STATUS_DESC', 'Czy chcesz pozwolić na moduł Nowa Poczta');
define('MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME_TITLE', 'Nazwa niestandardowego modułu');
define('MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME_DESC', 'Pozostaw puste, jeśli chcesz używać domyślnej nazwy modułu');
define('MODULE_SHIPPING_NWPOCHTA_COST_TITLE', 'Koszt');
define('MODULE_SHIPPING_NWPOCHTA_COST_DESC', 'Koszt korzystania z tego sposobu dostawy.');
define('MODULE_SHIPPING_NWPOCHTA_TAX_CLASS_TITLE', 'Podatek');
define('MODULE_SHIPPING_NWPOCHTA_TAX_CLASS_DESC', 'Korzystać z podatku.');
define('MODULE_SHIPPING_NWPOCHTA_ZONE_TITLE', 'Strefa');
define('MODULE_SHIPPING_NWPOCHTA_ZONE_DESC', 'Jeśli wybrana jest strefa, ten moduł dostawy będzie widoczny tylko dla kupujących z wybranej strefy.');
define('MODULE_SHIPPING_NWPOCHTA_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_SHIPPING_NWPOCHTA_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');
define('MODULE_SHIPPING_NWPOCHTA_SHIPPING_PRICE_TEXT_TITLE', 'Tekst ceny dostawy');
define('MODULE_SHIPPING_NWPOCHTA_SHIPPING_PRICE_TEXT_DESC', 'Pozostaw puste, jeśli chcesz użyć ceny określonej w polu koszt');

define('MODULE_SHIPPING_CUSTOMSHIPPER_STATUS_TITLE', 'Pozwól na moduł');
define('MODULE_SHIPPING_CUSTOMSHIPPER_NAME_TITLE', 'Nazwa modułu');
define('MODULE_SHIPPING_CUSTOMSHIPPER_WAY_TITLE', 'Opis');
define('MODULE_SHIPPING_CUSTOMSHIPPER_COST_TITLE', 'Koszt');
define('MODULE_SHIPPING_CUSTOMSHIPPER_TAX_CLASS_TITLE', 'Podatek');
define('MODULE_SHIPPING_CUSTOMSHIPPER_ZONE_TITLE', 'Strefa');
define('MODULE_SHIPPING_CUSTOMSHIPPER_ZONE_DESC', 'Jeśli wybrana jest strefa, ten moduł dostawy będzie widoczny tylko dla kupujących z wybranej strefy.');
define('MODULE_SHIPPING_CUSTOMSHIPPER_SORT_ORDER_TITLE', 'Kolejność sortowania');

define('MODULE_SHIPPING_PERCENT_STATUS_TITLE', 'Pozwól na moduł Dostawa procentowa');
define('MODULE_SHIPPING_PERCENT_STATUS_DESC', 'Czy chcesz pozwolić na moduł Dostawa procentowa?');
define('MODULE_SHIPPING_PERCENT_RATE_TITLE', 'Procent');
define('MODULE_SHIPPING_PERCENT_RATE_DESC', 'Koszt dostawy tego modułu jako procent całkowitej wartości zamówienia, wartości od .01 do .99');
define('MODULE_SHIPPING_PERCENT_LESS_THEN_TITLE', 'Koszt płaski dla zamówień do');
define('MODULE_SHIPPING_PERCENT_LESS_THEN_DESC', 'Płaski koszt wysyłki dla zamówień, jest kosztem do określonej wartości.');
define('MODULE_SHIPPING_PERCENT_FLAT_USE_TITLE', 'Płaski procentowy koszt');
define('MODULE_SHIPPING_PERCENT_FLAT_USE_DESC', 'Płaskie koszty wysyłki, jako procent całkowitej wartości zamówienia, ważne dla wszystkich zamówień.');
define('MODULE_SHIPPING_PERCENT_TAX_CLASS_TITLE', 'Podatek');
define('MODULE_SHIPPING_PERCENT_TAX_CLASS_DESC', 'Korzystać z podatku');
define('MODULE_SHIPPING_PERCENT_ZONE_TITLE', 'Strefa');
define('MODULE_SHIPPING_PERCENT_ZONE_DESC', 'Jeśli wybrana jest strefa, ten moduł dostawy będzie widoczny tylko dla kupujących z wybranej strefy.');
define('MODULE_SHIPPING_PERCENT_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_SHIPPING_PERCENT_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');

define('MODULE_SHIPPING_SAT_STATUS_TITLE', 'Pozwól na moduł Dostawa kurierem');
define('MODULE_SHIPPING_SAT_STATUS_DESC', 'Chcesz pozwolić na moduł Dostawa kurierem?');
define('MODULE_SHIPPING_SAT_COST_TITLE', 'Koszt');
define('MODULE_SHIPPING_SAT_COST_DESC', 'Koszt korzystania z tego sposobu dostawy.');
define('MODULE_SHIPPING_SAT_TAX_CLASS_TITLE', 'Podatek');
define('MODULE_SHIPPING_SAT_TAX_CLASS_DESC', 'Korzystaj z podatku.');
define('MODULE_SHIPPING_SAT_ZONE_TITLE', 'Strefa');
define('MODULE_SHIPPING_SAT_ZONE_DESC', 'Jeśli wybrana jest strefa, ten moduł dostawy będzie widoczny tylko dla kupujących z wybranej strefy.');
define('MODULE_SHIPPING_SAT_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_SHIPPING_SAT_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');

define('MODULE_SHIPPING_TABLE_STATUS_TITLE', 'Pozwól na moduł "Bez dostawy"');
define('MODULE_SHIPPING_TABLE_STATUS_DESC', 'Chcesz pozwolić na moduł "Bez dostawy" ');
define('MODULE_SHIPPING_TABLE_COST_TITLE', 'Koszt dostawy');
define('MODULE_SHIPPING_TABLE_COST_DESC', 'Koszt wysyłki jest obliczany na podstawie całkowitej masy zamówienia lub całkowitego kosztu zamówienia. Na przykład: 25: 8.50, 50: 5.50 itd. ... Oznacza to, że do 25 dostaw kosztuje 8,50, od 25 do 50 kosztuje 5,50, itd.');
define('MODULE_SHIPPING_TABLE_MODE_TITLE', 'Sposób obliczania');
define('MODULE_SHIPPING_TABLE_MODE_DESC', 'Koszt obliczenia dostawy w oparciu o całkowitą masę zamówienia (waga) lub na podstawie całkowitego kosztu zamówienia (cena).');
define('MODULE_SHIPPING_TABLE_HANDLING_TITLE', 'Koszt');
define('MODULE_SHIPPING_TABLE_HANDLING_DESC', 'Koszt korzystania z tego sposobu dostawy.');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_TITLE', 'Podatek');
define('MODULE_SHIPPING_TABLE_TAX_CLASS_DESC', 'Korzystaj z podatku.');
define('MODULE_SHIPPING_TABLE_ZONE_TITLE', 'Strefa');
define('MODULE_SHIPPING_TABLE_ZONE_DESC', 'Jeśli wybrana jest strefa, ten moduł dostawy będzie widoczny tylko dla kupujących z wybranej strefy.');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_SHIPPING_TABLE_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');

define('MODULE_SHIPPING_ZONES_STATUS_TITLE', 'Pozwól na moduł Stawki dla strefy');
define('MODULE_SHIPPING_ZONES_STATUS_DESC', 'Czy chcesz pozwolić na moduł Stawki dla strefy');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_TITLE', 'Podatek');
define('MODULE_SHIPPING_ZONES_TAX_CLASS_DESC', 'Korzystać z podatku.');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_SHIPPING_ZONES_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');
define('MODULE_SHIPPING_ZONES_COUNTRIES_1_TITLE', 'Kraje 1 strefy');
define('MODULE_SHIPPING_ZONES_COUNTRIES_1_DESC', 'Lista krajów przez przecinki dla strefy 1.');
define('MODULE_SHIPPING_ZONES_COST_1_TITLE', 'Koszt dostawy dla 1 strefy');
define('MODULE_SHIPPING_ZONES_COST_1_DESC', 'Koszt dostawy dla 1 strefy na podstawie maksymalnego kosztu zamówienia. Na przykład: 3: 8,50,7: 10,50, ... Oznacza to, że koszty dostawy dla zamówień ważących do 3 kg. będzie kosztować 8,50 dla kupujących z krajów pierwszej strefy.');
define('MODULE_SHIPPING_ZONES_HANDLING_1_TITLE', 'Koszt dla 1 strefy');
define('MODULE_SHIPPING_ZONES_HANDLING_1_DESC', 'Koszt korzystania z tego sposobu dostawy.');

// -----------------------ORDER TOTAL!!!!!---------------------------//

define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS_TITLE', 'Pozwól na moduł Powiązany rabat');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS_DESC', 'Czy chcesz pozwolić na moduł Powiązany rabat?');
define('MODULE_ORDER_TOTAL_OT_BETTER_TOGETHER_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_ORDER_TOTAL_OT_BETTER_TOGETHER_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX_TITLE', 'Include Tax');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX_DESC', 'Korzystać z podatku');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX_TITLE', 'Re-calculate Tax');
define('MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX_DESC', 'Przelicz podatek');

define('MODULE_ORDER_TOTAL_COUPON_STATUS_TITLE', 'Pokaż wszystko');
define('MODULE_ORDER_TOTAL_COUPON_STATUS_DESC', 'Czy chcesz wyświetlić wartość kuponu?');
define('MODULE_ORDER_TOTAL_OT_COUPON_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_ORDER_TOTAL_OT_COUPON_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');
define('MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING_TITLE', 'Uwzględniać dostawę');
define('MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING_DESC', 'Uwzględnij w obliczeniach dostawę.');
define('MODULE_ORDER_TOTAL_COUPON_INC_TAX_TITLE', 'Uwzględnij podatek');
define('MODULE_ORDER_TOTAL_COUPON_INC_TAX_DESC', 'Uwzględnij podatek w obliczeniach.');
define('MODULE_ORDER_TOTAL_COUPON_CALC_TAX_TITLE', 'Przelicz podatek');
define('MODULE_ORDER_TOTAL_COUPON_CALC_TAX_DESC', 'Przelicz podatek.');
define('MODULE_ORDER_TOTAL_COUPON_TAX_CLASS_TITLE', 'Podatek');
define('MODULE_ORDER_TOTAL_COUPON_TAX_CLASS_DESC', 'Użyj podatku dla kuponów.');

define('MODULE_ORDER_TOTAL_GV_STATUS_TITLE', 'Pokaż wszystko');
define('MODULE_ORDER_TOTAL_GV_STATUS_DESC', 'Czy chcesz wyświetlić wartość kuponu?');
define('MODULE_ORDER_TOTAL_OT_GV_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_ORDER_TOTAL_OT_GV_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');
define('MODULE_ORDER_TOTAL_GV_QUEUE_TITLE', 'Aktywacja karty podarunkowej');
define('MODULE_ORDER_TOTAL_GV_QUEUE_DESC', 'Czy chcesz ręcznie aktywować zakupione karty podarunkowe?');
define('MODULE_ORDER_TOTAL_GV_INC_SHIPPING_TITLE', 'Uwzględniać dostawę');
define('MODULE_ORDER_TOTAL_GV_INC_SHIPPING_DESC', 'Uwzględnić w obliczeniach dostawę.');
define('MODULE_ORDER_TOTAL_GV_INC_TAX_TITLE', 'Uwzględnij podatek');
define('MODULE_ORDER_TOTAL_GV_INC_TAX_DESC', 'Uwzględnij podatek w obliczeniach.');
define('MODULE_ORDER_TOTAL_GV_CALC_TAX_TITLE', 'Przelicz podatek');
define('MODULE_ORDER_TOTAL_GV_CALC_TAX_DESC', 'Przelicz podatek.');
define('MODULE_ORDER_TOTAL_GV_TAX_CLASS_TITLE', 'Podatek');
define('MODULE_ORDER_TOTAL_GV_TAX_CLASS_DESC', 'Korzystać z podatku.');
define('MODULE_ORDER_TOTAL_GV_CREDIT_TAX_TITLE', 'Podatek karty podarunkowej');
define('MODULE_ORDER_TOTAL_GV_CREDIT_TAX_DESC', 'Dodaj podatek do kupionych kart podarunkowych.');
define('MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID_TITLE', 'Status zamówienia');
define('MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID_DESC', 'Zamówienia złożone przy użyciu karty podarunkowej pokrywającej pełny koszt zamówienia będą miały wskazany status.');

define('MODULE_LEV_DISCOUNT_STATUS_TITLE', 'Pokaż rabat');
define('MODULE_LEV_DISCOUNT_STATUS_DESC', 'Zezwalać na rabaty');
define('MODULE_ORDER_TOTAL_OT_LEV_DISCOUNT_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_ORDER_TOTAL_OT_LEV_DISCOUNT_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');
define('MODULE_LEV_DISCOUNT_TABLE_TITLE', 'Procent rabatu');
define('MODULE_LEV_DISCOUNT_TABLE_DESC', 'Ustaw limity cenowe i procenty zniżki, oddzielając je przecinkiem.');
define('MODULE_LEV_DISCOUNT_INC_SHIPPING_TITLE', 'Uwzględniać dostawę');
define('MODULE_LEV_DISCOUNT_INC_SHIPPING_DESC', 'Uwzględnij w obliczeniach dostawę.');
define('MODULE_LEV_DISCOUNT_INC_TAX_TITLE', 'Uwzględnij podatek');
define('MODULE_LEV_DISCOUNT_INC_TAX_DESC', 'Uwzględnij podatek w obliczeniach.');
define('MODULE_LEV_DISCOUNT_CALC_TAX_TITLE', 'Przelicz podatek');
define('MODULE_LEV_DISCOUNT_CALC_TAX_DESC', 'Przelicz podatek.');

define('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS_TITLE', 'Pokaż niską wartość zamówienia');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS_DESC', 'Czy chcesz pokazać niski koszt zamówienia?');
define('MODULE_ORDER_TOTAL_OT_LOWORDERFEE_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_ORDER_TOTAL_OT_LOWORDERFEE_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE_TITLE', 'Zezwalaj na niskie koszty zamówienia');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE_DESC', 'Czy chcesz pozwolić na moduł niskiego kosztu zamówienia?');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER_TITLE', 'Niski koszt zamówień do');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER_DESC', 'Niska wartość zamówienia dla zamówień do określonej wartości.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE_TITLE', 'Opłata');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_FEE_DESC', 'Opłata');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION_TITLE', 'Dodaj opłatę do zamówienia');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION_DESC', 'Dodaj opłatę do następujących zamówień.');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS_TITLE', 'Podatek');
define('MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS_DESC', 'Korzystać z podatku.');

define('MODULE_PAYMENT_DISC_STATUS_TITLE', 'Pozwól na moduł');
define('MODULE_PAYMENT_DISC_STATUS_DESC', 'Aktywować moduł?');
define('MODULE_ORDER_TOTAL_OT_PAYMENT_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_ORDER_TOTAL_OT_PAYMENT_SORT_ORDER_DESC', 'Porządek sortowania modułu musi być koniecznie niższy niż moduł Total.');
define('MODULE_PAYMENT_DISC_PERCENTAGE_TITLE', 'Rabat');
define('MODULE_PAYMENT_DISC_PERCENTAGE_DESC', 'Minimalna kwota zamówienia, aby otrzymać rabat.');
define('MODULE_PAYMENT_DISC_MINIMUM_TITLE', 'Minimalna kwota zamówienia');
define('MODULE_PAYMENT_DISC_MINIMUM_DESC', 'Minimalna kwota zamówienia, aby otrzymać rabat.');
define('MODULE_PAYMENT_DISC_TYPE_TITLE', 'Sposób płatności');
define('MODULE_PAYMENT_DISC_TYPE_DESC', 'Tutaj musisz podać nazwę klasy modułu płatności, klasa znajduje się na przykład w pliku modułu /includes/modules/payment/webmoney.php. Od góry jest widoczny class webmoney, oznacza, że jeśli chcemy dać zniżkę przy płatności za pośrednictwem WebMoney, piszemy webmoney.');
define('MODULE_PAYMENT_DISC_INC_SHIPPING_TITLE', 'Uwzględniać dostawę');
define('MODULE_PAYMENT_DISC_INC_SHIPPING_DESC', 'Uwzględnij koszty wysyłki w obliczeniach');
define('MODULE_PAYMENT_DISC_INC_TAX_TITLE', 'Uwzględnij podatek');
define('MODULE_PAYMENT_DISC_INC_TAX_DESC', 'Uwzględnij podatek w obliczeniach.');
define('MODULE_PAYMENT_DISC_CALC_TAX_TITLE', 'Oblicz podatek');
define('MODULE_PAYMENT_DISC_CALC_TAX_DESC', 'Uwzględnij podatek przy obliczaniu rabatów.');

define('MODULE_QTY_DISCOUNT_STATUS_TITLE', 'Pokaż rabat na ilość');
define('MODULE_QTY_DISCOUNT_STATUS_DESC', 'Czy chcesz zezwolić na rabaty od ilości?');
define('MODULE_ORDER_TOTAL_OT_QTY_DISCOUNT_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_ORDER_TOTAL_OT_QTY_DISCOUNT_SORT_ORDER_DESC', 'Kolejność sortowania modułu.');
define('MODULE_QTY_DISCOUNT_RATE_TYPE_TITLE', 'Rodzaj rabatu');
define('MODULE_QTY_DISCOUNT_RATE_TYPE_DESC', 'Wybierz rodzaj rabatu - procent (percentage) lub płaska (flat rate)');
define('MODULE_QTY_DISCOUNT_RATES_TITLE', 'Rabat');
define('MODULE_QTY_DISCOUNT_RATES_DESC', 'Rabat jest obliczany na podstawie całkowitej liczby zamówionych pozycji. Na przykład: 10: 5.20: 10 ... i tak dalej. Oznacza to, że zamawiając 10 lub więcej sztuk towarów, kupujący otrzymuje rabat w wysokości 5% lub 5 USD; 20 lub więcej jednostek - 10% rabatu lub 10 USD; w zależności od typu');
define('MODULE_QTY_DISCOUNT_INC_SHIPPING_TITLE', 'Uwzględniać dostawę');
define('MODULE_QTY_DISCOUNT_INC_SHIPPING_DESC', 'Uwzględnić w obliczeniach dostawę.');
define('MODULE_QTY_DISCOUNT_INC_TAX_TITLE', 'Uwzględnij podatek');
define('MODULE_QTY_DISCOUNT_INC_TAX_DESC', 'Uwzględnij podatek w obliczeniach.');
define('MODULE_QTY_DISCOUNT_CALC_TAX_TITLE', 'Przelicz podatek');
define('MODULE_QTY_DISCOUNT_CALC_TAX_DESC', 'Przelicz podatek.');

define('MODULE_ORDER_TOTAL_SHIPPING_STATUS_TITLE', 'Pokaż dostawę');
define('MODULE_ORDER_TOTAL_SHIPPING_STATUS_DESC', 'Czy chcesz pokazać koszt dostawy?');
define('MODULE_ORDER_TOTAL_OT_SHIPPING_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_ORDER_TOTAL_OT_SHIPPING_SORT_ORDER_DESC', 'Kolejność  sortowania modułu.');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_TITLE', 'Pozwól na bezpłatną dostawę');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_DESC', 'Chcesz umożliwić bezpłatną dostawę?');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_TITLE', 'Bezpłatna wysyłka dla zamówień powyżej');
define('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER_DESC', 'W przypadku zamówień przekraczających podaną wartość dostawa będzie bezpłatna.');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_TITLE', 'Bezpłatna dostawa przy zamówieniach');
define('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION_DESC', 'Określ, dla których konkretnych zamówień darmowa dostawa będzie działać.');

define('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS_TITLE', 'Pokaż koszt produktu');
define('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS_DESC', 'Chcesz pokazać koszt produktu?');
define('MODULE_ORDER_TOTAL_OT_SUBTOTAL_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_ORDER_TOTAL_OT_SUBTOTAL_SORT_ORDER_DESC', 'Kolejność  sortowania modułu.');

define('MODULE_ORDER_TOTAL_TAX_STATUS_TITLE', 'Pokaż podatek');
define('MODULE_ORDER_TOTAL_TAX_STATUS_DESC', 'Czy chcesz pokazać podatek?');
define('MODULE_ORDER_TOTAL_OT_TAX_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_ORDER_TOTAL_OT_TAX_SORT_ORDER_DESC', 'Kolejność  sortowania modułu.');

define('MODULE_ORDER_TOTAL_TOTAL_STATUS_TITLE', 'Pokaż wszystko');
define('MODULE_ORDER_TOTAL_TOTAL_STATUS_DESC', 'Czy chcesz pokazać całkowity koszt zamówienia?');
define('MODULE_ORDER_TOTAL_OT_TOTAL_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_ORDER_TOTAL_OT_TOTAL_SORT_ORDER_DESC', 'Kolejność  sortowania modułu.');

define('SHIPPING_TAB_TITLE', 'Wysyłka');
define('SHIPPING_TO_PAYMENT_TAB_TITLE', 'Wysyłka do zapłaty');
define('SHIPPING_TO_FIELDS_TAB_TITLE', 'Wysyłka do pól');
define('SHIPPING_UPDATE_WAREHOUSES_TITLE', 'Zaktualizuj magazyny');
define('MODULE_SHIPPING_NWPOSHTANEW_STATUS_TITLE', 'Włącz moduł nowej poczty');
define('MODULE_SHIPPING_NWPOSHTANEW_STATUS_DESC', 'Czy chcesz włączyć moduł Nowa poczta?');
define('MODULE_SHIPPING_NWPOSHTANEW_COST_TITLE', 'Koszt');
define('MODULE_SHIPPING_NWPOSHTANEW_CUSTOM_NAME_TITLE', 'Nazwa niestandardowa');
define('MODULE_SHIPPING_NWPOSHTANEW_CUSTOM_NAME_DESC', 'Pozostaw to pole puste, jeśli chcesz użyć nazwy domyślnej');
define('MODULE_SHIPPING_NWPOSHTANEW_COST_DESC', 'Koszt korzystania z tej metody wysyłki.');
define('MODULE_SHIPPING_NWPOSHTANEW_TAX_CLASS_TITLE', 'Podatek');
define('MODULE_SHIPPING_NWPOSHTANEW_TAX_CLASS_DESC', 'Użyj podatku.');
define('MODULE_SHIPPING_NWPOSHTANEW_ZONE_TITLE', 'Strefa');
define('MODULE_SHIPPING_NWPOSHTANEW_ZONE_DESC', 'Jeśli zostanie wybrana strefa, ten moduł wysyłki będzie widoczny tylko dla klientów w wybranej strefie.');
define('MODULE_SHIPPING_NWPOSHTANEW_SORT_ORDER_TITLE', 'Kolejność sortowania');
define('MODULE_SHIPPING_NWPOSHTANEW_SORT_ORDER_DESC', 'Kolejność sortowania modułów.');
define('MODULE_SHIPPING_NWPOSHTANEW_API_KEY_TITLE', 'Klucz API');
define('MODULE_SHIPPING_NWPOSHTANEW_API_KEY_DESCRIPTION', 'Może być wymagana aktualizacja magazynów');
define('MODULE_SHIPPING_NWPOSHTANEW_SHOW_SHIPPING_COST_STATUS_TITLE', 'Pokaż koszt wysyłki');
define('MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_PRICE_TEXT_TITLE', 'Tekst ceny dostawy');
define('MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_PRICE_TEXT_DESC', 'Pozostaw puste, jeśli chcesz użyć ceny określonej w polu koszt');
define('MODULE_SHIPPING_NWPOSHTANEW_AUTODETECTION_DEPARTURE_TYPE_TITLE', 'Auto-detection of shipment type');
define('MODULE_SHIPPING_NWPOSHTANEW_AUTODETECTION_DEPARTURE_TYPE_DESC', 'Detect shipment type automatically?');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_REGION_TITLE', 'Sender area');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_REGION_DESC', 'Specify sender area');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_CITY_NAME_TITLE', 'Sender city');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_CITY_NAME_DESC', '\Select the city from which the order will be sent');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS_NAME_TITLE', 'Sender\'s address');
define('MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS_NAME_DESC', '\Select the address from which the order will be sent');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_TYPE_TITLE', 'Departure type');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_TYPE_DESC', 'Specify the type of shipment.');
define('MODULE_SHIPPING_NWPOSHTANEW_SEATS_AMOUNT_TITLE', 'Number of seats');
define('MODULE_SHIPPING_NWPOSHTANEW_SEATS_AMOUNT_DESC', 'Specify the default number of seats. If the field is left blank, then the number of seats will correspond to the number of products in the order.');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_DESCRIPTION_TITLE', 'Departure Description');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_DESCRIPTION_DESC', 'It is used as the default description of the product when creating "EN", it is convenient if there are many products in the store that have the same description.');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_TITLE', 'Return shipping');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_DESC', 'Specify the default return shipping type.');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_TITLE', 'Declared value');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DESC', 'Specify the components for the declared value of the shipment.');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DEFAULT_TITLE', 'Declared default value');
define('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DEFAULT_DESC', 'The value will be used if the declared value is not set or if the order is not paid by cash on delivery.');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_PAYER_TITLE', 'Return shipping payer');
define('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_PAYER_DESC', 'Specify the default return shipping payer.');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_TYPE_TITLE', 'Payment form');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_TYPE_DESC', 'Specify the default form of payment.');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD_TITLE', 'Cash on delivery payment method');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD_DESC', 'Specify the payment method corresponding to the cash on delivery.');
define('MODULE_SHIPPING_NWPOSHTANEW_MONEY_TRANSFER_METHOD_TITLE', 'How to receive a money transfer');
define('MODULE_SHIPPING_NWPOSHTANEW_MONEY_TRANSFER_METHOD_DESC', 'Specify the method of receiving money transfer.');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_CONTROL_TITLE', 'Payment control');
define('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_CONTROL_DESC', 'Specify components for payment control. If items are marked, the payment control will replace the money transfer.');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_ADDITIONAL_INFORMATION_TITLE', 'Additional shipping information');
define('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_ADDITIONAL_INFORMATION_DESC', 'It is used as a template for the field of additional information about the shipment when creating a waybill. Macros can be used. When using product macros, separate the text into two blocks using the symbol "|" (use product macros in the second block).');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_FORMAT_TITLE', 'Print format');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_FORMAT_DESC', 'Specify the print format.');
define('MODULE_SHIPPING_NWPOSHTANEW_TEMPLATE_TYPE_TITLE', 'Template type');
define('MODULE_SHIPPING_NWPOSHTANEW_TEMPLATE_TYPE_DESC', 'Specify template type.');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_TYPE_TITLE', 'Print type');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_TYPE_DESC', 'Specify Print Type.');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_START_TITLE', 'Place of printing');
define('MODULE_SHIPPING_NWPOSHTANEW_PRINT_START_DESC', 'Specify the location where printing will start.');
define('MODULE_SHIPPING_NWPOSHTANEW_NUMBER_OF_COPIES_TITLE', 'Number of copies');
define('MODULE_SHIPPING_NWPOSHTANEW_NUMBER_OF_COPIES_DESC', 'Specify the number of copies.');
define('MODULE_SHIPPING_NWPOSHTANEW_DISPLAY_ALL_CONSIGNMENTS_TITLE', 'Display all invoices for an account');
define('MODULE_SHIPPING_NWPOSHTANEW_DISPLAY_ALL_CONSIGNMENTS_DESC', 'Show all invoices for a postal company account? If you select "No", then only those invoices that are assigned to the orders of this online store will be displayed.');
define('MODULE_SHIPPING_NWPOSHTANEW_CONSIGNMENT_DISPLAYED_INFORMATION_TITLE', 'Displayed Information');
define('MODULE_SHIPPING_NWPOSHTANEW_CONSIGNMENT_DISPLAYED_INFORMATION_DESC', 'Select information to display.');
define('MODULE_SHIPPING_NWPOSHTANEW_DELIVERY_PAYER_TITLE', 'Delivery payer');
define('MODULE_SHIPPING_NWPOSHTANEW_DELIVERY_PAYER_DESC', 'Specify the default shipping payer');
define('MODULE_SHIPPING_NWPOSHTANEW_WEIGHT_TITLE', 'The weight');
define('MODULE_SHIPPING_NWPOSHTANEW_WEIGHT_DESC', 'Specify the default actual weight');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_W_TITLE', 'Width');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_W_DESC', 'Specify a default width');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_L_TITLE', 'Length');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_L_DESC', 'Specify a default length');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_H_TITLE', 'Height');
define('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_H_DESC', 'Specify a default height');
define('MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE_TITLE', 'Debug mode');
define('MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE_DESC', 'Enable/disable debug mode');
define('MODULE_SHIPPING_NWPOSHTANEW_SAVE_TTN_ONE_CLICK_TITLE', 'Create TTN in one click');
define('MODULE_SHIPPING_NWPOSHTANEW_SAVE_TTN_ONE_CLICK_DESC', 'Enable / disable the creation of TTN in one click');
define('MODULE_SHIPPING_NWPOSHTANEW_cn_identifier', 'Invoice ID');
define('MODULE_SHIPPING_NWPOSHTANEW_cn_number', 'invoice number');
define('MODULE_SHIPPING_NWPOSHTANEW_order_number', 'order no.');
define('MODULE_SHIPPING_NWPOSHTANEW_create_date', 'date of creation');
define('MODULE_SHIPPING_NWPOSHTANEW_actual_shipping_date', 'Actual departure date');
define('MODULE_SHIPPING_NWPOSHTANEW_preferred_shipping_date', 'Desired delivery date');
define('MODULE_SHIPPING_NWPOSHTANEW_estimated_shipping_date', 'Estimated delivery date');
define('MODULE_SHIPPING_NWPOSHTANEW_recipient_date', 'Date of receiving');
define('MODULE_SHIPPING_NWPOSHTANEW_last_updated_status_date', 'Date of last status update');
define('MODULE_SHIPPING_NWPOSHTANEW_sender', 'Sender');
define('MODULE_SHIPPING_NWPOSHTANEW_sender_address', 'Sender\'s address');
define('MODULE_SHIPPING_NWPOSHTANEW_recipient', 'Recipient');
define('MODULE_SHIPPING_NWPOSHTANEW_recipient_address', 'Address of the recipient');
define('MODULE_SHIPPING_NWPOSHTANEW_weight', 'Weight, kg');
define('MODULE_SHIPPING_NWPOSHTANEW_seats_amount', 'Number of seats');
define('MODULE_SHIPPING_NWPOSHTANEW_declared_cost', 'Declared value');
define('MODULE_SHIPPING_NWPOSHTANEW_shipping_cost', 'Cost of delivery');
define('MODULE_SHIPPING_NWPOSHTANEW_backward_delivery', 'Return shipping');
define('MODULE_SHIPPING_NWPOSHTANEW_service_type', 'Delivery technology');
define('MODULE_SHIPPING_NWPOSHTANEW_description', 'Description');
define('MODULE_SHIPPING_NWPOSHTANEW_additional_information', 'Additional Information');
define('MODULE_SHIPPING_NWPOSHTANEW_payer_type', 'Delivery payer');
define('MODULE_SHIPPING_NWPOSHTANEW_payment_method', 'Payment type');
define('MODULE_SHIPPING_NWPOSHTANEW_departure_type', 'Departure type');
define('MODULE_SHIPPING_NWPOSHTANEW_packing_number', 'Packing number');
define('MODULE_SHIPPING_NWPOSHTANEW_rejection_reason', 'Reason for not delivering');
define('MODULE_SHIPPING_NWPOSHTANEW_status', 'Status');
define('MODULE_SHIPPING_NWPOSHTANEW_Cargo', 'Cargo');
define('MODULE_SHIPPING_NWPOSHTANEW_Parcel', 'Parcel');
define('MODULE_SHIPPING_NWPOSHTANEW_Documents', 'Documents');
define('MODULE_SHIPPING_NWPOSHTANEW_TiresWheels', 'TiresWheels');
define('MODULE_SHIPPING_NWPOSHTANEW_Pallet', 'Pallet');
define('MODULE_SHIPPING_NWPOSHTANEW_N', 'No return shipping');
define('MODULE_SHIPPING_NWPOSHTANEW_Money', 'Money');
define('MODULE_SHIPPING_NWPOSHTANEW_ot_shipping', 'Delivery');
define('MODULE_SHIPPING_NWPOSHTANEW_ot_subtotal', 'Preliminary Total');
define('MODULE_SHIPPING_NWPOSHTANEW_ot_total', 'Order Total');
define('MODULE_SHIPPING_NWPOSHTANEW_Sender', 'Sender');
define('MODULE_SHIPPING_NWPOSHTANEW_Recipient', 'Recipient');
define('MODULE_SHIPPING_NWPOSHTANEW_ThirdPerson', 'Third Person');
define('MODULE_SHIPPING_NWPOSHTANEW_on_warehouse', 'On warehouse');
define('MODULE_SHIPPING_NWPOSHTANEW_to_payment_card', 'To payment card');
define('MODULE_SHIPPING_NWPOSHTANEW_document_A4', 'Document A4 ');
define('MODULE_SHIPPING_NWPOSHTANEW_document_A5', 'Document A5 ');
define('MODULE_SHIPPING_NWPOSHTANEW_markings_A4', 'Markings A4 ');
define('MODULE_SHIPPING_NWPOSHTANEW_html', 'HTML');
define('MODULE_SHIPPING_NWPOSHTANEW_pdf', 'PDF');
define('MODULE_SHIPPING_NWPOSHTANEW_horPrint', 'Horizontal');
define('MODULE_SHIPPING_NWPOSHTANEW_verPrint', 'Vertical');
define('MODULE_SHIPPING_NWPOSHTANEW_Cash', 'Cash');
define('MODULE_SHIPPING_NWPOSHTANEW_NonCash', 'Non Cash');

define('SHIPPING_UPDATE_AREAS_TITLE', 'Update areas');
define('SHIPPING_UPDATE_CITIES_TITLE', 'Update cities');
define('SHIPPING_UPDATE_REFERENCES_TITLE', 'Update directories');
?>