<?php

if ($_GET['ajaxloading'] == 'true') {
    $rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
    chdir('../../');
    require($rootPath . '/includes/application_top.php');
}
require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/boxes/header/loginbox.php');
