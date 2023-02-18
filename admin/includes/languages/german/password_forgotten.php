<?php
/*
  $Id: password_forgotten.php,v 1.8 09.06.2003 22:46:46 hpdl Exp $

  osCommerce, Open-Source-E-Commerce-Lösungen
  http://www.oscommerce.com

  Urheberrecht (c) 2003 osCommerce

  Veröffentlicht unter der GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Enter');
define('NAVBAR_TITLE_2', 'Passwortwiederherstellung');

define('HEADING_TITLE', 'Ich habe mein Passwort vergessen!');

define('TEXT_MAIN', 'Wenn Sie Ihr Passwort vergessen haben, geben Sie bitte Ihre E-Mail-Adresse ein und wir senden Ihr Passwort an die von Ihnen angegebene E-Mail-Adresse.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<b>Fehler:</b> E-Mail-Adresse stimmt nicht mit Ihrem Konto überein, bitte versuchen Sie es erneut.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' ist dein Passwort');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Eine Anfrage nach einem neuen Passwort wurde von ');
define('EMAIL_PASSWORD_REMINDER_BODY2', 'Ihr neues Passwort ist in \'' . STORE_NAME . '\':' . ' %s');
define('EMAIL_PASSWORD_REMINDER_SUBJECT2', STORE_NAME . ' - Anfrage zur Passwortänderung');
define('EMAIL_PASSWORD_REMINDER_BODY3', 'Wenn Sie diese Anfrage gestellt haben, folgen Sie dem Link unten und das Passwort des Kontos wird aktualisiert');

define('SUCCESS_PASSWORD_SENT', 'Fertig: Ihr neues Passwort wurde Ihnen per E-Mail zugeschickt.');
define('SUCCESS_PASSWORD_TOKEN_SENT', 'Fertig: Ein Link zum Zurücksetzen des Passworts wurde an Ihre E-Mail-Adresse gesendet.');
define('EMAIL_TOKEN_ERROR', 'Token ist nicht mehr gültig');