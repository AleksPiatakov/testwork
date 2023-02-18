<?php
/*
  $ Id: login.php, v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Lösungen
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce

    Released under the GNU General Public License
*/

  define('NAVBAR_TITLE', 'Login');
  define('HEADING_TITLE', 'Willkommen, gib deine Daten ein');
  define('TEXT_STEP_BY_STEP', ''); // should be empty

define('HEADING_RETURNING_ADMIN', 'Login: ');
define('HEADING_PASSWORD_FORGOTEN', 'Passwort Erinnerung: ');
define('TEXT_RETURNING_ADMIN', 'Nur für Administratoren!');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail-Adresse: ');
define('ENTRY_PASSWORD', 'Passwort: ');
define('ENTRY_FIRSTNAME', 'Name: ');
define('IMAGE_BUTTON_LOGIN', 'Login');

define('TEXT_PASSWORD_FORGOTTEN', 'Passwort vergessen?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>Fehler:</b></font> Ungültige E-Mail-Adresse oder(und) ein Passwort!');
define('TEXT_LOGIN_ERROR_TRIED', '<font color="#ff0000"><b>FEHLER:</b></font> Wiederholungen überschritten – versuchen Sie es in 5 Minuten erneut');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>Fehler:</b></font> Der Name und Passwort stimmen nicht überein');
define('TEXT_FORGOTTEN_FAIL', 'Sie haben versucht, mehr als 3 mal zu Sicherheitszwecken einzugeben, wenden Sie sich bitte an den Administrator für die Eingabe des Passworts.<br>&nbsp;<br>&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'Ein neues Passwort wurde an Ihre E-Mail-Adresse. Überprüfen Sie Ihre E-Mail und versuchen, erneut eingeben gesendet.<br>&nbsp;<br>&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'Dein neues Passwort!');
define('ADMIN_EMAIL_TEXT', 'Hallo %s' . "\n\n" . 'Sie können gehen an den Administrator mit dem folgende Kennwort ein. Nachdem sie mit dem Passwort anmelden, empfehlen wir, dass Sie Ihr Passwort auf dem neuen ändern!' . "\n\n" . 'Seite: s%' . "\n " . 'e-Mail: %s' . "\n" . 'Passwort: %s' . "\n\n" . 'Thank you!' ."\n" . '%s' . "\n\n". 'Diese E-Mail wurde automatisch gesendet, Sie müssen sie nicht beantworten!');
?>