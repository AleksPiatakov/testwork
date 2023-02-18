<?php

require('includes/application_top.php');
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRICE_HTML);
// Set number of columns in listing
define('NR_COLUMNS', 1);
//
$breadcrumb->add(BOX_INFORMATION_ALLPRODS);
$content = CONTENT_PRICE_HTML;
if ($_SERVER['REQUEST_URI'] == '/' . $_GET['language'] . '/' . $content . '.php') {
    tep_redirect('/' . $_GET['language'] . '/sitemap.html');
} elseif ($_SERVER['REQUEST_URI'] == '/' . $content . '.php') {
    tep_redirect('/sitemap.html');
}

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);
require(DIR_WS_INCLUDES . 'application_bottom.php');
