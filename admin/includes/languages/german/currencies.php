<?php
/*
  $ Id: currencies.php, v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Lösungen
  http://www.oscommerce.com

  Copyright(c) 2003 osCommerce

    Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Währungen');

define('TABLE_HEADING_CURRENCY_NAME', 'Währung');
define('TABLE_HEADING_CURRENCY_CODES', 'Code');
define('TABLE_HEADING_CURRENCY_VALUE', 'Value');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_INFO_EDIT_INTRO', 'Bitte nehmen Sie die notwendigen Änderungen vor');
define('TEXT_INFO_CURRENCY_TITLE', 'Name:');
define('TEXT_INFO_CURRENCY_CODE', 'Code:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Symbol nach links:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Symbol rechts:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Dezimalzeichen:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Tausendertrennzeichen:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Dezimalordnungen:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Zuletzt korrigiert:');
define('TEXT_INFO_CURRENCY_VALUE', 'Wert:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Beispiel:');
define('TEXT_INFO_INSERT_INTRO', 'Bitte Daten für die neue Währung eingeben');
define('TEXT_INFO_DELETE_INTRO', 'Möchten Sie diese Währung wirklich löschen?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Neue Währung');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Währung ändern');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Währung entfernen');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . '(diese Währung muss manuell angepasst werden)');
define('TEXT_INFO_CURRENCY_UPDATED', 'Der Wechselkurs für %s( %s) wurde erfolgreich mit %s aktualisiert . ');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Fehler: Die Standardwährung kann nicht gelöscht werden. Bitte geben Sie eine andere Standardwährung an und versuchen Sie es erneut . ');
define('ERROR_CURRENCY_INVALID', 'Fehler: Der Wechselkurs für %s( %s) haben Sie haben die Währung nicht mit Hilfe von %s aktualisierte Code korrekt darauf hingewiesen, den Wechselkurs zu aktualisieren, müssen Sie mit dem Internet verbunden werden.? . ');
define('WARNING_PRIMARY_SERVER_FAILED', 'Warnung: Fehler beim Server( %s) und aktualisieren den Wechselkurs für %s (%s) verbinden - versuchen, auf einem anderen Server zu verbinden, um den Wechselkurs zu aktualisieren, müssen Sie mit dem Internet verbunden werden. ') ;
?>