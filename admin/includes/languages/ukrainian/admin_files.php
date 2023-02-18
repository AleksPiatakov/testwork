<?php
/*
  $Id: admin_files.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Меню боксів для адміністраторів');

define('TABLE_HEADING_ACTION', 'Дія');
define('TABLE_HEADING_BOXES', 'Бокси');
define('TABLE_HEADING_FILENAME', 'Список файлів');
define('TABLE_HEADING_GROUPS', 'Групи');
define('TABLE_HEADING_STATUS', 'Статус');

define('TEXT_COUNT_BOXES', 'Бокси: ');
define('TEXT_COUNT_FILES', 'Файли: ');

//categories access
define('TEXT_INFO_HEADING_DEFAULT_BOXES', 'Ім\'я файлу:');

define('TEXT_INFO_DEFAULT_BOXES_INTRO', 'Щоб бокс був активований, натисніть на зелену кнопку, щоб зробити бокс неактивним (невидимим), натисніть на червону кнопку.<br><br><b>УВАГА:</b> Якщо Ви вимкніть бокс, то все файли, розташовані в даному боксі також будуть не видні!');
define('TEXT_INFO_DEFAULT_BOXES_INSTALLED', ' Активний');
define('TEXT_INFO_DEFAULT_BOXES_NOT_INSTALLED', ' Неактивний');

define('STATUS_BOX_INSTALLED', ' Активний');
define('STATUS_BOX_NOT_INSTALLED', ' Неактивний');
define('STATUS_BOX_REMOVE', 'Вимкнути');
define('STATUS_BOX_INSTALL', 'Увімкнути');

//files access
define('TEXT_INFO_HEADING_DEFAULT_FILE', 'Файл: ');
define('TEXT_INFO_HEADING_DELETE_FILE', 'Підтвердження видалення:');
define('TEXT_INFO_HEADING_NEW_FILE', 'Додати файл в бокс');

define('TEXT_INFO_DEFAULT_FILE_INTRO', 'Натисніть кнопку <b>додати</b> і файли, які Ви оберете будуть додані в бокс: ');
define('TEXT_INFO_DELETE_FILE_INTRO', 'Ви дійсно хочете видалити файл <span><b>%s</b></span> з боксу <b>%s</b>? ');
define('TEXT_INFO_NEW_FILE_INTRO', 'Переконайтеся, що файл, який Ви хочете додати відсутній в <span><b>списку файлів</b></span> зліва. Можливо, файл, який Ви хочете додати, уже є в списку.');

define('TEXT_INFO_NEW_FILE_BOX', 'Поточний бокс:');

//Button
define('BUTTON_CANCEL_NEW', 'відмінити');
define('BUTTON_BACK_NEW', 'назад');
define('BUTTON_ADMIN_FILES_NEW', 'добавити файли');
define('BUTTON_ADMIN_REMOVE_NEW', 'видалити');
?>
