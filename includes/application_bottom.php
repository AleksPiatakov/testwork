<?php
/*
  $Id: application_bottom.php,v 1.2 2003/09/24 15:34:33 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

if (!tep_session_is_registered('customer_id') && ENABLE_PAGE_CACHE == 'true' && class_exists('page_cache')) {
    global $page_cache;
    $page_cache->end_page_cache();
}
if (isset($_GET['showPageTime'])) {
    var_dump(microtime(true) - PAGE_PARSE_START_TIME);
}
// Log page speed
if (getConstantValue('ENABLE_DEBUG_PAGE_SPEED') === 'true') {
    $finishTime = round((microtime(true) - PAGE_PARSE_START_TIME), 2);
    if ($finishTime > 5) {
        $getContents = '';
        foreach ($_GET as $key => $value) {
            $getContents .= $key . " => " . $value . ' | ';
        }
        $postContents = '';
        foreach ($_POST as $key => $value) {
            $postContents .= $key . " => " . $value . ' | ';
        }
        \App\Logger\Log::channel('all')->info('debug_page_speed',[
            'SERVER_NAME' => $_SERVER['SERVER_NAME'],
            'REQUEST_URI' => $_SERVER['REQUEST_URI'],
            'SPENT_TIME' => $finishTime,
            'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
            'GET' => $getContents,
            'POST' => $postContents
        ]);
    }
}
// close session (store variables)
  tep_session_close();

  if ( (GZIP_COMPRESSION == 'true') && ($ext_zlib_loaded == true) && ($ini_zlib_output_compression < 1) ) {
    if ( (PHP_VERSION < '4.0.4') && (PHP_VERSION >= '4') ) {
      tep_gzip_output(GZIP_LEVEL);
    }
  }
