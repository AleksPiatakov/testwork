<?php
/*
  $Id: admin_files.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Nabídka Admin "Boxy"');

define('TABLE_HEADING_ACTION', 'Akce');
define('TABLE_HEADING_BOXES', 'Boxy');
define('TABLE_HEADING_FILENAME', 'Názvy souborů');
define('TABLE_HEADING_GROUPS', 'Skupiny');
define('TABLE_HEADING_STATUS', 'Stav');

define('TEXT_COUNT_BOXES', 'Boxy: ');
define('TEXT_COUNT_FILES', 'Soubory: ');

//přístup ke kategoriím
define('TEXT_INFO_HEADING_DEFAULT_BOXES', 'Boxy: ');

define('TEXT_INFO_DEFAULT_BOXES_INTRO', 'Pro instalaci krabice klikněte na zelené tlačítko, pro odinstalaci na červené tlačítko.<br><br><b>UPOZORNĚNÍ:</b> Pokud krabici odinstalujete, všechny soubory uložené v bude odstraněn!');
define('TEXT_INFO_DEFAULT_BOXES_INSTALLED', ' nainstalováno');
define('TEXT_INFO_DEFAULT_BOXES_NOT_INSTALLED', ' není nainstalováno');

define('STATUS_BOX_INSTALLED', 'Instalováno');
define('STATUS_BOX_NOT_INSTALLED', 'Není nainstalováno');
define('STATUS_BOX_REMOVE', 'Odebrat');
define('STATUS_BOX_INSTALL', 'Instalovat');

//přístup k souborům
define('TEXT_INFO_HEADING_DEFAULT_FILE', 'Soubor: ');
define('TEXT_INFO_HEADING_DELETE_FILE', 'Odebrat potvrzení');
define('TEXT_INFO_HEADING_NEW_FILE', 'Uložit soubory');

define('TEXT_INFO_DEFAULT_FILE_INTRO', 'Klikněte na tlačítko <b>uložit soubory</b> pro vložení nového souboru do aktuálního pole: ');
define('TEXT_INFO_DELETE_FILE_INTRO', 'Odebrat <span><b>%s</b></span> z <b>%s</b> pole? ');
define('TEXT_INFO_NEW_FILE_INTRO', 'Zkontrolujte <span><b>levou nabídku</b></span>, abyste se ujistili, že ukládáte správné soubory.');

define('TEXT_INFO_NEW_FILE_BOX', 'Aktuální schránka: ');

//Knoflík
define('BUTTON_CANCEL_NEW', 'zrušit');
define('BUTTON_BACK_NEW', 'zpět');
define('BUTTON_ADMIN_FILES_NEW', 'ukládat soubory');
define('BUTTON_ADMIN_REMOVE_NEW', 'odstranit');