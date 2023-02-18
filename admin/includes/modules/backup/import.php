<?php
if (strstr($_SERVER['PHP_SELF'],'import.php')){die;}
$_POST = [
  'webfile'=>true,
  'only_errors'=>true,
  'filepath'=> BACKUP_FOLDER.$dumpFilename
];
$_GET['import'] = true;
$error = false;
include ADMINER_ROOT . "sql.inc.php";
die(123);