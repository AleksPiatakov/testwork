<?php

require('includes/application_top.php');

if (file_exists(DIR_FS_EXT . 'yml_import/yml_import.php') && defined('YML_MODULE_ENABLED') && constant('YML_MODULE_ENABLED') == 'true'){
    require (DIR_FS_EXT . 'yml_import/yml_import.php');
}else{
    $location = explode('/',$_SERVER['REQUEST_URI']);
    array_pop($location);
    header('Location: '.implode('/',$location));
}