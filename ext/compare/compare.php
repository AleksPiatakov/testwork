<?php

error_reporting(E_ALL & ~E_NOTICE);

if ($_GET['ifdel'] == 'delete') {
    $_GET['delete'] = $_GET['idp'];
}

if ($rootPath == '') {
    chdir('../../');
    $rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
}
require($rootPath . '/includes/application_top.php');

if ($_GET['ifdel'] == 'delete') {
    $output['text'] = COMPARE;
    $output['link'] = '';
} else {
    $output['text'] = GO_COMPARE;
    $output['link'] = tep_href_link('compare.php');
}

$output['count'] = is_array($_SESSION['compares']) ? count($_SESSION['compares']) : 0;


if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    echo json_encode($output);
} else {
    $content = 'compare';
    require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);
    require(DIR_WS_INCLUDES . 'application_bottom.php');
}
