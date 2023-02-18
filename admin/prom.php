<?php

require('includes/application_top.php');

if (file_exists(DIR_FS_EXT . 'prom_excel/prom.php') && defined('PROM_EXCEL_MODULE_ENABLED') && constant('PROM_EXCEL_MODULE_ENABLED') == 'true'){
    require (DIR_FS_EXT . 'prom_excel/prom.php');
}else{
    $location = explode('/',$_SERVER['REQUEST_URI']);
    array_pop($location);
    header('Location: '.implode('/',$location));
}