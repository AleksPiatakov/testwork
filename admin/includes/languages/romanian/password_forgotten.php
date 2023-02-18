<?php
/*
  $Id: password_forgotten.php,v 1.8 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, soluții de comerț electronic cu sursă deschisă
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Lansat sub licența publică generală GNU
*/

define('NAVBAR_TITLE_1', 'Enter');
define('NAVBAR_TITLE_2', 'Recuperarea parolei');

define('HEADING_TITLE', 'Mi-am uitat parola!');

define('TEXT_MAIN', 'Dacă ați uitat parola, vă rugăm să introduceți adresa de e-mail și vă vom trimite parola la adresa de e-mail pe care ați furnizat-o.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<b>Eroare:</b> Adresa de e-mail nu se potriveşte cu contul dvs., vă rugăm să încercaţi din nou.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . 'este parola ta');
define('EMAIL_PASSWORD_REMINDER_BODY', 'O cerere pentru o nouă parolă a fost primită de la ');
define('EMAIL_PASSWORD_REMINDER_BODY2', 'Noua ta parolă este în \'' . STORE_NAME . '\':' . ' %s');
define('EMAIL_PASSWORD_REMINDER_SUBJECT2', STORE_NAME . '- cerere de schimbare a parolei');
define('EMAIL_PASSWORD_REMINDER_BODY3', 'dacă ați făcut această solicitare, atunci urmați linkul de mai jos și parola contului va fi actualizată');

define('SUCCESS_PASSWORD_SENT', 'Terminat: noua ta parolă a fost trimisă prin e-mail.');
define('SUCCESS_PASSWORD_TOKEN_SENT', 'Terminat: un link de resetare a parolei a fost trimis la adresa ta de e-mail.');
define('EMAIL_TOKEN_ERROR', 'Tokenul nu mai este valid');