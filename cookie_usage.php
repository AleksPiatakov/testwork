<?php

require('includes/application_top.php');

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_COOKIE_USAGE);

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_COOKIE_USAGE));

$content = CONTENT_COOKIE_USAGE;

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
