<?php
/*
  $Id: admin_account.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Admin');

define('TABLE_HEADING_ACCOUNT', 'Moje dane');

define('TEXT_INFO_FULLNAME', '<b>Imię: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Imię: </b>');
define('TEXT_INFO_LASTNAME', '<b>Nazwisko: </b>');
define('TEXT_INFO_EMAIL', '<b> Email Adres : </b>');
define('TEXT_INFO_PASSWORD', '<b>Hasło: </b>');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Zatwierdź hasło: </b>');
define('TEXT_INFO_CREATED', '<b>Wpis utworzony: </b>');
define('TEXT_INFO_LOGDATE', '<b>Ostatnie logowanie: </b>');
define('TEXT_INFO_LOGNUM', '<b>Ilość logowań: </b>');
define('TEXT_INFO_GROUP', '<b>Grupa: </b>');
define('TEXT_INFO_ERROR', 'Dany Email adres już jest zarejestrowany!Spróbuj jeszcze raz.');
define('TEXT_INFO_MODIFIED', 'Ostatnie modyfikacje: ');
define('TEXT_INFO_PASSWORD_HIDDEN', '**************');

define('TEXT_INFO_HEADING_DEFAULT', 'Edytuj dane ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Wprowadź hasło ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Hasło:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<b>BŁĄD:</b> nieprawidłowe hasło!');
define('TEXT_INFO_INTRO_DEFAULT', 'Naciśnij przycisk <b>edytuj</b> do edycji danych.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br><b>UWAGA:</b><br>Witamy, <b>%s</b>, Zalogowałeś się pierwszy raz. Zalecamy zmianę hasła!');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br><b>UWAGA:</b><br>Witamy, <b>%s</b>, Zalecamy zmianę email adresu (admin@localhost) i hasła!');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Wszystkie pola są wymagane. Kliknij przycisk "zapisz", aby zapisać zmiany.');

define('JS_ALERT_FIRSTNAME',        '- Nie podałeś swoje Imię. \n');
define('JS_ALERT_LASTNAME',         '- Nie podałeś swoje Nazwisko. \n');
define('JS_ALERT_EMAIL',            '- Nie podałeś swój Email adres. \n');
define('JS_ALERT_PASSWORD',         '- Nie podałeś swoje Hasło. \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Pole Imię musi zawierać co najmniej znaków: ');
define('JS_ALERT_LASTNAME_LENGTH',  '- Pole Nazwisko musi zawierać co najmniej znaków: ');
define('JS_ALERT_PASSWORD_LENGTH',  '- Pole Hasło musi zawierać co najmniej znaków: ');
define('JS_ALERT_EMAIL_FORMAT',     '- Nieprawidłowo wprowadzony Email adres! \n');
define('JS_ALERT_EMAIL_USED',       '- Wprowadzony Email adres już zarejestrowany! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- Nie podałeś hasło w polu Zatwierdź hasło! \n');

define('ADMIN_EMAIL_SUBJECT', 'Twoje dane zostały zmienione!');
define('ADMIN_EMAIL_TEXT', 'Witamy, %s!' . "\n\n" . 'Twoje informacje zostały pomyślnie zaktualizowane. Jeżeli nie zmieniałeś swoich danych, skontaktuj się z administratorem, być może ktoś próbuje uzyskać dostęp do twoich danych!!' . "\n\n" . 'Strona internetowa: %s' . "\n" . 'Email: %s' . "\n" . 'Hasło: %s' . "\n\n" . 'Dziękujemy!' . "\n" . '%s' . "\n\n" . 'Wiadomość została wysłana automatycznie, nie musisz na nią odpowiadać!'); 

//Button
define('BUTTON_BACK_NEW', 'Powróć');
?>
