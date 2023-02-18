<?php
/*
  $Id: admin_files.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Menu Administratora Boxów');

define('TABLE_HEADING_ACTION', 'Działanie');
define('TABLE_HEADING_BOXES', 'Boxy');
define('TABLE_HEADING_FILENAME', 'Lista plików');
define('TABLE_HEADING_GROUPS', 'Grupy');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_COUNT_BOXES', 'Boxy: ');
define('TEXT_COUNT_FILES', 'Pliki: ');

//categories access
define('TEXT_INFO_HEADING_DEFAULT_BOXES', 'Nazwa pliku: ');

define('TEXT_INFO_DEFAULT_BOXES_INTRO', 'Aby box został aktywowany, kliknij zielony przycisk, aby box został nieaktywny (niewidoczny), kliknij czerwony przycisk.<br><br><b>UWAGA:</b> Jeżeli wyłączysz box, wszystkie pliki znajdujące się w tym boxie także będą niewidoczne!');
define('TEXT_INFO_DEFAULT_BOXES_INSTALLED', ' Aktywny');
define('TEXT_INFO_DEFAULT_BOXES_NOT_INSTALLED', ' Nieaktywny');

define('STATUS_BOX_INSTALLED', 'Aktywny');
define('STATUS_BOX_NOT_INSTALLED', 'Nieaktywny');
define('STATUS_BOX_REMOVE', 'Wyłączyć');
define('STATUS_BOX_INSTALL', 'Włączyć');

//files access
define('TEXT_INFO_HEADING_DEFAULT_FILE', 'Plik: ');
define('TEXT_INFO_HEADING_DELETE_FILE', 'Potwierdź usunięcie:');
define('TEXT_INFO_HEADING_NEW_FILE', 'Dodaj plik do boxu');

define('TEXT_INFO_DEFAULT_FILE_INTRO', 'Naciśnij przycisk <b>dodaj</b> i pliki, które wybierzesz będą dodane do boxu: ');
define('TEXT_INFO_DELETE_FILE_INTRO', 'Czy na pewno chcesz usunąć plik <span><b>%s</b></span> z boxu <b>%s</b>? ');
define('TEXT_INFO_NEW_FILE_INTRO', 'Upewnij się, że plik, który chcesz dodać, nie znajduje się na <span><b>liście plików</b></span> po lewej stronie. Być może plik, który chcesz dodać, już znajduje się na liście.');

define('TEXT_INFO_NEW_FILE_BOX', 'Obecny box: ');

//Button
define('BUTTON_CANCEL_NEW', 'anuluj');
define('BUTTON_BACK_NEW', 'powróć');
define('BUTTON_ADMIN_FILES_NEW', 'przechowuj pliki');
define('BUTTON_ADMIN_REMOVE_NEW', 'usuń');
?>
