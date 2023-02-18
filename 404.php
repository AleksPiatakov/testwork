<?php

// 404 page
http_response_code(404);

$http_accept = $_SERVER['HTTP_ACCEPT'];
$image_mime = [
    'image/gif',
    'image/jpeg',
    'image/pjpeg',
    'image/png',
    'image/svg+xml',
    'image/tiff',
    'image/vnd.microsoft.icon',
    'image/vnd.wap.wbmp',
    'image/webp',
    'image/apng',
];
if (
    array_filter($image_mime, function ($mime) use ($http_accept) {
        return strstr($http_accept, $mime) && !strstr($http_accept, 'text/html');
    })
) {
    die;
}
require('includes/application_top.php');

$content = CONTENT_ERROR_404;

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
