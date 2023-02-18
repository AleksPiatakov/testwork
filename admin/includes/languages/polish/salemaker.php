<?php
/*
  $Id: salemaker.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Rabaty masowe');

define('TABLE_HEADING_SALE_NAME', 'Nazwa oferty');
define('TABLE_HEADING_SALE_DEDUCTION', 'Odliczenie');
define('TABLE_HEADING_SALE_DATE_START', 'Data rozpoczęcia oferty');
define('TABLE_HEADING_SALE_DATE_END', 'Data zakończenia');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Działanie');

define('TEXT_SALEMAKER_NAME', 'Nazwa oferty:');
define('TEXT_SALEMAKER_DEDUCTION', 'Odliczenie:');
define('TEXT_SALEMAKER_DEDUCTION_TYPE', 'Typ:');
define('TEXT_SALEMAKER_PRICERANGE_FROM', 'Cena towaru od:');
define('TEXT_SALEMAKER_PRICERANGE_TO', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;do&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
define('TEXT_SALEMAKER_SPECIALS_CONDITION', 'Jeśli produkt jest już objęty rabatem:');
define('TEXT_SALEMAKER_DATE_START', 'Data rozpoczęcia oferty:');
define('TEXT_SALEMAKER_DATE_END', 'Data zakończenia:');
define('TEXT_SALEMAKER_CATEGORIES', '<b>Lub</b> Wybierz kategorie, którą będzie dotyczyć dana oferta:');
define('TEXT_SALEMAKER_MANUFACTURERS', '<b>Lub</b> Wybierz producent, którą będzie dotyczyć dana oferta:');
define('TEXT_SALEMAKER_POPUP', '<a href="javascript:session_win();"><span class="errorText"><b>Zalecenia dotyczące tworzenia i korzystania z masowych rabatów.</b></span></a>');
define('TEXT_SALEMAKER_IMMEDIATELY', 'Natychmiast');
define('TEXT_SALEMAKER_NEVER', 'Brak ograniczeń');
define('TEXT_SALEMAKER_ENTIRE_CATALOG', 'Zaznaczyć jeżeli oferta jest ważna dla <b>wszystkich</b> produktów sklepu:');
define('TEXT_SALEMAKER_TOP', 'Rabat jest ważny dla wszystkich produktów w sklepie');

define('TEXT_INFO_DATE_ADDED', 'Data utworzenia:');
define('TEXT_INFO_DATE_MODIFIED', 'Data ostatniej modyfikacji:');
define('TEXT_INFO_DATE_STATUS_CHANGE', 'Data ostatniej zmiany statusu zniżki:');
define('TEXT_INFO_SPECIALS_CONDITION', 'Jeżeli produkt już ma rabat :');
define('TEXT_INFO_DEDUCTION', 'Odliczenie:');
define('TEXT_INFO_PRICERANGE_FROM', 'Cena produktu od:');
define('TEXT_INFO_PRICERANGE_TO', ' do ');
define('TEXT_INFO_DATE_START', 'Data rozpoczęcia oferty:');
define('TEXT_INFO_DATE_END', 'Data zakończenia:');

define('SPECIALS_CONDITION_DROPDOWN_0', 'Zignoruj cenę specjalną i ustaw warunki rabatów masowych');
define('SPECIALS_CONDITION_DROPDOWN_1', 'Zignoruj warunek rabatu masowego dla tego produktu');
define('SPECIALS_CONDITION_DROPDOWN_2', 'Dodaj warunek rabatu masowego do specjalnej ceny');

define('DEDUCTION_TYPE_DROPDOWN_0', 'Odliczenie kwoty');
define('DEDUCTION_TYPE_DROPDOWN_1', 'Procent rabatu');
define('DEDUCTION_TYPE_DROPDOWN_2', 'Nowa cena');

define('TEXT_INFO_HEADING_COPY_SALE', 'Kopiuj ofertę');
define('TEXT_INFO_COPY_INTRO', 'Wprowadź nazwę dla kopiowanej oferty<br>&nbsp;&nbsp;"%s"');

define('TEXT_INFO_HEADING_DELETE_SALE', 'Usuń ofertę');
define('TEXT_INFO_DELETE_INTRO', 'Czy na pewno chcesz usunąć tę ofertę');
define('TEXT_DISPLAY_NUMBER_OF_SALES', 'Wyświetlono <b>%d</b> - <b>%d</b> (Łącznie <b>%d</b> rabatów masowych)');

//Button
define('BUTTON_CANCEL_NEW', 'anuluj');
define('BUTTON_EDIT_NEW', 'edytować');
define('BUTTON_UNLOCK_NEW', 'odblokować');
define('BUTTON_PREVIEW_NEW', 'zapowiedź');
define('BUTTON_BACK_NEW', 'wróć');
define('BUTTON_NEWSLETTER_NEW', 'newsletter');
define('BUTTON_DELETE_NEW', 'usuń');
define('BUTTON_LOCK_NEW', 'zamknij');
define('BUTTON_SEND_NEW', 'wysłać');
define('BUTTON_INSERT_NEW', 'wstawić');
define('BUTTON_RESET_NEW', 'nastawić');
define('BUTTON_SALE_NEW', 'sprzedaż');
define('BUTTON_COPY_TO_NEW', 'kopiuj do');
?>
