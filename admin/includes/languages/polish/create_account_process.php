<?php
/*
  $Id: create_account_process.php,v 1.1 2003/09/24 14:33:18 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
define('NAVBAR_TITLE', 'Rejestracja klienta');
define('HEADING_TITLE', 'Dane osobowe');
define('HEADING_NEW', 'Złożenie zamówienia');
define('NAVBAR_NEW_TITLE', 'Złożenie zamówienia');

define('EMAIL_SUBJECT', 'Witamy w ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Szanowny Panie %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Szanowna Pani %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Szanowny Panie %s' . "\n\n");
define('EMAIL_WELCOME', 'Miło nam zaprosić cię do sklepu internetowego <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_CONTACT', 'Jeśli masz jakieś pytania, napisz: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_TEXT', 'Teraz możesz skorzystać <b>z dodatkowych usług</b>, które chętnie ci oferujemy. Usługi te obejmują:' . "\n\n" . '<li><b>Stały kosz</b> - Wszelkie towary dodane do koszyka pozostaną tam do chwili, gdy zdecydujesz się na ich zakup lub dopóki nie usuniesz ich z koszyka.' . "\n" . '<li><b>Książka adresowa</b> - Możemy dostarczyć zakupiony towar pod wskazany adres, a nie tylko adres domowy! To wspaniała możliwość wysyłania prezentów do rodziny i znajomych, nawet jeśli mieszkają w innym mieście.' . "\n" . '<li><b>Historia zamówień</b> - Tutaj możesz zobaczyć historię zamówień złożonych w naszym sklepie.' . "\n" . '<li><b>Opinie o produkcie</b> - Teraz nasi klienci mogą wyrazić swoją opinię na temat towarów zakupionych w naszym sklepie. Twoja opinia będzie dostępna dla szerokiego grona odbiorców, którzy na pewno potrzebują oceny konsumenckiej różnych produktów.' . "\n");
define('EMAIL_WARNING', '<b>Uwaga:</b> Ten adres e-mail został dostarczony przez jednego z naszych klientów. Jeśli jeszcze się nie zarejestrowałeś i nie jesteś członkiem naszego klubu konsumenckiego, poinformuj nas o tym na stronie ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

  define('EMAIL_PASS_1', 'Twoje hasło ');
  define('EMAIL_PASS_2', ', Nie zapomnij jego!' . "\n\n");
?>
