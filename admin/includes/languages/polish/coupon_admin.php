<?php
/*
  $Id: coupon_admin.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Kupony');
define('HEADING_TITLE_STATUS', 'Sortowanie: ');
define('TEXT_CUSTOMER', 'Klient:');
define('TEXT_COUPON', 'Nazwa kuponu');
define('TEXT_COUPON_ALL', 'Wszystkie kupony');
define('TEXT_COUPON_ACTIVE', 'Aktywne kupony');
define('TEXT_COUPON_INACTIVE', 'Nieaktywne kupony');
define('TEXT_SUBJECT', 'Temat:');
define('TEXT_FROM', 'Od:');
define('TEXT_FREE_SHIPPING', 'Bezpłatna wysyłka');
define('TEXT_MESSAGE', 'Wiadomość:');
define('TEXT_SELECT_CUSTOMER', 'Wybierz klienta');
define('TEXT_ALL_CUSTOMERS', 'Wszyscy klienci');
define('TEXT_NEWSLETTER_CUSTOMERS', 'Wszystkim, którzy subskrybują newsletter');
define('TEXT_CONFIRM_DELETE', 'Czy na pewno chcesz usunąć ten kupon?');

define('TEXT_TO_REDEEM', 'Możesz użyć tego kuponu w procesie składania zamówienia w naszym sklepie. Podczas składania zamówienia zostaniesz poproszony o podanie kodu kuponu, wpisz swój kod kuponu i kliknij przycisk "Zastosuj".');
define('TEXT_IN_CASE', ' w przypadku jakichkolwiek problemów. ');
define('TEXT_VOUCHER_IS', 'Kod kuponu: ');
define('TEXT_REMEMBER', 'Nie zapominaj o kodzie kuponu, jeśli zapomnisz kodu kuponu, nie możesz go użyć w naszym sklepie internetowym.');
define('TEXT_VISIT', 'kiedy odwiedzasz nasz sklep internetowy pod adresem ' . HTTP_SERVER . DIR_WS_CATALOG);
define('TEXT_ENTER_CODE', ' i wprowadź kod kuponu ');

define('TABLE_HEADING_ACTION', 'Działanie');

define('CUSTOMER_ID', 'Kod klienta');
define('CUSTOMER_NAME', 'Imię');
define('REDEEM_DATE', 'Data wykorzystania kuponu');
define('IP_ADDRESS', 'Adres IP');

define('TEXT_REDEMPTIONS', 'Statystyki wykorzystania kuponów');
define('TEXT_REDEMPTIONS_TOTAL', 'Łącznie wykorzystany jeden raz');
define('TEXT_REDEMPTIONS_CUSTOMER', 'Ten klient wykorzystał jeden raz');
define('TEXT_NO_FREE_SHIPPING', 'Brak bezpłatnej wysyłki');

define('NOTICE_EMAIL_SENT_TO', 'Powiadomienie: e-mail wysłany: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Błąd: Nie wybrano klienta.');
define('COUPON_NAME', 'Nazwa kuponu');
//define('COUPON_VALUE', 'Coupon Value');
define('COUPON_AMOUNT', 'Wartość nominalna kuponu');
define('COUPON_CODE', 'Kod kuponu');
define('COUPON_STARTDATE', 'Kupon jest ważny od');
define('COUPON_FINISHDATE', 'Kupon jest ważny do');
define('COUPON_FREE_SHIP', 'Bezpłatna wysyłka');
define('COUPON_FOR_EVERY_PRODUCT', 'Użyj dla każdego odpowiedniego produktu');
define('COUPON_DESC', 'Opis kuponu');
define('COUPON_MIN_ORDER', 'Minimalna kwota zamówienia');
define('COUPON_USES_COUPON', 'Ile razy mogę użyć kuponu przy składaniu zamówień?');
define('COUPON_USES_USER', 'Ile razy ten kupon może zostać wykorzystany przez jednego kupującego');
define('COUPON_PRODUCTS', 'Kupon jest ważny tylko dla określonych towarów');
define('COUPON_CATEGORIES', 'Kupon jest ważny tylko dla określonych kategorii');
define('VOUCHER_NUMBER_USED', 'Kupon użyty jeden raz');
define('DATE_CREATED', 'Data utworzenia');
define('DATE_MODIFIED', 'Ostatnie zmiany');
define('TEXT_HEADING_NEW_COUPON', 'Utwórz nowy kupon');
define('TEXT_NEW_INTRO', 'Aby utworzyć nowy kupon, musisz wypełnić poniższy formularz.<br>');

define('COUPON_BUTTON_PREVIEW', 'Podgląd');
define('COUPON_BUTTON_CONFIRM', 'Potwierdź');
define('COUPON_BUTTON_BACK', 'Wróć');

define('ERROR_NO_COUPON_AMOUNT', 'Błąd: nie określono wartości kuponu');
define('ERROR_NO_COUPON_NAME', 'Błąd: nie określono nazwy kuponu');
define('ERROR_COUPON_EXISTS', 'Błąd: kupon już istnieje');

define('COUPON_VIEW', 'Oglądaj');

define('COUPON_NAME_HELP', 'Wprowadź krótką nazwę kuponu.');
define('COUPON_AMOUNT_HELP', 'Możesz określić zarówno kwotę kuponu (podaj kwotę liczbową, na przykład, jeśli kwota kuponu wynosi 100 USD, po prostu napisz - 100), jak i procent rabatu (wskaż procent, który zostanie przekazany kupującemu, który wykorzystał kupon przy składaniu zamówienia, na przykład, aby dać zniżkę 10 %, i napisz - 10%), korzystając z tego kuponu, kupujący otrzymuje odliczenie kwoty kuponu od całkowitej kwoty zamówienia lub otrzymuje zniżkę z całkowitej kwoty zamówienia, w zależności od tego, co określisz w tym polu, lub kwoty odliczenia, lub procent zniżki.');
define('COUPON_CODE_HELP', 'Możesz sam podać kod kuponu, ale jeśli pozostawisz to pole puste (po prostu nie wypełnisz tego pola), kod kuponu zostanie wygenerowany automatycznie.');
define('COUPON_STARTDATE_HELP', 'Data, od której kupon będzie aktywny i może być wykorzystany przy składaniu zamówień.');
define('COUPON_FINISHDATE_HELP', 'Data, po której kupon nie może być już wykorzystany przy składaniu zamówień.');
define('COUPON_FREE_SHIP_HELP', 'Zaznacz to pole, jeśli chcesz, aby kupujący, korzystając z kuponu, złożył zamówienie na bezpłatną dostawę swojego zamówienia. Uwaga. Ta opcja nie może być wykorzystywana razem z "Wartość nominalna kuponu", to znaczy, że nie możesz natychmiast dać kupującemu odliczenia kwoty (lub zniżkę) na kuponie i jednocześnie darmową wysyłkę, tylko jedną rzecz: lub odliczenie (lub zniżkę) lub bezpłatną dostawę. Ta opcja uwzględnia "Minimalną wielkość zamówienia", czyli możesz, na przykład, dać kupującemu, który korzysta z kuponu, darmową dostawę, tylko jeśli kwota jego zamówienia jest wyższa od podanej przez ciebie, lub możesz nie ograniczać kwoty minimalnego zamówienia i dać bezpłatną dostawę każdemu, kto użyje kuponu przy składaniu zamówienia.');
define('COUPON_FOR_EVERY_PRODUCT_HELP', 'Zniżka kuponowa zostanie zastosowana do każdego kwalifikującego się przedmiotu w koszyku. Opcja działa tylko wtedy, gdy istnieje ograniczenie dotyczące produktu lub kategorii.');
define('COUPON_DESC_HELP', 'Opisz krótko tworzony kupon.');
define('COUPON_MIN_ORDER_HELP', 'Możesz ograniczyć (lub nie ograniczyć) ważność kuponu do minimalnej kwoty zamówienia, tj. jeśli kwota zamówienia jest mniejsza niż kwota określona w tym polu, wówczas kupon nie może być zastosowany do tego zamówienia, tylko dla zamówień powyżej określonej kwoty. Pomiń to pole, jeśli nie chcesz ustawiać ograniczeń.');
define('COUPON_USES_COUPON_HELP', 'Maksymalna liczba razy, kiedy można wykorzystać kupon, nie wypełniaj tego pola, jeśli nie chcesz ograniczać działań kuponu.');
define('COUPON_USES_USER_HELP', 'Maksymalna liczba kuponów, z których jeden kupujący może skorzystać, nie wypełniaj tego pola, jeśli nie chcesz ograniczać działań kuponu.');
define('COUPON_PRODUCTS_HELP', 'Możesz ograniczyć działanie kuponu tylko do określonych towarów w swoim sklepie internetowym, podając kody towarów po kolei (używaj przecinki). Pomiń to pole, jeśli nie chcesz ustawiać ograniczeń.');
define('COUPON_CATEGORIES_HELP', 'Możesz ograniczyć ważność kuponu tylko do określonych kategorii w swoim sklepie internetowym, podając kody kategorii po kolei (używaj przecinki). Pomiń to pole, jeśli nie chcesz ustawiać ograniczeń.');

define('TEXT_TOOLTIP_VOUCHER_EMAIL', 'Wyślij kupon na e-mail');
define('TEXT_TOOLTIP_VOUCHER_EDIT', 'Edytuj kupon');
define('TEXT_TOOLTIP_VOUCHER_DELETE', 'Usuń kupon');
define('TEXT_TOOLTIP_VOUCHER_REPORT', 'Raport kuponu');
