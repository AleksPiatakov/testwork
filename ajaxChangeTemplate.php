<?php

require('includes/application_top.php');
if (isset($_POST['template_name']) && $_POST['template_name']) {
    if (isValidTemplateName($_POST['template_name'])) {
        setcookie("template_name", $_POST['template_name'], time() + 86400, HTTP_SERVER);
        tep_redirect(FILENAME_DEFAULT);
    }
}
die;
