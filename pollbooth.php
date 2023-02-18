<?php

require('includes/application_top.php');
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_POLLS);

$breadcrumb->add(defined("HEADING_TITLE") ? HEADING_TITLE : "", tep_href_link(FILENAME_POLLS, '', 'NONSSL'));

$content = CONTENT_POLLS;

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
