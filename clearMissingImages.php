<?php

require('includes/application_top.php');

http_response_code(403);

$content = CONTENT_ERROR_403;
//$missingImages = checkMissingImageFiles();
//$result = deleteMissingImageFromDb($missingImages);
echo $result;

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
