<?php
/*
  $Id: admin_files.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Administrator Box Menü');

define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_BOXES', 'Boxen');
define('TABLE_HEADING_FILENAME', 'Liste der Dateien');
define('TABLE_HEADING_GROUPS', 'Gruppen');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_COUNT_BOXES', 'Boxen:');
define('TEXT_COUNT_FILES', 'Dateien:');

//categories access
define('TEXT_INFO_HEADING_DEFAULT_BOXES', 'Dateiname:');

define('TEXT_INFO_DEFAULT_BOXES_INTRO', 'Um Feld aktiviert wurde, drücken Sie die grüne Taste, die rote Taste  Boxen inaktiv (unsichtbar), drücken Sie zu machen. <br><br><b>ACHTUNG:</b> Wenn Sie die Box ausschalten, dann sind auch alle Dateien in diesem Feld nicht sichtbar!');
define('TEXT_INFO_DEFAULT_BOXES_INSTALLED', 'Aktiv');
define('TEXT_INFO_DEFAULT_BOXES_NOT_INSTALLED', 'Inaktiv');

define('STATUS_BOX_INSTALLED', 'Aktiv');
define('STATUS_BOX_NOT_INSTALLED', 'Inaktiv');
define('STATUS_BOX_REMOVE', 'Disable');
define('STATUS_BOX_INSTALL', 'Aktivieren');

//files access
define('TEXT_INFO_HEADING_DEFAULT_FILE', 'Datei:');
define('TEXT_INFO_HEADING_DELETE_FILE', 'Löschbestätigung:');
define('TEXT_INFO_HEADING_NEW_FILE', 'Datei zur Box hinzufügen');

define('TEXT_INFO_DEFAULT_FILE_INTRO', 'Klicken Sie auf die Schaltfläche <b>hinzufügen</b> und die ausgewählten Dateien werden zum Feld hinzugefügt:');
define('TEXT_INFO_DELETE_FILE_INTRO', 'Haben Sie die Datei wollen <span><b>%s</b></span> aus dem Feld <b>%s</b> wirklich löschen?');
define('TEXT_INFO_NEW_FILE_INTRO', 'Stellen Sie sicher, dass die Datei, die Sie hinzufügen möchten, nicht in der list <span><b>Dateiliste</b></span> auf der linken Seite. Die Datei, die Sie bereits in der Liste hinzufügen möchten.');

define('TEXT_INFO_NEW_FILE_BOX', 'Aktuelles Feld:');

//Button
define('BUTTON_CANCEL_NEW', 'stornieren');
define('BUTTON_BACK_NEW', 'zurück');
define('BUTTON_ADMIN_FILES_NEW', 'akten lagern');
define('BUTTON_ADMIN_REMOVE_NEW', 'löschen');
?>