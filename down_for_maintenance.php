<?php

require('includes/application_top.php');

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . DOWN_FOR_MAINTENANCE_FILENAME);

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(DOWN_FOR_MAINTENANCE_FILENAME));

$content = CONTENT_DOWN_FOR_MAINTAINANCE;

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);
require(DIR_WS_INCLUDES . 'application_bottom.php');
