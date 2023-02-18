<?php

$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
chdir('../../');

require($rootPath . '/includes/application_top.php');

error_reporting(E_ALL);

include('kcaptcha.php');

//session_start();

$captcha = new KCAPTCHA();

//if($_REQUEST[session_name()]){
    $_SESSION['captcha_keystring'] = $captcha->getKeyString();

//}
