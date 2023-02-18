<?php
/*
  $Id: admin_account.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Administrator');

define('TABLE_HEADING_ACCOUNT', 'Meine Daten');

define('TEXT_INFO_FULLNAME', '<b>Name: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Name: </b>');
define('TEXT_INFO_LASTNAME', '<b>Nachname: </b>');
define('TEXT_INFO_EMAIL', '<b>E-Mail-Adresse: </b>');
define('TEXT_INFO_PASSWORD', '<b>Passwort: </b>');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Passwort bestätigen: </b>');
define('TEXT_INFO_CREATED', '<b>Datensatz erstellt: </b>');
define('TEXT_INFO_LOGDATE', '<b>Letzter Eintrag: </b>');
define('TEXT_INFO_LOGNUM', '<b>Anzahl der Eingaben: </b>');
define('TEXT_INFO_GROUP', '<b> Gruppe: </b>');
define('TEXT_INFO_ERROR', 'Diese E-Mail-Adresse ist bereits registriert! Versuchen Sie es erneut.');
define('TEXT_INFO_MODIFIED', 'Letzte Änderungen:');
define('TEXT_INFO_PASSWORD_HIDDEN', '**************');

define('TEXT_INFO_HEADING_DEFAULT', 'Daten bearbeiten');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Passwort eingeben');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Passwort:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<b>FEHLER:</b> falsches Passwort!');
define('TEXT_INFO_INTRO_DEFAULT', 'Klicken Sie auf <b>ändern</b>, um die Daten zu bearbeiten.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br><b>ACHTUNG:.</b><br>Hallo, <b>%s</b>, Sie kam hier zum ersten Mal, dass wir empfehlen, dass Sie Ihr Passwort ändern!');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br><b>ACHTUNG:</b><br>Hallo, <b>%s</b>, empfehlen wir Ihnen, Ihre E-Mail-Adresse ändern (admin @ localhost) und das Passwort!');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Alle Felder im Formular sind erforderlich. Klicken Sie auf "Speichern", um die Änderungen zu speichern.');

define('JS_ALERT_FIRSTNAME',        '- Du hast deinen Namen nicht angegeben. \n');
define('JS_ALERT_LASTNAME',         '- Du hast Deinen Nachnamen nicht angegeben. \n');
define('JS_ALERT_EMAIL',            '- Sie haben Ihre E-Mail-Adresse nicht angegeben. \n');
define('JS_ALERT_PASSWORD',         '- Sie haben Ihr Passwort nicht eingegeben. \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Das Feld Name muss mindestens folgende Zeichen enthalten: ');
define('JS_ALERT_LASTNAME_LENGTH',  '- Das Feld Nachname muss mindestens folgende Zeichen enthalten: ');
define('JS_ALERT_PASSWORD_LENGTH',  '- Das Passwortfeld muss mindestens folgende Zeichen enthalten: ');
define('JS_ALERT_EMAIL_FORMAT',     '- Du hast die falsche E-Mail Adresse geschrieben! \n');
define('JS_ALERT_EMAIL_USED',       '- Die eingegebene Email-Adresse ist bereits registriert! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- Sie haben im Feld Passwort bestätigen kein Passwort eingegeben! \n');

define('ADMIN_EMAIL_SUBJECT', 'Ihre Daten wurden geändert!');
define( 'ADMIN_EMAIL_TEXT', 'Hallo, %s!' . "\n\n". 'Wurde Ihre Daten erfolgreich geändert. Wenn Sie nicht Ihre Informationen ändern, wenden Sie sich bitte an den Administrator kann jemand Zugriff auf Ihre Daten zu gewinnen versuchen!!' . "\n\n" . 'Webseite: %s' . "\n" . 'E-Mail: %s' . "\n" . 'Passwort: %s' . "\n\n" . 'Danke!' . "\n" . '%s' . "\n\n" . 'Diese Nachricht automatisch gesendet wurde, keine Notwendigkeit zu beantworten!');

//Button
define('BUTTON_BACK_NEW', 'zurück');
?>

