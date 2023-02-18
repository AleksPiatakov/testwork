<?php
/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 23.05.2019
 * Time: 17:23
 */
chdir('../');
require('includes/application_top.php');
require_once (DIR_WS_FUNCTIONS . 'minification.php');

checkAndGenerateCriticalCss();
echo json_encode(['success'=> true]);