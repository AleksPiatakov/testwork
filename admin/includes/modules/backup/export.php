<?php

if (strstr($_SERVER['PHP_SELF'],'export.php')){die;}

define('DUMP_FILENAME', date('Y-m-d-H-i-s').'.sql');


function save_output($buffer) {
    file_put_contents(BACKUP_FOLDER.DUMP_FILENAME, $buffer, FILE_APPEND);
}

if (empty($_POST['exportTables'])){
    $tables = tables_list();
}else{
    $tables = array_flip($_POST['exportTables']);
}

$_POST = array(
  'output' => 'text',
  'format' => 'sql',
  'table_style' => 'DROP+CREATE',
  'data_style' => 'TRUNCATE+INSERT',
  'tables' => array_keys($tables),
  'data' => array_keys($tables),
);

file_put_contents(BACKUP_FOLDER.DUMP_FILENAME, '');
ob_start('save_output', 1e6);
include ADMINER_ROOT . "dump.inc.php";
ob_get_contents();
ob_end_clean();
die(123);
