<?php

require('includes/application_top.php');
if ($file = $template->getFiles('HEADER', 'H_SHOPPING_CART')) {
    require $file;
}
