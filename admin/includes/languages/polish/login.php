<?php
/*
  $Id: login.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  define('NAVBAR_TITLE', 'Zaloguj się');
  define('HEADING_TITLE', 'Witamy, podaj swoje dane');
  define('TEXT_STEP_BY_STEP', ''); // should be empty

define('HEADING_RETURNING_ADMIN', 'Zaloguj się:');
define('HEADING_PASSWORD_FORGOTTEN', 'Przypomnij hasło:');
define('TEXT_RETURNING_ADMIN', 'Tylko dla administratorów!');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail adres:');
define('ENTRY_PASSWORD', 'Hasło:');
define('ENTRY_FIRSTNAME', 'Imię:');
define('IMAGE_BUTTON_LOGIN', 'Zaloguj się');

define('TEXT_PASSWORD_FORGOTTEN', 'Zapomniałeś hasło?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>BŁĄD:</b></font> Nieprawidłowy adres e-mail lub hasło!');
define('TEXT_LOGIN_ERROR_TRIED', '<font color="#ff0000"><b>BŁĄD:</b></font> Przekroczono liczbę prób — spróbuj ponownie za 5 minut');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>BŁĄD:</b></font> Imię i e-mail nie pasują do siebie!');
define('TEXT_FORGOTTEN_FAIL', 'Próbowałeś zalogować się więcej niż 3 razy. W celu zapewnienia bezpieczeństwa, należy skontaktować się z administratorem w celu uzyskania hasła do wejścia.<br>&nbsp;<br>&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'Nowe hasło zostało wysłane na Twój adres email. Sprawdź pocztę i spróbuj zalogować się ponownie.<br>&nbsp;<br>&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'Nowe hasło!'); 
define('ADMIN_EMAIL_TEXT', 'Witamy %s,' . "\n\n" . 'Możesz zalogować się do panelu administracyjnego z następującym hasłem. Po zalogowaniu się z tym hasłem, zalecamy zmianę hasła na nowe!' . "\n\n" . 'Strona internetowa : %s' . "\n" . 'Email: %s' . "\n" . 'Hasło: %s' . "\n\n" . 'Dziękujemy!' . "\n" . '%s' . "\n\n" . 'E-mail został wysłany automatycznie, nie trzeba na niego odpowiadać!'); 
?>
