<?php

require('includes/application_top.php');
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLE_INFO);

// Set number of columns in listing
define('NR_COLUMNS', 1);
//
$article_check_query = tep_db_query("select a.articles_status from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad where a.articles_id = '" . (int)$_GET['articles_id'] . "' and ad.articles_id = a.articles_id and ad.language_id = '" . (int)$languages_id . "'");
$article_check = tep_db_fetch_array($article_check_query);
if ($article_check['articles_status'] == "1") {
    $content = CONTENT_ARTICLE_INFO;
} else {
    http_response_code(404);
    $content = CONTENT_ERROR_404;
}

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
