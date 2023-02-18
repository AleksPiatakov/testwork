<?php

if ($_GET['method'] == 'ajax') {
    chdir('../../');
    $rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
    require($rootPath . '/includes/application_top.php');
}

if (COMPARE_MODULE_ENABLED == 'true') {
    require $template->requireBox('H_COMPARE');
}
