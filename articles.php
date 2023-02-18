<?php

require('includes/application_top.php');
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLES);

// Set number of columns in listing
define('NR_COLUMNS', 1);
//
// $breadcrumb->add(HEADING_TITLE, tep_href_link(FILENAME_ARTICLES, '', 'NONSSL'));

$content = CONTENT_ARTICLES;
if (empty($tPath)) {
    http_response_code(404);
    $content = CONTENT_ERROR_404;
}

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
