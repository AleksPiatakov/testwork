<?php

// Ajaxing to Routes.php
if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    require('includes/application_top.php');
    if (isset($_POST['render'])) {
        $module_route = $_POST['render'];
        // echo '<script>console.log('.json_encode($module_route).')</script>';
        include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/boxes/mainpage_modules/' . $module_route . '.php');

        exit;
    }
}
